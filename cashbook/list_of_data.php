
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

$v_start_date = $_POST['v_start_date'] ?? '';
$v_end_date = $_POST['v_end_date'] ?? '';

$stmtSelect = $conn->prepare("SELECT *, DATE_FORMAT(date_of_entry, '%d-%m-%Y') as date_of_entry FROM tbl_cashbook WHERE date_of_entry BETWEEN ? AND ? ORDER BY ids ASC");
$stmtSelect->bind_param("ss", $_POST['v_start_date'], $_POST['v_end_date']);
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
