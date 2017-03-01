<?php
// Start the session
      require_once('db_connect.php');
	session_start();
if (!isset($_POST['email']) && !isset($_SESSION['id'])){

echo "Please log in to continue";
echo '<br><a class = "btn btn-default" role="button" href="index.php">Click to login</a>';
}
else{
if(isset($_POST['email'])&&!isset($_GET['fid'])) {

	$p = "SELECT * FROM Users WHERE email = '".$_POST['email']."'";
	$rs = mysqli_query($dbc,$p);
	$data = mysqli_fetch_array($rs, MYSQLI_ASSOC);

	if($rs->num_rows !=1) {
		echo "email not recognised";
		echo '<br><a class = "btn btn-default" role="button" href="index.php">Click to login</a>';
		exit;
	}
	if(!password_verify ( $_POST['password'] , $data['password'])){
		echo "incorrect password";
		echo '<br><a class = "btn btn-default" role="button" href="index.php">Click to login</a>';
		exit;
	}
	
	else{
	
		
		$_SESSION['id'] = $data['id'];
		$loadprofile = $_SESSION['id'];
		}
}
else{
		if(isset($_GET['fid'])) {
   			$loadprofile = $_GET['fid'];
		}
		else{
			$loadprofile = $_SESSION['id'];
		}  
}	

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">

    <title>Social Network</title>


    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/buttons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
             <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


  </head>

  <body>

    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">PizzaRat</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav" style="display::after:inline">
            <li ><a href="index.php">Log Out</a></li>
            <li <?php if($_SESSION['id'] == $loadprofile){?>class="active"<?php }?>><a href="profile.php">My Profile</a></li>
           
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li class="dropdown-header">Profile</li>
                <li><a href="#" data-toggle="modal" data-target="#editinfo" >Edit Profile</a></li>
                <li><a href="#" data-toggle="modal" data-target="#changepassword">Change Password</a></li>
                
                <li><a href="#" data-toggle="modal" data-target="#delete">Delete Account</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Privacy</li>
                <li><a href="#" data-toggle="modal" data-target="#visibility">Visibility Settings</a></li>
                <li><a href="#">Blocking</a></li>
                <li><a href="#">Photos</a></li>
                <li><a href="#">Blog Settings</a></li>
              </ul>
            </li>
             
 <script type="text/javascript">
function getStates(value) {
    $.post("search.php", {name:value},function(data){
        $("#search").html(data);
    }
    ); 
}
</script>
            <li>
            <form><input type="text"  onkeyup="getStates(this.value)" size="30"  class="form-control" placeholder ="Search users" style="margin:8px 8px;">
                       
               <div id="search" style="background-color: white;border-left: 1px solid;border-right: 1px solid;padding-left:10px;">
     
    </div>
    </form>
 </li>
          <ul class="nav navbar-nav navbar-right" style="margin-left:20px" id="feedmenu">
              <li id="p" class="active"><a href="#" id='f1'>Photos</a></li>
              <li id="b" <?php if($_SESSION['id'] == $loadprofile){ ?>  class="dropdown" <?php } ?>>
                <a  href="#" id='f2'  <?php if($_SESSION['id'] == $loadprofile){ ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" <?php } ?>>Blog<?php if($_SESSION['id'] == $loadprofile){ ?>  <span class="caret"></span> <?php }?></a>
             <?php if($_SESSION['id'] == $loadprofile){?>
              <ul class="dropdown-menu">
                 <!--<li id="b"><a href="#" id='f2'>View Blog</a></li>-->
                  
                 <li><a href="#" data-toggle="modal" data-target="#addNewPost" >Add New Post</a></li>
                
                </ul>
                 <?php } ?>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Circles <span class="caret"></span></a>
                <ul class="dropdown-menu">
                 <li id="c"><a href="#" id='f3'>View Circles</a></li>
                 <li><a href="#" data-toggle="modal" data-target="#createcircle" >Create Circle</a></li>
                </ul>
	      </li>
           </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container" id="sn">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron col-md-3" style="padding:10px 20px;">
   <script>
$(document).ready(function() {
    $("#add").click(function(){ //Trigger on form submit
        var user1 =  <?php echo $_SESSION['id'];?>;
        var friend1 =  <?php echo $loadprofile;?>;
        var action1 = 'add';

        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'addfriend.php', //Your form processing file URL
            data      : {user: user1, friend: friend1, action: action1}, //Forms name
     
            success   : function(data) {
                   $( "#add" ).replaceWith( '<h4 style="color:orange"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Friend Request Pending</h4>' );
                            }
        });
        event.preventDefault(); //Prevent the default submit
    });
});
$(document).ready(function() {
    $(".accept").click(function(){ //Trigger on form submit
        var user1 =  <?php echo $_SESSION['id'];?>;
        var friend1 =  $( this ).val();
        var action1 = 'accept';

        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'addfriend.php', //Your form processing file URL
            data      : {user: user1, friend: friend1, action: action1}, //Forms name
     
            success   : function(data) {
           $("#friends").load(location.href+" #friends>*","");
                            }
        });
        event.preventDefault(); //Prevent the default submit
    });
});
$(document).ready(function() {
    $(".decline").click(function(){ //Trigger on form submit
        var user1 =  <?php echo $_SESSION['id'];?>;
        var friend1 =  $( this ).val();
        var action1 = 'decline';

        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'addfriend.php', //Your form processing file URL
            data      : {user: user1, friend: friend1, action: action1}, //Forms name
     
            success   : function(data) {
			 $("#friends").load(location.href+" #friends>*","");            
			}
        });
        event.preventDefault(); //Prevent the default submit
    });
});
$(document).ready(function() {
  $('.circle').each(function () {
      var safeColors = ['00','33','66','99','cc','ff'];
      var r = safeColors[Math.floor(Math.random()*6)];
      var g = safeColors[Math.floor(Math.random()*6)];
      var b = safeColors[Math.floor(Math.random()*6)];
      var color =  "#"+r+g+b;
      $(this).css("background-color", color);
  });
});

 </script>    
      <?php

    $r = mysqli_query($dbc,"SELECT * FROM Users WHERE id = '".$loadprofile."'");
    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
   
	$name = $row['name'];
	$sex= $row['sex'];
	$location = $row['location'];
	$join = date('d / m / Y', strtotime($row['date_joined']));
	$dob = $row['dob'];
	$email = $row['email'];
	$privacy = $row['privacy'];
	$date1 = new Datetime("now");
	$date2 = new DateTime($dob);
	$interval = $date1->diff($date2);
	
    $age =  "" . $interval->y. " years old";
     
     
     if($loadprofile != $_SESSION['id']){
     	if($loadprofile < $_SESSION['id']){
     		$smaller = $loadprofile;
     		$bigger = $_SESSION['id'];
     	}
     	else{
     		$smaller = $_SESSION['id'];
     		$bigger = $loadprofile;
     	}
     
    $s = mysqli_query($dbc,"SELECT * FROM Relationships WHERE user_1 = '".$smaller."' AND user_2 = '".$bigger."'");
    if($s->num_rows ==0){
    $status = "";
    echo '<button id="add" style="margin-bottom:20px;" class = "btn-lg btn-primary" role="button">Add Friend</button>';
    }
    else{
    	$row2 = mysqli_fetch_array($s,MYSQLI_ASSOC);
		$status = $row2['status'];
		$last_action = $row2['last_action'];
		if($status == "accepted"){
		echo '<h4 style="color:green"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Friends</h4>';
		}
    	else if($status == "pending"){
    	echo '<h4 style="color:orange"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Friend Request Pending</h4>';
    	}
    	else if($status == "blocked"){
    	echo '<h4 style="color:red"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Blocked</h4>';
    	}
    	
    	}   
    	 ?>
        
        
        <?php 
        $arrs = array();
        $arrb = array();
        $lists =  mysqli_query($dbc,"SELECT * FROM Relationships WHERE ((user_1 = '".$smaller."' OR user_2 = '".$smaller."')  AND status = 'accepted')");
        $listb =  mysqli_query($dbc,"SELECT * FROM Relationships WHERE ((user_1 = '".$bigger."' OR user_2 = '".$bigger."') AND status = 'accepted')");
         while($rowsm = mysqli_fetch_array($lists,MYSQLI_ASSOC)){
         if($rowsm["user_1"]!=$bigger || $rowsm["user_2"]!=$bigger){
		 	if($rowsm["user_1"] != $smaller){
		 	
		 		array_push($arrs,$rowsm["user_1"]);
		 	}
		 	else{
		 		array_push($arrs,$rowsm["user_2"]);
		 		}
		 	}
		 }
		while($rowbi = mysqli_fetch_array($listb,MYSQLI_ASSOC)){
         if($rowbi["user_1"]!=$smaller || $rowbi["user_2"]!=$smaller){
		 	if($rowbi["user_1"] != $bigger){
		 	
		 		array_push($arrb,$rowbi["user_1"]);
		 	}
		 	else{
		 		array_push($arrb,$rowbi["user_2"]);
		 		}
		 	}
		 }
		 $mfriends = array_intersect($arrb,$arrs);
		$mutual = sizeof($mfriends);
        }
        if(!(($loadprofile == $_SESSION['id'])||$privacy==3||$status=="accepted"||($privacy==2 && $mutual>0))){
         echo "<h3>$name</h3>";
         if($status=="pending"){
         echo"<p>If $name accepts your friend request, you will be able to see their full profile.</p>";
         }
        else{
        echo "<p>Add $name as a friend to view full profile.</p>";
        }
        }
        else{
       
	
	?>
 

		
         <h3><?php echo $name; ?></h3>
        <p>Lives in <?php echo $location; ?></p>
        <p>Gender <?php echo $sex; ?></p>
        <p>Joined <?php echo $join; ?></p>
        <p>Age <?php echo $age; ?></p>
     
      </div>
      
<style>
.feed {
    display: none;
}
.activejumbo {
    display: block;
    background-color:white;
}


</style>
<script>
$('#f1').click(function(){
$('#feedmenu').find(".active").removeClass("active");
$("#sn").find(".activejumbo").removeClass("activejumbo");
$('#feedmenu').find("#p").addClass("active");
$("#sn").find("#fphotos").addClass("activejumbo");
});
$('#f2').click(function(){
$('#feedmenu').find(".active").removeClass("active");
$("#sn").find(".activejumbo").removeClass("activejumbo");
$('#feedmenu').find("#b").addClass("active");
$("#sn").find("#fblog").addClass("activejumbo");
});
$('#f3').click(function(){
$('#feedmenu').find(".active").removeClass("active");
$("#sn").find(".activejumbo").removeClass("activejumbo");
$('#feedmenu').find("#c").addClass("active");
$("#sn").find("#fcircles").addClass("activejumbo");
});
     
</script>    
    
      <div class="jumbotron col-md-6 activejumbo feed" id="fphotos">
      Photos
 
      <!--Put photos stuff here-->
      
      
         
      
      </div>
      
      
       <div class="jumbotron col-md-6 feed" id="fblog">
       Blog Posts:
       
       
       <!--Put blog stuff here-->

        <?php 
       $user_id = $loadprofile;
  $query = "SELECT * FROM posts WHERE user_id='".$user_id."' ORDER BY id DESC";
  $posts = mysqli_query($dbc, $query);
  echo $posts->num_rows;
?>
       
    <div class="containter">
      <header>
        <?php if($_SESSION['id'] == $loadprofile){?>
        <h1>My Blog</h1>
        <?php } ?>
      </header>
      <div class = "row" id="posts">
        <ul>
          <?php while($row = mysqli_fetch_array($posts,MYSQLI_ASSOC)) : ?>
            <li class="post">
              <span><?php echo $row['title'] ?></span>
              <span><?php echo $row['date'] ?></span>
              <?php echo $row['content'] ?>
            </li>
<?php if($_SESSION['id'] == $loadprofile){?>
            <form method="post" action="delete_entry.php">
             <input type="hidden" name="post_id" value="<?php echo $row['id']?>" />
          <input id="show-btn" type="submit" name="submit" value="Delete"/>
        </form>
      <?php } ?>
          <?php endwhile; ?>
        </ul>
      </div>
      
     
    </div>
    <?php if($_SESSION['id'] == $loadprofile){?>
 <div id="post-form" class="row">
        <!-- If there was an error in the previous input data, display a message. -->
        <?php if (isset($_GET['error'])) : ?>
          <div class="error"><?php echo $_GET['error']; ?></div>
        <?php endif; ?>
        <!-- make a post form and submit it to process.php -->
        <form method="post" action="post_entry.php">
          <input type="text" id="title" name="title" placeholder="Title"/>
          <!-- <input type="text" id="content" name="content" placeholder="Enter Content"/> -->

          <textarea rows="5" cols="50" id="content" name="content" placeholder="Enter Content"></textarea>
<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']?>"/>
          <input id="show-btn" type="submit" name="submit" value="Post"/>
        </form>

  
      </div>

           <?php } ?>  
       
      </div>
      
      
       <div class="jumbotron col-md-6 feed" id="fcircles">
        Circles
        <?php
        $r = mysqli_query($dbc,"SELECT * FROM circles WHERE id IN ( SELECT circleID from circlemembership where userID = '".$loadprofile."')");
        while($row_data = mysqli_fetch_array($r,MYSQLI_ASSOC))
        {
         $circleid = $row_data['id'];
         $name = $row_data['name'];
          echo "<a href='circles/$circleid'><div class='circle'>$name</div></a>";        
        }
       ?>
       
       
         <!--Put circles stuff here-->
       
       
       
      </div>
      
      
   <?php
   $t = mysqli_query($dbc,"SELECT * FROM Relationships WHERE (user_1 = '".$loadprofile."' OR user_2 = '".$loadprofile."') AND status = 'accepted'");
   //echo $t->num_rows;
   $u = mysqli_query($dbc,"SELECT * FROM Relationships WHERE (user_1 = '".$_SESSION['id']."' OR user_2 = '".$_SESSION['id']."') AND status = 'pending' AND last_action != '".$_SESSION['id']."'");
  //echo $u->num_rows;
  
  
  
  $reclist = array();
		$checklist = array();
		$mq = mysqli_query($dbc,"SELECT id FROM Users WHERE location = '".$location."' AND id != '".$_SESSION['id']."'");
		$x  = mysqli_query($dbc,"SELECT * FROM Relationships WHERE (user_1 = '".$loadprofile."' OR user_2 = '".$loadprofile."')");
		 while($rowcheck = mysqli_fetch_array($x,MYSQLI_ASSOC)){
		 	if($rowcheck["user_1"] == $loadprofile){
		 		array_push($reclist,$rowcheck["user_2"]);
		 	}
		 	else{
		 			array_push($reclist,$rowcheck["user_1"]);
		 	}
		 }

		 while(($rowm = mysqli_fetch_array($mq,MYSQLI_ASSOC))){
		 array_push($checklist,$rowm["id"]);
		 
		 }
		 $publist = array_diff($checklist,$reclist);
  
  
  
  
  if($t->num_rows >0||sizeof($publist)||($loadprofile == $_SESSION['id'] && $u->num_rows >0)){
   ?>
    
      <div class="jumbotron col-md-3" style="padding:10px 20px;" id="friends">
      <?php if( $loadprofile == $_SESSION['id']){
      if($u->num_rows >0){
      echo "<h4>Pending Friend Requests</h4>";
     
	
		 while($row5 = mysqli_fetch_array($u,MYSQLI_ASSOC)){
		 	if($row5["user_1"] == $_SESSION['id']){
		 		$pendinglist = $row5["user_2"];
		 	}
		 	else{
		 		$pendinglist = $row5["user_1"];
		 	}
		
		 	$p = mysqli_query($dbc,"SELECT name FROM Users WHERE id = '".$pendinglist."'");
		 	$row6 = mysqli_fetch_array($p,MYSQLI_ASSOC);
		 	$pendingnamelist = $row6['name'];
		 	echo '<div class="btn-group-xs text-right"  role="group" aria-label="..."><a href="profile.php?fid='.$pendinglist.'">'.$pendingnamelist.'</a><button style="margin-left:20px;"class = "btn btn-success accept" value = "'.$pendinglist.'" role="button">Accept</button><button  value = "'.$pendinglist.'"  class = "btn btn-danger decline" role="button">Decline</button></div>';
		 	echo "<br><br>";
		 	
		 }
		}
		
		if(sizeof($publist)>0){
		echo "<h4>Recommended users to Friend</h4>";
		 
		 	
		
		 	 foreach($publist as $item){
		 	 $pname = mysqli_query($dbc,"SELECT name FROM Users WHERE id = '".$item."'");
		 	 $namerow = mysqli_fetch_array($pname,MYSQLI_ASSOC);
		 	echo '<a href="profile.php?fid='.$item.'"> '.$namerow['name'].'</a><br>';
		 	
		 }
		}
}

    if($t->num_rows >0){
 ?> 
    
      <h4>Friends  <span style="font-weight:200"> <?php if(isset($mutual)){if($mutual>0){ if($loadprofile != $_SESSION['id']){
      echo "($mutual mutual";  if($mutual>1){echo "friends)";}else{echo " friend)";}}}}?></span></h4>
      <?php
	
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
		 	echo '<a href="profile.php?fid='.$friendlist.'"> '.$namelist.'</a><br>';
		 	
		 		 	
		 }
    }
    

 ?>    
      </div>
<?php } 
   }//end

  $j = mysqli_query($dbc,"SELECT * FROM Users WHERE id = '".$_SESSION['id']."'");
    $rowp = mysqli_fetch_array($j,MYSQLI_ASSOC);
   
	$namep = $rowp['name'];
	$sexp= $rowp['sex'];
	$locationp = $rowp['location'];
	$emailp = $rowp['email'];
	//$join = date('d / m / Y', strtotime($row['date_joined']));
	//$dob = $row['dob'];
	$privacyp = $rowp['privacy'];
	//$date1 = new Datetime("now");
	//$date2 = new DateTime($dob);
	//$interval = $date1->diff($date2);




