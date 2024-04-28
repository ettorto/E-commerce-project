<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <title>Registration Page</title>
</head>
<body>

<div class="container">
<form id="registrationForm" method="post" action="../actions/register_process.php" onsubmit="validateForm(event)" >

        <h2>Register</h2>
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="contactNumber">Contact Number:</label>
        <input type="tel" id="contactNumber" name="contactNumber" required>

    
        <input type="hidden" id="userRole" value="1" name="userRole">
        <p style="text-align: center;">Already have an account? <a href="login.php">Click here to login</a></p>

        <button type="submit" id="reg_button" name="reg_button">Register</button>
    </form>
</div>

<script src="../js/script.js"></script>
</body>
</html>

