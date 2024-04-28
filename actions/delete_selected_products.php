<?php
// Include your general controller file
include("../controllers/general_controller.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the JSON data sent from the client
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if the 'products' key exists in the received data
    if (isset($data['products']) && is_array($data['products'])) {
        // Loop through the received product IDs and delete each product
        foreach ($data['products'] as $productId) {
            // Call the function to delete the product
            deleteProduct_ctr($productId);
        }

        // Return a success response
        http_response_code(200);
        echo json_encode(array("message" => "Selected products deleted successfully."));
    } else {
        // Return an error response if 'products' key is missing or not an array
        http_response_code(400);
        echo json_encode(array("message" => "Invalid request data."));
    }
} else {
    // Return an error response if the request method is not POST
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
