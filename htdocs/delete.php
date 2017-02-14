<?php

session_start();
require_once('db_connect.php');

$p = "DELETE FROM Users WHERE id = '".$_SESSION['id']."'";
$u = "DELETE FROM Relationships WHERE (user_1 = '".$_SESSION['id']."' OR user_2 = '".$_SESSION['id']."')";
$rs = mysqli_query($dbc,$p);
$ru = mysqli_query($dbc,$u);

header("Location: index.php");
exit;



?>