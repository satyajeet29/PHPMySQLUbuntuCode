<?php

class access {

	// connection global variables
	var $host	= null;
	var $user	= null;
	var $pass	= null;
	var $name	= null;
	var $conn	= null;
	var $result	= null;
	
	// constructing class
	function __construct($dbhost,$dbuser, $dbpass, $dbname ){
		
		$this->host = $dbhost;
		$this->user = $dbuser;
		$this->pass = $dbpass;
		$this->name = $dbname;

	}	

	// connection function
	public function connect() {

		$this->conn =  new mysqli($this->host, $this->user, $this->pass, $this->name);

		if (mysqli_connect_errno()) {
			
			//echo "Could not connect to database </br>";

		} else 	{
			//	echo "Connected and Selected --> ".mysqli_connect_errno()." </br>";
		
			}
	
		// support all languages
		$this->conn->set_charset("utf8");

	}

	
	// disconnection function
	public function disconnect(){

		if ($this->conn != null) {
			
			$this->conn->close();
		
		}

	}

	
	// Insert user details
	public function registerUser($username, $password, $salt, $email, $fullname) {
		
		//SQL Command
		// Option 1:
			$sql = "INSERT INTO users SET username=?, password=?, salt=?, email=?, fullname=?";
		
		// Option 2:

		//	$sql = "INSERT INTO users(username,  password, salt, email, fullname) VALUES(?,?,?,?,?)";


		//store query result in $statement
		$statement = $this->conn->prepare($sql);
		
		// if error
		if (!$statement) {
			throw new Exception($statement->error);
		}
		
		// bind 5 param of type string to be placed in $sql command
		$statement->bind_param("sssss", $username, $password, $salt, $email, $fullname);
		
		
		// Code block to see variables being passed with which values, meant for debugging purpose only <SP><12/05/2017>
		/*
		echo '</br></br>';
		echo 'Username:	 ' 	. $username.	'</br>';
		echo 'password:	 ' 	. $password.	'</br>';
		echo 'salt:	 ' 	. $salt.	'</br>';
		echo 'email id:	 ' 	. $email.	'</br>';
		echo 'fullname:	 ' 	. $fullname. 	'</br></br>';
		echo '$sql:  '      	. $sql.	   	'</br>';
		echo '$this: '		. get_class($this).	'</br>';
		//echo return($statement);
		echo '</br></br>';
		*/

		$returnValue = $statement->execute();
		return $returnValue;
		
		//echo 'result:	'.$returnValue->get_result().'</br>';
	}

	
	//Select user information
	public function selectUser($username){
			
		//sql command
		$sql = "SELECT * FROM users WHERE username ='".$username."'";


		//assign result we got from $sql to $result var
		$result = $this->conn->query($sql);

		// if we have at least 1 result returned
		if($result != null && (mysqli_num_rows($result) >= 1 )){
			
			// assign results we got to $row as associative array
			$row = $result->fetch_array(MYSQLI_ASSOC);
			
			if(!empty($row)) {
			
				$returnArray = $row;
		
			}
				
		}	

		return $returnArray;	
	
	}


	// Save email confirmation message's token
	public function saveToken($table, $id, $token) {

		//sql statement
		$sql = "INSERT INTO $table SET id=?, token=?";

		//prepare statement to be executed
		$statement = $this->conn->prepare($sql);

		//error occured
		if (!$statement) {
			throw new Exception($statement->error);
		}

		// bind parameters to sql statement
		$statement->bind_param("is", $id, $token);

		// launch / execute and store feedback in returnValue
		$returnValue = $statement->execute();

		return $returnValue;

	}


