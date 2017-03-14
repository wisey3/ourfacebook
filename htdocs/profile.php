<?php
// Start the session
      require_once('db_connect.php');
  session_start();
if (!isset($_POST['email']) && !isset($_SESSION['id'])){

echo "Please log in to continue";
echo '<br><a class = "btn btn-default" role="button" href="index.php">Click to login</a>';
}
else{
if(isset($_POST['email'])&&!isset($_GET['fid'])) {

  $p = "SELECT * FROM Users WHERE email = '".$_POST['email']."'";
  $rs = mysqli_query($dbc,$p);
  $data = mysqli_fetch_array($rs, MYSQLI_ASSOC);

  if($rs->num_rows !=1) {
    echo "email not recognised";
    echo '<br><a class = "btn btn-default" role="button" href="index.php">Click to login</a>';
    exit;
  }
  if(!password_verify ( $_POST['password'] , $data['password'])){
    echo "incorrect password";
    echo '<br><a class = "btn btn-default" role="button" href="index.php">Click to login</a>';
    exit;
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
    <link rel="stylesheet" href="css/buttons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
             <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <!--style sheet for the photos etc-->
    <link rel="stylesheet" href="css/photoStyle.css">


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
          <a class="navbar-brand" href="#">PizzaRat</a>
          <svg class="navbar-brand" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><path d="M97.958,64.536l-21.614-22.4c-0.444-4.55-4.291-8.117-8.956-8.117c-1.819,0-3.511,0.546-4.928,1.478  c-16.213-3.881-26.07-3.889-26.495-3.901c-10.851,0-19.68,8.827-19.688,19.678c0,0.004-0.001,0.01-0.001,0.014  c0,0.003,0,0.004,0,0.007c-0.004,6.953-5.661,12.606-12.616,12.606c-1.147,0-2.077,0.931-2.077,2.077s0.93,2.077,2.077,2.077  c6.324,0,11.836-3.52,14.693-8.699c2.856,5.18,8.369,8.699,14.693,8.699c0.211,0,0.416-0.024,0.625-0.031  c0.104,0.015,0.207,0.031,0.315,0.031h62.477c0.834,0,1.587-0.498,1.913-1.266C98.701,66.023,98.536,65.136,97.958,64.536z   M44.059,63.901c3.519-3.075,5.756-7.584,5.756-12.613c0-1.146-0.929-2.077-2.077-2.077s-2.077,0.93-2.077,2.077  c0,6.956-5.66,12.613-12.616,12.613c-6.955,0-12.613-5.653-12.616-12.606c0-0.003,0-0.004,0-0.007  c0-8.568,6.969-15.538,15.541-15.538c0,0,0,0,0.001,0c0.16,0,8.994,0.035,23.36,3.28c-0.598,1.204-0.943,2.555-0.943,3.989  c0,4.962,4.038,9,8.999,9c1.146,0,2.077-0.931,2.077-2.077c0-1.147-0.931-2.077-2.077-2.077c-2.672,0-4.845-2.174-4.845-4.846  c0-2.672,2.173-4.846,4.845-4.846s4.846,2.174,4.846,4.846c0,0.538,0.209,1.055,0.584,1.442l18.758,19.44H44.059z"></path><circle cx="76.852" cy="55.595" r="2.654"></circle></svg>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav" style="display::after:inline">
            <li ><a href="index.php">Log Out</a></li>
            <li <?php if($_SESSION['id'] == $loadprofile){?>class="active"<?php }?>><a href="profile.php">My Profile</a></li>
           
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li class="dropdown-header">Profile</li>
                <li><a href="#" data-toggle="modal" data-target="#editinfo" >Edit Profile</a></li>
                <li><a href="#" data-toggle="modal" data-target="#changepassword">Change Password</a></li>
                
                <li><a href="#" data-toggle="modal" data-target="#delete">Delete Account</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Privacy</li>
                <li><a href="#" data-toggle="modal" data-target="#visibility">Visibility Settings</a></li>
                <li><a href="#">Blocking</a></li>
                <li><a href="#">Photos</a></li>
                <li><a href="#">Blog Settings</a></li>
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
            <li>
            <form><input type="text"  onkeyup="getStates(this.value)" size="30"  class="form-control" placeholder ="Search users" style="margin:8px 8px;">
                       
               <div id="search" style="background-color: white;border-left: 1px solid;border-right: 1px solid;padding-left:10px;">
     
    </div>
    </form>
 </li>
          <ul class="nav navbar-nav navbar-right" style="margin-left:20px" id="feedmenu">
              <li id="p" class="active"><a href="#" id='f1'>Photos</a></li>
              <li id="b" <?php if($_SESSION['id'] == $loadprofile){ ?>  class="dropdown" <?php } ?>>
                <a  href="#" id='f2'  <?php if($_SESSION['id'] == $loadprofile){ ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" <?php } ?>>Blog<?php if($_SESSION['id'] == $loadprofile){ ?>  <span class="caret"></span> <?php }?></a>
             <?php if($_SESSION['id'] == $loadprofile){?>
              <ul class="dropdown-menu">
                 <!--<li id="b"><a href="#" id='f2'>View Blog</a></li>-->
                  
                 <li><a href="#" data-toggle="modal" data-target="#addNewPost" >Add New Post</a></li>
                
                </ul>
                 <?php } ?>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Circles <span class="caret"></span></a>
                <ul class="dropdown-menu">
                 <li id="c"><a href="#" id='f3'>View Circles</a></li>
                 <li><a href="#" data-toggle="modal" data-target="#createcircle" >Create Circle</a></li>
                </ul>
        </li>
           </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container" id="sn">

<<<<<<< Updated upstream
      <div class="jumbotron col-md-3" style="padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:30px;width:auto">
=======
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron col-md-3" style="padding:10px 20px;">
>>>>>>> Stashed changes
   <script>
$(document).ready(function() {
    $("#add").click(function(){ //Trigger on form submit
        var user1 =  <?php echo $_SESSION['id'];?>;
        var friend1 =  <?php echo $loadprofile;?>;
        var action1 = 'add';

        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'addfriend.php', //Your form processing file URL
            data      : {user: user1, friend: friend1, action: action1}, //Forms name
     
            success   : function(data) {
                   $( "#add" ).replaceWith( '<h4 style="color:orange"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Friend Request Pending</h4>' );
                            }
        });
        event.preventDefault(); //Prevent the default submit
    });
});
$(document).ready(function() {
    $(".accept").click(function(){ //Trigger on form submit
    
        var user1 =  <?php echo $_SESSION['id'];?>;
        var friend1 =  $( this ).val();
        var action1 = 'accept';
 $(this).closest(".btn-group-xs").remove();
        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'addfriend.php', //Your form processing file URL
            data      : {user: user1, friend: friend1, action: action1}, //Forms name
     
            success   : function(data) {
              
         
                            }
        });
        event.preventDefault(); //Prevent the default submit
    });
});
$(document).ready(function() {
    $(".decline").click(function(){ //Trigger on form submit
    
        var user1 =  <?php echo $_SESSION['id'];?>;
        var friend1 =  $( this ).val();
        var action1 = 'decline';
 $(this).closest(".btn-group-xs").remove(); 
        $.ajax({ //Process the form using $.ajax()
            type      : 'POST', //Method type
            url       : 'addfriend.php', //Your form processing file URL
            data      : {user: user1, friend: friend1, action: action1}, //Forms name
     
            success   : function(data) {
         
      }
        });
        event.preventDefault(); //Prevent the default submit
    });
});
$(document).ready(function() {
  $('.circle').each(function () {
      var safeColors = ['00','33','66','99','cc','ff'];
      var r = safeColors[Math.floor(Math.random()*6)];
      var g = safeColors[Math.floor(Math.random()*6)];
      var b = safeColors[Math.floor(Math.random()*6)];
      var color =  "#"+r+g+b;
      $(this).css("background-color", color);
  });
});

 </script>    

 <?php 

 function findMutual(&$smaller,&$bigger,&$dbc){
  $arrs = array();
  $arrb = array();
  $lists =  mysqli_query($dbc,"SELECT * FROM Relationships WHERE ((user_1 = '".$smaller."' OR user_2 = '".$smaller."')  AND status = 'accepted')");
  $listb =  mysqli_query($dbc,"SELECT * FROM Relationships WHERE ((user_1 = '".$bigger."' OR user_2 = '".$bigger."') AND status = 'accepted')");
  while($rowsm = mysqli_fetch_array($lists,MYSQLI_ASSOC)){
    if($rowsm["user_1"]!=$bigger || $rowsm["user_2"]!=$bigger){
      if($rowsm["user_1"] != $smaller){      
        array_push($arrs,$rowsm["user_1"]);
      }
      else{
        array_push($arrs,$rowsm["user_2"]);
      }
    }
  }
  while($rowbi = mysqli_fetch_array($listb,MYSQLI_ASSOC)){
    if($rowbi["user_1"]!=$smaller || $rowbi["user_2"]!=$smaller){
      if($rowbi["user_1"] != $bigger){      
        array_push($arrb,$rowbi["user_1"]);
      }
      else{
        array_push($arrb,$rowbi["user_2"]);
      }
    }
  }
  
  $mfriends = array_intersect($arrb,$arrs);
  $mutual = sizeof($mfriends);

  return $mutual;
 }
 ?>
      <?php

    $r = mysqli_query($dbc,"SELECT * FROM Users WHERE id = '".$loadprofile."'");
    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
   
  $name = $row['name'];
  $sex= $row['sex'];
  $location = $row['location'];
  $education = $row['education'];
  $join = date('d / m / Y', strtotime($row['date_joined']));
  $dob = $row['dob'];
  $email = $row['email'];
  $privacy = $row['privacy'];
  $date1 = new Datetime("now");
  $date2 = new DateTime($dob);
  $interval = $date1->diff($date2);
  
    $age =  "" . $interval->y. " years old";
     
     
     if($loadprofile != $_SESSION['id']){
      if($loadprofile < $_SESSION['id']){
        $smaller = $loadprofile;
        $bigger = $_SESSION['id'];
      }
      else{
        $smaller = $_SESSION['id'];
        $bigger = $loadprofile;
      }
     
    $s = mysqli_query($dbc,"SELECT * FROM Relationships WHERE user_1 = '".$smaller."' AND user_2 = '".$bigger."'");
    if($s->num_rows ==0){
    $status = "";
    echo '<button id="add" style="margin-bottom:20px;" class = "btn-lg btn-primary" role="button">Add Friend</button>';
    }
    else{
      $row2 = mysqli_fetch_array($s,MYSQLI_ASSOC);
    $status = $row2['status'];
    $last_action = $row2['last_action'];
    if($status == "accepted"){
    echo '<h4 style="color:green"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Friends</h4>';
    }
      else if($status == "pending"){
      echo '<h4 style="color:orange"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Friend Request Pending</h4>';
      }
      else if($status == "blocked"){
      echo '<h4 style="color:red"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Blocked</h4>';
      }
      
      }   
       ?>
        

        
        <?php 

        $mutual = findMutual($smaller,$bigger,$dbc);
        }
        if(!(($loadprofile == $_SESSION['id'])||$privacy==3||$status=="accepted"||($privacy==2 && $mutual>0))){
          echo "<h3>$name</h3>";
          if($status=="pending"){
            echo"<p>If $name accepts your friend request, you will be able to see their full profile.</p>";
          }
          else{
            echo "<p>Add $name as a friend to view full profile.</p>";
          }
        }
        else{
       
  
  ?>
 

    
         <h3><?php echo $name; ?></h3>
        <p>Lives in <?php echo $location; ?></p>
        <p>Gender <?php echo $sex; ?></p>
        <p>Joined <?php echo $join; ?></p>
        <p>Age <?php echo $age; ?></p>
        <p>Studies at <?php echo $education; ?></p>
        <?php if($_SESSION['id'] != $loadprofile){?>
        <p><a href="#" data-toggle="modal" data-target="#addTocircle" >Add to Circle</a></p>
        <?php } ?>
     
      </div>
      
<style>
.feed {
    display: none;
}
.activejumbo {
    display: block;
    background-color:white;
}


</style>
<script>
$('#f1').click(function(){
$('#feedmenu').find(".active").removeClass("active");
$("#sn").find(".activejumbo").removeClass("activejumbo");
$('#feedmenu').find("#p").addClass("active");
$("#sn").find("#fphotos").addClass("activejumbo");
});
$('#f2').click(function(){
$('#feedmenu').find(".active").removeClass("active");
$("#sn").find(".activejumbo").removeClass("activejumbo");
$('#feedmenu').find("#b").addClass("active");
$("#sn").find("#fblog").addClass("activejumbo");
});
$('#f3').click(function(){
$('#feedmenu').find(".active").removeClass("active");
$("#sn").find(".activejumbo").removeClass("activejumbo");
$('#feedmenu').find("#c").addClass("active");
$("#sn").find("#fcircles").addClass("activejumbo");
});
     
</script>  
    
      <div class="jumbotron col-md-6 activejumbo feed" id="fphotos" style="background-color: white;">
<<<<<<< Updated upstream
=======

      <!--function for checking visability-->
      <script type="text/javascript">
      </script>
>>>>>>> Stashed changes

      <!--My Ajax buttons (photos)-->
      <script type="text/javascript">
      var count = 0;
        $(document).ready(function() {
          $("body").on("click","#collectionBox .view",function (e) {
            count++;

            if(count==1){ //to stop the rabbit hole multi send loop thing

              var myData = 'user='+ <?php echo $_SESSION['id'] ?>+'&albumId='+ $(this).attr('id');
              $.post("photos.php #hi",myData,function(data){
                $("#collectionBox").html(data);
                count = 0;
              });
            } 
          });
        });
        $(document).ready(function() {
          $("body").on("click","#addCol .addItem",function (e) {
            count++;

            if(count==1){ //to stop the rabbit hole multi send loop thing   
              if($("#addText").val()==''){        
                  alert("Please enter some text!");
                  return false;
              }

              // alert($('#visability').val());

              var myData = 'user='+<?php echo $_SESSION['id']?>+'&content_txt='+$("#addText").val()+'&circle_name='+$("#chooseCircle").val()+'&vis='+$('#visability').val();

              $.ajax({
                type: "POST", // HTTP method POST or GET
                url: "addCollection.php", //Where to make Ajax calls
                dataType:"text", // Data type, HTML, json etc.
                data:myData, //$('#formID').serialize()
                success:function(response){
                    $("#tableCol").append(response); //responds -> <ul>
                    $("#addText").val(''); //empty text field on successful
                    count = 0;
                },
                error:function (xhr, ajaxOptions, thrownError){
                    $("#addCollection").show(); //show submit button
                    alert(thrownError);
                }
              });
            }
          });
        });
        $(document).ready(function() {
          $("body").on("click","#collectionBox .deleteCol",function (e) {
            count++;

            if(count==1){ //to stop the rabbit hole multi send loop thing

              var myData = 'albumID='+ $(this).attr('id')+'&type=Collection';

              $(this).closest('td').remove();

              $.ajax({
                  type: "POST", // HTTP method POST or GET
                  url: "deleteimage.php", //Where to make Ajax calls
                  data:myData,
                  dataType: "text",
                  success:function(data){         
                    // alert('Collection Deleted');
                    count = 0;
                  },        
                  error:function (xhr, ajaxOptions, thrownError){
                      alert('oh bollocks');
                  }
              });
            }
          });
        });
      </script>

        <?php
          $owner = $loadprofile; //whose pictures you're looking at
          $user = $_SESSION['id']; //who you are
        ?>

   
        <div id="collectionBox" class="collectionInsert" >
        <?php
        function viewCheck(&$user, &$albumID,&$dbc){ //put this out of this bit somewhere so that collection.php can use it
          $query = "SELECT * FROM album WHERE albumID = '".$albumID."'";
          $result = mysqli_query($dbc,$query);
          $album = mysqli_fetch_array($result);

          $vis = $album['viewStatus'];
          $owner = $album['userID'];

          if($user<$owner){
            $smol = $user;
            $big = $owner;
          }
          else{
            $smol = $owner;
            $big = $user;
          }

          if($user==$owner){
            return true;
          }
          else if($vis=='E'){ //everyone
            return true;
          }
          else if($vis=='F'){ //friends       
            $query = "SELECT * FROM Relationships WHERE user_1 = '$smol' AND user_2 = '$big'"; //if they're friends then it should return true
            $result = mysqli_query($dbc,$query);

            if($result->num_rows == 0){
              return false;
            }
            // return true;
          }
          else if($vis=='FOF'){ //friends of friends
            if(findMutual($smol,$big,$dbc)==0){
              echo 'returning false';
              return false;
            }
            // return true;
          }
          else{ //particular circles
            $query = "SELECT * FROM circlemembership WHERE circleID = (SELECT circleID FROM circles WHERE name = '$vis')";
            $result = mysqli_query($dbc,$query);

            while($row=mysqli_fetch_array($result)){ //returns a list of all people belonging to that circle

              $member = $row['userID'];

              if($member == $user){
                return true;
              }
            }
            return false;
          }
          return true;
        }
        ?>
        <h2><strong>Collections</strong></h2>
          
          <div id="collectionGrid" >
            <div>
            <?php
            
            $quer = "SELECT * FROM album WHERE userID = '".$owner."'";
            $albumNo = mysqli_query($dbc,$quer);
            

            $maxcols = 3;
            $i = 0;

            //Open the table and its first row
            echo "<table id='tableCol'>";
            echo "<tr>";
            while ($album = mysqli_fetch_array($albumNo)) {

                if ($i == $maxcols) {
                    $i = 0;
                    echo "</tr><tr>";
                }

                $name = $album['albumName'];
                $albumId = $album['albumID'];

                if(viewCheck($user,$albumId,$dbc)){//{session['id']fits with the album visability
                  echo "<td>";
                  //whole box
                  echo "<div style='position:relative;'>"; 
                  //delete button
                  if($owner==$user){
                    echo "<a class='deleteCol' id='".$albumId."'>";
                      echo "<div id='deleteX'>";
                        //image
                        echo "<img src='icons/close.png' height='30px' />";
                      echo "</div>";
                    echo "</a>";
                  }
                    //main button
                    echo "<a class='view' id='".$albumId."'>";
                      echo "<div id='colSquare'>";
                        echo "<p id='colName'>".$name."</p>";
                      echo "</div>";
                    echo "</a>";
                  echo "</div>";
                  echo "</td>";

                  $i++;
                }               
                
            }
            
            if($i==3){
              //close the table
              echo "</tr>";
              echo "</table>";

              //add collection square
              if($owner==$user){
                echo "<td>";
                echo '<button id="addButton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addCol">';
                echo '<p id="addButtonText">ADD</p>';
                echo '</button>';

                echo "</td>";
              }
            }
            else{
              //add collection square
              if($owner==$user){
                echo "<td>";
                echo '<button id="addButton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addCol">';
                echo '<p id="addButtonText">ADD</p>';
                echo '</button>';

                  echo "</td>";
              }

                //Add empty <td>'s to even up the amount of cells in a row:
              while ($i <= $maxcols) {
                  echo "<td>&nbsp;</td>";
                  $i++;
              }

              //close the table
              echo "</tr>";
              echo "</table>";
            }

            
          ?>
            </div>
          </div>
          <br>
        </div>
  
           
      </div> <!--End of photo stuff-->
      
      
<<<<<<< Updated upstream
       <div class="jumbotron col-md-6  feed" id="fblog">
=======
       <div class="jumbotron col-md-6 feed" id="fblog">
>>>>>>> Stashed changes
       Blog Posts:
       
       
       <!--Put blog stuff here-->


        <?php 
       $user_id = $loadprofile;
  $query = "SELECT * FROM posts WHERE user_id='".$user_id."' ORDER BY id DESC";
  $posts = mysqli_query($dbc, $query);
  echo $posts->num_rows;
?>
       
    <div class="containter ">
      <header>
        <?php if($_SESSION['id'] == $loadprofile){?>
        <h1>My Blog</h1>
        <?php } ?>
      </header>
      <div class = "row" id="posts " class="myblog">
        <ul>
          <?php while($row = mysqli_fetch_array($posts,MYSQLI_ASSOC)) : ?>
            <li id="post<?php echo $row['id']?>" class="post">
              <span><?php echo $row['title'] ?></span>
              <span><?php echo $row['date'] ?></span>
              <?php echo $row['content'] ?>
              <?php echo $row['id']?>


<?php if($_SESSION['id'] == $loadprofile){?>


            <form  id="delete-entry-<?php echo $row['id']?>">
             <input  name="post_id" type="hidden" value="<?php echo $row['id']?>" />
         <!--- <input id="show-btn" type="submit" name="submit" value="Delete"/> -->
        </form>
       


<button id="deletepost-<?php echo $row['id']?>" class="delete-post" type="button" class="btn btn-primary col-sm-12 col-xs-12">Delete</button>

<script>

  var $btn = $('#deletepost-<?php echo $row["id"]?>');
  console.log(
      'i am here'
    );
  $btn.on("click" , function (e) {
    // alert('trying to delete image');
    //count++;
    console.log(
      'i am here too'
    );
     //to stop the rabbit hole multi send loop thing

      var $myData = $('#delete-entry-<?php echo $row["id"]?>').serialize();

      $(this).closest('li').remove();

      $.ajax({
            type: "POST", // HTTP method POST or GET
            url: "delete_entry.php", //Where to make Ajax calls
            data: $myData,
            success:function(data){         
             
              
            },        
            error:function (xhr, ajaxOptions, thrownError){
                alert('oh bollocks');
            }
          });
    
  });



</script>


<!---
          <script>
          console.log("hey i exist");

            var $btn = $('#deletepost-<?php //echo $row["id"]?>');
            $(this).closest('li').remove();
            $('body').on('click', $btn, function(e) { 
              count++;
              console.log("hey i try");
              if (count ==1) {
            $.ajax({
              type: "POST",
              url: "delete_entry.php",
              
              data: $('#delete-entry-<?php //echo $row["id"]?>').serialize(),

              success: function(data) {
                console.log("hey i work");
                count=0;
                            
    $("#fblog").load(location.href+" #fblog>*","").addClass("activejumbo");


                                }
                            // serializes the form's elements.
        });
          }
    e.preventDefault();// avoid to execute the actual submit of the form.
});
</script> -->

      <?php } ?>
          <?php endwhile; ?>



            </li>


        </ul>
      </div>
      
     
    </div>
    <?php if($_SESSION['id'] == $loadprofile){?>
 <div id="post-form" class="row">
        <!-- If there was an error in the previous input data, display a message. -->
        <?php if (isset($_GET['error'])) : ?>
          <div class="error"><?php echo $_GET['error']; ?></div>
        <?php endif; ?>
        <!-- make a post form and submit it to process.php -->

    <a href="#" data-toggle="modal" data-target="#addNewPost" ><button>Add New Post</button></a>
        

  
      </div>

           <?php } ?>  
       
      </div>
      
      
<<<<<<< Updated upstream

      
=======
>>>>>>> Stashed changes
       <div class="jumbotron col-md-6 feed" id="fcircles">
        Circles
        <?php
        $r = mysqli_query($dbc,"SELECT * FROM circles WHERE id IN ( SELECT circleID from circlemembership where userID = '".$loadprofile."')");
        while($row_data = mysqli_fetch_array($r,MYSQLI_ASSOC))
        {
         $circleid = $row_data['id'];
         $name = $row_data['name'];
          echo "<a href='circles/$circleid'><div class='circle'>$name</div></a>";        
        }
       ?>
       
       
         <!--Put circles stuff here-->
       
       
       
      </div>
      
      
   <?php
   $t = mysqli_query($dbc,"SELECT * FROM Relationships WHERE (user_1 = '".$loadprofile."' OR user_2 = '".$loadprofile."') AND status = 'accepted'");
   //echo $t->num_rows;
   $u = mysqli_query($dbc,"SELECT * FROM Relationships WHERE (user_1 = '".$_SESSION['id']."' OR user_2 = '".$_SESSION['id']."') AND status = 'pending' AND last_action != '".$_SESSION['id']."'");
  //echo $u->num_rows;
  
  
  
  $reclist = array();
    $checklist = array();
    $mq = mysqli_query($dbc,"SELECT id FROM Users WHERE (location = '".$location."' OR education = '".$education."') AND id != '".$_SESSION['id']."'");
    $x  = mysqli_query($dbc,"SELECT * FROM Relationships WHERE (user_1 = '".$loadprofile."' OR user_2 = '".$loadprofile."')");
     while($rowcheck = mysqli_fetch_array($x,MYSQLI_ASSOC)){
      if($rowcheck["user_1"] == $loadprofile){
        array_push($reclist,$rowcheck["user_2"]);
      }
      else{
          array_push($reclist,$rowcheck["user_1"]);
      }
     }

     while(($rowm = mysqli_fetch_array($mq,MYSQLI_ASSOC))){
     array_push($checklist,$rowm["id"]);
     
     }
     $publist = array_diff($checklist,$reclist);
  
  
  
  
  if($t->num_rows >0||($loadprofile == $_SESSION['id'] &&sizeof($publist)>0)||($loadprofile == $_SESSION['id'] && $u->num_rows >0)){
  
   ?>
    
      <div class="jumbotron col-md-3" style="padding:10px 20px;" id="friends">
      <?php if( $loadprofile == $_SESSION['id']){
      if($u->num_rows >0){
      echo "<h4>Pending Friend Requests</h4>";
     
  
     while($row5 = mysqli_fetch_array($u,MYSQLI_ASSOC)){
      if($row5["user_1"] == $_SESSION['id']){
        $pendinglist = $row5["user_2"];
      }
      else{
        $pendinglist = $row5["user_1"];
      }
    
      $p = mysqli_query($dbc,"SELECT name FROM Users WHERE id = '".$pendinglist."'");
      $row6 = mysqli_fetch_array($p,MYSQLI_ASSOC);
      $pendingnamelist = $row6['name'];
      echo '<div class="btn-group-xs text-right"  role="group" aria-label="..."><a href="profile.php?fid='.$pendinglist.'">'.$pendingnamelist.'</a><button style="margin-left:20px;"class = "btn btn-success accept" value = "'.$pendinglist.'" role="button">Accept</button><button  value = "'.$pendinglist.'"  class = "btn btn-danger decline" role="button">Decline</button></div>';
      echo "<br><br>";
      
     }
    }
    
    if(sizeof($publist)>0){
    echo "<h4>Recommended users to Friend</h4>";
     
      
    
       foreach($publist as $item){
       $pname = mysqli_query($dbc,"SELECT name FROM Users WHERE id = '".$item."'");
       $namerow = mysqli_fetch_array($pname,MYSQLI_ASSOC);
      echo '<a href="profile.php?fid='.$item.'"> '.$namerow['name'].'</a><br>';
      
     }
    }
}

    if($t->num_rows >0){
 ?> 
    
      <h4>Friends  <span style="font-weight:200"> <?php if(isset($mutual)){if($mutual>0){ if($loadprofile != $_SESSION['id']){
      echo '<br>';
      echo "($mutual mutual";  if($mutual>1){echo " friends)";}else{echo " friend)";}}}}?></span></h4>
      <?php
  
     while($row3 = mysqli_fetch_array($t,MYSQLI_ASSOC)){
      if($row3["user_1"] == $loadprofile){
        $friendlist = $row3["user_2"];
      }
      else{
        $friendlist = $row3["user_1"];
      }
  
      $n = mysqli_query($dbc,"SELECT name FROM Users WHERE id = '".$friendlist."'");
      $row4 = mysqli_fetch_array($n,MYSQLI_ASSOC);
      $namelist = $row4['name'];
      echo '<a href="profile.php?fid='.$friendlist.'"> '.$namelist.'</a><br>';
      
          
     }
    }
    

 ?>    
      </div>
<?php } 
   }//end

  $j = mysqli_query($dbc,"SELECT * FROM Users WHERE id = '".$_SESSION['id']."'");
    $rowp = mysqli_fetch_array($j,MYSQLI_ASSOC);
   
  $namep = $rowp['name'];
  $sexp= $rowp['sex'];
  $locationp = $rowp['location'];
  $emailp = $rowp['email'];
  //$join = date('d / m / Y', strtotime($row['date_joined']));
  //$dob = $row['dob'];
  $privacyp = $rowp['privacy'];
  //$date1 = new Datetime("now");
  //$date2 = new DateTime($dob);
  //$interval = $date1->diff($date2);




