<?php

		if (empty($_REQUEST["username"]) || empty($_REQUEST["password"])) {

			$returnArray["status"] 	= "400";
			$returnArray["message"] = "Missing required information";

		}

        // STEP 1. Check variables passing to this file via POST
        $username = htmlentities($_REQUEST["username"]);
        $password = htmlentities($_REQUEST["password"]);
	// STEP 2. Build connection, secure way to build connection
	$file = parse_ini_file("Twitter.ini");

		// store in php var inf from ini var
			$host = trim($file["dbhost"]);
			$user = trim($file["dbuser"]);
			$pass = trim($file["dbpass"]);
			$name = trim($file["dbname"]);

			// include access.php to call func from access.php file
		require("access.php");
		
		$access = new access($host, $user, $pass, $name);
		$access->connect();

	// STEP 3. Get user information
	// assign result of execution of getUser to $user var
	//	echo $username;
	//	echo "</br>";

	$user = $access->getUser($username);

		// if we did not get any user's information
			if (empty($user)) {
						//echo json_encode($returnArray);
						
						$returnArray["status"] 	= "403";
						$returnArray["message"] = "User is not found";
						echo json_encode($returnArray);
						return;
					}

	// STEP 4. Check validity of entered password
	// get password and salt from db
	$secured_password  	= $user["password"];
	$salt 			= $user["salt"];
	$hashedpassword		= sha1($password.$salt);
	// check do passwords match: from db & entered one
	//if ($secured_password == sha1($password.$salt)) {
	if(strcmp($secured_password, $hashedpassword) == 0){
	//if ($secure_password == sha1($password . $salt)) {
	//if ($secure_password == $hashedpassword) {
		$returnArray["status"] 		= "200";
		$returnArray["message"]		= "Logged in succesfully";
		$returnArray["id"]		= $user["id"];
		$returnArray["username"]	= $user["username"];
		$returnArray["email"]		= $user["email"];
		$returnArray["fullname"]	= $user["fullname"];
		$returnArray["ava"]		= $user["ava"];
		/*
			Commnenting out returning value of key "ava" 
			as UserDefault data set fails to parse and store null values
			<SP><01/02/2018> 
		*/
		/*
			Implemented a workaround to subsitute ava variable null value with
			string "Null" so that UserDefaults data handling doesn't throw an
			exception 
			<SP><01/02/2018>
		*/

			if($returnArray["ava"] == NULL)
			{
				$returnArray["ava"]		= "Null";
			} 
			else 
			{
				$returnArray["ava"]             = $user["ava"];
			}
		echo json_encode($returnArray);
                return;
	}	
	
	else	
	
	{
		$returnArray["status"] 	= "403";
		$returnArray["message"] = "Passwords do not match";
		$returnArray["password1"] = $secured_password;
 		$returnArray["password2"] = $hashedpassword; 
		echo json_encode($returnArray);
                return;
	}

	// STEP 5. Close connection
		$access->disconnect();

	// STEP 6. Throw back all information to user
		echo json_encode($returnArray);
?>
