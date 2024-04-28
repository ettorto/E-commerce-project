<?php
// Start session to access session variables
session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 0) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit; // Stop further execution of the script
}

// Include your general class file
include("../controllers/general_controller.php");

// Fetch categories and brands data
$categories = viewCategory_ctr();
$brands = viewBrand_ctr();

// Fetch products data
$products = viewProducts_ctr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles1.css">
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

        /* Add CSS styles for product cards */
        .product-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            max-width: 300px; /* Set maximum width for each card */
            position: relative;
            display: inline-block; /* Display cards inline */
            vertical-align: top; /* Align cards to the top */
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px 5px 0 0; /* Round only the top corners */
        }
        .product-details {
            padding: 10px;
        }
        .card-buttons {
            position: absolute;
            top: 5px;
            right: 5px;
        }
         /* CSS for modal form */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto; /* 10% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        /* Close button style */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Form input style */
        input[type="text"],
        input[type="number"],
        textarea {
            width: calc(100% - 40px); /* Adjusted for padding */
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none; /* Disable textarea resize */
        }

        /* Button style */
        button[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: calc(100% - 40px); /* Adjusted for padding */
            font-size: 16px;
            margin-top: 10px;
        }

        button[type="button"]:hover {
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
        <h1>Welcome to the Admin Panel</h1>
        <div class="products">
            <h2>Products</h2>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_title']; ?>">
                    
                    <div class="product-details">
                        <h3><?php echo $product['product_title']; ?></h3>
                        <p><?php echo $product['product_desc']; ?></p>
                        <p><strong>Price: </strong><?php echo $product['product_price']; ?></p>
                        <p><strong>Category: </strong><?php echo $product['cat_name']; ?></p>
                        <p><strong>Brand: </strong><?php echo $product['brand_name']; ?></p>
                        <p><strong>Keywords: </strong><?php echo $product['product_keywords']; ?></p>
                    </div>
                    <button class="edit-btn" onclick="openModal(
                        '<?php echo $product['product_id']; ?>',
                        '<?php echo $product['product_title']; ?>',
                        '<?php echo $product['product_desc']; ?>',
                        '<?php echo $product['product_price']; ?>',
                        '<?php echo $product['cat_name']; ?>',
                        '<?php echo $product['brand_name']; ?>',
                        '<?php echo $product['product_keywords']; ?>',
                        '<?php echo $product['product_image']; ?>'
                    )">Edit Product</button>

                    <button class="delete-btn" onclick="deleteProduct(<?php echo $product['product_id']; ?>)">Delete</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal -->
    <div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">×</span>
            <h2>Edit Product</h2>
            <form id="editForm" enctype="multipart/form-data">
                <input type="hidden" id="productId" name="productId">
                <label for="productTitle">Product Title:</label>
                <input type="text" id="productTitle" name="productTitle">
                <label for="productDesc">Product Description:</label>
            <textarea id="productDesc" name="productDesc"></textarea>
            
            <label for="productPrice">Product Price:</label>
            <input type="number" id="productPrice" name="productPrice" step="0.01">
            
            <label for="productCategory">Product Category:</label>
            <select id="productCategory" name="productCategory">
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_name']; ?></option>
                <?php endforeach;?>
            </select>
            
            <label for="productBrand">Product Brand:</label>
            <select id="productBrand" name="productBrand">
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="productKeywords">Product Keywords:</label>
            <input type="text" id="productKeywords" name="productKeywords">
            <input type="hidden" id="productKeyword" value="a"name="productKeyword">
            <!-- New image input field
            <label for="productImage">Choose New Image:</label>
            <input type="file" id="productImage" name="productImage"> -->
            
            <button type="button" name="product_button" onclick="updateProduct()">Save</button>
        </form>
    </div>
</div>

<script>
    // Function to open modal and populate form fields
    function openModal(productId, title, description, price, category, brand, keywords) {
        document.getElementById('productId').value = productId;
        document.getElementById('productTitle').value = title;
        document.getElementById('productDesc').value = description;
        document.getElementById('productPrice').value = price;
        document.getElementById('productCategory').value = category;
        document.getElementById('productBrand').value = brand;
        document.getElementById('productKeywords').value = keywords;
        
        // // Clear the file input field
        // document.getElementById('productImage').value = null;

        // Display the modal
        document.getElementById('editModal').style.display = 'block';
    }

    // Function to close modal
    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Function to update product information via AJAX
    function updateProduct() {
        var formData = new FormData(document.getElementById('editForm'));
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../actions/edit_product.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Product updated successfully, close modal and possibly update UI
                closeModal();
                // You may want to reload or update the UI here
            } else {
                // Error updating product, display error message
                alert('Error updating product: ' + xhr.responseText);
            }
        };
        xhr.send(formData);
    }

    function deleteProduct(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            // Send AJAX request to delete_product.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../actions/delete_product.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Product deleted successfully, remove from UI
                        var productCard = document.getElementById("product_" + productId);
                        if (productCard) {
                            productCard.remove();
                        }
                        windows.reload();
                    } else {
                        // Error deleting product, show message
                        alert("Error deleting product.");
                    }
                }
            };
            xhr.send("product_id=" + productId);
        }
    }
</script>
</body>
</html>