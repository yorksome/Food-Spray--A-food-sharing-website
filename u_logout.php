<?php
session_start();
//if has not logged
if(!isset($_SESSION['isguestlogin']))
{
 header("Location: u_log.php");
}
else if(isset($_SESSION['isguestlogin'])!="")
{
 header("Location: index.html");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['isguestlogin']);
 header("Location: u_log.php");
}
?>
