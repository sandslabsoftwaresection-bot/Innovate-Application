<?php
 
require ('../../model/common/common_functions.php');
session_start();

class purchase_recievedController
{
        var $varModelObj,$varDBConnection;
        public $actionevents, $v_stringItem, $v_stringSupplier,$v_inventory_id,$startDate,$endDate,$company_id,$local_po_number,$local_po_child_id,$v_balance;
        
        
         function __construct()
	    {
        $this->varModelObj = new CommonModel();
        $this->varDBConnection = $this->varModelObj->varDBConnection;
		
        $this->actionevents = $_POST['action'];
        $this->v_stringItem = $_POST['v_stringItem'];
        $this->v_stringSupplier = $_POST['v_stringSupplier'];
        $this->v_inventory_id = $_POST['v_inventory_id'];
        $this->startDate = $_POST['startDate'];
        $this->endDate = $_POST['endDate'];
        $this->company_id = $_POST['company_id'];
        $this->local_po_number = $_POST['local_po_number'];
        $this->local_po_child_id = $_POST['local_po_child_id'];
        $this->v_balance = $_POST['v_balance'];
        $this->v_otp = $_POST['v_otp'];
        
	    }
	    
	     function SQLArray()
        { 
        $array =  array();
		
// 		$array[0] = "Call proc_total_store_report('". $this->v_from_date."','".$this->v_to_date."',@msg)";
		$array[1] = "SELECT COUNT(local_po_number) AS po_count, 
                               UPPER(company_name) as company_name,
                               company_id,sum(sub_total) as total_amount 
                        FROM local_po_main_tbl a
                        WHERE local_po_number IN (
                            SELECT a.local_po_number
                            FROM local_po_child_tbl b
                            WHERE b.local_po_no = a.local_po_number
                            GROUP BY a.local_po_number
                            HAVING SUM(b.quantity) - (SUM(b.quantity_purchased)+SUM(b.cancel_quantity)) > 0
                        ) and local_po_status!='Cancelled' and company_id IN (".$this->v_stringSupplier.") and cancel_on_demand!='Deactive'
                        GROUP BY company_id, company_name";
                        
        	$array[2] = "SELECT 
                            local_po_number, 
                            UPPER(company_name) AS company_name,
                            company_id, 
                            sub_total, 
                            COALESCE((SELECT SUM(amount) 
                                      FROM purchase_recieved_child_tbl 
                                      WHERE lpo_no = a.local_po_number 
                                      GROUP BY lpo_no), 0) AS recieved_amount
                        FROM 
                            local_po_main_tbl a
                        WHERE 
                            local_po_number IN (
                                SELECT 
                                    a.local_po_number
                                FROM 
                                    local_po_child_tbl b
                                WHERE 
                                    b.local_po_no = a.local_po_number
                                GROUP BY 
                                    a.local_po_number
                                HAVING 
                                    SUM(b.quantity) - (SUM(b.quantity_purchased)+SUM(b.cancel_quantity)) > 0
                            ) 
                            AND local_po_status != 'Cancelled' 
                            AND company_id = '".$this->company_id."' AND cancel_on_demand!='Deactive'";                   
        	$array[3] = "SELECT local_po_child_id,local_po_no, description,category_name, quantity,unit,rate,amount,vat_percentage,net_amount,quantity_purchased,cancel_ondemand_ch, (sum(quantity)-sum(quantity_purchased)) as balance,(select cancel_on_demand from local_po_main_tbl where local_po_number='".$this->local_po_number."')as cancel_status  FROM local_po_child_tbl WHERE local_po_no='".$this->local_po_number."' group by local_po_child_id";    
        
        $array[4] = "SELECT COUNT(local_po_number) AS po_count, 
                               UPPER(company_name) as company_name,
                               company_id,sum(sub_total) as total_amount 
                        FROM local_po_main_tbl a
                        WHERE local_po_number IN (
                            SELECT a.local_po_number
                            FROM local_po_child_tbl b
                            WHERE b.local_po_no = a.local_po_number
                            GROUP BY a.local_po_number
                            HAVING SUM(b.quantity) - (SUM(b.quantity_purchased)+SUM(b.cancel_quantity)) = 0
                        ) and local_po_status!='Cancelled' and company_id IN (".$this->v_stringSupplier.") and (DATE(local_po_date) BETWEEN DATE('". $this->startDate."') AND DATE('".$this->endDate."'))
                        GROUP BY company_id, company_name";
                        
        	$array[5] = "SELECT local_po_number, UPPER(company_name) as company_name,
                           company_id, sub_total, (select sum(amount) from purchase_recieved_child_tbl where lpo_no = a.local_po_number group by lpo_no) as recieved_amount
                            FROM local_po_main_tbl a
                            WHERE local_po_number IN (
                                SELECT a.local_po_number
                                FROM local_po_child_tbl b
                                WHERE b.local_po_no = a.local_po_number
                                GROUP BY a.local_po_number
                                HAVING SUM(b.quantity) - (SUM(b.quantity_purchased)+SUM(b.cancel_quantity)) = 0
                            ) and local_po_status!='Cancelled' and company_id='".$this->company_id."' and (DATE(local_po_date) BETWEEN DATE('". $this->startDate."') AND DATE('".$this->endDate."'))";    
        
            $array[6] = "Update local_po_main_tbl set cancel_on_demand='Deactive' where local_po_number='".$this->local_po_number."'";
            $array[7] = "SELECT COUNT(local_po_number) AS po_count, 
                               UPPER(company_name) as company_name,
                               company_id,sum(sub_total) as total_amount 
                        FROM local_po_main_tbl a
                        WHERE local_po_number IN (
                            SELECT a.local_po_number
                            FROM local_po_child_tbl b
                            WHERE b.local_po_no = a.local_po_number
                            GROUP BY a.local_po_number
                            HAVING SUM(b.quantity) - SUM(b.quantity_purchased) > 0
                        ) and local_po_status!='Cancelled' and company_id IN (".$this->v_stringSupplier.") and cancel_on_demand='Deactive' and (DATE(local_po_date) BETWEEN DATE('". $this->startDate."') AND DATE('".$this->endDate."'))
                        GROUP BY company_id, company_name";
                        
            $array[8] = "SELECT 
                            local_po_number, 
                            UPPER(company_name) AS company_name,
                            company_id, 
                            sub_total, 
                            COALESCE((SELECT SUM(amount) 
                                      FROM purchase_recieved_child_tbl 
                                      WHERE lpo_no = a.local_po_number 
                                      GROUP BY lpo_no), 0) AS recieved_amount
                        FROM 
                            local_po_main_tbl a
                        WHERE 
                            local_po_number IN (
                                SELECT 
                                    a.local_po_number
                                FROM 
                                    local_po_child_tbl b
                                WHERE 
                                    b.local_po_no = a.local_po_number
                                GROUP BY 
                                    a.local_po_number
                                HAVING 
                                    SUM(b.quantity) - SUM(b.quantity_purchased) > 0
                            ) 
                            AND local_po_status != 'Cancelled' 
                            AND company_id = '".$this->company_id."' AND cancel_on_demand='Deactive' and (DATE(local_po_date) BETWEEN DATE('". $this->startDate."') AND DATE('".$this->endDate."'))";
                            
                $array[9] = "Update local_po_child_tbl set cancel_ondemand_ch='Deactive',cancel_quantity='".$this->v_balance."'  where local_po_child_id='".$this->local_po_child_id."'";            
                $array[10] = "Update local_po_child_tbl set cancel_ondemand_ch='Deactive' where local_po_no='".$this->local_po_number."'";
                
                $array[11] = "select *,FormatDate(recieved_date) as recieved_date from purchase_recieved_child_tbl where lpo_no='".$this->local_po_number."' ORDER BY prd_no ";
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
            case 'list_purchase_report':
                // echo $var[1];
                 $this->varModelObj->ListFromTable($var[1]);
            break;
            case 'list_of_lpo_pending':
                // echo $var[1];
                 $this->varModelObj->ListFromTable($var[2]);
            break;
            case 'list_of_lpo_child_table':
                // echo $var[1];
                 $this->varModelObj->ListFromTable($var[3]);
            break;
            case 'list_purchase_report_completed':
                // echo $var[4];
                 $this->varModelObj->ListFromTable($var[4]);
            break;
            case 'list_of_lpo_completed':
                // echo $var[4];
                 $this->varModelObj->ListFromTable($var[5]);
            break;
            case 'cancel_lpo_on_demand':
                // echo $var[6];
                $result = strcmp($this->v_otp, $_SESSION['otp']);
                //echo $this->v_otp.'-----'.$_SESSION['otp'].'---'.$result;
                if($result==0){
                    $this->res=$this->varModelObj->UpdateTable($var[6]);
                    $this->varModelObj->UpdateTable($var[10]);
                    unset($_SESSION['otp']);
                    echo $this->res;
                }
                else{
                    echo "invalied";
                }
                //  $this->res=$this->varModelObj->UpdateTable($var[6]);
                //  $this->varModelObj->UpdateTable($var[10]);
                //  echo $this->res;
            break;
            case 'list_purchase_report_cancelled':
                // echo $var[7];
                 $this->varModelObj->ListFromTable($var[7]);
            break;
            
            case 'list_of_lpo_cancelled':
                // echo $var[1];
                 $this->varModelObj->ListFromTable($var[8]);
            break;
            case 'cancel_lpo_child_on_demand':
                $result = strcmp($this->v_otp, $_SESSION['otp']);
                if($result==0){
                    $this->res=$this->varModelObj->UpdateTable($var[9]);
                    unset($_SESSION['otp']);
                    echo $this->res;
                }
                else{
                    echo "invalied";
                }
                // echo $var[6];
                 
            break;
            case 'cancel_otp':
               unset($_SESSION['otp']);
            break;
            
            case 'prd_history_report':
               
                 $this->varModelObj->ListFromTable($var[11]);
                 
            break;
            
            default:
                  echo 'No Action Found...!';
            break;
              
        }

    }
    
}

$obj = new purchase_recievedController();
$obj->RequestAccept($obj->actionevents);
?>