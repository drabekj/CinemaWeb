<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
    <title>Login</title>
    <link href="css/login.css" rel="stylesheet">
    <link href="css/creative.css" rel="stylesheet">
    <link href="css/registration.css" rel="stylesheet">
</head>
<body>
<?php
function printLoginForm() {
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"  onsubmit="return checkform(this);">
<h1>System Login</h1>
<div class="container"><label><b>Username</b></label>
<input type="text" name="username" placeholder="Username"required/><br/>
<label><b>Password</b></label>
<input type="password" name="password" placeholder="Enter Password" required/><br/>
<!-- START CAPTCHA -->
<br>
<div class="capbox">

<div id="CaptchaDiv"></div>

<div class="capbox-inner">
Type the above number:<br>

<input type="hidden" id="txtCaptcha">
<input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>

</div>
</div>
<br><br>
<!-- END CAPTCHA -->
  <button type="submit" class="btn btn-primary btn-xl">Login</button>
</div>
</form>
<script type="text/javascript">

// Captcha Script

function checkform(theform){
var why = "";

if(theform.CaptchaInput.value == ""){
why += "- Please Enter CAPTCHA Code.\n";
}
if(theform.CaptchaInput.value != ""){
if(ValidCaptcha(theform.CaptchaInput.value) == false){
why += "- The CAPTCHA Code Does Not Match.\n";
}
}
if(why != ""){
alert(why);
return false;
}
}

var a = Math.ceil(Math.random() * 9)+ '';
var b = Math.ceil(Math.random() * 9)+ '';
var c = Math.ceil(Math.random() * 9)+ '';
var d = Math.ceil(Math.random() * 9)+ '';
var e = Math.ceil(Math.random() * 9)+ '';

var code = a + b + c + d + e;
document.getElementById("txtCaptcha").value = code;
document.getElementById("CaptchaDiv").innerHTML = code;

// Validate input against the generated number
function ValidCaptcha(){
var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
if (str1 == str2){
return true;
}else{
return false;
}
}

// Remove the spaces from the entered and generated code
function removeSpaces(string){
return string.split(' ').join('');
}
</script>
<?php
}
function printWelcomeScreen($name) {
    echo "<h1>Welcome, $name</h1>";
    echo "<a href=\"edit_user.php\">Edit/View Personal Information</a><br/>";
    echo "<a href=\"logout.php\">Logout</a>";
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $fullname = $_SESSION['fullname'];
    header('Location: index.php');
    die();
}
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    printLoginForm();
    die();
}
$username = $_POST['username'];
$password = sha1($_POST['password']);
echo "Password: " . $password;

include 'configDB.php';
$query = "SELECT * FROM User WHERE username='$username' AND password='$password'";
$result = array();
$result = $db->query($query);
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    $_SESSION['username']    = $row['username'];
    $_SESSION['fullname']    = $row['fullname'];
    $_SESSION['email']       = $row['email'];
    $_SESSION['phonenumber'] = $row['phonenumber'];
    $db->close();
    header('Location: index.php');
} else {
    printLoginForm();
}
$db->close();
?>
</body>
</html>
