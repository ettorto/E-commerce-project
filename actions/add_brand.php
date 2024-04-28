<?php

include("../controllers/general_controller.php");

if (ISSET($_POST["brand_button"])){


    $brandName=$_POST['brandName'];
    
    
    
    
    


    add_brand_ctr($brandName);

    }


?>