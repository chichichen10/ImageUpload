<?php

$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));

$sql = "DELETE FROM images";

$result = $pdo->query($sql);

if ($result) {
?>
<p3>System Initialized</p3>
<a href="index.php">Click here to go back to Index Page or redirecting in 10 seconds</a>
<?php
    echo '<meta http-equiv=REFRESH CONTENT=10;url=index.php>';
} else {
    echo "Failed";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}