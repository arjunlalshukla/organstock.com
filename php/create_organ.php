<!DOCTYPE html>
<html>
<?php
if (!isset($_SESSION['user'])){
    http_response_code(403);
    die('Forbidden');
}
include("header.php");
include("homerow.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$presets = isset($_SESSION['presets']) ? $_SESSION['presets'] : array();
//echo "<pre>" . print_r($presets, 1) . "</pre>";
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
//echo "<pre>" . print_r($messages, 1) . "</pre>";
?>
<head>
	<Title>Add Organ</title>
	<link rel="stylesheet" href="/css/all.css">
</head>
<body><div id="content">
	<h1>Add Organ</h1>
	<form action="create_organ_handler.php" method="POST" enctype="multipart/form-data"><div><table>
		<tr>
			<td>Organ Type</td>
			<td><select name="organ_type">	
				<?php
				$file = file_get_contents("../etc/organ_types.dat");
				$file = explode("\n", trim($file));
				foreach ($file as $line){
				   $line = trim($line);
				   $selected = isset($presets['organ_type']) && !isset($messages['organ_type']) && $presets['organ_type'] == $line ? 'selected="selected"' : '';
				   echo "<option value=\"$line\" $selected>$line</option>";
				}
				?>
			</select></td>
			<td class="message">
				<?php if (isset($messages['organ_type'])) echo $messages['organ_type'];?>
			</td>
		</tr>
		<tr>
			<td>Blood Type</td>
			<td><select name="blood_type">
				<?php
				$file = file_get_contents("../etc/blood_types.dat");
				$file = explode("\n", trim($file));
				foreach ($file as $line){
				   $line = trim($line);
				   $selected = isset($presets['blood_type']) && !isset($messages['blood_type']) && $presets['blood_type'] == $line ? 'selected="selected"' : '';
				   echo "<option value=\"$line\" $selected>$line</option>";
				}
				?>
			</select></td>
			<td class="message">
				<?php if (isset($messages['blood_type'])) echo $messages['blood_type'];?>
			</td>
		</tr>
		<tr>
			<td>Sex</td>
			<td><select name="sex">
				<?php
				$file = file_get_contents("../etc/sexes.dat");
				$file = explode("\n", trim($file));
				foreach ($file as $line){
				   $line = trim($line);
				   $selected = isset($presets['sex']) && !isset($messages['sex']) && $presets['sex'] == $line ? 'selected="selected"' : '';
				   echo "<option value=\"$line\" $selected>$line</option>";
				}
				?>
			</select></td>
			<td class="message">
				<?php if (isset($messages['sex'])) echo $messages['sex'];?>
			</td>
		</tr>
		<tr>
			<td>Weight</td>
			<td><input type="number" name="weight" value="<?php echo isset($presets['weight']) && !isset($messages['weight']) ? $presets['weight'] : ''; ?>">
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
			<td>Owner D.O.B.</td>
			<td><input type="date" name="dob" value="<?php echo isset($presets['dob']) && !isset($messages['dob']) ? $presets['dob'] : ''; ?>"></td>
			<td class="message">
				<?php if (isset($messages['dob'])) echo $messages['dob'];?>
			</td>
		</tr>
		<tr>
			<td>Price</td>
			<td><input type="number" name="price" value="<?php echo isset($presets['price']) && !isset($messages['price']) ? $presets['price'] : ''; ?>">
				<select>
					<option value="U.S. Dollar">U.S. Dollar</option>
				</select>
			</td>
			<td class="message">
				<?php if (isset($messages['price'])) echo $messages['price'];?>
			</td>
		</tr>
	</table></div>
	<?php if (isset($messages['description'])) echo $messages['description'];?><br>
	Description<br>
	<textarea rows="6" cols="60" name="description" maxlength="65535"><?php echo isset($presets['description']) && !isset($messages['description']) ? $presets['description'] : ''; ?></textarea><br>
	<?php if (isset($messages['file'])) echo $messages['file'];?>
	<div><input type="file" name="file_to_upload" id="file_to_upload"></div>
	<input type="submit" value="Submit">
</form></div></body>
</html>
<?php include("footer.php");?>
