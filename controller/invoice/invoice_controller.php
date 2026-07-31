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
        public $v_discount_precentage,$radioValue,$v_balance_in_due,$v_invoice_radio,$v_invoice_child_id, $v_array_table_data,$v_quotation_id;
        
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
		
		if (isset($_POST['v_net_total_perc_due'])) {
          $this->v_net_total_perc_due = $_POST['v_net_total_perc_due'];
        }
		
		if (isset($_POST['v_txt_qty_change'])) {
          $this->v_txt_qty_change = $_POST['v_txt_qty_change'];
        }
		
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        
        $this->v_quotation_child_id = $_POST['v_quotation_child_id'] ?? null;
        $this->v_net_total_due = $_POST['v_net_total_due'] ?? null;
          
        if (isset($_POST['v_array_table_data'])) {
          $this->v_array_table_data = $_POST['v_array_table_data'];
        }
        if (isset($_POST['v_quotation_id'])) {
          $this->v_quotation_id = $_POST['v_quotation_id'];
        } 
         if (isset($_POST['v_interim_real_no'])) {
          $this->v_interim_real_no = $_POST['v_interim_real_no'];
        }    
        
         
         
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "CALL proc_add_invoice_main_list( '".$this->invoice_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->invoice_number."','".$this->delivery_note_no."','".$this->v_project_id."','".$this->v_project_name."','".$this->v_invoice_company_id."','".$this->v_invoice_retention_amount."','".$this->v_invoice_previous_bill_amount."', @msg)";
        
        $array[1] = "CALL proc_list_invoice('".$this->invoice_number."',@msg)";
          
        $array[2] = "CALL proc_generate_invoice('".$this->invoice_number."','". $this->sub_total."','".$this->vat."','".$this->total_amount."','".$this->received_amount."','".$this->balane_in_due."','".$this->main_description."','".$this->v_invoice_retention_amount."','".$this->v_invoice_previous_bill_amount."','".$this->invoice_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->v_project_id."','".$this->v_project_name."','".$this->v_invoice_company_id."',@msg)";
      
        $array[3] = "CALL proc_view_invoice_list(@msg)";
        
        $array[4] = "CALL proc_view_invoice_list_between('".$this->from_date."','".$this->to_date."',@msg)";
        
        $array[5] = "CALL proc_edit_invoice_main_list( '".$this->invoice_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->invoice_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->rate."','".$this->amount."','". $this->sub_total."','".$this->vat."','".$this->total_amount."','".$this->received_amount."','".$this->balane_in_due."','".$this->main_description."','". $this->v_invoice_child_id."','".$this->v_invoice_retention_amount."','".$this->v_invoice_previous_bill_amount."',@msg)";
        
        $array[6] = "SELECT invoice_status from invoice_main_tbl WHERE invoice_number='".$this->invoice_number."' ";
        
        $array[7] = "SELECT count(invoice_status) as invoice_count,invoice_main_id,invoice_number FROM invoice_main_tbl WHERE invoice_status='Pending' ";
        
        $array[8] = " SELECT `invoice_main_id`, `invoice_number`, DATE(invoice_date) as `invoice_date`, `company_name`, `po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `LPO_no`, `sub_total`, `vat`, `total_amount`, `received_amount`, `balane_in_due`, `received_by_id`, `received_by_name`, `invoice_created_date`, `invoice_status`, `description`,company_id,project_id,project_name,invoice_against FROM  invoice_main_tbl WHERE invoice_status='Pending' ";
        
        $array[9] = "UPDATE  invoice_main_tbl SET invoice_status='Cancelled' WHERE invoice_number='".$this->invoice_number."'";
        
        $array[10] = "UPDATE  invoice_child_tbl SET quotation_status='Cancelled' WHERE invoice_no='".$this->invoice_number."'";
        
        $array[11] = "SELECT `delivery_note_main_id`, `delivery_note_number`, `delivery_note_date`, `company_name`, `po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `LPO_no`, `sub_total`, `received_by_id`, `received_by_name`, `delivery_note_created_date`, `delivery_note_status`, `description` from `delivery_note_main_tbl` where quotation_reference='".$this->v_quotation_no."' ";        
       
        $array[14]= "Select DISTINCT quotation_reference from delivery_note_main_tbl where project_id='".$this->v_project_id."' and  quotation_status !='Cancelled'";
        
        $array[15]= "DELETE from invoice_child_tbl WHERE invoice_no='".$this->invoice_number."' and delivery_note_no= '".$this->delivery_note_no."'";
        
        $array[16]= "Select DISTINCT quotation_number  from quotation_main_tbl a where project_id='".$this->v_project_id."' and  quotation_status !='Cancelled' and approved_status='Approved' and ((select sum(`quantity`)-sum(`supplied_qty`) from quotation_child_tbl where quotation_no= a.quotation_number)>0)";
        
        $array[17] = "CALL proc_add_invoice_main_list_quotation( '".$this->invoice_date.' '.$this->current_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->invoice_number."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->v_quotation_child_id."','".$this->v_quotation_no."','".$this->v_rate."','".$this->v_amount."','".$this->v_discount_precentage."','".$this->v_discount_amount."','".$this->v_vat_percentage."','".$this->v_net_amount."','".$this->v_req_qty."','". $this->v_invoice_company_id."','". $this->v_invoice_project_id."','". $this->v_invoice_project_name."',@msg)";
        
        $array[18] ="SELECT COUNT(*) as row_status FROM invoice_child_tbl WHERE invoice_no='".$this->invoice_number."' and description='".trim($this->dis)."'";
        
        $array[19] = "UPDATE invoice_child_tbl set quantity='".$this->v_delivered_qty."' ,amount='".$this->v_amount."',discount_amount='".$this->v_discount_amount."',net_amount='".$this->v_net_amount."',description='".$this->description."'  where invoice_child_id= '".$this->v_quotation_child_id."' and invoice_no='".$this->invoice_number."' ";
       
        $array[20] = "DELETE from invoice_child_tbl WHERE invoice_no='".$this->invoice_number."' and invoice_child_id='".$this->v_invoice_child_id."'";
        
        $array[21] = "DELETE from invoice_child_tbl WHERE invoice_no='".$this->invoice_number."' ";
        
        $array[22] = "CALL proc_view_cancel_invoice_list(@msg)";
        
        $array[23] = "CALL proc_view_cancel_invoice_list_between('".$this->from_date."','".$this->to_date."',@msg)";
        
        $array[24] = "CALL proc_add_invoice_main_list_qt( '".$this->invoice_date.' '.$this->current_date."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->LPO_no."','".$this->invoice_number."','". $this->v_invoice_company_id."','". $this->v_invoice_project_id."','". $this->v_invoice_project_name."','".$this->v_invoice_radio."',@msg)";
        
        $array[25] = "DELETE from invoice_child_tbl WHERE invoice_no='".$this->invoice_number."' and invoice_child_id='".$this->v_invoice_child_id."'";
        
        $array[26] = "UPDATE invoice_main_tbl set balane_in_due='".$this->v_balance_in_due."'  where  invoice_number='".$this->invoice_number."' ";
       
	   // $array[27] = "UPDATE quotation_child_tbl SET supplied_amount='".$this->v_net_total_perc_due."'  WHERE  quotation_child_id='".$this->v_quotation_child_id."' ";
        
	//	$array[28] = "UPDATE quotation_child_tbl SET net_amount='".$this->v_net_total_perc_due."', supplied_qty='".$this->v_txt_qty_change."', amount = '".$this->v_net_total_perc_due."'  WHERE  quotation_child_id='".$this->v_quotation_child_id."' ";
		
		$array[29] = "Select quotation_number  from quotation_main_tbl where project_id='".$this->v_project_id."' and  quotation_status !='Cancelled' ";
		$array[30] = "DELETE from intern_payment_child_tbl WHERE invoice_no='".$this->invoice_number."' and invoice_child_id='".$this->v_invoice_child_id."'";
		$array[31] = "SELECT count(invoice_status) as invoice_count,invoice_main_id,invoice_number FROM intern_payment_main_tbl WHERE invoice_status='Pending' ";
		$array[32] = "UPDATE  intern_payment_main_tbl SET invoice_status='Cancelled' WHERE invoice_number='".$this->invoice_number."'";
		$array[33] = "DELETE from intern_payment_child_tbl WHERE invoice_no='".$this->invoice_number."' and invoice_child_id='".$this->v_invoice_child_id."'";
		$array[34]= "Select DISTINCT interim_real_no  from intern_payment_main_tbl a where quotation_reference='".$this->v_quotation_id."' and  invoice_status ='Invoice Generated'";
		$array[35] = "DELETE from intern_payment_child_tbl WHERE invoice_no='".$this->invoice_number."' ";
		$array[36]= "Select DISTINCT intern_app_ref  from invoice_main_tbl a where quotation_reference='".$this->v_quotation_id."' and  invoice_status ='Invoice Generated'";
		$array[37]= "Select DISTINCT intern_app_ref  from invoice_main_tbl a where quotation_reference='".$this->v_quotation_id."' and  invoice_status ='Cancelled'";
		$array[38] = "UPDATE  intern_payment_main_tbl SET quotation_reference='".$this->v_quotation_no."' WHERE invoice_number='".$this->invoice_number."'";
        $array[39] = "CALL ProcessInvoiceRows('".$this->invoice_number."')";
        $array[40] = "select save_status from  invoice_main_tbl WHERE invoice_number='".$this->invoice_number."'";
        $array[41] = "UPDATE invoice_main_tbl set update_status='YES'  where  invoice_number='".$this->invoice_number."' ";
        $array[42] = "UPDATE intern_payment_main_tbl set update_status='YES'  where  interim_real_no ='".$this->v_interim_real_no."' ";
        $array[43] = "INSERT INTO credit_debit_ledger ( `company_id`, `company_name`, `project_id`, `project_name`, `quotation_id`, `quotation_number`, `credit_amount`, `debit_amount`, `invoice_id`, `invoice_number`,tax_content,retention_amount_type,retention_amount,received_amount_type,received_amount,`accounts_date`,account_head)
                        SELECT company_id, company_name, project_id , project_name,'',quotation_reference,'0.000',sub_total-((sub_total * retention_amount_percentage) / 100)-((sub_total * received_amount) / 100),invoice_main_id,invoice_real_no,tax_content,retention_amount_type,retention_amount_percentage,received_amount_type,received_amount,invoice_date,'Received Amount'
                        FROM invoice_main_tbl
                        WHERE invoice_number='".$this->invoice_number."'";
                        
        $array[44] = "UPDATE invoice_main_tbl set approved_status='YES'  where  invoice_number='".$this->invoice_number."' ";
        
        $array[45] = "INSERT INTO credit_debit_ledger ( `company_id`, `company_name`, `project_id`, `project_name`, `quotation_id`, `quotation_number`, `credit_amount`, `debit_amount`, `invoice_id`, `invoice_number`,tax_content,retention_amount_type,retention_amount,received_amount_type,received_amount,`accounts_date`,account_head)
                        SELECT 
                        company_id,
                        company_name,
                        project_id,
                        project_name,
                        '',
                        quotation_reference,
                      
                        0.000,
                        (sub_total * retention_amount_percentage) / 100,  -- debit_amount as numeric
                        invoice_main_id,invoice_real_no,tax_content,retention_amount_type,retention_amount_percentage,received_amount_type,received_amount,invoice_date,
                        'Retention Amount'
                    FROM invoice_main_tbl
                    WHERE invoice_number='".$this->invoice_number."'
                      AND retention_amount_percentage != 0 ";
            
            $array[46] = "INSERT INTO credit_debit_ledger ( `company_id`, `company_name`, `project_id`, `project_name`, `quotation_id`, `quotation_number`, `credit_amount`, `debit_amount`, `invoice_id`, `invoice_number`,tax_content,retention_amount_type,retention_amount,received_amount_type,received_amount,`accounts_date`,account_head)
                        SELECT 
                        company_id,
                        company_name,
                        project_id,
                        project_name,
                        '',
                        quotation_reference,
                        0.000,
                        (sub_total * received_amount) / 100,  -- debit_amount as numeric
                        invoice_main_id,invoice_real_no,tax_content,retention_amount_type,retention_amount_percentage,received_amount_type,received_amount,invoice_date,
                        'Advance Received Amount'
                    FROM invoice_main_tbl
                    WHERE invoice_number='".$this->invoice_number."'
                      AND received_amount != 0 "; 
                      
        $array[47] = "INSERT INTO credit_debit_ledger ( `company_id`, `company_name`, `project_id`, `project_name`, `quotation_id`, `quotation_number`, `credit_amount`, `debit_amount`, `invoice_id`, `invoice_number`,tax_content,retention_amount_type,retention_amount,received_amount_type,received_amount,`accounts_date`,account_head)
                        SELECT company_id, company_name, project_id , project_name,'',quotation_reference,'0.000',(sub_total-((sub_total * retention_amount_percentage) / 100)-((sub_total * received_amount) / 100))*tax_content/100,invoice_main_id,invoice_real_no,tax_content,retention_amount_type,retention_amount_percentage,received_amount_type,received_amount,invoice_date,'Tax Receivable'
                        FROM invoice_main_tbl
                        WHERE invoice_number='".$this->invoice_number."'";              
                       
                        
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
               
                $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[1]);
            break;
            
            case 'generate_invoice': 
               
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
			case 'check_invoice_status_for_intern_app': 
               
                $this->varModelObj->ListFromTable($var[31]);
            break;
            
            case 'select_invoice_pending_data': 
               
                $this->varModelObj->ListFromTable($var[8]);
            break;
            
            case 'cancel_invoice_list': 
               
                $this->varModelObj->UpdateTable($var[9]);
                $retval = $this->varModelObj->ListFromTableReturn($var[40]);
                $decode_data = json_decode($retval, true);
               
                if($decode_data['data'][0]['save_status']!='NotSaved')
                {
                    $this->varModelObj->ExecuteProcedure($var[39]);
                }
                
               // $this->varModelObj->UpdateTable($var[10]);
            break;
			case 'cancel_intern_app_list': 
               
                $this->varModelObj->UpdateTable($var[32]);
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
			case 'select_intern_app_list': 
           
             //echo $var[34];
               $this->varModelObj->CreateDropDown($var[34],'interim_real_no','interim_real_no',$this->v_ctrl_name,'Select Intern Application');
            break;
			case 'select_intern_list': 
           
            //echo $var[36];
               $this->varModelObj->CreateDropDown($var[36],'intern_app_ref','intern_app_ref',$this->v_ctrl_name,'Select Intern Application');
            break;
			case 'select_intern_cancel_list': 
           
            //echo $var[36];
               $this->varModelObj->CreateDropDown($var[37],'intern_app_ref','intern_app_ref',$this->v_ctrl_name,'Select Intern Application');
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
			case 'cancel_intern_app_child_data':
               $this->varModelObj->UpdateTable($var[33]); 
            break;
            
            
            case 'delete_quotation_no_child_tbl':
               $this->varModelObj->UpdateTable($var[21]); 
            break;
            case 'delete_intern_app_child':
			//echo $var[38];
               $this->varModelObj->UpdateTable($var[35]); 
               $this->varModelObj->UpdateTable($var[38]);
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
			case 'delete_invoice_list_intern_payment':
                
               $this->varModelObj->UpdateTable($var[30]); 
            break;
            
             case 'change_net_balance':
                
               $this->varModelObj->UpdateTable($var[26]); 
            break;
             case 'update_invoice_list':
                
               $this->varModelObj->UpdateTable($var[41]);
               $this->varModelObj->UpdateTable($var[42]);
               
            break;
            
             case 'approve_invoice_list':
                
               $this->varModelObj->UpdateTable($var[43]);
               $this->varModelObj->UpdateTable($var[45]);
               $this->varModelObj->UpdateTable($var[46]);
               $this->varModelObj->UpdateTable($var[44]);
               $this->varModelObj->UpdateTable($var[47]);
            break;
            
            
			case 'update_invoice_list_item':
			//echo "update invoice_child_tbl set supplied_amount_pr = '".$this->v_net_total_perc_due."',amount = '".$this->v_net_total_due."',net_amount='".$this->v_net_total_due."'   WHERE  invoice_child_id='".$this->v_invoice_child_id."'";
			
               $this->varModelObj->UpdateTable("update quotation_child_tbl set supplied_amount = supplied_amount + '".$this->v_net_total_perc_due."'  WHERE  quotation_child_id='".$this->v_quotation_child_id."'"); 
               $this->varModelObj->UpdateTable("update invoice_child_tbl set amount = '".$this->v_net_total_due."', purchase_qty=0, net_amount='".$this->v_net_total_due."', purchase_amount_pr= '".$this->v_net_total_perc_due."'  WHERE  invoice_child_id='".$this->v_invoice_child_id."'"); 
            break;
			case 'update_invoice_list_intern_payment':
			//echo "update invoice_child_tbl set supplied_amount_pr = '".$this->v_net_total_perc_due."',amount = '".$this->v_net_total_due."',net_amount='".$this->v_net_total_due."'   WHERE  invoice_child_id='".$this->v_invoice_child_id."'";
			
               //$this->varModelObj->UpdateTable("update quotation_child_tbl set supplied_amount = supplied_amount + '".$this->v_net_total_perc_due."'  WHERE  quotation_child_id='".$this->v_quotation_child_id."'"); 
               $this->varModelObj->UpdateTable("update intern_payment_child_tbl set amount = '".$this->v_net_total_due."', purchase_qty=0, net_amount='".$this->v_net_total_due."', purchase_amount_pr= '".$this->v_net_total_perc_due."'  WHERE  invoice_child_id='".$this->v_invoice_child_id."'"); 
            break;
            
			case 'update_qty_net_invoice_list_item':
               $this->varModelObj->UpdateTable("update quotation_child_tbl set supplied_qty = supplied_qty + '".$this->v_txt_qty_change."'  WHERE  quotation_child_id='".$this->v_quotation_child_id."'"); 
               $this->varModelObj->UpdateTable("update invoice_child_tbl set purchase_qty ='".$this->v_txt_qty_change."',amount = '".$this->v_net_total_due."',net_amount='".$this->v_net_total_due."'    WHERE  invoice_child_id='".$this->v_invoice_child_id."'"); 
            //echo "update invoice_child_tbl set supplied_qty = supplied_qty + '".$this->v_txt_qty_change."',amount = '".$this->v_net_total_due."',net_amount='".$this->v_net_total_due."'    WHERE  invoice_child_id='".$this->v_invoice_child_id."'";
            break;
			case 'update_qty_net_invoice_intern_app':
               //$this->varModelObj->UpdateTable("update quotation_child_tbl set supplied_qty = supplied_qty + '".$this->v_txt_qty_change."'  WHERE  quotation_child_id='".$this->v_quotation_child_id."'"); 
               $this->varModelObj->UpdateTable("update intern_payment_child_tbl set purchase_qty ='".$this->v_txt_qty_change."',amount = '".$this->v_net_total_due."',net_amount='".$this->v_net_total_due."'    WHERE  invoice_child_id='".$this->v_invoice_child_id."'"); 
            //echo "update invoice_child_tbl set supplied_qty = supplied_qty + '".$this->v_txt_qty_change."',amount = '".$this->v_net_total_due."',net_amount='".$this->v_net_total_due."'    WHERE  invoice_child_id='".$this->v_invoice_child_id."'";
            break;
			case 'update_all_invc_prc':
