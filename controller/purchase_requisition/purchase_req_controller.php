<?php

require ('../../model/common/common_functions.php');

class purchase_requisitionController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$ctrl_name, $jsonValue, $unit_ctrl_name, $v_tax_ctrl_name, $v_supplier_id, $v_supplier_name, $v_purchase_req_no,
		       $v_requsition_date, $v_requested_by, $v_approved_by, $v_work_order_no, $v_inventory_item_id, $v_inventory_item_name, $v_pr_decription, $v_pr_qnty, $v_pr_unit, 
			   $v_pr_rate, $v_pr_tax, $v_net_amount, $v_work_order_id, $v_pr_no, $v_pr_child_id, $cancel_ids, $start_date, $end_date, $v_supplier_ctrl_name,
			   $v_suppier_ids, $v_startDate, $v_endDate,$array_table_data;
        
    function __construct()
	{
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];  

        $this->unit_ctrl_name = $_POST['v_unit_ctrl_name']; 
		$this->v_tax_ctrl_name = $_POST['v_tax_ctrl_name'];

		$this->v_supplier_id = $_POST['v_supplier_id']; 
		$this->v_supplier_name = $_POST['v_supplier_name']; 
		$this->v_purchase_req_no = $_POST['v_purchase_req_no']; 
		$this->v_requsition_date = $_POST['v_requsition_date']; 
		$this->v_requested_by = $_POST['v_requested_by']; 
		$this->v_approved_by = $_POST['v_approved_by'];
		$this->v_work_order_id = $_POST['v_work_order_id']; 
		$this->v_work_order_no = $_POST['v_work_order_no']; 
		$this->v_inventory_item_id = $_POST['v_inventory_item_id']; 
		$this->v_inventory_item_name = $this->varDBConnection->real_escape_string($_POST['v_inventory_item_name']); 
		$this->v_pr_decription = $_POST['v_pr_decription']; 
		$this->v_pr_qnty = $_POST['v_pr_qnty']; 
		$this->v_pr_unit = $_POST['v_pr_unit']; 
		$this->v_pr_rate = $_POST['v_pr_rate'];
		$this->v_pr_tax = $_POST['v_pr_tax'];
		$this->v_net_amount = $_POST['v_net_amount'];
		
		$this->v_pr_no = $_POST['v_pr_no'];
		
		$this->v_pr_child_id = $_POST['v_pr_child_id'];
		
		$this->cancel_ids = $_POST['cancel_ids'];
		
		$this->v_supplier_ctrl_name = $_POST['v_supplier_ctrl_name'];
		
		$this->v_suppier_ids = $_POST['v_suppier_ids'];
		$this->array_table_data = $_POST['dataArray'];
		
		$this->v_startDate = $_POST['v_startDate'];
		$this->v_endDate = $_POST['v_endDate'];
     
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
	    $array[0] = "SELECT work_order_main_id, work_order_number FROM  work_order_tbl";
		
		$array[1] = "SELECT unit_id, unit_name FROM unit_master WHERE status='Active'";
		
		//$array[2] = "CALL proc_add_pr_main_list( '".$this->v_supplier_id."','".$this->v_supplier_name."','".$this->v_purchase_req_no."','".$this->v_requsition_date."','".$this->v_requested_by."','".$this->v_work_order_no."','".$this->v_pr_decription."','".$this->v_pr_qnty."', '".$this->v_pr_unit."','".$this->v_pr_rate."','".$this->v_pr_tax."','".$this->v_net_amount."', '".$this->v_work_order_id."', @msg)";
		 
        $array[2] = "CALL proc_add_pr_main_list_V2( '".$this->v_supplier_id."','".$this->v_supplier_name."','".$this->v_purchase_req_no."','".$this->v_requsition_date."','".$this->v_requested_by."', '".$this->v_approved_by."', '".$this->v_work_order_no."', @msg,@msg1)";
        
		 $array[3] = "SELECT * FROM purchase_requsition_child_tbl WHERE purchase_requsition_no='".$this->v_pr_no."'";
		
		$array[4] = "DELETE FROM purchase_requsition_child_tbl WHERE ids='".$this->v_pr_child_id."'";
		
