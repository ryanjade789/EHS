<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="sms-styles.css">
    <style>
        .container {
            text-align: center;
        }

        table {
            margin: 20px auto;
        }

        .button-container {
            text-align: left;
            margin-bottom: 10px;
        }

        .button {
            margin-right: 10px;
        }

        /* Total Number of Patients container */
        .total-patients-container {
            background-color: #27ae60; 
            color: #fff;
            padding: 10px; 
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(46, 204, 113, 0.3); 
            font-family: 'Arial', sans-serif; 
            font-size: 18px; 
        }

        .total-patients-container:hover {
            box-shadow: 0 0 20px rgba(46, 204, 113, 0.6); 
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select, input {
            padding: 8px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<!-- Bootstrap Icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <h2>Student Medical Records</h2>

        <!-- Button Container on the Left -->
        <div class="button-container">
            <a href="home1.php" class="button">Back to Home</a>
            <a href="student_medical_records3.php" class="button">Reload</a>
        </div>
        
        <!-- Search Bar -->
        <form method="POST">
        
            <input type="text" name="search" placeholder="Search by Firstname">
            <input type="submit" value="Search">
        </form>

        <div></div>
        <table>
            <tr>
                <th>DATE</th>
                
                <th>PATIENT NAME</th>
                <th>CONTACT</th>
                <th>INCHARGE</th>
                <th>SYMPTOM</th>
                <th>PRESCRIPTION</th>
                
                
            <?php
            include('db_connection.php');

            if (isset($_POST['search'])) {
                $search = strtolower($_POST['search']);
                

                    $sql = "SELECT
                    patient.ID,
                    patient.CONTACT,
                    patient.SYMPTOM,
                    patient.PRESCRIPTION,
                    patient.DATE,
                    patient.empid,
                    (
                        SELECT tbempinfo.firstname
                        FROM tbempinfo
                        WHERE tbempinfo.empid = patient.empid
                    ) AS empfirstname,
                    (
                        SELECT tbempinfo.lastname
                        FROM tbempinfo
                        WHERE tbempinfo.empid = patient.empid
                    ) AS emplastname,
                    patient.studid,
                    tbstudinfo.firstname AS studfirstname,
                    tbstudinfo.lastname AS studlastname,
                    patient.incharge_id,
                    tbempinfo.firstname,
                    tbempinfo.lastname
                    
                    
                FROM patient
                LEFT JOIN tbincharge ON patient.incharge_id = tbincharge.incharge_id
                LEFT JOIN tbempinfo ON tbincharge.empid = tbempinfo.empid 
                LEFT JOIN tbstudinfo ON patient.studid = tbstudinfo.studid 
                HAVING studfirstname = '$search'
                ";
                    $totalPatientsSql = "SELECT COUNT(*) AS totalPatients FROM patient LEFT JOIN tbincharge ON patient.incharge_id = tbincharge.incharge_id LEFT JOIN tbempinfo ON tbincharge.empid = tbempinfo.empid LEFT JOIN tbstudinfo ON patient.studid = tbstudinfo.studid WHERE tbstudinfo.firstname = '$search';";
                    $result = mysqli_query($conn, $sql);

                }
                


            else {
                $sql = "SELECT
                patient.ID,
                patient.CONTACT,
                patient.SYMPTOM,
                patient.PRESCRIPTION,
                patient.DATE,
                patient.empid,
                (
                    SELECT tbempinfo.firstname
                    FROM tbempinfo
                    WHERE tbempinfo.empid = patient.empid
                ) AS empfirstname,
                (
                    SELECT tbempinfo.lastname
                    FROM tbempinfo
                    WHERE tbempinfo.empid = patient.empid
                ) AS emplastname,
                patient.studid,
                tbstudinfo.firstname AS studfirstname,
                tbstudinfo.lastname AS studlastname,
                patient.incharge_id,
                tbempinfo.firstname,
                tbempinfo.lastname
                
                
            FROM patient
            LEFT JOIN tbincharge ON patient.incharge_id = tbincharge.incharge_id
            LEFT JOIN tbempinfo ON tbincharge.empid = tbempinfo.empid 
            LEFT JOIN tbstudinfo ON patient.studid = tbstudinfo.studid 
            WHERE patient.empid = 0
            ORDER BY patient.DATE DESC";
                $totalPatientsSql = "SELECT COUNT(*) AS totalPatients FROM db_sm3101.patient WHERE studid >0";
                $result = mysqli_query($conn, $sql);
            }

             while($row = mysqli_fetch_assoc($result)){
                $ID = $row['ID']; 
                $CONTACT = $row['CONTACT'];                
                $SYMPTOM = $row['SYMPTOM'];        
                $PRESCRIPTION = $row['PRESCRIPTION']; 
                $DATE = $row['DATE']; 
                $empid = $row['empid']; 
                $empfirstname = $row['empfirstname'];
                $emplastname = $row['emplastname'];
                $studid = $row['studid'];
                $studfirstname = $row['studfirstname'];
                $studlastname = $row['studlastname'];
                $incharge_id = $row['incharge_id'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];  



                echo "<tr >";
                echo " <th scope='row' >{$DATE}</th>";
                
                echo " <td>{$empfirstname} {$emplastname} {$studfirstname} {$studlastname}</td>";
                echo " <td > {$CONTACT}</td>";
                echo " <td>{$firstname} {$lastname}</td>";
                echo " <td > {$SYMPTOM}</td>";
                echo " <td>{$PRESCRIPTION}</td>";
                
               
                
              
                echo " </tr> ";
            }
            echo "</table>";

                $totalPatientsResult = $conn->query($totalPatientsSql);
                $totalPatientsRow = $totalPatientsResult->fetch_assoc();
                $totalPatients = $totalPatientsRow['totalPatients'];

                // Integrated Total Number of Patients Container
                echo '<div class="total-patients-container">';
                echo "<p>Total Number of Patients: $totalPatients</p>";
                echo '</div>';

                

            ?>
    </div>
</body>
</html>
