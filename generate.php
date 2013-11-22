<?php
/*
session_start();
if(isset($_SESSION["logged"]))
{
	if(isset($_GET["title"]) && isset($_GET["text"]) && isset($_GET["dateTime"]))
	{
		$userId = $_SESSION["userId"];
		require_once 'php/config.php';
		require_once 'php/functions.php';

		$title = validateData($_GET["title"]);
		$dateTime = validateData($_GET["dateTime"]);

		$selectQueryData = "SELECT * FROM $dbNotesTable WHERE USER=$userId AND TRIM(TITLE) ='" . $title. "' AND TRIM(DATETIME)='" . $dateTime . "' LIMIT 1";
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


		require_once('tcpdf/config/tcpdf_config.php');
		require_once('tcpdf/tcpdf.php');

// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('PHPNote');
		$pdf->SetTitle('PHPNote - Generated Note');
		$pdf->SetSubject('Generated Note from PHPNote');
		$pdf->SetKeywords('PHPNote');

// remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------

// set font
		$pdf->SetFont('times', 'B', 20);

// add a page
		$pdf->AddPage();

// set some text to print
		$txt = "test";

// print a block of text using Write()
		$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);


		$pdf->SetFont('times', '', 13);

// print a block of text using Write()
		$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
		$pdf->Output('example_002.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+

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
*/
?>