<?php
require 'db_connection.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM tbusers WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if ($password == $row['password']) {
            $_SESSION["id"] = $row["id"];
            header("Location: home1.php");
        } 
        else {
            echo
              "<script> alert('Invalid username or password'); </script>";
           }
        
    }
    else {
        echo
        "<script> alert('Invalid username or password'); </script>";
        }
}

   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    
    <link rel="stylesheet" type="text/css" href="login_style.css">
</head>
<body>
<div class="login-container">
        <h1>Electronic Healthcare System</h1>
        <h2>Login</h2>
        <form action="" method="post">
        
        <input type="text" id="username" name="username" placeholder ="username" required>

       
        <input type="password" id="password" name="password" placeholder ="password" required>
        <input type="checkbox" id="show-password" onchange="togglepassword()"> Show Password
         <script>
        function togglepassword() {
        const passwordInput = document.querySelector('input[name="password"]');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }
    </script>

        


        <button type="submit" name="submit">login</button>

        <a href = "signup.php">Sign Up</a>
    </form>

</div>


</body>
</html>