<?php

require "../unit2/helpers.php";

pageTop();


//all php arrays are associative ( like a dictionary or hash
// in other languages). arrays are defined by a 'key' and a 'value'

$colors = [1 => "red", 2 => "green", 3 => "blue"];

// the print_r functions print out the contents of an array

print_r($colors);


echo "<br />";
echo "<br />";

// if no keys are supplied they will be automatically generated:
$numbers = [1,2,3,4,5];
print_r($numbers);

	echo "<br />";
	echo "<br />";
//to access a value in an array, provide it's key:
	$thirdNumber = $numbers[2];
echo "The third number is $thirdNumber <br />";

//can also assign a value in an array, whether its key previously exists or not:
$numbers[2] = -4;
$numbers[5] = 6;
print_r($numbers);

echo "<br />";
echo "<br />";

//if the keys of an array are numerical, you can provide a different
//starting index by only assigning a key to the first element:
$flavors = [-1 => "chocolate", "vanilla", "strawberry"];
print_r($flavors);

echo "<br />";
echo "<br />";
//the keys of an array can be of any type, strings are common:
$animalSound = ["cat" => "meow", "dog" => "woof"];
print_r($animalSound);
print "<br />";
print "The dog says " . $animalSound["dog"] . "<br />";

echo "<br />";
/*
so what's the difference between echo and print?
echo can take multiple comma-separated values, though
this is unusual:
*/
echo print_r($colors), "<br/ >", print_r($numbers), "<br />";
echo "<br />";

/* print returns a value (1), and can be passed with or without
	paranthesis:
*/

if (print($animalSound['cat']. "<br />")){
	print "the cat made a sound!<br />";
	}

pageBottom();
?>
