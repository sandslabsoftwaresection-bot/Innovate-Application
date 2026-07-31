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
		$img_file = K_PATH_IMAGES.'sapphirebh_letterhead_land.jpg';
		}
		else
		{
		  $img_file = K_PATH_IMAGES;  
		}
		$this->Image($img_file, null, 0, 297,210, '', '', '', false, 300, 'C', false, false, 0);
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

        
        $this->Cell(520, 10, 'Page ' . $pageNumber . ' of ' . $totalPages, 0, false, 'C');

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
    
    
   
//   $result = mysqli_query($conns,"select * from intern_payment_main_tbl  where 	invoice_number = '".$_GET['invoice_number']."'");
    
    

//     while($row=mysqli_fetch_assoc($result)) {
//         $invoice_main_id =$row['invoice_main_id'];
//         $invoice_number = $row['interim_real_no'];
//         $invoice_date = date("d-M-Y", strtotime($row['invoice_date']));
//         $company_name= $row['company_name'];
//         $po_box = $row['po_box'];
//         $telephone_no = $row['telephone_no'];
//         $fax = $row['fax'];
//         $address = $row['address'];
//         $attn = $row['attn']; 
//         $subject = $row['subject'];
//         $quotation_reference = $row['quotation_reference']; 
//         $LPO_no = $row['LPO_no'] ;
//         $total_amount = $row['sub_total'] ;
//         $discount_amount=$row['total_amount'];
//         $received_by_id = $row['received_by_id'] ;
//         $received_by_name = $row['received_by_name'] ;
//         $description =  $row['description'];
//         $project_name = $row['project_name'] ;
//         $project_id = $row['project_id'] ;
//         $received_amount=$row['received_amount'] ;
//         $balane_in_due=$row['balane_in_due'] ;
//         $retention_amount_percentage=$row['retention_amount_percentage'];
//         $previous_bill_amount=$row['previous_bill_amount'];
//         $discount_type = $row['discount_type'] ;
//         $discount_amount = $row['discount_amount'] ;
//         $total_discount_amount = $row['total_discount_amount'] ;
//         $tax_content= $row['tax_content'];
//         $retention_amount_type = $row['retention_amount_type'] ;
//         $received_amount_type = $row['received_amount_type'] ;
        
//         $discount = 0;
//         $company_id = $row['company_id'];
//          $vat = $row['vat'];
         
//       if($row['retention_amount_percentage']!=0)
//          {
//              $retention_amount = ($row['sub_total']*$row['retention_amount_percentage'])/100;
//          }
		 
