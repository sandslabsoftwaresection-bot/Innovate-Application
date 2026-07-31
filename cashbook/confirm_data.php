<?php

// Create connection
include('../model/db_connection/connection.php');
$connObj = new DBConnection();
$conn = $connObj->ConnectToMYSQL();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmtDelete = $conn->prepare("UPDATE tbl_cashbook SET confirm_status = 'Confirm' WHERE ids = ?");
$stmtDelete->bind_param("i", $_POST['v_rowId']); // Assuming 'ids' is an integer field
$stmtDelete->execute();

// Check if the delete operation was successful
if ($stmtDelete->affected_rows > 0) {
    // Delete operation was successful
    echo "Record deleted successfully";
} else {
    // No rows were affected, likely the record didn't exist
    echo "No record found to delete";
}

$stmtDelete->close();
$conn->close();

?>
