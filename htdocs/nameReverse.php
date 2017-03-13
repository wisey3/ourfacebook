<?php
if(isset($_GET['userID']))
{
	require_once('db_connect.php');
	$uid = $_GET['userID'];
	$r = mysqli_query($dbc,"SELECT * FROM Users WHERE id = '".$uid."'");
    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
	$uname = $row['name'];
	$output[] = $uname;                                 
  	print(json_encode($output));
}
?>




