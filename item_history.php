<?php
  session_start();
  //session_destroy();
  include('connect.php');
  // if has logged
  /*if(isset($_SESSION['isguestlogin']))
  {
   header("Location: myaccount1.php");
 }*/
  //if(isset($_POST['btn-login']))
  //{
    $u_id = $_SESSION['isguestlogin'];
    //$u_pwd = $_SESSION['guestpwd'];
    $res=mysqli_query($dblink,"select * from (SELECT u_id as'id', u_pwd as 'pwd' FROM user WHERE u_id='$u_id' union select a_id as 'id', a_pwd as 'pwd' from adm where a_id='$u_id')a");
    $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
  //}

  //   session_start();
  //   $con = mysqli_connect("127.0.0.1","root","4869","Food_Spray");

    // $u_id = "alice@gmail.com";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Items</title>
    <meta charset="UTF-8">
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


    <script>
        $( function() {
            $( "#i_exp_date_new" ).datepicker({dateFormat: "yy-mm-dd"});
        } );

        $( function() {
            $( "#i_collect_date_new" ).datepicker({dateFormat: "yy-mm-dd"});
        } );

        $(function() {
            $('#is_collected').click(function() {
                this.value = (this.value == 0) ? 1 : 0;
                alert(this.value);
                var obj = $("#i_collect_date").get(0);
                obj.disabled = !$("#is_collected")[0].checked;
            });
        });
		$(document).ready(function() {
			$('.table').DataTable({
                "destroy":true,
                columnDefs:[
                  {'targets':'_all','className':'dt-center'}
                ]
              });
		});
    </script>

</head>

<body>
  <div class="container">
    <form method="post" action="item_editing.php">
      <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Upload Time</th>
              <th>Picture</th>
              <th>Name</th>
              <th>Type</th>
              <th>Quantity</th>   <!-- two fields -->
              <th>Expiration Date</th>
              <th>Location</th>
              <th>Description</th>
              <!-- <th>Collection</th> -->
              <th>Collection Date</th>
              <th>Check Status</th>
              <th>Order Status</th>
              <th colspan="2">Operations</th>
            </tr>
          </thead>


          <tbody>
            <?php
              // $con = mysqli_connect("127.0.0.1","root","4869","Food_Spray");
              $res_h = mysqli_query($dblink,"SELECT * FROM item WHERE i_u_donator='$u_id'");
              if(! $res_h){
                  die('Could not get item information about this user' . mysqli_connect_error());
              }


              while ($row_h = mysqli_fetch_array($res_h) )
              {
                  print "<tr><td id=\"i_id\">".$row_h['i_id']."</td>\n";
                  print "    <td>".$row_h['i_time']."</td>\n";

                  print "    <td><img class='img-responsive' src=\"img/".$row_h['i_im_name']."\" alt=\"IMAGE\" width=\"60\" height=\"60\"></td>\n";
                  print "    <td>".$row_h['i_name']."</td>\n";
                  print "    <td>".$row_h['i_type']."</td>\n";
                  print "    <td>".$row_h['i_quantity']." ".$row_h['i_unit']."</td>\n";
                  print "    <td>".$row_h['i_exp_date']."</td>\n";
                  print "    <td>".$row_h['i_location']."</td>\n";
                  print "    <td>".$row_h['i_detail']."</td>\n";
                  print "    <td>".$row_h['i_collect_date']."</td>\n";

                  if ($row_h['is_checked'] == 1){
                      $C_S ="Checked";
                  }else{
                      $C_S ="Un-checked";
                  }
                  if ($row_h['is_ordered'] == 1){
                      $O_S ="Ordered";
                  }else{
                      $O_S ="Un-ordered";
                  }
                  print "    <td>".$C_S."</td>\n";
                  print "    <td>".$O_S."</td>\n";


                  if ($row_h['is_ordered'] == 0 && $row_h['is_checked'] == 1){
                      print "<td colspan=\"1\"><a class=\"edit\" href=\"item_editing.php?i_id=".$row_h['i_id']."\" onclick=\"getValue()\">Update</a></td>";
                      print "<td colspan=\"1\"><a class=\"delete\" href=\"item_deleting.php?i_id=".$row_h['i_id']."\">Delete</a></td></tr>";
                  }else{
                      print "<td colspan=\"1\"><input type=\"submit\" name=\"submit\" value=\"Update\" disabled=\"disabled\"></td>";
                      print "<td colspan=\"1\"><input type=\"submit\" name=\"submit\" value=\"Delete\" disabled=\"disabled\"></td></tr>";
                  }
              }
            ?>
          </tbody>
        </table>
      </form>
      <a href="u_myaccount1.php">Back</a>
			</div>

</body>
</html>
