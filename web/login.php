<?php

$id=$_POST['id'];
$pwd=$_POST['pwd'];
if($id=="user"&&$pwd=="123"){
    echo "Logged in.";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=hi.php>';
}else{
    echo "Failed.";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';

}

?>