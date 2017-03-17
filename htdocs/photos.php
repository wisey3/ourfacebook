

<?php
require_once('db_connect.php');   
require_once('tablecheck.php');

if(isset($_POST['user'])&&isset($_POST['albumId'])){
	$user = $_POST['user'];
	$albumNum = $_POST['albumId'];

	$quer = "SELECT * FROM album WHERE albumID = '".$albumNum."'";
    $album = mysqli_query($dbc,$quer);
    $row = mysqli_fetch_array($album);
	$name = $row['albumName'];
	$owner = $row['userID'];
	$vis = $row['viewStatus'];
}
else{
	$user = 4;
	$albumId = 7;
	$name = 'poppy';
}

	// echo 'this is the album num '.$albumNum.' and this is the current user '.$user;
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/photoStyle.css">

<script type="text/javascript">
var count = 0;
$(document).ready(function() {
	$("#addPhoto").click(function(e){ 
		// alert('adding a photo here '+<?php echo $albumNum ?>);
		count++;

		if(count==1){ //to stop the rabbit hole multi send loop thing
			var formData = new FormData();

	  		formData.append('img', $('input[type=file]')[0].files[0]);
	  		formData.append('album','<?php echo $albumNum?>');

	        $.ajax({
		        type: "POST", // HTTP method POST or GET
		        url: "addPhoto.php", //Where to make Ajax calls
		        data:formData,
		        contentType: false,
		    	processData: false,
		        success:function(response){
		        	$("#tablePho").append(response);
		        	count = 0;
		        	// alerst('yay');
		        },        
		        error:function (xhr, ajaxOptions, thrownError){
		            alert('oh bollocks');
		        }
	        });
	    }
	});
});
$(document).ready(function() {
	$("body").on("click","#collectionBox .deleteImg",function (e) {
		// alert('trying to delete image');
		count++;

		if(count==1){ //to stop the rabbit hole multi send loop thing

			var myData = 'photoID='+ $(this).attr('id')+'&type=Photo';

			$(this).closest('td').remove();

			$.ajax({
		        type: "POST", // HTTP method POST or GET
		        url: "deleteimage.php", //Where to make Ajax calls
		        data:myData,
		        dataType: "text",
		        success:function(data){        	
		        	// alert('Image Deleted');
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
	$("body").on("click","#collectionBox .img",function (e) {		
		// alert('clicked on image');
		count++;

		if(count==1){ //to stop the rabbit hole multi send loop thing
        	// alert('about to look at this photo which is in album '+<?php echo $albumNum ?>+' or is actually '+$(this).attr('name'));

			var myData = 'user='+<?php echo $user ?>+'&photoId='+$(this).attr('id')+'&album='+$(this).attr('name');
			$.post("image.php #hey",myData,function(data){
				$("#collectionBox").html(data);
				count = 0;
			});
		}
	});
});
$(document).ready(function(){
	$("body").on("click","#collectionBox .backButton",function (e) {
		count++;
		if(count==1){/*to stop the rabbit hole multi send loop thing*/
			var toWhere = $(this).attr('id');
			if(toWhere=='toCollection'){
				// alert('leaving photos');
				var myData = 'user='+ <?php echo $user ?>+'&owner='+<?php echo $owner ?>+'&albumId='+<?php echo $albumNum ?>;
				$.post("collections.php",myData,function(data){
					$("#collectionBox").html(data);
					count = 0;
				});
			}
			else if(toWhere=='toPhotos'){
				// alert('leaving image');				
				// alert('going to collection '+$(this).attr('name')+' or maybe '+<?php echo $albumNum ?>);
				var myData = 'user='+ <?php echo $user ?>+'&albumId='+$(this).attr('name');
				$.post("photos.php",myData,function(data){
					$("#collectionBox").html(data);
					count = 0;
				});
			}
		}
	});
});
$(document).ready(function() {
	$("body").on("click","#commentBox .FormSubmit",function (e) {
		e.preventDefault();
		count++;

		if(count==1){ //to stop the rabbit hole multi send loop thing

			var myData = 'content_txt='+ $("#contentText").val()+'&user='+ <?php echo $user; ?>+'&photoId='+$(this).attr('id')+'&albumId='+<?php echo $albumNum; ?>;

	        $.ajax({
	            type: "POST", // HTTP method POST or GET
	            url: "addComment.php", //Where to make Ajax calls
	            dataType:"text", // Data type, HTML, json etc.
	            data:myData,
	            success:function(response){
	                $("#responds").append(response); //responds -> <ul>
	                $("#contentText").val(''); //empty text field on successful
	                count = 0;

	            },
	            error:function (xhr, ajaxOptions, thrownError){
	                $("#FormSubmit").show(); //show submit button
	                alert(thrownError);
	            }
	        });	

		}		
	});	            
});
$(document).ready(function() {
	$("body").on("click","#hi .change",function (e) {
		e.preventDefault();
		count++;

		if(count==1){ //to stop the rabbit hole multi send loop thing

			// alert($(this).attr('name'));

			var myData = 'viewStatus='+$('#vis').val()+'&albumId='+$(this).attr('name');

	        $.ajax({
	            type: "POST", // HTTP method POST or GET
	            url: "changeView.php", //Where to make Ajax calls
	            dataType:"text", // Data type, HTML, json etc.
	            data:myData,
	            success:function(data){
	            	alert('Visibility changed!');
	                count = 0;

	            },
	            error:function (xhr, ajaxOptions, thrownError){
	                // $("#FormSubmit").show(); //show submit button
	                alert(thrownError);
	            }
	        });
		}		
	});	            
});
</script>




</head>
<body>

	<div id="collectionBox" style=" padding: 30px; position:absolute; left:0vw; width:565px;">
		<!--whole page-->
		<div id="hi" style="left:30px;">
		<a class="backButton" id="toCollection" ><div style="position:absolute; left:-12px; top:-7px;"><img style="height:30px; opacity:0.5;" src="icons/backarrow.png"/></div></a>
		<?php if($user==$owner){
		echo "<div' style='position:absolute; top=:-10px; right:10px;'>";
			echo "<select class='form-control' id ='vis' style='width:150px; float:left;' required>";
				echo "<option value='' disabled>Change Visibility</option>";
				echo "<option value='E'";
				  if($vis=='E'){
				  	echo 'selected';}
					  echo ">Everybody</option>";
				echo "<option value ='F'";
				  if($vis=='F'){
				  	echo 'selected';}
					  echo ">Friends</option>";
				echo "<option value='FOF'";
				if($vis=='FOF'){
				  	echo 'selected';}
				  echo ">Friends of Friends</option>";
			  

			  	$quer = "SELECT * FROM circles WHERE id = (SELECT circleID FROM circleMembership WHERE userID = '$user')"; //this will return all circles in which user is a member.  
				$circles = mysqli_query($dbc,$quer);		

				while ($view = mysqli_fetch_array($circles)) {
					$circleName = $view['name'];
					
					echo "<option value='$circleName'";
					if($vis==$circleName){echo 'selected';}
					echo ">".$circleName."</option>";
				}		          
			echo "</select>";
			echo "<button id='changeVis' type='button' name='$albumNum' class='change' data-dismiss='modal' style='height:34px;'>Save</button>";
		echo "</div>";
		}
		else{
			echo '<br>';
		}?>
		<div <?php if($owner==$user){?> style="position:relative; left:30px; top:-30px;"<?php } ?>>
			<div>
				<h2><strong>Collections ></strong> <i style="font-size: 25px;"><?php echo $name ?></i></h2>

			</div>

			<div id="collectionGrid" style=" width:500px;">
				<div>
					<?php

					$quer = "SELECT * FROM photo WHERE albumID = '$albumNum'";
					$photos = mysqli_query($dbc,$quer);					

					$maxcols = 3;
					$i = 0;

					if(($photos->num_rows==0)&&($owner!=$user)){
						echo 'The collection "'.$name.'" has no photos';
					}

					//Open the table and its first row
					echo "<table id='tablePho'>";
					echo "<tr>";
					while ($image = mysqli_fetch_array($photos)) {

					    if ($i == $maxcols) {
					        $i = 0;
					        echo "</tr><tr>";
					    }

					    $photoNum = $image['photoID'];
					    $photoName = $image['refLoc'];
					    $albumId = $image['albumID'];

					    // $albumNum = $albumId;

					    
					    echo "<td>";
					    //main box
					    echo "<div style='position:relative;'>";
					    //delete box 
					    if($owner==$user){ 
					    	echo "<a class='deleteImg' id=".$photoNum.">";
							    echo "<div id='deleteX'>";
							    	//image
							    	echo "<img src='icons/close.png' style='height:30px; ' />";
							    echo "</div>";
						    echo "</a>";
						}
					    	//image button
					    	echo "<div id='imageSquare'>";

						    list($width,$height) = getimagesize(''.$photoName.'');
						    if($width>$height){
						    	echo "<a class='img' id='".$photoNum."' name='".$albumId."'>";
	                            	echo "<img src='".$photoName."' height='150px' style='image-orientation: 0deg;'>";
	                            echo "</a>";
	                        }
	                        else{
	                        	echo "<a class='img' id='".$photoNum."' name='".$albumId."'>";
	                            	echo "<img src='".$photoName."' width='150px' style='image-orientation: 0deg;'>";
	                            echo "</a>";
	                        }
			    			
					    	echo "</div>";
					    echo "</td>";

					    $i++;
					}

					if($i==3){
						//close the table
						echo "</tr>";
						echo "</table>";

						//add photo square
						if($owner==$user){ 
							echo "<td>";
							echo '<button id="addButton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPhot">';
							echo '<p id="addButtonText">ADD</p>';
							echo '</button>';

						    echo "</td>";
						}

					}
					else{
						//add photo square
						if($owner==$user){ 
							echo "<td>";
							echo '<button id="addButton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPhot">';
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
		</div> 
		</div>
		<!--Add Photo Modal-->
		<div class="modal fade" id="addPhot" role="dialog">
		    <div class="modal-dialog">		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Upload a photo</h4>
		        </div>
		        <div class="modal-body" style="position: relative; left: 30%;">
		        
		        	<form method="post" id="uploadForm" action=" " enctype="multipart/form-data">
						<input  type="file" name="addP" id="addP"> <!--style="margin-left:30%;"-->
						<br>
						<br>
						<button style="margin-left:10%; position:relative; bottom:0px;" class="btn btn-default" data-dismiss="modal" id="addPhoto" name="submit">Add</button>
						<br>
						<br>
						
					</form> 
		        </div>
		      </div>		      
		    </div>
	    </div> 		
	</div>

	 
</body>
</html>

