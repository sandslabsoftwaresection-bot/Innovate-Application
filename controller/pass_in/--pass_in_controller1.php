<?php require ('../../model/common/common_functions.php');

class passIncontroller
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$company_id, $previous_qty, $v_gate_pass_date, $company_name, $v_vehicle_no, $v_driver_name;
        public $v_approved_by, $v_received_by, $v_description, $v_checked_by, $v_qty, $v_pass_no, $v_unit, $v_po_box, $v_telephone_no, $v_fax, $pn_company_id;
        public $v_attn, $v_start_date, $v_end_date, $v_project_id, $v_project_name, $v_inventory_id, $v_inventory_name;
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
        $this->company_name = $_POST['v_company_name'];
        $this->v_address = $_POST['v_address'];
       
        $this->v_project_id = $_POST['v_project_id'] ;
        $this->v_project_name = $_POST['v_project_name'] ;
        $this->v_pass_in_date = $_POST['v_pass_in_date'] ;
        $this->v_po_box = $_POST['v_po_box'] ;
        $this->v_fax = $_POST['v_fax'] ;
        $this->v_attn = $_POST['v_attn'] ;
        $this->v_ids = $_POST['v_ids'] ;
        $this->child_ids = $_POST['child_ids'] ;
        $this->v_pass_in_no = $_POST['v_pass_in_no'] ;
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
	   
    }
	
    function SQLArray()
    { 
        $array =  array();
		
          $array[1] = "CALL proc_generate_pass_in_v1('".$this->company_id."','".$this->company_name."','".$this->v_pass_in_date."','".$this->v_project_id."','".$this->v_project_name."','".$this->v_approved_by."','".$this->v_checked_by."','".$this->v_received_by."','".$this->v_description."','".$this->v_qty."','".$this->v_unit."','".$this->v_inventory_id."','".$this->v_inventory_name."','".$this->v_pass_in_no."',@msg)";
		  $array[2] = "update pass_in_tbl set status='Generated' where pass_in_no='".$this->v_pass_in_no."'";
          $array[3] = "SELECT * FROM pass_in_child_tbl where pass_in_no='".$this->v_pass_in_no."'"; 
          $array[4] = "update pass_in_tbl set status='Generated' where pass_in_no='".$this->v_pass_in_no."'";
          $array[5] = "CALL proc_update_pass_in('".$this->company_id."','".$this->company_name."','".$this->v_pass_in_date."','".$this->v_inventory_id."','".$this->v_inventory_name."','".$this->v_approved_by."','".$this->v_checked_by."','".$this->v_received_by."','".$this->v_description."','".$this->v_qty."','".$this->v_unit."','".$this->v_pass_in_no."','".$this->v_po_box."','".$this->v_telephone_no."','".$this->v_fax."','".$this->v_attn."','".$this->v_address."','".$this->child_ids."',@msg)";
          // $array[6] = "SELECT *, DATE_FORMAT(pass_in_tbl.pass_in_date, '%d-%m-%Y') AS pass_in_date_formated FROM pass_in_tbl order by pass_in_date asc"; 
          $array[6] = "SELECT pass_in_id,pass_in_no,company_id,company_name,project_name,DATE_FORMAT(pass_in_tbl.pass_in_date, '%d-%m-%Y') AS pass_in_date,po_box,telephone,fax,attn,approved_by,checked_by,received_by FROM pass_in_tbl order by pass_in_date asc"; 
          $array[7] = "SELECT pass_in_id,pass_in_no,company_id,company_name,project_name,DATE_FORMAT(pass_in_tbl.pass_in_date, '%d-%m-%Y') AS pass_in_date,po_box,telephone,fax,attn,approved_by,checked_by,received_by FROM pass_in_tbl where pass_in_date between '".$this->v_start_date."' and '".$this->v_end_date."'"; 
          $array[8] = "CALL proc_delete_pass_in_child('".$this->child_ids."','".$this->v_inventory_id."',@msg)";
         // $array[9] = "select contact_address_2 from company_details where company_id='".$this->company_id."'";
          $array[9] = "select address from pass_in_tbl where company_id='".$this->company_id."'";
		 
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
			$this->varModelObj->UpdateTable($var[2]);
            break;

            case 'list_pass_in': 
            $this->varModelObj->ListFromTable($var[3]);
            break;

            case 'generate_pass_in': 
			$this->varModelObj->UpdateTable($var[4]);
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
		   
            default:   
             echo 'No Action Found...!';
            break;
            
        }

    }
}//end of class

$obj = new passIncontroller();
$obj->RequestAccept($obj->actionevents);
?>