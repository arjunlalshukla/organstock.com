<!DOCTYPE html>
<?php 
require("small_header.php");
require_once ('functions.php');
session_start();
if (isset($_SESSION["user"])) {
    header("Location: ./index.php");
}
$username = isset($_SESSION['username_preset']) ? $_SESSION['username_preset'] : '';
?>
<html>
<head>
	<title>Sign In - OrganStock</title>
	<link rel="stylesheet" href="../css/sign.css">
	<link rel="stylesheet" href="../css/all.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/error_messages.js"></script>
</head>
<body>
	<div id="content">
		<div class="center"><?php message($_SESSION, 'status')?></div>
		<form action="./sign_in_handler.php" method="POST">
			<div><input value="<?php echo $username; ?>" placeholder="username" type="text" id="username" name="username"></div>
			<div><input placeholder="password" type="password" id="password" name="password"></div>
			<div><input type="submit" value="Submit"></div>
		</form>
	</div>
</body>
</html>
<?php require("footer.php");?>
