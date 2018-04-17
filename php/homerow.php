<!DOCTYPE html>
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
<head>
	<link rel="stylesheet" href="/css/homerow.css">
	<link rel="stylesheet" href="/css/all.css">
</head>
<body>
	<div id="bar"><ul id="left">
		<li <?php echo basename($_SERVER['PHP_SELF']) == "search.php" ? 'class="current_page"' : 'class="not_current_page"' ;?>><a href="/php/search.php">Search</a></li>
	</ul>
	<ul id="right">
		<?php 
		if (isset($_SESSION['user'])){
// 		    echo "<pre>" . print_r($_SESSION['user']) . "</pre>";
		    $username = $_SESSION['user']['username'];
		    $name = "Arjun";
		    echo "<li>Welcome, " . $name . "</li>";
		    echo "<li " . (basename($_SERVER['PHP_SELF']) == "buyer_seller_private.php" || basename($_SERVER['PHP_SELF']) == "physician_private.php" ? 'class="current_page"' : 'class="not_current_page"' ) . "><a href=\"/php/private.php\">Your Account</a></li>";
		    //			Will reload the current page with no account logged in.
		    echo "<li class=\"not_current_page\" ><a href=\"/php/sign_out_handler.php\">Sign Out</a></li>";
		}	
		else {
			echo "<li class=\"not_current_page\" ><a href=\"/php/sign_in.php\">Sign In</a></li>";
			echo "<li class=\"not_current_page\" ><a href=\"/php/sign_up.php\">Sign Up</a></li>";
		}
		?>
	</ul>
	</div>
</body>
</html>
