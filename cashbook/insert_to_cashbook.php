<?PHP session_start();?>
<?php
// Your JSON data
$jsonData = $_POST['cash_book_entry_data'];

// Decode JSON data into PHP array
$dataArray = json_decode($jsonData, true);

// Create connection
include('../model/db_connection/connection.php');
$connObj = new DBConnection();
$conn = $connObj->ConnectToMYSQL();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


date_default_timezone_set('Asia/Bahrain');
$currentDateTime = date('Y-m-d H:i:s');
// Prepare and bind SQL INSERT statement
$stmtInsert = $conn->prepare("INSERT INTO tbl_cashbook (date_of_entry, credit, debit, description, entered_user_id, entered_username,status,default_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters and execute INSERT statement for each row in the array
foreach ($dataArray as $row) {
    $cr_amount = isset($row['cr_amount']) ? $row['cr_amount'] : 0;
    $dr_amount = isset($row['dr_amount']) ? $row['dr_amount'] : 0;
    $cr_description = isset($row['cr_dr_description']) ? $row['cr_dr_description'] : '';
	//$dr_description = isset($row['dr_description']) ? $row['dr_description'] : '';
    $entered_user_id = $_SESSION["user_id"];
    $entered_username = $_SESSION["user_real_name"];
    $default_date = $currentDateTime;

    $stmtInsert->bind_param("ssssssss", $row['selected_date'], $cr_amount, $dr_amount, $cr_description, $entered_user_id, $entered_username,$row['status'],$default_date);
    if (!$stmtInsert->execute()) {
        echo "Error: " . $stmtInsert->error;
    }
}

// Close statement and database connection
$stmtInsert->close();
$conn->close();

echo "Data inserted successfully.";

?>
