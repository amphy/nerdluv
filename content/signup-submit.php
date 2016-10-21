<?php
	include "top.html/top.html";
?>
<?php
	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
	$ptype = $_POST['ptype'];
	$os = $_POST['os'];
	$min = $_POST['min'];
	$max = $_POST['max'];
	$error = FALSE;
	$ptypeArray = array("ISTJ", "ISFJ", "INFJ", "INTJ", "ISTP", "ISFP", "INFP", "INTP", "ESTP", "ESFP", "ENFP", "ENTP", "ESTJ", "ESFJ", "ENFJ", "ENTJ");
	$matchedPType = FALSE;

	if(strlen($name) <= 0) $error = TRUE;
	if($age > 99 || $age < 0) $error = TRUE;
	if($min < 0 || $max > 99) $error = TRUE;
	foreach($ptypeArray as $type){
		if($ptype == $type){
			$matchedPType = TRUE;
			break;
		}
	}
	if(!$matchedPType) $error = TRUE;

	if(!$error) {
		$singles = fopen("singles.txt", "a");
		fwrite($singles, ("\n" . $name . ','));
		fwrite($singles, ($gender . ','));
		fwrite($singles, ($age . ','));
		fwrite($singles, ($ptype . ','));
		fwrite($singles, ($os . ','));
		fwrite($singles, ($min . ','));
		fwrite($singles, ($max));
		fclose($singles);
		if (isset($_FILES['file'])) {
			$fileToMove = $_FILES['file']['tmp_name'];
			$adjustedName = strtolower(str_replace(" ", "_", $name));
			$destination = "img/" . $adjustedName . ".jpg";
			move_uploaded_file($fileToMove,$destination);
		}

		include "signup-submit.html";
	} else {
		include "error.html";
	}
?>
<?php	
	include "bottom.html/bottom.html";
?>