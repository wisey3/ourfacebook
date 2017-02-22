<!--php code for adding a collection entry into the album table.-->

<?php
$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
require_once('db_connect.php');

// $name = $_POST['albumName'];
// $userid = $_GET['fid'];
// $user = 1;

$type = $_GET['type'];


//echo 'delete type '.$type.' and the album Id is '.$album.'';

if($type=='Collection'){
	$album = $_GET['albumID'];

	$quer = "DELETE FROM album WHERE albumID = ".$album."";
	$result = $dbc->query($quer);

	$quer = "DELETE FROM photo WHERE albumID = ".$album."";
	$result = $dbc->query($quer);

	header('Location: collection.php');
}
else{
	$photoID = $_GET['photoID'];	

	//$quer = "SELECT albumID FROM photo WHERE photoID = ".$photoID."";
	$sql = "SELECT * FROM album WHERE albumID = (SELECT albumID FROM photo WHERE photoID = ".$photoID.")";
	$res = mysqli_query($dbc,$sql);
	$album = mysqli_fetch_array($res);	 

	$albumName = $album['albumName'];
	$albumID = $album['albumID'];
	$userID = $album['userID'];

	// echo 'photo num '.$photoID.'';
	// echo 'album num '.$albumID.', album name '.$albumName.' and user id '.$userID.'';

	$quer = "DELETE FROM photo WHERE photoID = ".$photoID."";
	$result = $dbc->query($quer);

	$quer = "DELETE FROM comment WHERE photoID = ".$photoID."";
	$result = $dbc->query($quer);

	header('Location: photo.php?name='.$albumName.'&user='.$userID.'&num='.$albumID.''); //need album name album id and user id
	//photo.php?name=".$name."&user=".$user."&num=".$album['albumID']."
}


// $quer = "INSERT INTO album VALUES('3','$name','1',current_timestamp)";
// 	$res = mysql_query($dbc,$quer);

// if($name==NULL){
// 	echo "Sorry, your collection must have a title";
// }
// else{
// 	
// }

// header('Location: collection.php');

// echo json_encode($form_data);

?>