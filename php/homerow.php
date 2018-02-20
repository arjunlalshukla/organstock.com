<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/css/homerow.css">
	<link rel="stylesheet" href="/css/all.css">
</head>
<body>
	<div id="bar"><ul id="left">
		<li><a href="/php/search.php">Search</a></li>
	</ul>
	<ul id="right">
		<?php 
//		if (logged_in){
			$name = "Arjun";
			echo "<li>Welcome, " . $name . "</li>";
			echo "<li><a href=\"/php/user.php\">Your Account</a></li>";
//			Will reload the current page with no account logged in.
			echo "<li><a href=\"/index.php\">Sign Out</a></li>";
//		}	
//		else {
			echo "<li><a href=\"/php/sign_in.php\">Sign In</a></li>";
			echo "<li><a href=\"/php/sign_up.php\">Sign Up</a></li>";
//		}
		?>
	</ul>
	</div>
</body>
</html>
