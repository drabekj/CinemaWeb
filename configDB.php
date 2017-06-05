<?php
    $server = "";
    $user = "";
    $DBpassword = "";
    $database=""; //sameasaccount

    $db = new mysqli($server, $user, $DBpassword, $database);
    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
