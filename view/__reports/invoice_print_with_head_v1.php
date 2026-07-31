<?PHP 
require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
    
    $result = mysqli_query($conns,"select * from invoice_main_tbl  where 	invoice_number = '".$_GET['invoice_number']."'");
    
    


    while($row=mysqli_fetch_assoc($result)) {
        $invoice_main_id =$row['invoice_main_id'];
        $invoice_number = $row['invoice_number'];
        $invoice_date = date("m-d-Y", strtotime($row['invoice_date']));
        $company_name= $row['company_name'];
        $po_box = $row['po_box'];
        $telephone_no = $row['telephone_no'];
        $fax = $row['fax'];
        $address = $row['address'];
        $attn = $row['attn']; 
        $subject = $row['subject'];
        $quotation_reference = $row['quotation_reference']; 
        $LPO_no = $row['LPO_no'] ;
        $total_amount = $row['sub_total'] ;
        $discount_amount=$row['total_amount'];
        $received_by_id = $row['received_by_id'] ;
        $received_by_name = $row['received_by_name'] ;
        $description = $row['description'] ;
        $project_name = $row['project_name'] ;
        $project_id = $row['project_id'] ;
        $received_amount=$row['received_amount'] ;
        $balane_in_due=$row['balane_in_due'] ;
        $retention_amount_percentage=$row['retention_amount_percentage'];
        $previous_bill_amount=$row['previous_bill_amount'];
        $discount_type = $row['discount_type'] ;
        $discount_amount = $row['discount_amount'] ;
        $total_discount_amount = $row['total_discount_amount'] ;
        $tax_content= $row['tax_content'];
        $retention_amount_type = $row['retention_amount_type'] ;
        $received_amount_type = $row['received_amount_type'] ;
        
        $discount = 0;
        $company_id = $row['company_id'];
         $vat = $row['vat'];
         
       if($row['retention_amount_percentage']!=0)
         {
             $retention_amount = ($row['sub_total']*$row['retention_amount_percentage'])/100;
         }
          if($row['received_amount']!=0)
         {
           //  $received_amount =  ($row['total_amount']*$row['received_amount'])/100;
         }
        
    }
    $result_tax = mysqli_query($conns,"select tax_content from project_main_table  where project_main_id = ".$project_id);
     while($row_project_tax=mysqli_fetch_assoc($result_tax)) {
        $project_tax = $row_project_tax['tax_content'];
    }
    
    
    $result_company_id = mysqli_query($conns,"select description from company_details  where company_id = ".$company_id);
    while($row_comp_id=mysqli_fetch_assoc($result_company_id)) {
        $company_vat_no = $row_comp_id['description'];
    }
    
    
    $result_company = mysqli_query($conns,"select * from company_primary_details");
    while($row_company=mysqli_fetch_assoc($result_company)) {
        $print_companynamne = $row_company['company_name'];
        $print_address = $row_company['address'];
        $print_tele = $row_company['phone_no'];
        $print_fax = $row_company['fax'];
        $print_email = $row_company['email'];
        $print_po = $row_company['pobox'];
        $print_logo = $row_company['print_logo'];
        $vat_no = $row_company['VAT_no'];
    }
         
         
         
    function getCurrency($number)
    {
     
    $decimal = round($number - ($no = floor($number)), 3) * 1000;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety',21=>'zero');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? '  ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
   
    // $paise = ($decimal > 0) ? ". " . ($words[$decimal / 100] . " " . $words[substr($decimal, 1) / 10]. " " . $words[$decimal % 10]) . ' ' : '';
    // return ucwords(($Rupees ? $Rupees . ' ' : ' ') . $paise);
    $last=$decimal%100;
    $x=$decimal%10;
    $y=$last-$x;
      if($y==0)
    {
      $y= 21 ;
    }
     if($x==0)
    {
       $x=21;
    }
    if($decimal > 0)
    {
     $paise = ($decimal > 0) ? " " . ($words[$decimal / 100] . " " . $words[ $y ]. " " . $words[$x]) . ' ' : '';
   
    return ucwords(($Rupees ? $Rupees . ' ' : ' ') .'1000 /'. $decimal ."  ");
    }
    else
    {
      return ucwords(($Rupees ? $Rupees . ' ' : ' ') ."  ");  
    }
}
                               
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice <?php echo ' - '. $invoice_number;?></title>
<style>
	
