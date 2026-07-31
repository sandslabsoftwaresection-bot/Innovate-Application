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
        public $v_quotation_sub_total,$from_date,$to_date,$v_attn;
       
        
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
        $this->company_name = $this->varDBConnection->real_escape_string($_POST['v_quotation_company_name']);
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
        $this->project_name = $this->varDBConnection->real_escape_string($_POST['v_project_name']);
        
        $this->discount_percentage = $_POST['v_discount_percentage'];
        $this->amt_after_discount = $_POST['v_amt_after_discount'];
        $this->tax_percentage = $_POST['v_tax_percentage'];
        $this->net_amount = $_POST['v_net_amount'];
        $this->v_subject_id = $_POST['v_subject_id'];
        $this->v_introduction_name = $this->varDBConnection->real_escape_string($_POST['v_introduction_name']);
        $this->v_introduction_id = $_POST['v_introduction_id'];
        $this->v_quotation_sub_total = $_POST['v_quotation_sub_total'];
        
        $this->product_id = $_POST['v_product_id'];
        $this->product_name = $this->varDBConnection->real_escape_string($_POST['v_product_name']);
        $this->tax_content=$_POST['v_tax_content'];
        $this->product_discount_type=$_POST['v_product_discount_type'];
        $this->product_discount_amount=$_POST['v_product_discount_amount'];
        $this->quotation_net_amount=$_POST['v_quotation_net_amount'];
        $this->discount_type=$_POST['v_discount_type'];
        $this->total_discount=$_POST['v_total_discount'];
        $this->discount_amount=$_POST['v_discount_amount'];
        $this->discount_amount_product=$_POST['v_discount_amount_product'];
        $this->v_quotation_number=$_POST['v_quotation_number'];
        $this->option_select=$_POST['option_select'];
        $this->approved_status = $_POST['v_approved_status'];
       $this->v_attn = $_POST['v_attn'];
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "CALL proc_add_quotation_new_main_list_V1( '".$this->quotation_date.' '.$this->current_date."','".$this->company_name."','".$this->company_id."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->quotation_number."','".$this->subject."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->rate."','".$this->amount."','".$this->project_id."','".$this->project_name."','".$this->tax_content."','".$this->product_discount_type."','".$this->discount_percentage."','".$this->product_discount_amount."','0.000','".$this->net_amount."','".$this->v_introduction_id."','".$this->v_introduction_name."','".$this->product_id."','".$this->product_name."',@msg)";
        
        $array[1] = "CALL proc_list_quotation('".$this->quotation_number."',@msg)";
          
        $array[2] = "CALL proc_generate_quotation_v1( '".$this->quotation_date.' '.$this->current_date."','".$this->company_name."','".$this->company_id."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->subject."','".$this->quotation_number."', '".$this->main_description."','".$this->project_id."','".$this->project_name."','".$this->sub_total."','".$this->v_introduction_id."','".$this->v_introduction_name."','".$this->quotation_net_amount."','".$this->discount_type."','".$this->total_discount."','".$this->discount_amount."',@msg)";
      
        //$array[3] = "CALL proc_view_quotation_list(@msg)";
       // $array[3] = "SELECT `quotation_main_id`, `quotation_number`, FormatDate(quotation_date) as `quotation_date`, `company_name`,`company_id`,`project_id`,`project_name`, `po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `subject`, `sub_total`, `received_by_id`, `received_by_name`, `quotation_created_date`, `quotation_status`,`tax_content`, `discount_amount`,`discount_type`,`total_discount_amount`,`description`,approved_status,`introduction_id`,`introduction_name`,`sub_total` FROM quotation_main_tbl WHERE YEAR(quotation_date)=YEAR(CURDATE()) and quotation_status='Quotation Generated' ORDER BY quotation_main_id DESC";
        $array[3] = "SELECT 
                            q.quotation_main_id,
                            q.quotation_number,
                            FormatDate(q.`quotation_date`) AS `quotation_date`,
                            q.company_name,
                            q.company_id,
                            q.project_id,
                            p.project_number,
                            q.project_name,
                            q.po_box,
                            q.telephone_no,
                            q.fax,
                            q.address,
                            q.attn,
                            q.quotation_reference,
                            q.subject,
                            q.sub_total,
                            q.received_by_id,
                            q.received_by_name,
                            q.quotation_created_date,
                            q.quotation_status,
                            q.tax_content,
                            q.discount_amount,
                            q.discount_type,
                            q.total_discount_amount,
                            q.description,
                            q.approved_status,
                            q.introduction_id,
                            q.introduction_name,
                            q.sub_total
                        FROM quotation_main_tbl q
                        LEFT JOIN project_main_table p 
                               ON q.project_id = p.project_main_id
                        WHERE q.quotation_status = 'Quotation Generated'
                          AND q.quotation_date >= DATE_FORMAT(CURDATE(), '%Y-01-01')
                          AND q.quotation_date <  DATE_FORMAT(CURDATE() + INTERVAL 1 YEAR, '%Y-01-01')
                        ORDER BY q.quotation_main_id DESC;
                        ";

        //$array[4] = "CALL proc_view_quotation_list_between('".$this->from_date."','".$this->to_date."',@msg)";
       // $array[4] = "SELECT `quotation_main_id`, `quotation_number`, DATE_FORMAT(quotation_date,'%d-%m-%Y') as `quotation_date`, `company_name`,`company_id`,`project_id`,`project_name`, approved_status,`po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `subject`, `sub_total`, `received_by_id`, `received_by_name`, `quotation_created_date`, `quotation_status`,`tax_content`, `discount_amount`,`discount_type`,`total_discount_amount`,`description`,`introduction_id`,`introduction_name`,`sub_total` FROM  quotation_main_tbl WHERE DATE_FORMAT(quotation_date,'%y-%m-%d')  BETWEEN DATE('".$this->from_date."') AND DATE('". $this->to_date."') and quotation_status='Quotation Generated'";
        
        $array[5] = "CALL proc_edit_quotation_main_list_v1('". $this->quotation_child_id."','".$this->quotation_date.' '.$this->current_date."','".$this->company_name."','".$this->company_id."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->quotation_reference."','".$this->quotation_number."','".$this->subject."', '".$this->description."','".$this->quantity."','".$this->unit."','".$this->rate."','".$this->amount."','".$this->project_id."','".$this->project_name."','".$this->tax_content."','".$this->product_discount_type."','".$this->discount_percentage."','".$this->product_discount_amount."','0.000','".$this->net_amount."','".$this->v_introduction_id."','".$this->v_introduction_name."','".$this->product_id."','".$this->product_name."','".$this->quotation_net_amount."','".$this->discount_type."','".$this->total_discount."','".$this->discount_amount."','".$this->main_description."','".$this->discount_amount_product."',@msg)";
        
        $array[6] = "SELECT quotation_status from quotation_main_tbl WHERE quotation_number='".$this->quotation_number."' ";
        
        $array[7] = "SELECT count(quotation_status) as quotation_count,quotation_main_id,quotation_number FROM quotation_main_tbl WHERE quotation_status='Pending' ";
        
        $array[8] = " SELECT `quotation_main_id`, `quotation_number`, DATE(quotation_date) as `quotation_date`,`tax_content` ,`company_name`,`company_id`,`project_id`,`project_name`, `po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `subject`, `received_by_id`, `received_by_name`, `quotation_created_date`, `quotation_status`, `description`,introduction_id,introduction_name FROM  quotation_main_tbl WHERE quotation_status='Pending' ";
        
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
        
        $array[19] = "select * from product_master_tbl where `product_id`='".$this->product_id."'";
        
        $array[20] = "Select * from project_main_table where project_main_id='".$this->project_id."'";
        
        $array[21] = "UPDATE  quotation_main_tbl SET approved_status='Approved' WHERE quotation_number='".$this->v_quotation_number."'";
        
        $array[22] = "UPDATE  quotation_main_tbl SET approved_status='Pending' WHERE quotation_number='".$this->v_quotation_number."'";
        
        $array[23] = "UPDATE  company_details SET contact_person='".$this->v_attn."' WHERE company_id='".$this->company_id."'";
        
        $array[24] = "Select q.`quotation_main_id`,
                        q.`quotation_number`,
                        FormatDate(q.`quotation_date`) AS `quotation_date`,
                        q.`company_name`,
                        q.`company_id`,
                        q.`project_id`,
                        p.`project_number`,
                        q.`project_name`,
                        q.`approved_status`,
                        q.`po_box`,
                        q.`telephone_no`,
                        q.`fax`,
                        q.`address`,
                        q.`attn`,
                        q.`quotation_reference`,
                        q.`subject`,
                        q.`sub_total`,
                        q.`received_by_id`,
                        q.`received_by_name`,
                        q.`quotation_created_date`,
                        q.`quotation_status`,
                        q.`tax_content`,
                        q.`discount_amount`,
                        q.`discount_type`,
                        q.`total_discount_amount`,
                        q.`description`,
                        q.`introduction_id`,
                        q.`introduction_name`,
                        q.`sub_total`
                    FROM quotation_main_tbl q
                    LEFT JOIN project_main_table p 
                        ON q.`project_id` = p.`project_main_id`
						where q.company_id='".$this->company_id."' and q.project_id = '".$this->project_id."' and  q.approved_status ='".$this->option_select."' ";
        
        $array[25] = "Select q.`quotation_main_id`,
                        q.`quotation_number`,
                        FormatDate(q.`quotation_date`) AS `quotation_date`,
                        q.`company_name`,
                        q.`company_id`,
                        q.`project_id`,
                        p.`project_number`,
                        q.`project_name`,
                        q.`approved_status`,
                        q.`po_box`,
                        q.`telephone_no`,
                        q.`fax`,
                        q.`address`,
                        q.`attn`,
                        q.`quotation_reference`,
                        q.`subject`,
                        q.`sub_total`,
                        q.`received_by_id`,
                        q.`received_by_name`,
                        q.`quotation_created_date`,
                        q.`quotation_status`,
                        q.`tax_content`,
                        q.`discount_amount`,
                        q.`discount_type`,
                        q.`total_discount_amount`,
                        q.`description`,
                        q.`introduction_id`,
                        q.`introduction_name`,
                        q.`sub_total`
                    FROM quotation_main_tbl q
                    LEFT JOIN project_main_table p 
                        ON q.`project_id` = p.`project_main_id`
						where q.company_id='".$this->company_id."' and q.project_id = '".$this->project_id."'  ";
        
        
        
        $array[26] = "INSERT INTO credit_debit_ledger ( `company_id`, `company_name`, `project_id`, `project_name`, `quotation_id`, `quotation_number`,`contract_amount`, `credit_amount`, `debit_amount`, `invoice_id`, `invoice_number`,tax_content,`accounts_date`,account_head)
                        SELECT company_id, company_name, project_id , project_name,quotation_main_id,quotation_number,sub_total,'0.000','0.000',0,'NA',tax_content,quotation_created_date,'Contract Amount'
                        FROM quotation_main_tbl
                        WHERE quotation_number='".$this->v_quotation_number."'";
            
                        
                        
        $array[27] = "UPDATE  credit_debit_ledger SET account_status='Deactive' WHERE quotation_number='".$this->v_quotation_number."'";
                      
                      
        $array[28] = "UPDATE credit_debit_ledger t
                        JOIN quotation_main_tbl s ON t.quotation_id = s.quotation_main_id
                        SET t.company_id = s.company_id,
                            t.company_name = s.company_name,
                            t.project_id = s.project_id,
                            t.project_name = s.project_name,
                            t.contract_amount = s.sub_total,
                            t.tax_content = s.tax_content,
                            t.account_status = 'Active'
                        WHERE s.quotation_number = '".$this->v_quotation_number."'" ; 
                        
        $array[29] = "INSERT INTO credit_debit_ledger (
                        company_id, company_name, project_id, project_name,
                        quotation_id, quotation_number, contract_amount ,credit_amount, debit_amount,
                        invoice_id, invoice_number, tax_content, accounts_date, account_head
                    )
                    SELECT 
                        company_id,
                        company_name,
                        project_id,
                        project_name,
                        quotation_main_id,
                        quotation_number,
                        (sub_total * tax_content) / 100,   -- fixed field name to sub_total
                        0.000,0.000,                             -- debit_amount as numeric
                        0,                                 -- invoice_id as integer
                        'NA',                              -- invoice_number as string
                        tax_content,
                        quotation_created_date,
                        'Tax Income'
                    FROM quotation_main_tbl
                    WHERE quotation_number = '".$this->v_quotation_number."'
                      AND tax_content != 0;
                    "; 
                 
                        
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_quotation_new':
              
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
                $this->varModelObj->ListFromTable($var[3]);
            break;
            
            case 'list_quotation_view_between': 
            
			
			if($this->option_select=='approval')
			{
		    //$sql="SELECT `quotation_main_id`, `quotation_number`, FormatDate(quotation_date) as `quotation_date`, `company_name`,`company_id`,`project_id`,`project_name`, approved_status,`po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `subject`, `sub_total`, `received_by_id`, `received_by_name`, `quotation_created_date`, `quotation_status`,`tax_content`, `discount_amount`,`discount_type`,`total_discount_amount`,`description`,`introduction_id`,`introduction_name`,`sub_total` FROM  quotation_main_tbl WHERE DATE_FORMAT(quotation_date,'%y-%m-%d')  BETWEEN DATE('".$this->from_date."') AND DATE('". $this->to_date."') and quotation_status='Quotation Generated' and approved_status='Approved' order by quotation_main_id desc";	
		    $sql= "SELECT 
                        q.`quotation_main_id`,
                        q.`quotation_number`,
                        FormatDate(q.`quotation_date`) AS `quotation_date`,
                        q.`company_name`,
                        q.`company_id`,
                        q.`project_id`,
                        p.`project_number`,
                        q.`project_name`,
                        q.`approved_status`,
                        q.`po_box`,
                        q.`telephone_no`,
                        q.`fax`,
                        q.`address`,
                        q.`attn`,
                        q.`quotation_reference`,
                        q.`subject`,
                        q.`sub_total`,
                        q.`received_by_id`,
                        q.`received_by_name`,
                        q.`quotation_created_date`,
                        q.`quotation_status`,
                        q.`tax_content`,
                        q.`discount_amount`,
                        q.`discount_type`,
                        q.`total_discount_amount`,
                        q.`description`,
                        q.`introduction_id`,
                        q.`introduction_name`,
                        q.`sub_total`
                    FROM quotation_main_tbl q
                    LEFT JOIN project_main_table p 
                        ON q.`project_id` = p.`project_main_id`
                    WHERE DATE_FORMAT(q.`quotation_date`, '%Y-%m-%d') 
                          BETWEEN DATE('".$this->from_date."') 
                          AND DATE('".$this->to_date."')
                      AND q.`quotation_status` = 'Quotation Generated'
                      AND q.`approved_status` = 'Approved'
                    ORDER BY q.`quotation_main_id` DESC";
			}
			else
				{
		
		//	$sql="SELECT `quotation_main_id`, `quotation_number`, FormatDate(quotation_date) as `quotation_date`, `company_name`,`company_id`,`project_id`,`project_name`, approved_status,`po_box`, `telephone_no`, `fax`, `address`, `attn`, `quotation_reference`, `subject`, `sub_total`, `received_by_id`, `received_by_name`, `quotation_created_date`, `quotation_status`,`tax_content`, `discount_amount`,`discount_type`,`total_discount_amount`,`description`,`introduction_id`,`introduction_name`,`sub_total` FROM  quotation_main_tbl WHERE DATE_FORMAT(quotation_date,'%y-%m-%d')  BETWEEN DATE('".$this->from_date."') AND DATE('". $this->to_date."') and quotation_status='Quotation Generated' order by quotation_main_id desc";	
				
			$sql = "SELECT 
                            q.`quotation_main_id`,
                            q.`quotation_number`,
                            FormatDate(q.`quotation_date`) AS `quotation_date`,
                            q.`company_name`,
                            q.`company_id`,
                            q.`project_id`,
                            p.`project_number`,
                            q.`project_name`,
                            q.`approved_status`,
                            q.`po_box`,
                            q.`telephone_no`,
                            q.`fax`,
                            q.`address`,
                            q.`attn`,
                            q.`quotation_reference`,
                            q.`subject`,
                            q.`sub_total`,
                            q.`received_by_id`,
                            q.`received_by_name`,
                            q.`quotation_created_date`,
                            q.`quotation_status`,
                            q.`tax_content`,
                            q.`discount_amount`,
                            q.`discount_type`,
                            q.`total_discount_amount`,
                            q.`description`,
                            q.`introduction_id`,
                            q.`introduction_name`,
                            q.`sub_total`
                        FROM quotation_main_tbl q
                        LEFT JOIN project_main_table p 
                            ON q.`project_id` = p.`project_main_id`
                        WHERE DATE_FORMAT(q.`quotation_date`, '%Y-%m-%d') 
                              BETWEEN DATE('".$this->from_date."') 
                              AND DATE('".$this->to_date."')
                          AND q.`quotation_status` = 'Quotation Generated'
                        ORDER BY q.`quotation_main_id` DESC ";
	    
				}
                $this->varModelObj->ListFromTable($sql);
            break;
            
            case 'edit_quotation': 
               
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
            
            case 'select_product_details': 
              
                $this->varModelObj->ListFromTable($var[19]);
            break;
             case 'select_vat_content': 
              //echo $var[20];
                $this->varModelObj->ListFromTable($var[20]);
            break;
            
			case 'quotation_approval': 
              echo $this->approved_status;
              if(trim($this->approved_status)=='Approved')
              {
                 $this->varModelObj->UpdateTable($var[22]); 
                 $this->varModelObj->UpdateTable($var[27]);
              }
              else
              {
                  $this->varModelObj->UpdateTable($var[21]);
                  $res= $this->varModelObj->ListFromTableReturn("SELECT * from credit_debit_ledger WHERE quotation_number='".$this->v_quotation_number."'");
                  $decode_data = json_decode($res, true);
                  
                  if($decode_data['data'][0]['account_status']=== null)
                  {
                      
                    $this->varModelObj->AddToTable($var[26]);
                    $this->varModelObj->AddToTable($var[29]);
                    
                  } 
                  else
                  {
                      $this->varModelObj->UpdateTable($var[28]);
                  }
                  
              }
               
            break;
             case 'list_quotation_company_list': 
                 
                
                if($this->option_select == 'All')
                {
                  $this->varModelObj->ListFromTable($var[24]);  
                }
                else
                {
                  
                  $this->varModelObj->ListFromTable($var[25]);  
                }
            break;
            
            case 'update_attn': 
              
                $this->varModelObj->UpdateTable($var[23]);
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