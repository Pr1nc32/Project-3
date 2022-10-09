<?php

	
	function getRandomString($n) {
		
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	  
	    for ($i = 0; $i < $n; $i++) {
	        $index = rand(0, strlen($characters) - 1);
	        $randomString .= $characters[$index];
	    }
	  
	    return $randomString;
	}

	function send_mail($to, $subject, $message, $headers){

		

		if(true){
			return mail($to, $subject, $message, $headers);
		}

		return false;

	}

?>