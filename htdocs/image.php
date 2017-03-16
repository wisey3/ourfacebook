<?php
require_once('db_connect.php');   
require_once('tablecheck.php');
$photoId = $_POST['photoId'];
$user = $_POST['user']; //user = $loadprofile;
$albumId = $_POST['album'];

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div id="hey" align="center">
    <a class="backButton" id="toPhotos" name="<?php echo $albumId?>"><div style="position:absolute; left:10px; top:-1px; padding:4px;"><img style="height:30px; opacity:0.5;" src="icons/backarrow.png"/></div></a>
        <br>

        <!-- image  -->
        <div id="imageBox">
            
                <?php 

                $quer = "SELECT * FROM photo WHERE photoID = '".$photoId."'";
                $photo = mysqli_query($dbc,$quer);
                $row = mysqli_fetch_array($photo);

                $photoName = $row['refLoc'];

                list($width,$height) = getimagesize(''.$photoName.'');


                if($width>$height){
                    echo "<img id='mainImage' style='width:520px; image-orientation: 0deg;' src='".$photoName."'>";
                }
                else{
                    echo "<img id='mainImage' style='height:470px; image-orientation: 0deg;' src='".$photoName."'>";
                }

                ?>                                 
        </div>
        <div id="commentHolder" style="border:solid; border-color:lightgrey; background-color: white; position: relative; padding:10px;  width:540px; height:300px; top:-10px; left:-19px;"> <!---->
            <div id="commentScroll" style="overflow:scroll; position:absolute; text-align: left; height: 225px; width:520px;"> <!---->
            <?php                     

                $quer = "SELECT * FROM comment WHERE photoID = '".$photoId."'";
                $comments = mysqli_query($dbc,$quer);
                echo'<ul style="list-style-type: none; position:relative; left:-30px;" id="responds">';

                while($row = mysqli_fetch_array($comments)){
                    //$albumId = $row['albumID'];
                    $user = $row['userID'];

                    $quer = "SELECT * FROM Users WHERE id = '".$user."'";
                    $res = mysqli_query($dbc,$quer);
                    $result = mysqli_fetch_array($res);

                    $userName = $result['name'];
                    
                    echo'<li>'.$row['content'].'</li>'; 
                    echo"<li style='font-size:10px;'><i>".$userName." ".$row['date']."</i></li>";
                    echo '<br>';
                }
                echo "</li>";

            ?>
            
            </div>
            <?php

                echo '<div id="commentBox" style="position: absolute; bottom: 10px;">';
                echo '<textarea name="content_txt" id="contentText" cols="57" rows="1" placeholder="Leave a comment..."></textarea>';
                echo '<button style="position:absolute; right:-90px; " class="FormSubmit" id='.$photoId.'>Comment</button>';
                echo '</div';
            ?>
            
        </div>
    </div>
</body>
</html>