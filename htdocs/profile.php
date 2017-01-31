<?php
// Start the session
      require_once('db_connect.php');
	session_start();
if (isset($_POST)) {

	$p = "SELECT * FROM Users WHERE email = '".$_POST['email']."'";
	$rs = mysqli_query($dbc,$p);
	$data = mysqli_fetch_array($rs, MYSQLI_ASSOC);

	if($rs->num_rows !=1) {
		echo "email not recognised";
	}
	if($_POST['password'] != $data['password']){
		echo "incorrect password";
	}
	
	else{
	
		
		$_SESSION['id'] = $data['id'];
		$loadprofile = $_SESSION['id'];
		}
}
	else{



	
		if(isset($_GET['fid'])) {
   			$loadprofile = $_GET['fid'];
		}
		else{
			$loadprofile = $_SESSION['id'];
		}  
	}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../favicon.ico">

    <title>Social Network</title>


    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


  </head>

  <body>

    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CW</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
 <script type="text/javascript">
function getStates(value) {
    $.post("search.php", {name:value},function(data){
        $("#search").html(data);
    }
    ); 
}
</script>
<script>
$("#name").on('input', function () {
    var val = this.value;
    if($('#search option').filter(function(){
        return this.value === val;        
    }).length) {
     alet($(this).attr("data-value"));
     // window.location.href = $(this).attr("data-value");
    }
});
</script>
            <li><input type="text" id="name" list="search" name="search" onkeyup="getStates(this.value)" size="30"  class="form-control" placeholder ="Search users" style="margin-top:7px;">
               <datalist id='search' >
      
    </datalist>
            </li>
                       
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">menu</a></li>
            <li class="active"><a href="./">menu <span class="sr-only">(current)</span></a></li>
            <li><a href="../navbar-fixed-top/">menu</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron col-md-4">
      <?

    $r = mysqli_query($dbc,"SELECT * FROM Users WHERE id = '".$loadprofile."'");
    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
    
	$name = $row['name'];
	$sex= $row['sex'];
	$location = $row['location'];
	$join = date('d / m / Y', strtotime($row['date_joined']));
	$dob = $row['dob'];
	
	$date1 = new Datetime("now");
	$date2 = new DateTime($dob);
	$interval = $date1->diff($date2);
	
    $age =  "" . $interval->y. " years old";
    
	
	
	//$picture = $row['picture'];
	?>
        <h3><?php echo $name; ?></h3>
        <p>Lives in <?php echo $location; ?></p>
        <p>Gender <?php echo $sex; ?></p>
        <p>Joined <?php echo $join; ?></p>
        <p>Age <?php echo $age; ?></p>
     
      </div>

    </div> <!-- /container -->



    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

  </body>
</html>
<?


?>
