<?php
session_start();
//if has not logged
if(!isset($_SESSION['isguestlogin']))
{
 header("Location: u_log.php");
}

include_once('connect.php');
$u_id = $_SESSION["isguestlogin"];
$sql = "select * from user where (u_id='$u_id')";
$res = mysqli_query($dblink,$sql);
$userRow=$res->fetch_assoc();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['u_fullname'];?></title>
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
  <header>
    <div class="container" style="background:url('images/lemon2.jpg');background-repeat:repeat-x;">
      <div class="nav-brand">
        <a class="logo">Food Spray</a>
      </div>
      <nav id="nav" role="navigation">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="map.html">Map</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="" class="active">My Account</a></li>
          
        </ul>
      </nav>
    </div>
  </header>
	<div class="container">
  <content>
    <div class="main-body" style="background:url('images/featured-1.jpg');background-repeat:no-repeat;">
            <div id="content">
               Hi, <?php echo $userRow['u_fullname'];?>&nbsp;&nbsp;&nbsp;
            </div>

          <div class="list-group">
            <a class="list-group-item sblack"  href="u_account.php">User Information</a>
            <!-- a notification of wishlist
                 turn red if any wish item is in store
            -->


            <?php
            $nsql= "select @rownum:=@rownum+1 as RowNum,t1.w_id, t1.w_type as 'type',t1.w_content as 'w_content' from (select @rownum:=0)t, wishlist t1 where (((t1.w_content in (select i_name from item)) or (t1.w_type in (select i_type from item) and t1.w_content='')) and t1.w_u_user='$u_id')order by t1.w_id asc";
                $narr = mysqli_query($dblink,$nsql);
            if ($narr->num_rows==0)
            {
              echo "<a class='list-group-item sblack' href='u_wishlist.php'>My wishlist </a>";
              $notice="";
            }
            else {
              ?>
             <a class="list-group-item"  href="u_wishlist.php">
             My Wishlist
             </a>
              <?php
              $notice='Your wish items are in store now, have a look!';
            }
            ?>
            <!--
               add link to replace following # , then delete the comment
            -->
            <a class="list-group-item sblack" href="order.php">Order List</a>
            <a class="list-group-item sblack" href="item_history.php">Item List</a>
            <a class="list-group-item sblack" href="item.html">Post Items</a>
            <a class="list-group-item sblack" href="statistics.php">Intelligent Analysis</a>
            <a class="list-group-item sblack" href="inbox.php">Message</a>
			 <a class="list-group-item sblack" href="u_logout.php?logout">Sign Out</a>
          </div>
          <p> <?php
          echo $notice;
          ?>
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