	// Get id of user via $emailToken he recieved via email's $_GET
	function getUserID($table, $token) {

		$returArray = array();

		//sql statement
		$sql = "SELECT id FROM $table WHERE token ='".$token."'";

		// launch sql statement
		$result = $this->conn->query($sql);
		
		// if $result is not empty and storing some content
		if ($result != null && (mysqli_num_rows($result) >= 1)) {
	
			// content from $result convert to assoc array and store in $row
			$row = $result->fetch_array(MYSQLI_ASSOC);

			if(!empty($row)){

				$returArray = $row;		

			}		

		}

		return $returArray;
	}

	// Change status of emailConfirmation column
	function emailConfirmationStatus($status, $id)	{

		$sql = "UPDATE users SET emailConfirmed=? WHERE id=?";
		$statement = $this->conn->prepare($sql);

		if (!$statement) {
			throw new Exception($statement->error);
		}

		$statement->bind_param("ii", $status, $id);
		$returnValue = $statement->execute();
	
		return $returnValue;
	}



	// Delete token once email is confirmed
	function deleteToken($table, $token) {

		$sql = "DELETE FROM $table WHERE token=?";
		$statement = $this->conn->prepare($sql);

			if (!$statement) {
				throw new Exception($statement->error);
			}


		$statement->bind_param("s", $token);
		
		$returnValue = $statement->execute();

		return $returnValue;
	}


	//Get full user information
	public function getUser($username) {
	
				// declare array to store all information we get
				$returnArray = array();

				// sql statement
				$sql = "SELECT * FROM users WHERE username = '".$username."'";
	
				// execute /query $sql
				$result = $this->conn->query($sql);				

	 			// if $result is not empty and storing some content
                			if ($result != null && (mysqli_num_rows($result) >= 1)) {

                        				// assign result to $row as assoc array
                        					$row = $result->fetch_array(MYSQLI_ASSOC);

                        			if(!empty($row)){

                                				$returnArray = $row;

                        			}

                		}
			
			//echo json_encode($returnArray)."</br>";

			return $returnArray;

	}


        //Select user information with Email
        public function selectUserViaEmail($email){

		$returnArray = array();

                //sql command
                $sql = "SELECT * FROM users WHERE email ='".$email."'";


                //assign result we got from $sql to $result var
                $result = $this->conn->query($sql);

                // if we have at least 1 result returned
                if($result != null && (mysqli_num_rows($result) >= 1 )){

                        // assign results we got to $row as associative array
                        $row = $result->fetch_array(MYSQLI_ASSOC);

                        if(!empty($row)) {

                                $returnArray = $row;

                        }

                }

                return $returnArray;

        }

	// Updating password
	public function updatePassword($id, $password, $salt) {

		$sql = "UPDATE users SET password=?, salt=? WHERE id=?";
		$statement = $this->conn->prepare($sql);

		if (!$statement){
		
			throw new Exception($statement->error);

		}

		$statement->bind_param("ssi", $password, $salt , $id);

		$returnValue = $statement->execute();
		
		return $returnValue;


	}


	// Saving ava path in db
	function updateAvaPath($path, $id){
	
		//sql statement
		$sql = "UPDATE users SET ava=? WHERE id=?";

		//prepare to be executed
		$statement = $this->conn->prepare($sql);

		//error occured
		if (!$statement) {

			throw new Exception($statement->error);

		}

		// bind parameters in sql statement
		$statement->bind_param("si", $path, $id);

		// assign execution result to returnValue
		$returnValue = $statement->execute();

		return $returnValue;
	}

    	// Select user information with Id
    	public function selectUserViaID($id) {

        	$returnArray = array();

        	// sql command
       		 $sql = "SELECT * FROM users WHERE id='".$id."'";
		
        	// assign result we got from $sql to $result var
        	$result = $this->conn->query($sql);

        	// if we have at least 1 result returned
        	if ($result != null && (mysqli_num_rows($result) >= 1 )) {

            		// assign results we got to $row as associative array
            		$row = $result->fetch_array(MYSQLI_ASSOC);

            		if (!empty($row)){
                				$returnArray = $row;
            		}

        	}
        return $returnArray;
    	}

