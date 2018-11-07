<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'Summer$5';
$dbname = 'phpCourse';

$newdbname = "myDB"; 

// binary variable

$success = false;

//1: Connect to MySql
$connected  = mysqli_connect($dbhost, $dbuser, $dbpass);

//2: Select database
$selected = mysqli_select_db($connected, $dbname);


if($connected) {

		echo 'Connected </br>';
	
		if ($selected) {

                			echo 'Selected</br>';

					$success = true;
                		}    
					 else    
				
				{

                                	        echo 'Selection Failed </br>';

						$success = false;
                                }


		}	else	{


					echo 'Connection Failed</br>';
					$success = false;



				}





		if ($success) {
	


				$sql = "CREATE DATABASE " . $newdbname;
							
					if (mysqli_query($connected, $sql)) {

							echo "Created successfully database </br>" . $newdbname ;						

							} 
							
								else
 
							{
							
							echo "Database Creation Failed";
				
							}

		}


?>
