<?php
session_start();
?>
<html><head><style>
h1 {color:red}

form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}

</style></head>
<body>
<?php
$username = @$_POST['username'];
$password = @$_POST['password'];
$fullname = @$_POST['fullname'];
$email = @$_POST['email'];
$phonenumber = @$_POST['phonenumber'];

function insertRecord($username, $password, $fullname, $email, $phonenumber) {
$conn = mysql_connect("mysql.comp.polyu.edu.hk", "16019015x", "xwpksecu");
mysql_selectdb("16019015x", $conn);
$query = "insert into User values ('"
. $username. "', '" . $password . "', '"
. $fullname . "', '" . $email . "','" .$phonenumber ."')";
mysql_query($query, $conn);
if (mysql_error() != "") {
			echo "<h1>". mysql_error() ."</h1>";
echo "<input type=\"button\" "
. " onclick=\"javascript: history.go(-1)\" value=\"Back\"/>";
} else {
    $_SESSION['conn'] = $conn;
    $_SESSION['username'] = $username;
    $_SESSION['fullname'] = $fullname;
    header('Location: index.php');
}
mysql_close($conn);
}
if (isset($username) && trim($username) != "") {
insertRecord(trim($username), trim($password),
trim($fullname), trim($email),trim($phonenumber));
} else {
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<h1>System Register</h1>
<div class="container"><label><b>Username</b></label>
<input type="text" name="username" placeholder="Username"required/>
<label><b>Password</b></label>
<input type="password" name="password" placeholder="Enter Password" required/>
 <div class="container"><label><b>Fullname</b></label>
<input type="text" name="fullname" placeholder="Fullname"required/>
<div class="container"><label><b>Email</b></label>
<input type="text" name="email" placeholder="Email"required/>
<div class="container"><label><b>Phonenumber</b></label>
<input type="text" name="phonenumber" placeholder="PhoneNumber"required/>
 <button type="submit">Sign Up</button>
</form>
<?php
}
?>
</body></html>
