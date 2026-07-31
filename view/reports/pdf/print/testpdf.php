<?php 
include("../../../session_check.php");
require_once('tcpdf_include.php');

// Extend TCPDF class to create custom header and footer
class MYPDF extends TCPDF {
    // Page header
    public function Header() {
        // Header code here
    }

    // Page footer
    public function Footer() {
        // Footer code here
    }
}

// Create instance of PDF
$pdf = new MYPDF();

// Add a page
$pdf->AddPage();

// HTML table with inline style to vertically align the content of a specific cell
$html = '<table border="1">
    <tr>
        <td>Cell 1</td>
        <td style="line-height: 130px;">Cell 2 (Vertically Aligned Middle)</td>
        <td>Cell 3</td>
    </tr>
    <tr>
        <td>Row 2, Cell 1</td>
        <td>Row 2, Cell 2</td>
        <td>Row 2, Cell 3</td>
    </tr>
</table>';

// Write HTML content to the page
$pdf->writeHTML($html);

// Output the PDF
$pdf->Output();

?>
