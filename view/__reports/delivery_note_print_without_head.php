<?PHP 
require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
    
    $result = mysqli_query($conns,"select * from delivery_note_main_tbl  where 	delivery_note_number = '".$_GET['delivery_note_number']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $delivery_note_main_id =$row['delivery_note_main_id'];
        $invoice_number = $row['delivery_note_number'];
        $invoice_date = date("m-d-Y", strtotime($row['delivery_note_date']));
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
        $project_name = $row['project_name'] ;
        
        $discount = 0;
        $company_id = $row['company_id'];
        
    } 
    
    $result_company_id = mysqli_query($conns,"select description from company_details  where company_id = ".$company_id);
    while($row_comp_id=mysqli_fetch_assoc($result_company_id)) {
        $company_vat_no = $row_comp_id['description'];
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
        $vat_no = $row_company['VAT_no'];
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
<title>Delivery Note <?php echo ' - '.$invoice_number;?></title>
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

/*.page {
  page-break-after: always;
  text-align: center;
}*/

@page {
  margin: 15mm
}

@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
    #print_but,#export_excel_but{display: none;}
   body {margin: 0;font-size: 16px;font-family: "Times New Roman"}
   .signature-area{
         position: absolute;
         bottom: 30px;
	}
}	
	
</style>	
	
	
</head>

<body>
	

<!--<div class="page-header" style="text-align: center" align="center">-->
   
<!--				<table width="100%" border="0" cellspacing="0" cellpadding="0">-->
<!--                      <tbody>-->
<!--                        <tr style="text-align:left;">-->
<!--                          <td width="35%" align="right" valign="top"><img src="../../httpdocs/images/company_profile_image/<?PHP echo $print_logo;?>" width="238" height="49" alt=""/></td>-->
<!--                          <td width="65%" align="left" valign="top">&nbsp;-->
<!--                          </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                          <td><br>-->
                          
<!--                          </td>-->
<!--                          <td></td>-->
<!--                        </tr>-->
<!--                      </tbody>-->
<!--                    </table>-->
	
<!--</div>	-->
<!--<div class="page-footer" align="center">-->
    
	
	
<!--                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">-->
<!--                     <tbody>-->
<!--                        <tr style="text-align:middle; border-bottom:">-->
<!--                          <td colspan="2" align="center" valign="middle" style="padding-top:5px;">-->
						
<!--							<?PHP echo $print_companynamne;?>,-->
<!--                            <?PHP echo $print_address;?>,-->
<!--                            <?PHP echo " , Tele : ".$print_tele." , FAX : ".$print_fax." , Email : ".$print_email;?><br>      -->
							
<!--							</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                          <td width="50%"><br>-->
                         
<!--                          </td>-->
<!--                          <td width="50%">-->
                              
<!--                          </td>-->
<!--                        </tr>-->
<!--                      </tbody>-->
<!--                    </table>-->
           
           
	
	
<!--</div>	-->
    

