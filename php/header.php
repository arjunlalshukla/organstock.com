<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/all.css">
	<link rel="stylesheet" href="../css/header.css">
</head>
<body>
	<div id="header_bloc">
		<div id="logo_bloc">
			<a href="./index.php"><img class="logo" src="../logo.png" alt="logo"></a>
		</div>
		<div id="account_bloc">
			<?php
				/* if (logged_in)*/{
				}
				/* else */ {
					echo "<div><a href=\"./sign_in.php\"><button type=\"button\">Sign In</button></a></div>";
					echo "<div><a href=\"./sign_up.php\"><button type=\"button\">Sign Up</button></a></div>";
				}
			?>
		</div>
	</div>
</body>
</html>
