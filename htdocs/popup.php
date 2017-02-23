<?php
require_once('db_connect.php');
session_start();
$user = 1; //use this as a test
//$name = mysql_real_escape_string('2013');
$type=$_GET['type'];
if($type=='Photo'){
	$album=$_GET['album'];
}

?>

<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="icon" href="../../favicon.ico">

	    <title>Collections</title>


	    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

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
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>
	    <div style="background-color: whitesmoke; border: solid; width:20%; height:210px; position:relative; left:40%; top:100px;">
	    	<h3 style="text-align: center;">Add a <?php echo ''.$type.'';?></h3>
	    	<div style="border:solid; opacity: 0.7;"></div>
	    	<br>
	    	<?php 
	    	if($type=='Collection'){
	    		echo '<form action="addcollection.php" id="addcol" method="post">
						<input style="margin-left: 40px;"type="text" id="albumName" name="albumName" placeholder="Collection Name" required/>
						<br>
						<input data-rel="back" style="margin-left:100px; position:absolute; bottom:30px;" id="addCollection" type="submit" value="Add">
					</form>';

					//<input style="margin-left: 40px;"type="text" id="access" name="access" placeholder="Accessibility&#42" required/>
				//echo '<br>';
				//echo '<p style=" position:absolute; bottom:0; margin-left: 25px; margin-right: 25px; font-size: 10px;"><i><sup>*</sup> M = just me, F = friends, FOF = friends of friends or enter circle name e.g. Spring</i></p>';
			}
			else{
				//$albumId = $_GET['album'];
				echo '<form action="upload.php?albumId='.$album.'" method="post" enctype="multipart/form-data">
						<input style="margin-left:40px;" type="file" name="img" id="img">
						<input type="hidden" name="album" id="id" value="<?php echo '.$album.'?>";>
						<input style="margin-left:100px; position:absolute; bottom:30px;" type="submit" value="Add" name="submit">
					</form>';
				echo '<br>';
			}
    		?>
		    
			
	    </div>



	<br>


	



	<!--shows a link for all the collections within the album table-->


	<!--<?php
	//$sql = "INSERT INTO album VALUES('3','$name','$user','CURRENT_TIMESTAMP')";
	//$result = $db->query($sql);
	?>-->

	<!--add a collection
	<form action="collection.php" method="post">
		Collection Name:<br>
		<input type="text" name="albumName"><br>
		<br>
		<input type="submit" name="submit" value="Add">

		<select style="margin-left: 55px;" name="access" id="access">
					<option value="default" selected disabled="">Select Accessibility</option>
					<option value="m">Just Me</option>
					<option value="f">Friends</option>
					<option value="fof">Friends of Friends</option>
					<option value="circle">Circle</option> -could either have a pop-up or have all the circles mentioned here->
				</select> 
	</form>-->

	



	<script>
		var $btn = $('#addCollection');
		$btn.on('click',function(e)){

			$.ajax({ //process the form
				type: "POST",
				url: "addcollection.php",
				data: $("#addcol").serialize(),

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
		}
	</script>


	</body>
</html>