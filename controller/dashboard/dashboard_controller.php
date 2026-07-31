<?php
 
require ('../../model/common/common_functions.php');

class dashboard_controller
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_stringItem, $v_stringSupplier,$v_inventory_id;
        
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_stringItem = $_POST['v_stringItem'];
        $this->v_stringSupplier = $_POST['v_stringSupplier'];
        $this->v_inventory_id = $_POST['v_inventory_id'];
        
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
// 		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
		$array[1] = "select count(*) as company_count from company_details";
        $array[2] = "select count(*) as supplier_count from  supplier_details";
        $array[3] = "select count(*) as project_count from  project_main_table";
        $array[4] = "select count(*) as user_count from  users";
        return $array; 
        }
        
         function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            // case 'list_store_item':
            //      $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[0]);
            // break;
            case 'count_of_companies':
                 $this->varModelObj->ListFromTable($var[1]);
            break;
            case 'count_of_suppliers':
                 $this->varModelObj->ListFromTable($var[2]);
            break;
            case 'count_of_projects':
                 $this->varModelObj->ListFromTable($var[3]);
            break;
            case 'count_of_users':
                 $this->varModelObj->ListFromTable($var[4]);
            break;
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new dashboard_controller();
$obj->RequestAccept($obj->actionevents);
?>