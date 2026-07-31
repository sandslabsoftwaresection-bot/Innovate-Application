<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?PHP 
require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
    
    $result = mysqli_query($conns,"select * from  gate_pass_tbl  where pass_no = '".$_GET['pass_no']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $gate_pass_id =$row['gate_pass_id'];
        $pass_no = $row['pass_no'];
        $company_id = $row['company_id'];
        $gate_pass_date = date("m-d-Y", strtotime($row['gate_pass_date']));
        $company_name= $row['company_name'];
        $po_box = $row['po_box'];
        $telephone_no = $row['telephone_no'];
        $fax = $row['fax'];
        $address = $row['address'];
        $attn = $row['attn']; 
        $vehicle_no = $row['vehicle_no'];
        $driver_name = $row['driver_name']; 
        $approved_by = $row['approved_by'] ;
        $checked_by = $row['checked_by'] ;
        $received_by = $row['received_by'] ;
         
    } 
    
    // $result_company_id = mysqli_query($conns,"select description from company_details  where company_id = ".$company_id);
    // while($row_comp_id=mysqli_fetch_assoc($result_company_id)) {
        // $company_vat_no = $row_comp_id['description'];
    // }
    
    
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
         
         
         
    // function getCurrency($number)
    // {
     
    // $decimal = round($number - ($no = floor($number)), 3) * 1000;
    // $hundred = null;
    // $digits_length = strlen($no);
    // $i = 0;
    // $str = array();
    // $words = array(0 => '', 1 => 'one', 2 => 'two',
        // 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        // 7 => 'seven', 8 => 'eight', 9 => 'nine',
        // 10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        // 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        // 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        // 19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        // 40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        // 70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    // $digits = array('', 'hundred','thousand','lakh', 'crore');
    // while( $i < $digits_length ) {
        // $divider = ($i == 2) ? 10 : 100;
        // $number = floor($no % $divider);
        // $no = floor($no / $divider);
        // $i += $divider == 10 ? 1 : 2;
        // if ($number) {
            // $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            // $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            // $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        // } else $str[] = null;
    // }
    // $Rupees = implode('', array_reverse($str));
   
    // $paise = ($decimal > 0) ? ". " . ($words[$decimal / 100] . " " . $words[substr($decimal, 1) / 10]. " " . $words[$decimal % 10]) . ' ' : '';
    // return ucwords(($Rupees ? $Rupees . ' ' : ' ') . $paise);
// }
                               
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gate Pass <?php echo ' - '.$pass_no;?></title>
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
   body {
	   margin: 0px; 
	   font-size: 16px;
	   font-family: "Times New Roman";
	}
	.signature-area{
		 /*margin: -100px;
         margin-top: 700px; */	
         position: absolute;
         bottom: 50px;
		 margin-bottom: 25px;
	}
}		
</style>		
</head>

<body>

	<div class="page-header" style="text-align: center margin-bottom: 10px;" align="center">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tbody>
				<tr style="text-align:left;">
				  <td width="35%" align="right" valign="top"><img src="../../httpdocs/images/company_profile_image/<?PHP echo $print_logo;?>" width="238" height="49" alt=""/></td>
				  <td width="65%" align="left" valign="top">&nbsp;
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
				<?PHP echo $print_address;?>,
				<?PHP echo " , Tele : ".$print_tele." , FAX : ".$print_fax." , Email : ".$print_email;?><br>      
				</td>
			</tr>
			<tr>
			  <td width="50%"><br>
			 
			  </td>
			  <td width="50%">
				  
			  </td>
			</tr>
	    </tbody>
	</table>
