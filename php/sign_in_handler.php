<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("DAO.php");
$dao = new DAO();

echo '<pre>' . print_r($_POST, 1) . '</pre>';

$username = $_POST['username'];
$password = $_POST['password'];

if ($dao->password_is_valid($username, $password)) {
//     echo "<pre>" . print_r($dao->get_user_info($username)) . "</pre>";
    $_SESSION["user"] = $dao->get_user_info($username);
    echo $username . " , " .  $password . " , " . "accepted";
   header("Location: index.php");
   exit;
} else {
    $status = "Invalid username or password";
    $_SESSION["status"] = $status;
    $_SESSION["username_preset"] = $username;
    $_SESSION["access_granted"] = false;
    echo $username . " , " .  $password . " , " . "rejected";
    header("Location: ./sign_in.php");
    exit;
}
?>