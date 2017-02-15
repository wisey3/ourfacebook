<?php
 $errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
session_start();
require_once('db_connect.php');
header('Content-Type: application/json');

/* Validate the form on the server side */
if (empty($_POST['name'])) { //Name cannot be empty
    $errors['name'] = 'Error: Circle Name cannot be blank';
}

if (!empty($errors)) { //If errors in validation
    $form_data['success'] = false;
    $form_data['errors']  = $errors;
}	
	else{
		  $q = "INSERT INTO circles (name) VALUES ('".mysqli_real_escape_string($dbc,$_POST['name'])."')";
      $r = mysqli_query($dbc,$q);
      
      $result = mysqli_query($dbc,"SELECT id FROM users WHERE id ='".$_SESSION['id']."'");
      $row = mysqli_fetch_row($result);
      $user_id = $row[0]; 
      $result = mysqli_query($dbc, "SELECT MAX(id) FROM circles");
      $row = mysqli_fetch_row($result);
      $highest_id = $row[0];

		  $q2 = "INSERT INTO circlemembership (circleID, userID) VALUES ($highest_id, $user_id)"; 
   		$r2 = mysqli_query($dbc,$q2);
   		$form_data['success'] = true;
   		$form_data['posted'] = 'Super Circle Created Succecssful';

}
	echo json_encode($form_data);
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>