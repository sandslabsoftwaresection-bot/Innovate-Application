<?php require ('../../model/common/common_functions.php');

class InventoryController
{
        var $varModelObj,$varDBConnection;
        public  $actionevents,$v_ctrl_name,$quotation_number, $quotation_date, $company_name, $po_box, $telephone_no;
        public $fax, $address, $attn, $quotation_reference, $LPO_no, $sub_total, $vat, $total_amount, $received_amount, $balane_in_due;
        public $received_by_id, $received_by_name, $quotation_created_date, $quotation_status, $description;
        public $quotation_child_id, $quotation_main_id, $quantity, $unit, $rate, $amount, $default_date,$discount_percentage,$amt_after_discount,$tax_percentage,$net_amount;
        public $company_id,$project_id,$project_name,$v_subject_id,$v_introduction_name,$v_introduction_id,$main_description,$subject;
        public $v_quotation_sub_total,$from_date,$to_date, $v_category, $v_ids, $v_unit_name, $v_item_name,$v_unit_id,$v_approved_status,$v_item_id,$sub_cat_name;
       
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        
        $this->v_ids  =  $_POST['v_ids'];
        $this->v_category_id = $_POST['v_category_id'];
        $this->v_category = $_POST['v_category'];
        $this->v_unit_name = $_POST['v_unit_name'];
        $this->v_item_name = $_POST['v_item_name'];
        $this->v_unit_id = $_POST['v_unit_id'];
        $this->v_approved_status = $_POST['v_approved_status'];
        $this->v_item_id = $_POST['v_item_id'];
        $this->v_sub_category_id = $_POST['v_sub_category_id'];
        $this->sub_cat_name = $_POST['sub_cat_name'];
        $this->v_itemName = $_POST['v_itemName'];
        
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] ="INSERT INTO `inventory_tbl`(`inventory_category`, `item_name`, `item_unit`, `status`) VALUES ('".$this->v_category."','".$this->v_item_name."','".$this->v_unit_name."','Generated')"; 
		//$array[0] = "CALL proc_add_product_master( '".$this->product_name."' ,'".$this->product_unit_id."','".$this->product_unit_name."','".$this->unit_rate."','".$this->product_description."',@msg)";
         
        $array[1] = "SELECT * from inventory_tbl order by ids desc";
        
        $array[2] = "update inventory_tbl set inventory_category='".$this->v_category."', item_name='".$this->v_item_name."', item_unit='".$this->v_unit_name."' WHERE ids='".$this->v_ids."'";
        $array[3] = "DELETE from inventory_tbl WHERE `ids`='".$this->v_ids."'";
   
        //$array[3] = "CALL proc_edit_product_master('".$this->product_master_id."', '".$this->product_name."' ,'".$this->product_unit_name."','".$this->unit_rate."','".$this->product_description."',@msg)";
        
		$array[4]= "SELECT ids,item_name FROM inventory_tbl WHERE inventory_category='".$this->v_category."' ";
        $array[5] ="INSERT INTO `inventory_main_category`(`cat_name`) VALUES ('".$this->v_item_name."')"; 
        $array[6]= "SELECT cat_name as item_name FROM inventory_main_category WHERE cat_name  LIKE '%" . $this->v_item_name . "%'  ";
        // $array[7] = "CALL proc_add_inventory_item('".$this->v_item_name."', '".$this->v_category_id."' ,'".$this->v_category."','".$this->v_unit_name."','".$this->v_unit_id."',@msg)";
        $array[7] = "CALL proc_add_inventory_item1('".$this->v_item_name."', '".$this->v_category_id."' ,'".$this->v_category."','".$this->v_sub_category_id."' ,'".$this->sub_cat_name."','".$this->v_unit_name."','".$this->v_unit_id."',@msg)";
        $array[8]= "SELECT ids,cat_name,status FROM inventory_main_category order by ids desc";
        $array[9] = "update inventory_main_category set status='Deactive' WHERE ids='".$this->v_category_id."'";
        $array[10] = "update inventory_main_category set status='Active' WHERE ids='".$this->v_category_id."'";
        $array[11]= "SELECT * FROM store_items order by item_id desc";
        $array[12] = "update store_items set status='Deactive' WHERE item_id='".$this->v_item_id."'";
        $array[13] = "update store_items set status='Active' WHERE item_id='".$this->v_item_id."'";
        $array[14]= "SELECT item_name as item_name FROM store_items WHERE cat_name  LIKE '%" . $this->v_item_name . "%'  ";
        $array[15]= "SELECT ids, sub_cat_name FROM inventory_sub_category WHERE main_cat_ids='".$this->v_category_id."' AND status='Active'";
        $array[16]= "INSERT INTO inventory_sub_category (main_cat_ids, sub_cat_name) VALUES ('".$this->v_category_id."','".$this->sub_cat_name."')";
        $array[17]= "SELECT item_id, item_name, item_code,cat_id,cat_name,unit,tax_value FROM store_items WHERE status = 'Active' AND `cat_id`='".$this->v_category_id."' AND `sub_cat_id`='".$this->v_sub_category_id."' ORDER BY item_name ASC";
        $array[18]= "INSERT INTO inventory_item (item_name) VALUES ('".$this->v_itemName."')";
        
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            
            case 'generate_inventory': 
            $this->varModelObj->AddToTable($var[0]);
            break;
            
            case 'list_inventory': 
                $this->varModelObj->ListFromTable($var[1]);
            break;
            
            case 'get_sub_category': 
                $this->varModelObj->ListFromTable($var[15]);
            break;

            case 'add_sub_category': 
                $this->varModelObj->AddToTable($var[16]);
            break;
            
            case 'add_item_name': 
                
                $this->varModelObj->AddToTable($var[18]);
            break;
            
            case 'get_store_item': 
                // echo $var[17];
                $this->varModelObj->ListFromTable($var[17]);
            break;
            
            case 'edit_inventory': 
                echo $var[2];
                $this->varModelObj->UpdateTable($var[2]);
            break;
            
			case 'delete_invetory_action': 
                $this->varModelObj->DeleteRow($var[3]);
                
            break;
			
			case 'select_category_item': 
             //echo "Q1  :".$var[4];
                $this->varModelObj->CreateDropDown($var[4],'ids','item_name',$this->ctrl_name,'Select Item');
            break;
            case 'generate_inventory_category': 
            $this->varModelObj->AddToTable($var[5]);
            break;
            case 'fetch_item': 
              //  echo $var[6];
				header("Content-Type: application/json"); // Specify JSON content type
                 echo $this->varModelObj->ListFromTableWithOutData($var[6]);
				exit();
            break;
            case 'fetch_category_item': 
              //  echo $var[6];
				header("Content-Type: application/json"); // Specify JSON content type
                 echo $this->varModelObj->ListFromTableWithOutData($var[14]);
				exit();
            break;
            
             case 'generate_inventory_item': 
               
                $this->res=$this->varModelObj->ExecuteProcedure($var[7]);
                echo $this->res;
            break;
            case 'list_inventory_category': 
                $this->varModelObj->ListFromTable($var[8]);
            break;
             case 'list_inventory_item': 
                $this->varModelObj->ListFromTable($var[11]);
            break;
            case 'status_change': 
              
              if(trim($this->v_approved_status)=='Active')
              {
                  
                 $this->varModelObj->UpdateTable($var[9]); 
              }
              else
              {
                  $this->varModelObj->UpdateTable($var[10]); 
              }
               
            break;
             case 'item_status_change': 
              
              if(trim($this->v_approved_status)=='Active')
              {
                  
                 $this->varModelObj->UpdateTable($var[12]); 
              }
              else
              {
                  $this->varModelObj->UpdateTable($var[13]); 
              }
               
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

$obj = new InventoryController();
$obj->RequestAccept($obj->actionevents);
?>