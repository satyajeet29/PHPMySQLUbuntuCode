<?php

	//STEP1. Build connection
	//Secure way to store connection information
	$file = parse_ini_file("Twitter.ini");	//accessing the file with confirmation information

	//retrieve data from file
        $host = trim($file["dbhost"]);
        $user = trim($file["dbuser"]);
        $pass = trim($file["dbpass"]);
        $name = trim($file["dbname"]);

        // include access.php to call func from access.php file
        require("access.php");
        $access = new access($host, $user, $pass, $name);
        $access->connect();//launch opened connection	secure way to store connection information

	//STEP2. Check passed data to this file from app
	$word = null;
	$username = htmlentities($_REQUEST["username"]);

	if (!empty($_REQUEST["word"])){
		$word = htmlentities($_REQUEST["word"]);
	}

	//STEP 3. Access searching function and retrieve data from server
	$users = $access->selectUsers($word, $username);
	
	if (!empty($users)) {
		$returnArray["users"] = $users;
	} else {
		$returnArray["message"] = "Could not find records";
	} 

	//STEP 4. Close connection
	$access->disconnect();

	//STEP5. Pass information back as JSON to user
	echo json_encode($returnArray);
	

?>
