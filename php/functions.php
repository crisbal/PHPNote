<?php 
function validateData($data)
{
	$data = trim($data);
	$data = addslashes($data);
	$data = htmlspecialchars($data);
	return $data;
} 
?>


