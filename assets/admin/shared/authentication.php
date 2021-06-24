<?php 

$direction = $_SERVER['PHP_SELF'];
if(basename($_SERVER['PHP_SELF']) == "login.php")
return;
    if(!isset($_SESSION["admin"]))
        header("location: /BeyondWords/assets/admin/login.php?dir=$direction"); 

?>