<?php
include("../../../session_check.php");
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
   
   
   $result = mysqli_query($conns,"select * from intern_payment_main_tbl  where 	invoice_number = '".$_GET['invoice_number']."'");
    
    
	
	
	function convertNumberToWordsIndianFormat($number) {
    // Define Indian numbering system suffixes
    $suffix = array("", "Thousand", "Lakh", "Crore");
    
    // Split the number into groups of three digits
    $groups = [];
    while ($number > 0) {
        $groups[] = $number % 1000;
        $number = floor($number / 1000);
    }

    // Convert each group to words and combine with suffix
    $result = "";
    for ($i = count($groups) - 1; $i >= 0; $i--) {
        $group = $groups[$i];
        if ($group > 0) {
            $result .= convertThreeDigitGroupToWords($group) . " " . $suffix[$i] . " ";
        }
    }

    // Remove trailing spaces and return
    return trim($result);
}

function convertThreeDigitGroupToWords($number) {
    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine");
    $tens = array("", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");
    $teens = array("Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");

    $words = "";

    // Extract hundreds place
    $hundreds = floor($number / 100);
    if ($hundreds > 0) {
        $words .= $ones[$hundreds] . " Hundred ";
    }

    // Extract tens and ones place
    $tens_ones = $number % 100;
    if ($tens_ones >= 20) {
        $tens_digit = floor($tens_ones / 10);
        $ones_digit = $tens_ones % 10;
        $words .= $tens[$tens_digit] . " " . $ones[$ones_digit];
    } elseif ($tens_ones >= 10) {
        $words .= $teens[$tens_ones - 10];
    } else {
        $words .= $ones[$tens_ones];
    }

    return trim($words);
}
	


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
		 if($retention_amount_type=='%'){
			 $v_retention=number_format($retention_amount_percentage, 0);
			 $retention_amount = ($row['sub_total']*$v_retention)/100;
		 }
		 else{
			 $v_retention=0;
			 $retention_amount=$retention_amount_percentage;
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
   
    return ucwords(($Rupees ? $Rupees . ' ' : ' ') . $decimal .' / 1000 '."   ");
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
$pdf->setMargins(10, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
              
                $result_delivery_note_no = mysqli_query($conns,"select delivery_note_no as v_delivery_note_no from intern_payment_child_tbl where invoice_no= '".$_GET['invoice_number']."' limit 1");               
                while($row=mysqli_fetch_assoc($result_delivery_note_no)) {
                    $v_delivery_note_no=$row['v_delivery_note_no'];
                }  
                
               


                IF ($v_delivery_note_no != null) {
                    $result_quotation_no = mysqli_query($conns,"SELECT quotation_no  from intern_payment_child_tbl where invoice_no= '".$_GET['invoice_number']."' limit 1");               
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
             
              $result = mysqli_query($conns,"SELECT  `invoice_child_id`, `delivery_note_child_id`, `invoice_no`, `quotation_child_id`, `delivery_note_no`, `quotation_no`, `description`, `quantity`, `unit`,( select  ROUND(((`net_amount` / `quantity`) - ".$val.") ,3)   from quotation_child_tbl where quotation_child_id=intern_payment_child_tbl.quotation_child_id) as rate , `amount`,`discount_type`, `discount_precentage`, `discount_amount`, `vat_percentage`,ROUND (( select  ROUND(((`net_amount` / `quantity`) - ".$val.") ,3)   from quotation_child_tbl where quotation_child_id=intern_payment_child_tbl.quotation_child_id) * `quantity`,3) as net_amount, `default_date`, `quotation_status`, `required_quantity` ,`purchase_qty`,`purchase_amount_pr`,@total_quantity ,@total_discount from intern_payment_child_tbl  where invoice_no = '".$_GET['invoice_number']."'");
                 
              // echo  "SELECT  `invoice_child_id`, `delivery_note_child_id`, `invoice_no`, `quotation_child_id`, `delivery_note_no`, `quotation_no`, `description`, `quantity`, `unit`,( select  ROUND(((`net_amount` / `quantity`) - @val) ,3)   from quotation_child_tbl where quotation_child_id=invoice_child_tbl.quotation_child_id) as rate , `amount`,`discount_type`, `discount_precentage`, `discount_amount`, `vat_percentage`,ROUND (( select  ROUND(((`net_amount` / `quantity`) - @val) ,3)   from quotation_child_tbl where quotation_child_id=invoice_child_tbl.quotation_child_id) * `quantity`,3) as net_amount, `default_date`, `quotation_status`, `required_quantity` ,@total_quantity ,@total_discount from invoice_child_tbl  where invoice_no = '".$_GET['invoice_number']."' ";
                    
                }


        else
            {
                
                $result_total = mysqli_query($conns,"select sum(quantity) as total_quantity from intern_payment_child_tbl where invoice_no= '".$_GET['invoice_number']."'");               
                while($row=mysqli_fetch_assoc($result_total)) {
                    $total_quantity=$row['total_quantity'];
                }
                
                $result_total_discount = mysqli_query($conns,"SELECT total_discount_amount as total_discount, sub_total from intern_payment_main_tbl where invoice_number = '".$_GET['invoice_number']."'");               
                while($row=mysqli_fetch_assoc($result_total_discount)) {
                    $total_discount = $row['total_discount'];
					$sub_total=$row['sub_total'];
                }
             $val=  $total_discount / $total_quantity  ;

                 $result = mysqli_query($conns,"SELECT  `invoice_child_id`, `delivery_note_child_id`, `invoice_no`, `quotation_child_id`, `delivery_note_no`, `quotation_no`, `description`, `quantity`, `unit`, `rate`, `amount`,`discount_type`, `discount_precentage`, `discount_amount`, `vat_percentage`,`net_amount` as net_amount, `default_date`, `quotation_status`, `required_quantity`,`purchase_qty`,`purchase_amount_pr` from intern_payment_child_tbl where invoice_no = '".$_GET['invoice_number']."'");
            } 
                     while($row=mysqli_fetch_assoc($result)) {
						 
						$unit_rate=$row['rate'];
                          if($row['discount_amount']!=0)
                         {
                             $discount = $discount + ($row['discount_amount']);
                         }
                         $v_discount_type = $row['discount_type'];
						 
						 if($row['purchase_qty']==0.00)
						 {
							 $qtyper=$row['purchase_amount_pr'].' %';
							 $v_rate_amt=$row['rate']*$row['quantity'];
							
						 }
						 else if($row['purchase_amount_pr']==0.00)
						 {
							 $qtyper=$row['purchase_qty'];
							 $v_rate_amt=$row['rate'];
						 }
						 
                         
                                        	$content .='<tr>';
                                            $content .=  '<td bgcolor="#E5E5E5" style="text-align: center;border: 1px solid #C0C0C0;border-collapse: collapse;">'.$ctr.'</td>';
                                            $content .=  '<td bgcolor="#E5E5E5" style="border: 1px solid #C0C0C0;border-collapse: collapse;">'.$row['description'].'</td>';
                                            $content .=  '<td bgcolor="#E5E5E5" style="text-align: center;border: 1px solid #C0C0C0;border-collapse: collapse;vertical-align: middle;">'.number_format($row['quantity'],3).'</td>';
                                            $content .=  '<td bgcolor="#E5E5E5" style="text-align: center;border: 1px solid #C0C0C0;border-collapse: collapse;">'.$row['unit'].'</td>';
                                            //$content .=  '<td bgcolor="#E5E5E5" style="text-align: center;border: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($v_rate_amt,3).'</td>';
											$content .=  '<td bgcolor="#E5E5E5" style="text-align: center;border: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($unit_rate,3).'</td>';
											$content .=  '<td bgcolor="#E5E5E5" style="text-align: center;border: 1px solid #C0C0C0;border-collapse: collapse;vertical-align: middle;">'.$qtyper.'</td>';
                                            $content .=  '<td bgcolor="#E5E5E5" style="text-align: right;border: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($row['net_amount'],3).'</td>';
                                            $content .='</tr>';
						                    $amt=$amt+ $row['amount'];
						                    $cu_amt=$cu_amt+ $row['net_amount'];   
                                            $ctr = $ctr +1;	
												 
                                       }
									   $content .='<tr>';
                                       $content .='   <td>&nbsp;</td>';
                                       $content .='   <td>&nbsp;</td>';
                                       $content .='   <td>&nbsp;</td>';
                                       $content .='   <td>&nbsp;</td>';
                                       $content .='   <td>&nbsp;</td>';
                                       $content .='   <td>&nbsp;</td>';
                                       $content .=' </tr>';
									   
									   
									   
									   
										     $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4"><strong>Total Amount (Ex-VAT)</strong></td>';
                                              
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"><strong>'.$sub_total.'</strong></td>';
                                            $content .='</tr>';
											if($discount_amount!=0){
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"colspan="4">Discount</td>';
                                              $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
											  
											  if ($discount_type == "BD") {
													$number = explode('.', $discount_amount);
													if ($number[1] == '000') {
														//$x= $discount_amount;
														$disc= number_format($discount_amount, 0);
														$vat_p= number_format($discount_amount, 0);
														$content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
														$content .='<td style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($disc,3).'</td>';
														
													} else {
														//$x = $discount_amount;
														//$content .= $discount_amount;
														$vat_p = $discount_amount;
														$content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
														$content .='<td style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($discount_amount,3).'</td>';
														
													}
												} else {
													$vat_p = ($sub_total * $discount_amount) / 100;
													$disc= number_format($discount_amount, 0);
													//$content .= number_format($vat_p, 3);
													$content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.$disc.'%</td>';
													$content .='<td style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($vat_p,3).'</td>';
											  }
                                              // $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.$discount_amount.'%</td>';
                                              // $content .='<td style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.$discount.'</td>';
                                            $content .='</tr>';
											}
											$v_net_amt=$sub_total-$vat_p;
											if($discount_amount!=0){
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4"><strong>Net Amount (Ex-VAT)</strong></td>';
                                              $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
											  
                                              $content .='<td style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"><strong>'.number_format($v_net_amt,3).'</strong></td>';
                                            $content .='</tr>';
											}
											if($previous_bill_amount!=0){
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4" bgcolor="#E5E5E5">Gross Value of work BD </td>';
											  
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($v_net_amt,3).'</td>';
                                            $content .='</tr>';
											
											
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4" bgcolor="#E5E5E5">Less Previous Bill received BD</td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.$previous_bill_amount.'</td>';
                                            $content .='</tr>';
											}
											$nt_amt_due=$v_net_amt-$previous_bill_amount;
											if($previous_bill_amount!=0){
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4" bgcolor="#E5E5E5"><strong>Net Amount due to date</strong></td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"><strong>'.number_format($nt_amt_due,3).'</strong></td>';
                                            $content .='</tr>';
											}
											if($retention_amount!=0){
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4" bgcolor="#E5E5E5">Less Retention BD</td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
											  if($v_retention!=0){
												$content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.$v_retention.'%</td>';
												$content .='<td bgcolor="#E5E5E5" style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($retention_amount,3).'</td>';
											  }
											  else{
												  $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
												$content .='<td bgcolor="#E5E5E5" style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($retention_amount,3).'</td>';
											  }
                                              // $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.$retention_amount_percentage.'%</td>';
                                              // $content .='<td bgcolor="#E5E5E5" style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.$retention_amount.'</td>';
                                            $content .='</tr>';
											}
											$sub_rete=$nt_amt_due-$retention_amount;
											if($received_amount_type=='%'){
											$v_recied_pr=number_format($received_amount, 0);
											$v_rec_amt=($sub_total*$v_recied_pr)/100;
											}
											else{
												$v_recied_pr=0;
												$v_rec_amt=$received_amount;
											}
											$grant_total_amt=$sub_rete-$v_rec_amt;
											if($v_rec_amt!=0){
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4" bgcolor="#E5E5E5">Less Advance received BD</td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
											  if($v_recied_pr!=0){
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.$v_recied_pr.'%</td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($v_rec_amt,3).'</td>';
											  }
											  else{
												  $content .='<td bgcolor="#E5E5E5" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
                                              $content .='<td bgcolor="#E5E5E5" style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($v_rec_amt,3).'</td>';
											  }
											$content .='</tr>';
											}
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4"><strong>Grand Total (Ex-VAT)</strong></td>';
                                              $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"><strong>'.number_format($grant_total_amt,3).'</strong></td>';
                                            $content .='</tr>';
											$v_tax=($grant_total_amt*10)/100;
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4">Tax (VAT) 10%</td>';
                                              $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"></td>';
                                              $content .='<td style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($v_tax,3).'</td>';
                                            $content .='</tr>';
											$total_withtax=$grant_total_amt+$v_tax;
                                            $content .='<tr>';
                                              $content .='<td style="border-bottom: 1px solid #C0C0C0;border-collapse: collapse;" colspan="4"><strong>Total Amount in Due BD</strong></td>';
                                              $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;">&nbsp;</td>';
                                              $content .='<td style="text-align: right;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"><strong>'.number_format($total_withtax,3).'</strong></td>';
                                            $content .='</tr>';
											
											//$number =  round($total_withtax);// Replace this with your desired number
											$words = getCurrency($total_withtax);
											
                                            $content .='<tr>';
                                              $content .='<td colspan="8" style="text-align: center;border-bottom: 1px solid #C0C0C0;border-collapse: collapse;"><strong>( '.$words.'&nbsp;Bahraini Dinar only)</strong></td>';
                                            $content .='</tr>';
                                            $content .='<tr>';
                                              $content .='<td colspan="8" style="text-align: center">&nbsp;</td>';
                                            $content .='</tr>';
                                          
                                          
		       
		
//$pdf->Ln(5);
$html = <<<EOD
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

</head>

<body>
	
	
<table width="100%" border="0" cellpadding="5" >
  <tbody>
    <tr>
      <td colspan="3">&nbsp;</td>
      <td colspan="3" style="padding:15px;text-align: center; background-color: #0079dd; color: white; font-size: 25px;">INTERN PAYMENT APPLICATION</td>
    </tr>
    <tr>
      <td colspan="3" align="left" valign="top">
	  <strong>$company_name</strong>,<br>
<strong>&nbsp;PO Box:$po_box,</strong><br>
<strong>&nbsp;Manama, Kingdom of Bahrain</strong><br>
<strong>&nbsp;TEL : $telephone_no</strong><br>
<strong>&nbsp;FAX : $fax</strong><br>
<strong>&nbsp;VAT NO : $company_vat_no</strong>
</td>
      <td colspan="3" align="right" valign="top">
	  VAT ACCOUNT NO: :<strong>$vat_no</strong><br>
      INVOICE NO:<strong>$invoice_number</strong><br>
      Date :<strong>$invoice_date</strong><br>
      Quotation Ref :<strong>$quotation_reference</strong><br>
      LPO No :<strong>$LPO_no</strong></td>
    </tr>
    <tr>
      <td colspan="3">
	  <p><strong>&nbsp;&nbsp;PROJECT :$project_name</strong><br>
        <strong>ATTN :$attn</strong><br>
      </p></td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
       <td width="8%" bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;border: 1px solid #C0C0C0;border-collapse: collapse;">Sl No</td>
      <td width="27%" bgcolor="#0079DD" style="text-align: center ; color: #FFFFFF;border: 1px solid #C0C0C0;border-collapse: collapse;">Discription</td>
      <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;border: 1px solid #C0C0C0;border-collapse: collapse;">Qty</td>
      <td width="10%" bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;border: 1px solid #C0C0C0;border-collapse: collapse;">Unit</td>
      <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;border: 1px solid #C0C0C0;border-collapse: collapse;">Rate</td>
	  <td width="10%" bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;border: 1px solid #C0C0C0;border-collapse: collapse;">Gross Value of work</td>
      <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;border: 1px solid #C0C0C0;border-collapse: collapse;">Amount</td>
    </tr>
    $content
    
    <tr>
      <td colspan="6">$description</td>
      
    </tr>
  </tbody>
  
</table>
	
	
	
	
</body>
</html>   
    
 
EOD;


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



//Close and output PDF document
$pdf->Output($invoice_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
