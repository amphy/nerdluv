<?php
	include "top.html/top.html";
?>
<html>
<head>
	<link href="nerdluv.css" type="text/css" rel="stylesheet" />
</head>
</html>
<?php
	$usersArray = array();
	$matchesArray = array();
	$curUserArray = null;
	$userName = $_GET['name'];
	echo "<strong> Matches for " . $userName . "</strong>";
	$singles = fopen("singles.txt", "r");

	while (! feof($singles)) {
		$temp = fgets($singles);
		$usersArray[] = explode(",", $temp);
	}
	fclose($singles);
	foreach ($usersArray as $user) {
		if ($user[0] == $userName) {
			$curUserArray = $user;
		}
	}
	if (!$curUserArray) {
		echo "<br>";
		include "error.html";
	} else {
		foreach ($usersArray as $user) {
			if (($user[1] != $curUserArray[1]) &&
				($user[2] < $curUserArray[6] && $user[2] > $curUserArray[5]) &&
				($user[4] == $curUserArray[4]) &&
				($user[3][0] == $curUserArray[3][0] || $user[3][1] == $curUserArray[3][1] || $user[3][2] == $curUserArray[3][2] || $user[3][3] == $curUserArray[3][3])) {
				$imageName = strtolower(str_replace(" ", "_", $user[0]));
				if (!file_exists("img/" . $imageName . ".jpg")) {
					$imageName = "user";
				}
				echo "<div class ='match'><p><img src='img/". $imageName .".jpg' />" . $user[0]. "</p>";
				echo "<ul><li><strong>Gender:</strong> ".$user[1]."</li>";
				echo "<li><strong>Age:</strong> ".$user[2]."</li>";
				echo "<li><strong>Type:</strong> ".$user[3]."</li>";
				echo "<li><strong>OS:</strong> ".$user[4]."</li></ul></div>";


			}
		}
	}
?>

<?php	
	include "bottom.html/bottom.html";
?>