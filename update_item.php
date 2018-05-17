<!DOCTYPE html>
<html lang="en" dir="auto">
<?php

include('connect.php');
session_start();
if(isset($_SESSION['isguestlogin']))

{
$itemNO=$_POST['itemNo'];
   $q="SELECT * FROM item WHERE i_id='$itemNO' ";

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
<div class="container">
<content>
<div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">
<div class="table-responsive">
      <table  class="table"><tr><th>Item Name</th><th>Type</th> <th>Quantity</th><th>Expiration Date</th><th>Location</th><th>Photo</th><th>Details</th><th>Donor</th><th>Status</th></tr>

<?php



if ($result->num_rows > 0) { // Handle the results.

$counter=0;
while ($row = $result->fetch_assoc()){

?>
<form action="update_item_handle.php" method="post">
<tr>
<td>
<?php
echo "".$row["i_name"];
?>

</td>
<td>
<?php
echo "".$row["i_type"];
?>

</td>
<td>
<?php
echo "".$row["i_quantity"];
?>

</td>
<td><?php
echo "".$row["i_exp_date"];
?></td>
<td>
<?php
echo "".$row["i_location"];

$itemphoto=$row["i_im_name"];
?>

<?php

echo "<td><div class='ui small image'><img src='img/". $itemphoto."'></div></td>";
?>
<td>
<?php
echo "".$row["i_detail"];
?>
</td>
</td>
<td><?php
echo "".$row["i_donator"];
?></td>

<td>
 <div >
  <?php
  if($row["is_checked"])
  echo "CHECKED";

  else {
    echo "UNCHECKED";
  }
?>
    </div>
</td>



</tr>
<tr >
              <input type="hidden" name="itemNo" value="<?php echo $row['i_id'] ?>">

<td></td><td></td>
        <td colspan="4"><button type="submit" name="passButton" >Check</button></td>
        <td colspan="4"><button type="submit" name="rejectButton">Reject</button></td>

</tr>
</form>
<?php

}
?>
</table>
		</div>


   <?php

}


else
echo "no query".$q;
$dblink->close();
}


?>
<a href="index_admin.php">Back</a>
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
