<?php
require_once ("db_config.php");

if ($_POST) {
	if (isset($_POST["id"]))
		$id = $_POST["id"];
	
	// $mysqli = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	$query = "SELECT * FROM Projects WHERE id = $id";
	$query = mysqli_query($mysqli, $query);
	if (mysqli_num_rows($query) == 1) {
		$row = mysqli_fetch_assoc($query);
	}
} else {
	header('Location: error.html');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>GitHub API Projects</title>
		<link href="public/css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="workbench">
			<h1 style="margin: 25px;">Popular PHP Repositories on GitHub</h1>
			<h3>"<?php echo $row["repository_name"] ?>" Repository Details.</h3>
			<form action="display.php" method="post" style="margin: 0px;">
				<input id="button_back" type="submit" value="Back to the List">
			</form><br>
			<table id="table-main" cellpadding="5" cellspacing="5">
				<tr style="background-color: lightblue;">
					<td>Repository ID #</td>
					<td><?php echo $row["repository_id"]; ?></td>
				</tr>
				<tr>
					<td>Repository Name</td>
					<td><?php echo $row["repository_name"]; ?></td>
				</tr>
				<tr style="background-color: lightblue;">
					<td>Repository URL</td>
					<td><?php echo $row["repository_url"]; ?></td>
				</tr>
				<tr>
					<td>Date Created</td>
					<td><?php echo $row["date_created"]; ?></td>
				</tr>
				<tr style="background-color: lightblue;">
					<td>Last Push Date</td>
					<td><?php echo $row["last_updated"]; ?></td>
				</tr>
				<tr>
					<td>Description</td>
					<td><?php echo $row["description"]; ?></td>
				</tr>
				<tr style="background-color: lightblue;">
					<td>Number of Stars</td>
					<td><?php echo $row["stars"]; ?></td>
				</tr>
			</table><br><br>
			<a href="index.html"><img style="width: 150px; height: 150px;" src="public/images/GitHub.png" alt="GitHub"></a>
			<h4>Click on the above image to redirect to Homepage.</h4>
		</div>
	</body>
</html>
