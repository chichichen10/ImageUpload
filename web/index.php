<?php session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On'); ?>
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
    <input type="file" name="form_data" required ><br>
    Private <input type="radio" name="private" checked value = "true"></br>
    Public <input type="radio" name="private" value = "false"></br>
    <input type="submit" name="submit" value="submit">
    </form>';
} else {
    echo '<h3> Hi guest!</h3>';
    echo '<a href="loginpage.php">Click here to Login</a>';
}
$sql = "SELECT * FROM images";

$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));

$result = $pdo->query($sql);
$rows = $result->fetchAll();
foreach ($rows as $row) {

    $data = 'data:' . $row['type'] . ';base64,' . $row['image'];
    echo "<a href='view.php?imageid=" . $row['id'] . "'>";
    echo "<img src=$data></a>"; ?>
<br><?php
    }
        ?>