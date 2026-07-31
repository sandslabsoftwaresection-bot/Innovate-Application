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
		public function Footer() {
        // Select Arial italic 8
        $this->SetFont('helvetica', 'I', 8);

        // Position at 15 mm from bottom
        $this->SetY(-15);

        $pageNumber = $this->getAliasNumPage();
        $totalPages = $this->getAliasNbPages();

        
        $this->Cell(350, 10, 'Page ' . $pageNumber . ' of ' . $totalPages, 0, false, 'C');

        // Increment page counter
        $this->pageCount++;
    }
	
	

  
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   $certificate_code= $_GET['quotation_number'];
} else {
   $certificate_code=  $_POST['quotation_number'];
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
        $invoice_date = date("d-m-Y", strtotime($row['invoice_date']));
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
        $description =  $row['description'];
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
    
    
    $result_company_id = mysqli_query($conns,"select description,contact_address_2 from company_details  where company_id = ".$company_id);
    while($row_comp_id=mysqli_fetch_assoc($result_company_id)) {
        $company_vat_no = $row_comp_id['description'];
        $contact_address=$row_comp_id['contact_address_2'];
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
//$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setMargins(15, PDF_MARGIN_TOP, 15);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// remove default footer
//$pdf->setPrintFooter(false);

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

                        $color = "#09037f";
                        $border_bottom = "border-bottom: 1px solid #09037f;border-top: 1px solid #09037f;";
                        $border_bottom_line= "border-bottom: 1px solid #09037f;border-top: 1px solid #09037f;";
                        $border_left = "border-left: 1px solid #09037f";
                        $table_title_style = "text-align: center; color: #FFFFFF;font-size:12px;border: 1px solid #09037f;";
                        $table_title_bg = "#09037f";
                        $table_background = "background: transparent;"; 
                        $para_justify = "text-align: justify;text-justify: inter-word;display: inline-block;";
                        $valign_middle = "line-height: 40px;";
                        

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
						$amount_tot=$row['amount'];
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
						 
                         
                                        	$content .='<tr nobr="true" style="'.$border_bottom.';">';
                                            $content .=  '<td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$ctr.'</td>';
                                            $content .=  '<td style="text-align: left;'.$para_justify.$border_bottom.$border_left.';">'.$row['description'].'</td>';
                                            $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($row['quantity'],2).'</td>';
                                            $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$row['unit'].'</td>';
                                            //$content .=  '<td bgcolor="#E5E5E5" style="text-align: center;border: 1px solid #C0C0C0;border-collapse: collapse;">'.number_format($v_rate_amt,3).'</td>';
											$content .=  '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($unit_rate,3).'</td>';
											$content .=  '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($amount_tot,3).'</td>';
											$content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($qtyper,0).'%</td>';
                                            $content .=  '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($row['net_amount'],3).'</td>';
                                            $content .='</tr>';
						                    $amt=$amt+ $row['amount'];
						                    $cu_amt=$cu_amt+ $row['net_amount'];   
                                            $ctr = $ctr +1;	
												 
                                       }
									   //$content .='<tr style="border-bottom: 1px solid gray;">';
            //             			  $content .='<td colspan="6" style="text-align: left;'.$border_bottom_line.' "><strong>Total Amount (Ex-VAT)</strong></td>';
            //             			  $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.';"><strong>'.number_format($sub_total,3).'</strong></td>';
            //             			  $content .='</tr>';
                        // 			if($discount_amount!=0){
                        // 			$content .='<tr style="border-bottom: 1px solid gray;">';
                        			  
                        			  
                        			  
                        			 // if ($discount_type == "BD") {
                        				// 	$number = explode('.', $discount_amount);
                        				// 	if ($number[1] == '000') {
                        						
                        				// 		$disc= number_format($discount_amount, 0);
                        				// 		$vat_p= number_format($discount_amount, 0);
                        				// 		$content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.' "><strong>Discount</strong></td>';
                        				// 		//$content .='<td style="border-left:hidden;"></td>';
                        				// 		$content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.';" ><strong>'.number_format($disc,3).'</strong></td>';
                        						
                        				// 	} else {
                        						
                        				// 		$vat_p = $discount_amount;
                        				// 		$content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.' "><strong>Discount</strong></td>';
                        				// 		$content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'" ><strong>'.number_format($discount_amount,3).'</strong></td>';
                        						
                        				// 	}
                        				// } else {
                        				// 	$vat_p = ($sub_total * $discount_amount) / 100;
                        				// 	$disc= number_format($discount_amount, 0);
                        				// 	$content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.' "><strong>Discount  / '.$disc.'%</strong></td>';
                        				// //	$content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'" ><strong>'.$disc.'%</strong></td>';
                        				// 	$content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'" ><strong>'.number_format($vat_p,3).'</strong></td>';
                        			 // }
                        			  
                        			 
                        // 			$content .='</tr>';
                        // 			}
                        		//	$v_net_amt=$sub_total-$vat_p;
                        // 			if($discount_amount!=0){
                        // 			  $content .='<tr style="border-bottom: 1px solid gray;">';
                        // 			  $content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.';"><strong>Net Amount (Ex-VAT)</strong></td>';
                        			 
                        // 			  $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.';"><strong>'.number_format($v_net_amt,3).'</strong></td>';
                        // 			$content .='</tr>';
                        // 			}
                        			
                        			 $gross_value_tbl=$previous_bill_amount+$sub_total;
                        			$content .='<tr style="border-bottom: 1px solid gray;">';
                        			  $content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.' "><strong>Gross Value of work BD </strong></td>';
                        			  
                        			  $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'"><strong>'.number_format($gross_value_tbl,3).'</strong></td>';
                        			$content .='</tr>';
                        			
                        			if($previous_bill_amount!=0){
                        			$content .='<tr style="border-bottom: 1px solid gray;">';
                        			  $content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.' "><strong>Less Previous Bill received BD</strong></td>';
                        			 
                        			  $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'" ><strong>'.$previous_bill_amount.'</strong></td>';
                        			$content .='</tr>';
                        			}
                        			
                        			$nt_amt_due=$sub_total;
                        			if($previous_bill_amount!=0){
                        			$content .='<tr style="border-bottom: 1px solid gray;">';
                        			  $content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.' "><strong>Net Amount due to date</strong></td>';
                        			 
                        			  $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.';"><strong>'.number_format($nt_amt_due,3).'</strong></td>';
                        			$content .='</tr>';
                        			}
                        			
                        			if($retention_amount!=0){
                                            $content .='<tr style="border-bottom: 1px solid gray;">';
                                              //$content .='<td style="text-align: left;'.$border_bottom_line.' " colspan="5"><strong>Less Retention BD</strong></td>';
                                              
                                            //   $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'"></td>';
											  if($v_retention!=0){
												$content .='<td style="text-align: left;'.$border_bottom_line.' " colspan="7"><strong>Less :- Retention '.$v_retention.'% </strong></td>';
                                              
												//$content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'"><strong>'.$v_retention.'%</strong></td>';
												$content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'"><strong>'.number_format($retention_amount,3).'</strong></td>';
											  }
											  else{
											    $content .='<td style="text-align: left;'.$border_bottom_line.' " colspan="7"><strong>Less :- Retention BD</strong></td>';
                                                  
												$content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'"><strong>'.number_format($retention_amount,3).'</strong></td>';
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
                                            $content .='<tr style="border-bottom: 1px solid gray;">';
                                             
                                             
											  if($v_recied_pr!=0){
											  $content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.'"><strong>Less :- Advance received '.$v_recied_pr.'%</strong></td>';   
                                             // $content .='<td style="text-align: left;'.$border_left.';'.$border_bottom_line.'; "><strong>'.$v_recied_pr.'%</strong></td>';
                                              $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'; "><strong>'.number_format($v_rec_amt,3).'</strong></td>';
											  }
											  else{
											    $content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.'"><strong>Less :- Advance received BD</strong></td>';   
                                                  
												  //$content .='<td style="text-align: center;'.$border_left.';'.$border_bottom_line.'"></td>';
                                              $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'; "><strong>'.number_format($v_rec_amt,3).'</strong></td>';
											  }
											$content .='</tr>';
											}
                        			
                        			
                        		
                        			  $content .='<tr style="border-bottom: 1px solid gray;">';
                        			  $content .='<td colspan="7" style="text-align: left;'.$border_bottom_line.' "><strong>Grand Total (Ex-VAT)</strong></td>';
                        			 
                        			  
                        			  $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'"><strong>'.number_format($grant_total_amt,3).'</strong></td>';
                        			  $content .='</tr>';
                        			  $v_tax=($grant_total_amt*10)/100;
                        			  $content .='<tr style="border-bottom: 1px solid gray;">';
                        			  $content .='<td style="text-align: left;'.$border_bottom_line.' " colspan="7"><strong>Tax (VAT) '.number_format($tax_content,0).'%</strong></td>';
                        			 
                        			  $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'"><strong>'.number_format($v_tax,3).'</strong></td>';
                        			  $content .='</tr>';
                        			 $total_withtax=$grant_total_amt+$v_tax;
                        			 $content .='<tr style="border-bottom: 1px solid gray;">';
                        			  $content .='<td style="text-align: left;'.$border_bottom_line.';" colspan="7"><strong>Total Amount Due in BD</strong></td>';
                        			 
                        			  $content .='<td style="text-align: right;'.$border_left.';'.$border_bottom_line.'"><strong>'.number_format($total_withtax,3).'</strong></td>';
                        			  $content .='</tr>';
                        			  
                        			$words = getCurrency($total_withtax);
                    				$content = $content.'<tr style="border-bottom: 1px solid gray;">';
                    				$content = $content.'    <td colspan="8" style="text-align: center; font-size:12px;"><strong>Bahraini Dinars:'.$words.'&nbsp;only</strong>';
                        			$content = $content.'</td>';
                        			$content = $content.'    </tr>';
                                          


//$pdf->Ln(5);
$html = <<<EOD

<table width="100%" border="0" cellspacing="0"   id="main_table" style="$table_background">
 
 
  <tbody>
    <tr >
      <td style="padding-left:10px;padding-right:10px;">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px;$table_background">
        <tbody>
          <tr>
            <td width="49%" align="left" valign="top" style="padding-bottom: 0px;"></td>
            
            <td align="right" valign="top" style="background-color:red;" >
				<table width="100%"  cellspacing="0" cellpadding="5">
					<tbody>
						<tr >
						  <td width="20%" bgcolor="white"></td>
						  <td width="80%"style="text-align: right; color: #FFFFFF; font-size: 24px;  " bgcolor="$table_title_bg">INTERIM PAYMENT</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left"  style="font-weight:bold;text-align:right;" >
           
             
                <br>$company_name
                <br>P O Box : $po_box ,<br>
				$contact_address
                
                <br>TEL :  $telephone_no ,
                FAX :  $fax 
                <br>VAT : $company_vat_no
                
              </td>
            <td align="left" >
			  <table width="100%"  style="padding-top:5px;" >
              <tbody>
                
                <tr style="text-align: right;">
                  <td>Date : <strong>$invoice_date</strong></td>
                </tr>
                <tr style="text-align: right;">
                  <td >INTERIM PAYMENT NO : <strong>$invoice_number</strong></td>
                </tr>
               
                <tr style="text-align: right;">
                  <td>VAT Account No : <strong>$vat_no</strong></td>
                </tr>
				 <tr style="text-align: right;">
                  <td>Quotation Ref : <strong>$quotation_reference</strong></td>
                </tr>
				 <tr style="text-align: right;">
                  <td> LPO No : <strong>$LPO_no</strong></td>
                </tr>
				
				
              </tbody>
            </table>
			    
			  </td>
          </tr>
          <tr >
            <td colspan="2" align="left" valign="middle" style="height: 40px;"><div style="vertical-align: middle;"><strong><br>ATTN :  $attn </strong></div></td>
          </tr>
          <tr>
            <td colspan="2" align="left"  style="height: 30px;"><strong>PROJECT : $project_name </strong></td>
          </tr>
          
          
        </tbody>
      </table>
		
	  </td>
    </tr>
    <tr>
      <td>
         
         <table width="100%"  cellspacing="0" cellpadding="3"  style="border-collapse: collapse;border: .7em solid $color;$table_background" >
        <tbody>
          <tr >
              <td width="5%" bgcolor="$table_title_bg" style="$table_title_style">Sl No</td>
              <td width="30%" bgcolor="$table_title_bg" style="$table_title_style">Discription</td>
              <td width="6%" bgcolor="$table_title_bg" style="$table_title_style">Qty</td>
              <td width="5%" bgcolor="$table_title_bg" style="$table_title_style">Unit</td>
              <td width="12%" bgcolor="$table_title_bg" style="$table_title_style">Rate</td>
              <td width="14%" bgcolor="$table_title_bg" style="$table_title_style">Amount</td>
        	  <td width="13%" bgcolor="$table_title_bg" style="$table_title_style">Gross Value of work</td>
              <td width="14%" bgcolor="$table_title_bg" style="$table_title_style">Net Amount</td>
          </tr>  
          
		$content
		   
       
		</tbody>
	    </table>
	  </td>
    </tr>
    <br>
    <br>
  
   <tr>
    <td>
    
     <table width="98%"  cellspacing="0" cellpadding="2" align="left">
        <tbody>
          <tr>
            
            <td colspan="7" style="text-align:left">$description</td>
            
          </tr>  
         
		</tbody>
	    </table>
    
    
    </td>
    </tr>
 
</tbody>
</table>
    
   








EOD;



$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'C', true);
//$pdf->writeHTML($html);


//Close and output PDF document
$pdf->Output($invoice_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
