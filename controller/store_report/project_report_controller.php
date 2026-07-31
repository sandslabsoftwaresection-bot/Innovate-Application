<?php
 
require ('../../model/common/common_functions.php');

class project_reportController
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_stringItem, $v_stringSupplier,$v_inventory_id,$v_project_id;
        
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_stringItem = $_POST['v_stringItem'];
        $this->v_stringSupplier = $_POST['v_stringSupplier'];
        $this->v_project_id = $_POST['v_project_id'];
        
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
// 		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
		$array[1] = "SELECT ids, inventory_id, inventory_name, store_category_id, store_category, item_code, unit, description, quantity, damage_qty, qty_out, FormatDate(recieved_date) as recieved_date, ref_no, master_ref_id, entry_type from purchase_recieved_child_tbl where project_id='".$this->v_project_id."'";
        
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
            case 'list_project_report':
                 $this->varModelObj->ListFromTable($var[1]);
            break;
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new project_reportController();
$obj->RequestAccept($obj->actionevents);
?>