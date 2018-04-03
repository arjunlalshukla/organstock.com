<!DOCTYPE html>
<html>
<?php include("header.php");?>
<?php include("homerow.php");?>
<head>
	<Title>Add Organ</title>
	<link rel="stylesheet" href="/css/all.css">
</head>
<body><div id="content">
	<h1>Add Organ</h1>
	<form action="create_organ_handler.php" method="POST"><div><table>
		<tr>
			<td>Organ Type</td>
			<td><select name="organ_type">	
				<?php
				$file = file_get_contents("../etc/organ_types.dat");
				$file = explode("\n", trim($file));
				foreach ($file as $line){
				   $line = trim($line);
				   echo "<option value=\"$line\">$line</option>";
				}
				?>
			</select></td>
		</tr>
		<tr>
			<td>Blood Type</td>
			<td><select name="blood_type">
				<?php
				$file = file_get_contents("../etc/blood_types.dat");
				$file = explode("\n", trim($file));
				foreach ($file as $line){
				   $line = trim($line);
				   echo "<option value=\"$line\">$line</option>";
				}
				?>
			</select></td>
		</tr>
		<tr>
			<td>Sex</td>
			<td><select name="sex">
				<option value="M">M</option>
				<option value="F">F</option>
			</select></td>
		</tr>
		<tr>
			<td>Weight</td>
			<td><input type="number" name="weight">
				<select>
					<option value="kg">kg</option>
					<option value="lb">lb</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Owner D.O.B.</td>
			<td><input type="date" name="dob"></td>
		</tr>
		<tr>
			<td>Price</td>
			<td><input type="number" name="price">
				<select>
					<option value="U.S. Dollar">U.S. Dollar</option>
				</select>
			</td>
		</tr>
	</table></div>
	Description<br>
	<textarea rows="6" cols="60" name="description"></textarea><br>
	<?php if (isset($messages['file'])) echo $messages['file'];?>
	<div><input type="file" name="file_to_upload" id="file_to_upload"></div>
	<input type="submit" value="Submit">
</form></div></body>
</html>
<?php include("footer.php");?>
