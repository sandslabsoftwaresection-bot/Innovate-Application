<?php

require ('../../model/common/common_functions.php');

class quotationController
{
        var $varModelObj,$varDBConnection;
        public  $actionevents,$v_ctrl_name,$quotation_number, $quotation_date, $company_name, $po_box, $telephone_no;
        public $fax, $address, $attn, $quotation_reference, $LPO_no, $sub_total, $vat, $total_amount, $received_amount, $balane_in_due;
        public $received_by_id, $received_by_name, $quotation_created_date, $quotation_status, $description;
        public $quotation_child_id, $quotation_main_id, $quantity, $unit, $rate, $amount, $default_date,$discount_percentage,$amt_after_discount,$tax_percentage,$net_amount;
        public $company_id,$project_id,$project_name,$v_subject_id,$v_introduction_name,$v_introduction_id,$main_description,$subject;
        public $v_quotation_sub_total,$from_date,$to_date;
       
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        
        $this->quotation_number = $_POST['v_quotation_no'];
        $this->quotation_date = $_POST['v_quotation_date'];
        $this->company_name = $_POST['v_quotation_company_name'];
        $this->company_name = $this->varDBConnection->real_escape_string(($this->company_name));
        $this->po_box = $this->varDBConnection->real_escape_string($_POST['v_quotation_po_box']);
        $this->telephone_no = $_POST['v_quotation_contact_no'];
        $this->fax = $_POST['v_quotation_fax'];
        $this->attn = $this->varDBConnection->real_escape_string($_POST['v_quotation_attn']);
        $this->quotation_reference = $this->varDBConnection->real_escape_string($_POST['v_quotation_ref']);
        $this->LPO_no = $_POST['v_quotation_lpo_no'];
        $this->sub_total = $_POST['v_quotation_sub_total'];
        $this->vat = $_POST['v_quotation_vat'];
        $this->total_amount = $_POST['v_quotation_total_amount'];
        $this->balane_in_due = $_POST['v_quotation_balance_due'];
        $this->received_amount = $_POST['v_quotation_received_amount'];
        $this->received_by_id = $_POST['received_by_id'];
        $this->received_by_name = $this->varDBConnection->real_escape_string( $_POST['received_by_name']);
        $this->quotation_created_date = $_POST['quotation_created_date'];
        $this->main_description =$this->varDBConnection->real_escape_string ($_POST['v_quotation_all_description']);
        $this->subject =$this->varDBConnection->real_escape_string ($_POST['v_quotation_subject']);
        
        $this->description = $this->varDBConnection->real_escape_string( $_POST['v_quotation_description']);
        $this->quantity = $_POST['v_quotation_quantity'];
        $this->unit = $_POST['v_quotation_unit'];
        $this->rate = $_POST['v_quotation_rate'];
        $this->amount = $_POST['v_quotation_amount'];
        
        $this->from_date = $_POST['v_quotation_from_date'];
        $this->to_date = $_POST['v_quotation_to_date'];
        
        $this->quotation_child_id = $_POST['v_quotation_child_id'];
        $this->company_id = $_POST['v_company_id'];
        $this->project_id = $_POST['v_project_id'];
        $this->project_name = $_POST['v_project_name'];
        
        $this->discount_percentage = $_POST['v_discount_percentage'];
        $this->amt_after_discount = $_POST['v_amt_after_discount'];
        $this->tax_percentage = $_POST['v_tax_percentage'];
        $this->net_amount = $_POST['v_net_amount'];
        $this->v_subject_id = $_POST['v_subject_id'];
        $this->v_introduction_name = $_POST['v_introduction_name'];
        $this->v_introduction_id = $_POST['v_introduction_id'];
        $this->v_quotation_sub_total = $_POST['v_quotation_sub_total'];
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "CALL proc_add_quotation_main_list( '".$this->quotation_date.' '.$this->current_date."','".$this->company_name."','".$this->company_id."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->quotation_number."','".$this->subject."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->rate."','".$this->amount."','".$this->project_id."','".$this->project_name."','".$this->discount_percentage."','".$this->amt_after_discount."','".$this->tax_percentage."','".$this->net_amount."','".$this->v_introduction_id."','".$this->v_introduction_name."',@msg)";
        
        $array[1] = "CALL proc_list_quotation('".$this->quotation_number."',@msg)";
          
        $array[2] = "CALL proc_generate_quotation( '".$this->quotation_date.' '.$this->current_date."','".$this->company_name."','".$this->company_id."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->subject."','".$this->quotation_number."', '".$this->main_description."','".$this->project_id."','".$this->project_name."','".$this->sub_total."','".$this->v_introduction_id."','".$this->v_introduction_name."',@msg)";
      
        $array[3] = "CALL proc_view_quotation_list(@msg)";
        
        $array[4] = "CALL proc_view_quotation_list_between('".$this->from_date."','".$this->to_date."',@msg)";
        
