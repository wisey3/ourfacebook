<?php
  require_once('../db_connect.php');
  require('safeCrypto.php');
  $function = htmlentities(strip_tags($_POST['function']), ENT_QUOTES);
	$file = htmlentities(strip_tags($_POST['file']), ENT_QUOTES);
    
  $log = array();
    
    switch ($function) {
    
    	 case ('getState'):
    	 
        	 if (file_exists($file)) {
               $lines = file($file);
        	 }
             $log['state'] = count($lines);
               
        	 break;	
        	 
    	 case ('send'):
    	 
		     $nickname = htmlentities(strip_tags($_POST['nickname']), ENT_QUOTES);
			 $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			 $blankexp = "/^\n/";
			 $message = htmlentities(strip_tags($_POST['message']), ENT_QUOTES);
			 
    		 if (!preg_match($blankexp, $message)) {
            	
    			 if (preg_match($reg_exUrl, $message, $url)) {
           			$message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
    			 }

                $string = "<span>". $nickname . "</span>" . $message = str_replace("\n", " ", $message) . "";
                $key='Wh3nP1zzaRatB3AC0m1ng1b3aL3av1ng'; 
                $string=convert($string,$key); 
                fwrite(fopen($file, 'a'), "". $string . "\n" );
    		 }
    		 
        	 break;
    	
    }
    
    echo json_encode($log);

?>