<?php
    session_start();

    if (isset($_GET['clearCart'])) {
        clearShoppingCart();
    }

    function clearShoppingCart() {
        unset($_SESSION['orders_array']);
        header('Location: movie_offer.php');
        die();
    }