<table align="center">

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
          <div class="page">
			
			 
 <table width="800" border="0" cellspacing="0" cellpadding="5" align="center" id="main_table">
  <tbody>
    <tr >
      <td colspan="2" style="padding-left: 10px;padding-right: 10px">
          
          <table width="800" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td width="50%" align="left" valign="top" style="padding-bottom: 0px;">
                
                 <table width="370px"  cellspacing="0" cellpadding="1">
              <tbody>
                <tr >
                  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';padding-top:10px;" >&nbsp;</td>
                </tr>
                <tr>
                  <td><strong><?PHP echo $company_name; ?></strong></td>
                </tr>
                <tr>
                  <td><strong>PO Box : <?PHP echo $po_box; ?>,</strong></td>
                </tr>
                <tr>
                  <td><strong>Manama, Kingdom of Bahrain</strong></td>
                </tr>
                <tr>
                  <td><span style="padding-top: 0px;"><strong>TEL : <?PHP echo $telephone_no; ?></strong></span></td>
                </tr>
                <tr>
                  <td><span style="padding-top: 0px;"><strong>FAX : <?PHP echo $fax; ?></strong></span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table>

            </td>
            <td valign="top" ><table width="370px"  cellspacing="0" cellpadding="5">
              <tbody>
                <tr >
                  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">Delivery Note </td>
                </tr>
                <tr>
                  <td style="float: right;"><span style="padding-bottom: 0px;">Delivery Note No : <strong><?PHP echo $invoice_number; ?></strong></span></td>
                </tr>
                <tr>
                  <td style="float: right;">Date : <strong><?PHP echo $invoice_date; ?></strong></td>
                </tr>
                <tr>
                  <td style="float: right;">Quotation Ref : <strong><?PHP echo $quotation_reference ; ?></strong></td>
                </tr>
                 <tr>
                  <td style="float: right;">LPO No : <strong><?PHP echo $LPO_no ; ?></strong></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong>ATTN : <?PHP echo $attn; ?></strong></td>
            </tr>
          
        
        </tbody>
      </table>
		
		
		
		
	  </td>
    </tr>
    <tr >
      <td colspan="2" style="padding-left: 10px;padding-right: 10px">
          
          <table width="795px" border="0" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
        <tbody>
          <tr>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px"><strong >SL</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;"> <strong>Description</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Qty</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:120px"><strong>Remarks</strong></td>
            
          </tr>
          <?PHP 
                $ctr = 1;
                $amt=0;
                 $result = mysqli_query($conns,"select * from delivery_note_child_tbl where delivery_note_no = '".$_GET['delivery_note_number']."'");
                     while($row=mysqli_fetch_assoc($result)) {
                         if($row['vat_percentage']!=0)
                         {
                             $vat_per = $vat_per + ($row['discount_amount']*$row['vat_percentage'])/100;
                         }
                         if($row['discount_precentage']!=0)
                         {
                             $discount = $discount + ($row['amount']*$row['discount_precentage'])/100;
                         }
                         
                         if($ctr%2!=0)
                         {
                ?>
                          <tr style="border-bottom: 1px solid gray;">
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $ctr;?></td>
                            <td bgcolor="#f2f2f2"style="text-align: left"><?PHP echo $row['description'];?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo number_format($row['quantity'],3);?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $row['unit'];?></td>
                           
                            <td bgcolor="#f2f2f2" style="text-align: left"><?PHP echo $row['remarks']; ?></td>
                            
							  
                          </tr>
                    <?PHP }
                        else
                        {
                    
                    ?>
                    
                    
                        <tr style="border-bottom: 1px solid gray;">
                            <td style="text-align: center"><?PHP echo $ctr;?></td>
                            <td style="text-align: left"><?PHP echo $row['description'];?></td>
                            <td style="text-align: center"><?PHP echo number_format($row['quantity'],3);?></td>
                            <td style="text-align: center"><?PHP echo $row['unit'];?></td>
                           
                            <td style="text-align: left"><?PHP echo $row['remarks']; ?></td>
                            
                          </tr>
                    
                    
                    <?PHP } ?>
                          
          <?PHP 
          
	            $ctr = $ctr +1;
	            } ?>
         
         
			
			
			
		
			
          
        </tbody>
      </table></td>
    </tr>
      <div style="text-align:right;padding-right:30px;">
                   <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
                   <input type="button" value="Print this page" onClick="window.print()" id="print_but">
           </div>
		   <table class="signature-area" width="100%" border="0" align="bottom" valign="bottom" style="margin-top:200px;margin-bottom:20px; width:100%; text-align:center;">
		  <tbody>
			<tr>
			  <td><span><span style="text-align: left"><?PHP echo $description;?></span></span></td>
			</tr>
			
		  </tbody>
		</table>
    <!--<tr>
      <td><span><span style="text-align: left"><?PHP echo $description;?></span></span></td>
    </tr>-->
 
  </tbody>
</table>
  

  
			
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


	
</body>
</html>
<script>
function fnExcelReport()
{
	var no = "<?php echo $invoice_number; ?>";
	var filename = "Delivery note - "+no+".xls";
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

