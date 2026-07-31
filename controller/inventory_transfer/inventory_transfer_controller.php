<?php

require ('../../model/common/common_functions.php');




class inventoryTransferController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$project_id,$project_name,$company_id, $company_name,$reference_no,$signed_date, $contact_phone,$fax_number;
        public  $contact_person,$contact_address, $contract_value, $variations, $tax_id, $tax_name,$tax_value,  $project_description, $current_date,$ctrl_name;
        public $v_company_id,$v_company_name,$v_project_id,$v_project_name,$v_reference_no,$v_signed_date,$v_contact_phone,$v_contact_address,$v_fax_number,$v_contract_value;
        public $v_variations,$v_tax_id,$v_tax_name,$v_tax_value,$v_project_description;
        
    function __construct()
	{
	   
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
        $this->store_id = $_POST['v_store_id'];
		$this->inventory_id = $_POST['v_inventory_id'];
		$this->inventory_name = $_POST['v_inventory_name'];
		$this->transfer_qty = $_POST['v_transfer_qty'];
		$this->inventory_unit = $_POST['v_inventory_unit'];
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        $this->tax_content = $_POST['v_tax_content'];
        
        
       
        
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "SELECT *, (quantity_in - quanity_out) AS Stock FROM inventory_tbl WHERE inventory_category IN ('Consumable', 'Fixed') AND (quantity_in - quanity_out) > 0.00 ";
		
		$array[1] = "SELECT *, (store2_quantity_in - store2_quantity_out) AS Stock FROM inventory_tbl WHERE inventory_category IN ('Consumable', 'Fixed') AND (store2_quantity_in - store2_quantity_out) > 0.00 ";
		
		if ($this->store_id == 1) {
			$stock_from = 1;
			$stock_to = 2;
		} else {
			$stock_from = 2;
			$stock_to = 1;
		}
        
		$array[2] = "INSERT INTO tbl_transfer_stores (inventory_id, inventory_name, invt_unit, quantity, stock_from, stock_to) VALUES ('".$this->inventory_id."', '".$this->inventory_name."', '".$this->inventory_unit."', '".$this->transfer_qty."', '".$stock_from."', '".$stock_to."') ";
		
		$array[3] = "UPDATE inventory_tbl SET quanity_out = quanity_out +$this->transfer_qty , store2_quantity_in = store2_quantity_in +$this->transfer_qty WHERE ids = '".$this->inventory_id."' ";
		
		$array[4] = "UPDATE inventory_tbl SET store2_quantity_out = store2_quantity_out +$this->transfer_qty , quanity_out = quanity_out -$this->transfer_qty WHERE ids = '".$this->inventory_id."' ";
        
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'list_inventory':
               if($this->store_id === "1")
			   {
				   $this->varModelObj->ListFromTable($var[0]);
			   }
			   else
			   {
				   $this->varModelObj->ListFromTable($var[1]);
			   }
            break;
            
            case 'transfer_store_qty':
			
				$this->varModelObj->AddToTable($var[2]);
				
				if($this->store_id === '1')
				{
					$this->varModelObj->UpdateTable($var[3]);
				}
				else
				{
					$this->varModelObj->UpdateTable($var[4]);
				}
				
            break;
            
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new inventoryTransferController();
$obj->RequestAccept($obj->actionevents);
?>