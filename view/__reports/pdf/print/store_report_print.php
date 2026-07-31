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
$pdf->setTitle('SAPPHIER/STORE_REPORT');
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
                    $i=1;
              $startdate=date("d-M-Y", strtotime($_GET['start']));
              $enddate=date("d-M-Y", strtotime($_GET['end']));
                $result_project_repport = mysqli_query($conns,"Call proc_total_store_report('".$_GET['start']."','".$_GET['end']."',@msg)");  
                            
                            
                while($row=mysqli_fetch_assoc($result_project_repport)) {
                    $ids=$row['ids'];
                    $inventory_name=trim($row['inventory_name']);
                    $unit=$row['unit'];
                    $total_purch_qty=$row['total_purch_qty'];
                     $total_issued_qty=$row['total_issued_qty'];
                     $tot_damage_qty=$row['tot_damage_qty'];
                     $total_passin_return_qty=$row['total_passin_return_qty'];
                     $balance_qty=$row['current_stock'];
                   $issued_qty =$total_issued_qty-$tot_damage_qty-$total_passin_return_qty;
                    // $balance_qty = $total_purch_qty-$total_issued_qty+$total_passin_return_qty;
                    
		                    	$content .='<tr nobr="true" style="'.$border_bottom.';">';
                                $content .=  '<td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$i.'</td>';
                                $content .=  '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$inventory_name.'</td>';
                                $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$unit.'</td>';
                                $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($total_purch_qty,2).'</td>';
                                $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($issued_qty,2).'</td>';
                                $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($tot_damage_qty,2).'</td>';
                                $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($balance_qty,2).'</td>';
                                $content .='</tr>';	
                                                
					$i++;				  
                }                        

			
//$pdf->Ln(5);
$html = <<<EOD

<table width="100%" border="0" cellspacing="0"   id="main_table" style="$table_background">
 
 
  <tbody>
    <tr>
      <td style="padding-left:10px;padding-right:10px;">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px;$table_background">
        <tbody>
          <tr>
            <td width="49%" align="left" valign="top" style="padding-bottom: 0px;"></td>
            <td align="left" valign="top" >
				<table width="100%"  cellspacing="0" cellpadding="5">
					<tbody>
						<tr >
						  <td style="text-align: center; color: #FFFFFF; font-size: 26px; " bgcolor="$table_title_bg">STORE REPORT</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <br>
          <br>
          <tr>
          <td align="left"  style="font-weight:bold;text-align:right;" >
                    From Date :$startdate<br>
                    To Date : $enddate<br>
              </td>
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
            <td width="5%" bgcolor="$table_title_bg" style="$table_title_style"><strong >S/N</strong></td>
            <td width="25%" bgcolor="$table_title_bg" style="$table_title_style"> <strong>Description</strong></td>
            <td width="10%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Unit</strong></td>
              <td width="17%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Total Qty</strong></td>
              <td width="14%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Issued Qty</strong></td>
            <td width="14%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Damaged Qty</strong></td>
            <td width="14%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Balance Qty</strong></td>
            
          </tr>  
          
		$content
		   
       
		</tbody>
	    </table>
	  </td>
    </tr>
    <br>
    <br>
    <tr>
   
    </tr>
    
 
</tbody>
</table>
    
      
   








EOD;



$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'C', true);
//$pdf->writeHTML($html);


//Close and output PDF document
$invoice_real_no = str_replace("/","-",$invoice_real_no);
$pdf->Output($invoice_real_no.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
