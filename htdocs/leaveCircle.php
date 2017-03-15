<?php
 $errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
session_start();
require_once('db_connect.php');
header('Content-Type: application/json');

/* Validate the form on the server side */
if (empty($_POST['circleselect'])) { //Name cannot be empty
    $errors['circleselect'] = 'Error: You must select a circle';
}

if (!empty($errors)) { //If errors in validation
    $form_data['success'] = false;
    $form_data['errors']  = $errors;
} 
  else{
      $q2 = "DELETE FROM circlemembership WHERE circleID='".mysqli_real_escape_string($dbc,$_POST['circleselect'])."' AND userID='".$_SESSION['id']."'"; 
      $r2 = mysqli_query($dbc,$q2);
      $form_data['success'] = true;
      $form_data['posted'] = 'Left Circle succecssful';

}
echo json_encode($form_data);
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>