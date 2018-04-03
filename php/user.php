<?php
session_start();
require_once("./DAO.php");
$dao = new DAO();
if ($_SESSION['user']['username'] == $_GET['username'] && $dao->get_user_info($_GET['username'])['physician'] == 1){
    echo "<pre>" . print_r($_SESSION['user'], 1) . "</pre>";
    echo "<pre>" . print_r($_GET, 1) . "</pre>";
    echo "phys pri";
//     header("Location: physician_private.php");
//     exit;
} else if ($_SESSION['user']['username'] != $_GET['username'] && $dao->get_user_info($_GET['username'])['physician'] == 1){
    echo "<pre>" . print_r($_SESSION['user'], 1) . "</pre>";
    echo "<pre>" . print_r($_GET, 1) . "</pre>";
    echo "phys pub";
//     header("Location: physician_public.php");
//     exit;
} else if ($_SESSION['user']['username'] == $_GET['username'] && $dao->get_user_info($_GET['username'])['physician'] == 0){
    echo "<pre>" . print_r($_SESSION['user'], 1) . "</pre>";
    echo "<pre>" . print_r($_GET, 1) . "</pre>";
    echo "b_s pri";
//     header("Location: buyer_seller_private.php");
//     exit;
} else if ($_SESSION['user']['username'] != $_GET['username'] && $dao->get_user_info($_GET['username'])['physician'] == 0){
    echo "<pre>" . print_r($_SESSION['user'], 1) . "</pre>";
    echo "<pre>" . print_r($_GET, 1) . "</pre>";
    echo "b_s pri";
//     header("Location: buyer_seller_public.php");
//     exit;
}
?>