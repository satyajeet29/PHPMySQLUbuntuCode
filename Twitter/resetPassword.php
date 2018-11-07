<?php

	if (empty($_REQUEST["email"])) {

		$returnArray["status"] = "400";
		$returnArray["message"]= "Missing required information";
		echo json_encode($returnArray);
		return;

	}
	
	// STEP 1. Get information passed to this file
		$email = htmlentities($_REQUEST["email"]);

	// STEP 2. Build connection, secure way to build a connection
		$file = parse_ini_file("Twitter.ini");

		// store in php var inf from ini var
			$host = trim($file["dbhost"]);
			$user = trim($file["dbuser"]);
			$pass = trim($file["dbpass"]);
			$name = trim($file["dbname"]);

// include access.php to call function from access.php file
require("access.php");
$access = new access($host, $user, $pass, $name);
$access->connect();


// STEP 3. Check if email is found in db as registered email address
// store all results of function in $user variable
$user = $access->selectUserViaEmail($email);

	// if there is any information stored in $user variable
	if (empty($user)) {
		
		$returnArray["message"] = "Email not found";
		echo json_encode($returnArray);
		return;

	}


//STEP 4. Emailing 
// include email.php	
require ("templates/email.php");

//store all class in $emal variable
$email = new email();
 
//store generated unique string token in $token var
$token = $email->generateToken(20);

// store unique token in our database
$access->saveToken("passwordTokens", $user["id"], $token);

//refer emailing information
$details 		= array();
$details["subject"] 	= "Password request sent on Twitter";
$details["to"]		= $user["email"];
$details["fromName"]	= "Satyajeet Pradhan";
$details["fromEmail"]	= "satyajeet.pradhan@gmail.com";

//access html template file
$template = $email->resetPasswordTemplate();
$template = str_replace("{token}",$token, $template);
$details["body"] = $template;

//Send email to user
$email->sendEmail($details);

//STEP 5. Return message to mobile app
$returnArray["email"]   = $user["email"];
$returnArray["message"] = "We have sent you a email to reset password";
echo json_encode($returnArray);

//STEP 6. Close connection
$access->disconnect();
?>
