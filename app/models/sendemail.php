<?php

	class Email{

		public static function sendConfirmationEmail($email, $name, $code)
		{

			//var_dump($email .' '. $name);die:
        //First try......
			$user = array("email" => $email, "name" => $name, "code" => $code, "base_url" => URL::to('/'));

	        Mail::send('emails.auth.confirmationemail', 
	        			array('code' => $user['code'], 'base_url' => $user['base_url']), function($message) use ($user) {
	                    
	                    $message->to($user['email'], $user['name'])->subject('Welcome '. $user['name'] .'!');
	                	}
	        );
        
	        return null;
		}

		public static function sendResetPassEmail($email, $code)
		{

			$user = array("email" => $email, "code" => $code, "base_url" => URL::to('/'));

	        Mail::send('emails.auth.resetpassemail', 
	        			array('code' => $user['code'], 'base_url' => $user['base_url']), function($message) use ($user) {
	                    
	                    $message->to($user['email'], "Anonymous")->subject('Reset Password.');
	                	}
	        );
        
	        return null;	
		}

		public static function sendNotificationEmail($email, $text)
		{
			$user = array("email" => $email, "emailbody" => $text, "base_url" => URL::to('/'));

	        Mail::send('emails.auth.notificationemail', 
	        			array('emailbody' => $user['emailbody'], 'base_url' => $user['base_url']), function($message) use ($user) {
	                    
	                    $message->to($user['email'], "Anonymous")->subject('Notification.');
	                	}
	        );
        
	        return null;	
		}

	}

?>