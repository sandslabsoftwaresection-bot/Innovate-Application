<?php

require ('../../model/common/common_functions.php');

class delivery_noteController
{
        var $varModelObj,$varDBConnection;
        public $actionevents,$v_ctrl_name,$delivery_note_number, $delivery_note_date, $company_name, $po_box, $telephone_no;
        public $fax, $address, $attn, $quotation_reference, $LPO_no, $sub_total, $vat, $total_amount, $received_amount, $balane_in_due;
        public $received_by_id, $received_by_name, $delivery_note_created_date, $delivery_note_status, $description;
        public $delivery_note_child_id, $delivery_note_main_id, $rate, $amount, $default_date,$note_txt;
        public $dev_not_no, $dis,$item_remarks,$v_delivery_note_company_id,$v_delivery_note_project_name,$v_delivery_note_project_id,$v_project_id,$to_date,$from_date,$v_req_qty,$v_delivered_qty;
        public $v_net_amount,$v_vat_percentage,$v_discount_amount,$v_discount_precentage,$v_amount,$v_rate,$v_quotation_no,$v_quotation_child_id,$unit,$quantity,$main_description;
    function __construct()
	{
	    
        
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
        
        date_default_timezone_set('Asia/Bahrain');
        $this->current_date = date("H:i:s");
        
        
        
        $this->actionevents = $_POST['action'];
        $this->ctrl_name = $_POST['v_ctrl_name'];
      
        $this->company_id = $_POST['v_company_id'];
        $this->company_name = $this->varDBConnection->real_escape_string($_POST['v_company_name']);
        $this->project_id = $_POST['v_project_id'] ;
        $this->project_name = $this->varDBConnection->real_escape_string($_POST['v_project_name']);
        $this->quotation_id = $_POST['v_quotation_id'];
        $this->quotation_no = $_POST['v_quotation_no'];
		$this->description = $this->varDBConnection->real_escape_string($_POST['description']);
        $this->location_txt = $this->varDBConnection->real_escape_string($_POST['v_location_txt']);
        $this->received = $_POST['v_received'];
        $this->v_ids = $_POST['v_ids'];
        $this->v_required_qty = $_POST['v_required_qty'];
        $this->v_received_qty = $_POST['v_received_qty'];
        $this->v_balance_qty = $_POST['v_balance_qty'];
        $this->v_qty = $_POST['v_qty'];
        $this->v_remarks = $_POST['v_remarks'];
        $this->v_work_order_main_id = $_POST['v_work_order_main_id'];
        $this->v_quotation_status = $_POST['v_quotation_status'];
		
        
	    $this->v_working_date=$_POST['v_working_date'];
		$this->working_end_date=$_POST['v_working_end_date'];
	    $this->v_working_order_no=$_POST['work_order_no'];
		
        $this->start_date =$_POST['txt_start_date'];
		$this->end_date =$_POST['txt_end_date'];
        $this->note_txt =$_POST['note_txt'];
       
	    $this->user_id =$_SESSION["user_id"];
        $this->user_name =$_SESSION["user_username"];
        $this->created_date =date('y-m-d h:i:s', time());
        $this->default_date =date('y-m-d h:i:s', time());
        
        $this->tbl_name =$_POST['v_tbl_name'];
           
    }
	
