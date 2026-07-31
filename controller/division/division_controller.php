<?php
 
require ('../../model/common/common_functions.php');

class division_controller
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_division_name, $v_department_name,$v_approved_status,$v_division_id,$v_department_id;
        
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_division_name = $_POST['v_division_name'];
        $this->v_department_name = $_POST['v_department_name'];
        $this->v_division_id = $_POST['v_division_id'];
        $this->v_approved_status = $_POST['v_approved_status'];
        $this->v_department_id = $_POST['v_department_id'];
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
// 		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
		$array[1] = "INSERT INTO `division_master`(`division_name`) VALUES ('".$this->v_division_name."')";
        $array[2] = "SELECT count(*) as count FROM division_master where division_name= '".$this->v_division_name."'";
        $array[3] = "INSERT INTO `department_master`(`department_name`) VALUES ('".$this->v_department_name."')";
        $array[4] = "SELECT count(*) as count FROM department_master where department_name= '".$this->v_department_name."'";
        $array[5] = "SELECT * FROM division_master";
        $array[6] = "update division_master set status='Deactive' WHERE ids='".$this->v_division_id."'";
        $array[7] = "update division_master set status='Active' WHERE ids='".$this->v_division_id."'";
        $array[8] = "update division_master set division_name='".$this->v_division_name."' WHERE ids='".$this->v_division_id."'";
        $array[9] = "SELECT * FROM department_master";
        $array[10] = "update department_master set status='Deactive' WHERE ids='".$this->v_department_id."'";
        $array[11] = "update department_master set status='Active' WHERE ids='".$this->v_department_id."'";
        $array[12] = "update department_master set department_name='".$this->v_department_name."' WHERE ids='".$this->v_department_id."'";
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
            case 'add_division':
                 $json_data=$this->varModelObj->ListFromTableReturn($var[2]);
                 $data = json_decode($json_data, true);
                 $count = $data['data'][0]['count'];
                 if($count>=1){
                    echo "exist";
                }
                else{
                    // echo $var[1];
                 $this->varModelObj->AddToTable($var[1]);
                }
            break;
            case 'add_department':
                 $json_data=$this->varModelObj->ListFromTableReturn($var[4]);
                 $data = json_decode($json_data, true);
                 $count = $data['data'][0]['count'];
                 if($count>=1){
                    echo "exist";
                }
                else{
                    // echo $var[1];
                 $this->varModelObj->AddToTable($var[3]);
                }
            break;
            
             case 'list_division':
                
                 $this->varModelObj->ListFromTable($var[5]);
                
            break;
            case 'division_status_change':
                
                 if(trim($this->v_approved_status)=='Active')
              {
                  
                 $this->varModelObj->UpdateTable($var[6]); 
              }
              else
              {
                  $this->varModelObj->UpdateTable($var[7]); 
              }
            break;
            
             case 'update_division':
                 $json_data=$this->varModelObj->ListFromTableReturn($var[2]);
                 $data = json_decode($json_data, true);
                 $count = $data['data'][0]['count'];
                 if($count>=1){
                    echo "exist";
                }
                else{
                    // echo $var[1];
                 $this->varModelObj->UpdateTable($var[8]);
                }
            break;
            
            case 'list_departments':
                
                 $this->varModelObj->ListFromTable($var[9]);
                
            break;
            case 'department_status_change':
                
                 if(trim($this->v_approved_status)=='Active')
              {
                  
                 $this->varModelObj->UpdateTable($var[10]); 
              }
              else
              {
                  $this->varModelObj->UpdateTable($var[11]); 
              }
            break;
             case 'update_department':
                 $json_data=$this->varModelObj->ListFromTableReturn($var[4]);
                 $data = json_decode($json_data, true);
                 $count = $data['data'][0]['count'];
                 if($count>=1){
                    echo "exist";
                }
                else{
                    // echo $var[1];
                 $this->varModelObj->UpdateTable($var[12]);
                }
            break;
            
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new division_controller();
$obj->RequestAccept($obj->actionevents);
?>