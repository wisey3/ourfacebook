<!--php code for adding a collection entry into the album table.-->

<?php
$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
require_once('db_connect.php');

//$userid = $_GET['fid']; //current user
$user = $_GET['user'];
$body = $_POST['body'];
$photoID = $_GET['photoid'];

//echo 'the id is '.$photoID.', user is '.$user.' and the body of the comment is '.$body.'';

// $sql = "INSERT INTO comment VALUES(DEFAULT,$photoID,$user,$body,CURRENT_TIMESTAMP)"; 
// $result = $dbc->query($sql);	

$sql = "INSERT INTO comment VALUES(DEFAULT,'$photoID','$user','$body',CURRENT_TIMESTAMP)";
$result = $dbc->query($sql);	


// $quer = "INSERT INTO album VALUES('3','$name','1',current_timestamp)";
// 	$res = mysql_query($dbc,$quer);

// if($body==NULL){
// 	echo "Sorry, your comment must have content";
// }
// else{
// 	$sql = "INSERT INTO comment VALUES(DEFAULT,$photoID,$user,$body,CURRENT_TIMESTAMP)"; 
// 	$result = $dbc->query($sql);
//}

$quer = "SELECT * FROM photo WHERE photoID = ".$photoID.""; //getting the photo reference for this particular photoID
$res = $dbc->query($quer);
$photo = mysqli_fetch_array($res);
$name = $photo['refLoc'];

header('Location: image.php?user='.$user.'&photoid='.$photoID.'&photoname='.$name.'');
//image.php?photoid=".$photoNum."&photoname=".$photoName."&user=".$user."'><img src='".$photoName."


// 	echo json_encode($form_data);

?>

<!-- //session id for the current profile that you're on

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

// } -->