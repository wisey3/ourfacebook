<?php
 $errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
session_start();
require_once('db_connect.php');


$u = "SELECT * FROM Users WHERE id = '".$_SESSION['id']."'";

$ru = mysqli_query($dbc,$u);
$data = mysqli_fetch_array($ru, MYSQLI_ASSOC);
header('Content-Type: application/json');



/* Validate the form on the server side */
if (empty($_POST['oldpassword'])) { //Name cannot be empty
    $errors['oldpass'] = 'Error: Current Password cannot be blank';
}
if (empty($_POST['newpassword'])) { //Name cannot be empty
    $errors['newpass'] = 'Error: New Password cannot be blank';
}
if (!password_verify ( $_POST['oldpassword'] , $data['password'])) { //Name cannot be empty
    $errors['verification'] = 'Error: Current password incorrect';
}



if (!empty($errors)) { //If errors in validation
    $form_data['success'] = false;
    $form_data['errors']  = $errors;
}	
	else{
$hashpass =  password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
$q = "UPDATE Users SET password = '".$hashpass."' WHERE id = '".$_SESSION['id']."'";
	
	$r = mysqli_query($dbc,$q);
	
	$form_data['success'] = true;
    $form_data['posted'] = 'Password Change Successful';

}
	echo json_encode($form_data);
?>