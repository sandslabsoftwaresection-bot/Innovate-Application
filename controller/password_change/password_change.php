<?php require ('../../model/common/common_functions.php');

class ChangePassController
{
        var $varModelObj,$varDBConnection;
      
        public $v_approved_status;
       
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        
        $this->v_ids  =  $_POST['v_ids'];
       
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[1] = "SELECT * from inventory_tbl order by ids desc";
        
        $array[2] = "update inventory_tbl set inventory_category='".$this->v_category."', item_name='".$this->v_item_name."', item_unit='".$this->v_unit_name."' WHERE ids=$this->v_ids";
       
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            
           
            case 'list_inventory': 
                $this->varModelObj->ListFromTable($var[1]);
            break;
            
            case 'edit_inventory': 
                echo $var[2];
                $this->varModelObj->UpdateTable($var[2]);
            break;
            
		    default:
                echo 'No Action Found...!';
            break;
            
        }

    }
}//end of class

$obj = new ChangePassController();
$obj->RequestAccept($obj->actionevents);
?>