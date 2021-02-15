<?php session_start(); ?>
<h1>This is Index</h1>
<?php
if ($_SESSION['username'] != null) {
    $username = $_SESSION['username'];
    echo "<h3>WelCome <l> {$username} </l>!</h3>";
    echo '<a href="logout.php">Logout</a>';
    echo '<form method="post" action="upload.php" enctype="multipart/form-data">
    Upload File
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000"> <br>
    Upload
    <input type="file" name="form_data" size="40"><br>
    Private <input type="checkbox" name="private" checked></br>
    <input type="submit" name="submit" value="submit">
    </form>';
} else {
    echo '<h3> Hi guest!</h3>';
    echo '<a href="loginpage.php">Click here to Login</a>';
}
?>