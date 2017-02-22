<?php
require_once('db_connect.php');
session_start();
$user = 1; //use this as a test
//$name = mysql_real_escape_string('2013');

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
	    <div style="background-color:whitesmoke; padding: 30px; position:absolute; left:12vw; width:980px;">
	    	<div><h1><strong>Collections page</strong></h1></div>
	    	<br>

    		<div id="collectionGrid" style="background-color:white; width:920px;">
    			<div>
    			<?php
					//$albumNo = $dbc->query("SELECT * FROM album WHERE userID = '".$user."'");
    				$quer = "SELECT * FROM album WHERE userID = '".$user."'";
					$albumNo = mysqli_query($dbc,$quer);
					//$result = $db->query("SELECT * FROM photo");

					//displays all the collections associated with that user
					/*while($row = mysql_fetch_array($albumNo,MYSQLI_ASSOC)){
						//echo'<form action="photos.html"><input type="submit" value=image id="1" /></form>';
						echo '<a href="photos.html">Image will go here</a>';
						//maybe make this into a button
					}*/

					$maxcols = 5;
					$i = 0;

					//Open the table and its first row
					echo "<table>";
					echo "<tr>";
					while ($album = mysqli_fetch_array($albumNo)) {

					    if ($i == $maxcols) {
					        $i = 0;
					        echo "</tr><tr>";
					    }

					    $name = $album['albumName'];

					    echo "<td><a href='photo.php?name=".$name."&user=".$user."&num=".$album['albumID']."' style='color:black;'>
					    		<div style='margin:7px; width:170px; height:170px; background-color:dodgerblue; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); float:left;'>";
					    echo "<p style='font-size:30px; text-align: center; position: relative; top: 50%; transform: translateY(-50%); color:powderblue;'>".$name."</p>";
					    echo "</div></a></td>";

					    //echo "<td>".$name."</td>";

					    //echo "<td><a href='photo.php?name=".$name."&user=".$user."'>".$name."</a></td><br>";
					    //echo "<td><a href='photo.php?name=".$name."&user=".$user.">".$name."</a></td><br>";
					    //echo "<td><img src=\"" . $image['src'] . "\" /></td>";

					    $i++;
					}

					//add collection pop-up

					if($i==5){
						//close the table
						echo "</tr>";
						echo "</table>";

						//add collection square
						echo "<td><a href='popup.php?type=Collection&user=".$user."' style='color:black;'>
					    		<div style='margin:7px; width:170px; height:170px; background-color:lightgrey; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); float:left;'>";
			    		//echo "<img src='plus.png'/>";
					    echo "<p style='font-size:30px; text-align: center; position: relative; top: 50%; transform: translateY(-50%); color:grey;'>ADD</p>";
					    echo "</div></a></td>";
					}
					else{
						//add collection square
						echo "<td><a href='popup.php?type=Collection&user=".$user."' style='color:black;'>
					    		<div style='margin:7px; width:170px; height:170px; background-color:lightgrey; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); float:left;'>";
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



	<br>



	<!--<?php
	//$sql = "INSERT INTO album VALUES('3','$name','$user','CURRENT_TIMESTAMP')";
	//$result = $db->query($sql);
	?>-->

	


	</body>
</html>

<!--<form action="photos.html?id=1">
    <input type="submit" value="Album1" id="1" />
</form>

<form action="photos.html?id=2">
    <input type="submit" value="Album2" id="2" />
</form>

<form action="photos.html?id=3">
    <input type="submit" value="Album3" id="3" />
</form>-->