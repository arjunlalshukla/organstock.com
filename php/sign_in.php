<!DOCTYPE html>
<?php 
include("small_header.php");
session_start();

if (isset($_SESSION["signed_in_username"])) {
    header("Location: index.php");
}

$username = "";
if (isset($_SESSION['username_preset'])) {
    $username = $_SESSION['username_preset'];
}
?>
<html>
<head>
	<title>Sign In - OrganStock</title>
	<link rel="stylesheet" href="/css/all.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/error_messages.js"></script>
</head>
<body>
	<div id="content">
		<?php
        if (isset($_SESSION["status"])) {
            echo '<div id="sign_in_status" class="message">' . $_SESSION["status"] . "<button type='button' class='close'>X</button>" . "</div>";
            unset($_SESSION["status"]);
        }
        ?>
		<form action="sign_in_handler.php" method="POST">
			<div><input value="<?php echo $username; ?>" placeholder="username" type="text" id="username" name="username"></div>
			<div><input placeholder="password" type="password" id="password" name="password"></div>
			<div><input type="submit" value="Submit"></div>
		</form>
	</div>
</body>
</html>
<?php include("footer.php");?>
