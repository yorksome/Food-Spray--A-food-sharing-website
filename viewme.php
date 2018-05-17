<!DOCTYPE html>
<html>
<head>
<title>searchform</title>
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
  <table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th>Photo</th>
      <th>Food Description</th>

  </tr></thead>
  <tbody>
<?php
include('connect.php');

$itemid=$_GET['itemid'];


   $q="SELECT * FROM item WHERE i_id='$itemid'";

$result=mysqli_query($dblink,$q);
$row = $result->fetch_assoc();
$itemimname1=$row["i_name"];
$itemdetail1=$row["i_detail"];
$itemphoto=$row["i_im_name"];


   echo "<tr>";
  echo "<td><div class='ui small image'><img src='img/".     $itemphoto."'></div></td>";
  echo "<td>". $itemdetail1. "</td>";
  echo "<tr>";
//}
?>
</tbody>
</table>
	</div>
		</content>
	</div>
</body>

</html>
