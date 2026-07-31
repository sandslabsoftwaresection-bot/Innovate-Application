<?php
 
require ('../../model/common/common_functions.php');

class allowence_controller
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_allowence_name, $v_deduction_name,$v_approved_status,$v_allowence_id,$v_deduction_id;
        
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_allowence_name = $_POST['v_allowence_name'];
        $this->v_deduction_name = $_POST['v_deduction_name'];
        $this->v_allowence_id = $_POST['v_allowence_id'];
        $this->v_approved_status = $_POST['v_approved_status'];
        $this->v_deduction_id = $_POST['v_deduction_id'];
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
// 		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
		$array[1] = "INSERT INTO `allowence_master_tbl`(`allow_title`) VALUES ('".$this->v_allowence_name."')";
        $array[2] = "SELECT count(*) as count FROM allowence_master_tbl where allow_title= '".$this->v_allowence_name."'";
        $array[3] = "INSERT INTO `deduction_master_tbl`(`deduc_name`) VALUES ('".$this->v_deduction_name."')";
        $array[4] = "SELECT count(*) as count FROM deduction_master_tbl where deduc_name= '".$this->v_deduction_name."'";
        $array[5] = "SELECT * FROM allowence_master_tbl";
        $array[6] = "update allowence_master_tbl set status='Deactive' WHERE ids='".$this->v_allowence_id."'";
        $array[7] = "update allowence_master_tbl set status='Active' WHERE ids='".$this->v_allowence_id."'";
        $array[8] = "update allowence_master_tbl set allow_title='".$this->v_allowence_name."' WHERE ids='".$this->v_allowence_id."'";
        $array[9] = "SELECT * FROM deduction_master_tbl";
        $array[10] = "update deduction_master_tbl set status='Deactive' WHERE ids='".$this->v_deduction_id."'";
        $array[11] = "update deduction_master_tbl set status='Active' WHERE ids='".$this->v_deduction_id."'";
        $array[12] = "update deduction_master_tbl set deduc_name='".$this->v_deduction_name."' WHERE ids='".$this->v_deduction_id."'";
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
            case 'add_allowence':
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
            case 'add_deduction':
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
            
             case 'list_allowence':
                
                 $this->varModelObj->ListFromTable($var[5]);
                
            break;
            case 'allowence_status_change':
                
                 if(trim($this->v_approved_status)=='Active')
              {
                  
                 $this->varModelObj->UpdateTable($var[6]); 
              }
              else
              {
                  $this->varModelObj->UpdateTable($var[7]); 
              }
            break;
            
             case 'update_allowence':
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
            
            case 'list_deduction':
                
                 $this->varModelObj->ListFromTable($var[9]);
                
            break;
            case 'deduction_status_change':
                
                 if(trim($this->v_approved_status)=='Active')
              {
                  
                 $this->varModelObj->UpdateTable($var[10]); 
              }
              else
              {
                  $this->varModelObj->UpdateTable($var[11]); 
              }
            break;
             case 'update_deduction':
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

$obj = new allowence_controller();
$obj->RequestAccept($obj->actionevents);
?>