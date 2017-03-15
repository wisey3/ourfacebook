<?php

    session_start();

    if (isset($_GET['name']) && isset($_SESSION['id'])): 
      $circleNumber = $_GET['name'];
      $userID = $_SESSION['id'];
      require_once('../db_connect.php');
      $getCircles = "SELECT * FROM circlemembership WHERE userID = '".$userID."' AND circleID = '".$circleNumber."'";       
      $circleResults = mysqli_query($dbc,$getCircles);
      if (mysqli_num_rows($circleResults) < 1) {
        echo "time";
        header("Location: ../profile.php");
        die();
      }
      else {
        $file =  $circleNumber;
        $getUserName = "SELECT * FROM Users WHERE id = '".$userID."'";       
        $userResults = mysqli_query($dbc,$getUserName);
        while($row_data = mysqli_fetch_array($userResults,MYSQLI_ASSOC))
        {
         $userName = $row_data['name'];   
        }
        $getCircleName = "SELECT * FROM circles WHERE id = '".$circleNumber."'";       
        $circleResults = mysqli_query($dbc,$getCircleName);
        while($row_data = mysqli_fetch_array($circleResults,MYSQLI_ASSOC))
        {
         $circleName = $row_data['name'];   
        }
      }  
      

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="main.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
      var chat = new Chat('<?php echo $file; ?>');
      chat.init();
      var name = '<?php echo $userName;?>';
    </script>
    <script type="text/javascript" src="settings.js"></script>

</head>
<body>
    <div id="page-wrap">
      <div id="section">    
      <h3> <?php echo $circleName;?></h3>
            <div id="chat-wrap">
                <div id="chat-area"></div>
            </div>
            <form id="send-message-area" action="">
                <textarea id="sendie" maxlength='100'></textarea>
            </form> 
        </div>
    </div>      
</body>
</html>

<?php
    else:
            header('Location: http://pizzarat.info/profile.php');
    endif; 
?>