    function SQLArray()
    { 
        $array =  array();
		
         $array[1] = "SELECT `quotation_main_id`,`quotation_number` from quotation_main_tbl where project_id='".$this->project_id."' and approved_status='Approved' and work_order_status!='Generated'";
         $array[2] = "CALL proc_generate_working_orderr('".$this->company_id."','".$this->company_name."','".$this->project_id."','".$this->project_name."','".$this->quotation_id."','".$this->quotation_no."','".$this->location_txt."','".$this->received."','".$this->v_working_date."','".$this->working_end_date."','".$this->user_id."','".$this->user_name."','".$this->created_date."','".$this->default_date."','".$this->note_txt."',@msg)";
		 $array[3] = "SELECT *, DATE_FORMAT(work_order_tbl.work_order_start_date, '%d-%m-%Y') AS work_order_date from work_order_tbl inner join work_order_child_tbl on work_order_tbl.work_order_number = work_order_child_tbl.work_order_no and  work_order_child_tbl.work_order_no='".$this->quotation_no."'  order by work_order_tbl.work_order_main_id desc";
		 $array[4] = "UPDATE `work_order_child_tbl` SET `remarks`='".$this->v_remarks."',`required_quantity`='".$this->v_required_qty."',`received_quantity`='".$this->v_received_qty."',`balance_quantity`='".$this->v_balance_qty."',description='".$this->description."' WHERE `work_order_child_id`='".$this->v_ids."'";
         $array[5] = "CALL proc_delete_working_order('".$this->v_work_order_main_id."','".$this->v_ids."',@msg)";
		 //$array[6] = "SELECT *, DATE_FORMAT(work_order_tbl.work_order_date, '%d-%m-%Y') AS work_order_date from work_order_tbl inner join work_order_child_tbl on work_order_tbl.work_order_number = work_order_child_tbl.work_order_no and work_order_tbl.work_order_status='Generated' and work_order_child_tbl.quotation_status='Pending' order by work_order_tbl.work_order_main_id desc";
		 //$array[6] = "SELECT work_order_tbl.*, work_order_child_tbl.quotation_status,DATE_FORMAT(work_order_tbl.work_order_date, '%d-%m-%Y') AS work_order_dateFROM work_order_tblINNER JOIN work_order_child_tbl ON work_order_tbl.work_order_number = work_order_child_tbl.work_order_noWHERE work_order_tbl.work_order_status = 'Generated' AND work_order_child_tbl.quotation_status = 'Pending' ORDER BY work_order_tbl.work_order_main_id DESC";
		 $array[6]="SELECT wot.*, woct.quotation_status, FormatDate(wot.work_order_start_date) AS work_order_date FROM work_order_tbl wot INNER JOIN ( SELECT work_order_id, MAX(work_order_child_id) AS work_order_child_id FROM work_order_child_tbl GROUP BY work_order_id) AS wocg ON wot.work_order_main_id = wocg.work_order_id INNER JOIN work_order_child_tbl woct ON wocg.work_order_child_id = woct.work_order_child_id WHERE wot.work_order_status = 'Generated' ORDER BY wot.work_order_main_id DESC;";
		 $array[7] = "update work_order_tbl set work_order_status='Cancelled' where work_order_main_id='".$this->v_work_order_main_id."'";
		 $array[8] = "select work_order_main_id,work_order_status,work_order_number,quotation_reference,FormatDate(work_order_start_date) as work_order_date,location from work_order_tbl where work_order_status='Generated' and DATE_FORMAT(work_order_start_date,'%m/%d/%Y') between '".$this->start_date."' and '".$this->end_date."'";
		 $array[9] = "SELECT work_order_main_id,work_order_number,quotation_reference,FormatDate(work_order_start_date) as work_order_date,work_order_status,company_id,company_name,po_box,telephone_no,fax,attn,project_id,location,received,work_order_status  FROM work_order_tbl where work_order_status='Cancelled'";
		 $array[10] = "select work_order_main_id,work_order_status,work_order_number,quotation_reference,FormatDate(work_order_start_date) as work_order_date from work_order_tbl where work_order_status='Cancelled' and DATE_FORMAT(work_order_start_date,'%m/%d/%Y') between '".$this->start_date."' and '".$this->end_date."'";
		 //$array[11] = "update work_order_child_tbl set quotation_status='".$this->v_quotation_status."' where work_order_child_id='".$this->v_ids."'";
		 $array[11] = "UPDATE work_order_child_tbl SET quotation_status =  '".$this->v_quotation_status."' where work_order_child_id ='".$this->v_ids."'";
		 $array[12] = "SELECT *,DATE_FORMAT(default_date,'%d-%m-%Y')as work_order_date from  work_order_child_tbl  where work_order_no='".$this->quotation_no."' ";
		 //$array[12] = "SELECT *,DATE_FORMAT(default_date,'%d-%m-%Y')as work_order_date from  work_order_child_tbl ";
		 $array[13] = "update work_order_tbl set company_id = '".$this->company_id."', company_name= '".$this->company_name."',project_id='".$this->project_id."',project_name='".$this->project_name."',received='".$this->received."',location='".$this->location_txt."',note='".$this->note_txt."'  where work_order_number = '".$this->v_working_order_no."' ";
		 $array[14] = "update work_order_tbl as dest (select * from supplier_details where company_id ='".$this->company_id."') as src set dest.po_box=src.contact_address_1, dest.telephone_no=src.contact_phone,dest.fax=src.fax,dest.address=src.contact_address_2,dest.attn=src.contact_person where work_order_number= '".$this->v_working_order_no."'";
         $array[15] = "select distinct company_id,company_name from ".$this->tbl_name." ";
         $array[16] = "select distinct project_id,project_name from work_order_tbl where company_id = '".$this->company_id."'";
         $array[17] = "select distinct quotation_reference from work_order_tbl where project_id = '".$this->project_id."'";
         $array[18] = "select * from work_order_child_tbl where quotation_no = '".$this->quotation_no."'";
         $array[19] = "select * from quotation_child_tbl where quotation_no = '".$this->quotation_no."'";
		   return $array;
    }
    function RequestAccept($FunctionEvents)
    {
        $var =  $this->SQLArray();
      
	  
        switch ($FunctionEvents)
        {
            case 'select_quotation_list': 
                  $this->varModelObj->CreateDropDown($var[1],'quotation_main_id','quotation_number',$this->ctrl_name,'Select Quotation');
            break;
			
			case 'generate_working_order': 
			//echo $var[2];
                $work_order_nos=$this->varModelObj->ExecuteProcedure($var[2]);
                $sql1="UPDATE quotation_main_tbl set work_order_status='Generated' where quotation_number='".$this->quotation_no."'";
			    $this->varModelObj->UpdateTable($sql1);
		    break;
			
			
			 case 'list_work_order': 
			     //echo $var[12];
             $this->varModelObj->ListFromTable($var[12]);
            break;   
            
             case 'change_qty': 
              
                $this->varModelObj->ListFromTable($var[4]);
				
			$sql="select quantity,required_quantity from work_order_child_tbl where work_order_child_id='".$this->v_ids."'";
			$result = mysqli_query($this->varDBConnection, $sql);	
			foreach($result as $res)
			{
				$quantity=$res['quantity'];
				$required_quantity=$res['required_quantity'];
				
			}
			if($quantity==$required_quantity)
			{
			$sql1="UPDATE quotation_main_tbl set work_order_status='Generated' where quotation_number='".$this->quotation_no."'";
			$this->varModelObj->UpdateTable($sql1);
			}
            break;   
              
            case 'delete_work_orders': 
                $this->varModelObj->ExecuteProcedure($var[5]);
            break;
			
			case 'list_work_order_view': 
                $this->varModelObj->ListFromTable($var[6]);
            break;   
           
			case 'cancel_work_orders_list': 
               $this->varModelObj->UpdateTable($var[7]);
            break;
			
			
			 case 'search_with_date': 
                $this->varModelObj->ListFromTable($var[8]);
               break;
			 
		    
             case 'list_work_order_cancel_view': 
               $this->varModelObj->ListFromTable($var[9]);
            break;
		   
             case 'list_work_order_cancel_view_between': 
                $this->varModelObj->ListFromTable($var[10]);
             break;   
            
			
			case 'change_quotation_status': 
               $this->varModelObj->UpdateTable($var[11]);
            break;
            
            
			case 'update_working_order': 
               $this->varModelObj->UpdateTable($var[13]);
               $this->varModelObj->UpdateTable($var[14]);
            break;
            
			case 'select_company_name': 
                $this->varModelObj->CreateDropDown($var[15],'company_id','company_name',$this->ctrl_name,'Select Company');
            break;
			
			case 'select_company_project': 
                $this->varModelObj->CreateDropDown($var[16],'project_id','project_name',$this->ctrl_name,'Select Project');
            break;
			
            case 'select_project_quotation': 
                $this->varModelObj->CreateDropDown($var[17],'quotation_reference','quotation_reference',$this->ctrl_name,'Select Quotation');
            break;
			
            case 'list_work_order_quotation': 
                $this->varModelObj->ListFromTable($var[18]);
             break;
             
              case 'quotation_modal_table': 
                $this->varModelObj->ListFromTable($var[19]);
             break;
			
            default:
             echo 'No Action Found...!';
             break;
            
        }

    }
}//end of class

$obj = new delivery_noteController();
$obj->RequestAccept($obj->actionevents);
?>