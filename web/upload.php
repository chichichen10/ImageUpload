<?php
if (!isset($_SESSION)) {
    session_start();
}

$form_private = $_POST['private'];
$form_data = file_get_contents($_FILES['form_data']['tmp_name']);
$form_type = $_FILES['form_data']['type'];
$username = $_SESSION['username'];

$id = md5(date_timestamp_get(date_create()));
$_SESSION['imageID'] = $id;

$base64 = base64_encode($form_data);

$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));

$sql = "INSERT INTO images(image,private,username,type,id) VALUES('$base64','$form_private','$username','$form_type','$id')";

$result = $pdo->query($sql);
if ($result) {
    echo "File uploaded.";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=editor.php>';
} else {
    echo "Failed";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}