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
            // Check if it's the last page
   
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
   
    return ucwords(($Rupees ? $Rupees . ' ' : ' ') .$decimal .' / 1000 '."  ");
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
$pdf->setTitle('SAPPHIER/SALARY_CONSOLIDATION - '.$_GET['sal_date']);
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
                        $valign_middle = "line-height: 20px;";
                        

// add a page
$pdf->AddPage();

                        $date_string = isset($_GET['sal_date']) ? $_GET['sal_date'] : '';
                        
                        $start=date("M-Y", strtotime($_GET['sal_date']));
                       
                        
             $ctr = 1;
                $i=1;
                $count=0;
                $sum_earning=0;
                $sum_ded=0;
                $result_project_repport = mysqli_query($conns,"SELECT ids, concat(emp_name,' - ',salary_date) as emp_name,  allow_deduction, earning_amt, deduction_amt,DATE_FORMAT(salary_date, '%d %M %Y') as salary_date  FROM salary_child_tbl WHERE DATE_FORMAT(salary_date, '%Y-%m') = '".$date_string."'");  
                            
                            
                while($row=mysqli_fetch_assoc($result_project_repport)) {
                    $ids=$row['ids'];
                    $emp_name=trim($row['emp_name']);
                    $allow_deduction=$row['allow_deduction'];
                    $earning_amt=$row['earning_amt'];
                     $deduction_amt=$row['deduction_amt'];
                    
               
                        
                    //   $item_amount=$quantity*$rate;
                    //   $tax_rate= ($item_amount*$tax)/100;
                                 if ($emp_name !== $last_emp_name) {
                                        if (!$firstGroup && $count!=0) {
                                            // If it's not the first group, add the footer for the previous group
                                            $content .= '<tr class="footer"><td colspan="2" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Total</td>
                                            <td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_earning,3).'</strong></td>
                                            <td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_ded,3).'</strong></td>
                                            </tr>';
                                            $content .= '<tr class="footer"><td colspan="2" bgcolor="'.$table_title_bg.'" style="text-align: center;color:white;'.$valign_middle.$border_bottom.$border_left.';">Payable</td>
                                            <td bgcolor="'.$table_title_bg.'" colspan="2" style="text-align: right;color:white;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_earning-$sum_ded,3).'</strong></td>
                                            </tr>';
                                            $i=1;
                                        }
                                        $firstGroup = false; // Reset the flag after the first group
                                        $content .= '<tr class="group"><td colspan="4" style="text-align: left;background-color: #C8C8C8;padding-left:5px;padding-right:5px;margin-left:5px;margin-right:5px;border-left: .7em solid '.$color.';border-right: .7em solid '.$color.';"><strong style="font-size: 14px;">' . ucfirst($emp_name) . '</strong></td></tr>';
                                        $last_emp_name = $emp_name; // Update last inventory name
                                        $sum_earning=0;
                                        $sum_ded=0;
                                        $count++;
                                    }
		                    	$content .='<tr nobr="true" style="'.$border_bottom.';">';
                                $content .=  '<td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$i.'</td>';
                                $content .=  '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$allow_deduction.'</td>';
                                $content .=  '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($earning_amt,3).'</td>';
                                $content .=  '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($deduction_amt,3).'</td>';
                                $content .='</tr>';	
                                
                                $sum_earning=$sum_earning+$earning_amt;
                                $sum_ded=$sum_ded+$deduction_amt;
					$i++;
					
                }                        
            $content .= '<tr class="footer"><td colspan="2" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">Total</td>
            <td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_earning,3).'</strong></td>
            <td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_ded,3).'</strong></td>
            </tr>';
            $content .= '<tr class="footer"><td bgcolor="'.$table_title_bg.'"  colspan="2" style="text-align: center;color:white;'.$valign_middle.$border_bottom.$border_left.';">Payable</td>
            <td bgcolor="'.$table_title_bg.'"  colspan="2" style="text-align: right;color:white;'.$valign_middle.$border_bottom.$border_left.';"><strong>'.number_format($sum_earning-$sum_ded,3).'</strong></td>
            </tr>';

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
						  <td style="text-align: center; color: #FFFFFF; font-size: 24px; " bgcolor="$table_title_bg">SALARY BREAKUPS</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left"  style="font-weight:bold;text-align:right;font-size: 13px" >
                   
                    <br><br>Month of : $start
              </td>
          </tr>
          
          
          
          
        </tbody>
      </table>
		
	  </td>
    </tr>
    <br>
    <br>
   <tr>
      <td>
         
         <table width="100%"  cellspacing="0" cellpadding="3"  style="border-collapse: collapse;border: .7em solid $color;$table_background" >
        <tbody>
          <tr >
                <td width="8%" bgcolor="$table_title_bg" style="$table_title_style"><strong>SI</strong></td>
                <td width="39%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Description</strong></td>
                <td width="26%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Earning Amount</strong></td>
                <td width="26%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Deduction Amount</strong></td>
          </tr>  
          
		$content
		   
       
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
$invoice_number = str_replace("/","-",$invoice_number);
$pdf->Output('SALARY_CONSOLIDATION_'.$start.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
