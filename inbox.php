


<!DOCTYPE html>
<html lang="en" dir="auto">
<?php

include('connect.php');
session_start();
$user_id=$_SESSION["isguestlogin"];
//query to get all the records in message table for the logged in user
   $q="SELECT * FROM msg WHERE m_u_receiver='$user_id' ";

$result=mysqli_query($dblink,$q);

    ?>
    <head>
    <title>Food Spray Durham</title>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" href="css/jquery-ui.css">
      <script src="js/jquery.js"></script>
      <script src="bootstrap/js/bootstrap.js"></script>
      <script src="js/popper.js"></script>
      <script src="js/jquery.dataTables.js"></script>	
      <script src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/imags.js"></script>
    </head>

    
    

    <body>
		<div class="container">
		<content>
<div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">
<div class="table-responsive">
      <table class='table'><tr><th>Sender Name</th><th>Send Date</th><th>Content</th></tr>

<?php



if ($result->num_rows > 0) { // Handle the results.

$counter=0;
while ($row = $result->fetch_assoc()){


?>

<tr>
<td>
<?php
echo "".$row["m_u_sender"];
?>

</td>

<td><?php
echo "".$row["m_time"];
?></td>
<td>

  <?php
echo "".$row["m_content"];
}

?>

</td>


<td>

</td>



<td></td>

</tr>

<?php

}
else{
//echo "no query".$q;}
}
?>
</table>
	</div>

   <?php



$dblink->close();



?>
			</div>
			<a href="u_myaccount1.php">Back</a>
		</content>
		</div>	
    </body>

</html>
