<?php

require ('../../model/common/common_functions.php');




class paymentScheduleController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$ctrl_name,$company_id, $company_name, $contact_person, $contact_phone,$v_company_id ;
        public $nameValue,$chqValue,$dateValue,$v_bank_nm,$amountValue = array();
       
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
       
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        $this->selectedPaymentMethod = $_POST['selectedPaymentMethod'];
        $this->payment_acnt_head = $_POST['payment_acnt_head'];
        $this->customer_name = $this->varDBConnection->real_escape_string($_POST['customer_name']);
        $this->customer_id = $_POST['customer_id'];
        $this->payment_start_date = $_POST['payment_start_date'];
        $this->no_of_months = $_POST['no_of_months'];
        $this->total_amount = $_POST['total_amount'];
        $this->nameValue = $_POST['nameValue'];
        $this->chqValue = $_POST['chqValue'];
        $this->dateValue = $_POST['dateValue'];
        $this->amountValue = $_POST['amountValue'];
        $this->uniqueRefCode = $_POST['uniqueRefCode'];
        $this->schedule_description = $this->varDBConnection->real_escape_string($_POST['schedule_description']);
        $this->payments_type = $_POST['payments_type'];
        $this->chq_ref_no = $_POST['chq_ref_no'];
        $this->bank_name = $_POST['bank_name'];
        $this->selected_date = $_POST['selected_date'];
        
        $this->v_customer_name = $_POST['v_customer_name'];
        $this->v_contact_no = $_POST['v_contact_no'];
        
        $this->v_acnt_name = $_POST['v_acnt_name'];
        $this->v_acnt_type = $_POST['v_acnt_type'];
        
        if(trim($this->payments_type)=='Income')
        {
          $this->cr_amount =$this->total_amount;
          $this->dr_amount =0.000;
        }
        else
        {
          $this->dr_amount =$this->total_amount;
          $this->cr_amount =0.000;  
        }
        if($this->selectedPaymentMethod != 'Cheque')
        {
           $this->chq_ref_no ='NA' ;
           $this->bank_name = 'NA';
        }
       $_SESSION['user_id'] =1;
       $_SESSION['user_name'] = 'Admin'; 
       
       
       $this->v_start_date = $_POST['v_start_date'];
       $this->v_end_date = $_POST['v_end_date'];
       $this->v_cut_id = $_POST['v_cut_id'];
       $this->v_bank_nm = $_POST['v_bank_nm'];
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "INSERT INTO `tlb_income_and_expence` ( `account_id`,  `date_of_entry`, `due_date`, `user_id`, `user_name`, `description`, `customer_id`, `customer_name`, `cheque_no_receipt_no`,`bank_name`, `dr_amount`, `cr_amount`,`ref_code`,payment_method) VALUES ('".$this->payment_acnt_head."','".$this->current_date."','".$this->payment_start_date."','".$_SESSION['user_id']."','".$_SESSION['user_name']."','".$this->schedule_description."','".$this->customer_id."','".$this->customer_name."','".$this->chq_ref_no."','".$this->bank_name."','".$this->dr_amount."','".$this->cr_amount."','".$this->uniqueRefCode."','".$this->selectedPaymentMethod."')";
        //$array[1] = "select date_format(due_date,'%Y-%m-%d') as due_date,count(date_format(due_date,'%Y-%m-%d')) as due_counts from tlb_income_and_expence GROUP BY due_date ";
        $array[1] = "select * from view_shedule_date_and_count";
         
        $array[2] = "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') = '".$this->selected_date."' ";
        $array[3] = "INSERT INTO `customer_info` (customer_name,contact_number) values ('".$this->v_customer_name."','".$this->v_contact_no."')";
        $array[4] = "INSERT INTO `accounts_head` (accounts_head,Type) values ('".$this->v_acnt_name."','".$this->v_acnt_type."')";
        $array[5] = "SELECT * from customer_info where customer_status ='Active'";
        $array[6] = "SELECT * from accounts_head where status ='Active'";
        $array[7] = "Update tlb_income_and_expence set approved_status = '".$_POST['v_newStatus']."' where ids= ".$_POST['v_rowId'];
        $array[8] = "Update tlb_income_and_expence set cheque_no_receipt_no = '".$_POST['v_chq_ref_no']."' where ids= ".$_POST['v_rowId'];
        $array[9] = "Update tlb_income_and_expence set due_date = '".$_POST['v_chq_date']."' where ids= ".$_POST['v_rowId'];
        $array[10] = "DELETE from tlb_income_and_expence where ids =".$_POST['v_rowId'];
        $array[11] = "Update tlb_income_and_expence set payment_method = '".$_POST['v_payment_method']."' where ids= ".$_POST['v_rowId'];
        $array[12] = "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') between '".$_POST['v_start_date']."' and '".$_POST['v_end_date']."' order by date_format(due_date,'%Y-%m-%d')";
        $array[13] = "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where (date_format(due_date,'%Y-%m-%d') between '".$_POST['v_start_date']."' and '".$_POST['v_end_date']."') and (customer_id='".$this->v_cut_id."')  order by date_format(due_date,'%Y-%m-%d')";
        $array[14] = "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where (date_format(due_date,'%Y-%m-%d') between '".$_POST['v_start_date']."' and '".$_POST['v_end_date']."') and (bank_name='".trim($this->v_bank_nm)."')  order by date_format(due_date,'%Y-%m-%d')";
        $array[15] = "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where (date_format(due_date,'%Y-%m-%d') between '".$_POST['v_start_date']."' and '".$_POST['v_end_date']."') and (bank_name='".trim($this->v_bank_nm)."') and (customer_id='".$this->v_cut_id."') order by date_format(due_date,'%Y-%m-%d')";
        $array[16] = "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where (date_format(due_date,'%Y-%m-%d') between '".$_POST['v_start_date']."' and '".$_POST['v_end_date']."') and (bank_name!='')  order by date_format(due_date,'%Y-%m-%d')";
        $array[17] = "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where (date_format(due_date,'%Y-%m-%d') between '".$_POST['v_start_date']."' and '".$_POST['v_end_date']."') and (bank_name!='') and (customer_id='".$this->v_cut_id."') order by date_format(due_date,'%Y-%m-%d')";
        $array[18] = "Update tlb_income_and_expence set confirm_status = 'Confirm' where ids= ".$_POST['v_rowId'];
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_payment_schedule':
                
                 if($this->no_of_months ==1)
                 {
                     //echo $var[0];
                    $this->varModelObj->AddToTable($var[0]);
                    
                 }
                 else
                 {
                   $this->str='';
                   
                           if(trim($this->payments_type)=='Income')
                            {
                              $this->cr_amount =$this->amountValue;
                              $this->dr_amount =0.000;
                            }
                            else
                            {
                              $this->dr_amount =$this->amountValue;
                              $this->cr_amount =0.000;  
                            }
                        
                             if($this->no_of_months >1)
                                 {
                                  for($this->x = 0; $this->x < $this->no_of_months; $this->x++){
                                      
                                     $this->str = $this->str. "('".$this->payment_acnt_head."','".$this->current_date."','".$this->dateValue[$this->x]."','".$_SESSION['user_id']."','".$_SESSION['user_name']."','".$this->schedule_description."','".$this->customer_id."','".$this->customer_name."','".$this->chqValue[$this->x]."','".$this->nameValue[$this->x]."','".$this->dr_amount[$this->x]."','".$this->cr_amount[$this->x]."','".$this->uniqueRefCode."','".$this->selectedPaymentMethod."')".',';
                                   
                                    // $var =  $this->SQLArray();
                                    
                                     }
                                  } 
                                  $modifiedString = substr($this->str, 0, -1);
                                  // echo "INSERT INTO `tlb_income_and_expence` ( `account_id`,  `date_of_entry`, `due_date`, `user_id`, `user_name`, `description`,   `customer_id`, `customer_name`, `cheque_no_receipt_no`,`bank_name`, `dr_amount`, `cr_amount`,`ref_code`) VALUES".$modifiedString;
                                   $this->varModelObj->AddToTable("INSERT INTO `tlb_income_and_expence` ( `account_id`,  `date_of_entry`, `due_date`, `user_id`, `user_name`, `description`,   `customer_id`, `customer_name`, `cheque_no_receipt_no`,`bank_name`, `dr_amount`, `cr_amount`,`ref_code`,payment_method) VALUES".$modifiedString);
                                   
                 } 
                 
            break;
            
            
            
            
            
            case 'get_schedule':
                //echo $var[1];
                $this->varModelObj->ScheduleData($var[1]);
            break;
            
            case 'get_schedule_list':
               // echo $var[2];
                $this->varModelObj->ListFromTable($var[2]);
            break;
            
            case 'add_customer_details':
                 $this->varModelObj->AddToTable($var[3]);
            break;  
            case 'add_account_details':
                 $this->varModelObj->AddToTable($var[4]);
            break; 
            
            case 'get_customer_list':
               // echo $var[2];
                $this->varModelObj->ListFromTable($var[5]);
            break;
            
            case 'get_acount_list':
               // echo $var[2];
                $this->varModelObj->ListFromTable($var[6]);
            break;
            
            case 'change_status':
               // echo $var[2];
                $this->varModelObj->UpdateTable($var[7]);
            break;
             case 'change_ref_no':
                //echo $var[8];
                $this->varModelObj->UpdateTable($var[8]);
            break;
             case 'change_due_date':
                //echo $var[9];
                $this->varModelObj->UpdateTable($var[9]);
            break;
             case 'delete_row':
                echo $var[10];
                $this->varModelObj->DeleteRow($var[10]);
            break;
             case 'change_payment_method':
                //echo $var[9];
                $this->varModelObj->UpdateTable($var[11]);
            break;
            case 'get_search_data':
               if($this->v_cut_id == '0' && $this->v_bank_nm=='empty')
               {
                //   echo $var[12];
                $this->varModelObj->ListFromTable($var[12]);
               }
               else if($this->v_cut_id != '0' && $this->v_bank_nm=='empty')
               {
                // echo $var[13];
                 $this->varModelObj->ListFromTable($var[13]);  
               }
               else if($this->v_cut_id == '0' && $this->v_bank_nm !='empty')
               {
                // echo $var[14];
                    if($this->v_bank_nm =='ALL'){
                        $this->varModelObj->ListFromTable($var[16]); 
                    }
                    else{
                        $this->varModelObj->ListFromTable($var[14]); 
                    }
               }
               else{
                //   echo $var[15];
                    if($this->v_bank_nm =='ALL'){
                        $this->varModelObj->ListFromTable($var[17]); 
                    }
                    else{
                        $this->varModelObj->ListFromTable($var[15]);
                    }
                   
               }
            break;
            
            case 'confirm_row':
               // echo $var[2];
                $this->varModelObj->UpdateTable($var[18]);
            break;
            
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new paymentScheduleController();
$obj->RequestAccept($obj->actionevents);
?>