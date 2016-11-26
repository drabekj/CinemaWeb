<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- This is only to show you how to access the data -->
    <?php
        if (isset($_SESSION['orders_array']) && $_SESSION['orders_array'] != '') {
            echo "<h1>You have " . count($_SESSION['orders_array']) . " orders in your shopping cart.</h1>";
            echo "<a href='clearShoppingCart.php?clearCart=true'><button class='clearShoppingCart'>Clear shopping cart</button></a>";
        }
    ?>

    <a href="movie_offer.php"><button type="button"> Movie Display </button></a>
</body>
</html>
