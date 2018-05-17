<?php
    session_start();
    include("connect.php");
    $u_id = $_SESSION["isguestlogin"];


    // insert into orders table
    //generate an order id
    $sql_max = "SELECT MAX(o_id) AS max FROM orders";
    $res_max = mysqli_query($dblink,$sql_max);
    if(! $res_max){
      die('Could not get id' . mysqli_error($dblink));
    }
    $row_max=mysqli_fetch_array($res_max);
    $max = $row_max[0];
    $o_id = $max + 1;


    //get current time
    $sql_time = "SELECT now()";
    $res_time = mysqli_query($dblink,$sql_time);
    if(! $res_time){
      die('Could not get current time' . mysqli_error($dblink));
    }
    $row_time = mysqli_fetch_array($res_time);
    $o_time = $row_time[0];


    $o_u_recipient = $u_id;
    $o_i_item=$_POST['i_id'];
    $i_id=$_POST['i_id'];
    $o_item=$_POST['i_name'];
    $data='{o_i_item:"' . $o_i_item . '",o_item:"' . $o_item .'"}'; // JSON
    // echo json_encode($data); // JSON


    // insert into orders table
    // select its donator
    $sql_d = "SELECT i_donator FROM item WHERE i_id='$i_id'";
    $res_d = mysqli_query($dblink,$sql_d);
    if(! $res_d){
      die('Could not get donator information' . mysqli_error($dblink));
    }
    $row_d=mysqli_fetch_array($res_d);
    $o_donator = $row_d[0];


//ORDERS TABLE
    $sql_o = "INSERT INTO orders (o_id, o_time, o_u_recipient, o_i_item, o_item, o_donator)
    VALUES ($o_id,'$o_time','$o_u_recipient','$o_i_item','$o_item','$o_donator')";
    //echo $sql_o;
    //exit();
    $res_o = mysqli_query($dblink,$sql_o);


//ITEM TABLE
    $sql_status = "UPDATE item SET is_ordered=1 WHERE i_id='$i_id'";
    $res_status = mysqli_query($dblink,$sql_status);
    if($res_status){
      echo "success";
    }else{
      echo "fail";
    }

?>
