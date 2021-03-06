<?php
if (!isset($_SESSION)) {
    session_start();
}
$db = parse_url(getenv("DATABASE_URL"));

$pdo = new PDO("pgsql:" . sprintf(
    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
    $db["host"],
    $db["port"],
    $db["user"],
    $db["pass"],
    ltrim($db["path"], "/")
));


$id = $_POST['id'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM myusers WHERE name = '$id'";
$result = $pdo->query($sql);
$row = $result->fetch();

if ($_SESSION['check_word'] == $_POST['check']) {
    $_SESSION['check_word'] = '';
    if ($id != null && $pwd != null && $id == $row[1] && $pwd == $row[2]) {
        $_SESSION['username'] = $id;
        echo "Logged in.";
        if ($id == 'admin')
            echo '<meta http-equiv=REFRESH CONTENT=1;url=initializepage.php>';
        else
            echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
    } else {
        echo "Wrong username or password.";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=loginpage.php>';
    }
} else {
    echo "Wrong Verification!";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=loginpage.php>';
}