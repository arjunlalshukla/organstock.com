<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION['user'])){
    http_response_code(403);
    die('Forbidden');
}
require("header.php");
require("homerow.php");
require_once('functions.php');
require_once('DAO.php');
$dao = new DAO();
$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
$country = $_SESSION['user']['country'];
$image_path = $_SESSION['user']['image_path'];
?>
<head>
	<title><?php echo htmlspecialchars($username); ?></title>
	<link rel="stylesheet" href="../css/all.css">
</head>
<body><div id="content">
	<h1><?php echo htmlspecialchars($username); ?></h1>
	<?php show_image("../images/profiles/$username"); ?><br>
	<table id="user_info">
		<tr>
			<td>E-Mail</td>
			<td><?php echo htmlspecialchars($email); ?></td>
		<tr>
			<td>Country</td>
			<td><?php echo htmlspecialchars($country); ?></td>
		</tr>
	</table>
	<table class="organ_listing_info">
		<?php show_organ_table((array) $dao->user_get_organs($username));	?>
	</table>
	<a href="./create_organ.php"><button type="button">Add Organ</button></a>
</div></body>
</html>
<?php require("footer.php");?>
