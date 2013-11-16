<?php
	session_start();
	if(isset($_SESSION["logged"]) && isset($_SESSION["userId"]))
	{
		if($_SESSION["logged"]==true)
			header( 'Location: ../notes.php');
	}
	else 
	if(isset($_POST["email"]) && isset($_POST["password"]))  //if everything is set correctly
	{
		require_once 'config.php';
		require_once 'functions.php';

		
		echo $_POST["email"];
		echo $_POST["password"];
		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("Error " . mysqli_error($connection));
		$email = validateData($_POST["email"]);
		$password = sha1(validateData($_POST["password"]));
		if(strlen($password)>0 && strlen($email)>0)
		{
			$canLogin = "SELECT * FROM $dbUserTable WHERE LOWER(EMAIL)='" . strtolower($email) . "' AND PASSWORD='" . $password . "' LIMIT 1;";
			if($result = $connection->query($canLogin))  //if the query was succesfull
			{
				$result = $result->fetch_array(MYSQLI_BOTH);
				if(count($result) == 0)  //if we have 0 users with that mail and password
				{
						header( 'Location: ../login.php?error=Error:%20Wrong Email or Password' );
				}
				else
				{
					session_start();
					$_SESSION["logged"] = true;
					$_SESSION["userId"] = $result["ID"];
					$connection->close();
					header( 'Location: ../notes.php');
				}
			}
			else  //something went wrong
			{
				header( 'Location: ../login.php?error=Error:%20Something went wrong while logging in. Please try again later.' );
				$connection->close();
			}
		}
		else  //something went wrong
		{
			header( 'Location: ../login.php');
			$connection->close();
		}
	}
	else
	{
		header( 'Location: ../login.php' );
	}

 ?>