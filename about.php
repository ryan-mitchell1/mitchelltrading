<?php
require_once 'header.php';
include('register-handler.php');
include('login-handler.php');
session_start();
?>
<div class="header">
    <a href="index.php" class="logo"><img class="logo" src="logo.png"></a>
    <div class="header-middle">A little bit about me and this website!</div>
</div>
<div>
    <ul class="navbar-list">
        <li class="navbar-item float-left"><a class="navbar-anchor" href="index.php">Home</a></li>
        <li class="navbar-item float-left"><a class="navbar-anchor" href="history.php">History</a></li>
        <li class="navbar-item active float-left"><a class="navbar-anchor" href="about.php">About</a></li>
        <li class="navbar-item float-right"><a class="navbar-anchor" href="profile.php">Register</a></li>
    </ul>
</div>
<div class="about-content">
    <h3>More about this website!</h3>
    <p>
        This purpose of this website is for others and myself to learn more about crypto currency trading bots.
        Currently the bot that is being used is provided by Shrimp.io. Moving forward I want to try more programming
        forward bots or to create my own. Mitchelltrading.net is a project for a college class but will be maintained
        as long as it is used.
    </p>
    <h3>A little about me!</h3>
    <p>
        My name is Ryan and I created this website for a class at Boise State University. I am currently a student there
        studying computer science and am on my way to graduate in 2021. All inquiries can be directed to mitchelltradingcontact@gmail.com.
    </p>
</div>
<?php require_once 'footer.php'; ?>

