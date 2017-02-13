<?php

require_once('db_connect.php');
session_start();
$search = $_POST["name"];
$this_user = $_SESSION['id'];
$r = mysqli_query($dbc,"SELECT * FROM Users WHERE name LIKE '%{$search}%'AND id != $this_user");
if($r->num_rows ==0) {
	echo '<a>no users found</a>';
}
if($search == ""){
}
else{
while($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
    echo '<a href="profile.php?fid='.$row['id'].'"> '.$row['name'].'</a><br>';
}
echo '<style type="text/css">
        #search {
            border-bottom: 1px solid;
            position: absolute; 
            width: 100%;
            padding-top:5px;
            padding-bottom:5px;
        }
        </style>';
}

?>