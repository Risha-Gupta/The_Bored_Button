<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - The Bored Button</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        body 
        {
            background-image: url(images/bored.jpeg);
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: "Cardo", serif;
            font-weight: 400;
            font-style: normal;
        }

        .container 
        {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: beige;
            padding: 20px;
            width: 400px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .form-container 
        {
            width: 100%;
            max-width: 300px;
        }

        .form 
        {
            display: none;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .form.active 
        {
            display: flex;
        }

        .input-field 
        {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: "Cardo", serif;
        }

        .button 
        {
            padding: 10px 20px;
            background-color: rgb(29, 29, 77);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Cardo", serif;
            transition: background-color 0.3s ease;
        }

        .button:hover 
        {
            background-color: rgb(45, 45, 100);
        }

        .switch-form 
        {
            margin-top: 15px;
            color: rgb(29, 29, 77);
            cursor: pointer;
            text-decoration: underline;
        }

        .heading 
        {
            color: rgb(29, 29, 77);
            font-size: 40px;
            margin-bottom: 20px;
        }

        .error-message 
        {
            color: red;
            margin-top: 10px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="heading">The Bored Button</h1>
        <div class="form-container">
            <form id="loginForm" class="form active" method="POST" action="">
                <input type="email" placeholder="Email" class="input-field" name="loginEmail">
                <input type="password" placeholder="Password" class="input-field" name="loginPassword">
                <button class="button" type="submit" name="login">Login</button>
                <div class="switch-form" onclick="switchForm('register')">Need an account? Register</div>
            </form>

            <form id="registerForm" class="form" method="POST" action="">
                <input type="text" placeholder="Full Name" class="input-field" name="registerName">
                <input type="email" placeholder="Email" class="input-field" name="registerEmail">
                <input type="password" placeholder="Password" class="input-field" name="registerPassword">
                <input class="button" type="submit" name="register" value='Register'>
                <div class="switch-form" onclick="switchForm('login')">Already have an account? Login</div>
            </form>
        </div>
        <div id="errorMessage" class="error-message"></div>
    </div>

    <script>
        function switchForm(type) 
        {
            document.getElementById('loginForm').classList.toggle('active');
            document.getElementById('registerForm').classList.toggle('active');
            document.getElementById('errorMessage').textContent = '';
        }
    </script>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bored_button";

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if (!mysqli_query($conn, $sql)) 
    {
        die("Error creating database: " . mysqli_error($conn));
    }

    mysqli_select_db($conn, $dbname);

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )";
    
    if (!mysqli_query($conn, $sql)) 
    {
        die("Error creating table: " . mysqli_error($conn));
    }

    if (isset($_POST['register'])) 
    {
        $name = mysqli_real_escape_string($conn, $_POST['registerName']);
        $email = mysqli_real_escape_string($conn, $_POST['registerEmail']);
        $password = mysqli_real_escape_string($conn, $_POST['registerPassword']);

        if (!empty($name) && !empty($email) && !empty($password)) {
            
            $sql = "INSERT INTO users (full_name, email, password) VALUES ('$name', '$email', '$password')";
            if (mysqli_query($conn, $sql)) 
            {
                echo "<script>document.getElementById('errorMessage').textContent = 'Registration successful! Please login.';</script>";
            } 
            else 
            {
                echo "<script>document.getElementById('errorMessage').textContent = 'Error: Email already registered.';</script>";
            }
        } 
        else 
        {
            echo "<script>document.getElementById('errorMessage').textContent = 'Please fill in all fields.';</script>";
        }
    }

    if (isset($_POST['login'])) 
    {
        $email = mysqli_real_escape_string($conn, $_POST['loginEmail']);
        $password = mysqli_real_escape_string($conn, $_POST['loginPassword']);

        if (!empty($email) && !empty($password)) {
            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) 
            {
                $_SESSION['user_email'] = $email;
                echo "<script>document.getElementById('errorMessage').textContent = 'Login successful!'; window.location.href = 'frontpage.html';</script>";
            } 
            else 
            {
                echo "<script>document.getElementById('errorMessage').textContent = 'Invalid email or password.';</script>";
            }
        } 
        else 
        {
            echo "<script>document.getElementById('errorMessage').textContent = 'Please fill in all fields.';</script>";
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>