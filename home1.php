<!DOCTYPE html>
<html>
<head>
    <title>BSU Clinic Portal- Electronic Healthcare System</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style> label {
            font-size: 18px;
            color: #333;
            margin-right: 10px;
            margin-top: 10px;
        }

        select {
            margin-right:1%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }</style>
</head>
<body>
    <div class="container">
        
        <!-- Log Out Button -->
        <a href="login1.php" class="button">Log Out</a>
        
        <a href="logform1.php" class="button">Log Form</a>

        <!-- "Student Medical Records" Button -->
        <a href="employee_medical_records2.php" class="button">Employee Medical Records</a>
        <a href="student_medical_records3.php" class="button">Student Medical Records</a>
       
        <!-- "Reload" Button to Reset the Displayed Data -->
        <a href="home1.php" class="button">Reload</a>
        
        <!-- Search Bar -->
        <form method="POST">
            
            <select name="type" id="">
            <option value="student">Student</option>
            <option value="employee">Employee</option>
            </select>
            <input type="text" name="search" placeholder="Search by Firstname">
            <input type="submit" value="Search">
        </form>

        <!-- Display Data -->
        <h3>Patient Appointment Date</h3>
        <table>
            <tr>
                <th>Date of Appointment</th>
                <th>Time of Appointment</th>
                <th>Patient Name</th>
                
            </tr>
            <?php
            include('db_connection.php');

            if (isset($_POST['search'])) {
                $search = strtolower($_POST['search']);
                
                $type = $_POST['type'];
                
                if($type == 'student'){
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
                ORDER BY patient.DATE DESC;
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
                HAVING empfirstname = '$search'
                ORDER BY patient.DATE DESC;";
                    $totalPatientsSql = "SELECT COUNT(*) AS totalPatients
                    FROM patient
                    LEFT JOIN tbincharge ON patient.incharge_id = tbincharge.incharge_id
                    LEFT JOIN tbempinfo ON patient.empid = tbempinfo.empid
                    LEFT JOIN tbstudinfo ON patient.studid = tbstudinfo.studid
                    WHERE tbempinfo.firstname = '$search';";
                    $result = mysqli_query($conn, $sql);
                    
                }}



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
            ORDER BY patient.DATE DESC;";
                $totalPatientsSql = "SELECT COUNT(*) AS totalPatients FROM db_sm3101.patient";
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
                
                echo " <td>{$firstname} {$lastname}</td>";

              
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

               



            $conn->close();
            ?>
</body>
</html>
