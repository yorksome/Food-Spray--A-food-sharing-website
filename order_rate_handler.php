<html>
<head>
<title>Order History Credit Rate Handler</title>
<link href="css/jquery.dataTables.css">
</head>
<body>
  <?php
  include("connect.php");
  session_start();
  $user = $_SESSION['isguestlogin'];
  if(isset($user)){
        //$user = 'alice@gmail.com';

        @$radio = $_POST["radio"];
        @$o_id = $_POST["hidden"];

        if($o_id && $radio)
        {
          $sql = "SELECT * FROM orders WHERE (o_id='$o_id')";
          $result = mysqli_query($dblink,$sql); //get user full name -> order table
          if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
          {
                $donator = $row['o_donator'];
                $sql_1 = "SELECT * FROM user WHERE (u_fullname='$donator')"; // get user current credit ->user table
                $result_1 = mysqli_query($dblink,$sql_1);
                if($row_1 = mysqli_fetch_array($result_1,MYSQLI_ASSOC))
                {
                    $credit = $row_1["u_credit"];
                    echo $credit;
                    if($credit==0)
                    {
                      $credit = $radio;
                    }
                    else{
                      $credit = ($credit + $radio)/2;
                    }
                    $sql_2 = "UPDATE user SET u_credit='$credit' WHERE (u_fullname='$donator')";
                    $result_2 = mysqli_query($dblink,$sql_2);

                      $msg = "You have rated the credit succesfully!";
                      $sql_3 = "UPDATE orders SET is_rated=1 WHERE (o_id='$o_id')";
                      $result_3 = mysqli_query($dblink,$sql_3);
                      if(mysqli_affected_rows($dblink))
                        {  echo ("<script>");
                          echo("alert('{$msg}');");
                          echo("location.href='order.php';");
                          echo("</script>");
                        }
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
  mysql_close($conn);
  ?>
</body>
</html>
