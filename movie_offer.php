<?php
    // $server = "mysql.comp.polyu.edu.hk/16019015x";
    $server = "mysql.comp.polyu.edu.hk";
    $user = "16019015x";
    $password = "xwpksecu";
    $database="16019015x"; //sameasaccount

    $db = new mysqli($server, $user, $password, $database);
    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }


    $query = "SELECT * FROM Movie";
    $post_arr = array();
    $post_arr = $db->query($query);
?>
<html>
    <head>
        <title>Movies on right now</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="movie_offer_styles.css">
    </head>
    <body>
        <h1>Movie offer</h1>
        <div id="wrapper">
            <div
            <ul class="products">
                <?php
                    while ($row = $post_arr->fetch_assoc()) {
                        echo "<li><div class='product_box'>";
                            echo "<img src='img/" . $row["img"] . "'>";
                            echo "<h2>" . $row["name"] . "</h2>";
                            echo "<div class='movie_summ_box'><div class='movie_summ_content'>"
                                    . $row["price"] . " \$HKD" . "<span class='movie_category'>("
                                    . $row["category"] . ")</span><br>"
                                    . $row["duration"] . " min"
                                . "</div></div>";
                            echo "<div class='movie_desc'><p>"
                                    . $row["description"]
                                . "</div</p>";
                        echo "</div></li>";
                    }

                ?>
            </ul>
        </div>
    </body>
</html>
