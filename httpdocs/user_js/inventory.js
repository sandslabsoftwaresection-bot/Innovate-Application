$(document).ready(function(){

                
    var v_btn_generate_inventory = $( '#btn_generate_inventory' ).ladda();
               
    var tbl_inventory_list_list_table = $('#tbl_inventory_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});
    $('#tbl_inventory_list').removeClass( 'display' ).addClass('table table-striped table-bordered');                
               
        //load_data_to_grid_product_master_list();
    $( '#btn_edit_inventory' ).hide();
              
                
               
    v_btn_generate_inventory.click(function(){
      
        v_btn_generate_inventory.ladda( 'start' );           
		var v_category_id=$("#select_category option:selected").val();
		var v_category=$("#select_category option:selected").text();
		var v_unit_id=$("#select_unit option:selected").val();
		var v_unit_name=$("#select_unit option:selected").text();
		var v_item_name=$("#txt_item_name").val();
                  

		if(v_category_id=="0" || v_unit_id=="0" || v_item_name=="")
		{ 
	       v_btn_generate_inventory.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
			$.post("../controller/inventory/inventory_controller.php",
			{action:'generate_inventory',v_category_id:v_category_id,v_category:v_category,v_unit_name:v_unit_name,v_item_name:v_item_name}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_generate_inventory.ladda( 'stop' );
					 $.toast({
						heading: 'Success',
						text: 'Item added to Inventory..!',
						showHideTransition: 'slide',
						icon: 'success'
					});

				   load_data_to_grid_inventory_list(); 
				    clear_text();
					location.reload();
		    });
                
		}
    });
            
           
            
         $("#btn_view_list_of_inventory").click(function()
		 {
           load_data_to_grid_inventory_list();
		 });
		 
         function load_data_to_grid_inventory_list()
		 {
			 tbl_inventory_list_list_table.destroy();
				 
			 tbl_inventory_list_list_table = $('#tbl_inventory_list').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/inventory/inventory_controller.php',
						 'data': {
							action: 'list_inventory'
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
					"columns": [
						 { "data": null },
						 { "data": "inventory_category"},
						 { "data": "item_name"},
						 { "data": "item_unit"},
						 
						 { "data": "ids" ,
			 
			 
							  render: function ( data, type, rows, meta ) {
							
										str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_inventory" name="edit_inventory" data-dismiss="modal"><i class="material-icons " >edit</i></button>';
									
									return str_active_status_view;
	
								 },
								 
						

			 
					 },
					{ "data": "ids" ,
			 
			 
							  render: function ( data, type, rows, meta ) {
							
										str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_inventory" name="delete_inventory" ><i class="material-icons ">delete</i></button>';
									
									return str_active_status_view;
	
								 },
			 
					 },	 
	 
					 ],
					 pageLength: 25,
					 searching: false,
					 responsive: true,
					
					
					
					 "initComplete": function( settings, json ) {
							
					   
	 
					  },
					  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
						 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
						 return nRow;
					 },
					  "fnDrawCallback": function() {
					   
	 
					 },
			   
				
				 
			 });  
		
		 }
				 
			$('#btn_inventory').click(function(){
				location.reload();
			});	 
                 
                 
    $('#tbl_inventory_list tbody').on('click', 'td button', function (){             
		  var $row = $(this).closest('tr');
		  var data = tbl_inventory_list_list_table.row($row).data();
		  var v_inventory_id  = data.ids;
		  var v_item_unit  = data.item_unit;
		  $('#btn_generate_inventory').hide();
		  $('#btn_edit_inventory').show();
		  
		 if($(this).attr("name")=='edit_inventory')
		 { 
		   $('#select_category option:selected').text(data.inventory_category);
		   $('#select_unit option:selected').text(data.item_unit);
		   $('#txt_item_name').val(data.item_name);
		   $('#ids').val(data.ids);
		   closeNavR();
		 }
							 
		 if($(this).attr("name")=='delete_inventory')
		 { 
			swal({								
				title: "Are you sure?",
				text: "Do you want to delete the entry?",
				icon: 'warning',
				dangerMode: true,
				allowOutsideClick: false,
				closeOnClickOutside: false,
				buttons: {
				  cancel: 'No Cancel !',
				  delete: 'Yes Please Delete'
				}
				}).then(function (willDelete) {
				if (willDelete) {
				   delete_inventory_item(v_inventory_id);
				  // cancel_quotation_item_list(data.quotation_child_id,data.quotation_no);		 
				} else {
				}
			});
		
		 }
				 
		function delete_inventory_item(v_ids)
		{       
			$.post("../controller/inventory/inventory_controller.php",{action:'delete_invetory_action',v_ids:v_ids},
			function(result,status)
			{
				load_data_to_grid_inventory_list();					  
			});
				   
		} 
						
						
	/////////////////////////////////	
           
    });
	
	$('#btn_edit_inventory').click(function(){	
	
		var v_category = $("#select_category option:selected").text();
		var v_unit_name = $("#select_unit option:selected").text();
		var v_item_name = $("#txt_item_name").val();
		var ids = $("#ids").val();
	
		if($.trim(v_category)=="Select Category" || $.trim(v_unit_name)=="Select Unit" || $.trim(v_item_name)=="")
		{
		   swal('Warning',"Please fill the required field","warning");
		}
		else
		{		
			 $.post("../controller/inventory/inventory_controller.php",
			 {action:'edit_inventory',v_category:v_category, v_item_name:v_item_name, v_unit_name:v_unit_name, v_ids:ids}, 
			 function(result,status)
			 {
				result = $.trim(result);
				$.toast({
					heading: 'Success',
					text: 'Inventory updated successfully..!',
					showHideTransition: 'slide',
					icon: 'success'
				});
				load_data_to_grid_inventory_list();
				$("#btn_edit_inventory").hide();
				$("#btn_generate_inventory").show();
				clear_text();  
				location.reload();
			});			 
		}
	});
                
	
    function clear_text()
	{
	  $('#select_category option:selected').text("Select Category");
	  $('#select_unit option:selected').text("Select Unit");
      $("#txt_item_name").val(''); 
	}

});