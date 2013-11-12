<?php 
	if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]))  //if everything is set correctly
	{
		require_once 'config.php';
		require_once 'functions.php';

		
		
		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("Error " . mysqli_error($connection));

		$name = validateData($_POST["name"]);
		$email = validateData($_POST["email"]);
		$password = sha1(validateData($_POST["password"]));
		if(strlen($name) > 0 && strlen($password)>0 && strlen($email)>0)
		{
			$alreadyUsedSQL = "SELECT * FROM $dbUserTable WHERE LOWER(NAME)='" . strtolower($name) . "' OR LOWER(EMAIL)='" . strtolower($email) . "' LIMIT 1;";
			if($result = $connection->query($alreadyUsedSQL))  //if the query was succesfull
			{
				$result = $result->fetch_array(MYSQLI_BOTH);
				if(count($result) == 0)  //if we have 0 users with that uname or with that email 
				{
					$insertUserQuery="INSERT INTO $dbUserTable (NAME,EMAIL,PASSWORD) VALUES ('$name','$email','$password');";
					if($result = $connection->query($insertUserQuery))
					{
						session_start();
						$_SESSION["logged"] = true;
						$_SESSION["userId"] = $connection->insert_id;
						$connection->close();
					}
					else
					{
						header( 'Location: ../register.php?error=Error:%20Something went wrong when adding you to the database. Please try again later.' );
					}
				}
				else //user is not allowed
				header( 'Location: ../register.php?error=Error:%20Username%20or%20Email%20Already%20in%20use');
			}
			else  //something went wrong
			{
				header( 'Location: ../register.php?error=Error:%20Something went wrong when adding you to the database. Please try again later.' );
			}
		}
		else  //something went wrong
		{
			header( 'Location: ../register.php' );
		}
	}
	else
	{
		header( 'Location: ../register.php' );
	}
	?>