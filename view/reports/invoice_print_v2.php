<?PHP 
require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
    
    $result = mysqli_query($conns,"select * from invoice_main_tbl where 	invoice_number = '".$_GET['invoice_number']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $invoice_number = $row['invoice_number'];
        $invoice_date = date("m-d-Y", strtotime($row['invoice_date']));
        $company_name= $row['company_name'];
        $po_box = $row['po_box'];
        $telephone_no = $row['telephone_no'];
        $fax = $row['fax'];
        $address = $row['address'];
        $attn = $row['attn']; 
        $quotation_reference = $row['quotation_reference']; 
        $LPO_no = $row['LPO_no'] ;
        $vat = $row['vat'] ;
        $total_amount = $row['total_amount'] ;
        $received_amount = $row['received_amount'] ;
        $balane_in_due = $row['balane_in_due'] ;
        $received_by_id = $row['received_by_id'] ;
        $received_by_name = $row['received_by_name'] ;
        
        
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
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {
    width: 20cm;
    height: 28.8cm;
    padding-top: 20px;
    padding-left: 10px;
    padding-right: 10px;
    padding-bottom: 20px;
	
    text-align: right;
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
 
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}

	
	body,td,th {
    font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;
    font-style: normal;
    font-size: 14px;
    color: #000000;
    border-bottom: 1px solid #7F7F7F;
}
    tbody tr td {
    border-bottom-style: solid;
}
    </style>
<title>Invoice Printing</title>
</head>

<body>
	 
     
	
	<page size="A4">
	  <table width="100%" border="0" cellpadding="5" cellspacing="0">
	    <tbody>
	      <tr>
	        <td align="left" style=""><img src="logo.png" width="238" height="49" alt=""/></td>
	        <td align="right"><strong style="font-size: 22px">INVOICE</strong></td>
          </tr>
	      <tr>
	        <td align="left" bgcolor="#E8E8E8">PO Box - 1234, Tel - 45225866, Fax 1254455, care@yourcompanyname.com</td>
	        <td bgcolor="#E8E8E8">&nbsp;</td>
          </tr>
	      <tr>
	        <td colspan="2" style='padding:1px'><table width="100%" border="0" cellspacing="0" cellpadding="0">
	          <tbody>
	            <tr>
	              <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
	                <tbody>
	                  <tr>
	                    <td width="31%">Company Name</td>
	                    <td width="69%"><?PHP echo $company_name; ?></td>
                      </tr>
	                  <tr>
	                    <td>PO Box</td>
	                    <td><?PHP echo $po_box; ?></td>
                      </tr>
	                  <tr>
	                    <td>Tele</td>
	                    <td><?PHP echo $telephone_no; ?></td>
                      </tr>
	                  <tr>
	                    <td>Fax</td>
	                    <td><?PHP echo $fax; ?></td>
                      </tr>
	                  <tr>
	                    <td colspan="2">Manama, Kingdom of Bahrain</td>
                      </tr>
                    </tbody>
                  </table></td>
	              <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
	                <tbody>
	                  <tr>
	                    <td width="50%" align="left" valign="top">Invoice NO</td>
	                    <td width="50%" align="left" ><strong><?PHP echo $invoice_number; ?></strong></td>
                      </tr>
	                  <tr>
	                    <td>Date</td>
	                    <td><?PHP echo $invoice_date; ?></td>
                      </tr>
	                  <tr>
	                    <td>Quotation Ref</td>
	                    <td><?PHP echo $quotation_reference; ?></td>
                      </tr>
	                  <tr>
	                    <td>LPO No</td>
	                    <td><?PHP echo $LPO_no; ?></td>
                      </tr>
	                  <tr>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
                      </tr>
                    </tbody>
                  </table></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
	      <tr>
	          
      
	        <td colspan="2" align="left" valign="middle" bgcolor="#F0F0F0">Attention : <strong><?PHP echo $attn; ?></strong></td>
          </tr>
	      <tr>
	        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="5">
	          <tbody>
	            <tr>
	              <td width="8%" bgcolor="#DBDBDB"><strong>SL No</strong></td>
	              <td width="32%" align="left" valign="middle" bgcolor="#DBDBDB"><strong>Description</strong></td>
	              <td width="9%" align="center" valign="middle" bgcolor="#DBDBDB"><strong>Qty</strong></td>
	              <td width="10%" align="center" valign="middle" bgcolor="#DBDBDB"><strong>Unit</strong></td>
	              <td width="20%" align="right" bgcolor="#DBDBDB"><strong>Rate (BD)</strong></td>
	              <td width="21%" align="right" bgcolor="#DBDBDB"><strong>Amount (BD) </strong></td>
                </tr>
                
                <?PHP 
                $ctr = 1;
                $amt=0;
                 $result = mysqli_query($conns,"select * from invoice_child_tbl where invoice_no = '".$_GET['invoice_number']."'");
                     while($row=mysqli_fetch_assoc($result)) {
                ?>
                
	            <tr>
	              <td align="center"><?PHP echo $ctr;?></td>
	              <td align="left" valign="middle"><?PHP echo $row['description'];?></td>
	              <td align="center" valign="middle"><?PHP echo $row['quantity'];?></td>
	              <td align="center" valign="middle"><?PHP echo $row['unit'];?></td>
	              <td align="right"><?PHP echo $row['rate'];?></td>
	              <td align="right"><?PHP echo $row['amount'];
	              
	              $amt = floor($amt) + floor($row['amount']);
	              ?></td>
                </tr>
                
	            <?PHP 
	            $ctr = $ctr +1;
	            } ?>
	            <tr>
	              <td align="center" bgcolor="#ECECEC">&nbsp;</td>
	              <td bgcolor="#ECECEC">&nbsp;</td>
	              <td align="center" valign="middle" bgcolor="#ECECEC">&nbsp;</td>
	              <td align="center" valign="middle" bgcolor="#ECECEC">&nbsp;</td>
	              <td align="right" bgcolor="#ECECEC"><strong>Sub Total</strong></td>
	              <td align="right" bgcolor="#ECECEC"><strong><?PHP echo number_format($amt,3);?></strong></td>
                </tr>
                
         
	            <tr>
	              <td align="center">&nbsp;</td>
	              <td>&nbsp;</td>
	              <td align="center" valign="middle">&nbsp;</td>
	              <td align="center" valign="middle">&nbsp;</td>
	              <td align="right">VAT%</td>
	              <td align="right"><?PHP echo $vat;?>%</td>
                </tr>
	            <tr>
	              <td align="center" bgcolor="#ECECEC">&nbsp;</td>
	              <td bgcolor="#ECECEC">&nbsp;</td>
	              <td align="center" valign="middle" bgcolor="#ECECEC">&nbsp;</td>
	              <td align="center" valign="middle" bgcolor="#ECECEC">&nbsp;</td>
	              <td align="right" bgcolor="#ECECEC"><strong>Total Amount</strong></td>
	              <td align="right" bgcolor="#ECECEC"><strong><?PHP $k=number_format($amt,3)*($vat/100);$k=$k+ number_format($amt,3);echo number_format($k,3)//$total_amount;?></strong></td>
                </tr>
	            <tr>
	              <td align="center">&nbsp;</td>
	              <td>&nbsp;</td>
	              <td align="center" valign="middle">&nbsp;</td>
	              <td align="center" valign="middle">&nbsp;</td>
	              <td align="right">Received Amount </td>
	              <td align="right"><?PHP echo $received_amount;?></td>
                </tr>
	            <tr>
	              <td align="center" bgcolor="#ECECEC">&nbsp;</td>
	              <td bgcolor="#ECECEC">&nbsp;</td>
	              <td align="center" valign="middle" bgcolor="#ECECEC">&nbsp;</td>
	              <td align="center" valign="middle" bgcolor="#ECECEC">&nbsp;</td>
	              <td align="right" bgcolor="#ECECEC"><strong>Balance in Due</strong></td>
	              <td align="right" bgcolor="#ECECEC"><strong><?PHP echo number_format((number_format($k,3)-$received_amount),3);?></strong></td>
                </tr>
	            <tr>
	              <td colspan="6" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="5">
	                <tbody>
	                  <tr>
	                    <td width="50%"><p>For, Sapphire industries Co</p>
                        <p>&nbsp;</p>
                        <p>Signature  </p></td>
	                    <td width="50%" align="left" valign="top">Received,  <br>
	                      <br>
                        Signature   <br>
                        <br>
                        Name ______________________________________</td>
                      </tr>
                    </tbody>
                  </table></td>
                </tr>
	            <tr>
	              <td colspan="6" align="center"><small>Make all cheques payable to Company Name </small><br></td>
                </tr>
	            <tr>
	              <td colspan="6" align="center" bgcolor="#E7E7E7"><strong>Thank you for your business!</strong></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
        </tbody>
      </table>
	
	
	
	
</page>


</body>
</html>
