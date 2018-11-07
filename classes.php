<?php

	require "helpers.php";
	
	pageTop();
	
	//defines a class circle

	class circle{

		//class members can be public, protected, or private.
		//public - can be accessed anywhere
		//protected - can be accessed within objects of the class or subclasses
		//private - can only be accessed within objects of the class
		
		//methods can also have public, protected, or private access.
		//the default access for a method is public
		
		//this is a class constructor, will be called when an object of the class is created.

		function __construct($r) {

					$this->radius = $r;
					}



		//a method (function) that returns the area
		function area(){
				return 3.14159 * $this->radius**2;
			}


			

// end of class
}



$rad = 5;
$aCircle =  new circle($rad);
echo "<p>The area of the circle with radius $rad is " .$aCircle->area() . "</p>";

pageBottom();
?>
