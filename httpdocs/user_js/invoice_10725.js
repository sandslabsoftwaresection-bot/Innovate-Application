$(document).ready(function(){
   let v_previous_bill=0;
   let x=0;
   const userName = $("#header_name").text(); 
   let lastRowsByCompany = {};
	let lbl_vat_percentage=0;
                var v_but_invoice_save = $( '#btn_invoice_add' ).ladda();
                var v_but_invoice_edit = $( '#btn_invoice_edit' ).ladda();
                var v_but_invoice_gen = $( '#btn_generate_invoice' ).ladda();
                var v_but_update_all = $( '#update_all_invoice_list' ).ladda();
                var invoice_list_table = $('#tbl_invoice_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
                var invoice_list_main_table = $('#tbl_invoice_main_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
                var invoice_view_list_table = $('#list_of_invoices').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                var delivery_note_list_table = $('#tbl_delivery_note_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});
				$('#div_company_select').load('templates/company_combo.php');
            	var v_txt_qty_change = '';
				var v_net_total_due;
				var txt_default_net_total;
				var v_txt_net_total_perc = '';
				var v_net_total_perc_due;
				var row_count = 0;
				var cumulative=[];
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
                 $('#btn_invoice_edit').hide();
                 $('#btn_edit_invoice').hide();
                 $('#div_hide').hide();
                 $('#quotation_list_div').hide();
                 $('#delivery_note_tbl_div').hide();
                 
                 
                 
                 function getCurrency(number) {
                        var decimal = Math.round((number - Math.floor(number)) * 1000);
                        var no = Math.floor(number);
                        var digits_length = no.toString().length;
                        var i = 0;
                        var str = [];
                        var words = {
                            0: '', 1: 'one', 2: 'two',
                            3: 'three', 4: 'four', 5: 'five', 6: 'six',
                            7: 'seven', 8: 'eight', 9: 'nine',
                            10: 'ten', 11: 'eleven', 12: 'twelve',
                            13: 'thirteen', 14: 'fourteen', 15: 'fifteen',
                            16: 'sixteen', 17: 'seventeen', 18: 'eighteen',
                            19: 'nineteen', 20: 'twenty', 30: 'thirty',
                            40: 'forty', 50: 'fifty', 60: 'sixty',
                            70: 'seventy', 80: 'eighty', 90: 'ninety', 21: 'zero'
                        };
                        var digits = ['', 'hundred', 'thousand', 'hundred', 'million'];
                    
                        while (i < digits_length) {
                            var divider = (i === 2) ? 10 : 100;
                            var currentDigit = no % divider;
                            no = Math.floor(no / divider);
                            i += (divider === 10) ? 1 : 2;
                    
                            if (currentDigit) {
                                var plural = (str.length && currentDigit > 9) ? '' : '';
                                var hundred = (str.length === 1 && str[0]) ? '  ' : '';
                    
                                if (currentDigit < 21) {
                                    str.push(words[currentDigit] + ' ' + digits[str.length] + plural + ' ' + hundred);
                                } else {
                                    str.push(words[Math.floor(currentDigit / 10) * 10] + ' ' + words[currentDigit % 10] + ' ' + digits[str.length] + plural + ' ' + hundred);
                                }
                            } else {
                                str.push('');
                            }
                        }
                    
                        var rupees = str.reverse().join('');
                    
                        var last = decimal % 100;
                        var x = decimal % 10;
                        var y = last - x;
                    
                        if (y === 0) {
                            y = 21;
                        }
                    
                        if (x === 0) {
                            x = 21;
                        }
                    
                        var paise = (decimal > 0) ? ' ' + (words[Math.floor(decimal / 100)] + '-' + words[y] + '-' + words[x]) + ' ' : '';
                    
                        return (
                            rupees ? rupees + ' ' : ' '
                        ) + decimal + ' / 1000' + '   ' + paise;
                    } 
                // load_company_select_box('div_company_select','select_company');
                //  function load_company_select_box(div_name,ctrl_name)
                //     {
      
                //             $("#"+div_name).load('../controller/quotation/quotation_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});
        
                //     }
                  let editor;
                
                        ClassicEditor
                            .create( document.querySelector( '#txt_invoice_all_description' ) )
                            .then( newEditor => {
                                editor = newEditor;
                            } )
                            .catch( error => {
                                console.error( error );
                            } );
                        
                        
                        
                         let editor1;
                
                        ClassicEditor
                            .create( document.querySelector( '#txt_reissue_desc' ) )
                            .then( newEditor => {
                                editor1 = newEditor;
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
                                        $("#txt_invoice_po_box").val(obj.data[0].contact_address_1);
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
                          
                        }); 
                         
                });
                
                
             $('input:radio').change(function() {
                    //  var project_id=  $('#txt_invoice_project_id').val() ;
                     var project_id=$("#div_project_select_combo option:selected").val();
                     var radionValue=( $("input[name='option']:checked").val());
                     if(radionValue=="1")
                     {
                         console.log(radionValue+"if");
                         $("#delivery_note_tbl_div").hide();
                         $("#quotation_list_div").show();
                         $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                    console.log(result);
                           });  
                          $('#div_hide').hide(); 
                           
                     }
                     
                     if(radionValue=="2")
                     {
                         
                         console.log(radionValue+"else");
                          $("#delivery_note_tbl_div").show();
                            $("#quotation_list_div").hide();
                            
                            
                          $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                    
                            }); 
                            
                            $('#div_hide').show();
                         
                     }
                     
                    });
                
                    function check_pending_invoice()
                    {
                        
                         $.post("../controller/invoice/invoice_controller.php",{action:'check_invoice_status'},function(result,status){
                               var obj= jQuery.parseJSON(result);
                               var v_invoice_count=obj.data[0].invoice_count;
                               var v_invoice_id=obj.data[0].invoice_main_id;
                               var v_invoice_number=obj.data[0].invoice_number;
                               
                               if(v_invoice_count>0)
                                {
                                    
                                     cancel_invoice(v_invoice_number);
                                //             swal({
                                                                
                            				// 			title: "You have an uncompleted invoice request",
                            				// 			text: "Do you want to load again?",
                            				// 			icon: 'warning',
                            				// 			dangerMode: true,
                            				// 			allowOutsideClick: false,
                                //                         closeOnClickOutside: false,
                            				// 			buttons: {
                            				// 			  cancel: 'No Cancel Old Request!',
                            				// 			  delete: 'Yes Please Load'
                            				// 			}
                            				// 			}).then(function (willDelete) {
                            				// 			if (willDelete) {
                            						
                            				// 		      select_invoice(v_invoice_number);
                                         						


                            				// 			} else {
                            							    
                            				// 			  cancel_invoice(v_invoice_number);
                            							 
                            				// 			}
                                //     			});
                                    
                                   
                               }
                        });
                    }
                         
                        
                                             
                    function select_invoice(v_invoice_number)
                    {
                         $.post("../controller/invoice/new_invoice_controller.php",{action:'select_invoice_pending_data',v_invoice_no:v_invoice_number},function(result,status){
                                var obj= jQuery.parseJSON(result); 
                                //alert(obj.data[0].company_name);
                                // $('#div_company_select option').map(function () {
                                   
                                // if ($(this).val() == $.trim(obj.data[0].company_id)) return this;
                                // }).attr('selected', 'selected');
                                $("#select_company").val(obj.data[0].company_id);
                                $("#select_company").trigger("chosen:updated");
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
                               console.log(obj);
                                $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                                   if(status=="success")
                                   {
                                       
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).val() ==$.trim(obj.data[0].project_id)) return this;
                                        }).attr('selected', 'selected');
                                        $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:obj.data[0].project_id},function(result,status){
                                         
                                             if(status=="success")
                                               {
                                                  
                                                   $('#div_select_quotation_combo option').map(function () {
                                                    if ($.trim($(this).text()) ==$.trim(obj.data[0].quotation_reference)) return this;
                                                    }).attr('selected', 'selected');
                                                 
                                               }
                                        });
                                        
                                     
                                   }
                                });
                                
                                 
                                 load_data_to_grid_invoice_list(obj.data[0].invoice_number);
                                console.log(obj.data[0].invoice_against);
                                
                               if(obj.data[0].invoice_against=="2")
                                {
                                   
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
                                    
                                    if(obj.data[0].intern_app_ref==""){
                                        $("#customradio3").prop("checked", true);
                                         $('#div_intern').hide();
                                         $('#div_cust_intrn_no').hide();
                                         $('#div_upload').hide();
                                         
                                        load_data_to_grid_delivery_note_list_for_intern(obj.data[0].invoice_number);
                                    }
                                    else{
                                        $("#customradio4").prop("checked", true);
                                        $('#div_intern').show();
                                         $('#div_cust_intrn_no').show();
                                         $('#div_upload').show();
                                         load_data_to_discount(obj.data[0].intern_app_ref);
                                        $("#div_select_intern_combo").load('../controller/invoice/invoice_controller.php',{action:'select_intern_app_list',v_ctrl_name:'select_intern_app',v_quotation_id:obj.data[0].quotation_reference},function(result,status){
                                            if(status=="success")
                                               {
                                                  
                                                   $('#div_select_intern_combo option').map(function () {
                                                    if ($.trim($(this).text()) ==$.trim(obj.data[0].intern_app_ref)) return this;
                                                    }).attr('selected', 'selected');
                                                 load_data_to_grid_delivery_note_list_for_intern(obj.data[0].invoice_number);
                                               }
                                        });
                                       // load_data_to_grid_delivery_note_list_for_intern(obj.data[0].invoice_number);
                                      //  load_data_to_discount(obj.data[0].intern_app_ref);
                                    }
                                  // load_data_to_grid_delivery_note_list(obj.data[0].invoice_number);   
                                }
                                load_data_from_quatation_database(obj.data[0].quotation_reference);
                       
                                $( '#btn_invoice_add' ).show();
                                $( '#btn_invoice_edit' ).hide();
                                
                                
                                $("#invoice_no_head").html(obj.data[0].invoice_number);
                                 $('#btn_generate_invoice' ).show();
                                 
                                
                             });
                        
                    }
                   
                    function update_invoice(v_invoice_number,v_interim_real_no)
                    {
                        
                        $.post("../controller/invoice/invoice_controller.php",{action:'update_invoice_list',v_invoice_no:v_invoice_number,v_interim_real_no:v_interim_real_no
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                    
                         });
                       
                    }
                    function approve_invoice(v_invoice_number,v_interim_real_no)
                    {
                        
                        $.post("../controller/invoice/invoice_controller.php",{action:'approve_invoice_list',v_invoice_no:v_invoice_number,v_interim_real_no:v_interim_real_no
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                    
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
                      var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                      var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                      var v_invoice_discount_amount=$('#txt_discount_amount_qt').val();            
                                    
                      var v_received_amount_type=$("#div_received_amount_type option:selected").val();
                      var v_retention_amount_type=$("#div_retention_amount_type option:selected").val();
                      var v_discount_amount_type=$("#div_discount_amount_type option:selected").val();
                      
                      
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
                      if(v_invoice_discount_amount==='')
                      {
                          v_invoice_discount_amount=0.00;
                      }
                      
                      if(v_received_amount_type=='%') 
                      {
                          v_received_amount= ((parseFloat(pageTotal1)*parseFloat(v_invoice_received_amount))/100).toFixed(3);  
                      }
                       if(v_retention_amount_type=='%')
                      {
                          v_retention_amount=((parseFloat(pageTotal1)*parseFloat(v_invoice_retention_percentage))/100).toFixed(3);  
                      }
                       if(v_discount_amount_type=='%')
                      {
                          v_discount_amount=((parseFloat(pageTotal1)*parseFloat(v_invoice_discount_amount))/100).toFixed(3);  
                      }
                       if(v_received_amount_type=='BD')
                      {
                           v_received_amount=(parseFloat(v_invoice_received_amount)).toFixed(3);
                          
                      }
                      if(v_retention_amount_type=='BD')
                      {
                           v_retention_amount=(parseFloat(v_invoice_retention_percentage)).toFixed(3);
                      }
                      if(v_discount_amount_type=='BD')
                      {
                           v_discount_amount=(parseFloat(v_invoice_discount_amount)).toFixed(3);
                      }
                        
                           v_previous_bill=(parseFloat(pageTotal1)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount)+parseFloat(v_invoice_previous_bill)+parseFloat(v_discount_amount))).toFixed(3);
                        
                           v_invoice_net_balance_due = parseFloat(v_previous_bill).toFixed(3);
                           $('#txt_invoice_net_balance_due').val(v_invoice_net_balance_due); 
                            
                                            change_balance_in_due(v_invoice_net_balance_due,v_total_discount_amount);  
                            
                                    
                                    }
                           
                           
                          });  
                
                 }
                 
                 
                 function change_balance_in_due(v_invoice_net_balance_due,v_total_discount_amount)
                 {
                      var v_invoice_no=$("#txt_invoice_no").val(); 
                     
                     $.post("../controller/invoice/new_invoice_controller.php",{action:'change_net_balance',v_invoice_no:v_invoice_no,v_balance_in_due:v_invoice_net_balance_due,v_total_discount_amount:v_total_discount_amount
                           } , function(result,status){
                            
                             
                              
                           });
                     
                 }
                  function load_data_to_grid_delivery_note_list(invoice_no)
                 {
                     //alert(quotation_no);
                    delivery_note_list_table.destroy();
                         
                     delivery_note_list_table = $('#tbl_delivery_note_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/new_invoice_controller.php',
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
            			    "ordering":false,
            			    
            			    
                            "columns": [
                                 { "data": null },
                                 { "data": "description", width:"20%"},
                                 { "data": "quantity", className: "text-center"},
								 { "data": "unit", className: "text-center"},
								 { "data": "rate", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
								 { "data": "amount", className: "text-right"},
                                 
            					 { "data": "cumulative_percentage",className: "text-center",render: $.fn.dataTable.render.number(',', '.', 3, ''),
            					    render: function ( data, type, rows, meta ){
                						   //  var sum=parseFloat(rows["purchase_amount_pr"]) + parseFloat(rows["supplied_amount_pr"]);
                					var formattedValue = parseFloat(rows["supplied_amount_pr"]).toFixed(3);
									 if(rows['supplied_amount_pr']==100)
            					        {
            					           // 	var grade_edit ='<div class="input-group mb-3" style="width:100px;padding-top:9px;"> <input disabled type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_cum_upto_this'+rows["quotation_child_id"]+'" name="txt_cum_upto_this" value="'+formattedValue+'" style="width:100px;"><div class="input-group-append"><span class="input-group-text" style="font-size:10px;">%</span></div></div>';
            					                var grade_edit ='<div class="input-group mb-3" style="width:100px;padding-top:9px;"> <input disabled type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_cum_upto_this'+rows["quotation_child_id"]+'" name="txt_cum_upto_this" value=0 style="width:100px;"><div class="input-group-append"><span class="input-group-text" style="font-size:10px;">%</span></div></div>';
            					        
            					            
            					        }
            					        else
            					        {
            					           // 	var grade_edit ='<div class="input-group mb-3" style="width:100px;padding-top:9px;"> <input type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_cum_upto_this'+rows["quotation_child_id"]+'" name="txt_cum_upto_this" value="'+formattedValue+'" style="width:100px;"><div class="input-group-append"><span class="input-group-text" style="font-size:10px;">%</span></div></div>';
								                var grade_edit ='<div class="input-group mb-3" style="width:100px;padding-top:9px;"> <input type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_cum_upto_this'+rows["quotation_child_id"]+'" name="txt_cum_upto_this" value=0 style="width:100px;"><div class="input-group-append"><span class="input-group-text" style="font-size:10px;">%</span></div></div>';
            					        
            					            
            					        }
										return grade_edit;
                
                					},
								},
								
                                 
            					 { "data": "total_sup_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),
									render: function ( data, type, rows, meta ){
									   // if(user_events!='First')
									   // {
									   //     var var_sum=parseFloat(rows["net_amount"]) + parseFloat(rows["total_sup_amount"]);
									   // }
                						  var value1 = parseFloat(rows["total_sup_amount"]).toFixed(3);       
										var grade_edit =' <input type="number" id="txt_disc_total_'+rows["quotation_child_id"]+'" name="txt_disc_amount" value="'+value1+'" style="text-align:right; width:100px;" disabled>';
								      
										return grade_edit;
                
                					},
								 }, 
								 
            					 { "data": "supplied_amount_pr_percentage", className: "text-center"},
								 { "data": "total_sup_amount", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')}, 
								 { "data": "discount_precentage",className: "text-center",render: $.fn.dataTable.render.number(',', '.', 3, ''),
            					    render: function ( data, type, rows, meta ){
                						 var formattedValue = parseFloat(rows["purchase_amount_pr"]).toFixed(3);        
										var grade_edit ='<div class="input-group mb-3" style="width:100px;padding-top:9px;"> <input type="number" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_net_total_perc_'+rows["quotation_child_id"]+'" name="txt_net_total_perc" value="'+formattedValue+'" style="width:100px;" disabled><div class="input-group-append"><span class="input-group-text" style="font-size:10px;">%</span></div></div>';
								      
										return grade_edit;
                
                					},
								     
								 },
								 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),
									render: function ( data, type, rows, meta ){    
                						         
								// 		var grade_edit =' <input type="number" id="txt_net_total_'+rows["quotation_child_id"]+'" name="txt_net_amount" value="'+rows["net_amount"]+'" style="width:100px;" disabled>';
								      var grade_edit =' <input type="number" id="txt_net_total_'+rows["quotation_child_id"]+'" name="txt_net_amount" style="text-align:right; width:100px;" disabled>';
										return grade_edit;
                
                					},
								 },
            					  
								 { "data": "invoice_child_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                                        //   var str_active_status_edit = '<div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item text-info" data-toggle="dropdown"><i class="material-icons">list</i></a><div class="dropdown-menu" style="transform: translate3d(-10px, -35px, 0px);"><button type="button" class="btn btn-sm primary-gradient mr-2 dropdown-item"  id="view_invoice_list" name="view_invoice_list" style="width: 48px;"><i class="material-icons">edit</i></button> <div class="dropdown-divider"></div><button type="button" class="btn btn-sm success-gradient mr-2 dropdown-item"  id="update_invoice_list" name="update_invoice_list" style="width: 48px;" disabled><i class="material-icons">save</i></button> <div class="dropdown-divider"></div><button type="button" class="btn btn-sm btn-danger mr-2 dropdown-item"  id="delete_invoice_list" name="delete_invoice_list" style="width: 48px; background-color: red; color: white;"><i class="material-icons">delete</i></button></div></div></div>';
                                          var str_active_status_edit = '<div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item text-info" data-toggle="dropdown"><i class="material-icons">list</i></a><div class="dropdown-menu" style="transform: translate3d(-10px, -35px, 0px);"><button type="button" class="btn btn-sm primary-gradient mr-2 dropdown-item"  id="view_invoice_list" name="view_invoice_list" style="width: 48px;"><i class="material-icons">edit</i></button> </div></div></div>';
                                         
                                          return str_active_status_edit;
                
                							 },
                							 
                					
    
    					 
    					         },
    					          
             
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
                            // pageTotal1 = api
                            //     .column( 11, { page: 'current'} )
                            //     .data()
                            //     .reduce( function (a, b) {
                            //         return intVal(a) + intVal(b);
                            //     }, 0 );
                            pageTotal1=0;
                           amount_sum = api
                                .column( 5, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
							var cum_amt_sum = api
                                .column( 7, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                            // var cum_amt_sum=0;
							var last_sum = api
							.column(9, { page: 'current' })
							.data()
							.reduce(function (a, b) {
								return intVal(a) + intVal(b);
							}, 0);
                            // Update footer
                            $( api.column(11 ).footer() ).html($.fn.dataTable.render.number(',', '.', 3, '').display( pageTotal1 )
                                
                            );
							$( api.column(5 ).footer() ).html($.fn.dataTable.render.number(',', '.', 3, '').display( amount_sum )
                                 
                            ); 
							$( api.column(7 ).footer() ).html($.fn.dataTable.render.number(',', '.', 3, '').display( cum_amt_sum )
                                
                            );
							$(api.column(9).footer()).html($.fn.dataTable.render.number(',', '.', 3, '').display(last_sum));
							$("#txt_invoice_previous_bill_amount").val(last_sum);
						 lbl_amount_sum=parseFloat(amount_sum).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						 $("#lbl_contract_value").html(lbl_amount_sum); 
						
						 var last_sum_for_table=parseFloat(last_sum).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						 $('#table_previous_bill').html(last_sum_for_table);
						 var gross_value_for_table=parseFloat(cum_amt_sum).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                         $('#table_gross_value').html(gross_value_for_table);
							    
                      var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                      var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                      var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                      var v_invoice_discount_amount=$('#txt_discount_amount_qt').val();            
                                    
                      var v_received_amount_type=$("#div_received_amount_type option:selected").val();
                      var v_retention_amount_type=$("#div_retention_amount_type option:selected").val();
                      var v_discount_amount_type=$("#div_discount_amount_type option:selected").val();
                     var gross_amt_due_pr=parseFloat(pageTotal1);
				// 		 var pageTotal1_for_table=parseFloat(gross_amt_due_pr).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                      var v_final_discount_amt=$('#txt_final_discount_amount_hidden').val(); 
                       if(v_final_discount_amt==''){
                           v_final_discount_amt=0.00;
                       }
                     
                     gross_amt_due_pr = parseFloat(gross_amt_due_pr)-parseFloat(v_final_discount_amt);
                             var pageTotal1_for_table=parseFloat(gross_amt_due_pr).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						 $('#table_gross_amount_due').html(pageTotal1_for_table);
                            $('#hidden_gross').val(pageTotal1);
                     
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
                      if(v_invoice_discount_amount==='')
                      {
                          v_invoice_discount_amount=0.00;
                      }
                      
                      if(v_received_amount_type=='%') 
                      {
                          v_received_amount= ((parseFloat(gross_amt_due_pr)*parseFloat(v_invoice_received_amount))/100).toFixed(3);
                      }
                       if(v_retention_amount_type=='%')
                      {
                          v_retention_amount=((parseFloat(gross_amt_due_pr)*parseFloat(v_invoice_retention_percentage))/100).toFixed(3); 
                      }
                       if(v_discount_amount_type=='%')
                      {
                          v_discount_amount=((parseFloat(gross_amt_due_pr)*parseFloat(v_invoice_discount_amount))/100).toFixed(3);
                      }
                       if(v_received_amount_type=='BD')
                      {
                           v_received_amount=(parseFloat(v_invoice_received_amount)).toFixed(3);
                          
                      }
                      if(v_retention_amount_type=='BD')
                      {
                           v_retention_amount=(parseFloat(v_invoice_retention_percentage)).toFixed(3);
                      }
                      if(v_discount_amount_type=='BD')
                      {
                           v_discount_amount=(parseFloat(v_invoice_discount_amount)).toFixed(3);
                      }
                      
                      
                      
                            var disc_prc_for_table=parseFloat(v_invoice_discount_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            
                            $('#disc_prc').html(disc_prc_for_table);
                            var disc_pr_amt_for_table=parseFloat(v_discount_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            $('#disc_prc_amt').html(disc_pr_amt_for_table);
                            
                           
                          v_previous_bill=(parseFloat(gross_amt_due_pr)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount))).toFixed(3);
                            // v_previous_bill=(parseFloat(gross_amt_due_pr)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount))).toFixed(3);

                           v_invoice_net_balance_due = parseFloat(v_previous_bill).toFixed(3);
                           $('#txt_invoice_net_balance_due').val(v_invoice_net_balance_due);  
                            $('#table_less_retention').html(v_retention_amount); 
							$('#table_less_advance_rec').html(v_received_amount);
							var v_previous_bill_for_table=parseFloat(v_previous_bill).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
							$('#table_net_amount_due').html(v_previous_bill_for_table);
						//alert(v_previous_bill);
						
							var v_final_discount_for_table=parseFloat(v_final_discount_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
							$('#table_discount').html(v_final_discount_for_table);
                            change_balance_in_due(v_invoice_net_balance_due,v_total_discount_amount);  
                             
                            //alert("Percentae : "+lbl_vat_percentage+'--'+v_previous_bill);
							var vat_amount=((parseFloat(v_previous_bill)*parseFloat(lbl_vat_percentage))/100);
							var vat_amt_for_table=parseFloat(vat_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
							$('#table_tax_value').html(vat_amt_for_table);
							var table_total=(parseFloat(v_previous_bill)+parseFloat(vat_amount)).toFixed(3);
							var table_total2=parseFloat(table_total).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
							$('#table_total_amount').html(table_total2);
							var table_currency= getCurrency(table_total);
							//alert(table_currency);
							$('#table_bahrain_dinars').html(table_currency);
							 $('#div_discount select').removeAttr('disabled');
                             $('#txt_invoice_received_amount').removeAttr('disabled');  
                            $('#txt_invoice_retention_percentage').removeAttr('disabled'); 
                        },
                        "initComplete":function( settings, json){
                            console.log(delivery_note_list_table.rows().count());
                            row_count = delivery_note_list_table.rows().count();
                                    
                        }
                        
                        
                        
                        
                         
                     });  
                
                 }
                 var flag =0;
                  function load_data_to_grid_delivery_note_list_for_intern(invoice_no)
                 {
                     //alert(quotation_no);
                    delivery_note_list_table.destroy();
                         
                     delivery_note_list_table = $('#tbl_delivery_note_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/new_invoice_controller.php',
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
            			    "ordering":false,
            			    
            			    
                            "columns": [
                                 { "data": null },
                                 { "data": "description", width:"20%"},
                                 { "data": "quantity", className: "text-center"},
								 { "data": "unit", className: "text-center"},
								 { "data": "rate", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
								 { "data": "amount", className: "text-right"},
                                 
            					 { "data": "cumulative_percentage",className: "text-center",render: $.fn.dataTable.render.number(',', '.', 3, ''),
            					    render: function ( data, type, rows, meta ){
                						   var sum=parseFloat(rows["purchase_amount_pr"]) + parseFloat(rows["supplied_amount_pr"]);
                						   
                						var formattedValue = parseFloat(sum).toFixed(3);
										var grade_edit =' <div class="input-group mb-3" style="width:100px;padding-top:9px;">  <input style="font-size:12px;padding:2px;text-align:center;" type="number" class="discount-input form-control" id="txt_cum_upto_this'+rows["quotation_child_id"]+'" name="txt_cum_upto_this" value="'+formattedValue+'"  disabled><div class="input-group-append"><span class="input-group-text" style="font-size:10px;">%</span></div></div>';
								      if(sum!=100){
								          flag=1;
								      }
								      
										return grade_edit;
                
                					},
								},
								
                                 
            					 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),
									render: function ( data, type, rows, meta ){
									  
									      var v_sum=parseFloat(rows["net_amount"]) + parseFloat(rows["total_sup_amount"]);
									  
                						         
										var grade_edit =' <input type="number" id="txt_disc_total_'+rows["quotation_child_id"]+'" name="txt_disc_amount" value="'+v_sum+'" style="text-align:right; width:100px;" disabled>';
								      
										return grade_edit;
                
                					},
								 }, 
								 
            					 { "data": "supplied_amount_pr_percentage", className: "text-center"},
								 { "data": "total_sup_amount", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')}, 
								 { "data": "discount_precentage",className: "text-center",render: $.fn.dataTable.render.number(',', '.', 3, ''),
            					    render: function ( data, type, rows, meta ){
                						var formattedValue = parseFloat(rows["purchase_amount_pr"]).toFixed(3);        
										var grade_edit =' <div class="input-group mb-3" style="width:100px;padding-top:9px;"> <input type="number" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_net_total_perc_'+rows["quotation_child_id"]+'" name="txt_net_total_perc" value="'+formattedValue+'"  disabled><div class="input-group-append"><span class="input-group-text" style="font-size:10px;">%</span></div></div>';
								      
										return grade_edit;
                
                					},
								     
								 },
								 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),
									render: function ( data, type, rows, meta ){    
                						         
										var grade_edit =' <input type="number" id="txt_net_total_'+rows["quotation_child_id"]+'" name="txt_net_amount" value="'+rows["net_amount"]+'" style="text-align:right; width:100px;" disabled>';
								      
										return grade_edit;
                
                					},
								 },
            					  
								 { "data": "invoice_child_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                                        //   var str_active_status_edit = '<div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item text-info" data-toggle="dropdown"><i class="material-icons">list</i></a><div class="dropdown-menu" style="transform: translate3d(-10px, -35px, 0px);"><button type="button" class="btn btn-sm primary-gradient mr-2 dropdown-item"  id="view_invoice_list" name="view_invoice_list" style="width: 48px;"><i class="material-icons">edit</i></button> <div class="dropdown-divider"></div><button type="button" class="btn btn-sm success-gradient mr-2 dropdown-item"  id="update_invoice_list" name="update_invoice_list" style="width: 48px;" disabled><i class="material-icons">save</i></button> <div class="dropdown-divider"></div><button type="button" class="btn btn-sm btn-danger mr-2 dropdown-item"  id="delete_invoice_list" name="delete_invoice_list" style="width: 48px; background-color: red; color: white;"><i class="material-icons">delete</i></button></div></div></div>';
                                         var str_active_status_edit = '<div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item text-info" data-toggle="dropdown"><i class="material-icons">list</i></a><div class="dropdown-menu" style="transform: translate3d(-10px, -35px, 0px);"><button type="button" class="btn btn-sm primary-gradient mr-2 dropdown-item"  id="view_invoice_list" name="view_invoice_list" style="width: 48px;"><i class="material-icons">edit</i></button> </div></div></div>';
                                         
                                          return str_active_status_edit;
                
                							 },
                							 
                					
    
    					 
    					         },
    					          
             
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
                           amount_sum = api
                                .column( 5, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
				// 			var cum_amt_sum = api
    //                             .column( 7, { page: 'current'} )
    //                             .data()
    //                             .reduce( function (a, b) {
    //                                 return intVal(a) + intVal(b);
    //                             }, 0 );
							var last_sum = api
							.column(9, { page: 'current' })
							.data()
							.reduce(function (a, b) {
								return intVal(a) + intVal(b);
							}, 0);
							var cum_amt_sum = last_sum + pageTotal1;
                            // Update footer
                            $( api.column(11 ).footer() ).html($.fn.dataTable.render.number(',', '.', 3, '').display( pageTotal1 )
                                
                            );
							$( api.column(5 ).footer() ).html($.fn.dataTable.render.number(',', '.', 3, '').display( amount_sum )
                                 
                            ); 
							$( api.column(7 ).footer() ).html($.fn.dataTable.render.number(',', '.', 3, '').display( cum_amt_sum )
                                
                            );
							$(api.column(9).footer()).html($.fn.dataTable.render.number(',', '.', 3, '').display(last_sum));
							$("#txt_invoice_previous_bill_amount").val(last_sum);
						 lbl_amount_sum=parseFloat(amount_sum).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						 $("#lbl_contract_value").html(lbl_amount_sum); 
						
						 var last_sum_for_table=parseFloat(last_sum).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						 $('#table_previous_bill').html(last_sum_for_table);
						 var gross_value_for_table=parseFloat(cum_amt_sum).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                         $('#table_gross_value').html(gross_value_for_table);
							    
                      var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                      var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                      var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                      var v_invoice_discount_amount=$('#txt_discount_amount_qt').val();            
                                    
                      var v_received_amount_type=$("#div_received_amount_type option:selected").val();
                      var v_retention_amount_type=$("#div_retention_amount_type option:selected").val();
                      var v_discount_amount_type=$("#div_discount_amount_type option:selected").val();
                    // var gross_amt_due_pr=parseFloat(pageTotal1)-parseFloat(last_sum);
                    var gross_amt_due_pr=parseFloat(pageTotal1);
					 var v_final_discount_amt=$('#txt_final_discount_amount_hidden').val(); 
                       if(v_final_discount_amt==''){
                           v_final_discount_amt=0.00;
                       }	 
                       gross_amt_due_pr = parseFloat(gross_amt_due_pr)-parseFloat(v_final_discount_amt)
                            var pageTotal1_for_table=parseFloat(gross_amt_due_pr).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						 $('#table_gross_amount_due').html(pageTotal1_for_table);
                            $('#hidden_gross').val(pageTotal1); 
                     
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
                      if(v_invoice_discount_amount==='')
                      {
                          v_invoice_discount_amount=0.00;
                      }
                      
                      if(v_received_amount_type=='%') 
                      {
                          v_received_amount= ((parseFloat(gross_amt_due_pr)*parseFloat(v_invoice_received_amount))/100).toFixed(3);
                      }
                       if(v_retention_amount_type=='%')
                      {
                          v_retention_amount=((parseFloat(gross_amt_due_pr)*parseFloat(v_invoice_retention_percentage))/100).toFixed(3); 
                      }
                       if(v_discount_amount_type=='%')
                      {
                          v_discount_amount=((parseFloat(gross_amt_due_pr)*parseFloat(v_invoice_discount_amount))/100).toFixed(3);
                      }
                       if(v_received_amount_type=='BD')
                      {
                           v_received_amount=(parseFloat(v_invoice_received_amount)).toFixed(3);
                          
                      }
                      if(v_retention_amount_type=='BD')
                      {
                           v_retention_amount=(parseFloat(v_invoice_retention_percentage)).toFixed(3);
                      }
                      if(v_discount_amount_type=='BD')
                      {
                           v_discount_amount=(parseFloat(v_invoice_discount_amount)).toFixed(3);
                      }
                      
                      
                            var disc_prc_for_table=parseFloat(v_invoice_discount_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            
                            $('#disc_prc').html(disc_prc_for_table);
                            var disc_pr_amt_for_table=parseFloat(v_discount_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            $('#disc_prc_amt').html(disc_pr_amt_for_table);
                           
                          v_previous_bill=(parseFloat(gross_amt_due_pr)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount))).toFixed(3);
                            // v_previous_bill=(parseFloat(gross_amt_due_pr)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount))).toFixed(3);

                           v_invoice_net_balance_due = parseFloat(v_previous_bill).toFixed(3);
                           $('#txt_invoice_net_balance_due').val(v_invoice_net_balance_due);  
                            $('#table_less_retention').html(v_retention_amount); 
							$('#table_less_advance_rec').html(v_received_amount);
							var v_final_discount_for_table=parseFloat(v_final_discount_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
							$('#table_discount').html(v_final_discount_for_table);
							var v_previous_bill_for_table=parseFloat(v_previous_bill).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
							$('#table_net_amount_due').html(v_previous_bill_for_table);
						//alert(v_previous_bill);
                            change_balance_in_due(v_invoice_net_balance_due,v_total_discount_amount);  
                             
                            //alert("Percentae : "+lbl_vat_percentage+'--'+v_previous_bill);
							var vat_amount=((parseFloat(v_previous_bill)*parseFloat(lbl_vat_percentage))/100);
							var vat_amt_for_table=parseFloat(vat_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
							$('#table_tax_value').html(vat_amt_for_table);
							var table_total=(parseFloat(v_previous_bill)+parseFloat(vat_amount)).toFixed(3);
							var table_total2=parseFloat(table_total).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
							$('#table_total_amount').html(table_total2);
							var table_currency= getCurrency(table_total);
							//alert(table_currency);
							$('#table_bahrain_dinars').html(table_currency);
                            $('#div_discount select').prop('disabled', true);
                            $('#txt_invoice_received_amount').prop('disabled', true);
                            $('#txt_invoice_retention_percentage').prop('disabled', true);
                        },
                        "initComplete":function( settings, json){
                            console.log(delivery_note_list_table.rows().count());
                            row_count = delivery_note_list_table.rows().count();
                            if(flag==0){
                                 var discountDiv = document.getElementById('discount_div');
						            discountDiv.style.display = 'block';  
                            }      
                                    
                        }
                        
                        
                        
                        
                         
                     });  
                
                 }
                 var total=0;
                
                 
                 
                 
                 
                 
                 
   // Select the project based on the quotaion list is loaded...              
                $("#div_project_select_combo").change(function(){
                    
                    var project_id = ($('option:selected', this).val()); 
                    $('#txt_invoice_project_name').val($('option:selected', this).text()) ;
                    $('#txt_invoice_project_id').val($('option:selected', this).val()) ;
                   
                    var radioValue = $("input[name='option']:checked").val();
                 
                    if(radioValue=='2'){
                           $("#delivery_note_tbl_div").show();
                            $("#quotation_list_div").show();
                           
                           $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                
                            });  
                            
                    }
                    else
                    {
                       $("#delivery_note_tbl_div").hide();
                        $("#quotation_list_div").show();
                        
                        $("#div_select_quotation_combo").load('../controller/invoice/invoice_controller.php',{action:'select_quotation_list_qt',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                                  
                                
                                    
                            });  
                            
                        
                    }
                     
                 })
				 
				 $("input[name='option2']").change(function(){
					 var radioValue3 = $("input[name='option2']:checked").val();
					
					 if(radioValue3==3){
						 $("#div_intern").hide(); 
						 $("#div_cust_intrn_no").hide();
						 $("#div_upload").hide();
					 }
					 else{
						 $("#div_intern").show();
						 $("#div_cust_intrn_no").show();
						 $("#div_upload").show();
					 }
				 })
                 
