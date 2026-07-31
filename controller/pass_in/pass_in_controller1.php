<?php require ('../../model/common/common_functions.php');

class passIncontroller
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$company_id, $previous_qty, $v_gate_pass_date, $company_name, $v_vehicle_no, $v_driver_name;
        public $v_approved_by, $v_received_by, $v_description, $v_checked_by, $v_qty, $v_pass_no, $v_unit, $v_po_box, $v_telephone_no, $v_fax, $pn_company_id;
        public $v_attn, $v_start_date, $v_end_date, $v_project_id, $v_project_name, $v_inventory_id, $v_inventory_name, $array_table_data, $v_master_ids;
        public $job_no_id, $job_no, $v_location, $v_note,$v_issue_note_no,$v_pass_in_no;
    
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        
        
        
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
      
        $this->company_id = $_POST['v_company_id'];
        $this->company_name = $_POST['v_company_name'];
        $this->company_name = $this->varDBConnection->real_escape_string(($this->company_name));
        $this->v_address = $_POST['v_address'];
       
        $this->v_project_id = $_POST['v_project_id'] ;
        $this->v_project_name = $_POST['v_project_name'] ;
        $this->v_pass_in_date = $_POST['v_pass_in_date'] ;
        $this->v_po_box = $_POST['v_po_box'] ;
        $this->v_fax = $_POST['v_fax'] ;
        $this->v_attn = $_POST['v_attn'] ;
        $this->v_ids = $_POST['v_ids'] ;
        $this->child_ids = $_POST['child_ids'] ;
        // $this->v_pass_in_no = $_POST['v_pass_in_no'] ;
        $this->v_telephone_no = $_POST['v_telephone_no'] ;
        $this->v_inventory_id = $_POST['v_inventory_id'];
        $this->v_inventory_name = $_POST['v_inventory_name'];
        $this->v_approved_by = $_POST['v_approved_by'];
        $this->v_checked_by = $_POST['v_checked_by'];
        $this->v_received_by = $_POST['v_received_by'];
        $this->v_description = $_POST['v_description'];
        $this->v_qty = $_POST['v_qty'];
        $this->v_unit = $_POST['v_unit'];
        $this->v_pass_in_no = $_POST['v_pass_in_no'];
		$this->v_start_date = $_POST['txt_start_date'];
        $this->v_end_date = $_POST['txt_end_date'];
	    $this->array_table_data = $_POST['v_dataArray'];
	    $this->v_master_ids = $_POST['v_master_ids'];
	    $this->job_no_id = $_POST['job_no_id'];
	    $this->job_no = $_POST['job_no'];
	    $this->v_location = $_POST['v_location'];
	    $this->v_note = $_POST['v_note'];
	   $this->v_issue_note_no = $_POST['v_issue_note_no'];
	   
    }
	
    function SQLArray()
    { 
        $array =  array();
		
        // $array[1] = "CALL proc_generate_pass_in_v1('".$this->company_id."','".$this->company_name."','".$this->v_pass_in_date."','".$this->v_project_id."','".$this->v_project_name."','".$this->v_approved_by."','".$this->v_checked_by."','".$this->v_received_by."','".$this->v_description."','".$this->v_qty."','".$this->v_unit."','".$this->v_inventory_id."','".$this->v_inventory_name."','".$this->v_pass_in_no."',@msg, @msg1)";
		   $array[1] = "CALL proc_generate_pass_in_v1('".$this->company_id."','".$this->company_name."','".$this->v_pass_in_date."','".$this->v_project_id."','".$this->v_project_name."','".$this->v_approved_by."','".$this->v_checked_by."','".$this->v_received_by."','".$this->v_pass_in_no."','".$this->job_no."','".$this->job_no_id."','".$this->v_location."','".$this->v_note."', @msg, @msg1)";

		   $array[2] = "update pass_in_tbl set status='Generated' where pass_in_no='".$this->v_pass_in_no."'";
           $array[3] = "Call proc_list_passin_qty('".$this->v_project_id."',@msg)"; 
        // $array[4] = "update pass_in_tbl set status='Generated' where pass_in_no='".$this->v_pass_in_no."'";
           $array[5] = "CALL proc_update_pass_in('".$this->company_id."','".$this->company_name."','".$this->v_pass_in_date."','".$this->v_inventory_id."','".$this->v_inventory_name."','".$this->v_approved_by."','".$this->v_checked_by."','".$this->v_received_by."','".$this->v_description."','".$this->v_qty."','".$this->v_unit."','".$this->v_pass_in_no."','".$this->v_po_box."','".$this->v_telephone_no."','".$this->v_fax."','".$this->v_attn."','".$this->v_address."','".$this->child_ids."',@msg)";
        // $array[6] = "SELECT *, DATE_FORMAT(pass_in_tbl.pass_in_date, '%d-%m-%Y') AS pass_in_date_formated FROM pass_in_tbl order by pass_in_date asc"; 
           $array[6] = "SELECT pass_in_id,pass_in_no,company_id,company_name,project_name,project_id,FormatDate(pass_in_tbl.pass_in_date) AS pass_in_date,po_box,telephone,fax,attn,approved_by,checked_by,received_by,job_no,job_id,location,note FROM pass_in_tbl order by pass_in_date asc"; 
           $array[7] = "SELECT pass_in_id,pass_in_no,company_id,company_name,project_name,project_id,FormatDate(pass_in_tbl.pass_in_date) AS pass_in_date,po_box,telephone,fax,attn,approved_by,checked_by,received_by,job_no,job_id,location,note FROM pass_in_tbl where pass_in_date between '".$this->v_start_date."' and '".$this->v_end_date."'"; 
           $array[8] = "CALL proc_delete_pass_in_child('".$this->child_ids."','".$this->v_inventory_id."',@msg)";
        // $array[9] = "select contact_address_2 from company_details where company_id='".$this->company_id."'";
           $array[9] = "select address from pass_in_tbl where company_id='".$this->company_id."'";
		   $array[10] = "SELECT ids, store_category_id, store_category, inventory_id, inventory_name, description, quantity, unit, item_code, recieved_date, company_id, company_name, project_id, project_name, entry_type, ref_no, quantity, master_ref_id FROM purchase_recieved_child_tbl WHERE master_ref_id='".$this->v_master_ids."'";
		   $array[11] = "DELETE FROM `purchase_recieved_child_tbl` WHERE `ids`='".$this->child_ids."'";
		   $array[12] = "UPDATE purchase_recieved_child_tbl SET quantity='".$this->v_qty."', description='".$this->v_description."' WHERE ids='".$this->child_ids."'";
		   $array[13] = "DELETE FROM `pass_in_tbl` WHERE `pass_in_id`='".$this->v_master_ids."'";
		   $array[14] = "Call proc_list_passin_for_edit('".$this->v_pass_in_no."','".$this->v_project_id."',@msg)"; 
		   $array[15] = "UPDATE pass_in_tbl SET note='".$this->v_note."' WHERE pass_in_no='".$this->v_pass_in_no."'";
		  return $array;
    }
	
	
	
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
	  
        switch ($FunctionEvents)
        {
			
			
			case 'add_btn_action': 
			$this->varModelObj->ExecuteProcedure($var[1]);
            break;
			
	        case 'generate_pass_in': 
	           // echo $var[1];
	             $this->msg = $this->varModelObj->ExecuteProcedureReturnMultiplevalues($var[1]); 
	             
	        	$data1 = json_decode($this->msg, true);

							$SQLString = "INSERT INTO purchase_recieved_child_tbl(store_category_id, store_category, inventory_id, inventory_name, description, quantity,damage_qty, unit, item_code, recieved_date, company_id, company_name, project_id, project_name, entry_type, ref_no, master_ref_id) VALUES ";

                        // Loop through the data array
                        foreach ($this->array_table_data as $data) {
                            // Check if both damaged_qty and return_qty are non-zero
                            if ($data['damaged_qty'] != '0' && $data['return_qty'] != '0') {
                                
                                $quantity = $data['return_qty'];
                                $discription = $data['return_remark'];
                                $damage_qty = '0';
                                $values = "('" . $data['store_category_id'] . "', '" . $data['store_category'] . "', '" . $data['inventory_id'] . "', '" . $data['inventory_name'] . "', '" . $discription . "', '" . $quantity . "','".$damage_qty."', '" . $data['unit'] . "', '" . $data['item_code'] . "','".$this->v_pass_in_date."','".$this->company_id."','".$this->company_name."','".$this->v_project_id."','".$this->v_project_name."','PassIN', '".$data1['msg']."', '".$data1['msg1']."'),";  
                                $SQLString .= $values;
                        
                                
                                
                                $damage_qty = $data['damaged_qty'];
                                $quantity = '0';
                                $discription = $data['damaged_remark'];
                                $values = "('" . $data['store_category_id'] . "', '" . $data['store_category'] . "', '" . $data['inventory_id'] . "', '" . $data['inventory_name'] . "', '" . $discription . "', '" . $quantity . "','".$damage_qty."', '" . $data['unit'] . "', '" . $data['item_code'] . "','".$this->v_pass_in_date."','".$this->company_id."','".$this->company_name."','".$this->v_project_id."','".$this->v_project_name."','PassIN', '".$data1['msg']."', '".$data1['msg1']."'),";  
                                $SQLString .= $values;
                            } elseif ($data['damaged_qty'] != '0' || $data['return_qty'] != '0') {
                                // If only one of the quantities is non-zero, insert that value into the appropriate column and set the other column to 0
                                $quantity = $data['return_qty'] != '0' ? $data['return_qty'] : '0';
                                $discription = $data['return_qty'] != '0' ? $data['return_remark'] : $data['damaged_remark'];
                                $damage_qty = $data['damaged_qty'] != '0' ? $data['damaged_qty'] : '0';
                                $values = "('" . $data['store_category_id'] . "', '" . $data['store_category'] . "', '" . $data['inventory_id'] . "', '" . $data['inventory_name'] . "', '" . $discription . "', '" . $quantity . "','".$damage_qty."', '" . $data['unit'] . "', '" . $data['item_code'] . "','".$this->v_pass_in_date."','".$this->company_id."','".$this->company_name."','".$this->v_project_id."','".$this->v_project_name."','PassIN', '".$data1['msg']."', '".$data1['msg1']."'),";  
                                $SQLString .= $values;
                            }
                        }
                        
                        // Remove the trailing comma
                        $SQLString = rtrim($SQLString, ',');
                        // echo $SQLString;
                        // Perform the database insertion
                        $this->varModelObj->AddToTable($SQLString);
	        
// 			$this->varModelObj->UpdateTable($var[2]);
            break;

            case 'list_pass_in': 
                // echo $var[3];
            $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[3]);
            break;

          	case 'list_pass_in_for_edit': 
                // echo $var[3];
            $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[14]);
            break;	
			
			
			case 'save_btn_action':
			echo $var[5];
            $this->varModelObj->ExecuteProcedure($var[5]);
            break;
			
			case 'list_pass_in_view': 
			//echo $var[6];
			$this->varModelObj->ListFromTable($var[6]);
			break;

            case 'search_with_date': 
			$this->varModelObj->ListFromTable($var[7]);
            break;			 
		    
            case 'delete_pass_in_child': 
			$this->varModelObj->DeleteRow($var[8]);
            break; 			
            
			case 'delete_pass_in':
	
        $sql="select * from pass_in_child_tbl where pass_in_id='".$this->v_ids."'";
        $this->result = mysqli_query($this->varDBConnection,$sql);
	    while ($res = mysqli_fetch_assoc($this->result)) {
	    	$child_id =$res['pass_in_child_id'];
			$inventory_ids =$res['inventory_id'];
	
	
		$sql2="select quantity  from pass_in_child_tbl where pass_in_child_id='".$child_id."'";
	    $this->result2 = mysqli_query($this->varDBConnection,$sql2);
		while ($res2 = mysqli_fetch_assoc($this->result2)) {
	    	$quantity =$res2['quantity'];
		} 
		
		$sql3="update inventory_tbl set quantity_in=quantity_in-'".$quantity."' where ids='".$inventory_ids."'";		
        $this->varModelObj->UpdateTable($sql3);
		
		
		$sql4="delete from pass_in_child_tbl where pass_in_child_id='".$child_id."'";
        $this->varModelObj->DeleteRow($sql4);
		
		$sql5="delete from pass_in_tbl where pass_in_id='".$this->v_ids."'";
        $this->varModelObj->DeleteRow($sql5);
		
	}
        break; 			

        case 'select_address': 
		$this->varModelObj->ListFromTable($var[9]);
        break;	
        case 'select_child_table_details': 
			 // echo $var[10];
             $this->varModelObj->ListFromTable($var[10]);
        break;
        case 'delete_passin_child': 
		        
			 $this->varModelObj->DeleteRow($var[11]);
		break;
        case 'update_child': 
             //  echo $var[19];
	         $res=$this->varModelObj->UpdateTable($var[12]);
	        echo $res;
        break;
         case 'update_pass_in': 
            //  echo $var[15];
             $this->varModelObj->UpdateTable($var[15]);
            foreach ($this->array_table_data as $data) {
                    if ($data['up_damaged_child_id'] != '0' && $data['up_return_child_id'] != '0') {
                        // Update both damaged_qty and return_qty
                        $updateQuery1 = "UPDATE purchase_recieved_child_tbl 
                                        SET damage_qty = '" . $data['up_damaged_qty'] . "', 
                                            description = '" . $data['up_damaged_remark'] . "'
                                        WHERE ids = '" . $data['up_damaged_child_id'] . "'";
                        
                        $updateQuery2 = "UPDATE purchase_recieved_child_tbl 
                                        SET quantity = '" . $data['up_return_qty'] . "', 
                                            description = '" . $data['up_return_remark'] . "'
                                        WHERE ids = '" . $data['up_return_child_id'] . "'";
                        
                        // Perform the database updates separately
                        $this->varModelObj->UpdateTable($updateQuery1);
                        $this->varModelObj->UpdateTable($updateQuery2);
                    } elseif ($data['up_damaged_child_id'] != '0') {
                        // Update only damaged_qty
                        $updateQuery = "UPDATE purchase_recieved_child_tbl 
                                        SET damage_qty = '" . $data['up_damaged_qty'] . "', 
                                            description = '" . $data['up_damaged_remark'] . "'
                                        WHERE ids = '" . $data['up_damaged_child_id'] . "'";
                        
                        // Perform the database update
                        $this->varModelObj->UpdateTable($updateQuery);
                    } elseif ($data['up_return_child_id'] != '0') {
                        // Update only return_qty
                        $updateQuery = "UPDATE purchase_recieved_child_tbl 
                                        SET quantity = '" . $data['up_return_qty'] . "', 
                                            description = '" . $data['up_return_remark'] . "'
                                        WHERE ids = '" . $data['up_return_child_id'] . "'";
                        
                        // Perform the database update
                        $this->varModelObj->UpdateTable($updateQuery);
                    }
                }
                // $this->varModelObj->UpdateTable($updateQuery);
            
        break;
        
        case 'delete_pass_in_main': 
		        
			 $this->varModelObj->DeleteRow($var[13]);
		break;
		   
            default:   
             echo 'No Action Found...!';
            break;
            
        }

    }
}//end of class

$obj = new passIncontroller();
$obj->RequestAccept($obj->actionevents);
?>