<?php
require_once 'header.php';
include('register-handler.php');
include('login-handler.php');
session_start();
?>
<div class="header">
    <a href="index.php" class="logo"><img class="logo" src="logo.png"></a>
    <div class="header-middle">Welcome to Mitchell Trading</div>
</div>
<div>
    <ul class="navbar-list">
        <li class="navbar-item active float-left"><a class="navbar-anchor" href="index.php">Home</a></li>
        <li class="navbar-item float-left"><a class="navbar-anchor" href="history.php">History</a></li>
        <li class="navbar-item float-left"><a class="navbar-anchor" href="about.php">About</a></li>
        <?php if(isset($_SESSION['success'])): ?>
        <?php if(isset($_SESSION['isAdmin'])): ?>
        <li class="navbar-item float-left"><a class="navbar-anchor" href="admin.php">Admin</a></li>
        <?php endif; ?>
        <li class="navbar-item float-right"><a class="navbar-anchor" href="logout.php">Logout</a></li>
        <?php else: ?>
        <li class="navbar-item float-right"><a class="navbar-anchor" href="profile.php">Register</a></li>
        <?php endif; ?>
    </ul>
</div>
<div class="content">
    <div class="row">
        <div class="column left border-right">
            <h2 class="center-text">Recent News</h2>
            <?php
            // Get cURL resource
            $curl = curl_init();

            // Set some options - we are passing in a useragent too here
            $headers = array("x-api-key: " . "11297ef6254a1d46eeec6c2e8b056891");
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_URL => "https://cryptocontrol.io/api/v1/public/news?language=en&sentiment=false",
                CURLOPT_USERAGENT => "CryptoControl PHP client v2.3.0",
            ));

            // Send the request & save response to $resp
            $response = json_decode(curl_exec($curl));

            // Close request to clear up some resources
            curl_close($curl);
            echo '<ul>';
            for ($i = 0; $i < 2; $i++) {
                echo '<li><a target="_blank" href="'.$response[0]->similarArticles[$i]->url.'">'.$response[$i]->similarArticles[$i]->title.'</a></li>';
                echo '&nbsp';
                echo "<br>";
            }
            echo '</ul>'
            ?>
        </div>
        <div class="column middle">
            <h2 class="center-text">Table of most recent trades</h2>
            <table id="trade-table">
                <tr>
                    <th>Currency</th>
                    <th>Buy Price and Date</th>
                    <th>Sell Price and Date</th>
                </tr>
                <tr>
                    <td>BTC</td>
                    <td>9678 2020-17-02:15:30</td>
                    <td>9678 2020-18-02:30:45</td>
                </tr>
                <tr>
                    <td>Example</td>
                    <td>Temp table data</td>
                    <td>Temp table data</td>
                </tr>
            </table>
        </div>
        <div class="column right border-left">
            <h2 class="center-text">Current Prices</h2>
            <?php
            $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
            $parameters = [
                'start' => '1',
                'limit' => '11',
                'convert' => 'USD'
            ];

            $headers = [
                'Accepts: application/json',
                'X-CMC_PRO_API_KEY: 5e84d7ee-c29f-464f-9437-bafec267fb74'
            ];
            $qs = http_build_query($parameters); // query string encode the parameters
            $request = "{$url}?{$qs}"; // create the request URL


            $curl = curl_init(); // Get cURL resource
            // Set cURL options
            curl_setopt_array($curl, array(
                CURLOPT_URL => $request,            // set the request URL
                CURLOPT_HTTPHEADER => $headers,     // set the headers
                CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
            ));

            $response = curl_exec($curl); // Send the request, save the response
            for ($i = 0; $i <= 10; $i++) {
                print_r(json_decode($response)->data[$i]->symbol); // print json decoded response
                echo '&nbsp';
                $price_data = json_decode($response)->data[$i]->quote;
                print_r(round((float)$price_data->USD->price, 2)); // print json decoded response
                echo "<br>";
            }
            curl_close($curl); // Close request
            ?>
        </div>
    </div>
</div>
<?php require_once 'footer.php'; ?>
