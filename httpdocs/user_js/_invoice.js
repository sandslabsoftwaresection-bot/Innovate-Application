$(document).ready(function(){
   
                var v_but_invoice_save = $( '#btn_invoice_add' ).ladda();
                var v_but_invoice_edit = $( '#btn_invoice_edit' ).ladda();
                
                var invoice_list_table = $('#tbl_invoice_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
                 var invoice_list_main_table = $('#tbl_invoice_main_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
                var invoice_view_list_table = $('#list_of_invoices').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                var delivery_note_list_table = $('#tbl_delivery_note_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                  $('#tbl_delivery_note_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#tbl_invoice_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#tbl_invoice_main_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#list_of_invoices').removeClass( 'display' ).addClass('table table-striped table-bordered');
                  $('#tbl_invoice_list tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { invoice_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                 $('#list_of_invoices tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { invoice_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                 }); 
                 
                 $( '#btn_invoice_edit' ).hide();
                 $('#btn_edit_invoice' ).hide();
                 
                 
                 load_company_select_box('div_company_select','select_company');
                 
                 
                 
                   function load_company_select_box(div_name,ctrl_name)
                    {
      
                   $("#"+div_name).load('../controller/quotation/quotation_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});
        
                    }
                    
                    
                     let editor;
                
                        ClassicEditor
                            .create( document.querySelector( '#txt_invoice_all_description' ) )
                            .then( newEditor => {
                                editor = newEditor;
                            } )
                            .catch( error => {
                                console.error( error );
                            } );
                        
                   $("#div_company_select").change(function() {
                      
                    $('#txt_invoice_company_name').val($('option:selected', this).text()) ;
                    $('#txt_invoice_company_id').val($('option:selected', this).val()) ;
                    var company_id=$('option:selected', this).val() ;
                    
                    $.post("../controller/quotation/quotation_controller.php",{action:'select_company_details',v_company_id:company_id},function(result,status){
                        
                                if(status=="success")
                                {
                                    
                                var obj= jQuery.parseJSON(result);
                                $("#txt_invoice_company_id").val(obj.data[0].company_id);
                                $("#txt_invoice_company_name").val(obj.data[0].company_name);
                                $("#txt_invoice_po_box").val(obj.data[0].city);
                                $("#txt_invoice_contact_no").val(obj.data[0].contact_phone);
                                $("#txt_invoice_fax").val(obj.data[0].fax);
                                $("#txt_invoice_attn").val(obj.data[0].contact_person);
                                
                                $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                            
                               });
                                
                                }
                                else
                                {
                                    return false;
                                }
                    });           
                   
                 }); 
                 
                 
               
                check_pending_invoice();
               function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
                
               
                
                
                
                function check_pending_invoice()
                    {
                        
                         $.post("../controller/invoice/invoice_controller.php",{action:'check_invoice_status'},function(result,status){
                               var obj= jQuery.parseJSON(result);
                               var v_invoice_count=obj.data[0].invoice_count;
                               var v_invoice_id=obj.data[0].invoice_main_id;
                               var v_invoice_number=obj.data[0].invoice_number;
                               
                               if(v_invoice_count>0)
                                {
                                            swal({
                                                                
                                    							title: "You have an uncompleted invoice Request",
                                    							text: "Do you want to load again?",
                                    							icon: 'warning',
                                    							dangerMode: true,
                                    							allowOutsideClick: false,
                                                                closeOnClickOutside: false,
                                    							buttons: {
                                    							  cancel: 'No Cancel Old Request!',
                                    							  delete: 'Yes Please Load'
                                    							}
                                    							}).then(function (willDelete) {
                                    							if (willDelete) {
                                    						
                                    						      select_invoice(v_invoice_number);
                                                 						 
                                    							} else {
                                    							    
                                    							  cancel_invoice(v_invoice_number);
                                    							 
                                    							}
                                    				});
                                    
                                   
                               }
                        });
                } 
                         
                        
                                             
                    function select_invoice(v_invoice_number)
                    {
                         $.post("../controller/invoice/invoice_controller.php",{action:'select_invoice_pending_data',v_invoice_no:v_invoice_number},function(result,status){
                                var obj= jQuery.parseJSON(result); 
                               // alert(obj.data[0].company_name);
                                $('#div_company_select option').map(function () {
                                if ($(this).text() == $.trim(obj.data[0].company_name)) return this;
                                }).attr('selected', 'selected');
                                $("#txt_invoice_company_name").val(obj.data[0].company_name);
                                $("#txt_invoice_company_id").val(obj.data[0].company_id);
                                $("#txt_invoice_po_box").val(obj.data[0].po_box);
                                $("#txt_invoice_contact_no").val(obj.data[0].telephone_no);
                                $("#txt_invoice_fax").val(obj.data[0].fax);
                                $("#txt_invoice_attn").val(obj.data[0].attn);
                                $("#txt_invoice_no").val(obj.data[0].invoice_number);
                                $("#txt_invoice_date").val(obj.data[0].invoice_date);
                                $("#txt_invoice_quotation_ref").val(obj.data[0].quotation_reference);
                                $('#txt_invoice_lpo_no').val(obj.data[0].LPO_no);
                                alert(obj.data[0].company_id);
                                load_data_to_grid_invoice_list(obj.data[0].invoice_number);
                                $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                                   if(status=="success")
                                   {
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).text() ==$.trim(obj.data[0].project_name)) return this;
                                        }).attr('selected', 'selected');
                                     
                                   }
                                });
                                
                                 $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                            
                                  });
                                
                                
                              
                                $('#txt_invoice_vat').val(obj.data[0].vat);
                                $('#txt_invoice_total_amount').val(obj.data[0].total_amount);
                                $('#txt_invoice_received_amount').val(obj.data[0].received_amount);
                                $('#txt_invoice_balance_due').val(obj.data[0].balane_in_due);
                                const editorData = editor.setData(obj.data[0].subject_text);
                                $("#txt_invoice_all_description").val(editorData);
                                $( '#btn_invoice_add' ).show();
                                $( '#btn_invoice_edit' ).hide();
                                
                                
                                $("#invoice_no_head").html(obj.data[0].invoice_number);
                                 $('#btn_generate_invoice' ).show();
                                 
                                
                             });
                        
                       
                        
                        
                    }
                   
                   
                    
                    function cancel_invoice(v_invoice_number)
                    {
                        
                        $.post("../controller/invoice/invoice_controller.php",{action:'cancel_invoice_list',v_invoice_no:v_invoice_number
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                    
                         });
                       
                    }
                    function cancel_invoice_list_tbl(v_invoice_number,v_invoice_child_id)
                    {
                        
                        $.post("../controller/invoice/invoice_controller.php",{action:'cancel_invoice_child_data',v_invoice_no:v_invoice_number,v_invoice_child_id:v_invoice_child_id
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                    
                         });
                       
                    }
                
                
                $('#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_attn').keypress(function (e) {
           
                    var str = $(this).val();
                    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                    
                    });
                    $(this).val(str);
        

               });
               
               $('#txt_invoice_quantity, #txt_invoice_amount,#txt_invoice_rate,#txt_invoice_vat,#txt_invoice_received_amount,#txt_invoice_retention_percentage,#txt_invoice_previous_bill_amount').on("keypress", function (e) {
               
                if (e.which != 8 && e.which != 0 && ((e.which < 48 || e.which > 57) && e.which != 46)) {
                    e.preventDefault();
                }
               });
                           
               $('#txt_invoice_contact_no,#txt_invoice_fax').keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       
                        e.preventDefault();
                        return false;
                    }
               });
                $('#txt_invoice_rate').change(function(){
                    
                     var v_invoice_quantity=$('#txt_invoice_quantity').val();
                     var v_invoice_rate=$('#txt_invoice_rate').val();
                     var v_amount=(parseFloat(v_invoice_quantity)*parseFloat(v_invoice_rate)).toFixed(3);
                     var v_invoice_amount=$('#txt_invoice_amount').val(v_amount);
                     
                     
                 });
                  $('#txt_invoice_quantity').change(function(){
                    var v_invoice_rate=$('#txt_invoice_rate').val();
                   
                    if(parseFloat(v_invoice_rate) >= 0 )
                    {
                     
                      var v_invoice_quantity=$('#txt_invoice_quantity').val();
                      var v_amount=(parseFloat(v_invoice_quantity)*parseFloat(v_invoice_rate)).toFixed(3);
                      var v_invoice_amount=$('#txt_invoice_amount').val(v_amount);
                    }
                    else
                    {
                      var v_invoice_amount=$('#txt_invoice_amount').val(0.00);  
                    }
                     
                  });
                  
                  
                        
                 
                 $('#txt_invoice_vat').change(function(){
                     var v_invoice_vat=$('#txt_invoice_vat').val();
                     var total_amount=(parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_invoice_vat))/100)).toFixed(3);
                     $('#txt_invoice_total_amount').val(total_amount);
                      var v_invoice_total_amount=$('#txt_invoice_total_amount').val();
                      var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                      var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                       var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                     if(v_invoice_received_amount>=0)
                     {
                         var v_invoice_received_amount=(parseFloat(v_invoice_total_amount)*(parseFloat(v_invoice_received_amount)/100)).toFixed(3);
                        $('#txt_invoice_balance_due').val(v_invoice_received_amount);
                     }
                     else
                     {
                        $('#txt_invoice_balance_due').val(total_amount); 
                     }
                     
                     if(v_invoice_retention_percentage>=0)
                     {
                      
                     var balance_amount=(parseFloat(v_invoice_total_amount)*(parseFloat(v_invoice_retention_percentage)/100)).toFixed(3);
                     $('#txt_invoice_retention_amount').val(balance_amount);
                     }
                     
                     
                     if(v_invoice_previous_bill>=0)
                     {
                     var v_received_amount=$('#txt_invoice_balance_due').val();
                     var v_retention_amount=$('#txt_invoice_retention_amount').val();
                    
                      var v_invoice_total_amount=$('#txt_invoice_total_amount').val();
                     var balance_amount=(parseFloat(v_invoice_total_amount)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount)+parseFloat(v_invoice_previous_bill))).toFixed(3);
                     $('#txt_invoice_net_balance_due').val(balance_amount);
                     }
                     
                     
                 });
                 
                 $('#txt_invoice_received_amount').change(function(){
                     var v_invoice_total_amount=$('#txt_invoice_total_amount').val(); 
                     var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                     var balance_amount=(parseFloat(v_invoice_total_amount)*(parseFloat(v_invoice_received_amount)/100)).toFixed(3);
                     $('#txt_invoice_balance_due').val(balance_amount);
                     var v_invoice_total_amount=$('#txt_invoice_total_amount').val();
                      var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                      var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                       var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                     
                      if(v_invoice_retention_percentage>=0)
                     {
                      
                     var balance_amount=(parseFloat(v_invoice_total_amount)*(parseFloat(v_invoice_retention_percentage)/100)).toFixed(3);
                     $('#txt_invoice_retention_amount').val(balance_amount);
                     }
                     
                     if(v_invoice_previous_bill>=0)
                     {
                          var v_received_amount=$('#txt_invoice_balance_due').val();
                     var v_retention_amount=$('#txt_invoice_retention_amount').val();
                    
                      var v_invoice_total_amount=$('#txt_invoice_total_amount').val();
                     var balance_amount=(parseFloat(v_invoice_total_amount)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount)+parseFloat(v_invoice_previous_bill))).toFixed(3);
                     $('#txt_invoice_net_balance_due').val(balance_amount);
                     }
                     
                     
                     
                     
                 }); 
                 
                 
                  $('#txt_invoice_retention_percentage').change(function(){
                     var v_invoice_total_amount=$('#txt_invoice_total_amount').val(); 
                     var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                     var balance_amount=(parseFloat(v_invoice_total_amount)*(parseFloat(v_invoice_retention_percentage)/100)).toFixed(3);
                     $('#txt_invoice_retention_amount').val(balance_amount);
                     var v_invoice_total_amount=$('#txt_invoice_total_amount').val();
                      var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                      var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                       var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                      if(v_invoice_received_amount>=0)
                     {
                         var v_invoice_received_amount=(parseFloat(v_invoice_total_amount)*(parseFloat(v_invoice_received_amount)/100)).toFixed(3);
                        $('#txt_invoice_balance_due').val(v_invoice_received_amount);
  