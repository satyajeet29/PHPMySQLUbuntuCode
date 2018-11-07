<html>
	<head>
	</head>
	
	<body>
		<?php
			/*
				All variables in PHP start with a $. Variables are "loosely typed" in PHP. The typer of a variable is inferred from the context:
			*/
			
			$num1 = 1; //an integer
			$num2 = 2.3; //floating point number
			
			// values of a variables are interpolated when echoed
			echo"<h2>num1 is $num1, num2 is $num2</h2>";

			//all C typer operators are supported:
			$num++;
			$num2 *= $num1;
			echo"<h2>num1 is $num1, num2 is $num2</h2>";
			
			// $num1 reassigned to a string (not a good practice...)
			$num1 = "Rick";
			echo"<h2>Hello, my name is $num1</h2>";
			
			echo "</br>";
			echo ini_get('open_basedir');

		?>
	</body>
</html>