</div>	
    

	<table align="center">
		<thead>
		  <tr>
			<td>
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
					<tr>
					    <td colspan="2" style="padding-left: 10px;padding-right: 10px"> 
						<table width="800" border="0" cellspacing="0" cellpadding="5" >
						<tbody>
						  <tr>
							<td width="50%" align="left" valign="top" style="padding-bottom: 0px;">
								
								 <table width="370px"  cellspacing="0" cellpadding="1">
								<tbody>
								<tr >
								  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';padding-top:10px;" >&nbsp;</td>
								</tr>
								<tr>
								  <td><strong><br><br>Company : <?PHP echo $company_name; ?></strong></td>
								</tr>
								<tr>
								  <td><strong>Address : <?PHP echo $address; ?></strong></td>
								</tr>
							   
								<tr>
								  <td><span style="padding-top: 0px;"><strong>Attn : <?PHP echo $attn; ?></strong></span></td>
								</tr>
							   <!-- <tr>
								  <td><span style="padding-top: 0px;"><strong>FAX : <?PHP echo $fax; ?></strong></span></td>
								</tr>-->
								<tr>
								  <td>&nbsp;</td>
								</tr>
							  </tbody>
							</table>

							</td>
							<td align="left" valign="top" >
								<table width="370px"  cellspacing="0" cellpadding="10">
								  <tbody>
									<tr>
									  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">Gate Pass </td>
									</tr>
									
								   <tr>
									  <td style="float: right;"><span style="padding-bottom: 0px;"><br>Pass No: <strong><?PHP echo $pass_no; ?></strong></span></td>
									</tr>
									<tr>
									  <td style="float: right;">Date : <strong><?PHP echo $gate_pass_date; ?></strong></td>
									</tr>
								  </tbody>
								</table>
							</td>
						  </tr>
						 <!-- <tr>
							<td colspan="2" align="left" valign="top"><strong>ATTN : <?PHP echo $attn; ?></strong></td>
							</tr>-->
						</tbody>
					    </table>
					    </td>
					</tr>
					<tr>
					    <td colspan="2" style="padding-left: 10px;padding-right: 10px">
						<table width="795px" border="0" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
						<tbody>
						  <tr>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px;"><strong >SL</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;"> <strong>Description</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Qty</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
						  </tr>
						  <tr>
							<td style="text-align: center;font-size:15px;width:20px;border-right:1px solid black;border-left:1px solid black;"><strong ></strong></td>
							<td  style="text-align: center; font-size:15px;border-right:1px solid black;"> <strong></strong></td>
							<td  style="text-align: center; font-size:15px;width:50px;border-right:1px solid black;"><strong></strong></td>
							<td  style="text-align: center; font-size:15px;width:50px;border-right:1px solid black;"></td>
						  </tr>
						    <?PHP 
							   $i=0;
								 $result = mysqli_query($conns,"select * from  gate_pass_child_tbl where pass_no = '".$_GET['pass_no']."'");
									 while($row=mysqli_fetch_assoc($result)) {
										$description=$row['description'];
										$qty=$row['quantity'];
										$unit=$row['unit'];
										$i++;    
						    ?>
							  <tr style="border-bottom: 1px solid gray;">
								<td bgcolor="#f2f2f2" style="text-align: center;border-right: 1px solid black;border-left: 1px solid #000;"><?PHP echo $i;?></td>
								<td bgcolor="#f2f2f2"style="text-align: left;border-right: 1px solid black;"><?PHP echo $description;?></td>
								<td bgcolor="#f2f2f2" style="text-align: center;border-right: 1px solid black;"><?PHP echo $qty;?></td>
								<td bgcolor="#f2f2f2" style="text-align: center;border-right: 1px solid black;"><?PHP echo $unit;?></td>  
							  </tr>
							<?php } ?>
						</tbody>
					    </table>
						</td>
					</tr>
					    <div style="text-align:right;padding-right:30px;">
								   <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
								   <!--<input type="button" value="Print this page" onClick="window.print()" id="print_but">-->
						</div>
					<tr>
					  <td><span><span style="text-align: left"><?PHP /*echo $description;*/?></span></span></td>
					</tr>
				 
				    </tbody>
				</table>
		
		<!------->
			<div class="signature-area" style="position: absolute;
                bottom: 50px;">
				<table width="1000" border="0" cellspacing="0" cellpadding="5" style="margin-top: 50px;">
				  <tbody>
					<tr>
					<td><strong>Approved by</strong></td>
					<td><strong>Checked by</strong></td>
					<td><strong>Received by</strong></td>
					</tr>
					
					
					<tr>
					<td><strong><?php echo $approved_by; ?></strong></td>
					<td><strong><?php echo $checked_by; ?></strong></td>
					<td><strong><?php echo $received_by; ?></strong></td>
					</tr>
					
			 
					
					<tr>
					  <td><strong>Sign</strong></td>
					  <td><strong>Sign</strong></td>
					  <td><strong>Sign</strong></td>
					</tr>
					
					<tr>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					
					<tr>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					
					<tr>
					<td></td>
					<td></td>
					<td></td>
					</tr>
					
					<tr>
					<td>Vehicle No :<strong><?php echo $vehicle_no; ?></strong></td>
					</tr>
					<tr>
					<td>Driver :<strong><?php echo $driver_name; ?></strong></td>
					</tr>
					
					
					
				  </tbody>
				</table>
			</div>  
		<!-------> 
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
	var gp = "<?php echo $pass_no; ?>";
	var filename = "Gate Pass - "+gp+".xls";
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

