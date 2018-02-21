<!DOCTYPE html>
<?php include("small_header.php");?>
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
		<form action="handler.php" method=POST">
			<div>Select account type:   
				<input type="radio" name="account_type" value="buyer_seller">Buyer/Seller   
				<input type="radio" name="account_type" value="physician">Physician   
			</div>
		</form>
		<!-- Buyer/Seller form -->
		Buyer/Seller form<br>
		<form action="handler.php" method="POST"><div>
			<input type="text" placeholder="username" name="username"><br>
			<input type="password" placeholder="password" name="password"><br>
			<input type="password" placeholder="re-enter password" name="password_again"><br><br>
			<input type="email" placeholder="email" name="email"><br>
			<input type="email" placeholder="re-enter email" name="email_again"><br>
			Residential Information<br>
			Country: <select>
				<option value="australia">Australia</option>
				<option value="iran">Iran</option>
				<option value="singapore">Singapore</option>
			</select><br>
			State/Province: TBA<br>
			Address:<br>
			<input type="submit" value="Submit">
		</div></form>
		<!-- Physician form -->
		Physician form<br>
		<form action="handler.php" method="POST"><div>
			<input type="text" placeholder="First Name" name="first_name"><br>
			<input type="text" placeholder="Last Name" name="last_name"><br>
			<input type="text" placeholder="Suffix" name="suffix"><br>
			<input type="text" placeholder="Degree" name="degree"><br>
			Liscensing Agency: <select>
			</select><br>
			<input type="text" placeholder="License #" name="license"><br>
			<input type="submit" value="Submit">
		</div></form>
	</div>
</body>
</html>
<?php include("footer.php");?>
