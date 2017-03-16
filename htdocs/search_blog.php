<?php
 include "db_connect.php";
 
 $title=$_POST["title"];
 $user_id = $_POST["user-id"];
  
 $result=mysqli_query($dbc, "SELECT * FROM posts where  user_id='".$user_id."' and title like '%$title%'");
 $found=mysqli_num_rows($result);
 
 if($found>0){
    while($row=mysqli_fetch_assoc($result)){

      echo "<li><span id='post-title'>$row[title]</span><span id='post-date'>$row[date]</span><span id='post-content'>$row[content]</span></li>";
    }   
 }else{
    echo "<li>No Posts Found<li>";
 }
 // ajax search
?>