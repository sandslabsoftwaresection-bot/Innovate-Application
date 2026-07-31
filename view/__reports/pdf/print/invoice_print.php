<?php
//============================================================+
// File name   : example_051.php
// Begin       : 2009-04-16
// Last Update : 2013-05-14
//
// Description : Example 051 for TCPDF class
//               Full page background
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Full page background
 * @author Nicola Asuni
 * @since 2009-04-16
 * @group background
 * @group page
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	//Page header
	public function Header() {
		// get the current page break margin
		$bMargin = $this->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $this->AutoPageBreak;
		// disable auto-page-break
		$this->setAutoPageBreak(false, 0);
		// set bacground image
		//$img_file = K_PATH_IMAGES.'webinar_python_blank_without_qr.jpg';
		if($_GET['x']==0)
		{
		$img_file = K_PATH_IMAGES.'sapphirebh_letterhead.jpg';
		}
		else
		{
		  $img_file = K_PATH_IMAGES;  
		}
		$this->Image($img_file, null, 0, 210, 297, '', '', '', false, 300, 'C', false, false, 0);
		// restore auto-page-break status
		$this->setAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
		$this->SetTopMargin($this->GetY()+30);
	}
	
	

  
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   $certificate_code=$_GET['quotation_number'];
} else {
   $certificate_code=$_POST['quotation_number'];
}


// Create connection

   require_once($_SERVER['DOCUMENT_ROOT'].'/model/common/common_functions.php');
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
    $digits = array('', 'hundred','thousand','hundred', 'million');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? '' : null;
            $hundred = ($counter == 1 && $str[0]) ? '  ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
   
     $last=$decimal%100;
    $x=$decimal%10;
    $y=$last-$x;
     if($y==0)
    {
      $y= 21;
    }
     if($x==0)
    {
       $x=21;
    }
    if($decimal > 0)
    {
     $paise = ($decimal > 0) ? " " . ($words[$decimal / 100] . "-" . $words[ $y ]. "-" . $words[$x]) . ' ' : '';
   
    return ucwords(($Rupees ? $Rupees . ' ' : ' ') .'1000 /'. $paise ."   ");
    }
    else
    {
      return ucwords(($Rupees ? $Rupees . ' ' : ' ') ."   ");  
    }
}
                         

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('SaNDS Lab');
$pdf->setTitle('SAPPHIER/QNO/'.$invoice_number);
$pdf->setSubject('SAPPHIER');
$pdf->setKeywords('SAPPHIER');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//$pdf->setAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('times', '', 10);

// ---------------------------------------------------------
// set default font subsetting mode
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.



