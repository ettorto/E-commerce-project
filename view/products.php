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


// Fetch products data
$products = viewProducts_ctr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Page - Admin HTML Template</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="../assets1/css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="../assets1/css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="../assets1/css/templatemo-style.css">
    <!--
    Product Admin CSS Template
    https://templatemo.com/tm-524-product-admin
    -->
</head>
<body id="reportsPage">
<nav class="navbar navbar-expand-xl">
    <div class="container h-100">
        <a class="navbar-brand" href="dashboard.php">
            <h1 class="tm-site-title mb-0">Product Admin</h1>
        </a>
        <button
                class="navbar-toggler ml-auto mr-0"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <i class="fas fa-bars tm-nav-icon"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto h-100">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <i class="far fa-file-alt"></i>
                        <span> Reports <i class="fas fa-angle-down"></i> </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Daily Report</a>
                        <a class="dropdown-item" href="#">Weekly Report</a>
                        <a class="dropdown-item" href="#">Yearly Report</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="products.php">
                        <i class="fas fa-shopping-cart"></i> Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="accounts.php">
                        <i class="far fa-user"></i> Accounts
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <i class="fas fa-cog"></i>
                        <span> Settings <i class="fas fa-angle-down"></i> </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Billing</a>
                        <a class="dropdown-item" href="#">Customize</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link d-block" href="login.php">
                        Admin, <b>Logout</b>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="row tm-content-row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-products">
                <div class="tm-product-table-container">
                    <table class="table table-hover tm-table-small tm-product-table">
                        <thead>
                        <tr>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">IMAGE</th>
                            <th scope="col">PRODUCT NAME</th>
                            <th scope="col">PRICE</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">CATEGORY</th>
                            <th scope="col">KEYWORD</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                            <td><input type="checkbox" class="product-checkbox" value="<?php echo $product['product_id']; ?>"></td>

                                <td><img src="<?php echo $product['product_image']; ?>" alt="Product Image" width="100" height="100"></td>
                                <td class="tm-product-name"><?php echo $product['product_title']; ?></td>
                                <td><?php echo $product['product_price']; ?></td>
                                <td><?php echo $product['product_qty']; ?></td>
                                <td><?php echo $product['cat_name']; ?></td>
                                <td><?php echo $product['product_keywords']; ?></td>
                                <td>
                                    <a  class="tm-product-delete-link" onclick="deleteProduct(<?php echo $product['product_id']; ?>)">
                                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                    </a>
                                </td>
                                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- table container -->
                <a
                        href="add-product.php"
                        class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
                        <button class="btn btn-primary btn-block text-uppercase" onclick="deleteSelectedProducts()">
                             Delete selected products
                        </button>
                        <a
                        href="edit-product.php"
                        class="btn btn-primary btn-block text-uppercase mb-3">edit product</a>

            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-block-col">
            <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
                <h2 class="tm-block-title">Product Categories</h2>
                <div class="tm-product-table-container">
                    <table class="table tm-table-small tm-product-table">
                        <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td class="tm-product-name"><?php echo $category['cat_name']; ?></td>
                                <td class="text-center">
                                    <a href="#" class="tm-product-delete-link">
                                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- table container -->
                <a
                        href="add-category.php"
                        class="btn btn-primary btn-block text-uppercase mb-3">Add new category</a>
            </div>
        </div>
    </div>
</div>
<footer class="tm-footer row tm-mt-small">
    <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
            Copyright &copy; <b>2018</b> All rights reserved. 
            
            Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p>
    </div>
</footer>

<script src="../assets1/js/jquery-3.3.1.min.js"></script>
<!-- https://jquery.com/download/ -->
<script src="../assets1/js/bootstrap.min.js"></script>
<!-- https://getbootstrap.com/ -->
<script>
    $(function() {
        $(".tm-product-name").on("click", function() {
            window.location.href = "edit-product.html";
        });
    });

    
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
                        window.location.reload();
                    } else {
                        // Error deleting product, show message
                        alert("Error deleting product.");
                    }
                }
            };
            xhr.send("product_id=" + productId);
        }
    }

    function deleteSelectedProducts() {
        if (confirm("Are you sure you want to delete the selected products?")) {
            var selectedProducts = [];
            // Get all selected checkboxes
            var checkboxes = document.querySelectorAll('.product-checkbox:checked');
            checkboxes.forEach(function(checkbox) {
                selectedProducts.push(checkbox.value);
            });

            // Send AJAX request to delete selected products
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../actions/delete_selected_products.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Selected products deleted successfully, reload the page
                        window.location.reload();
                    } else {
                        // Error deleting selected products, show message
                        alert("Error deleting selected products.");
                    }
                }
            };
            xhr.send(JSON.stringify({ products: selectedProducts }));
        }
    }

</script>
</body>
</html>
