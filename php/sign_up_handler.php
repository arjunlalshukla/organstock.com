<!DOCTYPE html>
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("./DAO.php");
$dao = new DAO();

echo '<pre>' . print_r($_POST, 1) . '</pre>';

$account_type = $_POST['account_type'];
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

$_SESSION['presets'] = array($_POST);
$valid = true;
$messages = array();

if ($username == ""){
   $messages['username'] = "Enter a username";
   $valid = false;
   echo "foo";
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
   $messages['password'] = "Email must contain '@'";
   $valid = false;
} else if ($password != $re_password){
   $messages['password'] = "Email inputs must match";
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

if ($account_type == "physician"){
   $image_path = "none";
   if (isset($_FILE['file_to_upload'])){
      $imagePath = "../images/profiles/$username" . "_" . $_FILES["fileToUpload"]["name"];
      if (!move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $imagePath)) {
         throw new Exception("File move failed");
      }
   }
   $dao->create_physician($username, $password, $email, $country, $first_name, $last_name, $suffix, "none", "none", "none", $image_path);
} else if ($account_type == "buyer_seller"){
    $image_path = "none";
    if (isset($_FILE['file_to_upload'])){
        $imagePath = "../images/profiles/$username" . "_" . $_FILES["fileToUpload"]["name"];
        if (!move_uploaded_file($_FILES["file_to_upload"]["tmp_name"], $imagePath)) {
            throw new Exception("File move failed");
        }
    }
    $dao->create_buyer_seller($username, $password, $email, $country, $image_path);
} else {
   $messages['account_type'] = "Account type must be either Buyer/Seller or Physician";
   $valid = false;
}

if (!$valid) {
   $_SESSION['messages'] = $messages;
   header("Location: sign_up.php");
   exit;
}
?>
