<?php

require ('../../model/common/common_functions.php');

class accountController
{
    var $varModelObj, $varDBConnection;
    public $actionevents, $ctrl_name, $v_quotation_number, $quotation_id, $quotation_number,$v_description;
    
    function __construct()
    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'] ?? '';
        $this->v_quotation_number = trim($_POST['v_quotation_number'] ?? '');
        $this->project_ids = $_POST['v_project_id'] ?? '';
        
        $this->v_company_id = $_POST['v_company_id'] ?? '';
        $this->v_comapny_name = $this->varDBConnection->real_escape_string($_POST['v_comapny_name'] ?? '');
        $this->v_project_id = $_POST['project_id'] ?? '';
        $this->v_project_text = $this->varDBConnection->real_escape_string($_POST['project_text'] ?? '');
        $this->v_account_type = $_POST['account_type'] ?? '';
        $this->v_amount = $_POST['v_amount'] ?? '';
        $this->v_account_date = $_POST['v_account_date'] ?? '';
        $this->quotation_id = $_POST['quotation_id'] ?? '';
        $this->quotation_number = $_POST['quotation_number'] ?? '';
        
        $this->v_description = $_POST['v_description'] ?? '';
    }
    
    function SQLArray()
    { 
        $array = array();
        
        // Query for listing accounts history by quotation
        $array[0] = "SELECT * FROM credit_debit_ledger WHERE trim(`quotation_number`) = '" . $this->varDBConnection->real_escape_string($this->v_quotation_number) . "' ORDER BY account_head ASC";
        
        // Query for listing accounts history by project
        $array[1] = "SELECT * FROM credit_debit_ledger WHERE trim(`project_id`) = '" . $this->varDBConnection->real_escape_string($this->project_ids) . "' ORDER BY account_head ASC";

       // Query for project financial summary
        $array[2] = "SELECT 
            SUM(CASE WHEN account_head = 'Contract Amount' THEN contract_amount ELSE 0 END) AS contract_value,
            SUM(CASE WHEN account_head = 'Tax Income' THEN contract_amount ELSE 0 END) AS tax,
            SUM(CASE WHEN account_head = 'Received Amount' THEN debit_amount ELSE 0 END) AS received_amount,
            SUM(CASE WHEN account_head = 'Tax Receivable' THEN debit_amount ELSE 0 END) AS income_vat,
            SUM(CASE WHEN type = 'expense' THEN debit_amount ELSE 0 END) AS expense,
            SUM(CASE WHEN account_head = 'Tax Payable' THEN credit_amount ELSE 0 END) AS expense_vat
        FROM credit_debit_ledger" . 
        ($this->project_ids == 'All' 
            ? " WHERE company_id = '" . $this->varDBConnection->real_escape_string($this->v_company_id) . "'" 
            : " WHERE project_id = '" . $this->varDBConnection->real_escape_string($this->project_ids) . "' AND company_id = '" . $this->varDBConnection->real_escape_string($this->v_company_id) . "'"
        );

        
        // Query for quotation financial summary
        $array[3] = "SELECT 
            SUM(CASE WHEN account_head = 'Contract Amount' THEN contract_amount ELSE 0 END) AS contract_value,
            SUM(CASE WHEN account_head = 'Tax Income' THEN contract_amount ELSE 0 END) AS tax,
            SUM(CASE WHEN account_head = 'Received Amount' THEN debit_amount ELSE 0 END) AS received_amount,
            SUM(CASE WHEN account_head = 'Tax Receivable' THEN debit_amount ELSE 0 END) AS income_vat,
            SUM(CASE WHEN type = 'expense' THEN debit_amount ELSE 0 END) AS expense,
            SUM(CASE WHEN account_head = 'Tax Payable' THEN credit_amount ELSE 0 END) AS expense_vat
        FROM credit_debit_ledger ";
       // WHERE project_id = '" . $this->varDBConnection->real_escape_string($this->project_ids) . "'" . 
       // ($this->v_quotation_number == 'All' ? '' : " AND quotation_number = '" . $this->varDBConnection->real_escape_string($this->v_quotation_number) . "'");

        
        // Query for adding salary/miscellaneous account
       $array[4] = "INSERT INTO credit_debit_ledger 
                        (`company_id`, `company_name`, `project_id`, `project_name`,  `quotation_id`, `quotation_number`, `debit_amount`, `accounts_date`, `account_head`, `type`,description) 
                        VALUES (
                            '" . $this->varDBConnection->real_escape_string($this->v_company_id) . "',
                            '" . $this->v_comapny_name . "',
                            '" . $this->varDBConnection->real_escape_string($this->v_project_id) . "',
                            '" . $this->v_project_text . "',
                            '" . $this->varDBConnection->real_escape_string($this->quotation_id) . "',
                            '" .$this->quotation_number. "',
                            '" . $this->varDBConnection->real_escape_string($this->v_amount) . "',
                            '" . $this->varDBConnection->real_escape_string($this->v_account_date) . "',
                            '" . $this->varDBConnection->real_escape_string($this->v_account_type) . "',
                            'expense',
                            '" . $this->varDBConnection->real_escape_string($this->v_description) . "'
                        )";

        $array[5] = "SELECT *,date_format(accounts_date,'%d-%M-%Y') as accounts_date from credit_debit_ledger where project_id= '".$this->v_project_id."' and company_id='".$this->v_company_id."' and account_head IN (SELECT account_head_name FROM account_heads WHERE status = 'Active') "  ;           
        
        $array[6] = "SELECT * FROM account_heads WHERE status = 'Active' ORDER BY account_head_name ASC";
        
        $array[7] = "INSERT INTO account_heads (account_head_name) VALUES ('" . $this->varDBConnection->real_escape_string($_POST['name'] ?? '') . "')";
        
        $array[8] = "SELECT * FROM account_heads ORDER BY account_head_name ASC";
        
        $array[9] = "UPDATE account_heads SET status = IF(status = 'Active', 'Inactive', 'Active') WHERE ids = " . (int)($_POST['id'] ?? 0);
        
        $array[10] = "DELETE FROM account_heads WHERE ids = " . (int)($_POST['id'] ?? 0);
        
        $from_date_sql = '';
    $to_date_sql = '';
    $company_sql = '';
    if (!empty($_POST['from_date'] ?? '')) {
        $from_date_sql = date('Y-m-d', strtotime($_POST['from_date']));
    }
    if (!empty($_POST['to_date'] ?? '')) {
        $to_date_sql = date('Y-m-d', strtotime($_POST['to_date']));
    }
    if (!empty($_POST['company_id'] ?? '')) {
        $company_sql = " AND company_id = '" . $this->varDBConnection->real_escape_string($_POST['company_id']) . "'";
    }
    
    $array[11] = "
        SELECT 
            main.ids,
            main.accounts_date,
            main.invoice_number,
            main.type,
            main.reference_no,
            main.project_name AS description,
            main.account_head,
            -- Contract Value only on Contract Amount row
            CASE 
                WHEN main.account_head = 'Contract Amount' THEN (
                    SELECT SUM(
                        CASE 
                            WHEN sub.account_head IN ('Contract Amount','Tax Income') 
                                THEN sub.contract_amount 
                            ELSE 0 
                        END
                    )
                    FROM credit_debit_ledger sub
                    WHERE sub.quotation_number = main.quotation_number
                )
                ELSE 0
            END AS contract_value,
            -- Debit calculation
            CASE 
                WHEN main.account_head = 'Received Amount' THEN (
                    SELECT SUM(sub.debit_amount)
                    FROM credit_debit_ledger sub
                    WHERE sub.quotation_number = main.quotation_number
                      AND sub.invoice_number = main.invoice_number
                      AND sub.account_head IN ('Received Amount','Tax Receivable')
                )
                ELSE main.debit_amount
            END AS debit_amount,
            -- Credit calculation
            CASE 
                WHEN main.account_head = 'Received Amount' THEN 0
                ELSE main.credit_amount
            END AS credit_amount,
            -- Running balance (aligned with soa.php)
            (
                SELECT COALESCE(SUM(
                    CASE 
                        WHEN sub.account_head = 'Contract Amount' THEN 0
                        ELSE sub.debit_amount - sub.credit_amount
                    END
                ), 0)
                FROM credit_debit_ledger sub
                WHERE sub.accounts_date <= main.accounts_date
                  AND sub.ids <= main.ids
                  AND sub.account_head NOT IN ('Tax Income', 'Tax Receivable', 'Advance Received Amount', 'Retention Amount')
                  $company_sql
            ) AS balance
        FROM credit_debit_ledger main
        WHERE 1=1
          AND main.account_head NOT IN ('Tax Income', 'Tax Receivable', 'Advance Received Amount', 'Retention Amount')
          $company_sql
          " . 
          (!empty($from_date_sql) && !empty($to_date_sql) 
            ? " AND main.accounts_date BETWEEN '" . $this->varDBConnection->real_escape_string($from_date_sql) . "' AND '" . $this->varDBConnection->real_escape_string($to_date_sql) . "'" 
            : (!empty($from_date_sql) 
                ? " AND main.accounts_date >= '" . $this->varDBConnection->real_escape_string($from_date_sql) . "'" 
                : (!empty($to_date_sql) 
                    ? " AND main.accounts_date <= '" . $this->varDBConnection->real_escape_string($to_date_sql) . "'" 
                    : ""
                  )
              )
          ) . "
        ORDER BY main.accounts_date ASC, main.ids ASC
    ";


        return $array;
    }
    
    function RequestAccept($FunctionEvents)
    {
        $var = $this->SQLArray();
        
        switch ($FunctionEvents)
        {
            case 'list_accounts_history':
                if ($this->v_quotation_number == 'All') {
                    $this->varModelObj->ListFromTable($var[1]);
                } else if ($this->project_ids == 'All') {
                    $this->varModelObj->ListFromTable($var[1]); 
                } else {
                    $this->varModelObj->ListFromTable($var[0]);  
                }
                break;
            
            case 'add_salary_mis_account':
                // echo $var[4];
                $this->varModelObj->AddToTable($var[4]);  
                break;
            
            case 'get_project_financial_summary':
                $v_project_id = $this->varDBConnection->real_escape_string($_POST['v_project_id'] ?? '');
                
                // Execute query
                $result = $this->varDBConnection->query($var[2]);
                $row = $result->fetch_assoc();
                
                // Handle empty results
                if (!$row || is_null($row['contract_value'])) {
                    $financial_data = array_fill_keys(
                        ['contract_value', 'variations', 'tax', 'total_value', 'received_amount', 'income_vat', 
                         'net_income', 'net_balance', 'expense', 'expense_vat', 'total_expense', 'net_margin'], 
                        0.000
                    );
                } else {
                    // Calculate derived fields
                    $contract_value = (float)($row['contract_value'] ?? 0.000);
                    $tax = (float)($row['tax'] ?? 0.000);
                    $received_amount = (float)($row['received_amount'] ?? 0.000);
                    $income_vat = (float)($row['income_vat'] ?? 0.000);
                    $expense = (float)($row['expense'] ?? 0.000);
                    $expense_vat = (float)($row['expense_vat'] ?? 0.000);
                    
                    $financial_data = array(
                        'contract_value' => $contract_value,
                        'variations' => 0.000,
                        'tax' => $tax,
                        'total_value' => $contract_value + $tax,
                        'received_amount' => $received_amount,
                        'income_vat' => $income_vat,
                        'net_income' => $received_amount + $income_vat,
                        'net_balance' => ($contract_value + $tax) - ($received_amount + $income_vat),
                        'expense' => $expense,
                        'expense_vat' => $expense_vat,
                        'total_expense' => $expense + $expense_vat,
                        'net_margin' => ($contract_value ) - ($expense + $expense_vat)
                    );
                }
                
                echo json_encode($financial_data);
                break;
            
            case 'get_quotation_financial_summary':
                $v_project_id = $this->varDBConnection->real_escape_string($_POST['v_project_id'] ?? '');
                $v_quotation_number = $this->varDBConnection->real_escape_string($_POST['v_quotation_number'] ?? '');
                
                                $where = [];

                    /* Always restrict by company */
                    $where[] = "company_id = '" . $this->varDBConnection->real_escape_string($this->v_company_id) . "'";
                    
                    /* Project filter ONLY if project is NOT All */
                    if ($this->project_ids !== 'All') {
                        $where[] = "project_id = '" . $this->varDBConnection->real_escape_string($this->project_ids) . "'";
                    }
                    
                    /* Quotation filter ONLY if quotation is NOT All */
                    if ($this->v_quotation_number !== 'All') {
                        $where[] = "quotation_number = '" . $this->varDBConnection->real_escape_string($this->v_quotation_number) . "'";
                    }
                    
                    $whereClause = " WHERE " . implode(" AND ", $where);

                $result = $this->varDBConnection->query($var[3].$whereClause);
             
                $row = $result->fetch_assoc();
                
                // Handle empty results
                if (!$row || is_null($row['contract_value'])) {
                    $financial_data = array_fill_keys(
                        ['contract_value', 'variations', 'tax', 'total_value', 'received_amount', 'income_vat', 
                         'net_income', 'net_balance', 'expense', 'expense_vat', 'total_expense', 'net_margin'], 
                        0.000
                    );
                } else {
                    // Calculate derived fields
                    $contract_value = (float)($row['contract_value'] ?? 0.000);
                    $tax = (float)($row['tax'] ?? 0.000);
                    $received_amount = (float)($row['received_amount'] ?? 0.000);
                    $income_vat = (float)($row['income_vat'] ?? 0.000);
                    $expense = (float)($row['expense'] ?? 0.000);
                    $expense_vat = (float)($row['expense_vat'] ?? 0.000);
                    
                    $financial_data = array(
                        'contract_value' => $contract_value,
                        'variations' => 0.000,
                        'tax' => $tax,
                        'total_value' => $contract_value + $tax,
                        'received_amount' => $received_amount,
                        'income_vat' => $income_vat,
                        'net_income' => $received_amount + $income_vat,
                        'net_balance' => ($contract_value + $tax) - ($received_amount + $income_vat),
                        'expense' => $expense,
                        'expense_vat' => $expense_vat,
                        'total_expense' => $expense + $expense_vat,
                        'net_margin' => ($contract_value ) - ($expense + $expense_vat)
                    );
                }
                
                echo json_encode($financial_data);
                break;
                
            case 'list_accounts_history_expense': 
               
                $json_data=$this->varModelObj->ListFromTable($var[5]);
                echo $json_data;
                break;
            
            case 'list_account_heads':
                $result = $this->varDBConnection->query($var[6]);
                $data = [];
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                echo json_encode($data);
                break;
            
            case 'add_account_head':
                if ($this->varDBConnection->query($var[7])) {
                    echo $this->varDBConnection->insert_id;
                } else {
                    echo 0;
                }
                break;
            
            case 'list_all_account_heads':
                $json_data = $this->varModelObj->ListFromTable($var[8]);
                echo $json_data;
                break;
            
            case 'toggle_account_head_status':
                if ($this->varDBConnection->query($var[9])) {
                    echo 1;
                } else {
                    echo 0;
                }
                break;
            
            case 'delete_account_head':
                if ($this->varDBConnection->query($var[10])) {
                    echo 1;
                } else {
                    echo 0;
                }
                break;
                
            case 'list_statement_of_accounts':
                // echo $var[11];
                $this->varModelObj->ListFromTable($var[11]);
                break;
                
            case 'get_companies':
                $query = "SELECT company_id, MIN(company_name) AS company_name
                            FROM credit_debit_ledger
                            GROUP BY company_id
                            ORDER BY company_name ASC";
                $result = $this->varDBConnection->query($query);
                $data = [];
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                echo json_encode($data);
                break;
            
            default:
                echo 'No Action Found...!';
                break;
        }
    }
}

$obj = new accountController();
$obj->RequestAccept($obj->actionevents);
?>