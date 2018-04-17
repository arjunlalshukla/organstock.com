<!DOCTYPE html>
<html>
<?php
include("header.php");
include("homerow.php");
require_once('./DAO.php');
$dao = new DAO();
$username = $_GET['username'];
$user = $dao->get_user_info($username);
$email = $user['email'];
$country = $user['country'];
$image_path = $user['image_path'];
?>
<head>
	<title><?php echo htmlspecialchars($username); ?></title>
	<link rel="stylesheet" href="/css/all.css">
</head>
<body><div id="content">
	<h1><?php echo htmlspecialchars($username); ?></h1>
	<?php 
	$image_html = $image_path == "none" ? '' : "<img class=\"profile\" src=\"/images/profiles/$username\" alt=\"profile pic\"></a>";
	echo htmlspecialchars($image_html);
	?><br>
	<table id="user_info">
		<tr>
			<td>E-Mail</td>
			<td><?php echo htmlspecialchars($email); ?></td>
		<tr>
			<td>Country</td>
			<td><?php echo htmlspecialchars($country); ?></td>
		</tr>
	</table>
	<table class="organ_listing_info">
		<?php
		foreach ($dao->user_get_organs($username) as $organ){
		    $organ_id = $organ['id'];
		    $seller = $organ['seller_username'];
		    $organ_type = $organ['organ_type'];
		    $blood_type = $organ['blood_type'];
		    $sex = $organ['sex'];
		    $dob = $organ['owner_dob'];
		    $d1 = new DateTime($dob);
		    $d2 = new DateTime(date("Y-m-d"));
		    $diff = $d2->diff($d1);
		    $age = $diff->y;
		    $weight = $organ['weight'];
		    $price = $organ['price'];
		    $description = $organ['description'];
            $image_html = $organ['image_path'] == "none" ? '' : "<a href=\"/php/organ.php?organ_id=$organ_id\"><div><img class=\"organ_listing\" src=\"/images/organs/$organ_id\" alt=\"organ pic\"></div></a>";
            echo htmlspecialchars(
			"<tr>
				<td>$image_html</td>
				<td><a href=\"/php/organ.php?organ_id=$organ_id\"><div><table>
					<tr><td><table class=\"organ_listing_info\"><tr>
						<td class=\"organ_listing_info\">$organ_type</td>
						<td class=\"organ_listing_info\">Blood Type: $blood_type</td>
						<td class=\"organ_listing_info\">Sex: $sex</td>
						<td class=\"organ_listing_info\">Age: $age</td>
						<td class=\"organ_listing_info\">Weight: $weight</td>
						<td class=\"organ_listing_info\">Price: $ $price</td>
					</tr></table></td></tr>
					<tr><td class=\"organ_listing_info\">
						$description
					</td></tr>
				</table></div></a></tr>
			</tr>");
		}
		?>
	</table>
</div></body>
</html>
<?php include("footer.php");?>

