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
	<link rel="stylesheet" href="/css/sign_in.css">
	<link rel="stylesheet" href="/css/all.css">
</head>
<body>
	<div id="content">
		<?php
        if (isset($_SESSION["status"])) {
            echo "<div id=\"status\">" .  $_SESSION["status"] . "</div>";
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
