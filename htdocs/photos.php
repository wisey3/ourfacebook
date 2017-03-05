

<?php
require_once('db_connect.php');   
require_once('tablecheck.php');

if(isset($_POST['user'])&&isset($_POST['albumId'])){
	$user = $_POST['user'];
	$albumId = $_POST['albumId'];

	$quer = "SELECT * FROM album WHERE albumID = '".$albumId."'";
    $album = mysqli_query($dbc,$quer);
    $row = mysqli_fetch_array($album);
	$name = $row['albumName'];
}
else{
	$user = 4;
	$albumId = 7;
	$name = 'poppy';
}

	// echo 'this is the albumId you entered '.$albumId.' and the name of the album '.$name;
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
	$("#addPhoto").click(function(e){ 
		// alert('adding a photo here <?php echo $name ?>');
		var formData = new FormData();

  		formData.append('img', $('input[type=file]')[0].files[0]);
  		formData.append('album','<?php echo $albumId?>');

        $.ajax({
	        type: "POST", // HTTP method POST or GET
	        url: "addPhoto.php", //Where to make Ajax calls
	        data:formData,
	        contentType: false,
	    	processData: false,
	        success:function(response){
	        	$("#tablePho").append(response);
	        	// alert('yay');
	        },        
	        error:function (xhr, ajaxOptions, thrownError){
	            alert('oh bollocks');
	        }
        });
	});
});
$(document).ready(function() {
	$("body").on("click","#collectionBox .deleteImg",function (e) {
		// alert('trying to delete image');

		var myData = 'photoID='+ $(this).attr('id')+'&type=Photo';

		// alert(myData);
		$(this).closest('td').remove();

		$.ajax({
	        type: "POST", // HTTP method POST or GET
	        url: "deleteimage.php", //Where to make Ajax calls
	        data:myData,
	        dataType: "text",
	        success:function(data){        	
	        	alert('Image Deleted');
	        },        
	        error:function (xhr, ajaxOptions, thrownError){
	            // $("#addCollection").show(); //show submit button
	            alert('oh bollocks');
	        }
        });
	});
});
$(document).ready(function() {
	$("body").on("click","#collectionBox .img",function (e) {
		// alert('clicked on image');

		var myData = 'user='+<?php echo $user ?>+'&photoId='+$(this).attr('id');
		$.post("image.php #hey",myData,function(data){
			$("#collectionBox").html(data);
		});
	});
});
$(document).ready(function() {
	$("body").on("click","#collectionBox .FormSubmit",function (e) {
		// alert('posting a comment');
		e.preventDefault();

		if($("#contentText").val()==='')
        {
            alert("Please enter some text!");
            return false;
        }

        var myData = 'content_txt='+ $("#contentText").val()+'&user='+ <?php echo $user; ?>+'&photoId='+$(this).attr('id')+'&albumId='+<?php echo $albumId; ?>;

        $.ajax({
            type: "POST", // HTTP method POST or GET
            url: "addComment.php", //Where to make Ajax calls
            dataType:"text", // Data type, HTML, json etc.
            data:myData,
            success:function(response){
                $("#responds").append(response); //responds -> <ul>
                $("#contentText").val(''); //empty text field on successful

            },
            error:function (xhr, ajaxOptions, thrownError){
                $("#FormSubmit").show(); //show submit button
                alert(thrownError);
            }
        });		
	});	            
});
</script>




</head>
<body>

	<div id="collectionBox" style="background-color:whitesmoke; padding: 30px; position:absolute; left:0.1vw; width:565px;">
		<!--whole page-->
		<div id="hi" style="position:relative; top:-30px;"> 

			<div id="collectionGrid" style="background-color:white; width:500px;">
				<div>
					<?php
					$quer = "SELECT * FROM photo WHERE albumID = '$albumId'";
					$photos = mysqli_query($dbc,$quer);					

					$maxcols = 3;
					$i = 0;

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

					    
					    echo "<td>";
					    //main box
					    echo "<div style='position:relative;'>"; 
					    	echo "<a class='deleteImg' id=".$photoNum.">";
							    echo "<div style='background-color:white; margin:6px; height:30px; width:30px; opacity:0.5; right:0; position:absolute; z-index:100;'>";
							    	//image
							    	echo "<img src='icons/close.png' style='height:30px; ' />";
							    echo "</div>";
						    echo "</a>";
					    	//image button
					    	echo "<div style='margin:7px; width:150px; height:150px; background-color:skyblue; float:left; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); overflow:hidden;'>";

						    list($width,$height) = getimagesize(''.$photoName.'');
						    if($width>$height){
						    	echo "<a class='img' id='".$photoNum."'>";
	                            	echo "<img src='".$photoName."' height='150px'>";
	                            echo "</a>"; //align center vertically
	                        }
	                        else{
	                        	echo "<a class='img' id='".$photoNum."'>";
	                            	echo "<img src='".$photoName."' width='150px'>";
	                            echo "</a>"; //align center horizontally
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
						echo "<td>";
						echo '<button style="margin:7px; width:150px; height:150px; background-color:lightgrey; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); float:left;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPhot">';
						echo '<p style="font-size:30px; position: relative; top: 50%; transform: translateY(10%); color:grey;">ADD</p>';
						echo '</button>';

					    echo "</td>";

					}
					else{
						//add photo square
						echo "<td>";
						echo '<button style="margin:7px; width:150px; height:150px; background-color:lightgrey; box-shadow: 1px 2px 4px rgba(0, 0, 0, .5); float:left;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addPhot">';
						echo '<p style="font-size:30px; position: relative; top: 50%; transform: translateY(10%); color:grey;">ADD</p>';
						echo '</button>';

					    echo "</td>";

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
		        <div class="modal-body">
		        
		        	<form method="post" id="uploadForm" action=" " enctype="multipart/form-data">
						<input style="margin-left:30%;" type="file" name="addP" id="addP">
						<br>
						<br>
						<button style="margin-left:40%; position:relative; bottom:0px;" class="btn btn-default" data-dismiss="modal" id="addPhoto" name="submit">Add</button>
						<!-- <input type="submit" value="Add" class="btn btn-default" data-dismiss="modal" id="addPhoto" name="submit"> -->
						<br>
						<br>
						
					</form> 
		        </div>
		      </div>		      
		    </div>
	    </div>
</body>
</html>
