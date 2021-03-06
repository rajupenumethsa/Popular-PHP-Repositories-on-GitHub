<?php
require_once ("db_config.php");
session_start();

$stars = NULL;
if (isset($_SESSION['stars'])) {
	$stars = $_SESSION['stars'];
}

//$mysqli = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$query = "SELECT * FROM Projects";
if (!empty($stars))
	$query .= " WHERE stars >= " . $stars;

$result = mysqli_query($mysqli, $query);
$totalRows = mysqli_num_rows($result);

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
		<?php if ($totalRows == 0) { ?>
			<h2 style="color: red;">No PHP Github projects found.<br>Please try again with different input.</br></h2>
		<?php } else {?>
			<h2>PHP Repositories with <?php echo $stars ?> or more stars count : <?php echo $totalRows ?></h2>
			<table id="table-main" cellpadding="5" cellspacing="5">
			
			<?php
			$displayitems = 10;
			if (isset($_GET["page"]))
				$page_num = intval($_GET["page"]);
			else if (isset($_SESSION["page"]))
				$page_num = intval($_SESSION["page"]);
			else
				$page_num = 1;
			
			$_SESSION["page"] = $page_num;
			$endElement = $displayitems * $page_num;
			$startFrom = $endElement - $displayitems;
			$page_query = $query . " ORDER BY stars DESC LIMIT $startFrom, $displayitems";
			
			$result = mysqli_query($mysqli, $page_query);
			$rows = mysqli_num_rows($result);
			if ($rows){
				$i = 0;
			?>
				<tr id="row-head">
					<td style="width: 25px;"></td>
					<td>Repository ID</td>
					<td>Repository Name</td>
					<td>Stars</td>
					<td class="right_button">Action</td>
				</tr>
				<?php
				while ($post = mysqli_fetch_assoc($result)) {
					$id = $post["id"];
					if ($i%2 == 0) {
				?>
					<tr id="row-click">
				<?php } else { ?>
					<tr id="row-click"  style="background-color: lightblue;">
				<?php } ?>
						<td></td>
						<td><?php echo $post["repository_id"]; ?></td>
						<td><?php echo $post["repository_name"]; ?></td>
						<td><?php echo $post["stars"]; ?></td>
						<td class="right_button">
							<form action="display_item.php" method="post">
								<input type="hidden" name="id" value="<?php echo $id ?>">
								<input id="button_view" type="submit" value="view">
							</form>
						</td>
					</tr>
				<?php
				$i++;
				}
			}
			?>
			</table><br><br>
		</div>
		
			<!-- Bottom Navigational Menu -->
			<table cellspacing="2" cellpadding="2" align="center" style="width: 100%; table-layout: fixed;">
				<tbody>
					<tr>
						<td align="center">
						<?php
						if (isset($page_num)) {
							$totalPageCount = ceil($totalRows/$displayitems);
							
							if( $page_num >1 ) {
								$j = $page_num - 1;
								echo "<span><a id='click_link' href='display.php?page=$j'>Prev</a></span>";
							}

							for ($i=1; $i <= $totalPageCount; $i++) {
								if($i<>$page_num)
									echo "<span><a id='click_link' href='display.php?page=$i'>$i</a></span>";
								else
									echo "<span id='current_page' style='font-weight: bold;'>$i</span>";
							}

							if ($page_num != $totalPageCount ) {
								$j = $page_num + 1;
								echo "<span><a id='click_link' href='display.php?page=$j'>Next</a></span>";
							}
						}
						?>
						</td>
					</tr>
				</tbody>
			</table><br>
		<?php } ?>
		<div id="workbench">
			<a href="index.php"><img style="width: 150px; height: 150px;" src="public/images/GitHub.png" alt="GitHub"></a>
			<h4 style="margin: 0px;">Click on the above image to redirect to Homepage.</h4>
		</div>
	</body>
</html>