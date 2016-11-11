<?php
    session_start();
    include "configDB.php";
?>
<html>
    <head>
        <title>Movies on right now</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/movie_offer_style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src='scripts/sortScript.js' type='text/javascript'></script>
    </head>
    <body>
        <script src="scripts/clickEnter.js"></script>
        <div id="movie_offer_wrapper">
            <div id="filter_bar">
                <ul>
                  <li onclick='sortTable("name", "");'>Name</li>
                  <li onclick='sortTable("price", "");'>Price</li>
                  <li onclick='sortTable("duration", "");'>Duration</li>
                  <li class="dropdown">Category
                    <div class="dropdown-content">
                      <a onclick='sortTable("category", "action");'>Action</a>
                      <a onclick='sortTable("category", "comedy");'>Comedy</a>
                      <a onclick='sortTable("category", "documentary");'>Documentary</a>
                    </div>
                  </li>
                  <li>
                          <input type="text" id="filter_search" list="movies" placeholder="Search" name="filter_search">
                          <datalist id="movies">
                            <?php
                            // whisper movie names hint
                                $select_query = "SELECT name FROM Movie";
                                $result = array();
                                $result = $db->query($select_query);

                                $namesArray = array();
                                while($row = $result->fetch_assoc()){
                                    echo "<option value='" . $row['name'] . "'>";
                                }
                            ?>
                          </datalist>
                          <!-- <input id="search_btn" type="button" onclick='sortTable("name", "");'>S</input> -->
                          <a id="search_btn" onclick='sortTable("name", "");'><img src="icon/search_icon.png" style="width:15px;height:15px;"></a>
                  </li>
                </ul>
            </div>
            <ul id="products">
                <input type='hidden' id='sort' value='asc'>
                <?php
                    $query = "SELECT * FROM Movie";
                    $post_arr = array();
                    $post_arr = $db->query($query);

                    while ($row = $post_arr->fetch_assoc()) {
                        $id =          $row['id'];
                        $image =       $row['img'];
                        $name =        $row['name'];
                        $price =       $row['price'];
                        $duration =    $row['duration'];
                        $category =    $row['category'];
                        $description = $row['description'];
                ?>
                        <li class="li_product_box">
                            <a href="movie_detail.php?id=<?php echo $id; ?>">
                            <div class='product_box'>
                                <img src="img/<?php echo $image; ?>">
                                <h2><?php echo $name; ?></h2>
                                <div class='movie_summ_box'><div class='movie_summ_content'>
                                    <?php echo $price; ?> $HKD
                                    <span class='movie_category'>(<?php echo $category; ?>)</span><br>
                                    <?php echo $duration; ?> min
                                </div></div>
                                <div class='movie_desc'><p><?php echo $description ?></p></div>
                            </div>
                            </a>
                        </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </body>
</html>
