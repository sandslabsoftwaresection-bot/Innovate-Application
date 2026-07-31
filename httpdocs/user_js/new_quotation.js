$(document).ready(function(){
   
                var v_but_quotation_save = $( '#btn_quotation_add' ).ladda();
                var v_but_quotation_edit = $( '#btn_quotation_edit' ).ladda();
                var v_project_name,v_project_id;
                var quotation_list_table = $('#tbl_quotation_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
                var quotation_view_list_table = $('#list_of_quotations').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 $('#tbl_quotation_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#list_of_quotations').removeClass( 'display' ).addClass('table table-striped table-bordered');
                  $('#tbl_quotation_list tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { quotation_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                 $('#list_of_quotations tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { quotation_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                 }); 
                 
                 $( '#btn_quotation_edit' ).hide();
                 $('#btn_edit_quotation' ).hide();
                 check_pending_quotation();
                 
                 load_data_to_grid_view_quotation_list(); 
                 
                 load_company_select_box('div_company_select','select_company');
                 
                 load_subject_combo('div_subject_combo','subject_combo');
                 
                 
                   function load_company_select_box(div_name,ctrl_name)
                        { 
      
                   $("#"+div_name).load('../controller/quotation/quotation_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});
        
                        }
                        
                        
                    function load_subject_combo(div_name,ctrl_name)
                        
                        {
                            $("#"+div_name).load('../controller/quotation/quotation_controller.php',{action:'select_subject',v_ctrl_name:ctrl_name},function(result,status){});
                            
                        }
                   $("#div_subject_combo").change(function() {
                       
                      var subject_id=$('option:selected', this).val();
                     
                      $.post("../controller/quotation/quotation_controller.php",{action:'select_subject_details',v_subject_id:subject_id},function(result,status){
                           var obj= jQuery.parseJSON(result);
                          const editorData1 = editor1.setData(obj.data[0].subject_text);
                          
                         //var v_quotation_all_description= editorData;
                       
                           //$("#editor").val(v_quotation_all_description);
                           $("#txt_subject").val(editorData1); 
                          
                      });
                       
                        // $("#txt_subject").val
                   });
                        
                  $("#div_company_select").change(function() {
                      
                    $('#txt_quotation_company_name').val($('option:selected', this).text()) ;
                    var company_id=$('option:selected', this).val() ;
                    
                    $.post("../controller/quotation/quotation_controller.php",{action:'select_company_details',v_company_id:company_id},function(result,status){
                        
                                if(status=="success")
                                {
                                    
                                var obj= jQuery.parseJSON(result);
                                $("#txt_quotation_company_id").val(obj.data[0].company_id);
                                $("#txt_quotation_company_name").val(obj.data[0].company_name);
                                $("#txt_quotation_po_box").val(obj.data[0].city);
                                $("#txt_quotation_contact_no").val(obj.data[0].contact_phone);
                                $("#txt_quotation_fax").val(obj.data[0].fax);
                                $("#txt_quotation_attn").val(obj.data[0].contact_person);
                                $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                            
                               });
                                
                                }
                                else
                                {
                                    return false;
                                }
                    });           
                   
                 });
                  let editor1;
                
                        ClassicEditor
                            .create( document.querySelector( '#txt_subject' ) )
                            .then( newEditor => {
                                editor1 = newEditor;
                            } )
                            .catch( error => {
                                console.error( error );
                            } );
                
                
                 
                 
                 
                 let editor;
                
                        ClassicEditor
                            .create( document.querySelector( '#editor' ) )
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
                
                function check_pending_quotation()
                    {
                        
                         $.post("../controller/quotation/quotation_controller.php",{action:'check_quotation_status'},function(result,status){
                               var obj= jQuery.parseJSON(result);
                               var v_quotation_count=obj.data[0].quotation_count;
                               var v_quotation_id=obj.data[0].quotation_main_id;
                               var v_quotation_number=obj.data[0].quotation_number;
                               
                               if(v_quotation_count>0)
                                {
                                            swal({
                                                                
                                    							title: "You have an uncompleted quotation request",
                                    							text: "Do you want to load again?",
                                    							icon: 'warning',
                                    							dangerMode: true,
                                    							allowOutsideClick: false,
                                                                closeOnClickOutside: false,
                                    							buttons: {
                                    							  cancel: 'No cancel old request!',
                                    							  delete: 'Yes please load'
                                    							}
                                    							}).then(function (willDelete) {
                                    							if (willDelete) {
                                    						
                                    						      select_quotation(v_quotation_number);
                                                 						 
                                    							} else {
                                    							    
                                    							  cancel_quotation(v_quotation_number);
                                    							 
                                    							}
                                    				});
                                    
                                   
                               }
                        });
                } 
                         
                        
                                             
                    function select_quotation(v_quotation_number)
                    {
                         
                         $.post("../controller/quotation/quotation_controller.php",{action:'select_quotation_pending_data',v_quotation_no:v_quotation_number},function(result,status){
                                var obj= jQuery.parseJSON(result);
                                
                                
                                $('#div_company_select option[value='+obj.data[0].company_id+']').prop('selected','selected');
                               
                                $("#txt_quotation_company_name").val(obj.data[0].company_name);
                                $("#txt_quotation_po_box").val(obj.data[0].po_box);
                                $("#txt_quotation_contact_no").val(obj.data[0].telephone_no);
                                $("#txt_quotation_fax").val(obj.data[0].fax);
                                $("#txt_quotation_attn").val(obj.data[0].attn);
                                $("#txt_quotation_no").val(obj.data[0].quotation_number);
                                
                                var qut_date=obj.data[0].quotation_date.split(' ');
                                var quotation_date= qut_date[0].split('-');
                                var quotation_data=quotation_date[1]+'/'+quotation_date[2]+'/'+quotation_date[0];
                                $("#txt_quotation_date").val(quotation_data);
                                $("#txt_quotation_ref").val(obj.data[0].quotation_reference);
                               // alert(obj.data[0].project_id);
                               
                                $("#txt_subject").val(obj.data[0].subject);
                                
                                $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                                   if(status=="success")
                                   {
                                      $('#div_project_select_combo option[value='+obj.data[0].project_id+']').prop('selected','selected');  
                                   }
                                 });
                                load_data_to_grid_quotation_list(obj.data[0].quotation_number);
                               
                              
                               
                                $("#editor").val(obj.data[0].description);
                                $( '#btn_quotation_add' ).show();
                                $( '#btn_quotation_edit' ).hide();
                                
                                
                                $("#quotation_no_head").html(obj.data[0].quotation_number);
                                $('#btn_generate_quotation' ).show();
                                 
                                
                             });
                        
                       
                        
                        
                    }
                   
                   
                    
                    function cancel_quotation(v_quotation_number)
                    {
                        
                        $.post("../controller/quotation/quotation_controller.php",{action:'cancel_quotation_list',v_quotation_no:v_quotation_number
                                                }
                                                , function(result,status)
                                                {
                                                   
                         });
                       
                    }
   
                
                
                $('#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_attn').keypress(function (e) {
           
                    var str = $(this).val();
                    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                    
                    });
                    $(this).val(str);
        

               });
               
               $('#txt_quotation_quantity, #txt_quotation_amount,#txt_quotation_rate').on("keypress", function (e) {
               
                if (e.which != 8 && e.which != 0 && ((e.which < 48 || e.which > 57) && e.which != 46)) {
                    e.preventDefault();
                }
               });
                           
               $('#txt_quotation_contact_no,#txt_quotation_fax').keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       
                        e.preventDefault();
                        return false;
                    }
               });
               
               
                
                
                $('#txt_quotation_rate').change(function(){
                    
                     var v_quotation_quantity=$('#txt_quotation_quantity').val();
                     var v_quotation_rate=$('#txt_quotation_rate').val();
                     var v_amount=(parseFloat(v_quotation_quantity)*parseFloat(v_quotation_rate)).toFixed(3);
                     var v_quotation_amount=$('#txt_quotation_amount').val(v_amount);
                     $('#txt_net_amount').val(v_amount);
                     $('#txt_discount_percentage').val('0.000');
                     $('#txt_amt_after_discount').val(v_amount);
                     $('#txt_tax_percentage').val('0.000');
                    
                     
                 });
                 
                  $('#txt_quotation_quantity').change(function(){
                    var v_quotation_rate=$('#txt_quotation_rate').val();
                   
                    if(parseFloat(v_quotation_rate) >= 0 )
                    {
                     
                      var v_quotation_quantity=$('#txt_quotation_quantity').val();
                      var v_amount=(parseFloat(v_quotation_quantity)*parseFloat(v_quotation_rate)).toFixed(3);
                      var v_quotation_amount=$('#txt_quotation_amount').val(v_amount);
                      $('#txt_net_amount').val(v_amount);
                      $('#txt_discount_percentage').val('0.000');
                      $('#txt_amt_after_discount').val(v_amount);
                      $('#txt_tax_percentage').val('0.000');
                      
                    }
                    else
                    {
                      var v_quotation_amount=$('#txt_quotation_amount').val(0.00);  
                      
                    }
                     
                  });
                 
                  
                    $('#txt_discount_percentage').change(function(){
                        
                       var quotation_amount=$('#txt_quotation_amount').val();
                       if(quotation_amount != "")
                       {
                       //alert(quotation_amount);
                       var discount_percentage= $('#txt_discount_percentage').val();
                       var discount_amount=parseFloat(quotation_amount)*(parseFloat(discount_percentage)/100);
                       var amt_after_discount=parseFloat(quotation_amount)-parseFloat(discount_amount);
                       $('#txt_amt_after_discount').val(amt_after_discount);
                       $('#txt_net_amount').val(amt_after_discount);
                       $('#txt_tax_percentage').val('0.000');
                       }
                       
                       else
                       {
                           
                       }
                   });
                   
                   
                   $('#txt_tax_percentage').change(function(){
                       
                       var amt_after_discount = $('#txt_amt_after_discount').val();
                      // alert(amt_after_discount);
                       if(parseFloat(amt_after_discount) > 0 || parseFloat(amt_after_discount) != "")
                       {
                       var tax_percentage= $('#txt_tax_percentage').val();
                       var tax_amount=parseFloat(amt_after_discount)*(parseFloat(tax_percentage)/100);
                       var amt_after_tax=parseFloat(amt_after_discount)+parseFloat(tax_amount);
                       $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                       }
                       else
                       {
                       var quotation_amount=$('#txt_quotation_amount').val();       
                       var tax_percentage= $('#txt_tax_percentage').val();
                       var tax_amount=parseFloat(quotation_amount)*(parseFloat(tax_percentage)/100);
                       var amt_after_tax=parseFloat(quotation_amount)+parseFloat(tax_amount);
                       $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                           
                       }
                       
                   });
                
                v_but_quotation_save.click(function(){
                      
                 
                    v_but_quotation_save.ladda( 'start' );
                    
                    var v_quotation_company_name=$("#txt_quotation_company_name").val();
                    var v_quotation_company_id=$("#txt_quotation_company_id").val();
                    var v_quotation_po_box=$("#txt_quotation_po_box").val();
                    var v_quotation_contact_no=$("#txt_quotation_contact_no").val();
                    var v_quotation_fax=$("#txt_quotation_fax").val();
                    var v_quotation_attn=$("#txt_quotation_attn").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                    var v_quotation_date=formatDate($("#txt_quotation_date").val());
                    var v_quotation_ref=$("#txt_quotation_ref").val();
                   // var v_quotation_lpo_no=$('#txt_quotation_lpo_no').val();
                     var v_quotation_subject=$("#txt_subject").val();
                    
                    
                    var v_quotation_description=$('#txt_quotation_description').val();
                    
                    var v_quotation_quantity=$('#txt_quotation_quantity').val();
                    var v_quotation_unit=$('#txt_quotation_unit').val();
                    var v_quotation_rate=$('#txt_quotation_rate').val();
                    var v_quotation_amount=$('#txt_quotation_amount').val();
                    
                     var v_project_name=$("#div_project_select_combo option:selected").text();
                     var v_project_id=$("#div_project_select_combo option:selected").val();
                     
                    var v_discount_percentage=$('#txt_discount_percentage').val();
                    var v_amt_after_discount=$('#txt_amt_after_discount').val();
                    var v_tax_percentage=$('#txt_tax_percentage').val();
                    var v_net_amount=$('#txt_net_amount').val();
                     
                     
                    
                    if($.trim(v_quotation_company_name)=="select"||$.trim(v_quotation_company_name)==" "||$.trim(v_quotation_po_box)==""||$.trim(v_quotation_contact_no)==""||$.trim(v_quotation_fax)==""||$.trim(v_quotation_attn)==""||$.trim(v_quotation_date)==""||$.trim(v_quotation_ref)==""||$.trim(v_quotation_description)==""||$.trim(v_quotation_quantity)==""||$.trim(v_quotation_unit)==""||$.trim(v_quotation_rate)==""||$.trim(v_quotation_amount)==""|| $.trim(v_discount_percentage)==" " || $.trim(v_amt_after_discount)==" " ||$.trim(v_tax_percentage)==" " || $.trim(v_net_amount)==" " || $.trim(v_project_id) == "0")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_quotation_save.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/quotation/quotation_controller.php",{action:'add_quotation',v_quotation_company_name:v_quotation_company_name,v_quotation_po_box:v_quotation_po_box,v_quotation_contact_no:v_quotation_contact_no,v_quotation_fax:v_quotation_fax,v_quotation_attn:v_quotation_attn,v_quotation_no:v_quotation_no,v_quotation_date:v_quotation_date,v_quotation_ref:v_quotation_ref,v_quotation_description:v_quotation_description,v_quotation_quantity:v_quotation_quantity,v_quotation_unit:v_quotation_unit,v_quotation_rate:v_quotation_rate,v_quotation_amount:v_quotation_amount,v_quotation_subject:v_quotation_subject,v_company_id:v_quotation_company_id,v_project_name:v_project_name,v_project_id:v_project_id,v_discount_percentage:v_discount_percentage,v_amt_after_discount:v_amt_after_discount,v_tax_percentage:v_tax_percentage,v_net_amount:v_net_amount
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_quotation_save.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_quotation_list()
                                    clear_text()
                                   

                                
                                }
                                else 
                                {
                                     v_but_quotation_save.ladda( 'stop' );
                                    
                                     //swal("Success"," quotation added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item added to quotation Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                    
                                    
                                     $("#txt_quotation_no").val(result);
                                     $("#quotation_no_head").html(result);
                                     //$("#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_contact_no,#txt_quotation_fax,#txt_quotation_attn,#txt_quotation_no,#txt_quotation_date,#txt_quotation_quotation_ref,#txt_quotation_lpo_no").prop("readonly",true);
                                     
                                     
                                    load_data_to_grid_quotation_list(result);
                                    
                                    
                                    
                                     clear_text();
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
            
                
               
                      
                 function clear_text()
                 {
                     
                    $('#txt_quotation_description').val('');
                    $('#txt_quotation_quantity').val('');
                    $('#txt_quotation_unit').val('');
                    $('#txt_quotation_rate').val('0.000');
                    $('#txt_quotation_amount').val('0.000');
                    $('#txt_discount_percentage').val('0.000');
                    $('#txt_amt_after_discount').val('0.000');
                    $('#txt_tax_percentage').val('0.000');
                    $('#txt_net_amount').val('0.000');
                    // load_subject_combo('div_subject_combo','subject_combo');
                    // $('#txt_subject').val('');
                   
                    
                   
                 }
            
            
               
            
                
            
            
                function load_data_to_grid_quotation_list(quotation_no)
                 {
                     quotation_list_table.destroy();
                         
                     quotation_list_table = $('#tbl_quotation_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/quotation/quotation_controller.php',
                                 'data': {
                                    action: 'list_quotation',
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
                            "columns": [
                                 { "data": null },
                                 { "data": "quotation_child_id","visible":false },
                                 { "data": "quotation_no","visible":false },
                                 { "data": "description", width:"20%"},
                                 { "data": "quantity"},
                                 { "data": "unit"},
                                 { "data": "rate", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "discount_precentage",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 { "data": "discount_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 { "data": "vat_percentage", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') }
             
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
                            
                        }
                        
                         
                     });  
                
                 }
                 
                 
                     
                          
                      
                  $('#btn_generate_quotation').click(function(){
                 
                    var v_quotation_company_name=$("#txt_quotation_company_name").val();
                    var v_quotation_company_id=$("#txt_quotation_company_id").val();
                    var v_quotation_po_box=$("#txt_quotation_po_box").val();
                    var v_quotation_contact_no=$("#txt_quotation_contact_no").val();
                    var v_quotation_fax=$("#txt_quotation_fax").val();
                    var v_quotation_attn=$("#txt_quotation_attn").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                    var v_quotation_date=formatDate($("#txt_quotation_date").val());
                    var v_quotation_ref=$("#txt_quotation_ref").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                     const editorData1 = editor1.getData();
                   
                    var v_quotation_subject= editorData1;
                  //  var v_quotation_subject=$("#txt_subject").val();
                    var v_project_name=$("#div_project_select_combo option:selected").text();
                    var v_project_id=$("#div_project_select_combo option:selected").val();
                    const editorData = editor.getData();
                   
                    var v_quotation_all_description= editorData;
                   
                    var v_quotation_sub_total=pageTotal1;
                    alert(v_quotation_sub_total);
                     if($.trim(v_quotation_company_name)=="select"||$.trim(v_quotation_company_name)==" "||$.trim(v_quotation_po_box)==""||$.trim(v_quotation_contact_no)==""||$.trim(v_quotation_fax)==""||$.trim(v_quotation_attn)==""||$.trim(v_quotation_date)==""||$.trim(v_quotation_ref)==""||$.trim(v_quotation_subject)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_quotation_save.ladda( 'stop' );
                        return false;
                    }
                     else
                     {
                       $.post("../controller/quotation/quotation_controller.php",{action:'generate_quotation',v_quotation_no:v_quotation_no,
                       v_quotation_all_description:v_quotation_all_description,v_quotation_company_name:v_quotation_company_name,v_quotation_po_box:v_quotation_po_box,v_quotation_contact_no:v_quotation_contact_no,v_quotation_fax:v_quotation_fax,v_quotation_attn:v_quotation_attn,v_quotation_no:v_quotation_no,v_quotation_date:v_quotation_date,v_quotation_ref:v_quotation_ref,v_quotation_subject:v_quotation_subject,v_company_id:v_quotation_company_id,v_project_name:v_project_name,v_project_id:v_project_id,v_quotation_sub_total:v_quotation_sub_total
                       
                                }
                               
                                , function(result,status)
                                {
                                  if(result=="success")
                                  {
                                    swal("Success","Quotation generated successfully", "success"); 
                                   // clear_all_after_generate_quotation();
                                   // $("#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_contact_no,#txt_quotation_fax,#txt_quotation_attn,#txt_quotation_no,#txt_quotation_date,#txt_quotation_quotation_ref,#txt_quotation_lpo_no").prop("readonly",false);
                                     
                                  }
                                  else
                                  {
                                    swal("Error"," Some Error Occures..", "error"); 
                                    clear_all_after_generate_quotation(); 
                                  }
                          });
                     }
                  });
                  
                   $('#btn_search_date').click(function(){
                     var v_quotation_from_date = formatDate($("#txt_start_date").val());
                     var v_quotation_to_date = formatDate($("#txt_end_date").val());
                     load_data_to_grid_view_quotation_list_between(v_quotation_from_date,v_quotation_to_date);
                   
                  });
                
                 
                  
                 function clear_all_after_generate_quotation()
                 {
                   $('#txt_quotation_vat,#txt_quotation_total_amount,#txt_quotation_received_amount,#txt_quotation_balance_due,#txt_quotation_no,#txt_quotation_all_description,#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_contact_no,#txt_quotation_fax,#txt_quotation_attn,#txt_quotation_ref,#txt_quotation_lpo_no').val('');  
                   $("#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_contact_no,#txt_quotation_fax,#txt_quotation_attn,#txt_quotation_no,#txt_quotation_date,#txt_quotation_quotation_ref,#txt_quotation_lpo_no").prop("readonly",false);
                   var quotation_no=0;
                   load_data_to_grid_quotation_list(quotation_no);
                 }
                 
                 
                 function load_data_to_grid_view_quotation_list()
                 {
                     quotation_view_list_table.destroy();
                         
                     quotation_view_list_table = $('#list_of_quotations').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/quotation/quotation_controller.php',
                                 'data': {
                                    action: 'list_quotation_view',
                                    
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
                              
                                 { "data": "quotation_main_id","visible":false },
                                 { "data": "quotation_date"},
                                 { "data": "quotation_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                 { "data": "quotation_main_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="waves-effect waves-light text-white  btn blue box-shadow-none border-round mr-1 mb-1" onclick="openNavR()" id="view_quotations" name="view_quotations" ><i class="material-icons ">remove_red_eye</i></button>';
            								
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
                 
                 
                 function load_data_to_grid_view_quotation_list_between(v_quotation_from_date,v_quotation_to_date)
                 {
                      quotation_view_list_table.destroy();
                         
                     quotation_view_list_table = $('#list_of_quotations').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/quotation/quotation_controller.php',
                                 'data': {
                                    action: 'list_quotation_view_between',
                                    v_quotation_from_date:v_quotation_from_date,
                                    v_quotation_to_date:v_quotation_to_date
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
                              
                                 { "data": "quotation_main_id","visible":false },
                                 { "data": "quotation_date"},
                                 { "data": "quotation_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                 { "data": "quotation_main_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="waves-effect waves-light text-white  btn blue box-shadow-none border-round mr-1 mb-1" onclick="openNavR()" id="view_quotations" name="view_quotations" ><i class="material-icons ">remove_red_eye</i></button>';
            								
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
                 
                 $('#btn_create_quotation').click(function(){
                    //location.reload(); 
                 
                 });
                 
                 $("#txt_end_date").on("change", function() {
                     var v_quotation_from_date = formatDate($("#txt_start_date").val());
                     var v_quotation_to_date = formatDate($("#txt_end_date").val());
                     load_data_to_grid_view_quotation_list_between(v_quotation_from_date,v_quotation_to_date);
                   
                  });
                   $('#list_of_quotations tbody').on('click', 'td button', function (){
                       
                       var $row = $(this).closest('tr');
                        var data = quotation_view_list_table.row($row).data();
                        v_quotation_number  = data.quotation_number;
                        $('#txt_quotation_description').val('');
                        $('#txt_quotation_quantity').val('');
                        $('#txt_quotation_unit').val('');
                        $('#txt_quotation_rate').val('0.000');
                        $('#txt_quotation_amount').val('0.000');
                        $('#txt_discount_percentage').val('0.000');
                        $('#txt_amt_after_discount').val('0.000');
                        $('#txt_tax_percentage').val('0.000');
                        $('#txt_net_amount').val('0.000');
                        $( '#btn_quotation_add' ).show();
                        $( '#btn_quotation_edit' ).hide();
                        
                      
                   
                       // alert(data.company_name);
                        $('#div_company_select option').map(function () {
                        if ($(this).text() == data.company_name) return this;
                        }).attr('selected', 'selected');
                        
                        //$('#div_company_select option[value='+data.company_id+']').prop('selected','selected');  
                        $("#txt_quotation_company_id").val(data.company_id);
                        $("#txt_quotation_company_name").val(data.company_name);
                       
                        $("#txt_quotation_po_box").val(data.po_box);
                        $("#txt_quotation_contact_no").val(data.telephone_no);
                        $("#txt_quotation_fax").val(data.fax);
                        $("#txt_quotation_attn").val(data.attn);
                        $("#txt_quotation_no").val(data.quotation_number);
                        
                    //     $("#div_project_select_combo option:selected").text();
                    //   $("#div_project_select_combo option:selected").val();
                     
                     
                        var qut_date=data.quotation_date.split(' ');
                        var quotation_date= qut_date[0].split('-');
                        var quotation_data=quotation_date[1]+'/'+quotation_date[0]+'/'+quotation_date[2];
                        $("#txt_quotation_date").val(quotation_data);
                         $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                                   if(status=="success")
                                   {
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).text() == data.project_name) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
                        });
                        
                      
                        
                       
                        $("#txt_quotation_ref").val(data.quotation_reference);
                        $('#txt_subject').val(data.subject);
                        
                        
                         
                        load_data_to_grid_quotation_list(data.quotation_number);
                       
                         const editorData = editor.setData(data.description);
                   
                         var v_quotation_all_description= editorData;
                       
                        $("#editor").val(v_quotation_all_description);
                        //$( '#btn_quotation_add' ).hide();
                       // $( '#btn_quotation_edit' ).show();
                        
                        
                        $("#quotation_no_head").html(data.quotation_number);
                         $('#btn_generate_quotation' ).hide();
                         $('#btn_edit_quotation' ).hide();
                         
                        
                        closeNavR();
                      
                       
                       
                   });
                  
                 
                                 
                 $('#list_of_quotations tbody').on('dblclick', 'tr', function(){
                        var $row = $(this).closest('tr');
                        var data = quotation_view_list_table.row($row).data();
                        v_quotation_number  = data.quotation_number;
                        $('#txt_quotation_description').val('');
                        $('#txt_quotation_quantity').val('');
                        $('#txt_quotation_unit').val('');
                        $('#txt_quotation_rate').val('0.000');
                        $('#txt_quotation_amount').val('0.000');
                        $('#txt_discount_percentage').val('0.000');
                        $('#txt_amt_after_discount').val('0.000');
                        $('#txt_tax_percentage').val('0.000');
                        $('#txt_net_amount').val('0.000');
                        $( '#btn_quotation_add' ).show();
                        $( '#btn_quotation_edit' ).hide();
                        
                         swal("Confirm","Do you want to Edit or Delete?", {
                                      buttons: {
                                        cancel: "Cancel",
                                        catch: {
                                          text: "Edit",
                                          value: "catch",
                                        },
                                        defeat: {
                                          text: "Delete",
                                          value: "delete",
                                        },
                                      },
                                      icon:"warning",
                                    })
                                    .then((value) => {
                                      switch (value) {
                                     
                                        case "delete":
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
                                        						
                                        						       cancel_quotation(v_quotation_number);
                                                     						 
                                        							} else {
                                        							    
                                        							   
                                        							 
                                        							}
                                        						 });
                                          break;
                                     
                                          case "catch":
                                          
                                          //swal("Edit!", "Please Edit your data", "success");
                                          edit_data();
                                          closeNavR();
                                          
                                          break;
                                     
                                        default:
                                        
                                      }
                            
                       });    
                        
                     function  edit_data() 
                       {
                       // alert(data.company_name);
                        $('#div_company_select option').map(function () {
                        if ($(this).text() == data.company_name) return this;
                        }).attr('selected', 'selected');
                        
                        //$('#div_company_select option[value='+data.company_id+']').prop('selected','selected');  
                        $("#txt_quotation_company_id").val(data.company_id);
                        $("#txt_quotation_company_name").val(data.company_name);
                       
                        $("#txt_quotation_po_box").val(data.po_box);
                        $("#txt_quotation_contact_no").val(data.telephone_no);
                        $("#txt_quotation_fax").val(data.fax);
                        $("#txt_quotation_attn").val(data.attn);
                        $("#txt_quotation_no").val(data.quotation_number);
                        
                    //     $("#div_project_select_combo option:selected").text();
                    //   $("#div_project_select_combo option:selected").val();
                     
                     
                        var qut_date=data.quotation_date.split(' ');
                        var quotation_date= qut_date[0].split('-');
                        var quotation_data=quotation_date[1]+'/'+quotation_date[0]+'/'+quotation_date[2];
                        $("#txt_quotation_date").val(quotation_data);
                         $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                                   if(status=="success")
                                   {
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).text() == data.project_name) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
                        });
                        
                      
                        
                       
                        $("#txt_quotation_ref").val(data.quotation_reference);
                        $('#txt_subject').val(data.subject);
                        
                        
                         
                        load_data_to_grid_quotation_list(data.quotation_number);
                       
                         const editorData = editor.setData(data.description);
                   
                         var v_quotation_all_description= editorData;
                       
                        $("#editor").val(v_quotation_all_description);
                        //$( '#btn_quotation_add' ).hide();
                       // $( '#btn_quotation_edit' ).show();
                        
                        
                        $("#quotation_no_head").html(data.quotation_number);
                         $('#btn_generate_quotation' ).hide();
                         $('#btn_edit_quotation' ).show();
                         
                        
                        closeNavR();
                       }  
                        
                 });
                 
                
                 
                  $('#tbl_quotation_list tbody').on('dblclick', 'tr', function(){
                      
                      var $row = $(this).closest('tr');
                        var data = quotation_list_table.row($row).data();
                        v_quotation_number  = data.quotation_no;
                       swal("Confirm","Do you want to Edit or Delete?", {
                                      buttons: {
                                        cancel: "Cancel",
                                        catch: {
                                          text: "Edit",
                                          value: "catch",
                                        },
                                        defeat: {
                                          text: "Delete",
                                          value: "delete",
                                        },
                                      },
                                      icon:"warning",
                                    })
                                    .then((value) => {
                                      switch (value) {
                                     
                                        case "delete":
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
                                        						
                                        						       cancel_quotation_item_list(data.quotation_child_id,data.quotation_no);
                                                     						 
                                        							} else {
                                        							    
                                        							   
                                        							 
                                        							}
                                        						 });
                                          break;
                                     
                                          case "catch":
                                          
                                          //swal("Edit!", "Please Edit your data", "success");
                                          edit_current_data();
                                          closeNavR();
                                          
                                          break;
                                     
                                        default:
                                        
                                      }
                            
                       });  
                       
                       
                       
                       
            
                   
            function edit_current_data()
                 {
                        
                        
                        $("#txt_quotation_child_id").val(data.quotation_child_id);
                        alert(data.description);
                        $('#txt_quotation_description').val(data.description);
                        $('#txt_quotation_quantity').val(data.quantity);
                        $('#txt_quotation_unit').val(data.unit);
                        $('#txt_quotation_rate').val(data.rate);
                        $('#txt_quotation_amount').val(data.amount);
                        $('#txt_discount_percentage').val(data.discount_precentage);
                        $('#txt_amt_after_discount').val(data.discount_amount);
                        $('#txt_tax_percentage').val(data.vat_percentage);
                        $('#txt_net_amount').val(data.net_amount);
                        //$('#txt_subject').val(data.subject);
                        
                        // $("#div_project_select_combo").find('option').removeAttr("selected");
                        
                        //  $('#div_project_select_combo option').map(function () {
                        // if ($(this).text() == data.account_type) return this;
                        // }).attr('selected', 'selected');
                        
                     
                        $( '#btn_quotation_add' ).hide();
                        $( '#btn_quotation_edit' ).show();
                 }
                      
                  });
                  
                  
                function cancel_quotation_item_list(v_quotation_id,quotation_no)
                    {
                        
                        $.post("../controller/quotation/quotation_controller.php",{action:'cancel_quotation_item',v_quotation_child_id:v_quotation_id
                                                }
                                                , function(result,status)
                                                {
                                             load_data_to_grid_quotation_list(quotation_no)       
                                                   
                         });
                       
                    }   
                  
                  
                  
                  
                
                  v_but_quotation_edit.click(function(){
                      
                 
                    v_but_quotation_edit.ladda( 'start' );
                    var v_quotation_child_id=$("#txt_quotation_child_id").val();
                    var v_quotation_company_name=$("#txt_quotation_company_name").val();
                    var v_quotation_company_id=$("#txt_quotation_company_id").val();
                    var v_quotation_po_box=$("#txt_quotation_po_box").val();
                    var v_quotation_contact_no=$("#txt_quotation_contact_no").val();
                    var v_quotation_fax=$("#txt_quotation_fax").val();
                    var v_quotation_attn=$("#txt_quotation_attn").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                    var v_quotation_date=formatDate($("#txt_quotation_date").val());
                    var v_quotation_ref=$("#txt_quotation_ref").val();
                    const editorData1 = editor1.getData();
                   
                    var v_quotation_subject= editorData1;
                    //var v_quotation_subject=$('#txt_subject').val();
                    var v_project_name=$("#div_project_select_combo option:selected").text();
                    var v_project_id=$("#div_project_select_combo option:selected").val();
                  
                    var v_quotation_description=$('#txt_quotation_description').val();
                    var v_quotation_quantity=$('#txt_quotation_quantity').val();
                    var v_quotation_unit=$('#txt_quotation_unit').val();
                    var v_quotation_rate=$('#txt_quotation_rate').val();
                    var v_quotation_amount=$('#txt_quotation_amount').val();
                    
                    var v_discount_percentage=$('#txt_discount_percentage').val();
                    var v_amt_after_discount=$('#txt_amt_after_discount').val();
                    var v_tax_percentage=$('#txt_tax_percentage').val();
                    var v_net_amount=$('#txt_net_amount').val();
                    
                    
                    
                     const editorData = editor.getData();
                   
                    var v_quotation_all_description= editorData;
                    
                     var v_quotation_sub_total=pageTotal1;
                  
                  
                    if($.trim(v_quotation_company_id)=="0"||$.trim(v_quotation_company_id)==" "||$.trim(v_quotation_po_box)==""||$.trim(v_quotation_contact_no)==""||$.trim(v_quotation_fax)==""||$.trim(v_quotation_attn)==""
                    ||$.trim(v_quotation_date)==""||$.trim(v_quotation_ref)==""||$.trim(v_quotation_description)==""||$.trim(v_quotation_quantity)==""||
                    $.trim(v_quotation_unit)==""||$.trim(v_quotation_rate)==""||$.trim(v_quotation_amount)==""|| $.trim(v_discount_percentage)==" " || $.trim(v_amt_after_discount)==" " ||$.trim(v_tax_percentage)==" " || $.trim(v_net_amount)==" " || $.trim(v_project_id) == "0")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_quotation_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/quotation/quotation_controller.php",{action:'edit_quotation',v_quotation_company_name:v_quotation_company_name,v_quotation_po_box:v_quotation_po_box,
                         v_quotation_contact_no:v_quotation_contact_no,v_quotation_fax:v_quotation_fax,v_quotation_attn:v_quotation_attn,v_quotation_no:v_quotation_no,
                         v_quotation_date:v_quotation_date,v_quotation_ref:v_quotation_ref,v_quotation_description:v_quotation_description,v_quotation_quantity:v_quotation_quantity,
                         v_quotation_unit:v_quotation_unit,v_quotation_rate:v_quotation_rate,v_quotation_amount:v_quotation_amount,v_quotation_no:v_quotation_no,
                         v_quotation_all_description:v_quotation_all_description,v_quotation_sub_total:v_quotation_sub_total,v_quotation_child_id:v_quotation_child_id,v_quotation_subject:v_quotation_subject,v_discount_percentage:v_discount_percentage,v_amt_after_discount:v_amt_after_discount,v_tax_percentage:v_tax_percentage,v_net_amount:v_net_amount,v_project_id:v_project_id,v_project_name:v_project_name,v_company_id:v_quotation_company_id
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_quotation_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_quotation_list(v_quotation_no);
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_but_quotation_edit.ladda( 'stop' );
                                    
                                     //swal("Success"," quotation added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item edited to quotation Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_quotation_add' ).show();
                                     $( '#btn_quotation_edit' ).hide();
                                     //$("#txt_quotation_no").val(result);
                                     //$("#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_contact_no,#txt_quotation_fax,#txt_quotation_attn,#txt_quotation_no,#txt_quotation_date,#txt_quotation_quotation_ref,#txt_quotation_lpo_no").prop("readonly",true);
                                     
                                     
                                    load_data_to_grid_quotation_list( v_quotation_no);
                                     clear_text()
                                    
                                }
                            
                        }); 
                     }
            
                   
                });
                
                $('#btn_edit_quotation').click(function(){
                    
                    var v_quotation_child_id=$("#txt_quotation_child_id").val();
                    var v_quotation_company_name=$("#txt_quotation_company_name").val();
                    var v_quotation_company_id=$("#txt_quotation_company_id").val();
                    var v_quotation_po_box=$("#txt_quotation_po_box").val();
                    var v_quotation_contact_no=$("#txt_quotation_contact_no").val();
                    var v_quotation_fax=$("#txt_quotation_fax").val();
                    var v_quotation_attn=$("#txt_quotation_attn").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                    var v_quotation_date=formatDate($("#txt_quotation_date").val());
                    var v_quotation_ref=$("#txt_quotation_ref").val();
                    const editorData1 = editor1.getData();
                    var v_quotation_subject=editorData1;
                    var v_project_name=$("#div_project_select_combo option:selected").text();
                    var v_project_id=$("#div_project_select_combo option:selected").val();
                    // alert(v_quotation_company_name);
                     const editorData = editor.getData();
                   
                    var v_quotation_all_description= editorData;
                    
                   
                    
                    
                     
                     var v_quotation_sub_total=pageTotal1;
                  
                    // alert(v_quotation_company_name+'----'+v_quotation_po_box+'----'+v_quotation_contact_no+'----'+v_quotation_fax+'-----'+v_quotation_attn+'----'+v_quotation_date+'---'+v_quotation_ref+'-----'+''+v_quotation_subject);
            
                 
                    if($.trim(v_quotation_company_id)=="0"||$.trim(v_quotation_company_id)==" " ||$.trim(v_quotation_company_name)=="Select Company" || $.trim(v_quotation_company_name)==" " ||$.trim(v_quotation_po_box)==""||$.trim(v_quotation_contact_no)==""||$.trim(v_quotation_fax)==""||$.trim(v_quotation_attn)==" "||$.trim(v_quotation_date)==""||$.trim(v_quotation_ref)==""||$.trim(v_quotation_subject)==""||
                    $.trim(v_quotation_all_description)=="" || $.trim(v_project_id) == "0")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_quotation_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/quotation/quotation_controller.php",{action:'edit_quotation',v_quotation_company_name:v_quotation_company_name,v_company_id:v_quotation_company_id,
                         v_quotation_po_box:v_quotation_po_box,v_quotation_contact_no:v_quotation_contact_no,v_quotation_fax:v_quotation_fax,
                         v_quotation_attn:v_quotation_attn,v_quotation_no:v_quotation_no,v_quotation_date:v_quotation_date,v_quotation_ref:v_quotation_ref,
                         v_quotation_subject:v_quotation_subject,v_quotation_no:v_quotation_no,
                         v_quotation_all_description:v_quotation_all_description,v_quotation_child_id:v_quotation_child_id,v_project_name:v_project_name,v_project_id:v_project_id
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_quotation_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_quotation_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_but_quotation_edit.ladda( 'stop' );
                                    
                                     //swal("Success"," quotation added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item Edited to quotation Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_quotation_add' ).show();
                                     $( '#btn_quotation_edit' ).hide();
                                     //$("#txt_quotation_no").val(result);
                                     //$("#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_contact_no,#txt_quotation_fax,#txt_quotation_attn,#txt_quotation_no,#txt_quotation_date,#txt_quotation_quotation_ref,#txt_quotation_lpo_no").prop("readonly",true);
                                     
                                     
                                    load_data_to_grid_quotation_list( v_quotation_no);
                                     clear_text()
                                    
                                }
                            
                        }); 
                     }
            
                    
                    
                });        
                
                  
                 
                $('#btn_quotation_print').click(function(){
                    var quotation_number=$('#txt_quotation_no').val();
                   
                    if($.trim(quotation_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/quotation/quotation_controller.php",{action:'quotation_status',v_quotation_no:quotation_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_quotation_status=obj.data[0].quotation_status;
                       if(v_quotation_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/quotation_print.php?quotation_number="+quotation_number,"_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                    
                });
                
                 $('#btn_quotation_print_without_head').click(function(){
                     
                      var quotation_number=$('#txt_quotation_no').val();
                        if($.trim(quotation_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/quotation/quotation_controller.php",{action:'quotation_status',v_quotation_no:quotation_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_quotation_status=obj.data[0].quotation_status;
                       if(v_quotation_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                         window.open("reports/quotation_print_without_head.php?quotation_number="+quotation_number,"_blank"); 
                       }
                       
                       });
                      
                       
                    }
                      
                 });
                  
                 $('#btn_quotation_print_with_head').click(function(){
                      var quotation_number=$('#txt_quotation_no').val();
                           if($.trim(quotation_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/quotation/quotation_controller.php",{action:'quotation_status',v_quotation_no:quotation_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_quotation_status=obj.data[0].quotation_status;
                       if(v_quotation_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/quotation_print_with_head.php?quotation_number="+quotation_number,"_blank"); 
                       }
                       
                       });
                      
                       
                    }
                     
                 });  
                  
                 $('#btn_view_list_of_quotation').click(function(){
                     
                    //load_data_to_grid_view_quotation_list(); 
                     
                 });     
                  

});