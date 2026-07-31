<?php

require ('../../model/common/common_functions.php');




class unit_controller
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$unit_id, $unit_name,$current_date;
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
        $this->unit_id = $_POST['v_unit_id'];
        $this->unit_name = $_POST['v_unit'];
        
        $this->unit_name = $this->varDBConnection->real_escape_string(($this->unit_name));
       
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        $this->subject_name_text = $this->varDBConnection->real_escape_string(($this->subject_name_text));
        
        
       
        
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "INSERT INTO unit_master(unit_name) VALUES ( '".$this->unit_name."')"; 
        $array[1] = "SELECT * FROM unit_master WHERE status='Active' order by unit_id desc ";
        $array[2] ="UPDATE unit_master SET unit_name='".$this->unit_name."' WHERE unit_id='".$this->unit_id."'";
        $array[3] ="UPDATE unit_master SET status='DeActive' where unit_id='".$this->unit_id."'";
       
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_unit': 
                 echo $var[0];
                $this->varModelObj->AddToTable($var[0]);
            break;
            
            case 'list_unit':
                $this->varModelObj->ListFromTable($var[1]);
            break;
            
             case 'edit_unit':
                //echo $var[2];
                $this->varModelObj->UpdateTable($var[2]);
            break;
            
             case 'cancel_unit':
                echo $var[3];
                $this->varModelObj->UpdateTable($var[3]);
            break;
            
           
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new unit_controller();
$obj->RequestAccept($obj->actionevents);
?>