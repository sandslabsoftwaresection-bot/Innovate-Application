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
		$img_file = K_PATH_IMAGES.'sapphirebh_letterhead_land.jpg';
		}
		else
		{
		  $img_file = K_PATH_IMAGES;  
		}
		$this->Image($img_file, null, 0, 297,210, '', '', '', false, 300, 'C', false, false, 0);
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

        
        $this->Cell(520, 10, 'Page ' . $pageNumber . ' of ' . $totalPages, 0, false, 'C');

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
     $date_between =date("d-M-Y", strtotime($_GET['v_start_date']))." / ".date("d-M-Y", strtotime($_GET['v_end_date']));                          

// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('SaNDS Lab');
$pdf->setTitle('SAPPHIER/FUND_FLOW_STATEMENT/'.$date_between);
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
                        $border_bottom = "border-bottom: 1px solid #09037f;border-top: 1px solid #09037f;border-right: 1px solid #09037f;";
                        $border_bottom_line= "border-bottom: 1px solid #09037f;border-top: 1px solid #09037f;";
                        $border_left = "border-left: 1px solid #09037f";
                        $table_border = 'border: 1px solid #09037f;';
                        $border_right = "border-right: 1px solid #09037f";
                        $table_title_style = "text-align: center; color: #FFFFFF;font-size:12px;border: 1px solid #09037f;";
                        $table_title_bg = "#09037f";
                        $table_background = "background: transparent;"; 
                        $para_justify = "text-align: justify;text-justify: inter-word;display: inline-block;";
                        $valign_middle = "line-height: 15px;padding: 30px;";
                        

// add a page
$pdf->AddPage();
            $startand_end = date("d-M-Y", strtotime($_GET['v_start_date']))." / ".date("d-M-Y", strtotime($_GET['v_end_date']));
 $array = explode('-', $_GET['v_customer_id']);
    if($array[1]==0 && $_GET['bank']=='empty'){
      $result = mysqli_query($conns, "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') between '".$_GET['v_start_date']."' and '".$_GET['v_end_date']."' order by CASE WHEN approved_status = 'Approved' THEN 1 ELSE 2 END, date_format(due_date,'%Y-%m-%d')");
//echo "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') between '".$_GET['v_start_date']."' and '".$_GET['v_end_date']."' order by date_format(due_date,'%Y-%m-%d')";
    }
    else if($array[1]!=0 && $_GET['bank']=='empty'){
       
        //echo "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') between '".$_GET['v_start_date']."' and '".$_GET['v_end_date']."' and customer_id='".$array[1]."' order by date_format(due_date,'%Y-%m-%d')";
        $result = mysqli_query($conns, "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') between '".$_GET['v_start_date']."' and '".$_GET['v_end_date']."' and customer_id='".$_GET['v_customer_id']."' order by CASE WHEN approved_status = 'Approved' THEN 1 ELSE 2 END, date_format(due_date,'%Y-%m-%d')");
    }
    else if($array[1]==0 && $_GET['bank']!='empty')
    {
        if($_GET['bank']=='ALL'){
             $result = mysqli_query($conns, "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') between '".$_GET['v_start_date']."' and '".$_GET['v_end_date']."' and bank_name!='' order by CASE WHEN approved_status = 'Approved' THEN 1 ELSE 2 END, date_format(due_date,'%Y-%m-%d')");
        }
        else{
             $result = mysqli_query($conns, "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') between '".$_GET['v_start_date']."' and '".$_GET['v_end_date']."' and bank_name='".$_GET['bank']."' order by CASE WHEN approved_status = 'Approved' THEN 1 ELSE 2 END, date_format(due_date,'%Y-%m-%d')");
        }
         
    
    }
    else
    {
        if($_GET['bank']=='ALL'){
             $result = mysqli_query($conns, "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') between '".$_GET['v_start_date']."' and '".$_GET['v_end_date']."' and bank_name!='' and customer_id='".$_GET['v_customer_id']."' order by CASE WHEN approved_status = 'Approved' THEN 1 ELSE 2 END, date_format(due_date,'%Y-%m-%d')");
        }
        else{
             $result = mysqli_query($conns, "Select *,date_format(due_date,'%d-%b-%Y') as due_date from tlb_income_and_expence where date_format(due_date,'%Y-%m-%d') between '".$_GET['v_start_date']."' and '".$_GET['v_end_date']."' and bank_name='".$_GET['bank']."' and customer_id='".$_GET['v_customer_id']."' order by CASE WHEN approved_status = 'Approved' THEN 1 ELSE 2 END, date_format(due_date,'%Y-%m-%d')");
        }
        
    
    }
       
        $income_rows = [];
        $expense_rows = [];
        
        foreach ($result as $row) {
            
            if ($row['type'] == 'Income') {
                $income_rows[] = $row;
            } elseif ($row['type'] == 'Expenditure') {
                $expense_rows[] = $row;
            }
        }
        
        $content_expense = ''; 
        $content_income = '';
        
