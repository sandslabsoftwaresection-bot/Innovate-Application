<?php
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
		$img_file = K_PATH_IMAGES.'webinar_python_blank_without.jpg';
		$this->Image($img_file, null, 0, 210, 297, '', '', '', false, 300, 'C', false, false, 0);
		// restore auto-page-break status
		$this->setAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$this->setPageMark();
	}
}




// Create connection
      $conn = mysqli_connect("localhost","sandsl23_online_course_user","s@nds1@b","sandsl23_online_course");
	  mysqli_set_charset($con,'utf8');
      if (mysqli_connect_errno())
        {
                //echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
mysqli_set_charset( $conn, 'utf8');      
$sql = "SELECT name, email, name_hindi,certificate_code,status,batch_code,issue_date FROM internship_details where email = '".$_POST['v_user_name']."' or certificate_code ='".$_POST['v_user_name']."' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $student_name = $row["name"];
    $email = $row["email"];
    $name_hindi = $row["name_hindi"];
    $certificate_code = $row["certificate_code"];
    $status = $row["status"];
    $batch_code = $row["batch_code"];
    $issue_date = $row["issue_date"];
  }
  $issue_date = date_format(date_create($issue_date),"d-M-Y");
} 

//mysqli_set_charset( $conn, 'utf8');      
$sql = "SELECT program_title_hindi, hindi_matter,programe_title_english,english_matter,certificate_title_hindi,certificate_title_english FROM certificate_matter where event_name = '".$batch_code."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $hindi_matter = $row["hindi_matter"];
    $english_matter = $row["english_matter"];
    $program_title_hindi = $row["program_title_hindi"];
    $program_title_english = $row["programe_title_english"];
    $certificate_title_hindi = $row["certificate_title_hindi"];
    $certificate_title_english = $row["certificate_title_english"];
  }
} 

$conn->close();




// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('SaNDS Lab');
$pdf->setTitle('PHP MYSQL FULLSTACK');
$pdf->setSubject('PHPMYSQL');
$pdf->setKeywords('PHP,MYSQL,FULLSTACK, Webinar, Participation, Certificate');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(0);
$pdf->setFooterMargin(0);

// remove default footer
$pdf->setPrintFooter(false);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
// if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
// 	require_once(dirname(__FILE__).'/lang/eng.php');
// 	$pdf->setLanguageArray($l);
// }

// ---------------------------------------------------------

// set font
// $pdf->setFont('times', '', 48);

// ---------------------------------------------------------
$fontname_hindi3 = TCPDF_FONTS::addTTFfont("../fonts/MANGAL.TTF", 'TrueTypeUnicode', '', 96);
// set default font subsetting mode
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.



// add a page
$pdf->AddPage();
$pdf->SetFont($fontname_hindi3, '', 10, '', false);

if(trim($student_name)=='')
{
    $pdf->Image('images/varification_failed.png', 30, 100, 150, '', '', 'http://www.sandslab.com', '', false, 300);
}

//Matter Hindi
$pdf->Ln(44);
$html = '<div><p   style="font-size:12pt;color:#666666;padding-left:80px;line-height: 1.6;"  align="center">'.$hindi_matter.'</p></div>';
$pdf->writeHTML($html, true, false, true, false, '');


// Name Hindi
$pdf->Ln(-58);
$html = '<p   style="font-weight:bold;font-size:22pt;color:#666666"  align="center">'.$name_hindi.'</p>';
$pdf->writeHTML($html, true, false, true, false, '');

//Programe Title Hindi
$pdf->Ln(5);
$html = '<p   style="font-weight:bold;font-size:16pt;color:#666666"  align="center">'.$program_title_hindi.'</p>';
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Ln(-48);
$html = '<p   style="font-weight:bold;font-size:18pt;color:#666666"  align="center">'.$certificate_title_hindi.'</p>';
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Ln(-14);

$html = '<p   style="font-family:helvetica;font-weight:bold;font-size:16pt;color:#666666"  align="center">'.$certificate_title_english.'</p>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(70);
$html = '<p   style="font-family:helvetica;font-size:12pt;color:#666666;line-height: 1.6;"  align="center">'.$english_matter.'</p>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(-48);
$html = '<p   style="font-family:helvetica;font-weight:bold;font-size:16pt;color:#666666"  align="center">'.$student_name.'</p>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Ln(6);
$html = '<p   style="font-family:helvetica;font-weight:400;font-size:16pt;color:#666666"  align="center">'.$program_title_english.'</p>';
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Ln(80);
$space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$html = '<p   style="font-family:helvetica;font-size:12pt;color:#666666;"  align="left">'.$space.$certificate_code.'</p>';
$pdf->writeHTML(utf8_encode($html), true, false, true, false, '');

$pdf->Ln(1);
$space = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$html = '<span   style="font-family:helvetica;font-size:10pt;color:#666666;"  align="left">'.$space.'Date: '.$issue_date.'</span>';
$pdf->writeHTML(utf8_encode($html), true, false, true, false, '');
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($student_name.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