/* Styles go here */

.page-header, .page-header-space {
  height: 60px;
}

.page-footer, .page-footer-space {
  height: 50px;

}

.page-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  border-top: 2px solid red; /* for demo */
  background: white; /* for demo */
 

}

.page-header {
  position: fixed;
  top: 0mm;
  width: 100%;
  /*border-bottom: 1px solid black;  for demo */
  background: white; /* for demo */
  
}

.page {
  text-align: center;
}

@page {
  margin: 15mm
}

@media print {
     
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   
    #print_but,#export_excel_but{display: none;}
    
   body {margin: 0;font-size: 16px;font-family: "Times New Roman"}
  
   
}
@media print {
  #print_but,#export_excel_but {
    display: none;
  }
}
	
</style>	
	
	
</head>

<body>
	

<div class="page-header" style="text-align: center" align="center">
   
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr style="text-align:left;">
                          <td width="36%" align="right" valign="top"><img src="../../httpdocs/images/company_profile_image/<?PHP echo $print_logo;?>" width="285" height="60" alt=""/></td>
                          <td width="64%" align="left" valign="top">&nbsp;
                          </td>
                        </tr>
                        <tr>
                          <td><br>
                          
                          </td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
	
</div>	
<div class="page-footer" align="center">
    
	
	
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                     <tbody>
                        <tr style="text-align:middle; border-bottom:">
                          <td colspan="2" align="center" valign="middle" style="padding-top:5px;">
						
							<?PHP echo $print_companynamne;?>,
                          
                            <?PHP echo "  Tele : ".$print_tele." , ". $print_address." , Manama , Kingdom of Bahrain "?><br>      
							<?PHP echo "  Email : ".$print_email. "     Web : www.sapphirebh.com";?>
							
							</td>
                        </tr>
                        <tr>
                          <td width="50%"><br>
                         
                          </td>
                          <td width="50%">
                              
                          </td>
                        </tr>
                      </tbody>
                    </table>
           
           
	
	
</div>	
    

