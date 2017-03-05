<?php
require_once('db_connect.php');
session_start();

$target_dir = "uploads/"; //where you're uploading it to - need to create this new directory where uploads.php is
$target_file = $target_dir.basename($_FILES["img"]["name"]); //this is what the file will be called

$uploadOk = 1; //set var to check if upload complete
$imageFileType =  pathinfo($target_file,PATHINFO_EXTENSION); //get extension type

$currentUser = 1; // $loadprofile;

if(isset($_POST['album'])){
	$currentAlbum = $_POST['album'];
}
// else{
// 	$currentAlbum = 12;
// }

// echo 'user is '.$currentUser.' and my album no is '.$currentAlbum;

//check extension
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "JPG"){
	echo "Sorry, image file is not in the correct format.";
	$uploadOk = 0;
}

if($uploadOk == 0){
	echo "Sorry, your file could not be uploaded.";
}
else{
	if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
		addPhoto($target_file,$currentUser,$currentAlbum,$dbc);
		echo "Your file ".basename($_FILES["img"]["name"])." has been succesfully uploaded.";
	}
	else{
		echo "Sorry, your file could not be uploaded.";
	}
}

function addPhoto(&$target_file,&$currentUser,&$currentAlbum,&$dbc){
	// //get album name with number...
	// $quer = "SELECT albumName FROM album WHERE albumID = ".$currentAlbum."";
	// $res = mysqli_query($dbc,$quer);
	// $album = mysqli_fetch_array($res);

	//if success in uploading file to the uploads directory then I need to add a row in the photo table.
	$sql = "INSERT INTO photo VALUES(DEFAULT,'$currentAlbum','$currentUser','$target_file',CURRENT_TIMESTAMP)";//photoid, albumid, userid, refloc, date
	$res = mysqli_query($dbc,$sql);

	$quer = "SELECT MAX(photoID) as lastID FROM photo"; //WHERE albumName = '$name'"; //get most recent addition -> use MAX i think?
	$res = mysqli_query($dbc,$quer);
	$photo = mysqli_fetch_array($res);

	$photoNum = $photo['lastID'];
	$photoName = $target_file;

	if($res){
		echo "<td>";
	    //main box
	    echo "<div style='position:relative;'>"; 
	    	echo "<a class='deleteImg' id=".$photoNum.">";
			    echo "<div style='background-color:white; margin:6px; height:30px; width:30px; opacity:0.5; right:0; position:absolute; z-index:100;'>";
			    	//image
			    	echo "<img src='icons/close.png' style='height:30px; ' />";
			    echo "</div>";
		    echo "</a>";
	    	//image button
	    	echo "<div style='margin:7px; width:150px; height:150px; background-color:skyblue; float:left; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); overflow:hidden;'>";

		    list($width,$height) = getimagesize(''.$photoName.'');
		    if($width>$height){
		    	echo "<a class='img' id='".$photoNum."'>";
                	echo "<img src='".$photoName."' height='150px'>";
                echo "</a>"; //align center vertically
            }
            else{
            	echo "<a class='img' id='".$photoNum."'>";
                	echo "<img src='".$photoName."' width='150px'>";
                echo "</a>"; //align center horizontally
            }
		
	    	echo "</div>";
    	echo "</div>";
	    echo "</td>";
	}
}
?>


