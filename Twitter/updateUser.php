<?php


$returnArray = array();

// STEP 1: Check passed variables
if (empty($_REQUEST["username"]) && empty($_REQUEST["fullname"]) && empty($_REQUEST["email"]) && empty($_REQUEST["id"])) {
	$returnArray["status"] 	= "400";
	$returnArray["message"]	= "Missing required information";
	return;
} 

// crypting via html passed var to this php file
$username	= htmlentities($_REQUEST["username"]);
$fullname	= htmlentities($_REQUEST["fullname"]);
$email 		= htmlentities($_REQUEST["email"]);
$id 		= htmlentities($_REQUEST["id"]);

// STEP 2: Build connection
// Secure way to connection information
$file		= parse_ini_file("Twitter.ini"); //accessing the file with connection information

// retrieve data from file
$host = trim($file["dbhost"]);
$user = trim($file["dbuser"]);
$pass = trim($file["dbpass"]);
$name = trim($file["dbname"]);

//include MySQLDAO.php for connection and interacting with db
require("access.php");

//running MYSQDAO Class with constructed variables
$access = new access($host, $user, $pass, $name);
$access->connect(); //laun opened connection function

// STEP 3: Update user information
$result = $access->updateUser($username, $fullname, $email, $id);

	if (!empty($result)) {
		
		// STEP 4: Get newly updated information
		$user = $access->selectUserViaID($id);
		
		$returnArray["id"] 		= $user["id"];
		$returnArray["username"] 	= $user["username"];
		$returnArray["fullname"] 	= $user["fullname"];
		$returnArray["email"]		= $user["email"];
		$returnArray["ava"]           	= $user["ava"];
		$returnArray["status"]  	= "200";
		$returnArray["message"] 	= "Successfully updated";

	} else {
		$returnArray["status"] 		= "400";
		$returnArray["message"] 	= "Could not update user";
	}

// STEP 5: Close connection
$access->disconnect();

// STEP 6: Return back information to user via json
echo json_encode($returnArray);

?>
