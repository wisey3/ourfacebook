<?

require_once('db_connect.php');

$search = $_POST["name"];

$r = mysqli_query($dbc,"SELECT * FROM Users WHERE name LIKE '%{$search}%'");
if($r->num_rows ==0) {
	echo '<option value='."1".' label ='."none".'>';
}
else{
while($row = mysqli_fetch_array($r,MYSQLI_ASSOC)) {
    echo '<option data-value="profile.php?fid='.$row['id'].'">'.$row['name'].'</option>';
}
}