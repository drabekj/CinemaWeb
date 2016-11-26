<?php session_start(); ?>
<html>
<head>
    <title>Shopping cart</title>
    <link href="css/creative.css" rel="stylesheet">
    <link href="css/checkout.css" rel="stylesheet">
</head>
<body>
    <header>
        <div id="cart_wrap">
            <?php
            $count = count($_SESSION['orders_array']);
            if($count == 1)
                $fillValue = $count . " order";
            else
                $fillValue = $count . " ordes";

            echo "<h1>You have " . $fillValue . " in your shopping cart.</h1>"
             ?>
             <hr noshade>
            <a href='movie_offer.php'><button class='btn btn-primary btn-xl'>Continue Shopping</button></a>
            <a href='clearShoppingCart.php?clearCart=true'><button class='clearShoppingCart btn btn-primary btn-xl'>Empty cart</button></a>
            <a href='card.php'><button class='btn btn-primary btn-xl'>Pay</button></a>
        </div>
    </header>
</body>
</html>
