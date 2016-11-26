<?php
function showLoginReg() {
    echo "<li><a class='page-scroll' href='login.php'>Log In</a></li>";
    echo "<li><a class='page-scroll' href='registration.php'>Register</a></li>";
}

function showLogged() {
    $name = $_SESSION['fullname'];
    if ($_SESSION['fullname'] == "")
        $name = $_SESSION['username'];

    echo "<li><a class='page-scroll' href='edit_user.php'>" . $name . "</a></li>";

    if (isset($_SESSION['orders_array']) && $_SESSION['orders_array'] != '') {
        $count = count($_SESSION['orders_array']);
        echo "<li><a class='page-scroll' href='cart.php'>Shopping Cart (" . $count . ")</a></li>";
    }

    echo "<li><a class='page-scroll' href='logout.php'>Logout</a></li>";
}
