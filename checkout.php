<?php
    session_start();

    $seat_array = json_decode($_POST['seat_array']);
    $screening_id = $_POST['screening_id'];
    $seat_count = $_POST['seatCount'];
    $movie_name = $_POST['movie_name'];
    $_SESSION['screening_id'] = $screening_id;
    $_SESSION['seat_array'] = $seat_array;
    $_SESSION['seat_count'] = $seat_count;
    $_SESSION['movie_name'] = $movie_name;

    // debug print
    // foreach ( $seat_array as $subarray ) {
    //     foreach ( $subarray as $item ) {
    //             echo $item . " ";
    //     }
    //     echo "<br>";
    // }
    // echo "screening_id:" . $screening_id . "<br>";
    // echo "seat_count:" . $seat_count . "<br>";
    // echo "movie_name:" . $movie_name . "<br>";

 ?>

<html>
    <head>
        <title>Checkout</title>
        <p>The selected tickets were added to the shopping card.</p>
        <p>(stored in session)</p>
    </head>
    <body>

    </body>
</html>