?>
    </div> <!-- /container -->

    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<!--Add Collection Modal-->
<div class="modal fade" id="addCol" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create a collection</h4>
      </div>
      <div class="modal-body" style="position: relative; left:27%;">
        <input name="content_txt" type="text" id="addText" cols="45" rows="1" placeholder="Enter collection name">
        <button id="addCollection" type="button" class="addItem" data-dismiss="modal">Add</button><!--class="btn btn-default"-->
        <select class="form-control" id ="visability" style="width:100px;" required>
          <option value="E">Everybody</option>
          <option value ="F">Friends</option>
          <option value="FOF">Friends of Friends</option>
          <?php        

            $quer = "SELECT * FROM circles WHERE id = (SELECT circleID FROM circleMembership WHERE userID = '".$_SESSION['id']."')"; //this will return all circles in which user is a member.  
            $circles = mysqli_query($dbc,$quer);    

            while ($view = mysqli_fetch_array($circles)) {
              $circleName = $view['name'];
              
              echo "<option value='$circleName'";
              // if($vis==$circleName){echo 'selected';}
              echo ">".$circleName."</option>";
            }
          ?>
        </select>
        <!-- if circle is chosen then a second text box appears in which you can type the circle name -->
        <!-- <input name="circle_name" type="text" id="chooseCircle" cols="45" rows="1" placeholder="e.g. Football Team" required> -->
        
      </div>
    </div>
    
  </div>
