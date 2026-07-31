<?php
 
require ('../../model/common/common_functions.php');

class salary_consolidateController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$startDate;
        
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->startDate = $_POST['startDate'];
        
        
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
// 		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
		$array[1] = "call GetSalaryData('".$this->startDate."')";
        $array[2] = "SELECT ids, concat(emp_name,' - ',FormatDate(salary_date)) as emp_name,  allow_deduction, earning_amt, deduction_amt,DATE_FORMAT(salary_date, '%d %M %Y') as salary_date  FROM salary_child_tbl WHERE DATE_FORMAT(salary_date, '%Y-%m') = '".$this->startDate."'";
        return $array; 
        }
        
        function RequestAccept($FunctionEvents)
       {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            
            case 'get_data':
                $data = array();
        		$this->result = mysqli_query($this->varDBConnection, $var[1]);
        		while($row=mysqli_fetch_assoc($this->result)) {
        			$data[] = $row;
        		}
        		
        		
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
                   
                    $filteredData = $data;
                }


                header('Content-Type: application/json');
                echo json_encode($filteredData);
                
                
            break;
            case 'load_data_to_normal_table':
                 $this->varModelObj->ListFromTable($var[2]);
            break;
            
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new salary_consolidateController();
$obj->RequestAccept($obj->actionevents);
?>