<?php
include("../controllers/general_controller.php");



if (ISSET($_POST["reg_button"])){

$fullName=$_POST['fullName'];
$email=$_POST['email'];
$password=$_POST['password'];
$country=$_POST['country'];
$city=$_POST['city'];
$contactNumber=$_POST['contactNumber'];
// $profileImage=
$userRole=$_POST['userRole'];



 add_user_ctr($fullName, $email, $password, $country, $city, $contactNumber, $userRole);
}
?>