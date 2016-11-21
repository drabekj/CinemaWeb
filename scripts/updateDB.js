// Saves all selected seats in session to DB.
// Called after payment.
function saveSeats(session){
    // send request to update DB
    $.ajax({
           type: "post",
           url: "saveSeatsDB.php",
           success: function(data){
                alert("Seats bought, thank you for your purchase.");
                window.location = "movie_offer.php";
           }
    });
}
