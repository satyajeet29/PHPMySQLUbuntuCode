<html>
	<head>
	</head>
	
	<body>
		<form action = "insert.php" method = "post">
		<p>Add a language: <input type="text" name="language" /></p>
		<p><input type = "submit" value = "Submit"></p>
	 	</form>
	
	<?php

	//cornnect to a database
	$user 		= "root";
	$pwd 		= "Summer$5";
	$database 	= "phpCourse";
	$conn		= new mysqli("localhost", $user, $pwd, $database);



	// if there is POST data, insert it into the database
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		$language = $_POST['language'];
		$sql = "INSERT INTO language (name) VALUES ('$language')";



			//make sure the query is valid, or log the error:

			if ($conn->query($sql) !== TRUE) {

				echo "Error: " .$sql. "<br>" . $conn->error;

			}

	}//end of if statement
	$sql = "SELECT name FROM language";
	$result = $conn->query($sql);
	echo "<table border>";
	while ($row = $result->fetch_assoc()) {

		echo "<tr><td>" . $row['name'] . "</td></tr>";

	}
	
	echo "</table>";

	?>
	</body>
</html>
