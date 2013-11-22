<?php
session_start();
if(isset($_SESSION["logged"]))
{
	if(isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["dateTime"]))
	{
		
		require_once 'php/functions.php';
		require 'php/config.php';
		$title = validateData($_POST["title"]);
		$text = validateData($_POST["text"]);
		$dateTime = validateData($_POST["dateTime"]);

		$userId = validateData($_SESSION["userId"]);
		$connection = mysqli_connect($dbLocation,$dbUsername,$dbPassword,$dbName) or die("noConnection");
		$getDataQuery = "SELECT * FROM $dbNotesTable WHERE USER=$userId AND TRIM(TITLE) ='" . $title. "' AND TRIM(DATETIME)='" . $dateTime . "' LIMIT 1";
		if($result = $connection->query($getDataQuery))
		{

			$row_cnt = $result->num_rows;
			if($row_cnt>0) //if we have 1 result the note is already ok
			{
				$row = $result->fetch_assoc();
				generatePDF($row);
			}
			else
			{
				header( 'Location: notes.php?error=Error:%20Impossible to download, please try again in a few minutes!');
				$connection->close();
				die();
			}
		}
		else
		{
			header( 'Location: notes.php?error=Error:%20Impossible to download, please try again in a few minutes!');
			$connection->close();
			die();
		}
	}
	else
	{
		header( 'Location: notes.php?error=Error:%20Impossible to download, please try again in a few minutes!');
		$connection->close();
	}
}
else
{
	header( 'Location: login.php');
}


function generatePDF($row)
{
	require_once('tcpdf/config/tcpdf_config.php');
	require_once('tcpdf/tcpdf.php');



	class MYPDF extends TCPDF {
    	// Page footer
		public function Footer() {
        // Position at 15 mm from bottom
			require 'php/config.php';
			$this->SetY(-15);
        // Set font
			$this->SetFont('helvetica', 'I', 10);
        // Page number
			$this->writeHTML('<div style="text-align:center"><a href="' . $websiteUrl . '">Made with PHPNote - Write, Save, Share</a></div>', true, false, true, false, '');
		}
	}


		// create new PDF document
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('PHPNote');
	$pdf->SetTitle($row["TITLE"]);
	$pdf->SetSubject('Generated Note from PHPNote');
	$pdf->SetKeywords('PHPNote');

		// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(true);

		// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

		// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set font
	$pdf->SetFont('times', 'B', 20);

		// add a page
	$pdf->AddPage();

		// print a block of text using Write()
	$pdf->Write(0, $row["TITLE"] . "\n\n", '', 0, 'L', true, 0, false, false, 0);

		// set font
	$pdf->SetFont('times', '', 13);

		// print a block of text using Write()
	$pdf->Write(0, html_entity_decode($row["NOTE"]) . "\n\n", '', 0, 'L', true, 0, false, false, 0);

	ob_end_clean();
	$pdf->Output($row["TITLE"] . '.pdf', 'I');
}
?>