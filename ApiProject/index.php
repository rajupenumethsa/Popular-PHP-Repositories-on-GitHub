<?php
session_start();
session_unset();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="public/css/style.css">
		<script type="text/javascript" src="public/js/main.js"></script>
		<title>GitHub API Projects</title>
	</head>
	<body>
		<div id="workbench">
			<img id="image-hub" src="public/images/GitHub.png" alt="GitHub">
			<h1>Popular PHP Repositories on GitHub</h1>
			<form name="fetch_form" method="post" action="loadData.php" onsubmit="return formValidate()">
				List all the PHP Repository projects with a minimum of  
				<input type="text" name="stars" size="3" value=""> stars<br><br>
				<input id="button_back" type="submit" value="FETCH DATA">
			</form>
		</div>
		<div id="workbench" style="margin-top: 25px;">
			<a id="button_back" href="display.php">VIEW EXISTING DATA</a>
		</div>
	</body>
</html>