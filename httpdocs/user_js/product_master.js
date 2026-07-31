$(document).ready(function(){
   
                
                 var v_btn_generate_product_master = $( '#btn_generate_product_master' ).ladda();
                 var v_btn_edit_product_master = $( '#btn_edit_product_master' ).ladda();
               
                var product_master_list_table = $('#tbl_product_master_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                
                 $('#tbl_product_master_list').removeClass( 'display' ).addClass('table table-striped table-bordered');                
               
                 load_data_to_grid_product_master_list();
                 $( '#btn_edit_product_master' ).hide();
              
                
               
            v_btn_generate_product_master.click(function(){
                      
                 
                    v_btn_generate_product_master.ladda( 'start' );
                    
                    var v_product_name=$("#txt_product_name").val();
                    var v_product_unit_id=$("#select_product_unit option:selected").val();
                    var v_product_unit_name=$("#select_product_unit option:selected").text();
                    var v_unit_rate=$("#txt_unit_rate").val();
                   
                    const editorData = editor.getData();
                   
                    var v_product_description= editorData;
                   console.log(v_product_description);
                    if($.trim(v_product_name)=="" || $.trim(v_product_unit_id)=="0" || $.trim(v_unit_rate)=="" || $.trim(v_product_description)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_generate_product_master.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/master_product/master_product_controller.php",{action:'generate_master_product',v_product_name:v_product_name,v_product_unit_id:v_product_unit_id,v_product_unit_name:v_product_unit_name,v_unit_rate:v_unit_rate,v_product_description:v_product_description
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               console.log(result);
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_generate_product_master.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_quotation_list()
                                    clear_text();
                                   

                                
                                }
                                else 
                                {
                                     v_btn_generate_product_master.ladda( 'stop' );
                                    
                                   
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item added to master product Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                    
                                   load_data_to_grid_product_master_list(); 
                                  
                                    clear_text();
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
            
            function clear_text()
                 {
                     
                    $('#txt_product_name').val('');
                    $('#select_product_unit').val('');
                    $('#txt_unit_rate').val('');
                   $
                    const editorData = editor.setData('');
                   
                         var v_product_description= editorData;
                       
                        $("#txt_product_description").val(v_product_description);
                     
                 }
            
            $('#btn_create_product_master').click(function(){
                    
                    location.reload(); 
                 
            });
                  
            function load_data_to_grid_product_master_list()
                 {
                     product_master_list_table.destroy();
                         
                     product_master_list_table = $('#tbl_product_master_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/master_product/master_product_controller.php',
                                 'data': {
                                    action: 'list_master_product'
                                    //v_quotation_no:quotation_no
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
                                 { "data": "product_name"},
                                 { "data": "product_description"},
                                { "data": "product_unit_name"},
                                 { "data": "product_rate"},
                                 
            					 { "data": "product_master_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_product_master" name="edit_product_master" data-dismiss="modal"><i class="material-icons " >edit</i></button>';
            								
            								return str_active_status_view;
            
            							 },
            							 
            					

					 
					         },
            				{ "data": "product_master_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_product_master" name="delete_product_master" ><i class="material-icons ">delete</i></button>';
            								
            								return str_active_status_view;
            
            							 },
					 
					         },	 
             
                             ],
                             pageLength: 25,
            				 searching: true,
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
                 
                 
            $('#tbl_product_master_list tbody').on('click', 'td button', function (){
                      
                      var $row = $(this).closest('tr');
                      var data = product_master_list_table.row($row).data();
                     var v_product_master_id  = data.product_id;
                         if($(this).attr("name")=='edit_product_master')
                         {
                             
            			   edit_current_data(); 
            			  closeNavR();
            			 }
            			 
            			  if($(this).attr("name")=='delete_product_master')
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
        						cancel_product_master_item_list(v_product_master_id);
        						       //cancel_quotation_item_list(data.quotation_child_id,data.quotation_no);
                     						 
        							} else {
        							    
        							   
        							 
        							}
        						 });
            			
            			 }
                        
                  
            
                   
            function edit_current_data()
                 {
                     
                       $('#txt_master_product_id_hidden').val(data.product_id);
                       $('#txt_product_name').val(data.product_name);
                       $('#select_product_unit').val(data.product_unit_name).change();
                       //$('#select_product_unit').val(data.product_unit_id);
                       $('#txt_unit_rate').val(data.product_rate);
                        const editorData = editor.setData(data.product_description);
                   
                         var v_product_description= editorData;
                       
                        $("#txt_product_description").val(v_product_description);
                    
                     
                        $( '#btn_generate_product_master' ).hide();
                        $( '#btn_edit_product_master' ).show();
                 }
                      
                  });
               
               
            function cancel_product_master_item_list(v_product_master_id)
                    {
                        
                        $.post("../controller/master_product/master_product_controller.php",{action:'cancel_product_master_item',v_product_master_id:v_product_master_id
                                }
                                , function(result,status)
                                {
                                             load_data_to_grid_product_master_list();
                                                  
                         });
                       
                    } 
                    
                    
            v_btn_edit_product_master.click(function(){
                      
                 
                    v_btn_edit_product_master.ladda( 'start' );
                    
                    var v_master_product_id=$("#txt_master_product_id_hidden").val();
                    var v_product_name=$("#txt_product_name").val();
                    var v_product_unit_id=$("#select_product_unit option:selected").val();
                    var v_product_unit_name=$("#select_product_unit option:selected").text();
                    var v_unit_rate=$("#txt_unit_rate").val();
                   // var v_product_description=$("#txt_product_description").val();
                    const editorData = editor.getData();
                   
                    var v_product_description= editorData;
                   console.log(v_product_description);
                    if($.trim(v_product_name)=="" || $.trim(v_unit_rate)=="" || $.trim(v_product_description)==""||$.trim(v_product_unit_id)=="0" )
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_edit_product_master.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/master_product/master_product_controller.php",{action:'edit_master_product',v_product_name:v_product_name,v_product_unit_name:v_product_unit_name,v_unit_rate:v_unit_rate,v_product_description:v_product_description,v_product_master_id:v_master_product_id
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               console.log(result);
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_edit_product_master.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_quotation_list()
                                    clear_text()
                                   

                                
                                }
                                else 
                                {
                                     v_btn_edit_product_master.ladda( 'stop' );
                                    
                                   
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Product updated  Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                    
                                    
                                    load_data_to_grid_product_master_list();
                                    $("#btn_edit_product_master").hide();
                                    $("#btn_generate_product_master").show();
                                    
                                     clear_text();
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
                 
                 let editor;
                
                        ClassicEditor
                            .create( document.querySelector( '#txt_product_description' ) )
                            .then( newEditor => {
                                editor = newEditor;
                            } )
                            .catch( error => {
                                console.error( error );
                            } );
                      
            function formatDate(date) {
                     
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
           
       
            $('#btn_view_list_of_quotations').click(function(){
                load_data_to_grid_product_master_list(); 
                 
             });  
                 
                
});