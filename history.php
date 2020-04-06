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
        <li class="navbar-item float-right"><a class="navbar-anchor" href="profile.php">Register</a></li>
    </ul>
</div>
<div class="history-table">
    <h2 class="center-text">History of all trades made to date</h2>
    <table id="trade-table">
        <tr>
            <th>Currency</th>
            <th>Buy Price and Date</th>
            <th>Sell Price and Date</th>
            <th class="center-text">Profit or loss</th>
        </tr>
        <tr>
            <td>BTC</td>
            <td>9678 2020-17-02:15:30</td>
            <td>9778 2020-18-02:30:45</td>
            <td class="profit">100</td>
        </tr>
        <tr>
            <td>ETH</td>
            <td>297 2020-17-02:15:30</td>
            <td>257 2020-18-02:30:45</td>
            <td class="loss">-40</td>
        </tr>
        <tr>
            <td>Example</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
        </tr>
        <tr>
            <td>Example</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
        </tr>
        <tr>
            <td>Example</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
        </tr>
        <tr>
            <td>Example</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
        </tr>
        <tr>
            <td>Example</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
            <td>Temp table data</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>Total Buy: ####</td>
            <td>Total Sell: ####</td>
            <td>Total profit or loss: ###</td>
        </tr>
    </table>
</div>
<?php require_once 'footer.php'; ?>