<table align="center">

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <!--*** CONTENT GOES HERE ***-->
          <div class="page">
			
			 
 <table width="800" border="0" cellspacing="0" cellpadding="5" align="center" id="main_table">
  <tbody>
    <tr >
      <td colspan="2" style="padding-left: 10px;padding-right: 10px">
          
        <table width="800" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td width="50%" align="left" valign="top" style="padding-bottom: 0px;"><p>&nbsp;</p>
              <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tbody>
                  <tr>
                    <td><strong><?PHP echo $company_name; ?></strong></td>
                  </tr>
                  <tr>
                    <td><strong>PO Box : <?PHP echo $po_box; ?>,</strong></td>
                  </tr>
                  <tr>
                    <td><strong>Manama, Kingdom of Bahrain</strong></td>
                  </tr>
                  <tr>
                    <td><span style="padding-top: 0px;"><strong>TEL : <?PHP echo $telephone_no; ?></strong></span></td>
                  </tr>
                  <tr>
                    <td><span style="padding-top: 0px;"><strong>FAX : <?PHP echo $fax; ?><br>
                          <strong>VAT NO : <?PHP echo $company_vat_no; ?></strong></strong></span></td>
                  </tr>
                </tbody>
              </table>
              <p>&nbsp;</p></td>
            <td valign="top" ><table width="370px"  cellspacing="0" cellpadding="5">
              <tbody>
                  
                  
                <tr >
                  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">TAX INVOICE </td>
                </tr>
                <tr>
                  <td style="float: right;"><span style="padding-bottom: 0px;"> VAT ACCOUNT NO: <strong><?PHP echo $vat_no; ?></strong></span></td>
                </tr>
                 <tr>
                  <td style="float: right;"><span style="padding-bottom: 0px;">INVOICE NO: <strong><?PHP echo $invoice_number; ?></strong></span></td>
                </tr>
                <tr> 
                  <td style="float: right;">Date : <strong><?PHP echo $invoice_date; ?></strong></td>
                </tr>
                <tr>
                  <td style="float: right;">Quotation Ref : <strong><?PHP echo $quotation_reference ; ?></strong></td>
                </tr>
                 <tr>
                  <td style="float: right;">LPO No : <strong><?PHP echo $LPO_no ; ?></strong></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong>PROJECT : <?PHP echo $project_name; ?></strong></td>  
            
            </tr>
            <tr>
          <td colspan="2" align="left" valign="top"><strong>ATTN : <?PHP echo $attn; ?></strong></td>
           </tr>
        </tbody>
      </table>
		
		
		
		
	  </td>
    </tr>
    <tr >
      <td colspan="2" style="padding-left: 10px;padding-right: 10px">
          
          <table width="795px" border="0" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
        <tbody>
          <tr>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px"><strong >SL</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;"> <strong>Description</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Qty</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:120px"><strong>Rate (BD)</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:120px"><strong>Amount (BD)</strong></td>
            
          </tr>
          <?PHP 
                $ctr = 1;
                $amt=0;
              
              
                $result_delivery_note_no = mysqli_query($conns,"select delivery_note_no as v_delivery_note_no from invoice_child_tbl where invoice_no= '".$_GET['invoice_number']."' limit 1");               
                while($row=mysqli_fetch_assoc($result_delivery_note_no)) {
                    $v_delivery_note_no=$row['v_delivery_note_no'];
                }  
                
               


                IF ($v_delivery_note_no != null) {
                    $result_quotation_no = mysqli_query($conns,"SELECT quotation_no  from invoice_child_tbl where invoice_no= '".$_GET['invoice_number']."' limit 1");               
                while($row=mysqli_fetch_assoc($result_quotation_no)) {
                    $v_quotation_no=$row['quotation_no'];
                }  
                  $result_total = mysqli_query($conns,"select sum(quantity) as total_quantity from quotation_child_tbl where quotation_no='".$v_quotation_no."'");               
                while($row=mysqli_fetch_assoc($result_total)) {
                    $total_quantity=$row['total_quantity'];
                }
                
                $result_total_discount = mysqli_query($conns,"SELECT total_discount_amount as total_discount from quotation_main_tbl where quotation_number = '".$v_quotation_no."'");               
                while($row=mysqli_fetch_assoc($result_total_discount)) {
                    $total_discount = $row['total_discount'];
                }
             $val=  $total_discount / $total_quantity;
             
              $result = mysqli_query($conns,"SELECT  `invoice_child_id`, `delivery_note_child_id`, `invoice_no`, `quotation_child_id`, `delivery_note_no`, `quotation_no`, `description`, `quantity`, `unit`,( select  ROUND(((`net_amount` / `quantity`) - ".$val.") ,3)   from quotation_child_tbl where quotation_child_id=invoice_child_tbl.quotation_child_id) as rate , `amount`,`discount_type`, `discount_precentage`, `discount_amount`, `vat_percentage`,ROUND (( select  ROUND(((`net_amount` / `quantity`) - ".$val.") ,3)   from quotation_child_tbl where quotation_child_id=invoice_child_tbl.quotation_child_id) * `quantity`,3) as net_amount, `default_date`, `quotation_status`, `required_quantity` ,@total_quantity ,@total_discount from invoice_child_tbl  where invoice_no = '".$_GET['invoice_number']."'");
                 
              // echo  "SELECT  `invoice_child_id`, `delivery_note_child_id`, `invoice_no`, `quotation_child_id`, `delivery_note_no`, `quotation_no`, `description`, `quantity`, `unit`,( select  ROUND(((`net_amount` / `quantity`) - @val) ,3)   from quotation_child_tbl where quotation_child_id=invoice_child_tbl.quotation_child_id) as rate , `amount`,`discount_type`, `discount_precentage`, `discount_amount`, `vat_percentage`,ROUND (( select  ROUND(((`net_amount` / `quantity`) - @val) ,3)   from quotation_child_tbl where quotation_child_id=invoice_child_tbl.quotation_child_id) * `quantity`,3) as net_amount, `default_date`, `quotation_status`, `required_quantity` ,@total_quantity ,@total_discount from invoice_child_tbl  where invoice_no = '".$_GET['invoice_number']."' ";
                    
                }


        else
            {
                
                $result_total = mysqli_query($conns,"select sum(quantity) as total_quantity from invoice_child_tbl where invoice_no= '".$_GET['invoice_number']."'");               
                while($row=mysqli_fetch_assoc($result_total)) {
                    $total_quantity=$row['total_quantity'];
                }
                
                $result_total_discount = mysqli_query($conns,"SELECT total_discount_amount as total_discount from invoice_main_tbl where invoice_number = '".$_GET['invoice_number']."'");               
                while($row=mysqli_fetch_assoc($result_total_discount)) {
                    $total_discount = $row['total_discount'];
                }
             $val=  $total_discount / $total_quantity  ;

                 $result = mysqli_query($conns,"SELECT  `invoice_child_id`, `delivery_note_child_id`, `invoice_no`, `quotation_child_id`, `delivery_note_no`, `quotation_no`, `description`, `quantity`, `unit`,  ROUND( ((`net_amount` / `quantity`) - $val) ,3) as rate, `amount`,`discount_type`, `discount_precentage`, `discount_amount`, `vat_percentage`,ROUND( ((`net_amount` / `quantity`) - $val) * `quantity`,3) as net_amount, `default_date`, `quotation_status`, `required_quantity` from invoice_child_tbl where invoice_no = '".$_GET['invoice_number']."'");
            } 
                     while($row=mysqli_fetch_assoc($result)) {
                          if($row['discount_amount']!=0)
                         {
                             $discount = $discount + ($row['discount_amount']);
                         }
                         $v_discount_type = $row['discount_type'];
                         
                         if($ctr%2!=0)
                         {
                ?>
                          <tr style="border-bottom: 1px solid gray;">
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $ctr;?></td>
                            <td bgcolor="#f2f2f2"style="text-align: left"><?PHP echo $row['description'];?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo number_format($row['quantity'],3);?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $row['unit'];?></td>
                           
                            <td bgcolor="#f2f2f2" style="text-align: right"><?PHP echo number_format($row['rate'],3); ?></td>
                            <td bgcolor="#f2f2f2" style="text-align: right"><?PHP echo number_format($row['net_amount'],3); $amt=$amt+ $row['net_amount'];?></td>
                            
							  
                          </tr>
                    <?PHP }
                        else
                        {
                    
                    ?>
                    
                    
                        <tr style="border-bottom: 1px solid gray;">
                            <td style="text-align: center"><?PHP echo $ctr;?></td>
                            <td style="text-align: left"><?PHP echo $row['description'];?></td>
                            <td style="text-align: center"><?PHP echo number_format($row['quantity'],3);?></td>
                            <td style="text-align: center"><?PHP echo $row['unit'];?></td>
                           
                           <td style="text-align: right"><?PHP echo number_format($row['rate'],3); ?></td>
                            <td style="text-align: right"><?PHP echo number_format($row['net_amount'],3);$amt=$amt+ $row['net_amount']; ?></td>
                            
                          </tr>
                    
                    
                    <?PHP } ?>
                          
          <?PHP 
          
	            $ctr = $ctr +1;
	            } ?>
	            
	   	  
   
    <tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            <td colspan="4" style="text-align: left"><strong>Total Contract Value (BD)</strong></td>
            <td style="text-align: right" colspan="2"><strong><?PHP echo number_format($amt,3);?></strong></td>
    </tr>
	
	
          <?PHP if($total_discount_amount+$discount!=0) { ?>
          <?PHP } if ($discount_amount != 0) {?>
		  
	<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            <td colspan="4" style="text-align: left"><strong>Discount Amount (<?PHP  echo $discount_type; ?>)</strong></td>
             <?php if($discount_type == "BD") { ?>
                <td style="text-align: right" colspan="2"><strong><?PHP $number =explode('.', $discount_amount); if($number[1]== '000'){ $x=$discount_amount;  echo number_format($discount_amount,0.000);?> <?PHP } else {  $x=$discount_amount; echo number_format($discount_amount,3);} ?></strong></td>
			 <?php } else { ?>
                <td style="text-align: right" colspan="2"><strong><?PHP $net_discount = (($amt*$discount_amount)/100);
                echo number_format($net_discount,3);?></strong></td>
			 <?php } ?>
    </tr>
	<?PHP } if ($received_amount != 0) {?>
	
	
	<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            <td colspan="4" style="text-align: left"><strong>Less Advance Amount (<?php echo $received_amount_type; ?>) </strong></td>
			<?php if ($received_amount_type == "BD") { ?>
                <td style="text-align: right" colspan="2"><strong><?PHP $number =explode('.', $received_amount); if($number[1]== '000'){ echo number_format($received_amount,0.000);?> <?PHP } else {echo number_format($received_amount,3);} ?></strong></td>
            <?php } else { ?>
			    <td style="text-align: right" colspan="2"><strong><?PHP $net_received = (($amt*$received_amount)/100);
                echo number_format($net_received,3);?></strong></td>
			<?php } ?>
	</tr>
	<?PHP } if ($retention_amount_percentage != 0) { ?>
	
	<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            <td colspan="4" style="text-align: left"><strong> Less Retention Amount (<?php echo $retention_amount_type; ?>) </strong></td>
			<?php if ($retention_amount_type == "BD") { ?>
            <td style="text-align: right" colspan="2"><strong><?PHP $number =explode('.', $retention_amount_percentage); if($number[1]== '000'){ echo number_format($retention_amount_percentage,0.000);?> <?PHP } else {echo number_format($retention_amount_percentage,3);} ?></strong></td>
			<?php } else { ?>
			<td style="text-align: right" colspan="2"><strong><?PHP $net_retention = (($amt*$retention_amount_percentage)/100);
            echo number_format($net_retention,3);?></strong></td>
			<?php } ?>
	</tr>
	<?PHP }?>
	
	
	<tr style="border-bottom: 1px solid gray;">
	<?php 
    $net_amount_in_total_dis = 0.00;
    $net_amount_in_toatal_rece =0.000;
    $net_amount_in_toatal_reten=0;
    if($discount_type == "BD")
	{		
	  $net_amount_in_total_dis = $discount_amount;
	}
	 if($received_amount_type == "BD")
	{		
	  $net_amount_in_toatal_rece = $received_amount;
	}
	 if($retention_amount_type == "BD")
	{		
	  $net_amount_in_toatal_reten = $retention_amount_percentage;
	}
	if($discount_type == "%")
	{		
	  $net_amount_in_total_dis = $net_discount;
	}
	 if($received_amount_type == "%")
	{		
	  $net_amount_in_toatal_rece = $net_received;
	}
	 if($retention_amount_type == "%")
	{		
	  $net_amount_in_toatal_reten = $net_retention;
	}
	
	
	$z = $amt - ($net_amount_in_total_dis+$net_amount_in_toatal_rece+$net_amount_in_toatal_reten);
	

	?>
            <td style="text-align: center">&nbsp;</td>
            <td colspan="4" style="text-align: left"><strong>Net Balance Amount(BD)</strong></td>
            <td style="text-align: right" colspan="2"><strong><?php echo number_format($z,3); ?></strong></td>
    </tr>
	<?php
	$p = ($z/100)*10;
	?>
	<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            <td colspan="4" style="text-align: left"><strong>Tax (VAT)-10%</strong></td>
            <td style="text-align: right" colspan="2"><strong><?php echo number_format($p,3); ?></strong></td>
    </tr>
	<?php 
     $q = $z+$p;
	?>
	<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            <td colspan="4" style="text-align: left"><strong>Gross Amount (BD)</strong></td>
            <td style="text-align: right" colspan="2"><strong><?PHP $v_total_amt=$total_amount+$vat_p; echo number_format($q, 3);?></strong></td>
    </tr>

	
	
	<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            <td colspan="4" style="text-align: left"><strong>Net Amount Due (BD)</strong></td>
            <td style="text-align: right" colspan="2"><strong><?PHP $balane_in_due = $v_total_amt-( $received_amount+$retention_amount+$previous_bill_amount); echo number_format($q,3);?></strong></td>
    </tr>
	
	
			
    <tr>
            <td colspan="9" style="text-align: center; font-size:12px">Bahraini Dinars: <strong> <?PHP 
            $ro = round($q,3);
            $amt1 = str_replace(",","",$ro); 
          
            $splitamount = explode('.',$q);
            
             $splitamount1=number_format((float)$q, 3, '.', '');
             $splitamount = explode('.',$splitamount1);
            if(intval($splitamount[1])<=0 )
            {
                 echo getCurrency($splitamount[0]).' only';
            }
            else
            {
                 echo getCurrency($splitamount[0]).'  '.$splitamount[1].'/1000  fills only';
            }
            ?> </strong> </td>
    </tr>
         
         
         
			
			
			
		
			
          
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td><span><span style="text-align: left"><?PHP echo $description;?></span></span></td>
    </tr>
