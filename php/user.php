<?php
session_start();
require_once("DAO.php");
$dao = new DAO();
$username = $_GET['username'];
echo "<pre>" . print_r($_SESSION['user'], 1) . "</pre>";
echo "<pre>" . print_r($_GET, 1) . "</pre>";
echo "phys pri";
if ($_SESSION['user']['username'] == $username && $dao->get_user_info($username)['physician'] == 1){
    header("Location: physician_private.php");
    exit;
} else if ($_SESSION['user']['username'] != $username && $dao->get_user_info($username)['physician'] == 1){
    header("Location: physician_public.php");
    exit;
} else if ($_SESSION['user']['username'] == $username && $dao->get_user_info($username)['physician'] == 0){
    header("Location: buyer_seller_private.php");
    exit;
} else if ($_SESSION['user']['username'] != $username && $dao->get_user_info($username)['physician'] == 0){
    header("Location: buyer_seller_public.php");
    exit;
}
?>