        //Insert post in database
        public function insertPost($id, $uuid, $text, $path) {
		
		$returnArray = array();
                
		$sql = "INSERT INTO posts SET id=?, uuid=?, text=?, path=?";
                $statement = $this->conn->prepare($sql);

                        if(!$statement) {
                                throw new Exception($statement->error);
                        }       

                $statement->bind_param("isss", $id, $uuid, $text, $path);

                $returnValaue = $statement->execute();
        
                return $returnArray;
        }

	public function selectPosts($id) {

		//declare array to store selected information
		$returnArray = array();

		//sql JOIN
		$sql = " SELECT 	posts.id
				,	posts.uuid
				,	posts.text
				,	posts.path
				,	posts.date
				,	users.id
				,	users.username
				,	users.fullname
				,	users.email
				,	users.ava
				FROM Twitter.posts JOIN Twitter.users ON
				posts.id = $id AND users.id = $id ORDER by date DESC";
	
				// prepare to be executed
					// Difference between "prepare" and "query"?
				$statement = $this->conn->prepare($sql);
				//$statement = $this->conn->query($sql);	
					//error occured
					if (!$statement){
						throw new Exception($statement->error);
					}
				
				//execute sql	
				$statement->execute();
		
				//result we got in execution
				$result = $statement->get_result();
				
				//each time append to $returnArray new row one by one when it is found
				while ($row = $result->fetch_assoc()) {
					$returnArray[] = $row;
				}

				return $returnArray;
					
	}

	//Delete post according to passed uuid
	public function deletePost($uuid) {
		
		//sql statement to be executed
		$sql = "DELETE FROM posts WHERE uuid = ?";

		//prepate to be executed after binded params in place of ?
		$statement = $this->conn->prepare($sql);

		//error occured while preparation of sql statement
		if (!$statement) {			
			throw new Exception($statement->error);
		}

		//bind params in place of ? and assign var
		$statement->bind_param("s", $uuid);
		$statement->execute();

		//assign number of affected rows to $returnValue, to see did delete or not
		$returnValue = $statement->affected_rows;

		return $returnValue;
	}

	public function selectUsers($word, $username){
		
		//var to store all returned inf from db
		$returnArray = array();
		
		// sql statement to be executed if not entered word
		$sql = "SELECT id, username, email, fullname, ava FROM users WHERE NOT username ='".$username."'";
		
		// if word entered alter sql statement for wider search
		if (!empty($word)) {
			$sql .= " AND ( username LIKE ? OR fullname LIKE ? )"; 
		}
			
		//print($sql);
		//prepate to be executed after binded params in place of ?
                $statement = $this->conn->prepare($sql);

		//prepare to be executed as soon as vars are binded
		if (!$statement) {
			throw new Exception($statement->error);
		}
		
		//if word entered bind params		
		if (!empty($word)) {
			$word = '%' . $word . '%';
			$statement->bind_param("ss", $word, $word);
		}
		
		//execute statement
		$statement->execute();
		
		//assign return results to $result variable
		$result = $statement->get_result();
		
		//every time when we convert $result into an associative array appended to $row
		while ($row = $result->fetch_assoc()) {
		
			// store all append $rows in $returnArray variable
			$returnArray[] = $row;
		}

		//feedback result
		return $returnArray;
	}

 
	//Update user function in our db via $id
	public function updateUser($username, $fullname, $email, $id){
	
		//sql statement
		$sql = "UPDATE users SET username = ?, fullname = ?, email = ? WHERE id = ?";
		
		//prepare to be executed as soon as we bind param in place of '?'
		$statement = $this->conn->prepare($sql);

		// if error occured
		if (!$statement) {

			throw new Exception($statement->error);

		}

		// binding param in place of "?"
		$statement->bind_param("sssi", $username, $fullname, $email, $id);
		
		//assign execution result to $returnValue
		$returnValue = $statement->execute();

		//return of value		
		return $returnValue;

	}



}
// End of class
?>

