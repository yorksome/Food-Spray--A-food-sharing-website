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
	  <div class="table-responsive">
	  <table class="table">
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
      if(isset($user))
      {
              //$user = 'alice@gmail.com';

              $id = $_GET['id']; //
              if($id)
              {
                $sql = "SELECT * FROM orders WHERE (o_id='$id')";
                $result = mysqli_query($dblink,$sql);
                if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                      $item_id = $row['o_i_item'];
                      $sql_1 = "UPDATE item SET is_ordered=0 WHERE (i_id='$item_id')";
                      $result_1 = mysqli_query($dblink,$sql_1);
                      $is_changed = mysqli_affected_rows($dblink);
                      if($is_changed>0)
                      {
                        $msg = "You have canceled this transaction.";
                        echo ("<script>");
                        echo("alert('{$msg}');");
                        $sql_2 = "DELETE FROM orders WHERE (o_id='$id')";
                        $result_2 = mysqli_query($dblink,$sql_2);
                        echo("location.href='order.php';");
                        echo("</script>");
                      }
                      else {
                        $msg = "Update Failure!";
                        echo ("<script>");
                        echo ("alert('{$msg}');");
                        echo("location.href='order.php';");
                        echo ("</script>");
                      }
                }
              }
              else  {
                $msg = "Data not Received!";
                echo ("<script>");
                echo ("alert('{$msg}');");
                echo ("</script>");
              }
        }
      mysqli_close($dblink);
    ?>
  </table>
	  </div>
		  </div>
		  </content>
</div>

</body>
</html>
