<?PHP 
require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();

    
    $result = mysqli_query($conns,"select * from receipts where 	receipts_no = '".$_GET['receipts_no']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $receipts_no = $row['receipts_no'];
        $receipts_date = date("m-d-Y H:i:s A", strtotime($row['receipts_date']));
        $receipts_method = $row['receipts_method'];
        $received_from = $row['received_from'];
        $sum_of_amount = $row['sum_of_amount'];
        $cheque_no = $row['cheque_no'];
        $bank = $row['bank'];
        $cheque_date = date("m-d-Y", strtotime($row['cheque_date'])); 
        $invoice_id = $row['invoice_id']; 
        $received_by = $row['received_by'] ;
        $verified_by = $row['verified_by'] ;
        $total_amount = $row['total_amount'] ;
       
        
        
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
    }
         
                               
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<style>
	
body {
  background: rgb(204,204,204); 
}

page {
  position: relative;
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 9.9cm; 
}
page[size="A4"][layout="portrait"] {
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
  background-color: #ccc;
  padding-right: 1.5cm;
  padding-left: 1.5cm;
}
header:after{
  content: "Header";
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

@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
    height: 9.9cm;
  }
  header,
  footer {
    position: fixed;
    left: 0;
    right: 0;
    background-color: #ccc;
    padding-right: 1.5cm;
    padding-left: 1.5cm;
  }
}
	
	body,td,th {
	    
   // font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;
     font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
    font-style: normal;
    font-size: 14px;
    color: #000000;
    /*border-bottom: 1px solid #7F7F7F;*/
}
    tbody tr td {
    /*border-bottom-style: solid;*/
}
    </style>
<title>Recepit</title>
</head>

<body>
	 
     
	
	<page size="A4">
	  <table width="100%" border="0" cellpadding="5" cellspacing="0">
	    <tbody>
	      <tr>
	        <td align="left" style=""><img src="../../httpdocs/images/company_profile_image/<?PHP echo $print_logo;?>" width="238" height="49" alt=""/></td>
	        <td align="right" ><strong ><h2>RECEIPT</h2>
	        </strong></td>
          </tr>
	      <tr>
	        <td align="left" bgcolor="#0079DD" style="color: #FFFFFF;font-size:13px"><?PHP echo $print_companynamne.' , '.$print_address.' , Tele : '.$print_tele .' , FAX : '.$print_fax.', Email : '.$print_email;?></td>
	        <td bgcolor="#0079DD" style="color: #FFFFFF;">&nbsp;</td>
          </tr>
	      <tr>
	        <td colspan="2" style='padding:1px'><table width="100%" border="0" cellspacing="0" cellpadding="5">
	          <tbody>
	            <tr>
	              <td align="left" valign="middle" style="padding-left: 10px;">Receipt No</td>
	              <td align="left" valign="middle"><strong><?PHP echo $receipts_no;?></strong></td>
	              
	              <td align="left" valign="middle" style="text-align: center">CASH                  </td>
	              <td align="left" valign="middle" style="text-align: center"><input type="checkbox" name="checkbox" id="checkbox" <?PHP if(trim($receipts_method)=='Cash'){echo 'checked';}else {echo 'disabled';}?>></td>
	              <td align="left" valign="middle" style="text-align: center">Cheque                  </td>
	              <td align="left" valign="middle" style="text-align: center"><input type="checkbox" name="checkbox2" id="checkbox2" <?PHP if(trim($receipts_method)=='Cheque'){echo 'checked';}else {echo 'disabled';}?>></td>
	              <td align="left" valign="middle" style="text-align: center">Transfer                  </td>
	              <td align="left" valign="middle" style="text-align: center"><input type="checkbox" name="checkbox3" id="checkbox3" <?PHP if(trim($receipts_method)=='Transfer'){echo 'checked';}else {echo 'disabled';}?>></td>
	              <td align="left" valign="middle" style="text-align: right; padding-right: 10px;">Date: <strong><?PHP echo $receipts_date;?></strong></td>
                </tr>
	            <tr>
	              <td colspan="9" align="left" valign="middle" style="padding-left: 10px;">Received with thanks from : <strong><?PHP echo $received_from;?></strong></td>
                </tr>
	            <tr>
	              <td colspan="9" align="left" valign="middle" style="padding-left: 10px;">The Sum of BD. <strong>Two Thousand Only</strong></td>
                </tr>
	            <tr>
	              <td colspan="3" align="left" valign="middle" style="padding-left: 10px;">By Cheque No/ TRF : <?PHP echo $cheque_no;?> </td>
	              <td colspan="4" align="left" valign="middle" style="text-align: left">Bank : <?PHP echo $bank;?></td>
	              <td colspan="2" align="left" valign="middle" style="text-align: left">Date : <?PHP echo $cheque_date;?></td>
                </tr>
	            <tr>
	              <td colspan="9" align="left" valign="middle" style="padding-left: 10px;">Settlement of Invoice(s) : <strong><?PHP echo $invoice_id;?></strong></td>
                </tr>
	            <tr>
	              <td colspan="2" align="left" valign="middle" style="padding-left: 10px;">Received : <?PHP echo $received_by;?></td>
	              <td colspan="5" align="left" valign="middle" style="text-align: left">Verified : <?PHP echo $verified_by;?></td>
	              <td colspan="2" align="left" valign="middle" style="text-align: left;font-size:20px">Amount BD : <strong><?PHP echo $total_amount;?></strong></td>
                </tr>
	            <tr>
	              <td colspan="9" align="left" valign="middle" style="padding-left: 10px;">Cheque Payment: This is Valid on realization of Cheque. </td>
                </tr>
              </tbody>
            </table></td>
          </tr>
	      
	      <tr>
	        <td colspan="2">&nbsp;</td>
          </tr>
        </tbody>
      </table>
	
	
 
	
</page>


</body>
</html>
