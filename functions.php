<?php

	//functions are sections of code that are used many times and /or perform tasks
	//syntax is function name(parameter list) {body statements}

	function writeBold($str){
					echo "<b>$str</b>";
				}

	// if a function has no parameters, give it an empty parameter list::
	
	function writeTopWrapper(){
					echo "<html><head></head><body>";	
				}


	function writeBottomWrapper(){
						echo"</body></html>";
					}

	//functions can also return a  value
	function add($a,$b){
			
				return $a + $b;
			
			}


	//calling functions
	writeTopWrapper();

	echo "<p> ";
	writeBold("This text is bold");
	echo"</p><p>This text is not bold </p>";


	//Strings are concatenate with
	// even if valued to be concatenated into the strings are not strings:
	echo "<p> The sum of 3 and 5 is " . add(3, 5) . "</p>";

	//look what happens when we use add instead of write bold
	writeBold("<p> The sum of -2 and 9 is " . add(-2, 9) . "</p>");


	// of course, we can assign the return value to a variable as well:
	$num =3;
	$sum = add(4, $num);
	echo "<p>The sum of 4 and $num is $sum</p>";

?>
