<?php
    include "configDB.php";

    $select_query = "SELECT * FROM Movie WHERE id=" . $_GET['id'];
    file_put_contents('php://stderr', print_r($select_query, TRUE));
    $result = array();
    $result = $db->query($select_query);

    $row = $result->fetch_assoc();
    $id =       $row['id'];
    $image =       $row['img'];
    $name =        $row['name'];
    $price =       $row['price'];
    $duration =    $row['duration'];
    $category =    $row['category'];
    $description = $row['description'];
 ?>

<html>
    <head>
        <title><?php echo $name . " - movie detail"; ?></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/movie_detail_style.css">
        <link rel="stylesheet" type="text/css" href="css/movie_offer_style.css">
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
    </head>
    <body>
        <div id="detail_wrapper">
            <div class="product_box">
                <img src="img/<?php echo $image; ?>">
                <h2><?php echo $name; ?></h2>
                <div class="movie_summ_box"><div class="movie_summ_content">
                    <?php echo $price; ?> $HKD
                    <span class="movie_category">(<?php echo $category; ?>)</span><br>
                    <?php echo $duration; ?> min
                </div></div>
                <div class="movie_desc"><p><?php echo $description ?></p></div>
            </div>
            <div class="product_details">
                <div id="screening_details">
                    <ul>
                    <?php
                        // screeing data
                        $select_query = "SELECT * FROM Movie
                                        INNER JOIN Screening ON Movie.id=Screening.movie_id";
                        unset($result);
                        $result = array();
                        $result = $db->query($select_query);

                        while($row = $result->fetch_assoc()) {
                            $time = $row['screening_start'];
                            $id   = $row['id'];
                     ?>
                            <li><a href="select_seat.php?id=<?php echo $id . "&movie=" . $name; ?>">
                                <?php echo date("d.m. (l) h:ia", strtotime($time)); ?>
                            </a></li>
                     <?php
                        }
                      ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>
