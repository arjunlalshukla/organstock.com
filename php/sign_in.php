<!DOCTYPE html>
<?php include("small_header.php");?>
<html>
<head>
	<title>Sign In - OrganStock</title>
	<link rel="stylesheet" href="/css/sign_in.css">
	<link rel="stylesheet" href="/css/all.css">
</head>
<body>
	<div id="content">
		<form action="handler.php" method="POST">
			<div><input  placeholder="username" type="text" id="username" name="username"></div>
			<div><input placeholder="password" type="password" id="passwprd" name="password"></div>
			<div><input type="submit" value="Submit"></div>
		</form>
	</div>
</body>
</html>
<?php include("footer.php");?>
