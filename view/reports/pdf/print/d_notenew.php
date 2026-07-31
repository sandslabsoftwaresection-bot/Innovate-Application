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
    
    $result = mysqli_query($conns,"select * from delivery_note_main_tbl  where 	delivery_note_number = '".$_GET['delivery_note_number']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $delivery_note_main_id =$row['delivery_note_main_id'];
        $invoice_number = $row['delivery_note_number'];
        $invoice_date = date("d-M-Y", strtotime($row['delivery_note_date']));
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
        $received_by_id = $row['received_by_id'] ;
        $received_by_name = $row['received_by_name'] ;
        $description = $row['description'] ;
        $project_name = $row['project_name'] ;
        $notes = $row['notes'] ;
        $provider_name = $row['provided_by'] ;
        $receiver_name = $row['received_by_name'] ;
        $discount = 0;
        $company_id = $row['company_id'];
        
    } 
    
   $result_company_id = mysqli_query($conns,"select description,contact_address_2,contact_address_1 as po_box,country,contact_phone,fax,company_name from company_details  where company_id = ".$company_id);
    while($row_comp_id=mysqli_fetch_assoc($result_company_id)) {
        $company_vat_no = trim($row_comp_id['description']);
        $contact_address_2 = trim($row_comp_id['contact_address_2']);
        $po_box = trim($row_comp_id['po_box']);
        $country_com_dtls = trim($row_comp_id['country']);
        $tel_com_dtls = trim($row_comp_id['contact_phone']);
        $fax_com_dtls = trim($row_comp_id['fax']);
        $company_name_com_dtls = trim($row_comp_id['company_name']);
        
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
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
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
//$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setMargins(15, PDF_MARGIN_TOP, 15);
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

  
                 $ctr = 1;
                $amt=0;
                $result = mysqli_query($conns,"select * from delivery_note_child_tbl where delivery_note_no = '".$_GET['delivery_note_number']."'");
                     while($row=mysqli_fetch_assoc($result)) {
                         if($row['vat_percentage']!=0)
                         {
                             $vat_per = $vat_per + ($row['discount_amount']*$row['vat_percentage'])/100;
                         }
                         if($row['discount_precentage']!=0)
                         {
                             $discount = $discount + ($row['amount']*$row['discount_precentage'])/100;
                         }
                        
                         
                
                          $content = $content.'<tr nobr="true" style="'.$border_bottom.';">';
                          $content = $content.' <td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$ctr.'</td>';
                          $content = $content.'  <td  style="text-align: left;'.$para_justify.$border_bottom.$border_left.';">'.trim($row["description"]).'</td>';
                          $content = $content.'  <td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($row["quantity"],2).'</td>';
                          $content = $content.'  <td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$row["unit"].'</td>';
                          $content = $content.'  <td  style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.$row["remarks"].'</td>';
                        //   $content = $content.'  <td  style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($row["amount"],3).'</td>'; //$amt=$amt+$row["amount"].
                         
                        //   $amt=$amt+$row["amount"]; 
                        //   $tot_amt=$tot_amt+$row["amount"]; 
						  //$content = $content.$amt;   	  
                          $content = $content.'</tr>';
                       
                  $ctr = $ctr +1;  
                  
                
	  }
	  
	// Build conditional content
            if ($delivery_note_main_id < 71) {
                $conditional_content = '
                <table width="98%" cellspacing="0" cellpadding="0" style="" align="center">
                    <tbody>
                        <tr>
                            <td colspan="6" style="text-align:center;">'.$description.'</td>
                        </tr>  
                    </tbody>
                </table>';
            } else {
                $conditional_content = '
                <table width="100%" cellspacing="0" cellpadding="0" align="center">
                    <tbody>
                        <tr>
                            <td colspan="3" style="text-align:left; padding: 70px;">
                                Notes :<strong>&nbsp;&nbsp;'.$notes.'</strong><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" cellspacing="0" cellpadding="0" align="center">
                    <tbody>
                        <tr>
                            <td colspan="3" style="text-align:left; padding: 20px;">
                                Provider Name:<strong>&nbsp;&nbsp;&nbsp;'.$provider_name.'</strong><br><br>
                            </td>
                            <td colspan="3" style="text-align:left; padding: 20px; padding-right: 20px;">
                                Received By Name:<strong>&nbsp;&nbsp;&nbsp;'.$receiver_name.'</strong><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:left; padding: 70px;">
                                <strong>Signature:</strong> ___________________________<br>
                            </td>
                            <td colspan="3" style="text-align:left; padding: 70px;">
                                <strong>Signature:</strong> ___________________________<br>
                            </td>
                        </tr>
                    </tbody>
                </table>';
            }

//$pdf->Ln(5);
$html = <<<EOD

<table width="100%" border="0" cellspacing="0"   id="main_table" style="$table_background">
 
 
  <tbody>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px;$table_background">
        <tbody>
          <tr>
            <td width="49%" align="left" valign="top" style="padding-bottom: 0px;"></td>
            <td align="left" valign="top" >
				<table width="100%"  cellspacing="0" cellpadding="5">
					<tbody>
						<tr >
						  <td style="text-align: center; color: #FFFFFF; font-size: 26px; " bgcolor="$table_title_bg">DELIVERY NOTE</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left"  style="font-weight:bold;text-align:right;" >
           
             
              <br><br>$company_name_com_dtls
                <br>P O Box : $po_box,
                <br>$contact_address_2,
                <br>Country : $country_com_dtls,
                <br>TEL :  $tel_com_dtls, 
                <br>FAX :  $fax_com_dtls, 
                <br>VAT : $company_vat_no
                
              </td>
            <td align="left" >
			  <table width="100%"  style="padding-top:5px;" >
              <tbody>
                
                <tr style="text-align: right;">
                  <td>Date : <strong>$invoice_date</strong></td>
                </tr>
                <tr style="text-align: right;">
                  <td >Delivery Note No : <strong>$invoice_number</strong></td>
                </tr>
               
                <tr style="text-align: right;">
                  <td>Quotation Ref : <strong>$quotation_reference</strong></td>
                </tr>
                 <tr style="text-align: right;">
                  <td>LPO No : <strong>$LPO_no</strong></td>
                </tr>
                
                
              </tbody>
            </table>
			  
			  
			  </td>
          </tr>
          <tr >
            <td colspan="2" align="left" valign="middle" style="height: 40px;"><div style="vertical-align: middle;"><strong><br>ATTN :  $attn </strong></div></td>
          </tr>
          
        </tbody>
      </table>
		
	  </td>
    </tr>
    <tr >
      <td >
         
         <table width="100%"  cellspacing="0" cellpadding="3"  style="border-collapse: collapse;border: .7em solid $color;$table_background" >
        <tbody>
          <tr >
            <td bgcolor="$table_title_bg" style="width:5%;$table_title_style"><strong >S/N</strong></td>
            <td bgcolor="$table_title_bg" style="width:59%;$table_title_style"> <strong>Description</strong></td>
            <td bgcolor="$table_title_bg" style="width:10%;$table_title_style"><strong>Qty</strong></td>
            <td bgcolor="$table_title_bg" style="width:10%;$table_title_style"><strong>Unit</strong></td>
            <td bgcolor="$table_title_bg" style="width:15%;$table_title_style"><strong>Remarks</strong></td>
            
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
         $conditional_content
    </td>
    </tr>
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
