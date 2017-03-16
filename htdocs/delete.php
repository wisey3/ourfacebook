<?php

session_start();
require_once('db_connect.php');
if($_SESSION['id']==-2 && isset($_POST['id'])){
$user = $_POST['id'];
}
else{
$user = $_SESSION['id'];
}
$q = "DELETE FROM circlemembership WHERE userID = '".$user."'";
$p = "DELETE FROM Users WHERE id = '".$user."'";
$u = "DELETE FROM Relationships WHERE (user_1 = '".$user."' OR user_2 = '".$user."')";
$rq = mysqli_query($dbc,$q);
$rs = mysqli_query($dbc,$p);
$ru = mysqli_query($dbc,$u);

if($_SESSION['id']==-2 && isset($_POST['id'])){
header("Location: admin.php");
}
else{
header("Location: index.php");
}
exit;



?>