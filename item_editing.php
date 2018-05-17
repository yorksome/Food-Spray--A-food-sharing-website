<?php
    session_start();
    //session_destroy();
    include_once 'connect.php';
    // if has logged
  //  if(isset($_SESSION['isguestlogin']))
    //{
     //header("Location: u_myaccount.php");
  //  }
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

//0
    $i_id = $_GET['i_id'];
//1
    $sql_name = "SELECT i_name FROM item WHERE i_id='{$i_id}'";
    $res_name = mysqli_query($dblink,$sql_name);
    $row_name = mysqli_fetch_array($res_name);
    $i_name_value = $row_name[0];
//2
    $sql_type = "SELECT i_type FROM item WHERE i_id='{$i_id}'";
    $res_type = mysqli_query($dblink,$sql_type);
    $row_type = mysqli_fetch_array($res_type);
    $i_type_value = $row_type[0];
//3
    $sql_quantity = "SELECT i_quantity FROM item WHERE i_id='{$i_id}'";
    $res_quantity = mysqli_query($dblink,$sql_quantity);
    $row_quantity = mysqli_fetch_array($res_quantity);
    $i_quantity_value = $row_quantity[0];
//4
    $sql_unit = "SELECT i_unit FROM item WHERE i_id='{$i_id}'";
    $res_unit = mysqli_query($dblink,$sql_unit);
    $row_unit = mysqli_fetch_array($res_unit);
    $i_unit_value = $row_unit[0];
//5 exp
    $sql_exp = "SELECT i_exp_date FROM item WHERE i_id='{$i_id}'";
    $res_exp = mysqli_query($dblink,$sql_exp);
    $row_exp = mysqli_fetch_array($res_exp);
    $i_exp_value = $row_exp[0];
//6 loc
    $sql_location = "SELECT i_location FROM item WHERE i_id='{$i_id}'";
    $res_location = mysqli_query($dblink,$sql_location);
    $row_location = mysqli_fetch_array($res_location);
    $i_location_value = $row_location[0];
//7 picture
    $sql_img = "SELECT i_im_name FROM item WHERE i_id='{$i_id}'";
    $res_img = mysqli_query($dblink,$sql_img);
    $row_img = mysqli_fetch_array($res_img);
    $i_img_value = $row_img[0];
//8 des
    $sql_des = "SELECT i_detail FROM item WHERE i_id='{$i_id}'";
    $res_des = mysqli_query($dblink,$sql_des);
    $row_des = mysqli_fetch_array($res_des);
    $i_des_value = $row_des[0];
//10 is_
    $sql_is = "SELECT is_collected FROM item WHERE i_id='{$i_id}'";
    $res_is = mysqli_query($dblink,$sql_is);
    $row_is = mysqli_fetch_array($res_is);
    $i_is_value = $row_is[0];
//11 col
    $sql_col = "SELECT i_collect_date FROM item WHERE i_id='{$i_id}'";
    $res_col = mysqli_query($dblink,$sql_col);
    $row_col = mysqli_fetch_array($res_col);
    $i_col_value = $row_col[0];


if(isset($_POST['btn_update']))
{

    $i_exp_date_new = $_POST['i_exp_date_new'];
    $i_location_new = $_POST['i_location_new'];
    $i_detail_new = $_POST['i_detail_new'];
    $is_collected_new = $_POST['is_collected_new'];
    $i_collect_date_new = $_POST['i_collect_date_new'];


    if($is_collected_new == 1)
    {
        $i_collect_date_new = $_POST['i_collect_date_new'];
        $sql_new_1 = "UPDATE item SET i_exp_date='$i_exp_date_new',i_location='$i_location_new',i_detail='$i_detail_new',is_collected=1,i_collect_date='$i_collect_date_new' WHERE i_id='$i_id'";
        $res_new_1 = mysqli_query($dblink,$sql_new_1);
        if($res_new_1){
?>
            <script>alert('The information is updated successfully.');</script>
<?php
            echo "<script>location.href='item_history.php'</script>";
        }else{
?>
            <script>alert('Fail);</script>
<?php
        }
    }

    else
    {
        $sql_new_0 = "UPDATE item SET i_exp_date='$i_exp_date_new',i_location='$i_location_new',i_detail='$i_detail_new',is_collected=0,i_collect_date=null WHERE i_id='$i_id'";
        $res_new_0 = mysqli_query($dblink,$sql_new_0);
        if($res_new_0){
?>
            <script>alert('The information is updated successfully.');</script>
<?php
            echo "<script>location.href='item_history.php'</script>";
        }else{
?>
            <script>alert('Fail');</script>
<?php
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add_an_item</title>
	<meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" href="css/jquery-ui.css">
      <script src="js/jquery.js"></script>
      <script src="bootstrap/js/bootstrap.js"></script>
      <script src="js/popper.js"></script>
      <script src="js/jquery.dataTables.js"></script>	
      <script src="js/jquery-ui.js"></script>


    <style>
        .centre
        {
            MARGIN-RIGHT: auto;
            MARGIN-LEFT: auto;
            margin-top: 100PX;
            width:400px;
            vertical-align:middle;
        }
    </style>


    <script>
        $( function() {
            $( "#i_exp_date_new" ).datepicker({dateFormat: "yy-mm-dd"});
        } );

        $( function() {
            $( "#i_collect_date_new" ).datepicker({dateFormat: "yy-mm-dd"});
        } );

        $(function() {
            $('#is_collected_new').click(function() {
                this.value = (this.value == 0) ? 1 : 0;
                var obj = $("#i_collect_date_new").get(0);
                obj.disabled = !$("#is_collected_new")[0].checked;
            });
        });
    </script>
</head>

<body>
	    <div class="container">
         <div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">
			 
               <h2>Add Item Form</h2>		
        <form class="centre" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <label for="i_name">Picture:</label>
                    <img class="image" src="img/<?php echo $i_img_value ?>" alt="IMAGE" width="60" height="60">
                </div>
                <div class="form-group">
                  <label>Item Name:</label><?php echo $i_name_value ?>
                </div>
                <div class="form-group">
					<label>Item Type:</label><?php echo $i_type_value ?>
                </div>
                <div class="form-group">
                    <label>Quantity:</label><?php echo $i_quantity_value,$i_unit_value ?>
                </div>
                <div class="form-group">
                    <label>Expired Date</label>
                    <input class="form-control" type="text" name="i_exp_date_new" id="i_exp_date_new" placeholder="<?php echo $i_exp_value ?>" required>
                </div>
                <div class="form-group">
					 <label>Location:</label>
                     <input class="form-control" type="text" name="i_location_new" id="i_location_new" placeholder="<?php echo $i_location_value ?>" required>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea class="form-control"  name="i_detail_new" rows="3" cols="30" id="i_detail_new" placeholder="<?php echo $i_des_value ?>"></textarea>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input  class="form-check-input" type="checkbox" name="is_collected_new" value="0" id="is_collected_new">
                        <label>I allow this item being colleted by volunteers.</label>
                    </div>
			    </div>	
                <div class="form-group">
                    <label>Collection Date:</label>
                    <input class="form-control"  type="text" name="i_collect_date_new" id="i_collect_date_new" disabled="disabled" placeholder=""/>
                </div>
               <div class="form-group">
                    <button type="submit" name="btn_update">Update</button>
                </div>
        </form>
    </div>
	</div>

</body>
</html>
