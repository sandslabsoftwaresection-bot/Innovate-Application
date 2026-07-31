<?PHP 
require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
    
    $result = mysqli_query($conns,"select * from quotation_main_tbl  where 	quotation_number = '".$_GET['quotation_number']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $invoice_number = $row['quotation_number'];
        $invoice_date = date("d-M-Y", strtotime($row['quotation_created_date']));
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
        $discount_type = $row['discount_type'] ;
        $discount_amount = $row['discount_amount'] ;
        $total_discount_amount = $row['total_discount_amount'] ;
        $tax_content= $row['tax_content'];
        $discount = 0;
        $company_id = $row['company_id'];
        
        
    } 
    
    $result_company_id = mysqli_query($conns,"select description,contact_address_2 from company_details  where company_id = ".$company_id);
    while($row_comp_id=mysqli_fetch_assoc($result_company_id)) {
        $company_vat_no = $row_comp_id['description'];
        $contact_address_2 = $row_comp_id['contact_address_2'];
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
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety',21=>'zero');
    $digits = array('', 'hundred','thousand','hundred', 'million');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? '' : null;
            $hundred = ($counter == 1 && $str[0]) ? '  ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
   
     $last=$decimal%100;
    $x=$decimal%10;
    $y=$last-$x;
     if($y==0)
    {
      $y= 21 ;
    }
     if($x==0)
    {
       $x=21;
    }
    if($decimal > 0)
    {
     $paise = ($decimal > 0) ? " " . ($words[$decimal / 100] . "-" . $words[ $y ]. "-" . $words[$x]) . ' ' : '';
   
    return ucwords(($Rupees ? $Rupees . ' ' : ' ') .'1000 /'. $paise ."   ");
    }
    else
    {
      return ucwords(($Rupees ? $Rupees . ' ' : ' ') ."   ");  
    }
}
                               
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>QUOTATION<?php echo ' - '.$invoice_number?></title>
<style>
	
/* Styles go here */

.page-header, .page-header-space {
  height: 80px;
}

.page-footer, .page-footer-space {
  height: 40px;

}

.page-footer {
  position: fixed;
  bottom: 0;
  width: 100%;
  border-top: 1px solid red; /* for demo */
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
/*td p {*/
/*  margin: 0;*/
/*}*/
/*@page {*/
/*  margin: 15mm*/
/*}*/


@media print {
    
   /*thead {display: table-header-group;} */
   /*tfoot {display: table-footer-group;}*/
   
   /*button {display: none;}*/
   
   body {margin: 0;font-size: 16px;font-family: "Times New Roman"}
    
    
    
  #print_but,#export_excel_but {
    display: none;
  }
   .page-footer {
        position: fixed;
        width :100%;
        bottom: 0;
        left: 0;
        height : 50px;
        text-align: center;
        background-color:red;
    }
}
	
</style>
	
	
</head>

<body>
<div class="page-header" style="text-align: center;" align="center">
   
				<table width="100%" border="0" cellspacing="0" cellpadding="0" >
                      <tbody>
                        <tr style="text-align: left;">
                          <td width="36%" align="right" valign="top"><img src="../../httpdocs/images/company_profile_image/<?PHP echo $print_logo;?>" width="285" height="60" alt=""/></td>
                          <td width="64%" align="left" valign="top">&nbsp;
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
	
</div>	
<div class="page-footer" align="center" style="width:100%">
    
	
	
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                     <tbody>
                        <tr >
                          <td colspan="2" align="center" valign="middle" style="padding-top:5px;">
						
							<?PHP echo $print_companynamne;?>,
                          
                            <?PHP echo "  Tele : ".$print_tele." , ". $print_address." , Manama , Kingdom of Bahrain "?><br>      
							<?PHP echo "  Email : ".$print_email. "     Web : www.sapphirebh.com";?>     
							
							</td>
                        </tr>
                        
                      </tbody>
                    </table>
           
           
	
	
</div>	