$ctr1=1;
$ctr=1;
$count_exp=0;
$count_inc=0;
$exp_total =0.000;
$income_total = 0.000;
// Initialize last_approved_status
$last_approved_status_expense = null;
$last_approved_status_income = null;
$sum_exp=0;
$sum_inc=0;

foreach ($result as $row_result) {
    $approved_status = $row_result['approved_status'];
    
    if ($row_result['type'] == 'Expenditure') {
        if ($approved_status !== $last_approved_status_expense) {
            if (!$firstGroup && $count_exp!=0) {  
                    // If it's not the first group, add the footer for the previous group
                    $content_expense .= '<tr class="footer"><td colspan="3" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Total</td>
                    <td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_exp,3).'</strong></td>
                    </tr>';
            }
             $firstGroup = false; 
             $count_exp++;
             $sum_exp=0;
            $content_expense .= '<tr class="group"><td colspan="5" bgcolor="'.$table_title_bg.'" style="text-align: left;'.$table_title_style.';"><strong style="font-size: 12px;">' . $approved_status . '</strong></td></tr>';
            $last_approved_status_expense = $approved_status;
        }
        // Expenditure content generation...
        $result_receipt = ($row_result['cheque_no_receipt_no'] == '') ? '0000' : $row_result['cheque_no_receipt_no'];
        $content_expense .= '<tr nobr="true" style="'.$border_bottom.';">';    
        $content_expense .= '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$ctr.'</td>';
        $content_expense .= '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$row_result['due_date'].'</td>';
        $content_expense .= '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$row_result['customer_name'].'</td>';
        $content_expense .= '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.$row_result['dr_amount'].'</td>';
        $content_expense .= '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$result_receipt.' / '.$row_result['bank_name'].'</td>';
        $content_expense .= '</tr>';
        $exp_total += (float) $row_result['dr_amount'];
        $sum_exp+= (float) $row_result['dr_amount'];
        $ctr++;
    } else {
        if ($approved_status !== $last_approved_status_income) {
            if (!$firstGroup_in && $count_inc!=0) {  
                    // If it's not the first group, add the footer for the previous group
                    $content_income .= '<tr class="footer"><td colspan="3" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Total</td>
                    <td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_inc,3).'</strong></td>
                    </tr>';
            }
             $firstGroup_in = false; 
             $sum_inc=0;
             $count_inc++;
            $content_income .= '<tr class="group"><td colspan="5" bgcolor="'.$table_title_bg.'" style="text-align: left;'.$table_title_style.';"><strong style="font-size: 12px;">' . $approved_status . '</strong></td></tr>';
            $last_approved_status_income = $approved_status;
        }
        // Income content generation...
        $result_receipt = ($row_result['cheque_no_receipt_no'] == '') ? '0000' : $row_result['cheque_no_receipt_no'];
        $content_income .= '<tr nobr="true" style="'.$border_bottom.';">';
        $content_income .= '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$ctr1.'</td>';
        $content_income .= '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$row_result['due_date'].'</td>';
        $content_income .= '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$row_result['customer_name'].'</td>';
        $content_income .= '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.$row_result['cr_amount'].'</td>';
        $content_income .= '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$result_receipt.' / '.$row_result['bank_name'].'</td>';
        $content_income .= '</tr>'; 
        $income_total += (float) $row_result['cr_amount'];
        $sum_inc += (float) $row_result['cr_amount'];
        $ctr1++;
    }
   
    // Calculate balance_amount
    $balance_amount = $income_total - $exp_total;
}
 $content_income .= '<tr class="footer"><td colspan="3" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Total</td>
            <td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_inc,3).'</strong></td>
            </tr>';
