 $(document).ready(function(){
            $('#div_company_receipt').load('templates/company_combos.php');
            $('#other_company_add').hide(); 

            $("#div_company_receipt").change(function() {

                $('#txt_thanks').val($('option:selected', this).text()) ;
                $('#txt_thanks_id').val($('option:selected', this).val()) ;
                var othercompany =$('#select_company').val();
                if(othercompany==='Na'){
                    $('#other_company_add').show(); 
                 
                }else {
                    $('#other_company_add').hide();
                    $('#other_company_add').val(''); 
                }
            });
            
            var receipts_list_table = $('#list_of_receipt').DataTable({searching: false, paging: false, info: false,"ordering": false});
              $('#btn_edit_receipt').hide();
                $('#list_of_receipt').removeClass( 'display' ).addClass('table table-striped table-bordered');
                
               function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
    
	
    		$('#div_company_receipt').load('templates/company_combos.php');
            load_company_select_box('div_company_receipt','select_company');
             
         
         
            function load_company_select_box(div_name,ctrl_name)
            {

            $("#"+div_name).load('../controller/receipts/receipts_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});

            }
                        
            $("#txt_receipt_amount").on("keypress", function (e) {
               
                if (e.which != 8 && e.which != 0 && ((e.which < 48 || e.which > 57) && e.which != 46)) {
                    e.preventDefault();
                }
            });
            
            $("#txt_receipt_sum,#txt_receipt_amount").change(function(){
                
               v_receipt_sum = $("#txt_receipt_sum").val();
               if(v_receipt_sum == '')
               {
                   v_receipt_sum==0.000;
               }
               else
               {
               v_receipt_sum = parseFloat(v_receipt_sum).toFixed(3);
              
               }
                $("#txt_receipt_sum").val(v_receipt_sum);
              
            })
           $( "#txt_receipt_amount").change(function(){
                v_receipt_amount = $("#txt_receipt_amount").val();
              
               if(v_receipt_amount === '')
               {
                  v_receipt_amount=0.000; 
               }
               else
               {
               v_receipt_amount = parseFloat(v_receipt_amount).toFixed(3);
               }
               
               $("#txt_receipt_amount").val(v_receipt_amount);
           });
            
 
 $('#btn_generate_receipt').click(function(){
                
                var v_txt_receipt_no = $('#txt_receipt_no').val();
                var v_rdo_receipt_payment_type = $("input[name='option']:checked"). val();
                var v_txt_receipt_date =formatDate ($('#txt_receipt_date').val());
                
                var v_txt_thanks_id=$('#txt_thanks_id').val();
                var v_txt_receipt_sum = $('#txt_receipt_sum').val();
                var v_txt_receipt_method = $('#txt_receipt_method').val();
                var v_txt_receipt_bank = $('#txt_receipt_bank').val();
                var v_txt_receipt_cheque_date = formatDate($('#txt_receipt_cheque_date').val());
              
                var v_txt_receipt_settelment_invoice = $('#txt_receipt_settelment_invoice').val();
                var v_txt_receipt_received_by = $('#txt_receipt_received_by').val();
                var v_txt_receipt_varified_by = $('#txt_receipt_varified_by').val();
                var v_txt_receipt_amount = $('#txt_receipt_amount').val();
                var v_txt_description = $('#txt_description').val();
                
                console.log(v_rdo_receipt_payment_type);
                if(v_txt_thanks_id==='Na'){
                    var v_txt_thanks = $('#other_company_add').val();
                }else
                {
                    var v_txt_thanks = $('#txt_thanks').val();
                }
                console.log('v_txt_thanks',v_txt_thanks);
                console.log('v_txt_thanks_id',v_txt_thanks_id);
                $.post( "../controller/receipts/receipts_controller.php", { 
                                      action :'add_receipts',
                                      txt_receipt_no: v_txt_receipt_no,
                                      rdo_receipt_payment_type: v_rdo_receipt_payment_type ,
                                      txt_receipt_date : v_txt_receipt_date,
                                      txt_thanks : v_txt_thanks,
                                      txt_thanks_id:v_txt_thanks_id,
                                      txt_receipt_sum : v_txt_receipt_sum,
                                      txt_receipt_method : v_txt_receipt_method,
                                      txt_receipt_bank : v_txt_receipt_bank,
                                      txt_receipt_cheque_date : v_txt_receipt_cheque_date,
                                      txt_receipt_settelment_invoice : v_txt_receipt_settelment_invoice,
                                      txt_receipt_received_by : v_txt_receipt_received_by,
                                      txt_receipt_varified_by : v_txt_receipt_varified_by,
                                      txt_receipt_amount : v_txt_receipt_amount,
                                      txt_description :v_txt_description,
                                      txt_created_by_id : $.cookie('user_id'),
                                      txt_created_by_name : $.cookie('user_name')
                    
                }).done(function( data ) {
                        //alert( "Data Loaded: " + data );
                        $('#txt_receipt_no').val(data);
                                    $.toast({
                                        heading: 'Success',
                                        text: 'Payment voucher generated successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                        
                        }).fail(function() {
                                    $.toast({
                                        heading: 'Error',
                                        text: 'Error in generating payment voucher',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                          });
                
            });
            $("#btn_create_new_users").click(function(){
                
                location.reload();
            })
            
            
             
               
             function load_data_to_grid_view_receipts_list()
                 {
                     receipts_list_table.destroy();
                         
                     receipts_list_table = $('#list_of_receipt').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/receipts/receipts_controller.php',
                                 'data': {
                                    action: 'list_receipt_view',
                                    
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
                              
                                 { "data": "receipts_id","visible":false },
                                 { "data": "receipts_date"},
                                 { "data": "receipts_no"},
                                 { "data": "received_from"},
                                 { "data": "total_amount"},
                                 { "data": "receipts_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_receipts" name="view_receipts" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         },
    					         { "data": "receipts_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_receipts" name="delete_receipts" ><i class="material-icons ">delete</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         },
             
                             ],
                             pageLength: 25,
            				 searching: false,
                             responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                                                      
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 }
                 
            
            
             function load_data_to_grid_view_receipts_list_between(receipt_from_date,receipt_to_date)
                 {
                     receipts_list_table.destroy();
                         
                     receipts_list_table = $('#list_of_receipt').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/receipts/receipts_controller.php',
                                 'data': {
                                    action: 'list_receipt_view_between',
                                    from_date:receipt_from_date,
                                    to_date:receipt_to_date
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
                              
                                 { "data": "receipts_id","visible":false },
                                 { "data": "receipts_date"},
                                 { "data": "receipts_no"},
                                 { "data": "received_from"},
                                 { "data": "total_amount"},
                                 
                                 { "data": "receipts_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_receipts" name="view_receipts" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         },
    					         { "data": "receipts_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_receipts" name="delete_receipts" ><i class="material-icons ">delete</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         },
             
                             ],
                             pageLength: 25,
            				 searching: false,
                             responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                                                      
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 }     
            
             $('#btn_search_date').click(function(){
                     var v_receipt_from_date = formatDate($("#txt_start_date").val());
                     var v_receipt_to_date = formatDate($("#txt_end_date").val());
                     load_data_to_grid_view_receipts_list_between(v_receipt_from_date,v_receipt_to_date);
                   
                  });
            
            $('#btn_receipt_print').click(function(){
                //window.open('reports/receipt_print.php?receipts_no='+$('#txt_receipt_no').val(),'_blank');
                window.open("reports/pdf/print/receipt_print.php?receipts_no="+$('#txt_receipt_no').val()+"&x=1","_blank"); 
                  
			
			});
            
            
              $('#btn_receipt_print_with_head').click(function(){
				  window.open("reports/pdf/print/receipt_print.php?receipts_no="+$('#txt_receipt_no').val()+"&x=0","_blank"); 
                       
                //window.open('reports/receipt_print_with_head.php?receipts_no='+$('#txt_receipt_no').val(),'_blank');
            });
			
			$('#btn_receipt_export_excel').click(function(){
                window.open('reports/receipt_print_with_head.php?receipts_no='+$('#txt_receipt_no').val(),'_blank');
            });
            
            
             $('#btn_view_list_of_receipts').click(function(){
                  
                    var v_start_date_year= new Date().getFullYear();
                    $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                    load_data_to_grid_view_receipts_list(); 
                   
                     
             }); 
             
              $('#list_of_receipt').on('click', 'td button', function (){
                  
                       var $row = $(this).closest('tr');
                        var data = receipts_list_table.row($row).data();
                        v_receipts_id  = data.receipts_id;
                
                  
                    if($(this).attr("name")=='view_receipts')
                        {
                            
                            if(data.received_from_id ==='0' || data.received_from_id==='undefined') {
                                $('#other_company_add').val(data.received_from);
                                $("#select_company").val('Na');
                                $("#select_company").trigger("chosen:updated");
                                $('#other_company_add').show(); 
                            } else {
                                $("#select_company").val(data.received_from_id);
                                $("#select_company").trigger("chosen:updated");
                                $('#other_company_add').hide(); 
                                $('#other_company_add').val(''); 
                            }
                			$('#txt_receipt_no').val(data.receipts_no);
                            // $("input[name='option']:checked"). val(data.receipts_method); 
                            var paymentMethodFromDatabase = data.receipts_method;
                            $("input[name='option']").prop('checked', false);
                            $("input[name='option'][value='" + paymentMethodFromDatabase + "']").prop('checked', true);
                            var rec_date=data.receipts_date.split(' ');
                            var receipts_date= rec_date[0].split('-');
                            var receipts_date=receipts_date[1]+'/'+receipts_date[0]+'/'+receipts_date[2];
                            $('#txt_receipt_date').val(receipts_date);
                            
                            // $('#div_company_receipt option').map(function () {
                                    // if ($(this).text() == $.trim(data.received_from)) return this;
                                    // }).attr('selected', 'selected');
                            console.log(data);
                           
                            $('#txt_thanks').val(data.received_from);
                            $('#txt_thanks_id').val(data.received_from_id);
                            $('#txt_receipt_sum').val(data.sum_of_amount);
                            $('#txt_receipt_method').val(data.cheque_no);
                            $('#txt_receipt_bank').val(data.bank);
                            var chq_date=data.cheque_date.split(' ');
                            var cheque_date= chq_date[0].split('-');
                            var cheque_date=cheque_date[1]+'/'+cheque_date[2]+'/'+cheque_date[0];
                            $('#txt_receipt_cheque_date').val(cheque_date);
                            $('#txt_receipt_settelment_invoice').val(data.invoice_id);
                            $('#txt_receipt_received_by').val(data.received_by);
                            $('#txt_receipt_varified_by').val(data.verified_by);
                            $('#txt_receipt_amount').val(data.total_amount);
                            $('#txt_description').val(data.discription);
                            
                            $('#btn_edit_receipt').show();
                            $('#btn_generate_receipt').hide(); 
                            
                        	closeNavR();		
            			 }
            			 
            			 if($(this).attr("name")=='delete_receipts')
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
                                        						
                                        						       delete_receipts(v_receipts_id);
                                        						       load_data_to_grid_view_receipts_list();
                                                     						 
                                        							} else {
                                        							    
                                        							   
                                        							 
                                        							}
                                        						 });
                         }
                        
                
                  
                  
              });
             
             function delete_receipts(v_receipts_id)
                    {
                        
                        $.post("../controller/receipts/receipts_controller.php",{action:'delete_receipt',v_receipts_id:v_receipts_id}
                                                , function(result,status)
                                                {
                                            //         swal("System is deactivated the company", {
                                    								// title: 'Warning',
                                    								// icon: "warning",
                                    							 // });
                                    							 load_data_to_grid_view_receipts_list();
                                                    
                         });
                         
                         
                       
                    }
            
            
               
               
             $('#list_of_receipt').on('dblclick', 'tr', function(){
                 
                        var $row = $(this).closest('tr');
                        var data = receipts_list_table.row($row).data();
                        v_receipts_no  = data.receipts_no;
                    
                        
                        
                $('#txt_receipt_no').val(data.receipts_no);
                $('#receipt_no_head').html(data.receipts_no);
                
                 $("input[name='option']:checked"). val(data.receipts_method); 
               
                var rec_date=data.receipts_date.split(' ');
                var receipts_date= rec_date[0].split('-');
                var receipts_date=receipts_date[1]+'/'+receipts_date[0]+'/'+receipts_date[2];
                $('#txt_receipt_date').val(receipts_date);
                 $('#div_company_receipt option').map(function () {
                        if ($(this).text() == $.trim(data.received_from)) return this;
                        }).attr('selected', 'selected');
                
                
                $('#txt_thanks').val(data.received_from);
                $('#txt_receipt_sum').val(data.sum_of_amount);
                $('#txt_receipt_method').val(data.cheque_no);
                $('#txt_receipt_bank').val(data.bank);
                var chq_date=data.cheque_date.split(' ');
                var cheque_date= chq_date[0].split('-');
                var cheque_date=cheque_date[1]+'/'+cheque_date[2]+'/'+cheque_date[0];
                $('#txt_receipt_cheque_date').val(cheque_date);
                $('#txt_receipt_settelment_invoice').val(data.invoice_id);
                $('#txt_receipt_received_by').val(data.received_by);
                $('#txt_receipt_varified_by').val(data.verified_by);
                $('#txt_receipt_amount').val(data.total_amount);
                
                $('#btn_edit_receipt').show();
                $('#btn_generate_receipt').hide();        
                      
             });
             
             $('#btn_edit_receipt').click(function(){
                 
                 var v_txt_receipt_no = $('#txt_receipt_no').val();
                
                var v_rdo_receipt_payment_type = $("input[name='option']:checked"). val();
                var v_txt_receipt_date =formatDate ($('#txt_receipt_date').val());
                
                var v_txt_thanks_id=$('#txt_thanks_id').val();
                var v_txt_receipt_sum = $('#txt_receipt_sum').val();
                var v_txt_receipt_method = $('#txt_receipt_method').val();
                var v_txt_receipt_bank = $('#txt_receipt_bank').val();
                var v_txt_receipt_cheque_date = formatDate($('#txt_receipt_cheque_date').val());
              
                var v_txt_receipt_settelment_invoice = $('#txt_receipt_settelment_invoice').val();
                var v_txt_receipt_received_by = $('#txt_receipt_received_by').val();
                var v_txt_receipt_varified_by = $('#txt_receipt_varified_by').val();
                var v_txt_receipt_amount = $('#txt_receipt_amount').val();
                var v_txt_description = $('#txt_description').val();
                console.log(v_rdo_receipt_payment_type);
                if(v_txt_thanks_id==='Na'){
                	var v_txt_thanks = $('#other_company_add').val();
                }else
                {
                	var v_txt_thanks = $('#txt_thanks').val();
                }
                $.post( "../controller/receipts/receipts_controller.php", { 
                                      action :'edit_receipts',
                                      txt_receipt_no: v_txt_receipt_no,
                                      rdo_receipt_payment_type: v_rdo_receipt_payment_type ,
                                      txt_receipt_date : v_txt_receipt_date,
                                      txt_thanks : v_txt_thanks,
                                      txt_thanks_id:v_txt_thanks_id,
                                      txt_receipt_sum : v_txt_receipt_sum,
                                      txt_receipt_method : v_txt_receipt_method,
                                      txt_receipt_bank : v_txt_receipt_bank,
                                      txt_receipt_cheque_date : v_txt_receipt_cheque_date,
                                      txt_receipt_settelment_invoice : v_txt_receipt_settelment_invoice,
                                      txt_receipt_received_by : v_txt_receipt_received_by,
                                      txt_receipt_varified_by : v_txt_receipt_varified_by,
                                      txt_receipt_amount : v_txt_receipt_amount,
                                      txt_description :v_txt_description,
                                      txt_created_by_id : $.cookie('user_id'),
                                      txt_created_by_name : $.cookie('user_name')
                    
                }).done(function( data ) {
                        //alert( "Data Loaded: " + data );
                       // $('#txt_receipt_no').val(data);
                                    $.toast({
                                        heading: 'Success',
                                        text: 'Payment voucher edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                        
                        }).fail(function() {
                                    $.toast({
                                        heading: 'Error',
                                        text: 'Error in generating payment vouchers',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                          });
                 
                 
             })
             
        
    });