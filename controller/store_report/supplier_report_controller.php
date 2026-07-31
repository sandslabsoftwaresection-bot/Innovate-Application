<?php
 
require ('../../model/common/common_functions.php');

class supplier_reportController
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_stringItem, $v_stringSupplier,$v_inventory_id,$startDate,$endDate;
        
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_stringItem = $_POST['v_stringItem'];
        $this->v_stringSupplier = $_POST['v_stringSupplier'];
        $this->v_inventory_id = $_POST['v_inventory_id'];
        $this->startDate = $_POST['startDate'];
        $this->endDate = $_POST['endDate'];
        
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
// 		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
		$array[1] = "SELECT a.ids, a.inventory_id, trim(a.inventory_name) as inventory_name, a.store_category_id, a.store_category, a.description, a.quantity, a.rate,(a.rate*a.quantity) as item_amount,((a.rate*a.quantity)*a.tax/100) as item_tax,  a.tax, a.amount, FormatDate(a.recieved_date) as formatted_recieved_date, a.ref_no, a.master_ref_id, a.entry_type,
                                (
                                    SELECT supplier_name
                                    FROM purchase_received_main_tbl b
                                    WHERE b.supplier_id IN (".$this->v_stringSupplier.") AND b.ids = a.master_ref_id AND b.supplier_name IS NOT NULL
                                    group by b.supplier_name
                                ) as supplier_name
                            FROM
                                purchase_recieved_child_tbl a
                            WHERE
                                a.inventory_id IN (".$this->v_stringItem.")
                                AND a.entry_type = 'Purchase_recieved' AND (a.recieved_date BETWEEN '".$this->startDate."' AND '".$this->endDate."')
                                AND (
                                    a.ids IS NOT NULL
                                    OR a.inventory_id IS NOT NULL
                                    OR a.inventory_name IS NOT NULL
                                )
                                AND EXISTS (
                                    SELECT 1
                                    FROM purchase_received_main_tbl b
                                    WHERE b.ids = a.master_ref_id AND b.supplier_id IN (".$this->v_stringSupplier.") AND b.supplier_name IS NOT NULL
                                    group by b.supplier_name
                                ) order by a.inventory_name
                            ";
        
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
            case 'list_supplier_report':
                 $this->varModelObj->ListFromTable($var[1]);
            break;
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new supplier_reportController();
$obj->RequestAccept($obj->actionevents);
?>