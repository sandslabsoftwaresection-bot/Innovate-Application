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
<title>Quotation </title>
	<style type="text/css">
	
	
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
    /*font-family: Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace;*/
    font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
    font-style: normal;
    font-size: 14px;
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
</style>
</head>

<body>
<page size="A4">
<table width="800" border="0" cellspacing="0" cellpadding="5" align="center">
  <tbody>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px"><table width="800" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td width="50%" align="left" valign="top"><img src="logo.png" width="238" height="49" alt=""/><br>
              PO Box - 1234, Tel - 45225866, Fax 1254455, care@yourcompanyname.com</td>
            <td align="left" valign="top" ><table width="370px"  cellspacing="0" cellpadding="5">
              <tbody>
                <tr >
                  <td style="text-align: center; color: #FFFFFF; font-size: 20px;" bgcolor="#0079DD">QUOTATION</td>
                </tr>
                <tr>
                  <td>Quotation No : <strong><?PHP echo $invoice_number; ?></strong></td>
                </tr>
                <tr>
                  <td>Date : <strong><?PHP echo $invoice_date; ?></strong></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left" valign="top">TO,<br>
              <strong><?PHP echo $company_name; ?> </strong><br>
              PO Box : <?PHP echo $po_box; ?>, <br>
              Manama, Kingdom of Bahrain<br>
              Tele : <?PHP echo $telephone_no; ?><br>
              Fax : <?PHP echo $fax; ?></td>
            <td align="left" valign="top">
            <table width="370px"  cellspacing="0" cellpadding="5">
              <tbody>
                 <tr>
                  <td>Attn : <strong><?PHP echo $attn; ?></strong></td>
                </tr>
                <tr>
                  <td>Project : <strong>Villa Project for Govt Employees.</strong></td>
                </tr>
                <tr>
                  <td>Subject : <strong><?PHP echo $subject; ?></strong></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
        </tbody>
      </table>
		
		
		
		
	  </td>
    </tr>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px"><table width="773px" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;"><strong >SL No</strong></td>
            <td bgcolor="#0079DD"><strong style="color: #FFFFFF">Description</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;"><strong>Qty</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;"><strong>Unit</strong></td>
            <td bgcolor="#0079DD" style="text-align: right; color: #FFFFFF;"><strong>Rate (BD)</strong></td>
            <td bgcolor="#0079DD" style="text-align: right; color: #FFFFFF;"><strong>Amount (BD)</strong></td>
          </tr>
          <?PHP 
                $ctr = 1;
                $amt=0;
                 $result = mysqli_query($conns,"select * from quotation_child_tbl where quotation_no = '".$_GET['quotation_number']."'");
                     while($row=mysqli_fetch_assoc($result)) {
                ?>
          <tr>
            <td style="text-align: center"><?PHP echo $ctr;?></td>
            <td><?PHP echo $row['description'];?></td>
            <td style="text-align: center"><?PHP echo $row['quantity'];?></td>
            <td style="text-align: center"><?PHP echo $row['unit'];?></td>
            <td style="text-align: right"><?PHP echo $row['rate'];?></td>
            <td style="text-align: right"><?PHP echo $row['amount']; $amt = floor($amt) + floor($row['amount']);?></td>
          </tr>
          <?PHP 
	            $ctr = $ctr +1;
	            } ?>
         
          <tr>
            <td style="text-align: center">&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
            <td bgcolor="#E7E7E7" style="text-align: right"><strong>Sub Total</strong></td>
            <td bgcolor="#E7E7E7" style="text-align: right"><strong><?PHP echo number_format($amt,3);?></strong></td>
          </tr>
          <tr>
            <td colspan="6" style="text-align: left">Bahraini Dinars: <?PHP echo getCurrency(number_format($amt,3));?> Only</td>
            </tr>
          <tr>
            <td colspan="6" style="text-align: left;text-decoration: underline;"><strong>PAYMENT</strong></td>
            </tr>
          <tr>
            <td colspan="6" style="text-align: center;text-decoration: underline;"><strong>TERMS &amp; CONDITIONS</strong></td>
            </tr>
          <tr>
            <td colspan="6" style="text-align: left"><?PHP echo $description;?></td>
            </tr>
          <tr>
            <td style="text-align: center">&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
            <td style="text-align: center">&nbsp;</td>
            <td style="text-align: right">&nbsp;</td>
            <td style="text-align: right">&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
</page>
</body>
</html>
