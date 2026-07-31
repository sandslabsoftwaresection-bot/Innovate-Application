<?

require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();

    
    $result = mysqli_query($conns,"select * from receipts where	receipts_no = '".$_GET['receipts_no']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $receipts_no = $row['receipts_no'];
        $receipts_date = date("d-m-Y H:i:s A", strtotime($row['receipts_date']));
        $receipts_method = $row['receipts_method'];
        $received_from = $row['received_from'];
        $sum_of_amount = $row['sum_of_amount'];
        $cheque_no = $row['cheque_no'];
        $bank = $row['bank'];
        $cheque_date = date("d-m-Y", strtotime($row['cheque_date'])); 
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
<title>Receipt <?php echo ' - '.$receipts_no?></title>
	<style type="text/css">
	
	
	body {
  /*background: rgb(204,204,204); */
  counter-reset: section;    
}

?>
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
  body {
    /*margin-top: 3cm;*/
    /*margin-left: 0;*/
    /*margin-right: 0;*/
    /*height: auto;*/
    /*box-shadow: 0;*/
    
 
  }
 
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
  
   #export_excel_but{display: none;}
   #print_but{display: none;}
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

 
</style>
</head>

<body>
<page size="A4">
<table width="800" border="0" cellspacing="0" cellpadding="15" align="center" id="main_table">
  <tbody>
    <tr>
      <td width="190" valign="middle" style="text-align: right;">&nbsp;</td>
      <td width="570" align="right">
          <table width="370px"  cellspacing="0" cellpadding="5" align="right">
        <tbody>
          <tr >
            <td align="right" valign="top" bgcolor="#0079DD" style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';">PAYMENT VOUCHER </td>
          </tr>
        </tbody>
      </table></td>
      </tr>
    <tr >
        <td colspan="2" align="left" valign="middle" style="text-align: center">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr style="border-bottom:1pt solid black;">
              <td style="text-align: left;border-bottom:1pt solid black;">Voucher No : <strong><?PHP echo $receipts_no; ?></td>
              <td style="text-align: center;border-bottom:1pt solid black;">Cash</td>
              <td style="text-align: center;border-bottom:1pt solid black;"><input type="checkbox" name="checkbox" id="checkbox" <?PHP if(trim($receipts_method)=='Cash'){echo 'checked';}else {echo 'disabled';}?>></td>
              <td style="text-align: right;border-bottom:1pt solid black;">Cheque </td>
              <td style="text-align: center;border-bottom:1pt solid black;"><input type="checkbox" name="checkbox2" id="checkbox2" <?PHP if(trim($receipts_method)=='Cheque'){echo 'checked';}else {echo 'disabled';}?>></td>
              <td style="text-align: right;border-bottom:1pt solid black;">Transfer </td>
              <td style="text-align: center;border-bottom:1pt solid black;"><input type="checkbox" name="checkbox3" id="checkbox3" <?PHP if(trim($receipts_method)=='Transfer'){echo 'checked';}else {echo 'disabled';}?>></td>
              <td style="text-align: right;border-bottom:1pt solid black;">
				Date : <strong><?PHP echo $receipts_date; ?>
				</td>
            </tr>
          </tbody>
        </table></td>
      </tr>
          <tr>
            <td align="left" valign="left" >
		    Received with thanks from :</td>
            <td align="left" valign="left" style="text-align: left;border-bottom:1pt solid black;"><strong><?PHP echo $received_from;?></strong></td>
          </tr>
          <tr>
            <td align="left" valign="left" >
			  
		    The Sum of BD.</td>
            <td align="left" valign="left" style="text-align: left;border-bottom:1pt solid black;"><strong><?PHP 
            
              $splitamount = explode('.',($total_amount));
          
            if(intval($splitamount[1])<=0 )
            {
                 echo getCurrency($splitamount[0]).' only';
            }
            else
            {
                 echo getCurrency($splitamount[0]).'1000/'.$splitamount[1].' fills only';
            }
           // echo getCurrency($sum_of_amount);?> </strong></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="left" style="text-align: left;padding-left:0px;padding-right:0px;border-bottom:1pt solid black;"><table width="100%" border="0" cellspacing="10" cellpadding="5">
              <tbody>
                <tr>
                  <td width="17%" >By Cheque No/ TRF : </td>
                  <td width="20%" style="border-bottom:1pt solid black;"><?PHP echo $cheque_no;?></td>
                  <td width="14%" >Bank :</td>
                  <td width="21%" style="border-bottom:1pt solid black;"><?PHP echo $bank;?></td>
                  <td width="12%">Date : </td>
                  <td width="16%" style="border-bottom:1pt solid black;"><?PHP echo $cheque_date;?></td>
                </tr>
                <tr >
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="5" >
                    <tbody>
                      <tr>
                        <td width="24%" style="padding-left:0px;">The Sum of BD.</td>
                        <td width="76%" style="border-bottom:1pt solid black;"><strong><?PHP 
                         $splitamount = explode('.',($total_amount));
          
                        if(intval($splitamount[1])<=0 )
                        {
                             echo getCurrency($splitamount[0]).' only';
                        }
                        else
                        {
                             echo getCurrency($splitamount[0]).'1000/'.$splitamount[1].' fills only';
                        }
                        
                        //echo getCurrency($sum_of_amount);?> </strong></td>
                      </tr>
                    </tbody>
                  </table>
                 </td>
                </tr>
                <tr style="border-bottom:1pt solid black;">
                  <td colspan="6"></td>
                </tr>
                <tr>
                  <td>Received : </td>
                  <td style="border-bottom:1pt solid black;"><?PHP echo $received_by;?></td>
                  <td>Verified : </td>
                  <td style="border-bottom:1pt solid black;"><?PHP echo $verified_by;?></td>
                  <td>Amount BD :</td>
                  <td style="border-bottom:1pt solid black;"><strong><?PHP echo number_format($total_amount,3);?></strong></td>
                </tr>
                <tr>
                  <td>Signature : </td>
                  <td style="border-bottom:1pt solid black;"></td>
                  <td>Signature : </td>
                  <td style="border-bottom:1pt solid black;"></td>
                  <td></td>
                  <td></td>
                </tr>
                <!--<tr>
                  <td colspan="6">Inwords : <b><?PHP //echo getCurrency($total_amount);?></b> Only</td>
                </tr>-->
                <tr >
                  <td colspan="6" style="padding-top:20px;" >Cheque Payment: This is Valid on realization of Cheque.</td>
                </tr>
              </tbody>
            </table></td>
          </tr>
         
    </tbody>
  </table>
		
		
		
		
	  </td>
    </tr>
  <tr >
      <td style="padding-left: 10px;padding-right: 10px">&nbsp;</td>
  </tr>

  <!--<div style="break-after:page"></div>-->
<table width="800" border="0" cellspacing="0" cellpadding="5" align="center">
  <tbody>
    
  </tbody>
</table>
 
       
 
</page>

</body>
       <div style="text-align:right;padding-right:30px;">
           <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
           <input type="button" value="Print this page" onClick="window.print()" id="print_but">
            
        </div>
</html>


<script>
function fnExcelReport()
{
	var no = "<?php echo $receipts_no; ?>";
	var filename = "Receipt - "+no+".xls";
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
        sa=txtArea1.document.execCommand("SaveAs",true,"quotation.xlsx");
    }  
    else                 //other browser not tested on IE 11
  var link = document.createElement('a');
  link.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tab_text);
  link.download = filename;
  link.click();
  return (link);
}


</script>