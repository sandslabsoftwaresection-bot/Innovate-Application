<?php

require ('../../model/common/common_functions.php');




class amount_type_controller
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$amt_type_id, $amt_type,$current_date;
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
        $this->amt_type_id = $_POST['v_amt_type_id'];
        $this->amt_type = $_POST['v_amt_type'];
        
        $this->amt_type = $this->varDBConnection->real_escape_string(($this->amt_type));
       
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        $this->subject_name_text = $this->varDBConnection->real_escape_string(($this->subject_name_text));
        
        
       
        
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "INSERT INTO amount_type_tbl(type_name) VALUES ( '".$this->amt_type."')"; 
        $array[1] = "SELECT * FROM amount_type_tbl WHERE status='Active' order by type_id desc ";
        $array[2] ="UPDATE amount_type_tbl SET type_name='".$this->amt_type."' WHERE type_id='".$this->amt_type_id."'";
        $array[3] ="UPDATE amount_type_tbl SET status='DeActive' WHERE type_id='".$this->amt_type_id."'";
       
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_amt_type': 
                 echo $var[0];
                $this->varModelObj->AddToTable($var[0]);
            break;
            
            case 'list_amt_type':
                $this->varModelObj->ListFromTable($var[1]);
            break;
            
             case 'edit_amt_type':
                //echo $var[2];
                $this->varModelObj->UpdateTable($var[2]);
            break;
            
             case 'cancel_amt_type':
                echo $var[3];
                $this->varModelObj->UpdateTable($var[3]);
            break;
            
           
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new amount_type_controller();
$obj->RequestAccept($obj->actionevents);
?>