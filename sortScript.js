function sortTable(columnName){

    var sort = $("#sort").val();
    $.ajax({
        url:'fetch_movie_cards_data.php',
        type:'post',
        data:{columnName:columnName,sort:sort},
        success: function(response){
            $("#products li").remove();
            $("#products").append(response);

            if(sort == "asc"){
                $("#sort").val("desc");
            }else{
                $("#sort").val("asc");
            }
        },
    });
}
