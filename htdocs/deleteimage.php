<?php
$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
require_once('db_connect.php');

$type = $_POST['type'];

if($type=='Collection'){
	$album = $_POST['albumID'];

	$sql = "SELECT * FROM photo WHERE albumID = ".$album."";
	$res = mysqli_query($dbc,$sql);
	
	while($image = mysqli_fetch_assoc($res)){
		//echo ''.$image['refLoc'].'';
		if(file_exists($image['refLoc'])){
			removeImage($image['photoID'],$dbc);
		}		
	}		

	// echo 'whats happening';

	//delete album
	$quer = "DELETE FROM album WHERE albumID = ".$album."";
	$result = mysqli_query($dbc,$quer);

	//delete photo comments in album
	$quer = "DELETE FROM comment WHERE albumID = ".$album."";
	$result = $dbc->query($quer);	

	//delete photos in album
	$quer = "DELETE FROM photo WHERE albumID = ".$album."";
	$result = $dbc->query($quer);	

	// header('Location: collection.php');
}
else if($type=='Photo'){
	// $photoID = $_GET['photoID'];
	$photoID = $_POST['photoID'];
	// $photoID = 2;

	removeImage($photoID,$dbc);

	//get vars for the returned page
	$sql = "SELECT * FROM album WHERE albumID = (SELECT albumID FROM photo WHERE photoID = ".$photoID.")";
	$res = mysqli_query($dbc,$sql);
	$album = mysqli_fetch_array($res);	 

	$albumName = $album['albumName'];
	$albumID = $album['albumID'];
	$userID = $album['userID'];

	$quer = "DELETE FROM photo WHERE photoID = ".$photoID."";
	$result = $dbc->query($quer);

	$quer = "DELETE FROM comment WHERE photoID = ".$photoID."";
	$result = $dbc->query($quer);
	
	// header('Location: photo.php?name='.$albumName.'&user='.$userID.'&num='.$albumID.'');
	
}

function removeImage(&$photoID,&$dbc){
	$sql = "SELECT * FROM photo WHERE photoID = ".$photoID."";
	$res = mysqli_query($dbc,$sql);
	$photo = mysqli_fetch_array($res);

	$photoFile = $photo['refLoc'];
	echo ''.$photoFile.'';
	unlink($photoFile);
}

?>