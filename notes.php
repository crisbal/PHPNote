<?php 
	session_start();
	if(isset($_SESSION["logged"]))
	{
		$userId = $_SESSION["userId"];
		require_once 'config.php';
		require_once 'functions.php';

		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("Error " . mysqli_error($connection));
		$queryGetNotes = "SELECT * FROM $dbNotesTable WHERE USER = $userId";
		if($result = $connection->query($queryGetNotes))  //if the query was succesfull
		{
			if(count($result)==0)
			{
				echo "Add notes to show them here.";
			}
			else
			{
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
				{
				  echo $row['TITLE'] .'<br />';
				  echo $row['NOTE'] .'<br /><br /><br /><br /><br />';
				}

			}
		}
		else
		{
			echo " error";
			//header( 'Location: ../login.html' );
		}
	}
	else
	{
		echo "pls login";
		//header( 'Location: ../login.html' );
	}	
 ?>