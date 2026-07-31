$(document).ready(function(){
	
	var tbl_inventory_material = $('#tbl_inventory_material').DataTable({searching: false, paging: false, info: false,"ordering": false});
    $('#tbl_inventory_material').removeClass( 'display' ).addClass('table table-striped table-bordered');
    $('#tbl_inventory_material tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_inventory_material.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
    });
	
	var tbl_view_inventory_details = $('#tbl_view_inventory_details').DataTable({searching: false, paging: false, info: false,"ordering": false});
    $('#tbl_view_inventory_details').removeClass( 'display' ).addClass('table table-striped table-bordered');
    $('#tbl_view_inventory_details tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_view_inventory_details.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
    });
		
    $('#div_load_inventory').load('templates/material_inventory_combo.php');	
	
	$('#div_load_inventory').change(function(){
		var ids = $('option:selected', this).val();
	    load_inventory_fixed_item(ids);
	});
	

	$('#tbl_inventory_material tbody').on('click','button', function () {
		var $row = $(this).closest('tr');
		var data = tbl_inventory_material.row($row).data();    
		 if($(this).attr("name") == 'view_inventory_material')
		 {
			openNavR();
            load_tbl_view_inventory_details(data.ids);
			$('#txt_view_row_id').val(data.ids);  
            $('#span_iten_name').html("Inventory - "+data.item_name);  			
		 }                
    });
	
	$('#btn_print_pur_material').click(function(){
		
		window.open("reports/print_purchase_materail.php?_blank");

	});
	
	
	$('#btn_view_inventory_print').click(function(){
		
       var ids = $('#txt_view_row_id').val();
       window.open("reports/view_print_inv_material.php?row_ids="+ids,"_blank"); 

	});
	
	
	
//-----------------------Common Function---------------------------//
	function load_inventory_fixed_item(inventory_ids)
    {  
		tbl_inventory_material.destroy();     
		tbl_inventory_material = $('#tbl_inventory_material').DataTable( {
				
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/inventory_material/inventory_mat_controller.php',
					 'data': {
						action: 'list_inventory_material',
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
						
								edit_ivn_mat = '<button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" name="view_inventory_material" ><i class="material-icons ">remove_red_eye</i></button>';
								
								return edit_ivn_mat;

							},
					 },
				 ],
				 pageLength: 100,
				 searching: false,
				 
				 "fnRowCallback" : function(nRow, aData, iDisplayIndex){
					$('td:eq(0)', nRow).html(iDisplayIndex +1);
				   return nRow;
				},

		});
    }
	
	
	function load_tbl_view_inventory_details(ids)
    {  
		tbl_view_inventory_details.destroy();     
		tbl_view_inventory_details = $('#tbl_view_inventory_details').DataTable( {

				
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
				 pageLength: 100,
				 searching: false,
				 fixedColumns: true,
				 
				 
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
	
	
});