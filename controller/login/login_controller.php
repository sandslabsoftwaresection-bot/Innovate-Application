<?php
require ('../../model/common/common_functions.php');
class loginController 
{
    var $varModelObj;
    public $actionevents,$username,$password,$login_result,$type,$v_item_name,$user_id,$v_approved_status,$v_name,$v_user_email,$txt_user_password,$v_id;

  
    function __construct()
	{
        
        $this->varModelObj = new CommonModel();
        $this->actionevents = $_POST['action'];
        $this->username = $_POST['username'];
        $this->password = $_POST['password'];
        $this->old_password=$_POST['old_password'];
        $this->new_password=$_POST['new_password'];
        $this->v_item_name=$_POST['v_item_name'];
        $this->user_id=$_POST['user_id'];
        $this->v_approved_status=$_POST['v_approved_status'];
        $this->v_name=$_POST['v_name'];
        $this->v_user_email=$_POST['v_user_email'];
        $this->txt_user_password=$_POST['txt_user_password'];
        $this->v_id=$_POST['v_id'];
    }
    function SQLArray()
    {
        $array =  array();
        $array[0] = "SELECT * FROM  users where username='".$this->username."' ";
        $array[1] = "SELECT * FROM  privilege where user_username='".$this->username."' ";
        $array[2] = "SELECT count(*) as count FROM  users where password='".$this->old_password."' ";
        $array[3] = "UPDATE users set password='".$this->new_password."'  where id='1'";
        $array[4] = "SELECT username,password FROM users ";
        $array[5] = "SELECT id,username,password,status,name,email FROM users";
        $array[6] = "SELECT count(*) as count FROM users where username= '".$this->v_item_name."'";
        $array[7] ="INSERT INTO `users`(`username`,name,email,password) VALUES ('".$this->v_item_name."','".$this->v_name."','".$this->v_user_email."','".$this->txt_user_password."')"; 
        $array[8] = "SELECT count(*) as count FROM  users where password='".$this->old_password."' and id='".$this->user_id."' ";
        $array[9] = "UPDATE users set password='".$this->new_password."'  where id='".$this->user_id."'";
        $array[10] = "update users set status='Deactive' WHERE id='".$this->user_id."'";
        $array[11] = "update users set status='Active' WHERE id='".$this->user_id."'";
        $array[12] = "SELECT count(*) as count FROM users where email= '".$this->v_user_email."'";
        $array[13] = "UPDATE users set password='".$this->txt_user_password."', name= '".$this->v_name."', email='".$this->v_user_email."'  where id='".$this->v_id."'";
        $array[14] = "SELECT count(*) as count FROM users where email= '".$this->v_user_email."' and id!='".$this->v_id."'";
       
        return $array;
    }

    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();

        switch ($FunctionEvents)
        {
            
            case 'login':
                
                $this->login_result = $this->varModelObj->userAuthentication($var[0],$var[1],$this->password);
               
                if (trim($this->login_result)=="Success")
                {
                    echo "success";
                  
                }
                else
                {
                    echo $this->login_result;
                }
               
            break;
           
            case 'signout':
                $this->varModelObj->SignOut();
             
            break;
            
            case 'check_old_password':
                
                $this->varModelObj->check_user_count($var[2]);
             
            break;
            case 'select_username_password':
                
                $this->varModelObj->ListFromTable($var[4]);
             
            break;
            
            case 'password_update':
                $this->varModelObj->UpdateTable($var[3]);
             
            break;
            case 'list_user_detais':
                
                $this->varModelObj->ListFromTable($var[5]);
             
            break;
            case 'generate_new_user':
                $json_data=$this->varModelObj->ListFromTableReturn($var[6]);
                $json_data2=$this->varModelObj->ListFromTableReturn($var[12]);
                $data = json_decode($json_data, true);
                $count = $data['data'][0]['count']; 
                $data2 = json_decode($json_data2, true);
                $count_mail = $data2['data'][0]['count']; 
                
                
                if($count>=1 && $count_mail>=1){
                    echo "exist";
                }
                else if($count>=1){
                     echo "username";
                }
                else if($count_mail>=1){
                    echo "email";
                }
                else{
                    $this->varModelObj->AddToTable($var[7]);
                }
                // $this->varModelObj->AddToTable($var[0]);
             
            break;
            case 'check_old_password_for_header':
                
                $this->varModelObj->check_user_count($var[8]);
             
            break;
            case 'password_update_for_header':
                $this->varModelObj->UpdateTable($var[9]);
             
            break;
            case 'status_change': 
              
              if(trim($this->v_approved_status)=='Active')
              {
                  
                 $this->varModelObj->UpdateTable($var[10]); 
              }
              else
              {
                  $this->varModelObj->UpdateTable($var[11]); 
              }
               
            break;
             case 'edit_user_details':
                 $json_data2=$this->varModelObj->ListFromTableReturn($var[14]);
                 $data2 = json_decode($json_data2, true);
                $count_mail = $data2['data'][0]['count'];
                if($count_mail>=1){
                    echo "email";
                }
                else{
                    $this->varModelObj->UpdateTable($var[13]);
                }
            break;
        }
    }


}

$obj = new loginController();
$obj->RequestAccept($obj->actionevents);