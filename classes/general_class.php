<?php
//connect to database class
// require("../settings/db_class.php");
require_once dirname(__FILE__) . "/../settings/db_class.php";

/**
*General class to handle all functions 
*/
/**
 *@author Ernest Torto
 *
 */

//  public function add_brand($a,$b)
// 	{
// 		$ndb = new db_connection();	
// 		$name =  mysqli_real_escape_string($ndb->db_conn(), $a);
// 		$desc =  mysqli_real_escape_string($ndb->db_conn(), $b);
// 		$sql="INSERT INTO `brands`(`brand_name`, `brand_description`) VALUES ('$name','$desc')";
// 		return $this->db_query($sql);
// 	}
class general_class extends db_connection
{
	//--INSERT--//
	public function add_user($fullName, $email, $password, $country, $city, $contactNumber, $userRole) {
        $ndb = new db_connection();
        $fullName = mysqli_real_escape_string($ndb->db_conn(), $fullName);
        $email = mysqli_real_escape_string($ndb->db_conn(), $email);
        // Encrypt the password using password_hash() function
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $country = mysqli_real_escape_string($ndb->db_conn(), $country);
        $city = mysqli_real_escape_string($ndb->db_conn(), $city);
        $contactNumber = mysqli_real_escape_string($ndb->db_conn(), $contactNumber);

        // // Check email availability before adding new customer
        // $emailCheckQuery = "SELECT * FROM customer WHERE email = '$email'";
        // $result = $ndb->db_query($emailCheckQuery);
        // if ($result) {
        //     // Email is already taken
        //     return false;
        // }

        $sql = "INSERT INTO `customer` (`customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `user_role`)
                VALUES ('$fullName', '$email', '$hashedPassword', '$country', '$city', '$contactNumber', '$userRole')";

        $result = $this->db_query($sql);
        if ($result) {
            // Redirect to login page after successful registration
            header("Location: ../view/login.php");
            exit();
        } else {
            // Redirect back to register page with error message
            header("Location: ../view/register.php");
            exit();
        }
        return $result;
    }

 

    
public function add_brand($brandName)
{
    $ndb = new db_connection();	
    $brandName =  mysqli_real_escape_string($ndb->db_conn(), $brandName);
    
    $sql="INSERT INTO `brands`(`brand_name`) VALUES ('$brandName')";
    $result=$this->db_query($sql);

    
    if ($result) {
        // Brand added successfully, redirect or show success message
        header("Location: ../view/brand.php");
        exit();
    } else {
        // Error adding brand, handle accordingly
        echo "Error adding brand.";
    }
    return $this->db_query($sql);
}

public function add_category($brandCategory)
{
    $ndb = new db_connection();	
    $brandCategory =  mysqli_real_escape_string($ndb->db_conn(), $brandCategory);
    
    $sql="INSERT INTO `categories`(`cat_name`) VALUES ('$brandCategory')";
    $result=$this->db_query($sql);

    
    if ($result) {
        // Brand added successfully, redirect or show success message
        header("Location: ../view/products.php");
        exit();
    } else {
        // Error adding brand, handle accordingly
        echo "Error adding category.";
    }
    return $this->db_query($sql);
}




