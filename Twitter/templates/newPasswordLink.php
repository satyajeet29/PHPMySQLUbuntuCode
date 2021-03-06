<?php

/*
$password_1     = htmlentities($_POST["password_1"]);
$password_2     = htmlentities($_POST["password_2"]);   
$token          = htmlentities($_POST["token"]); 
echo $password_1;
echo "</br>";
echo $password_2;
echo "</br>";
echo $token;
echo "</br>";
*/

 
//SECOND LOAD OF PAGE

	//STEP 1. Check passed information
	if (!empty($_POST["password_1"]) && !empty($_POST["password_2"]) && !empty($_POST["token"])){

		$password_1 	= htmlentities($_POST["password_1"]);
		$password_2 	= htmlentities($_POST["password_2"]);	
		$token 		= htmlentities($_POST["token"]); 

		//STEP 2. Check do passwords match or not
		if ($password_1 == $password_2){

			//STEP 3. Build Connection
			//Secure way to build a connection
			
				$file = parse_ini_file("../Twitter.ini");	
			
				//store in php var inf from ini var
				$host = trim($file["dbhost"]);
				$user = trim($file["dbuser"]);
				$pass = trim($file["dbpass"]);
				$name = trim($file["dbname"]);

				//include access.php to call func from access.php file
				require("../access.php");
				$access = new access($host, $user, $pass, $name);
				$access->connect();

					//STEP 4. Get user id via user token we passed to this file
					$user = $access->getUserID("passwordTokens", $token);

						//STEP5. Update database
						if(!empty($user)){
				
							//5.1 Generate secured password
							$salt = openssl_random_pseudo_bytes(20);
							$secured_password = sha1($password_1 . $salt);

								//5.2 Update user password
								$result = $access->updatePassword($user["id"], $secured_password, $salt);
								
									if ($result) {
											//5.3 Delete unique token
											$access->deleteToken("passwordTokens", $token);
											$message = "Succesfully created new password";		
											
											header("Location:http://52.89.123.54/Twitter/didResetPassword.php?message=" . $message);

									} else {
										echo 'User ID is empty';
									}

						}
		}	else	 {
					$message = "Passwords do not match";						
				}

	}

?>

	<html>
		<head>
			<!--Title-->
			<title>Create new password</title>
		
			<!--CSS Style-->
			<style>
			
				.password_field
				{
					margin: 10px;	
				}
				.button
				{
					margin: 10px;
				}	
				
			</style>
		</head>

		<body>
			<h1>Create a  new password</h1>
			<?php
				
				if (!empty($message)) {
				
					echo "</br>".$message."</br>";

				}
				
			?>
		<!--Forms-->
		<form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
		<div><input type="password" name="password_1" placeholder="New Password:" class="password_field"/><div>
		<div><input type="password" name="password_2" placeholder="Repeat Password:" class="password_field"/><div>
		<div><input type="submit" value="Save" class="button"/><div>
		<input type="hidden" value="<?php echo $_GET['token'];?>"name="token">
		</form>

		</body>
	

	</html>