        $array[5] = "CALL proc_edit_quotation_main_list( '".$this->quotation_date.' '.$this->current_date."','".$this->company_name."','".$this->company_id."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->subject."','".$this->quotation_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->rate."','".$this->amount."','".$this->main_description."','". $this->quotation_child_id."','".$this->project_id."','".$this->project_name."','".$this->discount_percentage."','".$this->amt_after_discount."','".$this->tax_percentage."','".$this->net_amount."','".$this->v_introduction_id."','".$this->v_introduction_name."','".$this->v_quotation_sub_total."',@msg)";
        
        $array[6] = "SELECT quotation_status from quotation_main_tbl WHERE quotation_number='".$this->quotation_number."' ";
        
        $array[7] = "SELECT count(quotation_status) as quotation_count,quotation_main_id,quotation_number FROM quotation_main_tbl WHERE quotation_status='Pending' ";
        
        $array[8] = " SELECT `quotation_main_id`, `quotation_number`, DATE(quotation_date) as `quotation_date`, `company_name`,`company_id`,`project_id`,`project_name`, `po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `subject`, `received_by_id`, `received_by_name`, `quotation_created_date`, `quotation_status`, `description`,introduction_id,introduction_name FROM  quotation_main_tbl WHERE quotation_status='Pending' ";
        
       $array[9] = "UPDATE quotation_main_tbl SET quotation_status='Cancelled' WHERE quotation_number='".$this->quotation_number."'";
        
        $array[10] = "UPDATE quotation_child_tbl SET quotation_status='Cancelled' WHERE quotation_no='".$this->quotation_number."'";
        
        $array[11]= "SELECT company_id,company_name FROM company_details where status='Active' " ;
        
        $array[12]= "SELECT company_id,company_name,contact_phone,city,fax,contact_person,contact_address_1 FROM company_details where company_id= ".$this->company_id." and status='Active' " ;
        
        $array[13]= "SELECT project_main_id,project_main_name from project_main_table where company_id=".$this->company_id." and project_status='Active' ";
        
         $array[14]="select * from subject_details where status='Active'";
         
         $array[15] = "DELETE from quotation_child_tbl WHERE quotation_child_id='".$this->quotation_child_id."'";
         
         $array[16] = "select * from subject_details WHERE subject_id='".$this->v_subject_id."'";
         
         $array[17] = "CALL proc_view_cancel_quotation_list(@msg)";
        
         $array[18] = "CALL proc_view_cancel_quotation_list_between('".$this->from_date."','".$this->to_date."',@msg)";
        
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_quotation':
              // echo $var[0];
                $this->varModelObj->ExecuteProcedure($var[0]);
            break;
            
            case 'list_quotation': 
              // echo $var[1];
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[1]);
            break;
            
            case 'generate_quotation': 
              
                $this->varModelObj->ExecuteProcedure($var[2]);
            break;
            
            case 'list_quotation_view': 
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[3]);
            break;
            
            case 'list_quotation_view_between': 
               
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[4]);
            break;
            
            case 'edit_quotation': 
                echo $var[5];
                $this->varModelObj->ExecuteProcedure($var[5]);
            break;
            
            case 'quotation_status': 
               
                $this->varModelObj->ListFromTable($var[6]);
            break;
            
            case 'check_quotation_status': 
               
                $this->varModelObj->ListFromTable($var[7]);
            break;   
            
            case 'select_quotation_pending_data': 
               
                $this->varModelObj->ListFromTable($var[8]);
            break;
            
            case 'cancel_quotation_list': 
               //echo $var[9];
               //echo $var[10];
                $this->varModelObj->DeleteRow($var[9]);
                $this->varModelObj->DeleteRow($var[10]);
            break;
            
            case 'select_company_name': 
               
                $this->varModelObj->CreateDropDown($var[11],'company_id','company_name',$this->ctrl_name,'Select Company');
            break;
            
            case 'select_company_details': 
               
                $this->varModelObj->ListFromTable($var[12]);
            break;
            
            case 'select_company_project': 
             // echo $var[13];
                $this->varModelObj->CreateDropDown($var[13],'project_main_id','project_main_name',$this->ctrl_name,'Select Project');
            break;
            
              case 'select_subject': 
               //echo $var[13];
                $this->varModelObj->CreateDropDown($var[14],'subject_id','subject',$this->ctrl_name,'Select Introduction');
            break;
            
             case 'cancel_quotation_item': 
            
                $this->varModelObj->DeleteRow($var[15]);
            break;
            
            case 'select_subject_details': 
              
                $this->varModelObj->ListFromTable($var[16]);
            break;
            
              case 'list_of_cancel_quotations': 
                 
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[17]);
            break;
            
            case 'list_of_cancel_quotation_view_between': 
               
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[18]);
            break;
            
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new quotationController();
$obj->RequestAccept($obj->actionevents);
?>