<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("./DAO.php");
$dao = new DAO();

if (!isset($_SESSION['user'])){
    http_response_code(403);
    die('Forbidden');
}

echo '<pre>' . print_r($_POST, 1) . '</pre>';

$organ_type = $_POST['organ_type'];
$blood_type = $_POST['blood_type'];
$sex = $_POST['sex'];
$weight = $_POST['weight'];
$dob = $_POST['dob'];
$price = $_POST['price'];
$description = $_POST['description'];

$_SESSION['presets'] = $_POST;
echo '<pre>' . print_r($_SESSION['presets'], 1) . '</pre>';
echo '<pre>' . print_r($_FILES, 1) . '</pre>';
$valid = true;
$messages = array();

$file = file_get_contents("../etc/organ_types.dat");
$file = explode("\n", trim($file));
if (!in_array($organ_type, $file)){
    $messages['organ_type'] = "Organ type must be valid";
    $valid = false;
}

$file = file_get_contents("../etc/blood_types.dat");
$file = explode("\n", trim($file));
if (!in_array($blood_type, $file)){
    $messages['blood_type'] = "Blood type must be one of (A-, A+, AB-, AB+, B-, B+, O-, O+)";
    $valid = false;
}

$file = file_get_contents("../etc/sexes.dat");
$file = explode("\n", trim($file));
if (!in_array($sex, $file)){
    $messages['sex'] = "Sex is not valid";
    $valid = false;
}

if (!is_numeric($weight)){
    $messages['weight'] = "Weight must be a number";
    $valid = false;
} else if ($weight <= 0) {
    $messages['weight'] = "Weight must be positive";
    $valid = false;
}

if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dob) == 0) {
    $messages['dob'] = "Not in date format";
    $valid = false;
} else if (!checkdate(substr($dob, 5, 2), substr($dob, 8, 2), substr($dob, 0, 4))){
    $messages['dob'] = "Date is not valid on calendar";
    $valid = false;
}

if (!is_numeric($price)){
    $messages['price'] = "Price must be a number";
    $valid = false;
} else if ($price < 0) {
    $messages['price'] = "Price must not be negative";
    $valid = false;
}

if (strlen($description) >  65535){
    $messages['description'] = "Description is too long. Max character count is 65535";
    $valid = false;
}

if (isset($_FILES['file_to_upload']) && $_FILES['file_to_upload']['error'] == 1){
    $messages['file'] = "File is too big";
    $valid = false;
}

echo '<pre>' . print_r($messages, 1) . '</pre>';

echo $dao->organ_get_next_id();

if ($valid){
    $image_path = "none";
    $organ_id = $dao->organ_get_next_id();
    if (isset($_FILES['file_to_upload']) && $_FILES['file_to_upload']['error'] == ""){
        $path = $_FILES["file_to_upload"]["name"];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $image_path = "../images/organs/$organ_id" /* . "." . $ext */;
        if (!move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $image_path)) {
            throw new Exception("File move failed");
        }
    }
    $dao->create_organ($_SESSION['user']['username'], $organ_type, $blood_type, $sex, $weight, $dob, $price, $description, $image_path);
} else {
    $_SESSION['messages'] = $messages;
    header("Location: create_organ.php");
    exit;
}

