<!DOCTYPE html>
<html>
<?php 
session_start();
include("header.php");
include("homerow.php");
if (isset($_SESSION['messages']))
    $messages = $_SESSION['messages'];
if (isset($_SESSION['presets']))
    $presets = $_SESSION['presets'];
?>
<head>
	<Title>Search</title>
	<link rel="stylesheet" href="/css/all.css">
	<link rel="stylesheet" href="/css/search.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/error_messages.js"></script>
</head>
<body><div id="content">
	<form action="results.php" method="GET">
		<br>
		<div>
			Organ Type<br>
			<?php
			if (isset($messages['organ_type'])){
			    echo '<div class="message">' . $messages['organ_type'] . "<button type='button' class='close'>X</button>" . "</div>";
			    unset($_SESSION['messages']['organ_type']);
			}
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
			if (isset($messages['blood_type'])){
			    echo '<div class="message">' . $messages['blood_type'] . "<button type='button' class='close'>X</button>" . "</div>";
			    unset($_SESSION['messages']['blood_type']);
			}
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
			if (isset($messages['sex'])) {
                echo '<div class="message">' . $messages['sex'] . "<button type='button' class='close'>X</button>" . "</div>";
                unset($_SESSION['messages']['sex']);
			}
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
				<td colspan='2'>
					<?php 
					if (isset($messages['weight'])) {
					    echo '<div class="message">' . $messages['weight']  . "<button type='button' class='close'>X</button>" . '</div>';
					    unset($_SESSION['messages']['weight']);
                    }
					?>
				</td>
			</tr>
			<tr>
				<td>Weight</td>
				<td><input type="number" name="weight_low" value="<?php echo isset($presets['weight_low']) && !isset($messages['weight']) ? $presets['weight_low'] : '';?>">
					to
					<input type="number" name="weight_up" value="<?php echo isset($presets['weight_up']) && !isset($messages['weight']) ? $presets['weight_up'] : '';?>">
					<select>
						<option value="kg">kg</option>
						<option value="lb">lb</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<?php 
					if (isset($messages['age'])) {
					    echo '<div class="message">' . $messages['age']  . "<button type='button' class='close'>X</button>" . '</div>';
					    unset($_SESSION['messages']['age']);
					}
					?>
				</td>
			</tr>
			<tr>
				<td>Age</td>
				<td><input type="number" name="age_low" value="<?php echo isset($presets['age_low']) && !isset($messages['age']) ? $presets['age_low'] : '';?>">
	             to
                <input type="number" name="age_up" value="<?php echo isset($presets['age_up']) && !isset($messages['age']) ? $presets['age_up'] : '';?>">
				</td>
			</tr>
		</table></div>
		<br>
		<input type="submit"  value="Submit">
	</form>
</div></body>
</html>
