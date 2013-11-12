<?php 
	session_start();
	$_SESSION["logged"] = true;
	$_SESSION["userId"] = 1;
	if(isset($_SESSION["logged"]))
	{

		$userId = $_SESSION["userId"];
		require_once 'config.php';
		require_once 'functions.php';
		include_once 'body/header.php';
		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("Error " . mysqli_error($connection));
		$queryGetNotes = "SELECT * FROM $dbNotesTable WHERE USER = $userId";
		if($result = $connection->query($queryGetNotes))  //if the query was succesfull
		{
			if($result->num_rows == 0)
			{
				echo "Add notes to show them here.";
			}
			else
			{
				while ($row = $result->fetch_assoc()) 
				{

					echo 	'<div class="note">
						      <div class="noteTitle">' . $row['TITLE'] . '
						        <span class="noteButtons">
						          <span class="glyphicon glyphicon-pencil" title="Edit this note"></span>
						          <span class="glyphicon glyphicon-trash" title="Delete this note"></span>
						        </span>
						      </div>
						      <div class="noteText">' . $row['NOTE'] . '  </div>
    						</div>';
				}

			}
		}
		else
		{
			echo " error";
			//header( 'Location: ../login.html' );
		}

		include_once 'body/footer.php';
	}
	else
	{
		echo "pls login";
		//header( 'Location: ../login.html' );
	}

 ?>