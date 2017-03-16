<!DOCTYPE html>
<html>
  <head>
<title>Social Network</title>
<script src="jquery-3.1.1.min.js"></script>
<link rel="icon" href="../../favicon.ico">
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
 <div class="container">

      <div class="jumbotron col-md-8 col-md-offset-2" style="padding-top:40px;margin-top:20px;">
      <a type="button" class="btn btn-default" href="admin.php"><span class="glyphicon glyphicon-chevron-left"></span> Back to Admin Home</a>
<?php

      require_once('db_connect.php');
      session_start();
      if($_SESSION['id'] != -2){
      exit;
      }
      $loadprofile = $_GET['fid'];
      $r = mysqli_query($dbc,"SELECT * FROM Users WHERE id = '".$loadprofile."'");
      $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
   
      $name = $row['name'];
      $sexp = $row['sex'];
      $locationp = $row['location'];
      $educationp = $row['education'];
      $emailp = $row['email'];
      
      echo '<h3 class="text-center">'.$name.'\'s Profile</h3>';
      
      echo '<h4>Edit Profile Information <span style="font-weight:200"></h4>';
      
    ?>       

      
                <form id="form" method="POST" class="form-horizontal" role="form" style="margin:0px 0px;">
                         <div class="form-group">
                        <div class="col-sm-12">
                                       <div class="input-group">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input id="name" name="name" data-validation="length" data-validation-length="min4" class="form-control required" type="text" size="16" value="<?php echo $name; ?>" autofocus="autofocus" required/>
                            </div>
                        </div>
                
                        </div>
                          <div class="form-group">
                            <div class="col-xs-6">
                         
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
       
                                <select class="form-control" name ="sex" id="sex" required>
                  <option <?php if($sexp=="Male"){echo 'selected';}?>>Male</option>
                  <option <?php if($sexp=="Female"){echo 'selected';}?>>Female</option>
                  <option <?php if($sexp=="Other"){echo 'selected';}?>>Other</option>
                </select>
                      
                        </div>
                        </div>
                        <div class="col-xs-6">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span></span>
                                <input id="location" name="location" data-validation="length" data-validation-length="min3"   class="form-control required" type="text" size="16" value="<?php echo $locationp; ?>" required/>
                            </div>
                        </div>
                    </div
                       </div>
                       <div class="form-group">
                            <div class="col-sm-6">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-university"></span></span>
                                <input id="education" name="education"  class="form-control" type="text" size="16" value="<?php echo $educationp; ?>" required/>
                            </div>
                        </div>
                                 
                       
                            <div class="col-sm-6">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input id="email" name="email" data-validation="email" class="form-control email" type="email" size="16" value="<?php echo $emailp; ?>" required/>
                            </div>
                        </div>
                    </div>
               <input id="user" name="user" class="form-control" type="hidden" value="<?php echo $loadprofile; ?>"/>

               </form>
      <h3 id="errormessage" style="color:red;" class="payment-errors text-center"></h3>
      <button id="submitedit" type="button" class="btn btn-primary  col-md-offset-4 col-md-4  form-group">Save</button>
     <br> 
     
     
     <script>
          var $btn = $('#submitedit');
       $btn.on('click', function(e) {   
       //$btn.prop('disabled', true);
//$btn.button('progress');
  
    $.ajax({
           type: "POST",
           url: "edit.php",
           data: $("#form").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.name) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.name); //Throw relevant error
                                }
                                else if (data.errors.location) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.location); //Throw relevant error
                                }
                                else if (data.errors.repeat) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.repeat); //Throw relevant error
                                }
                            }
                            else {
                                    $('.payment-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
          
                                }
                            }
                            
      
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.

});
</script>
<br><br><br>
  <?php  
  		  
      echo '<h4>Friends  <span style="font-weight:200"></h4>'; 

     $t = mysqli_query($dbc,"SELECT * FROM Relationships WHERE (user_1 = '".$loadprofile."' OR user_2 = '".$loadprofile."') AND status = 'accepted'");

     while($row3 = mysqli_fetch_array($t,MYSQLI_ASSOC)){
      if($row3["user_1"] == $loadprofile){
        $friendlist = $row3["user_2"];
      }
      else{
        $friendlist = $row3["user_1"];
      }
  
      $n = mysqli_query($dbc,"SELECT name FROM Users WHERE id = '".$friendlist."'");
      $row4 = mysqli_fetch_array($n,MYSQLI_ASSOC);
      $namelist = $row4['name'];
      echo '<div class = "stuff"><a  href="profile.php?fid='.$friendlist.'"> '.$namelist.'</a><button type="button" class="btn btn-default pull-right acc" id = "'.$friendlist.'" value = "friend"><span class="glyphicon glyphicon-user"></span> Remove Friendship</button></div><br><br>';
      
          
     } 
     
     
     
     echo '<h4>Blog Posts  <span style="font-weight:200"></h4>'; 

     

     $t = mysqli_query($dbc,"SELECT * FROM posts WHERE user_id = '".$loadprofile."'");

     while($row = mysqli_fetch_array($t,MYSQLI_ASSOC)){
    
  
     
      echo '<div class = "stuff"><a>'.$row['title'].' - '.$row['content'].'</a><button type="button" class="btn btn-default pull-right acc" id = "'.$row['id'].'" value = "blog"><span class="glyphicon glyphicon-list"></span> Remove Post</button></div><br><br>';
      
          
     }
     
       
       
       echo '<h4>Albums<span style="font-weight:200"></h4>'; 

     

     $t = mysqli_query($dbc,"SELECT * FROM album WHERE userID = '".$loadprofile."'");

     while($row = mysqli_fetch_array($t,MYSQLI_ASSOC)){
    
  
     
      echo '<div class = "stuff"><a>'.$row['albumName'].'</a><button type="button" class="btn btn-default pull-right ph"  id = "'.$row['albumID'].'" value = "Collection"><span class="glyphicon glyphicon-th-large"></span> Remove Album</button></div><br><br>';
      
          
     }
     
     
           echo '<h4>Photos<span style="font-weight:200"></h4>'; 

     

     $t = mysqli_query($dbc,"SELECT * FROM photo WHERE userID = '".$loadprofile."'");

     while($image = mysqli_fetch_array($t,MYSQLI_ASSOC)){
   
					    $photoNum = $image['photoID'];
					    $photoName = $image['refLoc'];
					    $albumId = $image['albumID'];

					    // $albumNum = $albumId;

					    
					   
					
						
					    	echo '<div class = "stuff">';
					    

						    list($width,$height) = getimagesize(''.$photoName.'');
						    if($width>$height){
						    	echo "<a class='img' id='".$photoNum."' name='".$albumId."'>";
	                            	echo "<img src='".$photoName."' height='150px' style='image-orientation: 0deg;'>";
	                            echo "</a>";
	                        }
	                        else{
	                        	echo "<a class='img' id='".$photoNum."' name='".$albumId."'>";
	                            	echo "<img src='".$photoName."' width='150px' style='image-orientation: 0deg;'>";
	                            echo "</a>";
	                        }
			    			
					       echo '<button type="button" class="btn btn-default pull-right ph" id = "'.$photoNum.'" value = "Photo"><span class="glyphicon glyphicon-picture"></span> Delete Photo</button></div><br><br>';
	}

 echo '<h4>All Photo Comments<span style="font-weight:200"></h4>'; 


 $t = mysqli_query($dbc,"SELECT * FROM comment WHERE userID = '".$loadprofile."'");

     while($row = mysqli_fetch_array($t,MYSQLI_ASSOC)){
   

			    			
					       echo '<div class = "stuff"><a>'.$row['content'].'</a><button type="button" class="btn btn-default pull-right acc" id = "'.$row['id'].'" value = "comment"><span class="glyphicon glyphicon-list-alt"></span> Delete Comment</button></div><br><br>';
	}

  	echo '<h4>Circle Membership<span style="font-weight:200"></h4>'; 


 $t = mysqli_query($dbc,"SELECT * FROM circles
INNER JOIN circlemembership
ON circlemembership.circleID=circles.id WHERE circlemembership.userID = '".$loadprofile."'");

     while($row = mysqli_fetch_array($t,MYSQLI_ASSOC)){
   

			    			
					       echo '<div class = "stuff"><a>'.$row['name'].'</a><button type="button" class="btn btn-default pull-right acc" id = "'.$row['id'].'" value = "circles"><span class="glyphicon glyphicon-remove"></span> Remove User from Circle</button></div><br><br>';
	}
     
      
          
     
    
?>
<script>
$(document).ready(function() {
    $(".acc").click(function(){ //Trigger on form submit
    
        var user1 =  <?php echo $loadprofile;?>;
        var id1 =  $(this).attr('id');
        var action1 = $( this ).val();
        
 $(this).closest(".stuff").remove();

        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'admin_process.php', //Your form processing file URL
            data      : {user: user1, id: id1, action: action1}, //Forms name
     
            success   : function(data) {
              
         
                            }
        });
        event.preventDefault(); //Prevent the default submit
    });
});

$(document).ready(function() {
    $(".ph").click(function(){ //Trigger on form submit
    
        var user1 =  <?php echo $loadprofile;?>;
        var id1 =  $(this).attr('id');
        var action1 = $( this ).val();
        
 $(this).closest(".stuff").remove();

        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'deleteimage.php', //Your form processing file URL
            data      : {user: user1, albumID: id1,photoID: id1, type: action1}, //Forms name
     
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
