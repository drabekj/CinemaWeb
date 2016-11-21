<?php
    session_start();
    include "configDB.php";

    $select_query = "SELECT * FROM Movie WHERE id=" . $_GET['id'];
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
    </head>
    <body>
        <?php
            if (isset($_SESSION['orders_array']) && $_SESSION['orders_array'] != '') {
                echo "<h1>You have " . count($_SESSION['orders_array']) . " orders in your shopping cart.</h1>";
                echo "<a href='clearShoppingCart.php?clearCart=true'><button class='clearShoppingCart'>Clear shopping cart</button></a>";
            }
        ?>

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
                    <h3>Screening times</h3>
                    <hr>
                    <ul>
                    <?php
                        // screeing data
                        $select_query = "SELECT * FROM Movie
                                        INNER JOIN Screening ON Movie.id=Screening.movie_id
                                        WHERE Movie.id=$id";
                        unset($result);
                        $result = array();
                        $result = $db->query($select_query);
                        $movie_id = $id;

                        while($row = $result->fetch_assoc()) {
                            $time = $row['screening_start'];
                            $id   = $row['id'];
                     ?>
                            <li><a href="select_seat.php?id=<?php echo $id . "&movie_id=" . $movie_id; ?>">
                                <button type="button">
                                    <?php echo date("d.m. (l) h:ia", strtotime($time)); ?>
                                </button>
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
