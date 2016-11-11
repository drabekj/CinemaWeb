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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src='scripts/updateDB.js' type='text/javascript'></script>
    </head>
    <body>
        <p>The selected tickets were added to the shopping card.</p>
        <p>(stored in session)</p>
        <button type="button" onclick='saveSeats(<?php echo json_encode($_SESSION); ?>)'>
            UPDATE DB(will happen automatically when payed)
        </button>
    </body>
</html>
