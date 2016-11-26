<?php 
session_start(); 
if (isset($_SESSION['username'])) { 
echo "<h1>Good bye, " . $_SESSION['fullname'] . "</h1>"; 
echo "<a href=\"login.php\">Login</a>"; 
unset($_SESSION['username']); 
unset($_SESSION['fullname']); 
} else { 
echo "<h1>You have not logged in yet</h1>"; 
echo "<a href=\"login.php\">Login</a>"; 
} 
?> 