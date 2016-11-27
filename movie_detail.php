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
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/creative.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/movie_detail_style.css">
        <link rel="stylesheet" type="text/css" href="css/movie_offer_style.css">
    </head>
    <body>
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="index.php">
                        <img id="nav_logo" src="icon/logo_icon_small.png" />
                        ABC Cinema
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="movie_offer.php">Movie Offer</a>
                        </li>
                        <?php
                            include 'renderFunc.php';

                            if (isset($_SESSION['username'])) {
                                showLogged();
                            }
                            else {
                                showLoginReg();
                            }
                        ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

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
                        $select_query = "SELECT * FROM Movie INNER JOIN Screening ON Movie.id=Screening.movie_id WHERE Movie.id=$id";
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