</div>
<!--End of Add Collection Modal-->


<div class="modal fade" id="editinfo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
            Edit Profile Information
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="form" method="POST" class="form-horizontal" role="form">
                         <div class="form-group">
                        <div class="col-sm-12">
                                       <div class="input-group">
                                      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input id="name" name="name" data-validation="length" data-validation-length="min4" class="form-control required" type="text" size="16" value="<?php echo $namep; ?>" autofocus="autofocus" required/>
                            </div>
                        </div>
                
                        </div>
                          <div class="form-group">
                            <div class="col-xs-6">
                         
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
       
                                <select class="form-control" name ="sex" id="sex" required>
                  <option <?php if($sexp=="Male"){echo 'selected';}?>>Male</option>
                  <option <?php if($sexp=="Female"){echo 'selected';}?>>Female</option>
                  <option <?php if($sexp=="Other"){echo 'selected';}?>>Other</option>
                </select>
                      
                        </div>
                        </div>
                        <div class="col-xs-6">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-location-arrow"></i></span></span>
                                <input id="location" name="location" data-validation="length" data-validation-length="min3"   class="form-control required" type="text" size="16" value="<?php echo $locationp; ?>" required/>
                            </div>
                        </div>
                    </div
                       </div>                  
                        <div class="form-group">
                            <div class="col-sm-12">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                <input id="email" name="email" data-validation="email" class="form-control email" type="email" size="16" value="<?php echo $emailp; ?>" required/>
                            </div>
                        </div>
                    </div>
                    <h3 id="errormessage" style="color:red" class="payment-errors text-center"></h3>
          
                
                </form>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
