<?PHP 
require ('../../model/common/common_functions.php');
   
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
                               
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Purchase Requisition<?php echo  ' - '.$invoice_number; ?> </title>
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
			
				<?PHP echo $print_companynamne;?>,
			  
				<?PHP echo "  Tele : ".$tele." , ". $company_address." , Manama , Kingdom of Bahrain "?><br>      
				<?PHP echo "  Email : ".$company_email. "     Web : www.sapphirebh.com"; ?>     
				
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

	<table class="tbl90" align="center"  border="0" cellspacing="0" cellpadding="5" width="90%">
		<thead> 
		  <tr>
			<td>
			  <!--place holder for the fixed-position header-->
			  <div class="page-header-space"></div>
			</td>
		  </tr>
		</thead>  

		<tbody>
		  <tr>
			<td>
			  <!--*** CONTENT GOES HERE ***-->
			<div class="container"> 
			<div class="page">
				
				 
				<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" id="main_table">
				  <tbody>
					<tr >
					  <td style="padding-left: 10px;padding-right: 10px">
						  
					<table width="100%" border="0" cellspacing="0" cellpadding="5">
						<tbody>
						  <tr>
							<td width="50%" align="left" valign="top" style="padding-bottom: 0px;"></td>
							<td align="left" valign="top" >
								<table width="100%"  cellspacing="0" cellpadding="5">
								  <tbody>
									<tr>
									  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic'; "bgcolor="#0079DD">PURCHASE REQUISITION</td>
									</tr>
									
								  </tbody>
								</table>
							</td>
						  </tr>
						  <tr>
							<td align="left" valign="top" style="padding-top: 0px;"><p><strong> </strong>
							   <table cellspacing="0" cellpadding="5"> 
									<tbody>
									  <tr>
										<td style=""><strong><?PHP echo $supplier_name; ?></strong>,</td>
									  </tr>
									  <tr>
										<td style=""><strong><?PHP //echo $contact_address; ?>
										    <?php
											// $address_lines = explode(", ", $contact_address);

											// foreach ($address_lines as $line) {
												// echo $line.',' . "<br>";
											// }
											?>
											<?php
											$address_lines = explode(", ", $contact_address);

											$total_lines = count($address_lines);
											foreach ($address_lines as $index => $line) {
											echo $line;

											if ($index < $total_lines - 1) {
												echo ',<br>';
											} else {
												echo '<br>';
											}
											}
											?>

										
										</strong></td>
									  </tr>
									</tbody>
							   </table>
							
								<!--<strong><?PHP //echo $supplier_name; ?></strong>,<br>-->
								<!--<strong>Phone: <?PHP //echo $contact_phone; ?></strong><br>
								<strong>Email : <?PHP //echo $contact_email; ?></strong><br>
								<strong>Fax: <?PHP //echo $fax; ?></strong><br>-->
								<!--<strong><?PHP //echo $contact_address; ?></strong><br>-->
								<!--<strong>CONTACT PERSON : <?PHP //echo $contact_person; ?>,</strong><br>-->
								</P>
							</td>
							<td align="right" valign="top">
								<table width="370px"  cellspacing="0" cellpadding="5">
									  <tbody style="float: right;">
										 <tr>
										  <td>PR No : <strong><?PHP echo $invoice_number; ?></strong></td>
										</tr>
										<tr>
										  <td>Date : <strong><?PHP echo $invoice_date; ?></strong></td>
										</tr>
										 <tr>
										  <td>Requested by : <strong><?PHP echo $requested_by; ?></strong></td>
										</tr>
										<tr>
										  <td>Job No : <strong><?PHP echo $work_order_no; ?></strong></td>
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
					  <td style="padding-left: 10px;padding-right: 10px">
						  
						<table class="tbl_line" width="100%" border=".025" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
						<tbody>
						  <tr>
							<td bgcolor="" style="text-align: center; color: black;font-size:15px;width:10px"><strong >SL</strong></td>
							<td bgcolor="" style="text-align: center; color: black;font-size:15px;width:500px"><strong>Description</strong></td>
							<td bgcolor="" style="text-align: center; color: black;font-size:15px;width:50px"><strong>Qty</strong></td>
							<td bgcolor="" style="text-align: center; color: black;font-size:15px;width:50px"><strong>Unit</strong></td>
							<td bgcolor="" style="text-align: center; color: black;font-size:15px;width:80px"><strong>Rate</strong></td>
							<td bgcolor="" style="text-align: center; color: black;font-size:15px;width:80px"><strong>Tax (VAT)</strong></td>
							<td bgcolor="" style="text-align: center; color: black;font-size:15px;width:100px"><strong>Amount</strong></td>
						  </tr>
						  <?PHP 
								$ctr = 1;
								$amt=0;
								$pr_child_table = mysqli_query($conns, "SELECT * FROM purchase_requsition_child_tbl WHERE purchase_requsition_no = '".$_GET['pr_number']."'");
									while($child_row=mysqli_fetch_assoc($pr_child_table)) {
			                               if($child_row['rate']=="" || $child_row['rate']=="0.000")
											 {
												$v_rate = ''; 
												$v_tax = ''; 
												$v_amount = '';							
											 }
											 else
											 {
												 $v_rate = $child_row['rate'];
												 $v_tax = $child_row['tax']."%";
												 $v_amount = $child_row['amount'];
											 }
										 //if($ctr%2!=0)
										 //{
								?>
										  <tr style="">
											<td  style="text-align: center;vertical-align:top;"><?PHP echo $ctr;?></td>
											<td  style="text-align:left;vertical-align:top;"><?PHP echo $child_row['description']; ?><br><br><br><br><br><br></td>
											<td  style="text-align: center;vertical-align:top;"><?PHP echo $child_row['quantity']; ?></td>
											<td  style="text-align: center;vertical-align:top;"><?PHP echo $child_row['unit']; ?></td>
											<td  style="text-align: right;vertical-align:top;"><?PHP echo number_format($v_rate, 3); ?></td>
											<td  style="text-align: right;vertical-align:top;"><?PHP echo $v_tax; ?></td>
											<td  style="text-align: right;vertical-align:top;"><?PHP echo number_format($v_amount ,3); $amt = $amt+$v_amount; ?></td>
										  </tr>
									<?PHP 
									//} else {
									?>
										<!--<tr style="border-bottom: 1px solid gray;height:75px;">
											<td style="text-align:left;"><?PHP //echo $ctr;?></td>
											<td style="text-align:left;vertical-align:top;"><?PHP //echo $child_row['description']; ?></td>
											<td style="text-align: center"><?PHP //echo $child_row['quantity']; ?></td>
											<td style="text-align: center"><?PHP //echo $child_row['unit']; ?></td>
											<td style="text-align: right"><?PHP //echo number_format($v_rate,3); ?></td>
											<td style="text-align: right"><?PHP //echo $v_tax; ?></td>
											<td style="text-align: right"><?PHP //echo number_format($v_amount,3); $amt = $amt+$v_amount; ?></td>
										</tr>-->
									<?PHP //} ?>
										  
						  <?PHP 
						  
							$ctr = $ctr +1;
							} ?>
						   <tr class="tbl_line_b" style="border-bottom:.01px #a9a9a9; height:35px;">
								<td style="text-align: center">&nbsp;</td>
								<td colspan="4" style="text-align: right"> <strong>Total Amount</strong></td>
								<td style="text-align: right" colspan="2"><strong><?PHP if ($amt == 0) { echo '';} else { echo number_format($amt, 3);}//echo number_format($amt,3); ?></strong></td>	
								
						   </tr>
						</tbody>
					  </table></td>
					</tr>
					<tr >
					  <td style="padding-left: 10px;padding-right: 10px">&nbsp;</td>
					</tr>
				  </tbody>
				</table>
	          </div>
				<!--<div style="break-after:page"></div>-->
				<!--<table width="800" border="0" cellspacing="0" cellpadding="5" align="left">
				  <tbody>
					<tr>
					  <td><span><span style="text-align: left"><?PHP //echo $supplier_vat_no; ?></span></span></td>
					</tr>
				  </tbody>
				</table>-->  
             
				<div class="signature-area" style="position: absolute; margin-bottom: 50px; width:100%; text-align:left;">
					<table class="tbl90" width="100%" border="0" cellspacing="0" cellpadding="5" align="left" style="margin-top: 50px;">
					  <tbody>
                       	<tr>
            			  <td><span><span style="text-align: left">For Sapphire Industries W.L.L  </span></span></td>
            			</tr>
						<!--<tr>-->
						<!--<td><strong>For Sapphire Industries</strong></td>-->
						<!--</tr>-->
						
						<!--<tr>-->
						<!--<td><strong><?php echo $approved_by; ?></strong></td>-->
						<!--<td><strong>Thomas Mammen</strong></td>-->
						<!--<td><strong>Licy</strong></td>-->
						<!--</tr>-->
						
						<!--<tr>-->
						<!--  <td><strong>Purchase Manager</strong></td>-->
						<!--  <td><strong>General Manager</strong></td>-->
						<!--  <td><strong>Executive Manager</strong></td>-->
						<!--</tr>-->
						
					  </tbody>
					</table>
				</div>
				</div>
					
				<div style="text-align:right; padding-right:30px; margin-top: 200px;">
				   <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
				   <input type="button" value="Print this page" onClick="window.print()" id="print_but">   
				</div>
			 
			</td>
		  </tr>
		</tbody>
		<tfoot>
		  <tr>
			<td>
			  <div class="page-footer-space"></div>
			</td>
		  </tr>
		</tfoot>
	</table>	
</page>	
	
</body>
</html>


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
