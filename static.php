<?php
require "helpers.php";



class Counted{


	//static prpoerties belong to the class,
	//not to any instance of the class

		public static $_count  = 0;


	//use the scope resolution operator :: to access static properties
	
	// also, $thi does not work with static properties
	//an methods, since $this only
	//works in the context of instance of class
	//(an object). The self keyword means "this class."

	function __construct() {
		
		self::$_count++;

	}

        function __destruct() {

                self::$_count++;
        
        }
}
pageTop();


	function makeObject() {

			$counted = new Counted();

			echo "Instances of Counted:". Counted::$_count . "<br />";
			//$counted will be destroyed when it goes out of scope.

			}



// here, each call to makeObject instantiated Counted, but since the $counted object goes out of scope, the static $_count variable is obly ever printed as "1" (objects are destrcuted when they go out of scope; the __destruct method is called).

echo "Making three instances of Counted with makeObject() <br />";
makeObject();
makeObject();
makeObject();
echo "Outside of the call to makeObject, there are" .Counted::$_count . "instance of Counted.<br />";
echo "<br />";

// here, all three objects are in scope, so the $_count variable does increase. Garbage collection occurs when the script terminates.

echo "Making \$count1<br />";
$count1  = new Counted();
echo "Instances of Counted: ". Counted::$_count . "<br />";
echo "<br />";

echo "Making \$count2<br />";
$count2  = new Counted();
echo "Instances of Counted: ". Counted::$_count . "<br />";
echo "<br />";

echo "Making \$count2<br />";
$count2  = new Counted();
echo "Instances of Counted: ". Counted::$_count . "<br />";
echo "<br />";

//We can explicitly free an object by using unset(object_name);

echo "Unsetting (freeing) \$count3 <br />";
unset($count3);
echo "Instances of Counted" . Counted::$_count ."<br />";
echo "<br />";


echo "Unsetting (freeing) \$count2 <br />";
unset($count2);
echo "Instances of Counted" . Counted::$_count ."<br />";
echo "<br />";


echo "Unsetting (freeing) \$count1 <br />";
unset($count1);
echo "Instances of Counted" . Counted::$_count ."<br />";
echo "<br />";






pageBottom();
?>
