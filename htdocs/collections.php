<?php
require_once('db_connect.php');   
require_once('tablecheck.php');     
$photoId = 1;
$owner = 1; //loadprofile
$user = 1; //session_id
?>

<!DOCTYPE html>
<html>
<head>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> <!-- need this - who knew? -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$("#addCollection").click(function(e){
		// alert('adding a collection');
		if($("#contentText").val()==='')
        {
            alert("Please enter some text!");
            return false;
        }

        var myData = 'content_txt='+ $("#add").val()+'&user='+ <?php echo $user; ?>;

        $.ajax({
	        type: "POST", // HTTP method POST or GET
	        url: "addcollection.php", //Where to make Ajax calls
	        dataType:"text", // Data type, HTML, json etc.
	        data:myData,
	        success:function(response){
	            $("#tableCol").append(response); //responds -> <ul>
	            $("#add").val(''); //empty text field on successful

	        },
	        error:function (xhr, ajaxOptions, thrownError){
	            $("#addCollection").show(); //show submit button
	            alert(thrownError);
	        }
        });
	});
});
$(document).ready(function() {
	$("body").on("click","#collectionBox .deleteCol",function (e) {
		// alert('trying to delete collection');

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
	        },        
	        error:function (xhr, ajaxOptions, thrownError){
	            alert('oh bollocks');
	        }
        });
	});
});
$(document).ready(function() {
	$("body").on("click","#collectionBox .view",function (e) {

		var myData = 'user='+ <?php echo $user ?>+'&albumId='+ $(this).attr('id');
		$.post("photos.php #hi",myData,function(data){
			$("#collectionBox").html(data);
		});
	});
});
</script>



</head>
<body>

	<h2><strong>Collections</strong></h2>
      <br>

      <?php
          if(isset($loadprofile)&&isset($_SESSION['id'])){
            $owner = $loadprofile;
            $user = $_SESSION['id'];
          }
          else{
            $owner = 1;
            $user = 1;
          }
          

          // echo 'owner: '.$loadprofile.' and the user: '.$_SESSION['id'];
        ?>
   
        <div id="collectionBox" style="background-color:white; padding: 30px; position:absolute; top:3px; left:0.2vw; width:565px;">
        <h2><strong>Collections</strong></h2>

        <div id="hola">              
          
          <div id="collectionGrid" style="background-color:white; width:500px;">
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

                echo "<td>";
                //whole box
                echo "<div style='position:relative;'>"; 
                //delete button
                if($owner==$user){
                  echo "<a class='deleteCol' id='".$albumId."'>";
                    echo "<div style='background-color:white; margin:6px; height:30px; width:30px; opacity:0.5; right:0; position:absolute; z-index:100;'>";
                      //image
                      echo "<img src='icons/close.png' style='height:30px; ' />";
                    echo "</div>";
                  echo "</a>";
                }
                  //main button
                  echo "<a class='view' id='".$albumId."'>";
                    echo "<div style='margin:7px; width:150px; height:150px; background-color:dodgerblue; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); float:left;'>";
                      echo "<p style='font-size:30px; text-align: center; position: relative; top: 50%; transform: translateY(-50%); color:powderblue;'>".$name."</p>";
                    echo "</div>";
                  echo "</a>";
                echo "</div>";
                echo "</td>";

                $i++;
            }

            //add collection pop-up
            
            if($i==3){
              //close the table
              echo "</tr>";
              echo "</table>";

              //add collection square
              if($owner==$user){
                echo "<td>";
                echo '<button style="margin:7px; width:150px; height:150px; background-color:whitesmoke; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); float:left;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addCol">';
                echo '<p style="font-size:30px; position: relative; top: 50%; transform: translateY(10%); color:grey;">ADD</p>';
                echo '</button>';

                echo "</td>";
              }
            }
            else{
              //add collection square
              if($owner==$user){
                echo "<td>";
                echo '<button style="margin:7px; width:150px; height:150px; background-color:whitesmoke; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); float:left;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addCol">';
                echo '<p style="font-size:30px; position: relative; top: 50%; transform: translateY(10%); color:grey;">ADD</p>';
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
		        <div class="modal-body">
		        	<textarea name="content_txt" id="add" cols="45" rows="1" placeholder="Enter collection name"></textarea>
		        	<button id="addCollection" class="btn btn-default" data-dismiss="modal">Add</button>
		        </div>
		      </div>
		      
		    </div>
	    </div>
</body>
</html>