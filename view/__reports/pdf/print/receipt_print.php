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
   
   
    $result = mysqli_query($conns,"select * from receipts where	receipts_no = '".$_GET['receipts_no']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $receipts_no = $row['receipts_no'];
        $receipts_date = date("d-m-Y H:i:s A", strtotime($row['receipts_date']));
        $receipts_method = $row['receipts_method'];
        $received_from = $row['received_from'];
        $received_other = $row['received_from_id'];
        $status = ($received_other == 0) ? 'Paid' : 'Received';
        $sum_of_amount = $row['sum_of_amount'];
        $cheque_no = $row['cheque_no'];
        $bank = $row['bank'];
        $cheque_date = date("d-m-Y", strtotime($row['cheque_date'])); 
        $invoice_id = $row['invoice_id']; 
        $received_by = $row['received_by'] ;
        $verified_by = $row['verified_by'] ;
        $total_amount = $row['total_amount'] ;
        $discription = isset($row['discription']) ? trim($row['discription']) : '';

        
        
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
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
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
   
    $paise = ($decimal > 0) ? ". " . ($words[$decimal / 100] . " " . $words[substr($decimal, 1) / 10]. " " . $words[$decimal % 10]) . ' ' : '';
    return ucwords(($Rupees ? $Rupees . ' ' : ' ') . $paise);
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

  
                        $content = $content .'<tr>';
						$content = $content .'<td colspan="2" align="left" valign="middle" style="text-align: center">';
						$content = $content .'<table width="99%" border="0" cellspacing="0" cellpadding="8">';
						$content = $content .'<tbody>';
						$content = $content .'<tr style="border-bottom: 1pt solid black;">';
						$content = $content .'<td style="border-bottom: 1pt solid black;width:170px;">Voucher No : <strong>' . $receipts_no . '</strong></td>';
						$content = $content . '<td style="border-bottom: 1pt solid black;width:70px;">';
						if (trim($receipts_method) == 'Cash') {
							$content = $content . '<strong>Cash</strong>';
						} else {
							$content = $content . 'Cash';
						}
						$content = $content . '</td>';
						
						$content = $content . '<td style="border-bottom: 1pt solid black;width:70px;">';
						if (trim($receipts_method) == 'Cheque') {
							$content = $content . '<strong>Cheque</strong>';
						} else {
							$content = $content . 'Cheque';
						}
						$content = $content . '</td>';
						
						$content = $content . '<td style="border-bottom: 1pt solid black;width:70px;">';
						if (trim($receipts_method) == 'Transfer') {
							$content = $content . '<strong>Transfer</strong>';
						} else {
							$content = $content . 'Transfer';
						}
						$content = $content . '</td >';
						
                        $content = $content . '<td style="border-bottom: 1pt solid black; width:45px;"></td>';
                        
						$content = $content .'<td style="border-bottom: 1pt solid black;width:181px;">Date : <strong>' . $receipts_date . '</strong></td>';
						$content = $content .'</tr>';
						$content = $content .'</tbody>';
						$content = $content .'</table></td>';
						$content = $content .'</tr>';
						$content = $content . '<tr>';
						$content = $content . '<td colspan="2">';
						$content = $content . '<table width="99%" border="0" cellpadding="0" cellspacing="10">';
						$content = $content . '<tbody>';
						$content = $content . '<tr>';
						$content = $content . '<td width="25%" align="left" valign="middle">'.$status.' with thanks :</td>';
						$content = $content . '<td width="78%" align="left" valign="middle" style="text-align: left; border-bottom: 1pt solid black;width:75%;"><strong>'.$received_from.'</strong></td>';
						$content = $content . '</tr>';
						$content = $content . '</tbody>';
						$content = $content . '</table>';
						$content = $content . '</td>';
						$content = $content . '</tr>';
						
						$content = $content . '<tr>';
						$content = $content . '<td colspan="2">';
						$content = $content . '<table width="99%" border="0" cellpadding="0" cellspacing="10">';
						$content = $content . '<tbody>';
						$content = $content . '<tr>';
						$content = $content . '<td width="25%" align="left" valign="middle">The Sum of BD.</td>';
						$content = $content . '<td width="78%" align="left" valign="middle" style="text-align: left; border-bottom: 1pt solid black;"><strong>';
						$splitamount = explode('.', $total_amount);
						if (intval($splitamount[1]) <= 0) {
							$content = $content . getCurrency($splitamount[0]) . ' only';
						} else {
							$content = $content . getCurrency($splitamount[0]) . '1000/' . $splitamount[1] . ' fills only';
						}
						$content = $content . '</strong></td>';
						$content = $content . '</tr>';
						$content = $content . '</tbody>';
						$content = $content . '</table>';
						$content = $content . '</td>';
						$content = $content . '</tr>';
						

						//$content = $content .'<tr>';
						//$content = $content .'<td align="left" valign="left" >Received with thanks from :</td>';
							
						//$content = $content .'<td align="left" valign="middle" style="text-align:left;border-bottom:1pt solid black;"><strong>'.$received_from.'</strong></td>';
						//$content = $content .'</tr>';
						
						// $content = $content . '<tr>';
						// $content = $content . '<td align="left" valign="left">The Sum of BD.</td>';
						// $content = $content . '<td align="left" valign="left" style="text-align: left; border-bottom: 1pt solid black;"><strong>';
						// $splitamount = explode('.', $total_amount);
						// if (intval($splitamount[1]) <= 0) {
							// $content = $content . getCurrency($splitamount[0]) . ' only';
						// } else {
							// $content = $content . getCurrency($splitamount[0]) . '1000/' . $splitamount[1] . ' fills only';
						// }
						// $content = $content . '</strong></td>';
						// $content = $content . '</tr>';
						
						$content = $content . '<tr>';
						$content = $content . '<td colspan="2" align="left" valign="left" style="text-align: left; padding-left: 0px; padding-right: 0px; border-bottom: 1pt solid black;">';
						$content = $content . '<table width="100%" border="0" cellspacing="10" cellpadding="0">';
						$content = $content . '<tbody>';
						$content = $content . '<tr>';
						$content = $content . '<td width="21%">By Cheque No/ TRF :</td>';
						$content = $content . '<td width="28%" style="border-bottom: 1pt solid black;">' . $cheque_no . '</td>';
						$content = $content . '<td width="7%">Bank :</td>';
						$content = $content . '<td width="28%" style="border-bottom: 1pt solid black;">' . $bank . '</td>';
						$content = $content . '<td width="6%">Date :</td>';
						$content = $content . '<td width="12%" style="border-bottom: 1pt solid black;">' . $cheque_date . '</td>';
						$content = $content . '</tr>';
					    
					   // $content = $content . '<tr>';
        //                 $content = $content . '<td colspan="6" style="height: 10px; background-color: #fff;"></td>'; // Adjust height as needed
        //                 $content = $content . '</tr>';	
                        
                        $content = $content . '<tr>';
                        $content = $content . '<td></td>'; // Adjust height as needed
                        $content = $content . '</tr>';
                        
						$content = $content . '<tr>';
						$content = $content . '<td colspan="2">';
						$content = $content . '<table width="99%" border="0" cellspacing="0" cellpadding="0">';
						$content = $content . '<tbody>';
						$content = $content . '<tr>';
						$content = $content . '<td width="37%" style="padding-left:  0px;">The Sum of BD.</td>';
						$content = $content . '<td width="185%" style="border-bottom: 1pt solid black;"><strong>';
						$splitamount = explode('.', $total_amount);
						if (intval($splitamount[1]) <= 0) {
							$content = $content . getCurrency($splitamount[0]) . ' only';
						} else {
							$content = $content . getCurrency($splitamount[0]) . '1000/' . $splitamount[1] . ' fills only';
						}
						$content = $content . '</strong></td>';
						$content = $content . '</tr>';
						$content = $content . '</tbody>';
						$content = $content . '</table>';
						$content = $content . '</td>';
						$content = $content . '</tr>';
						
						
						if ($discription !== '') {
						    $content = $content . '<tr>';
                            $content = $content . '<td></td>'; // Adjust height as needed
                            $content = $content . '</tr>';
                            
                            $content .= '<tr>';
                            $content .= '<td colspan="6">';
                            $content .= '<table width="99%" border="0" cellspacing="0" cellpadding="0">';
                            $content .= '<tbody>';
                            $content .= '<tr>';
                            $content .= '<td width="11%" style="padding-left: 0px;">Notes :</td>';
                            $content .= '<td width="91%" style="border-bottom: 1pt solid black;">' . htmlspecialchars($discription) . '</td>';
                            $content .= '</tr>';
                            $content .= '</tbody>';
                            $content .= '</table>';
                            $content .= '</td>';
                            $content .= '</tr>';
                        }
						
						$content = $content . '<tr>';
                        $content = $content . '<td colspan="6" style="height: 10px; background-color: #fff;"></td>'; // Adjust height as needed
                        $content = $content . '</tr>';
						
						$content = $content . '<tr style="border-bottom: 1pt solid black;">';
						$content = $content . '<td colspan="6"></td>';
						$content = $content . '</tr>';
						$content = $content . '<tr>';
						$content = $content . '<td width="11%">Received :</td>';
						$content = $content . '<td width="27%" style="border-bottom: 1pt solid black;">' . $received_by . '</td>';
						$content = $content . '<td width="11%">Verified :</td>';
						$content = $content . '<td width="27%" style="border-bottom: 1pt solid black;">' . $verified_by . '</td>';
						$content = $content . '<td width="14%">Amount BD :</td>';
						$content = $content . '<td width="12%"style="border-bottom: 1pt solid black;"><strong>' . number_format($total_amount, 3) . '</strong></td>';
						$content = $content . '</tr>';
						$content = $content . '<tr>';
						$content = $content . '<td width="11%">Signature :</td>';
						$content = $content . '<td style="border-bottom: 1pt solid black;"></td>';
						$content = $content . '<td  width="11%">Signature :</td>';
						$content = $content . '<td style="border-bottom: 1pt solid black;"></td>';
						$content = $content . '<td></td>';
						$content = $content . '<td></td>';
						$content = $content . '</tr>';
						$content = $content . '<tr>';
						$content = $content . '<td colspan="6" style="padding-top: 20px;">Cheque Payment: This is Valid on realization of Cheque.</td>';
						$content = $content . '</tr>';
						$content = $content . '</tbody>';
						$content = $content . '</table>';
						$content = $content . '</td>';
						$content = $content . '</tr>';

//$pdf->Ln(5);
$html = <<<EOD

 <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" id="main_table">
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
                                                <td style="text-align: center; color: #FFFFFF; font-size: 26px; " bgcolor="$table_title_bg">
                                                   PAYMENT VOUCHER 
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
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
$receipts_no = str_replace("/","-",$receipts_no);
$pdf->Output($receipts_no.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
