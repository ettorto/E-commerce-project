<?php

include("../controllers/general_controller.php");

if (ISSET($_POST["product_button"])){


    $productCategory = $_POST["productCategory"];
    $productTitle = $_POST["productTitle"];
    $productPrice = $_POST["productPrice"];
    $productDescription = $_POST["productDescription"];
    $productKeywords = $_POST["productKeywords"];
    $productQuantity = $_POST["stock"];
    $productImage= $_FILES["productImage"];
    
    
    
    
    


    add_product_ctr($productCategory, $productTitle, $productPrice, $productDescription, $productImage, $productQuantity, $productKeywords);

    }


?>

