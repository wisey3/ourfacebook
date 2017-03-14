<?php
  include 'db_connect.php';
  //if they submitted the form
 $errors = array(); //To store errors
$form_data = array(); 
header('Content-Type: application/json');
    //escape special characters from user input
    $id = mysqli_real_escape_string($dbc, $_POST['post_id']);
    //otherwise
    
      //create a query that inserts the messages
      $query = "DELETE FROM posts WHERE id = '$id'";
      //send query in and if it doesn't work report an error


      if (!empty($errors)) { //If errors in validation
    $form_data['success'] = false;
    $form_data['errors']  = $errors;
} 
    //otherwise
    else {
      if (!mysqli_query($dbc, $query)) {
         die('Error: ' . mysqli_error($dbc));
        $errors['failed'] = 'delete post failed';
        $form_data['success'] = false;
      $form_data['errors']  = $errors;
      }
      else {
        //returns an http header
        $form_data['success'] = true;
      $form_data['posted'] = 'delete post Successful';
      }
    }
    
     echo json_encode($form_data);  
?>
