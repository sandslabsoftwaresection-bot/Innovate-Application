<?php

require ('../../model/common/common_functions.php');

class invoiceController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$invoice_number, $invoice_date, $company_name, $po_box, $telephone_no;
        public $fax, $address, $attn, $quotation_reference, $LPO_no, $sub_total, $vat, $total_amount, $received_amount, $balane_in_due;
        public $received_by_id, $received_by_name, $invoice_created_date, $invoice_status, $description,$main_description;
        public $invoice_child_id, $invoice_main_id, $quantity, $unit, $rate, $amount, $default_date,$from_date,$to_date,$v_quotation_no,$delivery_note_no;
        public $v_project_id,$v_project_name,$v_invoice_company_id,$v_quotation_child_id,$v_rate,$v_amount,$v_discount_amount,$v_vat_percentage,$v_net_amount;
        public $v_req_qty,$v_invoice_project_name,$v_invoice_project_id,$v_delivered_qty,$v_invoice_retention_amount,$v_invoice_previous_bill_amount,$dis;
        public $v_discount_precentage,$radioValue,$v_balance_in_due,$v_invoice_radio,$v_invoice_child_id ;
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        if (isset($_POST['v_ctrl_name'])) {
           $this->v_ctrl_name = $_POST['v_ctrl_name'];  
        }
         if (isset($_POST['v_invoice_no'])) {
           $this->invoice_number = $_POST['v_invoice_no'];  
        }
         if (isset($_POST['v_invoice_date'])) {
           $this->invoice_date = $_POST['v_invoice_date'];  
        }
         if (isset($_POST['v_invoice_company_name'])) {
           $this->company_name = $_POST['v_invoice_company_name'];
           $this->company_name = $this->varDBConnection->real_escape_string(($this->company_name));
        }
         if (isset($_POST['v_invoice_po_box'])) {
           $this->po_box = $this->varDBConnection->real_escape_string($_POST['v_invoice_po_box']);
        }
         if (isset($_POST['v_invoice_contact_no'])) {
          $this->telephone_no = $_POST['v_invoice_contact_no'];
        }
         if (isset($_POST['v_invoice_fax'])) {
           $this->fax = $_POST['v_invoice_fax'];
        }
         if (isset($_POST['v_invoice_attn'])) {
          $this->attn = $this->varDBConnection->real_escape_string($_POST['v_invoice_attn']);
        }
         if (isset($_POST['v_invoice_quotation_ref'])) {
          $this->quotation_reference = $this->varDBConnection->real_escape_string($_POST['v_invoice_quotation_ref']);
        }
         if (isset($_POST['v_invoice_lpo_no'])) {
         $this->LPO_no = $this->varDBConnection->real_escape_string($_POST['v_invoice_lpo_no']);
        }
         if (isset($_POST['v_invoice_sub_total'])) {
         $this->sub_total = $_POST['v_invoice_sub_total'];
        }
         if (isset($_POST['v_invoice_vat'])) {
           $this->vat = $_POST['v_invoice_vat'];
        }
         if (isset($_POST['v_invoice_total_amount'])) {
          $this->total_amount = $_POST['v_invoice_total_amount'];
        }
         if (isset($_POST['v_invoice_balance_due'])) {
           $this->balane_in_due = $_POST['v_invoice_balance_due'];
        }
         if (isset($_POST['v_invoice_received_amount'])) {
          $this->received_amount = $_POST['v_invoice_received_amount'];
        }
         if (isset($_POST['received_by_id'])) {
          $this->received_by_id = $_POST['received_by_id'];
        }
        if (isset($_POST['received_by_name'])) {
         
          $this->received_by_name = $_POST['received_by_name'];
        }
         if (isset($_POST['invoice_created_date'])) {
          $this->invoice_created_date = $_POST['invoice_created_date'];
        }
         if (isset($_POST['v_invoice_all_description'])) {
           $this->main_description = $this->varDBConnection->real_escape_string($_POST['v_invoice_all_description']);
        }
         if (isset($_POST['v_invoice_description'])) {
          $this->description =$this->varDBConnection->real_escape_string( $_POST['v_invoice_description']);
        }
         if (isset($_POST['v_invoice_quantity'])) {
          $this->quantity = $_POST['v_invoice_quantity'];
        }
         if (isset($_POST['v_invoice_unit'])) {
           $this->unit = $this->varDBConnection->real_escape_string($_POST['v_invoice_unit']);
        }
         if (isset($_POST['v_invoice_rate'])) {
          $this->rate = $_POST['v_invoice_rate'];
        }
         if (isset($_POST['v_invoice_amount'])) {
          $this->amount = $_POST['v_invoice_amount'];
        }
         if (isset($_POST['v_invoice_from_date'])) {
          $this->from_date = $_POST['v_invoice_from_date'];
        }
         if (isset($_POST['v_invoice_to_date'])) {
          $this->to_date = $_POST['v_invoice_to_date'];
        }
         if (isset($_POST['v_invoice_child_id'])) {
         $this->v_invoice_child_id = $_POST['v_invoice_child_id'];
        }
         if (isset($_POST['v_quotation_no'])) {
          $this->v_quotation_no = $_POST['v_quotation_no'];
        }
         if (isset($_POST['delivery_note_no'])) {
          $this->delivery_note_no = $_POST['delivery_note_no'];
        }
         if (isset($_POST['v_project_id'])) {
          $this->v_project_id = $_POST['v_project_id'];
        }
         if (isset($_POST['v_project_name'])) {
          $this->v_project_name = $_POST['v_project_name'];
        }
         if (isset($_POST['v_invoice_company_id'])) {
         $this->v_invoice_company_id = $_POST['v_invoice_company_id'];
        }
         if (isset($_POST['v_quotation_no'])) {
           $this->v_quotation_no = $_POST['v_quotation_no'];
        }
        if (isset($_POST['v_rate'])) {
            $this->v_rate = $_POST['v_rate'];
        }
         if (isset($_POST['v_amount'])) {
          $this->v_amount = $_POST['v_amount'];
        }
         if (isset($_POST['v_discount_amount'])) {
           $this->v_discount_amount = $_POST['v_discount_amount'];
        }
         if (isset($_POST['v_vat_percentage'])) {
            $this->v_vat_percentage = $_POST['v_vat_percentage'];
        }
         if (isset($_POST['v_net_amount'])) {
          $this->v_net_amount = $_POST['v_net_amount'];
        }
         if (isset($_POST['v_req_qty'])) {
          $this->v_req_qty = $_POST['v_req_qty'];
        }
        if (isset($_POST['v_invoice_project_name'])) {
          $this->v_invoice_project_name = $_POST['v_invoice_project_name'];
        }
        
        if (isset($_POST['v_invoice_project_id'])) {
          $this->v_invoice_project_id = $_POST['v_invoice_project_id']; 
        }
        if (isset($_POST['v_delivered_qty'])) {
         $this->v_delivered_qty = $_POST['v_delivered_qty']; 
        }
        if (isset($_POST['v_invoice_retention_amount'])) {
          $this->v_invoice_retention_amount = $_POST['v_invoice_retention_amount'];  
        }
        if (isset($_POST['v_invoice_previous_bill_amount'])) {
          $this->v_invoice_previous_bill_amount = $_POST['v_invoice_previous_bill_amount'];    
           
        }
        if (isset($_POST['dis'])) {
          $this->dis=$_POST['dis'];
        }
         if (isset($_POST['v_discount_precentage'])) {
          $this->v_discount_precentage=$_POST['v_discount_precentage'];
        }
        
         if (isset($_POST['radioValue'])) {
         $this->v_invoice_radio = $_POST['radioValue'];
        }
         if (isset($_POST['v_balance_in_due'])) {
          $this->v_balance_in_due = $_POST['v_balance_in_due'];
        }
        if (isset($_POST['v_quotation_child_id'])) {
          $this->v_quotation_child_id = $_POST['v_quotation_child_id'];
        }
        
        $this->v_tax_content = $_POST['v_tax_content'];
        $this->v_quotation_no = $_POST['v_quotation_no'];
        $this->v_total_discount_amount = $_POST['v_total_discount_amount'];
        //$this->v_total_discount_amount = $_POST['v_total_discount_amount'];
        //v_discount_type
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        
          
        $this->v_received_amount_type = $_POST['v_received_amount_type'];
        $this->v_retention_amount_type = $_POST['v_retention_amount_type'];
         
             
        
         
         
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "CALL proc_add_invoice_main_list_v3( '".$this->invoice_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->invoice_number."','".$this->delivery_note_no."','".$this->v_project_id."','".$this->v_project_name."','".$this->v_invoice_company_id."','".$this->v_invoice_retention_amount."','".$this->v_invoice_previous_bill_amount."', @msg)";
        
        $array[1] = "CALL proc_list_invoice_v3('".$this->invoice_number."',@msg)";
          
        $array[2] = "CALL proc_generate_invoice('".$this->invoice_number."','". $this->sub_total."','".$this->vat."','".$this->total_amount."','".$this->received_amount."','".$this->balane_in_due."','".$this->main_description."','".$this->v_invoice_retention_amount."','".$this->v_invoice_previous_bill_amount."','".$this->invoice_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->v_project_id."','".$this->v_project_name."','".$this->v_invoice_company_id."','".$this->v_received_amount_type."','".$this->v_retention_amount_type."',@msg)";
      
        $array[3] = "CALL proc_view_invoice_list_v3(@msg)";
        
        $array[4] = "CALL proc_view_invoice_list_between_v3('".$this->from_date."','".$this->to_date."',@msg)";
        
        $array[5] = "CALL proc_edit_invoice_main_list_v3( '".$this->invoice_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->invoice_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->rate."','".$this->amount."','". $this->sub_total."','".$this->vat."','".$this->total_amount."','".$this->received_amount."','".$this->balane_in_due."','".$this->main_description."','". $this->v_invoice_child_id."','".$this->v_invoice_retention_amount."','".$this->v_invoice_previous_bill_amount."',@msg)";
        
        $array[6] = "SELECT invoice_status from invoice_main_tbl_v3 WHERE invoice_number='".$this->invoice_number."'";
        
        $array[7] = "SELECT count(invoice_status) as invoice_count,invoice_main_id,invoice_number FROM invoice_main_tbl_v3 WHERE invoice_status='Pending' ";
        
        $array[8] = " SELECT `invoice_main_id`, `invoice_number`, DATE(invoice_date) as `invoice_date`, `company_name`, `po_box`, `telephone_no`, `fax`, `project_id` ,`project_name`, `address`, `attn`, `quotation_reference`, `LPO_no`, `sub_total`, `vat`,`total_discount_amount`, `discount_amount`,`discount_type`,`total_amount`, `received_amount`, `balane_in_due`, `received_by_id`, `received_by_name`, `invoice_created_date`, `invoice_status`, `description`,company_id, project_id, project_name,invoice_against FROM  invoice_main_tbl_v3 WHERE invoice_status='Pending' ";
        
        $array[9] = "UPDATE  invoice_main_tbl_v3 SET invoice_status='Cancelled' WHERE invoice_number='".$this->invoice_number."'";
        
        $array[10] = "UPDATE  invoice_child_tbl_v3 SET quotation_status='Cancelled' WHERE invoice_no='".$this->invoice_number."'";
        
        $array[11] = "SELECT `delivery_note_main_id`, `delivery_note_number`, `delivery_note_date`, `company_name`, `po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `LPO_no`, `sub_total`, `received_by_id`, `received_by_name`, `delivery_note_created_date`, `delivery_note_status`, `description` from `delivery_note_main_tbl` where quotation_reference='".$this->v_quotation_no."' ";        
       
        $array[14]= "Select DISTINCT quotation_reference from delivery_note_main_tbl where project_id='".$this->v_project_id."' and  quotation_status !='Cancelled'";
        
        $array[15]= "DELETE from invoice_child_tbl_v3 WHERE invoice_no='".$this->invoice_number."' and delivery_note_no= '".$this->delivery_note_no."'";
        
        $array[16]= "Select DISTINCT quotation_number  from quotation_main_tbl where project_id='".$this->v_project_id."'";
        
        $array[17] = "CALL proc_add_invoice_main_list_quotation_v3( '".$this->invoice_date.' '.$this->current_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->invoice_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->v_quotation_child_id."','".$this->v_quotation_no."','".$this->v_rate."','".$this->v_amount."','".$this->v_discount_precentage."','".$this->v_discount_amount."','".$this->v_vat_percentage."','".$this->v_net_amount."','".$this->v_req_qty."','". $this->v_invoice_company_id."','". $this->v_invoice_project_id."','". $this->v_invoice_project_name."',@msg)";
        
        $array[18] ="SELECT COUNT(*) as row_status FROM invoice_child_tbl_v3 WHERE invoice_no='".$this->invoice_number."' and description='".trim($this->dis)."'";
        
        $array[19] = "UPDATE invoice_child_tbl_v3 set quantity='".$this->v_delivered_qty."' ,amount='".$this->v_amount."',discount_amount='".$this->v_discount_amount."',net_amount='".$this->v_net_amount."',description='".$this->description."'  where invoice_child_id= '".$this->v_quotation_child_id."' and invoice_no='".$this->invoice_number."' ";
       
        $array[20] = "DELETE from invoice_child_tbl_v3 WHERE invoice_no='".$this->invoice_number."' and invoice_child_id='".$this->v_invoice_child_id."'";
        
        $array[21] = "DELETE from invoice_child_tbl_v3 WHERE invoice_no='".$this->invoice_number."' ";
        
        $array[22] = "CALL proc_view_cancel_invoice_list(@msg)";
        
        $array[23] = "CALL proc_view_cancel_invoice_list_between('".$this->from_date."','".$this->to_date."',@msg)";
        
        $array[24] = "CALL proc_add_invoice_main_list_qt_new_v3( '".$this->invoice_date.' '.$this->current_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->invoice_number."','". $this->v_invoice_company_id."','". $this->v_invoice_project_id."','". $this->v_invoice_project_name."','".$this->v_invoice_radio."','".$this->v_tax_content."','".$this->v_total_discount_amount."',@msg)";
        
        $array[25] = "DELETE from invoice_child_tbl_v3 WHERE invoice_no='".$this->invoice_number."' and invoice_child_id='".$this->v_invoice_child_id."'";
        
        $array[26] = "UPDATE invoice_main_tbl_v3 set balane_in_due='".$this->v_balance_in_due."',total_discount_amount='".$this->v_total_discount_amount."'  where  invoice_number='".$this->invoice_number."' ";
        
        $array[27]= "Select  discount_amount,discount_type,total_discount_amount  from quotation_main_tbl where quotation_number='".$this->v_quotation_no."'";
       
        
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_invoice':
                //echo $var[0]
                $this->varModelObj->ExecuteProcedure($var[0]);
            break;
            
            case 'list_invoice': 
              // echo $var[1];
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[1]);
            break;
            
            case 'generate_invoice': 
              // echo $var[2];
                $this->varModelObj->ExecuteProcedure($var[2]);
            break;
            
            case 'list_invoice_view': 
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[3]);
            break;
            
            case 'list_invoice_view_between': 
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[4]);
            break;
            
            case 'edit_invoice': 
                
                $this->varModelObj->ExecuteProcedure($var[5]);
            break;
            
            case 'invoice_status': 
                $this->varModelObj->ListFromTable($var[6]);
            break;
            
            case 'check_invoice_status': 
                $this->varModelObj->ListFromTable($var[7]);
            break;   
            
            case 'select_invoice_pending_data': 
               
                $this->varModelObj->ListFromTable($var[8]);
            break;
            
            case 'cancel_invoice_list': 
               
                $this->varModelObj->UpdateTable($var[9]);
               // $this->varModelObj->UpdateTable($var[10]);
            break;
            case 'list_main_invoice': 
               
               $this->varModelObj->ListFromTable($var[11]);
            break;
            case 'delivery_note_main_id': 
               
               $this->varModelObj->ListFromTable($var[12]);
            break;
             case 'select_delivery_note_main_tbl': 
               
               $this->varModelObj->ListFromTable($var[13]);
            break;
            case 'select_quotation_list': 
               
               $this->varModelObj->CreateDropDown($var[14],'quotation_reference','quotation_reference',$this->v_ctrl_name,'Select Quotation');
            break;
             case 'delete_invoice_list': 
             //  echo $var[15];
                $this->varModelObj->UpdateTable($var[15]);
               
            break;
             case 'select_quotation_list_qt': 
           
             // echo $var[16];
               $this->varModelObj->CreateDropDown($var[16],'quotation_number','quotation_number',$this->v_ctrl_name,'Select Quotation');
            break;
            
            case 'add_invoice_qt': 
             // echo $var[17];
               $this->varModelObj->ExecuteProcedure($var[17]);
            break;
            
            case 'check_avl_qt': 
            
               $this->varModelObj->ListFromTable($var[18]);
            break;
            
            case 'change_delivery_qty': 
             
               $this->varModelObj->UpdateTable($var[19]);
               
               $this->varModelObj->UpdateTable($var[26]);
               // echo $var[19];
            break;
            
            case 'cancel_invoice_child_data':
               $this->varModelObj->UpdateTable($var[20]); 
            break;
            
            
            case 'delete_quotation_no_child_tbl':
               $this->varModelObj->UpdateTable($var[21]); 
            break;
            
            case 'list_of_cancel_invoice_view':
               $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[22]); 
            break;
            
            case 'list_cancel_invoice_view_between':
               $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[23]); 
            break;
            
             case 'add_invoice_quotation':
                
               $this->varModelObj->ExecuteProcedure($var[24]); 
            break;
            
            
             case 'delete_invoice_list_item':
                
               $this->varModelObj->UpdateTable($var[25]); 
            break;
            
             case 'change_net_balance':
                
               $this->varModelObj->UpdateTable($var[26]); 
            break;
            
            case 'select_total_discount_amount': 
              
               $this->varModelObj->ListFromTable($var[27]);
            break;
            
            
            
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new invoiceController();
$obj->RequestAccept($obj->actionevents);
?>