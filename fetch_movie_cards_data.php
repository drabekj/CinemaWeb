<?php
    include "configDB.php";

    $colName = $_POST['columnName'];
    $catName = $_POST['categoryName'];
    $sort = $_POST['sort'];

    if ($colName != 'category') {
        $select_query = "SELECT * FROM Movie order by " . $colName . " " . $sort . " ";
    }
    else {
        $select_query = "SELECT * FROM Movie WHERE category='" . $catName . "' ";
    }

    $result = array();
    $result = $db->query($select_query);

    $html = '';
    while($row = $result->fetch_assoc()){
        $image =       $row['img'];
        $name =        $row['name'];
        $price =       $row['price'];
        $duration =    $row['duration'];
        $category =    $row['category'];
        $description = $row['description'];

        // generate new html code with content
        $html .=
        "<li>
            <div class='product_box'>
                <img src=\"img/" . $image . "\">
                <h2>" . $name . "</h2>
                <div class='movie_summ_box'><div class='movie_summ_content'>"
                    . $price . " \$HKD
                    <span class='movie_category'>(" . $category . ")</span><br>"
                    . $duration . " min
                </div></div>
                <div class='movie_desc'><p>" . $description . "</p></div>
        </li>";
    }

    echo $html;
