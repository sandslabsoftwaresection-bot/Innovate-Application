<?php

require ('../../model/common/common_functions.php');

class serviceController
{
        var $varModelObj,$varDBConnection;
        public  $actionevents,$company_id,$serviceName,$v_item_id;
        
    function __construct()
	{

        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];

        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        
        $this->service_note_number = $_POST['v_service_note_no'];
        $this->service_note_date = $_POST['v_service_note_date'];
        $this->company_name = $_POST['v_service_note_company_name'];
        $this->company_name = $this->varDBConnection->real_escape_string(($this->company_name));
        $this->po_box = $this->varDBConnection->real_escape_string($_POST['v_service_note_po_box']);
        $this->telephone_no = $_POST['v_service_note_contact_no'];
        $this->fax = $_POST['v_service_note_fax'];
        $this->attn = $this->varDBConnection->real_escape_string($_POST['v_service_note_attn']);
        $this->company_id = $_POST['v_company_id'];
        $this->service_type_id = $_POST['v_service_type_id'];
        $this->serviceName = $_POST['serviceName'];
        $this->v_item_id = $_POST['v_item_id'];
        // $this->array_table_data = $this->varDBConnection->real_escape_string($_POST['v_dataArray']);
        $this->array_table_data = $_POST['v_dataArray'];
        $this->v_ids = $_POST['v_ids'];
        $this->v_qty = $_POST['v_qty'];
        $this->v_remarks = $_POST['v_remarks'];
        $this->v_status = $_POST['v_status'];
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
        
        $array[0]= "SELECT company_id,company_name,contact_phone,city,fax,contact_person,contact_address_1 FROM company_details where company_id= ".$this->company_id." and status='Active' " ;
        
        $array[1] = "INSERT INTO `tbl_service_type`(`service_name`) VALUES ('".$this->serviceName."')";

        $array[2] = "CALL proc_add_service_note_main_list_v1( '".$this->service_note_number."','".$this->service_note_date."','".$this->company_id."','".$this->company_name."','".$this->po_box."','".$this->telephone_no."','".$this->fax."','".$this->attn."','".$this->service_type_id."','".$this->serviceName."',@msg)";
        
	    $array[4] ="SELECT DISTINCT service_note_main_tbl.* FROM service_note_main_tbl INNER JOIN service_note_child_tbl ON service_note_main_tbl.service_note_number = service_note_child_tbl.service_note_number WHERE service_note_status!= 'Cancelled'";
		
	    $array[5] ="UPDATE `service_note_main_tbl` SET `service_note_status`='Cancelled' WHERE `service_note_main_id`= '".$this->v_ids."' ";
		
		$array[6] = "SELECT `service_note_child_id`, `service_note_number`, `cat_id`, `service_id`, `service_name`, `remarks`, `quantity`, `default_date` FROM service_note_child_tbl AS tbl WHERE `service_note_number`= '".$this->service_note_number."'";
        
        $array[7] ="SELECT DISTINCT service_note_main_tbl.* FROM service_note_main_tbl INNER JOIN service_note_child_tbl ON service_note_main_tbl.service_note_number = service_note_child_tbl.service_note_number WHERE service_note_status= 'Cancelled'";
		
		$array[8] = "DELETE FROM `service_note_child_tbl` WHERE `service_note_child_id`='".$this->v_ids."'";
        
        $array[9] = "UPDATE service_note_child_tbl SET quantity='".$this->v_qty."', remarks='".$this->v_remarks."' WHERE service_note_child_id='".$this->v_ids."'";
        
        $array[10] ="UPDATE `service_note_main_tbl` SET `service_note_status`='Generated' WHERE `service_note_main_id`= '".$this->v_ids."' ";    
        
        $array[11] ="SELECT * From  tbl_service_type order by ids desc";    
        
        $array[12] = "Update tbl_service_type set status='Deactive'  where ids = ".$this->v_ids." ";  
        
        $array[13] = "Update tbl_service_type set status='Active'  where ids = ".$this->v_ids." ";
        
        $array[14] = "DELETE FROM `tbl_service_type` WHERE `ids`='".$this->v_ids."'";
        
        $array[15] = "Update tbl_service_type set service_name='".$this->serviceName."'  where ids = ".$this->v_ids." ";
        
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

           
            case 'select_company_details_for_service_note': 
                $this->varModelObj->ListFromTable($var[0]);
            break;
            
            case 'add_service_name':
                $this->varModelObj->AddToTable($var[1]);
            break;
			
			case 'add_service_note':
			    $this->msg = $this->varModelObj->ExecuteProcedureReturnMultiplevalues($var[2]);
			    $data = json_decode($this->msg, true);
			    
			    $SQLString = "INSERT INTO `service_note_child_tbl`( `service_note_number`, `cat_id`, `service_id`, `service_name`, `remarks`, `quantity`,`unit`)VALUES ";
				$SQLOther = "";
			    for($i=0;$i<=sizeof($this->array_table_data)-1;$i++){
			
			      $SQLOther = $SQLOther ."('".$data['msg']."','".$this->array_table_data[$i]['CompanyID']."','".$this->array_table_data[$i]['ServiceID']."','".$this->array_table_data[$i]['ServiceName']."','".$this->array_table_data[$i]['Description']."','".$this->array_table_data[$i]['Quantity']."','".$this->array_table_data[$i]['Unit']."'),";  
                  
			    }
			    $x = substr_replace($SQLOther, "", -1);
				$SQLString = $SQLString.$x;
				echo $SQLString;
				$this->varModelObj->AddToTable($SQLString);
            break;
            
            case 'list_service_note':
                $this->varModelObj->ListFromTable($var[4]);
		    break;
		    
		    case 'cancelled_service_note': 
			    $this->varModelObj->UpdateTable($var[5]);
		    break;
		    
		    case 'select_service_child_table_details': 
                $this->varModelObj->ListFromTable($var[6]);
            break;
            
            case 'list_cancelled_service_note':
                $this->varModelObj->ListFromTable($var[7]);
		    break;
		    
		    case 'delete_child_service_note': 
			    $this->varModelObj->DeleteRow($var[8]);
		    break;
		    
		    case 'update_child_service_note':
			    $this->varModelObj->UpdateTable($var[9]);
		    break;
		    
		    case 'reinitialize_service_note': 
			    $this->varModelObj->UpdateTable($var[10]);
		    break;
		    
		    case 'service_list': 
				$this->varModelObj->ListFromTable($var[11]);
		    break;
		    
		    case 'change_status_service':
			   if( $this->v_status == 'Active')
			      {
			        $this->effected_rows = $this->varModelObj->UpdateTable($var[12]);  
			        
			      }
			      else
			      {
			       $this->effected_rows = $this->varModelObj->UpdateTable($var[13]);
			      }
		    break;
		    
		    case 'delete_service_type': 
				$this->varModelObj->DeleteRow($var[14]);
		    break;
		    
		    case 'edit_service_name':
			    $this->varModelObj->UpdateTable($var[15]);
		    break;
		    
            default:
             echo 'No Action Found...!';
            break;
            
        }

    }
}//end of class

$obj = new serviceController();
$obj->RequestAccept($obj->actionevents);
?>