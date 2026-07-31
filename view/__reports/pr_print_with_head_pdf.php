<?php
require 'pdfdoc/vendor/autoload.php';
require ('../../model/common/common_functions.php');
use Dompdf\Dompdf;
use Dompdf\Options;

// Create a new Dompdf instance
$options = new Options();
$options->set('isPhpEnabled', true); // Enable inline PHP code
$dompdf = new Dompdf($options);

// Generate table rows using a loop



   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
   
    $pr_main_table = mysqli_query($conns, "SELECT * FROM purchase_requsition_main_tbl WHERE purchase_req_no = '".$_GET['pr_number']."'");
    while($rows = mysqli_fetch_assoc($pr_main_table)) 
	{
        $invoice_number = $rows['purchase_req_no'];
        $invoice_date = date("m-d-Y", strtotime($rows['default_date']));
        $supplier_name= $rows['supplier_name'];
        $supplier_id = $rows['supplier_id'];
        $requsition_date = $rows['requsition_date'];
        $requested_by = $rows['requested_by'];
		$approved_by = $rows['approved_by'];
        $work_order_no_id = $rows['work_order_no_id'];
        $work_order_no = $rows['work_order_no']; 
        $requisition_status = $rows['requisition_status'];
    } 
	
	
    $result_supplier = mysqli_query($conns, "SELECT * FROM supplier_details  where company_id = ".$supplier_id);
    while($row_supplier = mysqli_fetch_assoc($result_supplier)) 
	{
        $supplier_vat_no = $row_supplier['description'];
		$contact_address = $row_supplier['contact_address_2'];
		$contact_person = $row_supplier['contact_person'];
		$contact_email = $row_supplier['contact_email'];
		$contact_phone = $row_supplier['contact_phone'];
		$fax = $row_supplier['fax'];
    }
	
	$result_company = mysqli_query($conns, "SELECT * FROM company_primary_details  where profile_id = '1'");
    while($row_company= mysqli_fetch_assoc($result_company)) 
	{
		$print_companynamne = $row_company['company_name'];
        $tele = $row_company['phone_no'];
		$company_address = $row_company['address'];
		$company_email = $row_company['email'];
    }
                               








// Load your HTML content
$html = '
<html>
<head>
<meta charset="utf-8">
<title>Purchase Requisition '.$invoice_number.' </title>
<!-- favicons -->
    <link rel="apple-touch-icon" href="../../../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png">
    <link rel="icon" href="../../../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png">
<style>
	
/* Styles go here */
body {
  counter-reset: section;    
}

.page-header, .page-header-space {
  height: 60px;
}

.page-footer, .page-footer-space {
  height: 50px;

}

.page-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  border-top: 2px solid red; /* for demo */
  background: white; /* for demo */
}

.page-header {
  position: fixed;
  top: 0mm;
  width: 100%;
  /*border-bottom: 1px solid black;  for demo */
  background: white; /* for demo */
}

.page {
  text-align: center;
}

@page {
  margin: 15mm
}
.tbl90{
	  width: 900px;
	  
  }	
@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   
   body {margin: 0;font-size: 16px;font-family: "Times New Roman"}
}

@media print {
  #print_but,#export_excel_but {
    display: none;
  }
  
	
  .signature-area {
    position: bsolute;
	
	bottom:0;
    
  }

  
	
  .tbl90{
	  width: 1000px;
  }	
  .tbl_line
  {
   border:.01px #a9a9a9;
  }
  .tbl_line_b
  {
	border-bottom:.01px #a9a9a9;
  }
}		
</style>
	
	
</head>

<body>
 <page size="A4">
	<div class="page-header" style="text-align: center" align="center">
	    <table class="tbl90" width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tbody>
				<tr style="text-align:left;">
				  <td width="36%" align="right" valign="top"><img src="../../httpdocs/images/company_profile_image/174258_logo copy png.jpg" width="285" height="60" alt=""/></td>
				  <td width="64%" align="left" valign="top">&nbsp;
				  </td>
				</tr>
				<tr>
				  <td><br>
				  
				  </td>
				  <td></td>
				</tr>
			  </tbody>
		</table>
	</div>	
	<div class="page-footer" align="center">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		 <tbody>
			<tr style="text-align:middle; border-bottom:">
			  <td colspan="2" align="center" valign="middle" style="padding-top:5px;">
			
			 $print_companynamne,
			  
				   Tele :'.$tele.'  ,  '.$company_address.' , Manama , Kingdom of Bahrain <br>      
				 Email : '.$company_email.'    Web : www.sapphirebh.com    
				
				</td>
			</tr>
			<tr>
			  <td width="50%"><br>
			  
			  </td>
			  <td width="50%"></td>
			</tr>
		  </tbody>
		</table>
	</div>	

	
</page>	
	
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



<script>
function fnExcelReport()
{
	var pr = "<?php echo $invoice_number;  ?>";
	var filename = "purchase requisition - "+pr+".xls";
    var tab_text="<table border='2px' ><tr bgcolor='#FFFFFF' style='border-bottom: 1px solid #FFFFFF;'>";
    var textRange; var j=0;
    tab = document.getElementById('main_table'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        //tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
  // tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE"); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,filename);
    }  
    else                 //other browser not tested on IE 11
  var link = document.createElement('a');
  link.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tab_text);
  link.download = filename;
  link.click();
  return (link);
}
 window.onload = function() {
     const signature = document.querySelector('.signature-area');
	
     window.onbeforeprint = function() {
       signature.style.position = 'fixed';
       signature.style.bottom = '50px';
     };
     window.onafterprint = function() {
	    
	   signature.style.position = 'static';  
	   signature.style.bottom = '0px';
     };
	
   };

</script>	

