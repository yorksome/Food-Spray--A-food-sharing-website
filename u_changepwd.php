<?php
session_start();
include_once 'connect.php';

if(isset($_POST['btn-submit']))
{
  $u_id = $_SESSION["isguestlogin"];
  $sql = "select * from user where u_id='$u_id'";
  $arr = mysqli_query($dblink,$sql);
  $rows = $arr->fetch_assoc();
  $pwd = mysqli_real_escape_string($dblink,$_POST['pwd']);
  $npwd = mysqli_real_escape_string($dblink,$_POST['npwd']);
  $rpwd = mysqli_real_escape_string($dblink,$_POST['rpwd']);
  if($rows['u_pwd']!=$pwd)
  {
 	?>
     <script>alert('Current password is wrong');</script>
  <?php
 }
    else if(!preg_match('/^[a-zA-Z0-9!#$%&{|}~-]*$/', $npwd)){
?>
  <script>alert('the password cannot contain non English Characters');</script>
<?php
}

  else if ($npwd!=$rpwd)
  {
  ?>
    <script>alert('Re-enter Password can not be different from new password');</script>
  <?php
  }
  // password length cannot less then 6 characters
  else if(strlen($npwd)<6){
  ?>
    <script>alert('Password can not less than 6 characters');</script>
<?php
  }

else
{
    mysqli_query($dblink,"update user set u_pwd='$npwd' where u_id='$u_id'");
    ?>
    <script>alert('successfully changed');</script>
  <?php
}
}
?>

<html>
<head>
<title>change password</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  <content>
    <div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">
<div class="container">
	<h2>Change Password<h2>
	<br/>
	<form method="post">
    <div class="form-group">
		<label for="pwd">Current password</label><input type="password"   class="form-control" name="pwd" placeholder="Current password" required />
    </div>

    <div class="form-group">
		<label for="npwd">New password</label><input type="password"   class="form-control" name="npwd" placeholder="New password" required />
    </div>

    <div class="form-group">
		<label for="rpwd">Re-enter new password</label><input type="password" class="form-control" name="rpwd" placeholder="Re-enter new password" required />
    </div>

    <div class="form-group">
		<button type="submit" class="btn btn-primary" name="btn-submit">Save changes</button>
    </div>

     <div class="form-group">
       <a href="u_register.php">Return to login</a>
    </div>
</form>
		</div>

</div>
	</content>
</body>
</html>
