<?php
  include 'db_connect.php';
  //if they submitted the form
  if (isset($_POST['submit'])) {
    //escape special characters from user input
    $title = mysqli_real_escape_string($dbc, $_POST['title']);
    $content = mysqli_real_escape_string($dbc, $_POST['content']);
    $user_id = mysqli_real_escape_string($dbc, $_POST['user_id']);

    //get date/time
    date_default_timezone_set('Europe/London');
    $date = date('y-m-d', time());

    if (!isset($title) || $title == '' || !isset($content) || $content == '' ) {
      $error = "Please fill in the title and content.";
      //return url with a parameter
      header("Location: profile.php?error=" . urlencode($error));
      exit();
    }
    //otherwise
    else {
      //create a query that inserts the messages
      $query = "INSERT INTO posts (title, content, date, user_id) VALUES ('$title', '$content', '$date', '$user_id')";
      //send query in and if it doesn't work report an error
      if (!mysqli_query($dbc, $query)) {
        die('Error: ' . mysqli_error($dbc));
      }
      else {
        //returns an http header
        header('Location: profile.php');
        exit();
      }
    }
  }
?>