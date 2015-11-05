<?php
session_start();
if(isset($_SESSION)){
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    setcookie("screen_name", "",time() - 1800);
    session_destroy();
    header("Location: index.php");
}else{
    header("Location: index.php");
}
