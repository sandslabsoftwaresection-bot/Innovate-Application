$(document).ready(function(){
	
	var tbl_inventory_mahinery = $('#tbl_inventory_mahinery').DataTable({searching: false, paging: false, info: false,"ordering": false});
    $('#tbl_inventory_mahinery').removeClass( 'display' ).addClass('table table-striped table-bordered');
    $('#tbl_inventory_mahinery tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_inventory_mahinery.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
    });
	
	
	var tbl_view_inventory_details_mac = $('#tbl_view_inventory_details_mac').DataTable({searching: false, paging: false, info: false,"ordering": false});
    $('#tbl_view_inventory_details_mac').removeClass( 'display' ).addClass('table table-striped table-bordered');
    $('#tbl_view_inventory_details_mac tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_view_inventory_details_mac.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
    });
	
	
    $('#div_load_inventory').load('templates/machinery_inventory_combo.php');	
	
    $('#div_load_inventory').change(function(){
		var ids = $('option:selected', this).val();
	    load_inventory_machinery_item(ids);
	});	
	
	$('#tbl_inventory_mahinery tbody').on('click','button', function () {
		var $row = $(this).closest('tr');
		var data = tbl_inventory_mahinery.row($row).data();    
		 if($(this).attr("name") == 'view_inventory_machinery')
		 {
			   openNavR();
			   load_view_inventory_machinery_item(data.ids);
			   $('#txt_view_row_id').val(data.ids);
			   $('#span_iten_name').html("Inventory - "+data.item_name);
		 }
                        
    });
	
	$('#btn_print_pur_machinery').click(function(){
		window.open("reports/print_purchase_machinery.php?_blank");
	});
	
	$('#btn_view_inventory_print_mac').click(function(){
		
       var ids = $('#txt_view_row_id').val();
       window.open("reports/print_view_inv_machinery.php?row_ids="+ids,"_blank"); 

	});
	
	function load_inventory_machinery_item(inventory_ids)
    {  
		tbl_inventory_mahinery.destroy();     
		tbl_inventory_mahinery = $('#tbl_inventory_mahinery').DataTable( {
				
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/inventory_material/inventory_mat_controller.php',
					 'data': {
						action: 'list_inventory_machinery',
						v_inventory_ids:inventory_ids
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
					 { "data": null},
					 { "data": "item_name"},
					 { "data": "item_unit"},
					 { "data": "Store1"},
					 { "data": "Store2"},
					 { "data": null,
						 render: function ( data, type, rows, meta ) 
						   {
						
								edit_ivn_mat = '<button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" name="view_inventory_machinery" ><i class="material-icons ">remove_red_eye</i></button>';
								
								return edit_ivn_mat;

							},
					 }
				 ],
				 pageLength: 25,
				 searching: false,
				 
				 "fnRowCallback" : function(nRow, aData, iDisplayIndex){
					$('td:eq(0)', nRow).html(iDisplayIndex +1);
				   return nRow;
				},
				// responsive: true,
		});
    }
	
	
	function load_view_inventory_machinery_item(ids)
    {  
		tbl_view_inventory_details_mac.destroy();     
		tbl_view_inventory_details_mac = $('#tbl_view_inventory_details_mac').DataTable( {
				
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/inventory_material/inventory_mat_controller.php',
					 'data': {
						action: 'list_view_inventory_details',
						v_view_ids:ids
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
				     { "data": "trans_date",className: "text-center"},
					 { "data": "inventory_name"},
					 { "data": "description"},
					 { "data": "qty",className: "text-center"},
					 { "data": "unit",className: "text-center"},
					 { "data": "action"},
					 { "data": "ref_no",className: "text-center"}
				 ],
				 pageLength: 25,
				 searching: false,
				 
				 "fnRowCallback" : function(nRow, aData, iDisplayIndex){
					$('td:eq(0)', nRow).html(iDisplayIndex +1);
				   return nRow;
				},
                
				// "footerCallback": function ( row, data, start, end, display ) 
				// {
					 // var api = this.api();
		 
					 //Remove the formatting to get integer data for summation
					// var intVal = function ( i ) {
						// return typeof i === 'string' ?
							// i.replace(/[\$,]/g, '')*1 :
							// typeof i === 'number' ?
								// i : 0;
					// };
		 
					//Total Quantity In
					// total_qty_in = api
						// .column(4, { page: 'current' })
						// .data()
						// .reduce( function (a, b) {
							// return intVal(a) + intVal(b);
						// }, 0 );
				   
					//Total Quantity Out
					// total_qty_out = api
						// .column( 5, { page: 'current'} )
						// .data()
						// .reduce( function (a, b) {
							// return intVal(a) + intVal(b);
						// }, 0 );
						
						
					// var qty_bal = (total_qty_in-total_qty_out);				
				   
					//Update footer
					// $(api.column(4).footer()).html(total_qty_in.toFixed(2));
					// $(api.column(5).footer()).html(total_qty_out.toFixed(2)+"<br /> Balance : "+qty_bal.toFixed(2));   			
			    // }
		});
    }
	

	function current_date()
	{
		var currentDate = new Date();
		var day = currentDate.getDate();
		var month = currentDate.getMonth() + 1;
		var year = currentDate.getFullYear();
		var formattedDate = ('0' + day).slice(-2) + '-' + ('0' + month).slice(-2) + '-' + year;
	    return formattedDate;
	}
	
	
	// function DeleteFixed_Item(delete_ids)
	// {
		// $.post('../controller/inventory_material/inventory_mat_controller.php',
		// {action:"delete_fixed_inventory_item",v_delete_ids:delete_ids},function(result, status){ 
		  // tbl_inventory_mahinery.ajax.reload();
		// });
	// }
	
	
});