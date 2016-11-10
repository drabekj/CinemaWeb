$(document).ready(function(){
    $('#filter_search').keypress(function(e){
        if(e.keyCode==13) {
          $('#search_btn').click();
          console.log("FUCK");
        }
    });
});
