<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$imageID = $_GET['imageid'];
$sql = "SELECT * FROM images WHERE id = '$imageID'";

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
$row = $result->fetch();
$data = 'data:' . $row['type'] . ';base64,' . $row['image'];
echo "<img src=$data>"; ?>
<a href="index.php">back to index page</a>