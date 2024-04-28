<?php
//connect to the user account class
// include("../classes/general_class.php");
require_once dirname(__FILE__) . "/../classes/general_class.php";
//sanitize data

// function add_user_ctr($a,$b,$c,$d,$e,$f,$g){
// 	$adduser=new customer_class();
// 	return $adduser->add_user($a,$b,$c,$d,$e,$f,$g);
// }


//--INSERT--//
function add_user_ctr($fullName, $email, $password, $country, $city, $contactNumber, $userRole) {
    $addUser = new general_class();
    return $addUser->add_user($fullName, $email, $password, $country, $city, $contactNumber, $userRole);
}

function add_brand_ctr($brandName) {
    $addBrand = new general_class();
    return $addBrand->add_brand($brandName);
}

function add_category_ctr($brandCategory) {
    $addCategory = new general_class();
    return $addCategory->add_category($brandCategory);
}


function add_product_ctr($productCategory, $productTitle, $productPrice, $productDescription,$productImage, $productQuantity, $productKeywords) {
    $addCategory = new general_class();
    return $addCategory->add_product($productCategory, $productTitle, $productPrice, $productDescription, $productImage, $productQuantity, $productKeywords);
}

function addProductToCart_ctr($product_id, $quantity) {
    $generalClass = new general_class();
    $generalClass->addProductToCart($product_id, $quantity);
}

//--SELECT--//
function login_user_ctr($email, $password) {
    $addUser = new general_class();
    return $addUser->login_user($email, $password);
}
function viewProducts_ctr() {
    $viewProducts = new general_class();
    return $viewProducts-> viewProducts();
}

function getProduct_ctr() {
    $getProduct = new general_class();
    return $getProduct-> getProduct();
}
function viewBrand_ctr() {
    $viewBrand = new general_class();
    return $viewBrand-> viewBrand();
}

function viewCategory_ctr() {
    $viewCategory = new general_class();
    return $viewCategory-> viewCategory();
}

function getProductsInCart_ctr($user_id) {
    $getProduct= new general_class();
    return $getProduct-> getProductsInCart($user_id);
}
//--UPDATE--//
function editBrand_ctr($brandId,$newbrandName){
$editBrand = new general_class();
return $editBrand->edit_brand($brandId,$newbrandName);
}
function editCategory_ctr($categoryId,$newcategoryName){
    $editCategory = new general_class();
    return $editCategory->edit_category($categoryId,$newcategoryName);
    }

    function editProducts_ctr($productId, $newProductCategory, $newProductBrand, $newProductName, $newProductPrice, $newProductDescription, $newProductKeyword){
        $editProduct = new general_class();
        return $editProduct->editProducts($productId, $newProductCategory, $newProductBrand, $newProductName, $newProductPrice, $newProductDescription, $newProductKeyword);
    }
    

function  updateProductQuantityInCart_ctr($user_id, $product_id, $quantity){
    $updateQuantity= new general_class();
    return $updateQuantity-> updateProductQuantityInCart($user_id, $product_id, $quantity);
}


//--DELETE--//
function deleteProduct_ctr($productId) {
    $deleteProduct = new general_class();
    return $deleteProduct-> deleteProduct($productId);
}

function deleteBrand_ctr($brandId) {
    $deleteBrand = new general_class();
    return $deleteBrand-> deleteBrand($brandId);
}

function deleteCategory_ctr($categoryId) {
    $deleteCategory = new general_class();
    return $deleteCategory-> deleteCategory($categoryId);
}

function removeProductFromCart_ctr($user_id, $product_id){
    $removeFromCart = new general_class();
    return $removeFromCart-> removeProductFromCart($user_id, $product_id);
}

?>