<?php 
session_start();

if(isset($_SESSION["login"]))
    header("locatio: index.php");
}
?>