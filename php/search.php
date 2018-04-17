<!DOCTYPE html>
<html>
<?php 
session_start();
include("header.php");
include("homerow.php");
require_once('./functions.php');
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
$presets = isset($_SESSION['presets']) ? $_SESSION['presets'] : array();
?>
<head>
	<Title>Search</title>
	<link rel="stylesheet" href="../css/all.css">
	<link rel="stylesheet" href="../css/search.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/error_messages.js"></script>
</head>
<body><div id="content">
	<form action="results.php" method="GET">
		<br>
		<div>
			Organ Type<br>
			<?php
			message($messages, 'organ_type');
			check_boxes_from_file('../etc/organ_types.dat', 'organ_type', $presets, 3);
			?>
		</div>
		<br>
		<div>
			Blood Type<br>
			<?php
			message($messages, 'blood_type');
			check_boxes_from_file('../etc/blood_types.dat', 'blood_type', $presets, 4);
			?>
		</div>
		<br>
		<div>
			Sex<br>
			<?php
			message($messages, 'sex');
			check_boxes_from_file('../etc/sexes.dat', 'sex', $presets, 2);
			?>
		</div>
		<br>
		<div><table>
			<tr>
				<td colspan='2'><?php message($messages, 'weight')?></td>
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
				<td colspan='2'><?php message($messages, 'age')?></td>
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
