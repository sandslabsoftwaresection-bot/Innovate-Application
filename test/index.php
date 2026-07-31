<?php
// Connect to MySQL
$mysqli = new mysqli("localhost", "sapphire_innovate_staging_user", "S@nds1@b", "sapphire_innovate_staging");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Fetch data from MySQL
$result = $mysqli->query("SELECT * FROM tlb_income_and_expence");
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Separate income and expense records
$income = array();
$expense = array();
foreach ($data as $row) {
    if ($row['cr_amount'] > 0) {
        $income[] = $row;
    } elseif ($row['dr_amount'] > 0) {
        $expense[] = $row;
    }
}

// Calculate total income
$total_income = 0;
foreach ($income as $row) {
    $total_income += $row['cr_amount'];
}

// Calculate total expenses
$total_expense = 0;
foreach ($expense as $row) {
    $total_expense += $row['dr_amount'];
}

// Calculate net income
$net_income = $total_income - $total_expense;

// Display P&L Account
echo "<h2>Profit & Loss Account</h2>";
echo "<table id='pl-account' class='display' style='width:100%'>";
echo "<thead><tr>";
echo "<th>Particulars</th>";
echo "<th>Amount</th>";
echo "</tr></thead>";
echo "<tbody>";

// Display income
echo "<tr><td><strong>Income</strong></td><td></td></tr>";
foreach ($income as $row) {
    echo "<tr>";
    echo "<td>{$row['customer_name']}</td>";
    echo "<td>{$row['cr_amount']}</td>";
    echo "</tr>";
}

// Display expenses
echo "<tr><td><strong>Expenses</strong></td><td></td></tr>";
foreach ($expense as $row) {
    echo "<tr>";
    echo "<td>{$row['customer_name']}</td>";
    echo "<td>{$row['dr_amount']}</td>";
    echo "</tr>";
}

// Display total income, expenses, and net income
echo "<tr><td><strong>Total Income</strong></td><td>{$total_income}</td></tr>";
echo "<tr><td><strong>Total Expenses</strong></td><td>{$total_expense}</td></tr>";
echo "<tr><td><strong>Net Income</strong></td><td>{$net_income}</td></tr>";

echo "</tbody></table>";

// Close MySQL connection
$mysqli->close();
?>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#pl-account').DataTable({
            "paging": false,
            "searching": false,
            "info": false
        });
    });
</script>
