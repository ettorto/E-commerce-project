<?php
// Start session
session_start();

// For header redirection
ob_start();

// Function to check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Function to get user ID
function get_user_id() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

// Function to check if user has a specific role
function has_role($role) {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] == $role;
}

// Function to check if user is an admin
function is_admin() {
    return has_role(0); // Assuming admin role is 0
}

?>
