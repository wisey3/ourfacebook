<?php
  include 'db_connect.php';
  //if they submitted the form
  if (isset($_POST['submit'])) {
    //escape special characters from user input
    $id = mysqli_real_escape_string($dbc, $_POST['post_id']);
    //otherwise
    
      //create a query that inserts the messages
      $query = "DELETE FROM posts WHERE id = '$id'";
      //send query in and if it doesn't work report an error
      if (!mysqli_query($dbc, $query)) {
        die('Error: ' . mysqli_error($connection));
      }
      else {
        //returns an http header
        header('Location: profile.php');
        exit();
      }
    
  }
?>