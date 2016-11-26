<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h1>Forgot password</h1>

    <form id="forgotten_form" name="forgotten_form" action="send_email.php" method="POST">
        <label>We will send you a link to reset password to your email.</label>
        <input type="email" name="email" placeholder="Email" title="Must be a valid email address." email/>
        <button type="submit" id="submit" name="submit">Submit</button>
    </form>
</body>
</html>
