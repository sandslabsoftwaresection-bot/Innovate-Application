<?php
 
require ('../../model/common/common_functions.php');

class inventory_materialController
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $jsonValue, $v_inventory_ids, $v_delete_ids, $v_view_ids, $v_item_name;
        
    function __construct()
	{
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
		
		$this->v_inventory_ids = $_POST['v_inventory_ids'];
		$this->v_delete_ids = $_POST['v_delete_ids'];
		
		$this->v_view_ids = $_POST['v_view_ids'];
		
		$this->v_item_name = $_POST['v_item_name'];

    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
		
		$array[0] = "SELECT *, (quantity_in-quanity_out) AS Store1,(store2_quantity_in-store2_quantity_out) AS Store2 FROM inventory_tbl WHERE inventory_category='Consumable'";
		
		$array[1] = "SELECT *, (quantity_in-quanity_out) AS Store1,(store2_quantity_in-store2_quantity_out) AS Store2 FROM inventory_tbl WHERE inventory_category='Consumable' AND ids='".$this->v_inventory_ids."'";
		
		$array[2] = "DELETE FROM inventory_tbl WHERE ids='".$this->v_delete_ids."'";
		
		$array[3] = "SELECT *, (quantity_in-quanity_out) AS Store1,(store2_quantity_in-store2_quantity_out) AS Store2 FROM inventory_tbl WHERE inventory_category='Fixed'";
		
		$array[4] = "SELECT *, (quantity_in-quanity_out) AS Store1,(store2_quantity_in-store2_quantity_out) AS Store2 FROM inventory_tbl WHERE inventory_category='Fixed' AND ids='".$this->v_inventory_ids."'";
		
		$array[5] = "SELECT *, quantity_in-quanity_out AS qty_bal FROM inventory_tbl WHERE inventory_category='Consumable'";
		
		$array[6] = "SELECT `inventory_id` as inventory_id,`inventory_name` as inventory_name,`description` as description,`qty` as qty,`unit` as unit,`purchase_recieved_date` as trans_date,
					`ref_no` as ref_no,'Purchased Received To Store1' as action,'PR' as type FROM `view_purchased_received_inventory`
					WHERE inventory_id='".$this->v_view_ids."'  and (`parent_ids`!='' or `parent_ids` IS NOT NULL) UNION SELECT `inventory_id` as inventory_id,`inventory_name` as inventory_name,'' description ,`quantity` as qty,`invt_unit` as unit,
					`date_transfer` as trans_date,'' as ref_no,CASE WHEN stock_from = '1' THEN 'Transfer From Store1 To Store2' ELSE 'Transfer From Store2 To Store1' END as action,CASE WHEN stock_from = '1' THEN 'ST12' ELSE 'ST21' END as action 
					from tbl_transfer_stores WHERE inventory_id= '".$this->v_view_ids."' UNION   SELECT `inventory_id` as inventory_id,`inventory_name` as inventory_name,'' as description,`qty` as qty,`unit` as unit,`entry_date` as trans_date,'' as ref_no,'Consume in Store2' as action,
					'CN2' as type FROM `view_store2_consume_inventory` WHERE inventory_id= '".$this->v_view_ids."'  and (`parent_ids`!='' or `parent_ids` IS NOT NULL) UNION  SELECT `inventory_id` as inventory_id,`inventory_name` as inventory_name,description as description,`qty` as qty,
					`unit` as unit,`entry_date` as trans_date,ref_no as ref_no,'Deliver From Store2' as action,'GPOUT' as type FROM `view_gate_pass_inventory_out` WHERE inventory_id= '".$this->v_view_ids."'  and (`parent_ids`!='' or `parent_ids` IS NOT NULL)UNION  SELECT `inventory_id` as inventory_id,
					`inventory_name` as inventory_name,description as description,`qty` as qty,`unit` as unit,`entry_date` as trans_date,ref_no as ref_no,'Return To Store2' as action,'PASSIN' as type FROM `view_pass_in_inventory_in` WHERE  inventory_id='".$this->v_view_ids."'  and (`parent_ids`!='' or `parent_ids` IS NOT NULL) ORDER BY trans_date asc";
					
		$array[7] = "SELECT *, (quantity_in-quanity_out) AS Store1,(store2_quantity_in-store2_quantity_out) AS Store2 FROM inventory_tbl WHERE inventory_category='Finished'";
		
		$array[8] = "SELECT *, (quantity_in-quanity_out) AS Store1,(store2_quantity_in-store2_quantity_out) AS Store2 FROM inventory_tbl WHERE inventory_category='Finished' AND ids='".$this->v_inventory_ids."'";
		
		$array[9] = "SELECT `finished_pdt_id` as inventory_id,`finished_pdt_name` as inventory_name,'' as description,`pdt_qty` as qty,`pdt_unit` as unit,`insert_date` as trans_date,'' as ref_no,
					'Manufactured In Factory And Deliver in Store2' as action,'FGST2' as type FROM `tbl_store2_finished_pdt_master` WHERE  finished_pdt_id= '".$this->v_view_ids."'   UNION  SELECT `inventory_id` as inventory_id,
					`inventory_name` as inventory_name,description as description,`qty` as qty,`unit` as unit,`entry_date` as trans_date,ref_no as ref_no,'Deliver From Store2' as action,
					'GPOUT' as type FROM `view_gate_pass_inventory_out` WHERE inventory_id= '".$this->v_view_ids."'  and (`parent_ids`!='' or `parent_ids` IS NOT NULL)UNION  SELECT `inventory_id` as inventory_id,`inventory_name` as inventory_name,
					description as description,`qty` as qty,`unit` as unit,`entry_date` as trans_date,ref_no as ref_no,'Return To Store2' as action,'PASSIN' as type FROM `view_pass_in_inventory_in` WHERE  inventory_id= '".$this->v_view_ids."' and (`parent_ids`!='' or `parent_ids` IS NOT NULL) ORDER BY trans_date asc ";
		
		return $array; 
    } 
	
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'list_inventory_material':
				if($this->v_inventory_ids == "all")
				{
				   $this->varModelObj->ListFromTable($var[0]);
				}
				else
				{
				   $this->varModelObj->ListFromTable($var[1]);
				} 
            break;
           
		    case 'delete_fixed_inventory_item':
                 $this->varModelObj->DeleteRow($var[2]);
            break;
			
			
			case 'list_inventory_machinery':
				if($this->v_inventory_ids == "all")
				{
				   $this->varModelObj->ListFromTable($var[3]);
				}
				else
				{
				   $this->varModelObj->ListFromTable($var[4]);
				} 
            break;  
			
			
			case 'list_all_consumable_materials':
				  $this->varModelObj->ListFromTable($var[5]);
            break;
			
			case 'list_view_inventory_details':
				$this->jsonValue = $this->varModelObj->ListFromTable($var[6]);
            break;
			
			case 'list_all_fixed_materials':
				  $this->varModelObj->ListFromTable($var[3]); 
            break;
			
			case 'list_inventory_finished':
				if($this->v_inventory_ids == "all")
				{
				   $this->varModelObj->ListFromTable($var[7]);
				}
				else
				{
				   $this->varModelObj->ListFromTable($var[8]);
				} 
            break;  
			
			case 'list_view_inventory_details_finished':
				$this->jsonValue = $this->varModelObj->ListFromTable($var[9]);
            break;
			
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
}//end of class

$obj = new inventory_materialController();
$obj->RequestAccept($obj->actionevents);
?>