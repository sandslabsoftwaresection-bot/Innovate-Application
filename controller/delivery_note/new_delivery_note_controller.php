<?php

require ('../../model/common/common_functions.php');

class delivery_noteController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$delivery_note_number, $delivery_note_date, $company_name, $po_box, $telephone_no;
        public $fax, $address, $attn, $quotation_reference, $LPO_no, $sub_total, $vat, $total_amount, $received_amount, $balane_in_due;
        public $received_by_id, $received_by_name, $delivery_note_created_date, $delivery_note_status, $description;
        public $delivery_note_child_id, $delivery_note_main_id, $rate, $amount, $default_date;
        public $dev_not_no, $dis,$item_remarks,$v_delivery_note_company_id,$v_delivery_note_project_name,$v_delivery_note_project_id,$v_project_id,$to_date,$from_date,$v_req_qty,$v_delivered_qty;
        public $v_net_amount,$v_vat_percentage,$v_discount_amount,$v_discount_precentage,$v_amount,$v_rate,$v_quotation_no,$v_quotation_child_id,$unit,$quantity,$main_description;
        public $v_provide_name,$v_received_by,$v_notes;
        
    function __construct()
	{
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        $this->delivery_note_number = $_POST['v_delivery_note_no'];
        $this->delivery_note_date = $_POST['v_delivery_note_date'];
        $this->company_name = $_POST['v_delivery_note_company_name'];
        $this->company_name = $this->varDBConnection->real_escape_string(($this->company_name));
        $this->po_box = $this->varDBConnection->real_escape_string($_POST['v_delivery_note_po_box']);
        $this->telephone_no = $_POST['v_delivery_note_contact_no'];
        $this->fax = $_POST['v_delivery_note_fax'];
        $this->attn = $this->varDBConnection->real_escape_string($_POST['v_delivery_note_attn']);
        $this->quotation_reference = $this->varDBConnection->real_escape_string($_POST['v_delivery_note_quotation_ref']);
        $this->LPO_no = $this->varDBConnection->real_escape_string($_POST['v_delivery_note_lpo_no']);
        $this->received_by_id = $_POST['received_by_id'];
        $this->received_by_name = $_POST['received_by_name'];
        $this->delivery_note_created_date = $_POST['delivery_note_created_date'];
        $this->main_description = $this->varDBConnection->real_escape_string($_POST['v_delivery_note_all_description']);
        $this->description = $this->varDBConnection->real_escape_string($_POST['v_delivery_note_description']);
        $this->quantity = $_POST['v_delivery_note_quantity'];
        $this->unit = $_POST['v_delivery_note_unit'];
        $this->v_quotation_child_id = $_POST['v_quotation_child_id'];
        $this->v_quotation_no = $_POST['v_quotation_no'];
        $this->v_rate = $_POST['v_rate'];
        $this->v_amount = $_POST['v_amount'];
        $this->v_discount_precentage = $_POST['v_discount_precentage'];
        $this->v_discount_amount = $_POST['v_discount_amount'];
        $this->v_vat_percentage = $_POST['v_vat_percentage'];
        $this->v_net_amount = $_POST['v_net_amount'];
        $this->v_delivered_qty = $_POST['v_delivered_qty'];
        $this->v_req_qty = $_POST['v_req_qty'];
        $this->from_date = $_POST['v_delivery_note_from_date'];
        $this->to_date = $_POST['v_delivery_note_to_date'];
        $this->delivery_note_child_id = $_POST['v_delivery_note_child_id'];
        $this->v_project_id = $_POST['v_project_id'];
        $this->v_delivery_note_project_id = $_POST['v_delivery_note_project_id'];
        $this->v_delivery_note_project_name = $_POST['v_delivery_note_project_name'];
        $this->v_delivery_note_company_id = $_POST['v_delivery_note_company_id'];
        $this->v_discount_type = $_POST['v_discount_type'];
        $this->dev_not_no =trim( $_POST['delivery_no'] ); 
        $this->dis = $_POST['dis'] ;
        $this->item_remarks = $_POST['v_item_remarks'] ;
        $this->quotation_child_id = $_POST['v_quotation_child_id'] ;
        $this->v_quotation_no=$_POST['v_quotation_no'];
        
        $this->v_provide_name = $_POST['v_provide_name'] ;
        $this->v_received_by = $_POST['v_received_by'] ;
        $this->v_notes = $_POST['v_notes'] ;
    }

    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "CALL proc_add_delivery_note_main_list_v1( '".$this->delivery_note_date.' '.$this->current_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->delivery_note_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->v_quotation_child_id."','".$this->v_quotation_no."','".$this->v_rate."','".$this->v_amount."','".$this->v_discount_precentage."','".$this->v_discount_amount."','".$this->v_vat_percentage."','".$this->v_net_amount."','".$this->v_req_qty."','". $this->v_delivery_note_company_id."','". $this->v_delivery_note_project_id."','". $this->v_delivery_note_project_name."','".$this->v_discount_type."',@msg)";
        
        $array[1] = "CALL proc_list_delivery_note('".$this->delivery_note_number."',@msg)";
          
        $array[2] = "CALL proc_generate_delivery_note1('".$this->delivery_note_number."','".$this->main_description."','". $this->v_notes."','".$this->v_provide_name."','".$this->v_received_by."',@msg)";
      
        $array[3] = "CALL proc_view_delivery_note_list1(@msg)";
        
        $array[4] = "CALL proc_view_delivery_note_list_between('".$this->from_date."','".$this->to_date."',@msg)";
        
     // $array[5] = "CALL proc_edit_delivery_note_main_list( '".$this->delivery_note_date.' '.$this->current_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->delivery_note_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->main_description."','". $this->delivery_note_child_id."',@msg)";
        
        $array[5] = "CALL proc_edit_delivery_note_main_list1( '".$this->delivery_note_date.' '.$this->current_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->delivery_note_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->main_description."','". $this->delivery_note_child_id."','". $this->v_notes."','".$this->v_provide_name."','".$this->v_received_by."',@msg)";
        
        $array[6] = "SELECT delivery_note_status from delivery_note_main_tbl WHERE delivery_note_number='".$this->delivery_note_number."' ";
        
        $array[7] = "SELECT count(delivery_note_status) as delivery_note_count,delivery_note_main_id,delivery_note_number FROM delivery_note_main_tbl WHERE delivery_note_status='Pending' ";
        
        $array[8] = " SELECT `delivery_note_main_id`, `delivery_note_number`, DATE(delivery_note_date) as `delivery_note_date`, `company_name`, `po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `LPO_no`, `received_by_id`, `received_by_name`, `delivery_note_created_date`, `delivery_note_status`, `description` FROM  delivery_note_main_tbl WHERE delivery_note_status='Pending' ";
        
        $array[9] = "UPDATE delivery_note_main_tbl SET delivery_note_status='Cancelled' WHERE delivery_note_number='".$this->delivery_note_number."'";
         
        $array[10] = "UPDATE delivery_note_child_tbl SET quotation_status='Cancelled' WHERE delivery_note_no='".$this->delivery_note_number."'";
        
        $array[11] = "SELECT `quotation_main_id`,`quotation_number` from quotation_main_tbl where project_id='".$this->v_project_id."' and quotation_status!='Cancelled' ";
        
        $array[12] = "UPDATE delivery_note_child_tbl set quantity='".$this->v_delivered_qty."' ,amount='".$this->v_amount."',discount_amount='".$this->v_discount_amount."'	,net_amount='".$this->v_net_amount."',remarks='".$this->item_remarks."' where quotation_child_id= '".$this->v_quotation_child_id."' and delivery_note_no='".$this->delivery_note_number."' ";
       
        $array[14] ="Delete from delivery_note_child_tbl where delivery_note_child_id='".$this->delivery_note_child_id."'";
        
       
        $array[15] ="SELECT COUNT(*) as row_status FROM delivery_note_child_tbl WHERE delivery_note_no='".$this->dev_not_no."' and description='".trim($this->dis)."'";
        
        
        $array[16] ="SELECT COUNT(*) as dn_count_on_quotation FROM `delivery_note_main_tbl` WHERE quotation_reference = '".$this->v_quotation_no."'";
        
        $array[17]="SELECT `delivery_note_main_id`, `delivery_note_number`, DATE_FORMAT(delivery_note_date,'%d-%m-%Y') as `delivery_note_date`, `company_name`, `po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `LPO_no`, `received_by_id`, `received_by_name`, `delivery_note_created_date`, `delivery_note_status`, `description` FROM  delivery_note_main_tbl WHERE quotation_reference='".$this->v_quotation_no."'";
        
        $array[18] = "CALL proc_view_cancel_delivery_note_list(@msg)";
        
        $array[19] = "CALL proc_view_cancel_delivery_note_list_between('".$this->from_date."','".$this->to_date."',@msg)";
        
        $array[20] = "Select Sum(quantity) as total_delivered_qnty from delivery_note_child_tbl where quotation_child_id='".$this->quotation_child_id."'" ;
        
        $array[21] = "CALL proc_list_quotation_new('".$this->v_quotation_no."',@msg)";
        
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_delivery_note':
                // echo $var[0];
                $this->varModelObj->ExecuteProcedure($var[0]);
            break;
            
            case 'list_delivery_note': 
               
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[1]);
            break;
            
            case 'generate_delivery_note': 
                $this->varModelObj->ExecuteProcedure($var[2]);
            break;
            
            case 'list_delivery_note_view': 
                //echo $var[3];
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[3]);
            break;
            
            case 'list_delivery_note_view_between': 
                //echo $var[4];
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[4]);
            break;
            
            
            case 'list_quotation': 
                //echo $var[21];
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[21]);
            break;
            
            
            
            
            case 'edit_delivery_note': 
                //echo $var[5];
                $this->varModelObj->ExecuteProcedure($var[5]);
            break;
            
            case 'delivery_note_status': 
               
                $this->varModelObj->ListFromTable($var[6]);
            break;
            
            case 'check_delivery_note_status': 
               
                $this->varModelObj->ListFromTable($var[7]);
            break;   
            
            case 'select_delivery_note_pending_data': 
               
                $this->varModelObj->ListFromTable($var[8]);
            break;
            
            case 'cancel_delivery_note_list': 
               
                $this->varModelObj->UpdateTable($var[9]);
                $this->varModelObj->UpdateTable($var[10]);
            break;
            
            case 'select_quotation_list': 
                  
                  $this->varModelObj->CreateDropDown($var[11],'quotation_main_id','quotation_number',$this->ctrl_name,'Select Quotation');
               
            break;
            
              case 'change_delivery_qty': 
               
                $this->varModelObj->UpdateTable($var[12]);
              
            break;
            
            case 'change_delivery_qty_edit': 
                
                $this->varModelObj->UpdateTable($var[13]);
              
            break;
            
            case 'chk_delivered_qnty': 
                
                $this->varModelObj->ListFromTable($var[20]);
              
            break;
            
            
            case 'delete_delivery_item': 
                
                $this->varModelObj->UpdateTable($var[14]);
              
            break;
            case 'check_avl': 
                //echo $var[15];
                $this->varModelObj->ListFromTable($var[15]);
              
            break;
             case 'count_on_quotation': 
              
                $this->varModelObj->ListFromTable($var[16]);
              
            break;
            
          
          
           case 'list_delivery_note_view_for_quotation': 
               //echo $var[17];
                $this->varModelObj->ListFromTable($var[17]);
              
            break;
            
            case 'list_delivery_note_cancel_view': 
                //echo $var[3];
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[18]);
            break;
            
            case 'list_delivery_note_cancel_view_between': 
                //echo $var[4];
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[19]);
            break;
            
            
            
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new delivery_noteController();
$obj->RequestAccept($obj->actionevents);
?>