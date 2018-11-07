<?php
		/*
			require includes the contents of a file. if the file does not exist, an error is raised and execution ends.
			
			include does the same thing as required, but if the file does not exist, inlcude raises a warning and execution continues
			
		*/


		require "helpers.php"; //defines pageTop() and pageBottom()

		pageTop();


		$greeting = "hello";
		$say_bye = "have a nice day";



		//useful string functions:
		

		//strlen: returns the length of a string
		echo "<p>\"$greeting\" has " . strlen($greeting) .  " characters</p>";

		//str_word_count: returns the number of words in a string
		echo "<p>\"$say_bye\" has " . str_word_count($say_bye) . " words</p>";

		//strrev: reverses a string
		echo "<p>\"$greeting\" backwards  is \"" . strrev($greeting) . "\"</p>";

		//strpos: retunrs the starting character position of the first match in a string or FALSE if not match is found
		$word = "wonderful";


		//$pos will be false if the word is not found but a number if the word is not found

		if ($pos = strpos($say_bye, $word)) {
							echo "<p>\"$word\" is at position $pos in \"say_bye\"</p>";
						}
							else
						{
							echo "<p>\"$word\" not found in \"say_bye\"</p>";
						}
		//str_replace: replace text in a string with a new text
		$say_bye = str_replace("nice", $word, $say_bye);
		echo "<p>$say_bye</p>";


		pageBottom();
?>
