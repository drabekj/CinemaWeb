<?php session_start(); ?>

<html>
<head>
	<title>Profile</title>
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/creative.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/registration.css">
</head>
<body>
	<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand page-scroll" href="index.php">
					<img id="nav_logo" src="/icon/logo_icon_small.png" />
					ABC Cinema
				</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a class="page-scroll" href="movie_offer.php">Movie Offer</a>
					</li>
					<?php
						include 'renderFunc.php';

						if (isset($_SESSION['username'])) {
							showLogged();
						}
						else {
							showLoginReg();
						}
					?>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>

<?php
function printEditForm($name) {
?>
	<div id="profile">
		<h1>Personal Data</h1>
		<hr noshade>
		<div id="data">
			<h3>Your username: <span class="datas"><?php echo ($_SESSION['username']); ?></span></h3>
			<h3>Your fullname: <span class="datas"><?php echo ($_SESSION['fullname']); ?></span></h3>
			<h3>Your email: <span class="datas"><?php echo ($_SESSION['email']); ?></span></h3>
			<h3>Your phone number: <span class="datas"><?php echo ($_SESSION['phonenumber']); ?></span></h3>
		</div>
		<hr noshade>
	</div>

	<form id="update_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<input type="text" name="fullname" placeholder="Change Fullname"/>
		<input type="password" name="password" placeholder="Change Password" />
		<input type="text" name="email" placeholder="Change Email"/>
		<input type="text" name="phonenumber" placeholder="Change PhoneNumber"/>
 		<button type="submit" class="btn btn-primary btn-xl" name="submit">Update</button>
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
	$password = $_POST['password'];
	$_SESSION['fullname'] = $fullname = $_POST['fullname'];
	$_SESSION['email'] = $email = $_POST['email'];
	$_SESSION['phonenumber'] = $phonenumber = $_POST['phonenumber'];

	// Add your code here to complete this PHP page
	include "configDB.php";

	$update_query = sprintf("UPDATE User SET fullname = '%s', password = '%s', email = '%s', phonenumber = '%s' WHERE username = '%s'",
	$fullname,
	$password,
	$email,
	$phonenumber,
	$username);

	if ($db->query($update_query) === TRUE) {
    	echo "Record updated successfully";
	} else {
	    echo "Error updating record: " . $db->error;
	}
	$db->close();
} else {
	printEditForm($_SESSION['fullname']);
}
?>
</body>
</html>
