<?php
 
require ('../../model/common/common_functions.php');

class salary_controller
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_emp_id,$v_emp_name_id,$v_emp_name,$v_days,$v_start_time,$v_end_time,$v_normal_ot,$v_special_ot,$v_note,$array_table_data,$netamount,$v_main_id;
        public $v_from_date,$v_to_date,$v_div_id,$v_deptm_id,$v_date,$gosi_pr,$v_checkbx,$travel_allo_rt,$indemnity_rt,$rejoining_date;
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_emp_id = $_POST['v_emp_id'];
        $this->v_emp_name_id = $_POST['v_emp_name_id'];
        $this->v_emp_name = $_POST['v_emp_name'];
        $this->v_duty_hr = $_POST['v_duty_hr'];
        $this->v_days = $_POST['v_days'];
        $this->v_start_time = $_POST['v_start_time'];
        $this->v_end_time = $_POST['v_end_time'];
        $this->v_normal_ot = $_POST['v_normal_ot'];
        $this->v_special_ot = $_POST['v_special_ot'];
        $this->v_note = $_POST['v_note'];
        $this->array_table_data = $_POST['dataArray'];
        $this->netamount = $_POST['netamount'];
        $this->v_main_id = $_POST['v_main_id'];
        $this->v_from_date = $_POST['v_from_date'];
        $this->v_to_date = $_POST['v_to_date'];
        $this->v_div_id = $_POST['v_div_id'];
        $this->v_deptm_id = $_POST['v_deptm_id'];
        $this->v_date = $_POST['v_date'];
        $this->gosi_pr = $_POST['gosi_pr'];
        $this->v_checkbx = $_POST['v_checkbx'];
        $this->travel_allo_rt = $_POST['travel_allo_rt'];
        $this->indemnity_rt = $_POST['indemnity_rt'];
        $this->rejoining_date = $_POST['rejoining_date'];
        $this->last_date = $_POST['last_date'];
        $this->total_months = $_POST['total_months'];
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
		$array[0] = "SELECT e.ids as emp_id, e.employee_id, e.contact_no, e.division_name, e.dpmt_name, e.normal_ot_amt, e.special_ot_amt,e.gosi_pr,e.travel_allo_rate,e.indemnity_rate, s.duty_hr, s.days, s.starting_time, s.ending_time, s.ids 
    
        FROM emp_registration_tbl e LEFT JOIN (SELECT emp_tbl_id, MAX(salary_date) AS max_timestamp FROM salary_main_tbl GROUP BY emp_tbl_id ) latest_salary ON e.ids = latest_salary.emp_tbl_id LEFT JOIN salary_main_tbl s ON latest_salary.emp_tbl_id = s.emp_tbl_id AND latest_salary.max_timestamp = s.salary_date WHERE e.ids = '".$this->v_emp_id."'";
		$array[1] = "Call proc_add_salary_slip('".$this->v_emp_name_id."','".$this->v_duty_hr."','".$this->v_days."','".$this->v_start_time."','".$this->v_end_time."','".$this->v_normal_ot."','".$this->v_special_ot."','".$this->v_note."','".$this->netamount."','".$this->v_date."','".$this->gosi_pr."','".$this->v_checkbx."','".$this->travel_allo_rt."','".$this->indemnity_rt."','".$this->rejoining_date."','".$this->last_date."','".$this->total_months."',@msg)";
        $array[2] = "SELECT *,FormatDate(salary_date) as salary_date FROM salary_main_tbl ORDER BY salary_date DESC";
        $array[3] = "SELECT * FROM  salary_child_tbl where main_tbl_id='".$this->v_main_id."'";
        $array[4] = "Call proc_delete_salary_slip('".$this->v_main_id."',@msg)";
        $array[5] = "SELECT *,FormatDate(salary_date) as salary_date from salary_main_tbl where (DATE(salary_date) BETWEEN DATE('". $this->v_from_date."') AND DATE('".$this->v_to_date."')) and emp_tbl_id='".$this->v_emp_name_id."'"; 
        $array[6] = "SELECT *,FormatDate(salary_date) as salary_date from salary_main_tbl where (DATE(salary_date) BETWEEN DATE('". $this->v_from_date."') AND DATE('".$this->v_to_date."')) and div_id='".$this->v_emp_name_id."'"; 
        $array[7] = "SELECT *,FormatDate(salary_date) as salary_date from salary_main_tbl where (DATE(salary_date) BETWEEN DATE('". $this->v_from_date."') AND DATE('".$this->v_to_date."')) and dep_id='".$this->v_emp_name_id."'"; 
        $array[8] = "SELECT count(*) as count FROM  salary_main_tbl where emp_tbl_id='".$this->v_emp_name_id."' AND YEAR(salary_date) = YEAR('".$this->v_date."') AND MONTH(salary_date) = MONTH('".$this->v_date."')";
        $array[9] = "SELECT e.ids, e.employee_Name, e.employee_id, e.division_name, e.dpmt_name, COALESCE(s.earning_amt, '0.000') AS earning_amt 
