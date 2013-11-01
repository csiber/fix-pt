<?php

	class Email{

		public bool sendEmail()
		{

        //First try......
	        Mail::send('emails.auth.testmail', 
	        			array('id' => 1), function($message) {
	                    $message->to('mainstopable@gmail.com', 
	                    			'instopable')->subject('Welcome!');
	                	}
	        );
        //Second try.......... 
	        {
	            $to = 'mainstopable@gmail.com';
	            $subject = 'Testing sendmail.exe';
	            $message = 'Hi, you just received an email using sendmail!';
	            $headers = 'From: ldsot3g3@gmail.com' . "\r\n" .
	                    'Reply-To: ldsot3g3@gmail.com' . "\r\n" .
	                    'MIME-Version: 1.0' . "\r\n" .
	                    'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
	                    'X-Mailer: PHP/' . phpversion();
	            mail($to, $subject, $message, $headers);
	        }
		}

	}

?>