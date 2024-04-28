<?php
session_start();
include("../controllers/general_controller.php");

// Check if user is authenticated
if(isset($_SESSION['user_id'])) {
    // User is authenticated, retrieve user_id from session
    $user_id = $_SESSION['user_id'];

    // Check if the product ID is provided and valid
    if(isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        // Remove the product from the user's cart
        $result = removeProductFromCart_ctr($user_id, $product_id);

        if($result) {
            // Product successfully removed from cart
            echo "success";
        } else {
            // Error occurred while removing product
            echo "error";
        }
    } else {
        // Invalid product ID provided
        echo "invalid";
    }
} else {
    // User is not authenticated
    echo "unauthorized";
}
?>
