<?php
	session_start();
	//session_destroy();
	include_once 'connect.php';

	// if has logged
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

    // $u_id = "alice@gmail.com";

    // $dblink = mysqli_connect("127.0.0.1","root","4869","Food_Spray");
    // if (!$dblink){
    //     die('Could not connect: ' . mysqli_connect_error());
    // }


    // insert into item table
    //generate an item id
    $sql_max = "SELECT MAX(i_id) AS max FROM item";
	$res_max = mysqli_query($dblink,$sql_max);
	if(! $res_max){
		die('Could not get id' . mysqli_error($dblink));
	}
	$row_max=mysqli_fetch_array($res_max);
	$max = $row_max[0];
	$i_id = $max + 1;


	//get donator fullname
	// $u_id = $_SESSION['u_id'];
	$sql_name = "SELECT u_fullname FROM user WHERE u_id='{$u_id}'";
	$res_name = mysqli_query($dblink,$sql_name);
	if(! $res_name){
		die('Could not get fullname' . mysqli_error($dblink));
	}
	$row_name=mysqli_fetch_array($res_name);
	$i_donator = $row_name[0];


	//get current time
	$sql_time = "SELECT now()";
    $res_time = mysqli_query($dblink,$sql_time);
    if(! $res_time){
		die('Could not get current time' . mysqli_error($dblink));
	}
	$row_time = mysqli_fetch_array($res_time);
	$i_time = $row_time[0];


    //get picture
    //to get the type of the image
	$imgTemp = explode(".", $_FILES["img"]["name"]);
	//use a method to generate random number and add the type
	$newImgName = round(microtime(true)) . '.' . end($imgTemp);
	//upload the image to the path file with the new name


//TEST
	if (move_uploaded_file($_FILES['img']['tmp_name'], "./img/".$newImgName)) {
	    // echo "File is valid, and was successfully uploaded.\n";
	} else {
	    // echo "fail!\n";
	}


    //POST & GET
	$i_name = $_POST['i_name'];
	$i_type = $_POST['i_type'];
	$i_quantity = $_POST['i_quantity'];
	$i_unit = $_POST['i_unit'];
	$i_exp_date = $_POST['i_exp_date'];
	$i_location = $_POST['i_location'];
	$i_detail = $_POST['i_detail'];
	$i_im_name = $newImgName;
	$is_collected = $_POST['is_collected'];


	if($is_collected == 1)
	{
		$i_collect_date = $_POST['i_collect_date'];
		$sql_i_1 = "INSERT INTO item (i_id, i_u_donator, i_donator, i_time, i_name, i_type, i_quantity, i_unit, i_exp_date, i_location, i_im_name, i_detail, is_collected, i_collect_date) VALUES ($i_id,'$u_id','$i_donator','$i_time','$i_name','$i_type',$i_quantity,'$i_unit','$i_exp_date','$i_location','$newImgName','$i_detail',1,'$i_collect_date')";
		$res_i_1 = mysqli_query($dblink,$sql_i_1);

		if($res_i_1){
?>
            <script>alert('The item is submitted successfully. Please wait for checking.');</script>
<?php
            echo "<script>location.href='item_history.php'</script>";
        }else{
?>
            <script>alert('Fail');</script>
<?php
        }
	}

	else
	{
		$sql_i_0 = "INSERT INTO item (i_id, i_u_donator, i_donator, i_time, i_name, i_type, i_quantity, i_unit, i_exp_date, i_location, i_im_name, i_detail) VALUES ($i_id,'$u_id','$i_donator','$i_time','$i_name','$i_type',$i_quantity,'$i_unit','$i_exp_date','$i_location','$newImgName','$i_detail')";
		$res_i_0 = mysqli_query($dblink,$sql_i_0);

		if($res_i_0){
?>
            <script>alert('The item is submitted successfully. Please wait for checking.');</script>
<?php
            echo "<script>location.href='item_history.php'</script>";
        }else{
?>
            <script>alert('Fail');</script>
<?php
        }
	}

?>
