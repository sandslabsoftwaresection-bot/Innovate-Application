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
    
    $result = mysqli_query($conns,"select * from quotation_main_tbl  where 	quotation_number = '".$_GET['quotation_number']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $invoice_number = $row['quotation_number'];
        $invoice_date = date("d-M-Y", strtotime($row['quotation_created_date']));
        $company_name= trim($row['company_name']);
        
        $po_box = trim($row['po_box']);
        $telephone_no = trim($row['telephone_no']);
        $fax = trim($row['fax']);
        $address = trim($row['address']);
        $attn = trim($row['attn']); 
        $subject = trim($row['subject']);
        $quotation_reference = $row['quotation_reference']; 
        $LPO_no = $row['LPO_no'] ;
        $total_amount = $row['sub_total'] ;
        $received_by_id = $row['received_by_id'] ;
        $received_by_name = $row['received_by_name'] ;
        $description = $row['description'] ;
        $project_name = $row['project_name'] ;
        $discount_type = $row['discount_type'] ;
        $discount_amount = $row['discount_amount'] ;
        $total_discount_amount = $row['total_discount_amount'] ;
        $tax_content= $row['tax_content'];
        $discount = 0;
        $company_id = $row['company_id'];
        
        
    } 
    
    $result_company_id = mysqli_query($conns,"select description,contact_address_2 from company_details  where company_id = ".$company_id);
    while($row_comp_id=mysqli_fetch_assoc($result_company_id)) {
        $company_vat_no = $row_comp_id['description'];
        $contact_address_2 = trim($row_comp_id['contact_address_2']);
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
      $y= 21 ;
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
                $discount=0;
                 $result = mysqli_query($conns,"select * from quotation_child_tbl where quotation_no = '".$_GET['quotation_number']."'");
                     while($row=mysqli_fetch_assoc($result)) {
                     
                         if($row['discount_amount']!=0)
                         {
                             $discount = $discount + ($row['discount_amount']);
                         }
                        
                        
                         
                          
                
                          $content = $content.'<tr nobr="true" style="border-bottom: 1px solid gray;">';
                          $content = $content.' <td bgcolor="#f2f2f2" style="vertical-align: top;">'.$ctr.'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: left"><strong><u>'.trim($row["product_name"]).'</u></strong>'.$row["description"].'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: center">'.number_format($row["quantity"],3).'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: center">'.$row["unit"].'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: right">'.number_format($row["rate"],3).'</td>';
                          $content = $content.'  <td bgcolor="#f2f2f2" style="text-align: right">'.number_format($row["amount"],3). '</td>'; //$amt=$amt+$row["amount"].
                          $amt=$amt+$row["amount"]; 
                          $tot_amt=$tot_amt+$row["amount"]; 
						  //$content = $content.$amt;   	  
                          $content = $content.'</tr>';
                       
                  $ctr = $ctr +1;  
                  
                
	  }// Close of While 
	  
	  
	  
	            $content = $content.'<tr style="border-bottom: 1px solid gray;">';
                $content = $content.'    <td style="text-align: center">&nbsp;</td>';
                    
                $content = $content.'    <td colspan="4" style="text-align: right"><strong>Total Amount in BHD</strong></td>';
                   
                $content = $content.'    <td style="text-align: right" colspan="2"><strong>';
                $amt=number_format($amt,3);
                $content = $content.$amt;
                $content = $content.'</strong></td>';
                $content = $content.'  </tr>';
                if($total_discount_amount+$discount!=0) { 
        		$content = $content.'	 <tr style="border-bottom: 1px solid gray;">';
                $content = $content.'    <td style="text-align: center">&nbsp;</td>';
                    
                $content = $content.'    <td colspan="4" style="text-align: right"><strong>Discount Amount</strong></td>';
                   
                $content = $content.'    <td style="text-align: right" colspan="2"><strong>'.number_format($total_discount_amount+$discount,3).'</strong></td>';
                $content = $content.'  </tr>';
                $content = $content.'   <tr style="border-bottom: 1px solid gray;">';
                $content = $content.'    <td style="text-align: center">&nbsp;</td>';
                    
                $content = $content.'    <td colspan="4" style="text-align: right"><strong>Balance Amount</strong></td>';
                   
                $content = $content.'    <td style="text-align: right" colspan="2"><strong>';
                $content = $content.number_format($amt-($total_discount_amount+$discount),3);
                $content = $content.'</strong></td>';
                $content = $content.'  </tr>';
                }
        			
        		$content = $content.'	<tr style="border-bottom: 1px solid gray;">';
                $content = $content.'    <td style="text-align: center">&nbsp;</td>';
                    
                $content = $content.'    <td colspan="4" style="text-align: right"><strong> VAT (';
                $number =explode(".", $tax_content); 
                if($number[1]== "000")
                { 
                    $tax_content = number_format($tax_content,0);
                    $content = $content.$tax_content;
                } 
                else 
                {
                     $content = $content.$tax_content;
                    
                }
                $content = $content.'%)</strong></td>';
                   
                $content = $content.'<td style="text-align: right" colspan="2"><strong>';
                $vat_p = ((($tot_amt-($total_discount_amount+$discount))*$tax_content)/100) ;
                 //  $vat_p = ($vat_p) ; 
                 $x =  number_format($vat_p,3);
                 $content = $content.$x;
                $content = $content.'</strong></td>';
                $content = $content.'  </tr>';
        		$content = $content.'	<tr style="border-bottom: 1px solid gray;">';
                $content = $content.'    <td style="text-align: center">&nbsp;</td>';
                    
                $content = $content.'    <td colspan="4" style="text-align: right"><strong>Grand Total BHD</strong></td>';
                   
                $content = $content.'    <td style="text-align: right" colspan="2"><strong>';
                $after_value = number_format(round(($tot_amt-($total_discount_amount+$discount)) + $vat_p,3),3);
                $content = $content.$after_value;
                $content = $content.'</strong></td>';
                $content = $content.'  </tr>';
        			
                $content = $content.'  <tr >';
                $content = $content.'    <td colspan="10" style="text-align: center; font-size:12px">Bahraini Dinars: <strong>';
                
                    $ro = round(($tot_amt-($total_discount_amount+$discount)) + $vat_p,3);
                    $amt1 = str_replace(",","",$ro); 
                    
                    // $splitamount = explode('.',(($amt-$discount) + $vat_per));
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
          <tr>
            <td width="52%" align="left" valign="top" style="padding-bottom: 0px;"></td>
            <td align="left" valign="top" >
				<table width="100%"  cellspacing="0" cellpadding="5">
					<tbody>
						<tr >
						  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">QUOTATION </td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left" valign="top" style="font-weight:bold;text-align: right;" >
           
             
              <br>$company_name
                <br>PO Box : $po_box ,
                <br>$contact_address_2 
                <br>TEL :  $telephone_no ,
                FAX :  $fax 
                <br>VAT : $company_vat_no
                
              </td>
            <td align="left" valign="top">
			  <table width="100%"  cellspacing="0" cellpadding="5">
              <tbody >
                
                <tr style="text-align: right;">
                  <td >Date : <strong> $invoice_date </strong></td>
                </tr>
                <tr style="text-align: right;">
                  <td >Quotation No : <strong> $invoice_number </strong></td>
                </tr>
               
                <tr style="text-align: right;">
                  <td>VAT Account No : <strong> $vat_no  </strong></td>
                </tr>
              </tbody>
            </table>
			  
			  
			  </td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><u><strong>ATTN :  $attn </strong></u></td>
            </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong>PROJECT : $project_name </strong></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong>SUBJECT :  $quotation_reference  </strong></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top">Dear Sir, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $subject </td>
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
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:50%"> <strong>Description</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:8%"><strong>Qty</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:8%"><strong>Unit</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:12px;width:13%"><strong>Rate</strong></td>
            
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:13%"><strong>Amount</strong></td>
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
