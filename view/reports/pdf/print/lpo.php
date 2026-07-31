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
    
     $result = mysqli_query($conns,"select * from local_po_main_tbl  where 	local_po_number = '".$_GET['local_po_number']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $invoice_number = $row['local_po_number'];
        $invoice_date = date("m-d-Y", strtotime($row['local_po_created_date']));
        $company_name= $row['company_name'];
        $po_box = $row['po_box'];
        $telephone_no = $row['telephone_no'];
        $fax = $row['fax'];
        $address = $row['address'];
        $attn = $row['attn']; 
        $project_name = $row['project_name'];
        $quotation_reference = $row['quotation_reference']; 
        $LPO_no = $row['LPO_no'] ;
        $total_amount = $row['sub_total'] ;
        $received_by_id = $row['received_by_id'] ;
        $received_by_name = $row['received_by_name'] ;
        $description = $row['description'] ;
        $payment_terms = $row['payment_terms'] ;
        
        
    } 
    
     $result_supplier = mysqli_query($conns,"select * from supplier_details  where 	company_name like '%".$company_name."'");
   
    while($row_supplier=mysqli_fetch_assoc($result_supplier)) {
        $country= $row_supplier['country'];
        $city= $row_supplier['city'];
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
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety' ,21=>'zero');
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
   
     $last=$decimal%100;
    $x=$decimal%10;
    $y=$last-$x;
     if($y==0)
    {
      $y= 21 ;
    }
     if($x==0)
    {
       $x=21;
    }
    if($decimal > 0)
    {
     $paise = ($decimal > 0) ? " " . ($words[$decimal / 100] . " " . $words[ $y ]. " " . $words[$x]) . ' ' : '';
   
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
$pdf->setTitle('SAPPHIER/LPO/'.$invoice_number);
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
                $discount=0;
                 $result = mysqli_query($conns,"select * from local_po_child_tbl where local_po_no = '".$_GET['local_po_number']."'"); 
                     while($row=mysqli_fetch_assoc($result)) {
                     
                         
                
                          $content = $content.'<tr nobr="true" style="border-bottom: 1px solid gray;">';
                          $content = $content.' <td bgcolor="#f2f2f2" style="vertical-align: top;">'.$ctr.'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: left">'.trim($row["description"]).'</td>';  
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: center">'.number_format($row["quantity"]).'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: center">'.$row["unit"].'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: right">'.number_format($row["rate"],3).'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: right">'.number_format($row["vat_percentage"],3).'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: right">'.number_format(($row['discount_amount']*$row['vat_percentage']/100),3).'</td>'; //$amt=$amt+$row["amount"].
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: right">'.number_format($row['net_amount'],3). '</td>';
                          $amt=$amt+$row["net_amount"]; 
                          $tot_amt=$tot_amt+$row["net_amount"]; 
						  //$content = $content.$amt;   	  
                          $content = $content.'</tr>';
                  $ctr = $ctr +1;  
	  }// Close of While 
	  
	            $content = $content.'<tr style="border-bottom: 1px solid gray;">';
                $content = $content.'    <td style="text-align: center">&nbsp;</td>';
                    
                $content = $content.'    <td colspan="5" style="text-align: right"><strong>Total Amount in BHD</strong></td>';
                   
                $content = $content.'    <td style="text-align: right" colspan="2"><strong>';
                $amt=number_format($amt,3);
                $content = $content.$amt;
                $content = $content.'</strong></td>';
                $content = $content.'  </tr>';
                $content = $content.'  <tr >';
                $content = $content.'    <td colspan="10" style="text-align: center; font-size:12px">Bahraini Dinars: <strong>';
                
                    $ro = round(($tot_amt-($total_discount_amount+$discount)) + $vat_p,3);
                    $amt1 = str_replace(",","",$ro); 
                     $splitamount1=number_format((float)(($tot_amt-($total_discount_amount+$discount)) + $vat_p), 3, ".", "");
                     $splitamount = explode(".",($splitamount1));
                  
                    if(intval($splitamount[1])<=0 )
                    {
                         $getCurr = getCurrency($splitamount[0]).' only';
                         $content = $content.$getCurr;
                    }
                    else
                    {
                         $getCurr = getCurrency($splitamount[0])."  ".$splitamount[1]."/1000 Fills Only";
                         $content = $content.$getCurr;
                    }
                $content = $content.'</strong> </td>';
                $content = $content.'    </tr>';

//$pdf->Ln(5);
$html = <<<EOD

<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" id="main_table">
 
 
  <tbody>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody>
         <tr >
      <td style="padding-left: 10px;padding-right: 10px">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
           <td width="50%" align="left" valign="top" style="padding-bottom: 0px;"></td>
           <td align="left" valign="top" >
				<table width="100%"  cellspacing="0" cellpadding="5">
					<tbody>
						<tr >
						  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">PURCHASE ORDER</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left" valign="top" style="padding-top: 0px;">
				<table border="0" cellspacing="0" cellpadding="5">
				  <tbody>
				  <tr><td>
                  <strong>$company_name </strong><br>
                    <strong>PO Box : $po_box ,</strong> <br>
                    <strong>City :$city </strong><br>
                    <strong>Country :$country</strong><br>
                    <strong>TEL :  $telephone_no / ,
                    FAX :  $fax <br>
                    VAT : $company_vat_no</strong><br>
                   </td></tr>
				  </tbody>
				</table>
              </td>
            <td  align="left" valign="top">
			  <table width="100%"  cellspacing="0" cellpadding="5">
              <tbody>
                 <tr>
                  <td style="float: right;">PO No : <strong>$invoice_number</strong><br>Date : <strong>$invoice_date</strong><br>Quotation Ref : <strong>$quotation_reference</strong><br>Payment Terms : <strong>$payment_terms</strong><br>VAT Account No : <strong>$vat_no</strong></td>
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
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">
         
         <table width="100%" border="1px" cellspacing="0" cellpadding="5"  style="border-collapse: collapse;">
        <tbody>
          <tr>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:5%"><strong >S/N</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:25%"> <strong>Description</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:13%"><strong>Qty</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:8%"><strong>Unit</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:13%"><strong>Rate</strong></td>
             <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:13%"><strong>Tax Rate</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:13%"><strong>Tax Amount</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:13%"><strong>Net Amount</strong></td>
          </tr>  
          
		$content
		        
		</tbody>
	    </table>
	  </td>
    </tr>
</tbody>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
  <tbody>
    <tr>
      <td><span style="padding-left: 10px;padding-right: 10px"><span style="text-align: left"> $description </span></span></td>
    </tr>
  </tbody>
</table> 

EOD;


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



//Close and output PDF document
$pdf->Output($invoice_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
