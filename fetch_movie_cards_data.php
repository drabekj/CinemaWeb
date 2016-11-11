<?php
    include "configDB.php";

    $colName = $_POST['columnName'];
    $catName = $_POST['categoryName'];
    $filterQuery = $_POST['searchQuery'];
    $sort = $_POST['sort'];

    $addNameFilter = "name LIKE '%" . $filterQuery . "%' ";
    if ($colName == 'category') {
        $select_query = "SELECT * FROM Movie WHERE category='" . $catName . "' AND " . $addNameFilter;
    }
    else {
        $select_query = "SELECT * FROM Movie WHERE " . $addNameFilter . " order by " . $colName . " " . $sort;
    }
    // file_put_contents('php://stderr', print_r($select_query, TRUE));

    $result = array();
    $result = $db->query($select_query);

    $html = '';
    while($row = $result->fetch_assoc()){
        $id =          $row['id'];
        $image =       $row['img'];
        $name =        $row['name'];
        $price =       $row['price'];
        $duration =    $row['duration'];
        $category =    $row['category'];
        $description = $row['description'];

        // generate new html code with content
        $html .=
        "<li>
            <a href='movie_detail.php?id=" . $id . "'>
            <div class='product_box'>
                <img src=\"img/" . $image . "\">
                <h2>" . $name . "</h2>
                <div class='movie_summ_box'><div class='movie_summ_content'>"
                    . $price . " \$HKD
                    <span class='movie_category'>(" . $category . ")</span><br>"
                    . $duration . " min
                </div></div>
                <div class='movie_desc'><p>" . $description . "</p></div>
            </div>
            </a>
        </li>";
    }

    echo $html;
