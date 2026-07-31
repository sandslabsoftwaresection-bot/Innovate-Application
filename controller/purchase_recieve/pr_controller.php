<?php
 
require ('../../model/common/common_functions.php');

class purchase_recieveController
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_supplier_ctrl_name, $v_job_ctrl_name, $v_pr_ctrl_name, $v_jobNo, $v_lpo_ctrl_name, $v_qty_ctrl_name, $v_tax_ctrl_name,
			   $v_supplier_id, $v_supplier_name, $v_job_ids, $v_job_name, $v_prn_no, $v_pur_recieve_date, $v_job_location, $v_requested_by, $v_approved_by,
			   $v_prd_no, $v_lpo_no, $v_bill_no, $v_pr_child_id, $v_inventory_item_id, $v_inventory_item_name, $v_description, $v_quantity, $v_unit, $v_rate, $v_tax, $v_net_amount, $v_purchase_recieve_no, $v_pur_recie_child_id,
			   $v_delete_ids, $v_startDate, $v_endDate, $v_purchase_rd_no, $v_prnn_no;
        
    function __construct()
	{
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_supplier_ctrl_name = $_POST['v_supplier_ctrl_name'];  
		$this->v_job_ctrl_name = $_POST['v_job_ctrl_name'];
		$this->v_pr_ctrl_name = $_POST['v_pr_ctrl_name'];
		$this->v_jobNo = $_POST['v_jobNo'];
		$this->v_lpo_ctrl_name = $_POST['v_lpo_ctrl_name'];
		$this->v_qty_ctrl_name = $_POST['v_qty_ctrl_name'];
		$this->v_tax_ctrl_name = $_POST['v_tax_ctrl_name'];
		
		$this->v_supplier_id = $_POST['v_supplier_id'];
		$this->v_supplier_name = $_POST['v_supplier_name'];
		$this->v_job_ids = $_POST['v_job_ids'];
		$this->v_job_name = $_POST['v_job_name'];
		$this->v_prn_no = $_POST['v_prn_no'];
		$this->v_pur_recieve_date = $_POST['v_pur_recieve_date'];
		$this->v_job_location = $_POST['v_job_location'];
		$this->v_requested_by = $_POST['v_requested_by'];
		$this->v_approved_by = $_POST['v_approved_by'];
		$this->v_prd_no = $_POST['v_prd_no'];
		$this->v_lpo_no = $_POST['v_lpo_no'];
		$this->v_bill_no = $_POST['v_bill_no'];
		$this->v_pr_child_id = $_POST['v_pr_child_id'];
		$this->v_inventory_item_id = $_POST['v_inventory_item_id']; 
		$this->v_inventory_item_name = $_POST['v_inventory_item_name']; 
		$this->v_description = $_POST['v_description'];
		$this->v_quantity = $_POST['v_quantity'];
		$this->v_unit = $_POST['v_unit'];
		$this->v_rate = $_POST['v_rate'];
		$this->v_tax = $_POST['v_tax'];
		$this->v_net_amount = $_POST['v_net_amount'];
		
		$this->v_purchase_recieve_no = $_POST['v_purchase_recieve_no']; 
		
		$this->v_pur_recie_child_id = $_POST['v_pur_recie_child_id'];
		
		$this->v_delete_ids = $_POST['v_delete_ids'];
		
		$this->v_startDate = $_POST['v_startDate'];
		$this->v_endDate = $_POST['v_endDate'];
		
		$this->v_purchase_rd_no = $_POST['v_purchase_rd_no'];
		
		$this->v_prnn_no = $_POST['v_prnn_no'];
 
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
		
		$array[0] = "SELECT company_id, company_name FROM supplier_details WHERE status='Active'";
		
		$array[1] = "SELECT work_order_main_id, work_order_number FROM  work_order_tbl";
		
		$array[2] = "SELECT ids ,purchase_req_no FROM purchase_requsition_main_tbl WHERE work_order_no='".$this->v_jobNo."'";
        $array[27] = "SELECT ids ,purchase_req_no  FROM purchase_requsition_main_tbl WHERE requisition_status!='Cancelled'";
        
		$array[3] = "SELECT local_po_number FROM local_po_main_tbl";
		
		$array[4] = "SELECT unit_id, unit_name FROM unit_master WHERE status='Active'";
		
		$array[5] = "SELECT ids, tax_value FROM tax_tbl WHERE status='Active'";
		
		$array[6] = "CALL proc_add_purchase_recieve_main_list_v1 ('".$this->v_supplier_id."', '".$this->v_supplier_name."', '".$this->v_job_ids ."', '".$this->v_job_name."', '".$this->v_prn_no."', '".$this->v_pur_recieve_date."', '".$this->v_job_location."', '".$this->v_requested_by."', '".$this->v_approved_by."', '".$this->v_prd_no."', '".$this->v_lpo_no."', '".$this->v_bill_no."', '".$this->v_pr_child_id."', '".$this->v_inventory_item_id."', '".$this->v_inventory_item_name."', '".$this->v_description."', '".$this->v_quantity."', '".$this->v_unit."', '".$this->v_rate."', '".$this->v_tax."', '".$this->v_net_amount."', @msg)";
		
		$array[7] = "SELECT * FROM purchase_recieved_child_tbl WHERE  prd_no='".$this->v_purchase_recieve_no."'";
		
		$array[8] = "DELETE FROM purchase_recieved_child_tbl WHERE ids='".$this->v_pur_recie_child_id."'";
		
		$array[9] = "UPDATE purchase_recieved_child_tbl SET description='".$this->v_description."', quantity='".$this->v_quantity."', unit='".$this->v_unit."', rate='".$this->v_rate."', tax='".$this->v_tax."', amount='".$this->v_net_amount."' WHERE prd_no='".$this->v_prd_no."'";
		
		$array[10] = "UPDATE purchase_received_main_tbl SET supplier_id='".$this->v_supplier_id."', supplier_name='".$this->v_supplier_name."', work_order_id='".$this->v_job_ids."', work_order_no='".$this->v_job_name."', purchase_req_no='".$this->v_prn_no."', purchase_recieved_date='".$this->v_pur_recieve_date."', job_location='".$this->v_job_location."', requested_by='".$this->v_requested_by."', approved_by='".$this->v_approved_by."', lpo_no='".$this->v_lpo_no."', bill_no='".$this->v_bill_no."', purchase_received_status='PR Generated' WHERE prd_no='".$this->v_prd_no."'";
		
		$array[11] = "SELECT * FROM purchase_received_main_tbl WHERE purchase_received_status IN('Pending','PR Generated')";
		
		$array[12] = "UPDATE purchase_received_main_tbl SET purchase_received_status='Cancelled' WHERE ids='".$this->cancel_ids."'";

        $array[13] = "SELECT * FROM purchase_received_main_tbl WHERE purchase_received_status IN('Cancelled')";
        
		$array[14] = "SELECT * FROM purchase_received_main_tbl WHERE purchase_received_status IN('Pending','PR Generated') AND purchase_recieved_date BETWEEN '".$this->v_startDate."' AND '".$this->v_endDate."'";
		
		$array[15] = "SELECT * FROM purchase_received_main_tbl WHERE purchase_received_status IN('Cancelled') AND purchase_recieved_date BETWEEN '".$this->v_startDate."' AND '".$this->v_endDate."'";
		
		$array[16] = "SELECT purchase_received_status FROM purchase_received_main_tbl WHERE prd_no='".$this->v_prn_no ."'";
		
		$array[17] = "SELECT * FROM purchase_requsition_child_tbl WHERE purchase_requsition_no='".$this->v_purchase_recieve_no."'";
		//----------------------------------------------------------------------------------------------------------------------------------------//
        
		$array[18] = "SELECT *,(quantity-quantity_purchased) as qty_bal  FROM purchase_requsition_child_tbl WHERE purchase_requsition_no='".$this->v_purchase_recieve_no."' AND quantity > quantity_purchased";
		
		$array[19] = "SELECT purchase_req_child_id FROM purchase_recieved_child_tbl WHERE purchase_req_child_id='".$this->v_pr_child_id."'";
		
		$array[20] = "SELECT * FROM purchase_recieved_child_tbl WHERE prd_no='".$this->v_purchase_rd_no."'";
		
		$array[21] = "DELETE FROM purchase_recieved_child_tbl WHERE ids='".$this->v_delete_ids."'";
		
		$array[22] = "UPDATE purchase_requsition_child_tbl SET quantity_purchased = quantity_purchased+'".$this->v_quantity."' WHERE ids='".$this->v_pr_child_id."'";
		
		$array[23] = "UPDATE purchase_requsition_child_tbl SET quantity_purchased = quantity_purchased-'".$this->v_quantity."' WHERE ids='".$this->v_pr_child_id."'";
		
		$array[24] = "DELETE FROM purchase_received_main_tbl WHERE ids='".$this->v_pr_child_id."'";
		
		$array[25] = "UPDATE inventory_tbl SET quantity_in=quantity_in+$this->v_quantity WHERE ids='".$this->v_inventory_item_id."'";
		
		$array[26] = "UPDATE inventory_tbl SET quantity_in=quantity_in-$this->v_quantity WHERE ids='".$this->v_inventory_item_id."'";
		
		$array[27] = "SELECT * FROM local_po_main_tbl WHERE local_po_number='".$this->v_lpo_no."' ";

		return $array; 
    } 
	
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'select_supplier_name':
                $this->varModelObj->CreateDropDown($var[0],'company_id','company_name',$this->v_supplier_ctrl_name, 'Select Supplier');
            break;
           
		    case 'select_job_no':
                $this->varModelObj->CreateDropDown($var[1],'work_order_main_id','work_order_number',$this->v_job_ctrl_name,'Select Job No');
            break;
			
			case 'select_pr_no':
                $this->varModelObj->CreateDropDownForPRN($var[2],'purchase_req_no','purchase_req_no',$this->v_pr_ctrl_name,'Select PR No',$this->v_prnn_no);
            break;
			case 'select_pr_no_v1':
                $this->varModelObj->CreateDropDownForPRN($var[27],'purchase_req_no','purchase_req_no',$this->v_pr_ctrl_name,'Select PR No',$this->v_prnn_no);
            break;
			case 'select_LPO_no':
                $this->varModelObj->CreateDropDown($var[3],'local_po_number','local_po_number',$this->v_lpo_ctrl_name,'Select LPO No');
            break;
			
			case 'select_unit_no':
                $this->varModelObj->CreateDropDown($var[4],'unit_id','unit_name',$this->v_qty_ctrl_name,'Select Unit');
            break;
			
			case 'select_tax_no':
               $this->varModelObj->CreateDropDown($var[5],'ids','tax_value',$this->v_tax_ctrl_name ,'10.00');
            break;
			
			case 'add_purchase_recieve':
				$this->varModelObj->ExecuteProcedure($var[6]);
				$this->varModelObj->UpdateTable($var[22]);
                $this->varModelObj->UpdateTable($var[25]);				
            break;
				
			case 'list_purchase_recieve':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[7]);
				echo $this->jsonValue; 
            break;
			
			case 'delete_pur_recie_item': 
                $this->varModelObj->DeleteRow($var[8]);
            break;
			
			case 'edit_purchase_recieve':  	
				$this->jsonValue = $this->varModelObj->UpdateTable($var[9]);
				echo $this->jsonValue;
            break; 
			
			case 'generate_purchase_recieve':  	
				$this->jsonValue = $this->varModelObj->UpdateTable($var[10]);
				echo $this->jsonValue;
            break; 
			
			case 'list_table_pur_recie':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[11]);
				echo $this->jsonValue; 
            break;
			
			case 'pur_recie_status_to_cancel':  	
				$this->jsonValue = $this->varModelObj->UpdateTable($var[12]);
				echo $this->jsonValue;
            break; 
			
			case 'list_table_cancelled_pur_recie':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[13]);
				echo $this->jsonValue; 
            break;
			
			case 'list_table_pur_recie_view_between':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[14]);
				echo $this->jsonValue; 
            break;
			
			case 'list_table_cancelled_pur_recie_between':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[15]);
				echo $this->jsonValue; 
            break;
			
			case 'purchase_recieve_status':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[16]);
				echo $this->jsonValue; 
            break;
			
			case 'list_purchase_recieve_by_prno':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[17]);
				echo $this->jsonValue; 
            break;
	//------------------------------------------------------------------------------------------//
			case 'list_purchase_recieve_add':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[18]);
				echo $this->jsonValue; 
            break;
			
			case 'list_purchase_recieve_add_second':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[20]);
				echo $this->jsonValue; 
            break;
			
			case 'update_qty_in_delete':
                $this->varModelObj->UpdateTable($var[23]);
            break;
			
			case 'delete_purchase_recieve_second':
                $this->jsonValue = $this->varModelObj->DeleteRow($var[21]);
            break;
			
			case 'delete_main_purchase_recieve':
                $this->jsonValue = $this->varModelObj->DeleteRow($var[24]);
            break;
		    
			case 'update_qty_in_delete_inventory':
                $this->varModelObj->UpdateTable($var[26]);
            break;
			
			case 'select_lpo_details':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[27]);
				echo $this->jsonValue; 
            break;
			
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
}//end of class

$obj = new purchase_recieveController();
$obj->RequestAccept($obj->actionevents);
?>