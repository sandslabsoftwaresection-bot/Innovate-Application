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
                        $border_left = "border-left: 1px solid #09037f;";
                        $table_title_style = "text-align: center; color: #FFFFFF;font-size:12px;border: 1px solid #09037f;";
                        $table_title_bg = "#09037f";
                        $table_background = "background: transparent;"; 
                        $para_justify = "text-align: justify;text-justify: inter-word;display: inline-block;";
                        $valign_middle = "line-height: 20px;";
                        $child1_head_colour="background-color: #48549F;color:white;";
                        $main_bg_color = "background-color: #E7E7ED;";
                        $child1_bg_color = "background-color: #F7D0A0;";
                        $child2_head_colour="background-color: #0B776B;color:white;";
                        $span_color="background-color: white;";
// add a page           
$pdf->AddPage();
                    $i=1;
                    $j=1;
                    $k=1;
                    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
                        $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
              
            // echo $startDate;
                $result_project_repport = mysqli_query($conns,"SELECT COUNT(local_po_number) AS po_count, 
                               UPPER(company_name) as company_name,
                               company_id,sum(sub_total) as total_amount 
                        FROM local_po_main_tbl a
                        WHERE local_po_number IN (
                            SELECT a.local_po_number
                            FROM local_po_child_tbl b
                            WHERE b.local_po_no = a.local_po_number
                            GROUP BY a.local_po_number
                            HAVING SUM(b.quantity) - (SUM(b.quantity_purchased)+SUM(b.cancel_quantity)) = 0
                        ) and local_po_status!='Cancelled' and company_id IN (".$_GET['supplier'].") and (DATE(local_po_date) BETWEEN DATE('".$startDate."') AND DATE('".$endDate."'))
                        GROUP BY company_id, company_name");  
                            
                            
                while($row=mysqli_fetch_assoc($result_project_repport)) {
                    $ids=$row['ids'];
                    $po_count=trim($row['po_count']);
                    $company_name=$row['company_name'];
                    $company_id=$row['company_id'];
                     $total_amount=$row['total_amount'];
                    
                    
		                    	$content .='<tr nobr="true" style="'.$border_bottom.';">';
		                    	$content .=  '<td colspan="1" style="text-align: center;'.$main_bg_color.$valign_middle.$border_bottom.$border_left.';">'.$i.'</td>';
                                $content .=  '<td colspan="5" style="text-align: left;'.$main_bg_color.$valign_middle.$border_bottom.$border_left.';">'.$company_name.'</td>';
                                $content .=  '<td colspan="3" style="text-align: center;'.$main_bg_color.$valign_middle.$border_bottom.$border_left.';">'.$po_count.'</td>';
                                $content .=  '<td colspan="3" style="text-align: center;'.$main_bg_color.$valign_middle.$border_bottom.$border_left.';">'.number_format($total_amount,3).'</td>';
                                $content .='</tr>';	
                                                
					$i++;				  
                
                    
                    $result_child_1 = mysqli_query($conns,"SELECT local_po_number, UPPER(company_name) as company_name,
                           company_id, sub_total, (select sum(amount) from purchase_recieved_child_tbl where lpo_no = a.local_po_number group by lpo_no) as recieved_amount
                            FROM local_po_main_tbl a
                            WHERE local_po_number IN (
                                SELECT a.local_po_number
                                FROM local_po_child_tbl b
                                WHERE b.local_po_no = a.local_po_number
                                GROUP BY a.local_po_number
                                HAVING SUM(b.quantity) - (SUM(b.quantity_purchased)+SUM(b.cancel_quantity)) = 0
                            ) and local_po_status!='Cancelled' and company_id='".$company_id."' and (DATE(local_po_date) BETWEEN DATE('".$startDate."') AND DATE('".$endDate."'))");  
                                
                                
                             	$content .='<tr nobr="true" style="">';
                             	$content .=  '<td colspan="1"  style="text-align: center;'.$span_color.$valign_middle.$border_left.';"></td>';
                                $content .=  '<td colspan="1"  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.$child1_head_colour.';">S/N</td>';
                                $content .=  '<td colspan="3" style="text-align: left;'.$valign_middle.$border_bottom.$border_left.$child1_head_colour.';">LPO Number</td>';
                               $content .=  '<td colspan="4" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.$child1_head_colour.';">Sub Total</td>';
                                $content .=  '<td colspan="3" style="text-align: center;'.$valign_middle.$border_bottom.$border_left.$child1_head_colour.';">Recieved Amount</td>';
                                $content .='</tr>';	   
                                
                                 while($row=mysqli_fetch_assoc($result_child_1)) {
                                $ids=$row['ids'];
                                $local_po_number=trim($row['local_po_number']);
                                $sub_total=$row['sub_total'];
                                $recieved_amount=$row['recieved_amount'];
                                 
                    
		                    	$content .='<tr nobr="true" style="">';
		                    	$content .=  '<td colspan="1"  style="text-align: center;'.$span_color.$valign_middle.$border_left.';"></td>';
                                $content .=  '<td colspan="1"  style="text-align: center;'.$child1_bg_color.$valign_middle.$border_bottom.$border_left.';">'.$j.'</td>';
                                $content .=  '<td colspan="3" style="text-align: left;'.$child1_bg_color.$valign_middle.$border_bottom.$border_left.';">'.$local_po_number.'</td>';
                               $content .=  '<td colspan="4" style="text-align: center;'.$child1_bg_color.$valign_middle.$border_bottom.$border_left.';">'.number_format($sub_total,3).'</td>';
                                $content .=  '<td colspan="3" style="text-align: center;'.$child1_bg_color.$valign_middle.$border_bottom.$border_left.';">'.number_format($recieved_amount,3).'</td>';
                                $content .='</tr>';	
                                                
					        $j++;
					        
					        $result_child_2 = mysqli_query($conns,"SELECT local_po_child_id,local_po_no, description,category_name, quantity,unit,rate,amount,vat_percentage,net_amount,quantity_purchased,cancel_ondemand_ch, (sum(quantity)-sum(quantity_purchased)) as balance,(select cancel_on_demand from local_po_main_tbl where local_po_number='".$local_po_number."')as cancel_status  FROM local_po_child_tbl WHERE local_po_no='".$local_po_number."' group by local_po_child_id");  
                            $content .= '<tr nobr="true" style="">';
                            $content .= '<td style="width:4%;text-align: center;' . $valign_middle .';"></td>';
                            $content .= '<td style="width:3%;text-align: center;' . $valign_middle .';"></td>';
                            $content .= '<td style="width:4%;text-align: center;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">S/N</td>';
                            $content .= '<td style="width:16%;text-align: left;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">Item Name</td>';
                            $content .= '<td style="width:9%;text-align: center;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">Quantity</td>';
                            $content .= '<td style="width:5%;text-align: center;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">Unit</td>';
                            $content .= '<td style="width:9%;text-align: center;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">Rate</td>';
                            $content .= '<td style="width:9%;text-align: center;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">Amount</td>';
                            $content .= '<td style="width:10%;text-align: center;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">Vat</td>';
                            $content .= '<td style="width:10%;text-align: center;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">Net Amount</td>';
                            $content .= '<td style="width:10%;text-align: center;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">Quantity Purchased</td>';
                            $content .= '<td style="width:10%;text-align: center;' . $valign_middle . $border_bottom . $border_left . $child2_head_colour . ';">Balance Quantity</td>';
                            $content .= '</tr>';  
					        while ($row2 = mysqli_fetch_assoc($result_child_2)) {
					            $description = trim($row2['description']);
                                $quantity = $row2['quantity'];
                                $unit = $row2['unit'];
                                $rate = $row2['rate'];
                                $amount = $row2['amount'];
                                $vat_percentage = $row2['vat_percentage'];
                                $net_amount = $row2['net_amount'];
                                $quantity_purchased = $row2['quantity_purchased'];
                                $balance = $row2['balance'];
                                
                                $content .= '<tr nobr="true" style="">';
                                $content .= '<td style="width:4%;text-align: center;' . $valign_middle .';"></td>';
                                $content .= '<td style="width:3%;text-align: center;' . $valign_middle .';"></td>';
                                $content .= '<td style="width:4%;text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">' . $k . '</td>';
                                $content .= '<td style="width:16%;text-align: left;' . $valign_middle . $border_bottom . $border_left . ';">'.$description.'</td>';
                                $content .= '<td style="width:9%;text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">'.$quantity.'</td>';
                                $content .= '<td style="width:5%;text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">'.$unit.'</td>';
                                $content .= '<td style="width:9%;text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">'.$rate.'</td>';
                                $content .= '<td style="width:9%;text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">'.$amount.'</td>';
                                $content .= '<td style="width:10%;text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">'.$vat_percentage.'</td>';
                                $content .= '<td style="width:10%;text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">'.$net_amount.'</td>';
                                $content .= '<td style="width:10%;text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">'.$quantity_purchased.'</td>';
                                $content .= '<td style="width:10%;text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">'.$balance.'</td>';
                                $content .= '</tr>';
					            
					         $k++;   
					        }
					        
					        
					        
					
                            }
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
						  <td style="text-align: center; color: #FFFFFF; font-size: 26px; " bgcolor="$table_title_bg">COMPLETED REPORT</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <br>
          <br>
          <tr>
          <td align="left"  style="font-weight:bold;text-align:right;" >
                  
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
            <td colspan="1" width="4%" bgcolor="$table_title_bg" style="$table_title_style"><strong >S/N</strong></td>
            <td colspan="5" width="51%" bgcolor="$table_title_bg" style="$table_title_style"> <strong>Company Name</strong></td>
            <td colspan="3" width="22%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Count</strong></td>
              <td colspan="3" width="22%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Total Amount</strong></td>
              
            
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
