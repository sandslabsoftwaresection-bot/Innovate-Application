<?php
require ('../../model/common/common_functions.php');

 $db_con = new DBConnection();
 $conns = $db_con->ConnectToMYSQL();
   
    $main_table = mysqli_query($conns, "SELECT * FROM purchase_received_main_tbl WHERE prd_no = '".$_GET['pur_recie_number']."'");
    while($rows = mysqli_fetch_assoc($main_table)) 
	{
        $invoice_number = $rows['prd_no'];
        $invoice_date = date("m-d-Y", strtotime($rows['default_date']));
		$supplier_id = $rows['supplier_id'];
        $supplier_name= $rows['supplier_name'];
		$work_order_id = $rows['work_order_id'];
        $work_order_no = $rows['work_order_no']; 
		$purchase_req_no = $rows['purchase_req_no'];
        $purchase_recieve_date = $rows['purchase_recieved_date'];
        $job_location = $rows['job_location'];
		$requested_by = $rows['requested_by'];
		$approved_by = $rows['approved_by'];
		$lpo_no = $rows['lpo_no'];
		$bill_no = $rows['bill_no'];
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
		$city = $row_supplier['city'];
		$country = $row_supplier['country'];
    }
    
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Purchase Recieved <?php echo  ' - '.$invoice_number;?> </title>
<!-- favicons -->
    <link rel="apple-touch-icon" href="../../../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png">
    <link rel="icon" href="../../../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png">
	<style type="text/css">
	
	
	body {
  /*background: rgb(204,204,204); */
  counter-reset: section;    
}


page {
  position: relative;
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
 /* box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);*/
}
page[size="A4"] {  
  width: 22cm;
  height: 29.7cm; 
}
page[size="A4"][layout="portrait"] {
  margin-top: 1.5cm;
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="portrait"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="portrait"] {
  width: 21cm;
  height: 14.8cm;  
}

header,
footer {
    position: absolute;
    left: 0;
    right: 0;
    
    background-color: transparent;
    padding-right: 1.5cm;
    padding-left: 1.5cm;
    width: 100%;
}
header:after{
  /*content: "Header";*/
}
footer:after{
  /*content: "Footer";*/
}

header {
  top: 0;
  padding-top: 5mm;
  padding-bottom: 3mm;
}
footer {
  bottom: 0;
  color: #000;
  padding-top: 3mm;
  padding-bottom: 5mm;
}


@page { margin-top: 3.81cm ;} /* All margins set to 2cm */


@page :first {
 margin-top: 3.81cm    /* Top margin on first page 10cm */
}
@media print {
 
 
  header,
  footer {
    position: fixed;
    margin-top: 100px;
    left: 0;
    right: 0;
    background-color: transparent;
    padding-right: 1.5cm;
    padding-left: 1.5cm;
  }
   body {margin: 0;font-size: 16px;font-family: "Times New Roman"}
}
	
body,td,th {
    /*font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;*/
    font-family: "Times New Roman", times , Verdana, sans-serif;
    font-style: normal;
    font-size: 16px;
    color: #000000;
    text-align: left;
}
	
	#rcorners2 {
  border-radius: 25px;
  border: 1px solid #646464;
  padding: 5px;
  width: 800px;
 
}
	
tr td img {
    text-align: center;
}

tr.border_bottom td {
  border-bottom: 1px solid black;
}
@media print {
  #print_but,#export_excel_but {
    display: none;
  }
  .signature-area{
         position: absolute;
         bottom: 70px;
	}
}

 
</style>
</head>

