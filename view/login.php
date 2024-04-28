<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .center {
            text-align: center;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="../actions/login_process.php" method="post" onsubmit="return validateForm()">
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <div id="emailError" class="error-message"></div>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div id="passwordError" class="error-message"></div>

            <p class="center">Not Registered? <a href="register.php">Click here to register</a></p>

            <button type="submit" id="login_button" name="login_button">Login</button>
        </form>
    </div>

    <!-- <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            var emailError = document.getElementById("emailError");
            var passwordError = document.getElementById("passwordError");

            if (email.trim() === "") {
                emailError.textContent = "Please enter your email.";
                return false;
            } else {
                emailError.textContent = "";
            }

            if (password.trim() === "") {
                passwordError.textContent = "Please enter your password.";
                return false;
            } else {
                passwordError.textContent = "";
            }

            return true;
        }
    </script> -->
</body>
</html>
