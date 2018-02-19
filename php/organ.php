<html>
<head>
	<Title>Organ Type - ID#</title>
	<link rel="stylesheet" href="/css/all.css">
</head>
<?php include("header.php");?>
<?php include("homerow.php");?>
<body><div id="content"><form action="handler.php" method="POST">
	<h1>Organ Type - Seller - ID#</h1>
	<img id="organ" src="/etc/lungs.jpg" alt="organ"><br>
	<div><button type="button">Upload Photo</button></div><br>
	<form action="handler.php" method="POST"><div><table>
		<tr>
			<td>Blood Type</td>
			<td><Select>
				<option value="op">O+</option>
				<option value="on">O-</option>
				<option value="ap">A+</option>
				<option value="an">A-</option>
				<option value="bp">B+</option>
				<option value="bn">B-</option>
				<option value="abp">AB+</option>
				<option value="abn">AB-</option>
			</select></td>
		</tr>
		<tr>
			<td>Sex</td>
			<td><select>
				<option value="male">M</option>
				<option value="female">F</option>
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
	</table></div>
	Description<br>
	<textarea rows="6" cols="60"></textarea><br>
	<input type="submit" value="Submit">
</form></div></body>
</html>
<?php include("footer.php");?>
