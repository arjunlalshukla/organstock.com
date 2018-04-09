<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("./DAO.php");
$dao = new DAO();

$_SESSION['presets'] = $_GET;
$valid = true;
$messages = array();

$weight_low = $_GET['weight_low'];
$weight_up = $_GET['weight_up'];
$age_low = $_GET['age_low'];
$age_up = $_GET['age_up'];


if ((!is_numeric($weight_low) && $weight_low != "") || (!is_numeric($weight_up) && $weight_up != "")){
    $messages['weight'] = "Weight must be a number";
    $valid = false;
} else if ($weight_low < 0 || $weight_up < 0) {
    $messages['weight'] = "Weight must not be negative";
    $valid = false;
} else if ($weight_low > $weight_up){
    $messages['weight'] = "Lower bound cannot be greater than upper bound";
    $valid = false;
}

if ((!is_numeric($age_low) && $age_low != "") || (!is_numeric($age_up) && $age_up != "")){
    $messages['age'] = "age must be a number";
    $valid = false;
} else if ($age_low < 0 || $age_up < 0) {
    $messages['age'] = "age must not be negative";
    $valid = false;
} else if ($age_low > $age_up){
    $messages['age'] = "Lower bound cannot be greater than upper bound";
    $valid = false;
}else if (((int) $age_low) != $age_low || ((int) $age_up) != $age_up){
    $messages['age'] = "Any bounds given must be integers";
    $valid = false;
} else if ($age_low > date("Y") || $age_up > date("Y")) {
    $messages['age'] = "Age given cannot exceed " . date("Y");
    $valid = false;
}

$organ_types = array();
$file = file_get_contents("../etc/organ_types.dat");
$file = explode("\n", trim($file));
foreach ($file as $line){
    $line = trim($line);
    if (isset($_GET[$line])){
        $organ_types[] = $line;
    }
}
if (empty($organ_types)){
    $messages['organ_type'] = "Select at least one type of organ to search for.";
    $valid = false;
}

$blood_types = array();
$file = file_get_contents("../etc/blood_types.dat");
$file = explode("\n", trim($file));
foreach ($file as $line){
    $line = trim($line);
    if (isset($_GET[$line])){
        $blood_types[] = $line;
    }
}
if (empty($blood_types)){
    $messages['blood_type'] = "Select at least one blood type to search for.";
    $valid = false;
}

$sexes = array();
$file = file_get_contents("../etc/sexes.dat");
$file = explode("\n", trim($file));
foreach ($file as $line){
    $line = trim($line);
    if (isset($_GET[$line])){
        $sexes[] = $line;
    }
}
if (empty($sexes)){
    $messages['sex'] = "Select at least one sex to search for.";
    $valid = false;
}

if (!$valid){
    $_SESSION['messages'] = $messages;
    header("Location: search.php");
    exit;
}

$results = $dao->search_organs($organ_types, $blood_types, $sexes, $weight_low, $weight_up, $age_low, $age_up);
?>
<!DOCTYPE html>
<html>
<?php
include("header.php");
include("homerow.php");
require_once('./DAO.php');
$dao = new DAO();
?>
<head>
	<title>Search Results</title>
	<link rel="stylesheet" href="/css/all.css">
</head>
<body><div id="content">
	<h1>Search Results</h1>
	<table class="organ_listing_info">
		<?php
		foreach ($results as $organ){
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
			echo 
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
			</tr>";
		}
		?>
	</table>
</div></body>
</html>
<?php include("footer.php");?>
