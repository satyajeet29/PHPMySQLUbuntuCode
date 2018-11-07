<?php

if(empty($_GET["token"])) {

	echo "Missing required information";

}
// STEP1. Check required and passed information
$token = htmlentities($_GET["token"]);

// STEP2. Build connection, secure way to build connection
$file = parse_ini_file("../Twitter.ini");

	// store in php var inf from ini var

	$host = trim($file["dbhost"]);
	$user = trim($file["dbuser"]);
	$pass = trim($file["dbpass"]);
	$name = trim($file["dbname"]);

	//echo "Test succesful";
	// include access.php to call func from access.php file
	require("../access.php");

	/*
		$filename = "../access.php";


                	// check if file exists
        
                	if (file_exists($filename)){
                
                        	echo "The file $filename exists";               

                	} else {

                        	echo "The file $filename doesn't exist";                
		
                	}
	*/
	$access = new access($host, $user, $pass, $name);
	$access->connect();

// STEP3. Get id of user
// store in $id result of func
$id = $access->getUserID("emailTokens", $token);
 if (empty($id["id"])){
		echo "User with this token is not found";
		return;
	}

// STEP4. Change status of confirmation and delete token
$result = $access->emailConfirmationStatus(1,$id["id"]);

	if ($result) {

		// 4.1 Delete token from 'emailTokens' table of db in mysql
		$access->deletetoken("emailTokens", $token);
		echo 'Thank You! Your email is now confirmed';	
	} 

// STEP5. Close connection
$access->disconnect();

?>
