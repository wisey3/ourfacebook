<?php

include_once("db_connect.php");

if(isset($_POST["content_txt"]) && strlen($_POST["content_txt"])>0) 
{	$user = $_POST['user'];

	

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