// add a page
$pdf->AddPage();
                                          
						
							
                $ctr = 1;
                $amt=0;
                $cu_amt=0;
              
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
             
              $result = mysqli_query($conns,"SELECT  `invoice_child_id`, `delivery_note_child_id`, `invoice_no`, `quotation_child_id`, `delivery_note_no`, `quotation_no`, `description`, `quantity`, `unit`,( select  ROUND(((`net_amount` / `quantity`) - ".$val.") ,3)   from quotation_child_tbl where quotation_child_id=invoice_child_tbl.quotation_child_id) as rate , `amount`,`discount_type`, `discount_precentage`, `discount_amount`, `vat_percentage`,ROUND (( select  ROUND(((`net_amount` / `quantity`) - ".$val.") ,3)   from quotation_child_tbl where quotation_child_id=invoice_child_tbl.quotation_child_id) * `quantity`,3) as net_amount, `default_date`, `quotation_status`, `required_quantity` ,`purchase_qty`,`purchase_amount_pr`,@total_quantity ,@total_discount from invoice_child_tbl  where invoice_no = '".$_GET['invoice_number']."'");
                 
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

                 $result = mysqli_query($conns,"SELECT  `invoice_child_id`, `delivery_note_child_id`, `invoice_no`, `quotation_child_id`, `delivery_note_no`, `quotation_no`, `description`, `quantity`, `unit`, `rate`, `amount`,`discount_type`, `discount_precentage`, `discount_amount`, `vat_percentage`,ROUND( ((`net_amount` / `quantity`) - $val) * `quantity`,3) as net_amount, `default_date`, `quotation_status`, `required_quantity`,`purchase_qty`,`purchase_amount_pr` from invoice_child_tbl where invoice_no = '".$_GET['invoice_number']."'");
            } 
                     while($row=mysqli_fetch_assoc($result)) {
						
                          if($row['discount_amount']!=0)
                         {
                             $discount = $discount + ($row['discount_amount']);
                         }
                         $v_discount_type = $row['discount_type'];
						 
						 if($row['purchase_qty']==0.00)
						 {
							 $qtyper=$row['purchase_amount_pr'].'%';
							
						 }
						 else if($row['purchase_amount_pr']==0.00)
						 {
							 $qtyper=$row['purchase_qty'];
						 }
						 
                         
                        
										    $content=$content.'<tr style="border-bottom: 1px solid gray;">';
											$content=$content.'<td bgcolor="#f2f2f2" style="text-align:center;">'.$ctr.'</td>';
											$content=$content.'<td bgcolor="#f2f2f2" style="text-align:left;">'.$row['description'].'</td>';
                                            $content=$content.'<td bgcolor="#f2f2f2" style="text-align:center;">'.number_format($row['quantity'],2).'</td>';
											
											$content=$content.'<td bgcolor="#f2f2f2" style="text-align:center;">'.$row['unit'].'</td>';
											$content=$content.'<td bgcolor="#f2f2f2" style="text-align:right;">'.number_format($row['rate'],3).'</td>';
												
											$content=$content.'<td bgcolor="#f2f2f2" style="text-align:right;">'.number_format($row['quantity']*$row['rate'],3).'</td>';
											$content=$content.'<td bgcolor="#f2f2f2" style="text-align:right;">'.$qtyper.'</td>';
                           
											$content=$content.'<td bgcolor="#f2f2f2" style="text-align:right;">'.number_format($row['net_amount'],3).'</td>';
                                            
                                            $content=$content.'</tr>';
						                    $amt=$amt+ $row['amount'];
						                    $cu_amt=$cu_amt+ $row['net_amount'];   
                                            $ctr = $ctr +1;		
												 
                                       }
									   
										$content .='<tr style="border-bottom: 1px solid gray;">';
										$content .='<td style="text-align: center">&nbsp;</td>';
										$content .='<td colspan="5" style="text-align:right"><strong>'.number_format($amt,3).'</strong></td>';
										$content .='<td style="text-align: right" colspan="2"><strong>'.number_format($cu_amt,3).'</strong></td>';
										$content .='</tr>';
										
										$content .= '<tr style="border-bottom: 1px solid gray;">';
										$content .= '<td style="text-align: center">&nbsp;</td>';
										$content .= '<td colspan="5" style="text-align: left"><strong>Total Amount (BD)</strong></td>';

										$content .= '<td style="text-align: right" colspan="2"><strong>' . number_format($amt, 3) . '</strong></td>';
										$content .= '</tr>';
										
										
										
										
									    
									if ($total_discount_amount + $discount != 0) {
										// Your code logic when the condition is true.
									}

									$content .= '<tr style="border-bottom: 1px solid gray;">';
									$content .= '<td style="text-align: center">&nbsp;</td>';
									$content .= '<td colspan="5" style="text-align: left"><strong>Discount Amount</strong></td>';
									$content .= '<td style="text-align: right" colspan="2"><strong>';

									if ($discount_type == "BD") {
										$number = explode('.', $discount_amount);
										if ($number[1] == '000') {
											$x = $discount_amount;
											$content .= number_format($discount_amount, 0);
										} else {
											$x = $discount_amount;
											$content .= $discount_amount;
										}
									} else {
										$vat_p = ($amt * $discount_amount) / 100;
										$content .= number_format($vat_p, 3);
									}

									$content .= '</strong></td>';
									$content .= '</tr>';
									
									
									$content .= '<tr style="border-bottom: 1px solid gray;">';
									$content .= '<td style="text-align: center">&nbsp;</td>';
									$content .= '<td colspan="5" style="text-align: left"><strong>Net Amount</strong></td>';
									$content .= '<td style="text-align: right" colspan="2"><strong>';

									$netamt = $amt-$vat_p ;

									$content .= number_format($netamt, 3); 

									$content .= '</strong></td>';
									$content .= '</tr>';
									
									$content .= '<tr style="border-bottom: 1px solid gray;">';
									$content .= '<td style="text-align: center">&nbsp;</td>';
									$content .= '<td colspan="5" style="text-align: left"><strong>Current Invoice Amount</strong></td>';
									$content .= '<td style="text-align: right" colspan="2"><strong>'.number_format($cu_amt,3).'</strong></td>';;

								   
									$content .= '</tr>';
									
									
									$content .= '<tr style="border-bottom: 1px solid gray;">';
									$content .= '<td style="text-align: center">&nbsp;</td>';
									$content .= '<td colspan="5" style="text-align: left"><strong>Less Previouse Bill (BD)</strong></td>';

									$content .= '<td style="text-align: right" colspan="2"><strong>';

									//$netamt = $amt-$discount_amount ;

									//$content .= number_format($netamt, 3); 

									$content .= '</strong></td>';
									$content .= '</tr>';
									
									
									$content .= '<tr style="border-bottom: 1px solid gray;">';
									$content .= '<td style="text-align: center">&nbsp;</td>';
									$content .= '<td colspan="5" style="text-align: left"><strong>Less Advance (BD) 10%</strong></td>';

									$content .= '<td style="text-align: right" colspan="2"><strong>';

									//$netamt = $amt-$discount_amount ;

									//$content .= number_format($netamt, 3); 

									$content .= '</strong></td>';
									$content .= '</tr>';
									
									
									$content .= '<tr style="border-bottom: 1px solid gray;">';
									$content .= '<td style="text-align: center">&nbsp;</td>';
									$content .= '<td colspan="5" style="text-align: left"><strong>Less Retention Amount (BD) 5%</strong></td>';

									$content .= '<td style="text-align: right" colspan="2"><strong>';

									//$netamt = $amt-$discount_amount ;

									//$content .= number_format($netamt, 3); 

									$content .= '</strong></td>';
									$content .= '</tr>';
									
									$content .= '<tr style="border-bottom: 1px solid gray;">';
									$content .= '<td style="text-align: center">&nbsp;</td>';
									$content .= '<td colspan="5" style="text-align: left"><strong>Net Balance Amount (BD)</strong></td>';


									$content .= '<td style="text-align: right" colspan="2"><strong>';

									$netamt = $amt-$discount_amount ;

									$content .= number_format($netamt, 3); 

									$content .= '</strong></td>';
									$content .= '</tr>';
									
									
										$content .= '<tr style="border-bottom: 1px solid gray;">';
										$content .= '<td style="text-align: center">&nbsp;</td>';
										$content .= '<td colspan="5" style="text-align: left"><strong>Tax (VAT)10%</strong></td>';
										$content .= '<td style="text-align: right" colspan="2"><strong>';
										//$content .= number_format($p, 3);
										$content .= '</strong></td>';
										$content .= '</tr>';

										$content .= '<tr style="border-bottom: 1px solid gray;">';
										$content .= '<td style="text-align: center">&nbsp;</td>';
										$content .= '<td colspan="5" style="text-align: left"><strong>Gross Amount (BD)</strong></td>';
										$content .= '<td style="text-align: right" colspan="2"><strong>';

										//$v_total_amt = $total_amount + $vat_p;
										//$content .= number_format($q, 3);

										$content .= '</strong></td>';
										$content .= '</tr>';
										
										
										 
										$content .= '<tr>';
										$content .= '<td colspan="9" style="text-align: center;font-size:12px;border: none;">Bahraini Dinars: <strong>';

										$ro = round($q, 3);
										$amt1 = str_replace(",", "", $ro);

										$splitamount = explode('.', $q);

										$splitamount1 = number_format((float)$q, 3, '.', '');
										$splitamount = explode('.', $splitamount1);

										if (intval($splitamount[1]) <= 0) {
											$content .= getCurrency($splitamount[0]) . ' only';
										} else {
											$content .= getCurrency($splitamount[0]) . '  ' . $splitamount[1] . '/1000  fills only';
										}

										$content .= '</strong> </td>';
										$content .= '</tr>';

		       
		
