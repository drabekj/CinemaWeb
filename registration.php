<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <title>Registration</title>
    <link href="css/creative.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/registration.css">
</head>
<body>
<?php
$username = @$_POST['username'];
$password = @$_POST['password'];
$fullname = @$_POST['fullname'];
$email = @$_POST['email'];
$phonenumber = @$_POST['phonenumber'];

function insertRecord($username, $password, $fullname, $email, $phonenumber) {
    include "configDB.php";
    $query = "insert into User values ('"
        . $username. "', '" . sha1($password) . "', '"
        . $fullname . "', '" . $email . "','" .$phonenumber ."')";

    if ($db->query($query) !== TRUE) {
        echo "Error updating record: " . $db->error;
    }
    else {
        $_SESSION['username']    = $username;
        $_SESSION['fullname']    = $fullname;
        $_SESSION['email']       = $email;
        $_SESSION['phonenumber'] = $phonenumber;
        $db->close();
        header('Location: index.php');
    }
    $db->close();
}

if (isset($username) && trim($username) != "") {
    insertRecord(trim($username), trim($password),
    trim($fullname), trim($email),trim($phonenumber));
}
else {
?>
    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h1>Registration</h1>
        <hr noshade>
        <div class="container">
            <input type="text" name="username" placeholder="Username" title="At least 3 characters long." pattern=".{3,}" required/>
        </div>
        <div class="container">
            <input type="password" name="password" placeholder="Enter Password" title="At least 6 characters long." pattern=".{6,}" required/>
        </div>
        <div class="container">
            <input type="text" name="fullname" placeholder="Fullname" title="At least 3 characters long." pattern=".{3,}" required/>
        </div>
        <div class="container">
            <input type="email" name="email" placeholder="Email" title="Must be a valid email address." email required/>
        </div>
        <div class="container">
            <input type="number" name="phonenumber" placeholder="PhoneNumber" title="Valid phone number at least 6 characters long." pattern=".{6,}" tel required/>
        </div>
        <button type="submit" class="btn btn-primary btn-xl">Sign Up</button>
    </form>
<?php
}
?>
</body>
</html>