$content_expense .= '<tr class="footer"><td colspan="3" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Total</td>
            <td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_exp,3).'</strong></td>
            </tr>';

$exp_total=number_format($exp_total,3);
$income_total=number_format($income_total,3);
$balance_amount=number_format($balance_amount,3);

$html = <<<EOD
<table width="100%" border="0" cellspacing="0"   id="main_table" style="$table_background.$table_border">
 
 
  <tbody>
    <tr nobr="true">
      <td style="padding-left:10px;padding-right:10px;">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px;$table_background">
        <tbody>
          <tr nobr="true">
            <td width="49%" align="left" valign="top" style="padding-bottom: 0px;"></td>
            
            <td align="right" valign="top"  >
				<table width="100%"  cellspacing="0" cellpadding="5">
					<tbody>
						<tr >
						  <td width="30%" bgcolor="white"></td>
						  <td width="70%" style="text-align: right; color: #FFFFFF; font-size: 24px;" bgcolor="$table_title_bg">FUND FLOW STATEMENT</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left"  style="font-weight:bold;text-align:right;" >
           
             
                
                
              </td>
            <td align="left" >
			  <table width="100%"  style="padding-top:5px;" >
              <tbody>
                
                <tr style="text-align: right;">
                  <td>Date : <strong>$startand_end</strong></td>
                </tr>
               
				 <tr style="text-align: right;">
                  <td></td>
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
      <td> 
         
       <table width="100%" border="0" style="border:hidden;">
  <tbody>
    <tr >
      <td style="padding:20px;"><table width="99%" border="1"  style="border-collapse: collapse;" cellpadding="0">
  <tbody>
    <tr >
      <td width="50%"><table width="100%" border="1" style="border-collapse: collapse;" cellpadding="5" style="$table_border">
        <tbody>
          <tr nobr="true">
            <td colspan="5" align="center" valign="middle" style="color:red;" bgcolor="$table_title_bg" style="$table_title_style"><strong>INCOME</strong></td>
            </tr>
            <tr>
    			<td width="8%" align="center" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';"><strong>Sl</strong></td>
                <td width="18%" align="center" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Date</td>
                
                <td width="31%" align="center" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Client</td>
                <td width="20%" align="center" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Amount</td>
                <td width="23%" align="center" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Cheque/Cash</td>
          </tr>
          $content_income
        </tbody>
      </table></td>
      <td width="50%"><table width="100%" border="1" style="border-collapse: collapse;" cellpadding="5" style="$table_border">
        <tbody>
          <tr nobr="true">
            <td colspan="5" align="center" valign="middle" style="color:red;" bgcolor="$table_title_bg" style="$table_title_style"><strong>EXPENSE</strong></td>
          </tr>
            <tr>
                <td width="8%" align="center" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';" ><strong>Sl</strong></td>
                <td width="20%" align="center" valign="middle"  style="text-align: center;line-space:15px;'.$valign_middle.$border_bottom.$border_left.';">Date</td>
                <td width="30%" align="center" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Client</td>
                <td width="19%" align="center" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_right';">Amount</td>
                <td width="23%" align="center" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.$border_right';">Cheque/Cash</td>
          </tr>
          $content_expense
        </tbody>
      </table></td>
    </tr>
	<tr>
      <td><table width="100%" border="1" style="border-collapse: collapse;" cellpadding="5" style="$table_border">
        <tbody>
          <tr >
            <td width="57%" align="left" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';" >Total Income</td>
            <td width="20%" align="right" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">&nbsp;$income_total</td>
            <td width="23%" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Balance Amount</td>
            <td align="right" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">&nbsp;$balance_amount</td>
            <td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
      <td><table width="100%" border="1" style="border-collapse: collapse;" cellpadding="5" style="$table_border">
  <tbody>
    <tr>
      <td width="57%" align="left" valign="middle" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Total Expense</td>
      <td width="20%" align="right" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">&nbsp;$exp_total</td>
      <td width="23%" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">&nbsp;</td>
      <td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">&nbsp;</td>
      <td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
	  
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
	  
		
		
		
		
	 </td>
    </tr>
    <br>
    <br>
  
  
 
</tbody>
</table>



EOD;




$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'C', true);
//$pdf->writeHTML($html);


//Close and output PDF document
$invoice_number = str_replace("/","-",$invoice_number);
$pdf->Output($invoice_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
