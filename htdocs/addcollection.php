<?php
$errors = array(); //To store errors
$form_data = array(); //Pass back the data to `form.php`
require_once('db_connect.php');
session_start();

if(isset($_POST['content_txt'])&&isset($_POST['user'])){
	// echo 'name is set ';
	$name = mysql_real_escape_string($_POST['content_txt']);
	// echo 'to be '.$name;
	$user = $_POST['user'];

	//INSERTING THE VALUES
	$sql = "INSERT INTO album VALUES(DEFAULT,'$name','$user',CURRENT_TIMESTAMP)"; //try and work out how to add auto_increment and current_timestamp.
	$result = $dbc->query($sql);

	$quer = "SELECT * FROM album WHERE albumName = '$name'";
	$res = mysqli_query($dbc,$quer);
	$album = mysqli_fetch_array($res);
	$albumID = $album['albumID'];
	$owner = $album['userID'];

	if($result)
	{
		
		echo "<td>";
	      //whole box
	      echo "<div style='position:relative;'>"; 
	      //delete button
	        echo "<a class='deleteCol' id='".$albumID."'>";
	          echo "<div style='background-color:white; margin:6px; height:30px; width:30px; opacity:0.5; right:0; position:absolute; z-index:100;'>";
	            //image
	            echo "<img src='icons/close.png' style='height:30px; ' />";
	          echo "</div>";
	        echo "</a>";
	      //}
	        //main button
	        echo "<a class='view' id='".$albumID."'>";
	          echo "<div style='margin:7px; width:150px; height:150px; background-color:dodgerblue; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); float:left;'>";
	            echo "<p style='font-size:30px; text-align: center; position: relative; top: 50%; transform: translateY(-50%); color:powderblue;'>".$name."</p>";
	          echo "</div>";
	        echo "</a>";
	      echo "</div>";
	      echo "</td>";

	  	$dbc->close(); //close db connection

	}else{
		
		header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}

?>