<body>
<page size="A4">
 <table width="800" border="0" cellspacing="0" cellpadding="5" align="center" id="main_table">
  <tbody>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">
          
    <table width="800" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td width="50%" align="left" valign="top" style="padding-bottom: 0px;"></td>
            <td align="left" valign="top" >
				<table width="370px"  cellspacing="0" cellpadding="5">
				  <tbody>
					<tr >
					  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">PURCHASE RECIEVED</td>
					</tr>
					
				  </tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td align="left" valign="top" style="padding-top: 0px;"><p>
			    <table cellspacing="0" cellpadding="5">
					<tbody>
					   <tr>
						  <td><strong><?PHP echo $supplier_name; ?></strong>,</td>
					   </tr>
					   <tr>
						   <td><strong>PO Box : <?PHP echo $city; ?>,</strong></td>
						</tr>
					   <tr>
						  <td><strong>TEL : <?PHP echo $contact_phone; ?></strong></td>
					   </tr>
					   <tr>
						   <td><strong>FAX : <?PHP echo $fax; ?></strong></td>
						</tr>
						<tr>
						   <td><strong>City : <?PHP echo $city; ?></strong></td>
						</tr>
						<tr>
						   <td><strong>Country : <?PHP echo $country; ?></strong></td>
						</tr>
					</tbody>
				</table>
					<!--<strong><?PHP //echo $supplier_name; ?></strong>,<br>
					<strong><?PHP //echo $contact_address; ?></strong><br>-->
				</p>
            </td>
            <td align="right" valign="top">
			    <table width="370px"  cellspacing="0" cellpadding="5">
					  <tbody style="float: right;">
						<tr>
						  <td>PRD No : <strong><?PHP echo $invoice_number; ?></strong></td>
						</tr>
						<tr>
						  <td>Date : <strong><?PHP echo $invoice_date; ?></strong></td>
						</tr>
						<tr>
						  <td>Job Location : <strong><?PHP echo $job_location; ?></strong></td>
						</tr>
						<tr>
						  <td>Requested by : <strong><?PHP echo $requested_by; ?></strong></td>
						</tr>
						<tr>
						  <td>LPO No : <strong><?PHP echo $lpo_no; ?></strong></td>
						</tr>
						<tr>
						  <td>PR No : <strong><?PHP echo $purchase_req_no; ?></strong></td>
						</tr>
						<tr>
						  <td>Bill No : <strong><?PHP echo $bill_no; ?></strong></td>
						</tr>
					  </tbody>
                </table>
			</td>
          </tr>
        </tbody>
    </table>
		
		
		
		
	  </td>
    </tr>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">
          
    <table width="795px" border="0" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
        <tbody>
          <tr>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px;"><strong >SL</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px;"> <strong>Description</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px;"><strong>Qty</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px;"><strong>Unit</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px;"><strong>Rate</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px;"><strong>Tax (VAT)</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:30px;"><strong>Amount</strong></td>
          </tr>
          <?PHP 
                $ctr = 1;
                $amt=0;
                $child_table = mysqli_query($conns, "SELECT * FROM purchase_recieved_child_tbl WHERE prd_no = '".$_GET['pur_recie_number']."'");
                    while($child_row=mysqli_fetch_assoc($child_table)) {
                         if($child_row['rate']=="" || $child_row['rate']=="0.000")
						 {
							
							$v_rate = '--'; 
							$v_tax = '--'; 
                            $v_amount = '--';							
						 }
						 else
						 {
							 $v_rate = $child_row['rate'];
							 $v_tax = $child_row['tax']."%";
							 $v_amount = $child_row['amount'];
						 }
                         if($ctr%2!=0)
                         {
                ?>
                          <tr style="border-bottom: 1px solid gray;">
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $ctr;?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $child_row['description']; ?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $child_row['quantity']; ?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $child_row['unit']; ?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo number_format($v_rate,3); ?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $v_tax; ?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo number_format($v_amount,3); $amt = $amt+$v_amount; ?></td>
                          </tr>
                    <?PHP 
					} else {
                    ?>
                        <tr style="border-bottom: 1px solid gray;">
                            <td  bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $ctr;?></td>
                            <td  bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $child_row['description']; ?></td>
                            <td  bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $child_row['quantity']; ?></td>
                            <td  bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $child_row['unit']; ?></td>
                            <td  bgcolor="#f2f2f2" style="text-align: center"><?PHP echo number_format($v_rate ,3); ?></td>
                            <td  bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $v_tax; ?></td>
                            <td  bgcolor="#f2f2f2" style="text-align: center"><?PHP echo number_format($v_amount,3); $amt = $amt+$v_amount; ?></td>
                        </tr>
                    <?PHP } ?>
                          
          <?PHP 
          
			$ctr = $ctr +1;
			} ?>
           <tr style="border-bottom: 1px solid gray;">
				<td style="text-align: center">&nbsp;</td>
				<td colspan="4" style="text-align: right"> <strong>Total Amount</strong></td>
				<td style="text-align: right" colspan="2"><strong><?PHP echo number_format($amt,3); ?></strong></td>
           </tr>
        </tbody>
    </table></td>
    </tr>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">&nbsp;</td>
    </tr>
  </tbody>
</table>


	<div class="signature-area">
		<table width="1000" border="0" cellspacing="0" cellpadding="5" align="left" style="margin-top: 50px;">
		  <tbody>
			<tr>
			<td><strong>Approved by</strong></td>
			</tr>
			
			<tr>
				<td><strong><?php echo $approved_by; ?></strong></td>
				<!--<td><strong>Thomas Mammen</strong></td>
				<td><strong>Licy</strong></td>-->
			</tr>
			
			<tr>
			  <td><strong>Purchase Manager</strong></td>
			  <!--<td><strong>General Manager</strong></td>
			  <td><strong>Executive Manager</strong></td>-->
			</tr>
			
		  </tbody>
		</table>
	</div>

<div style="text-align:right; padding-right:30px; margin-top: 200px;">
   <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
   <input type="button" value="Print this page" onClick="window.print()" id="print_but">   
</div>
 
 
 
</page>

</body>

</html>


<script>
function fnExcelReport()
{
	var pr = "<?php echo $invoice_number;  ?>";
	var filename = "purchase recieve - "+pr+".xls";
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


</script>	