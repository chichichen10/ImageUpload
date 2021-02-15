<?php
if (!isset($_SESSION)) {
    session_start();
}

$form_private = $_POST['private'];
$form_data = $_FILES['form_data']['tmp_name'];
$form_type = $_FILES['form_data']['type'];
$username = $_SESSION['username'];

$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));

$sql = "INSERT INTO images(image,private,username,type) VALUES('$form_data','$form_private','$username','$form_type')";

$result = $pdo->query($sql);
if ($result) {
    echo "File uploaded.";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
} else {
    echo "Failed";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}