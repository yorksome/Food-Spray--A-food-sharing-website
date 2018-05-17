<?php
    session_start();
    include("connect.php");
    //session_destroy();
    //$_SESSION["isguestlogin"]=true;//registered user already loggined in
    if(isset($_SESSION["isguestlogin"])){
      $isguestlogin=true;
    }else{
      $isguestlogin=false;
    }

    if(isset($_POST['searchq'])){
      $itemtype=$_POST['itemtype'];
      $searchq=$_POST['searchq'];
      $searchq="%" . $searchq . "%";
      if($isguestlogin==true){
?>
     <thead>
         <tr>
             <th>ID</th>
             <th>Name</th>
             <th>Quantity</th>
             <th>Expiration Date</th>
             <th>Location</th>
             <th>Photo</th>
             <th>Order</th>
             <th>Message</th>
             <th>Credit</th>

         </tr>
     </thead>
     <tbody>
<?php
    if($itemtype=="Any"){
      $stmt=mysqli_prepare($dblink,"select item.i_id,item.i_name,item.i_type,item.i_quantity,item.i_exp_date,
      item.i_location,item.i_im_name,item.is_ordered,credit.c_mark,item.i_u_donator
      from item left join credit on item.i_u_donator=credit.c_u_grated
      where i_name like ? and is_checked=1 and is_ordered=0");
      mysqli_stmt_bind_param($stmt,'s',$searchq);
    }else{
      $stmt=mysqli_prepare($dblink,"select item.i_id,item.i_name,item.i_type,item.i_quantity,item.i_exp_date,
      item.i_location,item.i_im_name,item.is_ordered,credit.c_mark,item.i_u_donator
      from item left join credit on item.i_u_donator=credit.c_u_grated
      where i_name like ? and is_checked=1 and is_ordered=0
      and i_type=?");
      mysqli_stmt_bind_param($stmt,'ss',$searchq,$itemtype);
    }
     
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$itemid,$itemname,$itemtype,$itemquantity,$itemdue,$itemlocation,$itemphoto
    ,$itemoder,$creditmark,$itemdonator);
    $isfound=false;
    while(mysqli_stmt_fetch($stmt)){


      echo "<tr>";
      echo "<td>". $itemid. "</td>";
      echo "<td>". $itemname. "</td>";
      echo "<td>". $itemquantity. "</td>";
      echo "<td>". $itemdue. "</td>";
      echo "<td>". $itemlocation. "</td>";
      echo "<td><button onclick='viewme(".$itemid.")'>View Me</button></td>";
      echo "<td><button onclick='order(".$itemid.",\"".$itemname."\")'>Order</button></td>";
      echo "<td><button onclick='message(".$itemid.",\"".$itemdonator."\")'>Message</button></td>";
      echo "<td>". $creditmark. "</td>";
      echo "</tr>";
      $isfound=true;
    }
    if($isfound==false){
      echo "<tr>";
      echo "<td colspan='10'> No Match </td>";
      echo "</tr>";
    }
    }else{
?>
      <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Quantity</th>
              <th>Expiration Date</th>
              <th>Photo</th>
          </tr>
      </thead>
      <tbody>
<?php
      if($itemtype=="Any"){
        $stmt=mysqli_prepare($dblink,"select item.i_id,item.i_name,item.i_type,item.i_quantity,item.i_exp_date,
        item.i_location,item.i_im_name from item
        where i_name like ?  and is_checked=1 and is_ordered=0");
        mysqli_stmt_bind_param($stmt,'s',$searchq);
      }else{
        $stmt=mysqli_prepare($dblink,"select item.i_id,item.i_name,item.i_type,item.i_quantity,item.i_exp_date,
        item.i_location,item.i_im_name from item
        where i_name like ?  and is_checked=1 and is_ordered=0
        and i_type=?");
        mysqli_stmt_bind_param($stmt,'ss',$searchq,$itemtype);
      }
       //echo $stmt;
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$itemid,$itemname,$itemtype,$itemquantity,$itemdue,$itemlocation,$itemphoto);
        $isfound=false;
        while(mysqli_stmt_fetch($stmt)){

?>
          <tr>
          <td><?php echo $itemid ?></td>
          <td><?php echo $itemname?></td>
          <td><?php echo $itemquantity?></td>
          <td><?php echo $itemdue?></td>
          <td><button onclick='viewme(<?php echo $itemid?>)'>View Me</button></td>
          </tr>
<?php
          //echo $foodname.":";
          //echo $foodtype."<br/>" ;
          $isfound=true;
        }
        if($isfound==false){
          echo "<tr>";
          echo "<td colspan='5'> No Match </td>";
          echo "</tr>";
        }

      }
    }
?>
