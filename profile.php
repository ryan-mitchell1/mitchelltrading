<?php
require_once 'header.php';
include('register-handler.php');
include('login-handler.php');
session_start();
$username_preset = "";
$email_preset = "";
if (isset($_SESSION['form'])) {
    $username_preset = $_SESSION['form']['username'];
    $email_preset = $_SESSION['form']['email'];
}
?>
<div class="header">
    <a href="index.php" class="logo"><img class="logo" src="logo.png"></a>
    <div class="header-middle">Create a New Account</div>
</div>
<div>
    <ul class="navbar-list">
        <li class="navbar-item float-left"><a class="navbar-anchor" href="index.php">Home</a></li>
        <li class="navbar-item float-left"><a class="navbar-anchor" href="history.php">History</a></li>
        <li class="navbar-item float-left"><a class="navbar-anchor" href="about.php">About</a></li>
        <li class="navbar-item active float-right"><a class="navbar-anchor" href="profile.php">Register</a></li>
    </ul>
</div>
<form action="register-handler.php" method="post">
    <div class="login-container">
        <h2>Register</h2>
        <div>
            <label for="username">Username:</label>
            <input type="text" value="<?php echo $username_preset; ?>" name="username" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" value="<?php echo $email_preset; ?>" name="email" required>
        </div>
        <div>
            <label for="password_1">Password:</label>
            <input type="password" name="password_1" required>
        </div>
        <div>
            <label for="password_2">Confirm Password:</label>
            <input type="password" name="password_2" required>
        </div>
        <button type="submit" class="user-button" name="register-user">Submit</button>

        <p>Already a user? <a href="login.php"><b>Log in</b></a></p>
        <?php
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<div class='error'>{$error}</div>";
            }
            unset($_SESSION['errors']);
        } ?>
    </div>

</form>

<?php require_once 'footer.php'; ?>
