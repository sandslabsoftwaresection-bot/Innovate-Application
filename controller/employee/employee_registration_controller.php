<?php
 
require ('../../model/common/common_functions.php');

class employee_registration_controller
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_employee_name, $v_employee_id,$v_employee_cpr,$v_passporrt_no,$v_joining_date,$v_email,$v_contact,$v_native_con,$v_native_con_pr;
        public $v_div_name,$v_div_id,$v_depmt_name,$v_depmt_id,$v_id,$v_approved_status,$v_from_date,$v_to_date,$v_normal_ot,$v_special_ot,$v_travel_allo,$v_indemnity;
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_employee_name = $_POST['v_employee_name'];
        $this->v_employee_id = $_POST['v_employee_id'];
        $this->v_employee_cpr = $_POST['v_employee_cpr'];
        $this->v_passporrt_no = $_POST['v_passporrt_no'];
        $this->v_joining_date = $_POST['v_joining_date'];
        $this->v_email = $_POST['v_email'];
        $this->v_contact = $_POST['v_contact'];
        $this->v_native_con = $_POST['v_native_con'];
        $this->v_native_con_pr = $_POST['v_native_con_pr'];
        $this->v_div_name = $_POST['v_div_name'];
        $this->v_div_id = $_POST['v_div_id'];
        $this->v_depmt_name = $_POST['v_depmt_name'];
        $this->v_depmt_id = $_POST['v_depmt_id'];
        $this->v_id = $_POST['v_id'];
        $this->v_approved_status = $_POST['v_approved_status'];
        $this->v_from_date = $_POST['v_from_date'];  
        $this->v_to_date = $_POST['v_to_date'];
        $this->v_normal_ot = $_POST['v_normal_ot'];
        $this->v_special_ot = $_POST['v_special_ot'];
        $this->v_gosi = $_POST['v_gosi'];
        $this->v_travel_allo = $_POST['v_travel_allo'];
        $this->v_indemnity = $_POST['v_indemnity'];
        $this->v_rejoining_date = $_POST['v_rejoining_date'];
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
// 		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
		$array[1] = "INSERT INTO `emp_registration_tbl`(`employee_Name`,employee_id,cpr,passport_no,join_date,email,contact_no,native_contact_no,native_contact_person,division_name,division_id,dpmt_name,	dpmt_id, normal_ot_amt, special_ot_amt,gosi_pr,travel_allo_rate,indemnity_rate) VALUES ('".$this->v_employee_name."','".$this->v_employee_id."','".$this->v_employee_cpr."','".$this->v_passporrt_no."','".$this->v_joining_date."','".$this->v_email."','".$this->v_contact."','".$this->v_native_con."','".$this->v_native_con_pr."','".$this->v_div_name."','".$this->v_div_id."','".$this->v_depmt_name."','".$this->v_depmt_id."','".$this->v_normal_ot."','".$this->v_special_ot."','".$this->v_gosi."','".$this->v_travel_allo."','".$this->v_indemnity."')";
        $array[2] = "SELECT count(*) as count FROM emp_registration_tbl where cpr= '".$this->v_employee_cpr."'";
        $array[3] = "SELECT *,FormatDate(join_date) as join_date,(select MAX(rejoin_date) from tbl_emp_rejoining where emp_tbl_id = e.ids) as rejoining_date from emp_registration_tbl e";
        $array[4] = "update emp_registration_tbl set status='Deactive' WHERE ids='".$this->v_id."'";
        $array[5] = "update emp_registration_tbl set status='Active' WHERE ids='".$this->v_id."'";
        $array[6] = "SELECT count(*) as count FROM emp_registration_tbl where cpr= '".$this->v_employee_cpr."' and ids!='".$this->v_id."'";
        $array[7] = "update emp_registration_tbl set employee_Name='".$this->v_employee_name."',employee_id='".$this->v_employee_id."',cpr='".$this->v_employee_cpr."',passport_no='".$this->v_passporrt_no."',join_date='".$this->v_joining_date."',email='".$this->v_email."',contact_no='".$this->v_contact."',native_contact_no='".$this->v_native_con."',native_contact_person='".$this->v_native_con_pr."',division_name='".$this->v_div_name."',division_id='".$this->v_div_id."',dpmt_name='".$this->v_depmt_name."',dpmt_id='".$this->v_depmt_id."',normal_ot_amt='".$this->v_normal_ot."',special_ot_amt='".$this->v_special_ot."', gosi_pr='".$this->v_gosi."',travel_allo_rate='".$this->v_travel_allo."',indemnity_rate='".$this->v_indemnity."' WHERE ids='".$this->v_id."'";
        $array[8] = "SELECT *,FormatDate(join_date) as join_date,(select MAX(rejoin_date) from tbl_emp_rejoining where emp_tbl_id = e.ids) as rejoining_date from emp_registration_tbl e where DATE(join_date) BETWEEN DATE('". $this->v_from_date."') AND DATE('".$this->v_to_date."')"; 
        $array[9] = "SELECT *,FormatDate(join_date) as join_date,(select MAX(rejoin_date) from tbl_emp_rejoining where emp_tbl_id = e.ids) as rejoining_date from emp_registration_tbl e where ids='".$this->v_id."'";
        $array[10] = "SELECT *,FormatDate(join_date) as join_date,(select MAX(rejoin_date) from tbl_emp_rejoining where emp_tbl_id = e.ids) as rejoining_date from emp_registration_tbl e where contact_no='".$this->v_contact."'";
        $array[11] = "SELECT normal_ot_amt,special_ot_amt,gosi_pr,travel_allo_rate,indemnity_rate from emp_registration_tbl WHERE default_date = (SELECT MAX(default_date) FROM emp_registration_tbl)";
        $array[12] = "update emp_registration_tbl set normal_ot_amt='".$this->v_normal_ot."'";
        $array[13] = "update emp_registration_tbl set special_ot_amt='".$this->v_special_ot."'";
        $array[14] = "update emp_registration_tbl set gosi_pr='".$this->v_gosi."'";
        $array[15] = "update emp_registration_tbl set travel_allo_rate='".$this->v_travel_allo."'";
        $array[16] = "update emp_registration_tbl set indemnity_rate='".$this->v_indemnity."'";
        $array[17] = "INSERT INTO `tbl_emp_rejoining`(emp_tbl_id,`rejoin_date`) values('".$this->v_id."','".$this->v_rejoining_date."')";
        return $array; 
        }
        
         function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            
            
            
            
            case 'register_emp':
                 $json_data=$this->varModelObj->ListFromTableReturn($var[2]);
                 $data = json_decode($json_data, true);
                 $count = $data['data'][0]['count'];
                 if($count>=1){
                    echo "exist";
                }
                else{
                    $res=$this->varModelObj->AddToTable($var[1]);
                    $this->varModelObj->AddToTable("INSERT INTO `tbl_emp_rejoining`(`emp_tbl_id`,rejoin_date) VALUES('".$res."','".$this->v_rejoining_date."')");
                }
            break;
             case 'list_employees':
                
                    $this->varModelObj->ListFromTable($var[3]);
                
            break;
            case 'user_status_change':
                echo $this->v_approved_status;
                 if(trim($this->v_approved_status)=='Active')
                  {
                      
                     $this->varModelObj->UpdateTable($var[4]); 
                  }
                  else
                  {
                      $this->varModelObj->UpdateTable($var[5]); 
                  }
            break;
            case 'update_emp':
                 $json_data=$this->varModelObj->ListFromTableReturn($var[6]);
                 $data = json_decode($json_data, true);
                 $count = $data['data'][0]['count'];
                if($count>=1){
                    echo "exist";
                    }
                else{
                    $this->varModelObj->UpdateTable($var[7]);
                    }
            break;
            case 'list_employees_between_date':
                
                    $this->varModelObj->ListFromTable($var[8]);
                
            break;
            
            case 'list_employees_searchby_name':
                
                    $this->varModelObj->ListFromTable($var[9]);
                
            break;
             case 'list_employees_searchby_number':
                
                    $this->varModelObj->ListFromTable($var[10]);
                
            break;
            case 'select_ot_rates':
                
                    $this->varModelObj->ListFromTable($var[11]);
                
            break;
            case 'update_normalot_for_all':
                
                    $this->varModelObj->UpdateTable($var[12]);
                
            break;
            case 'update_special_for_all':
                
                    $this->varModelObj->UpdateTable($var[13]);
                
            break;
            case 'update_gosi_for_all':
                
                    $this->varModelObj->UpdateTable($var[14]);
                
            break;
            case 'update_travel_allo_for_all':
                
                    $this->varModelObj->UpdateTable($var[15]);
                
            break;
            case 'update_indemnity_for_all':
                
                    $this->varModelObj->UpdateTable($var[16]);
                
            break;
            case 'update_rejoining_date':
                
                    $this->varModelObj->AddToTable($var[17]);
                
            break;
            
            
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new employee_registration_controller();
$obj->RequestAccept($obj->actionevents);
?>