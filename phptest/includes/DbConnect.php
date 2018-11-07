<?php

/**
 * Created by PhpStorm.
 * User: Belal
 * Date: 04/02/17
 * Time: 7:51 PM
 */
class DbConnect
{
    private $conn;

    function __construct()
    {
    }

    /**
     * Establishing database connection
     * @return database connection handler
     */
    function connect()
    {
        require_once 'Constants.php';

        // Connecting to mysql database
        $this->conn = new mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check for database connection error
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // returing connection resource
       	//	return $this->conn;
	else
	{
		$test_query = "SHOW TABLES FROM $dbname";
		$result = mysql_query($test_query);
		$tblCnt = 0;

	while($tbl = mysql_fetch_array($result)) {
	  $tblCnt++;
 	 #echo $tbl[0]."<br />\n";
	}
		if (!$tblCnt) {
 				 echo "There are no tables<br />\n";
				} else {
  				echo "There are $tblCnt tables<br />\n";
				}

    	}
	}
}
?>
