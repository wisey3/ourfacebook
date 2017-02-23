<?php
require_once('db_connect.php');
session_start();
$photoId = $_GET['photoid']; //get the id of thr photo you selecetd
$photoName = $_GET['photoname'];
$user = $_GET['user'];

$sql = "SELECT * FROM album WHERE albumID = (SELECT albumID FROM photo WHERE photoID = ".$photoId.")";
$res = mysqli_query($dbc,$sql);
$album = mysqli_fetch_array($res);   

$albumId = $album['albumID'];
$albumName = $album['albumName'];

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../../favicon.ico">

        <title>Image</title>


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
        <a href="photo.php?name=<?php echo $albumName?>&user=<?php echo $user?>&num=<?php echo $albumId?>" style="display: inline; float:left;"><img src="icons/backarrow.png" height="50px" /></a>
        <!-- href='photo.php?name=".$albumName."&user=".$user."&num=".$album['albumID']." -->
        </div>
        <div align="center"> <!--for the main bulk of the page-->
            <div style="background-color: whitesmoke; padding:25px; height:400px; position:relative; top:20%; transform: translateY(20%); z-index:1;">
                <div style="position:relative; background-color: whitesmoke; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); border:solid; border-color: white; z-index:2; width:550px; height:500px; top:-70px; left:-250px; padding:7px;"> 
                    <!--<div style=" border:solid; display: block; z-index:2; position: absolute; top:50%; margin-left: auto; margin-right: auto;">-->
                        <?php 

                        list($width,$height) = getimagesize(''.$photoName.'');


                        if($width>$height){
                            //$buffer = (500 - $height)/4;
                            echo "<img src='".$photoName."' style='position:absolute; width:520px; top:50%; left:50%; transform:translate(-50%,-50%);'>"; //align center vertically
                        }
                        else{
                            echo "<img src='".$photoName."' style='position:absolute; height:470px; left:50%; margin-right:-50%; transform:translateX(-50%); padding-top:10px; text-align:center;'>"; //align center horizontally
                        }

                        ?>
                    
                    <!--     
                    </div> -->
                    <?php 
                    //echo "<img src='".$photoName.".png' style='z-index:2; width:400px; left:20%; top:-15%; position:absolute; border:solid; border-width:10px; border-color:whitesmoke; '>";   

                    
                    // echo 'image name: '.$photoName.'.';
                    // echo 'width: '.$width.'.';
                    // echo 'height: '.$height.'.';

                    // if($width>$height){
                    //     echo "<img src='".$photoName.".png' style='z-index:2; width:400px; left:20%; top:-15%; position:absolute; border:solid; border-width:10px; border-color:whitesmoke; '>";   
                    // }
                    // else{
                    //     echo "<img src='".$photoName.".png' style='z-index:2; height:400px; left:20%; top:-15%; position:absolute; border:solid; border-width:10px; border-color:whitesmoke; '>";   
                    // }

                    ?>              
                </div>

                <!--COmment boxes-->
                <div style="border:solid; background-color: whitesmoke; position: absolute; padding:10px;  width:35vw; height:350px; top:25px; left:700px;">
                    <div style="overflow:scroll; position:absolute; text-align: left; height: 275px; width:33vw;">
                    <?php               
                        //$result = $db->query("SELECT * FROM photo");

                        $quer = "SELECT * FROM comment WHERE photoID = '".$photoId."'";
                        $comments = mysqli_query($dbc,$quer);

                        while($row = mysqli_fetch_array($comments)){
                            echo'<table style="position:relative;">';
                            echo"<tr>";
                            // echo '<div style="background-color:lightgrey; ">';
                            // echo'<p>'.$row['content'].'</p>'; 
                            echo'<td>'.$row['content'].'</td>'; 
                            echo"</tr>";
                            //echo"<p style='font-size:10px;'>".$row['date']."</p>";
                            echo"<tr><td style='font-size:10px;'><i>".$row['date']."</i></td></tr>";
                            echo "</table><br>";

                            //echo '</div>';
                        }

                    ?>
                    </div>
                    <?php
                        echo '<div style="position: absolute; bottom: 10px;">';
                        echo '<form action="comment.php?photoid='.$photoId.'&user='.$user.'" id="addcomment" method="post">
                                    <input type="text" id="body" name="body" style="width:27vw;" required/>
                                    <input id="post" type="submit" value="Post"/>
                                </form> ';
                        echo '</div';
                    ?>
                    
                </div>
            </div>

        </div>

<!--add a comment-->
<br>
<!-- <form action="comment.php" method="post">
	<input type="text" name="commentBody"><br>
	<br>
	<input type="submit" name="submit" value="post">
</form>
 -->

<!--<div style="float:left;">
                    <?php //echo "<img src='".$photoName.".png' height='300px'>";?>
                </div>

                <div style="background-color:whitesmoke; padding-left: 500px; padding-top: 10px; padding-bottom: 10px;">
                    <div>
                    <?php               
                        //$result = $db->query("SELECT * FROM photo");

                        // $comments = $db->query("SELECT * FROM comment WHERE photoID = '".$photoId."'");

                        // while($row = $comments->fetchArray(SQLITE3_ASSOC)){
                        //     echo'<table  border="1">';
                        //     echo"<tr>";
                        //     echo'<td style="padding:5px;">'.$row['content'].'</td>'; 
                        //     echo"</tr></table>";
                        // }
                    ?>
                    </div> 
                    <br>
                    <form id="addcomment" method="post">
                        <input type="text" id="commentID" name="commentID" required/>
                        <button id="post" type="button">Post</button>
                    </form>  
                </div>   --> 

<script>
	var $btn = $('#post');
	$btn.on('click',function(e)){

		$.ajax({ //process the form
			type: "POST",
			url: "comment.php",
			data: $("#addcomment").serialize(),

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

<!-- <div style="position: absolute; bottom: 10px;">
                        <form action="comment.php?photoid=$photoID&user=$user" id="addcomment" method="post">
                            <input type="text" id="body" name="body" style='width:27vw;' required/>
                            <input id="post" type="submit" value="Add"/>
                        </form>  
                    </div> -->