// 			echo " inside percentage".$this->v_array_table_data[0];
			for($i=0;$i<=sizeof($this->v_array_table_data)-1;$i++){
				$this->varModelObj->UpdateTable("update quotation_child_tbl set supplied_amount = supplied_amount + '".$this->v_array_table_data[$i]['discount_precentage']."'  WHERE  quotation_child_id='".$this->v_array_table_data[$i]['quotation_child_id']."'"); 
              	if($this->v_array_table_data[$i]['discount_precentage']!=0){
                    $this->varModelObj->UpdateTable("update invoice_child_tbl set purchase_amount_pr='".$this->v_array_table_data[$i]['discount_precentage']."',net_amount='".$this->v_array_table_data[$i]['net_amount']."', purchase_qty=0   WHERE  invoice_child_id='".$this->v_array_table_data[$i]['invoice_child_id']."'"); 
              	}
              	else{
              	    $this->varModelObj->UpdateTable("update invoice_child_tbl set purchase_amount_pr='".$this->v_array_table_data[$i]['discount_precentage']."',net_amount=0, purchase_qty=0   WHERE  invoice_child_id='".$this->v_array_table_data[$i]['invoice_child_id']."'"); 
              	}
		
			}
			$this->varModelObj->UpdateTable("update invoice_main_tbl set save_status = 'Saved'  WHERE  invoice_number='".$this->v_array_table_data[0]['invoice_no']."'");
			break;
			
			case 'update_all_invc_prc_for_intern_payment':
			    
			//echo " inside percentage".$this->v_array_table_data[0]['discount_precentage'];
			
			for($i=0;$i<=sizeof($this->v_array_table_data)-1;$i++){
			    
			//	$this->varModelObj->UpdateTable("update quotation_child_tbl set supplied_amount = supplied_amount + '".$this->v_array_table_data[$i]['discount_precentage']."'  WHERE  quotation_child_id='".$this->v_array_table_data[$i]['quotation_child_id']."'"); 
              	//echo "update intern_payment_child_tbl set supplied_amount_pr = '".$this->v_array_table_data[$i]['discount_precentage']."', purchase_amount_pr='".$this->v_array_table_data[$i]['discount_precentage']."',amount = '".$this->v_array_table_data[$i]['net_amount']."',net_amount='".$this->v_array_table_data[$i]['net_amount']."', purchase_qty=0   WHERE  invoice_child_id='".$this->v_array_table_data[$i]['invoice_child_id']."'";
        			
        			if($this->v_array_table_data[$i]['discount_precentage']!=0){
        			    
                           $this->varModelObj->UpdateTable("update intern_payment_child_tbl set purchase_amount_pr='".$this->v_array_table_data[$i]['discount_precentage']."',net_amount='".$this->v_array_table_data[$i]['net_amount']."', purchase_qty=0   WHERE  invoice_child_id='".$this->v_array_table_data[$i]['invoice_child_id']."'");
                            $retval = $this->varModelObj->ListFromTableReturn("Select * from invoice_main_tbl where intern_app_ref='".$this->v_array_table_data[$i]['interim_real_no']."' ");
                            $decode_data = json_decode($retval, true);
                            echo "Status :".$decode_data['data'][0]['invoice_status'];
                            if($decode_data['data'][0]['invoice_status']=='Invoice Generated')
                            {
                                $this->varModelObj->UpdateTable("update invoice_child_tbl set purchase_amount_pr='".$this->v_array_table_data[$i]['discount_precentage']."',net_amount='".$this->v_array_table_data[$i]['net_amount']."', purchase_qty=0   WHERE  intern_app_ref='".$this->v_array_table_data[$i]['interim_real_no']."' and quotation_child_id = '".$this->v_array_table_data[$i]['quotation_child_id']."' "); 
                                $this->varModelObj->UpdateTable("update quotation_child_tbl set supplied_amount = supplied_amount + '".$this->v_array_table_data[$i]['change_in_precetage']."'  WHERE  quotation_child_id='".$this->v_array_table_data[$i]['quotation_child_id']."'");
            			        $this->varModelObj->UpdateTable("UPDATE invoice_main_tbl set update_status='NO'  where  intern_app_ref='".$this->v_array_table_data[$i]['interim_real_no']."' ");
            			        $this->varModelObj->UpdateTable("UPDATE intern_payment_main_tbl set update_status='NO'  where  interim_real_no='".$this->v_array_table_data[$i]['interim_real_no']."' ");
                            }
                           
            			   
        			    }
    			    else{
        			        $this->varModelObj->UpdateTable("update intern_payment_child_tbl set purchase_amount_pr='".$this->v_array_table_data[$i]['discount_precentage']."',net_amount=0, purchase_qty=0   WHERE  invoice_child_id='".$this->v_array_table_data[$i]['invoice_child_id']."'"); 
        			        $retval = $this->varModelObj->ListFromTableReturn("Select * from invoice_main_tbl where intern_app_ref='".$this->v_array_table_data[$i]['interim_real_no']."' ");
                            $decode_data = json_decode($retval, true);
                            echo "Status :".$decode_data['data'][0]['invoice_status'];
                            if($decode_data['data'][0]['invoice_status']=='Invoice Generated')
                            {
                                $this->varModelObj->UpdateTable("update invoice_child_tbl set purchase_amount_pr='".$this->v_array_table_data[$i]['discount_precentage']."',net_amount=0, purchase_qty=0   WHERE  intern_app_ref='".$this->v_array_table_data[$i]['interim_real_no']."' and quotation_child_id = '".$this->v_array_table_data[$i]['quotation_child_id']."' "); 
                                $this->varModelObj->UpdateTable("update quotation_child_tbl set supplied_amount = supplied_amount + '".$this->v_array_table_data[$i]['change_in_precetage']."'  WHERE  quotation_child_id='".$this->v_array_table_data[$i]['quotation_child_id']."'");
            			        $this->varModelObj->UpdateTable("UPDATE invoice_main_tbl set update_status='NO'  where  intern_app_ref='".$this->v_array_table_data[$i]['interim_real_no']."' ");
                                $this->varModelObj->UpdateTable("UPDATE intern_payment_main_tbl set update_status='NO'  where  interim_real_no='".$this->v_array_table_data[$i]['interim_real_no']."' ");
                           
                            }
        			          
    			        }
        			    
            			    
			}
			break;
			
			case 'update_all_invc_qty':
			$str='';
			
				 for($i=0;$i<=sizeof($this->v_array_table_data)-1;$i++){
					 
					 $str = "update quotation_child_tbl set supplied_qty = supplied_qty + '".$this->v_array_table_data[$i]['qty_change']."'  WHERE  quotation_child_id='".$this->v_array_table_data[$i]['quotation_child_id']."';";
					 $this->varModelObj->UpdateTable($str);
					 
					 $this->varModelObj->UpdateTable("update invoice_child_tbl set purchase_qty ='".$this->v_array_table_data[$i]['qty_change']."',amount = '".$this->v_array_table_data[$i]['net_amount']."',net_amount='".$this->v_array_table_data[$i]['net_amount']."'    WHERE  invoice_child_id='".$this->v_array_table_data[$i]['invoice_child_id']."'"); 
				 }
			
			//echo  $this->varModelObj->UpdateTable($str); 
			echo $str;
			
			
			break;
			case 'update_all_invc_qty_for_intern_payment':
			//$str='';
			
				 for($i=0;$i<=sizeof($this->v_array_table_data)-1;$i++){
					 
					 //$str = "update quotation_child_tbl set supplied_qty = supplied_qty + '".$this->v_array_table_data[$i]['qty_change']."'  WHERE  quotation_child_id='".$this->v_array_table_data[$i]['quotation_child_id']."';";
					 //$this->varModelObj->UpdateTable($str);
					 
					 $this->varModelObj->UpdateTable("update intern_payment_child_tbl set purchase_qty ='".$this->v_array_table_data[$i]['qty_change']."',amount = '".$this->v_array_table_data[$i]['net_amount']."',net_amount='".$this->v_array_table_data[$i]['net_amount']."'    WHERE  invoice_child_id='".$this->v_array_table_data[$i]['invoice_child_id']."'"); 
				 }
			
			//echo  $this->varModelObj->UpdateTable($str); 
			//echo $str;
			
			
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