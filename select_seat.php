<?php
    session_start();
    include "configDB.php";

    $select_query = "SELECT * FROM Screening WHERE id=" . $_GET['id'];
    $result = array();
    $result = $db->query($select_query);

    $row = $result->fetch_assoc();
    $id = $_GET['id'];
    $time = $row['screening_start'];
    $movie_id = $_GET['movie_id'];
    $seat_dataRAW = $row['seat_data'];
    // If we have already a order for this screening in shopping cart use that array,
    // otherwise get one from DB.
    $exists = 0;
    if (isset($_SESSION['orders_array']) && $_SESSION['orders_array'] != '') {
        foreach ($_SESSION['orders_array'] as $index => $order) {
            if($id == $order['screening_id']) {
                $seat_array = $order['seat_array'];
                $exists = 1;
            }
        }
    }
    if ($exists == 0) {
        $seat_array = unserialize($row['seat_data']);
    }
    $total_seat_rows = 10;
    $total_each_row_seats = 16;

    // get price of the ticket
    $select_query = "SELECT price, name FROM Movie WHERE id=" . $movie_id;
    $result = array();
    $result = $db->query($select_query);
    $row = $result->fetch_assoc();
    $price = $row['price'];
    $movie = $row['name'];

    // debug print
    // echo '<pre>' . var_export($_SESSION, true) . '</pre>';

    // initialize empty array if empty
    if($seat_dataRAW == null) {
        $seat_array = array();
        for($i = 0; $i < 10; $i++) {
            $seat_array[$i] = array();
            for($j = 0; $j < 16; $j++) {
                $seat_array[$i][$j] = 0;
            }
        }

        // update seat data
        $new_seat_data = serialize($seat_array);
        $save_query = "UPDATE Screening SET seat_data='" . $new_seat_data . "' WHERE id=" . $id;
        if ($db->query($save_query) !== TRUE) {
            echo "Error updating record: " . $db->error;
        }
    }
 ?>
<html>
    <head>
        <title>Please select seat</title>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/creative.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/select_seat_style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src='scripts/seatManagement.js' type='text/javascript'></script>
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
                    <a class="navbar-brand page-scroll" href="index.php">
                        <img id="nav_logo" src="/icon/logo_icon_small.png" />
                        ABC Cinema
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="movie_offer.php">Movie Offer</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="login.php">Log In</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="registration.php">Register</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <div id="select_seat_wrapper">
            <h2>Please select seat for the movie <?php echo $movie ?></h2>
            <p><?php echo $time; ?></p>
            <hr>
            <div id="seat_map">
                <table id="seats_table">
                    <tr>
                        <td></td><th id="table_screen" colspan="<?php echo $total_each_row_seats; ?>">Screen</th>
                    </tr>
                    <tr class="spacer"></tr>
                    <?php
                        for ($i=0; $i < $total_seat_rows; $i++) {
                            echo "<tr><th>" . chr(65 + $i) . "</th>";
                            for ($j=0; $j < $total_each_row_seats; $j++) {
                                if ($seat_array[$i][$j] == 1) {
                                    $seatStatus = "seat_btn_occupied";
                                }
                                else if ($seat_array[$i][$j] == 2) {
                                    $seatStatus = "seat_btn_selected";
                                }
                                else {
                                    $seatStatus = "seat_btn_free";
                                }

                                echo "<td>
                                        <button class='seat_btn " . $seatStatus . "' onclick='toggleSeat(" . $i . "," . $j . ",this)'>"
                                            . ($j + 1)
                                        . "</button>
                                    </td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </table>
            </div>
            <hr>
            <div id="box_under_table">
                <div id="left_booking_details">
                    <p>Total price: <span class="totalPrice">0</span> $HKD</p>
                    <p>Seat count: <span class="totalCount">0</span></p>
                </div>
                <div id="right_booking_details">
                    <button onclick="return bookSeats();" class="btn btn-primary">Add to shopping cart</button>
                </div>
            </div>
        </div>
    </body>
</html>
<!-- pass data to seatManagement.js -->
<script>
   var seat_array = <?php echo json_encode($seat_array, JSON_HEX_TAG); ?>;
   var seat_price = <?php echo json_encode($price, JSON_HEX_TAG); ?>;
   var screening_id = <?php echo json_encode($id, JSON_HEX_TAG); ?>;
   var movie_name = <?php echo json_encode($movie, JSON_HEX_TAG); ?>;
</script>
