<?php
    session_start();
    include 'configDB.php';

    foreach ($_SESSION['orders_array'] as $index => $screening_order) {
        $screening_id = $screening_order['screening_id'];

        // change 2s to 1s (change selected seats to occupied seats in array)
        foreach ($screening_order['seat_array'] as $indexOrder => $row) {
            foreach ($row as $indexSeat => $seat) {
                if ($seat == 2)
                    $screening_order['seat_array'][$indexOrder][$indexSeat] = 1;
            }
        }
        $new_seat_data = serialize($screening_order['seat_array']);

        $save_query = "UPDATE Screening SET seat_data='" . $new_seat_data . "' WHERE id=" . $screening_id;
        if ($db->query($save_query) !== TRUE) {
            echo "Error updating record: " . $db->error;
        }
    }
    unset($_SESSION['orders_array']);
