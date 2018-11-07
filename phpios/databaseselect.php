<?php


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'Summer$5';
$dbname = 'phpCourse';


$connected  = mysqli_connect($dbhost, $dbuser, $dbpass);
        if ($connected){


                echo "Connected </br>";



        }       else


        {

                echo "Connection Failed</br>";

        }



$selected = mysqli_select_db($connected, $dbname);

if ($selected) {

		echo 'Selected</br>';

		}	else	{

					echo 'Selection Failed </br>';
				
				}

?>
