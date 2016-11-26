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
    // echo '<pre>' . var_export($_SESSION, true) . '</pre>';
 ?>

<html>
    <head>
        <title>Checkout</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src='scripts/updateDB.js' type='text/javascript'></script>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/creative.css" rel="stylesheet">
        <link href="css/checkout.css" rel="stylesheet">
    </head>
    <body>
        <?php
            if (isset($_SESSION['orders_array']) && $_SESSION['orders_array'] != '') {
                echo "<h1>You have " . count($_SESSION['orders_array']) . " orders in your shopping cart.</h1>";
                echo "<a href='clearShoppingCart.php?clearCart=true'><button class='clearShoppingCart'>Clear shopping cart</button></a>";
            }
        ?>

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="index.php">ABC Cinema</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="movie_offer.php">Movie Offer</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#portfolio">Log In</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact">Register</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <div class="proceed_box">
            <p>The selected tickets were added to the shopping card.</p>
            <p>(stored in session)</p>
            <a href="movie_offer.php">
                <button type="button" id="proceed_shop_btn" class="btn btn-primary btn-xl page-scroll">
                    Continue shopping
                </button>
            </a>
            <a href="credit_card.php">
                <button type="button" id="proceed_pay_btn" class="btn btn-primary btn-xl"> <!-- onclick='saveSeats(<?php echo json_encode($_SESSION); ?>)'> -->
                    Proceed to Payment
                </button>
            </a>
        </div>
    </body>
</html>
