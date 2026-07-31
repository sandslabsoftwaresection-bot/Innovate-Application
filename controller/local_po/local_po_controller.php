<?php

require ('../../model/common/common_functions.php');

class local_poController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$ctrl_name,$local_po_number, $local_po_date, $company_name, $po_box, $telephone_no;
        public $fax, $address, $attn, $quotation_reference, $LPO_no, $sub_total, $vat, $total_amount, $received_amount, $balane_in_due;
        public $received_by_id, $received_by_name, $local_po_created_date, $local_po_status, $description,$main_description,$payment_terms,$less_discount;
        public $local_po_main_id, $quantity, $unit, $rate, $amount, $default_date,$from_date,$to_date,$local_po_child_id,$v_discount_percentage;
        public $v_amt_after_discount,$v_tax_percentage,$v_net_amount,$company_id,$v_job_ids,$v_job_name,$v_prn_no;
        public $v_company_id; // Add this property for purchase requisitions
        public $inventory_id;
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        $this->local_po_number = $_POST['v_local_po_no'];
        $this->local_po_date = $_POST['v_local_po_date'];
        $this->company_name = $_POST['v_local_po_company_name'];
        $this->company_name = $this->varDBConnection->real_escape_string(($this->company_name));
        $this->po_box = $this->varDBConnection->real_escape_string($_POST['v_local_po_po_box']);
        $this->telephone_no = $_POST['v_local_po_contact_no'];
        $this->fax = $_POST['v_local_po_fax'];
        $this->attn = $this->varDBConnection->real_escape_string($_POST['v_local_po_attn']);
        $this->quotation_reference = $this->varDBConnection->real_escape_string($_POST['v_local_po_quotation_ref']);
        $this->LPO_no = $this->varDBConnection->real_escape_string($_POST['v_local_po_lpo_no']);
        $this->sub_total = $_POST['v_local_po_sub_total'];
        $this->vat = $_POST['v_local_po_vat'];
        $this->total_amount = $_POST['v_local_po_total_amount'];
        $this->balane_in_due = $_POST['v_local_po_balance_due'];
        $this->received_amount = $_POST['v_local_po_received_amount'];
        $this->received_by_id = $_POST['received_by_id'];
        $this->received_by_name = $_POST['received_by_name'];
        $this->local_po_created_date = $_POST['local_po_created_date'];
        $this->main_description = $this->varDBConnection->real_escape_string($_POST['v_local_po_all_description']);
        $this->payment_terms = $_POST['v_local_po_payment'];
        $this->less_discount = $_POST['v_local_po_discount'];
        
        $this->description =$this->varDBConnection->real_escape_string( $_POST['v_local_po_description']);
        $this->quantity = $_POST['v_local_po_quantity'];
        $this->unit = $this->varDBConnection->real_escape_string($_POST['v_local_po_unit']);
        $this->rate = $_POST['v_local_po_rate'];
        $this->amount = $_POST['v_local_po_amount'];
        
        $this->from_date = $_POST['v_local_po_from_date'];
        $this->to_date = $_POST['v_local_po_to_date'];
        
        $this->local_po_child_id = $_POST['v_local_po_child_id'];
        
        $this->v_discount_percentage = $_POST['v_discount_percentage'];
        $this->v_amt_after_discount = $_POST['v_amt_after_discount'];
        $this->v_tax_percentage = $_POST['v_tax_percentage'];
        $this->v_net_amount = $_POST['v_net_amount'];
        $this->company_id=$_POST['v_company_id'];
		$this->v_job_ids = $_POST['v_job_ids'];
        $this->v_job_name = $_POST['v_job_name'];
        $this->v_prn_no=$_POST['v_prn_no'];
        $this->inventory_id = isset($_POST['v_inventory_id']) ? $_POST['v_inventory_id'] : '';
        // Add this for purchase requisitions
        $this->v_company_id = isset($_POST['v_company_id']) ? $_POST['v_company_id'] : (isset($_POST['v_company_id']) ? $_POST['v_company_id'] : '');
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "CALL proc_add_local_po_main_list2( '".$this->local_po_date."','".$this->company_id."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->quotation_reference."','".$this->payment_terms."','".$this->local_po_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->rate."','".$this->amount."','".$this->v_discount_percentage."','".$this->v_amt_after_discount."','".$this->v_tax_percentage."','".$this->v_net_amount."','".$this->v_job_name."','".$this->v_prn_no."',@msg)";
        
        $array[1] = "CALL proc_list_local_po('".$this->local_po_number."',@msg)";
          
        $array[2] = "CALL proc_generate_local_po('".$this->local_po_number."','". $this->sub_total."','".$this->less_discount."','".$this->total_amount."','".$this->vat."','".$this->balane_in_due."','".$this->main_description."',@msg)";
      
        $array[3] = "CALL proc_view_local_po_list1(@msg)";
		
        $array[4] = "CALL proc_view_local_po_list_between('".$this->from_date."','".$this->to_date."',@msg)";
        
        $array[5] = "CALL proc_edit_local_po_main_list1('".$this->local_po_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->quotation_reference."','".$this->payment_terms."','".$this->local_po_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->rate."','".$this->amount."','". $this->sub_total."','".$this->less_discount."','".$this->total_amount."','".$this->vat."','".$this->balane_in_due."','".$this->main_description."','". $this->local_po_child_id."','".$this->v_job_name."','".$this->v_prn_no."',@msg)";
        
        $array[6] = "SELECT local_po_status from local_po_main_tbl WHERE local_po_number='".$this->local_po_number."' ";
        
        $array[7] = "SELECT count(local_po_status) as local_po_count,local_po_main_id,local_po_number FROM local_po_main_tbl WHERE local_po_status='Pending' ";
        
        $array[8] = " SELECT `local_po_main_id`, `local_po_number`, DATE(local_po_date) as `local_po_date`, `company_name`, `po_box`, `telephone_no`, `fax`, `address`,  `quotation_reference`, `payment_terms`, `sub_total`, `less_discount`, `total_amount`, `vat`, `balane_in_due`, `received_by_id`, `received_by_name`, `local_po_created_date`, `local_po_status`,`description`,job_ids,job_name,prn_number FROM  local_po_main_tbl WHERE local_po_status='Pending' ";
        
         $array[9] = "UPDATE local_po_main_tbl SET local_po_status='Cancelled' WHERE local_po_number='".$this->local_po_number."'";
        
        $array[10] = "UPDATE local_po_child_tbl SET quotation_status='Cancelled' WHERE local_po_no='".$this->local_po_number."'";
        
        $array[11]= "SELECT company_id,company_name FROM supplier_details where status='Active' " ;
        
        $array[12]= "SELECT company_id,company_name,contact_phone,city,contact_address_1,fax,contact_person FROM supplier_details where company_id= ".$this->company_id." and status='Active' " ;
        
        $array[13] = "CALL proc_edit_loal_po_list('".$this->local_po_child_id."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->rate."','".$this->amount."','".$this->v_discount_percentage."','".$this->v_amt_after_discount."','".$this->v_tax_percentage."','".$this->v_net_amount."',@msg)";
        
        $array[14] = "Delete from local_po_child_tbl where local_po_child_id=".$this->local_po_child_id;
        
        $array[15] = "CALL proc_view_cancelled_local_po_list1(@msg)";
        
        $array[16] = "CALL proc_view_cancel_local_po_list_between('".$this->from_date."','".$this->to_date."',@msg)";
        
        // Add new query for purchase requisitions
        $array[17] = "SELECT purchase_req_no FROM purchase_requsition_main_tbl WHERE supplier_id = '".$this->v_company_id."' ORDER BY purchase_req_no DESC";
        
        $array[18] = "SELECT * FROM purchase_requsition_child_tbl WHERE purchase_requsition_no = '".$this->v_prn_no."'";
        
        $array[19] = "SELECT * FROM store_items WHERE item_id = '".$this->inventory_id."'";
        
        $array[20] = "SELECT p.work_order_no, w.location
                        FROM purchase_requsition_main_tbl p
                        JOIN work_order_tbl w 
                          ON w.work_order_number = p.work_order_no
                        WHERE p.purchase_req_no = '".$this->v_prn_no."'";
        
        return $array;
    }
    
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            case 'add_local_po':
                $this->varModelObj->ExecuteProcedure($var[0]);
            break;
            
            case 'list_local_po': 
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[1]);
            break;
            
            case 'generate_local_po': 
                $this->varModelObj->ExecuteProcedure($var[2]);
            break;
            
            case 'list_local_po_view': 
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[3]);
            break;
            
            case 'list_local_po_view_between': 
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[4]);
            break;
            
            case 'edit_local_po': 
                $this->varModelObj->ExecuteProcedure($var[5]);
            break;
            
            case 'local_po_status': 
                $this->varModelObj->ListFromTable($var[6]);
            break;
            
            case 'check_local_po_status': 
                $this->varModelObj->ListFromTable($var[7]);
            break;   
            
            case 'select_local_po_pending_data': 
                $this->varModelObj->ListFromTable($var[8]);
            break;
            
            case 'cancel_local_po_list': 
                $this->varModelObj->UpdateTable($var[9]);
                $this->varModelObj->UpdateTable($var[10]);
            break;
            
            case 'select_company_name': 
                $this->varModelObj->CreateDropDown($var[11],'company_id','company_name',$this->ctrl_name,'Select Company');
            break;
            
            case 'select_company_details': 
                $this->varModelObj->ListFromTable($var[12]);
            break;
            
            case 'edit_local_po_list': 
                $this->varModelObj->ExecuteProcedure($var[13]);
            break;
          
            case 'delete_local_item': 
                $this->varModelObj->UpdateTable($var[14]);
            break;
            
            case 'list_cancelled_local_po_view': 
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[15]);
            break;
            
            case 'list_local_po_cancel_view_between': 
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[16]);
            break;
            
            // Add new case for getting purchase requisitions
            case 'get_purchase_requisitions': 
                $this->varModelObj->ListFromTable($var[17]);
            break;
            
            case 'get_prn_items': 
                $this->varModelObj->ListFromTable($var[18]);
            break;
            
            case 'get_item_details': 
                // echo $var[19];
                $this->varModelObj->ListFromTable($var[19]);
            break;
            case 'get_work_order_no': 
                
                $this->varModelObj->ListFromTable($var[20]);
            break;
            
            default:
             echo 'No Action Found...!';
             break;
        }
    }
}//end of class

$obj = new local_poController();
$obj->RequestAccept($obj->actionevents);
?>