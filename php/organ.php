<!DOCTYPE html>
<html>
<?php
include("header.php");
include("homerow.php");
require_once('./DAO.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// echo "<pre>" . print_r($_GET, 1) . "</pre>";
$organ_id = $_GET['organ_id'];
$dao = new DAO();
$organ = $dao->get_organ_info($organ_id);
// echo "<pre>" . print_r($organ, 1) . "</pre>";
$seller = $organ['seller_username'];
?>
<head>
	<Title><?php echo htmlspecialchars($organ['id'] . " - " . $seller); ?></title>
	<link rel="stylesheet" href="/css/all.css">
</head>
<body><div id="content">
	<h1><?php echo htmlspecialchars($organ['id']);?></h1>

	<?php ; ?>
	<?php 
	$image_html = $organ['image_path'] == "none" ? '' : "<img class=\"organ\" src=\"/images/organs/$organ_id\" alt=\"organ pic\"></a>";
	echo htmlspecialchars($image_html);
	?>
	<table id="organ_info">
		<tr>
			<td>Seller</td>
			<td><a href="/php/buyer_seller_public.php?username=<?php echo htmlspecialchars($seller);?>"><?php echo htmlspecialchars($seller); ?></a></td>
		</tr>
		<tr>
			<td>Organ Type</td>
			<td><?php echo htmlspecialchars($organ['organ_type']);?></td>
		</tr>
		<tr>
			<td>Blood Type</td>
			<td><?php echo htmlspecialchars($organ['blood_type']);?></td>
		</tr>
		<tr>
			<td>Sex</td>
			<td><?php echo htmlspecialchars($organ['sex']);?></td>
		</tr>
		<tr>
			<td>Weight</td>
			<td><?php echo htmlspecialchars($organ['weight']);?></td>
		</tr>
		<tr>
			<td>Owner D.O.B.</td>
			<td><?php echo htmlspecialchars(date("m/d/Y", strtotime($organ['owner_dob'])));?></td>
		</tr>
		<tr>
			<td>Price</td>
			<td>$ <?php echo htmlspecialchars($organ['price']);?></td>
		</tr>
	</table><br>
	Description<br><br>
	<div id="description"><?php echo htmlspecialchars($organ['description']);?></div>
</div></body>
</html>
<?php include("footer.php");?>
