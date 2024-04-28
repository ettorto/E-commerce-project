<?php

include("../controllers/general_controller.php");

// if (isset($_POST["edit_brand_button"])) {
  

    $newbrandName = $_POST['brand_name'];
    $brandId = $_POST['brand_id']; 
    

    editBrand_ctr($brandId, $newbrandName);
// }
?>