<?php
$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
require_once('db_connect.php');

$fileName = $_FILES['file']['name'];
$fileType = $_FILES['file']['type'];
$fileError = $_FILES['file']['error'];
$fileContent = file_get_contents($_FILES['file']['tmp_name']);



$xml=simplexml_load_string($fileContent) or die("Error: Cannot create object");




$olddate =$xml->dob;
$newdate = str_replace('/', '-', $olddate);
$p = "SELECT * FROM Users WHERE email = '".$xml->email."'";

$rs = mysqli_query($dbc,$p);
	$data = mysqli_fetch_array($rs, MYSQLI_ASSOC);
header('Content-Type: application/json');



/* Validate the form on the server side */
if (empty($xml->email)) { //Name cannot be empty
    $errors['email'] = 'Error: Email cannot be blank';
}
if (empty($xml->password)) { //Name cannot be empty
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
	$hashpass =  $xml->password;
$q = "INSERT INTO Users
	(id,name,sex,dob,location,education,date_joined,email,password)
	VALUES (
	'{$xml->id}','".mysqli_real_escape_string($dbc,$xml->name)."','{$xml->sex}','".date('Y-m-d', strtotime($newdate))."','".mysqli_real_escape_string($dbc,$xml->location)."','".mysqli_real_escape_string($dbc,$xml->education)."',NOW(),'{$xml->email}','".$hashpass."')";
	
	$r = mysqli_query($dbc,$q);
	
	$form_data['success'] = true;
    $form_data['posted'] = 'Registration Successful';

}
	echo json_encode($form_data);
	?>

