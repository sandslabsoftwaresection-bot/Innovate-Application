<?PHP 
require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
    
    $result = mysqli_query($conns,"select * from quotation_main_tbl  where 	quotation_number = '".$_GET['quotation_number']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $invoice_number = $row['quotation_number'];
        $invoice_date = date("m-d-Y", strtotime($row['quotation_created_date']));
        $company_name= $row['company_name'];
        $po_box = $row['po_box'];
        $telephone_no = $row['telephone_no'];
        $fax = $row['fax'];
        $address = $row['address'];
        $attn = $row['attn']; 
        $subject = $row['subject'];
        $quotation_reference = $row['quotation_reference']; 
        $LPO_no = $row['LPO_no'] ;
        $total_amount = $row['sub_total'] ;
        $received_by_id = $row['received_by_id'] ;
        $received_by_name = $row['received_by_name'] ;
        $description = $row['description'] ;
        
    } 
         
         
         
    function getCurrency($number)
    {
    $decimal = round($number - ($no = floor($number)), 3) * 1000;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? ". " . ($words[$decimal / 100] . " " . $words[$decimal / 10]. " " . $words[$decimal % 10]) . ' ' : '';
    return ucwords(($Rupees ? $Rupees . ' ' : ' ') . $paise);
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
  height: 29.7cm; 
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
    width: 681px;
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
	        <td align="right"><strong style="font-size: 22px">QUOTATION</strong></td>
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
	                    <td width="50%" align="left" valign="top">Quotation NO</td>
	                    <td width="50%" align="left" ><strong><?PHP echo $invoice_number; ?></strong></td>
                      </tr>
	                  <tr>
	                    <td>Date</td>
	                    <td><?PHP echo $invoice_date; ?></td>
                      </tr>
	                  <tr>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
                      </tr>
	                  <tr>
	                    <td>&nbsp;</td>
	                    <td>&nbsp;</td>
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
	          
      
	        <td colspan="2" align="left" valign="middle" bgcolor="#F0F0F0">Subject : <strong><?PHP echo $subject; ?></td>
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
                 $result = mysqli_query($conns,"select * from quotation_child_tbl where quotation_no = '".$_GET['quotation_number']."'");
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
	              <td colspan="6" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="5">
	                <tbody>
	                  <tr >
	                    <td colspan="2"><p>Bahraini Dinars: <?PHP echo getCurrency(number_format($amt,3));?> Only</p></td>
	                    
                      </tr>
	                  <tr >
	                    <td colspan="2"><strong>PAYMENT </strong></td>
                      </tr>
	                  <tr >
	                    <td colspan="2" style="text-align: center"><strong>TERMS & CONDITIONS </strong></td>
                      </tr>
	                  <tr >
	                    <td colspan="2" ><?PHP echo $description;?></td>
                      </tr>
                    </tbody>
                  </table></td>
                </tr>
                
                
               
                
                
                
                
              </tbody>
            </table></td>
          </tr>
        </tbody>
      </table>
	
	
  <footer>
<!--
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tbody>
    	            <tr>
    	              <td colspan="6" align="center"><small>Make all cheques payable to Company Name </small><br></td>
                    </tr>
    	            <tr>
    	              <td colspan="6" align="center" bgcolor="#E7E7E7"><strong>Thank you for your business!</strong></td>
                    </tr>
                </tbody>
                </table>
-->
  </footer>	
	
</page>


</body>
</html>
