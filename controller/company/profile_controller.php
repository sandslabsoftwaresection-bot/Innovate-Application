<?php

require ('../../model/common/common_functions.php');




class companyController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$ctrl_name,$company_id, $company_name, $contact_person, $contact_phone,$v_company_id,$lastname,$contact_address,$fax,$front_logo,$print_logo,$vat_number;
        public $contact_email, $contact_address_1, $contact_address_2, $country_name, $state_name, $city_name, $fax_number, $company_description, $current_date,$upload_item_image;
        
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
        
       
        $this->company_id = $_POST['v_company_id'];
        $this->company_name = $_POST['company_name'];
        $this->company_name = $this->varDBConnection->real_escape_string(($this->company_name));
        $this->lastname = $_POST['lastname'];
        $this->lastname = $this->varDBConnection->real_escape_string(($this->lastname));
        
        $this->contact_address = $_POST['contact_address'];
        $this->contact_address = $this->varDBConnection->real_escape_string(($this->contact_address));
         
        $this->contact_email = $_POST['contact_email'];
        $this->contact_phone = $_POST['contact_phone'];
        $this->fax = $_POST['fax'];
       
       
        $this->front_logo = $_POST['front_logo'];
        $this->front_logo = $this->varDBConnection->real_escape_string(($this->front_logo));
        $this->print_logo = $_POST['print_logo'];
        $this->print_logo = $this->varDBConnection->real_escape_string(($this->print_logo));
        $this->vat_number =  $_POST['v_vat_number'];
         
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("Y-m-d h:i:s");
        
    }
    
    
    
    function SQLArray()
    { 
        $array =  array();
      
       // $array[0] = "INSERT INTO `company_details`( `company_name`, `contact_person`, `contact_email`, `contact_phone`, `contact_address_1`, `contact_address_2`, `country`, `state`, `city`, `fax`, `description`,`default_date`,`profile_image`) VALUES ( '".$this->company_name."','".$this->contact_person."','".$this->contact_email."','".$this->contact_phone."','".$this->contact_address_1."','".$this->contact_address_2."','".$this->country_name."','".$this->state_name."','".$this->city_name."','".$this->fax_number."', '".$this->company_description."','".$this->current_date."','".$this->upload_item_image."')";
        $array[1] = "select *,date_format(default_date,'%m/%d/%Y') as default_date from company_primary_details ";
       // $array[2] ="UPDATE `company_primary_details` SET `company_name`='".$this->company_name."',lastname='".$this->lastname."',`address`='".$this->contact_address."',`email`='".$this->contact_email."',`phone_no`='".$this->contact_phone."',`fax`='".$this->fax."',`front_logo`='".$this->front_logo."',`print_logo`='".$this->print_logo."' where `profile_id`='1'";
        
        $array[2] ="UPDATE `company_primary_details` SET `company_name`='".$this->company_name."',lastname='".$this->lastname."',`address`='".$this->contact_address."',`email`='".$this->contact_email."',`phone_no`='".$this->contact_phone."',`fax`='".$this->fax."',`print_logo`='".$this->print_logo."',VAT_no='".$this->vat_number."' where `profile_id`='1'";
        
        
        $array[3] ="update company_details set `status`='DeActivate' where company_id='".$this->company_id."'";
       
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
            
            
            
            case 'list_profile':
             //echo $var[1];
                $this->varModelObj->ListFromTable($var[1]);
            break;
            
            
            
             case 'edit_profile':
                //echo $var[2];
                $this->varModelObj->UpdateTable($var[2]);
            break;
            
             case 'cancel_company':
                echo $var[3];
                $this->varModelObj->UpdateTable($var[3]);
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