//$pdf->Ln(5);
$html = <<<EOD

 <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" id="main_table">
        <tbody>
            <tr>
                <td style="padding-left: 10px; padding-right: 10px">
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tbody>
                            <tr>
                                <td width="50%" align="left" valign="top" style="padding-bottom: 0px;"></td>
                                <td align="left" valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center; color: #FFFFFF; font-size: 24px; font-family: 'Century Gothic';width:290px;" bgcolor="#0079DD">
                                                    INVOICE
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" style="padding-top: 0px;">
                                    <p>
									    <strong>$company_name</strong>,<br>
										
                                        <strong>PO Box&nbsp;:$po_box,</strong><br>
										<strong>&nbsp;&nbsp;Manama, Kingdom of Bahrain</strong><br>
										<strong>&nbsp;&nbsp;TEL : $telephone_no</strong><br>
										<strong>&nbsp;&nbsp;FAX : $fax</strong><br>
										<strong>&nbsp;&nbsp;VAT NO : $company_vat_no</strong>
                                        
                                    </p>
                                </td>
                                <td align="left" valign="top">
                                    <table cellspacing="0" cellpadding="5">
                                        <tbody style="">
                                            <tr style="text-align:right;">
                                                <td>VAT ACCOUNT NO: :<strong>$vat_no</strong></td>
                                            </tr>
                                            <tr style="text-align:right;">
                                                <td>INVOICE NO:<strong>$invoice_number</strong></td>
                                            </tr>
                                            <tr style="text-align:right;">
                                                <td>Date :<strong>$invoice_date</strong></td>
                                            </tr>
											<tr style="text-align:right;">
                                                <td>Quotation Ref :<strong>$quotation_reference</strong></td>
                                            </tr>
											<tr style="text-align:right;">
                                                <td>LPO No :<strong>$LPO_no</strong></td>
                                            </tr>
											
                                           
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
							<tr style="text-align:left;">
								<td>&nbsp;&nbsp;<strong>PROJECT :$project_name</strong></td>
							</tr>
							<tr style="text-align:left;">
								<td>&nbsp;&nbsp;<strong>ATTN :$attn</strong></td>
							</tr>
                            
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 10px; padding-right: 10px">
                    <table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
                        <tbody>
                                            <tr>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:30px"><strong >SL</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:170px"> <strong>Description</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Qty</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:80px"><strong>Rate (BD)</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:80px"><strong>Amount (BD)</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:80px"><strong>% / QTY</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:90px"><strong>Cumulative Amount</strong></td>
											
											</tr>
                                       $content
									   
						   
                        </tbody>
                    </table>
                </td>
            </tr>
			
			
        </tbody>
    </table>
	
	<table width="100%" border="0" cellspacing="0" align="center">
	  <tbody>
		<tr>
		  <td align="center" valign="bottom"><span style="padding-left: 10px;padding-right: 10px"><span style="text-align: left"> $description </span></span></td>
		</tr>
	  </tbody>
   </table> 
	
	

EOD;


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



//Close and output PDF document
$pdf->Output($invoice_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
