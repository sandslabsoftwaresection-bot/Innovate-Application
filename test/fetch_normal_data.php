<?php

// Database connection settings
$servername = "localhost";
$username = "sapphire_innovate_staging_user";
$password = "S@nds1@b";
$database = "sapphire_innovate_staging";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve data
$query = "SELECT `ids`,`emp_name`,`allow_deduction`,`earning_amt`,`deduction_amt`,`salary_date` FROM `salary_child_tbl` where MONTH(salary_date) = 4  AND YEAR(salary_date) = 2024";

// Execute query
$result = $conn->query($query);

// Fetch data and store in array
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();



// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
