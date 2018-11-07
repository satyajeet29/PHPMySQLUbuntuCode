<?php

require "../unit2/helpers.php";

pageTop();

// several server variables are available
// these are in an associative array called $_SERVER

// a list of all server variables available on any particular server:
phpinfo(32);

//useful ones:
$filename = $_SERVER["SCRIPT_FILENAME"];
echo "Filename of this file is: $filename<br />";

$root = $_SERVER["DOCUMENT_ROOT"];
echo "The document root is : $root<br />";

$name = $_SERVER["SCRIPT_NAME"];
echo "The document root is : $name<br />";

$useragent = $_SERVER["HTTP_USER_AGENT"];
echo "The name of client is : $useragent<br />";


pageBottom();
?>
