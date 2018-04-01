<!DOCTYPE html>
<?php require("small_header.php");?>
<html>
<head>
	<title>Sign Up - OrganStock</title>
	<link rel="stylesheet" href="/css/all.css">
	<link rel="stylesheet" href="/css/sign_up.css">
</head>
<body>
	<div id="content">
		<!-- This option will make more stuff appear depending on which
			radio option is chosen. -->
			
		<form action="sign_up_handler.php" method="POST">
		   <div>Select account type:   
				<input type="radio" id="account_type" name="account_type" value="buyer_seller">Buyer/Seller   
				<input type="radio" id="account_type" name="account_type" value="physician">Physician   
			</div>
			<div><input  placeholder="username" type="text" id="username" name="username"></div>
			<div><input placeholder="password" type="password" id="password" name="password"></div>
			<div><input type="password" placeholder="re-enter password" name="password_again"></div>
			<div><input type="email" placeholder="email" name="email"></div>
		   <div><input type="email" placeholder="re-enter email" name="email_again"></div>
			<div>Country: <select name="country">
				   <?php
				   $file = file_get_contents("../etc/countries.dat");
				   $file = explode("\n", trim($file));
				   foreach ($file as $line){
				      echo "<option value=\"$line\">$line</option>";
				   }
				   ?>
			</select></div>
			Additional Physician Information
			<div><input type="text" placeholder="First Name" name="first_name"></div>
   		<div><input type="text" placeholder="Last Name" name="last_name"></div>
	   	<div><input type="text" placeholder="Suffix" name="suffix"></div>
	   	Profile picture
	   	<div><input type="file" name="file_to_upload" id="file_to_upload"></div>
	   	<!--
   		<div><input type="text" placeholder="Degree" name="degree"></div>
   		-->
   		<!--
   		<div>Liscensing Agency: <select name="agency">
   		</select></div>
   		<div><input type="text" placeholder="License #" name="license"></div>
   		-->
			<div><input type="submit" value="Submit"></div>
		</form>
		<!--
		<form action="sign_up_handler.php" method=POST">
         <div><input type="text" placeholder="username" id="username" name="username"></div>
   		<div><input type="submit" value="Submit"></div>
	   </form>
	   -->
	</div>
</body>
</html>
<?php include("footer.php");?>
