
<?php
include('../model/db_connection/connection.php');
$connObj = new DBConnection();
$conn = $connObj->ConnectToMYSQL();
// Your JSON data
//$jsonData = $_POST['cash_book_entry_data'];

// Decode JSON data into PHP array
//$dataArray = json_decode($jsonData, true);

// Create connection
//$conn = new mysqli("localhost", "root", "s@nds1@b", "cashbook");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmtSelect = $conn->prepare("SELECT DATE(date_of_entry) AS entry_date, COUNT(*) AS entry_count FROM tbl_cashbook GROUP BY date_of_entry ORDER BY date_of_entry;");
$stmtSelect->execute();
$result = $stmtSelect->get_result();

$data = array(); // Initialize an empty array to store fetched data

while ($row = $result->fetch_assoc()) {
    $data['data'][] = $row; // Append each row to the data array
}

// Convert the data array to JSON format
$json_output = json_encode($data);

// Output the JSON


// Close statement and database connection
$stmtSelect->close();
$conn->close();

echo $json_output;

?>
