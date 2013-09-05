<?php
include ('app/app.php');
if(isset($_COOKIE['login'])){
    setcookie('login','',time()-3600);
}

session_destroy();
//render('index.html', 'logout.html');
header("location: index.php");
?>
