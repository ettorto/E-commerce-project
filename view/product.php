<?php
// Start the session
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 0) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit; // Stop further execution of the script
}


// Include your general class file
include("../controllers/general_controller.php");

$category = viewCategory_ctr();
$brand = viewBrand_ctr();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        /* Sidebar styles */
        .sidebar {
            width: 250px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
            color: #fff;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            padding: 10px;
        }
        .sidebar li a {
            color: #fff;
            text-decoration: none;
        }
        .sidebar li a:hover {
            text-decoration: underline;
        }
         /* Main content styles */
         .main-content {
            margin-left: 250px; /* Adjusted for sidebar width */
            padding: 20px;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="file"] {
            margin-top: 10px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="sidebar">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="product.php">Products</a></li>
            <li><a href="category.php">Category</a></li>
            <li><a href="brand.php">Brand</a></li>
            <li><a href="../index.php">Customer View</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
    <div class="container">
        <h1>Add Product</h1>
        <form action="../actions/add_product.php" method="post" enctype="multipart/form-data">
            <label for="productCategory">Product Category:</label>
            <select id="productCategory" name="productCategory" required>
                <?php
                // Loop through categories array to generate options dynamically
                foreach ($category as $cat) {
                    echo "<option value='{$cat["cat_id"]}'>{$cat["cat_name"]}</option>";
                }
                ?>
            </select>

            <label for="productBrand">Product Brand:</label>
            <select id="productBrand" name="productBrand" required>
                <?php
                // Loop through brands array to generate options dynamically
                foreach ($brand as $brd) {
                    echo " <option value='{$brd['brand_id']}'>{$brd['brand_name']}</option> ";
                }
                ?>
            </select>

            <label for="productTitle">Product Title:</label>
            <input type="text" id="productTitle" name="productTitle" required>

            <label for="productPrice">Product Price:</label>
            <input type="number" id="productPrice" name="productPrice" step="0.01" required>

            <label for="productDescription">Product Description:</label>
            <textarea id="productDescription" name="productDescription" rows="4" cols="50" required></textarea>

            <label for="productImage">Product Image:</label>
            <input type="file" id="productImage" name="productImage" accept="image/*" required> 

            <label for="productKeywords">Product Keywords:</label>
            <input type="text" id="productKeywords" name="productKeywords" required>

            <button type="submit" id="product_button" name="product_button">Add Product</button>
        </form>
    </div>
            </div>
</body>
</html>
