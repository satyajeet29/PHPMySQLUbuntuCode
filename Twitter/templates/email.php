<?php
class email{


	function generateToken($length){
		
		//some characters
		$characters = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCBNMJ1234567890";
		
		//get length of character string
		$charactersLength = strlen($characters);

		$token = '';

		// generate every time until characters length is less than $charactersLength
		for ($i = 0; $i < $length; $i++){
			
			$token .= $characters[rand(0, $charactersLength-1)];
		
		}
		
		return $token;

	}


	//Open confirmation
	function confirmationTemplate(){
		
		// variable to store file name
		// Note: The path of the file needs to be referred keeping in mind from where a given file is being referred, in this cas it's registet.php or access.php so make sure
		// to define the path folder relative to it <SP><12/19/2017>
		$filename = "templates/confirmationtemplate.html";
		

		// check if file exists
	/*
		if (file_exists($filename)){
		
			echo "The file $filename exists";		

		} else {

			echo "The file $filename doesn't exist";		

		}
	*/
		//echo "</br>";
		// open file
		//$file = fopen($filename,"r") or die("Unable to open file");
		$file = fopen($filename,"r") or die("Unable to open a file");		


		//store content of file in $template var
		$template = fread($file, filesize($filename));

		fclose($file);

		return $template;
	}

	//User reset of password
	function resetPasswordTemplate(){

		$filename = "templates/resetPasswordTemplate.html";

		//open file
		$file = fopen($filename,"r") or die("Unable To Open File");			

		//store content of file in $template var
		$template = fread($file, filesize($filename));

		fclose($file);

		return $template;
	}
	
	//Send email with php
	function sendEmail($details){

		$subject 	= $details["subject"]	;
		$to 		= $details["to"]	;
		$fromName 	= $details["fromName"]	;
		$fromEmail 	= $details["fromEmail"]	;
		$body 		= $details["body"]	;
		
		// header required by some of smtp or mail sites
		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;content=UTF-8" . "\r\n";
		$headers .= "From: " . $fromName . " <" . $fromEmail . ">" . "\r\n";

		//php function to send email finally
		mail($to, $subject, $body, $headers);

	}
}
?>
