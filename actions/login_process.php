<?php
include("../controllers/general_controller.php");



if (ISSET($_POST["login_button"])){


$email=$_POST['email'];
$password=$_POST['password'];




 login_user_ctr($email, $password);
}
?>