  public function add_product($productCategory, $productTitle, $productPrice, $productDescription, $productImage, $productQuantity, $productKeywords){

    $ndb= new db_connection();
    $productCategory = mysqli_real_escape_string($ndb->db_conn(), $productCategory);
    $productTitle = mysqli_real_escape_string($ndb->db_conn(), $productTitle);
    $productPrice = mysqli_real_escape_string($ndb->db_conn(), $productPrice);
    $productDescription = mysqli_real_escape_string($ndb->db_conn(), $productDescription);
    $productQuantity = mysqli_real_escape_string($ndb->db_conn(), $productQuantity);
    $productKeywords = mysqli_real_escape_string($ndb->db_conn(), $productKeywords);
       

    $target_dir = "../images/";
    $target_file = $target_dir . basename($productImage["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    

    $check = getimagesize($productImage["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

                // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($productImage["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($productImage["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $productImage["name"])). " has been uploaded.";
            } else {
            echo "Sorry, there was an error uploading your file.";
            }
        }

        // SQL query to insert product into the database
        $sql = "INSERT INTO products (product_cat, product_title, product_price, product_desc, product_image, product_qty, product_keywords)
                VALUES ('$productCategory', '$productTitle', '$productPrice', '$productDescription', '$target_file', '$productQuantity','$productKeywords')";
        
        // Execute the query
        $result= $this->db_query($sql);

        if ($result) {
            // Product added successfully, redirect or show success message
            header("Location: ../view/dashboard.php");
            exit();
        } else {
            // Error adding product, handle accordingly
            echo "Error adding product.";
        }
  }



  public function addProductToCart($product_id, $quantity) {
    // Get the database connection
    $ndb = new db_connection();

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Sanitize user input to prevent SQL injection
    $product_id = mysqli_real_escape_string($ndb->db_conn(), $product_id);
    $quantity = mysqli_real_escape_string($ndb->db_conn(), $quantity);

    // Check if the product already exists in the cart for the user
    $sql_check = "SELECT * FROM cart WHERE c_id = '$user_id' AND p_id = '$product_id'";
    $result_check = $this->db_fetch_one($sql_check);

    if ($result_check) {
        // Product already exists in the cart, update the quantity
        
        $new_quantity = $result_check['qty'] + $quantity;

        $sql_update = "UPDATE cart SET qty = '$new_quantity' WHERE c_id = '$user_id' AND p_id = '$product_id'";
        $sql_update= $this->db_query($sql_update);
        if ( $sql_update) {
            header("Location: ../view/cart.php");
            exit();
        } else {
            echo "Error updating quantity: " . mysqli_error($ndb->db_conn());
        }
    } else {
        // Product does not exist in the cart, insert new record
        $sql_insert = "INSERT INTO cart (c_id, p_id, qty) 
                       VALUES ('$user_id', '$product_id', '$quantity')";
        
        $sql_insert=$this->db_query($sql_insert);

        if ( $sql_insert) {
            header("Location: ../view/cart.php");
            exit();
        } else {
            echo "Error adding product to cart: " . mysqli_error($ndb->db_conn());
        }
    }

    
}

	//--SELECT--//

    
    public function login_user($email, $password) {
        $ndb = new db_connection();
        $email = mysqli_real_escape_string($ndb->db_conn(), $email);
        $password = mysqli_real_escape_string($ndb->db_conn(), $password);
        
        // Retrieve the hashed password and user role from the database
        $sql = "SELECT customer_pass, customer_email, customer_id,  user_role FROM customer WHERE customer_email = '$email'";
        $row = $this->db_fetch_one($sql);
        
        // echo var_dump($row);

        if ($row !== false) {
            $hashedPassword = $row['customer_pass'];
            $userRole = intVal($row['user_role']);
            $useremail= $row['customer_email'];
            $userid= intVal($row['customer_id']);
             // Assuming user role is stored in the database
            
            // Verify the password using password_verify
            if (password_verify($password, $hashedPassword)) {
                // Password is correct, user is authenticated
                session_start();
            
                // Store user information in session variables
                $_SESSION['user_id'] = $userid;
                $_SESSION['user_role'] = $userRole;
                $_SESSION['email']=$useremail;

                // echo var_dump($_SESSION);
                // Redirect the user based on their role
                if ($userRole == 0) {
                    // echo "I am admin";
                    // header("Location: http://localhost/project/view/dashboard.php")
                    header("Location: ../view/dashboard.php");
                    exit();
                } else {

                    // echo "regular user";
                    header("Location: ../index.php");    
                    exit();
                }
            } else {
                // Password is incorrect
                header("Location: ../view/login.php?error=invalid_credentials");
                exit();
            }
        } else {
            // User not found or query failed
            header("Location: ../view/login.php?error=user_not_found");
            exit();
        }
    }
    


    // Function to get all products
    public function viewProducts()
    {
        $ndb = new db_connection();
        $sql = "SELECT p.*, c.cat_name 
        FROM products p 
        INNER JOIN categories c ON p.product_cat = c.cat_id";
        return $this->db_fetch_all($sql);
        
    }
    public function getProduct(){
        $ndb= new db_connection();
        $sql = "SELECT p.*, c.cat_name 
        FROM products p 
        INNER JOIN categories c ON p.product_cat = c.cat_id";
        return $this->db_fetch_one($sql);
     }

     // Function to get all brands
     public function viewBrand()
     {
         $ndb = new db_connection();
         $sql = "SELECT * FROM brands";
         return $this->db_fetch_all($sql);
         
     }

     public function viewCategory(){
        $ndb= new db_connection();
        $sql = "SELECT * FROM categories";
        return $this->db_fetch_all($sql);
     }


     // Function to fetch products in the user's cart
    public function getProductsInCart($user_id) {
        $ndb= new db_connection();

        $sql = "SELECT c.*, p.product_title, p.product_price , p.product_image
        FROM cart c
        INNER JOIN products p ON c.p_id = p.product_id
        WHERE c.c_id = '$user_id'";
        return $this->db_fetch_all($sql);
        
    }


    //DELETE//
        // Function to delete Product
        public function deleteProduct($productId) {
            $ndb = new db_connection();
    
            // Sanitize the input
            $productId = mysqli_real_escape_string($ndb->db_conn(), $productId);
    
            // Delete query
            $sql = "DELETE FROM products WHERE product_id = '$productId'";
    
            // Execute the query
           $result= $this->db_query($sql);

            if ($result) {
                // Product added successfully, redirect or show success message
                header("Location: ../view/dashboard.php");
                exit();
            } else {
                // Error adding product, handle accordingly
                echo "Error deleting product.";
            }
        }
    
        // Function to delete Brand
        public function deleteBrand($brandId) {
            $ndb = new db_connection();
    
            // Sanitize the input
            $brandId = mysqli_real_escape_string($ndb->db_conn(), $brandId);
    
            // Delete query
            $sql = "DELETE FROM brands WHERE brand_id = '$brandId'";
    
            // Execute the query
            $result = $this->db_query($sql);
    
            if ($result) {
                // Brand deleted successfully
                return true;
            } else {
                // Error deleting brand
                return false;
            }
        }

        // Function to delete Brand
        public function deleteCategory($categoryId) {
            $ndb = new db_connection();
    
            // Sanitize the input
            $categoryId = mysqli_real_escape_string($ndb->db_conn(), $categoryId);
    
            // Delete query
            $sql = "DELETE FROM categories WHERE cat_id = '$categoryId'";
    
            // Execute the query
            $result = $this->db_query($sql);
    
            if ($result) {
                // Brand deleted successfully
                return true;
            } else {
                // Error deleting brand
                return false;
            }
        }
    

       

        // Function to remove a product from the user's cart
        public function removeProductFromCart($user_id, $product_id) {
            $ndb = new db_connection();
            
            // Sanitize the input
            $user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
            $product_id = mysqli_real_escape_string($ndb->db_conn(), $product_id);
            
            // Delete query
            $sql = "DELETE FROM cart WHERE c_id = '$user_id' AND p_id = '$product_id'";
            
            // Execute the query
            $result = $this->db_query($sql);
            
            if ($result) {
                // Product removed from the cart successfully
                return true;
            } else {
                // Error removing product from the cart
                return false;
            }
        }



         //Function to edit product
    public function editProducts($productId, $newProductCategory, $newProductBrand, $newProductName, $newProductPrice, $newProductDescription,  $newProductKeyword) {
        $ndb = new db_connection;

        echo var_dump( $productId);
        $productId= mysqli_real_escape_string($ndb->db_conn(), $productId);
        $newProductName= mysqli_real_escape_string($ndb->db_conn(), $newProductName);
        $newProductPrice= mysqli_real_escape_string($ndb->db_conn(), $newProductPrice);
        $newProductCategory= mysqli_real_escape_string($ndb->db_conn(), $newProductCategory);
        $newProductBrand= mysqli_real_escape_string($ndb->db_conn(), $newProductBrand);
        $newProductDescription= mysqli_real_escape_string($ndb->db_conn(), $newProductDescription);
        $newProductKeyword= mysqli_real_escape_string($ndb->db_conn(), $newProductKeyword);


       
        $sql = "UPDATE products SET  
                        product_title = '$newProductName', 
                        product_price = '$newProductPrice', 
                        product_cat = '$newProductCategory', 
                        product_brand = '$newProductBrand', 
                        product_desc = '$newProductDescription', 
                        product_keywords = '$newProductKeyword'
                        WHERE product_id = '$productId'";
                        
                    $result= $this->db_query($sql);
                
                    if($result){
                    // handle file upload error if needed
                    echo var_dump($result);
                    // header("Location: ../dashboard.php");
                    exit();
                } else {
                    // Error adding product, handle accordingly
                    // echo "Error editing product.";
                }
        
         
    }

    public function edit_brand($brandId,$newbrandName){
        $ndb = new db_connection;

        
        $brandId= mysqli_real_escape_string($ndb->db_conn(), $brandId);
        $newbrandName= mysqli_real_escape_string($ndb->db_conn(), $newbrandName);

        $sql = "UPDATE brands SET brand_name = '$newbrandName' WHERE brand_id = '$brandId'";
        $result= $this->db_query($sql);

        if ($result) {
            // Product added successfully, redirect or show success message
            header("Location: ../view/brand.php");
            exit();
        } else {
            // Error adding product, handle accordingly
            echo "Error editing product.";
        }

    }

    public function edit_category($categoryId,$newcategoryName){
        $ndb = new db_connection;

        
        $categoryId= mysqli_real_escape_string($ndb->db_conn(), $categoryId);
        $newcategoryName= mysqli_real_escape_string($ndb->db_conn(), $newcategoryName);

        $sql = "UPDATE categories SET cat_name = '$newcategoryName' WHERE cat_id = '$categoryId'";
        $result= $this->db_query($sql);

        if ($result) {
            // Product added successfully, redirect or show success message
            header("Location: ../view/category.php");
            exit();
        } else {
            // Error adding product, handle accordingly
            echo "Error editing product.";
        }

    }

 

 // Function to update the quantity of a product in the user's cart
 public function updateProductQuantityInCart($user_id, $product_id, $quantity) {
    // Create a new instance of the database connection
    $ndb = new db_connection;

    // Escape and sanitize input data
    $user_id = mysqli_real_escape_string($ndb->db_conn(), $user_id);
    $product_id = mysqli_real_escape_string($ndb->db_conn(), $product_id);
    $quantity = mysqli_real_escape_string($ndb->db_conn(), $quantity);

    // Construct the SQL query to update the quantity in the cart table
    $sql = "UPDATE cart SET qty = '$quantity' WHERE c_id = '$user_id' AND p_id = '$product_id'";
    
    // Execute the query
    $result = $ndb->db_query($sql);

    // Check if the query was successful
    if ($result) {
        // Quantity updated successfully, handle redirection or response
        // For example, you can redirect to the cart page
        header("Location: cart.php");
        exit();
    } else {
        // Error occurred while updating quantity, handle accordingly
        echo "Error updating quantity.";
    }}

}
?>