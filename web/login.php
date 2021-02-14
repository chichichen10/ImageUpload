<?php
if(!isset($_SESSION)){
    session_start();
    }

$id=$_POST['id'];
$pwd=$_POST['pwd'];
if($_SESSION['check_word']==$_POST['check']){
    $_SESSION['check_word'] = ''; 
    if($id=="user"&&$pwd=="123"){
        echo "Logged in.";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=hi.php>';
    }else{
        echo "Wrong username or password.";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';

    }
}else{
    echo "Wrong Verification!";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}

?>