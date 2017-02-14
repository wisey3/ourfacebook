<?php
 $errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
session_start();
require_once('db_connect.php');
header('Content-Type: application/json');



/* Validate the form on the server side */
if (empty($_POST['privacy'])) { //Name cannot be empty
    $errors['privacy'] = 'Error: Privacy setting cannot be blank';
}




if (!empty($errors)) { //If errors in validation
    $form_data['success'] = false;
    $form_data['errors']  = $errors;
}	
	else{
$q = "UPDATE Users SET privacy = '".$_POST['privacy']."' WHERE id = '".$_SESSION['id']."'";
	
	$r = mysqli_query($dbc,$q);
	
	$form_data['success'] = true;
    $form_data['posted'] = 'Privacy Change Successful';

}
	echo json_encode($form_data);
?>