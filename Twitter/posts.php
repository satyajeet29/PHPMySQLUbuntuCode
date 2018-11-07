<?php
	//Secure the way to build connection
        $file = parse_ini_file("Twitter.ini");

        $host = trim($file["dbhost"]);
        $user = trim($file["dbuser"]);
        $pass = trim($file["dbpass"]);
        $name = trim($file["dbname"]);

        // include access.php to call func from access.php file
        require("access.php");
        $access = new access($host, $user, $pass, $name);
        $access->connect();
	
	//Check did pass data to the file
		// if data passed - save post
		if (!empty($_REQUEST["uuid"]) && !empty($_REQUEST["text"])) {
			//STEP 2.1 Pass POST_GET via html encrypt and assign to vars
			$id 	= htmlentities($_REQUEST["id"]);
			$uuid	= htmlentities($_REQUEST["uuid"]);
			$text 	= htmlentities($_REQUEST["text"]);
		
			//STEP 2.2 Create a folder in server to store posts pictures
			chdir('post');
			
                			//STEP 2.3: Creating the folder 
                			$folder = $id;
				// if no posts folder exists, create it
				if (!file_exists($folder)) {

					mkdir($folder, 0777, true);
			
				} 
			
				//Move uploaded file
				$folder = $folder . "/" . basename($_FILES["file"]["name"]);	
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $folder)) {	
					
						$returnArray["message"] = "Post has been made with picture";	
						$path 			= "http://52.89.123.54/Twitter/post/" . $id . "/post-" . $uuid . ".jpg";  
			
				} else {
					
							$returnArray["message"] = "Post has been made without picture";
							$path 			= ""; 
					}
		

	
	//STEP 2.4 Save path and other post details in db
	$access->insertPost($id, $uuid, $text, $path);
	

		//if id of the user is not passed but uuid of post is passed -> delete post		 
	} else if(!empty($_REQUEST["uuid"]) && empty($_REQUEST["id"])) {

		//	Get uuid of post and path to post picture to this php file via swift POST
		$uuid = htmlentities($_REQUEST["uuid"]);
		$path = htmlentities($_REQUEST["path"]);
		
		//	Delete post according to uuid
		$result = $access->deletePost($uuid);

		if(!empty($result)) {
			
			$returnArray["message"] = "Successfully deleted";
			$returnArray["result"]	= $result;
 			
			// conduct unlinking operation only when a path valu exists			
			if(!empty($path)){			

				// Delete file according to its path and if it exists
				$path = str_replace("http://52.89.123.54","/var/www/html",$path);
			
					// moving out of current directory to point to home directory 
  					chdir('../../../../');
			
						//file deleted successfully
						if (unlink($path)) {							
									$returnArray["status"] = "1000";
									// could not delete succesfully
								}else{  					
									$returnArray["status"] = "400";
								}
				} else {
					//returns in case of posts without pictures
					$returnArray["status"] = "204";
			}
		
		} else {
			$returnArray["message"] = "Could not delete post";
		}
		//if data are not passed - show posts
	} else {
		//STEP 2.1 Pass POST / GET via html encryption and assign passed id user to $id var
		$id = htmlentities($_REQUEST["id"]);
	
		//STEP 2.2 Select posts + user related to $id
		$posts = $access->selectPosts($id);

		//STEP 2.3 If posts are found, append them to $returnArray
		if (!empty($posts)){
			$returnArray["posts"] = $posts;
		}

	
	}

	//STEP 3. Close connection
	$access->disconnect();

	//STEP 4. Feedback information
	echo json_encode($returnArray);

?>
