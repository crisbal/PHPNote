<?php 

	session_start();
	if(isset($_SESSION["logged"]) && isset($_SESSION["userId"]))
	{	
		if(isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["dateTime"]) && $_SESSION["logged"] == true)
		{
			require_once 'config.php';
			require_once 'functions.php';
			$title = validateData($_POST["title"]);
			$text = validateData($_POST["text"]);
			$dateTime = validateData($_POST["dateTime"]);
			$userId = validateData($_SESSION["userId"]);
			$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("noConnection");
			$deleteQuery = "DELETE FROM $dbNotesTable WHERE USER=$userId AND TRIM(TITLE) ='" . $title. "' AND TRIM(NOTE) = '" .$text . "' AND TRIM(DATETIME)='" . $dateTime . "'";
			if($result = $connection->query($deleteQuery))
			{
				echo "success";
				$connection->close();
			}
			else
			{
				echo "queryError";
				$connection->close();
			}
		}
		else
		{
			echo "noPost";
		}
	}
	else
	{
		echo "redirect";
	}
?>