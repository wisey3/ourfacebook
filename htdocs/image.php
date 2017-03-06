<?php
require_once('db_connect.php');   
require_once('tablecheck.php');
// $photoName = 
$photoId = $_POST['photoId'];
// echo 'photo id is here sir '.$photoId;
$user = $_POST['user']; //user = $loadprofile;
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<!-- <div class="yo">whats up</div> -->
	<div id="hey" align="center">
    <a class="backButton" id="toPhotos"><div style="position:absolute; left:-3px; top:-1px; padding:4px;"><img style="height:30px; opacity:0.5;" src="icons/backarrow.png"/></div></a>
        <br>

        <!-- image  -->
        <div style="position:relative; background-color: white; z-index:2; width:550px; height:500px; top:-20px; left:-20px; padding:7px; padding-top:10px;"> 
            <!--<div style=" border:solid; display: block; z-index:2; position: absolute; top:50%; margin-left: auto; margin-right: auto;">-->
            
                <?php 

                $quer = "SELECT * FROM photo WHERE photoID = '".$photoId."'";
                $photo = mysqli_query($dbc,$quer);
                $row = mysqli_fetch_array($photo);

                $photoName = $row['refLoc'];

                // echo 'reference '.$photoName.' has that worked?';

                list($width,$height) = getimagesize(''.$photoName.'');


                if($width>$height){
                    //$buffer = (500 - $height)/4;
                    echo "<img src='".$photoName."' style='position:absolute; width:520px; top:50%; left:50%; transform:translate(-50%,-50%); box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);'>"; //align center vertically
                }
                else{
                    echo "<img src='".$photoName."' style='position:absolute; height:470px; left:50%; margin-right:-50%; transform:translateX(-50%);  text-align:center; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);'>"; //align center horizontally
                }

                ?>                                 
        </div>
        <div style="border:solid; border-color:lightgrey; background-color: white; position: relative; padding:10px;  width:540px; height:350px; top:-10px; left:-19px;">
            <div style="overflow:scroll; position:absolute; text-align: left; height: 275px; width:520px;">
            <?php                     

                $quer = "SELECT * FROM comment WHERE photoID = '".$photoId."'";
                $comments = mysqli_query($dbc,$quer);
                echo'<ul style="list-style-type: none; position:relative; left:-30px;" id="responds">';

                while($row = mysqli_fetch_array($comments)){
                    $albumId = $row['albumID'];
                    $user = $row['userID'];

                    $quer = "SELECT * FROM Users WHERE id = '".$user."'";
                    $res = mysqli_query($dbc,$quer);
                    $result = mysqli_fetch_array($res);

                    $userName = $result['name'];
                    
                    // echo"<tr>";
                    // echo '<div style="background-color:lightgrey; ">';
                    // echo'<p>'.$row['content'].'</p>'; 
                    echo'<li>'.$row['content'].'</li>'; 
                    // echo"</tr>";
                    //echo"<p style='font-size:10px;'>".$row['date']."</p>";
                    echo"<li style='font-size:10px;'><i>".$userName." ".$row['date']."</i></li>";
                    echo '<br>';
                    

                    //echo '</div>';
                }
                echo "</li>";

            ?>
            </div>
            <?php

                echo '<div id="commentBox" style="position: absolute; bottom: 10px;">';
                echo '<textarea name="content_txt" id="contentText" cols="60" rows="1" placeholder="Enter some text"></textarea>';
                echo '<button style="position:absolute; right:-90px; " class="FormSubmit" id='.$photoId.'>Comment</button>';
                echo '</div';
            ?>
            
        </div>
    </div>
</body>
</html>