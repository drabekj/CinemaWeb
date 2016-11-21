<?php
    session_start();

    // store selected seats in session ready to be updated to DB upon payment
    // stored as an array, each item in array represents 1 screening order (might contain more tickets)
    $seat_array = json_decode($_POST['seat_array']);
    $screening_id = $_POST['screening_id'];
    $seat_count = $_POST['seatCount'];
    $movie_name = $_POST['movie_name'];

    // NULL arguments, redirect to movie offer
    if ($screening_id == null || $seat_count == null || $seat_count == 0) {
        header('Location: movie_offer.php');
        die();
    }

    // single order for a movie
    $movie_order = array('movie_name' => $movie_name, 'screening_id' => $screening_id,
        'seat_array' => $seat_array, 'seat_count' => $seat_count);

    if (!(isset($_SESSION['orders_array']) && $_SESSION['orders_array'] != '')) {
        $orders_array = array();
        $_SESSION['orders_array'] = $orders_array;
    }
    // find if that screening has already order
    $exists = 0;
    foreach ($_SESSION['orders_array'] as $index => $order) {
        if($screening_id == $order['screening_id']) {
            $_SESSION['orders_array'][$index] = $movie_order;
            $exists = 1;
        }
    }
    // add new order to array
    if ($exists == 0) {
        $_SESSION['orders_array'][] = $movie_order;
    }

    // debug print
    echo '<pre>' . var_export($_SESSION, true) . '</pre>';
 ?>

<html>
    <head>
        <title>Checkout</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src='scripts/updateDB.js' type='text/javascript'></script>
    </head>
    <body>
        <?php
            if (isset($_SESSION['orders_array']) && $_SESSION['orders_array'] != '') {
                echo "<h1>You have " . count($_SESSION['orders_array']) . " orders in your shopping cart.</h1>";
                echo "<a href='clearShoppingCart.php?clearCart=true'><button class='clearShoppingCart'>Clear shopping cart</button></a>";
            }
        ?>

        <p>The selected tickets were added to the shopping card.</p>
        <p>(stored in session)</p>
        <a href="movie_offer.php"><button type="button">
            Continue shopping
        </button></a>
        <button type="button" onclick='saveSeats(<?php echo json_encode($_SESSION); ?>)'>
            UPDATE DB(will happen automatically when payed)
        </button>
    </body>
</html>
