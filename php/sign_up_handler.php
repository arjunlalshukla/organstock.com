<!DOCTYPE html>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("DAO.php");
$dao = new DAO();

echo $dao->username_is_valid("a");

echo '<pre>' . print_r($_POST, 1) . '</pre>';

$account_type = isset($_POST['account_type']) ? $_POST['account_type'] : "";
$username = $_POST['username'];
$password = $_POST['password'];
$re_password = $_POST['password_again'];
$email = $_POST['email'];
$re_email = $_POST['email_again'];
$country = $_POST['country'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$suffix = $_POST['suffix'];
//$degree = $_POST['degree'];
//$agency = $_POST['agency'];
//$license = $_POST['license'];

$_SESSION['presets'] = $_POST;
echo '<pre>' . print_r($_SESSION['presets'], 1) . '</pre>';
echo '<pre>' . print_r($_FILES, 1) . '</pre>';
$valid = true;
$messages = array();

if ($username == ""){
   $messages['username'] = "Enter a username";
   $valid = false;
} else if (preg_match("/\w{1,}/", $username) === 0){
   echo "bar";
   $messages['username'] = "All characters must be letter, number or underscore";
   $valid = false;
}else if (!$dao->username_is_valid($username)){
   $messages['username'] = "Username is already taken";
   $valid = false;
}
  
if ($password == ""){
   $messages['password'] = "Enter a password";
   $valid = false;
} else if (preg_match("/\w{1,}/", $password) === 0){
   $messages['password'] = "All characters must be letter, number or underscore";
   $valid = false;
} else if ($password != $re_password){
   $messages['password'] = "Password inputs must match";
   $valid = false;
}

if ($email == ""){
   $messages['email'] = "Enter an email";
   $valid = false;
} else if (preg_match("/\w{1,}@\w{1,}/", $email) === 0){
   $messages['email'] = "Email must contain '@'";
   $valid = false;
} else if ($email != $re_email){
   $messages['email'] = "Email inputs must match";
   $valid = false;
}

$file = file_get_contents("../etc/countries.dat");
$file = explode("\n", trim($file));
if (!in_array($country, $file)){
   $messages['country'] = "Country does not exist";
   $valid = false;
}

if ($account_type == "physician"){
   if ($first_name == ""){
      $messages['first_name'] = "Enter a first name";
      $valid = false;
   }
   if ($last_name == ""){
      $messages['last_name'] = "Enter a last_name";
      $valid = false;
   }
}

if (/*$account_type != "physician" && */ $account_type != "buyer_seller") {
    $messages['account_type'] = "Account type must be either Buyer/Seller" /* .  " or Physician" */;
    $valid = false;
}

if (isset($_FILES['file_to_upload']) && $_FILES['file_to_upload']['error'] == 1){
    $messages['file'] = "File is too big";
    $valid = false;
}

if ($account_type == "physician" && $valid){
   $image_path = "none";
   if (isset($_FILES['file_to_upload']) && $_FILES['file_to_upload']['error'] == ""){
      $path = $_FILES["file_to_upload"]["name"];
      $ext = pathinfo($path, PATHINFO_EXTENSION);
      $image_path = "../images/profiles/$username" /* . "." . $ext */;
      if (!move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $image_path)) {
         throw new Exception("File move failed");
      }
   }
   $dao->create_physician($username, $password, $email, $country, $first_name, $last_name, $suffix, "none", "none", "none", $image_path);
} else if ($account_type == "buyer_seller" && $valid){
    $image_path = "none";
    if (isset($_FILES['file_to_upload']) && $_FILES['file_to_upload']['error'] == ""){
        $path = $_FILES["file_to_upload"]["name"];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $image_path = "../images/profiles/$username" /* . "." . $ext */;
        if (!move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $image_path)) {
            throw new Exception("File move failed");
        }
    }
    $dao->create_buyer_seller($username, $password, $email, $country, $image_path);
} 

if (!$valid) {
   $_SESSION['messages'] = $messages;
   header("Location: sign_up.php");
   exit;
}

unset($_SESSION['presets']);
header("Location: index.php");
exit;
?>
