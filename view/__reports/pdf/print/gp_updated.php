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
    
    
   
     $result = mysqli_query($conns,"select * from  gate_pass_new_tbl  where pass_no = '".$_GET['pass_no']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $gate_pass_id =$row['gate_pass_id'];
        $pass_no = $row['pass_no'];
        $company_id = $row['company_id'];
        $gate_pass_date = date("d-M-Y", strtotime($row['gate_pass_date']));
        
        //$company_name= $row['company_name'];
       $company_name = trim($row['company_name']);
        
        $po_box = $row['po_box'];
        $telephone_no = $row['telephone_no'];
        $fax = $row['fax'];
        $address = $row['address'];
        $attn = $row['attn']; 
        $vehicle_no = $row['vehicle_no'];
        $driver_name = $row['driver_name']; 
        $approved_by = $row['approved_by'] ;
        $checked_by = $row['checked_by'] ;
        $received_by = $row['received_by'] ;
        $jobno = $row['job_no'] ;
        $jobname = $row['project_name'] ;
        $v_location = $row['location'] ;
        $v_note = trim($row['note']) ; 
         
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
                        $valign_middle = "line-height: 40px;";
                        

// add a page
$pdf->AddPage();

  
              $i=0;
				//  $result = mysqli_query($conns,"select * from  gate_pass_child_tbl where pass_no = '".$_GET['pass_no']."'");
					 $result = mysqli_query($conns,"select * from  gate_pass_child_tbl where pass_no = '".$_GET['pass_no']."'");
                     while($row=mysqli_fetch_assoc($result)) {
                        $inventory_id=$row['inventory_id'];
                        $inventory_name=$row['inventory_name'];
                        $description=$row['description'];
                        $qty=$row['quantity'];
                        $unit=$row['unit'];
                        $i++; 
		
						 
                         
                                        		$content .='<tr nobr="true" style="'.$border_bottom.';">';
                                            $content .=  '<td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$i.'</td>';
                                            $content .=  '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$inventory_name.'</td>';
                                            $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$qty.'</td>';
                                            $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$unit.'</td>';
                                           $content .=  '<td style="text-align: left;'.$para_justify.$border_bottom.$border_left.';">'.$description.'</td>';
                                            $content .='</tr>';
						                   
												 
                                      }
                                      
	if($v_note!=NULL)
{
    $td_note.='<tr>';
  $td_note.='<td style="text-align: left;'. $para_justify.';">'.$v_note.'</td>';  
  $td_note.='</tr>';
}
else
{
    $td_note .= '<tr><td style="text-align: left;border-bottom: 1px solid #09037f;"></td></tr>'; 
     $td_note .= '<tr><td></td></tr>'; 
    $td_note .= '<tr><td style="text-align: left;border-bottom: 1px solid #09037f;"></td></tr>'; 
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
						  <td style="text-align: center; color: #FFFFFF; font-size: 26px; " bgcolor="$table_title_bg">Gate Pass</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td  align="left" valign="top" style="padding: 0px;"><table width="100%"  style="padding-top:8px;" >
                    <tr style="text-align: left;">
                        <td >Job No : <strong>$jobno</strong> </td >
                    </tr>    
                    <tr style="text-align: left;">    
                        <td >Job Name : <strong>$jobname</strong></td >
                    </tr>    
                    <tr style="text-align: left;">    
                       <td >Location : <strong>$v_location</strong></td >
                    </tr>   
                </table>
            </td>
              <td align="left" >
			  <table width="100%"  style="padding-top:8px;">
              <tbody>
              
                <tr style="text-align: right;">
                  <td >Pass No : <strong>$pass_no</strong></td>
                </tr>
                <tr style="text-align: right;">
                  <td>Date : <strong>$gate_pass_date</strong></td>
                </tr>
                <tr style="text-align: right;">
                      <td>Requested : <strong>$checked_by</strong></td>
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
    <br>
    <tr>
      <td>
      
         
         <table width="100%"  cellspacing="0" cellpadding="3"  style="border-collapse: collapse;border: .7em solid $color;$table_background" >
        <tbody>
          <tr >
              <td width="5%" bgcolor="$table_title_bg" style="$table_title_style"><strong>No</strong></td>
              <td width="30%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Description</strong></td>
              <td  width="15%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Qty</strong></td>
              <td width="15%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Unit</strong></td>
              <td width="34%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Remarks</strong></td>
             

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
    
     	<table width="100%" border="0" cellspacing="0" cellpadding="2" align="left" valign="middile">
				  <tbody>
				     <tr>
                        <td width="7%">Note:</td>
                        <td width="92%" colspan="2">
                            <table width="100%">
                                <tbody>
                                    
                                        $td_note
                                    
                                </tbody>
                            </table>
                        </td>
                    </tr>
					 <tr>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
					<tr>
    					<td colspan="2">Approved by</td>
    					<td align="left">Received by</td>
    				</tr>
					
					
					<tr>
					<td colspan="2">Name <strong>$approved_by</strong></td>
					<td align="left">Name <strong>$received_by</strong></td>
					</tr>
					
			        <tr>
                        <td colspan="3"></td>
                    </tr>
					
					<tr>
					  <td colspan="2">Sign _________________________</td>
					  <td align="left">Sign _________________________</td>
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
$pass_no = str_replace("/","-",$pass_no);
$pdf->Output($pass_no.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
