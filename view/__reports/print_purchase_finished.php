<?PHP 
require ('../../model/common/common_functions.php');
   
   $db_con = new DBConnection();
   $conns = $db_con->ConnectToMYSQL();
   

	$result_company = mysqli_query($conns, "SELECT * FROM company_primary_details  where profile_id = '1'");
    while($row_company= mysqli_fetch_assoc($result_company)) 
	{
		$print_companynamne = $row_company['company_name'];
        $tele = $row_company['phone_no'];
		$company_address = $row_company['address'];
		$company_email = $row_company['email'];
    }
                               
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inventory List</title>

    <!-- favicons -->
	<link rel="apple-touch-icon" href="../../../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png">
    <link rel="icon" href="../../../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png">
	
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
   
   body {margin: 0;font-size: 16px;font-family: "Times New Roman"}
}
@media print {
  #print_but,#export_excel_but {
    display: none;
  }
}	
	
</style>
	
	
</head>

<body>
	<div class="page-header" style="text-align: center" align="center">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tbody>
				<tr style="text-align:left;">
				  <td width="36%" align="right" valign="top"><img src="../../httpdocs/images/company_profile_image/174258_logo copy png.jpg" width="285" height="60" alt=""/></td>
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
			  
				<?PHP echo "  Tele : ".$tele." , ". $company_address." , Manama , Kingdom of Bahrain "?><br>      
				<?PHP echo "  Email : ".$company_email. "     Web : www.sapphirebh.com"; ?>     
				
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
					  <td style="padding-left: 10px;padding-right: 10px">
						  
					<table width="800" border="0" cellspacing="0" cellpadding="5">
						<tbody>
						  <tr>
							<td width="50%" align="left" valign="top" style="padding-bottom: 0px;"></td>
							<td align="left" valign="top" >
								<table width="370px"  cellspacing="0" cellpadding="5">
								  <tbody>
									<tr >
									  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD">FINISHED INVENTORY LIST</td>
									</tr>
									<tr>
									  <td style="float: right;">Date : <strong><?PHP echo date("d-m-Y"); ?></strong></td>
									</tr>
								  </tbody>
								</table>
							</td>
						  </tr> 
						</tbody>
					</table>
						
						
						
						
					  </td>
					</tr>
					<tr>
					  <td style="padding-left: 10px;padding-right: 10px">
						  
						<table width="795px" border="0" cellspacing="0" cellpadding="5" style="border-collapse: collapse;">
						<tbody>
						  <tr>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px"><strong >SL</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:20px"> <strong>Item</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Store 1 Stock</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Store 2 Stock</strong></td>
						  </tr>
						  <?PHP 
								$ctr = 1;
								$tbl_inventory = mysqli_query($conns, "SELECT * FROM inventory_tbl WHERE inventory_category='Finished'");
								while($row = mysqli_fetch_assoc($tbl_inventory)) 
								{
								  $item_name = $row['item_name'];
								  $item_unit = $row['item_unit'];
								  $qty_in = $row['quantity_in'];
								  $qty_out = $row['quanity_out'];
								  $store2_quantity_in = $row['store2_quantity_in'];
								  $store2_quantity_out = $row['store2_quantity_out'];
								  $store1 = number_format(($qty_in-$qty_out),2);
								  $store2 = number_format(($store2_quantity_in-$store2_quantity_out),2);
								
	
										 if($ctr%2!=0)
										 {
								?>
										  <tr style="border-bottom: 1px solid gray;">
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $ctr;?></td>
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $item_name; ?></td>
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $item_unit; ?></td>
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $store1; ?></td>
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $store2; ?></td>
										  </tr>
									<?PHP 
									} else {
									?>
										<tr style="border-bottom: 1px solid gray;">
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $ctr;?></td>
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $item_name; ?></td>
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $item_unit; ?></td>
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $store1; ?></td>
											<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $store2; ?></td>
										</tr>
									<?PHP } ?>
										  
						  <?PHP 
								$ctr = $ctr +1; } 
						  ?>
						 
						</tbody>
					  </table></td>
					</tr>
					<tr >
					  <td style="padding-left: 10px;padding-right: 10px">&nbsp;</td>
					</tr>
				  </tbody>
				</table>

				<div style="text-align:right; padding-right:30px; margin-top: 200px;">
				   <input type="button" value="Export To Excel" onclick="fnExcelReport();" id="export_excel_but">
				   <input type="button" value="Print this page" onClick="window.print()" id="print_but">   
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
	var filename = "Machinery list.xls";
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
