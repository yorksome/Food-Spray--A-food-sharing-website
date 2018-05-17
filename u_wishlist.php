<?php
  session_start();
  //if has not logged
  if(isset($_SESSION['isguestlogin'])=="")
  {
     header("Location: u_log.php");
  }
  include('connect.php');
  $u_user = $_SESSION["isguestlogin"];
 ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>wishlist</title>
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
<div>
	<form method="post" name="wishlist">
		<div class="form-group">
			<div class="table-responsive">
    <?php
    /* get records from wishlist table */
      $sql = "select @rownum:=@rownum+1 as RowNum,t1.w_id, t1.w_type as 'type',t1.w_content as 'w_content' from (select @rownum:=0)t, wishlist t1 where t1.w_u_user='$u_user' order by t1.w_id asc";
      $arr = mysqli_query($dblink,$sql);
      echo "<label>Wishlist:</label>";
      if($arr == '')
      {
      	echo "No records";
      }
      else{
      	echo"
        <table class='table' align='center' border='1' width='80%'><thread>
      	<tr>
      	<th class='tc'>ID</th>
      	<th class='tc'>Food Type</th>
      	<th class='tc'>Food</th>
      	<th class='tc'>Action</th>
      	</tr></thread>";
      	while($rows=$arr->fetch_assoc())
      	{
      	 	echo "<tr>";
      	 	echo "<td class='tc'>".$rows["RowNum"]."</td>";
          echo "<td class='tc'>".$rows["type"]."</td>";
          echo "<td class='tc'>".$rows["w_content"]."</td>";
          echo "<td class='tc'>";
          echo "<a href='delwish.php?wid=".$rows["w_id"]."'  class='link-update'><font color='blue'>Delete</font></a>";
          echo "</td>";
          echo "</tr>";
        }
          echo "</table>";
      }
     ?>
			</div>
		</div>
     </form>
     <div class="form-group">
     <form method="post" name="notification">
		 <div class="table-responsive">
     <?php
     /* get all wish items which are in store now*/
       $nsql= "select @rownum:=@rownum+1 as RowNum,t1.w_id, t1.w_type as 'type',t1.w_content as 'w_content' from (select @rownum:=0)t, wishlist t1 where (((t1.w_content in (select i_name from item)) or (t1.w_type in (select i_type from item) and t1.w_content='')) and t1.w_u_user='$u_user') order by t1.w_id asc";
       $narr = mysqli_query($dblink,$nsql);

       echo "<label>The following wish items are in store now:</label>";
       if($narr == '')
       {
         echo "No records";
       }
       else{
         echo
         "<table class='table' align='center' border='1' width='80%'><thread>
          <tr>
             <th class='tc'>ID</th>
             <th class='tc'>Food Type</th>
             <th class='tc'>Food</th>
             <th class='tc'>Action</th>
          </tr></thread>";
          while($nrows = $narr->fetch_assoc())
          {
            echo "<tr>";
            echo "<td class='tc'>".$nrows["RowNum"]."</td>";
            echo "<td class='tc'>".$nrows["type"]."</td>";
            echo "<td class='tc'>".$nrows["w_content"]."</td>";
            echo "<td class='tc'>";
            // click on the button, the corresponding record will delete from the wishlist, users can go to search the item by themselves
            echo "<a href='delwish.php?wid=".$nrows["w_id"]."'  class='link-update'><font color='red'>I know</font></a>";
            echo "</td>";
            echo "</tr>";
           }
           echo "</table>";
        }
     ?>
		 </div>
     </form>
	</div>
	<div class="form-group">
     <a href="u_myaccount1.php">Back</a>
	</div>	
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
