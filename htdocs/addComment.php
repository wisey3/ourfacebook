<!--php code for adding a comment entry into the album table.-->

<?php
// $errors = array(); //To store errors
// $form_data = array(); //Pass back the data to `form.php`
// require_once('db_connect.php');

// //$userid = $_GET['fid']; //current user
// $user = $_GET['user'];
// $body = mysql_real_escape_string($_POST['body']);
// $photoID = $_GET['photoid'];
// $albumID = $_GET['albumid'];

// if($body == NULL){
// 	echo 'you cannot have an empty comment you fool';
// }
// else{
// 	$sql = "INSERT INTO comment VALUES('$photoID','$user','$albumID','$body',CURRENT_TIMESTAMP)";
// 	$result = $dbc->query($sql);	
// }

// $quer = "SELECT * FROM photo WHERE photoID = ".$photoID.""; //getting the photo reference for this particular photoID
// $res = $dbc->query($quer);
// $photo = mysqli_fetch_array($res);
// $name = $photo['refLoc'];

// header('Location: image.php?user='.$user.'&photoid='.$photoID.'&photoname='.$name.'');

?>

<?php

include_once("db_connect.php");

// echo 'the user '.$_POST['user'];
// echo 'the body '.$_POST['content_txt'];
// echo 'the photoId '.$_POST['photoId'];
// echo 'the album '.$_POST['albumId'];

if(isset($_POST["content_txt"]) && strlen($_POST["content_txt"])>0) 
{	//check $_POST["content_txt"] is not empty
	// echo 'well its not empty';

	

	$user = $_POST['user'];

	

	// $body = mysql_real_escape_string($_POST['body']);
	$photoID = $_POST['photoId'];

	$quer = "SELECT * FROM photo WHERE photoID = '".$photoID."'";
    $photo = mysqli_query($dbc,$quer);
    $row = mysqli_fetch_array($photo);

    $albumID = $row['albumID'];

	//sanitize post value, PHP filter FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH Strip tags, encode special characters.
	$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	// $photoID = 1;
	// $user = 1;
	// $albumID = 2;
	date_default_timezone_set("Europe/London");
	$time = date('H:i:s');
	$date = date('Y-m-d',time());
	
	$insert_row = $dbc->query("INSERT INTO comment VALUES('$photoID','$user','$albumID','".$contentToSave."',CURRENT_TIMESTAMP)");

	$quer = "SELECT * FROM Users WHERE id = '".$user."'";
    $res = mysqli_query($dbc,$quer);
    $row = mysqli_fetch_array($res);

    $userName = $row['name'];

	// echo 'it has been inserted yay!';
	
	if($insert_row)
	{

	  	// echo"<tr>";
        echo'<li>'.$contentToSave.'</li>'; 
        // echo"</tr>";
        echo"<li style='font-size:10px;'><i>".$userName." ".$date." ".$time."</i></li>";
        echo '<br>';

	  	$dbc->close(); //close db connection

	}else{
		
		//header('HTTP/1.1 500 '.mysql_error()); //display sql errors.. must not output sql errors in live mode.
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}
else{
	echo 'shit monkeys';
}

?>