?>
    </div> <!-- /container -->

    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<div class="modal fade" id="editinfo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
            Edit Profile Information
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="form" method="POST" class="form-horizontal" role="form">
                         <div class="form-group">
                        <div class="col-sm-12">
                                       <div class="input-group">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input id="name" name="name" data-validation="length" data-validation-length="min4" class="form-control required" type="text" size="16" value="<?php echo $namep; ?>" autofocus="autofocus" required/>
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
                            <div class="col-sm-12">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input id="email" name="email" data-validation="email" class="form-control email" type="email" size="16" value="<?php echo $emailp; ?>" required/>
                            </div>
                        </div>
                    </div>
                    <h3 id="errormessage" style="color:red" class="payment-errors text-center"></h3>
          
                
                </form>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
<script>$.validate();</script>
            <div class="modal-footer">
            
                <button id="submitedit" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group"
                           data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>"
                           data-success-text="<span class='glyphicon glyphicon-ok'></span>"
                >
                    Save
                </button>
                
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
                setTimeout(function() {
                $('#editinfo').modal('hide');
            }, 350);
                                }
                            }
                            
      
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.

});
</script>
           </div>
          
            </div>
        </div>
        </div>
        </div>
<div class="modal fade" id="changepassword">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
            Change Password
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="passform" method="POST" class="form-horizontal" role="form">
                
                         <div class="form-group">
                            <div class="col-sm-12">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="oldpassword" name="oldpassword" class="form-control" type="password" size="16" placeholder="Current Password" required/>
                            </div>
                        </div>
                    </div>    
                       <div class="form-group">
                            <div class="col-sm-12">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="newpassword" name="newpassword" class="form-control" type="password" size="16" placeholder="New Password" required/>
                            </div>
                        </div>
                    </div>                       
                    
                    <h3 id="errormessage" style="color:red" class="pass-errors text-center"></h3>
          
                
                </form>


