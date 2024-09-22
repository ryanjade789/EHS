<?php include('db_connection.php'); ?>

<?php
    if (isset($_POST['submit'])) {
        $number = $_POST['number'];
        $incharge = isset($_POST['incharge']) ? $_POST['incharge'] : '';
        $contact = $_POST['contact'];
        $date = date('Y-m-d', strtotime($_POST['date']));
        $symptom = $_POST['symptom'];
        $prescription = $_POST['prescription'];
        $type = $_POST['type'];

        if ($type == 'student') {
            $sql1 = "SELECT * FROM tbstudinfo WHERE studid = '$number'";
            $result1 = mysqli_query($conn, $sql1);

            if ($result1 === false) {
                die("Query failed: " . mysqli_error($conn));
            }

            if (mysqli_num_rows($result1) == 0) {
                echo "<script>alert('Student ID doesn\'t exist');</script>";
            } else {
                $sql2 = "SELECT * FROM tbincharge WHERE incharge_id = '$incharge'";
                $result2 = mysqli_query($conn, $sql2);

                if ($result2 === false) {
                    die("Query failed: " . mysqli_error($conn));
                }

                if (mysqli_num_rows($result2) == 0) {
                    echo "<script>alert('Incharge ID doesn\'t exist');</script>";
                } else {
                    $query = "INSERT INTO patient (CONTACT, SYMPTOM, PRESCRIPTION, `DATE`, empid, studid, incharge_id) 
                    VALUES ('$contact', '$symptom', '$prescription', '$date', 0, $number, $incharge)";
                    
                    $result = mysqli_query($conn, $query);

                    if ($result === false) {
                        die("Query failed: " . mysqli_error($conn));
                    } else {
                        echo "<script type='text/javascript'>alert('Data added successfully!')</script>";
                    }
                }
            }
        } else {
            // Employee section
            $sql1 = "SELECT * FROM tbempinfo WHERE empid = '$number'";
            $result1 = mysqli_query($conn, $sql1);

            if ($result1 === false) {
                die("Query failed: " . mysqli_error($conn));
            }

            if (mysqli_num_rows($result1) == 0) {
                echo "<script>alert('Employee ID doesn\'t exist');</script>";
            } else {
                $sql2 = "SELECT * FROM tbincharge WHERE incharge_id = '$incharge'";
                $result2 = mysqli_query($conn, $sql2);

                if ($result2 === false) {
                    die("Query failed: " . mysqli_error($conn));
                }

                if (mysqli_num_rows($result2) == 0) {
                    echo "<script>alert('Incharge ID doesn\'t exist');</script>";
                } else {
                    $query = "INSERT INTO patient (CONTACT, SYMPTOM, PRESCRIPTION, `DATE`, empid, studid, incharge_id) 
                    VALUES ('$contact', '$symptom', '$prescription', '$date', $number, 0, $incharge)";
                    
                    $result = mysqli_query($conn, $query);

                    if ($result === false) {
                        die("Query failed: " . mysqli_error($conn));
                    } else {
                        echo "<script type='text/javascript'>alert('Data added successfully!')</script>";
                    }
                }
            }
        }
    }
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <title>BSU Clinic Portal- Electronic Healthcare System</title>
    <link rel="stylesheet" type="text/css" href="lgf_styles.css">
    
 <style>select {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }</style>
 
</head>
<body>
    <div class="container">
        <h2>Log Form</h2>
        <a href="home1.php" class="button">Home</a>
        
        <!-- CRUD Buttons -->
        <a href="crud1.php" class="button">Documents for Employee</a>
        <a href="crud2.php" class="button">Documents for Student</a>
        
        <!-- Log Form -->
        <form action="" method="post">
        <select name="type" id="">
            <option value="student">Student</option>
            <option value="employee">Employee</option>
            </select>
            <div class="input-group">
                <label for="date">ID number</label>
                <input type="number" id="date" name="number" required>
            </div>
            <div class="input-group">
                <label for="date">Incharge ID number</label>
                <input type="number" id="date" name="incharge" required>
            </div>
            <div class="input-group">
                <label for="number">Contact</label>
                <input type="text" id="date" name="contact" required>
            </div>
            <div class="input-group">
                <label for="contact">Date</label>
                <input type="datetime-local" id="contact" name="date" required>
            </div>
            <div class="input-group">
                <label for="symptom">SYMPTOM:</label>
                <input type="text" id="symptom" name="symptom" required>
            </div>
            <div class="input-group">
                <label for="prescription">PRESCRIPTION:</label>
                <input type="text" id="prescription" name="prescription" required>
            </div>

            <!-- Save button -->
            <input type="submit" value="Save" name = "submit">
        </form>
    </div>
</body>
</html>
