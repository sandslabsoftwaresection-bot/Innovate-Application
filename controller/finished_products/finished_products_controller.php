<?php

require ('../../model/common/common_functions.php');




class companyController
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
        $this->fin_invn_ctrl_name = $_POST['v_fin_invn_ctrl_name'];
        
        $this->store_id = $_POST['v_store_id'];
		$this->inventory_id = $_POST['v_inventory_id'];
		$this->inventory_name = $_POST['v_inventory_name'];
		$this->pdt_qty = $_POST['v_qty'];
		$this->inventory_unit = $_POST['v_inventory_unit'];
		$this->master_id = $_POST['v_master_id'];
		$this->consume_qty = $_POST['v_consume_qty'];
		$this->child_id = $_POST['v_child_id'];
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        $this->tax_content = $_POST['v_tax_content'];
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
		$array[0] = "SELECT ids, item_name FROM `inventory_tbl` WHERE `inventory_category` = 'Finished' ";
		
		$array[1] = "SELECT *, (store2_quantity_in - store2_quantity_out) AS Stock FROM inventory_tbl WHERE inventory_category = 'Consumable' AND (store2_quantity_in - store2_quantity_out) > 0.00 ";
		
		$array[2] = "SELECT * FROM `inventory_tbl` WHERE `ids` = '".$this->inventory_id."' ";

		$array[3] = "call proc_add_finished_product('".$this->inventory_id."', '".$this->inventory_name."', '".$this->inventory_unit."', '".$this->pdt_qty."', @msg)";
		
		$array[4] = "UPDATE inventory_tbl SET store2_quantity_in = store2_quantity_in + $this->pdt_qty WHERE ids ='".$this->inventory_id."'";
		
		$array[5] = "INSERT INTO tbl_store2_finished_pdt_child (master_ids, inventory_id, inventory_name, consume_unit, consume_qty) VALUES ('".$this->master_id."', '".$this->inventory_id."', '".$this->inventory_name."', '".$this->inventory_unit."', '".$this->consume_qty."') ";
		
		$array[6] = "UPDATE inventory_tbl SET store2_quantity_out = store2_quantity_out + $this->consume_qty WHERE ids ='".$this->inventory_id."' ";

		$array[7] = "SELECT * FROM `tbl_store2_finished_pdt_child` WHERE master_ids = '".$this->master_id."' ";
		
		$array[8] = "DELETE FROM tbl_store2_finished_pdt_child WHERE ids='".$this->child_id."' ";
		
		$array[9] = "UPDATE inventory_tbl SET store2_quantity_out = store2_quantity_out - $this->consume_qty WHERE ids ='".$this->inventory_id."' ";

		$array[10] = "SELECT *, DATE_FORMAT(insert_date,'%d-%m-%Y') AS insert_date FROM `tbl_store2_finished_pdt_master` ";

		$array[11] = "SELECT * FROM `tbl_store2_finished_pdt_child` WHERE master_ids = '".$this->master_id."' ";

		$array[12] = "UPDATE inventory_tbl SET store2_quantity_in = store2_quantity_in - $this->pdt_qty WHERE ids ='".$this->inventory_id."'";
		
		$array[13] = "DELETE FROM tbl_store2_finished_pdt_master WHERE ids = '".$this->master_id."' ";
        
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'select_fin_inventory':
                $this->varModelObj->CreateDropDown($var[0],'ids','item_name',$this->fin_invn_ctrl_name,'-- Select --');
            break;
            
            case 'list_con_inventory':
				$this->varModelObj->ListFromTable($var[1]);
            break;
			
			case 'get_inventory_unit':
				$this->jsonValue = $this->varModelObj->ListFromTable($var[2]);
				echo $this->jsonValue;
            break;
			
			case 'add_finished_pdt': 
                  
                  $this->lastId = $this->varModelObj->ExecuteProcedure($var[3]);
				  echo $this->lastId;
				  $this->varModelObj->UpdateTable($var[4]);
                 
            break;
			
			case 'add_finished_pdt_child':
				$this->varModelObj->AddToTable($var[5]);
				$this->varModelObj->UpdateTable($var[6]);
            break;
			
			case 'list_finished_pdt_child':
				$this->varModelObj->ListFromTable($var[7]);
            break;
			
			case 'delete_finished_pdt_child':
				$this->varModelObj->DeleteRow($var[8]);
				$this->varModelObj->UpdateTable($var[9]);
            break;
            
			case 'list_finished_pdt_view':
				$this->varModelObj->ListFromTable($var[10]);
            break;
			
			case 'delete_finished_pdt_main':
				$this->SQLQuery = $this->varModelObj->ReturnCountValue($var[11]);
				
				if($this->SQLQuery !== 0)
				{
					echo $this->SQLQuery;
					return;
				}
				else
				{
					echo "Q1 :".$var[12];
					echo "Q2 :".$var[13];
					$this->varModelObj->UpdateTable($var[12]);
					$this->varModelObj->DeleteRow($var[13]);
				}
            break;
			
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new companyController();
$obj->RequestAccept($obj->actionevents);
?>