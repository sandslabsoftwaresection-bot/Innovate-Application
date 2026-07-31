<?php

require ('../../model/common/common_functions.php');




class companyController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$company_id, $company_name, $contact_person, $contact_phone;
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
        $this->company_description = $this->varDBConnection->real_escape_string(($this->company_description));
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        
        $this->upload_item_image= $_POST['upload_item_image'];
        $this->upload_item_image = $this->varDBConnection->real_escape_string(($this->upload_item_image));
        
        
        
       
        
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
        $array[0] = "INSERT INTO `supplier_details`( `company_name`, `contact_person`, `contact_email`, `contact_phone`, `contact_address_1`, `contact_address_2`, `country`, `state`, `city`, `fax`, `description`,`default_date`,`profile_image`) VALUES ( '".$this->company_name."','".$this->contact_person."','".$this->contact_email."','".$this->contact_phone."','".$this->contact_address_1."','".$this->contact_address_2."','".$this->country_name."','".$this->state_name."','".$this->city_name."','".$this->fax_number."', '".$this->company_description."','".$this->current_date."','".$this->upload_item_image."')";
        $array[1] = "select *,date_format(default_date,'%m/%d/%Y') as default_date from supplier_details where status='Active' order by company_id desc ";
        $array[2] ="update supplier_details set `company_name`='".$this->company_name."',`contact_person`='".$this->contact_person."',`contact_email`='".$this->contact_email."', `contact_phone`='".$this->contact_phone."',`contact_address_1`='".$this->contact_address_1."',`contact_address_2`='".$this->contact_address_2."',`country`='".$this->country_name."',`state`='".$this->state_name."',`city`='".$this->city_name."',`fax`='".$this->fax_number."',`description`='".$this->company_description."',`profile_image`='".$this->upload_item_image."' where company_id='".$this->company_id."'";
        $array[3] ="update supplier_details set `status`='DeActivate' where company_id='".$this->company_id."'";
		$array[4] = "SELECT * FROM `local_po_main_tbl` WHERE `company_name` = '".$this->company_name."' ";
		$array[5] = "SELECT *,FormatDate(local_po_created_date) AS local_po_created_date FROM local_po_main_tbl WHERE company_name= '".$this->company_name."' AND local_po_status != 'Cancelled' order by local_po_main_id desc ";

       
        return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
        switch ($FunctionEvents)
        {

            
            case 'add_company':
                // echo $var[0];
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
			
			case 'get_lpo_count':
                $this->SQLQuery = $this->varModelObj->ReturnCountValue($var[4]);
				echo $this->SQLQuery;
            break;
			
			case 'list_supplier_lpo':
			//echo $var[5];
                $this->varModelObj->ListFromTable($var[5]);
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