<!DOCTYPE html>
<html lang="en" dir="auto">
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
<script type="text/javascript" src="js/imags.js"></script>
</head>
<?php

include('connect.php');

$itemid=$_GET['itemid'];
$itemDoner=$_GET['itemDoner'];
?>
    <script>
    function hello(){
      var itemid=$('#itemid').val();
      var doner=$('#itemDoner').val();
      var msg=$('textarea#messege').val();
    //  var testKeyword = /^[A-Za-z]+$/;
    var testKeyword = /^[ +A-Za-z0-9\s+]+$/;

        if(msg==undefined || msg=='' || !testKeyword.test(msg)){
        alert(msg);
        return;
     }
      $.ajax({
      url: 'msg_handle.php',
      type: "post",
      data:{"itemid":itemid,"doner":itemDoner,"messege":msg},
      dataType:"text",
      success: function(data){
          alert(data);
          // console.log(msg);
      },
      error:function(msg){
        console.log(msg);
      }
      });
    }
    $(document).ready(function() {


    } );
    </script>



<body>
  <div class="container">
  <content>

      <form action="msg_handle.php" method="post">
          <div class="form-group">
              <label for="message">Send a message</label>
          <textarea name="messege" id="messege" class="form-control">
           </textarea >
         </div>
          <!--send the donator and item information as hidden values in the form
          -->
        <div class="form-group">
           <!--send the donator and item information as hidden values in the form
          -->
           <input type="hidden" name="itemid" id="itemid" value="<?php echo $itemid ?>">
          <input type="hidden" name="itemDoner" id="itemDoner" value="<?php echo $itemDoner ?>">
         <!-- <button type="submit" name="sendButton" >send</button> -->
         <button type="submit" class="btn btn-primary" >Send</button>
       </div>
      </form>

   <?php

$dblink->close();

?>


  </content>
        </div>


    </body>

</html>
