<?php
// Check if the session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if the function isLoggedIn() is not already declared
if (!function_exists('isLoggedIn')) {
    // Function to check if the user is logged in
    function isLoggedIn() {
        return isset($_SESSION['username']) && !empty($_SESSION['username']);
    }
}
// Logout logic
if (isset($_GET['logout'])) {
    // Clear all session data
    session_unset();
    session_destroy();
    // Redirect to home page or login page
    header("Location: index.php");
    exit();
}
?>
