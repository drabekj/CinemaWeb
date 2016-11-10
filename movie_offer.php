<?php
    include "configDB.php";
?>
<html>
    <head>
        <title>Movies on right now</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="movie_offer_styles.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src='sortScript.js' type='text/javascript'></script>
    </head>
    <body>
        <h1>Movie offer</h1>
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
                </ul>
            </div>
            <ul id="products">
                <input type='hidden' id='sort' value='asc'>
                <?php
                    $query = "SELECT * FROM Movie";
                    $post_arr = array();
                    $post_arr = $db->query($query);

                    while ($row = $post_arr->fetch_assoc()) {
                        $image =       $row['img'];
                        $name =        $row['name'];
                        $price =       $row['price'];
                        $duration =    $row['duration'];
                        $category =    $row['category'];
                        $description = $row['description'];
                ?>
                        <li class="li_product_box">
                            <div class='product_box'>
                                <img src="img/<?php echo $image; ?>">
                                <h2><?php echo $name; ?></h2>
                                <div class='movie_summ_box'><div class='movie_summ_content'>
                                    <?php echo $price; ?> $HKD
                                    <span class='movie_category'>(<?php echo $category; ?>)</span><br>
                                    <?php echo $duration; ?> min
                                </div></div>
                                <div class='movie_desc'><p><?php echo $description ?></p></div>
                        </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </body>
</html>
