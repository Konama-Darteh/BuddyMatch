<?php
// Start session
session_start();

// Function to check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']) && isset($_SESSION['email']);
}

// Redirect user to login page if not logged in
function redirect_if_not_logged_in() {
    if (!is_logged_in()) {
        header("Location: ../view/login.php"); // Redirect to your login page
        exit();
    }
}
?>
