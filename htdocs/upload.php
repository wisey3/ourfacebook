<!--creating upload.php-->
<?php
require_once('db_connect.php');
session_start();

$target_dir = "uploads/"; //where you're uploading it to - need to create this new directory where uploads.php is
$target_file = $target_dir.basename($_FILES["img"]["name"]); //this is what the file will be called

//echo '<p> This is the file you are trying to upload '.$target_file.'</p>';
//echo '<img src="'.$target_file.'"/>';
//test echo $target_file;
$uploadOk = 1; //set var to check if upload complete
$imageFileType =  pathinfo($target_file,PATHINFO_EXTENSION); //get extension type

$currentUser = 1;
//$currentAlbum = mysql_real_escape_string('Italy');//get this
// $currentUser = $_GET['fid'];
$currentAlbum = $_GET['albumId'];//get this

//limit file size
if($_FILES["img"]["size"]>500000){
	echo "Sorry, image file is too large.";
	$uploadOk = 0; //changes to 0 as cannot be uploaded if too large
}

//check extension
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif"){
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
		//echo 'refloc = '.$target_file.', user = '.$currentUser.', album = '.$currentAlbum.'';
	}
	else{
		echo "Sorry, your file could not be uploaded.";
	}
}

function addPhoto(&$target_file,&$currentUser,&$currentAlbum,&$dbc){
	//get album name with number...
	$quer = "SELECT albumName FROM album WHERE albumID = ".$currentAlbum."";
	$res = mysqli_query($dbc,$quer);
	$album = mysqli_fetch_array($res);
	$name = $album['albumName'];

	//echo ''.$name.'';
	//if success in uploading file to the uploads directory then I need to add a row in the photo table.
	$sql = "INSERT INTO photo VALUES(DEFAULT,'$currentAlbum','$currentUser','$target_file',CURRENT_TIMESTAMP)";//photoid, albumid, userid, refloc, date
	$res = mysqli_query($dbc,$sql);

	header('Location: photo.php?name='.$name.'&user='.$currentUser.'&num='.$currentAlbum.'');
}
?>

