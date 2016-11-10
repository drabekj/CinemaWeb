function sortTable(columnName, categoryName) {
    var searchQuery = $("#filter_search").val();
    var sort = $("#sort").val();
    console.log("run sortTable(" + columnName + ", " + categoryName + ") search:" + searchQuery);

    $.ajax({
        url:'fetch_movie_cards_data.php',
        type:'post',
        data:{columnName:columnName,sort:sort,categoryName:categoryName, searchQuery:searchQuery},
        success: function(response){
            $("#products li").remove();
            $("#products").append(response);

            if (columnName != "category") {
                if(sort == "asc"){
                    $("#sort").val("desc");
                }else{
                    $("#sort").val("asc");
                }
            }
        }
    });
}
