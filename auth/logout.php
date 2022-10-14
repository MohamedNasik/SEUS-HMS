
<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
// $_SESSION = array();
 
// Destroy the session.
// session_destroy();
 
// Destroy the session.
unset($_SESSION['user_id']);
unset($_SESSION['usernames']);
unset($_SESSION['role_id']);



// Redirect to login page
header("location: ..\login.php");
exit;
?>