<?php

require ('../../model/common/common_functions.php');




class subject_controller
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$subject_id, $subject_name,$current_date;
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
        $this->subject_id = $_POST['v_subject_id'];
        $this->subject_name = $_POST['v_subject'];
        $this->subject_name_text = $_POST['v_subject_text'];
        
        $this->subject_name = $this->varDBConnection->real_escape_string(($this->subject_name));
       
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        $this->subject_name_text = $this->varDBConnection->real_escape_string(($this->subject_name_text));
        
        
       
        
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "INSERT INTO `subject_details`( `subject`,`default_date`,subject_text) VALUES ( '".$this->subject_name."','".$this->current_date."','".$this->subject_name_text."')";
        $array[1] = "select * from subject_details where status='Active' order by subject_id desc ";
        $array[2] ="update subject_details set `subject`='".$this->subject_name."',`subject_text`='".$this->subject_name_text."' where subject_id='".$this->subject_id."'";
        $array[3] ="update subject_details set `status`='DeActive' where subject_id='".$this->subject_id."'";
       
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_subject':
                 echo $var[0];
                $this->varModelObj->AddToTable($var[0]);
            break;
            
            
            
            case 'list_subject':
             // echo $var[1];
                $this->varModelObj->ListFromTable($var[1]);
            break;
            
            
            
             case 'edit_subject':
                echo $var[2];
                $this->varModelObj->UpdateTable($var[2]);
            break;
            
             case 'cancel_subject':
                echo $var[3];
                $this->varModelObj->UpdateTable($var[3]);
            break;
            
           
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new subject_controller();
$obj->RequestAccept($obj->actionevents);
?>