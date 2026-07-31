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
        $received_other = $row['received_from_id'];
        $status = ($received_other == 0) ? 'Paid' : 'Received';
        $sum_of_amount = $row['sum_of_amount'];
        $cheque_no = $row['cheque_no'];
        $bank = $row['bank'];
        $cheque_date = date("d-m-Y", strtotime($row['cheque_date'])); 
        $invoice_id = $row['invoice_id']; 
        $received_by = $row['received_by'] ;
        $verified_by = $row['verified_by'] ;
        $total_amount = $row['total_amount'] ;
        $discription = isset($row['discription']) ? trim($row['discription']) : '';
        
        
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
            $hundred = ($counter == 1 && $str[0]) ? '  ' : null;
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
<title>Receipts <?php echo ' - '.$receipts_no;?></title>
<style>
	
/* Styles go here */

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
  page-break-after: always;
  text-align: center;
}

@page {
  margin: 15mm
}

@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   #export_excel_but{display: none;}
   #print_but{display: none;}
   body {margin: 0;font-size: 16px;font-family: "Times New Roman"}
}	
 
</style>
</head>

<body>
    <div class="page-header" style="text-align: center" align="center">
   
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody>
                        <tr style="text-align:left;">
                          <td width="36%" align="right" valign="top"><img src="../../httpdocs/images/company_profile_image/<?PHP echo $print_logo;?>" width="285" height="60" alt=""/></td>
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
                          
                            <?PHP echo "  Tele : ".$print_tele." , ". $print_address." , Manama , Kingdom of Bahrain "?><br>      
							<?PHP echo "  Email : ".$print_email. "     Web : www.sapphirebh.com";?>      
							
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

<page size="A4">
     
