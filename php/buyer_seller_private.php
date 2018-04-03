<!DOCTYPE html>
<html>
<?php
include("header.php");
include("homerow.php");
require_once('./DAO.php');
$dao = new DAO();
$username = $_SESSION['user']['username'];
$email = $_SESSION['user']['email'];
$country = $_SESSION['user']['country'];
$image_path = $_SESSION['user']['image_path'];
?>
<head>
	<title><?php echo $username; ?></title>
	<link rel="stylesheet" href="/css/all.css">
</head>
<body><div id="content">
	<h1><?php echo $username; ?></h1>
	<img id="profile" src="<?php echo $image_path; ?>" alt="profile picture"><br>
	<div><button type="button">Upload Photo</button></div><br>
	<table id="user_info">
		<tr>
			<td>E-Mail</td>
			<td><?php echo $email; ?></td>
		<tr>
			<td>Country</td>
			<td><?php echo $country; ?></td>
		</tr>
	</table>
	<table>
		<?php
//		foreach ($dao->user_get_organs($username) as $organ){
			echo 
			"<tr>
				<td><a href=\"/php/organ.php\"><div><img src=\"/etc/organ_id.png\" alt=\"organ pic\"></div></a></td>
				<td><a href=\"/php/organ.php\"><div><table>
					<tr><td><table><tr>
						<td>Organ type</td>
						<td>Blood Type: X</td>
						<td>Sex: X</td>
						<td>Age: X</td>
						<td>Weight: X</td>
					</tr></table></td></tr>
					<tr><td>
						This is the description of the organ. It may be written by brokers for OrganStock or the seller themselves.
					</td></tr>
				</table></div></a></tr>
			</tr>";
//		}
		?>
	</table>
	<a href="/php/create_organ.php"><button type="button">New Organ</button></a>
</div></body>
</html>
<?php include("footer.php");?>
