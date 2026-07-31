$(document).ready(function(){
   
                
                
	var con_inventory_list_table = $('#list_of_consume_inventory').DataTable({searching: true, paging: true, info: false,"ordering": false});
	
	 $('#list_of_consume_inventory').removeClass( 'display' ).addClass('table table-striped table-bordered');
	  $('#list_of_consume_inventory tbody').on( 'click', 'tr', function () {
			if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { con_inventory_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
	  });

	var tbl_con_inventory_child = $('#tbl_con_inventory_child').DataTable({searching: false, paging: false, info: false,"ordering": false});
	
	$('#tbl_con_inventory_child').removeClass( 'display' ).addClass('table table-striped table-bordered');
	$('#tbl_con_inventory_child tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_con_inventory_child.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
	});	  
	
	var finished_pdt_view_list_table = $('#list_of_finished_pdt').DataTable({searching: false, paging: false, info: false,"ordering": false});
	
	$('#list_of_finished_pdt').removeClass( 'display' ).addClass('table table-striped table-bordered');
	$('#list_of_finished_pdt tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { finished_pdt_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
	});	  
				  
	$('#div_card_2').hide();

	
				  
	load_lpo_no_select('div_fin_invnt_select','select_fin_invn');
	function load_lpo_no_select(div_name,fin_invn_ctrl_name)
	{ 
	   $("#"+div_name).load('../controller/finished_products/finished_products_controller.php',{action:'select_fin_inventory',v_fin_invn_ctrl_name:fin_invn_ctrl_name},function(result,status){});
	}
	
	
	
	var v_inventory_id,v_inventory_unit,obj;
	
	$("#div_fin_invnt_select").change(function() {
		
		v_inventory_id = $('option:selected', this).val() ;
		//alert(v_inventory_id);
	  
		$.post("../controller/finished_products/finished_products_controller.php",{action:'get_inventory_unit',v_inventory_id:v_inventory_id},function(result,status){
					
					if(status=="success")
					{
						obj= jQuery.parseJSON(result);
						console.log(obj.data[0].item_unit);
						v_inventory_unit = obj.data[0].item_unit;
						$("#txt_inventory_unit").val(v_inventory_unit);
					}
					else
					{
						return false;
					}
		});           
	   
	});
	
	$('#btn_add_list').click(function(){
		
		v_inventory_id = $('#select_fin_invn option:selected').val();
		var v_inventory_name = $('#select_fin_invn option:selected').text();
		var v_qty = $('#txt_fin_qty').val();
		
		if(v_inventory_id == '0' || v_qty == '')
		{
			swal("Warning","Please fill all the fields...!", "warning"); 
			return false;
		}
		else
		{
		
			$.post("../controller/finished_products/finished_products_controller.php",{action:'add_finished_pdt',v_inventory_id:v_inventory_id, v_inventory_name:v_inventory_name, v_qty:v_qty,v_inventory_unit:v_inventory_unit},
				function(result,status)
				{
					
					$('#txt_last_id').val($.trim(result));
					
					$.toast({
					heading: 'Success',
					text: 'Added successfully..!',
					showHideTransition: 'slide',
					icon: 'success'
					}); 
					
					$('#div_card_2').show();
					$('#div_card_1').hide();
					load_data_to_grid_con_inventory_list();
					$('#finished_in_name').text(v_inventory_name);
					$('#qty').text(v_qty);
					$('#unit').text(v_inventory_unit);
				});
		}
		
	});
	
	function load_data_to_grid_con_inventory_list()
	 {
		 con_inventory_list_table = $('#list_of_consume_inventory').DataTable( {
				
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/finished_products/finished_products_controller.php',
					 'data': {
						action: 'list_con_inventory'
					 }
				 },
				 "language": {
					 "zeroRecords": "No records available",
					 "infoEmpty": "No records available",
				  },
				"order": [[ 0, "desc" ]],
				"bPaginate": false,
				"bLengthChange": false,
				"bFilter": true,
				"bInfo": false,
				"autoWidth": false,
				"columns": [
					
					 { "data": null,"width":'20px',className: "text-center"},
					 { "data": "item_name",className: "text-center"},
					 { "data": "Stock" , className: "text-center"},
					 { "data": "Transfer_amount" ,"width":'20%', className: "text-center",
						render: function ( data, type, rows, meta ) 
						{
							var trnsfr_amt_edit =' <input type="number"  id="txt_consume_qty_'+rows["ids"]+'" name="txt_consume_qty" value = "0.00" style="width:100px; text-align: center;">';
							return trnsfr_amt_edit;
						},
					 },
					 { "data": "Transfer", className: "text-center",
						render: function ( data, type, rows, meta ) 
						{
							str_transfer = ' <button type="button" class="btn btn-sm success-gradient mr-2"  id="btn_add" name="btn_add">Add</button>';
							return str_transfer;
						},
						 
					 },
					 
				 ],
				 pageLength: 100,
				 searching: true,
				 responsive: true,
				 destroy: true,
				 
				 "initComplete": function( settings, json ) {
				  },
				   "order": [
					  [3, 'asc']
					],
				  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
					 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
					 return nRow;
				  },
					"displayLength": 100,
					
					"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [  0,1,2,3,4] }, 
					
				],
					
			 
				
		 });  
	
	 }
		var master_id;
		 $('#list_of_consume_inventory tbody').on('click', 'td button', function() {
			 
			 var $row = $(this).closest('tr');
			 var data = con_inventory_list_table.row($row).data();
			 
			master_id = $('#txt_last_id').val();
			 
			 v_inventory_id = data.ids;
			 var v_inventory_name = data.item_name;
			 var stock_qty  = data.Stock;
			 var v_inventory_unit  = data.item_unit;
			 
			var inputId = 'txt_consume_qty_' + v_inventory_id;
			var consume_qty = $('#' + inputId).val();
			
			if(master_id == '')
			{
				swal("Warning","Reference Id is missing", "warning"); 
				return false;
			}
			if(consume_qty <= "0.00" || consume_qty == '')
			 {
				swal("Warning","Please provide transfer quantity", "warning"); 
				return false;
			 }
			 if(consume_qty > parseFloat(stock_qty))
			 {
				swal("Warning","Qty should be less than Stock", "warning"); 
				return false;
			 }
			 else
			 {
				//alert(master_id);
				$.post("../controller/finished_products/finished_products_controller.php",{action:'add_finished_pdt_child',v_inventory_id:v_inventory_id, v_inventory_name:v_inventory_name, v_consume_qty:consume_qty, v_master_id:master_id,v_inventory_unit:v_inventory_unit},
						function(result,status)
						{
						   $.toast({
							heading: 'Success',
							text: 'Added successfully..!',
							showHideTransition: 'slide',
							icon: 'success'
							}); 
							load_data_to_grid_con_inventory_list();
							load_con_inventory_list_add(master_id);
					 });
			 }
			
		 });
				 
				 
				 
		function load_con_inventory_list_add(master_id)
		{
			tbl_con_inventory_child.destroy();     
			tbl_con_inventory_child = $('#tbl_con_inventory_child').DataTable( {          
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/finished_products/finished_products_controller.php',
						 'data': {
							action: 'list_finished_pdt_child',
							v_master_id:master_id
						 }
					 },
					 "language": {
						 "zeroRecords": "No records available",
						 "infoEmpty": "No records available",
					  },
					"order": [[ 0, "desc" ]],
					"bPaginate": false,
					"bLengthChange": false,
					"bFilter": false,
					"bInfo": false,
					"autoWidth": false,
					"scroller": true,
					"columns": [
						 { "data": null,className: "text-center"},
						 { "data": "inventory_name",className: "text-center"},
						 { "data": "consume_qty",className: "text-center"},
						 { "data": null,className: "text-center",
							 render: function ( data, type, rows, meta ) 
							   {
							
									action_pur_recie = '<button type="button" class="btn btn-sm btn-danger mr-1" name="btn_delete"><i class="material-icons">delete</i></button>';
									
									return action_pur_recie;

								},
						 },
					 ],
					 pageLength: 25,
					 searching: false,
					 
					 "fnRowCallback": function (nRow, aData, iDisplayIndex) {
					 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
					 return nRow;
				  },
			});
		}

		$('#tbl_con_inventory_child tbody').on('click', 'td button', function() {
			 
			 var $row = $(this).closest('tr');
			 var data = tbl_con_inventory_child.row($row).data();              
               
			 var child_id = data.ids;
			 var consume_qty = data.consume_qty;
			 v_inventory_id = data.inventory_id;
			 
			 $.post("../controller/finished_products/finished_products_controller.php",{action:'delete_finished_pdt_child',v_consume_qty:consume_qty, v_child_id:child_id,v_inventory_id:v_inventory_id},
				function(result,status)
				{
				   $.toast({
					heading: 'Success',
					text: 'Deleted successfully..!',
					showHideTransition: 'slide',
					icon: 'success'
					}); 
					load_data_to_grid_con_inventory_list();
					load_con_inventory_list_add(data.master_ids);
			 });
			   
		});
		
		$('#btn_refresh_page').click(function(){
			location.reload();
		});
		
		
		function load_data_to_grid_view_finished_pdt_list()
		 {
			 finished_pdt_view_list_table.destroy();
				 
			 finished_pdt_view_list_table = $('#list_of_finished_pdt').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/finished_products/finished_products_controller.php',
						 'data': {
							action: 'list_finished_pdt_view',
							
						 }
					 },
					 "language": {
						 "zeroRecords": "No records available",
						 "infoEmpty": "No records available",
					  },
					"order": [[ 0, "desc" ]],
						"bPaginate": false,
						"bLengthChange": true,
						"bFilter": true,
						"bInfo": true,
						"autoWidth": false,
					"columns": [
					  
						 { "data": null },
						 { "data": "finished_pdt_name"},
						 { "data": "pdt_qty"},
						 { "data": "pdt_unit"},
						 { "data": "insert_date"},
						 { "data": "ids" ,
				 
				 
								  render: function ( data, type, rows, meta ) {
								
											str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_finished_pdt" name="view_finished_pdt" ><i class="material-icons ">remove_red_eye</i></button>';
										
										return str_active_status_view;
		
									 },
									 
				 
						 },
						 { "data": "ids" ,
				 
				 
								  render: function ( data, type, rows, meta ) {
								
											str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_finished_pdt" name="delete_finished_pdt" ><i class="material-icons ">delete</i></button>';
										
										return str_active_status_view;
		
									 },
				 
						 },
	 
	 
					 ],
					 pageLength: 25,
					 searching: false,
					// responsive: true,
					
					"fnRowCallback": function (nRow, aData, iDisplayIndex) {
						 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
						 return nRow;
					  },
					
					
					 "initComplete": function( settings, json ) {
					  
											  
	 
					  },
					  
					  "fnDrawCallback": function() {
					   
	 
					 }
				
				 
			 });  
		
		 }
		 
		 
		$('#btn_view_list_of_finished_pdt').click(function(){
			load_data_to_grid_view_finished_pdt_list();
		});
		
		var v_finished_pdt_id;
		 $('#list_of_finished_pdt tbody').on('click', 'td button', function (){
			 
				var $row = $(this).closest('tr');
				var data = finished_pdt_view_list_table.row($row).data();
				
				//v_finished_pdt_id = data.ids;
				
				if($(this).attr("name")=='view_finished_pdt')
                {
					$('#finished_in_name').text(data.finished_pdt_name);
					$('#qty').text(data.pdt_qty);
					$('#unit').text(data.pdt_unit);
					
					$('#txt_last_id').val(data.ids);
					
					$('#div_card_2').show();
					$('#div_card_1').hide();
					
					load_data_to_grid_con_inventory_list();
					load_con_inventory_list_add(data.ids);
					
					closeNavR();
				}
				
				if($(this).attr("name")=='delete_finished_pdt')
                {
					$.post("../controller/finished_products/finished_products_controller.php",{action:'delete_finished_pdt_main',v_master_id:data.ids,v_qty:data.pdt_qty,v_inventory_id:data.finished_pdt_id},
						function(result,status)
						{
							if($.trim(result) > 0)
							{
								swal("Warning","Please delete all the added inventories before deleting the entry", "warning"); 
								return false;
							}
							else
							{
								swal({                                                       
									title: "Are you sure?",
									text: "Do you want to delete the entry?",
									icon: 'warning',
									buttons: true,
									dangerMode: true,
									}).then((willDelete) => {
									if (willDelete) {
										$.toast({
										heading: 'Success',
										text: 'Deleted successfully..!',
										showHideTransition: 'slide',
										icon: 'success'
										}); 
										load_data_to_grid_view_finished_pdt_list();
									} 
								 }); 
								
								
							}
						   
					});
				}
				
		 });
		 
});