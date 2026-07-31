<?php
 
require ('../../model/common/common_functions.php');

class lpoEditController
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_child_ids, $cat_id,$cat_name,$item_id,$item_name,$item_code,$local_po_number,$v_lpo_number;
        
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_child_ids = $_POST['v_child_ids'];
        $this->cat_id = $_POST['cat_id'];
        $this->cat_name = $_POST['cat_name'];
        $this->item_id = $_POST['item_id'];
        $this->item_name = $_POST['item_name'];
        $this->item_code = $_POST['item_code'];
        $this->local_po_number = $_POST['local_po_number'];
        $this->v_lpo_number = $_POST['v_lpo_number'];
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
// 		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
        $array[1] = "SELECT local_po_child_id,description,item_id,category_name,category_id,item_code,unit  FROM local_po_child_tbl WHERE item_id=0";    
        $array[2] = "UPDATE local_po_child_tbl SET description='".$this->item_name."',item_id='".$this->item_id."',category_name='".$this->cat_name."',category_id='".$this->cat_id."',item_code='".$this->item_code."'  WHERE local_po_child_id='".$this->v_child_ids."'";    
        return $array; 
        }
        
         function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            // case 'list_store_item':
            //      $this->varModelObj->ExecuteProcedureForReturnTableFormat($var[0]);
            // break;
            case 'lpo_edit_load':
                // echo $var[1];
                 $this->varModelObj->ListFromTable($var[1]);
            break;
            case 'update_lpo_child':
                // echo $var[2];
                 $res=$this->varModelObj->UpdateTable($var[2]);
                 echo $res;    
            break;
           
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new lpoEditController();
$obj->RequestAccept($obj->actionevents);
?>