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
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = $fullname;
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
            <input type="text" name="username" placeholder="Username" required/>
        </div>
        <div class="container">
            <input type="password" name="password" placeholder="Enter Password" required/>
        </div>
        <div class="container">
            <input type="text" name="fullname" placeholder="Fullname"required/>
        </div>
        <div class="container">
            <input type="text" name="email" placeholder="Email"required/>
        </div>
        <div class="container">
            <input type="text" name="phonenumber" placeholder="PhoneNumber"required/>
        </div>
        <button type="submit" class="btn btn-primary btn-xl">Sign Up</button>
    </form>
<?php
}
?>
</body>
</html>
