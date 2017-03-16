<?php
 $errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
session_start();
require_once('db_connect.php');
if($_SESSION['id']==-2 && isset($_POST['user'])){
$touse = $_POST['user'];
}
else{
$touse = $_SESSION['id'];
}



$p = "SELECT * FROM Users WHERE email = '".$_POST['email']."'";
$u = "SELECT * FROM Users WHERE id = '".$touse."'";
$rs = mysqli_query($dbc,$p);
$ru = mysqli_query($dbc,$u);
	$data = mysqli_fetch_array($ru, MYSQLI_ASSOC);
header('Content-Type: application/json');



/* Validate the form on the server side */
if (empty($_POST['email'])) { //Name cannot be empty
    $errors['email'] = 'Error: Email cannot be blank';
}
if (empty($_POST['location'])) { //Name cannot be empty
    $errors['location'] = 'Error: Location cannot be blank';
}

if($rs->num_rows >0 && $data['email'] != $_POST['email']) {
	 $errors['repeat'] = 'Error: Email already used';
}

if (!empty($errors)) { //If errors in validation
    $form_data['success'] = false;
    $form_data['errors']  = $errors;
}	
	else{

$q = "UPDATE Users SET
	name='".mysqli_real_escape_string($dbc,$_POST['name'])."',sex = '{$_POST['sex']}',location = '".mysqli_real_escape_string($dbc,$_POST['location'])."',education = '".mysqli_real_escape_string($dbc,$_POST['education'])."',email = '{$_POST['email']}' WHERE id = '".$touse."'";
	
	$r = mysqli_query($dbc,$q);
	
	$form_data['success'] = true;
    $form_data['posted'] = 'Profile Edit Successful';

}
	echo json_encode($form_data);
?>