<?php
session_start();
include 'clearShoppingCart.php';

if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
    unset($_SESSION['fullname']);
    clearShoppingCart();
    header('Location: index.php');
} else {
    header('Location: index.php');
}
?>
