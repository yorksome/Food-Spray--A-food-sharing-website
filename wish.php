<?php
    session_start();
    //session_destroy();
    include_once 'connect.php';

    // $w_u_user ="alice@gmail.com";

    // // if has logged
    // if(isset($_SESSION['isguestlogin']))
    // {
    //  header("Location: u_myaccount.php");
    // }
    // if(isset($_POST['btn-login']))
    // {
    //   $u_id = mysqli_real_escape_string($dblink,$_POST['u_id']);
    //   $u_pwd = mysqli_real_escape_string($dblink,$_POST['u_pwd']);
    //   $res=mysqli_query($dblink,"select * from (SELECT u_id as'id', u_pwd as 'pwd' FROM user WHERE u_id='$u_id' union select a_id as 'id', a_pwd as 'pwd' from adm where a_id='$u_id')a");
    //   $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
    // }


    $sql_max = "SELECT MAX(w_id) AS max FROM wishlist";
    $res_max = mysqli_query($dblink,$sql_max);
    if(! $res_max){
      die('Could not get id' . mysqli_error($dblink));
    }
    $row_max=mysqli_fetch_array($res_max);
    $max = $row_max[0];
    $w_id = $max + 1;

    $w_u_user = $_SESSION['isguestlogin'];
    $w_content = $_POST['w_content'];
    $w_type = $_POST['w_type'];


    $sql_w = "INSERT INTO wishlist VALUES ($w_id,'$w_u_user','$w_content','$w_type')";
    $res_w = mysqli_query($dblink,$sql_w);
    if ($res_w) {
      echo ("Successfully. ");
      echo ("The system will notice you when the items that you are interest in are available.");
    }
    else {
      echo ("Fail.");
    }

?>
