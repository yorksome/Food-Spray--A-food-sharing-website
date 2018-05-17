<html>
<head>
<title>Order History Credit Rate</title>
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
  <?php
   $id = $_GET['id']; //
   session_start();
 ?>
  <div>
    <form action="order_rate_handler.php" method="post">
  <div class="container">
	  <content>
<div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">
	  <div class="table-responsive">
	  <table class="table">
    		  <tr>
    			 <td>Credit:</td>
         </tr>
         <tr>
    			 <td><input type="radio" name="radio" value="0">0</td>

         </tr>
         <tr>
    			 <td><input type="radio" name="radio" value="1">1</td>

         </tr>
         <tr>
           <td><input type="radio" name="radio" value="2">2</td>

         </tr>
         <tr>
           <td><input type="radio" name="radio" value="3">3</td>

         </tr>
         <tr>
           <td><input type="radio" name="radio" value="4">4</td>
 
         </tr>
         <tr>
           <td><input type="radio" name="radio" value="5">5</td>

    	</tr>

         <tr>			 
           <td>
			   <input type="hidden" name="hidden" value="<?php echo "$id";?>">
			   <input type="submit" value="submit">
			 </td>
         </tr>		  
		  <tr>
			  <td><a href="order.php">Back</a></td>
		  </tr>
          </table>
	  </div>
		  </div>
		  </content>
		</div>
    </form>
  </div>
</body>
</html>
