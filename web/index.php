<?php session_start(); ?>
<h1>This is Index</h1>
<?php
if ($_SESSION['username'] != null) {
    $username = $_SESSION['username'];
    echo '<h3>WelCome <l> {$username} </l>!</h3>';
    echo '<a href="logout.php">Logout</a>';
} else {
    echo '<h3> Hi guest!</h3>';
    echo '<a href="loginpage.php">Click here to Login</a>';
}
?>