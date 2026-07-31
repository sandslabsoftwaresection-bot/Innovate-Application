<?php

require ('../../model/common/common_functions.php');




class companyController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$ctrl_name,$company_id, $company_name, $contact_person, $contact_phone,$v_company_id ;
        public $contact_email, $contact_address_1, $contact_address_2, $country_name, $state_name, $city_name, $fax_number, $company_description, $current_date,$upload_item_image;
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        $this->company_id = $_POST['v_company_id'];
        $this->company_name = $_POST['v_company_name'];
        $this->company_name = $this->varDBConnection->real_escape_string(($this->company_name));
        $this->contact_person = $_POST['v_contact_person'];
         $this->contact_person = $this->varDBConnection->real_escape_string(($this->contact_person));
        $this->contact_phone = $_POST['v_contact_phone'];
        $this->contact_email = $_POST['v_contact_email'];
        $this->contact_address_1 = $_POST['v_contact_address_1'];
        $this->contact_address_1 = $this->varDBConnection->real_escape_string(($this->contact_address_1));
        $this->contact_address_2 = $_POST['v_contact_address_2'];
        $this->contact_address_2 = $this->varDBConnection->real_escape_string(($this->contact_address_2));
        $this->country_name = $_POST['v_country_name'];
        $this->state_name = $_POST['v_state_name'];
        $this->city_name = $_POST['v_city_name'];
        $this->fax_number = $_POST['v_fax_number'];
        $this->company_description= $_POST['v_company_description'];
		$this->project_id = $_POST['v_project_id'];
        $this->company_description = $this->varDBConnection->real_escape_string(($this->company_description));
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        
        $this->upload_item_image= $_POST['upload_item_image'];
        $this->upload_item_image = $this->varDBConnection->real_escape_string(($this->upload_item_image));
        
        
        
       
        
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "INSERT INTO `company_details`( `company_name`, `contact_person`, `contact_email`, `contact_phone`, `contact_address_1`, `contact_address_2`, `country`, `state`, `city`, `fax`, `description`,`default_date`,`profile_image`) VALUES ( '".$this->company_name."','".$this->contact_person."','".$this->contact_email."','".$this->contact_phone."','".$this->contact_address_1."','".$this->contact_address_2."','".$this->country_name."','".$this->state_name."','".$this->city_name."','".$this->fax_number."', '".$this->company_description."','".$this->current_date."','".$this->upload_item_image."')";
        $array[1] = "select *,date_format(default_date,'%m/%d/%Y') as default_date from company_details where status='Active' order by company_id desc ";
        $array[2] ="update company_details set `company_name`='".$this->company_name."',`contact_person`='".$this->contact_person."',`contact_email`='".$this->contact_email."', `contact_phone`='".$this->contact_phone."',`contact_address_1`='".$this->contact_address_1."',`contact_address_2`='".$this->contact_address_2."',`country`='".$this->country_name."',`state`='".$this->state_name."',`city`='".$this->city_name."',`fax`='".$this->fax_number."',`description`='".$this->company_description."',`profile_image`='".$this->upload_item_image."' where company_id='".$this->company_id."'";
        $array[3] ="update company_details set `status`='DeActivate' where company_id='".$this->company_id."'";
		$array[4] = "SELECT * FROM `project_main_table` WHERE `company_id` = '".$this->company_id."' ";
		$array[5] = "SELECT * FROM `quotation_main_tbl` WHERE `company_id` = '".$this->company_id."' ";
        $array[6] = "SELECT * FROM `quotation_main_tbl` WHERE `company_id` = '".$this->company_id."' AND approved_status = 'Approved' ";
        $array[7] = "SELECT *,date_format(default_date,'%m/%d/%Y') AS default_date FROM project_main_table WHERE company_id= '".$this->company_id."' order by company_id desc ";
		$array[8] = "SELECT * FROM `quotation_main_tbl` WHERE `project_id` = '".$this->project_id."' ";
		$array[9] = "SELECT * FROM `quotation_main_tbl` WHERE `project_id` = '".$this->project_id."' AND approved_status = 'Approved' ";
		$array[10] = "SELECT project_main_table.* FROM project_main_table WHERE EXISTS ( SELECT 1 FROM quotation_main_tbl WHERE quotation_main_tbl.project_id = project_main_table.project_main_id AND quotation_main_tbl.approved_status = 'Approved' AND quotation_main_tbl.company_id = '".$this->company_id."')";
       
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_company':
                 echo $var[0];
                $this->varModelObj->AddToTable($var[0]);
            break;
            
            
            
            case 'list_company':
             // echo $var[1];
                $this->varModelObj->ListFromTable($var[1]);
            break;
            
            
            
             case 'edit_company':
                echo $var[2];
                $this->varModelObj->UpdateTable($var[2]);
            break;
            
             case 'cancel_company':
                echo $var[3];
                $this->varModelObj->UpdateTable($var[3]);
            break;
            
			case 'get_project_count':
			
                $this->SQLQuery = $this->varModelObj->ReturnCountValue($var[4]);
				echo $this->SQLQuery;
            break;
			
			case 'get_quotation_count':
			
                $this->SQLQuery = $this->varModelObj->ReturnCountValue($var[5]);
				echo $this->SQLQuery;
            break;
			
			case 'get_approv_quotation_count':
			
                $this->SQLQuery = $this->varModelObj->ReturnCountValue($var[6]);
				echo $this->SQLQuery;
            break;
			
			case 'list_project':
                $this->varModelObj->ListFromTable($var[7]);
            break;
			
			case 'list_quotation':
			//echo $var[8];
                $this->varModelObj->ListFromTable($var[8]);
            break;
			
			case 'list_quotation2':
                $this->varModelObj->ListFromTable($var[9]);
            break;
			
			case 'list_project1':
			//echo "Q :".$var[10];
                $this->varModelObj->ListFromTable($var[10]);
            break;
           
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new companyController();
$obj->RequestAccept($obj->actionevents);
?>