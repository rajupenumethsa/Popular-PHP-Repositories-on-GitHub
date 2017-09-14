<?php
//require_once ("config.php");
//$url = "https://api.github.com/repos/laravel/laravel";

if ($_POST) {
	session_start();
	session_unset();
	$_SESSION["stars"] = $_POST["stars"];
	$url = "https://api.github.com/search/repositories?q=topic:PHP&sort=stars&order=desc";
	$options  = array('http' => array('user_agent'=> $_SERVER['HTTP_USER_AGENT']));
	$context  = stream_context_create($options);
	$response = file_get_contents($url, false, $context);

	$response = json_decode($response, true);
	$total_count = $response['total_count'];
	
	for ($j = 1; $j < $total_count/100; $j++) {
		if ($j == 1)
			$url = "https://api.github.com/search/repositories?q=topic:PHP&sort=stars&order=desc&per_page=100";
		else
			$url = "https://api.github.com/search/repositories?q=topic:PHP&sort=stars&order=desc&page=" . $j ."&per_page=100";
		
		$jsonresponse = file_get_contents($url, false, $context);
		if (!$jsonresponse)
			header('Location: display.php');
		$jsonresponse = json_decode($jsonresponse, true);
		$items = $jsonresponse['items'];
		$length = count($items);

		$mysqli = new mysqli("localhost", "root", "", "GitHubProjects");
		$ir = $ur = 0;

		for ($i=0; $i < $length; $i++) {
			if ($mysqli->connect_error) {
				die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
			} else {
				$id = $items[$i]['id'];
				$name = $mysqli->real_escape_string($items[$i]['name']);
				$url = $mysqli->real_escape_string($items[$i]['url']);
				$created_at = new DateTime($items[$i]['created_at']);
				$date_created = $created_at->format('Y-m-d H:i:s');
				$pushed_at = new DateTime($items[$i]['pushed_at']);
				$last_updated = $pushed_at->format('Y-m-d H:i:s');
				$description = $mysqli->real_escape_string($items[$i]['description']);
				$stars = $items[$i]['stargazers_count'];
				if ($stars > $_POST['stars']) {
					$query = "SELECT id FROM Projects WHERE repository_id = $id";
					$query = mysqli_query($mysqli, $query);
					if (mysqli_num_rows($query) == 1) {
						$row = mysqli_fetch_row($query);
						$update_query = "UPDATE Projects SET repository_id = $id, repository_name = '$name', repository_url = '$url', date_created = '$date_created',
							last_updated = '$last_updated', description = '$description', stars = $stars WHERE id = $row[0]";
						// var_dump($update_query);
						if (mysqli_query($mysqli, $update_query) != TRUE) {
							echo "Updating Row Error: " . $insert_query . "<br>" . $mysqli_error;
						} else {
							$ur++;
						}
					} else {
						$insert_query = "INSERT INTO Projects (repository_id, repository_name, repository_url, date_created, last_updated, description, stars) 
							VALUES ($id, '$name', '$url', '$date_created', '$last_updated' , '$description', $stars)";
						if (mysqli_query($mysqli, $insert_query) != TRUE) {
							echo "Inserting Row Error: " . $insert_query . "<br>" . $mysqli_error;
						} else {
							$ir++;
						}
					}
				} else {
					break 2;
				}
			}
		}
	}
	header('Location: display.php');
} else {
	header('Location: error.html');
}
?>