<script>$.validate();</script>
            <div class="modal-footer">
            
                <button id="submitedit" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group"
                           data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>"
                           data-success-text="<span class='glyphicon glyphicon-ok'></span>"
                >
                    Save
                </button>
                
<script>
          var $btn = $('#submitedit');
       $btn.on('click', function(e) {   
       //$btn.prop('disabled', true);
//$btn.button('progress');
  
    $.ajax({
           type: "POST",
           url: "edit.php",
           data: $("#form").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.name) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.name); //Throw relevant error
                                }
                                else if (data.errors.location) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.location); //Throw relevant error
                                }
                                else if (data.errors.repeat) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.repeat); //Throw relevant error
                                }
                            }
                            else {
                                    $('.payment-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                setTimeout(function() {
                $('#editinfo').modal('hide');
            }, 350);
                                }
                            }
                            
      
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.

});
</script>
           </div>
          
            </div>
        </div>
        </div>
        </div>
<div class="modal fade" id="changepassword">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
            Change Password
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="passform" method="POST" class="form-horizontal" role="form">
                
                         <div class="form-group">
                            <div class="col-sm-12">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="oldpassword" name="oldpassword" class="form-control" type="password" size="16" placeholder="Current Password" required/>
                            </div>
                        </div>
                    </div>    
                       <div class="form-group">
                            <div class="col-sm-12">
                           
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="newpassword" name="newpassword" class="form-control" type="password" size="16" placeholder="New Password" required/>
                            </div>
                        </div>
                    </div>                       
                    
                    <h3 id="errormessage" style="color:red" class="pass-errors text-center"></h3>
          
                
                </form>


