<?php

include("../controllers/general_controller.php");

if (ISSET($_POST["category_button"])){


    $brandCategory=$_POST['categoryname'];
    
    
    
    
    


    add_category_ctr($brandCategory);

    }


?>