<script>$.validate();</script>
            <div class="modal-footer">
            
                <button id="passsubmit" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group"
                           data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>"
                           data-success-text="<span class='glyphicon glyphicon-ok'></span>"
                >
                    Save
                </button>
                
                
                <script>
          var $btn = $('#passsubmit');
       $btn.on('click', function(e) {   
       //$btn.prop('disabled', true);
//$btn.button('progress');
  
    $.ajax({
           type: "POST",
           url: "password.php",
           data: $("#passform").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.oldpass) { //Returned if any error from process.php
                                    $('.pass-errors').fadeIn(1000).html(data.errors.oldpass); //Throw relevant error
                                }
                                else if (data.errors.newpass) { //Returned if any error from process.php
                                    $('.pass-errors').fadeIn(1000).html(data.errors.newpass); //Throw relevant error
                                }
                                else if (data.errors.verification) { //Returned if any error from process.php
                                    $('.pass-errors').fadeIn(1000).html(data.errors.verification); //Throw relevant error
                                }
                            }
                            else {
                                    $('.pass-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                setTimeout(function() {
                $('#changepassword').modal('hide');
            }, 350);
                                }
                            }
                            
      
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.

});
</script>
                </div>
          
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
            NOTE: Deleting your account is irreversible!
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
            	<p class="text-center">Are you sure you want to delete your account?</p>
                <form id="form" method="POST" action="delete.php" class="form-horizontal text-center" role="form">
                
                       
                    
           <button id="delete" type="submit" class="btn btn-danger"
                         
                >
                   Delete Account
           </button>
                
                </form>


        
          
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="visibility">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
            Who can see your profile?
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="privacyform" method="POST" class="form-horizontal" role="form">
                
                         <div class="form-group">
                            <div class="col-xs-12">
                         
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
       
                                <select class="form-control" name ="privacy" id="privacy" required>
  								<option value ="3" <?php if($privacyp==3){echo 'selected';}?>>Everyone</option>
  								<option value="2" <?php if($privacyp==2){echo 'selected';}?>>Friends of Friends</option>
  								<option value ="1" <?php if($privacyp==1){echo 'selected';}?>>Friends Only</option>
								</select>
								</div>
                      
                        </div>
                        </div>                   
                    
                    <h3 id="errormessage" style="color:red" class="privacy-errors text-center"></h3>
          
                
                </form>


            <div class="modal-footer">
            
                <button id="privacysubmit" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group"
                
                >
                    Save
                </button>
                
                       <script>
          var $btn = $('#privacysubmit');
       $btn.on('click', function(e) {   
       //$btn.prop('disabled', true);
//$btn.button('progress');
  
    $.ajax({
           type: "POST",
           url: "privacy.php",
           data: $("#privacyform").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.oldpass) { //Returned if any error from process.php
                                    $('.privacy-errors').fadeIn(1000).html(data.errors.privacy); //Throw relevant error
                                }
                              
                            }
                            else {
                                    $('.privacy-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                setTimeout(function() {
                $('#visibility').modal('hide');
            }, 350);
                                }
                                 setTimeout(function() {
                     $('.privacy-errors').empty();
            }, 350);
           
                            }
                            
      
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.

});
</script>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createcircle">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header text-center">
            Create Circle
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      <div class="modal-body">
        <form id="createCircleform" method="POST" class="form-horizontal" role="form">
          <div class="form-group">
            <div class="col-sm-12">
              <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-circle-o"></span></span>   
                <input id="name" name="name" data-validation="length" data-validation-length="min1" class="form-control required" type="text" size="16" placeholder="Circle Name" autofocus="autofocus" required/>
              </div>
            </div>
          </div>              
          <h3 id="errormessage" style="color:red" class="payment-errors text-center"></h3>      
        </form>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
        <script>$.validate();</script>
        <div class="modal-footer">
          <button id="submitcircle" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group" data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>" data-success-text="<span class='glyphicon glyphicon-ok'></span>" >Save </button>
          <script>
            var $btn = $('#submitcircle');
            $btn.on('click', function(e) {   
            $.ajax({
              type: "POST",
              url: "createCircle.php",
              data: $("#createCircleform").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.name) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.name); //Throw relevant error
                                }
                            }
                            else {
                                    $('.payment-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                setTimeout(function() {
                $('#createcircle').modal('hide');
            }, 350);
                                }
                            }
        });
    e.preventDefault(); // avoid to execute the actual submit of the form.
});
</script>
        </div>
      </div>
    </div>
  </div>
