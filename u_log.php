<?php
session_start();
include_once 'connect.php';
/* if has logged */
if(isset($_SESSION['isguestlogin'])!="")
{
 header("Location: u_myaccount1.php");
}
if(isset($_POST['btn-login']))
{

  $u_id = mysqli_real_escape_string($dblink,$_POST['u_id']);
  $u_pwd = mysqli_real_escape_string($dblink,$_POST['u_pwd']);

  /* both user and administrator can log from the page */
  $res=mysqli_query($dblink,"SELECT u_id as'id', u_pwd as 'pwd' FROM user WHERE u_id='$u_id'");
  $row=mysqli_fetch_array($res);

  $res_a = mysqli_query($dblink,"SELECT a_id as 'id', a_pwd as 'pwd' FROM adm WHERE a_id='$u_id'");
  $row_a = mysqli_fetch_array($res_a);

  if($u_id==$row['id']&&$u_pwd==$row['pwd'])
  {
    $_SESSION['isguestlogin'] = $row['id'];
    $_SESSION['guestpwd'] = $row['pwd'];
    header("Location: u_myaccount1.php");
  }
  else if($u_id==$row_a['id']&&$u_pwd==$row_a['pwd']){
      
      $_SESSION['isguestlogin'] = $row_a['id'];
    $_SESSION['guestpwd'] = $row_a['pwd'];
           header("Location: index_admin.php");
        }
       else
        {
        ?>
          <script>alert('Wrong username or password.');</script>
          <?php
        }
     }
   ?>

<html>
<head>
<meta http-equiv="replacetent-Type" replacetent="text/html; charset=utf-8" />
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
					<li><a href="u_log.php"  class="active">Login</a></li>
          <li><a href="u_photo.php">Register</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<div class="container">
  <content>
    <div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">
          <div id="login-form">
          <form method="post">
			<div class="form-group">
				<label for="u_id">Your Email</label>
					<input type="text"  class="form-control" name="u_id" placeholder="Your Email" required />
              </div>
			<div class="form-group">
				<label for="u_pwd">Your Password</label>
                    <input type="password" class="form-control" name="u_pwd" placeholder="Your Password" required />
              </div>
              <div class="form-group">
                     <button type="submit" class="btn btn-primary" name="btn-login">Sign In</button>
			  </div>
                <div class="form-group">
                <a href="u_reset.php">Forgotten your password?</a>
			  </div>
			  <div class="form-group">
              <a href="u_photo.php">Need an account? Sign up!</a>
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
