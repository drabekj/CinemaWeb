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
    $seat_array = unserialize($row['seat_data']);
    $total_seat_rows = 10;
    $total_each_row_seats = 16;

    // get price of the ticket
    $select_query = "SELECT price FROM Movie WHERE id=" . $movie_id;
    $result = array();
    $result = $db->query($select_query);
    $row = $result->fetch_assoc();
    $price = $row['price'];
    $movie = $row['movie'];

    // initialize empty array if empty
    if($row['seat_data'] === null) {
        $seat_array = array();
        for($i = 0; $i < 10; $i++) {
            $seat_array[$i] = array();
            for($j = 0; $j < 16; $j++) {
                $seat_array[$i][$j] = 0;
            }
        }
    }

    // update seat data
    $new_seat_data = serialize($seat_array);
    $save_query = "UPDATE Screening SET seat_data='" . $new_seat_data . "' WHERE id=" . $id;
    if ($db->query($save_query) !== TRUE) {
        echo "Error updating record: " . $db->error;
    }
 ?>
<html>
    <head>
        <title>Please select seat</title>
        <link rel="stylesheet" type="text/css" href="css/select_seat_style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src='scripts/seatManagement.js' type='text/javascript'></script>
    </head>
    <body>
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
                                if ($seat_array[$i][$j])
                                    $seatStatus = "seat_btn_occupied";
                                else
                                    $seatStatus = "seat_btn_free";

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
                    <button onclick="return bookSeats();">Book now</button>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
   var seat_array = <?php echo json_encode($seat_array, JSON_HEX_TAG); ?>;
   var seat_price = <?php echo json_encode($price, JSON_HEX_TAG); ?>;
</script>
