<?php
require_once('db_connect.php');

if((mysqli_query($dbc,"SELECT * FROM album"))==FALSE){
	echo 'sorry this table doesnt exist';

	$sql = "CREATE TABLE album (
	albumID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	albumName TEXT NOT NULL,
	userID INT(6),
	date DATETIME
	)";

	if ($dbc->query($sql) === FALSE) {
	    echo "Error creating table: " . $dbc->error;
	}
}
else{
	checkreset($dbc,'album','albumID');
}

if((mysqli_query($dbc,"SELECT * FROM photo"))==FALSE){
	echo 'sorry this table doesnt exist';

	$sql = "CREATE TABLE photo (
	photoID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	albumID INT(6),
	userID INT(6),
	refLec TEXT NOT NULL,
	date DATETIME
	)";

	if ($dbc->query($sql) === FALSE) {
	    echo "Error creating table: " . $dbc->error;
	}
}
else{
	checkreset($dbc,'photo','photoID');
}

if((mysqli_query($dbc,"SELECT * FROM comment"))==FALSE){
	echo 'sorry this table doesnt exist';

	$sql = "CREATE TABLE comment (
	photoID INT(6),
	userID INT(6),
	content TEXT NOT NULL,
	date DATETIME
	)";

	if ($dbc->query($sql) === FALSE) {
	    echo "Error creating table: " . $dbc->error;
	}
}


function checkreset(&$dbc,$table,$id){
	$result = mysqli_query($dbc,"SELECT ".$id." FROM ".$table."");
	$row = mysqli_fetch_array($result);

	if(isset($row[''.$id.''])){
		//echo 'table not empty';
	}
	else{
		$trun = "TRUNCATE TABLE ".$table."";
		mysqli_query($dbc,$trun);
	}
}


?>