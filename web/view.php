<?php

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
$row = $result->fetch();
$type = $row['type'];
try {
    // $data = $row['image']->pg_unescape_bytea();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
header("Content-type:$type");
echo pg_unescape_bytea($row['image']);