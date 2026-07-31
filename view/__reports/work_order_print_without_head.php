<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<?PHP 
require ('../../model/common/common_functions.php');
   
   // var	$invoice_number,$invoice_date,$company_name,$po_box,$telephone_no,$fax,$address,$attn,$quotation_reference,$LPO_no;
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
    
    $result = mysqli_query($conns,"select * from  work_order_tbl  where work_order_number = '".$_GET['work_order_no']."'");
    while($row=mysqli_fetch_assoc($result)) {
        $work_order_main_id =$row['work_order_main_id'];
        $work_order_number = $row['work_order_number'];
        $work_order_date = date("m-d-Y", strtotime($row['work_order_date']));
        $company_name= $row['company_name'];
        $po_box = $row['po_box'];
        $telephone_no = $row['telephone_no'];
        $fax = $row['fax'];
        $address = $row['address'];
        $attn = $row['attn']; 
        $subject = $row['subject'];
        $quotation_reference = $row['quotation_reference']; 
        $received = $row['received'] ;
        $location = $row['location'] ;
        $created_by_id = $row['created_by_id'] ;
        $created_by_name = $row['created_by_name'] ;
        $project_id = $row['project_id'] ;
        $project_name = $row['project_name'] ;
        $company_id = $row['company_id'];
        
    } 
    
    // $result_company_id = mysqli_query($conns,"select description from company_details  where company_id = ".$company_id);
    // while($row_comp_id=mysqli_fetch_assoc($result_company_id)) {
        // $company_vat_no = $row_comp_id['description'];
    // }
    
    
    // $result_company = mysqli_query($conns,"select * from company_primary_details");
    // while($row_company=mysqli_fetch_assoc($result_company)) {
        // $print_companynamne = $row_company['company_name'];
        // $print_address = $row_company['address'];
        // $print_tele = $row_company['phone_no'];
        // $print_fax = $row_company['fax'];
        // $print_email = $row_company['email'];
        // $print_po = $row_company['pobox'];
        // $print_logo = $row_company['print_logo'];
        // $vat_no = $row_company['VAT_no'];
    // }
         
         
         
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
<title>Work Order <?php echo ' - '.$_GET['work_order_no']; ?></title>
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
   text-align: center;
 }

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
         bottom: 50px;
	}
}	
	
</style>	
	
</head>

