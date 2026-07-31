<?php
// Database connection parameters
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

// Execute query to fetch data
$sql = "SELECT ids, concat(emp_name,' - ',salary_date) as emp_name,  allow_deduction, earning_amt, deduction_amt,DATE_FORMAT(salary_date, '%d %M %Y') as salary_date  FROM salary_child_tbl WHERE DATE_FORMAT(salary_date, '%Y-%m') = '2024-04'";
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Fetch data and store it in an array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data['data'][] = $row;
    }

    // Convert data to JSON format
    $json_data = json_encode($data);

    // Send JSON data to the client
    header('Content-Type: application/json');
    echo $json_data;
} else {
    // No results found
    echo json_encode(array('message' => 'No records found'));
}

// Close connection
$conn->close();
?>
