<?php
require_once('db_connect.php');
      session_start();
      if($_SESSION['id'] == -2){
      $user = $_POST['user'];
      $id = $_POST['id'];
      $action = $_POST['action'];
      
      
      	if($action == "friend"){
      	 		if($user < $id){
        				$smaller = $user;
        				$bigger = $id;
      			}
      			else{
        				$smaller = $id;
        				$bigger = $user;
      			}
     
    			$s = mysqli_query($dbc,"DELETE FROM Relationships WHERE user_1 = '".$smaller."' AND user_2 = '".$bigger."'");
    		
      	}
      	
      
	
      	if($action == "blog"){     
    			$s = mysqli_query($dbc,"DELETE FROM posts WHERE id = '".$id."'");
      	}
      	
      	if($action == "comment"){     
    			$s = mysqli_query($dbc,"DELETE FROM comment WHERE id = '".$id."'");
      	}
      	if($action == "circles"){     
    			$s = mysqli_query($dbc,"DELETE FROM circlemembership WHERE userID = '".$user."'");
      	}

      	
}
?>