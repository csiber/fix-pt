<?php

	class Email{

		public static function sendConfirmationEmail($email, $name, $code)
		{

			//var_dump($email .' '. $name);die:
        //First try......
			$user = array("email" => $email, "name" => $name, "code" => $code);

	        Mail::send('emails.auth.confirmationemail', 
	        			array('code' => $user['code']), function($message) use ($user) {
	                    
	                    $message->to($user['email'], $user['name'])->subject('Welcome '. $user['name'] .'!');
	                	}
	        );
        
	        return null;
		}

		public static function sendResetPassEmail($email, $code)
		{

			$user = array("email" => $email, "code" => $code);

	        Mail::send('emails.auth.resetpassemail', 
	        			array('code' => $user['code']), function($message) use ($user) {
	                    
	                    $message->to($user['email'], "Anonymous")->subject('Reset Password.');
	                	}
	        );
        
	        return null;	
		}

	}

?>