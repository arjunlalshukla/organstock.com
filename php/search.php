<!DOCTYPE html>
<html>
<?php include("header.php");?>
<?php include("homerow.php");?>
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
			$file = file_get_contents("../etc/organ_types.dat");
			$file = explode("\n", trim($file));
			
// 			echo "<pre>" . print_r($file, 1) . "</pre>";
			$i = 0;
			foreach ($file as $line){
			   $line = trim($line);
			   echo "<input type=\"checkbox\" name=\"$line\" id=\"$line\"><label for=\"$line\" class=\"organ\">$line</label>";
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
			$file = file_get_contents("../etc/blood_types.dat");
			$file = explode("\n", trim($file));
// 			echo "<pre>" . print_r($file, 1) . "</pre>";
			$i = 0;
			foreach ($file as $line){
			   $line = trim($line);
			   echo "<input type=\"checkbox\" name=\"$line\" id=\"$line\"><label for=\"$line\" class=\"blood_type\">$line</label>";
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
			$file = file_get_contents("../etc/sexes.dat");
			$file = explode("\n", trim($file));
// 			echo "<pre>" . print_r($file, 1) . "</pre>";
			$i = 0;
			foreach ($file as $line){
			   $line = trim($line);
			   echo "<input type=\"checkbox\" name=\"$line\" id=\"$line\"><label for=\"$line\" class=\"sex\">$line</label>";
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
				<td><input type="number" name="weight_to">
					to
					<input type="number" name="weight_from">
					<select>
						<option value="kg">kg</option>
						<option value="lb">lb</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Age</td>
				<td><input type="number" name="age_to">
	             to
                <input type="number" name="age_from">
				</td>
			</tr>
		</table></div>
		<br>
		<input type="submit"  value="Submit">
	</form>
</div></body>
</html>
