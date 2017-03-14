<?php
$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
require_once('db_connect.php');
session_start();

$view = $_POST['viewStatus'];
$albumNum = $_POST['albumId'];


$quer = "UPDATE album SET viewStatus='$view' WHERE albumID = '$albumNum'";
$album = mysqli_query($dbc,$quer);

?>