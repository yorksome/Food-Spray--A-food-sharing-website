


<!DOCTYPE html>
<html lang="en" dir="auto">
<?php

include('connect.php');

   $q="SELECT * FROM user ";

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
  <div class="navbar-brand">
    <a class="logo">Administrator Interface</a>
  </div>
  <nav id="nav" role="navigation">
    <ul>
      <li><a href="index_admin.php">Check Items</a></li>
      <li><a href="registered_users.php" class="active">Registered Users</a></li>
      <li><a href="index.html">Home</a></li>

    </ul>
  </nav>
</div>
        <title>Welcome Admin</title>

</header>

<div class="container">
<content>    
<div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">

	<div class="table-responsive">

      <table  class="table"><tr><th>User Name</th><th>Date of Register </th><th>Address</th><th>Credite Score</th><th>Volunteer Status</th></tr>

<?php



if ($result->num_rows > 0) { // Handle the results.

$counter=0;
while ($row = $result->fetch_assoc()){


?>
<form action="update_item.php" method="post">
<tr>
<td>
<?php
echo "".$row["u_fullname"];
?>

</td>

<td><?php
echo "".$row["u_date"];
?></td>
<td>
<?php
echo "".$row["u_location"];
?>

</td>
<td>
<?php
echo "".$row["u_credit"];
?>

</td>
<td>
 <div id="statusDisplay">
  <?php
if($row["is_volunteer"])
echo "A Volunteer";

else {
  echo "Not A Volunteer";
}
?>
    </div>
</td>


<td>
  <?php

$counter++;
?>

</td>
              <input type="hidden" name="itemNo" value="<?php echo $row['i_id'] ?>">
              <input type="hidden" id="<?php echo "itemNo".$counter; ?>" value="<?php echo $row['i_id'] ?>">







</tr>
</form>
<?php

}
?>
</table>



   <?php

}


else
echo "no query".$q;
$dblink->close();



?>




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
