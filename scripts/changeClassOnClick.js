function validateSmartSelection() {
    for(var i = 0; i < seat_array.length; i++) {
        for(var j = 0; j < seat_array[i].length - 1; j++) {
            // creates isolated seat on the beginning
            if (j == 1 && seat_array[i][j] == 2 && seat_array[i][j-1] == 0) {
                console.log("beginning");
                return false;
            }
            // creates isolated seat on the end
            if (j == seat_array[i].length - 2 && seat_array[i][j] == 2 && seat_array[i][j+1] == 0) {
                console.log("end");
                return false;
            }
            // creates isolated seat middle from left
            if (j < seat_array[i].length - 2 && seat_array[i][j] == 2 && seat_array[i][j+1] == 0 && seat_array[i][j+2] != 0) {
                console.log("middle left");
                return false;
            }
            // creates isolated seat middle from right
            if (j > 1 && seat_array[i][j] == 2 && seat_array[i][j-1] == 0 && seat_array[i][j-2] != 0) {
                console.log("middle right");
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

    if(!validateSmartSelection()) {
        alert("Sorry, please do not create isloated seats.");
        seat_array[x][y] = originalState;
        return;
    }

    $(context)
    .toggleClass('seat_btn_selected')
    .toggleClass('seat_btn_free');

    // alert(seat_array.join('\n'));


};
