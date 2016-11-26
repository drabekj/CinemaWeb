<?php
	session_start();

	function printEditForm($name) {
?>
<style>
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
</style>

	<h1>Personal Info Update</h1>
	<h3>Your username: <?php echo ($_SESSION['username']); ?></h3>
	<h3>Your fullname: <?php echo ($_SESSION['fullname']); ?></h3>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
 <div class="container"><label><b>Fullname</b></label>
<input type="text" name="fullname" placeholder="Change Fullname"/>
<label><b>Password</b></label>
<input type="password" name="password" placeholder="Change Password" />
<div class="container"><label><b>Email</b></label>
<input type="text" name="email" placeholder="Change Email"/>
<div class="container"><label><b>Phonenumber</b></label>
<input type="text" name="phonenumber" placeholder="Change PhoneNumber"/>
 <button type="submit">Submit</button>
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