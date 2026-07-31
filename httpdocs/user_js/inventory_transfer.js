$(document).ready(function(){
   
                
                
                var inventory_list_table = $('#list_of_inventory').DataTable({searching: true, paging: true, info: false,"ordering": false});
				
                 $('#list_of_inventory').removeClass( 'display' ).addClass('table table-striped table-bordered');
                  $('#list_of_inventory tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { inventory_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
				  
				  var store_id,v_inventory_id;
                  $("#select_store").change(function() {
                      
                   
                    store_id = $(this).val() ;
                    //alert(store_id);
					
					if(store_id == '0')
					{
						swal("Warning","Please select store", "warning");
						return false;
					}
					else
					{
						var selectedText = $(this).find("option:selected").text();
						$("#head_tbl").text(selectedText);
						
						load_data_to_grid_inventory_list(store_id);
					}
                     
                 });
                
             
            
                function load_data_to_grid_inventory_list()
                 {
                     inventory_list_table = $('#list_of_inventory').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/inventory_transfer/inventory_transfer_controller.php',
                                 'data': {
                                    action: 'list_inventory',
									v_store_id:store_id
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            				"bPaginate": true,
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
										var trnsfr_amt_edit =' <input type="number"  id="txt_transfer_qty_'+rows["ids"]+'" name="txt_transfer_qty" value = "0.00" style="width:100px; text-align: center;">';
										return trnsfr_amt_edit;
                					},
								 },
                                 { "data": "Transfer", className: "text-center",
                                    render: function ( data, type, rows, meta ) 
									{
            							str_transfer = ' <button type="button" class="btn btn-sm success-gradient mr-2"  id="btn_transfer" name="btn_transfer" ><i class="material-icons ">launch</i></button>';
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
                 // var transfer_qty;
                 // $('#list_of_inventory tbody').on('change', 'td input[name="txt_transfer_qty"]', function(){
                     
                     
                        // var $row = $(this).closest('tr');
                        // var data = inventory_list_table.row($row).data();
                        
                        // v_inventory_id  = data.ids;
						// var stock_qty  = data.Stock;
						
                        // transfer_qty = $(this).val();
						
						
						// if(transfer_qty > stock_qty)
						// {
							// swal("Warning","Qty should be less than Stock", "warning");
							// $(this).val('0.00');
						// }
						// if(transfer_qty <= '0.00' || transfer_qty == '')
						// {
							// swal("Warning","Please provide transfer quantity", "warning");
							// $(this).val('0.00');
						// }
				 // });
				 
				 $('#list_of_inventory tbody').on('click', 'td button', function() {
					 
					 var $row = $(this).closest('tr');
                     var data = inventory_list_table.row($row).data();
					 
					 var v_inventory_id = data.ids;
					 var v_inventory_name = data.item_name;
					 var stock_qty  = data.Stock;
					 var v_inventory_unit  = data.item_unit;
					 
					var inputId = 'txt_transfer_qty_' + v_inventory_id;
					var transfer_qty = $('#' + inputId).val();
					
					 if(transfer_qty <= "0.00" || transfer_qty == '')
					 {
						swal("Warning","Please provide transfer quantity", "warning"); 
						return false;
					 }
					 if(transfer_qty > parseFloat(stock_qty))
					 {
						swal("Warning","Qty should be less than Stock", "warning"); 
						return false;
					 }
					 else
					 {
					    // alert("test");
						$.post("../controller/inventory_transfer/inventory_transfer_controller.php",{action:'transfer_store_qty',v_inventory_id:v_inventory_id, v_inventory_name:v_inventory_name, v_transfer_qty:transfer_qty, v_store_id:store_id,v_inventory_unit:v_inventory_unit},
								function(result,status)
								{
								   $.toast({
									heading: 'Success',
									text: 'Store transfered successfully..!',
									showHideTransition: 'slide',
									icon: 'success'
									}); 
									load_data_to_grid_inventory_list();
							 });
					 }
					
				 });
              
               
});