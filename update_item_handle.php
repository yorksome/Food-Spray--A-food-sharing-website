<?php

include('connect.php');
$itemNo=$_POST['itemNo'];
$msg='';
//check which botton was clicked
if(isset($_POST['passButton']))
{

    $q = "UPDATE item
SET is_checked='1'
WHERE i_id='$itemNo' ";


//create a messege for the donator of the item
$msg="your item has been approved";

}
else {
  $q = "DELETE FROM item
WHERE i_id='$itemNo' ";

$msg="your item has been rejected!";
}



$qDon="SELECT i_u_donator,i_id FROM item WHERE i_id='$itemNo'";
$resultDonation=mysqli_query($dblink,$qDon);

$row = $resultDonation->fetch_assoc();
$donator=$row['i_u_donator'];
$donation=$row['i_id'];
$result=mysqli_query($dblink,$q);
$date = date('Y-m-d H:i:s');
//add new record in the messege table with the related content
$qMsg=" INSERT INTO msg (`m_time`,`m_i_item`,`m_u_sender`,`m_u_receiver`,`m_content`)
VALUES ('$date','$donation','Administrator','$donator','$msg')";
$resultMsg=mysqli_query($dblink,$qMsg);



if ($result) {
    header("location: index_admin.php");
} else {
    echo "Error: " . $q . "<br>" . $dblink->error;
}

$dblink->close();






?>
