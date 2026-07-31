$(document).ready(function(){
   
                var v_btn_amt_type_add = $( '#btn_amt_type_add' ).ladda();
                var v_btn_amt_type_edit = $( '#btn_amt_type_edit' ).ladda();
                
                //var company_list_table = $('#list_of_companies').DataTable({});
                
                var list_of_amt_type_table = $('#list_of_amt_type').DataTable({searching: true, paging: true, info: false,"ordering": false});
                
                //var invoice_view_list_table = $('#list_of_invoices').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 $('#list_of_amt_type').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 //$('#list_of_invoices').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#list_of_amt_type').addClass('pagination-sm');
                  $('#list_of_amt_type tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { list_of_amt_type_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                //  $('#list_of_invoices tbody').on( 'click', 'tr', function () {
                //     if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { invoice_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                //  }); 
                 
                 $( '#btn_amt_type_edit' ).hide();
                
               function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
         
   
                
                
           
    
                v_btn_amt_type_add.click(function(){
                    
                    v_btn_amt_type_add.ladda( 'start' );
                    
                    var v_amt_type=$("#txt_amt_type").val();
            
                    if($.trim(v_amt_type)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_amt_type_add.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/amount_type/amount_type_controller.php",{action:'add_amt_type',v_amt_type:v_amt_type}
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_amt_type_add.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   

                                
                                }
                                else 
                                {
                                     v_btn_amt_type_add.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'New amount type added successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                     clear_text();
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
            
                      
                 function clear_text()
                 {
                    $("#txt_amt_type").val('');
                 }
            
          
                function load_data_to_grid_amt_type_list()
                 {
                    // company_list_table.destroy();
                         
                     list_of_amt_type_table = $('#list_of_amt_type').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/amount_type/amount_type_controller.php',
                                 'data': {
                                    action: 'list_amt_type'
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            				"bPaginate": true,
            				"bLengthChange": false,
            				"bFilter": false,
            				"bInfo": false,
            				"autoWidth": false,
                            "columns": [
                                //   {
                                //     "className":  'details-control',
                                //     "orderable":  false,
                                //     "data":        null,
                                //     "defaultContent": ''
                                //  },
                                 { "data": null},
                                 { "data": "type_id","visible":false },
                                 { "data": "type_name" },
                                 { "data": "type_id",
                                 
                                     render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_amt_type" name="edit_amt_type" ><i class="material-icons ">remove_red_eye</i></button>';
            								
            								return str_active_status_view;
            
            							 },
                                     
                                 },
                                 
                                 { "data": "type_id",
                                 
                                     render: function ( data, type, rows, meta ) {
            						
            									str_active_status_delete = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_amt_type" name="delete_amt_type" ><i class="material-icons ">delete</i></button>';
            								
            								return str_active_status_delete;
            
            							 },
                                     
                                 },
             
                             ],
                             pageLength: 25,
            				 searching: true,
                             responsive: true,
                             destroy: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                                    
                               
             
                              },
                              "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                     $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                     return nRow;
                  },
                  "drawCallback": function (settings) {
                       $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                  }
                            
                     });  
                    
                
                 }
                 
            $('#btn_create_new_amt_type').click(function(){
                  location.reload(true); 
                 
                 });
                 
               
                 $('#list_of_amt_type tbody').on('click', 'td button', function(){	
					var $row = $(this).closest('tr');
					var data = list_of_amt_type_table.row($row).data();
					v_amt_type_id  = data.type_id;
					$("#txt_amt_type").val('');
				  
				
					$( '#btn_amt_type_add' ).hide();
					$( '#btn_amt_type_edit' ).show();
					
					 if($(this).attr("name")=='edit_amt_type')
					 {
						 edit_amt_type(v_amt_type_id);
						 closeNavR();
					 }
					 
					 
					if($(this).attr("name")=='delete_amt_type')
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
							
								   delete_amt_type(v_amt_type_id);
										 
								} else 
									{
										
									}
								});
					}
					
					  function  edit_amt_type(v_amt_type_id) 
					   {
						//alert(data.account_name);
						$("#txt_amt_type_id").val(v_amt_type_id);   
						$("#txt_amt_type").val(data.type_name);
						$('#btn_amt_type_edit' ).show();
						 
						closeNavR();
					   }  
					});
                  
				  
				  function delete_amt_type(v_amt_type_id)
                    {
                        
					$.post("../controller/amount_type/amount_type_controller.php",{action:'cancel_amt_type',v_amt_type_id:v_amt_type_id}
											, function(result,status)
											{
										        swal("System is deactivated the amount type", {
																title: 'Warning',
																icon: "warning",
															 });
												
					 });
					 
					 load_data_to_grid_amt_type_list();
                       
                    }
                 
				 
				 v_btn_amt_type_edit.click(function(){
                      
                 
                    v_btn_amt_type_edit.ladda( 'start' );
                    var v_amt_type_id=$("#txt_amt_type_id").val(); 
                    var v_amt_type=$("#txt_amt_type").val();
                    if($.trim(v_amt_type)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_amt_type_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/amount_type/amount_type_controller.php",{action:'edit_amt_type',v_amt_type_id:v_amt_type_id,v_amt_type:v_amt_type}
                                , function(result,status)
                               
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_amt_type_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_btn_amt_type_edit.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Amount type details edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $("#txt_amt_type").val('');
                                     $( '#btn_amt_type_add' ).show();
                                     $( '#btn_amt_type_edit' ).hide();
                                    
                                     
                                    load_data_to_grid_amt_type_list();
                                     clear_text();
                                    
                                }
                            
                        }); 
                     }
            
                   
                });
               
                
                  
                 $('#btn_view_list_of_units').click(function(){
					 
                    load_data_to_grid_amt_type_list(); 
                     
                 });     
                 
                 
                $('#btn_amt_type_cancel').click(function(){
                     
                    clear_text();
                     
                 }); 

});