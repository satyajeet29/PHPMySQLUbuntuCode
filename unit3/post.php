<?php
require "../unit2/helpers.php";

pageTop();

/*
	$_GET is an array whose contents come from the HTTPS POST method.

	$_POST is not visible in the address bar, so sending data via POST is more secure

*/

$name = $_POST['name'];
$age = $_POST['age'];

echo "Hello, $name. I see you are $age years old!";

pageBottom();
?>
