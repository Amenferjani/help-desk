<?php include 'login.php'; ?>
<?php
session_start();

// Clear all session variables and destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: login.html");

exit;
?>
