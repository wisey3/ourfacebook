<?php
require_once('db_connect.php');   
require_once('tablecheck.php');     
if(isset($_POST['owner'])&&isset($_POST['user'])){
  $owner = $_POST['owner'];
  $user = $_POST['user'];
  $albumId = $_POST['albumId'];
}
else{
  $owner = 1;
  $user = 1;
} 
?>

<!DOCTYPE html>
<html>
<head>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<!-- <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>  -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> <!-- need this - who knew? -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
var count = 0;
$(document).ready(function() {
	$("#addCollection").click(function(e){
		// alert('adding a collection');
    count++;

    if(count==1){ //to stop the rabbit hole multi send loop thing
  		if($("#addText").val()==='')
      {
          alert("Please enter some text!");
          return false;
      }

      var myData = 'content_txt='+ $("#addText").val()+'&user='+ <?php echo $user; ?>; //replacing this with a <br>

      $.ajax({
          type: "POST", // HTTP method POST or GET
          url: "addcollection.php", //Where to make Ajax calls
          dataType:"text", // Data type, HTML, json etc.
          data:myData,
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
		// alert('trying to delete collection');
    count++;

    if(count==1){ //to stop the rabbit hole multi send loop thing

  		var myData = 'albumID='+ $(this).attr('id')+'&type=Collection';

  		// alert(myData);
  		$(this).closest('td').remove();

  		$.ajax({
          type: "POST", // HTTP method POST or GET
          url: "deleteimage.php", //Where to make Ajax calls
          data:myData,
          dataType: "text",
          success:function(data){        	
          	alert('Collection Deleted');
            count = 0;
          },        
          error:function (xhr, ajaxOptions, thrownError){
              alert('oh bollocks');
          }
      });
    }
	});
});
$(document).ready(function() {
	$("body").on("click","#collectionBox .view",function (e) {
    count++;

    if(count==1){ //to stop the rabbit hole multi send loop thing
      // alert('looking at album '+$(this).attr('id'));

  		var myData = 'user='+ <?php echo $user ?>+'&albumId='+ $(this).attr('id');
  		$.post("photos.php",myData,function(data){
  			$("#collectionBox").html(data);
        count = 0;
  		});
    }
	});
});
</script>



</head>
<body>
   
        <div id="collectionBox" >
        

        <div id="hola" class="collectionInsert"> 
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

        function viewCheck(&$user, &$albumID,&$dbc){ //put this out of this bit somewhere so that collection.php can use it
          $query = "SELECT * FROM album WHERE albumID = '".$albumID."'";
          $result = mysqli_query($dbc,$query);
          $album = mysqli_fetch_array($result);



          $vis = $album['viewStatus'];
          $owner = $album['userID'];

          // echo $album['albumName'].' can be seen by '.$vis;

          if($user<$owner){
            $smol = $user;
            $big = $owner;
          }
          else if($user==$owner){
            return true;
          }
          else{
            $smol = $owner;
            $big = $user;
          }

          if($vis=='E'){ //everyone
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
          
          <div id="collectionGrid">
            <div>
            <?php
            
            $quer = "SELECT * FROM album WHERE userID = '".$owner."'"; //loadprofile anyway as thats what you want to see
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
                      echo "<img src='iconic/close.png' height='30px' />";
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

            //add collection pop-up
            
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
        
        </div>

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
              <select class="form-control" id ="visability" style="width:150px;" required>
                <option value="E">Everybody</option>
                <option value ="F">Friends</option>
                <option value="FOF">Friends of Friends</option>
                <?php
                $quer = "SELECT * FROM circles WHERE id = (SELECT circleID FROM circleMembership WHERE userID = '$user')";
                $circles = mysqli_query($dbc,$quer);    

                while ($view = mysqli_fetch_array($circles)) {
                  $circleName = $view['name'];
                  
                  echo "<option value='$circleName'";
                  echo ">".$circleName."</option>";
                }
                ?>
              </select>              
            </div>
          </div>
          
        </div>
      </div>
      <!--End of Add Collection Modal-->

    
</body>
</html>