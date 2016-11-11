<?php
    include 'configDB.php';

    // update seat data
    $screening_id = $_POST['screening_id'];
    $new_seat_data = serialize($_POST['seat_array']);
    
    $save_query = "UPDATE Screening SET seat_data='" . $new_seat_data . "' WHERE id=" . $screening_id;
    if ($db->query($save_query) !== TRUE) {
        echo "Error updating record: " . $db->error;
    }
