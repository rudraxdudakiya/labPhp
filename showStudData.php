<!DOCTYPE html>
<html>
<head>
    <title>Student Table</title>
</head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
            margin: 20px;
            padding: 20px;
        }
    </style>
<body>

    <h2>Student Records</h2>
    
    <?php
    
        include "mysqlConnect.php";
                
        $sql = "SELECT * FROM studentTB";
        $result = mysqli_query($connection, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        
        if(!empty($data)) {
            echo "      
                <table>
                    <tr>
                        <th>SrNo</th>
                        <th>RollNo</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Date Of Birth</th>
                        <th>Semester</th>
                        <th>Mo.No</th>
                        <th>Email</th>
                    </tr>
            ";
            $i=1;

            foreach($data as $row) {
                echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $row["rollno"] . "</td>";
                    echo "<td>" . $row["studName"] . "</td>";
                    echo "<td>" . $row["gender"] . "</td>";
                    echo "<td>" . $row["address"] . "</td>";
                    echo "<td>" . $row["city"] . "</td>";
                    echo "<td>" . $row["dob"] . "</td>";
                    echo "<td>" . $row["semester"] . "</td>";
                    echo "<td>" . $row["mobileNo"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                echo "</tr>";
                $i++;
            }
            echo "</table>";
        } else {
            echo "<p class='no-data'>No records found in the database.</p>";
        }
    ?>
</body>
</html>