function validateSmartSelection() {
    for(var i = 0; i < seat_array.length; i++) {
        for(var j = 0; j < seat_array[i].length - 1; j++) {
            // creates isolated seat on the beginning
            if (j == 1 && seat_array[i][j] == 2 && seat_array[i][j-1] == 0) {
                console.log("error: isolated seat at beginning");
                return false;
            }
            // creates isolated seat on the end
            if (j == seat_array[i].length - 2 && seat_array[i][j] == 2 && seat_array[i][j+1] == 0) {
                console.log("error: isolated seat at end");
                return false;
            }
            // creates isolated seat middle from left
            if (j < seat_array[i].length - 2 && seat_array[i][j] == 2 && seat_array[i][j+1] == 0 && seat_array[i][j+2] != 0) {
                console.log("error: isolated seat at middle left");
                return false;
            }
            // creates isolated seat middle from right
            if (j > 1 && seat_array[i][j] == 2 && seat_array[i][j-1] == 0 && seat_array[i][j-2] != 0) {
                console.log("error: isolated seat at middle right");
                return false;
            }
        }
    }

    return true;
};

function toggleSeat(x, y, context) {
    console.log("[" + x + "," + y + "]");

    if($(context).hasClass('seat_btn_occupied')) {
        alert("We are sorry, but this seat is taken.");
        return;
    }

    // update binary array (2 stands for selected)
    var originalState = seat_array[x][y];
    if($(context).hasClass('seat_btn_free'))
        seat_array[x][y] = 2;
    else {
        seat_array[x][y] = 0;
    }

    $(context)
    .toggleClass('seat_btn_selected')
    .toggleClass('seat_btn_free');

    // alert(seat_array.join('\n'));


};

function bookSeats() {
    if(!validateSmartSelection()) {
        alert("Sorry, please do not create isloated seats.");
        // seat_array[x][y] = originalState;
        return false;
    }

    // count selected seats
    var countSeats = countSelected();
    console.log("Booking " + countSelected() + " seats...");
    console.log("Movie name: " + movie_name);

    // redirect to checkout page + pass data
    $('<form />')
      .hide()
      .attr({ method : "post" })
      .attr({ action : "checkout.php"})
      .append($('<input />')
        .attr("type","hidden")
        .attr({ "name" : "seat_array" })
        .val(JSON.stringify(seat_array))
      )
      .append($('<input />')
        .attr("type","hidden")
        .attr({ "name" : "screening_id" })
        .val(screening_id)
      )
      .append($('<input />')
        .attr("type","hidden")
        .attr({ "name" : "seatCount" })
        .val(countSeats)
      )
      .append($('<input />')
        .attr("type","hidden")
        .attr({ "name" : "movie_name" })
        .val(movie_name)
      )
      .append('<input type="submit" />')
      .appendTo($("body"))
      .submit();
};

// live update total price
$(document).ready(function(){
    $('.seat_btn').click(function(){
        $(".totalPrice").text(countSelected() * seat_price);
        $(".totalCount").text(countSelected());
    });
});

function countSelected(){
    var count = 0;
    for(var i = 0; i < seat_array.length; i++) {
        for(var j = 0; j < seat_array[i].length; j++) {
            if (seat_array[i][j] == 2)
                count++;
        }
    }

    return count;
};