<script>$.validate();</script>
            <div class="modal-footer">
            
                <button id="passsubmit" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group"
                           data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>"
                           data-success-text="<span class='glyphicon glyphicon-ok'></span>"
                >
                    Save
                </button>
                
                
                <script>
          var $btn = $('#passsubmit');
       $btn.on('click', function(e) {   
       //$btn.prop('disabled', true);
//$btn.button('progress');
  
    $.ajax({
           type: "POST",
           url: "password.php",
           data: $("#passform").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.oldpass) { //Returned if any error from process.php
                                    $('.pass-errors').fadeIn(1000).html(data.errors.oldpass); //Throw relevant error
                                }
                                else if (data.errors.newpass) { //Returned if any error from process.php
                                    $('.pass-errors').fadeIn(1000).html(data.errors.newpass); //Throw relevant error
                                }
                                else if (data.errors.verification) { //Returned if any error from process.php
                                    $('.pass-errors').fadeIn(1000).html(data.errors.verification); //Throw relevant error
                                }
                            }
                            else {
                                    $('.pass-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                setTimeout(function() {
                $('#changepassword').modal('hide');
            }, 350);
                                }
                            }
                            
      
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.

});
</script>
                </div>
          
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
            NOTE: Deleting your account is irreversible!
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <p class="text-center">Are you sure you want to delete your account?</p>
                <form id="form" method="POST" action="delete.php" class="form-horizontal text-center" role="form">
                
                       
                    
           <button id="delete" type="submit" class="btn btn-danger"
                         
                >
                   Delete Account
           </button>
                
                </form>


        
          
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="visibility">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header text-center">
            Who can see your profile?
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <form id="privacyform" method="POST" class="form-horizontal" role="form">
                
                         <div class="form-group">
                            <div class="col-xs-12">
                         
                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
       
                                <select class="form-control" name ="privacy" id="privacy" required>
                  <option value ="3" <?php if($privacyp==3){echo 'selected';}?>>Everyone</option>
                  <option value="2" <?php if($privacyp==2){echo 'selected';}?>>Friends of Friends</option>
                  <option value ="1" <?php if($privacyp==1){echo 'selected';}?>>Friends Only</option>
                </select>
                </div>
                      
                        </div>
                        </div>                   
                    
                    <h3 id="errormessage" style="color:red" class="privacy-errors text-center"></h3>
          
                
                </form>


            <div class="modal-footer">
            
                <button id="privacysubmit" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group"
                
                >
                    Save
                </button>
                
                       <script>
          var $btn = $('#privacysubmit');
       $btn.on('click', function(e) {   
       //$btn.prop('disabled', true);
//$btn.button('progress');
  
    $.ajax({
           type: "POST",
           url: "privacy.php",
           data: $("#privacyform").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.oldpass) { //Returned if any error from process.php
                                    $('.privacy-errors').fadeIn(1000).html(data.errors.privacy); //Throw relevant error
                                }
                              
                            }
                            else {
                                    $('.privacy-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                setTimeout(function() {
                $('#visibility').modal('hide');
            }, 350);
                                }
                                 setTimeout(function() {
                     $('.privacy-errors').empty();
            }, 350);
           
                            }
                            
      
        });

    e.preventDefault(); // avoid to execute the actual submit of the form.

});
</script>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createcircle">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header text-center">
            Create Circle
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      <div class="modal-body">
        <form id="createCircleform" method="POST" class="form-horizontal" role="form">
          <div class="form-group">
            <div class="col-sm-12">
              <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-circle-o"></span></span>   
                <input id="name" name="name" data-validation="length" data-validation-length="min1" class="form-control required" type="text" size="16" placeholder="Circle Name" autofocus="autofocus" required/>
              </div>
            </div>
          </div>              
          <h3 id="errormessage" style="color:red" class="payment-errors text-center"></h3>      
        </form>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
        <script>$.validate();</script>
        <div class="modal-footer">
          <button id="submitcircle" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group" data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>" data-success-text="<span class='glyphicon glyphicon-ok'></span>" >Save </button>
          <script>
            var $btn = $('#submitcircle');
            $btn.on('click', function(e) {   
            $.ajax({
              type: "POST",
              url: "createCircle.php",
              data: $("#createCircleform").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.name) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.name); //Throw relevant error
                                }
                            }
                            else {
                                    $('.payment-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                setTimeout(function() {
                $('#createcircle').modal('hide');
            }, 350);
                                }
                            }
        });
    e.preventDefault(); // avoid to execute the actual submit of the form.
});
</script>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addTocircle">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header text-center">
            Add Friend to Circle
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      <div class="modal-body">
        <form id="addCircleform" method="POST" class="form-horizontal" role="form">
          <div class="form-group">
            <div class="col-sm-12">
              <div class="input-group">
                <span class="input-group-addon"><span class="fa fa-circle-o"></span></span>   
                <select class="form-control" id="circleselect" name ="circleselect" required>
                <?php

                  $r = mysqli_query($dbc,"SELECT * FROM circles WHERE id IN ( SELECT circleID from circlemembership where userID = '".$_SESSION['id']."')");
                  while($row_data = mysqli_fetch_array($r,MYSQLI_ASSOC))
                  {
                    $circleID = $row_data['id'];
                    $circleName = $row_data['name'];
                    echo "<option value=$circleID> $circleName </option>";      
                  }
                  echo"<input type='hidden' id='userID' name='userID' value=$loadprofile>";
                ?>
                </select>
              </div>           
            </div>
          </div>              
          <h3 id="errormessage" style="color:red" class="payment-errors text-center"></h3>      
        </form>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
        <script>$.validate();</script>
        <div class="modal-footer">
          <button id="submitFriendToCircle" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group" data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>" data-success-text="<span class='glyphicon glyphicon-ok'></span>" >Save </button>
          <script>

            var $btn = $('#submitFriendToCircle');
            $btn.on('click', function(e) { 
            $.ajax({
              type: "POST",
              url: "addToCircle.php",
              data: $("#addCircleform").serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.name) { //Returned if any error from process.php
                                    $('.payment-errors').fadeIn(1000).html(data.errors.name); //Throw relevant error
                                }
                            }
                            else {
                                    $('.payment-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                setTimeout(function() {
                $('#addTocircle').modal('hide');
            }, 350);
                                }
                            }
        });
    e.preventDefault(); // avoid to execute the actual submit of the form.
});
</script>
        </div>
      </div>
    </div>
  </div>
