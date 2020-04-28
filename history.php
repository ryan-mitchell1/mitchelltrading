<?php
require_once 'header.php';
include('register-handler.php');
include('login-handler.php');
session_start();
?>
<div class="header">
    <a href="index.php" class="logo"><img class="logo" src="logo.png"></a>
    <div class="header-middle">Full history of all trades made.</div>
</div>
<div>
    <ul class="navbar-list">
        <li class="navbar-item float-left"><a class="navbar-anchor" href="index.php">Home</a></li>
        <li class="navbar-item active float-left"><a class="navbar-anchor" href="history.php">History</a></li>
        <li class="navbar-item float-left"><a class="navbar-anchor" href="about.php">About</a></li>
        <?php if(isset($_SESSION['success'])): ?>
            <li class="navbar-item float-right"><a class="navbar-anchor" href="logout.php">Logout</a></li>
        <?php else: ?>
            <li class="navbar-item float-right"><a class="navbar-anchor" href="profile.php">Register</a></li>
        <?php endif; ?>
    </ul>
</div>
<div class="history-table">
    <h2 class="center-text">Total Summary</h2>
    <table id="trade-table">
        <tr>
            <th>Favorite Currency</th>
            <th>Total Bought</th>
            <th>Current Total</th>
            <th>Total Difference</th>
            <th>Time Trading</th>
        </tr>
        <?php
        require_once 'Dao.php';

        $dao = new Dao();

        $trades = $dao->getAllTrades();

        $amount_traded = [];
        $favorite_currency = "";
        $total_bought = 0;
        $current_total = 0;
        $total_difference = 0;
        $start_date = "";
        $end_date= "";
        $time_trading = "";
        $index = 0;

        foreach ($trades as $trade){
            if(array_key_exists($trade['currency'], $amount_traded)){
                $amount_traded[$trade['currency']] += 1;
            } else {
                $amount_traded[$trade['currency']] = 1;
            }
            $total_difference += $trade['difference'];
            $total_bought += $trade['money_added'];
            if($index == 0){
                $end_date = $trade['date'];
            }
            if($index == sizeof($trades)-1){
                $start_date = $trade['date'];
            }
            $index++;
        }
        $current_total = $total_bought + $total_difference;
        arsort($amount_traded);
        $favorite_currency = array_key_first($amount_traded);;
        $time_trading = $start_date." to ".$end_date;
        echo '<tr>';
        echo '<td>'.$favorite_currency.'</td>';
        echo '<td>'.$total_bought.'</td>';
        echo '<td>'.$current_total.'</td>';
        if($total_difference < 0) {
            echo '<td class="loss">' . $total_difference . '</td>';
        } else {
            echo '<td class="profit">' . $total_difference . '</td>';
        }
        echo '<td>'.$time_trading.'</td>';
        echo '</tr>';
        ?>
    </table>
</div>
<div class="history-table">
    <h2 class="center-text">History of all trades made to date</h2>
    <table id="trade-table">
        <tr>
            <th>Currency</th>
            <th>Price</th>
            <th>Amount</th>
            <th>Difference</th>
            <th>Date</th>
        </tr>
        <?php
        require_once 'Dao.php';

        $dao = new Dao();

        $trades = $dao->getAllTrades();

        foreach ($trades as $trade){
            echo '<tr>';
            echo '<td>'.$trade['currency'].'</td>';
            echo '<td>'.$trade['price'].'</td>';
            echo '<td>'.$trade['amount'].'</td>';
            echo '<td>'.$trade['difference'].'</td>';
            echo '<td>'.$trade['date'].'</td>';
            echo '</tr>';
        }
        ?>
    </table>
</div>
<?php require_once 'footer.php'; ?>
