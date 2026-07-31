<?php
 
require ('../../model/common/common_functions.php');

class store_reportController
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_from_date, $v_to_date,$v_inventory_id;
        
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_from_date = $_POST['v_from_date'];
        $this->v_to_date = $_POST['v_to_date'];
        $this->v_inventory_id = $_POST['v_inventory_id'];
        
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
		$array[1] = "SELECT ids, inventory_id, inventory_name, store_category_id, store_category, description, quantity, qty_out, damage_qty, FormatDate(recieved_date) as formatted_recieved_date, company_name, project_name, ref_no, entry_type FROM `purchase_recieved_child_tbl` WHERE `inventory_id`='".$this->v_inventory_id."' and (DATE(recieved_date) BETWEEN DATE('". $this->v_from_date."') AND DATE('".$this->v_to_date."')) ORDER BY ids ASC ";
        
        return $array; 
        }
        
         function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            case 'list_store_item':
                 $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[0]);
            break;
            case 'list_history_store_item':
                 $this->varModelObj->ListFromTable($var[1]);
            break;
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new store_reportController();
$obj->RequestAccept($obj->actionevents);
?>