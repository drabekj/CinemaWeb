<?php
    $server = "mysql.comp.polyu.edu.hk";
    $user = "16019015x";
    $DBpassword = "xwpksecu";
    $database="16019015x"; //sameasaccount

    $db = new mysqli($server, $user, $DBpassword, $database);
    if($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
