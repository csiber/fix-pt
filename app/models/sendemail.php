<?php

	class Email{

		public static function sendEmail($email, $name)
		{

			//var_dump($email .' '. $name);die:
        //First try......
			$user = array("email" => $email, "name" => $name);

	        Mail::send('emails.auth.testmail', 
	        			array('id' => 1), function($message) use ($user) {
	                    
	                    $message->to($user['email'], $user['name'])->subject('Welcome '. $user['name'] .'!');
	                	}
	        );
        
	        return null;
		}

	}

?>