//           if($row['received_amount']!=0)
//          {
//           //  $received_amount =  ($row['total_amount']*$row['received_amount'])/100;
//          }
// 		 if($retention_amount_type=='%'){
// 			 $v_retention=number_format($retention_amount_percentage, 0);
// 			 $retention_amount = ($row['sub_total']*$v_retention)/100;
// 		 }
// 		 else{
// 			 $v_retention=0;
// 			 $retention_amount=$retention_amount_percentage;
// 		 }
		 
        
//     }
    
   
// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('SaNDS Lab');
$pdf->setTitle('SAPPHIER/SUPPLIER_REPORT');
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

                        $item_ids_string = isset($_GET['item_id']) ? $_GET['item_id'] : '';
                        $supl_ids_string = isset($_GET['supplier_id']) ? $_GET['supplier_id'] : '';
                        $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
                        $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
                        $start=date("d-M-Y", strtotime($_GET['startDate']));
                        $end=date("d-M-Y", strtotime($_GET['endDate']));
                        
             $ctr = 1;
                $i=1;
              
                $result_project_repport = mysqli_query($conns,"SELECT a.ids, a.inventory_id, a.inventory_name, a.store_category_id, a.store_category, a.description, a.quantity, a.rate, a.tax, a.amount, a.recieved_date, a.ref_no, a.master_ref_id, a.entry_type,
                                (
                                    SELECT supplier_name
                                    FROM purchase_received_main_tbl b
                                    WHERE b.supplier_id IN (".$supl_ids_string.") AND b.ids = a.master_ref_id AND b.supplier_name IS NOT NULL
                                ) as supplier_name
                            FROM
                                purchase_recieved_child_tbl a
                            WHERE
                                a.inventory_id IN (".$item_ids_string.")
                                AND a.entry_type = 'Purchase_recieved'AND (a.recieved_date BETWEEN '".$startDate."' AND '".$endDate."')
                                AND (
                                    a.ids IS NOT NULL
                                    OR a.inventory_id IS NOT NULL
                                    OR a.inventory_name IS NOT NULL
                                )
                                AND EXISTS (
                                    SELECT 1
                                    FROM purchase_received_main_tbl b
                                    WHERE b.ids = a.master_ref_id AND b.supplier_id IN (".$supl_ids_string.") AND b.supplier_name IS NOT NULL
                                )ORDER BY a.inventory_name");  
                            
                            
                while($row=mysqli_fetch_assoc($result_project_repport)) {
                    $ids=$row['ids'];
                    $inventory_name=trim($row['inventory_name']);
                    $ref_no=$row['ref_no'];
                    $recieved_date=$row['recieved_date'];
                     $entry_type=$row['entry_type'];
                     $supplier_name=trim($row['supplier_name']);
                     $quantity=$row['quantity'];
                    $rate=$row['rate'];
                   $damage_qty=$row['damage_qty'];
                    $tax=$row['tax'];
                    $amount=$row['amount'];
               
                // if($entry_type=='IssueNote'){
                //     $entry_type='Issue';
                // }
                // if($entry_type=='PassIN'){
                //     $entry_type='Return';
                // }
                      $item_amount=$quantity*$rate;
                      $tax_rate= ($item_amount*$tax)/100;
                     if ($inventory_name !== $last_inventory_name) {
                            // Insert a group header for the new inventory name
                            $content .= '<tr class="group"><td colspan="10" style="text-align: left;"><strong style="font-size: 20px;">' . $inventory_name . '</strong></td></tr>';
                            $last_inventory_name = $inventory_name; // Update last inventory name
                        }
		                    	$content .='<tr nobr="true" style="'.$border_bottom.';">';
                                $content .=  '<td  style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$i.'</td>';
                                // $content .=  '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$inventory_name.'</td>';
                                $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$recieved_date.'</td>';
                                $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.$ref_no.'</td>';
                                $content .=  '<td style="text-align: left;'.$valign_middle.$border_bottom.$border_left.';">'.$supplier_name.'</td>';
                                $content .=  '<td style="text-align: center;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($quantity,2).'</td>';
                                $content .=  '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($rate,3).'</td>';
                                $content .=  '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($item_amount,3).'</td>';
                                $content .=  '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($tax_rate,3).'</td>';
                                $content .=  '<td style="text-align: right;'.$valign_middle.$border_bottom.$border_left.';">'.number_format($amount,3).'</td>';
                                $content .='</tr>';	
                                                
					$i++;				  
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
            
            <td align="right" valign="top" style="background-color:red;" >
								<table width="100%"  cellspacing="0" cellpadding="5">
					<tbody>
						<tr >
						  <td style="text-align: center; color: #FFFFFF; font-size: 26px; " bgcolor="$table_title_bg">SUPPLIER REPORT</td>
						</tr>
					
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left"  style="font-weight:bold;text-align:right;" >
                   
                    <br><br>Starting Date: $start
                    <br>Ending Date: $end
               
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
            <td width="5%" bgcolor="$table_title_bg" style="$table_title_style"><strong>SI</strong></td>
            <td width="9%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Date</strong></td>
              <td width="15%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Ref No</strong></td>
              <td width="23%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Supplier Name</strong></td>
            <td width="6%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Qty</strong></td>
            <td width="10%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Rate</strong></td>
            <td width="10%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Amount</strong></td>
            <td width="10%" bgcolor="$table_title_bg" style="$table_title_style"><strong>VAT Rate</strong></td>
            <td width="11%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Net Amount</strong></td>
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
$pdf->Output($invoice_number.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