// 		$array[5] = "UPDATE purchase_requsition_child_tbl SET inventory_id='".$this->v_inventory_item_id."', inventory_name='".$this->v_inventory_item_name."', description='".$this->v_pr_decription."', quantity='".$this->v_pr_qnty."', unit='".$this->v_pr_unit."', rate='".$this->v_pr_rate."', tax='".$this->v_pr_tax."', amount='".$this->v_net_amount."' WHERE ids='".$this->v_pr_child_id."'";
		$array[5] = "UPDATE purchase_requsition_child_tbl SET description='".$this->v_pr_decription."', quantity='".$this->v_pr_qnty."' WHERE ids='".$this->v_pr_child_id."'";
		
		
		$array[6] = "SELECT ids, tax_value FROM tax_tbl WHERE status='Active'";
        
		$array[7] = "UPDATE purchase_requsition_main_tbl SET supplier_id='".$this->v_supplier_id."', supplier_name='".$this->v_supplier_name."', requsition_date='".$this->v_requsition_date."', requested_by='".$this->v_requested_by."', approved_by='".$this->v_approved_by."', work_order_no_id='".$this->v_work_order_id."', work_order_no='".$this->v_work_order_no."', requisition_status='PR Generated' WHERE purchase_req_no='".$this->v_purchase_req_no."'";
		
		$array[8] = "SELECT requisition_status FROM purchase_requsition_main_tbl WHERE purchase_req_no='".$this->v_purchase_req_no."'";
		
		$array[9] = "SELECT *,FormatDate(requsition_date) as requsition_date FROM purchase_requsition_main_tbl WHERE requisition_status IN('Pending','PR Generated')";
		
		$array[10] ="UPDATE purchase_requsition_main_tbl SET requisition_status='Cancelled' WHERE ids='".$this->cancel_ids."'";
		
		$array[11] = "SELECT *,FormatDate(requsition_date) as requsition_date FROM purchase_requsition_main_tbl WHERE requisition_status IN('Cancelled')";
		
		$array[12] = "SELECT * FROM purchase_requsition_main_tbl WHERE default_date='".$this->start_date."' BETWEEN default_date='".$this->end_date."'";
		
		$array[13]= "SELECT company_id, company_name FROM supplier_details WHERE status='Active'" ;
		
		$array[14] = "SELECT company_id, company_name, contact_phone, contact_address_2, city, fax FROM supplier_details WHERE company_id= ".$this->v_suppier_ids." AND status='Active'";
		
		$array[15] = "SELECT *,FormatDate(requsition_date) as requsition_date FROM purchase_requsition_main_tbl WHERE requisition_status IN('Pending','PR Generated') AND requsition_date BETWEEN '".$this->v_startDate."' AND '".$this->v_endDate."'";
		
		$array[16] = "SELECT *,FormatDate(requsition_date) as requsition_date FROM purchase_requsition_main_tbl WHERE requisition_status IN('Cancelled') AND requsition_date BETWEEN '".$this->v_startDate."' AND '".$this->v_endDate."'";
		
		$array[17]="SELECT location as project_number from work_order_tbl where work_order_number='".$this->v_work_order_no."'";
        return $array;
    }
	
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'select_job_no':
                $this->varModelObj->CreateDropDown($var[0],'work_order_main_id','work_order_number',$this->ctrl_name,'Select Work Order No');
            break;
            
			
			case 'select_unit':
                $this->varModelObj->CreateDropDown($var[1],'unit_id','unit_name',$this->unit_ctrl_name,'Select Unit');
            break;
			
			
			case 'add_purchase_requisition':
			  //  echo $var[2];
                // $this->varModelObj->ExecuteProcedureReturnMultiplevalues($var[2]);
                	$this->msg = $this->varModelObj->ExecuteProcedureReturnMultiplevalues($var[2]);
			$data = json_decode($this->msg, true);

			 $SQLString = "INSERT INTO purchase_requsition_child_tbl(purchase_requsition_main_id, purchase_requsition_no, inventory_id, inventory_name, description, quantity, unit, rate, tax, amount) VALUES ";
				  $SQLOther = "";
			    for($i=0;$i<=sizeof($this->array_table_data)-1;$i++){
			
			      $SQLOther = $SQLOther ."('".$data['msg1']."', '".$data['msg']."','".$this->array_table_data[$i]['inventory_id']."','".$this->varDBConnection->real_escape_string($this->array_table_data[$i]['inventory_name'])."','".$this->array_table_data[$i]['description']."','".$this->array_table_data[$i]['qty']."','".$this->array_table_data[$i]['unit']."','".$this->array_table_data[$i]['rate']."','".$this->array_table_data[$i]['tax']."','".$this->array_table_data[$i]['net_total']."'),";  
                  
			    }
			    
			        $x = substr_replace($SQLOther, "", -1);
					$SQLString = $SQLString.$x;
				// 	echo $SQLString;
					 $this->varModelObj->AddToTable($SQLString);
            break;
            
			
			case 'list_purchase_req':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[3]);
				echo $this->jsonValue; 
            break;
			
			
			case 'delete_pr_item': 
                $this->varModelObj->DeleteRow($var[4]);
            break;
			

			case 'edit_purchase_requisition':  	
				$this->jsonValue = $this->varModelObj->UpdateTable($var[5]);
				echo $this->jsonValue;
            break; 
			
			
			case 'select_tax':
                $this->varModelObj->CreateDropDown($var[6],'ids','tax_value',$this->v_tax_ctrl_name ,'10.00');
            break;
			
			
			case 'purchase_requisition_generate':  		
				$this->jsonValue = $this->varModelObj->UpdateTable($var[7]);
				echo $this->jsonValue;
            break;
			
			
			case 'purchase_requisition_status': 
                $this->varModelObj->ListFromTable($var[8]);
            break;
			case 'list_pr_child': 
                $this->varModelObj->ListFromTable($var[3]);
            break;
			
			case 'list_table_pr_view':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[9]);
				echo $this->jsonValue; 
            break;
			
			
			case 'cancel_pr_data':  		
				$this->jsonValue = $this->varModelObj->UpdateTable($var[10]);
				echo $this->jsonValue;
            break;
			
			
			case 'list_cancelled_table_pr_view':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[11]);
				echo $this->jsonValue; 
            break;
			
			
			case 'list_table_pr_view_date_search':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[12]);
				echo $this->jsonValue; 
            break;
			
			
			case 'select_company_name':
                $this->varModelObj->CreateDropDown($var[13],'company_id','company_name',$this->v_supplier_ctrl_name, 'Select Supplier');
            break;
			
			
			case 'fetch_company_details': 
                $this->varModelObj->ListFromTable($var[14]);
            break;
            
			
			case 'list_table_pr_view_between': 
                $this->jsonValue = $this->varModelObj->ListFromTable($var[15]);
				echo $this->jsonValue; 
            break;
			
			
			case 'list_cancelled_table_pr_view_between': 
                $this->jsonValue = $this->varModelObj->ListFromTable($var[16]);
				echo $this->jsonValue; 
            break;
			
			
			case 'select_project_number': 
                $this->varModelObj->ListFromTable($var[17]);
            break;
            
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
}//end of class

$obj = new purchase_requisitionController();
$obj->RequestAccept($obj->actionevents);
?>