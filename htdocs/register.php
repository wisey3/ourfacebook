<?php
 $errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
require_once('db_connect.php');
$olddate = $_POST['dob'];
$newdate = str_replace('/', '-', $olddate);
$p = "SELECT * FROM Users WHERE email = '".$_POST['email']."'";

$rs = mysqli_query($dbc,$p);
	$data = mysqli_fetch_array($rs, MYSQLI_ASSOC);
header('Content-Type: application/json');



/* Validate the form on the server side */
if (empty($_POST['email'])) { //Name cannot be empty
    $errors['email'] = 'Error: Email cannot be blank';
}
if (empty($_POST['password'])) { //Name cannot be empty
    $errors['password'] = 'Error: Password cannot be blank';
}

if($rs->num_rows >0) {
	 $errors['repeat'] = 'Error: Email already used';
}

if (!empty($errors)) { //If errors in validation
    $form_data['success'] = false;
    $form_data['errors']  = $errors;
}	
	else{
	$hashpass =  password_hash($_POST['password'], PASSWORD_DEFAULT);
$q = "INSERT INTO Users
	(name,sex,dob,location,education,date_joined,email,password)
	VALUES (
	'".mysqli_real_escape_string($dbc,$_POST['name'])."','{$_POST['sex']}','".date('Y-m-d', strtotime($newdate))."','".mysqli_real_escape_string($dbc,$_POST['location'])."','".mysqli_real_escape_string($dbc,$_POST['education'])."',NOW(),'{$_POST['email']}','".$hashpass."')";
	
	$r = mysqli_query($dbc,$q);
	
	$form_data['success'] = true;
    $form_data['posted'] = 'Registration Successful';

}
	echo json_encode($form_data);
?>