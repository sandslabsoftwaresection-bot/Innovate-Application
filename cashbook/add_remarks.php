<?php
include('../model/db_connection/connection.php');
$connObj = new DBConnection();
$conn = $connObj->ConnectToMYSQL();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['v_remark']) && isset($_POST['table_id'])) {
    // Validate and sanitize inputs
    $v_remark = $_POST['v_remark'];
    $table_id = $_POST['table_id'];

    // Prepare and execute the update query
    $stmtUpdate = $conn->prepare("UPDATE tbl_cashbook SET notes = ? WHERE ids = ?");
    $stmtUpdate->bind_param("si", $v_remark, $table_id); // Assuming 'ids' is an integer field
    $stmtUpdate->execute();

    // Check if the update operation was successful
    if ($stmtUpdate->affected_rows > 0) {
        // Update operation was successful
        echo "Record updated successfully";
    } else {
        // No rows were affected, likely the record didn't exist or values didn't change
        echo "No record found to update or values unchanged";
    }

    $stmtUpdate->close();
} else {
    echo "Invalid input data";
}

$conn->close();
?>
