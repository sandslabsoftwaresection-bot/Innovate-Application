<?php

require ('../../model/common/common_functions.php');




class companyController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$project_id,$project_name,$company_id, $company_name,$reference_no,$signed_date, $contact_phone,$fax_number;
        public  $contact_person,$contact_address, $contract_value, $variations, $tax_id, $tax_name,$tax_value,  $project_description, $current_date,$ctrl_name;
        public $v_company_id,$v_company_name,$v_project_id,$v_project_name,$v_reference_no,$v_signed_date,$v_contact_phone,$v_contact_address,$v_fax_number,$v_contract_value;
        public $v_variations,$v_tax_id,$v_tax_name,$v_tax_value,$v_project_description;
        
    function __construct()
	{
	   
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
        $this->company_id = $_POST['v_company_id'];
        $this->company_name = $_POST['v_company_name'];
        $this->company_name = $this->varDBConnection->real_escape_string(($this->company_name));
        $this->project_id = $_POST['v_project_id'];
        $this->project_name = $_POST['v_project_name'];
        $this->project_name = $this->varDBConnection->real_escape_string(($this->project_name));
        $this->reference_no = $_POST['v_reference_no'];
        $this->signed_date = $_POST['v_signed_date'];
        $this->signed_date= date("Y-m-d", strtotime($this->signed_date) );
        $this->contact_phone = $_POST['v_contact_phone'];
        $this->contact_person = $_POST['v_contact_person'];
        $this->contact_person = $this->varDBConnection->real_escape_string(($this->contact_person));
        
        $this->contact_address = $_POST['v_contact_address'];
        $this->contact_address = $this->varDBConnection->real_escape_string(($this->contact_address));
        $this->fax_number = $_POST['v_fax_number'];
        $this->contract_value = $_POST['v_contract_value'];
        $this->variations = $_POST['v_variations'];
        $this->tax_id = $_POST['v_tax_id'];
        $this->tax_name = $_POST['v_tax_name'];
        $this->tax_name = $this->varDBConnection->real_escape_string(($this->tax_name));
        $this->tax_percentage = $_POST['v_tax_value'];
        $this->tax_value=((floatval($this->contract_value)+floatval($this->variations))*(floatval($this->tax_percentage/100)));
        
        //$this->tax_value=($this->contract_value*($this->tax_percentage/100));
        
        $this->project_description= $_POST['v_project_description'];
        $this->project_description = $this->varDBConnection->real_escape_string(($this->project_description));
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        $this->tax_content = $_POST['v_tax_content'];
        
        
       
        
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
       // $array[0] = "INSERT INTO `project_details`( `project_name`, `company_id`, `company_name`, `reference_no`, `contract_signed_date`, `phone_number`, `fax_number`, `contact_person`, `address`, `contract_value`, `variations`, `tax_id`, `tax_name`,`tax_value`,`project_description`, `default_date`) VALUES ('".$this->project_name."','".$this->company_id."','".$this->company_name."','".$this->reference_no."','".$this->signed_date."','".$this->contact_phone."','".$this->fax_number."','".$this->contact_person."','".$this->contact_address."','".$this->contract_value."','".$this->variations."','".$this->tax_id."','".$this->tax_name."','".$this->tax_value."','".$this->project_description."','".$this->current_date."')";
        
        $array[0] = "INSERT INTO `project_main_table`( `project_main_name`, `company_id`, `company_name`,`tax_content` ,`default_date`) VALUES ('".$this->project_name."','".$this->company_id."','".$this->company_name."','".$this->tax_content."','".$this->current_date."')";
        
        
        $array[1] = "select *,date_format(default_date,'%d/%m/%Y') as default_date from project_main_table where project_status='Active' and project_number = '' or  project_number is null order by company_id desc";
        // $array[2] ="update project_details set `project_name`='".$this->project_name."',`company_id`='".$this->company_id."',`company_name`='".$this->company_name."',`reference_no`='".$this->reference_no."',`contract_signed_date`='".$this->signed_date."', `phone_number`='".$this->contact_phone."',`fax_number`='".$this->fax_number."',`contact_person`='".$this->contact_person."',`address`='".$this->contact_address."',`contract_value`='".$this->contract_value."',`variations`='".$this->variations."',`tax_id`='".$this->tax_id."',`tax_name`='".$this->tax_name."',`tax_value`='".$this->tax_value."',`project_description`='".$this->project_description."' where project_id='".$this->project_id."'";
        
        $array[2] ="update project_main_table set `project_main_name`='".$this->project_name."',`company_id`='".$this->company_id."',`company_name`='".$this->company_name."',tax_content='".$this->tax_content."' where project_main_id='".$this->project_id."'";
        
        $array[3] ="update project_main_table set `project_status`='DeActivate' where project_main_id='".$this->project_id."'";
        $array[4]= "SELECT company_id,company_name FROM company_details where status='Active' " ;
       
        $array[6]= "SELECT * FROM company_details where `company_id`='".$this->company_id."' and status='Active' " ;
       
        $array[7] = "select *,date_format(default_date,'%d/%m/%Y') as default_date from project_main_table where  project_number !='' order by company_id desc";
        
        $array[8] = "SELECT q.*, DATE_FORMAT(q.quotation_date,'%d/%m/%Y') AS quotation_date,p.project_number FROM quotation_main_tbl q JOIN project_main_table p ON p.project_main_id = q.project_id WHERE q.project_id = '".$this->project_id."' ";
        $array[9] = "select *,date_format(default_date,'%d/%m/%Y') as default_date from project_main_table where project_status='Active' and (project_number ='' or project_number is null) and  company_id ='".$this->company_id."'";
        $array[10] = "select *,date_format(default_date,'%d/%m/%Y') as default_date from project_main_table where  project_number !='' and  company_id ='".$this->company_id."'";
       
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_project':
               //  echo $var[0];
                $this->varModelObj->AddToTable($var[0]);
            break;
            
            
            
            case 'list_project':
            //  echo $var[1];
                $this->varModelObj->ListFromTable($var[1]);
            break;
            
            
            
             case 'edit_project':
               // echo $var[2];
                $this->varModelObj->UpdateTable($var[2]);
            break;
            
             case 'cancel_project_entry':
               // echo $var[3];
                $this->varModelObj->UpdateTable($var[3]);
            break;
            
            case 'select_company_name': 
               
                $this->varModelObj->CreateDropDown($var[4],'company_id','company_name',$this->ctrl_name,'Select Company/Client');
            break;
            
            
             case 'display_company_details': 
               
                $this->varModelObj->ListFromTable($var[6]);
            break;
            
            
            case 'select_project_name': 
              // echo $var[4];
               // $this->varModelObj->CreateDropDown($var[4],'project_id','project_name',$this->ctrl_name,'Select Project');
                $this->varModelObj->CreateDropDown($var[7],'project_id','project_name',$this->ctrl_name,'Select Project');
            break;
            
             case 'generate_project_number':
               
                $this->generate_project_number();
            break;
            
            case 'list_project_with_number':
            //  echo $var[1];
                $this->varModelObj->ListFromTable($var[7]);
            break;
            
             case 'list_project_quotation': 
               
                $this->varModelObj->ListFromTable($var[8]);
            break;
            
             case 'list_project_companywise': 
        //   echo $var[9];
            $this->varModelObj->ListFromTable($var[9]);
            
            break;
             case 'list_project_with_number_companywise':
            //  echo $var[1];
                $this->varModelObj->ListFromTable($var[10]);
            break;
            
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
    
    function generate_project_number()
    {
      
              
               
                $year = date("y");
                $result1 = mysqli_query($this->varDBConnection,"SELECT max(project_number) as project_number FROM project_main_table WHERE project_number LIKE 'SI-$year-%' ORDER BY project_main_id DESC LIMIT 1");
               // echo "SELECT project_number FROM project_main_table WHERE project_number LIKE 'SI-$year-%' ORDER BY project_main_id DESC LIMIT 1";
                if ($result1->num_rows > 0) {
                    $row = $result1->fetch_assoc();
                    $lastNumber = $row['project_number']; // e.g. IN-PR005
                    // Extract numeric part
                    $num = (int)substr($lastNumber, -3);
                    $num++;
                } else {
                    // If no projects yet
                    $num = 1;
                }
                
                // Step 2: Format new project number
                $newProjectNumber = 'SI-' . $year . '-' . str_pad($num, 3, '0', STR_PAD_LEFT);
                
                // Step 3: Insert into the table
                
                $result1 = mysqli_query($this->varDBConnection,"Update project_main_table SET project_number = '".$newProjectNumber."' where project_main_id = '".$this->project_id."' ");
               


    }
    
    
    
}//end of class

$obj = new companyController();
$obj->RequestAccept($obj->actionevents);
?>