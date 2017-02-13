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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


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
            <li ><a href="index.php">Home</a></li>
            <li <?php if($_SESSION['id'] == $loadprofile){?>class="active"<?php }?>><a href="profile.php">My Profile</a></li>
            <li><a href="#contact">Privacy</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li class="dropdown-header">Profile</li>
                <li><a href="#">Edit Profile</a></li>
                <li><a href="#">Change Email/Password</a></li>
                <li><a href="#">Blog Settings</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Privacy</li>
                <li><a href="#">Blocking</a></li>
                <li><a href="#">Photos</a></li>
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
            <li id="b"><a  href="#" id='f2'>Blog <span class="sr-only">(current)</span></a></li>
            <li id="c"><a href="#" id='f3'>Circles</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container" id="sn">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron col-md-3" style="padding:10px 20px;">
      
      <?php

    $r = mysqli_query($dbc,"SELECT * FROM Users WHERE id = '".$loadprofile."'");
    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
   
	$name = $row['name'];
	$sex= $row['sex'];
	$location = $row['location'];
	$join = date('d / m / Y', strtotime($row['date_joined']));
	$dob = $row['dob'];
	
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
	}
	?>
 
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
            $('#friends').load(document.URL +  ' #friends');
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
			 $('#friends').load(document.URL +  ' #friends');                 
			}
        });
        event.preventDefault(); //Prevent the default submit
    });
});

 </script>

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
     <!--Put photos stuff here-->
      <div class="jumbotron col-md-6 activejumbo feed" id="fphotos">
      Photos
 
      <!--Put photos stuff here-->
      
      
         
      
      </div>
      
      
       <div class="jumbotron col-md-6 feed" id="fblog">
       Blog
       
       
       <!--Put blog stuff here-->
       
       
      </div>
      
      
       <div class="jumbotron col-md-6 feed" id="fcircles">
       Circles
       
       
       
         <!--Put circles stuff here-->
       
       
       
      </div>
      
      
   <?php
   $t = mysqli_query($dbc,"SELECT * FROM Relationships WHERE (user_1 = '".$_SESSION['id']."' OR user_2 = '".$_SESSION['id']."') AND status = 'accepted'");
   //echo $t->num_rows;
   $u = mysqli_query($dbc,"SELECT * FROM Relationships WHERE (user_1 = '".$_SESSION['id']."' OR user_2 = '".$_SESSION['id']."') AND status = 'pending' AND last_action != '".$_SESSION['id']."'");
  //echo $u->num_rows;
   if($loadprofile == $_SESSION['id'] && ($t->num_rows >0 || $u->num_rows >0)){
   ?>
      <div class="jumbotron col-md-3" style="padding:10px 20px;" id="friends">
      <?php if($u->num_rows >0){ ?>
      <h4>Pending Friend Requests</h4>
      <?php
	
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
		 	echo '<div class="btn-group-xs text-right"  role="group" aria-label="..."> '.$pendingnamelist.'<button style="margin-left:20px;"class = "btn btn-success accept" value = "'.$pendinglist.'" role="button">Accept</button><button  value = "'.$pendinglist.'"  class = "btn btn-danger decline" role="button">Decline</button></div>';
		 	echo "<br><br>";
		 	
		 }
		 	
}
    if($t->num_rows >0){
 ?> 
      
      <h4>Friends</h4>
      <?php
	
		 while($row3 = mysqli_fetch_array($t,MYSQLI_ASSOC)){
		 	if($row3["user_1"] == $_SESSION['id']){
		 		$friendlist = $row3["user_2"];
		 	}
		 	else{
		 		$friendlist = $row3["user_1"];
		 	}
	
		 	$n = mysqli_query($dbc,"SELECT name FROM Users WHERE id = '".$friendlist."'");
		 	$row4 = mysqli_fetch_array($n,MYSQLI_ASSOC);
		 	$namelist = $row4['name'];
		 	echo "$namelist";
		 	echo "<br>";
		 		 	
		 }
  }   
 ?>    
      </div>
<?php } ?>
    </div> <!-- /container -->

    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

  </body>
</html>
<?php

}
?>
