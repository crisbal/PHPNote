<?php 
	session_start();
	if(isset($_SESSION["logged"]))
	{
		if(isset($_POST["title"]) && isset($_POST["text"]))
		{
			$userId = $_SESSION["userId"];
			require_once 'config.php';
			require_once 'functions.php';

			$title = validateData($_POST["title"]);
			$text = validateData($_POST["text"]);
			$insertQuery = "INSERT INTO $dbNotesTable (USER,TITLE,NOTE) VALUES ('$userId','$title','$text');";
			$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("Error " . mysqli_error($connection));
			if($result = $connection->query($insertQuery))
			{
				header( 'Location: ../notes.php');
				$connection->close();
			}
			else
			{
				header( 'Location: ../create.php?error=Error:%20Can\'t save your note! Please try again.!');
				echo $insertQuery;
				$connection->close();
			}
		}
		else
		{
			header( 'Location: ../create.php');
		}
	}
	else
	{
		header( 'Location: ../login.php');
	}	


 ?>