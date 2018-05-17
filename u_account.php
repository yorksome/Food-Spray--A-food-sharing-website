<?php
session_start();
//if has not logged
if(isset($_SESSION['isguestlogin'])=="")
{
  header("Location: u_log.php");
}
  include('connect.php');
  $u_id = $_SESSION["isguestlogin"];
  //get account information from database
  $sql = "select * from user where u_id='$u_id'";
  $arr = mysqli_query($dblink,$sql);
  $rows = $arr->fetch_assoc();

//update new information to database
if(isset($_POST['btn-update']))
{
$upuser='';
  $uname = mysqli_real_escape_string($dblink,ucwords($_POST['uname']));
  $gender = mysqli_real_escape_string($dblink,$_POST['gender']);
  $email = $_SESSION["isguestlogin"];
  $location = mysqli_real_escape_string($dblink,strtoupper($_POST['location']));
  if(isset($_POST['volunteer'])){
    $volunteer = $_POST['volunteer'];}
    else {
      $volunteer = 0;
    }



  if(!preg_match('/^[A-Za-z0-9- +]{3,15}+$/', $uname)){
  ?>
    <script>alert('User name: 3 to 15 English characters');</script>
  <?php
  }
  else if(!preg_match('/^[ +A-Za-z0-9\s+]+$/', $location)){
  ?>
    <script>alert('Location: Use only English characters and numbers');</script>
  <?php
  }
  else
  {
  $upuser = "update user set u_fullname='$uname', u_gender='$gender',u_location='$location', is_volunteer='$volunteer' where u_id='$email'";

  if(mysqli_query($dblink,$upuser))
  {
 ?>
      <script>alert('successfully updated');</script>
      <?php
      echo "<script>location.href='u_account.php'</script>";
    }
  }

  {
  ?>
      <script>alert('error while updating...');</script>
      <?php
   }
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>acount</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/popper.js"></script>
<script src="js/jquery.dataTables.js"></script>	
</head>

<body>
<div class="container">
	  <content>
    <div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">
<div id="login-form">
<form method="post">
    <div class="form-group">
        <img src = "<?php echo $rows['u_im_name'] ?>" width="20%" height="20%" />
	</div>

        <div class="form-group">
            <label for="uname">User Name</label>
            <input type="text" name="uname" class="form-control" value="<?php echo $rows['u_fullname'] ?>" />
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
			  <select name="gender" class="form-control">
				<option value="Male" <?php if ("Male" == $rows['u_gender']) echo "selected='selected'";?> >Male</option>
				<option value="Female" <?php if ("Female" == $rows['u_gender'])  echo "selected='selected'";?>>Female</option>
			  </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control"  value="<?php echo $rows['u_id'] ?>" disabled="true"/>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" class="form-control" value="<?php echo $rows['u_location'] ?>"/>
        </div>

	    <div class="form-group">
		   <div class="form-check">
			   <input type="checkbox" name="volunteer" id="volunteer" VALUE ="1" <?php if ($rows['is_volunteer']=="1") echo 'checked="Y"';?>／>
			   <label class="form-check-label" for="volunteer">I'd&nbsp;like&nbsp;to&nbsp;be&nbsp;a&nbsp;volunteer</label>		   
           </div>
        </div>
        <div class="form-group">
              <button type="submit" class="btn btn-primary" name="btn-update">Update</button>
	    </div>	
        <div class="form-group">
			 <a href="u_myaccount1.php">Back</a>
        </div>

		<div class="form-group">
			<a href="u_changepwd.php">change password</a>    
		</div>
</form>
</div>
		  </div>
	</content>
</div>
  <footer>
    <hr/>
    <div class="copyright">
		<i>
			Address:The Palatine Centre Durham University Stockton Road Durham DH1 3LE UK 
			Phone:0191 334 2222
		</i>	
		<br/>
		<i>
		@copyright - Durham Food Spary Team1
		</i>
	  </div>
  </footer>
</body>
</html>
