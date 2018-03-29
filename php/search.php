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
			<input type="checkbox" name="organ_type" id="blood"><label for="blood" class="organ">Blood</label>
	      <input type="checkbox" name="organ_type" id="cornea"><label for="cornea" class="organ">Cornea</label>
	      <input type="checkbox" name="organ_type" id="intestine"><label for="intestine" class="organ">Intestine</label><br>
	      <input type="checkbox" name="organ_type" id="lung_both"><label for="lung_both" class="organ">Lungs (both)</label>
	      <input type="checkbox" name="organ_type" id="lung_left"><label for="lung_left" class="organ">Lung (left)</label>
	      <input type="checkbox" name="organ_type" id="lung_right"><label for="lung_right" class="organ">Lung (right)</label><br>
	      <input type="checkbox" name="organ_type" id="pancreas"><label for="pancreas" class="organ">Pancreas</label>
	      <input type="checkbox" name="organ_type" id="kidney"><label for="kidney" class="organ">Kidney</label>
	      <input type="checkbox" name="organ_type" id="liver"><label for="liver" class="organ">Liver</label>
		</div>
		<br>
		<div><table>
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
		<input type="submit"  value="submit">
	</form>
</div></body>
</html>
