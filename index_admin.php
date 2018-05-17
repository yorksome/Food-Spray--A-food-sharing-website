


<!DOCTYPE html>
<html lang="en" dir="auto">
<?php

include('connect.php');
session_start();
if(isset($_SESSION['isguestlogin']))


{
   $q="SELECT * FROM item WHERE is_checked=0";

$result=mysqli_query($dblink,$q);

    ?>
    <head>
    <title>Food Spray Durham</title>
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
	<script src="js/imags.js"></script>
    </head>
<body>
    <header>

<div class="container" style="background:url('images/lemon2.jpg');background-repeat:repeat-x;">
  <div class="nav-brand">
    <a class="logo">Administrator Interface</a>
  </div>
  <nav id="nav" role="navigation">
    <ul>
      <li><a href="index_admin.php" class="active">Check Items</a></li>
      <li><a href="registered_users.php">Registered Users</a></li>
      <li><a href="u_logout.php?logout">Sign Out</a>

    </ul>
  </nav>
</div>
        <title>Welcome Admin</title>



</header>


<content>
<div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">

	<div class="table-responsive">

<?php



if ($result->num_rows > 0) { // to ensure there are results before applying the query
?>
  <table class="table"><tr><th>Item Name</th><th>Expiration Date</th><th>Status</th></tr>
<?php
while ($row = $result->fetch_assoc()){


?>
<form action="update_item.php" method="post">
<tr>
<td>
<?php
echo "".$row["i_name"];
?>

</td>

<td><?php
echo "".$row["i_exp_date"];
?></td>
<td>

  <?php
if(!$row["is_checked"])
{
  echo "Un-checked";
}
?>

</td>


<td>


</td>
              <input type="hidden" name="itemNo" value="<?php echo $row['i_id'] ?>">






<td><button type="submit" name="checkButton" value="check">View Details</button></td>

</tr>
</form>
<?php

}
echo "<tr>";
echo "<td colspan='10'> No Match </td>";
echo "</tr>";
?>
</table>
	</div>
</div>


   <?php

}


else
echo "no new items";

$dblink->close();

}



?>

	</content>
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
