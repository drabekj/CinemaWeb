function saveSeats(session){
    // replace selected by saved in array (2s by 1s)
    for(var i = 0; i < session.seat_array.length; i++) {
        for(var j = 0; j < session.seat_array[i].length - 1; j++) {
            if (session.seat_array[i][j] == 2)
                session.seat_array[i][j] = 1;
        }
    }

    // send request to update DB
    var screening_id = session.screening_id;
    var seat_array = session.seat_array;
    $.ajax({
           type: "post",
           url: "saveSeatsDB.php",
           data:{screening_id:screening_id,seat_array:seat_array},
           success: function(data){
                alert("Seats bought!");
           }
    });
}
