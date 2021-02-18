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

$imageID = $_SESSION['imageID'];
$sql = "SELECT * FROM images WHERE id = '$imageID'";
$result = $pdo->query($sql);
$row = $result->fetch();
$origin = $row['image'];
$src = $origin;
if (isset($_POST['grey'])) {
    $src = grayscale($src);
    $_SESSION['filter'] = 'grey';
}
if (isset($_POST['border'])) {
    $src = border($src);
    $_SESSION['filter'] = 'border';
}
if (isset($_POST['orign'])) {
    unset($_SESSION['filter']);
}
if (isset($_POST['upload'])) {
    if (isset($_SESSION['filter'])) {
        if ($_SESSION['filter'] == 'grey')
            $src = grayscale($src);
        if ($_SESSION['filter'] == 'border')
            $src = border($src);
    }
    unset($_SESSION['filter']);
    upload($src);
}
if (isset($_POST['cancel'])) {
    $sql = "DELETE FROM images WHERE id = '$imageID'";
    $sql = "SELECT * FROM images WHERE id = '$imageID'";
    $result = $pdo->query($sql);
    echo '<meta http-equiv=REFRESH CONTENT=0.2;url=index.php>';
}



echo "<image src='data:image/png;base64,$src'>";

function grayscale($src)
{
    $img = new Imagick();
    $img->readImageBlob(base64_decode($src));
    $img->transformImageColorspace(Imagick::COLORSPACE_GRAY);
    $tmp = $img->getImageBlob();
    $img->clear();
    $src = base64_encode($tmp);
    return $src;
}

function border($src)
{
    $img = new Imagick();
    $img->readImageBlob(base64_decode($src));
    $img->borderImage('black', 20, 20);
    $tmp = $img->getImageBlob();
    $img->clear();
    $src = base64_encode($tmp);
    return $src;
}

function upload($src)
{
    $db = parse_url(getenv("DATABASE_URL"));

    $pdo = new PDO("pgsql:" . sprintf(
        "host=%s;port=%s;user=%s;password=%s;dbname=%s",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
    ));

    $imageID = $_SESSION['imageID'];
    $sql = "UPDATE images SET image='$src' WHERE id = '$imageID'";
    unset($_SESSION['imageID']);
    $result = $pdo->query($sql);
    if ($result) {
        echo "File uploaded.";
        echo '<meta http-equiv=REFRESH CONTENT=0.2;url=index.php>';
    } else {
        echo "Failed";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
    }
}

?>
<form method="post">
    <input type="submit" name="grey" value="greyscale">
    <input type="submit" name="origin" value="Discard filter">
    <input type="submit" name="border" value="Add Border"><br><br>
    <input type="submit" name="upload" value="Upload">
    <input type="submit" name="cancel" value="Cancel">
</form>