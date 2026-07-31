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
    
     $main_table = mysqli_query($conns, "SELECT * FROM purchase_received_main_tbl WHERE prd_no = '".$_GET['pur_recie_number']."'");
    while($rows = mysqli_fetch_assoc($main_table)) 
	{
        $invoice_number = $rows['prd_no'];
        $invoice_date = date("d-M-Y", strtotime($rows['default_date']));
		$supplier_id = $rows['supplier_id'];
        $supplier_name= trim($rows['supplier_name']);
		$work_order_id = $rows['work_order_id'];
        $work_order_no = $rows['work_order_no']; 
		$purchase_req_no = $rows['purchase_req_no'];
        $purchase_recieve_date = $rows['purchase_recieved_date'];
        $job_location = $rows['job_location'];
		$requested_by = $rows['requested_by'];
		$approved_by = $rows['approved_by'];
		$lpo_no = $rows['lpo_no'];
		$bill_no = $rows['bill_no'];
		
    } 
	
	
   $result_supplier = mysqli_query($conns,"select * from supplier_details  where company_id= '".$supplier_id."'");
   
    while($row_supplier=mysqli_fetch_assoc($result_supplier)) {
        $supplier_vat_no = trim($row_supplier['description']);
		$contact_address = trim($row_supplier['contact_address_2']);
		$contact_person = trim($row_supplier['contact_person']);
		$contact_email = trim($row_supplier['contact_email']);
		$contact_phone = trim($row_supplier['contact_phone']);
		$fax = trim($row_supplier['fax']);
		$com_name_sup_dtls = trim($row_supplier['company_name']);
		$pobox_sup_dtls = trim($row_supplier['contact_address_1']);
		$country_sup_dtls = trim($row_supplier['country']);
    }
	
	$result_company = mysqli_query($conns, "SELECT * FROM company_primary_details  where profile_id = '1'");
    while($row_company= mysqli_fetch_assoc($result_company)) 
	{
		$print_companynamne = $row_company['company_name'];
        $tele = $row_company['phone_no'];
		$company_address = $row_company['address'];
		$company_email = $row_company['email'];
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
							$pr_child_table = mysqli_query($conns, "SELECT * FROM purchase_recieved_child_tbl WHERE prd_no = '".$_GET['pur_recie_number']."'");
								while($child_row=mysqli_fetch_assoc($pr_child_table)) {
									   if($child_row['rate']=="" || $child_row['rate']=="0.000")
										 {
											$v_rate = '--'; 
											$v_tax = '--'; 
											$v_amount = '--';							
										 }
										 else
										 {
											 $v_rate = $child_row['rate'];
											 $v_tax = $child_row['tax'];
											 $v_amount = $child_row['amount'];
										 }
						$amt_tbl=$child_row['quantity']*$v_rate;				 
                        $tax_amt=($amt_tbl*$v_tax)/100;
                         
                
                          $content = $content.'<tr nobr="true" style="'.$border_bottom.';">';
                          $content = $content.' <td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$ctr.'</td>';
                          $content = $content.'  <td  style="text-align: left;'.$para_justify.$border_bottom.$border_left.';">'.$child_row['inventory_name'].'</td>';
                          $content = $content.'  <td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$child_row['quantity'].'</td>';
                          $content = $content.'  <td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$child_row['unit'].'</td>';
                          $content = $content.'  <td  style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($v_rate, 3).'</td>';
                          $content = $content.'  <td  style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($amt_tbl, 3).'</td>';
						  $content = $content.'  <td  style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($tax_amt, 3).'</td>';
						  
                          $content = $content.'  <td  style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($v_amount ,3).'</td>'; //$amt=$amt+$row["amount"].
                         
                          $amt = $amt+$v_amount;
						  	  
                          $content = $content.'</tr>';
                       
                  $ctr = $ctr +1;		
                  
                
	  }// Close of While 
	  
	                            $content = $content.'<tr style="border-bottom: 1px solid gray;">';
								//$content = $content.'<td style="text-align: center">&nbsp;</td>';
									
								$content = $content.'<td colspan="6" style="text-align: left;'.$border_bottom_line.';"><strong>Total Amount</strong></td>';
								   
								$content = $content.'<td style="text-align: right;'.$border_left.';'.$border_bottom_line.';" colspan="2"><strong>';
								$amt=number_format($amt,3);
								$content = $content.$amt;
								$content = $content.'</strong></td>';
								$content = $content.'  </tr>';
	  
	            


//$pdf->Ln(5);
$html = <<<EOD

<table width="100%" border="0" cellspacing="0"   id="main_table" style="$table_background">
 
 
  <tbody>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px;$table_background">
        <tbody>
          <tr>
            <td width="49%" align="left" valign="top" style="padding-bottom:0px;"></td>
            <td align="left" valign="top" >
				<table width="100%"  cellspacing="0" cellpadding="5">
					<tbody>
						<tr >
						  <td style="text-align: center; color: #FFFFFF; font-size: 26px; " bgcolor="$table_title_bg">PURCHASE RECIEVED</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left"  style="font-weight:bold;text-align:right;">
                <br><br>$com_name_sup_dtls
                <br>P O Box : $pobox_sup_dtls,
                <br>$contact_address,
                <br>Country : $country_sup_dtls,
                <br>TEL :  $contact_phone, 
                <br>FAX :  $fax, 
                <br>VAT : $supplier_vat_no
              </td>
            <td align="left" >
			  <table width="100%"  style="padding-top:5px;" >
              <tbody>
                
               <tr style="text-align:right;">
				<td>PRD No :<strong>$invoice_number</strong></td>
				</tr>
				<tr style="text-align:right;">
					<td>Date :<strong>$invoice_date</strong></td>
				</tr>
				<tr style="text-align:right;">
					<td>Job Location :<strong>$job_location</strong></td>
				</tr>
				<tr style="text-align:right;">
					<td>Requested by :<strong>$requested_by</strong></td>
				</tr>
				<tr style="text-align:right;">
					<td>LPO No :<strong>$lpo_no</strong></td>
				</tr>
				<tr style="text-align:right;">
					<td>PR No :<strong>$purchase_req_no</strong></td>
				</tr>
				<tr style="text-align:right;">
					<td>Bill No :<strong>$bill_no</strong></td>
				</tr>
				
              </tbody>
            </table>
			  
			  
			  </td>
          </tr>
         
        </tbody>
      </table>
		<br>
		<br>
	  </td>
    </tr>
	<br>
    <tr >
      <td >
         
         <table width="100%"  cellspacing="0" cellpadding="3"  style="border-collapse: collapse;border: .7em solid $color;$table_background" >
        <tbody>
          <tr >
            <td bgcolor="$table_title_bg" style="width:5%;$table_title_style"><strong >S/N</strong></td>
            <td bgcolor="$table_title_bg" style="width:30%;$table_title_style"> <strong>Description</strong></td>
            <td bgcolor="$table_title_bg" style="width:7%;$table_title_style"><strong>Qty</strong></td>
            <td bgcolor="$table_title_bg" style="width:7%;$table_title_style"><strong>Unit</strong></td>
            <td bgcolor="$table_title_bg" style="width:11%;$table_title_style"><strong>Rate</strong></td>
            <td bgcolor="$table_title_bg" style="width:12%;$table_title_style"><strong>Amount</strong></td>
            <td bgcolor="$table_title_bg" style="width:12%;$table_title_style"><strong>Tax (VAT)</strong></td>
            
            <td bgcolor="$table_title_bg" style="width:15%;$table_title_style"><strong>Net Amount</strong></td>
          </tr>  
          
		    
		$content
		        
            
       
		</tbody>
	    </table>
	  </td>
    </tr>
	<br>
    
    <tr>
        <td>
                
                  <table width="100%" border="0" cellspacing="0" cellpadding="5" style="$table_background" id="left" align="middile">  
						
				  
				  <tbody>
				  <tr>
					 <td><strong>Approved by</strong></td>		  
				 </tr>
                    <tr>
						<td><strong>$approved_by</strong></td>
						<!--<td><strong>Thomas Mammen</strong></td>
						<td><strong>Licy</strong></td>-->
					</tr>
							
					<tr>
					  <td><strong>Purchase Manager</strong></td>
					  <!--<td><strong>General Manager</strong></td>
					  <td><strong>Executive Manager</strong></td>-->
					</tr>
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
$pdf->Output($invoice_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
