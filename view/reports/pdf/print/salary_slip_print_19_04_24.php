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
   
   
    $result = mysqli_query($conns,"select * from  salary_main_tbl  where ids = '".$_GET['main_id']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $emp_name =ucfirst($row['emp_name']);
        $emp_com_id = $row['emp_id'];
        $division = trim($row['division']);
        $department = trim($row['department']);
        $contact_no = $row['contact_no'];
        $note = $row['note'];
        $duty_hr = $row['duty_hr'];
        $days = $row['days'];
        $gosi_pr = $row['gosi_pr'];
        $normal_ot_rate = $row['normal_ot_rate'];
        $special_ot_rate = $row['special_ot_rate'];
        $emp_tbl_id = $row['emp_tbl_id'];
        $starting_time = date('h:i A', strtotime($row['starting_time']));
        $ending_time = date('h:i A', strtotime($row['ending_time']));
       $slip_in_date=date("F Y", strtotime($row['salary_date']));
         
    } 
    
     
    $result_cpr = mysqli_query($conns,"select cpr,passport_no from  emp_registration_tbl  where ids = '".$emp_tbl_id."'");
    while($row=mysqli_fetch_assoc($result_cpr)) {
        $emp_cpr =$row['cpr'];
       $passport_no =$row['passport_no'];
        // $pass_in_date = date("m-d-Y", strtotime($row['pass_in_date']));
       
         
    } 
 
    
    $result_company = mysqli_query($conns,"select * from company_primary_details");
    while($row_company=mysqli_fetch_assoc($result_company)) {
        $print_companynamne = $row_company['company_name'];
        $print_address = $row_company['lastname'];
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
$pdf->setTitle('SAPPHIER/SLS/'.$emp_name);
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
                       
                        $color = "#09037f";
                        $border_bottom = "border-bottom: 1px solid #09037f;border-top: 1px solid #09037f;";
                        $border_bottom_line= "border-bottom: 1px solid #09037f;border-top: 1px solid #09037f;";
                        $border_left = "border-left: 1px solid #09037f";
                        $table_title_style = "text-align: center; color: #FFFFFF;font-size:12px;border: 1px solid #09037f;";
                        $table_title_bg = "#09037f";
                        $table_background = "background: transparent;"; 
                        $para_justify = "text-align: justify;text-justify: inter-word;display: inline-block;";
                        $valign_middle = "line-height: 40px;";
                        $border_right = "border-right: 1px solid #09037f";
                        $border_colour= "border: 1px solid #09037f;";
// add a page
$pdf->AddPage();

                $content_allo='';
                $content_ded='';
                $allo_tot=0;
                $ded_tot=0;
                $total_amt=0;
                $ot_sum =0;
                $normal_amt=0;
                $special_amt=0;
                $i=0;
                $j=0;
                $leave_days=30-$days;
                 $result = mysqli_query($conns,"select * from  salary_child_tbl where main_tbl_id = '".$_GET['main_id']."'");
              
                     while($row=mysqli_fetch_assoc($result)) {
                        $status=$row['status'];
                        $allow_deduction=trim($row['allow_deduction']);
                        $earning_amt=$row['earning_amt'];
                        $deduction_amt=$row['deduction_amt'];
                        $allo_ded_tbl_id=$row['allo_ded_tbl_id'];
                        $hrs=$row['hrs'];
                        $i++; 
						
						if($status=="Allowence")
						{
						    if($i==1)
						    {
						        	$content_allo = $content_allo . '<tr nobr="true">';
            				// 		$content = $content . '<td bgcolor="#f2f2f2" style="text-align: center; border-right: 1px solid black; border-left: 1px solid #000;">' . $i . '</td>';
            						$content_allo = $content_allo . '<td bgcolor="#ebe9e4" style="text-align: left; line-height: 20px; border-right: 1px solid #09037f;">' . $allow_deduction . '</td>';
            						$content_allo = $content_allo . '<td bgcolor="#ebe9e4" style="text-align: right; line-height: 20px; ">' . number_format($earning_amt,3) . '</td>';
            						$content_allo = $content_allo . '</tr>';
            						$allo_tot=$allo_tot+$earning_amt;
						    }
						    else
						    {
						        	$content_allo = $content_allo . '<tr nobr="true">';
            				// 		$content = $content . '<td bgcolor="#f2f2f2" style="text-align: center; border-right: 1px solid black; border-left: 1px solid #000;">' . $i . '</td>';
            						$content_allo = $content_allo . '<td bgcolor="#ebe9e4" style="text-align: left; border-top: 1px solid #09037f; line-height: 20px; border-right: 1px solid #09037f;">' . $allow_deduction . '</td>';
            						$content_allo = $content_allo . '<td bgcolor="#ebe9e4" style="text-align: right; border-top: 1px solid #09037f; line-height: 20px;">' . number_format($earning_amt,3) . '</td>';
            						$content_allo = $content_allo . '</tr>';
            						$allo_tot=$allo_tot+$earning_amt;
						    }
    					
						}
						else{
						        $j++;
						        if($j==1){
						            
						            if($allo_ded_tbl_id==1)
						            {
						                $content_ded = $content_ded . '<tr nobr="true">';
                				// 		$content = $content . '<td bgcolor="#f2f2f2" style="text-align: center; border-right: 1px solid black; border-left: 1px solid #000;">' . $i . '</td>';
                						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: left; line-height: 20px; border-right: 1px solid #09037f;">' . $allow_deduction . ' ('.$gosi_pr.' %)</td>';
                						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: right; line-height: 20px;">' . number_format($deduction_amt,3) . '</td>';
                						$content_ded = $content_ded . '</tr>';
                						$ded_tot=$ded_tot+$deduction_amt;
						            }
						            else if($allo_ded_tbl_id==2){
						                 $content_ded = $content_ded . '<tr nobr="true">';
                				// 		$content = $content . '<td bgcolor="#f2f2f2" style="text-align: center; border-right: 1px solid black; border-left: 1px solid #000;">' . $i . '</td>';
                						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: left; line-height: 20px; border-right: 1px solid #09037f;">' . $allow_deduction . ' ('.$leave_days.')</td>';
                						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: right; line-height: 20px;">' . number_format($deduction_amt,3) . '</td>';
                						$content_ded = $content_ded . '</tr>';
                						$ded_tot=$ded_tot+$deduction_amt;
						            }
						            else{
    						            $content_ded = $content_ded . '<tr nobr="true">';
                				// 		$content = $content . '<td bgcolor="#f2f2f2" style="text-align: center; border-right: 1px solid black; border-left: 1px solid #000;">' . $i . '</td>';
                						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: left; line-height: 20px; border-right: 1px solid #09037f;">' . $allow_deduction . '</td>';
                						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: right; line-height: 20px;">' . number_format($deduction_amt,3) . '</td>';
                						$content_ded = $content_ded . '</tr>';
                						$ded_tot=$ded_tot+$deduction_amt;
						            }
						        }
						        else{
						                if($allo_ded_tbl_id==1)
						                    {
						                        $content_ded = $content_ded . '<tr nobr="true">';
                        				// 		$content = $content . '<td bgcolor="#f2f2f2" style="text-align: center; border-right: 1px solid black; border-left: 1px solid #000;">' . $i . '</td>';
                        						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: left; border-top: 1px solid #09037f; line-height: 20px; border-right: 1px solid #09037f;">' . $allow_deduction . ' ('.$gosi_pr.' %)</td>';
                        						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: right; border-top: 1px solid #09037f; line-height: 20px;">' . number_format($deduction_amt,3) . '</td>';
                        						$content_ded = $content_ded . '</tr>';
                        						$ded_tot=$ded_tot+$deduction_amt; 
						                    }
						                    else if($allo_ded_tbl_id==2)
						                    {
						                        $content_ded = $content_ded . '<tr nobr="true">';
                        				// 		$content = $content . '<td bgcolor="#f2f2f2" style="text-align: center; border-right: 1px solid black; border-left: 1px solid #000;">' . $i . '</td>';
                        						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: left; border-top: 1px solid #09037f; line-height: 20px; border-right: 1px solid #09037f;">' . $allow_deduction . ' ('.$leave_days.')</td>';
                        						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: right; border-top: 1px solid #09037f; line-height: 20px;">' . number_format($deduction_amt,3) . '</td>';
                        						$content_ded = $content_ded . '</tr>';
                        						$ded_tot=$ded_tot+$deduction_amt; 
						                    }
						                    else{
						                         $content_ded = $content_ded . '<tr nobr="true">';
                        				// 		$content = $content . '<td bgcolor="#f2f2f2" style="text-align: center; border-right: 1px solid black; border-left: 1px solid #000;">' . $i . '</td>';
                        						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: left; border-top: 1px solid #09037f; line-height: 20px; border-right: 1px solid #09037f;">' . $allow_deduction . '</td>';
                        						$content_ded = $content_ded . '<td bgcolor="#ebe9e4" style="text-align: right; border-top: 1px solid #09037f; line-height: 20px;">' . number_format($deduction_amt,3) . '</td>';
                        						$content_ded = $content_ded . '</tr>';
                        						$ded_tot=$ded_tot+$deduction_amt;
						                    }
    						           
						        }
            						
						}
                       
                        $total_amt=$allo_tot-$ded_tot;
                        
                      if($allo_ded_tbl_id==2 && $status=="Allowence"){
                            // echo $earning_amt;
                            $normal_hrd=$hrs;
                            $normal_amt=$earning_amt;
                        }
                        
                 
                         if($allo_ded_tbl_id==3 && $status=="Allowence"){
                            $special_hrd=$hrs;
                            $special_amt=$earning_amt;
                        }
                       
                        
                        $ot_sum=$special_amt+$normal_amt;

                        
	  }
	  
	  if($normal_hrd=="")
	    {
	        $normal_hrd=0;
	        $normal_hrd=number_format($normal_hrd,2);
	    }
	    if($special_hrd=="")
	    {
	        $special_hrd=0;
	        $special_hrd=number_format($special_hrd,2);
	    }
	    $allo_tot_num=number_format($allo_tot,3);
	    $ded_tot_num=number_format($ded_tot,3);
	    $total_amt_num=number_format($total_amt,3);
	    $special_amt=number_format($special_amt,3);
	    $normal_amt=number_format($normal_amt,3);
	     $ot_sum=number_format($ot_sum,3);
	   $word= getCurrency($total_amt);
	    
	    
//$pdf->Ln(5);
$html = <<<EOD
<table width="100%" cellspacing="0" cellpadding="5">
    <tbody>
        <tr>
            <td style="width:50%;">
            </td>
            <td style="text-align: center; color: #FFFFFF; font-size: 24px; font-family: 'Century Gothic';width:50%;" bgcolor="#09037f">
                SALARY SLIP
            </td>
        </tr>
    </tbody>
</table><br><br>
<table width="100%" border="1" cellpadding="3" style="border-collapse: collapse;">
  <tbody>
    <tr style="$style_padding">
      <td  colspan="4" align="center" bgcolor="#09037f" style="color: white;"><b>Pay Slip for the month of  $slip_in_date</b></td>
    </tr>
    <tr>
      <td widht="25%" style="$border_colour">Employee ID</td>
      <td  widht="25%" style="$border_colour">$emp_com_id</td>
      <td  widht="25%" style="$border_colour">CPR No</td>
      <td  widht="25%" style="$border_colour">$emp_cpr</td>
     
    </tr>
    <tr>
      <td style="$border_colour">Employee Name</td>
      <td style="$border_colour"><b>$emp_name</b></td>
      <td style="$border_colour">Duty Hrs</td>
      <td style="$border_colour">$duty_hr</td>
     
    </tr>
    <tr>
      <td style="$border_colour">Department</td>
      <td style="$border_colour">$department</td>
      <td style="$border_colour">Days</td>
      <td style="$border_colour">$days</td>
     
    </tr>
    <tr>
      <td style="$border_colour">Division</td>
      <td style="$border_colour">$division</td>
      <td style="$border_colour">Starting Time</td>
      <td style="$border_colour">$starting_time</td>
    </tr>
    <tr>
      <td style="$border_colour">Location</td>
      <td style="$border_colour">$print_address</td>
      <td style="$border_colour">Ending Time</td>
      <td style="$border_colour">$ending_time</td>
    </tr>
    
     <tr bgcolor="#09037f" style="color: white;">
      <td align="center" style="$border_colour">Earnings</td>
      <td align="center" style="$border_colour">Amount</td>
      <td align="center" style="$border_colour">Deductions</td>
      <td align="center" style="$border_colour">Amount</td>
    </tr>
    <tr>
          <td style="$border_colour; padding: 0px; margin: 0px;" colspan="2"><table style="width: 100%; border-collapse: collapse; margin: 0px; padding: 0px;">
                    $content_allo
                </table>
          </td>
          <td style="$border_colour; padding: 0px; margin: 0px;" colspan="2"><table style="border-collapse: collapse; margin: 0px; padding: 0px;">
                    $content_ded
                </table>
          </td>
      
    </tr>
    
    <tr>
      <td style="$border_colour">Total</td>
      <td style="$border_colour; text-align: right;">$allo_tot_num</td>
      <td style="$border_colour">Total</td>
      <td style="$border_colour; text-align: right;">$ded_tot_num</td>
    </tr>
    <tr>
      <td style="$border_colour" colspan="3">Net Amount</td>
      <td style="$border_colour; text-align: right; font-size:18px;" colspan="1"><b>$total_amt_num</b></td>

    </tr>
    <tr>
      <td style="$border_colour; text-align: center;" colspan="4">Bahraini Dinars: <b> $word</b>only</td>


    </tr>
	
    <tr style="padding: 0px;">
      <td colspan="4" style="padding: 0px;">
		
			<table width="100%" cellpadding="3" border="1" style="border-collapse: collapse; text-align: right;">
		  
		  		<tr>
				  <td colspan="5" align="center" bgcolor="#09037f" style="color: white;"><b>Overtime Summary</b></td>
				</tr>
				<tr>
				  <td align="center" style="$border_colour">Type</td>
				  <td align="center" style="$border_colour">Hrs</td>
				  <td align="center" style="$border_colour">Rate</td>
				  <td align="center" style="$border_colour">Amount</td>
				  <td align="center" style="$border_colour">Net Amount </td>
				</tr>
			
				<tr>
				  <td align="center" style="$border_colour">Normal OT</td>
				  <td align="center" style="$border_colour">$normal_hrd hrs</td>
				  <td align="center" style="$border_colour">$normal_ot_rate /hrs</td>
				  <td align="right" style="$border_colour">$normal_amt</td>
				  <td align="center" rowspan="2" style="font-size:18px; $border_colour">$ot_sum</td>
				</tr>
				<tr>
				
				  <td align="center" style="$border_colour">Special OT</td>
				  <td align="center" style="$border_colour">$special_hrd hrs</td>
				  <td align="center" style="$border_colour">$special_ot_rate /hrs</td>
				  <td align="right" style="$border_colour">$special_amt</td>
				  
				  
				</tr>
				<tr>
				  <td colspan="5" align="left" style="$border_colour">Note $note</td>
				  
				</tr>
				<tr>
				  <td colspan="5" align="left" style="$border_colour">This is a system-generated salary slip; no signature or seal is required. </td>
				</tr>
				<tr >
				  <td colspan="5" align="right" style="$border_colour">Authorized Signatory </td>
			    </tr>
		  </table>
		
		
		</td>
    </tr>
    
  </tbody>
</table>
	
	



EOD;


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

$style = array(
	'border' => 2,
	'vpadding' => 'auto',
	'hpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255)
	'module_width' => 1, // width of a single module in points
	'module_height' => 1 // height of a single module in points
);

//Close and output PDF document
$pdf->Output($emp_name.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
