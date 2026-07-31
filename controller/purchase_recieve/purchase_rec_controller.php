<?php
 
require ('../../model/common/common_functions.php');


class purchase_recieveController
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_supplier_ctrl_name, $v_job_ctrl_name, $v_pr_ctrl_name, $v_jobNo, $v_lpo_ctrl_name, $v_qty_ctrl_name, $v_tax_ctrl_name,
			   $v_supplier_id, $v_supplier_name, $v_job_ids, $v_job_name, $v_prn_no, $v_pur_recieve_date, $v_job_location, $v_requested_by, $v_approved_by,
			   $v_prd_no, $v_lpo_no, $v_bill_no, $v_pr_child_id, $v_inventory_item_id, $v_inventory_item_name, $v_description, $v_quantity, $v_unit, $v_rate, $v_tax, $v_net_amount, $v_purchase_recieve_no, $v_pur_recie_child_id,
			   $v_delete_ids, $v_startDate, $v_endDate, $v_purchase_rd_no, $v_prnn_no, $v_prd_number, $category_id, $category_name, $lpo_quantity, $array_table_data, $company_name, $company_id, $project_name, $project_id, $v_ref_no,
			   $v_date, $v_recieved_by,$updated_qty,$confirm_id,$quotation_id,$quotation_number;
        
    function __construct()
	{
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_supplier_ctrl_name = $_POST['v_supplier_ctrl_name'];  
		$this->v_job_ctrl_name = $_POST['v_job_ctrl_name'];
		$this->v_pr_ctrl_name = $_POST['v_pr_ctrl_name'];
		$this->v_jobNo = $_POST['v_jobNo'];
		$this->v_lpo_ctrl_name = $_POST['v_lpo_ctrl_name'];
		$this->v_qty_ctrl_name = $_POST['v_qty_ctrl_name'];
		$this->v_tax_ctrl_name = $_POST['v_tax_ctrl_name'];
		
		$this->v_supplier_id = $_POST['v_supplier_id'];
		$this->v_supplier_name = $_POST['v_supplier_name'];
		$this->v_job_ids = $_POST['v_job_ids'];
		$this->v_job_name = $_POST['v_job_name'];
		$this->v_prn_no = $_POST['v_prn_no'];
		$this->v_pur_recieve_date = $_POST['v_pur_recieve_date'];
		$this->v_job_location = $_POST['v_job_location'];
		$this->v_requested_by = $_POST['v_requested_by'];
		$this->v_approved_by = $_POST['v_approved_by'];
		$this->v_prd_no = $_POST['v_prd_no'];
		$this->v_lpo_no = $_POST['v_lpo_no'];
		$this->v_bill_no = $_POST['v_bill_no'];
		$this->v_pr_child_id = $_POST['v_pr_child_id'];
		$this->v_inventory_item_id = $_POST['v_inventory_item_id']; 
		$this->v_inventory_item_name = $_POST['v_inventory_item_name']; 
		$this->v_description = $_POST['v_description'];
		$this->v_quantity = $_POST['v_quantity'];
		$this->v_unit = $_POST['v_unit'];
		$this->v_rate = $_POST['v_rate'];
		$this->v_tax = $_POST['v_tax'];
		$this->v_net_amount = $_POST['v_net_amount'];
		
		$this->v_purchase_recieve_no = $_POST['v_purchase_recieve_no']; 
		
		$this->v_pur_recie_child_id = $_POST['v_pur_recie_child_id'];
		
		$this->v_delete_ids = $_POST['v_delete_ids'];
		
		$this->v_startDate = $_POST['v_startDate'];
		$this->v_endDate = $_POST['v_endDate'];
		
		$this->v_purchase_rd_no = $_POST['v_purchase_rd_no'];
		
		$this->v_prnn_no = $_POST['v_prnn_no'];
        $this->v_prd_number = $_POST['v_prd_number'];
        $this->category_id = $_POST['category_id'];
	    $this->category_name = $_POST['category_name'];
	    $this->lpo_quantity = $_POST['lpo_quantity'];
	    $this->array_table_data = $_POST['array_table_data'];
	    $this->company_name = $_POST['company_name'];
	    $this->company_id = $_POST['company_id'];
	    $this->project_name = $_POST['project_name'];
	    $this->project_id = $_POST['project_id'];
	    $this->v_ref_no = $_POST['v_ref_no'];
	    $this->v_date = $_POST['v_date'];
	    $this->v_recieved_by = $_POST['v_recieved_by'];
	    $this->updated_qty = $_POST['updated_qty'];
	    $this->rowCount = $_POST['rowCount'];
	    $this->confirm_id = $_POST['confirm_id'];
	    
	    $this->company_id = $_POST['v_company_id'];
	    $this->company_name = $this->varDBConnection->real_escape_string($_POST['v_company_name']);
	    $this->project_id = $_POST['v_project_id'];
	    $this->project_name = $this->varDBConnection->real_escape_string($_POST['v_project_name']);
	    $this->quotation_id = $_POST['v_quotation_id'];
	    $this->quotation_number = $_POST['v_quotation_number'];
	    $this->purchase_amnt = $_POST['v_total'];
	    
	    
	    $this->purchase_receive_id = $_POST['v_approve_item_id'];
	    $this->v_required_quantity = $_POST['v_required_quantity'];
	    $this->v_approve_id = $_POST['v_approve_id'];
	    
	    
	}
    
    
    
    function SQLArray()
    { 
        $array =  array();
		
		$array[0] = "SELECT company_id, company_name FROM supplier_details WHERE status='Active'";
		
		$array[1] = "SELECT work_order_main_id, work_order_number FROM  work_order_tbl";
		
		$array[2]  = "SELECT ids ,purchase_req_no FROM purchase_requsition_main_tbl WHERE work_order_no='".$this->v_jobNo."'";
        
        $array[27] = "SELECT ids ,purchase_req_no  FROM purchase_requsition_main_tbl WHERE requisition_status!='Cancelled'";
        
		$array[3] = "SELECT local_po_main_id,local_po_number FROM `local_po_main_tbl` WHERE `local_po_status`!='Cancelled' and `local_po_number` in (select local_po_no from local_po_child_tbl where (quantity-quantity_purchased)>0) group by `local_po_number` ";
		
		$array[4] = "SELECT unit_id, unit_name FROM unit_master WHERE status='Active'";
		
		$array[5] = "SELECT ids, tax_value FROM tax_tbl WHERE status='Active'"; 
		
		$array[6] = "CALL proc_add_purchase_recieve_main_list_v1 ('".$this->v_supplier_id."', '".$this->v_supplier_name."', '', '".$this->v_job_name."', '".$this->v_prn_no."', '".$this->v_pur_recieve_date."', '".$this->v_job_location."', '".$this->v_requested_by."', '".$this->v_approved_by."', '".$this->v_prd_no."', '".$this->v_lpo_no."', '".$this->v_bill_no."','". $this->company_id."','". $this->company_name."','".$this->project_id."','".$this->project_name."','".$this->quotation_id."','".$this->quotation_number."','".$this->purchase_amnt."',@msg, @msg1)";
		
		$array[7] = "SELECT * FROM purchase_recieved_child_tbl WHERE  prd_no='".$this->v_purchase_recieve_no."'";
		
		$array[8] = "DELETE FROM purchase_recieved_child_tbl WHERE ids='".$this->v_pur_recie_child_id."'";
		
		$array[9] = "UPDATE purchase_recieved_child_tbl SET description='".$this->v_description."', quantity='".$this->v_quantity."', unit='".$this->v_unit."', rate='".$this->v_rate."', tax='".$this->v_tax."', amount='".$this->v_net_amount."' WHERE prd_no='".$this->v_prd_no."'";
		
		$array[10] = "UPDATE purchase_received_main_tbl SET supplier_id='".$this->v_supplier_id."', supplier_name='".$this->v_supplier_name."', work_order_id='".$this->v_job_ids."', work_order_no='".$this->v_job_name."', purchase_req_no='".$this->v_prn_no."', purchase_recieved_date='".$this->v_pur_recieve_date."', job_location='".$this->v_job_location."', requested_by='".$this->v_requested_by."', approved_by='".$this->v_approved_by."', lpo_no='".$this->v_lpo_no."', bill_no='".$this->v_bill_no."', purchase_received_status='PR Generated' WHERE prd_no='".$this->v_prd_no."'";
		
		$array[11] = "SELECT p.*, FORMATDATE(p.purchase_recieved_date) AS purchase_recieved_date, w.location as project_number FROM purchase_received_main_tbl p LEFT JOIN work_order_tbl w ON w.work_order_number = p.work_order_no WHERE p.purchase_received_status IN ('Pending', 'PR Generated')";
		
		$array[12] = "UPDATE purchase_received_main_tbl SET purchase_received_status='Cancelled' WHERE ids='".$this->cancel_ids."'";

        $array[13] = "SELECT *,FormatDate(purchase_recieved_date) as purchase_recieved_date FROM purchase_received_main_tbl WHERE purchase_received_status IN('Cancelled')";
        
		$array[14] = "SELECT *,FormatDate(purchase_recieved_date) as purchase_recieved_date FROM purchase_received_main_tbl WHERE purchase_received_status IN('Pending','PR Generated') AND purchase_recieved_date BETWEEN '".$this->v_startDate."' AND '".$this->v_endDate."'";
		
		$array[15] = "SELECT *,FormatDate(purchase_recieved_date) as purchase_recieved_date FROM purchase_received_main_tbl WHERE purchase_received_status IN('Cancelled') AND purchase_recieved_date BETWEEN '".$this->v_startDate."' AND '".$this->v_endDate."'";
		
		$array[16] = "SELECT purchase_received_status FROM purchase_received_main_tbl WHERE prd_no='".$this->v_prn_no ."'";
		
		$array[17] = "SELECT * FROM purchase_requsition_child_tbl WHERE purchase_requsition_no='".$this->v_purchase_recieve_no."'";
		//----------------------------------------------------------------------------------------------------------------------------------------//
        
		$array[18] = "SELECT * FROM local_po_child_tbl WHERE local_po_no='".$this->v_purchase_recieve_no."'";
		
		$array[19] = "SELECT purchase_req_child_id FROM purchase_recieved_child_tbl WHERE purchase_req_child_id='".$this->v_pr_child_id."'";
		
		$array[20] = "SELECT * FROM purchase_recieved_child_tbl WHERE prd_no='".$this->v_purchase_rd_no."'";
		
		$array[21] = "DELETE FROM purchase_recieved_child_tbl WHERE ids='".$this->v_delete_ids."'";
		
		$array[22] = "UPDATE local_po_child_tbl SET quantity_purchased = quantity_purchased+'".$this->v_quantity."' WHERE local_po_child_id='".$this->v_pr_child_id."'";
		
		$array[23] = "UPDATE local_po_child_tbl SET quantity_purchased = quantity_purchased-'".$this->v_quantity."' WHERE local_po_child_id='".$this->v_pr_child_id."'";
		
		$array[24] = "DELETE FROM purchase_received_main_tbl WHERE ids='".$this->v_pr_child_id."'";
		
		$array[25] = "UPDATE inventory_tbl SET quantity_in=quantity_in+$this->v_quantity WHERE ids='".$this->v_inventory_item_id."'";
		
		$array[26] = "UPDATE inventory_tbl SET quantity_in=quantity_in-$this->v_quantity WHERE ids='".$this->v_inventory_item_id."'";
		
		$array[28] = "SELECT l.job_name, w.location as project_number , l.* FROM local_po_main_tbl l  JOIN work_order_tbl w ON w.work_order_number = l.job_name  WHERE l.local_po_number='".$this->v_lpo_no."' ";
		$array[29] = "SELECT prd_no FROM purchase_received_main_tbl WHERE purchase_received_status = 'Pending'";
		$array[30] = "SELECT * FROM purchase_received_main_tbl WHERE purchase_received_status = 'Pending'";
        $array[31] = "UPDATE purchase_received_main_tbl SET purchase_received_status='Cancelled' WHERE prd_no='".$this->v_prd_number."'";
        $array[32] = "CALL Prc_purchase_rec_cancel('".$this->v_prd_number."')";
        $array[33] = "SELECT * FROM purchase_recieved_child_tbl WHERE (DATE(recieved_date) BETWEEN DATE('".$this->v_startDate."') AND DATE('".$this->v_endDate."')) and pr_rec_status='Store Return' GROUP BY inventory_name";
        // $array[34] = "UPDATE purchase_recieved_child_tbl SET quantity='".$this->updated_qty."', description= '".$this->v_description."' WHERE ids='".$this->v_pur_recie_child_id."'";
        // $array[34] = "UPDATE purchase_recieved_child_tbl SET quantity='".$this->updated_qty."', description= '".$this->v_description."', amount='".$this->v_net_amount."' WHERE ids='".$this->v_pur_recie_child_id."'";
        $array[34] = "UPDATE purchase_recieved_child_tbl SET description= '".$this->v_description."' WHERE ids='".$this->v_pur_recie_child_id."'";
        
        
        $array[35] = "UPDATE purchase_received_main_tbl SET purchase_received_status = 'Cancelled' WHERE ids = (SELECT purchase_recieved_main_id FROM purchase_recieved_child_tbl WHERE ids = '".$this->v_delete_ids."')";
        $array[36] = "UPDATE purchase_received_main_tbl SET confirm_status='Confirm' WHERE ids='".$this->confirm_id."'";
        $array[37] = "SELECT p.*, FORMATDATE(p.purchase_recieved_date) AS purchase_recieved_date, w.location as project_number FROM purchase_received_main_tbl p LEFT JOIN work_order_tbl w ON w.work_order_number = p.work_order_no WHERE p.purchase_received_status IN ('Pending', 'PR Generated')and confirm_status ='Confirm'";
        // $array[37] = "SELECT *,FormatDate(purchase_recieved_date) as purchase_recieved_date FROM purchase_received_main_tbl WHERE purchase_received_status IN('Pending','PR Generated') and confirm_status ='Confirm' ";
		
		$array[38] = " INSERT INTO `purchase_received_add_to_project` ( `purchase_receive_child_id`, `supplier_id`, `supplier_name`, `company_id`, `company_name`, `project_id`, `project_name`, `quotation_id`, `quotation_number`, `inventory_id`, `inventory_name`, `prd_no`, `quantity`, `unit`, `rate`, `tax`, `amount`, `item_code`, `lpo_mumber`)
            SELECT `ids`,`company_id`,`company_name`,'". $this->company_id."','". $this->company_name."','".$this->project_id."','".$this->project_name."','".$this->quotation_id."','".$this->quotation_number."',`inventory_id`,`inventory_name`,`prd_no`,'".$this->v_required_quantity."',`unit`,`rate`,`tax`,('".$this->v_required_quantity."' * `rate`) AS amount,`item_code`,`lpo_no` FROM `purchase_recieved_child_tbl` WHERE ids='".$this->purchase_receive_id."' ";
            
          $array[39] = "INSERT INTO credit_debit_ledger (
                        company_id, company_name, project_id, project_name,
                        quotation_id, quotation_number, credit_amount, debit_amount,
                        invoice_id, invoice_number, tax_content, accounts_date, account_head
                    )
                    SELECT 
                        company_id,
                        company_name,
                        project_id,
                        project_name,
                        quotation_id,
                        quotation_number,
                        amount,   -- fixed field name to sub_total
                        0.000,                             -- debit_amount as numeric
                        tax,                                 -- invoice_id as integer
                        prd_no,                              -- invoice_number as string
                        tax,
                        add_to_project_date,
                        'Purchase Received'
                    FROM purchase_received_add_to_project
                    WHERE ids = 
                      " ;
                      
                      $array[40] = "INSERT INTO credit_debit_ledger (
                        company_id, company_name, project_id, project_name,
                        quotation_id, quotation_number, credit_amount, debit_amount,
                        invoice_id, invoice_number, tax_content, accounts_date, account_head
                    )
                    SELECT 
                        company_id,
                        company_name,
                        project_id,
                        project_name,
                        quotation_id,
                        quotation_number,
                        (amount*tax) / 100,   -- fixed field name to sub_total
                        0.000,                             -- debit_amount as numeric
                        tax,                                 -- invoice_id as integer
                        prd_no,                              -- invoice_number as string
                        tax,
                        add_to_project_date,
                        'Tax Payable'
                    FROM purchase_received_add_to_project
                    WHERE tax !=0 and ids = 
                      " ;
            
            $array[41] = "UPDATE purchase_recieved_child_tbl SET received_qty = received_qty + '".$this->v_required_quantity."'  WHERE ids='".$this->purchase_receive_id."'";
            
            $array[42] = "select * from purchase_received_add_to_project where purchase_receive_child_id = '".$this->v_approve_id."'";
		
		return $array; 
    } 
	
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'select_supplier_name':
                $this->varModelObj->CreateDropDown($var[0],'company_id','company_name',$this->v_supplier_ctrl_name, 'Select Supplier');
            break;
           
		    case 'select_job_no':
                $this->varModelObj->CreateDropDown($var[1],'work_order_main_id','work_order_number',$this->v_job_ctrl_name,'Select Work Order No');
            break;
			
			case 'select_pr_no':
                $this->varModelObj->CreateDropDownForPRN($var[2],'purchase_req_no','purchase_req_no',$this->v_pr_ctrl_name,'Select PR No',$this->v_prnn_no);
            break;
			case 'select_pr_no_v1':
                $this->varModelObj->CreateDropDownForPRN($var[27],'purchase_req_no','purchase_req_no',$this->v_pr_ctrl_name,'Select PR No',$this->v_prnn_no);
            break;
			case 'select_LPO_no':
                $this->varModelObj->CreateDropDown($var[3],'local_po_number','local_po_number',$this->v_lpo_ctrl_name,'Select LPO No');
            break;
			
			case 'select_unit_no':
                $this->varModelObj->CreateDropDown($var[4],'unit_id','unit_name',$this->v_qty_ctrl_name,'Select Unit');
            break;
			
			case 'select_tax_no':
               $this->varModelObj->CreateDropDown($var[5],'ids','tax_value',$this->v_tax_ctrl_name ,'10.00');
            break;
			
			case 'add_purchase_recieve':
			 //   echo $var[6];
				$this->varModelObj->ExecuteProcedure($var[6]);
				$this->varModelObj->UpdateTable($var[22]);
                $this->varModelObj->UpdateTable($var[25]);				
            break;
				
			case 'list_purchase_recieve':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[7]);
				echo $this->jsonValue; 
            break;
			
			case 'delete_pur_recie_item': 
                $this->varModelObj->DeleteRow($var[8]);
            break;
			
			case 'edit_purchase_recieve':  	
				$this->jsonValue = $this->varModelObj->UpdateTable($var[9]);
				echo $this->jsonValue;
            break; 
			
			case 'generate_purchase_recieve':
			     //  echo $var[6];
			    $this->msg = $this->varModelObj->ExecuteProcedureReturnMultiplevalues($var[6]);
			$data = json_decode($this->msg, true);  
			     $SQLString = "INSERT INTO purchase_recieved_child_tbl(store_category_id, store_category, inventory_id, inventory_name, description, quantity, unit, rate, tax, amount, item_code, recieved_date,entry_type, ref_no, master_ref_id,purchase_recieved_main_id,prd_no,lpo_no,purchase_req_child_id,company_id,company_name) VALUES ";
				  $SQLOther = "";
			    for($i=0;$i<=sizeof($this->array_table_data)-1;$i++){
			
			      $SQLOther = $SQLOther ."('".$this->array_table_data[$i][2]."','".$this->array_table_data[$i][1]."','".$this->array_table_data[$i][4]."','".$this->array_table_data[$i][3]."','".$this->array_table_data[$i][14]."','".$this->array_table_data[$i][6]."','".$this->array_table_data[$i][7]."','".$this->array_table_data[$i][8]."','".$this->array_table_data[$i][10]."','".$this->array_table_data[$i][11]."','".$this->array_table_data[$i][5]."','".$this->v_pur_recieve_date."','Purchase_recieved','".$data['msg']."', '".$data['msg1']."','".$data['msg1']."','".$data['msg']."', '".$this->v_lpo_no."','".$this->array_table_data[$i][12]."','".$this->v_supplier_id."', '".$this->v_supplier_name."'),";   
                  
			    }
			    
			        $x = substr_replace($SQLOther, "", -1);
					$SQLString = $SQLString.$x;
				// 	echo $SQLString;
					$ret =  $this->varModelObj->AddToTable($SQLString);
				// 	echo $ret;
					
					
					
				// 	update
			       $listofId = ''; // Correct variable name
                    $updateString = 'UPDATE local_po_child_tbl SET quantity_purchased = CASE local_po_child_id ';
                    for ($i = 0; $i < sizeof($this->array_table_data); $i++) {
                        $updateString .= 'WHEN ' . $this->array_table_data[$i][12] . ' THEN quantity_purchased + ' . $this->array_table_data[$i][6] . ' '; // Changed index from [6] to [11]
                        $listofId .= $this->array_table_data[$i][12] . ',';
                    }
                    $listofId = rtrim($listofId, ',');
                    $updateString .= 'ELSE quantity_purchased END WHERE local_po_child_id IN (' . $listofId . ');';
                    
                    // Assuming $this->varModelObj->UpdateTable() executes the SQL query
                    $this->varModelObj->UpdateTable($updateString);
			       	echo $ret;
			     
			     
				// $this->jsonValue = $this->varModelObj->UpdateTable($var[10]);
				// echo $this->jsonValue;
            break; 
            case 'generate_store_return':
			    $SQLString = "INSERT INTO purchase_recieved_child_tbl(store_category_id, store_category, inventory_id, inventory_name, description, quantity, unit, rate, tax, 	amount, item_code, recieved_date, company_id, company_name, project_id, project_name, recieved_name, ref_no, pr_rec_status) VALUES ";
				  $SQLOther = "";
			    for($i=0;$i<=sizeof($this->array_table_data)-1;$i++){
			
			      $SQLOther = $SQLOther ."('".$this->array_table_data[$i]['CategoryID']."','".$this->array_table_data[$i]['Category']."','".$this->array_table_data[$i]['ItemID']."','".$this->array_table_data[$i]['ItemName']."','".$this->array_table_data[$i]['Description']."','".$this->array_table_data[$i]['Qty']."','".$this->array_table_data[$i]['Unit']."','".$this->array_table_data[$i]['Rate']."','".$this->array_table_data[$i]['TaxPercentage']."','".$this->array_table_data[$i]['Amount']."','".$this->array_table_data[$i]['ItemCode']."','".$this->v_date."','".$this->company_id."','".$this->company_name."','".$this->project_id ."','".$this->project_name."','".$this->v_recieved_by."','".$this->v_ref_no."','Store Return'),";  
                  
			    }
			    
			        $x = substr_replace($SQLOther, "", -1);
					$SQLString = $SQLString.$x;
				// 	echo $SQLString;
					$ret =  $this->varModelObj->AddToTable($SQLString);
					echo $ret;
			
            break; 
            
			
			case 'list_table_pur_recie':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[11]);
				echo $this->jsonValue; 
            break;
            
            case 'list_table_pur_recie_approved':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[37]);
				echo $this->jsonValue; 
            break;
			
			case 'pur_recie_status_to_cancel':  	
				$this->jsonValue = $this->varModelObj->UpdateTable($var[12]);
				echo $this->jsonValue;
            break; 
			
			case 'list_table_cancelled_pur_recie':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[13]);
				echo $this->jsonValue; 
            break;
			
			case 'list_table_pur_recie_view_between':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[14]);
				echo $this->jsonValue; 
            break;
			
			case 'list_table_cancelled_pur_recie_between':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[15]);
				echo $this->jsonValue; 
            break;
			
			case 'purchase_recieve_status':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[16]);
				echo $this->jsonValue; 
            break;
			
			case 'list_purchase_recieve_by_prno':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[17]);
				echo $this->jsonValue; 
            break;
	//------------------------------------------------------------------------------------------//
			case 'list_purchase_recieve_add':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[18]);
				echo $this->jsonValue; 
            break;
			
			case 'list_purchase_recieve_add_second':
				//echo "Q  :".$var[20];
                $this->jsonValue = $this->varModelObj->ListFromTable($var[20]);
				echo $this->jsonValue; 
            break;
			
			case 'update_qty_in_delete':
                $this->varModelObj->UpdateTable($var[23]);
            break;
			
			case 'delete_purchase_recieve_second':
			    if($this->rowCount==1){
			     //   echo $var[35];
			        $this->varModelObj->UpdateTable($var[35]);
			        $this->jsonValue = $this->varModelObj->DeleteRow($var[21]);
			    }
			    else{
			        $this->jsonValue = $this->varModelObj->DeleteRow($var[21]);
			    }
                
            break;
			
			case 'delete_main_purchase_recieve':
                $this->jsonValue = $this->varModelObj->DeleteRow($var[24]);
            break;
		    
			case 'update_qty_in_delete_inventory':
                $this->varModelObj->UpdateTable($var[26]);
            break;
			
			case 'select_lpo_details':
			    
                $this->jsonValue = $this->varModelObj->ListFromTable($var[28]);
               //echo $var[28];
				echo $this->jsonValue; 
            break;
			case 'check_prd_status':
                $this->varModelObj->ListFromTable($var[29]);
				 
            break;
            case 'select_prd_pending_data':
                $this->varModelObj->ListFromTable($var[30]);
				 
            break;
            case 'cancel_prd_list':
                $this->varModelObj->UpdateTable($var[31]);
				 $this->varModelObj->ExecuteProcedure($var[32]);
            break;
            case 'list_store_return_view':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[33]);
				echo $this->jsonValue; 
            break;
            case 'update_child_lpo_pr':  
                //  $this->varModelObj->UpdateTable($var[22]);
                $res= $this->varModelObj->UpdateTable($var[34]);
                 echo $res;
            break;
            
            case 'update_confirm_status':  	
				$this->jsonValue = $this->varModelObj->UpdateTable($var[36]);
				echo $this->jsonValue;
            break; 
            
            case 'add_to_project':  	
				$this->jsonValue = $this->varModelObj->AddToTable($var[38]);
				$this->jsonValue_1 = $this->varModelObj->AddToTable($var[39].$this->jsonValue);
				$this->varModelObj->AddToTable($var[40].$this->jsonValue);
				$this->jsonValue = $this->varModelObj->UpdateTable($var[41]);
				
				echo $this->jsonValue_1;
            break; 
            case 'list_purchase_approve':
                $this->jsonValue = $this->varModelObj->ListFromTable($var[42]);
				echo $this->jsonValue; 
            break;
            
            
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
}//end of class

$obj = new purchase_recieveController();
$obj->RequestAccept($obj->actionevents);
?>