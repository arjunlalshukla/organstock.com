<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("./DAO.php");
$dao = new DAO();

echo '<pre>' . print_r($_POST, 1) . '</pre>';
?>
