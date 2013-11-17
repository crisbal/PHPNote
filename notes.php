<?php 
	session_start();
	if(isset($_SESSION["logged"]))
	{

		$userId = $_SESSION["userId"];
		require_once 'php/config.php';
		require_once 'php/functions.php';
		require_once 'php/body/header.php';

		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("Error " . mysqli_error($connection));
		$queryGetNotes = "SELECT * FROM $dbNotesTable WHERE USER = $userId ORDER BY DATETIME DESC";
		
		if($result = $connection->query($queryGetNotes))  //if the query was succesfull
		{

			if($result->num_rows == 0)
			{
				echo '<a href="create.php" ><div class="glyphicon glyphicon-plus addNote" title="Add a note"> </div></a>';
				echo '<div class="alert alert-info"><strong>Hey, Listen!</strong> Right now this page is empty, add a note to show it here.</div>';
			}
			else
			{
				echo '<a href="create.php" ><div class="glyphicon glyphicon-plus addNote" title="Add a note"> </div></a>';
				while ($row = $result->fetch_assoc()) 
				{

					echo 	'<div class="note">
						      <div class="noteTitle">' . trim($row['TITLE']) . '
						        <span class="noteButtons">
						          <a href="#" ><span class="glyphicon glyphicon-pencil" title="Edit this note"></span></a>
						          <a href="#" ><span class="glyphicon glyphicon-trash" title="Delete this note"></span></a>
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

		require_once 'php/body/footer.php';
		echo '<script src="js/notes.js"></script>';
		$connection->close();
	}
	else
	{
		header( 'Location: login.php' );
	}

 ?>