</div>
      

        <div class="modal fade" id="addNewPost">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header text-center">
            Add New Post
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      <div class="modal-body">
        <form id="newPostForm" class="form-horizontal" role="form">
          <div class="form-group">
            <div class="col-sm-12">
              <div class="input-group">
                <input id="title" name="title" data-validation="length" data-validation-length="min1" class="form-control required" type="text" size="16" placeholder="Title" autofocus="autofocus" required/>
                 <textarea id="content" name="content" data-validation="length" data-validation-length="min1" class="form-control required" type="text" size="16" placeholder="Content" autofocus="autofocus" required></textarea>
                 <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']?>"/>
              </div>
            </div>
          </div>              
          <h3  style="color:red" class="blog-errors text-center"></h3> 
          <!--<input id="show-btn" type="submit" name="submit" value="Post"/>    --> 
        </form>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
        <script>$.validate();</script>
        <div class="modal-footer">
          <button id="submitpost" type="button" class="btn btn-primary col-sm-12 col-xs-12 form-group" data-progress-text="<span class='glyphicon glyphicon-refresh fa-spin'></span>" data-success-text="<span class='glyphicon glyphicon-ok'></span>">Post</button>
          <script>
            var $btn = $('#submitpost');
            $btn.on('click', function(e) {   
            $.ajax({
              type: "POST",
              url: "post_entry.php",
              data: $('#newPostForm').serialize(), // serializes the form's elements.
    
           success: function(data) {
                            if (!data.success) { //If fails
                                if (data.errors.notitle) { //Returned if any error from process.php
                                    $('.blog-errors').fadeIn(1000).html(data.errors.notitle); //Throw relevant error
                                }
                                if (data.errors.failed) { //Returned if any error from process.php
                                    $('.blog-errors').fadeIn(1000).html(data.errors.failed); //Throw relevant error
                                }
                            }
                            else {
                                    $('.blog-errors').fadeIn(1000).append('<h3 style="color:green">' + data.posted + '</h3>'); //If successful, than throw a success message
                                     setTimeout(function() {
                $('#addNewPost').modal('hide');
            }, 350);
    $("#fblog").load(location.href+" #fblog>*","").addClass("activejumbo");


                                }
                            }
        });
    e.preventDefault(); // avoid to execute the actual submit of the form.
});
</script>
        </div>
      </div>
    </div>
  </div>
</div>

      
  </body>
</html>
<?php

}
?>