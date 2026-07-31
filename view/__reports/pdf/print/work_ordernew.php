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
    
    
   
   $result = mysqli_query($conns,"select * from  work_order_tbl  where work_order_number = '".$_GET['work_order_no']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $work_order_main_id =$row['work_order_main_id'];
        $work_order_number = $row['work_order_number'];
        $work_order_start_date = date("d-M-Y", strtotime($row['work_order_start_date']));
		$work_order_end_date = date("d-M-Y", strtotime($row['work_order_end_date']));
		
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
         $v_note = trim($row['note']) ;
        
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
                        $valign_middle = "line-height: 30px;";
                        

// add a page
$pdf->AddPage();

  
             $i=0;
						  $result = mysqli_query($conns,"select * from  work_order_child_tbl where work_order_no = '".$_GET['work_order_no']."'");
							 while($row=mysqli_fetch_assoc($result)) {
								$product_name=$row['product_name']; 
								$description=$row['description'];
								$description = str_replace("<p>","",$description);
								$description = str_replace("</p>","",$description);
								$qty=number_format($row['required_quantity'],2);
								$unit=$row['unit'];
								$quotation_status=$row['quotation_status'];
								$remarks=$row['remarks'];
	                       $i++; 
						 
                         
                                        	$content .='<tr nobr="true" style="'.$border_bottom.';">';
                                            $content .=  '<td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$i.'</td>';
                                            $content .=  '<td style="text-align: left;'.$para_justify.$border_bottom.$border_left.';"><strong>' . trim($product_name) .'</strong> '.trim($description).'</td>';
                                            $content .=  '<td style="text-align: center;'.$border_bottom.$border_left.';">'.$qty.'</td>';
                                            $content .=  '<td style="text-align: center;'.$border_bottom.$border_left.';">'.$unit.'</td>';
                                            $content .= '<td align="center" style="padding: 0px;'.$border_bottom.$border_left.'">';
                                            $content .= ($quotation_status == 'Material Received') ? 'Yes' : '&nbsp;';
											$content .= '</td>';
											$content .= '<td align="center" style="padding: 0px;'.$border_bottom.$border_left.'">';
											$content .= ($quotation_status == 'Fabrication completed') ? 'Yes' : '&nbsp;';
											$content .= '</td>';
											$content .= '<td align="center" style="padding: 0px;'.$border_bottom.$border_left.'">';
											$content .= ($quotation_status == 'Delivered') ? 'Yes' : '&nbsp;';
											$content .= '</td>';
											$content .= '<td align="center" style="padding: 0px;'.$border_bottom.$border_left.'">';
											$content .= ($quotation_status == 'Site fixing completed') ? 'Yes' : '&nbsp;';
											$content .= '</td>';
                                            $content .=  '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$remarks.'</td>';
                                            $content .='</tr>';
						                   
												 
                                       }
									  
     if($v_note!=NULL)
{
    $td_note.='<tr>';
  $td_note.='<td colspan="6" style="text-align: left;'. $para_justify.';">Note: &nbsp;&nbsp;'.$v_note.'</td>';  
  $td_note.='</tr>';
}                                     


            
           
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
            <td align="left" valign="top" >
				<table width="100%"  cellspacing="0" cellpadding="5">
					<tbody>
						<tr >
						  <td style="text-align: center; color: #FFFFFF; font-size: 26px; " bgcolor="$table_title_bg">WORK ORDER</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left"  style="font-weight:bold;text-align:right;" >
           
             
                <br>Project No. : $location
                <br>Received : $received
				
              </td>
            <td align="left" >
			  <table width="100%"  style="padding-top:5px;" >
              <tbody>
                
                <tr style="text-align: right;">
                  <td>Job No :<strong>$work_order_number</strong></td>
                </tr>
                <tr style="text-align: right;">
                  <td>Quotation Ref : <strong>$quotation_reference</strong></td>
                </tr>
                <tr style="text-align: right;">
                  <td >Start Date : <strong>$work_order_start_date</strong></td>
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
    <br>
    <tr>
      <td>
         
         <table width="100%"  cellspacing="0" cellpadding="3"  style="border-collapse: collapse;border: .7em solid $color;$table_background" >
        <tbody>
          <tr>
              <td width="5%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Sl No</strong></td>
              <td width="20%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Product Name</strong></td>
              <td width="10%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Qty</strong></td>
              <td width="6%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Unit</strong></td>
              <td width="10.5%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Material Received</strong></td>
              <td width="10.5%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Fabricaton completed</strong></td>
              <td width="10.5%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Delivered</strong></td>
              <td width="10.5%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Site fixing completed</strong></td>
        	  <td width="16%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Remarks</strong></td>
          </tr>  
          

          
          
          
          
		$content
		   
       
		</tbody>
	    </table>
	  </td>
    </tr>
    <br>
    
   	<tr>
	<td>
	 <table width="100%"  cellspacing="0" cellpadding="3" style="" align="center">
        <tbody>$td_note
            
          <tr>
            
            <td colspan="6" style="text-align:left;">Completion Report:<ul style="list-style-type: none;">
              
			  <li>1.</li>
			  <li>2.</li>	
			</ul></td>
            
          </tr>  
         
		</tbody>
	    </table>
	
	</td>								
   </tr>
   <br>
   <br>
   	<tr>
	<td>
	 <table width="100%"  cellspacing="0" cellpadding="3"  align="center">
        <tbody>
         
            	<tr>
					<td width="22%" align="left"><strong>Manager</strong></td>
					<td width="31%"><strong>Accounts manager</strong></td>
					<td width="27%"><strong>Supervisor</strong></td>
					<td width="20%" align="right"><strong>Forman</strong></td>    
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
$work_order_number = str_replace("/","-",$work_order_number);
$pdf->Output($work_order_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
