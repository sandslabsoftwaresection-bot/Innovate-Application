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
   $certificate_code= $_GET['quotation_number'];
} else {
   $certificate_code=  $_POST['quotation_number'];
}


// Create connection

   require_once($_SERVER['DOCUMENT_ROOT'].'/model/common/common_functions.php');
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
   
   
  $pr_main_table = mysqli_query($conns, "SELECT * FROM purchase_requsition_main_tbl WHERE purchase_req_no = '".$_GET['pr_number']."'");
    while($rows = mysqli_fetch_assoc($pr_main_table)) 
	{
        $invoice_number = $rows['purchase_req_no'];
        $invoice_date = date("m-d-Y", strtotime($rows['default_date']));
        $supplier_name= $rows['supplier_name'];
        $supplier_id = $rows['supplier_id'];
        $requsition_date = $rows['requsition_date'];
        $requested_by = $rows['requested_by'];
		$approved_by = $rows['approved_by'];
        $work_order_no_id = $rows['work_order_no_id'];
        $work_order_no = $rows['work_order_no']; 
        $requisition_status = $rows['requisition_status'];
    } 
	
	
    $result_supplier = mysqli_query($conns, "SELECT * FROM supplier_details  where company_id = ".$supplier_id);
    while($row_supplier = mysqli_fetch_assoc($result_supplier)) 
	{
        $supplier_vat_no = $row_supplier['description'];
		$contact_address = $row_supplier['contact_address_2'];
		$contact_person = $row_supplier['contact_person'];
		$contact_email = $row_supplier['contact_email'];
		$contact_phone = $row_supplier['contact_phone'];
		$fax = $row_supplier['fax'];
    }
	
	$result_company = mysqli_query($conns, "SELECT * FROM company_primary_details  where profile_id = '1'");
    while($row_company= mysqli_fetch_assoc($result_company)) 
	{
		$print_companynamne = $row_company['company_name'];
        $tele = $row_company['phone_no'];
		$company_address = $row_company['address'];
		$company_email = $row_company['email'];
    }
	
	$address_lines = explode(", ", $contact_address);
	$total_lines = count($address_lines);
	$address_output = '';

	foreach ($address_lines as $index => $line) {
		$address_output .= $line;

		if ($index < $total_lines - 1) {
			$address_output .= ',<br>';
		} else {
			$address_output .= '<br>';
		}
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
								$pr_child_table = mysqli_query($conns, "SELECT * FROM purchase_requsition_child_tbl WHERE purchase_requsition_no = '".$_GET['pr_number']."'");
									while($child_row=mysqli_fetch_assoc($pr_child_table)) {
			                               if($child_row['rate']=="" || $child_row['rate']=="0.000")
											 {
												$v_rate = ''; 
												$v_tax = ''; 
												$v_amount = '';							
											 }
											 else
											 {
												 $v_rate = $child_row['rate'];
												 $v_tax = $child_row['tax']."%";
												 $v_amount = $child_row['amount'];
											 }
                         
                        
										    $content=$content.'<tr style="border-bottom: 1px solid gray;">';
											$content=$content.'<td style="text-align: center">'.$ctr.'</td>';
											$content=$content.'<td style="text-align: left">'.$child_row['description'].'</td>';
											$content=$content.'<td style="text-align: center">'.$child_row['quantity'].'</td>';
											$content=$content.'<td style="text-align: center">'.$child_row['unit'].'</td>';
											$content=$content.'<td style="text-align: center">'.number_format($v_rate,3).'</td>';
											$content=$content.'<td style="text-align: center">'.$v_tax.'</td>';
											$content=$content.'<td style="text-align: center">'.number_format($v_amount,3).'</td>';
										    $content=$content.'</tr>';
						                    $amt = $amt+$v_amount;
						                       
                                            $ctr = $ctr +1;		
										 
												 
                                }
								
								// $content = $content.'<tr style="border-bottom: 1px solid gray;">';
								// $content = $content.'<td style="text-align: center">&nbsp;</td>';
									
								// $content = $content.'<td colspan="5" style="text-align: right"><strong>Total Amount</strong></td>';
								   
								// $content = $content.'<td style="text-align: right" colspan="2"><strong>';
								// $amt=number_format($amt,3);
								
								// $content = $content.$amt;
								// $content = $content.'</strong></td>';
								// $content = $content.'  </tr>';
								
								$content .= '<tr style="border-bottom: 1px solid gray;">';
								$content .= '<td style="text-align: center">&nbsp;</td>';
								$content .= '<td colspan="4" style="text-align: right"><strong>Total Amount</strong></td>';
								$content .= '<td style="text-align: right" colspan="2"><strong>';
								$content .= ($amt == 0) ? '' : number_format($amt, 3);
								$content .= '</strong></td>';
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
                                                <td style="text-align: center; color: #FFFFFF; font-size: 24px; font-family: 'Century Gothic';width:320px;" bgcolor="#0079DD">
                                                    PURCHASE REQUISITION
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" style="padding-top: 0px;">
                                    <p>
									    <strong>$supplier_name</strong>,<br>
										
                                        <strong>$address_output</strong><br>
                                        
                                    </p>
                                </td>
                                <td align="left" valign="top">
                                    <table cellspacing="0" cellpadding="5">
                                        <tbody style="">
                                            <tr style="text-align:right;">
                                                <td>PRD No :<strong>$invoice_number</strong></td>
                                            </tr>
                                            <tr style="text-align:right;">
                                                <td>Date :<strong>$invoice_date</strong></td>
                                            </tr>
                                            <tr style="text-align:right;">
                                                <td>Requested by :<strong>$requested_by</strong></td>
                                            </tr>
											
											<tr style="text-align:right;">
                                                <td>Job No : :<strong>$work_order_no</strong></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </td>
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
											<td  style="text-align: center; font-size:15px;width:30px;"><strong >SL</strong></td>
											<td  style="text-align: center; font-size:15px;width:260px;"> <strong>Description</strong></td>
											<td  style="text-align: center; font-size:15px;width:50px;"><strong>Qty</strong></td>
											<td  style="text-align: center; font-size:15px;width:50px;"><strong>Unit</strong></td>
											<td  style="text-align: center; font-size:15px;width:80px;"><strong>Rate</strong></td>
											<td  style="text-align: center; font-size:15px;width:80px;"><strong>Tax (VAT)</strong></td>
											<td  style="text-align: center; font-size:15px;width:80px;"><strong>Amount</strong></td>
										  </tr>
                                       $content
									   
						   
                        </tbody>
                    </table>
                </td>
            </tr>
			<br>
			<br>
		        <div class="signature-area" style="position: absolute; margin-bottom: 50px; width:100%; text-align:left;">
					<table class="tbl90" width="100%" border="0" cellspacing="0" cellpadding="5" align="left" style="margin-top: 50px;">
					  <tbody>
                       	<tr>
            			  <td><span><span style="text-align: left">For Sapphire Industries W.L.L  </span></span></td>
            			</tr>
						
						
					  </tbody>
					</table>
				</div>
				
			
			
        </tbody>
    </table>
	
	

EOD;


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



//Close and output PDF document
$pdf->Output($invoice_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
