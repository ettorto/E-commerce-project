<?php
include("../controllers/general_controller.php");

// if (isset($_POST["edit_brand_button"])) {
  

    $newcategoryName = $_POST['cat_name'];
    $categoryId = $_POST['cat_id']; 
    

    editCategory_ctr($categoryId, $newcategoryName);
// }
?>