<body>

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
									<table width="800" border="0" cellspacing="0" cellpadding="5">
									    <tbody>
									        <tr>
										        <td width="50%" align="left" valign="top" style="padding-bottom: 0px;">
											        <table width="370px"  cellspacing="0" cellpadding="4">
														<tbody>
															<tr>
															  <td>&nbsp;</td>
															</tr>
															<tr>
															  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';padding-top:10px;" >&nbsp;</td>
															</tr>
															<tr>
															  <td><strong style="font-size:15px;">Company Name : <?PHP echo $company_name; ?></strong></td>
															</tr>
															<tr>
															  <td><strong>Location : <?PHP echo $location; ?></strong></td>
															</tr>
															<tr>
															  <td><span style="padding-top: 0px;"><strong>Received : <?PHP echo $received; ?></strong></span></td>
															</tr>
															<tr>
															  <td>&nbsp;</td>
															</tr>
													  </tbody>
										            </table>
										        </td>
										        <td align="left" valign="top" >
												    <table width="370px"  cellspacing="0" cellpadding="5">
													  <tbody>
														<tr>
														  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">WORK ORDER</td>
														</tr>
														<tr>
														  <td>&nbsp;</td>
														</tr>
														<tr>
														  <td style="float: right;"><strong style="font-size:18px;">Job No : <?PHP echo $work_order_number; ?></strong></td>
														</tr>
														<tr>
														  <td style="float: right;">Work Order Date : <strong><?PHP echo $work_order_date; ?></strong></td>
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
								    <table width="795px" border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
										<tbody>
										  <tr>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px;"><strong >SL</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;"> <strong>Product Name</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Qty</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Status</strong></td>
											<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:120px"><strong>Remarks</strong></td>
										  </tr>
										   <tr>
											<td style="text-align: center;font-size:15px;width:20px;border-right:1px solid black;border-left:1px solid black;"><strong ></strong></td>
											<td  style="text-align: center; font-size:15px;border-right:1px solid black;"> <strong></strong></td>
											<td  style="text-align: center; font-size:15px;width:50px;border-right:1px solid black;"><strong></strong></td>
											<td  style="text-align: center; font-size:15px;width:50px;border-right:1px solid black;"></td>
											<td  style="text-align: center;font-size:15px;width:50px;border-right:1px solid black;">			
											<table><tr><td style="font-size: 14px;">Material Received</td>
											<td style="border-left: 1px solid #080808;font-size: 14px;">Fabricaton completed</td>
											<td style="border-left: 1px solid #080808;font-size: 14px;">Delivered</td>
											<td style="border-left: 1px solid #080808;font-size: 14px;">Site fixing completed</td></tr></table></td>
											<td  style="text-align: center;font-size:15px;width:120px;border-right:1px solid black;"><strong></strong></td>
										  </tr>
										  <?PHP 
											   $i=0;
												 $result = mysqli_query($conns,"select * from  work_order_child_tbl where work_order_no = '".$_GET['work_order_no']."'");
													 while($row=mysqli_fetch_assoc($result)) {
														$product_name=$row['product_name']; 
														$description=$row['description'];
														$qty=$row['required_quantity'];
														$unit=$row['unit'];
														$quotation_status=$row['quotation_status'];
														$remarks=$row['remarks'];
													$i++; 
													   
													   
												?>
												
												<tr style="border-bottom: 1px solid gray;">
													<td bgcolor="#f2f2f2" style="text-align: center;border-right: 1px solid black;border-left: 1px solid #000;"><?PHP echo $i;?></td>
													<td bgcolor="#f2f2f2"style="text-align: left;border-right: 1px solid black;"><strong><?PHP echo $product_name;?></strong></td>
													<td bgcolor="#f2f2f2" style="text-align: center;border-right: 1px solid black;"><?PHP echo $qty;?></td>
													<td bgcolor="#f2f2f2" style="text-align: center;border-right: 1px solid black;"><?PHP echo $unit;?></td>
													<td bgcolor="#f2f2f2" style="text-align: center;border-right: 1px solid black; padding: 0px;">
													<table style="height: 40px;border: 1px solid #ADADAD;border-collapse: collapse;"><tr>
													<td style="width:25%;text-align: center;border-left-style: hidden;"><?php if($quotation_status=='Material Received'){?><i class="fa fa-check" aria-hidden="true"></i><?php } else { echo "&nbsp"; } ?></td>
													<td style="width:25%;text-align: center;border-left: 1px solid black;"><?php if($quotation_status=='Fabrication completed'){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } else { echo "&nbsp"; } ?><td>
													<td style="width:25%;text-align: center;border-left: 1px solid black;"><?php if($quotation_status=='Delivered'){?><i class="fa fa-check" aria-hidden="true"></i><?php } else { echo "&nbsp"; }  ?></td>
													<td style="width:25%;text-align: center;border-left: 1px solid black;border-right-style: hidden;"><?php if($quotation_status=='Site fixing completed'){ ?><i class="fa fa-check" aria-hidden="true"></i><?php } else { echo "&nbsp"; }  ?></td>
													</tr></table></td>
													<td bgcolor="#f2f2f2" style="text-align: left;border-right: 1px solid black;"><?PHP echo $remarks; ?></td> 
												</tr>
													 <?php } ?>
										</tbody>
							        </table>
							    </td>
							</tr>
							<div style="text-align:right;padding-right:30px;">
								   <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
								   <input type="button" value="Print this page" onClick="window.print()" id="print_but">
							</div><br><br>
		  
							<tr>
							  <td><span><span style="text-align: left"><?PHP /*echo $description;*/?></span></span></td>
							</tr>
							
							<tr>
							    <td colspan="5">
									<div style="margin-bottom: 10px;">
										<span style="float:left;">Completion Report:</span>
										<ul style="float:left;list-style-type: none;padding: 24px;margin: 0;margin-left: -151px;">
										  <li>1.</li>
										  <li>2.</li>	
										</ul>
									</div>
                                </td>								
							</tr>
							
							<!--<tr>
							    <td colspan="5">
									<div class="signature-area" style="position: absolute; margin-bottom: 50px;">
										<table width="1000" border="0" cellspacing="0" cellpadding="5" align="center" style="margin-top: 50px;">
										  <tbody>
											<tr>
												<td><strong>Manager</strong></td>
												<td><strong>Accounts manager</strong></td>
												<td><strong>Supervisor</strong></td>
												<td><strong>Forman</strong></td>
											</tr>
										  </tbody>  
										</table>
									</div>
                                </td>								
							</tr>-->
							
                        </tbody>
                    </table>
					
					<div class="signature-area" style="position: absolute; margin-bottom: 50px;">
						<table width="1000" border="0" cellspacing="0" cellpadding="5" align="center" style="margin-top: 50px;">
						  <tbody>
							<tr>
								<td><strong>Manager</strong></td>
								<td><strong>Accounts manager</strong></td>
								<td><strong>Supervisor</strong></td>
								<td><strong>Forman</strong></td>
							</tr>
						  </tbody>  
						</table>
					</div>
					
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
	var no = "<?php echo $_GET['work_order_no']; ?>";
	var filename = "Work order - "+no+".xls";
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

