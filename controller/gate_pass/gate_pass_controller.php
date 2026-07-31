<?php require ('../../model/common/common_functions.php');

class gatepasscontrollerController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$company_id, $previous_qty, $v_gate_pass_date, $company_name, $v_vehicle_no, $v_driver_name;
        public $v_approved_by, $v_received_by, $v_description, $v_checked_by, $v_qty, $v_pass_no, $v_unit, $v_po_box, $v_telephone_no, $v_fax, $pn_company_id;
        public $v_attn, $v_start_date, $v_end_date, $v_project_id, $v_project_name, $v_inventory_id, $v_inventory_name, $v_gate_pass_ids;
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
       
        $this->v_gate_pass_date = $_POST['v_gate_pass_date'] ;
        $this->v_vehicle_no = $_POST['v_vehicle_no'];
        $this->v_driver_name = $_POST['v_driver_name'];
        $this->v_approved_by = $_POST['v_approved_by'];
        $this->v_checked_by = $_POST['v_checked_by'];
        $this->v_received_by = $_POST['v_received_by'];
		
		$this->v_project_id = $_POST['v_project_id'];
		$this->v_project_name = $_POST['v_project_name'];
		$this->v_inventory_id = $_POST['v_inventory_id'];
		$this->v_inventory_name = $_POST['v_inventory_name'];
		$this->v_inventory_category = $_POST['v_inventory_category'];
		 
        $this->v_description = $_POST['v_description'];
        $this->v_qty = $_POST['v_qty'];
        $this->v_unit = $_POST['v_unit'];
        $this->v_pass_no = $_POST['v_pass_no'];
        $this->v_po_box = $_POST['v_po_box'];
        $this->v_address = $_POST['v_address'];
        $this->v_telephone_no = $_POST['v_telephone_no'];
        $this->v_fax = $_POST['v_fax'];
        $this->v_attn = $_POST['v_attn'];
        $this->child_ids = $_POST['child_ids'];
       $this->v_start_date = $_POST['txt_start_date'];
       $this->v_end_date = $_POST['txt_end_date'];
	   $this->pn_company_id = $_POST['pn_company_id'];
	   $this->v_gate_pass_ids = $_POST['v_gate_pass_ids'];
       $this->start_dt=date('Y-m-d', strtotime($this->v_start_date));
       $this->end_dt=date('Y-m-d', strtotime($this->v_end_date));
    }
	
    function SQLArray()
    { 
        $array =  array();
		
         $array[1] = "SELECT unit_id,unit_name FROM unit_master where status='Active'";
         $array[2] = "CALL proc_generate_gate_pass_v1('".$this->company_id."','".$this->company_name."', '".$this->v_project_id."','".$this->v_project_name."','".$this->v_gate_pass_date."','".$this->v_vehicle_no."','".$this->v_driver_name."','".$this->v_approved_by."','".$this->v_checked_by."','".$this->v_received_by."','".$this->v_inventory_id."','".$this->v_inventory_name."','".$this->v_description."','".$this->v_qty."','".$this->v_unit."','".$this->v_pass_no."',@msg)";
		 $array[3] ="SELECT * FROM gate_pass_tbl INNER JOIN gate_pass_child_tbl ON gate_pass_tbl.gate_pass_id = gate_pass_child_tbl.gate_pass_id and gate_pass_status!='Cancelled' and gate_pass_tbl.pass_no='".$this->v_pass_no."'"; 
		 $array[4] = "update gate_pass_tbl set gate_pass_status='Generated' where pass_no='".$this->v_pass_no."'";
         $array[5] = "DELETE FROM `gate_pass_child_tbl` WHERE `gate_pass_child_id`='".$this->child_ids."'";
         $array[6] = "CALL proc_update_gate_pass('".$this->company_id."','".$this->company_name."','".$this->v_gate_pass_date."','".$this->v_vehicle_no."','".$this->v_driver_name."','".$this->v_approved_by."','".$this->v_checked_by."','".$this->v_received_by."','".$this->v_description."','".$this->v_qty."','".$this->v_unit."','".$this->v_pass_no."','".$this->v_po_box."','".$this->v_telephone_no."','".$this->v_fax."','".$this->v_attn."','".$this->v_address."','".$this->child_ids."',@msg)";
		 $array[7] = "select *,FormatDate(gate_pass_date) as gate_pass_date from gate_pass_tbl where gate_pass_status!='Cancelled' and gate_pass_date between '".$this->start_dt."' and '".$this->end_dt."'";
		 $array[8] = "SELECT * FROM gate_pass_tbl WHERE gate_pass_status= 'Cancelled'";
		 $array[9] = "select * from gate_pass_tbl where gate_pass_status='Cancelled' and gate_pass_date between '".$this->start_dt."' and '".$this->end_dt."'";
		 $array[10]= "SELECT company_id,company_name,contact_phone,city,fax,contact_person,contact_address_2,contact_address_1 FROM company_details where company_id= ".$this->company_id." and status='Active' ";
         $array[11] ="SELECT *,FormatDate(gate_pass_date) as gate_pass_date FROM gate_pass_tbl WHERE gate_pass_status = 'Generated'";
	     $array[12] ="CALL proc_delete_gate_pass_tbls('".$this->v_pass_no."',@msg)";
		 $array[13] = "SELECT project_main_id, project_main_name FROM project_main_table WHERE project_status='Active' AND company_id='".$this->pn_company_id."'";
		 $array[14] = "UPDATE inventory_tbl SET quanity_out=quanity_out+$this->v_qty WHERE ids='".$this->v_inventory_id."'";
		 $array[15]= "SELECT * FROM inventory_tbl WHERE inventory_category= '".$this->v_inventory_category."' ";
		 $array[16] = "SELECT ids, item_name FROM inventory_tbl WHERE inventory_category='".$this->pn_company_id."'";
        $array[17] = "SELECT ids, store_category_id, store_category, inventory_id, inventory_name, description, qty_out, unit, item_code, recieved_date, company_id, company_name, project_id, project_name, entry_type, ref_no, quantity, master_ref_id,(select SUM(quantity - qty_out) FROM purchase_recieved_child_tbl WHERE inventory_id = tbl.inventory_id) AS stock  FROM purchase_recieved_child_tbl AS tbl WHERE master_ref_id='".$this->v_gate_pass_ids."' AND entry_type= 'IssueNote'";
        $array[18] = "DELETE FROM `purchase_recieved_child_tbl` WHERE `ids`='".$this->child_ids."'";
         $array[19] = "UPDATE purchase_recieved_child_tbl SET qty_out='".$this->v_qty."', description='".$this->v_description."' WHERE ids='".$this->child_ids."'";
         $array[20] = "SELECT * FROM store_items WHERE item_id='".$this->v_inventory_id."'";
        $array[21] = "SELECT work_order_main_id, work_order_number FROM work_order_tbl WHERE work_order_status='Generated' AND project_id='".$this->v_project_id."'";
	    $array[22] ="SELECT *,FormatDate(gate_pass_date) as gate_pass_date FROM gate_pass_new_tbl WHERE gate_pass_status = 'Generated'";
	    $array[23] = "select *,FormatDate(gate_pass_date) as gate_pass_date from gate_pass_new_tbl where gate_pass_status!='Cancelled' and gate_pass_date between '".$this->start_dt."' and '".$this->end_dt."'";
	    $array[24] = "SELECT * FROM gate_pass_child_tbl WHERE gate_pass_id='".$this->v_gate_pass_ids."'";
	    $array[25] = "UPDATE gate_pass_child_tbl SET quantity='".$this->v_qty."', description='".$this->v_description."' WHERE gate_pass_child_id='".$this->child_ids."'";
	    $array[26] = "DELETE FROM `gate_pass_child_tbl` WHERE `gate_pass_child_id`='".$this->child_ids."'";
	    $array[27] = "DELETE FROM `gate_pass_new_tbl` WHERE `pass_no`='".$this->v_pass_no."'";
	 
	 
	  return $array;
    }
	
	
	
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
	  
        switch ($FunctionEvents)
        {
			
			case 'select_unit': 
			$this->varModelObj->CreateDropDown($var[1],'unit_id','unit_name',$this->ctrl_name,'Select Unit');
            break;   
            
		    case 'add_btn_action':
            $this->varModelObj->ExecuteProcedure($var[2]);
			$this->varModelObj->UpdateTable($var[14]);
		    break;
			
			 case 'list_gate_pass': 
			 $this->varModelObj->ListFromTable($var[3]);
		     break;
			
			 case 'generate_gate_pass': 
             $this->varModelObj->UpdateTable($var[4]);
		     break;
			
			 case 'delete_gate_pass': 
			 $this->varModelObj->DeleteRow($var[5]);
		     break;
		     case 'delete_gatepass_child': 
		        
			 $this->varModelObj->DeleteRow($var[18]);
		     break;
			
			 case 'save_btn_action':
				$result = mysqli_query($this->varDBConnection,"SELECT quanity_out FROM inventory_tbl WHERE ids='".$this->v_inventory_id."'");
				while($row=mysqli_fetch_assoc($result))
				{ 
			      $this->previous_qty = $row['quanity_out'];
				}
			 $this->varModelObj->UpdateTable("UPDATE inventory_tbl SET quanity_out=(quanity_out-$this->previous_qty)+$this->v_qty WHERE ids='".$this->v_inventory_id."'");
			 $this->varModelObj->UpdateTable($var[6]);
		     break;

             case 'delete_gate_pass_action': 
			 $this->varModelObj->UpdateTable($var[12]);
		     break;
			 
			 case 'list_gate_pass_view':
             $this->varModelObj->ListFromTable($var[11]);
		     break;
			
			 case 'search_with_date': 
			 $this->varModelObj->ListFromTable($var[7]);
		     break;
			
             case 'list_cancelled_gate_pass': 
             $this->varModelObj->ListFromTable($var[8]);
		     break;
			  
			 case 'cancelled_search_with_date': 
             $this->varModelObj->ListFromTable($var[9]);
		     break;
			
			 case 'select_company_details': 
			 // echo $var[10];
             $this->varModelObj->ListFromTable($var[10]);
             break;
             case 'select_child_table_details': 
			 // echo $var[10];
             $this->varModelObj->ListFromTable($var[17]);
             break;
			 
			case 'select_project_name': 
			     $this->varModelObj->CreateDropDown($var[13],'project_main_id','project_main_name',$this->ctrl_name,'Select Project');
            break;
            case 'select_job_no_lst': 
			     $this->varModelObj->CreateDropDown($var[21],'work_order_main_id','work_order_number',$this->ctrl_name,'Select Job No');
            break;
			
			case 'select_inventory_details': 
			 // echo $var[15];
             $this->varModelObj->ListFromTable($var[15]);
             break;
			 
			 case 'select_category_item_name': 
			 //echo "Q2  :".$var[16];
			     $this->varModelObj->CreateDropDown($var[16],'ids','item_name',$this->ctrl_name,'Select Item');
            break;
             case 'update_child': 
                //  echo $var[19];
			 $res=$this->varModelObj->UpdateTable($var[19]);
			 echo $res;
		     break;
		     case 'select_unit_for_pass_in':      
        
			 $this->varModelObj->ListFromTable($var[20]);
			 
		     break;
		      case 'gate_pass_new_list':
             $this->varModelObj->ListFromTable($var[22]);
		     break;
		     case 'search_with_date_new_gp': 
			 $this->varModelObj->ListFromTable($var[23]);
		     break;
		      case 'select_child_table_gate_pass': 
			 // echo $var[24];
             $this->varModelObj->ListFromTable($var[24]);
             break;
             case 'update_child_gp': 
                //  echo $var[19];
			 $res=$this->varModelObj->UpdateTable($var[25]);
			 echo $res;
		     break;
		    case 'delete_child_gp': 
		        
			 $this->varModelObj->DeleteRow($var[26]);
		     break;
		     case 'delete_gate_pass_main': 
			 $this->varModelObj->DeleteRow($var[27]);
		     break;

            default:   
             echo 'No Action Found...!';
            break;
            
        }

    }
}//end of class

$obj = new gatepasscontrollerController();
$obj->RequestAccept($obj->actionevents);
?>