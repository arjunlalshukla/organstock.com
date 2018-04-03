<!DOCTYPE html>
<?php
session_start();
require("small_header.php");
$presets = isset($_SESSION['presets']) ? $_SESSION['presets'] : array();
//echo "<pre>" . print_r($presets, 1) . "</pre>";
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
//echo "<pre>" . print_r($messages, 1) . "</pre>";
?>
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
			
		<form action="sign_up_handler.php" method="POST" enctype="multipart/form-data">
			<?php if (isset($messages['account_type'])) echo $messages['account_type'];?>
			<div>Select account type:   
				<input type="radio" id="account_type" name="account_type" value="buyer_seller" <?php if(isset($presets['account_type']) && $presets['account_type'] == "buyer_seller") echo "checked"?>>Buyer/Seller   
				<input type="radio" id="account_type" name="account_type" value="physician" <?php if(isset($presets['account_type']) && $presets['account_type'] == "physician") echo "checked"?>>Physician   
			</div>
			<?php if (isset($messages['username'])) echo $messages['username'];?>
			<div><input value="<?php echo isset($presets['username']) && !isset($messages['username']) ? $presets['username'] : ''; ?>" placeholder="username" type="text" id="username" name="username"></div>
			<?php if (isset($messages['password'])) echo $messages['password'];?>
			<div><input placeholder="password" type="password" id="password" name="password"></div>
			<div><input type="password" placeholder="re-enter password" name="password_again"></div>
			<?php if (isset($messages['email'])) echo $messages['email'];?>
			<div><input value="<?php echo isset($presets['email']) && !isset($messages['email']) ? $presets['email'] : ''; ?>" type="email" placeholder="email" name="email"></div>
		  	<div><input value="<?php echo isset($presets['email_again']) && !isset($messages['email'])? $presets['email'] : ''; ?>" type="email" placeholder="re-enter email" name="email_again"></div>
			<?php if (isset($messages['country'])) echo $messages['country'];?>
			<div>Country: <select name="country">
				<?php
				$file = file_get_contents("../etc/countries.dat");
				$file = explode("\n", trim($file));
				foreach ($file as $line){
				   $line = trim($line);
				   $selected = isset($presets['country']) && !isset($messages['country']) && $presets['country'] == $line ? 'selected="selected"' : '';
				   echo "<option value=\"$line\" $selected>$line</option>";
				}
				?>
			</select></div>
			Additional Physician Information <br>
			<?php if (isset($messages['first_name'])) echo $messages['first_name'];?>
			<div><input value="<?php echo isset($presets['first_name']) && !isset($messages['first_name']) ? $presets['first_name'] : ''; ?>" type="text" placeholder="First Name" name="first_name"></div>
   			<?php if (isset($messages['last_name'])) echo $messages['last_name'];?>
   			<div><input value="<?php echo isset($presets['last_name']) && !isset($messages['last_name']) ? $presets['last_name'] : ''; ?>" type="text" placeholder="Last Name" name="last_name"></div>
	   		<div><input value="<?php echo isset($presets['suffix']) ? $presets['suffix'] : ''; ?>" type="text" placeholder="Suffix" name="suffix"></div>
	   		Profile picture <br>
	   		<?php if (isset($messages['file'])) echo $messages['file'];?>
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
