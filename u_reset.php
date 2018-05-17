<?php
session_start();
include_once 'connect.php';
//if has logged
if(isset($_SESSION['isguestlogin'])!="")
{
 header("Location: u_myaccount1.php");
}
if(isset($_POST['btn-submit']))
{
  $u_id = mysqli_real_escape_string($dblink,$_POST['u_id']);

  //only registered email can find password back

 if(!preg_match('/^[a-zA-Z0-9.!#$%&{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/', $u_id)){
  ?>
    <script>alert('Email: incorrect format');</script>
  <?php
  }
  else {
    $res=mysqli_query($dblink,"select u_id from user where u_id='$u_id'");
    $row=$res->fetch_assoc();
  if(!$row['u_id'])
  {
 	?>
     <script>alert('the email has not registed');</script>
     <?php
  }else
    {
      //generate a random new password
 	     function getRandomString($len, $chars=null)
    {
       if (is_null($chars)) {
       $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
       }
       mt_srand(10000000*(double)microtime());
       for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++)
       {
             $str .= $chars[mt_rand(0, $lc)];
       }
        return $str;
    }
    //p_id in table pwd plus 1 automaticly when insert
    $id = mysqli_query($dblink,"select max(p_id) as 'id' from pwd");
    $rows=$id->fetch_assoc();
    $rowid=$rows['id'];
   	date_default_timezone_set('WET');
    $today = date('Y-m-d h:i:sa');
    $pwd=getRandomString(10);
    $insertpwd="insert into pwd(p_id, p_u_mail, p_date,p_state,p_pwd) values('$rowid'+1,'$u_id','$today', 'pending', '$pwd')";
 	  mysqli_query($dblink,$insertpwd);
    //update password of corresponding user in the user table
    $updateuser="update user set u_pwd='$pwd' where u_id='$u_id'";
 	  mysqli_query($dblink,$updateuser);
 	?>
    <script>alert('We will send you an email in 10 minites');</script>
<?php
    }
}
}
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Find Password Back</title>
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
	<h3>Forgotten Password?<h3>
	<h5>No problem. Just let us know the email address you use with Food Spray and we will send you a new password.</h5>
	<br/>	
<form method="post">
	
        <div class="form-group">
            <label for="u_id">Email address</label><input type="text" class="form-control" name="u_id" placeholder="Email address" required />
    </div>

    <div class="form-group">
		<button type="submit" class="btn btn-primary" name="btn-submit">SEND ME EMAIL</button>
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