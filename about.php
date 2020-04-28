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
        <?php if(isset($_SESSION['success'])): ?>
            <li class="navbar-item float-right"><a class="navbar-anchor" href="logout.php">Logout</a></li>
        <?php else: ?>
            <li class="navbar-item float-right"><a class="navbar-anchor" href="profile.php">Register</a></li>
        <?php endif; ?>
    </ul>
</div>
<div class="about-content">
    <h3>More about this website!</h3>
    <p>
        This purpose of this website is for others and myself to learn more about crypto currency trading bots.
        Most recently the bot that was being used was provided by Shrimp.io. But I have started to look into more investing
        on my own in order to create my own bot in the future. Mitchelltrading.net is a project for a college class but
        will be maintained as long as it is used.
    </p>
    <h3>A little about me!</h3>
    <p>
        My name is Ryan and I created this website for a class at Boise State University. I am currently a student there
        studying computer science and am on my way to graduate in 2021. All inquiries can be directed to mitchelltradingcontact@gmail.com.
    </p>
</div>
<?php require_once 'footer.php'; ?>

