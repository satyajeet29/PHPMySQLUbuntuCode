<?php
	
	//Debug step 1:
	//	echo '</br></br>Register.php $password:	' . $password . '</br></br>';	


	// if GET or POST are empty
	if (empty($_REQUEST["username"]) || empty($_REQUEST["password"]) || empty($_REQUEST["email"]) || empty($_REQUEST["fullname"])) {
		$returnArray["status"] 	= "400"					;
		$returnArray["message"] = "Missing required information"	;	
		echo json_encode($returnArray)					;
		return								;
	}

        // STEP 1. Declare parameters of user information
        // Securing information and storing variables
        $username        = htmlentities($_REQUEST["username"])  ;
        $password        = htmlentities($_REQUEST["password"])  ;
        $email           = htmlentities($_REQUEST["email"])     ;
        $fullname        = htmlentities($_REQUEST["fullname"])  ;
	// secure password
	$salt = openssl_random_pseudo_bytes(20);
	$secured_password = sha1($password . $salt);
	

	//Debug step 2:
	//echo 'Register.php   $secured_password: ' . $secured_password . '</br></br>';

	//Debug step 3:
       // echo 'Register.php    $salt: ' . $salt . '</br></br>';



	//STEP 2. Build a connection
	// Build connection
	//Secure the way to build connection
	$file = parse_ini_file("Twitter.ini");

	$host = trim($file["dbhost"]);
	$user = trim($file["dbuser"]);
	$pass = trim($file["dbpass"]);
	$name = trim($file["dbname"]);

	// include access.php to call func from access.php file
	require("access.php");
	$access = new access($host, $user, $pass, $name);
	$access->connect();

	//STEP 3. Insert user information
	$result = $access->registerUser($username, $secured_password, $salt, $email, $fullname);

		// succesfully registered
		if($result) {
			
			// got current registered user information	
			$user = $access->selectUser($username);
		
			// declare information to feedback to user of App as json
			$returnArray["status"]  	= "200";
                        $returnArray["message"] 	= "Successfully registered";			
			$returnArray["id"]		= $user["id"];
			$returnArray["username"]      	= $user["username"];
			$returnArray["email"]        	= $user["email"];
			$returnArray["fullname"]        = $user["fullname"];
			$returnArray["ava"]        	= $user["ava"];
			
			try{			
				//STEP4. Emailing
				// include email.php
				require ('templates/email.php');
						
			
				// store all class in $email var
				$email = new email();
			
				// store generated token in $token var
				$token = $email->generateToken(20);
			
				// save inf in 'emailTokens' table
				$access->saveToken("emailTokens", $user["id"],$token);
			
				// refer emailing information
				$details		=	array();
				$details["subject"]	=	"Email confirmation on Twitter";
				$details["to"]		=	$user["email"];
				$details["fromName"]	=	"Satyajeet Pradhan";
				$details["fromEmail"]	=	"satyajeet.pradhan@gmail.com";
			
				//access template file
				$template = $email->confirmationTemplate();
		
				//replace {token} from confirmationTemplate.html by $token and store all content in $template var
				$template = str_replace("{token}", $token, $template);

				$details["body"]	=	$template;

				$email->sendEmail($details);

			} catch (Exception $e) {

				echo 'Caught Exception: ', $e->getMessage(), "\n";
				
			}
			

		
			
		} else {

			$returnArray["status"] 		= "400";
			$returnArray["message"] 	= "Could not register with provided information ".$result;
		}
	

	//STEP 5. Close connection
	$access->disconnect();


	//STEP 6. Json data
	echo json_encode($returnArray);	
?>
