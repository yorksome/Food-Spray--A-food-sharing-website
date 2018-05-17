<?php
	session_start();
	//session_destroy();
	include_once 'connect.php';
	// if has logged
	if(isset($_SESSION['isguestlogin']))
	{
	 header("Location: u_myaccount.php");
	}
	if(isset($_POST['btn-login']))
	{
	  $u_id = mysqli_real_escape_string($dblink,$_POST['u_id']);
	  $u_pwd = mysqli_real_escape_string($dblink,$_POST['u_pwd']);
	  $res=mysqli_query($dblink,"select * from (SELECT u_id as'id', u_pwd as 'pwd' FROM user WHERE u_id='$u_id' union select a_id as 'id', a_pwd as 'pwd' from adm where a_id='$u_id')a");
	  $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
	}

	// session_start(); 
	// $u_id = "alice@gmail.com"; 
	// $con = mysqli_connect("127.0.0.1","root","4869","Food_Spray");
	// if (!$con){
	//     die('Could not connect: ' . mysqli_connect_error());
	// }

	$i_id = $_GET['i_id'];
	$sql_d = "DELETE FROM item WHERE i_id=$i_id";
	$res_d = mysqli_query($dblink,$sql_d);

	if($res_d){
?>
            <script>alert('The item is deleted successfully.');</script>
<?php
            echo "<script>location.href='item_history.php'</script>";  
    }else{
?>
        	<script>alert('Fail');</script>
<?php
    }

?>