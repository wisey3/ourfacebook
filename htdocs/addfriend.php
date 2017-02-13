<?php
require_once('db_connect.php');
session_start();
$user = $_POST['user'];
$friend = $_POST['friend'];
$action = $_POST['action'];
$this_user = $_SESSION['id'];
if($user<$friend){
	$smaller = $user;
	$bigger = $friend;
	}
else{
	$bigger = $user;
	$smaller = $friend;
}
if($action == 'add'){
$r = mysqli_query($dbc,"INSERT INTO Relationships (user_1,user_2,status,last_action) VALUES ($smaller,$bigger,'pending',$user)");
//add to table
}
else if($action == 'accept'){
$s = mysqli_query($dbc,"UPDATE Relationships SET status = 'accepted', last_action = $user WHERE user_1 = $smaller AND user_2 = $bigger");
//update to accepted
}
else if($action == 'decline'){
$t = mysqli_query($dbc,"DELETE FROM Relationships WHERE user_1 = $smaller AND user_2 = $bigger");
//remove
}
?>