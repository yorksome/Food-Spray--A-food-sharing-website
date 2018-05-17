
<!DOCTYPE html>
<html lang="en" dir="auto">
<?php
include('connect.php');
include('analysis.php');
//session_start();
//session name of user
$user_id=$_SESSION["isguestlogin"];
//query to retrive all the records of the logged in user from item table
   $queryDonate="SELECT i_u_donator,i_type, count(*) as number FROM item WHERE i_u_donator='$user_id' GROUP BY i_type";
//query to retrive all the records of the logged in user from order table

$queryOrder="SELECT orders.o_u_recipient,orders.o_i_item,item.i_type,item.i_id,
count(*) as number
FROM orders
LEFT JOIN item ON orders.o_i_item=item.i_id
WHERE orders.o_u_recipient='$user_id'
Group BY item.i_type;";


//$queryOrder="SELECT item.i_type,orders.o_u_recipient,orders.o_i_item, count(*) as number FROM orders,item WHERE o_u_recipient='$user_id' GROUP BY item.i_type";
$result=mysqli_query($dblink,$queryDonate);
$result2=mysqli_query($dblink,$queryOrder);


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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart()
    {
         var data = google.visualization.arrayToDataTable([
                   ['Type', 'Number'],
                   <?php
                   while($row = mysqli_fetch_array($result))
                   {
                        echo "['".$row["i_type"]."', ".$row["number"]."],";
                   }
                   ?>
              ]);
         var options = {
               title: 'Percentage of Food Donation',
               is3D:true,
               pieHole: 0.4
              };
         var chart = new google.visualization.PieChart(document.getElementById('piechart'));
         chart.draw(data, options);
    }
    </script>


    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2()
    {
         var data = google.visualization.arrayToDataTable([
                   ['Type', 'Number'],
                   <?php
                   while($row = mysqli_fetch_array($result2))
                   { //use the item id in the order table to fetch the item type name from the item table
                     $type=$row["o_i_item"];
                     $q3="SELECT i_id, i_type FROM item WHERE i_id='$type'";
                     $result3=mysqli_query($dblink,$q3);
                     $row2 = mysqli_fetch_array($result3);
                     //use the item type name and number of records from order table
                        echo "['".$row2["i_type"]."', ".$row["number"]."],";
                   }
                   ?>
              ]);
         var options = {
               title: 'Percentage of Food Orders',
               is3D:true,

               pieHole: 0.4
              };
         var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
         chart.draw(data, options);
    }
    </script>


    </head>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
    </script>
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/imags.js"></script>

    <body>
				 <div class="container">
               <h2>Intelligent Analysis</h2>
      <a href="u_myaccount1.php">Back to My Account</a>
<div class="content">
  <div class="table-responsive">
    <table class="table table-dark">
    <tr><td>
  <p>Here is your donation percentage :</p>
</td>
</tr>
<tr><td>
<div class="graph">
<div id="piechart" style="width:800px ; height:400px; backgroundColor: #ffb3b3; border:10px">
</div>
</div>
</td><tr><td>
<p>Here is your orders percentage :</p>
</td></tr>
<tr><td>
<div class="graph">
<div id="piechart2" style="width:800px ; height:400px; background-color: #ffb3b3; border:10px">

</div>
</div>
</td></tr>
</table>
</div>
<div class="contentR">
  <p style="color:#cc0000; font-style: italic;font-size: 26px;">Your Statistics:</p>
  <p>you have donated
<?php
//display statistics to user using COUNT for number of records in item table
 $queryDonate="SELECT  count(*) as number FROM item WHERE i_u_donator='$user_id' ";
$resultStat=mysqli_query($dblink,$queryDonate);
$row = mysqli_fetch_array($resultStat);
echo "".$row["number"];
?>
 times </p>
 <p>you have ordered
<?php
$queryOrder="SELECT count(*) as number FROM orders WHERE o_u_recipient='$user_id' ";
$result=mysqli_query($dblink,$queryDonate);
$result2=mysqli_query($dblink,$queryOrder);
$row2 = mysqli_fetch_array($result2);
echo "".$row2["number"];
?>
 times </p>
 <p style="color:#cc0000; font-style: italic;font-size: 26px;">Your Recommendation:</p>
 <?php
echo $advice;
 ?>
</div>

</div>






		</div>
    </body>

</html>
