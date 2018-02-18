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
		if (false /*logged_in*/){
			}	
		else {
			echo "<li><a href=\"/php/sign_in.php\">Sign In</a></li>";
			echo "<li><a href=\"/php/sign_up.php\">Sign Up</a></li>";}
		?>
	</ul>
	</div>
</body>
</html>