<table width="800" border="0" cellspacing="0" cellpadding="15" align="center">
    
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
      <td width="190" valign="middle" style="text-align: right;">&nbsp;</td>
      <td width="570" align="right">
          <table width="370px"  cellspacing="0" cellpadding="5" align="right">
        <tbody>
            <tr>
                <td >
                     <div style="text-align:right;padding-right:30px;">
                   <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
                   <!--<input type="button" value="Print this page" onClick="window.print()" id="print_but">-->
                    
    </div>
                </td>
            </tr>
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
            <td align="left" valign="top" ><?php echo $status; ?> with thanks from :</td>
            <td align="left" valign="top" style="text-align: left;">
                <div style="border-bottom: 1pt solid black; padding-bottom: 2px;"><strong><?PHP echo $received_from;?></strong></div>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top" >The Sum of BD.</td>
            <td align="left" valign="top" style="text-align: left;"><div style="border-bottom: 1pt solid black; padding-bottom: 2px;"><strong><?PHP 
                 $splitamount = explode('.',($total_amount));
              
                if(intval($splitamount[1])<=0 )
                {
                     echo getCurrency($splitamount[0]).' only';
                }
                else
                {
                     echo getCurrency($splitamount[0]).'1000/'.$splitamount[1].' fills only';
                }
                //echo getCurrency($total_amount);?> </strong></div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="left" valign="left" style="text-align: left;padding-left:0px;padding-right:0px;border-bottom:1pt solid black;"><table width="100%" border="0" cellspacing="10" cellpadding="5">
              <tbody>
                <tr>
                  <td align="left" valign="top" width="22%">By Cheque No/ TRF : </td>
                  <td align="left" valign="top" style="text-align: left; border-bottom: 1pt solid black; padding-bottom: 2px" width="20%"><?PHP echo $cheque_no;?></td>
                  <td align="left" valign="top" style="text-align: right;">Bank :</td>
                  <td align="left" valign="top" style="text-align: left; border-bottom: 1pt solid black; padding-bottom: 2px" width="20%"><?PHP echo $bank;?></td>
                  <td align="left" valign="top" style="text-align: right;">Date : </td>
                  <td align="left" valign="top" style="text-align: left; border-bottom: 1pt solid black; padding-bottom: 2px" width="20%"><?PHP echo $cheque_date;?></td>
                </tr>
                <tr >
                  <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="5" >
                    <tbody>
                      <tr>
                        <td  align="left" valign="top" width="26%" style="text-align: left; padding-left: 0; margin: 0;">The Sum of BD.</td>
                        <td align="left" valign="top" style="text-align: left;">
                        <div style="border-bottom: 1pt solid black; padding-bottom: 2px;"><strong><?PHP
                         $splitamount = explode('.',($total_amount));
                          
                            if(intval($splitamount[1])<=0 )
                            {
                                 echo getCurrency($splitamount[0]).' only';
                            }
                            else
                            {
                                 echo getCurrency($splitamount[0]).'1000/'.$splitamount[1].' fills only';
                            }
                       // echo getCurrency($sum_of_amount);?> </strong></div></td>
                      </tr>
                    </tbody>
                  </table>
                 </td>
                </tr>
                
                <?php if ($discription !== ''): ?>
                    <tr>
                        <td colspan="6">
                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                <tbody>
                                    <tr>
                                        <td align="left" valign="top" style="text-align: left; padding-left: 0; margin: 0;">Notes :</td>
                                        <td align="left" valign="top" width="74%" style="text-align: left;"><div style="border-bottom: 1pt solid black; padding-bottom: 2px;">
                                            <?php echo htmlspecialchars($discription, ENT_QUOTES, 'UTF-8'); ?></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td align="left" valign="top"></td>
                </tr>
                
                <tr style="border-bottom:1pt solid black;" height="10%">
                  <td colspan="6"></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tbody>
                                <tr>
                                  <td align="left" valign="top" style="text-align: left; padding-left: 0; margin: 0;">Received : </td>
                                  <td align="left" valign="top" style="text-align: left; border-bottom: 1pt solid black; padding-bottom: 2px" width="20%"><?PHP echo $received_by;?></td>
                                  <td align="left" valign="top" style="text-align: right;">Verified : </td>
                                  <td align="left" valign="top" style="text-align: left; border-bottom: 1pt solid black; padding-bottom: 2px" width="20%"><?PHP echo $verified_by;?></td>
                                  <td align="left" valign="top" style="text-align: right;">Amount BD :</td>
                                  <td align="left" valign="top" style="text-align: left; border-bottom: 1pt solid black; padding-bottom: 2px" width="20%"><strong><?PHP echo number_format($total_amount,3);?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tbody>
                                <tr>
                                  <td align="left" valign="top" style="text-align: left; padding-left: 0; margin: 0;">Signature : </td>
                                  <td align="left" valign="top" style="text-align: left; border-bottom: 1pt solid black; padding-bottom: 2px" width="25%"></td><td align="left" valign="top" style="text-align: right;">Signature : </td>
                                  <td align="left" valign="top" style="text-align: left; border-bottom: 1pt solid black; padding-bottom: 2px" width="25%"></td>
                                  <td align="left" valign="top" style="text-align: right;" width="100"></td>
                                  <td align="left" valign="top" style="text-align: left;" width="100"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <!--<tr>-->
                <!--  <td align="left" valign="top" style="text-align: left;">Signature : </td>-->
                <!--  <td align="left" valign="top" style="text-align: left; border-bottom:1pt solid black;"></td>-->
                <!--  <td align="left" valign="top" style="text-align: left;">Signature : </td>-->
                <!--  <td align="left" valign="top" style="text-align: left; border-bottom:1pt solid black;"></td>-->
                <!--  <td></td>-->
                <!--  <td ></td>-->
                <!--</tr>-->
                <!--<tr>
                  <td colspan="6">Inwords : <b><?PHP //echo getCurrency($total_amount);?></b> Only</td>
                </tr>-->
                <tr >
                  <td colspan="6" style="padding-top:20px;" >Cheque Payment: This is Valid on realization of Cheque.</td>
                  
                   
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
      <td style="padding-left: 10px;padding-right: 10px">&nbsp;</td>
  </tr>

  <!--<div style="break-after:page"></div>-->
<table width="800" border="0" cellspacing="0" cellpadding="5" align="center">
  <tbody>
   
  </tbody>
</table>

       


</page>

</body>

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
