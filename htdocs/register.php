<?php

require_once('db_connect.php');
$olddate = $_POST['dob'];
$newdate = str_replace('/', '-', $olddate);
$p = "SELECT * FROM Users WHERE email = '".$_POST['email']."'";

$rs = mysqli_query($dbc,$p);
	$data = mysqli_fetch_array($rs, MYSQLI_ASSOC);
header('Content-Type: application/json');
	if($rs->num_rows >0) {
	
	error_log ( "duplicate email",0);
	echo "email already used";
	 header('HTTP/1.1 500 Internal Server');
	 
   
	}
	else{
$q = "INSERT INTO Users
	(name,sex,dob,location,date_joined,email,password)
	VALUES (
	'".mysqli_real_escape_string($dbc,$_POST['name'])."','{$_POST['sex']}','".date('Y-m-d', strtotime($newdate))."','".mysqli_real_escape_string($dbc,$_POST['location'])."',NOW(),'{$_POST['email']}','{$_POST['password']}')";
	
	$r = mysqli_query($dbc,$q);
	echo "successful sign up";
}

?>