<!--    <tr >-->
<!--      <td width="50%" align="left" valign="middle" style="padding-left: 10px;padding-right: 10px">-->
			
<!--		  For <?PHP echo $print_companynamne;?><br><br><br>-->
		  
<!--		  Signature______________________-->
		
		
<!--		</td>-->
<!--      <td width="50%" align="right" valign="middle" style="padding-left: 10px;padding-right: 10px">Received By <br><br> Signature________________________<br><br>-->
<!--                              Name __________________________</td>-->
<!--    </tr>-->
<!--    <tr >-->
<!--      <td colspan="2" align="center" valign="middle" style="padding-left: 10px;padding-right: 10px">All the materials checked and confirmed<br> -->
<!--<strong>Thank you for your business !</strong>-->
<!--</td>-->
<!--      </tr>-->
  </tbody>
</table>
  

  
			
		  </div>
		  
		   <div style="text-align:right;padding-right:30px;">
                   <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
                   <!--<input type="button" value="Print this page" onClick="window.print()" id="print_but">-->
           </div>
        
         
        </td>
      </tr>
      
    </tbody>


    <tfoot>
      <tr>
        <td>
          
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

</table>	 

<script>



function fnExcelReport()
{
	var no = "<?php echo $invoice_number; ?>";
	var filename = "Invoice - "+no+".xls";
    var tab_text="<table border='2px' ><tr bgcolor='#FFFFFF' style='border-bottom: 1px solid #FFFFFF;'>";
    var textRange; var j=0;
    tab = document.getElementById('main_table'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
  // tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE"); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"quotation.xlsx");
    }  
    else                 //other browser not tested on IE 11
     var link = document.createElement('a');
	  link.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tab_text);
	  link.download = filename;
	  link.click();
	  return (link);
}




</script>	
