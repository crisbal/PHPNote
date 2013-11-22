<?php 

session_start();
if(isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["dateTime"])) //the user want to make a note public
{	
	if(isset($_SESSION["logged"]) && isset($_SESSION["userId"]))  //if the session variables are set
	{
		if($_SESSION["logged"] == true)  //if he is logged
		{
			require_once 'php/config.php';
			require_once 'php/functions.php';	

			$title = validateData($_POST["title"]);
			$text = validateData($_POST["text"]);
			$dateTime = validateData($_POST["dateTime"]);
			$userId = validateData($_SESSION["userId"]);
			$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("noConnection");

			$alreadyPublicQuery = "SELECT PUBLICID FROM $dbNotesTable WHERE USER=$userId AND TRIM(TITLE) ='" . $title. "' AND TRIM(DATETIME)='" . $dateTime . "' LIMIT 1";
			if($result = $connection->query($alreadyPublicQuery))
			{
				
				$row_cnt = $result->num_rows;
				if($row_cnt!=0) //if no results the id is good
				{
					$row = $result->fetch_assoc();
					echo "id=" . $row["PUBLICID"];
					exit();
				}
			}
			else
			{
				echo "queryError";
				$connection->close();
				die();
			}

			do{
				$publicId = generateRandomString(); //generate a random id for the note
				$selectQuery = "SELECT ID FROM $dbNotesTable WHERE PUBLICID ='" . $publicId . "' LIMIT 1";  //this query get a result if the id is already in use
				if($result = $connection->query($selectQuery))
				{
					$row_cnt = $result->num_rows;
					if($row_cnt==0) //if no results the id is good
					{
						break;
					}
				}
				else
				{
					echo "queryError";
					$connection->close();
					die();
				}

			}while(true);

			$querySetPublicId = "UPDATE $dbNotesTable SET PUBLICID='" . $publicId . "' WHERE USER=$userId AND TRIM(TITLE) ='" . $title. "' AND TRIM(DATETIME)='" . $dateTime . "'";  //we are ready to update the note with his public id
			if($result = $connection->query($querySetPublicId))
			{
				echo "id=$publicId";
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
			echo "redirect";
		}
	}
	else
	{
		echo "redirect";
	}
}
else if(isset($_GET["id"]))  //the user want to view a note
{
	
	require_once 'php/config.php';
	require_once 'php/functions.php';
	require_once 'php/body/header.php';
	$publicId = validateData($_GET["id"]);

	$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("noConnection");

	$getNoteQuery = "SELECT * FROM $dbNotesTable WHERE PUBLICID='" . $publicId . "' LIMIT 1";

	if($result = $connection->query($getNoteQuery))
	{
		$row_cnt = $result->num_rows;
		if($row_cnt==0) //if no results we must show a 404 
		{
			echo 	'<div class="note">
						      <div class="noteTitle">No note found with the ID: ' . $publicId . '</div>
						      <div class="noteText">Check your URL!</div>
    						</div>';
		}
		else
		{
			$row = $result->fetch_assoc();
			echo 	'<div class="note">
						      <div class="noteTitle">' . trim($row['TITLE']) . '
						      </div>
						      <div class="noteText">' . nl2br(trim($row['NOTE'])) . '</div>
						      <div class="noteDateTime">' . trim($row['DATETIME']) . '</div>
    						</div>';
		}
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
	header("Location: notes.php");
}


function generateRandomString()
{
	$allChars = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
	$randomString = "";

	for($i=0;$i<6;$i++)
	{
		$randomString.=$allChars[rand(0,strlen($allChars)-1)];
	}

	return $randomString;
}
?>