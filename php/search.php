<!DOCTYPE html>
<html>
<?php 
session_start();
include("header.php");
include("homerow.php");
$messages = $_SESSION['messages'];
?>
<head>
	<Title>Search</title>
	<link rel="stylesheet" href="/css/all.css">
	<link rel="stylesheet" href="/css/search.css">
</head>
<body><div id="content">
	<form action="results.php" method="GET">
		<br>
		<div>
			Organ Type<br>
			<?php
			if (isset($messages['organ_type'])) echo $messages['organ_type'] . "<br>";
			$file = file_get_contents("../etc/organ_types.dat");
			$file = explode("\n", trim($file));
			
// 			echo "<pre>" . print_r($file, 1) . "</pre>";
			$i = 0;
			foreach ($file as $line){
			   $line = trim($line);
			   $checked = isset($_SESSION['presets'][$line]) ? 'checked' : '' ;
			   echo "<input type=\"checkbox\" name=\"$line\" id=\"$line\" $checked><label for=\"$line\" class=\"organ\">$line</label>";
			   $i = $i + 1;
			   if ($i % 3 == 0 && $line != end($file)) {
			       echo "<br>";
			   }
			}
			?>
		</div>
		<br>
		<div>
			Blood Type<br>
			<?php
			if (isset($messages['blood_type'])) echo $messages['blood_type'] . "<br>";
			$file = file_get_contents("../etc/blood_types.dat");
			$file = explode("\n", trim($file));
// 			echo "<pre>" . print_r($file, 1) . "</pre>";
			$i = 0;
			foreach ($file as $line){
			   $line = trim($line);
			   $checked = isset($_SESSION['presets'][$line]) ? 'checked' : '' ;
			   echo "<input type=\"checkbox\" name=\"$line\" id=\"$line\" $checked><label for=\"$line\" class=\"blood_type\">$line</label>";
			   $i = $i + 1;
			   if ($i % 4 == 0 && $line != end($file)) {
			       echo "<br>";
			   }
			}
			?>
		</div>
		<br>
		<div>
			Sex<br>
			<?php
			if (isset($messages['sex'])) echo $messages['sex'] . "<br>";
			$file = file_get_contents("../etc/sexes.dat");
			$file = explode("\n", trim($file));
// 			echo "<pre>" . print_r($file, 1) . "</pre>";
			$i = 0;
			foreach ($file as $line){
			   $line = trim($line);
			   $checked = isset($_SESSION['presets'][$line]) ? 'checked' : '' ;
			   echo "<input type=\"checkbox\" name=\"$line\" id=\"$line\" $checked><label for=\"$line\" class=\"sex\">$line</label>";
			   $i = $i + 1;
			   if ($i % 2 == 0 && $line != end($file)) {
			       echo "<br>";
			   }
			}
			?>
		</div>
		<br>
		<div><table>
			<tr>
				<td>Weight</td>
				<td><input type="number" name="weight_low" value="<?php echo isset($presets['weight']) && !isset($messages['weight']) ? $presets['weight_low'] : '';?>">
					to
					<input type="number" name="weight_up" value="<?php echo isset($presets['weight']) && !isset($messages['weight']) ? $presets['weight_up'] : '';?>">
					<select>
						<option value="kg">kg</option>
						<option value="lb">lb</option>
					</select>
				</td>
				<td class="message">
					<?php if (isset($messages['weight'])) echo $messages['weight'];?>
				</td>
			</tr>
			<tr>
				<td>Age</td>
				<td><input type="number" name="age_low" value="<?php echo isset($presets['age']) && !isset($messages['age']) ? $presets['age_low'] : '';?>">
	             to
                <input type="number" name="age_up" value="<?php echo isset($presets['age']) && !isset($messages['age']) ? $presets['age_up'] : '';?>">
				</td>
				<td class="message">
					<?php if (isset($messages['age'])) echo $messages['age'];?>
				</td>
			</tr>
		</table></div>
		<br>
		<input type="submit"  value="Submit">
	</form>
</div></body>
</html>
