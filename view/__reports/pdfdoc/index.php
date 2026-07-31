<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Create a new Dompdf instance
$options = new Options();
$options->set('isPhpEnabled', true); // Enable inline PHP code
$dompdf = new Dompdf($options);

// Generate table rows using a loop
$tableRows = '';
for ($i = 0; $i <= 200; $i++) { // You can adjust the loop range as needed
    $tableRows .= "
        <tr>
            <td>$i</td>
            <td>Ajit</td>
            <td>Koratty</td>
            <td>30</td>
        </tr>
    ";
}

// Load your HTML content
$html = '
<!DOCTYPE html>
<html>
<head>
<style>
  body {
    position: relative; /* Set the body to relative positioning */
    min-height: 100%; /* Make sure the body fills the entire height */
  }
  .footer {
    position: absolute; /* Set the footer to absolute positioning */
    bottom: 0; /* Place the footer at the bottom */
    width: 100%; /* Make the footer width full width */
    height: 100px;
    background-color: gray;
  }
</style>
</head>
<body>
  <h1>Example Document</h1>
  <div>
    <p>This is an example document.</p>
  </div>
  <div>
    <h3>Example Section I</h3>
    <table width="100%">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Address</th>
        <th>Age</th>
      </tr>
      ' . $tableRows . '
    </table>
  </div>
  <div class="footer">
    This is the footer content
  </div>
</body>
</html>
';

// Load HTML to Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the PDF to the browser
$dompdf->stream('document.pdf', array('Attachment' => 0));
?>
