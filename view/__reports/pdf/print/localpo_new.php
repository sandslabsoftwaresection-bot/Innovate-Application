<?php
include("../../../session_check.php");
//============================================================+
// File name   : generate_pdf.php
// Description : Generate a Purchase Order PDF with TCPDF, including sums of Amount and VAT Rate under respective columns in the footer
//============================================================+

/**
 * Creates a Purchase Order PDF document using TCPDF
 * @package com.tecnick.tcpdf
 * @author Nicola Asuni (original), modified for Purchase Order
 * @since 2009-04-16
 * @group background
 * @group page
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    // Page header
    public function Header() {
        // Get the current page break margin
        $bMargin = $this->getBreakMargin();
        // Get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // Disable auto-page-break
        $this->setAutoPageBreak(false, 0);
        // Set background image
        if ($_GET['x'] == 0) {
            $img_file = K_PATH_IMAGES . 'sapphirebh_letterhead.jpg';
        } else {
            $img_file = K_PATH_IMAGES;
        }
        $this->Image($img_file, null, 0, 210, 297, '', '', '', false, 300, 'C', false, false, 0);
        // Restore auto-page-break status
        $this->setAutoPageBreak($auto_page_break, $bMargin);
        // Set the starting point for the page content
        $this->setPageMark();
        $this->SetTopMargin($this->GetY() + 30);
    }

    // Page footer
    public function Footer() {
        // Select Arial italic 8
        $this->SetFont('helvetica', 'I', 8);
        // Position at 15 mm from bottom
        $this->SetY(-15);
        $pageNumber = $this->getAliasNumPage();
        $totalPages = $this->getAliasNbPages();
        $this->Cell(350, 10, 'Page ' . $pageNumber . ' of ' . $totalPages, 0, false, 'C');
    }
}

// Get the quotation number
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $certificate_code = $_GET['quotation_number'];
} else {
    $certificate_code = $_POST['quotation_number'];
}

// Create connection
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/common/common_functions.php');
$db_con = new DBConnection();
$conns = $db_con->ConnectToMYSQL();

// Fetch data from local_po_main_tbl
$result = mysqli_query($conns, "select * from local_po_main_tbl where local_po_number = '" . $_GET['local_po_number'] . "'");
while ($row = mysqli_fetch_assoc($result)) {
    $invoice_number = $row['local_po_number'];
    $invoice_date = date("d-M-Y", strtotime($row['local_po_created_date']));
    $company_name = trim($row['company_name']);
    $po_box = trim($row['po_box']);
    $telephone_no = trim($row['telephone_no']);
    $fax = trim($row['fax']);
    $address = trim($row['address']);
    $attn = trim($row['attn']);
    $project_name = trim($row['project_name']);
    $quotation_reference = trim($row['quotation_reference']);
    $LPO_no = trim($row['LPO_no']);
    $total_amount = $row['sub_total'];
    $received_by_id = $row['received_by_id'];
    $received_by_name = trim($row['received_by_name']);
    $description = trim($row['description']);
    $payment_terms = trim($row['payment_terms']);
}

// Fetch supplier details
$result_supplier = mysqli_query($conns, "select * from supplier_details where company_name like '%" . $company_name . "'");
while ($row_supplier = mysqli_fetch_assoc($result_supplier)) {
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

// Fetch company VAT number
$result_company_id = mysqli_query($conns, "select description from company_details where company_id = " . $company_id);
while ($row_comp_id = mysqli_fetch_assoc($result_company_id)) {
    $company_vat_no = $row_comp_id['description'];
}

// Fetch company primary details
$result_company = mysqli_query($conns, "select * from company_primary_details");
while ($row_company = mysqli_fetch_assoc($result_company)) {
    $print_companynamne = trim($row_company['company_name']);
    $print_address = trim($row_company['address']);
    $print_tele = trim($row_company['phone_no']);
    $print_fax = trim($row_company['fax']);
    $print_email = trim($row_company['email']);
    $print_po = trim($row_company['pobox']);
    $print_logo = trim($row_company['print_logo']);
    $vat_no = trim($row_company['VAT_no']);
}

// Function to convert number to words
function getCurrency($number) {
    $decimal = round($number - ($no = floor($number)), 3) * 1000;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(
        0 => '', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen',
        18 => 'eighteen', 19 => 'nineteen', 20 => 'twenty', 30 => 'thirty', 40 => 'forty',
        50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety', 21 => 'zero'
    );
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? '  ' : null;
            $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred :
                $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else {
            $str[] = null;
        }
    }
    $Rupees = implode('', array_reverse($str));
    $last = $decimal % 100;
    $x = $decimal % 10;
    $y = $last - $x;
    if ($y == 0) {
        $y = 21;
    }
    if ($x == 0) {
        $x = 21;
    }
    if ($decimal > 0) {
        $paise = ($decimal > 0) ? " " . ($words[$decimal / 100] . " " . $words[$y] . " " . $words[$x]) . ' ' : '';
        return ucwords(($Rupees ? $Rupees . ' ' : ' ') . '1000 /' . $paise . "   ");
    } else {
        return ucwords(($Rupees ? $Rupees . ' ' : ' ') . "   ");
    }
}

// Create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('SaNDS Lab');
$pdf->setTitle('SAPPHIER/QNO/' . $invoice_number);
$pdf->setSubject('SAPPHIER');
$pdf->setKeywords('SAPPHIER');

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// Set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->setMargins(15, PDF_MARGIN_TOP, 15);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// Set font
$pdf->setFont('times', '', 10);

// Styling variables
$color = "#09037f";
$border_bottom = "border-bottom: 1px solid #09037f;border-top: 1px solid #09037f;";
$border_bottom_line = "border-bottom: 1px solid #09037f;border-top: 1px solid #09037f;";
$border_left = "border-left: 1px solid #09037f";
$table_title_style = "text-align: center; color: #FFFFFF;font-size:12px;border: 1px solid #09037f;";
$table_title_bg = "#09037f";
$table_background = "background: transparent;";
$para_justify = "text-align: justify;text-justify: inter-word;display: inline-block;";
$valign_middle = "line-height: 40px;";

// Add a page
$pdf->AddPage();

// Fetch and generate table content
$ctr = 1;
$amt = 0;
$tot_amt = 0;
$amount_sum = 0; // Sum of Amount column
$vat_sum = 0; // Sum of VAT Rate column
$total_discount_amount = 0; // Assuming this is defined or zero
$vat_p = 0; // Assuming this is defined or zero
$content = '';

$result = mysqli_query($conns, "select * from local_po_child_tbl where local_po_no = '" . $_GET['local_po_number'] . "'");
while ($row = mysqli_fetch_assoc($result)) {
    $content .= '<tr nobr="true" style="' . $border_bottom . ';">';
    $content .= '<td style="text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">' . $ctr . '</td>';
    $content .= '<td style="text-align: left;' . $para_justify . $border_bottom . $border_left . ';">' . $row['description'] . '</td>';
    $content .= '<td style="text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">' . number_format($row['quantity'], 2) . '</td>';
    $content .= '<td style="text-align: center;' . $valign_middle . $border_bottom . $border_left . ';">' . $row['unit'] . '</td>';
    $content .= '<td style="text-align: right;' . $valign_middle . $border_bottom . $border_left . ';">' . number_format($row["rate"], 3) . '</td>';
    $content .= '<td style="text-align: right;' . $valign_middle . $border_bottom . $border_left . ';">' . number_format($row["amount"], 3) . '</td>';
    $content .= '<td style="text-align: right;' . $valign_middle . $border_bottom . $border_left . ';">' . number_format(($row["amount"] * $row['vat_percentage'] / 100), 2) . '</td>';
    $content .= '<td style="text-align: right;' . $valign_middle . $border_bottom . $border_left . ';">' . number_format($row['net_amount'], 3) . '</td>';
    $content .= '</tr>';

    // Calculate sums
    $amount_sum += $row["amount"];
    $vat_sum += ($row["amount"] * $row['vat_percentage'] / 100);
    $amt += $row["net_amount"];
    $tot_amt += $row["net_amount"];
    $ctr++;
}

// Format the sums
$amount_sum_format = number_format($amount_sum, 3);
$vat_sum_format = number_format($vat_sum, 2);
$net_amount_format = number_format($amt, 3);

// Add footer table with sums under respective columns
$content .= '<tr style="border-bottom: 1px solid gray;">';
$content .= '<td colspan="5" style="text-align: left;' . $border_bottom_line . $border_left . '"><strong>Total Amount in BHD</strong></td>';
$content .= '<td style="text-align: right;' . $border_bottom_line . $border_left . ';"><strong>' . $amount_sum_format . '</strong></td>';
$content .= '<td style="text-align: right;' . $border_bottom_line . $border_left . ';"><strong>' . $vat_sum_format . '</strong></td>';
$content .= '<td style="text-align: right;' . $border_bottom_line . $border_left . ';"><strong>' . $net_amount_format . '</strong></td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td colspan="8" style="text-align: center; font-size:12px">Bahraini Dinars: <strong>';
$ro = round(($tot_amt - ($total_discount_amount + $discount)) + $vat_p, 3);
$amt1 = str_replace(",", "", $ro);
$splitamount1 = number_format((float)(($tot_amt - ($total_discount_amount + $discount)) + $vat_p), 3, ".", "");
$splitamount = explode(".", ($splitamount1));

if (intval($splitamount[1]) <= 0) {
    $getCurr = getCurrency($splitamount[0]) . ' only';
    $content .= $getCurr;
} else {
    $getCurr = getCurrency($splitamount[0]) . "  " . $splitamount[1] . "/1000 Fills Only";
    $content .= $getCurr;
}
$content .= '</strong></td>';
$content .= '</tr>';

// HTML content for the PDF
$html = <<<EOD
<table width="100%" border="0" cellspacing="0" id="main_table" style="$table_background">
    <tbody>
        <tr>
            <td style="padding-left:10px;padding-right:10px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:10px;$table_background">
                    <tbody>
                        <tr>
                            <td width="49%" align="left" valign="top" style="padding-bottom: 0px;"></td>
                            <td align="left" valign="top">
                                <table width="100%" cellspacing="0" cellpadding="5">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center; color: #FFFFFF; font-size: 26px;" bgcolor="$table_title_bg">PURCHASE ORDER</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" style="font-weight:bold;text-align:right;">
                                <br><br>$com_name_sup_dtls
                                <br>P O Box : $pobox_sup_dtls,
                                <br>$contact_address,
                                <br>Country : $country_sup_dtls,
                                <br>TEL : $contact_phone,
                                <br>FAX : $fax,
                                <br>VAT : $supplier_vat_no
                            </td>
                            <td align="left">
                                <table width="100%" style="padding-top:5px;">
                                    <tbody>
                                        <tr style="text-align: right;">
                                            <td>Date : <strong>$invoice_date</strong></td>
                                        </tr>
                                        <tr style="text-align: right;">
                                            <td>PO No : <strong>$invoice_number</strong></td>
                                        </tr>
                                        <tr style="text-align: right;">
                                            <td>Quotation Ref : <strong>$quotation_reference</strong></td>
                                        </tr>
                                        <tr style="text-align: right;">
                                            <td>Payment Terms : <strong>$payment_terms</strong></td>
                                        </tr>
                                        <tr style="text-align: right;">
                                            <td>VAT Account No : <strong>$vat_no</strong></td>
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
            <td>
                <table width="100%" cellspacing="0" cellpadding="3" style="border-collapse: collapse;border: .7em solid $color;$table_background">
                    <tbody>
                        <tr>
                            <td width="5%" bgcolor="$table_title_bg" style="$table_title_style"><strong>S/N</strong></td>
                            <td width="20%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Description</strong></td>
                            <td width="10%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Qty</strong></td>
                            <td width="10%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Unit</strong></td>
                            <td width="10%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Rate</strong></td>
                            <td width="14%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Amount</strong></td>
                            <td width="15%" bgcolor="$table_title_bg" style="$table_title_style"><strong>VAT Rate</strong></td>
                            <td width="15%" bgcolor="$table_title_bg" style="$table_title_style"><strong>Net Amount</strong></td>
                        </tr>
                        $content
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0" style="" align="left">
                    <tbody>
                        <tr>
                            <td colspan="8" style="text-align:left;">$description</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
EOD;

// Write HTML to PDF
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'C', true);

// Close and output PDF document
$invoice_number = str_replace("/", "-", $invoice_number);
$pdf->Output($invoice_number . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>