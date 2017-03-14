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

	//visability can be E=everyone, F=Friends, FOF=Friends of Friends, C=any particular circle
	if(isset($_POST['vis'])){
		$visability = $_POST['vis'];
		// if($visability=='C'){
		// 	$visability=$_POST['circle_name'];
		// }
	}
	else{
		$visability = 'E';
	}

	// echo "<p> the visability chosen is ".$_POST['vis']." and the circle is ".$_POST['circle_name']."</p>";
	

	//INSERTING THE VALUES
	$sql = "INSERT INTO album VALUES(DEFAULT,'$name','$user','$visability',CURRENT_TIMESTAMP)"; //need to add the visability
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
	          echo "<div id='deleteX'>";
	            //image
	            echo "<img src='icons/close.png' style='height:30px; ' />";
	          echo "</div>";
	        echo "</a>";
	      //}
	        //main button
	        echo "<a class='view' id='".$albumID."'>";
	          echo "<div id='colSquare'>";
	            echo "<p id='colName'>".$name."</p>";
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
