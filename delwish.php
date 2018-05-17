<?php
  session_start();
  //if has not logged
  if(isset($_SESSION['isguestlogin'])=="")
  {
     header("Location: u_log.php");
  }
  include('connect.php');
  $u_user = $_SESSION["isguestlogin"];
  $wid = $_GET["wid"];
  $sql = "delete from wishlist where w_id='$wid'";
  if(mysqli_query($dblink,$sql)){
  ?>
    <script>alert('successfully delete'); history.go(-1);</script>
  <?php
  }
  ?>
  
 