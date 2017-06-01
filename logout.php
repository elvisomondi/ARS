<?php
    session_start();

    if(isset($_SESSION['user_id'])) {
        session_destroy();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['isAdmin']);
        unset($_SESSION['name']);
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }

    if(isset($_COOKIE['userName']) and isset($_COOKIE['pwd'])){
    	$myuserName = $_COOKIE['userName'];
    	$mypwd = $_COOKIE['pwd'];
        setcookie('userName',$myuserName,time()-1);
        setcookie('pwd',$mypwd,time()-1);  
    }


?>
