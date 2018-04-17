<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION['user'])){
    http_response_code(403);
    die('Forbidden');
}
require("header.php");
require("homerow.php");
require_once('./functions.php');
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
	<link rel="stylesheet" href="../css/all.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/error_messages.js"></script>
</head>
<body><div id="content">
	<h1>Add Organ</h1>
	<form action="create_organ_handler.php" method="POST" enctype="multipart/form-data"><div><table>
		<tr>
			<td>Organ Type</td>
			<td><?php drop_down_from_file("../etc/organ_types.dat", 'organ_type', $messages, $presets); ?> </td>
			<td><?php message($messages, 'blood_type'); ?> </td>
		</tr>
		<tr>
			<td>Blood Type</td>
			<td><?php drop_down_from_file("../etc/blood_types.dat", 'blood_type', $messages, $presets); ?></td>
			<td><?php message($messages, 'blood_type');	?></td>
		</tr>
		<tr>
			<td>Sex</td>
			<td><?php drop_down_from_file("../etc/sexes.dat", 'sex', $messages, $presets);?></td>
			<td><?php message($messages, 'sex');?></td>
		</tr>
		<tr>
			<td>Weight</td>
			<td><input type="number" name="weight" value="<?php fill_preset($messages, $presets, 'weight'); ?>">
				<select>
					<option value="kg">kg</option>
					<option value="lb">lb</option>
				</select>
			</td>
			<td><?php message($messages, 'weight');?></td>
		</tr>
		<tr>
			<td>Owner D.O.B.</td>
			<td><input type="date" name="dob" value="<?php fill_preset($messages, $presets, 'dob'); ?>"></td>
			<td><?php message($messages, 'dob');?></td>
		</tr>
		<tr>
			<td>Price</td>
			<td><input type="number" name="price" value="<?php fill_preset($messages, $presets, 'price'); ?>">
				<select>
					<option value="U.S. Dollar">U.S. Dollar</option>
				</select>
			</td>
			<td><?php message($messages, 'price');?></td>
		</tr>
	</table></div>
	<?php message($messages, 'description');?>
	<br>
	Description<br>
	<textarea rows="6" cols="60" name="description" maxlength="65535"><?php fill_preset($messages, $presets, 'description'); ?></textarea><br>
	<?php message($messages, 'file')?>
	<div><input type="file" name="file_to_upload" id="file_to_upload"></div>
	<input type="submit" value="Submit">
</form></div></body>
</html>
<?php require("footer.php");?>
