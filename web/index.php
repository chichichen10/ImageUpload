<?php session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 'On'); 
?>
<h1>This is Index</h1>
<?php
$logedin = false;
if ($_SESSION['username'] != null) {
    $username = $_SESSION['username'];
    $logedin = true;
    echo "<h3>Welcome <i> {$username} </i>!</h3>";
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
$sql = "SELECT * FROM images ORDER BY timestamp DESC";

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
$counter = 0;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
echo "<br><br>";
if (!$logedin) {
    foreach ($rows as $row) {
        if (!$row['private']) {
            if ($counter >= 8 * ($page - 1) && $counter < 8 * $page) {
                $data = 'data:' . $row['type'] . ';base64,' . $row['image'];
                echo "<a href='view.php?imageid=" . $row['id'] . "'>";
                echo "<img src=$data width='50' height='50'></a>";
            }
            $counter++;
        }
    }
} else {
    foreach ($rows as $row) {
        if (!$row['private']) {
            if ($counter >= 8 * ($page - 1) && $counter < 8 * $page) {
                $data = 'data:' . $row['type'] . ';base64,' . $row['image'];
                echo "<a href='view.php?imageid=" . $row['id'] . "'>";
                echo "<img src=$data width='50' height='50'></a>";
            }
            $counter++;
        } elseif ($row['username'] == $_SESSION['username']) {
            if ($counter >= 8 * ($page - 1) && $counter < 8 * $page) {
                $data = 'data:' . $row['type'] . ';base64,' . $row['image'];
                echo "<a href='view.php?imageid=" . $row['id'] . "'>";
                echo "<img src=$data width='50' height='50'></a>";
            }
            $counter++;
        }
    }
}

$numofdata = $counter;
$numofpage = (int)($numofdata / 8);
$numofpage += $numofdata % 8 == 0 ? 0 : 1;

echo "<br>";
if ($page > 1) {
    $prev = $page - 1;
    echo "<a href=index.php?page=$prev>prev</a>";
}
echo " Page $page of $numofpage ";
if ($numofdata > $page * 8) {
    $next = $page + 1;
    echo "<a href=index.php?page=$next>next</a>";
}