<?php
session_start();
//if has logged
if(isset($_SESSION['isguestlogin'])!="")
{
 header("Location: u_myaccount1.php");
}
include_once 'connect.php';

if(isset($_POST['btn-signup']))
{
	$pic =$_POST['picture'];
  $u_id = mysqli_real_escape_string($dblink,$_POST['u_id']);
  $u_fullname = mysqli_real_escape_string($dblink,ucwords($_POST['u_fullname']));
  $u_pwd = $_POST['u_pwd'];
  $pass=$_POST['pass'];
  date_default_timezone_set('WET');//England timezone
  $today = date('Y-m-d h:i:sa');//get time of the moment of query
  $u_gender = $_POST['u_gender'];
  $u_location = mysqli_real_escape_string($dblink,strtoupper($_POST['u_location']));//upper words
  if(isset($_POST['is_volunteer'])){
  $is_volunteer = $_POST['is_volunteer'];}
  else {
    $is_volunteer = 0;
  }
  $check_query = mysqli_query($dblink,"select u_id from user where u_id='$u_id' limit 1");

/**
input restriction
*/
if($check_query->num_rows<>0){
   ?>
   <script>alert('E-mail is existed');</script>
<?php
}
if(!preg_match('/^[a-zA-Z0-9.!#$%&{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/', $u_id)){
?>
  <script>alert('Email: incorrect format');</script>
<?php
}

if(!preg_match('/^[A-Za-z][\w\x80-\xff]{3,15}$/', $u_fullname)){
?>
  <script>alert('User name: 3 to 15 English characters');</script>
<?php
}

if(strlen($_POST['u_pwd'])<6){
?>
  <script>alert('Password can not less than 6 characters');</script>
<?php
}

if($u_pwd<>($pass)){
?>
  <script>alert('confirm password can not be different from password');
  </script>
<?php
}

if ((preg_match('/^[\w\x80-\xff]{3,15}$/', $u_fullname))&&(strlen($_POST['u_pwd']) >= 6)&&($u_pwd==($pass))&&($check_query->num_rows==0)&&
 mysqli_query($dblink,"INSERT INTO user(u_id, u_fullname, u_pwd, u_gender, u_location, is_volunteer,u_date,u_im_name) VALUES('$u_id','$u_fullname','$u_pwd','$u_gender','$u_location','$is_volunteer','$today','$pic')"))
  {
  ?>
      <script>alert('successfully registered');</script>
       echo "<script>location.href='u_log.php'</script>";
      <?php
  }
  else
  {
  ?>
      <script>alert('error while registering you...');</script>
      <?php
  }
}
?>

<html>
<head>
<meta http-equiv="content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
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
  <header>
		<div class="container" style="background:url('images/lemon2.jpg');background-repeat:repeat-x;">
			<div class="nav-brand">
				<a class="logo">Food Spray</a>
			</div>
			<nav id="nav" role="navigation">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="map.html">Map</a></li>
					<li><a href="about.html">About</a></li>
					<li><a href="u_log.php">Login</a></li>
          <li><a href="u_register.php"  class="active">Register</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<div class="container">
  <content>
    <div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">
        <div id="login-form">
        <form method="post" >
      			<div class="form-group">
				    Step2: Fill in the following form:
			    </div>
            	<div class="form-group">
				<label for="u_fullname">Full Name</label>
					<input type="text" name="u_fullname"  class="form-control" placeholder="Full Name" required />
                </div>

                 <div class="form-group">
					<label for="u_gender">Your Gender</label>
						  <select name="u_gender" class="form-control">
							<option value="--" selected="selected">-- Choose Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
				</div>

                 <div class="form-group">
					<label for="u_id">Your Email</label>
					 <input type="email" name="u_id"  class="form-control" placeholder="Your Email" required />
                 </div>

                 <div class="form-group">
					<label for="u_pwd">Your Password</label>
					 <input type="password" class="form-control" name="u_pwd" placeholder="Your Password" required />
                 </div>

                  <div class="form-group">
					  <label for="pass">Confirm Password</label>
					  <input type="password" class="form-control" name="pass" placeholder="Confirm Password" required />
                   </div>

                  <div class="form-group">
					  <label for="u_location">Location</label>
					  <input type="text" name="u_location" class="form-control" placeholder="Location" required />
                   </div>

			      <div class="form-group">
					  <div class="form-check">
						  <input type="checkbox" name="is_volunteer"  class="form-check-input"  value="1" ／>
						  <label class="form-check-label" for="is_volunteer">I'd&nbsp;like&nbsp;to&nbsp;be&nbsp;a&nbsp;<a href="about.html">volunteer</a></label>
					  </div>
			      </div>
                  <div class="form-group">
			            <button type="submit" class="btn btn-primary" name="btn-signup">Sign Me Up</button>
                  </div>
                   <div class="form-group">
					   <a href="u_log.php">Sign In Here</a>
                    </div>

            <div class="form-group">
                 <input type="hidden" name="picture" value="<?php echo $_POST['picture']; ?>"/>
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
