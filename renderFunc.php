<?php
function showLoginReg() {
    echo "<li><a class='page-scroll' href='login.php'>Log In</a></li>";
    echo "<li><a class='page-scroll' href='registration.php'>Register</a></li>";
}

function showLogged() {
    echo "<li><a class='page-scroll' href='edit_user.php'>" . $_SESSION['fullname'] . "</a></li>";

    if (isset($_SESSION['orders_array']) && $_SESSION['orders_array'] != '') {
        $count = count($_SESSION['orders_array']);
        echo "<li><a class='page-scroll' href='cart.php'>Shopping Cart (" . $count . ")</a></li>";
    }

    echo "<li><a class='page-scroll' href='logout.php'>Logout</a></li>";
}
