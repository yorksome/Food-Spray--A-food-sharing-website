<?php
session_start();
include('connect.php');

//session name of user
$user_id=$_SESSION["isguestlogin"];

$queryDonate="SELECT i_u_donator,i_type, count(*) as number FROM item WHERE i_u_donator='$user_id' GROUP BY i_type";
$result=mysqli_query($dblink,$queryDonate);
$higest=0;
while($row = mysqli_fetch_array($result))
{
  if($row["number"]>$higest)
  //assin the value to the highest type donated
  {$higest=$row["number"];
  $type=$row["i_type"];}

}

switch ($type) {
  case 'Fruit and Vegetable':
    $advice="Would you consider buying loose Fruits or Vegetables next time you go shopping , this will decrease your food wastage and save your money!";
    break;
  case 'Dairy':
      $advice="would you consider buying a smaller pakage of your perferred dairy product to reduce your wastage?";
      break;
  case 'Frozen Food':
        $advice="Try taking a smaller pakage of your chosen Frozen food and make sure not to go shopping while hungry";
        break;
  case 'Dry Goods':
        $advice="Consider planning your meals and your shopping list carefully , check the cuboards before you shop to avoide buying an item you already have";
        break;
        case 'Homemade':
              $advice="Have you considered scaling your recipe? you can have the same result with a smaller amount";
              break;
              case 'Bakery Product':
                  $advice="Have you considered scaling your recipe? you can have the same result with a smaller amount";
                    break;

  default:
  echo "";
    break;
}
?>
