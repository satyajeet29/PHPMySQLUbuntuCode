<?php

$topWrapper = "<html><head></head><body>";
$bottomWrapper = "</body></html>";

echo $topWrapper;


$num = 0;

		//while loop.  condition  is checked before the body of the loop is entered
		//loop is entered
	
		echo "<h3>while \$num &lt;= 5</h3>";

		while ($num <= 5){
					echo"<h3> $num </h3>";
					$num++;
				}




		// do-while loop. condition is check after the body of the loop is entered
		echo "<h3>while \$num &lt;= 5</h3>";

		do {

			echo "<h3>$num</h3>";
			$num++;
			
		}	while ($num < 5);


		// for loop. (initializer; condition; increment)
		echo "<h3>for each value of \$num > 0, decrementing</h3>";
		
		for($num; $num > 0; $num--)	{
							echo "<h3>$num</h3>";
						
						}


		//an array:
		$numbers = array("one", "two" ,"three" );
		
		
		//for each loop iterates over the values in the array:
		echo "<h3>for each in array(\"one\",\"two\",\"three\")</h3>";
			foreach ($numbers as $number)	{
							
							echo "<h3>$number</h3>";
							}
echo $bottomWrapper;

?>
