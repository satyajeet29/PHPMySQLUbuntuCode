<?php

// Desired folder structure
$structure = '../avaPictures/test';

// To create the nested structure, the $recursive parameter 
// to mkdir() must be specified.

if (!mkdir($structure, 0777, true)) {
    die('Failed to create folders...');
	echo "Failed to create mkdir";
}

// ...


/*
$root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
//echo $root;

$dir = $root . '/somefolder/';
echo $dir;

$old = umask(0);

if( !is_dir($dir) ) {
    mkdir($dir, 0755, true);
}
umask($old);
*/

//echo whoami;

?>
