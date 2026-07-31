$(document).ready(function(){
   
                var v_but_invoice_save = $( '#btn_invoice_add' ).ladda();
                var v_but_invoice_edit = $( '#btn_invoice_edit' ).ladda();
                var pageTotal1=0;
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
                    if ( $(this).hasClass('selected') ) 
                    { $(this).removeClass('selected');
                    } 
                    else {
                        invoice_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); 
                        
                        }
                 }); 
                 var v_total_discount_amount = 0.000;
				 
                 $('#lbl_payment').hide();
                 $( '#btn_invoice_edit' ).hide();
                 $('#btn_edit_invoice' ).hide();
                 $('#div_hide' ).hide();
                 $('#quotation_list_div' ).hide();
                 $('#delivery_note_tbl_div' ).hide();
                 
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
                
                
                $("#div_project_select_combo").change(function() { 
                         var v_project_id=$('option:selected', this).val() ;
                        
                         $.post("../controller/quotation_new/quotation_new_controller.php",{action:'select_vat_content',v_project_id:v_project_id},function(result,status){
                           
                           var obj= jQuery.parseJSON(result);
                           $("#txt_tax_content").val(obj.data[0].tax_content); 
                          // alert(obj.data[0].tax_content);
                      }); 
                         
                     }); 
                
                 $('input:radio').change(function() {
                    //  var project_id=  $('#txt_invoice_project_id').val() ;
                     var project_id=$("#div_project_select_combo option:selected").val();
                     var radionValue=( $("input[name='option']:checked").val());
                     if(radionValue=="1")
                     {
                         console.log(radionValue+"if");
                         $("#delivery_note_tbl_div").show();
                         $("#quotation_list_div").show();
                         $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller_v3.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                    console.log(result);
                           });  
                          $('#div_hide').hide(); 
                           
                     }
                     
                     if(radionValue=="2")
                     {
                         
                         console.log(radionValue+"else");
                          $("#delivery_note_tbl_div").show();
                            $("#quotation_list_div").hide();
                            
                            
                          $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller_v3.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                    
                            }); 
                            
                            $('#div_hide').show();
                         
                     }
                     
                    });
                
                function check_pending_invoice()
                    {
                        
                         $.post("../controller/invoice/invoice_controller_v3.php",{action:'check_invoice_status'},function(result,status){
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
                         $.post("../controller/invoice/invoice_controller_v3.php",{action:'select_invoice_pending_data',v_invoice_no:v_invoice_number},function(result,status){
                                var obj= jQuery.parseJSON(result); 
                                //alert(obj.data[0].company_name);
                                $('#div_company_select option').map(function () {
                                   
                                if ($(this).val() == $.trim(obj.data[0].company_id)) return this;
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
                                $('#txt_invoice_discount_amount').val(obj.data[0].total_discount_amount);
                               // $('#txt_hidden_discount_type').val(obj.data[0].discount_type);
                                $('#txt_hidden_discount_amount').val(obj.data[0].discount_amount);
                                //$('#txt_invoice_discount_type').val(obj.data[0].discount_amount+ '('+obj.data[0].discount_type+')');
                                $('#txt_invoice_project_name').val(obj.data[0].project_name) ;
                                $('#txt_invoice_project_id').val(obj.data[0].project_id) ;
                                load_data_to_grid_invoice_list(obj.data[0].invoice_number);
                                $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                                   if(status=="success")
                                   {
                                       
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).val() ==$.trim(obj.data[0].project_id)) return this;
                                        }).attr('selected', 'selected');
                                     
                                   }
                                });
                                
                                 $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller_v3.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:obj.data[0].project_id},function(result,status){
                                    
                                   
                                     if(status=="success")
                                   {
                                      
                                       $('#div_select_quotation_combo option').map(function () {
                                        if ($(this).text() ==$.trim(obj.data[0].quotation_reference)) return this;
                                        }).attr('selected', 'selected');
                                     
                                   }
                                  });
                                
                                console.log(obj.data[0].invoice_against);
                                
                               if(obj.data[0].invoice_against=="2")
                                {
                                    
                                   
                                    // $('input[name=option][value=2]').attr('checked', true);
                                    
                                   
                                     $("#customradio2").prop("checked", true);
                                    $('#quotation_list_div').hide();
                                    $('#delivery_note_tbl_div').show();
                                     $('#div_hide').show();
                                   load_data_to_grid_invoice_list(data.invoice_number);  
                                }
                                else
                                {
                                   
                                    // $('input[name=option][value=1]').attr('checked', true);
                                   
                                    $("#customradio1").prop("checked", true);
                                    
                                     $('#delivery_note_tbl_div').hide();
                                      $('#div_hide').hide();
                                    $('#quotation_list_div').show();
                                   load_data_to_grid_delivery_note_list(obj.data[0].invoice_number);   
                                }
                       
                              
                              
                              
                              
                              
                              
                               
                                $( '#btn_invoice_add' ).show();
                                $( '#btn_invoice_edit' ).hide();
                                $('#btn_generate_invoice' ).show();
                                 
                                
                             });
                        
                       
                        
                        
                    }
                   
                   
                    
                    function cancel_invoice(v_invoice_number)
                    {
                        
                        $.post("../controller/invoice/invoice_controller_v3.php",{action:'cancel_invoice_list',v_invoice_no:v_invoice_number
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                    
                         });
                       
                    }
                    function cancel_invoice_list_tbl(v_invoice_number,v_invoice_child_id)
                    {
                        
                        $.post("../controller/invoice/invoice_controller_v3.php",{action:'cancel_invoice_child_data',v_invoice_no:v_invoice_number,v_invoice_child_id:v_invoice_child_id
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
            
                 
             $("#txt_invoice_received_amount,#txt_invoice_retention_percentage,#txt_invoice_previous_bill_amount").change(function(){
                   
                      
                  
                      var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                      var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                      var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                     
                      
                        if(v_invoice_received_amount==='')
                      {
                          v_invoice_received_amount=0.00;
                      }
                      if(v_invoice_retention_percentage==='')
                      {
                          v_invoice_retention_percentage=0.00;
                      }
                       if(v_invoice_previous_bill==='')
                      {
                          v_invoice_previous_bill=0.00;
                      }
                      
                       
                      
                      var v_received_amount=(parseFloat(v_invoice_received_amount)).toFixed(3);
                   
                      var v_retention_amount=((parseFloat(pageTotal1)*parseFloat(v_invoice_retention_percentage))/100).toFixed(3);
                    
                      var v_previous_bill=(parseFloat(pageTotal1)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount)+parseFloat(v_invoice_previous_bill))).toFixed(3);
                    
                      var v_invoice_net_balance_due=parseFloat(v_previous_bill);
                       $('#txt_invoice_net_balance_due').val(v_invoice_net_balance_due);
                      
                   
               })
               
               
               
                
               
                      
              
                
                 $("#div_project_select_combo").change(function(){
                    
                    var project_id = ($('option:selected', this).val()); 
                    $('#txt_invoice_project_name').val($('option:selected', this).text()) ;
                    $('#txt_invoice_project_id').val($('option:selected', this).val()) ;
                   
                    var radioValue = $("input[name='option']:checked").val();
                 
                    if(radioValue=='2'){
                           $("#delivery_note_tbl_div").show();
                            $("#quotation_list_div").show();
                           
                           $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller_v3.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                    
                            });  
                            
                    }
                    else
                    {
                       $("#delivery_note_tbl_div").hide();
                        $("#quotation_list_div").show();
                        $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller_v3.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                  
                                  
                                    
                            });  
                            
                        
                    }
                     
                 })
                 
                 $('input:radio').change(function() {
                    //  var project_id=  $('#txt_invoice_project_id').val() ;
                     var project_id=$("#div_project_select_combo option:selected").val();
                     var radionValue=( $("input[name='option']:checked").val());
                     if(radionValue=="1")
                     {
                         console.log(radionValue+"if");
                         $("#delivery_note_tbl_div").show();
                         $("#quotation_list_div").show();
                         $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller_v3.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                    console.log(result);
                           });  
                          $('#div_hide').hide(); 
                           
                     }
                     
                     if(radionValue=="2")
                     {
                         
                         console.log(radionValue+"else");
                          $("#delivery_note_tbl_div").show();
                            $("#quotation_list_div").hide();
                            
                            
                          $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller_v3.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                    
                            }); 
                            
                            $('#div_hide').show();
                         
                     }
                     
                    });
                                     
                
                 $("#div_select_quotation_combo").change(function(){
                     
                     var quotation_no= $('#div_select_quotation_combo option:selected').text(); 
                     var quotation_no=$("#txt_invoice_quotation_ref").val(quotation_no);
                     var radioValue = $("input[name='option']:checked").val();
                     var quotation_no = $.trim(($('option:selected', this).text())); 
                     $.post('../controller/invoice/invoice_controller_v3.php',{action:'select_total_discount_amount',v_quotation_no : quotation_no},function(result,status){
                         if(status=='success')
                         {
                               var obj= jQuery.parseJSON(result);
                              
                              // $('#txt_hidden_discount_type').val(obj.data[0].discount_type);
                              // $('#txt_invoice_discount_type').val(obj.data[0].discount_amount+ '('+obj.data[0].discount_type+')');
                              $("#txt_quotation_total_discount_amount").val(obj.data[0].total_discount_amount);
                               v_total_discount_amount= $("#txt_quotation_total_discount_amount").val();
                               
                              
                               
                         
                            
                      var v_invoice_no=$("#txt_invoice_no").val();
                          if(v_invoice_no != '')
                          {
                          $.post('../controller/invoice/invoice_controller_v3.php',{action:'delete_quotation_no_child_tbl',v_invoice_no :v_invoice_no},function(result,status){
                              
                              if(status=='success') 
                              {
                               load_data_to_grid_invoice_list(v_invoice_no);
                              }
                            }); 
                          }
                   
                     var radionValue=( $("input[name='option']:checked").val());
                     
                     
                     if(radionValue=='2')
                     {
                          $("#delivery_note_tbl_div").show();
                          $("#quotation_list_div").hide();
                          $('#div_hide').show();
                           
                        
                     load_data_to_grid_invoice_main_list(quotation_no);     
                     }
                     else
                     {
                          $("#delivery_note_tbl_div").show();
                          $("#quotation_list_div").show();
                          $('#div_hide').hide();
                          var v_invoice_company_name=$("#txt_invoice_company_name").val();
                                            var v_invoice_company_id=$("#txt_invoice_company_id").val();
                                            var v_invoice_po_box=$("#txt_invoice_po_box").val();
                                            var v_invoice_contact_no=$("#txt_invoice_contact_no").val();
                                            var v_invoice_fax=$("#txt_invoice_fax").val();
                                            var v_invoice_attn=$("#txt_invoice_attn").val();
                                            var v_invoice_no=$("#txt_invoice_no").val();
                                            var v_invoice_date=formatDate($("#txt_invoice_date").val());
                                            var v_invoice_quotation_ref=$("#txt_invoice_quotation_ref").val();
                                            var v_invoice_lpo_no=$('#txt_invoice_lpo_no').val();
                                            var v_invoice_project_name= $('#txt_invoice_project_name').val() ;
                                            var v_invoice_project_id= $('#txt_invoice_project_id').val() ;
                                            var v_tax_content =  $("#txt_tax_content").val(); 
                                         // alert(v_tax_content);
                                       $.post("../controller/invoice/invoice_controller_v3.php",{action:'add_invoice_quotation',v_invoice_company_name:v_invoice_company_name,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,v_quotation_no:v_invoice_quotation_ref,v_invoice_project_name:v_invoice_project_name,v_invoice_project_id:v_invoice_project_id,v_invoice_company_id:v_invoice_company_id,radioValue:radioValue,v_tax_content:v_tax_content,v_total_discount_amount:v_total_discount_amount
                                         
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                result = $.trim(result);
                                               
                                                if(result.charAt(0)=='U')
                                                {
                                                   
                                                    swal("Error", result, "error");
                                                    load_data_to_grid_delivery_note_list()
                                                    clear_text()
                                                   
                
                                                
                                                }
                                                else 
                                                {
                                                    
                                                   
                                                     $.toast({
                                                        heading: 'Success',
                                                        text: 'Item added to invoice successfully..!',
                                                        showHideTransition: 'slide',
                                                        icon: 'success'
                                                    });
                                                    
                                                    
                                                    
                                                     $("#txt_invoice_no").val(result);
                                                     $("#invoicce_no_head").html(result);
                                                     $("#txt_invoice_discount_amount").val(v_total_discount_amount);
                                                    // $("#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_contact_no,#txt_invoice_fax,#txt_invoice_attn,#txt_invoice_no,#txt_invoice_date,#txt_invoice_quotation_ref,#txt_invoice_lpo_no").prop("readonly",true);
                                                     //$("#btn_qty_"+v_quotation_child_id).prop("disabled",true);
                                                      $("#delivery_note_tbl_div").hide();
                                                      load_data_to_grid_invoice_list(result);
                                                      load_data_to_grid_delivery_note_list(result); 
                                                     //load_data_to_grid_delivery_note_list_print(result);
                                                    //load_data_to_grid_delivery_note_list(result);
                                                  
                                                    $("#div_first :input").prop("disabled", true);
                                                    $("#div_second :input").prop("disabled", true);
                                                    
                                                }
                                                
                                                 
                                            
                                        });
                          
                     //load_data_to_grid_delivery_note_list(quotation_no);   
                         
                       
                     }
                     
                     
                     
                 }
             }); 
                          
                    
                   
                  
                 }) 
                 
                 
                 
                 
                 function load_data_to_grid_delivery_note_list(invoice_no)
                 {
                     //alert(quotation_no);
                    delivery_note_list_table.destroy();
                         
                     delivery_note_list_table = $('#tbl_delivery_note_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/invoice_controller_v3.php',
                                 'data': {
                                    action: 'list_invoice',
                                    v_invoice_no:invoice_no
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
            				"scrollY": 300,
                            "scrollX": true,
                            "scroller": true,
            			    
                            "columns": [
                                 { "data": null },
                                 { "data": "quotation_child_id","visible":false },
                                 { "data": "quotation_no","visible":false },
                                 { "data": "description", width:"20%"},
                                 { "data": "quantity"},
                                 { "data": "unit"},
                                 { "data": "rate", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''), "visible":false},
            					 { "data": "discount_precentage",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),
            					      render: function ( data, type, rows, meta ) {
                						         if(rows['discount_type']=='BD')
                						         {
                						            str_active_status_view = data+" (BD)"; 
                						         }
                								else
                								{
                								    str_active_status_view = data+" (%)";
                								}
                								
                								return str_active_status_view;
                
                							 },
            					     
            					 "visible":false},
                                 { "data": "discount_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),"visible":false},
                                 { "data": "vat_percentage", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),"visible":false },
            					 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					  { "data": "invoice_child_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="view_invoice_list" name="" ><i class="material-icons ">edit</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         },
    					         { "data": "invoice_child_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2"  id="delete_invoice_list" name="delete_invoice_list" ><i class="material-icons ">delete</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         "visible":false },
             
                             ],
                             pageLength: 25,
            				 searching: false,
                             //responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                                    
                               
             
                              },
                              "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                                 return nRow;
                             },
                              "fnDrawCallback": function() {
                               
             
                             },
                             "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                 
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                 
                            // Total over all pages Income
                            total1 = api
                                .column( 11 )
                                .data()
                                .reduce( function (a, b) {
                                    
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Total over this page Income
                            pageTotal1 = api
                                .column( 11, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Update footer
                            $( api.column( 11 ).footer() ).html($.fn.dataTable.render.number(',', '.', 3, '').display( pageTotal1 )
                                
                            );
                                       
                                         var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                                         var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                                         var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                                         
                                          
                                          if(v_invoice_received_amount==='')
                                          {
                                              v_invoice_received_amount=0.00;
                                          }
                                          if(v_invoice_retention_percentage==='')
                                          {
                                              v_invoice_retention_percentage=0.00;
                                          }
                                          if(v_invoice_previous_bill==='')
                                          {
                                              v_invoice_previous_bill=0.00;
                                          }
                                          
                                        
                                        
                                        var v_discount_type= $('#txt_hidden_discount_type').val();
                                        
                                        if(v_discount_type=='%')
                                        {
                                            var v_discount_amount = $("#txt_hidden_discount_amount").val();
                                            if(v_discount_amount==='' ||v_discount_amount===0)
                                            {
                                                v_total_discount_amount=0.000;
                                                $("#txt_invoice_discount_amount").val(v_total_discount_amount);
                                            }
                                            else
                                            {
                                                var v_total_discount_amount = ((parseFloat(pageTotal1)*parseFloat(v_discount_amount))/100).toFixed(3);
                                                $("#txt_invoice_discount_amount").val(v_total_discount_amount);
                                            }
                                        }
                                        else
                                        {
                                         var v_total_discount_amount = $("#txt_invoice_discount_amount").val();
                                        }   
                                        if(v_total_discount_amount==='')
                                        {
                                            v_total_discount_amount=0.000;
                                        }
                                       // console.log(v_total_discount_amount);
                                          var v_received_amount=(parseFloat(v_invoice_received_amount));
                                          var v_retention_amount=((parseFloat(pageTotal1)*parseFloat(v_invoice_retention_percentage))/100).toFixed(3);
                                          var v_previous_bill=(parseFloat(pageTotal1)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount)+parseFloat(v_invoice_previous_bill))).toFixed(3);
                                          var v_invoice_net_balance_due=parseFloat(v_previous_bill);
                                          var v_invoice_net_balance_due = (parseFloat(v_previous_bill)).toFixed(3);
                                          //alert(v_invoice_net_balance_due);
                                          $('#txt_invoice_net_balance_due').val(v_invoice_net_balance_due); 
                            
                                            change_balance_in_due(v_invoice_net_balance_due,v_total_discount_amount);  
                            
                            
                        }
                        
                         
                     });  
                
                 }
                 
                 
                 function change_balance_in_due(v_invoice_net_balance_due,v_total_discount_amount)
                 {
                      var v_invoice_no=$("#txt_invoice_no").val(); 
                     
                     $.post("../controller/invoice/invoice_controller_v3.php",{action:'change_net_balance',v_invoice_no:v_invoice_no,v_balance_in_due:v_invoice_net_balance_due,v_total_discount_amount:v_total_discount_amount
                           } , function(result,status){
                            
                             
                              
                           });
                     
                 }
                 
                
                
                 function load_data_to_grid_invoice_main_list(quotation_no)
                 {
                     invoice_list_main_table.destroy();
                         
                     invoice_list_main_table = $('#tbl_invoice_main_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/invoice_controller_v3.php',
                                 'data': {
                                    action: 'list_main_invoice',
                                    v_quotation_no:quotation_no
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
            				"scrollY": 300,
                            "scrollX": true,
                            "scroller": true,
            			    
                            "columns": [
                              
                                 { "data": "delivery_note_main_id","visible":false },
                                 { "data": "delivery_note_main_id",
                                 
                                    
            					       render: function ( data, type, rows, meta ) {
            							
            									str_check ='<input  type="checkbox" name="delivery_note_check" id="chkbox_'+data+'"  value="'+rows['delivery_note_number']+'" />'
            								
            								return str_check;
            
            							 }
            					 
            					
                                 },
                                 { "data": "delivery_note_number" },
                                 { "data": "delivery_note_date", width:"50%"},
                                 { "data": "LPO_no"},
                                 
                                 
             
                             ],
                             pageLength: 25,
            				 searching: false,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                                    
                               
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                         
                     });  
                
                 }
                 
                 
                 
                 
                 
                    $('#tbl_delivery_note_list tbody').on('click', 'td button', function (){
                     
                     
                     
                     
                     
                        var $row = $(this).closest('tr');
                        var data = delivery_note_list_table.row($row).data();
                       
                        v_quotation_child_id  = data.quotation_child_id;
                        v_invoice_child_id  = data.invoice_child_id;
                        v_quotation_no=data.quotation_no;
                        v_description=data.description;
                        v_quantity=data.quantity;
                        v_unit=data.unit;
                        v_rate=data.rate;
                        v_amount=data.amount;
                        v_discount_precentage=data.discount_precentage;
                        v_discount_amount=data.discount_amount;
                        v_vat_percentage=data.vat_percentage;
                        v_net_amount=data.net_amount;
                        v_req_qty=data.quantity;
                        v_discount_type=data.discount_type;
                        
                  
                        
                        
                        
                         if($(this).attr("name")=='btn_quotation_list')
                         {
                           
                            swal({
                                    title: "Change Quantity",
                                     text: "Do you want to change the delivered quantity ? ",
                                     icon: "warning",
                                      buttons: {
                                        cancel: "Cancel",
                                        catch: {
                                          text: "Yes",
                                          value: "catch",
                                        },
                                        defeat: {
                                          text: "No",
                                          value: "delete",
                                        },
                                      },
                                      icon:"warning",
                                    })     
                                    .then((value) => {
                                      switch (value) {
                                     
                                        case "delete":
                                                          
                                         add_to_delivery_list(v_quotation_child_id,v_quotation_no,v_description,v_quantity,v_unit,v_rate,v_amount,v_discount_precentage,v_discount_amount,v_vat_percentage,v_net_amount,v_req_qty);
                                                    
                                          break;
                                     
                                          case "catch":
                                              
                                          $("#txt_quotation_child_id").val(v_quotation_child_id);
                                          $("#txt_quotation_discount_type").val(v_discount_type);
                                          $("#txt_quotation_quantity").val(v_quantity);
                                          $("#txt_reissue_qty").val(v_quantity);
                                          $("#txt_quotation_rate").val(v_rate);
                                          $("#txt_quotation_discount_precentag").val(v_discount_precentage);
                                          $("#txt_quotation_vat_percentage").val(v_vat_percentage);
                                          $("#req_qty").html(v_quantity);
                                          $('#modal_quantity_change').modal();
                			              $('#modal_quantity_change').modal('show'); 
                                 
                                          
                                          add_to_delivery_list(v_quotation_child_id,v_quotation_no,v_description,v_quantity,v_unit,v_rate,v_amount,v_discount_precentage,v_discount_amount,v_vat_percentage,v_net_amount,v_req_qty);
                                           
                                          
                                   
                                          
                                          break;
                                     
                                        default:
                                        
                                      }
                            
                            });  
                       
                         }
                         
                           if($(this).attr("name")=='view_invoice_list')
                         {
                           
                           
                                              
                                          $("#txt_quotation_child_id").val(v_invoice_child_id);
                                          $("#txt_quotation_discount_type").val(v_discount_type);
                                          $("#txt_quotation_quantity").val(v_quantity);
                                          $("#txt_reissue_qty").val(v_quantity);
                                          $("#txt_quotation_rate").val(v_rate);
                                          $("#txt_quotation_discount_precentag").val(v_discount_precentage);
                                          $("#txt_quotation_vat_percentage").val(v_vat_percentage);
                                          $("#txt_reissue_desc").val(v_description);
                                          $("#req_qty").html(v_quantity);
                                          $('#modal_quantity_change').modal();
                			              $('#modal_quantity_change').modal('show'); 
                                 
                                   
                            
                          
                       
                         }
                         
                         
                          if($(this).attr("name")=='delete_invoice_list')
                         {
                              var v_invoice_no=$("#txt_invoice_no").val();
                             $.post("../controller/invoice/invoice_controller_v3.php",{action:'delete_invoice_list_item',v_invoice_no:v_invoice_no,v_invoice_child_id:v_invoice_child_id}, function(result,status){
        			                
        			                 if(status=="success")
        			                 {
        			                     
        			                       $.toast({
                                                        heading: 'Success',
                                                        text: 'Item deleted to invoice successfully..!',
                                                        showHideTransition: 'slide',
                                                        icon: 'success'
                                                    });
        			                     load_data_to_grid_delivery_note_list(v_invoice_no);
        			                     load_data_to_grid_invoice_list(v_invoice_no);
        			                 }
        			                 
			                 }); 
			                 
			                 
			                 
                             
                         }
                         
                     
                         
                 });  
                 
                 
                 
                   function add_to_delivery_list(v_quotation_child_id,v_quotation_no,v_description,v_quantity,v_unit,v_rate,v_amount,v_discount_precentage,v_discount_amount,v_vat_percentage,v_net_amount,v_req_qty)
                    {
                       
                                            var v_invoice_company_name=$("#txt_invoice_company_name").val();
                                            var v_invoice_company_id=$("#txt_invoice_company_id").val();
                                            var v_invoice_po_box=$("#txt_invoice_po_box").val();
                                            var v_invoice_contact_no=$("#txt_invoice_contact_no").val();
                                            var v_invoice_fax=$("#txt_invoice_fax").val();
                                            var v_invoice_attn=$("#txt_invoice_attn").val();
                                            var v_invoice_no=$("#txt_invoice_no").val();
                                            var v_invoice_date=formatDate($("#txt_invoice_date").val());
                                            var v_invoice_quotation_ref=$("#txt_invoice_quotation_ref").val();
                                            var v_invoice_lpo_no=$('#txt_invoice_lpo_no').val();
                                            var v_invoice_project_name= $('#txt_invoice_project_name').val() ;
                                            var v_invoice_project_id= $('#txt_invoice_project_id').val() ;
                                   
                                     //alert(v_discount_precentage);
                                       $.post("../controller/invoice/invoice_controller_v3.php",{action:'add_invoice_qt',v_invoice_company_name:v_invoice_company_name,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,v_invoice_description:v_description,v_invoice_quantity:v_quantity,v_invoice_unit:v_unit,v_quotation_child_id:v_quotation_child_id,v_quotation_no:v_quotation_no,v_rate:v_rate,v_amount:v_amount,v_discount_precentage:v_discount_precentage,v_discount_amount:v_discount_amount,v_vat_percentage:v_vat_percentage,v_net_amount:v_net_amount,v_req_qty:v_req_qty,v_invoice_project_name:v_invoice_project_name,v_invoice_project_id:v_invoice_project_id,v_invoice_company_id:v_invoice_company_id
                                         
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                result = $.trim(result);
                                               
                                                if(result.charAt(0)=='U')
                                                {
                                                   
                                                    swal("Error", result, "error");
                                                    load_data_to_grid_delivery_note_list()
                                                    clear_text()
                                                   
                
                                                
                                                }
                                                else 
                                                {
                                                    
                                                   
                                                     $.toast({
                                                        heading: 'Success',
                                                        text: 'Item added to delivery_note Successfully..!',
                                                        showHideTransition: 'slide',
                                                        icon: 'success'
                                                    });
                                                    
                                                    
                                                    
                                                     $("#txt_invoice_no").val(result);
                                                     $("#invoicce_no_head").html(result);
                                                     $("#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_contact_no,#txt_invoice_fax,#txt_invoice_attn,#txt_invoice_no,#txt_invoice_date,#txt_invoice_quotation_ref,#txt_invoice_lpo_no").prop("readonly",true);
                                                     //$("#btn_qty_"+v_quotation_child_id).prop("disabled",true);
                                                      $("#delivery_note_tbl_div").show();
                                                      load_data_to_grid_invoice_list(result)
                                                     //load_data_to_grid_delivery_note_list_print(result);
                                                    //load_data_to_grid_delivery_note_list(result);
                                                  
                                                    $("#div_first :input").prop("disabled", true);
                                                    $("#div_second :input").prop("disabled", true);
                                                    
                                                }
                                                
                                                 
                                            
                                        });
                                        
                                       
                                        
                                  
                                           
                     }  
                     
                     
                     
                     
               $("#btn_reissue_qnty").click(function(){
               
                        var v_invoice_company_name=$("#div_company_select option:selected").text();
                        var v_invoice_company_id=$("#div_company_select option:selected").val();
                        var v_invoice_po_box=$("#txt_invoice_po_box").val();
                        var v_invoice_contact_no=$("#txt_invoice_contact_no").val();
                        var v_invoice_fax=$("#txt_invoice_fax").val();
                        var v_invoice_attn=$("#txt_invoice_attn").val();
                      
                        var v_invoice_date=formatDate($("#txt_invoice_date").val());
                        var v_invoice_quotation_ref=$("#txt_invoice_quotation_ref").val();
                        var v_invoice_lpo_no=$('#txt_invoice_lpo_no').val();
                        var v_project_name= $('#txt_invoice_project_name').val() ;
                        var v_project_id= $('#txt_invoice_project_id').val() ;
                       
                          var v_invoice_no=$("#txt_invoice_no").val();      
                        
                          var v_delivery_note_no=$("#txt_delivery_note_no").val(); 
                          var v_req_quantity= $("#txt_quotation_quantity").val(); 
                          var v_quotation_child_id = $("#txt_quotation_child_id").val();
                          var delivered_qty = $("#txt_reissue_qty").val();
                          var rate =  $("#txt_quotation_rate").val();
                          var discount_percentage = $("#txt_quotation_discount_precentag").val();
                          var vat_percentage = $("#txt_quotation_vat_percentage").val();
                          var v_description = $("#txt_reissue_desc").val();
                          var v_discount_type=$("#txt_quotation_discount_type").val();
                          var v_amount=(parseFloat(delivered_qty)*parseFloat(rate));
                          
                         
                          if(v_discount_type=='%')
                          {
                            
                          var dis_amount = (parseFloat(delivered_qty)*parseFloat(rate))*(parseFloat(discount_percentage)/100);
                         // alert(dis_amount);
                          var v_discount_amount=(parseFloat(delivered_qty)*parseFloat(rate))-parseFloat(dis_amount)  ;
                         
                          var v_net_amount=((parseFloat(v_discount_amount)*(parseFloat(vat_percentage)/100))+ parseFloat(v_discount_amount)).toFixed(3) ;
                          }
                          else
                          {
                             var dis_amount= parseFloat(discount_percentage);
                             var v_net_amount= (parseFloat(delivered_qty)*parseFloat(rate))- parseFloat(discount_percentage);
                          }
                         
                         
                          var v_balance_in_due=$("#txt_invoice_net_balance_due").val(); 
                               // alert (v_balance_in_due);
                                    
                      if($.trim(v_invoice_company_name)==""||$.trim(v_invoice_po_box)==""||$.trim(v_invoice_contact_no)==""||$.trim(v_invoice_fax)==""||$.trim(v_invoice_attn)==""||$.trim(v_invoice_date)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_invoice_save.ladda( 'stop' );
                        return false;
                    }
                    else
                    {    
                              

                           $.post("../controller/invoice/invoice_controller_v3.php",{action:'change_delivery_qty',v_quotation_child_id:v_quotation_child_id,v_delivered_qty:delivered_qty,v_net_amount:v_net_amount,v_amount:v_amount,v_discount_amount:dis_amount,v_invoice_no:v_invoice_no,v_balance_in_due:v_balance_in_due,v_invoice_description:v_description
                           } , function(result,status){
                               //alert(result);
                              var invoice_no=  $("#txt_invoice_no").val();
                              load_data_to_grid_delivery_note_list(invoice_no)
                              load_data_to_grid_invoice_list(invoice_no);
                               $('#modal_quantity_change').modal();
            			       $('#modal_quantity_change').modal('hide');
                           });

                    }
           })           
                     
           
                 
                 
                
                
                
             $('#tbl_invoice_main_list').on('click', 'tr', function() {
                     
                   
                    var $row = $(this).closest('tr');
                    var data = invoice_list_main_table.row($row).data();
                    var delivery_note_no=data.delivery_note_number;
                    var v_invoice_company_name=$("#txt_invoice_company_name").val();
                    var v_invoice_company_id=$("#txt_invoice_company_id").val();
                    var v_invoice_po_box=$("#txt_invoice_po_box").val();
                    var v_invoice_contact_no=$("#txt_invoice_contact_no").val();
                    var v_invoice_fax=$("#txt_invoice_fax").val();
                    var v_invoice_attn=$("#txt_invoice_attn").val();
                    var v_invoice_no=$("#txt_invoice_no").val();
                    var v_invoice_date=formatDate($("#txt_invoice_date").val());
                    var v_invoice_quotation_ref=$("#txt_invoice_quotation_ref").val();
                    var v_invoice_lpo_no=$('#txt_invoice_lpo_no').val();
                    var v_project_name= $('#txt_invoice_project_name').val() ;
                    var v_project_id= $('#txt_invoice_project_id').val() ;
                    
                    
                    
                    //alert(v_invoice_quotation_ref);
                   // alert(v_invoice_company_name+'---'+v_invoice_po_box+'---'+v_invoice_contact_no+'----'+v_invoice_fax+'----'+v_invoice_attn+'----'+v_invoice_date+'----'+v_invoice_quotation_ref+'------'+v_invoice_lpo_no);
                     
                     $('#tbl_invoice_main_list input[type=checkbox] ').each(function() {
			         if (jQuery(this).is(":checked")) {
			             //alert(jQuery(this).is(":checked"));
			             
                     if($.trim(v_invoice_company_name)==""||$.trim(v_invoice_po_box)==""||$.trim(v_invoice_contact_no)==""||$.trim(v_invoice_fax)==""||$.trim(v_invoice_attn)==""||$.trim(v_invoice_date)==""||$.trim(v_invoice_lpo_no)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_invoice_save.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/invoice/invoice_controller_v3.php",{action:'add_invoice',v_invoice_company_name:v_invoice_company_name,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,delivery_note_no:delivery_note_no,v_invoice_company_id:v_invoice_company_id,v_project_name:v_project_name,v_project_id:v_project_id
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_invoice_save.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                   
                                   

                                
                                }
                                else 
                                {
                                     v_but_invoice_save.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                       $.toast({
                                        heading: 'Success',
                                        text: 'Item added to invoice successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                    
                                    
                                     $("#txt_invoice_no").val(result);
                                     $("#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_contact_no,#txt_invoice_fax,#txt_invoice_attn,#txt_invoice_no,#txt_invoice_date,#txt_invoice_quotation_ref,#txt_invoice_lpo_no").prop("readonly",true);
                                     
                                     
                                    load_data_to_grid_invoice_list(result);
                                    
                                    
                                    

                                    
                                }
                                
                                 
                            
                           });
                        
                       
                        
                        }
                    
			         }
			         else
			         {
			          // console.log(jQuery(this).val());
			           var d_note_no = jQuery(this).val();
			            var invoice_no=$("#txt_invoice_no").val();
			             $.post("../controller/invoice/invoice_controller_v3.php",{action:'delete_invoice_list',v_invoice_no:v_invoice_no,delivery_note_no:d_note_no}, function(result,status){
			                 if(status=="success")
			                 {
			                load_data_to_grid_invoice_list(invoice_no); 
			                 }
			             }); 
			         }
			        
                    
                      });
                      
                      
               
             });
                
            
            
                function load_data_to_grid_invoice_list(invoice_no)
                 {
                     invoice_list_table.destroy();
                         
                     invoice_list_table = $('#tbl_invoice_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/invoice_controller_v3.php',
                                 'data': {
                                    action: 'list_invoice',
                                    v_invoice_no:invoice_no
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
            				"scrollY": 300,
                            "scrollX": true,
                            "scroller": true,
            			    "fixedHeader": {
                                header: true,
                               footer: true
                            },
                            "columns": [
                              
                                 //{ "data": "invoice_child_id","visible":false },
                                 //{ "data": "invoice_no","visible":false },
                                 { "data": "description", width:"50%"},
                                 { "data": "quantity"},
                                 { "data": "unit"},
                                 { "data": "rate", className: "text-right" },
            					 { "data": "amount",className: "text-right","visible":false },
            					 { "data": "discount_precentage",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),
            					      render: function ( data, type, rows, meta ) {
                						         if(rows['discount_type']=='BD')
                						         {
                						            str_active_status_view = data+" (BD)"; 
                						         }
                								else
                								{
                								    str_active_status_view = data+" (%)";
                								}
                								
                								return str_active_status_view;
                
                							 },
            					     
            					 "visible":false},
            					
                                 { "data": "discount_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),"visible":false},
                                 { "data": "vat_percentage", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),"visible":false },
            					 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
                                 
            				 
             
                             ],
                             pageLength: 25,
            				 searching: false,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                                    
                               
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             },
                             "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                 
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                 
                            // Total over all pages Income
                            total1 = api
                                .column( 8 )
                                .data()
                                .reduce( function (a, b) {
                                    
                                    return intVal(a) + intVal(b);
                                }, 0 );
                                 total2 = api
                                .column( 4 )
                                .data()
                                .reduce( function (a, b) {
                                    
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Total over this page Income
                             pageTotal6 = api
                                .column( 4, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                            pageTotal1 = api
                                .column( 8, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Update footer
                            $( api.column( 8 ).footer() ).html(
                                pageTotal1.toFixed(3)
                            );
                             $( api.column( 4 ).footer() ).html(
                                pageTotal6.toFixed(3)
                            );
                            
                            
                                  
                                    
                                    
                                          var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                                         // alert(v_invoice_received_amount);
                                          var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                                          var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                                         
                                          
                                            if(v_invoice_received_amount==='')
                                          {
                                              v_invoice_received_amount=0.00;
                                          }
                                          if(v_invoice_retention_percentage==='')
                                          {
                                              v_invoice_retention_percentage=0.00;
                                          }
                                           if(v_invoice_previous_bill==='')
                                          {
                                              v_invoice_previous_bill=0.00;
                                          }
                                          
                                           
                                         var v_discount_type= $('#txt_hidden_discount_type').val();
                                        
                                        if(v_discount_type=='%')
                                        {
                                            var v_discount_amount = $("#txt_hidden_discount_amount").val();
                                            if(v_discount_amount==='' ||v_discount_amount===0)
                                            {
                                                
                                                v_total_discount_amount=0.000;
                                                v_total_discount_amount=v_total_discount_amount.toFixed(3);
                                                $("#txt_invoice_discount_amount").val(v_total_discount_amount);
                                            }
                                            else
                                            {
                                                var v_total_discount_amount = ((parseFloat(pageTotal1)*parseFloat(v_discount_amount))/100).toFixed(3);
                                                $("#txt_invoice_discount_amount").val(v_total_discount_amount);
                                            }
                                        }
                                        else
                                        {
                                         var v_total_discount_amount = $("#txt_invoice_discount_amount").val();
                                        }   
                                        if(v_total_discount_amount==='')
                                        {
                                            v_total_discount_amount=0.000;
                                        }
                                        
                                         // console.log(v_total_discount_amount);
                                         
                                          var v_received_amount=(parseFloat(v_invoice_received_amount));
                   
                                          var v_retention_amount=((parseFloat(pageTotal1)*parseFloat(v_invoice_retention_percentage))/100).toFixed(3);
                                        
                                          var v_previous_bill=(parseFloat(pageTotal1)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount)+parseFloat(v_invoice_previous_bill))).toFixed(3);
                                        
                                          var v_invoice_net_balance_due=parseFloat(v_previous_bill);
                                          var v_invoice_net_balance_due = (parseFloat(v_previous_bill) ).toFixed(3);
                                          
                                          $('#txt_invoice_net_balance_due').val(v_invoice_net_balance_due); 
                            
                                            change_balance_in_due(v_invoice_net_balance_due,v_total_discount_amount);  
                            
                                    
                                    }
                           
                           
                          });  
                
                 }
                 
                 
         
                 
                 
                 
                  $('#btn_generate_invoice').click(function(){
                      
                       var v_invoice_company_name=$("#txt_invoice_company_name").val();
                        var v_invoice_company_id=$("#txt_invoice_company_id").val();
                        var v_invoice_po_box=$("#txt_invoice_po_box").val();
                        var v_invoice_contact_no=$("#txt_invoice_contact_no").val();
                        var v_invoice_fax=$("#txt_invoice_fax").val();
                        var v_invoice_attn=$("#txt_invoice_attn").val();
                      
                        var v_invoice_date=formatDate($("#txt_invoice_date").val());
                        var v_invoice_quotation_ref=$("#txt_invoice_quotation_ref").val();
                        var v_invoice_lpo_no=$('#txt_invoice_lpo_no').val();
                        var v_project_name= $('#txt_invoice_project_name').val() ;
                        var v_project_id= $('#txt_invoice_project_id').val() ;
                        
                        var v_invoice_no=$("#txt_invoice_no").val();   
                 
                        var v_invoice_vat=$('#txt_invoice_vat').val();
                        var v_invoice_total_amount=$('#txt_invoice_total_amount').val(); 
                        var v_received_amount=$('#txt_invoice_balance_due').val();
                        var v_retention_amount=$('#txt_invoice_retention_amount').val();
                        var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                         
                        // var v_invoice_balance_due=(parseFloat(v_invoice_total_amount)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount)+parseFloat(v_invoice_previous_bill))).toFixed(3);
                         
                        var v_invoice_total_amount=$('#txt_invoice_total_amount').val();
                        var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                       var v_invoice_balance_due=$('#txt_invoice_net_balance_due').val();
                        var v_invoice_no=$("#txt_invoice_no").val();
                        const editorData = editor.getData();
                       
                        var v_invoice_all_description= editorData;
                        //var v_invoice_all_description=$("#txt_invoice_all_description").val();
                        
                        var v_invoice_retention_amount=$("#txt_invoice_retention_percentage").val();
                        var v_invoice_previous_bill_amount=$("#txt_invoice_previous_bill_amount").val();
                        var v_discount_type =  $('#txt_hidden_discount_type').val();
                        var v_discount_amount = $("#txt_hidden_discount_amount").val();
                        var v_total_discount_amount= $("#txt_quotation_total_discount_amount").val();         
                              
                    var v_invoice_sub_total=pageTotal1;
                    
                    if($.trim(v_invoice_received_amount)==""||$.trim(v_invoice_balance_due)==""||$.trim(v_invoice_all_description)=="")
                     {
                        swal("Warning"," Please Fill All The Fields ", "warning");
                        
                        
                     }
                     else
                     {
                       $.post("../controller/invoice/invoice_controller_v3.php",{action:'generate_invoice',v_invoice_company_name:v_invoice_company_name,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,v_quotation_no:v_invoice_quotation_ref,v_project_name:v_project_name,v_project_id:v_project_id,v_invoice_company_id:v_invoice_company_id,v_invoice_no:v_invoice_no,v_invoice_vat:v_invoice_vat,v_invoice_total_amount:v_invoice_total_amount,v_invoice_received_amount:v_invoice_received_amount,v_invoice_balance_due:v_invoice_balance_due,v_invoice_all_description:v_invoice_all_description,v_invoice_sub_total:v_invoice_sub_total,v_invoice_retention_amount:v_invoice_retention_amount,v_invoice_previous_bill_amount:v_invoice_previous_bill_amount,v_discount_type:v_discount_type,v_discount_amount:v_discount_amount,v_total_discount_amount:v_total_discount_amount
                                }
                               
                                , function(result,status)
                                {
                                  if(result=="success")
                                  {
                                    swal("Success"," Invoice generated successfully", "success"); 
                                    $('#btn_generate_invoice').hide();
                                     $('#btn_edit_invoice').show();
                                   // clear_all_after_generate_invoice();
                                    $("#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_contact_no,#txt_invoice_fax,#txt_invoice_attn,#txt_invoice_no,#txt_invoice_date,#txt_invoice_quotation_ref,#txt_invoice_lpo_no").prop("readonly",false);
                                     
                                  }
                                  else
                                  {
                                    swal("Error"," Some Error Occures..", "error"); 
                                    //clear_all_after_generate_invoice(); 
                                  }
                          });
                     }
                  });
                  
                  
                
                 
                  
                 function clear_all_after_generate_invoice()
                 {
                   $('#txt_invoice_vat,#txt_invoice_total_amount,#txt_invoice_received_amount,#txt_invoice_balance_due,#txt_invoice_no,#txt_invoice_all_description,#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_contact_no,#txt_invoice_fax,#txt_invoice_attn,#txt_invoice_quotation_ref,#txt_invoice_lpo_no').val('');  
                   $("#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_contact_no,#txt_invoice_fax,#txt_invoice_attn,#txt_invoice_no,#txt_invoice_date,#txt_invoice_quotation_ref,#txt_invoice_lpo_no").prop("readonly",false);
                   var invoice_no=0;
                   load_data_to_grid_invoice_list(invoice_no);
                 }
                 
                 
                 function load_data_to_grid_view_invoice_list()
                 {
                     invoice_view_list_table.destroy();
                         
                     invoice_view_list_table = $('#list_of_invoices').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/invoice_controller_v3.php',
                                 'data': {
                                    action: 'list_invoice_view',
                                    
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
            			    "scrollY": 300,
                            "scrollX": true,
                            "scroller": true,
            			    "fixedHeader": {
                                header: true,
                               footer: true
                            },
                            "columns": [
                              
                                 { "data": "invoice_main_id","visible":false },
                                 { "data": "invoice_date"},
                                 { "data": "invoice_number"},
                                 { "data": "company_name", visible:false},
                                 { "data": "balane_in_due"},
                                 { "data": "invoice_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_invoice" name="view_invoice" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
    					         },
    					         { "data": "invoice_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_invoice" name="delete_invoice" ><i class="material-icons ">delete</i></button>';
                								
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
                               
             
                             },
							 "drawCallback": function ( settings ) {
								var api = this.api();
								var rows = api.rows( {page:'current'} ).nodes();
								var last=null;
					 
								api.column(3, {page:'current'} ).data().each( function ( group, i ) {
									if ( last !== group ) {
										$(rows).eq( i ).before(
											'<tr class="group" style="background-color:#D2B4DE;"><td colspan="6">'+group+'</td></tr>'
										);
					 
										last = group;
									}
								} );
							}
                        
                         
                     });  
                
                 }
				 
				 // $('#list_of_invoices tbody').on('click', 'tr.group', function () {
					 // alert("hi");
					// var currentOrder = invoice_view_list_table.order()[0];
					// if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
					// invoice_view_list_table.order([groupColumn, 'desc']).draw();
					// } else {
					// invoice_view_list_table.order([groupColumn, 'asc']).draw();
					// }
				// });
                 
                 
                 function load_data_to_grid_view_invoice_list_between(v_invoice_from_date,v_invoice_to_date)
                 {
                      invoice_view_list_table.destroy();
                         
                     invoice_view_list_table = $('#list_of_invoices').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/invoice_controller_v3.php',
                                 'data': {
                                    action: 'list_invoice_view_between',
                                    v_invoice_from_date:v_invoice_from_date,
                                    v_invoice_to_date:v_invoice_to_date
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
            				"scrollY": 300,
                            "scrollX": true,
                            "scroller": true,
            			    "fixedHeader": {
                                header: true,
                               footer: true
                            },
                            "columns": [
                              
                                 { "data": "invoice_main_id","visible":false },
                                 { "data": "invoice_date"},
                                 { "data": "invoice_number"},
                                 { "data": "company_name", visible:false},
                                 { "data": "balane_in_due"},
                                 { "data": "invoice_main_id",
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_invoice" name="view_invoice" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         },
    					         { "data": "invoice_main_id",
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_invoice" name="delete_invoice" ><i class="material-icons ">delete</i></button>';
                								
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
                               
             
                             },
							 "drawCallback": function ( settings ) {
								var api = this.api();
								var rows = api.rows( {page:'current'} ).nodes();
								var last=null;
					 
								api.column(3, {page:'current'} ).data().each( function ( group, i ) {
									if ( last !== group ) {
										$(rows).eq( i ).before(
											'<tr class="group" style="background-color:#D2B4DE;"><td colspan="6">'+group+'</td></tr>'
										);
					 
										last = group;
									}
								} );
							}
                        
                        
                         
                     });  
                
                 
                 }
				 
				
                 
                 $('#btn_create_invoice').click(function(){
                     
                    location.reload(); 
                 
                 });
                 
                  $('#btn_search_date').click(function(){
                     var v_invoice_from_date = formatDate($("#txt_start_date").val());
                     var v_invoice_to_date = formatDate($("#txt_end_date").val());
                     load_data_to_grid_view_invoice_list_between(v_invoice_from_date,v_invoice_to_date);
                   
                  });
                 
                 $("#txt_end_date").on("change", function() {
                     var v_invoice_from_date = formatDate($("#txt_start_date").val());
                     var v_invoice_to_date = formatDate($("#txt_end_date").val());
                     load_data_to_grid_view_invoice_list_between(v_invoice_from_date,v_invoice_to_date);
                   
                  });
                  
                   $('#list_of_invoices tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = invoice_view_list_table.row($row).data();
                        
                        v_invoice_number  = data.invoice_number;
                        $('#txt_invoice_description').val('');
                        $('#txt_invoice_quantity').val('');
                        $('#txt_invoice_unit').val('');
                        $('#txt_invoice_rate').val('');
                        $('#txt_invoice_amount').val('');
                        $( '#btn_invoice_add' ).show();
                        $( '#btn_invoice_edit' ).hide();
                        
                         if($(this).attr("name")=='view_invoice')
                         {
                   
                        $('#div_company_select option').map(function () {
                        if ($(this).text() == $.trim(data.company_name)) return this;
                        }).attr('selected', 'selected');
                        //$("#txt_invoice_company_name").val(data.company_name);
                        $("#txt_invoice_po_box").val(data.po_box);
                        $("#txt_invoice_contact_no").val(data.telephone_no);
                        $("#txt_invoice_fax").val(data.fax);
                        $("#txt_invoice_attn").val(data.attn);
                        $("#txt_invoice_no").val(data.invoice_number);
                        
                        $('#txt_invoice_discount_amount').val(data.total_discount_amount);
                       // $('#txt_hidden_discount_type').val(data.discount_type);
                        $('#txt_hidden_discount_amount').val(data.discount_amount);
                       // $('#txt_invoice_discount_type').val(data.discount_amount+ '('+data.discount_type+')');
                        
                         var invoice_date=data.invoice_date.split(' ');
                        var invoice_date= invoice_date[0].split('-');
                        var invoice_date=invoice_date[1]+'/'+invoice_date[0]+'/'+invoice_date[2];
                        
                        $("#txt_invoice_date").val(invoice_date);
                        $("#txt_invoice_quotation_ref").val(data.quotation_reference);
                        $('#txt_invoice_lpo_no').val(data.LPO_no);
                        $('#txt_invoice_project_name').val(data.project_name) ;
                        $('#txt_invoice_project_id').val(data.project_id) ;
                        // $('input[name=option][value=2]').attr('checked', true);
                        
                        if(data.invoice_against=="2")
                        {
                            
                            console.log(data.invoice_against+"if");
                            // $('input[name=option][value=2]').attr('checked', true);
                            
                           
                             $("#customradio2").prop("checked", true);
                            $('#quotation_list_div').hide();
                            $('#delivery_note_tbl_div').show();
                             $('#div_hide').show();
                           load_data_to_grid_invoice_list(data.invoice_number);  
                        }
                        else
                        {
                            console.log(data.invoice_against+"else");
                            // $('input[name=option][value=1]').attr('checked', true);
                           
                            $("#customradio1").prop("checked", true);
                            
                             $('#delivery_note_tbl_div').hide();
                              $('#div_hide').hide();
                            $('#quotation_list_div').show();
                           load_data_to_grid_delivery_note_list(data.invoice_number);   
                        }
                       
                       
                      
                        $('#txt_invoice_vat').val(data.vat);
                        $('#txt_invoice_total_amount').val(data.total_amount);
                        $('#txt_invoice_received_amount').val(data.received_amount);
                        
                        $('#txt_invoice_net_balance_due').val(data.balane_in_due);
                        $('#txt_invoice_previous_bill_amount').val(data.previous_bill_amount);
                        $('#txt_invoice_retention_percentage').val(data.retention_amount_percentage);
                        
                        var x = (data.total_amount*(data.received_amount/100)).toFixed(3);
                        $('#txt_invoice_balance_due').val(x);
                        var y= data.total_amount*(data.retention_amount_percentage/100).toFixed(3);
                         $('#txt_invoice_retention_amount').val(y);
                         const editorData = editor.setData(data.description);
                         $("#txt_invoice_all_description").val(editorData);
                        
                       
                       console.log('company_id'+data.company_id);
                        $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                                   if(status=="success")
                                   {
                                     
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).text() == $.trim(data.project_name)) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
                        });
                        $("#div_select_quotation_combo").load('../controller/delivery_note/delivery_note_controller.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:data.project_id},function(result,status){
                             if(status=="success")
                                   {
                                     
                                       $('#div_select_quotation_combo option').map(function () {
                                        if ($(this).text() == $.trim(data.quotation_reference)) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
                         }); 
                        
                         $('#btn_generate_invoice' ).hide();
                         $('#btn_edit_invoice' ).show();
                         
                        
                        closeNavR();
                        
                         }
                         if($(this).attr("name")=='delete_invoice')
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
                						
                						       cancel_invoice(v_invoice_number);
                             				   load_data_to_grid_view_invoice_list()		 
                							} else {
                							


                							


                							


                							}
                						 });
                    
                         }
                       
                  
                   });
                   
                                 
                
                
                 
                  $('#tbl_invoice_list tbody').on('click', 'td button', function (){
                   
                        var $row = $(this).closest('tr');
                        var data = invoice_list_table.row($row).data();
                        v_invoice_number  = data.invoice_no;
                        v_invoice_child_id=data.invoice_child_id
                        $("#txt_invoice_child_id").val(data.invoice_child_id);
                        $('#txt_invoice_description').val(data.description);
                        $('#txt_invoice_quantity').val(data.quantity);
                        $('#txt_invoice_unit').val(data.unit);
                        $('#txt_invoice_rate').val(data.rate);
                        $('#txt_invoice_amount').val(data.amount);
                 
                        $( '#btn_invoice_add' ).hide();
                        $( '#btn_invoice_edit' ).show();
                      
                  });
                  
                 
              
                
                $('#btn_edit_invoice').click(function(){
                    var v_invoice_child_id=$("#txt_invoice_child_id").val();
                   // var v_invoice_company_name=$("#txt_invoice_company_name").val();
                     var v_invoice_company_name=$("#div_company_select option:selected").text();
                     var v_invoice_company_id=$("#div_company_select option:selected").val();
                    var v_invoice_po_box=$("#txt_invoice_po_box").val();
                    var v_invoice_contact_no=$("#txt_invoice_contact_no").val();
                    var v_invoice_fax=$("#txt_invoice_fax").val();
                    var v_invoice_attn=$("#txt_invoice_attn").val();
                    var v_invoice_no=$("#txt_invoice_no").val();
                    var v_invoice_date=formatDate($("#txt_invoice_date").val());
                    var v_invoice_quotation_ref=$("#txt_invoice_quotation_ref").val();
                    var v_invoice_lpo_no=$('#txt_invoice_lpo_no').val();
                    
                    
                    
                    var v_invoice_description=$('#txt_invoice_description').val();
                    
                    var v_invoice_quantity=$('#txt_invoice_quantity').val();
                    var v_invoice_unit=$('#txt_invoice_unit').val();
                    var v_invoice_rate=$('#txt_invoice_rate').val();
                    var v_invoice_amount=$('#txt_invoice_amount').val();
                    
                    
                     var v_invoice_vat=$('#txt_invoice_vat').val();
                     var total_amount=(parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_invoice_vat))/100)).toFixed(3);
                     $('#txt_invoice_total_amount').val(total_amount);
                     var v_invoice_total_amount=$('#txt_invoice_total_amount').val(); 
                     var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                      var balance_amount=(parseFloat(v_invoice_total_amount)*(parseFloat(v_invoice_received_amount)/100))+(parseFloat(v_invoice_total_amount)).toFixed(3);
                     $('#txt_invoice_balance_due').val(balance_amount);
                     var v_invoice_balance_due=$('#txt_invoice_balance_due').val();
                     const editorData = editor.getData();
                   
                    var v_invoice_all_description= editorData;
                     //var v_invoice_all_description=$("#txt_invoice_all_description").val();
                     var v_invoice_sub_total=pageTotal1;
                    var v_invoice_retention_amount=$("#txt_invoice_retention_percentage").val();
                    var v_invoice_previous_bill_amount=$("#txt_invoice_previous_bill_amount").val();
                     var v_invoice_net_balance_due=$("#txt_invoice_net_balance_due").val();
                    
                     var v_invoice_sub_total=pageTotal1;
                  
            
                    if($.trim(v_invoice_company_name)==""||$.trim(v_invoice_po_box)==""||$.trim(v_invoice_contact_no)==""||$.trim(v_invoice_fax)==""||$.trim(v_invoice_attn)==""||$.trim(v_invoice_date)==""||$.trim(v_invoice_quotation_ref)==""||$.trim(v_invoice_lpo_no)==""||$.trim(v_invoice_all_description)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_invoice_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/invoice/invoice_controller_v3.php",{action:'edit_invoice',v_invoice_company_name:v_invoice_company_name,v_invoice_company_id:v_invoice_company_id,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,v_invoice_description:v_invoice_description,v_invoice_quantity:v_invoice_quantity,v_invoice_unit:v_invoice_unit,v_invoice_rate:v_invoice_rate,v_invoice_amount:v_invoice_amount,v_invoice_no:v_invoice_no,v_invoice_vat:v_invoice_vat,v_invoice_total_amount:v_invoice_total_amount,v_invoice_received_amount:v_invoice_received_amount,v_invoice_balance_due:v_invoice_net_balance_due,v_invoice_all_description:v_invoice_all_description,v_invoice_sub_total:v_invoice_sub_total,v_invoice_child_id:v_invoice_child_id,v_invoice_retention_amount:v_invoice_retention_amount,v_invoice_previous_bill_amount:v_invoice_previous_bill_amount
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_invoice_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_but_invoice_edit.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Invoice updated successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_invoice_add' ).show();
                                     $( '#btn_invoice_edit' ).hide();
                                     //$("#txt_invoice_no").val(result);
                                     //$("#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_contact_no,#txt_invoice_fax,#txt_invoice_attn,#txt_invoice_no,#txt_invoice_date,#txt_invoice_quotation_ref,#txt_invoice_lpo_no").prop("readonly",true);
                                     
                                     
                                    load_data_to_grid_invoice_list( v_invoice_no);
                                     clear_text();
                                    
                                }
                            
                        }); 
                     }
            
                    
                    
                });        
                
                  
                 
                $('#btn_invoice_print').click(function(){
                    var invoice_number=$('#txt_invoice_no').val();
                   
                    if($.trim(invoice_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create invoice for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/invoice/invoice_controller_v3.php",{action:'invoice_status',v_invoice_no:invoice_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_invoice_status=obj.data[0].invoice_status;
                       if(v_invoice_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate invoice for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/invoice_print_v3.php?invoice_number="+invoice_number,"_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                    
                });
                
                 $('#btn_invoice_print_without_head').click(function(){
                     
                       var invoice_number=$('#txt_invoice_no').val();
                   
                    if($.trim(invoice_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create invoice for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/invoice/invoice_controller_v3.php",{action:'invoice_status',v_invoice_no:invoice_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_invoice_status=obj.data[0].invoice_status;
                       if(v_invoice_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate invoice for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/invoice_print_without_head_v1.php?invoice_number="+invoice_number,"_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                       
                       
                      
                 });
                  
                 $('#btn_invoice_print_with_head').click(function(){
                       var invoice_number=$('#txt_invoice_no').val();
                   
                    if($.trim(invoice_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create invoice for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/invoice/invoice_controller_v3.php",{action:'invoice_status',v_invoice_no:invoice_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_invoice_status=obj.data[0].invoice_status;
                       if(v_invoice_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate invoice for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/invoice_print_with_head_v1.php?invoice_number="+invoice_number,"_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                     
                 }); 
                 
                   function load_data_to_grid_view_cancel_invoice_list()
                 {
                     invoice_view_list_table.destroy();
                         
                     invoice_view_list_table = $('#list_of_cancel_invoices').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/invoice_controller_v3.php',
                                 'data': {
                                    action: 'list_of_cancel_invoice_view',
                                    
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
            				"scrollY": 300,
                            "scrollX": true,
                            "scroller": true,
            			    "fixedHeader": {
                                header: true,
                               footer: true
                            },
                            "columns": [
                              
                                 { "data": "invoice_main_id","visible":false },
                                 { "data": "invoice_date","width":"50px"},
                                 { "data": "invoice_number","width":"40px"},
                                 { "data": "company_name","width":"200px"},
                                 { "data": "balane_in_due","width":"200px"},
                                 { "data": "invoice_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_invoice" name="view_invoice" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         }
                                 
             
                             ],
                             pageLength: 25,
            				 searching: false,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                                                      
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 }
                 
                 
                 function load_data_to_grid_view_cancel_invoice_list_between(v_invoice_from_date,v_invoice_to_date)
                 {
                      invoice_view_list_table.destroy();
                         
                     invoice_view_list_table = $('#list_of_cancel_invoices').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/invoice_controller_v3.php',
                                 'data': {
                                    action: 'list_cancel_invoice_view_between',
                                    v_invoice_from_date:v_invoice_from_date,
                                    v_invoice_to_date:v_invoice_to_date
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
            				"scrollY": 300,
                            "scrollX": true,
                            "scroller": true,
            			    "fixedHeader": {
                                header: true,
                               footer: true
                            },
                            "columns": [
                              
                                 { "data": "invoice_main_id","visible":false },
                                 { "data": "invoice_date","width":"50px"},
                                 { "data": "invoice_number","width":"40px"},
                                 { "data": "company_name","width":"200px"},
                                 { "data": "balane_in_due","width":"200px"},
                                 { "data": "invoice_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_invoice" name="view_invoice" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         }
    					        
             
                             ],
                             pageLength: 25,
            				 searching: false,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                               
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 
                 }
                 
                  $('#list_of_cancel_invoices tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = invoice_view_list_table.row($row).data();
                        v_invoice_number  = data.invoice_number;
                        $('#txt_invoice_description').val('');
                        $('#txt_invoice_quantity').val('');
                        $('#txt_invoice_unit').val('');
                        $('#txt_invoice_rate').val('');
                        $('#txt_invoice_amount').val('');
                        $( '#btn_invoice_add' ).show();
                        $( '#btn_invoice_edit' ).hide();
                        
                         if($(this).attr("name")=='view_invoice')
                         {
                   
                        $('#div_company_select option').map(function () {
                        if ($(this).text() == $.trim(data.company_name)) return this;
                        }).attr('selected', 'selected');
                        //$("#txt_invoice_company_name").val(data.company_name);
                        $("#txt_invoice_po_box").val(data.po_box);
                        $("#txt_invoice_contact_no").val(data.telephone_no);
                        $("#txt_invoice_fax").val(data.fax);
                        $("#txt_invoice_attn").val(data.attn);
                        $("#txt_invoice_no").val(data.invoice_number);
                        $("#txt_invoice_date").val(data.invoice_date);
                        $("#txt_invoice_quotation_ref").val(data.quotation_reference);
                        $('#txt_invoice_lpo_no').val(data.LPO_no);
                        $('#txt_invoice_discount_amount').val(data.total_discount_amount);
                       // $('#txt_hidden_discount_type').val(data.discount_type);
                        $('#txt_hidden_discount_amount').val(data.discount_amount);
                       // $('#txt_invoice_discount_type').val(data.discount_amount+ '('+data.discount_type+')');
                        load_data_to_grid_invoice_list(data.invoice_number);
                       
                      
                        $('#txt_invoice_vat').val(data.vat);
                        $('#txt_invoice_total_amount').val(data.total_amount);
                        $('#txt_invoice_received_amount').val(data.received_amount);
                        
                        $('#txt_invoice_net_balance_due').val(data.balane_in_due);
                        //alert(data.balane_in_due+'balance in due');
                        $('#txt_invoice_previous_bill_amount').val(data.previous_bill_amount);
                        $('#txt_invoice_retention_percentage').val(data.retention_amount_percentage);
                        
                        var x = (data.total_amount*(data.received_amount/100)).toFixed(3);
                        $('#txt_invoice_balance_due').val(x);
                        var y= data.total_amount*(data.retention_amount_percentage/100).toFixed(3);
                         $('#txt_invoice_retention_amount').val(y);
                         const editorData = editor.setData(data.description);
                         $("#txt_invoice_all_description").val(editorData);
                       
                        //$("#txt_invoice_all_description").val(data.description);
                        //$( '#btn_invoice_add' ).hide();
                       // $( '#btn_invoice_edit' ).show();
                       
                        $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                                   if(status=="success")
                                   {
                                      
                                       $('#div_project_select_combo option').map(function () {
                                           
                                        if ($(this).text() == $.trim(data.project_name)) return this;
                                        }).attr('selected', 'selected');
                                     //$('#div_project_select_combooption[value='+data.project_id+']').prop('selected','selected');  
                                   }
                        });
                        $("#div_select_quotation_combo").load('../controller/delivery_note/delivery_note_controller.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:data.project_id},function(result,status){
                             if(status=="success")
                                   {
                                       $('#div_select_quotation_combo option').map(function () {
                                        if ($(this).text() == data.quotation_reference) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
                         }); 
                        
                         $('#btn_generate_invoice' ).hide();
                         $('#btn_edit_invoice' ).hide();
                         closeNavRCancel();   
                         }
                        
                       
                  
                   });
                   
                 
                 
                 
                 
                  $('#btn_search_cancel_date').click(function(){
                     var v_invoice_from_date = formatDate($("#txt_cancel_start_date").val());
                     var v_invoice_to_date = formatDate($("#txt_cancel_end_date").val());
                     load_data_to_grid_view_cancel_invoice_list_between(v_invoice_from_date,v_invoice_to_date);
                   
                  });
                
                  
                 $('#btn_view_list_of_invoice').click(function(){
                    
					var v_start_date_year= new Date().getFullYear();
                    $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                    load_data_to_grid_view_invoice_list(); 
                     
                 });   
                 
                 $('#btn_view_list_of_cancelled_invoice').click(function(){
                    	var v_start_date_year= new Date().getFullYear();
                    $("#txt_cancel_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
				
                   load_data_to_grid_view_cancel_invoice_list();
                     
                 });   
				
//////////////////Amount type change event starts/////////////////////
			 $("#select_amount_type").on("change", function() {
				var v_sel_amnt_type = $(this).find(':selected').text();
					$('#lbl_received').text( v_sel_amnt_type );
			  });

//////////////////Amount type change event end////////////////////////                
                  
 
});