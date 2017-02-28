<?php
require_once('db_connect.php');
require_once('tablecheck.php');
session_start();
$user = $_GET['user'];
$name = $_GET['name'];
$albumId = $_GET['num'];


//$name = mysql_real_escape_string($_GET['name']);

//$name = get the name from the previous thing :) //this is important!!! name of the album
?>

<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <link rel="icon" href="../../favicon.ico">

	    <title><?php echo $name?></title>


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
	    <div>
	    <a href="collection.php" style="display: inline; float:left;"><img src="icons/backarrow.png" height="50px" /></a>
	    </div>
	    <div style="background-color:whitesmoke; padding: 30px; position:absolute; left:12vw; width:980px;">
	    	<div style="display: inline-block;">
	    	<h1 style="display: inline;"><strong><?php echo $name?></strong></h1>
	    	</div>
	    	<br>
	    	<br>

    		<div id="collectionGrid" style="background-color:white; width:920px;">
    			<div>
    			<?php
    				$quer = "SELECT * FROM photo WHERE albumID = (SELECT albumId FROM album WHERE albumName = '".$name."')";
					$photos = mysqli_query($dbc,$quer);
					

					$maxcols = 5;
					$i = 0;

					//Open the table and its first row
					echo "<table>";
					echo "<tr>";
					while ($image = mysqli_fetch_array($photos)) {

					    if ($i == $maxcols) {
					        $i = 0;
					        echo "</tr><tr>";
					    }

					    $photoNum = $image['photoID'];
					    $photoName = mysql_real_escape_string($image['refLoc']);

					    echo "<td>";
					    //main box
					    echo "<div style='position:relative;'>"; 

					    	echo "<a href='deleteimage.php?type=Photo&photoID=".$photoNum."'>";
							    echo "<div style='background-color:white; margin:6px; height:30px; width:30px; opacity:0.5; right:0; position:absolute; z-index:100;'>";
							    	//image
							    	echo "<img src='icons/close.png' style='height:30px; ' />";
							    echo "</div>";
						    echo "</a>";
					    	//image button
					    	echo "<div style='margin:7px; width:170px; height:170px; background-color:skyblue; float:left; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); overflow:hidden;'>";

						    list($width,$height) = getimagesize(''.$photoName.'');
						    if($width>$height){
	                            echo "<a href='image.php?photoid=".$photoNum."&photoname=".$photoName."&user=".$user."'><img src='".$photoName."' height='170px'></a>"; //align center vertically
	                        }
	                        else{
	                            echo "<a href='image.php?photoid=".$photoNum."&photoname=".$photoName."&user=".$user."'><img src='".$photoName."' width='170px'></a>"; //align center horizontally
	                        }
			    		
					    	echo "</div>";
					    echo "</td>";

					    $i++;
					}

					if($i==5){
						//close the table
						echo "</tr>";
						echo "</table>";

						//add photo square
						echo "<td><a href='popup.php?type=Photo&album=".$albumId."&user=".$user."' style='color:black;'>
					    		<div style='margin:7px; width:170px; height:170px; background-color:lightgrey; float:left; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);'>";
			    		//echo "<img src='plus.png'/>";
					    echo "<p style='font-size:30px; text-align: center; position: relative; top: 50%; transform: translateY(-50%); color:grey;'>ADD</p>";
					    echo "</div></a></td>";
					}
					else{
						//add photo square
						echo "<td><a href='popup.php?type=Photo&album=".$albumId."&user=".$user."' style='color:black;'>
					    		<div style='margin:7px; width:170px; height:170px; background-color:lightgrey; float:left; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);'>";
			    		//echo "<img src='plus.png'/>";
					    echo "<p style='font-size:30px; text-align: center; position: relative; top: 50%; transform: translateY(-50%); color:grey;'>ADD</p>";
					    echo "</div></a></td>";

					    //Add empty <td>'s to even up the amount of cells in a row:
						while ($i <= $maxcols) {
						    echo "<td>&nbsp;</td>";
						    $i++;
						}

						//close the table
						echo "</tr>";
						echo "</table>";
					}

					
				?>
    			</div>
    		</div>
    		<br>    		
		</div>

<!--adding a image-->

<!-- <form action="upload.php" method="post" enctype="multipart/form-data">
	<input type="file" name="img" id="img">
	<input type="hidden" name="album" id="id" value="<?php //echo '$albumId'?>";>
	<input type="submit" value="Add Image" name="submit">
</form> -->

<!--If the photo table is empty, then reset the count to be 0.-->

</body>
</html>


