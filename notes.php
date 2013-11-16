<?php 
	session_start();
	if(isset($_SESSION["logged"]))
	{

		$userId = $_SESSION["userId"];
		require_once 'config.php';
		require_once 'functions.php';
		include_once 'body/header.php';
		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("Error " . mysqli_error($connection));
		$queryGetNotes = "SELECT * FROM $dbNotesTable WHERE USER = $userId ORDER BY DATETIME DESC";
		if($result = $connection->query($queryGetNotes))  //if the query was succesfull
		{
			if($result->num_rows == 0)
			{
				echo '<div class="alert alert-info"><strong>Hey, Listen!</strong> Right now this page is empty, add a note to show it here.</div>';
			}
			else
			{

				echo "<h2>Your notes</h2><br>";
				while ($row = $result->fetch_assoc()) 
				{

					echo 	'<div class="note">
						      <div class="noteTitle">' . trim($row['TITLE']) . '
						        <span class="noteButtons">
						          <span class="glyphicon glyphicon-pencil" title="Edit this note"></span>
						          <span class="glyphicon glyphicon-trash" title="Delete this note"></span>
						        </span>
						      </div>
						      <div class="noteText">' . trim($row['NOTE']) . '</div>
						      <div class="noteDateTime">' . trim($row['DATETIME']) . '</div>
    						</div>';
				}

			}

			echo '<span class="logout"><a href="php/logout.php">Logout</a></span>';
		}
		else
		{
			echo '<div class="alert alert-danger"><strong>Woops!</strong> I can\'t load your notes, please try again in a few seconds.</div>';
		}

		include_once 'body/footer.php';
		echo '<script src="js/notes.js"></script>';
		$connection->close();
	}
	else
	{
		header( 'Location: login.php' );
	}

 ?>