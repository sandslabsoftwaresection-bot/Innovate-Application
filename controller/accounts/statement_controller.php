<?php
include('../../model/db_connection/connection.php');

class StatementController
{
    var $varDBConnection;
    public $actionevents;
    
    function __construct()
    {
        $this->varDBConnection = $conn; // Use your existing connection
        $this->actionevents = $_POST['action'] ?? '';
    }
    
    function getStatementData()
    {
        // DataTables server-side processing parameters
        $requestData = $_REQUEST;
        $columns = array(
            0 => 'accounts_date',
            1 => 'company_name',
            2 => 'project_name',
            3 => 'quotation_number',
            4 => 'account_head',
            5 => 'type',
            6 => 'credit_amount',
            7 => 'debit_amount',
            8 => 'account_status'
        );
        
        // Base query
        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM credit_debit_ledger WHERE 1=1";
        
        // Search filter
        if (!empty($requestData['search']['value'])) {
            $searchValue = $this->varDBConnection->real_escape_string($requestData['search']['value']);
            $query .= " AND (company_name LIKE '%$searchValue%' 
                          OR project_name LIKE '%$searchValue%' 
                          OR quotation_number LIKE '%$searchValue%'
                          OR account_head LIKE '%$searchValue%')";
        }
        
        // Column-specific filtering
        if (!empty($requestData['columns'][4]['search']['value'])) {
            $accountHead = $this->varDBConnection->real_escape_string($requestData['columns'][4]['search']['value']);
            $query .= " AND account_head = '$accountHead'";
        }
        
        // Order by
        $query .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . " " . 
                 $requestData['order'][0]['dir'] . " LIMIT " . $requestData['start'] . " , " . 
                 $requestData['length'] . " ";
        
        $result = $this->varDBConnection->query($query);
        $data = array();
        
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        
        // Get total records
        $totalResult = $this->varDBConnection->query("SELECT FOUND_ROWS() as total");
        $totalRow = $totalResult->fetch_assoc();
        $totalRecords = $totalRow['total'];
        
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),
            "data" => $data
        );
        
        echo json_encode($json_data);
    }
    
    function RequestAccept($FunctionEvents)
    {
        switch ($FunctionEvents) {
            case 'get_statement_data':
                $this->getStatementData();
                break;
                
            default:
                echo 'No Action Found...!';
                break;
        }
    }
}

// Create instance and process request
$obj = new StatementController();
$obj->RequestAccept($obj->actionevents);
?>