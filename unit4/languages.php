<?php
	require "../unit2/helpers.php";
	
	pageTop();
	
	/*
	mysqli is a PHP library for working with MySQL databases.
		It can be used in either a procedural or object oriented way.
		The steps for connecting to and working with a MySQL database are below:
	*/

	$user	 = "root";
	$pwd 	 = "Summer$5";
	$db	 = "phpCourse";

	/*
		STEP 1.
		connect to database with mysqli.
		do not use "localhost" for the host name,
		it only gives a UNIX connection. "127.0.0.1" gives a TCP/IP connection.
	*/

	$conn = new mysqli("localhost", $user, $pwd, $db);

	//	STEP 2. Create a query
	$sql  =	"SELECT name FROM language"; 

	//	STEP3. get the query result (all the rows)
	$result = $conn->query($sql);
	
	echo "<table border>";
	// 	STEP4. get each row as an associative array, until there are no more rows
	while ($row = $result->fetch_assoc()) {
	//write out the contents of the name field
	echo "<tr><td>" . $row['name'] . "</td></tr>";
	}
	
	echo "</table>";
	pageBottom();
?>
