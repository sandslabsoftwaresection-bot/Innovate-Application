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
        
         $this->product_master_id = $_POST['v_product_master_id'];
        $this->product_name = $_POST['v_product_name'];
        $this->product_unit_id = $_POST['v_product_unit_id'];
        $this->product_unit_name =  $this->varDBConnection->real_escape_string($_POST['v_product_unit_name']);
        $this->unit_rate = $_POST['v_unit_rate'];
        $this->product_description = $this->varDBConnection->real_escape_string($_POST['v_product_description']);
       
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "CALL proc_add_product_master( '".$this->product_name."' ,'".$this->product_unit_id."','".$this->product_unit_name."','".$this->unit_rate."','".$this->product_description."',@msg)";
         
        $array[1] = "SELECT * from product_master_tbl";
        
         $array[2] = "DELETE from product_master_tbl WHERE `product_id`='".$this->product_master_id."'";
   
        $array[3] = "CALL proc_edit_product_master('".$this->product_master_id."', '".$this->product_name."' ,'".$this->product_unit_name."','".$this->unit_rate."','".$this->product_description."',@msg)";
        
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            
            case 'generate_master_product': 
              
                $this->varModelObj->ExecuteProcedure($var[0]);
            break;
            
            case 'list_master_product': 
              // echo $var[1];
                $this->varModelObj->ListFromTable($var[1]);
            break;
            case 'cancel_product_master_item': 
              echo $var[2];
             
                $this->varModelObj->DeleteRow($var[2]);
                
            break;
              case 'edit_master_product': 
              //  echo $var[3];
                $this->varModelObj->ExecuteProcedure($var[3]);
            break;
            
            // case 'list_quotation_view': 
            //     $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[3]);
            // break;
            
            // case 'list_quotation_view_between': 
               
            //     $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[4]);
            // break;
            
           
            
            // case 'quotation_status': 
               
            //     $this->varModelObj->ListFromTable($var[6]);
            // break;
            
            // case 'check_quotation_status': 
               
            //     $this->varModelObj->ListFromTable($var[7]);
            // break;   
            
            // case 'select_quotation_pending_data': 
               
            //     $this->varModelObj->ListFromTable($var[8]);
            // break;
            
            // case 'cancel_quotation_list': 
            //   //echo $var[9];
            //   //echo $var[10];
            //     $this->varModelObj->DeleteRow($var[9]);
            //     $this->varModelObj->DeleteRow($var[10]);
            // break;
            
            // case 'select_company_name': 
               
            //     $this->varModelObj->CreateDropDown($var[11],'company_id','company_name',$this->ctrl_name,'Select Company');
            // break;
            
            // case 'select_company_details': 
               
            //     $this->varModelObj->ListFromTable($var[12]);
            // break;
            
            // case 'select_company_project': 
            //  // echo $var[13];
            //     $this->varModelObj->CreateDropDown($var[13],'project_main_id','project_main_name',$this->ctrl_name,'Select Project');
            // break;
            
            //   case 'select_subject': 
            //   //echo $var[13];
            //     $this->varModelObj->CreateDropDown($var[14],'subject_id','subject',$this->ctrl_name,'Select Introduction');
            // break;
            
            //  case 'cancel_quotation_item': 
            
            //     $this->varModelObj->DeleteRow($var[15]);
            // break;
            
            // case 'select_subject_details': 
              
            //     $this->varModelObj->ListFromTable($var[16]);
            // break;
            
            //   case 'list_of_cancel_quotations': 
                 
            //     $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[17]);
            // break;
            
            // case 'list_of_cancel_quotation_view_between': 
               
            //     $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[18]);
            // break;
            
            
          
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new quotationController();
$obj->RequestAccept($obj->actionevents);
?>