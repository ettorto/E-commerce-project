<?php

include("../controllers/general_controller.php");

// if (ISSET($_POST["delete"])){


    $categoryId=$_POST['cat_id'];
    
    
    
    
    


    deleteCategory_ctr($categoryId);

    // }


?>