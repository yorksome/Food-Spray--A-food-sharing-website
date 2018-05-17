<?php
include('connect.php');
session_start();

$donation=$_POST['itemid'];
$donator=$_POST['itemDoner'];
$sender=$_SESSION["isguestlogin"];
$msg=$_POST['messege'];

$date = date('Y-m-d H:i:s');
//sql query to insert a new record to messege table with ender and receiver information
$qMsg=" INSERT INTO msg (`m_time`,`m_i_item`,`m_u_sender`,`m_u_receiver`,`m_content`)
VALUES ('$date','$donation','$sender','$donator','$msg')";
$resultMsg=mysqli_query($dblink,$qMsg);

if ($resultMsg) {
  //echo "Message Sent!";
  $msg = "Message Sent!";
  echo ("<script>");
  echo("alert('{$msg}');");
  echo("location.href='index.html';");
  echo("</script>");
  //  header("location: index.html");
} else {
    //echo "Error: " . $q . "<br>" . $dblink->error;
    echo $dblink->error;
}

$dblink->close();


?>
