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

$cats = viewCategory_ctr();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand</title>
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
        .brand-table {
            width: 100%;
            border-collapse: collapse;
        }
        .brand-table th, .brand-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .brand-table th {
            background-color: #f2f2f2;
        }
        .brand-table th:first-child, .brand-table td:first-child {
            border-left: none;
        }
        .brand-table th:last-child, .brand-table td:last-child {
            border-right: none;
        }
        .edit-btn, .delete-btn {
            padding: 6px 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .edit-btn:hover, .delete-btn:hover {
            background-color: #0056b3;
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
    <h1>Add Category</h1>
    <form action="../actions/add_category.php" method="post" >
        <label for="categoryName">Category:</label>
        <input type="text" id="categoryname" name="categoryname" required>
        
        <button type="submit" name="category_button">Add Category</button>
    </form>
    <h1>Categories</h1>
    <input type="text" id="searchInput" onkeyup="searchCategories()" placeholder="Search for categories...">
    <table class="brand-table" id="categoryTable">
        <thead>
            <tr>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cats as $cat): ?>
                <tr id="cat_<?php echo $cat['cat_id']; ?>">
                    <td><?php echo $cat['cat_name']; ?></td>
                    <td>
                        <button class="edit-btn" onclick="editCategory(<?php echo $cat['cat_id']; ?>, '<?php echo $cat['cat_name']; ?>')">Edit</button>
                        <button class="delete-btn" onclick="deleteCategory(<?php echo $cat['cat_id']; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
            </div>
    <!-- JavaScript functions for edit and delete actions -->
    <script>
        function editCategory(catId, catName) {
            var newName = prompt("Enter the new category name:", catName);
            if (newName !== null) {
                // Send AJAX request to update the brand name
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../actions/edit_category.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Brand updated successfully, reload the page to reflect changes
                            location.reload();
                        } else {
                            // Error updating brand, show message
                            alert("Error updating brand.");
                        }
                    }
                };
                xhr.send("cat_id=" + catId + "&cat_name=" + encodeURIComponent(newName));
            }
        }

        function deleteCategory(catId) {
            if (confirm("Are you sure you want to delete this category?")) {
                // Send AJAX request to delete_brand.php
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../actions/delete_category.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Brand deleted successfully, remove from table
                            document.getElementById("cat_" + catId).remove();
                        } else {
                            // Error deleting brand, show message
                            alert("Error deleting category.");
                        }
                    }
                };
                xhr.send("cat_id=" + catId);
            }
        }

        function searchCategories() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("categoryTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search
                        // Loop through all table rows, and hide those that don't match the search query
                        for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Assuming category name is in the first column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
  

    </script>
</body>
</html>

