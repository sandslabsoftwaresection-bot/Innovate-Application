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
								<table width="370px"  cellspacing="0" cellpadding="5" align="right">
								  <tbody>
									<tr >
									  <td style="text-align: center; color: #FFFFFF; font-size: 26px; font-family: 'Century Gothic';" bgcolor="#0079DD" align="right">CONSUMABLE INVENTORY LIST</td>
									</tr>
									
								  </tbody>
								</table>
							</td>
						  </tr>
						  <tr>
						  <td align="left"></td>
						  <?php 
						    $result_item = mysqli_query($conns, "SELECT * FROM inventory_tbl  where ids = '".$_GET['row_ids']."'");
							while($row_item= mysqli_fetch_assoc($result_item)) 
							{
								$item_Name = $row_item['item_name'];
							} 
						  ?>
							<td align="right">
								<table width="370px"  cellspacing="0" cellpadding="5" align="right">
									  <tbody style="float: right;">
										<tr>
										  <td><strong><?PHP echo "Inventory - ".$item_Name; ?></strong></td>
										</tr>
										<tr>
										  <td>Date : <strong><?PHP echo date("d/m/Y"); ?></strong></td>
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
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px;"><strong >Date</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Ref No</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:70px"><strong>Inventory</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:70px"><strong>Description</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Qty</strong></td>
							<td bgcolor="#0079DD" style="text-align: center; color: #FFFFFF;font-size:15px;width:50px"><strong>Unit</strong></td>
						  </tr>
						  <?PHP 
						        $sum_qty_in = 0;
								$sum_qty_out = 0;
								$sql = "SELECT `inventory_id` as inventory_id,`inventory_name` as inventory_name,`description` as description,`qty` as qty,`unit` as unit,`purchase_recieved_date` as trans_date,
										`ref_no` as ref_no,'Purchased Received To Store1' as action,'PR' as type FROM `view_purchased_received_inventory`
										WHERE inventory_id='".$_GET['row_ids']."'  and (`parent_ids`!='' or `parent_ids` IS NOT NULL) UNION SELECT `inventory_id` as inventory_id,`inventory_name` as inventory_name,'' description ,`quantity` as qty,`invt_unit` as unit,
										`date_transfer` as trans_date,'' as ref_no,CASE WHEN stock_from = '1' THEN 'Transfer From Store1 To Store2' ELSE 'Transfer From Store2 To Store1' END as action,CASE WHEN stock_from = '1' THEN 'ST12' ELSE 'ST21' END as action 
										from tbl_transfer_stores WHERE inventory_id= '".$_GET['row_ids']."' UNION   SELECT `inventory_id` as inventory_id,`inventory_name` as inventory_name,'' as description,`qty` as qty,`unit` as unit,`entry_date` as trans_date,'' as ref_no,'Consume in Store2' as action,
										'CN2' as type FROM `view_store2_consume_inventory` WHERE inventory_id= '".$_GET['row_ids']."'  and (`parent_ids`!='' or `parent_ids` IS NOT NULL) UNION  SELECT `inventory_id` as inventory_id,`inventory_name` as inventory_name,description as description,`qty` as qty,
										`unit` as unit,`entry_date` as trans_date,ref_no as ref_no,'Deliver From Store2' as action,'GPOUT' as type FROM `view_gate_pass_inventory_out` WHERE inventory_id= '".$_GET['row_ids']."'  and (`parent_ids`!='' or `parent_ids` IS NOT NULL)UNION  SELECT `inventory_id` as inventory_id,
										`inventory_name` as inventory_name,description as description,`qty` as qty,`unit` as unit,`entry_date` as trans_date,ref_no as ref_no,'Return To Store2' as action,'PASSIN' as type FROM `view_pass_in_inventory_in` WHERE  inventory_id='".$_GET['row_ids']."'  and (`parent_ids`!='' or `parent_ids` IS NOT NULL) ORDER BY trans_date asc";
								$result = mysqli_query($conns, $sql);
								while($rows = mysqli_fetch_assoc($result)) 
								{
									$trans_date = $rows['trans_date'];
									$ref_no = $rows['ref_no'];
									$inventory_name = $rows['inventory_name'];
									$description = $rows['description'];
									$qty = $rows['qty'];
									$unit = $rows['unit'];  

								?>
									  <tr style="border-bottom: 1px solid gray;">
										<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $trans_date; ?></td>
										<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $ref_no; ?></td>
										<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $inventory_name; ?></td>
										<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $description; ?></td>
										<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $qty; ?></td>
										<td bgcolor="#f2f2f2" style="text-align: center"><?PHP echo $unit; ?></td>
									  </tr>
						  <?PHP } ?>
						  	<tr>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"><strong><?php //echo number_format($sum_qty_in, 2); ?></strong></td>
						    </tr>
						    <tr>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"></td>
								<td bgcolor="#f2f2f2" style="text-align: center"><strong><?php //echo "Balance: ".number_format(($sum_qty_in-$sum_qty_out),2); ?></strong></td>
						   </tr>
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
	var item = "<?php echo $item_Name; ?>";
	var filename = "Iventory list - "+item+".xls";
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
