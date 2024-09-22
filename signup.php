<?php
require 'db_connection.php';

if (isset($_POST['submit'])) {
    // Sanitize and validate user inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $empid = mysqli_real_escape_string($conn, $_POST['empid']);
    $empid1 = mysqli_real_escape_string($conn, $_POST['empid1']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

    // Validate and sanitize inputs
    $sql = "SELECT * FROM tbusers WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    $sql1 = "SELECT * FROM tbempinfo WHERE empid = '$empid'";
    $result1 = mysqli_query($conn, $sql1);

    if ($result === false || $result1 === false) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<script> alert('Username already exists'); </script>";
    } else {
        if (mysqli_num_rows($result1) == 0) {
            echo "<script> alert('Your ID doesn\'t exist'); </script>";
        } else {
            if ($empid != $empid1) {
                echo "<script> alert('ID number does not match'); </script>";
            } else {
                if ($password == $confirmpassword) {
                    // Hash the password before storing it
                    // Insert into tbusers
                    $query = "INSERT INTO `tbusers` (username, `password`, incharge_id)
                                VALUES ('$username', '$password', $empid)";
                    $insert_result = mysqli_query($conn, $query);

                    if ($insert_result === false) {
                        die("Insert query into tbusers failed: " . mysqli_error($conn));
                    }

                    // Check if the incharge_id already exists in tbincharge
                    $check_query = "SELECT * FROM tbincharge WHERE incharge_id = '$empid'";
                    $check_result = mysqli_query($conn, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        // Update existing record in tbincharge
                        $update_query = "UPDATE tbincharge SET empid = $empid WHERE incharge_id = '$empid'";
                        $update_result = mysqli_query($conn, $update_query);

                        if ($update_result === false) {
                            die("Update query in tbincharge failed: " . mysqli_error($conn));
                        }
                    } else {
                        // Insert new record into tbincharge
                        $query1 = "INSERT INTO `tbincharge` (incharge_id, `empid`)
                                    VALUES ('$empid', $empid)";
                        $insert_result1 = mysqli_query($conn, $query1);

                        if ($insert_result1 === false) {
                            die("Insert query into tbincharge failed: " . mysqli_error($conn));
                        }
                    }

                    echo "<script>
                    alert('Registered Successfully');
                    window.location.href = 'home1.php';
                    </script>";

                    exit(); // Make sure to exit after header redirect
                } else {
                    echo "<script> alert('Password does not match'); </script>";
                }
            }
        }
    }
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sign-Up</title>
    <link rel="stylesheet" type="text/css" href="login_style.css">
    <style>
        input#number[name="empid"] {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border: 1px solid #ddd;
  border-radius: 6px;
  background-color: #f9f9f9;
}
<style>
        input#number[name="empid"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        .back-button {
            margin-top:10px;
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #45a049;
        }
        input#number[name="empid1"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        .back-button {
            margin-top:10px;
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
    
</head>
<body>
<div class="login-container">
        <h1>Electronic Healthcare System</h1>
        <h2>Login</h2>
        <form action="" method="post">
      
        <input type="text" id="username" name="username" placeholder = "Username" required>

        
        <input type="number" id="number" name="empid" placeholder = "ID number" required>
        
        <input type="number" id="number" name="empid1" placeholder = "Confirm ID number" required>

        
        <input type="password" id="password" name="password" placeholder = "password" required>

       
        <input type="password" id="confirmpassword" name="confirmpassword" placeholder = "confirmpassword" required>

        <button type="submit" name="submit">Sign Up</button>
        <a href="login1.php" class="back-button">Back</a>
    </form>


    </div>    

    
</body>
</html>
