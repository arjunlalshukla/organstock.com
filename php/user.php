<!DOCTYPE html>
<html>
<?php include("header.php");?>
<?php include("homerow.php");?>
<head>
	<title>Username</title>
	<link rel="stylesheet" href="/css/all.css">
</head>
<body><div id="content">
	<h1>Username</h1>
	<img id="profile" src="/etc/profile.png" alt="profile picture"><br>
	<div><button type="button">Upload Photo</button></div><br>
	<form action="handler.php" method="POST"><table>
		<tr>
			<th>Visible</th>
		</tr>
		<tr>
			<td><input type="checkbox" name="name_check"></td><!--Not optional for physicians-->
			<td>Name</td>
			<td>Arjun Shukla</td>
		</tr>
		<tr>
			<td></td>
			<td>Country</td>
			<td>Singapore</td>
		<tr>
			<td></td>
			<td>State/Province</td>
			<td>Singapore</td>
		</tr>
		<tr><!-- If Physician -->
			<td></td>
			<td>Licensing Agency</td>
			<td>Singapore Medical Council</td>
		</tr>
		<tr><!-- If Physician -->
			<td></td>
			<td>License #</td>
			<td><input type="text" name="license" value="12345"></td>
		</tr>
		<tr><!-- If Physician -->
			<td></td>
			<td>Specialty</td>
			<td>Cardiothoracic Surgery</td>
		</tr>
		<?php 
//			for each email in emails
				echo "<tr>";
					echo "<td><input type=\"checkbox\" name=\"email_check\"></td>";
					echo "<td>E-Mail</td>";
					echo "<td><input type=\"email\" name=\"email\"></td>";
				echo "</tr>";
		?>
	</table></form>
	<!-- If Buyer/Seller -->
	<table>
		<?php
//			for each organ in organs
				echo "<tr>";
					echo "<td><a href=\"/php/organ.php\"><div><img src=\"/etc/organ_id.png\" alt=\"organ pic\"></div></a></td>";
					echo "<td><a href=\"/php/organ.php\"><div><table>";
						echo "<tr><td><table><tr>";
							echo "<td>Organ type</td>";
							echo "<td>Blood Type: X</td>";
							echo "<td>Sex: X</td>";
							echo "<td>Age: X</td>";
							echo "<td>Weight: X</td>";
						echo "</tr></table></td></tr>";
						echo "<tr><td>";
							echo "This is the description of the organ. It may be written by brokers for OrganStock or the seller themselves.";
						echo "</td></tr>";
					echo "</table></div></a></tr>";
				echo "</tr>";
		?>
	</table>
	<a href="/php/organ.php"><button type="button">New Organ</button></a>
</div></body>
</html>
<?php include("footer.php");?>
