<?php
     header("Content-type: text/xml");
     $dom = new DOMDocument("1.0");
     $node = $dom->createElement("markers");
     $parnode = $dom->appendChild($node);
     include("connect.php");
      $query = "SELECT * FROM item";
      $result = mysqli_query($dblink,$query);
      //echo $result;
      if (!$result) {
        die('Invalid query: ' . mysqli_error($result));
      }
      while ($row = $result->fetch_assoc()){
        $noder = $dom->createElement("marker");
        $newnode = $parnode->appendChild($noder);

        $newnode->setAttribute("name",$row['i_name']);
        $newnode->setAttribute("postcode", $row['i_location']);
        $newnode->setAttribute("date", $row['i_exp_date']);
        $newnode->setAttribute("status", $row['is_checked']);
        $newnode->setAttribute("ordered", $row['is_ordered']);
      }
      mysqli_close($dblink);
      echo $dom->saveXML();
   ?>