// Quotation drop down select and insert the data into invoice main tbl and invoice child table
                 
                 
                  $("#div_select_quotation_combo").change(function(){
					  
                      var radioValue2 = $("input[name='option2']:checked").val();
					  
					if(radioValue2==3)
					{
						
                     var quotation_no= $('#div_select_quotation_combo option:selected').text(); 
                     var quotation_no=$("#txt_invoice_quotation_ref").val(quotation_no);
                     var radioValue = $("input[name='option']:checked").val();
                     var quotation_no = $.trim(($('option:selected', this).text())); 
					 
					
                     $.post('../controller/invoice/new_invoice_controller.php',{action:'select_total_discount_amount_for_qt',v_quotation_no : quotation_no},function(result,status){
                         if(status=='success')
                         {
                           
                               var obj= jQuery.parseJSON(result);
                              

                              $("#txt_discount_amount_qt").val(obj.data[0].discount_amount);
							  $('#div_discount_amount_type option').map(function () {
								if ($(this).text() == $.trim(obj.data[0].discount_type)) return this;
								}).attr('selected', 'selected');
							   
                              $("#txt_quotation_total_discount_amount").val(obj.data[0].total_discount_amount);
                               v_total_discount_amount= $("#txt_quotation_total_discount_amount").val();
                               
                              lbl_vat_percentage = parseFloat(obj.data[0].tax_content);
                              var lbl_vat_amount= parseFloat(obj.data[0].tax_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                              var lbl_gross_amt= parseFloat(obj.data[0].gross_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                              var lbl_disc=parseFloat(obj.data[0].discount_amount);
                              var lbl_net_amt_exvat=parseFloat(obj.data[0].sub_total).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                                   //  $("#lbl_contract_value").text(amount_sum);
                              $("#lbl_discount").html(" " +lbl_disc);
                              $("#lbl_net_amount_exvat").html(" " +lbl_net_amt_exvat);
                                $("#lbl_vat_perc").html(" " +lbl_vat_percentage+'%');
                                 $("#lbl_vat_amt").html(" " +lbl_vat_amount); 
                              $("#lbl_gross_amt_bd").html(" " +lbl_gross_amt);
                              $("#lbl_discount_perc").html(" (" +obj.data[0].discount_type+")");
								$("#table_gross_value").html(lbl_gross_amt);
								$("#table_vat_perc").html(lbl_vat_percentage+'%');
                                
                         
                            
                      var v_invoice_no=$("#txt_invoice_no").val();
                          if(v_invoice_no != '')
                          {
                          $.post('../controller/invoice/invoice_controller.php',{action:'delete_quotation_no_child_tbl',v_invoice_no :v_invoice_no},function(result,status){
                              
                            //   if(status=='success') 
                            //   {
                            //   load_data_to_grid_invoice_list(v_invoice_no);
                            //   }
                            }); 
                          }
                   
                     var radionValue=( $("input[name='option']:checked").val());
                     
                     
                     if(radionValue=='2')
                     {
                          $("#delivery_note_tbl_div").show();
                          $("#quotation_list_div").hide();
                          $('#div_hide').show();
                           
                        
                     load_data_to_grid_invoice_main_list(v_invoice_no);     
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
                                        
                                       $.post("../controller/invoice/new_invoice_controller.php",{action:'add_invoice_quotation',v_invoice_company_name:v_invoice_company_name,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,v_quotation_no:v_invoice_quotation_ref,v_invoice_project_name:v_invoice_project_name,v_invoice_project_id:v_invoice_project_id,v_invoice_company_id:v_invoice_company_id,radioValue:radioValue,v_tax_content:v_tax_content,v_total_discount_amount:v_total_discount_amount
                                         
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
                                                   
                                                      $("#delivery_note_tbl_div").hide();
                                                      load_data_to_grid_invoice_list(result);
                                                      load_data_to_grid_delivery_note_list(result); 
                                                    $("#div_first :input").prop("disabled", true);
                                                    $("#div_second :input").prop("disabled", true);
                                                    
                                                }
                                                
                                                 
                                            
                                        });
                          
                     load_data_to_grid_delivery_note_list(v_invoice_no);   
                       
                       
                     }
                     
                     
                     
                 }
             }); 
					  }
					  else{
                          
                    // load intern application ref-----------------------------------
					 var v_quotation_id= ($('option:selected', this).val()); 
					$("#div_select_intern_combo").load('../controller/invoice/invoice_controller.php',{action:'select_intern_app_list',v_ctrl_name:'select_intern_app',v_quotation_id:v_quotation_id},function(result,status){
                                
                            });
					 
				// --------------------------------------------------------
					  }
                  
                 }) 
				 
				 $("#div_select_intern_combo").change(function(){
					 var quotation_no= ($('option:selected','#div_select_quotation_combo' ).val());
					 var intern_number= ($('option:selected','#div_select_intern_combo' ).val());
					// var radioValue = $("input[name='option']:checked").val();
					var v_intern_id= ($('option:selected', this).val());
					$("#txt_invoice_received_amount").val(null);
                     $("#txt_invoice_retention_percentage").val(null);
					//alert(quotation_no);
					 $.post('../controller/invoice/new_invoice_controller.php',{action:'select_total_discount_amount',v_quotation_no : quotation_no,v_intern_number:intern_number},function(result,status){
                         if(status=='success')
                         {
                           
                               var obj= jQuery.parseJSON(result);
                              
                             
                              $("#txt_discount_amount_qt").val(obj.data[0].discount_amount);
                              $('#txt_invoice_lpo_no').val(obj.data[0].LPO_no);
							  $('#div_discount_amount_type option').map(function () {
								if ($(this).text() == $.trim(obj.data[0].discount_type)) return this;
								}).attr('selected', 'selected');
								
                              $("#txt_quotation_total_discount_amount").val(obj.data[0].total_discount_amount);
                               v_total_discount_amount= $("#txt_quotation_total_discount_amount").val();
                               
                                      // alert(amount_sum);.toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                             lbl_vat_percentage = parseFloat(obj.data[0].tax_content);
                              var lbl_vat_amount= parseFloat(obj.data[0].tax_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                              var lbl_gross_amt= parseFloat(obj.data[0].gross_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                              var lbl_disc=parseFloat(obj.data[0].discount_amount);
                              var lbl_net_amt_exvat=parseFloat(obj.data[0].sub_total).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                                   //  $("#lbl_contract_value").text(amount_sum);
                              $("#lbl_discount").html(" " +lbl_disc);
                              $("#lbl_net_amount_exvat").html(" " +lbl_net_amt_exvat);
                                $("#lbl_vat_perc").html(" " +lbl_vat_percentage+'%');
                                 $("#lbl_vat_amt").html(" " +lbl_vat_amount); 
                              $("#lbl_gross_amt_bd").html(" " +lbl_gross_amt);
                              $("#lbl_discount_perc").html(" (" +obj.data[0].discount_type+")");
								$("#table_gross_value").html(lbl_gross_amt);
								$("#table_vat_perc").html(lbl_vat_percentage+'%');
								
                              
                               
                         
                            
                      var v_invoice_no=$("#txt_invoice_no").val();
                          if(v_invoice_no != '')
                          {
                          $.post('../controller/invoice/invoice_controller.php',{action:'delete_quotation_no_child_tbl',v_invoice_no :v_invoice_no},function(result,status){
                              
                            //   if(status=='success') 
                            //   {
                            //   load_data_to_grid_invoice_list(v_invoice_no);
                            //   }
                            }); 
                          } 
                   
                     var radioValue=( $("input[name='option']:checked").val());
                     
                     
                     if(radioValue=='2')
                     {
                          $("#delivery_note_tbl_div").show();
                          $("#quotation_list_div").hide();
                          $('#div_hide').show();
                           
                        
                     load_data_to_grid_invoice_main_list(v_invoice_no);     
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
                                        
                                       $.post("../controller/invoice/new_invoice_controller.php",{action:'add_invoice_intrn_app',v_invoice_company_name:v_invoice_company_name,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,v_quotation_no:v_invoice_quotation_ref,v_invoice_project_name:v_invoice_project_name,v_invoice_project_id:v_invoice_project_id,v_invoice_company_id:v_invoice_company_id,radioValue:radioValue,v_tax_content:v_tax_content,v_total_discount_amount:v_total_discount_amount,v_intern_id:v_intern_id,v_int_quotation_no:quotation_no
                                         
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
                                                   
                                                      $("#delivery_note_tbl_div").hide();
                                                      load_data_to_grid_invoice_list(result);
                                                      load_data_to_grid_delivery_note_list_for_intern(result); 
                                                    $("#div_first :input").prop("disabled", true);
                                                    $("#div_second :input").prop("disabled", true);
                                                    
                                                }
                                                
                                                 
                                            
                                        });
                          
                     load_data_to_grid_delivery_note_list_for_intern(v_invoice_no);   
                     load_data_to_discount(v_intern_id);   
                       
                     }
                     
                     
                     
                 }
             }); 
				 
				 
				 })
				  function load_data_to_discount(intern_no)
                 {
					 $.post('../controller/invoice/new_invoice_controller.php',{action:'select_discounts_for_intern',v_intern_id : intern_no},function(result,status){
                         if(status=='success')
                         {
							 var obj= jQuery.parseJSON(result);
                              
                             
                              $("#txt_discount_amount_qt").val(obj.data[0].discount_amount);
							  
							  $('#div_discount_amount_type option').map(function () {
								if ($(this).text() == $.trim(obj.data[0].discount_type)) return this;
								}).attr('selected', 'selected');
								
							  $("#txt_invoice_received_amount").val(obj.data[0].received_amount);
							  $('#div_received_amount_type option').map(function () {
								if ($(this).text() == $.trim(obj.data[0].received_amount_type)) return this;
								}).attr('selected', 'selected');
							  
							  $("#txt_invoice_retention_percentage").val(obj.data[0].retention_amount_percentage);
							  $('#div_retention_amount_type option').map(function () {
								if ($(this).text() == $.trim(obj.data[0].retention_amount_type)) return this;
								}).attr('selected', 'selected');
							  
							  $("#txt_invoice_previous_bill_amount").val(obj.data[0].previous_bill_amount);
						        
                             
                         }
                 });
				 }
            // Quotation list text box item and amount change          
                     var previousColumnValues;
                     var cum_amt_total;
                     var page_total_arr=[];
                   $('#tbl_delivery_note_list tbody').on('change', 'td input', function() {
					
					if (!previousColumnValues) {
						previousColumnValues=delivery_note_list_table.column(11).data().toArray();
					 for (var i = 0; i < previousColumnValues.length; i++) {
                        var currentValue1=0;
						page_total_arr.push(currentValue1);
					}
						var sumOfArray = page_total_arr.reduce(function (acc, currentValue) {return acc + parseFloat(currentValue);}, 0);
						
					}
					if(!cum_amt_total){
					cum_amt_total=delivery_note_list_table.column(7).data().toArray();
					for (var i = 0; i < cum_amt_total.length; i++) {
					console.log(cum_amt_total[i]);
						var currentValue1=cum_amt_total[i];
						cumulative.push(currentValue1);
					}
					var sumOfCumulative = cumulative.reduce(function (acc, currentValue) {return acc + parseFloat(currentValue);}, 0);
					}
					var $row = $(this).closest('tr');
					//alert($row);
                    var data = delivery_note_list_table.row($row).data();
					
				// let val = delivery_note_list_table.column( 9 ).data().reduce( function (a,b) {
					// return parseFloat(a) + parseFloat(b);
				// } );
				// alert(val);
					
					
					
					v_rate=data.rate;
					v_net_amount=data.net_amount;
					v_amount=data.amount;
					//alert(data.amount);
					v_quantity=data.quantity;
					v_supply_qty = data.supplied_qty;
					v_quotation_child_id = data.quotation_child_id
					v_supplied_pr=data.supplied_amount_pr;
				
					if($(this).attr("name")=='txt_cum_upto_this')
					{
						
						var v_txt_net_total_perc = $('#txt_cum_upto_this'+v_quotation_child_id).val();
					   v_sum=parseFloat(v_txt_net_total_perc);
					   var this_period_pr=parseFloat(v_txt_net_total_perc)-parseFloat(v_supplied_pr);
						
						if(v_sum>100 || parseFloat(v_supplied_pr)>v_sum ){
							swal("Error","Executed Work is Greater!!","error");
								$('#txt_cum_upto_this'+v_quotation_child_id).val(0);
								$('#txt_cum_upto_this'+v_quotation_child_id).css('border-color', 'red');
						}
						else{
						if(v_txt_net_total_perc != '' && v_txt_net_total_perc>0)
						{
							$('.cls_qty_change').prop('disabled', true);
							$('.cls_qty_change').val(0);
							var v_net_total_perc1 = ((parseFloat(v_amount)*parseFloat(v_txt_net_total_perc))/100);
							v_net_total_perc_due = (parseFloat(v_net_total_perc1)).toFixed(3);
						//	$('#txt_net_total_perc_span'+v_quotation_child_id).html(v_sum);
							var v_net_total_perc = ((parseFloat(v_amount)*parseFloat(this_period_pr))/100);
							v_cum_amt=(parseFloat(v_net_total_perc)).toFixed(3);
							$('#txt_disc_total_'+v_quotation_child_id).val(v_net_total_perc_due);
						 
							//alert(v_txt_net_total_perc);
							$('#txt_net_total_perc_'+v_quotation_child_id).val(this_period_pr);
							$('#txt_net_total_'+v_quotation_child_id).val(v_cum_amt);
							$('#txt_cum_upto_this'+v_quotation_child_id).css('border-color', '');
							
						}
						else
						{
							$('#txt_net_total_'+v_quotation_child_id).val(v_net_amount);
						    $('#txt_cum_upto_this'+v_quotation_child_id).val('');
							$('#txt_qty_change_'+v_quotation_child_id).prop('disabled', false);
				// 			$('#txt_cum_upto_this'+v_quotation_child_id).css('border-color', 'red');
						}
						}
					}
					var rowIndex = delivery_note_list_table.row($row).index();
					//console.log(rowIndex);
					var v_net=$('#txt_net_total_'+v_quotation_child_id).val();
					var cum_amt=$('#txt_disc_total_'+v_quotation_child_id).val();
					console.log(cum_amt);
					
					if (rowIndex >= 0 && rowIndex < page_total_arr.length) {
						// Alter the array at the specified index
						page_total_arr[rowIndex] = v_net; 
						cumulative[rowIndex]=cum_amt;
						//console.log('Array after alteration:', previousColumnValues);
					}
					//	pageTotal1=pageTotal1-v_net
						var sumOfArray = page_total_arr.reduce(function (acc, currentValue) {return acc + parseFloat(currentValue);}, 0);
						var sumOfCumulative = cumulative.reduce(function (acc, currentValue) {return acc + parseFloat(currentValue);}, 0);
						console.log('Array:', cumulative);
						delivery_note_list_table.column(11).footer().innerHTML = $.fn.dataTable.render.number(',', '.', 3, '').display(sumOfArray);
						delivery_note_list_table.column(7).footer().innerHTML = $.fn.dataTable.render.number(',', '.', 3, '').display(sumOfCumulative);
						$('#txt_invoice_net_balance_due').val(sumOfArray);
						pageTotal1=sumOfArray;
						//var gross_amt2=$('#lbl_gross_amt_bd').html();
						var disc_pr_table=$('#lbl_discount').html();
						var disc_pr_amt=((parseFloat(sumOfArray)*parseFloat(disc_pr_table))/100);
						var disc_pr_amt_for_table=parseFloat(disc_pr_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                        $('#disc_prc_amt').html(disc_pr_amt_for_table);
						var sumOf_cumulative_for_table=parseFloat(sumOfCumulative).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                        $('#table_gross_value').html(sumOf_cumulative_for_table);
                        
                       var final_discount= $('#txt_final_discount_amount').val();
                       if(final_discount=='')
                      {
                          final_discount=0.00;
                      }
                      sumOfArray=parseFloat(sumOfArray)-parseFloat(final_discount);
						var sumOfArray_for_table=parseFloat(sumOfArray).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						$('#table_gross_amount_due').html(sumOfArray_for_table);
						$('#hidden_gross').val(sumOfArray);
						var lbl_table_disc=$('#lbl_discount').html();
						var v_discount_amount_type=$("#div_discount_amount_type option:selected").val();
						
						var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                      var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                     
                      var v_received_amount_type=$("#div_received_amount_type option:selected").val();
                      var v_retention_amount_type=$("#div_retention_amount_type option:selected").val();
                      
                        if(v_invoice_received_amount==='')
                      {
                          v_invoice_received_amount=0.00;
                      }
                      if(v_invoice_retention_percentage==='')
                      {
                          v_invoice_retention_percentage=0.00;
                      }
                      
                      if(v_received_amount_type=='%') 
                      {
                          v_received_amount= ((parseFloat(sumOfArray)*parseFloat(v_invoice_received_amount))/100).toFixed(3);
                      }
                       if(v_retention_amount_type=='%')
                      {
                          v_retention_amount=((parseFloat(sumOfArray)*parseFloat(v_invoice_retention_percentage))/100).toFixed(3); 
                      }
                     
                       if(v_received_amount_type=='BD')
                      {
                           v_received_amount=(parseFloat(v_invoice_received_amount)).toFixed(3);
                          
                      }
                      if(v_retention_amount_type=='BD')
                      {
                           v_retention_amount=(parseFloat(v_invoice_retention_percentage)).toFixed(3);
                      }
                     
														  if(v_discount_amount_type=='%')
														  {
															 var v_discount_amount=((parseFloat(sumOfArray)*parseFloat(lbl_table_disc))/100).toFixed(3); 
														  }
														  if(v_discount_amount_type=='BD')
														  {
															  var v_discount_amount=parseFloat(lbl_table_disc).toFixed(3);
														  }
										
														  var tbl_vat_amt2=$("#lbl_vat_perc").html();
														  
														  var tbl_final=(parseFloat(sumOfArray)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount)));
													       var v_retention_amount_for_table=parseFloat(v_retention_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });				  
													       $("#table_less_retention").html(v_retention_amount_for_table);
													     
													       var v_received_amount_for_table=parseFloat(v_received_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });				  
													       $("#table_less_advance_rec").html(v_received_amount_for_table);
														  
														  
														  $("#txt_invoice_net_balance_due").val(tbl_final);
										var tbl_final_for_table=parseFloat(tbl_final).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });				  
														  $("#table_net_amount_due").html(tbl_final_for_table);
														  var vat2=((parseFloat(tbl_final)*parseFloat(tbl_vat_amt2))/100).toFixed(3);
											var vat2_for_table=parseFloat(vat2).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });			  
														  $("#table_tax_value").html(vat2_for_table);
														  var table_total2=(parseFloat(tbl_final)+parseFloat(vat2)).toFixed(3);
										var table_total2_for_table=parseFloat(table_total2).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });				  
														  $("#table_total_amount").html(table_total2_for_table);
														  var table_currency= getCurrency(table_total2);
							//alert(table_currency);
							$('#table_bahrain_dinars').html(table_currency);
							
				});   
				
				
				
						
           // Quotation list table save and edit option        
                   
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
                         
                           if($(this).attr("name")=='view_invoice_list')
                         {
                                        
                                          $("#txt_quotation_child_id").val(v_invoice_child_id);
                                          $("#txt_quotation_discount_type").val(v_discount_type);
                                          $("#txt_quotation_quantity").val(v_quantity);
                                          $("#txt_reissue_qty").val(v_quantity);
                                          $("#txt_quotation_rate").val(v_rate);
                                          $("#txt_quotation_discount_precentag").val(v_discount_precentage);
                                          $("#txt_quotation_vat_percentage").val(v_vat_percentage);
                                          const editorData = editor1.setData(v_description);
                                            var v_product_description= editorData;
                       
                                          $("#txt_reissue_desc").val(v_product_description);
                                          $("#req_qty").html(v_quantity);
                                          $('#modal_quantity_change').modal();
                			              $('#modal_quantity_change').modal('show'); 
                                 
                         }
                         
                         
                          if($(this).attr("name")=='delete_invoice_list')
                         {
                              var v_invoice_no=$("#txt_invoice_no").val();
                             $.post("../controller/invoice/invoice_controller.php",{action:'delete_invoice_list_item',v_invoice_no:v_invoice_no,v_invoice_child_id:v_invoice_child_id}, function(result,status){
        			                
        			                 if(status=="success")
        			                 {
        			                     
        			                       $.toast({
                                                        heading: 'Success',
                                                        text: 'Item deleted to invoice successfully..!',
                                                        showHideTransition: 'slide',
                                                        icon: 'success'
                                                    });
                                         row_count = parseInt(row_count)-1;           
        			                     load_data_to_grid_delivery_note_list_for_intern(v_invoice_no);
        			                     load_data_to_grid_invoice_list(v_invoice_no);
        			                 }
        			                 
			                 }); 
			                 
			                 
			                 
                             
                         }
						 
						 if($(this).attr("name")=='update_invoice_list')
						 {
						
						 v_txt_qty_change = $('#txt_qty_change_'+v_quotation_child_id).val();
					   	v_txt_net_total_perc = $('#txt_net_total_perc_'+v_quotation_child_id).val();
							
							if(v_txt_qty_change == 0 && v_txt_net_total_perc !=0)
							{
        						
        							var v_net_total_perc = ((parseFloat(v_net_amount)*parseFloat(v_txt_net_total_perc))/100);
        							
        							v_net_total_perc_due=parseFloat(v_net_total_perc);
        							v_net_total_perc_due = (parseFloat(v_net_total_perc)).toFixed(3);
        							 $.post("../controller/invoice/invoice_controller.php",{action:'update_invoice_list_item',v_net_total_due:v_net_total_perc_due,v_net_total_perc_due:v_txt_net_total_perc,v_quotation_child_id:v_quotation_child_id,v_invoice_child_id:v_invoice_child_id}, function(result,status){
                			                
                			                                $.toast({
                                                                heading: 'Success',
                                                                text: 'Item updated to invoice successfully..!',
                                                                showHideTransition: 'slide',
                                                                icon: 'success'
                                                            });
        										
            						     row_count = parseInt(row_count)-1;
            		                     //load_data_to_grid_delivery_note_list(v_invoice_no);
            		                     //load_data_to_grid_invoice_list(v_invoice_no);
                			                     
        			                 }); 
							}
							else if(v_txt_qty_change != 0 && v_txt_net_total_perc == 0)
							{
							   
							    var v_invoice_no=$("#txt_invoice_no").val();
							    var v_net_total_due = parseFloat(v_rate) * parseFloat(v_txt_qty_change);
								//alert(v_net_total_due+"-"+v_txt_qty_change+"-"+v_net_total_perc_due);
								$.post("../controller/invoice/invoice_controller.php",{action:'update_qty_net_invoice_list_item',v_net_total_due:v_net_total_due,v_txt_qty_change:v_txt_qty_change,v_quotation_child_id:v_quotation_child_id,v_invoice_child_id:v_invoice_child_id}, function(result,status){
        			                
        			                       $.toast({
                                                        heading: 'Success',
                                                        text: 'Item updated to invoice successfully..!',
                                                        showHideTransition: 'slide',
                                                        icon: 'success'
                                                    });
                                                    
								       row_count = parseInt(row_count) - 1;
								      // alert(row_count);
        			                   //load_data_to_grid_delivery_note_list(v_invoice_no);
        			                   //load_data_to_grid_invoice_list(v_invoice_no);
        			                   $('#txt_qty_change_'+v_quotation_child_id).css('border-color', '');
        			                     
			                 }); 
							}
							
							var sum = 0;
                            var columnIndex = 9; // Index of the column you want to sum (0-based)
                    
                            delivery_note_list_table.rows().every(function() {
                                var data = this.data();
                                sum += parseInt(data[columnIndex]);
                            });
                    
                           // alert('Sum of column ' + columnIndex + ': ' + sum);
                            
						 }
                         
                     
                         
                 });  
				 
				 
		//update all invoice list using single button
		var save_temp=0;
				 $('#update_all_invoice_list').on('click', function (){
				    //  save_temp=0;
				     //alert("update");
				     v_but_update_all.ladda('start');
					 var array_table_data = delivery_note_list_table.rows().data().toArray();
					 //alert(array_table_data[0]['discount_precentage']);
					 for (var i = 0; i < array_table_data.length; i++) {
							 
							var updatedDiscountPercentage = $('input[name="txt_cum_upto_this"]', delivery_note_list_table.row(i).node()).val();
							var updated_thisprd_pr = $('input[name="txt_net_total_perc"]', delivery_note_list_table.row(i).node()).val();
				// 			if(updatedDiscountPercentage==0 || updatedDiscountPercentage==0.00 ||updated_thisprd_pr=="" || updated_thisprd_pr==0)
				// 			{
							    var inputFieldId = $('input[name="txt_cum_upto_this"]', delivery_note_list_table.row(i).node()).attr('id');
						
							 //   $('#' + inputFieldId).css('border-color', 'red');
							 //   save_temp=1;
							    //$('#txt_net_total_perc_'+delivery_note_list_table.row(i).node()).style.backgroundColor = 'red';
							   
							   if(parseFloat(updatedDiscountPercentage)==100)
							   {
							       save_temp=save_temp+1;
							   }
				// 			}
							var updatedQantityChange = $('input[name="txt_qty_change"]', delivery_note_list_table.row(i).node()).val();
							
							var updatedNetAmount = $('input[name="txt_net_amount"]', delivery_note_list_table.row(i).node()).val();
							array_table_data[i]['discount_precentage'] = updated_thisprd_pr;
							array_table_data[i]['net_amount'] = updatedNetAmount;
							array_table_data[i]['qty_change'] = updatedQantityChange;
						}
						console.log(array_table_data.length);
						console.log(save_temp);
						if(array_table_data.length==save_temp)
						{
						    var discountDiv = document.getElementById('discount_div');
						    discountDiv.style.display = 'block';
						    
						}
						else
						{
						    $('#txt_final_discount_amount').val(0.000);
						    var discountDiv = document.getElementById('discount_div');
						    discountDiv.style.display = 'none';
						    
						   
						}
						//alert(array_table_data[0]['net_amount']);
					
				// 	 if(array_table_data[0]['qty_change'] == 0 && array_table_data[0]['discount_precentage'] !=0)
			
							if(pageTotal1!=0)
							{
								$.post("../controller/invoice/invoice_controller.php",{action:'update_all_invc_prc',v_array_table_data:array_table_data}, function(result,status){
        			                
        			                       $.toast({ 
                                                        heading: 'Success',
                                                        text: 'Item updated to invoice successfully..!',
                                                        showHideTransition: 'slide',
                                                        icon: 'success'
                                                    });
													row_count=0;
													save_temp=0;
													v_but_update_all.ladda('stop');
													 $("#update_all_invoice_list").prop('disabled',true); 
							});
							}else{
							   v_but_update_all.ladda('stop');
							    swal("Error","Net Amount is zero...!","error");
							}
							
				  
				// 			if(array_table_data[0]['qty_change'] != 0 && array_table_data[0]['discount_precentage'] ==0)
				// 			{
				// 				$.post("../controller/invoice/invoice_controller.php",{action:'update_all_invc_qty',v_array_table_data:array_table_data}, function(result,status){
        			                
    //     			                       $.toast({ 
    //                                                     heading: 'Success',
    //                                                     text: 'Item updated to invoice successfully..!',
    //                                                     showHideTransition: 'slide',
    //                                                     icon: 'success'
    //                                                 });
				// 									row_count=0;
				// 			});
				// 			}
							
				 });
				 
				 
                 
           // Calculations
            var v_received_amount = 0;
            var v_retention_amount = 0;   
            // var table_gross_amt_due=0;
             $("#txt_invoice_received_amount,#txt_invoice_retention_percentage,#txt_invoice_previous_bill_amount,#txt_discount_amount_qt,#div_received_amount_type,#div_retention_amount_type,#div_discount_amount_type,#txt_final_discount_amount").change(function(){
                   
                      
                  
                      var v_invoice_received_amount=$('#txt_invoice_received_amount').val();
                      var v_invoice_retention_percentage=$('#txt_invoice_retention_percentage').val();
                      var v_invoice_previous_bill=$('#txt_invoice_previous_bill_amount').val();
                      var v_invoice_discount_amount=$('#txt_discount_amount_qt').val();
                      
                      var v_received_amount_type=$("#div_received_amount_type option:selected").val();
                      var v_retention_amount_type=$("#div_retention_amount_type option:selected").val();
                      var v_discount_amount_type=$("#div_discount_amount_type option:selected").val();
                      
                      var final_discount_amt=$('#txt_final_discount_amount').val();
                        
                       if(final_discount_amt==''){
                           final_discount_amt=0.00;
                       }
                    //  var table_gross_amt_due=$("#table_gross_amount_due").html();
                    
                    var table_gross_amt_due=$("#hidden_gross").val();
                     table_gross_amt_due=Number(table_gross_amt_due.replace(/,/g, ''));
                     table_gross_amt_due = parseFloat(table_gross_amt_due)-parseFloat(final_discount_amt);
                     var table_gross_amt_due_for_table=parseFloat(table_gross_amt_due).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                     $("#table_gross_amount_due").html(table_gross_amt_due_for_table);
                    //   $("#hidden_gross").val(table_gross_amt_due_for_table);
                      
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
                      if(v_invoice_discount_amount==='')
                      {
                          v_invoice_discount_amount=0.00;
                      }
                      
                      if(v_received_amount_type=='%') 
                      {
                          v_received_amount= ((parseFloat(table_gross_amt_due)*parseFloat(v_invoice_received_amount))/100).toFixed(3);
                      }
                       if(v_retention_amount_type=='%')
                      {
                          v_retention_amount=((parseFloat(table_gross_amt_due)*parseFloat(v_invoice_retention_percentage))/100).toFixed(3);  
                      }
                       if(v_discount_amount_type=='%')
                      {
                          v_discount_amount=((parseFloat(table_gross_amt_due)*parseFloat(v_invoice_discount_amount))/100).toFixed(3);  
                      }
                       if(v_received_amount_type=='BD')
                      {
                           v_received_amount=(parseFloat(v_invoice_received_amount)).toFixed(3);
                          
                      }
                      if(v_retention_amount_type=='BD')
                      {
                           v_retention_amount=(parseFloat(v_invoice_retention_percentage)).toFixed(3);
                      }
                      if(v_discount_amount_type=='BD')
                      {
                           v_discount_amount=(parseFloat(v_invoice_discount_amount)).toFixed(3);
                      }
                        
                         v_previous_bill=(parseFloat(table_gross_amt_due)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount))).toFixed(3);
                         //v_previous_bill=(parseFloat(pageTotal1)-(parseFloat(v_received_amount)+parseFloat(v_retention_amount))).toFixed(3);

                           v_invoice_net_balance_due = parseFloat(v_previous_bill).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                           $('#txt_invoice_net_balance_due').val(v_invoice_net_balance_due);
                           var v_received_amount_for_table=parseFloat(v_received_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						   $('#table_less_advance_rec').html(v_received_amount_for_table);
						   var v_retention_amount_for_table=parseFloat(v_retention_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						   $('#table_less_retention').html(v_retention_amount_for_table);
						  var final_discount_table=parseFloat(final_discount_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
						   $('#table_discount').html(final_discount_table);
						  
						   var v_previous_bill_for_table=parseFloat(v_previous_bill).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                      $('#table_net_amount_due').html(v_previous_bill_for_table);
					 var vat_percentage=$('#lbl_vat_perc').html();
                     var vat_amount=((parseFloat(v_previous_bill)*parseFloat(vat_percentage))/100).toFixed(3);
                     var vat_amount_for_table=parseFloat(vat_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
					 $('#table_tax_value').html(vat_amount_for_table);
					 var table_total=(parseFloat(v_previous_bill)+parseFloat(vat_amount)).toFixed(3);
					 var table_total_for_table=parseFloat(table_total).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
					$('#table_total_amount').html(table_total_for_table);
					var table_currency= getCurrency(table_total);
							
					$('#table_bahrain_dinars').html(table_currency);
                   
                      
    
                   
               })
               
               $('#btn_generate_invoice').click(function(){
                      
                      v_but_invoice_gen.ladda( 'start' );
                      $("#update_all_invoice_list").hide(); 
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
                        var v_discount_type =  $("#div_discount_amount_type option:selected").val();
                        var v_discount_amount = $('#txt_discount_amount_qt').val();
                        var v_total_discount_amount= $("#txt_quotation_total_discount_amount").val();
                        
                        var v_received_amount_type=$("#div_received_amount_type option:selected").val();
                        var v_retention_amount_type=$("#div_retention_amount_type option:selected").val();
						var intern_app_no= ($('option:selected','#div_select_intern_combo' ).val());
						var quotation_no= ($('option:selected','#div_select_quotation_combo' ).val());
						var v_custom_int_no=$("#txt_cust_intern_no").val();
						var final_discount_amount=$("#txt_final_discount_amount").val();
		//file upload***************************						
						randomNum = Math.ceil(Math.random() * 999999);
						var doc_file_obj = $("#cust_file")[0].files[0];
						if (doc_file_obj) 
                             {
                                 var fileName = doc_file_obj.name;
    
                                     var upload = new ns.Upload(doc_file_obj);
                                     var v_file_name=(randomNum+'_'+fileName);
                                     var successs = upload.doUpload("../httpdocs/customer_intern_file/upload.php?random_no="+randomNum,v_file_name);
									 
                                     //$('#txt_applicant_doc_name').val(v_file_name);
                                    // v_file_name = $('#txt_applicant_doc_name').val();
                                     // if(v_file_name=="")
                                     // {
                                          // $.toast({
                                            // heading: 'Error!',
                                            // text: 'Some Error occured, Please reload the page.',
                                            // showHideTransition: 'slide',
                                            // icon: 'error'
                                        // }); 
                                     // }
                                     // else
                                     // {
                                        // jobData.file_name = v_file_name;
                                        // $.post('controller/job_application_controller.php',
                                        // {action:"add_job_application", v_jobData:jobData},
                                        // function(result){
                                           // if(result>=1)
                                           // {
                                                // $.toast({
                                                    // heading: 'Application Done!',
                                                    // text: 'Your Job Application is submitted',
                                                    // showHideTransition: 'slide',
                                                    // icon: 'success'
                                                // }); 
                                                // $('#frm_job_register').trigger("reset");
                                           // }
                                           // else
                                           // {
                                                // $.toast({
                                                    // heading: 'Failed!',
                                                    // text: 'Please try again...',
                                                    // showHideTransition: 'slide',
                                                    // icon: 'error'
                                                // }); 
                                           // }
                                        // });
                                    // }
                                
                             }
                        
                        
        //******************************************                      
                    var v_invoice_sub_total=pageTotal1;
                    
                    if( row_count != '0')
                    {
                        //alert(row_count);
                       swal("Warning"," Please save the purchase quantity  ", "warning");
                       return false;
                        v_but_invoice_gen.ladda( 'stop' );
                    }
                    
                    if($.trim(v_invoice_received_amount)==""||$.trim(v_invoice_balance_due)==""||$.trim(v_invoice_all_description)=="")
                     {
                        swal("Warning"," Please Fill All The Fields ", "warning");
                        return false;
                         v_but_invoice_gen.ladda( 'stop' );
                        
                     } 
                     else
                     {
                       $.post("../controller/invoice/new_invoice_controller.php",{action:'generate_invoice',v_invoice_company_name:v_invoice_company_name,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,v_quotation_no:v_invoice_quotation_ref,v_project_name:v_project_name,v_project_id:v_project_id,v_invoice_company_id:v_invoice_company_id,v_invoice_no:v_invoice_no,v_invoice_vat:v_invoice_vat,v_invoice_total_amount:v_invoice_total_amount,v_invoice_received_amount:v_invoice_received_amount,v_invoice_balance_due:v_invoice_balance_due,v_invoice_all_description:v_invoice_all_description,v_invoice_sub_total:v_invoice_sub_total,v_invoice_retention_amount:v_invoice_retention_amount,v_invoice_previous_bill_amount:v_invoice_previous_bill_amount,v_discount_type:v_discount_type,v_discount_amount:v_discount_amount,v_total_discount_amount:v_total_discount_amount,v_received_amount_type:v_received_amount_type,v_retention_amount_type:v_retention_amount_type,v_custom_int_no:v_custom_int_no,v_file_name:v_file_name,v_intern_app_no:intern_app_no,v_int_quotation_no:quotation_no,final_discount_amount:final_discount_amount
                                }
                               
                                , function(result,status)
                                {
									var obj= jQuery.parseJSON(result);
                                  if(obj.msg=="success")
                                  {
                                    swal("Success"," Invoice generated successfully", "success"); 
                                    $('#btn_generate_invoice').hide();
                                    $('#btn_edit_invoice').show();
									$('#txt_real_invoice_no').val(obj.msg1);
                                   // clear_all_after_generate_invoice();
                                    $("#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_contact_no,#txt_invoice_fax,#txt_invoice_attn,#txt_invoice_no,#txt_invoice_date,#txt_invoice_quotation_ref,#txt_invoice_lpo_no").prop("readonly",false);
                                      v_but_invoice_gen.ladda( 'stop' );
                                  }
                                  else
                                  {
                                    swal("Error"," Some Error Occures..", "error"); 
                                    //clear_all_after_generate_invoice(); 
                                    v_but_invoice_gen.ladda( 'stop' );
                                  }
                          });
                     }
                  });
                  
				  
	//genrete intern payment application Invoice----------------------------------
				 $('#btn_intern_payment_application').click(function(){
                      
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
                        var v_discount_type =  $("#div_discount_amount_type option:selected").val();
                        var v_discount_amount = $('#txt_discount_amount_qt').val();
                        var v_total_discount_amount= $("#txt_quotation_total_discount_amount").val();
                        
                        var v_received_amount_type=$("#div_received_amount_type option:selected").val();
                        var v_retention_amount_type=$("#div_retention_amount_type option:selected").val();
                      
                        
                        
                              
                    var v_invoice_sub_total=pageTotal1;
                    
                    if( row_count != '0')
                    {
                        //alert(row_count);
                       swal("Warning"," Please save the purchase quantity  ", "warning");
                       return false;
                    }
                    
                    if($.trim(v_invoice_received_amount)==""||$.trim(v_invoice_balance_due)==""||$.trim(v_invoice_all_description)=="")
                     {
                        swal("Warning"," Please Fill All The Fields ", "warning");
                        return false;
                        
                     }
                     else
                     {
                       $.post("../controller/invoice/new_invoice_controller.php",{action:'generate_intern_payment_application',v_invoice_company_name:v_invoice_company_name,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,v_quotation_no:v_invoice_quotation_ref,v_project_name:v_project_name,v_project_id:v_project_id,v_invoice_company_id:v_invoice_company_id,v_invoice_no:v_invoice_no,v_invoice_vat:v_invoice_vat,v_invoice_total_amount:v_invoice_total_amount,v_invoice_received_amount:v_invoice_received_amount,v_invoice_balance_due:v_invoice_balance_due,v_invoice_all_description:v_invoice_all_description,v_invoice_sub_total:v_invoice_sub_total,v_invoice_retention_amount:v_invoice_retention_amount,v_invoice_previous_bill_amount:v_invoice_previous_bill_amount,v_discount_type:v_discount_type,v_discount_amount:v_discount_amount,v_total_discount_amount:v_total_discount_amount,v_received_amount_type:v_received_amount_type,v_retention_amount_type:v_retention_amount_type
                                }
                               
                                , function(result,status)
                                {
                                  if(result=="success")
                                  {
                                    swal("Success"," Invoice generated successfully", "success"); 
                                    // $('#btn_generate_invoice').hide();
                                    // $('#btn_edit_invoice').show();
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
                   $('#txt_invoice_vat,#txt_invoice_total_amount,#txt_invoice_received_amount,#txt_invoice_balance_due,#txt_invoice_no,#txt_invoice_all_description,#txt_invoice_company_name,#txt_invoice_po_box,#txt_invoice_contact_no,#txt_invoice_fax,#txt_invoice_attn,#txt_invoice_quotation_ref,#txt_invoice_lpo_no,#txt_final_discount_amount').val('');  
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
                                 'url': '../controller/invoice/new_invoice_controller.php',
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
            			   
                            "columns": [
                              
                                 { "data": "invoice_main_id","visible":false },
                                 { "data": "invoice_date"},
                                 { "data": "invoice_real_no"},
                                 { "data": "company_name", visible:false},
                                 { "data": "quotation_total_amount"},
                                 { "data": "sub_total"},
                                 { "data": "invoice_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_invoice" name="view_invoice" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
    					         },
    					         { "data": "invoice_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                                           
                                             if(rows['is_latest_invoice'] === '1') 
                                             {
                                                
                                              if(userName ==='Administrator')
                                              {
                                                  console.log(rows['update_status']);
                                                  if(rows['update_status']=='NO')
                    						        {
                    									str_active_status_view_1 = ' <button type="button" class="btn btn-sm btn-info mr-2" onclick="openNavR()" id="update_invoice" name="update_invoice" style="color:green"><i class="material-icons " style="Color:white;">lock_outline</i></button>';
                    						        }
                    						      else
                    						        {
                    						            str_active_status_view_1 = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="update_invoice" name="update_invoice" ><i class="material-icons " style="Color:white;">lock_open</i></button>';
                    						         
                    						        }
                                              }
                                             
                                              else
                                              {
                                                  str_active_status_view_1 = ''; 
                                              }
                                             
                                             }
                                             else
                                             {
                                                 str_active_status_view_1 = '';
                    						        ; 
                                             }
                                              
                                              	return str_active_status_view_1;
                                            }
                                           
                							
                
                						},
    					               { "data": "invoice_main_id" ,
                                          render: function ( data, type, rows, meta ) {
                						            if(rows['approved_status']=='YES')
                						            {
                						             str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_approved" name="view_approved" ><i class="material-icons ">check</i></button>';
                								    }
                								    else
                								    {
                								      str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_approved" name="view_approved" ><i class="material-icons ">clear</i></button>';
                								    }
                									
                								return str_active_status_view;
                
                							 },
    					               },
                                 
             
                             ],
                             pageLength: 25,
            				 searching: true,
                             responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                                                      
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             },
							 "drawCallback": function ( settings ) {
								var api = this.api();
								var rows = api.rows( {page:'current'} ).nodes();
								var last=null;
					            let lastCompany = null;
                                lastRowsByCompany = {};
                              
								api.column(3, {page:'current'} ).data().each( function ( group, i ) {
									if ( last !== group ) {
										$(rows).eq( i ).before(
											'<tr class="group" style="background-color:#D2B4DE;"><td colspan="7">'+group+'</td></tr>'
										);
					 
										last = group;
									}
								} );
							}
                        
                         
                     });  
                
                 }
				   function load_data_to_grid_view_invoice_list_between(v_invoice_from_date,v_invoice_to_date)
                 {
                      invoice_view_list_table.destroy();
                         
                     invoice_view_list_table = $('#list_of_invoices').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/new_invoice_controller.php',
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
            				
                            "columns": [
                              
                                 { "data": "invoice_main_id","visible":false },
                                 { "data": "invoice_date"},
                                 { "data": "invoice_real_no"},
                                 { "data": "company_name", visible:false},
                                 { "data": "quotation_total_amount"},
                                 { "data": "sub_total"},
                                 { "data": "invoice_main_id",
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_invoice" name="view_invoice" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         },
    					       //  { "data": "invoice_main_id",
    					 
                         
                //                           render: function ( data, type, rows, meta ) {
                						
                // 									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_invoice" name="delete_invoice" ><i class="material-icons ">delete</i></button>';
                								
                // 								return str_active_status_view;
                
                // 							 },
                						
    					       //  },
             
                             ],
                             pageLength: 25,
            				 searching: true,
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
                        console.log(data +'---'+data.LPO_no);
                        v_invoice_number  = data.invoice_number;
                        v_interim_real_no = data.intern_app_ref;
                        alert(v_interim_real_no);
                        $('#txt_invoice_description').val('');
                        $('#txt_invoice_quantity').val('');
                        $('#txt_invoice_unit').val('');
                        $('#txt_invoice_rate').val('');
                        $('#txt_invoice_amount').val('');
                        $( '#btn_invoice_add' ).show();
                        $( '#btn_invoice_edit' ).hide();
                        
                         if($(this).attr("name")=='view_invoice')
                         {
                            $("#update_all_invoice_list").hide(); 
                           flag=0;
							 
							     $("#div_select_intern_combo").load('../controller/invoice/invoice_controller.php',{action:'select_intern_list',v_ctrl_name:'select_intern_app',v_quotation_id:data.quotation_reference},function(result,status){
										 $('#div_select_intern_combo option').map(function () {
                                        if ($(this).text() == $.trim(data.intern_app_ref)) return this;
                                        }).attr('selected', 'selected');
                                
                            });
							  
                    
                        // $('#div_company_select option').map(function () {
                        // if ($(this).text() == $.trim(data.company_name)) return this;
                        // }).attr('selected', 'selected');
						$("#select_company").val(data.company_id);
                        $("#select_company").trigger("chosen:updated");
                        //$("#txt_invoice_company_name").val(data.company_name);
                        $("#txt_invoice_po_box").val(data.po_box);
                        $("#txt_invoice_contact_no").val(data.telephone_no);
                        $("#txt_invoice_fax").val(data.fax);
                        $("#txt_invoice_attn").val(data.attn);
                        $("#txt_real_invoice_no").val(data.invoice_real_no);
                        $("#txt_invoice_no").val(data.invoice_number);
                        $('#txt_invoice_discount_amount').val(data.total_discount_amount);
                       // $('#txt_hidden_discount_type').val(data.discount_type);
                        $('#txt_hidden_discount_amount').val(data.discount_amount);
                        $('#txt_discount_amount_qt').val(data.discount_amount);
                         $('#txt_final_discount_amount').val(data.final_discount);
                         $('#txt_final_discount_amount_hidden').val(data.final_discount);
                         if(data.final_discount!=0.000)
                         {
                             var discountDiv = document.getElementById('discount_div');
                             discountDiv.style.display = 'block';
                         }
                         else
                         {
                             var discountDiv = document.getElementById('discount_div');
                             discountDiv.style.display = 'none';
                         }
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
							 if(data.intern_app_ref!=""){
									$("#customradio4").prop("checked", true);
									
									 $('#txt_cust_intern_no').val(data.customer_intern_no);
									 $('#div_intern').show();
									$('#div_cust_intrn_no').show();
								   $('#div_upload').show();
							
                           
								   }
								   else{
									   $("#customradio3").prop("checked", true);
									   $('#div_intern').hide();
									   $('#div_cust_intrn_no').hide();
									   $('#div_upload').hide();
										
								   }
                           load_data_to_grid_delivery_note_list_for_intern(data.invoice_number);
                           
                        }
                        //console.log("intern"+data.intern_app_ref);
                      
                       
                      
                        $('#txt_invoice_vat').val(data.vat);
                        $('#txt_invoice_total_amount').val(data.total_amount);
                        $('#txt_invoice_received_amount').val(data.received_amount);
                        
                        $('#txt_invoice_net_balance_due').val(data.balane_in_due);
                        $('#txt_invoice_previous_bill_amount').val(data.previous_bill_amount);
                        $('#txt_invoice_retention_percentage').val(data.retention_amount_percentage);
                        
						
						
                         $('#div_received_amount_type option').map(function () {
							$(this).removeAttr('selected'); 
                        if ($(this).text() == $.trim(data.received_amount_type)) return this;
                        }).attr('selected', 'selected');
                        
						
                        $('#div_retention_amount_type option').map(function () {
							$(this).removeAttr('selected');
                        if ($(this).text() == $.trim(data.retention_amount_type)) return this;
                        }).attr('selected', 'selected');
                        
						
                        $('#div_discount_amount_type option').map(function () {
							$(this).removeAttr('selected');
                        if ($(this).text() == $.trim(data.discount_type)) return this;
                        }).attr('selected', 'selected');
                        
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
                                     //alert("inside if"+data.quotation_reference);
                                       $('#div_select_quotation_combo option').map(function () {
                                        if ($(this).text() == $.trim(data.quotation_reference)) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
								   
									   
								   
                         }); 
                          // $("#div_select_intern_combo").load('../controller/invoice/invoice_controller.php',{action:'select_intern_app_list',v_ctrl_name:'select_intern_app',v_quotation_id:data.quotation_reference},function(result,status){
                                
                            // });
                            //**********************************
                            load_data_from_quatation_database(data.quotation_reference);
                           
                            //*********************************************
                         $('#btn_generate_invoice' ).hide();
                         $('#btn_edit_invoice').show();
                         
                        
                        closeNavR();
                        
                         }
                         
                         
                         if($(this).attr("name")=='update_invoice')
                         {
                             
                              swal({
                                                                    
                							title: "Are you sure?",
                							text: "Do you want to update this invoice?",
                							icon: 'warning',
                							dangerMode: true,
                							allowOutsideClick: false,
                                            closeOnClickOutside: false,
                							buttons: {
                							cancel: 'No Cancel !',
                							 delete: 'Yes Please Update'
                							}
                							}).then(function (willDelete) {
                							if (willDelete) {
                						
                						       update_invoice(v_invoice_number,v_interim_real_no);
                             				   load_data_to_grid_view_invoice_list()		 
                							} else {
                						
                							}
                						 });
                    
                         }
                         if($(this).attr("name")=='view_approved')
                         {
                             swal({
                                                                    
                							title: "Are you sure?",
                							text: "Do you want to approve this invoice?",
                							icon: 'warning',
                							dangerMode: true,
                							allowOutsideClick: false,
                                            closeOnClickOutside: false,
                							buttons: {
                							cancel: 'No Cancel !',
                							 delete: 'Yes Please Approve'
                							}
                							}).then(function (willDelete) {
                							if (willDelete) {
                						
                						       approve_invoice(v_invoice_number,v_interim_real_no);
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
                  
                 
              
                 function load_data_to_grid_view_cancel_invoice_list()
                 {
                     invoice_view_list_table.destroy();
                         
                     invoice_view_list_table = $('#list_of_cancel_invoices').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/invoice/new_invoice_controller.php',
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
                                 { "data": "invoice_date"},
                                 { "data": "invoice_real_no"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
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
                                 'url': '../controller/invoice/new_invoice_controller.php',
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
                                 { "data": "invoice_date"},
                                 { "data": "invoice_real_no"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
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
							 
							     $("#div_select_intern_combo").load('../controller/invoice/invoice_controller.php',{action:'select_intern_cancel_list',v_ctrl_name:'select_intern_app',v_quotation_id:data.quotation_reference},function(result,status){
										 $('#div_select_intern_combo option').map(function () {
                                        if ($(this).text() == $.trim(data.intern_app_ref)) return this;
                                        }).attr('selected', 'selected');
                                
                            });
							  
                    
                        // $('#div_company_select option').map(function () {
                        // if ($(this).text() == $.trim(data.company_name)) return this;
                        // }).attr('selected', 'selected');
						$("#select_company").val(data.company_id);
                        $("#select_company").trigger("chosen:updated");
						// $("#select_company").val(data.company_id);
                        // $("#select_company").trigger("chosen:updated");
                        //$("#txt_invoice_company_name").val(data.company_name);
                        $("#txt_invoice_po_box").val(data.po_box);
                        $("#txt_invoice_contact_no").val(data.telephone_no);
                        $("#txt_invoice_fax").val(data.fax);
                        $("#txt_invoice_attn").val(data.attn);
                        $("#txt_real_invoice_no").val(data.invoice_real_no);
                        $("#txt_invoice_no").val(data.invoice_number);
                        $('#txt_invoice_discount_amount').val(data.total_discount_amount);
                       // $('#txt_hidden_discount_type').val(data.discount_type);
                        $('#txt_hidden_discount_amount').val(data.discount_amount);
                        $('#txt_discount_amount_qt').val(data.discount_amount);
                        
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
							 if(data.intern_app_ref!=""){
									$("#customradio4").prop("checked", true);
									
									 $('#txt_cust_intern_no').val(data.customer_intern_no);
									 $('#div_intern').show();
									$('#div_cust_intrn_no').show();
								   $('#div_upload').show();
								
                           
								   }
								   else{
									   $("#customradio3").prop("checked", true);
									   $('#div_intern').hide();
									   $('#div_cust_intrn_no').hide();
									   $('#div_upload').hide();
										
								   }
                          load_data_to_grid_delivery_note_list_for_intern(data.invoice_number);
                        }
                        //console.log("intern"+data.intern_app_ref);
                      
                       
                      
                        $('#txt_invoice_vat').val(data.vat);
                        $('#txt_invoice_total_amount').val(data.total_amount);
                        $('#txt_invoice_received_amount').val(data.received_amount);
                        
                        $('#txt_invoice_net_balance_due').val(data.balane_in_due);
                        $('#txt_invoice_previous_bill_amount').val(data.previous_bill_amount);
                        $('#txt_invoice_retention_percentage').val(data.retention_amount_percentage);
                        
                         $('#div_received_amount_type option').map(function () {
							 $(this).removeAttr('selected');
                        if ($(this).text() == $.trim(data.received_amount_type)) return this;
                        }).attr('selected', 'selected');
                        
                        $('#div_retention_amount_type option').map(function () {
							$(this).removeAttr('selected');
                        if ($(this).text() == $.trim(data.retention_amount_type)) return this;
                        }).attr('selected', 'selected');
                        
                        $('#div_discount_amount_type option').map(function () {
							$(this).removeAttr('selected');
                        if ($(this).text() == $.trim(data.discount_type)) return this;
                        }).attr('selected', 'selected');
                        
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
                                     //alert("inside if"+data.quotation_reference);
                                       $('#div_select_quotation_combo option').map(function () {
                                        if ($(this).text() == $.trim(data.quotation_reference)) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
								   
									   
								   
                         }); 
                         load_data_from_quatation_database(data.quotation_reference);
                        
                         $('#btn_generate_invoice' ).hide();
                         $('#btn_edit_invoice').hide();
                         closeNavRCancel();     
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
                   var y = document.getElementById("bank_details").checked;
                     
                     var z = (y == true) ? 1 : 0;
                  
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
                       $.post("../controller/invoice/new_invoice_controller.php",
					   {action:'invoice_status',v_invoice_no:invoice_number},
					   function(result,status){	   
                       var obj= jQuery.parseJSON(result);

                       var v_invoice_status = obj.data[0].invoice_status;	
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
							   window.open("reports/pdf/print/invoice_printnew.php?invoice_number="+invoice_number+"&x=1&z="+z,"_blank"); 
                       
							  //window.open("reports/invoice_print_without_head_v1.php?invoice_number="+invoice_number,"_blank"); 
						   }
                       
                       });
                      
                       
                   }    
                      
                 });
				 $('#btn_view_document').click(function(){
                       var invoice_number=$('#txt_invoice_no').val();
                   
                    if($.trim(invoice_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create invoice',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
					 else
                    {
					var v_real_no=$('#txt_real_invoice_no').val();
					if($.trim(v_real_no)==""){
						$.toast({
                                        heading: 'Error',
                                        text: 'Please select or create invoice',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
					}else{
                       $.post("../controller/invoice/new_invoice_controller.php",{action:'view_intern_document',v_invoice_no:invoice_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_invoice_status=obj.data[0].file_upload;
                       if(v_invoice_status=="")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'No Document to show',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("../httpdocs/customer_intern_file/"+v_invoice_status,"_blank"); 
                       
                       }
                       
                       });
					}
                       
                    }
                    
                     
                 }); 
                 
					
                  
                 $('#btn_invoice_print_with_head').click(function(){
                     var y = document.getElementById("bank_details").checked;
                     
                     var z = (y == true) ? 1 : 0;
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
                       $.post("../controller/invoice/new_invoice_controller.php",{action:'invoice_status',v_invoice_no:invoice_number},function(result,status){
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
                          window.open("reports/pdf/print/invoice_printnew.php?invoice_number="+invoice_number+"&x=0&z="+z,"_blank"); 
                       
						  //window.open("reports/invoice_print_with_head_v1.php?invoice_number="+invoice_number,"_blank"); 
                       }
                       
                       });
                      
                       
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
                    var v_invoice_quotation_ref=$("#select_quotation option:selected").text();
                    var v_invoice_lpo_no=$('#txt_invoice_lpo_no').val();
                   
                     
                        var v_project_name= $('#txt_invoice_project_name').val() ;
                        var v_project_id= $('#txt_invoice_project_id').val() ;
                        
                    
                    
                    var v_invoice_description=$('#txt_invoice_description').val();
                    var v_invoice_quantity=$('#txt_invoice_quantity').val();
                    var v_invoice_unit=$('#txt_invoice_unit').val();
                    var v_invoice_rate=$('#txt_invoice_rate').val();
                    var v_invoice_amount=$('#txt_invoice_amount').val();
                    
                    
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
                        var v_discount_type =  $("#div_discount_amount_type option:selected").val();
                        var v_discount_amount = $('#txt_discount_amount_qt').val();
                        var v_total_discount_amount= $("#txt_quotation_total_discount_amount").val();
                        
                        var v_received_amount_type=$("#div_received_amount_type option:selected").val();
                        var v_retention_amount_type=$("#div_retention_amount_type option:selected").val();
                        var v_final_discount= $("#txt_final_discount_amount").val();
                        
                        
                              
                    var v_invoice_sub_total=pageTotal1;
                    
                    if($.trim(v_invoice_received_amount)==""||$.trim(v_invoice_balance_due)==""||$.trim(v_invoice_all_description)=="")
                     {
                        swal("Warning"," Please Fill All The Fields ", "warning");
                        
                        
                     }
                    else
                    {         
                         $.post("../controller/invoice/new_invoice_controller.php",{action:'edit_invoice',v_invoice_company_name:v_invoice_company_name,v_invoice_po_box:v_invoice_po_box,v_invoice_contact_no:v_invoice_contact_no,v_invoice_fax:v_invoice_fax,v_invoice_attn:v_invoice_attn,v_invoice_no:v_invoice_no,v_invoice_date:v_invoice_date,v_invoice_quotation_ref:v_invoice_quotation_ref,v_invoice_lpo_no:v_invoice_lpo_no,v_quotation_no:v_invoice_quotation_ref,v_project_name:v_project_name,v_project_id:v_project_id,v_invoice_company_id:v_invoice_company_id,v_invoice_no:v_invoice_no,v_invoice_vat:v_invoice_vat,v_invoice_total_amount:v_invoice_total_amount,v_invoice_received_amount:v_invoice_received_amount,v_invoice_balance_due:v_invoice_balance_due,v_invoice_all_description:v_invoice_all_description,v_invoice_sub_total:v_invoice_sub_total,v_invoice_retention_amount:v_invoice_retention_amount,v_invoice_previous_bill_amount:v_invoice_previous_bill_amount,v_discount_type:v_discount_type,v_discount_amount:v_discount_amount,v_total_discount_amount:v_total_discount_amount,v_received_amount_type:v_received_amount_type,v_retention_amount_type:v_retention_amount_type,v_invoice_child_id:v_invoice_child_id,final_discount_amount:v_final_discount
                                },function(result,status){
                                   
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
                                  
                                     
                                    //load_data_to_grid_invoice_list( v_invoice_no);
                                     clear_text();
                                    
                                }
                            
                        }); 
                     }
            
			}); 

              			
            var btn_reissue_qnty = $('#btn_reissue_qnty').ladda();
            btn_reissue_qnty.click(function(){
                btn_reissue_qnty.ladda('start');
                // var v_description = $("#txt_reissue_desc").val();
                const editorData = editor1.getData();
                   
                    var v_description= editorData;
                   console.log(v_description);
				var v_invoice_no=$("#txt_invoice_no").val(); 
                var v_quotation_child_id = $("#txt_quotation_child_id").val();		
                if($.trim(v_description)=="")
				{
					swal("Warning","Please provide Description ....", "warning");
					btn_reissue_qnty.ladda('stop');
					return false; 
				}
				else
				{     
					$.post("../controller/invoice/new_invoice_controller.php",
					{action:'change_delivery_qty', v_invoice_description:v_description, v_invoice_no:v_invoice_no, v_quotation_child_id:v_quotation_child_id}, 
					function(result, status){
						var invoice_no=  $("#txt_invoice_no").val();
						load_data_to_grid_delivery_note_list_for_intern(invoice_no);
						load_data_to_grid_invoice_list(invoice_no);
						btn_reissue_qnty.ladda('stop');
						$('#modal_quantity_change').modal('hide');
					});
				}
           });           			
                  
               
        function load_data_from_quatation_database(quatation_no){
             $.post('../controller/invoice/new_invoice_controller.php',{action:'select_total_discount_amount_for_qt',v_quotation_no : quatation_no},function(result,status){
                         if(status=='success')
                         {
                           
                               var obj= jQuery.parseJSON(result);
                              

                              $("#txt_discount_amount_qt").val(obj.data[0].discount_amount);
							  $('#div_discount_amount_type option').map(function () {
								if ($(this).text() == $.trim(obj.data[0].discount_type)) return this;
								}).attr('selected', 'selected');
							   
                              $("#txt_quotation_total_discount_amount").val(obj.data[0].total_discount_amount);
                               v_total_discount_amount= $("#txt_quotation_total_discount_amount").val();
                               
                              lbl_vat_percentage = parseFloat(obj.data[0].tax_content);
                              var lbl_vat_amount= parseFloat(obj.data[0].tax_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                              var lbl_gross_amt= parseFloat(obj.data[0].gross_amt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                              var lbl_disc=parseFloat(obj.data[0].discount_amount);
                              var lbl_net_amt_exvat=parseFloat(obj.data[0].sub_total).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                                   //  $("#lbl_contract_value").text(amount_sum);
                              $("#lbl_discount").html(" " +lbl_disc);
                              $("#lbl_net_amount_exvat").html(" " +lbl_net_amt_exvat);
                                $("#lbl_vat_perc").html(" " +lbl_vat_percentage+'%');
                                 $("#lbl_vat_amt").html(" " +lbl_vat_amount); 
                              $("#lbl_gross_amt_bd").html(" " +lbl_gross_amt);
                              $("#lbl_discount_perc").html(" (" +obj.data[0].discount_type+")");
							//	$("#table_gross_value").html(lbl_gross_amt);
								$("#table_vat_perc").html(lbl_vat_percentage+'%');
								var table_net_amount_due=$("#table_net_amount_due").html();
								var number = parseFloat(table_net_amount_due.replace(/,/g, ''));
								var table_net_amount_due_amount=(parseFloat(number)*parseFloat(lbl_vat_percentage))/100;
								var tax_value_for_table=parseFloat(table_net_amount_due_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
								$("#table_tax_value").html(tax_value_for_table);
								var table_total_amount=parseFloat(number)+parseFloat(table_net_amount_due_amount);
								var table_total_amount_for_table=parseFloat(table_total_amount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
								$("#table_total_amount").html(table_total_amount_for_table);
                         }
                            });
                                
        }
             
           
                 
                 
                     
});