<table align="center" style="height:auto;">

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
      <td style="padding-left: 10px;padding-right: 10px">
          
          <table width="800" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td width="50%" align="left" valign="top" style="padding-bottom: 0px;"></td>
            <td align="left" valign="top" ><table width="370px"  cellspacing="0" cellpadding="5">
              <tbody>
                <tr >
                  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">QUOTATION </td>
                </tr>
                
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top" style="padding-top: 0px;"><p>
              <strong><?PHP echo $company_name; ?></strong><br>
                <strong>PO Box : <?PHP echo $po_box; ?>,</strong> <br>
                <strong><?PHP echo $contact_address_2 ?></strong><br>
                <strong>TEL : <?PHP echo $telephone_no; "/ "?> ,
                FAX : <?PHP echo $fax; ?><br>
                VAT :<?PHP echo $company_vat_no?></strong><br>
               </p>
              </td>
            <td align="left" valign="top">
			  <table width="370px"  cellspacing="0" cellpadding="5">
              <tbody >
                
                <tr style="text-align: right;">
                  <td >Date : <strong><?PHP echo $invoice_date; ?></strong></td>
                </tr>
                <tr style="text-align: right;">
                  <td >Quotation No : <strong><?PHP echo $invoice_number; ?></strong></td>
                </tr>
               
                <tr style="text-align: right;">
                  <td>VAT Account No : <strong><?PHP echo $vat_no ; ?></strong></td>
                </tr>
              </tbody>
            </table>
			  
			  
			  </td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><u><strong>ATTN : <?PHP echo $attn; ?></strong></u></td>
            </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong>PROJECT :<?PHP echo $project_name; ?></strong></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong>SUBJECT : <?PHP echo $quotation_reference; ?> </strong></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top">Dear Sir, <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo $subject; ?></td>
          </tr>
        </tbody>
      </table>
		
		
		
		
	  </td>
    </tr>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">
         
         <table width="795px" border="1px" cellspacing="0" cellpadding="5"  style="border-collapse: collapse;">
        <tbody>
          <tr>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px"><strong >S/N</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;"> <strong>Description</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Qty</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:80px"><strong>Rate</strong></td>
            
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:100px"><strong>Amount</strong></td>
            
          </tr>
          <?PHP 
                $ctr = 1;
                $amt=0;
                $discount=0;
                 $result = mysqli_query($conns,"select * from quotation_child_tbl where quotation_no = '".$_GET['quotation_number']."'");
                     while($row=mysqli_fetch_assoc($result)) {
                     
                         if($row['discount_amount']!=0)
                         {
                             $discount = $discount + ($row['discount_amount']);
                         }
                        
                        
                         
                         if($ctr%2!=0)
                         {
                ?>
                          <tr style="border-bottom: 1px solid gray;">
                            <td bgcolor="#f2f2f2" style="vertical-align: top;"><?PHP echo $ctr;?></td>
                            <?php if (trim($row["product_name"]) != "-Select Product--") { ?>
                            
                            <td bgcolor="#f2f2f2" style="text-align: left"><strong><u><?PHP echo $row['product_name']; ?></u></strong> <br> <?PHP echo $row['description'];?></td>
                           <?php } else { ?>
                            <td bgcolor="#f2f2f2" style="text-align: left"><?PHP echo $row['description'];?></td>
                           <?php } ?>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo number_format($row['quantity'],3);?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $row['unit'];?></td>
                            <td bgcolor="#f2f2f2" style="text-align: right"><?PHP echo number_format($row['rate'],3);?></td>
                            <td bgcolor="#f2f2f2" style="text-align: right"><?PHP echo number_format($row['amount'],3); $amt=$amt+$row['amount'];?></td>
                            
							  
                          </tr>
                    <?PHP }
                        else
                        {
                    
                    ?>
                    
                    
                        <tr style="border-bottom: 1px solid gray;">
                            <td style="vertical-align: top;"><?PHP echo $ctr;?></td>
                            <?php if (trim($row["product_name"]) != "-Select Product--") { ?>
                            <td style="text-align: left">
                                <strong><u><?php echo $row['product_name']; ?></u></strong><br>
                                <?php echo $row['description']; ?>
                            </td>
                        <?php } else { ?>
                            <td style="text-align: left">
                                <?php echo $row['description']; ?>
                            </td>
                        <?php } ?>
                            <td style="text-align: center"><?PHP echo number_format($row['quantity'],3);?></td>
                            <td style="text-align: center"><?PHP echo $row['unit'];?></td>
                            <td style="text-align: right"><?PHP echo number_format($row['rate'],3);?></td>
                            <td style="text-align: right"><?PHP echo number_format($row['amount'],3);$amt=$amt+$row['amount']; ?></td>
                            
                          </tr>
                    
                    
                    <?PHP } ?>
                          
          <?PHP 
          
	            $ctr = $ctr +1;
	            } ?>
         
          <tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            
            <td colspan="4" style="text-align: right"><strong>Total Amount in BHD</strong></td>
           
            <td style="text-align: right" colspan="2"><strong><?PHP echo number_format($amt,3);?></strong></td>
          </tr>
          <?PHP if($total_discount_amount+$discount!=0) { ?>
			 <tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            
            <td colspan="4" style="text-align: right"><strong>Discount Amount</strong></td>
           
            <td style="text-align: right" colspan="2"><strong><?PHP echo number_format($total_discount_amount+$discount,3);?></strong></td>
          </tr>
           <tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            
            <td colspan="4" style="text-align: right"><strong>Balance Amount</strong></td>
           
            <td style="text-align: right" colspan="2"><strong><?PHP echo number_format($amt-($total_discount_amount+$discount),3);?></strong></td>
          </tr>
          <?PHP } ?>
			
			<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            
            <td colspan="4" style="text-align: right"><strong> VAT (<?PHP $number =explode('.', $tax_content); if($number[1]== '000'){ echo number_format($tax_content,0);?> <?PHP } else {echo $tax_content;}?>%)</strong></td>
           
            <td style="text-align: right" colspan="2"><strong><?PHP $vat_p = ((($amt-($total_discount_amount+$discount))*$tax_content)/100) ;
            
            echo number_format($vat_p,3);?></strong></td>
          </tr>
			<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            
            <td colspan="4" style="text-align: right"><strong>Grand Total BHD</strong></td>
           
            <td style="text-align: right" colspan="2"><strong><?PHP echo number_format(round(($amt-($total_discount_amount+$discount)) + $vat_p,3),3);?></strong></td>
          </tr>
			
          <tr >
            <td colspan="10" style="text-align: center; font-size:12px">Bahraini Dinars: <strong> <?PHP 
            
            $ro = round(($amt-($total_discount_amount+$discount)) + $vat_p,3);
            $amt1 = str_replace(",","",$ro); 
            
            // $splitamount = explode('.',(($amt-$discount) + $vat_per));
             $splitamount1=number_format((float)(($amt-($total_discount_amount+$discount)) + $vat_p), 3, '.', '');
             $splitamount = explode('.',($splitamount1));
          
            if(intval($splitamount[1])<=0 )
            {
                 echo getCurrency($splitamount[0]).' only';
            }
            else
            {
                 echo getCurrency($splitamount[0]).'  '.$splitamount[1].'/1000'.' Fills Only';
            }
            
            
           
            
            ?> </strong> </td>
            </tr>
        </tbody>
      </table> 
          
      </td>
    </tr>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">&nbsp;</td>
    </tr>
  </tbody>
 
 
</table>
  
<table width="800" border="0" cellspacing="0" cellpadding="4" align="center">
  <tbody>
    <tr>
      <td><span style="padding-left: 10px;padding-right: 10px"><span style="text-align: left"><?PHP echo $description;?></span></span></td>
    </tr>
  </tbody>
</table>  
  
			
		  </div>
        <div style="text-align:right;padding-right:30px;">
               <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
               <!--<input type="button" value="Print this page" onClick="window.print()" id="print_but">-->
        
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

// var data_type = 'data:application/vnd.ms-excel';
// a.href = data_type + ', ' + encodeURIComponent(tab_text);
// a.download = 'SupervisorReport.xls';

function fnExcelReport()
{
	var no = "<?php echo $invoice_number; ?>";
	var filename = "Quotation - "+no+".xls";
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