FROM emp_registration_tbl e LEFT JOIN (SELECT emp_tbl_id, MAX(salary_date) AS latest_entry_date FROM salary_child_tbl WHERE allo_ded_tbl_id = '1' AND status = 'Allowence' GROUP BY emp_tbl_id) latest_salary ON e.ids = latest_salary.emp_tbl_id LEFT JOIN salary_child_tbl s ON latest_salary.emp_tbl_id = s.emp_tbl_id AND latest_salary.latest_entry_date = s.salary_date AND s.allo_ded_tbl_id = '1' AND s.status = 'Allowence'
WHERE e.status = 'Active'";
        
        //  $array[2] = "CALL proc_generate_gate_pass_v1('".$this->company_id."','".$this->company_name."', '".$this->v_project_id."','".$this->v_project_name."','".$this->v_gate_pass_date."','".$this->v_vehicle_no."','".$this->v_driver_name."','".$this->v_approved_by."','".$this->v_checked_by."','".$this->v_received_by."','".$this->v_inventory_id."','".$this->v_inventory_name."','".$this->v_description."','".$this->v_qty."','".$this->v_unit."','".$this->v_pass_no."','".$this->v_job_no."','".$this->job_no_id."','".$this->v_location."','". $this->v_note."',@msg,@msg1)";

        
//         $array[6] = "update division_master set status='Deactive' WHERE ids='".$this->v_division_id."'";
        
        return $array; 
        }
        
         function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {
            
            case 'load_employee_details':
                // echo $var[0];
                 $res=$this->varModelObj->ListFromTableReturn($var[0]);
                 $data = json_decode($res, true);
                // echo $data['data'][0]['ids'];
                $sql="SELECT earning_amt FROM salary_child_tbl where main_tbl_id=".$data['data'][0]['ids']." and allo_ded_tbl_id=1 and status='Allowence'";
                $res1 = $this->varModelObj->ListFromTableReturn($sql);
                $data1 = json_decode($res1, true);
                $sql2="SELECT MAX(rejoin_date) as rejoin_date FROM tbl_emp_rejoining where emp_tbl_id=".$data['data'][0]['emp_id']."";
                $res2 = $this->varModelObj->ListFromTableReturn($sql2);
                $data2 = json_decode($res2, true);
                $mergedData = array_merge_recursive($data,$data2,$data1);
                // echo $mergedData;
                $mergedJson = json_encode($mergedData);
                 echo $mergedJson;
               
            break;
             case 'generate_salary_slip': 
                 $res=$this->varModelObj->ListFromTableReturn($var[8]);
                 $data = json_decode($res, true);
                 $count = $data['data'][0]['count'];
                 if($count>=1){
                     echo "exist";
                 }
                 else{
                
        			$this->msg = $this->varModelObj->ExecuteProcedure($var[1]);
        			
       
        			 $SQLString = "INSERT INTO salary_child_tbl(main_tbl_id, emp_name, emp_tbl_id, allow_deduction, allo_ded_tbl_id, hrs, earning_amt, deduction_amt, description, status, days, salary_date) VALUES ";
        				  $SQLOther = "";
        			    for($i=0;$i<=sizeof($this->array_table_data)-1;$i++){
        			
        			      $SQLOther = $SQLOther ."('".$this->msg."','".$this->v_emp_name."','".$this->v_emp_name_id."','".$this->array_table_data[$i]['allo_ded']."','".$this->array_table_data[$i]['allo_ded_id']."','".$this->array_table_data[$i]['hrs']."','".$this->array_table_data[$i]['allo_amt']."','".$this->array_table_data[$i]['ded_amt']."','".$this->array_table_data[$i]['Description']."','".$this->array_table_data[$i]['status']."','".$this->array_table_data[$i]['days']."','".$this->v_date."'),";  
                          
        			    }
        			    
        			        $x = substr_replace($SQLOther, "", -1);
        					$SQLString = $SQLString.$x;
        					echo "-";
        					 $this->varModelObj->AddToTable($SQLString);  
                 }
		     break;
		     case 'list_salary_slips':
                 $this->varModelObj->ListFromTable($var[2]);
            break;
            case 'select_child_tbl':
                 $this->varModelObj->ListFromTable($var[3]);
            break;
            case 'Delete_salary_slip':
                 $this->varModelObj->ExecuteProcedure($var[4]);
            break;
            case 'list_salary_slips_name_search':
                
                    $this->varModelObj->ListFromTable($var[5]);
                
            break;
            case 'list_salary_slips_division_search':
                
                    $this->varModelObj->ListFromTable($var[6]);
                
            break;
            case 'list_salary_slips_depmnt_search':
                
                    $this->varModelObj->ListFromTable($var[7]);
                
            break;
            case 'list_basic_salaries':
                
                    $this->varModelObj->ListFromTable($var[9]);
                
            break;
              
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new salary_controller();
$obj->RequestAccept($obj->actionevents);
?>