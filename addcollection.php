<!--php code for adding a collection entry into the album table.-->

<?php
$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
require_once('db_connect.php');
session_start();

$name = $_POST['albumName'];
$userid = $_GET['fid'];
$user = 1;
$access = $_POST['access'];


// $quer = "INSERT INTO album VALUES('3','$name','1',current_timestamp)";
// 	$res = mysql_query($dbc,$quer);

if($name==NULL){
	echo "Sorry, your collection must have a title";
}
else{
	$sql = "INSERT INTO album VALUES(DEFAULT,'$name','$user',CURRENT_TIMESTAMP)"; //try and work out how to add auto_increment and current_timestamp.
	$result = $dbc->query($sql);
}

header('Location: collection.php');

//session id for the current profile that you're on

//check its not empty error wise

/* Validate the form on the server side */
// if (empty($name)) { //Name cannot be empty
//     $errors['albumName'] = 'Error: Collection name cannot be blank';
// }

// if (!empty($errors)) { //If errors in validation
//     $form_data['success'] = false;
//     $form_data['errors']  = $errors;
// }	
// else{

// 	$quer = "INSERT INTO album VALUES('3','$name','1',current_timestamp)";
// 	$res = mysql_query($dbc,$quer);
	
// 	$form_data['success'] = true;
//     $form_data['posted'] = 'Collection successfully added.';

// }
	echo json_encode($form_data);

?>

<!--
if($name==NULL){
	echo "Sorry, your album must have a title"; //not sure about this bit
}
else{
	$sql = "INSERT INTO album VALUES($name,$userid)";
	mysql_query($dbc,$sql);
}-->