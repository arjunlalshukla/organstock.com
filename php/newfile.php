<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("./DAO.php");
$dao = new DAO();

$valid = $dao->username_is_valid("a");
if ($valid) 
    echo "valid";
else
    echo "invalid";
?>