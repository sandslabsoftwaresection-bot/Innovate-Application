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
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety' ,21=>'zero');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' ' : null;
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
     $paise = ($decimal > 0) ? " " . ($words[$decimal / 100] . " " . $words[ $y ]. " " . $words[$x]) . ' ' : '';
   
    return ucwords(($Rupees ? $Rupees . ' ' : ' ') .'1000 /'. $paise ."  ");
    }
    else
    {
      return ucwords(($Rupees ? $Rupees . ' ' : ' ') ."  ");  
    }
}
                               
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>QUOTATION<?php echo ' - '.$invoice_number?></title>
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
<table width="800" border="0" cellspacing="0" cellpadding="5" align="center">
  <tbody>
    <tr >
      <td style="padding-left: 10px;padding-right: 10px">
          
          <table width="800" border="0" cellspacing="0" cellpadding="5">
        <tbody>
          <tr>
            <td width="50%" align="left" valign="top" style="padding-bottom: 0px;"></strong><br>
              <br></td>
            <td align="left" valign="top" ><table width="370px"  cellspacing="0" cellpadding="5">
              <tbody>
                <tr >
                  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">QUOTATION </td>
                </tr>
                
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td align="left" valign="top" style="padding-top: 10px;"><strong><span style="padding-bottom: 0px;">Quotation No : <strong><?PHP echo $invoice_number; ?><br><br>
                    <?PHP echo $company_name; ?></strong><br>
                    <strong>PO Box : <?PHP echo $po_box; ?>,</strong> <br>
                    <strong>Manama, Kingdom of Bahrain</strong></span><br>
              TEL : <?PHP echo $telephone_no; ?>
              FAX : <?PHP echo $fax; ?></strong><br>
              <strong>VAT NO : <?PHP echo $company_vat_no;?></strong>
              </td>
            <td align="left" valign="top">
			  
			  <table width="370px"  cellspacing="0" cellpadding="5">
              <tbody>
                
                <tr>
                  <td>Date : <strong><?PHP echo $invoice_date; ?></strong></td>
                </tr>
                <tr>
                  <td>VAT Account No : <strong><?PHP echo $vat_no ; ?></strong></td>
                </tr>
              </tbody>
            </table>
			  
			  
			  </td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong>ATTN : <?PHP echo $attn; ?></strong></td>
            </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong>PROJECT : <?PHP echo $project_name; ?></strong></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong>SUBJECT : <?PHP echo $quotation_reference; ?> </strong></td>
          </tr>
          <tr>
            <td colspan="2" align="left" valign="top"><strong><?PHP echo $subject; ?></strong></td>
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
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px"><strong >SL</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;"> <strong>Description</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Qty</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:80px"><strong>Rate (BD)</strong></td>
            <td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:100px"><strong>Amount (BD)</strong></td>
            
          </tr>
          <?PHP 
                $ctr = 1;
                $amt=0;
                 $result = mysqli_query($conns,"select * from quotation_child_tbl where quotation_no = '".$_GET['quotation_number']."'");
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
                            <td bgcolor="#f2f2f2" style="text-align: left"><?PHP echo $row['description'];?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo number_format($row['quantity'],3);?></td>
                            <td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $row['unit'];?></td>
                            <td bgcolor="#f2f2f2" style="text-align: right"><?PHP echo  number_format($row['rate'],3);?></td>
                            <td bgcolor="#f2f2f2" style="text-align: right"><?PHP echo number_format($row['amount'],3); $amt=$amt+$row['amount'];?></td>
                            
							  
                          </tr>
                    <?PHP }
                        else
                        {
                    
                    ?>
                    
                    
                        <tr style="border-bottom: 1px solid gray;">
                            <td style="text-align: center"><?PHP echo $ctr;?></td>
                            <td><?PHP echo $row['description'];?></td>
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
			 <tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            
            <td colspan="4" style="text-align: right"><strong>Discount Amount</strong></td>
           
            <td style="text-align: right" colspan="2"><strong><?PHP echo number_format($discount,3);?></strong></td>
          </tr>
			 <tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            
            <td colspan="4" style="text-align: right"><strong>Balance Amount</strong></td>
           
            <td style="text-align: right" colspan="2"><strong><?PHP echo number_format($amt-$discount,3);?></strong></td>
          </tr>
			<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            
            <td colspan="4" style="text-align: right"><strong>VAT account number <?PHP echo $vat_no;?> VAT5%</strong></td>
           
            <td style="text-align: right" colspan="2"><strong><?PHP //$vat_p = ((($amt*$discount)/100)+$amt)*.05 ;
            
            echo number_format($vat_per,3);?></strong></td>
          </tr>
			<tr style="border-bottom: 1px solid gray;">
            <td style="text-align: center">&nbsp;</td>
            
            <td colspan="4" style="text-align: right"><strong>Grand Total BHD</strong></td>
           
            <td style="text-align: right" colspan="2"><strong><?PHP echo number_format(round(($amt-$discount) + $vat_per,3),3);?></strong></td>
          </tr>
			
          <tr >
           <td colspan="9" style="text-align: center; font-size:12px">Bahraini Dinars: <strong> <?PHP 
            
            $ro = round(($amt-$discount) + $vat_per,3);
            $amt1 = str_replace(",","",$ro); 
            
            // $splitamount = explode('.',(($amt-$discount) + $vat_per));
             $splitamount1=number_format((float)(($amt-$discount) + $vat_per), 3, '.', '');
             $splitamount = explode('.',($splitamount1));
          
            if(intval($splitamount[1])<=0 )
            {
                 echo getCurrency($splitamount[0]).' only';
            }
            else
            {
                 echo getCurrency($splitamount[0]).'1000/'.$splitamount[1].' fills only';
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


<!--<div style="break-after:page"></div>-->
<table width="800" border="0" cellspacing="0" cellpadding="5" align="center">
  <tbody>
    <tr>
      <td><span style="padding-left: 10px;padding-right: 10px"><span style="text-align: left"><?PHP echo $description;?></span></span></td>
    </tr>
  </tbody>
</table>

</page>

</body>

</html>
