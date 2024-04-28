<?php
// Start session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../view/login.php");
    exit(); // Stop further execution
}

// Check if the product details are received via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your general controller file
    include("../controllers/general_controller.php");

    // Retrieve product details from POST data
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    // $ip_address=''

    // Call the add to cart function from general controller
    addProductToCart_ctr($product_id, $quantity);
} else {
    // If the request method is not POST, redirect the user to the homepage
    header("Location: ../index.php");
    exit();
}
?>
