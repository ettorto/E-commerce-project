<?php

include("../controllers/general_controller.php");

if (ISSET($_POST["productKeyword"])){

    $productId=$_POST["productId"];
    $newProductCategory = $_POST["productCategory"];
    $newProductBrand = $_POST["productBrand"];
    $newProductName = $_POST["productTitle"];
    $newProductPrice = $_POST["productPrice"];
    $newProductDescription = $_POST["productDesc"];
    $newProductKeyword = $_POST["productKeywords"];
    // $newProductImage= $_FILES["productImage"];
    
    
    
    
    


    editProducts_ctr($productId, $newProductCategory, $newProductBrand, $newProductName, $newProductPrice, $newProductDescription, $newProductKeyword);

    }


?>
