<?php
 $errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
session_start();
require_once('db_connect.php');
header('Content-Type: application/json');
$q = "UPDATE Users SET lastActive=now() WHERE id='".$_SESSION['id']."'";
$r = mysqli_query($dbc,$q);
      
?>
