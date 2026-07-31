<?php

require ('../../model/common/common_functions.php');

class ReceiptsController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$ctrl_name,$current_date;
        public $txt_receipt_no,$rdo_receipt_payment_type,$txt_receipt_date,$txt_thanks,$txt_receipt_sum,$txt_receipt_method,$txt_receipt_bank,$created_id,$created_name;
        public $txt_receipt_settelment_invoice,$txt_receipt_received_by,$txt_receipt_varified_by,$txt_receipt_amount,$txt_receipt_cheque_date,$from_date,$to_date,$txt_thanks_id;
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        
        $this->txt_receipt_no = $_POST['txt_receipt_no'];
        $this->rdo_receipt_payment_type = $this->varDBConnection->real_escape_string($_POST['rdo_receipt_payment_type']);
        $this->txt_receipt_date = $_POST['txt_receipt_date'].' '.$this->current_date;
        $this->txt_thanks = $this->varDBConnection->real_escape_string($_POST['txt_thanks']);
        $this->txt_thanks_id = $this->varDBConnection->real_escape_string($_POST['txt_thanks_id']);
        $this->txt_receipt_sum = $this->varDBConnection->real_escape_string($_POST['txt_receipt_sum']);
        $this->txt_receipt_method = $this->varDBConnection->real_escape_string($_POST['txt_receipt_method']);
        $this->txt_receipt_bank = $_POST['txt_receipt_bank'];
        
        $this->txt_receipt_settelment_invoice = $this->varDBConnection->real_escape_string($_POST['txt_receipt_settelment_invoice']);
        $this->txt_receipt_received_by = $this->varDBConnection->real_escape_string($_POST['txt_receipt_received_by']);
        $this->txt_receipt_varified_by = $this->varDBConnection->real_escape_string($_POST['txt_receipt_varified_by']);
        
        $this->txt_receipt_amount = $_POST['txt_receipt_amount'];
        $this->txt_receipt_cheque_date = $_POST['txt_receipt_cheque_date'];
        $this->txt_receipt_cheque_date = $_POST['txt_receipt_cheque_date'];
        $this->created_id = $_POST['txt_created_by_id'];
        $this->created_name = $_POST['txt_created_by_name'];
        $this->discription = $_POST['txt_description'];
        
         $this->from_date = $_POST['from_date'];
         $this->to_date = $_POST['to_date'];
        
        
        if(trim($this->created_id==''))
        {
            $this->created_id=0;
        }
        
        $this->receipt_id = $_POST['v_receipts_id'];
      
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
   
       $array[0] = "CALL proc_add_receipt_v2( '".$this->rdo_receipt_payment_type."','".$this->txt_receipt_date."','".$this->txt_thanks."','".$this->txt_thanks_id."','".$this->txt_receipt_sum."','".$this->txt_receipt_method."','".$this->txt_receipt_bank."','".$this->txt_receipt_cheque_date."','".$this->txt_receipt_settelment_invoice."','".$this->txt_receipt_received_by."', '".$this->txt_receipt_varified_by."','".$this->txt_receipt_amount."',".$this->created_id.",'".$this->created_name."','".$this->discription."',@msg)";
        $array[1] ="select `discription`, `receipts_id`, `receipts_no`, `receipts_method`, FormatDate(`receipts_date`) as receipts_date, `received_from`,received_from_id, `sum_of_amount`, `cheque_no`, `bank`, `cheque_date`, `invoice_id`, `received_by`, `verified_by`, `total_amount`, `receipt_created_date`, `receipt_status`, `receipt_created_by_id`, `receipt_created_by_name` from receipts where YEAR(receipts_date)=YEAR(CURDATE()) and receipt_status != 'Cancelled'";
        $array[2] = "CALL proc_edit_receipt_v1( '".$this->rdo_receipt_payment_type."','".$this->txt_receipt_date."','".$this->txt_thanks."','".$this->txt_thanks_id."','".$this->txt_receipt_sum."','".$this->txt_receipt_method."','".$this->txt_receipt_bank."','".$this->txt_receipt_cheque_date."','".$this->txt_receipt_settelment_invoice."','".$this->txt_receipt_received_by."', '".$this->txt_receipt_varified_by."','".$this->txt_receipt_amount."',".$this->created_id.",'".$this->created_name."','".trim($this->txt_receipt_no)."', '".$this->discription."',@msg)";
        $array[3]= "SELECT company_id,company_name,contact_phone,city,fax FROM company_details where  status='Active' " ;
        $array[4] ="select `receipts_id`, `receipts_no`, `receipts_method`, FormatDate(`receipts_date`) as receipts_date, `received_from`, `sum_of_amount`, `cheque_no`, `bank`, `cheque_date`, `invoice_id`, `received_by`, `verified_by`, `total_amount`, `receipt_created_date`, `receipt_status`, `receipt_created_by_id`, `receipt_created_by_name` from receipts where DATE_FORMAT(receipts_date,'%Y-%m-%d') between DATE_FORMAT('".$this->from_date."','%Y-%m-%d') and DATE_FORMAT('".$this->to_date."','%Y-%m-%d')";
        $array[5] ="UPDATE receipts SET receipt_status='Cancelled' WHERE receipts_id=".$this->receipt_id;
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_receipts':
             
                $this->varModelObj->ExecuteProcedure($var[0]);
                
            break;
            
            case 'list_receipt_view':
              
                $this->varModelObj->ListFromTable($var[1]);
            break;
            
             case 'edit_receipts':
              echo $var[2];
                $this->varModelObj->ExecuteProcedure($var[2]);
            break;
            
             case 'select_company_name':
            
                $this->varModelObj->CreateDropDown($var[3],'company_id','company_name',$this->ctrl_name,'Select Company');
            break;
            
             case 'list_receipt_view_between':
             
                $this->varModelObj->ListFromTable($var[4]);
            break;
            
            
            case 'delete_receipt':
                echo $var[5];
                $this->varModelObj->UpdateTable($var[5]);
            break;
            
          
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new ReceiptsController();
$obj->RequestAccept($obj->actionevents);
?>