</div>
	    

        <div class="modal fade" id="addNewPost">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header text-center">
            Add New Post
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      <div class="modal-body">
        <form id="newPostForm" class="form-horizontal" role="form">
          <div class="form-group">
            <div class="col-sm-12">
              <div class="input-group">
                <input id="title" name="title" data-validation="length" data-validation-length="min1" class="form-control required" type="text" size="16" placeholder="Title" autofocus="autofocus" required/>
                 <textarea id="content" name="content" data-validation="length" data-validation-length="min1" class="form-control required" type="text" size="16" placeholder="Content" autofocus="autofocus" required></textarea>
                 <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']?>"/>
              </div>
            </div>
          </div>              
          <h3  style="color:red" class="blog-errors text-center"></h3> 
          <!--<input id="show-btn" type="submit" name="submit" value="Post"/>    --> 
        </form>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
        <script>$.validate();</script>
        <div class="modal-footer">
          <button id="submitpost" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group" data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>" data-success-text="<span class='glyphicon glyphicon-ok'></span>">Post</button>
          <script>
            var $btn = $('#submitpost');
            $btn.on('click', function(e) {   
            $.ajax({
              type: "POST",
              url: "post_entry.php",
              data: $('#newPostForm').serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.notitle) { //Returned if any error from process.php
                                    $('.blog-errors').fadeIn(1000).html(data.errors.notitle); //Throw relevant error
                                }
                                if (data.errors.failed) { //Returned if any error from process.php
                                    $('.blog-errors').fadeIn(1000).html(data.errors.failed); //Throw relevant error
                                }
                            }
                            else {
                                    $('.blog-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                                     setTimeout(function() {
                $('#addNewPost').modal('hide');
            }, 350);
    $("#fblog").load(location.href+" #fblog>*","").addClass("activejumbo");


                                }
                            }
        });
    e.preventDefault(); // avoid to execute the actual submit of the form.
});
</script>
        </div>
      </div>
    </div>
  </div>
</div>

	    
  </body>
</html>
<?php

}
?>
