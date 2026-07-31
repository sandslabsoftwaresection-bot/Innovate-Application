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
$query = "call GetSalaryData('2024-03')";

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


// Filter columns to include only those with at least one non-zero row value
$filteredData = array();
$columnsToKeep = array(); // Keep track of columns to maintain order

// Manually add emp_name, date to the list of columns to keep
$columnsToKeep['emp_name'] = 'emp_name';
$columnsToKeep['salary_date'] = 'salary_date';

if (!empty($data)) {
    // Iterate over each row to find columns with non-zero values
    foreach ($data as $row) {
        foreach ($row as $columnName => $columnData) {
            // Check if the column is not already marked to keep, not starting with '__', and has non-zero value
            if (!in_array($columnName, $columnsToKeep) && substr($columnName, 0, 2) === '__' && $columnData != 0) {
                // Rename the column and mark it to keep
                $newColumnName = str_replace(array('__', '_amt'), array('', ''), $columnName);
                $columnsToKeep[$columnName] = $newColumnName;
            }
        }
    }
    // Add total_earning, total_deduction, and total_net_amount to the list of columns to keep
    $columnsToKeep['total_earning'] = 'total_earning';
    $columnsToKeep['total_deduction'] = 'total_deduction';
    $columnsToKeep['total_net_amount'] = 'total_net_amount';
    
    // Iterate over each row and include only the columns marked to keep
    foreach ($data as $row) {
        $filteredRow = array();
        foreach ($columnsToKeep as $oldColumnName => $newColumnName) {
            // Set the column data, or 0 if the column doesn't exist in the row
            $filteredRow[strtoupper($newColumnName)] = isset($row[$oldColumnName]) ? $row[$oldColumnName] : 0;
        }
        $filteredData[] = $filteredRow;
    }
} else {
    echo "No data received from the database.";
}



// Return data as JSON
header('Content-Type: application/json');
echo json_encode($filteredData);
?>
