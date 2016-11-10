<?php
    include "configDB.php";
?>
<html>
    <head>
        <title>Movies on right now</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="movie_offer_styles.css">
    </head>
    <body>
        <h1>Movie offer</h1>
        <div id="movie_offer_wrapper">
            <div id="filter_bar">
                <ul>
                  <button type="button"><li>Name</li></button>
                  <button type="button"><li>Price</li></button>
                  <button type="button"><li>Filter3</li></button>
                  <button type="button"><li>Filter4</li></button>
                </ul>
            </div>
            <ul class="products">
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
                        <li>
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
