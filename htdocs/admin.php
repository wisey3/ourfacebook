<!DOCTYPE html>
<html>
  <head>
<title>Social Network - Admin</title>
<script src="jquery-3.1.1.min.js"></script>
<link rel="icon" href="../../favicon.ico">
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
 <div class="container">
<h2 class = "text-center">Administrator</h2>

<h4 class = "text-center">Click on a user to see more</h4>
      <div class="jumbotron col-md-12" style="padding-top:40px;margin-top:20px">
<?php

      require_once('db_connect.php');
      session_start();
      $_SESSION['id'] = -2;
      $users = mysqli_query($dbc,"SELECT * FROM Users");
      
      while($row_data = mysqli_fetch_array($users,MYSQLI_ASSOC))
    	{
 echo '<div class="stuff"><a href="admin_edit.php?fid='.$row_data['id'].'"> '.$row_data['name'].'</a>';
 echo '<button type="button" class="btn btn-danger pull-right" id = "'.$row_data['id'].'" ><span class="glyphicon glyphicon-remove"></span> Delete User</button>';
echo '</div><br><br>';
      	} 
    
?>
<script>
$(document).ready(function() {
    $(".btn").click(function(){ //Trigger on form submit
    
     
        var id1 =  $(this).attr('id');
 $(this).closest(".stuff").remove();

        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'delete.php', //Your form processing file URL
            data      : {id: id1}, //Forms name
     
            success   : function(data) {
              
         
                            }
        });
        event.preventDefault(); //Prevent the default submit
    });
});
</script>
</div>
</div>
</body>
</html>
