<?php 

$direction = $_SERVER['PHP_SELF'];
if(basename($_SERVER['PHP_SELF']) == "login.php" || basename($_SERVER['PHP_SELF']) == "register.php")
return;
    if(!isset($_SESSION["user"]))
        header("location: /BeyondWords/assets/user/login.php?dir=$direction"); 

?>