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
   
   
   $result = mysqli_query($conns,"select * from  work_order_tbl  where work_order_number = '".$_GET['work_order_no']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $work_order_main_id =$row['work_order_main_id'];
        $work_order_number = $row['work_order_number'];
        $work_order_start_date = date("m-d-Y", strtotime($row['work_order_start_date']));
		$work_order_end_date = date("m-d-Y", strtotime($row['work_order_end_date']));
		
        $company_name= $row['company_name'];
        $po_box = $row['po_box'];
        $telephone_no = $row['telephone_no'];
        $fax = $row['fax'];
        $address = $row['address'];
        $attn = $row['attn']; 
        $subject = $row['subject'];
        $quotation_reference = $row['quotation_reference']; 
        $received = $row['received'] ;
        $location = $row['location'] ;
        $created_by_id = $row['created_by_id'] ;
        $created_by_name = $row['created_by_name'] ;
        $project_id = $row['project_id'] ;
        $project_name = $row['project_name'] ;
        $company_id = $row['company_id'];
        
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

  
                          $i=0;
						  $result = mysqli_query($conns,"select * from  work_order_child_tbl where work_order_no = '".$_GET['work_order_no']."'");
							 while($row=mysqli_fetch_assoc($result)) {
								$product_name=$row['product_name']; 
								$description=$row['description'];
								$qty=$row['required_quantity'];
								$unit=$row['unit'];
								$quotation_status=$row['quotation_status'];
								$remarks=$row['remarks'];
	                       $i++; 
                         
                        
											$content .= '<tr nobr="true" style="border-bottom:1px solid;">';
											$content .= '<td bgcolor="#f2f2f2" style=" ;">' . $i . '</td>';
											$content .= '<td bgcolor="#f2f2f2" style=""><strong>' . $product_name . '</strong></td>';
											$content .= '<td bgcolor="#f2f2f2" style="">' . $qty . '</td>';
											$content .= '<td bgcolor="#f2f2f2" style="">' . $unit . '</td>';
											$content .= '<td bgcolor="#f2f2f2" style="padding: 0px;">';
											$content .= '<table style="height: 40px; border: 1px solid #ADADAD; border-collapse: collapse;"><tr>';
											$content .= '<td style="width:25%; border-left-style: hidden;">';
											$content .= ($quotation_status == 'Material Received') ? 'Yes' : '&nbsp;';
											$content .= '</td>';
											$content .= '<td style="width:25%; border-left-style: hidden;">';
											$content .= ($quotation_status == 'Fabrication completed') ? 'Yes' : '&nbsp;';
											$content .= '</td>';
											$content .= '<td style="width:25%; border-left-style: hidden;">';
											$content .= ($quotation_status == 'Delivered') ? 'Yes' : '&nbsp;';
											$content .= '</td>';
											$content .= '<td style="width:25%; border-left-style: hidden;">';
											$content .= ($quotation_status == 'Site fixing completed') ? 'Yes' : '&nbsp;';
											$content .= '</td>';
											$content .= '</tr></table></td>';
											$content .= '<td bgcolor="#f2f2f2" style="text-align: left;">' . $remarks . '</td>';
											$content .= '</tr>';
						
						                         // $content=$content.'<tr style="border-bottom: 1px solid gray;">';
											     // $content=$content.'<td bgcolor="#f2f2f2" style="border-right: 1px solid black;border-left: 1px solid #000;">'.$i.'</td>';
											     // $content=$content.'<td bgcolor="#f2f2f2" style="border-right: 1px solid black;"><strong>'.$product_name.'</strong></td>';
											   
												 // $content=$content.'<td bgcolor="#f2f2f2" style="border-right: 1px solid black;">'.$qty.'</td>';
												 // $content=$content.'<td bgcolor="#f2f2f2" style="border-right: 1px solid black;">'.$unit.'</td>';
												 // $content=$content.'<td bgcolor="#f2f2f2" style="border-right: 1px solid black; padding: 0px;">';
												 // $content=$content.'<table style="height: 40px;border: 1px solid #ADADAD;border-collapse: collapse;"><tr>';
												 // $content=$content.'<td style="width:25%; border-left-style: hidden;">'.if($quotation_status=='Material Received'){.'<i class="fa fa-check" aria-hidden="true"></i>'. } else{&nbsp;}.'</td>';
												 // $content=$content.'<td style="width:25%; border-left: 1px solid black;">'.if($quotation_status=='Fabrication completed'){.'<i class="fa fa-check" aria-hidden="true"></i>'. } else { "&nbsp"; } .'<td>';
												 // $content=$content.'<td style="width:25%; border-left: 1px solid black;">'.if($quotation_status=='Delivered'){.'<i class="fa fa-check" aria-hidden="true"></i>'. } else {"&nbsp"; }.'</td>';
												 // $content=$content.'<td style="width:25%; border-left: 1px solid black;border-right-style: hidden;">'.if($quotation_status=='Site fixing completed'){.'<i class="fa fa-check" aria-hidden="true"></i>'. } else { "&nbsp"; }.'</td>';
												 // $content=$content.'</tr></table></td>';
												 // $content=$content.'<td bgcolor="#f2f2f2" style="text-align: left;border-right: 1px solid black;">'.$remarks.'</td>';
										         // $content=$content. '</tr>';

												 
												 
												 
												 
}
	  
	  

//$pdf->Ln(5);
$html = <<<EOD

 <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" id="main_table">
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
                                                <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">
                                                    WORK ORDER
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" style="padding-top: 0px;">
                                    <p>
                                        <strong>Project No.:$location</strong><br>
                                        <strong>Received : $received</strong> <br>
                                        
                                    </p>
                                </td>
                                <td align="left" valign="top">
                                    <table width="100%" cellspacing="0" cellpadding="5">
                                        <tbody>
                                            <tr style="text-align: right;">
                                                <td>Job No : <strong>$work_order_number</strong></td>
                                            </tr>
                                            <tr style="text-align: right;">
                                                <td>Start Date : <strong>$work_order_start_date</strong></td>
                                            </tr>
                                            <tr style="text-align: right;">
                                                <td>End Date : <strong>$work_order_end_date</strong></td>
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
                <td style="padding-left: 10px; padding-right: 10px">
                    <table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
                        <tbody>
                            <tr>
											  <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:30px;"><strong >SL</strong></td>
											   <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;"><strong>Product Name</strong></td>
												<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:70px"><strong>Qty</strong></td>
												<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
												<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:250px"><strong>Status</strong></td>
												<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:150px"><strong>Remarks</strong></td>
										    </tr>
										    <tr>
												<td style="font-size:15px;width:30px;border-right:1px solid black;border-left:1px solid black;"><strong ></strong></td>
												<td  style="font-size:15px;border-right:1px solid black;"> <strong></strong></td>
												<td  style="font-size:15px;width:70px;border-right:1px solid black;"><strong></strong></td>
												<td  style="font-size:15px;width:50px;border-right:1px solid black;"></td>
												<td  style="center;font-size:15px;width:250px;border-right:1px solid black;">			
												<table><tr><td style="font-size: 14px;width:60px;">Material Received</td>
												<td style="border-left: 1px solid #080808;font-size: 14px;width:60px;">Fabricaton completed</td>
												<td style="border-left: 1px solid #080808;font-size: 14px;width:60px;">Delivered</td>
												<td style="border-left: 1px solid #080808;font-size: 14px;width:60px;">Site fixing completed</td></tr></table></td>
												<td  style="font-size:15px;width:150px;border-right:1px solid black;"><strong></strong></td>
										    </tr>
                           $content
                        </tbody>
                    </table>
                </td>
            </tr>
			<tr>
			<td colspan="5">
				<div style="margin-bottom: 10px;">
					<span style="text-align:left;padding-left:100px;">Completion Report:</span>
					<ul style="float:left;list-style-type: none;padding: 24px;margin: 0;">
					  <li>1.</li>
					  <li>2.</li>	
					</ul>
				</div>
			</td>								
		   </tr>
		   <div class="signature-area" style="margin-bottom: 50px; position: absolute;">
			<table width="1000" border="0" cellspacing="0" cellpadding="5" align="left" style="margin-top: 50px;">
			  <tbody>
				<tr>
					<td><strong>Manager</strong></td>
					<td><strong>Accounts manager</strong></td>
					<td><strong>Supervisor</strong></td>
					<td><strong>Forman</strong></td>    
				</tr>
			  </tbody>  
			</table>
		</div>
			
			
        </tbody>
    </table>
	
	

EOD;


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



//Close and output PDF document
$pdf->Output($invoice_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
