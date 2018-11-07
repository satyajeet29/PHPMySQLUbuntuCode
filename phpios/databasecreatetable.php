<?php
$host = 'localhost';
$dbuser = 'root';
$dbpass = 'Summer$5';
$dbname = 'phpCourse';

$newdbname = "myDB";

$newtable = "clients";

// binary variable

$success = false;

//1: Connect to MySql
$connected  = mysqli_connect($dbhost, $dbuser, $dbpass);



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


                }       else    {


                                        echo 'Connection Failed</br>';
                                        $success = false;



                                }



/*	Commenting out the block meant for creating a database

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

*/

//Creation of table in new database
/*
if ($success) 	{
		
			$sql  = "CREATE TABLE " . $newdbname . "." . $newtable; // Creation of myDB table 
			$sql  .= " (name VARCHAR(20), city VARCHAR(20))";
								

					echo $sql . "</br>"	;


					 if ( mysqli_query($connected, $sql)) {

                			                                        echo "Created table succesfully </br>" . $newdbname . "</br>" . $newtable;

                                        		                		}

                                                        		        else

                                                        		{

                                                        			echo "Table Creation Failed";

                                                        				}



		}

*/

//Insertion of records

/*
if ($success)   {

                        $sql  = "INSERT INTO " . $newdbname . "." . $newtable . "
				(name, city)
				 VALUES
				('Bob', 'London'),
				('Henry', 'New York'),
				('Jessica', 'Paris')"; // Insertion of records into table
                       	// $sql  .= " (name VARCHAR(20), city VARCHAR(20))";


                        //               echo $sql . "</br>"     ;


                                         if ( mysqli_query($connected, $sql)) {

                                                                                echo "Inserted records succesfully </br>" . $newdbname . "</br>" . $newtable;

                                                                                        }

                                                                                else

                                                                        {

                                                                                echo "Record Insertion Failed";

                                                                                        }



                }

*/

//Selection of records


if ($success)   {

                        $sql  = "SELECT name, city FROM " . $newdbname . "." . $newtable; // Insertion of records into table
                        // $sql  .= " (name VARCHAR(20), city VARCHAR(20))";


                                       echo $sql . "</br>"     ;


                                         $query =  mysqli_query($connected, $sql);

							//$i = 0;

					while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){

							$name = $row["name"];
							$city = $row["city"];

						
								//echo $name . " , " $city . "</br>";
								//echo $name ." - ". $city. "</br>";
								echo json_encode($row);
								
								

						}

								//echo json_encode($row);

                }


?>
