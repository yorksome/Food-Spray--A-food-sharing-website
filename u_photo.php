<?php
session_start();
//if has logged
if(isset($_SESSION['isguestlogin'])!="")
{
 header("Location: u_myaccount1.php");
}
include_once 'connect.php';
?>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>Login & Registration System</title>
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

<form action="u_register.php" method="post">
	    <div class="form-group">
		<label for="picture">Step1: Choose a picture to be your avatar:</label>
		  <select class="form-control" name="picture" >
					<option value="P01.jpg">pic1</option>
					<option value="P02.jpg">pic2</option>
					<option value="P03.jpg">pic3</option>
					<option value="P04.jpg">pic4</option>
					<option value="P05.jpg">pic5</option>
					<option value="P06.jpg">pic6</option>
					<option value="P07.jpg">pic7</option>
					<option value="P08.jpg">pic8</option>
					<option value="P09.jpg">pic9</option>
					<option value="P10.jpg">pic10</option>
					<option value="P11.jpg">pic11</option>
					<option value="P12.jpg">pic12</option>
					<option value="P13.jpg">pic13</option>
					<option value="P14.jpg">pic14</option>
					<option value="P15.jpg">pic15</option>

			</select>
	</div>
	<div class="form-group">
			<input type="hidden" name="act" value="insert"/>
			<input class="btn btn-primary" type="submit" name="btn-next" id="button" value="Next"/>
	</div>
	<div class="form-group">
			<div class="table-responsive">
				<table class="table">
					<tr><td><img class="img-thumbnail"  src="images/P01.jpg" width="110" height="70"/>pic1</td>
					<td><img class="img-thumbnail" src="images/P02.jpg" width="110" height="70"/>pic2</td>
				   <td><img class="img-thumbnail" src="images/P03.jpg" width="110" height="70"/>pic3</td>
				   <td><img class="img-thumbnail" src="images/P04.jpg" width="110" height="70"/>pic4</td>
				   <td><img class="img-thumbnail" src="images/P05.jpg" width="110" height="70"/>pic5</td></tr>
				   <tr><td><img class="img-thumbnail" src="images/P06.jpg" width="110" height="70"/>pic6</td>
				   <td><img class="img-thumbnail" src="images/P07.jpg" width="110" height="70"/>pic7</td>
				   <td><img class="img-thumbnail" src="images/P08.jpg" width="110" height="70"/>pic8</td>
				   <td><img class="img-thumbnail" src="images/P09.jpg" width="110" height="70"/>pic9</td>
				   <td><img class="img-thumbnail" src="images/P10.jpg" width="110" height="70"/>pic10</td></tr>
				   <tr><td><img class="img-thumbnail" src="images/P11.jpg" width="110" height="70"/>pic11</td>
				   <td><img class="img-thumbnail" src="images/P12.jpg" width="110" height="70"/>pic12</td>
				   <td><img class="img-thumbnail" src="images/P13.jpg" width="110" height="70"/>pic13</td>
				   <td><img class="img-thumbnail" src="images/P14.jpg" width="110" height="70"/>pic14</td>
				   <td><img class="img-thumbnail" src="images/P15.jpg" width="110" height="70"/>pic15</td></tr>
				</table>
			 </div>
	</div>
       </form>
		</div>

</div>
	</content>
</body>
</html>
