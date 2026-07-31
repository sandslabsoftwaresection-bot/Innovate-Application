<?PHP 
require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();

    
    $result = mysqli_query($conns,"select * from receipts where	receipts_no = '".$_GET['receipts_no']."'");
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
   
    $paise = ($decimal > 0) ? ". " . ($words[$decimal / 100] . " " . $words[substr($decimal, 1) / 10]. " " . $words[$decimal % 10]) . ' ' : '';
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
  background-color: #ffffff;
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
    height: 29.7cm;
  }
  header,
  footer {
    position: fixed;
    left: 0;
    right: 0;
    background-color: #ffffff;
    padding-right: 1.5cm;
    padding-left: 1.5cm;
  }
}
	
	body,td,th {
	    
   
     font-family:  "Times New Roman";
    font-style: normal;
    font-size: 12px;
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
	        <td align="left" ><img src="../../httpdocs/images/company_profile_image/<?PHP echo $print_logo;?>" width="238" height="49" alt=""/></td>
	        <td align="right" style="font-family:  'Century Gothic';font-size: 16px"<strong ><h2>RECEIPT</h2>
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
	              
	              <td align="left" valign="middle" style="text-align: center">Cash                 </td>
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
	              <td colspan="9" align="left" valign="middle" style="padding-left: 10px;">The Sum of BD. <strong><?PHP echo getCurrency($sum_of_amount);?> Only</strong></td>
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
	              <td colspan="2" align="left" valign="middle" style="text-align: left;font-size:20px">Amount BD : <strong><?PHP echo number_format($total_amount,3);?></strong></td>
                </tr>
                <tr>
	              <td colspan="9" align="left" valign="middle" style="padding-left: 10px;">Inwords : <b><?PHP echo getCurrency($total_amount);?></b> Only</td>
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
	
	
 <footer>
    <hr>
     <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                     <tbody>
                        <tr style="text-align:middle; border-bottom:">
                          <td colspan="2" align="center" valign="middle" style="padding-top:5px;">
						
							<?PHP echo $print_companynamne;?>,
                            <?PHP echo $print_address;?>,
                            <?PHP echo " , Tele : ".$print_tele." , FAX : ".$print_fax." , Email : ".$print_email;?><br>      
							
							</td>
                        </tr>
                        <tr>
                          <td width="50%"><br>
                          
                          </td>
                          <td width="50%"></td>
                        </tr>
                      </tbody>
                    </table>
</footer>
	
</page>


</body>
</html>
