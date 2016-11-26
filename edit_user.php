<?php session_start(); ?>

<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="css/creative.css">
	<link rel="stylesheet" type="text/css" href="css/registration.css">
</head>
<body>
<?php
function printEditForm($name) {
?>
	<div id="profile">
		<h1>Personal Data</h1>
		<hr noshade>
		<div id="data">
			<h3>Your username: <span class="datas"><?php echo ($_SESSION['username']); ?></span></h3>
			<h3>Your fullname: <span class="datas"<?php echo ($_SESSION['fullname']); ?></span></h3>
		</div>
		<hr noshade>
	</div>

	<form id="update_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<input type="text" name="fullname" placeholder="Change Fullname"/>
		<input type="password" name="password" placeholder="Change Password" />
		<input type="text" name="email" placeholder="Change Email"/>
		<input type="text" name="phonenumber" placeholder="Change PhoneNumber"/>
 		<button type="submit" class="btn btn-primary btn-xl">Update</button>
	</form>

<?php
}

if (!isset($_SESSION['username'])) {
	echo "<h1>You have not logged in yet</h1>";
	echo "<a href=\"login.php\">Login</a>";
	die();
}

if (isset($_POST['submit'])) {
	$username = $_SESSION['username'];
	$_SESSION['fullname'] = $fullname = $_POST['fullname'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$phonenumber = $_POST['phonenumber'];

	// Add your code here to complete this PHP page
	$conn = mysql_connect("mysql.comp.polyu.edu.hk", "16019015x", "xwpksecu");
	if (!$conn) {
		echo "<h1>Couldn't connect to the database. "
		. "Please try again later.</h1>";
		die();
	}
	mysql_selectdb("16019015x", $conn);
	$query = sprintf("UPDATE users SET fullname = '%s', password = '%s', email = '%s', phonenumber = '%s' WHERE username = '%s'",
	mysql_real_escape_string($fullname),
	mysql_real_escape_string($password),
	mysql_real_escape_string($email),
	mysql_real_escape_string($phonenumber),
	mysql_real_escape_string($username));
	mysql_query($query, $conn);

	if (mysql_errno()) {
		echo "<h1>Fails to update personal information. "
		. "Please try again later.</h1>";
		echo "<a href=\"login.php\">Back</a>";
	} else {
		echo "<h1>Personal info updated successfully</h1>";
		echo "<a href=\"login.php\">Back</a>";
	}
	mysql_close($conn);
} else {
	printEditForm($_SESSION['fullname']);
}
?>
</body>
</html>
