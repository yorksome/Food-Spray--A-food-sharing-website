<html>
<head>
<title>Order History</title>
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
  <script src="js/update.js"></script>	
</head>
<body>
  <div class="container">	
  <content>
    <div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">	
  <div id="orderHistory_container">
	  <table class="table table-striped table-bordered" style="width:100%">
		  <tr>
			 <th>Order_ID</th>
			 <th>Time</th>
			 <th>Donator</th>
			 <th>Item</th>
       <th></th>
       <th></th>
		 </tr>
       <?php
        include("connect.php");
        session_start();
        $user = $_SESSION['isguestlogin'];
        if(isset($user)){
            //$user = 'alice@gmail.com';
            $sql = "SELECT * FROM orders WHERE (o_u_recipient = '$user')";
       		  $result = mysqli_query($dblink,$sql);

            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
             echo"<tr>";
             echo"<td>".$row["o_id"]."</td>";
             echo"<td>".$row['o_time']."</td>";
             echo"<td>".$row['o_donator']."</td>";
             echo"<td>".$row['o_item']."</td>";
             $is_confirmed = $row['is_confirmed'];
             $is_rated = $row['is_rated'];

             if($is_confirmed==0)
             {
               echo "<td>";
               echo '<a href="order_confirm.php?id='.$row['o_id'].'">Confirm</a>';
               echo "</td>";
               echo "<td>";
               echo '<a href="order_cancel.php?id='.$row['o_id'].'">Cancel</a>';
               echo "</td>";
             }
             else
             {
               if($is_rated==0){
                   echo "<td>";
                   echo '<a href="order_rate.php?id='.$row['o_id'].'">Rate</a>';
                   echo "</td>";
                   echo "<td></td>";
               }
               else{
                   echo "<td>";
                   echo "</td>";
                   echo "<td></td>";
               }
             }
             echo"</tr>";
            }
          }

        mysqli_close($dblink);
      ?>

    </table>
    <a href="u_myaccount1.php">Back</a>
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
