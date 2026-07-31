$(document).ready(function(){
    // $('#div_unit_select').load('templates/service_unit_combo.php');
    var v_but_delivery_note_save = $( '#btn_delivery_note_add' ).ladda();
    var v_but_delivery_note_edit = $( '#btn_delivery_note_edit' ).ladda();
    var v_quotation_child_id;
    var delivery_note_list_table = $('#tbl_delivery_note_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
    var delivery_note_list_table_original = $('#tbl_delivery_note_list_original').DataTable({searching: false, paging: false, info: false,"ordering": false});
    
    var delivery_note_cancel_view_list_table = $('#list_of_cancel_delivery_notes').DataTable( {searching: false, paging: false, info: false,"ordering": false});
    
     $('#tbl_delivery_note_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
	 
	 var delivery_note_view_list_table = $('#list_of_delivery_notes').DataTable( {searching: false, paging: false, info: false,"ordering": false});
     $('#list_of_delivery_notes').removeClass( 'display' ).addClass('table table-striped table-bordered');
	 $('#list_of_delivery_notes tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { delivery_note_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
     }); 
	 
	 $('#div_company_select').load('templates/company_combo.php');
	 
    
     $('#tbl_delivery_note_list_original').removeClass( 'display' ).addClass('table table-striped table-bordered');
     $('#list_of_cancel_delivery_notes').removeClass( 'display' ).addClass('table table-striped table-bordered');
      $('#tbl_delivery_note_list tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { delivery_note_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
      });
    //   $('#tbl_delivery_note_list tbody').on( 'click', 'tr', function () {

    //                 if ( $(this).hasClass('dashed') ) { $(this).removeClass('dashed'); } else { delivery_note_list_table.$('tr.selected').removeClass('dashed'); $(this).addClass('dashed'); }
                        
    //      }); 
      
    
    $('#div_manual_data').hide();
    
    // $('#manual_checkbox').on('change', function() {
    //     if ($(this).is(':checked')) {
    //         $('#div_manual_data').show();
    //         $('#manual_hide_table_div').hide();
    //     } else {
    //         $('#div_manual_data').hide();
    //         $('#manual_hide_table_div').show();
    //     }
    // });
    
    $('#manual_checkbox').on('change', function() {
        if ($(this).is(':checked')) {
            
            $('#manual_hide_table_div').hide();
            $('#div_unit_select').load('templates/delivery_unit_combo.php');
            // Disable the dropdown, set value to 0, and trigger change
            $('#select_quotation')
                .val('0') // Set to "Select Quotation"
                .prop('disabled', true)
                .trigger('change');
            $('#div_manual_data').show();
        } else {
            $('#div_manual_data').hide();
            $('#manual_hide_table_div').show();
    
            // Enable the dropdown
            $('#select_quotation').prop('disabled', false);
        }
    });


    $("#clear_btn").click(function() {
        $('#description').val('');
        $('#qty').val('');
        $("#unit").val('');
    });
    
    var siCounter = 1;  
    var editingRow = null;
    
    $("#add_btn").click(function() {
        var v_description = $('#description').val();
        var v_quantity = $('#qty').val();
        var v_unit = $("#unit option:selected").val();
        var v_unit_text =$("#unit option:selected").text();
        var v_service_note_company_name = $("#txt_service_note_company_name").val();
        var v_service_note_company_id = $("#txt_service_note_company_id").val();
        var v_service_type_name = $("#service_name option:selected").text();
        var v_service_type_id = $("#service_name option:selected").val();

        if (v_description === '' || v_unit === '0' || v_quantity === '' || $.trim(v_service_note_company_id) == "0" || $.trim(v_service_type_id) == "0") {
            swal('Warning', 'Please fill the required fields', 'warning');
        } else {

                var v_quotation_child_id = $("#txt_quotation_child_id").val();
                var v_quotation_no = 'Manual';
                // var v_description = $("#txt_quotation_description").val();
                // var v_quantity = $("#txt_quotation_quantity").val();
                // var v_unit = $("#txt_quotation_unit").val();
                var v_rate =$("#txt_quotation_rate").val();
                var v_amount =  $("#txt_quotation_amount").val();
                var v_discount_precentage =  $("#txt_quotation_discount_precentag").val();
                var v_discount_amount = $("#txt_quotation_discount_amount").val();
                var v_vat_percentage = $("#txt_quotation_vat_percentage").val();
                var v_net_amount =  $("#txt_quotation_netamount").val();
                var v_req_qty = $("#txt_quotation_quantity").val();
                var v_discount_type = $("#txt_quotation_discount_type").val();
                var v_delivery_note_company_name=$("#txt_delivery_note_company_name").val();
                var v_delivery_note_company_id=$("#txt_delivery_note_company_id").val();
                var v_delivery_note_po_box=$("#txt_delivery_note_po_box").val();
                var v_delivery_note_contact_no=$("#txt_delivery_note_contact_no").val();
                var v_delivery_note_fax=$("#txt_delivery_note_fax").val();
                var v_delivery_note_attn=$("#txt_delivery_note_attn").val();
                var v_delivery_note_no=$("#txt_delivery_note_no").val();
                var v_delivery_note_date=formatDate($("#txt_delivery_note_date").val());
                var v_delivery_note_quotation_ref=$("#txt_delivery_note_quotation_ref").val();
                var v_delivery_note_lpo_no=$('#txt_delivery_note_lpo_no').val();
                var v_delivery_note_project_name=$('#txt_delivery_note_project_name').val() ;
                var v_delivery_note_project_id=$("#txt_delivery_note_project_id").val();
                                    
                if($.trim(v_delivery_note_company_id)==="0"||$.trim(v_delivery_note_po_box)===""||$.trim(v_delivery_note_contact_no)===""||$.trim(v_delivery_note_fax)===""||$.trim(v_delivery_note_attn)===""||$.trim(v_delivery_note_date)===""||$.trim(v_delivery_note_lpo_no)==="")
                {
                    swal("Warning","Please provide all the details ....", "warning");
                    v_but_delivery_note_edit.ladda( 'stop' );
                    return false;
                }else
                {
                    $.post("../controller/delivery_note/new_delivery_note_controller.php",{
                        action:'add_delivery_note',
                        v_delivery_note_company_name:v_delivery_note_company_name,
                        v_delivery_note_po_box:v_delivery_note_po_box,
                        v_delivery_note_contact_no:v_delivery_note_contact_no,
                        v_delivery_note_fax:v_delivery_note_fax,
                        v_delivery_note_attn:v_delivery_note_attn,
                        v_delivery_note_no:v_delivery_note_no,
                        v_delivery_note_date:v_delivery_note_date,
                        v_delivery_note_quotation_ref:v_quotation_no,
                        v_delivery_note_lpo_no:v_delivery_note_lpo_no,
                        v_delivery_note_description:v_description,
                        v_delivery_note_quantity:v_quantity,
                        v_delivery_note_unit:v_unit_text,
                        v_quotation_child_id:v_quotation_child_id,
                        v_quotation_no:v_quotation_no,
                        v_rate:v_rate,
                        v_amount:v_amount,
                        v_discount_precentage:v_discount_precentage,
                        v_discount_amount:v_discount_amount,
                        v_vat_percentage:v_vat_percentage,
                        v_net_amount:v_net_amount,
                        v_req_qty:v_req_qty,
                        v_delivery_note_project_name:v_delivery_note_project_name,
                        v_delivery_note_project_id:v_delivery_note_project_id,
                        v_delivery_note_company_id:v_delivery_note_company_id,
                        v_discount_type:v_discount_type}, 
                    function(result,status){
                        result = $.trim(result);
                        if(result.charAt(0)=='U'){
                            swal("Error", result, "error");
                            //load_data_to_grid_delivery_note_list()
                            clear_text()
                        }else {
                            $.toast({
                                heading: 'Success',
                                text: 'Item added to delivery_note Successfully..!',
                                showHideTransition: 'slide',
                                icon: 'success'
                            });

                            $("#txt_delivery_note_no").val(result);
                            $("#delivery_note_no_head").html(result);
                            $("#txt_delivery_note_company_name,#txt_delivery_note_po_box,#txt_delivery_note_contact_no,#txt_delivery_note_fax,#txt_delivery_note_attn,#txt_delivery_note_no,#txt_delivery_note_date,#txt_delivery_note_quotation_ref,#txt_delivery_note_lpo_no").prop("readonly",true);
                             //$("#btn_qty_"+v_quotation_child_id).prop("disabled",true);
                            // Reset input fields
                            $('#description').val('');
                            $('#qty').val('');
                            $("#unit").val(0).trigger("change");
                            // $('#unit').val('');  
                            load_data_to_grid_delivery_note_list_print(result);
                            //load_data_to_grid_delivery_note_list(result);
                          
                            $("#div_first :input").prop("disabled", true);
                            $("#div_second :input").prop("disabled", true);
                        }
                    });
            } 
        }
    });

    $( '#btn_delivery_note_edit' ).hide();
    $('#btn_edit_delivery_note' ).hide();
    //  check_pending_delivery_note();
   function formatDate(date) {
         var d = new Date(date),
             month = '' + (d.getMonth() + 1),
             day = '' + d.getDate(),
             year = d.getFullYear();
    
         if (month.length < 2) month = '0' + month;
         if (day.length < 2) day = '0' + day;
    
         return [year, month, day].join('-');
    }
    
    
    
      let editor;
    
            ClassicEditor
                .create( document.querySelector( '#txt_delivery_note_all_description' ) )
                .then( newEditor => {
                    editor = newEditor;
                } )
                .catch( error => {
                    console.error( error );
                } );
   
    
    
    //  load_company_select_box('div_company_select','select_company');
     
     
     
    //   function load_company_select_box(div_name,ctrl_name)
    //     {

    //   $("#"+div_name).load('../controller/quotation/quotation_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});

    //     }
       
       
       
       
       $("#div_company_select").change(function() {
          
        $('#txt_delivery_note_company_name').val($('option:selected', this).text()) ;
        $("#txt_delivery_note_company_id").val($('option:selected', this).val());
        var company_id=$('option:selected', this).val() ;
        
        $.post("../controller/quotation/quotation_controller.php",{action:'select_company_details',v_company_id:company_id},function(result,status){
            
                    if(status=="success")
                    {
                        
                    var obj= jQuery.parseJSON(result);
                    $("#txt_delivery_note_company_id").val(obj.data[0].company_id);
                    $("#txt_delivery_note_company_name").val(obj.data[0].company_name);
                    $("#txt_delivery_note_po_box").val(obj.data[0].contact_address_1);
                    $("#txt_delivery_note_contact_no").val(obj.data[0].contact_phone);
                    $("#txt_delivery_note_fax").val(obj.data[0].fax);
                    $("#txt_delivery_note_attn").val(obj.data[0].contact_person);
                    
                    $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                
                   });
                    
                    var delivery_company_id=$("#txt_delivery_note_company_id").val();
                   
                    }
                    else
                    {
                        return false;
                    }
        });           
       
     }); 
     
     
      $('#btn_view_list_of_delivery_note').click(function(){
        
        var v_start_date_year= new Date().getFullYear();
        $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
        load_data_to_grid_view_delivery_note_list(); 
         
     });    
     
     
     function load_data_to_grid_view_delivery_note_list(quotation_no)
     {
         delivery_note_view_list_table.destroy();
             
         delivery_note_view_list_table = $('#list_of_delivery_notes').DataTable( {
                
                 "ajax": {
                     'type': 'POST',
                     'url': '../controller/delivery_note/new_delivery_note_controller.php',
                     'data': {
                        action: 'list_delivery_note_view',
                        v_quotation_no:quotation_no
                        
                     }
                 },
                 "language": {
                     "zeroRecords": "No records available",
                     "infoEmpty": "No records available",
                  },
                "order": [[ 0, "desc" ]],
				"bPaginate": false,
				"bLengthChange": true,
				"bFilter": true,
				"bInfo": true,
				"autoWidth": false,
                "columns": [
                  
                     { "data": "delivery_note_main_id","visible":false },
                     { "data": "delivery_note_date"},
                     { "data": "delivery_note_number"},
                     { "data": "LPO_no"},
                     {"data": "delivery_note_main_id" ,
			 
             
                              render: function ( data, type, rows, meta ) {
    						
    									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_delivery_note" name="view_delivery_note" ><i class="material-icons ">remove_red_eye</i></button>';
    								
    								return str_active_status_view;
    
    							 },
    							 
    					

			 
			         },
			         { "data": "delivery_note_main_id" ,
			 
             
                              render: function ( data, type, rows, meta ) {
    						
    									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_delivery_note" name="delete_delivery_note" ><i class="material-icons ">delete</i></button>';
    								
    								return str_active_status_view;
    
    							 },
    							 
    					

			 
			         },
                     
 
                 ],
                 pageLength: 50,
				 searching: true,
                 responsive: true,
				
                
                
                 "initComplete": function( settings, json ) {
                  
                                          
 
                  },
                  "fnDrawCallback": function() {
                   
 
                 }
            
             
         });  
    
     }
     
     
     function load_data_to_grid_view_delivery_note_list_for_quotation(quotation_no)
     {
         delivery_note_view_list_table.destroy();
             
         delivery_note_view_list_table = $('#list_of_delivery_notes').DataTable( {
                
                 "ajax": {
                     'type': 'POST',
                     'url': '../controller/delivery_note/delivery_note_controller.php',
                     'data': {
                        action: 'list_delivery_note_view_for_quotation',
                        v_quotation_no:quotation_no
                        
                     }
                 },
                 "language": {
                     "zeroRecords": "No records available",
                     "infoEmpty": "No records available",
                  },
                "order": [[ 0, "desc" ]],
				"bPaginate": false,
				"bLengthChange": true,
				"bFilter": true,
				"bInfo": true,
				"autoWidth": false,
                "columns": [
                  
                     { "data": "delivery_note_main_id","visible":false },
                     { "data": "delivery_note_date"},
                     { "data": "delivery_note_number"},
                     { "data": "LPO_no"},
                     {"data": "delivery_note_main_id" ,
			 
             
                              render: function ( data, type, rows, meta ) {
    						
    									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_delivery_note" name="view_delivery_note" ><i class="material-icons ">remove_red_eye</i></button>';
    								
    								return str_active_status_view;
    
    							 },
    							 
    					

			 
			         },
			         { "data": "delivery_note_main_id" ,
			 
             
                              render: function ( data, type, rows, meta ) {
    						
    									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_delivery_note" name="delete_delivery_note" ><i class="material-icons ">delete</i></button>';
    								
    								return str_active_status_view;
    
    							 },
    							 
    					

			 
			         },
                     
 
                 ],
                 pageLength: 50,
				 searching: true,
                 responsive: true,
				
                
                
                 "initComplete": function( settings, json ) {
                  
                                          
 
                  },
                  "fnDrawCallback": function() {
                   
 
                 }
            
             
         });  
    
     }
     
    
     
     $("#div_project_select_combo").change(function(){
        
        var project_id = ($('option:selected', this).val()); 
         $('#txt_delivery_note_project_name').val($('option:selected', this).text()) ;
         $("#txt_delivery_note_project_id").val($('option:selected', this).val());
      
       $("#div_select_quotation_combo").load('../controller/delivery_note/delivery_note_controller.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                
        });  
         
     })
     
      
     $("#div_select_quotation_combo").change(function(){
         
         var quotation_no= $('#div_select_quotation_combo option:selected').text(); 
       $("#txt_delivery_note_quotation_ref").val(quotation_no);
        var quotation_no= $("#txt_delivery_note_quotation_ref").val();
       
        var quotation_no = $.trim(($('option:selected', this).text())); 
        load_data_to_grid_delivery_note_list(quotation_no);
        load_data_to_grid_view_delivery_note_list_for_quotation(quotation_no);
        
        
        $.post("../controller/delivery_note/delivery_note_controller.php",{action:'count_on_quotation',v_quotation_no:quotation_no}, function(result,status)
             {
                 var obj= jQuery.parseJSON(result);
                 
                 
                 $('#no_of_dn').html('<strong>Generated Delivery Note : '+obj.data[0].dn_count_on_quotation+'</strong>');
               
         });    
        
      
     });
     
     $('#btn_create_delivery_note').click(function(){
         location.reload();
     })
     
    function load_data_to_grid_delivery_note_list(quotation_no)
     {
        // alert(quotation_no);
         delivery_note_list_table.destroy();
             
         delivery_note_list_table = $('#tbl_delivery_note_list').DataTable( {
                
                 "ajax": {
                     'type': 'POST',
                     'url': '../controller/delivery_note/new_delivery_note_controller.php',
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
				"scrollY": 300,
                "scrollX": true,
                "scroller": true,
			    "fixedHeader": {
                    header: true,
                   footer: true
                },
                "columns": [
                     { "data": null },
                     { "data": "quotation_child_id","visible":false },
                     { "data": "quotation_no","visible":false },
                     { "data": "description", width:"20%"},
                     { "data": "quantity"},
                     { "data": "unit"},
                     { "data": "rate", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
					 { "data": "amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),"visible":false },
					 { "data": "discount_precentage",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),
					      render: function ( data, type, rows, meta ) {
					          return str_discount=rows['discount_precentage']+  '(' +rows['discount_type']+ ')';
					      },
					     
					 "visible":false},
                     { "data": "discount_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),"visible":false},
                   
					 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
					 { "data": "quotation_child_id",
					 
					      render: function ( data, type, rows, meta ) {
						
									str_quotation_list = ' <button type="button" class="waves-effect waves-light  btn green box-shadow-none border-round mr-1 mb-1" style="color:white;" id="btn_qty_'+data+'" name="btn_quotation_list" >Add</button>';
								
								return str_quotation_list;

							 },
					 }
 
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
                    .column( 10 )
                    .data()
                    .reduce( function (a, b) {
                        
                        return intVal(a) + intVal(b);
                    }, 0 );
               
                // Total over this page Income
                pageTotal1 = api
                    .column( 10, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
               
                // Update footer
                $( api.column( 10 ).footer() ).html($.fn.dataTable.render.number(',', '.', 3, '').display( pageTotal1 )
                    
                );
                
            }
            
             
         });  
    
     }  
     
     $('#btn_search_date').click(function(){
         var v_delivery_note_from_date = formatDate($("#txt_start_date").val());
         var v_delivery_note_to_date = formatDate($("#txt_end_date").val());
         load_data_to_grid_view_delivery_note_list_between(v_delivery_note_from_date,v_delivery_note_to_date);
       
      });
      
      function load_data_to_grid_view_delivery_note_list_between(v_delivery_note_from_date,v_delivery_note_to_date)
     {
          delivery_note_view_list_table.destroy();
             
         delivery_note_view_list_table = $('#list_of_delivery_notes').DataTable( {
                
                 "ajax": {
                     'type': 'POST',
                     'url': '../controller/delivery_note/delivery_note_controller.php',
                     'data': {
                        action: 'list_delivery_note_view_between',
                        v_delivery_note_from_date:v_delivery_note_from_date,
                        v_delivery_note_to_date:v_delivery_note_to_date
                     }
                 },
                 "language": {
                     "zeroRecords": "No records available",
                     "infoEmpty": "No records available",
                  },
                "order": [[ 0, "desc" ]],
				"bPaginate": false,
				"bLengthChange": true,
				"bFilter": true,
				"bInfo": true,
				"autoWidth": false,
			    
                "columns": [
                  
                     { "data": "delivery_note_main_id","visible":false },
                     { "data": "delivery_note_date","width":"50px"},
                     { "data": "delivery_note_number","width":"50px"},
                     { "data": "LPO_no","width":"20px"},
                     { "data": "delivery_note_main_id" ,"width":"20px",
			 
             
                              render: function ( data, type, rows, meta ) {
    						
    									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_delivery_note" name="view_delivery_note" ><i class="material-icons ">remove_red_eye</i></button>';
    								
    								return str_active_status_view;
    
    							 },
    							 
    					

			 
			         },
			         { "data": "delivery_note_main_id" ,"width":"20px",
			 
             
                              render: function ( data, type, rows, meta ) {
    						
    									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_delivery_note" name="delete_delivery_note" ><i class="material-icons ">delete</i></button>';
    								
    								return str_active_status_view;
    
    							 },
    							 
    					

			 
			         },
 
                 ],
                 pageLength: 50,
				 searching: true,
                 responsive: true,
				
                
                
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
            v_quotation_no=data.quotation_no;
            v_description=$.trim(data.description);
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
            
            $("#txt_quotation_child_id").val(v_quotation_child_id);
            $("#txt_quotation_no").val(v_quotation_no);
            $("#txt_quotation_description").val(v_description);
            $("#txt_quotation_quantity").val(v_quantity);
            $("#txt_quotation_unit").val(v_unit);
            $("#txt_quotation_rate").val(v_rate);
            $("#txt_quotation_amount").val(v_amount);
            $("#txt_quotation_discount_precentag").val(v_discount_precentage);
            $("#txt_quotation_discount_amount").val(v_discount_amount);
            $("#txt_quotation_vat_percentage").val(v_vat_percentage);
            $("#txt_quotation_netamount").val(v_net_amount);
            $("#txt_quotation_quantity").val(v_req_qty);
            $("#txt_quotation_discount_type").val(v_discount_type);
            
         
            
            v_txt_delivery_note_no = $('#txt_delivery_note_no').val();
            var v_delivery_note_company_name=$("#div_company_select option:selected").text();
            $("#txt_delivery_note_company_name").val(v_delivery_note_company_name);
            var v_delivery_note_po_box=$("#txt_delivery_note_po_box").val();
            var v_delivery_note_contact_no=$("#txt_delivery_note_contact_no").val();
            var v_delivery_note_fax=$("#txt_delivery_note_fax").val();
            var v_delivery_note_attn=$("#txt_delivery_note_attn").val();
            var v_delivery_note_no=$("#txt_delivery_note_no").val();
            var v_delivery_note_date=formatDate($("#txt_delivery_note_date").val());
            var v_delivery_note_quotation_ref=$("#txt_delivery_note_quotation_ref").val();
            var v_delivery_note_lpo_no=$('#txt_delivery_note_lpo_no').val();
            
              // alert(v_delivery_note_company_name+'---'+v_delivery_note_po_box+'----'+v_delivery_note_contact_no+'----'+v_delivery_note_fax+'---'+v_delivery_note_attn+'----'+v_delivery_note_date+'-----'+v_quotation_no+'-----'+v_delivery_note_lpo_no);
                      
                
                        
           if($.trim(v_delivery_note_company_name)==""||$.trim(v_delivery_note_po_box)==""||$.trim(v_delivery_note_contact_no)==""||$.trim(v_delivery_note_fax)==""||$.trim(v_delivery_note_attn)==""||$.trim(v_delivery_note_date)==""||$.trim(v_quotation_no)==""||$.trim(v_delivery_note_lpo_no)=="")
                                    {
                                        swal("Warning","Please provide all the details ....", "warning");
                                       
                                        return false;
                                    }
                                  
                                     else
                                        {
            
            // if($.trim(v_delivery_note_no) !='')
            // {
            //  $.post("../controller/delivery_note/delivery_note_controller.php",{action:'check_avl',dis:v_description,delivery_no :v_txt_delivery_note_no}, function(result,status)
            //  {
            //      var obj= jQuery.parseJSON(result);
           
            //     if(obj.data[0].row_status=='1')
            //     {
            //           swal({
            //             title: "Already Added",
            //              text: "Selected Item Already in the list.",
            //              icon: "warning"
            //           });
            //         return false;
            //     }
                 
                
                
            //  });
            // }
           
                
        
        }  
            
           if($(this).attr("name")=='btn_quotation_list')
                 {
                     
                       $.post("../controller/delivery_note/new_delivery_note_controller.php",{action:'chk_delivered_qnty',v_quotation_child_id:v_quotation_child_id}, function(result,status)
                                 {
                                    
                                var obj= jQuery.parseJSON(result);
                                var v_delivered_qty = obj.data[0].total_delivered_qnty; 
                                //alert(v_delivered_qty);
                                if(v_delivered_qty == null)
                                {
                                   v_delivered_qty=0.00 ;
                                }
                                var balance_qty = parseInt(v_quantity) - parseInt(v_delivered_qty)
                              $("#txt_quotation_child_id").val(v_quotation_child_id);
                              $("#txt_quotation_quantity").val(v_quantity);
                              
                              $("#txt_reissue_qty").val(balance_qty);
                              $("#txt_quotation_rate").val(v_rate);
                              $("#txt_quotation_discount_precentag").val(v_discount_precentage);
                              $("#txt_quotation_vat_percentage").val(v_vat_percentage);
                              $("#txt_quotation_discount_type").val(v_discount_type);
                              $("#req_qty").html(v_quantity);
                              $("#delivered_qty").html(v_delivered_qty);
                              $("#txt_delivered_qty").val(v_delivered_qty);
                              if(parseInt(balance_qty)==0)
                              {
                                  $("#txt_reissue_qty").prop('disabled', true);
                                  $("#btn_reissue_qnty").prop('disabled', true);
                                  
                              }
                              else
                              {
                                  $("#txt_reissue_qty").prop('disabled', false);
                                  $("#btn_reissue_qnty").prop('disabled', false);
                              }
                              
                              if($.trim(v_delivery_note_no) !='')
                                    {
                                     $.post("../controller/delivery_note/delivery_note_controller.php",{action:'check_avl',dis:v_description,delivery_no :v_txt_delivery_note_no}, function(result,status)
                                     {
                                         var obj= jQuery.parseJSON(result);
                                   
                                        if(obj.data[0].row_status=='1')
                                        {
                                              swal({
                                                title: "Already Added",
                                                 text: "Selected Item Already in the list.",
                                                 icon: "warning"
                                              });
                                            return false;
                                        }
                                       else
                                       {
                                         $('#modal_quantity_change').modal();
    			                         $('#modal_quantity_change').modal('show');   
                                       }
                                        
                                        
                                     });
                                    }
                                    else
                                    {
                                      $('#modal_quantity_change').modal();
    			                      $('#modal_quantity_change').modal('show');  
                                    }
                              

    			              
                     });
                 
                 }  
     
     }); 
     
      $('#list_of_delivery_notes tbody').on('click', 'td button', function (){
          var $row = $(this).closest('tr');
            var data = delivery_note_view_list_table.row($row).data();
            v_delivery_note_number  = data.delivery_note_number;
            quotation_no=data.quotation_reference;
            
            if($(this).attr("name")=='view_delivery_note')
             {
                 
                 
            load_data_to_grid_delivery_note_list(quotation_no);
            
            $('#txt_delivery_note_description').val('');
            $('#txt_delivery_note_quantity').val('');
            $('#txt_delivery_note_unit').val('');
            
            $( '#btn_delivery_note_add' ).show();
            $( '#btn_delivery_note_edit' ).hide();
       
             // $('#div_company_select option').map(function () {
            // if ($(this).text() == data.company_name) return this;
            // }).attr('selected', 'selected');
           $("#select_company").val(data.company_id);
            $("#select_company").trigger("chosen:updated");
		   
            //$("#txt_delivery_note_company_name").val(data.company_name);
            $("#txt_delivery_note_po_box").val(data.po_box);
            $("#txt_delivery_note_contact_no").val(data.telephone_no);
            $("#txt_delivery_note_fax").val(data.fax);
            $("#txt_delivery_note_attn").val(data.attn);
            $("#txt_delivery_note_no").val(data.delivery_note_number);
            
            var del_date=data.delivery_note_date.split(' ');
            var delivery_note_date= del_date[0].split('-');
            var delivery_data=delivery_note_date[1]+'/'+delivery_note_date[0]+'/'+delivery_note_date[2];
             $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                       if(status=="success")
                       {
                           $('#div_project_select_combo option').map(function () {
                            if ($(this).text() == data.project_name) return this;
                            }).attr('selected', 'selected');
                         // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                       }
            });
            $("#txt_delivery_note_date").val(delivery_data);
             $("#div_select_quotation_combo").load('../controller/delivery_note/new_delivery_note_controller.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:data.project_id},function(result,status){
                 if(status=="success")
                       {
                           $('#div_select_quotation_combo option').map(function () {
                            if ($(this).text() == data.quotation_reference) return this;
                            }).attr('selected', 'selected');
                         // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                       }
             }); 
            if(data.quotation_reference === 'Manual'){
                $('#manual_checkbox').prop('checked', true);
                $('#select_quotation')
                .val('0') // Set to "Select Quotation"
                .prop('disabled', true)
                .trigger('change');
            }else{
              $('#manual_checkbox').prop('checked', false);
                $('#select_quotation').prop('disabled', true);   
            }
            $("#txt_delivery_note_quotation_ref").val(data.quotation_reference);
            $('#txt_delivery_note_lpo_no').val(data.LPO_no);
            //load_data_to_grid_delivery_note_list(data.delivery_note_number);
            load_data_to_grid_delivery_note_list_print(data.delivery_note_number);
          
            $('#provider_name').val(data.provided_by);
            $('#received_by').val(data.received_by_name);
            $('#txt_notes').val(data.notes);
            $("#txt_delivery_note_all_description").val(data.description);
            //$( '#btn_delivery_note_add' ).hide();
           // $( '#btn_delivery_note_edit' ).show();
          
            
            $("#delivery_note_no_head").html(data.delivery_note_number);
             $('#btn_generate_delivery_note' ).hide();
             $('#btn_edit_delivery_note' ).show();
             
            
            closeNavR();
             }
             
             if($(this).attr("name")=='delete_delivery_note')
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
                            						        //alert(v_delivery_note_number);
                            						       cancel_delivery_note(v_delivery_note_number);
                                         				    load_data_to_grid_view_delivery_note_list();
                                         				    
                            							} else {
                            							    
                            							   
                            							 
                            							}
                            						 });
             }     
             
          
          
      });
     
     
    
    
       
      function add_to_delivery_list(v_quotation_child_id,v_quotation_no,v_description,v_quantity,v_unit,v_rate,v_amount,v_discount_precentage,v_discount_amount,v_vat_percentage,v_net_amount,v_req_qty,v_discount_type)
        {
           
                               var v_delivery_note_company_name=$("#txt_delivery_note_company_name").val();
                               var v_delivery_note_company_id=$("#txt_delivery_note_company_id").val();
                                var v_delivery_note_po_box=$("#txt_delivery_note_po_box").val();
                                var v_delivery_note_contact_no=$("#txt_delivery_note_contact_no").val();
                                var v_delivery_note_fax=$("#txt_delivery_note_fax").val();
                                var v_delivery_note_attn=$("#txt_delivery_note_attn").val();
                                var v_delivery_note_no=$("#txt_delivery_note_no").val();
                                var v_delivery_note_date=formatDate($("#txt_delivery_note_date").val());
                                var v_delivery_note_quotation_ref=$("#txt_delivery_note_quotation_ref").val();
                                var v_delivery_note_lpo_no=$('#txt_delivery_note_lpo_no').val();
                                var v_delivery_note_project_name=$('#txt_delivery_note_project_name').val() ;
                                var v_delivery_note_project_id=$("#txt_delivery_note_project_id").val();
                                
                            if($.trim(v_delivery_note_company_id)=="0"||$.trim(v_delivery_note_po_box)==""||$.trim(v_delivery_note_contact_no)==""||$.trim(v_delivery_note_fax)==""||$.trim(v_delivery_note_attn)==""||$.trim(v_delivery_note_date)==""||$.trim(v_delivery_note_lpo_no)=="")
                                {
                                    swal("Warning","Please provide all the details ....", "warning");
                                    v_but_delivery_note_edit.ladda( 'stop' );
                                    return false;
                                }
                         else
                         {
                             $.post("../controller/delivery_note/new_delivery_note_controller.php",{action:'add_delivery_note',v_delivery_note_company_name:v_delivery_note_company_name,v_delivery_note_po_box:v_delivery_note_po_box,v_delivery_note_contact_no:v_delivery_note_contact_no,v_delivery_note_fax:v_delivery_note_fax,v_delivery_note_attn:v_delivery_note_attn,v_delivery_note_no:v_delivery_note_no,v_delivery_note_date:v_delivery_note_date,v_delivery_note_quotation_ref:v_quotation_no,v_delivery_note_lpo_no:v_delivery_note_lpo_no,v_delivery_note_description:v_description,v_delivery_note_quantity:v_quantity,v_delivery_note_unit:v_unit,v_quotation_child_id:v_quotation_child_id,v_quotation_no:v_quotation_no,v_rate:v_rate,v_amount:v_amount,v_discount_precentage:v_discount_precentage,v_discount_amount:v_discount_amount,v_vat_percentage:v_vat_percentage,v_net_amount:v_net_amount,v_req_qty:v_req_qty,v_delivery_note_project_name:v_delivery_note_project_name,v_delivery_note_project_id:v_delivery_note_project_id,v_delivery_note_company_id:v_delivery_note_company_id,v_discount_type:v_discount_type
                             
                                    }
                                    , function(result,status)
                                    {
                                       
                                    result = $.trim(result);
                                   
                                    if(result.charAt(0)=='U')
                                    {
                                       
                                        swal("Error", result, "error");
                                        //load_data_to_grid_delivery_note_list()
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
                                        
                                       
                                       
                                        
                                         $("#txt_delivery_note_no").val(result);
                                         $("#delivery_note_no_head").html(result);
                                         $("#txt_delivery_note_company_name,#txt_delivery_note_po_box,#txt_delivery_note_contact_no,#txt_delivery_note_fax,#txt_delivery_note_attn,#txt_delivery_note_no,#txt_delivery_note_date,#txt_delivery_note_quotation_ref,#txt_delivery_note_lpo_no").prop("readonly",true);
                                         //$("#btn_qty_"+v_quotation_child_id).prop("disabled",true);
                                         return "success";
                                         load_data_to_grid_delivery_note_list_print(result);
                                        //load_data_to_grid_delivery_note_list(result);
                                      
                                        $("#div_first :input").prop("disabled", true);
                                        $("#div_second :input").prop("disabled", true);
                                        
                                         
                                        
                                    }
                                    
                                     
                                
                            });
                            
              }       
                            
                      
                               
         }  
         
         
function cancel_delivery_note(v_delivery_note_number)
{

$.post("../controller/delivery_note/delivery_note_controller.php",{action:'cancel_delivery_note_list',v_delivery_note_no:v_delivery_note_number
                                    }
                                    , function(result,status)
                                    {
                                       
                                        
             });
}




         
 $("#txt_reissue_qty").change(function() {
  var v_req_quantity= $("#txt_quotation_quantity").val();  
    var balance = $("#txt_reissue_qty").val();
    var delivered_qty = $("#txt_delivered_qty").val();
    if(delivered_qty== null)
    {
      delivered_qty=0.00;   
    }
    var balance_qty = parseInt(v_req_quantity) - parseInt(delivered_qty);
    
   
    if(parseInt(balance_qty) < parseInt(balance))
    {
     
       swal("Error","Delivered quantity is grater than required quantity", "error"); 
         
        $("#txt_reissue_qty").val(balance_qty)  ;  
        return false;
    }
    
 });        
         
   
$("#btn_reissue_qnty").click(function(){
   
  
        var v_quotation_child_id = $("#txt_quotation_child_id").val();
        var v_quotation_no = $("#txt_quotation_no").val();
        var v_description = $("#txt_quotation_description").val();
        var v_quantity = $("#txt_quotation_quantity").val();
        var v_unit = $("#txt_quotation_unit").val();
        var v_rate =$("#txt_quotation_rate").val();
        var v_amount =  $("#txt_quotation_amount").val();
        var v_discount_precentage =  $("#txt_quotation_discount_precentag").val();
        var v_discount_amount = $("#txt_quotation_discount_amount").val();
        var v_vat_percentage = $("#txt_quotation_vat_percentage").val();
        var v_net_amount =  $("#txt_quotation_netamount").val();
        var v_req_qty = $("#txt_quotation_quantity").val();
        var v_discount_type = $("#txt_quotation_discount_type").val();
   
   
 //  var ret_val= add_to_delivery_list(v_quotation_child_id,v_quotation_no,v_description,v_quantity,v_unit,v_rate,v_amount,v_discount_precentage,v_discount_amount,v_vat_percentage,v_net_amount,v_req_qty,v_discount_type);
                       
                       
                        var v_delivery_note_company_name=$("#txt_delivery_note_company_name").val();
                               var v_delivery_note_company_id=$("#txt_delivery_note_company_id").val();
                                var v_delivery_note_po_box=$("#txt_delivery_note_po_box").val();
                                var v_delivery_note_contact_no=$("#txt_delivery_note_contact_no").val();
                                var v_delivery_note_fax=$("#txt_delivery_note_fax").val();
                                var v_delivery_note_attn=$("#txt_delivery_note_attn").val();
                                var v_delivery_note_no=$("#txt_delivery_note_no").val();
                                var v_delivery_note_date=formatDate($("#txt_delivery_note_date").val());
                                var v_delivery_note_quotation_ref=$("#txt_delivery_note_quotation_ref").val();
                                var v_delivery_note_lpo_no=$('#txt_delivery_note_lpo_no').val();
                                var v_delivery_note_project_name=$('#txt_delivery_note_project_name').val() ;
                                var v_delivery_note_project_id=$("#txt_delivery_note_project_id").val();
                                
                            if($.trim(v_delivery_note_company_id)=="0"||$.trim(v_delivery_note_po_box)==""||$.trim(v_delivery_note_contact_no)==""||$.trim(v_delivery_note_fax)==""||$.trim(v_delivery_note_attn)==""||$.trim(v_delivery_note_date)==""||$.trim(v_delivery_note_lpo_no)=="")
                                {
                                    swal("Warning","Please provide all the details ....", "warning");
                                    v_but_delivery_note_edit.ladda( 'stop' );
                                    return false;
                                }
                         else
                         {
                            $.post("../controller/delivery_note/new_delivery_note_controller.php",{action:'add_delivery_note',v_delivery_note_company_name:v_delivery_note_company_name,v_delivery_note_po_box:v_delivery_note_po_box,v_delivery_note_contact_no:v_delivery_note_contact_no,v_delivery_note_fax:v_delivery_note_fax,v_delivery_note_attn:v_delivery_note_attn,v_delivery_note_no:v_delivery_note_no,v_delivery_note_date:v_delivery_note_date,v_delivery_note_quotation_ref:v_quotation_no,v_delivery_note_lpo_no:v_delivery_note_lpo_no,v_delivery_note_description:v_description,v_delivery_note_quantity:v_quantity,v_delivery_note_unit:v_unit,v_quotation_child_id:v_quotation_child_id,v_quotation_no:v_quotation_no,v_rate:v_rate,v_amount:v_amount,v_discount_precentage:v_discount_precentage,v_discount_amount:v_discount_amount,v_vat_percentage:v_vat_percentage,v_net_amount:v_net_amount,v_req_qty:v_req_qty,v_delivery_note_project_name:v_delivery_note_project_name,v_delivery_note_project_id:v_delivery_note_project_id,v_delivery_note_company_id:v_delivery_note_company_id,v_discount_type:v_discount_type
                            }, function(result,status){
                                       
                                    result = $.trim(result);
                                   
                                    if(result.charAt(0)=='U')
                                    {
                                       
                                        swal("Error", result, "error");
                                        //load_data_to_grid_delivery_note_list()
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
                                        
                                       
                                       
                                        
                                         $("#txt_delivery_note_no").val(result);
                                         $("#delivery_note_no_head").html(result);
                                         $("#txt_delivery_note_company_name,#txt_delivery_note_po_box,#txt_delivery_note_contact_no,#txt_delivery_note_fax,#txt_delivery_note_attn,#txt_delivery_note_no,#txt_delivery_note_date,#txt_delivery_note_quotation_ref,#txt_delivery_note_lpo_no").prop("readonly",true);
                                         //$("#btn_qty_"+v_quotation_child_id).prop("disabled",true);
                                        
                                         load_data_to_grid_delivery_note_list_print(result);
                                        //load_data_to_grid_delivery_note_list(result);
                                      
                                        $("#div_first :input").prop("disabled", true);
                                        $("#div_second :input").prop("disabled", true);
                                        
                                         
                                        
                                    }
                                    
                                     
                             
                       
               
                        var v_delivery_note_company_name=$("#txt_delivery_note_company_name").val();
                        var v_delivery_note_po_box=$("#txt_delivery_note_po_box").val();
                        var v_delivery_note_contact_no=$("#txt_delivery_note_contact_no").val();
                        var v_delivery_note_fax=$("#txt_delivery_note_fax").val();
                        var v_delivery_note_attn=$("#txt_delivery_note_attn").val();
                        var v_delivery_note_no=$("#txt_delivery_note_no").val();
                        var v_delivery_note_date=formatDate($("#txt_delivery_note_date").val());
                        var v_delivery_note_quotation_ref=$("#txt_delivery_note_quotation_ref").val();
                        var v_delivery_note_lpo_no=$('#txt_delivery_note_lpo_no').val();
                        
             
   
                        var v_delivery_note_no=$("#txt_delivery_note_no").val(); 
                        var v_req_quantity= $("#txt_quotation_quantity").val(); 
                        var v_quotation_child_id = $("#txt_quotation_child_id").val();
                        var delivered_qty = $("#txt_reissue_qty").val();
                        var item_remarks=  $("#txt_remarks").val();
                        var rate =  $("#txt_quotation_rate").val();
                        var discount_percentage = $("#txt_quotation_discount_precentag").val();
                        var vat_percentage = $("#txt_quotation_vat_percentage").val();
                        var v_amount=(parseFloat(delivered_qty)*parseFloat(rate));
                        var v_discount_type=$("#txt_quotation_discount_type").val();
  
                          if(discount_percentage=='')
                          {
                             discount_percentage = 0.000; 
                          }
                          if(v_discount_type=='%')
                          {
                          var dis_amount = (parseFloat(delivered_qty)*parseFloat(rate))*(parseFloat(discount_percentage)/100);
                         // alert(dis_amount);
                          var v_discount_amount=(parseFloat(delivered_qty)*parseFloat(rate))- parseFloat(dis_amount) ;
                         // alert(v_discount_amount);
                          var v_net_amount= parseFloat(v_discount_amount).toFixed(3) ;
                         // alert (v_net_amount);
                          }
                          else
                          {
                             var dis_amount = (parseFloat(delivered_qty)*parseFloat(rate))-(parseFloat(discount_percentage));
                         // alert(dis_amount);
                          var v_discount_amount= parseFloat(dis_amount) ;
                         // alert(v_discount_amount);
                          var v_net_amount= parseFloat(v_discount_amount).toFixed(3) ;
                         // alert (v_net_amount);  
                          }
                        if($.trim(v_delivery_note_company_name)==""||$.trim(v_delivery_note_po_box)==""||$.trim(v_delivery_note_contact_no)==""||$.trim(v_delivery_note_fax)==""||$.trim(v_delivery_note_attn)==""||$.trim(v_delivery_note_date)==""||$.trim(v_quotation_no)==""||$.trim(v_delivery_note_lpo_no)=="")
                        {
                            swal("Warning","Please provide all the details ....", "warning");
                            v_but_delivery_note_save.ladda( 'stop' );
                            return false;
                        }
                       
                        else
                        {    
                          
                               $.post("../controller/delivery_note/delivery_note_controller.php",{action:'change_delivery_qty',v_quotation_child_id:v_quotation_child_id,v_delivered_qty:delivered_qty,v_net_amount:v_net_amount,v_amount:v_amount,v_discount_amount:v_discount_amount,v_delivery_note_no:v_delivery_note_no,v_item_remarks:item_remarks
                               } , function(result,status){
                                   var delivery_note_no=  $("#txt_delivery_note_no").val();
                                  $("#txt_remarks").val('');
                                   load_data_to_grid_delivery_note_list_print(delivery_note_no);
                                   $('#modal_quantity_change').modal();
                			       $('#modal_quantity_change').modal('hide');
                               });
   
                        }
                        
                        
         })          
 }  

});  

    function load_data_to_grid_delivery_note_list_print(delivery_note_no)
     {
         delivery_note_list_table_original.destroy();
             
         delivery_note_list_table_original = $('#tbl_delivery_note_list_original').DataTable( {
                
                 "ajax": {
                     'type': 'POST',
                     'url': '../controller/delivery_note/delivery_note_controller.php',
                     'data': {
                        action: 'list_delivery_note',
                        v_delivery_note_no:delivery_note_no
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
                     { "data": null},
                     { "data": "delivery_note_child_id","visible":false },
                     { "data": "delivery_note_no","visible":false },
                     
                     { "data": "description", width:"50%"},
                     { "data": "quantity"},
                     { "data": "unit"},
                     { "data": "delivery_note_child_id" ,"visible":false,
		 
         
                          render: function ( data, type, rows, meta ) {
						
									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_delivery_note" name="edit_delivery_note" ><i class="material-icons ">edit</i></button>';
								
								return str_active_status_view;

							 },
							 
					

		 
		           },
				   { "data": "delivery_note_child_id" ,
		 
         
                          render: function ( data, type, rows, meta ) {
						
									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_delivery_note" name="delete_delivery_note" ><i class="material-icons ">delete</i></button>';
								
								return str_active_status_view;

							 },
		 
		          },	 
 
                 ],
                 pageLength: 25,
				 searching: false,
                // responsive: true,
				
                
                
                 "initComplete": function( settings, json ) {
                        
                   
 
                  },
                  
                  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                     $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                     return nRow;
                 },
                  "fnDrawCallback": function() {
                   
 
                 }
            
             
         });  
    
     }
     
      $('#tbl_delivery_note_list_original tbody').on('click', 'td button', function (){
            var $row = $(this).closest('tr');
            var data = delivery_note_list_table_original.row($row).data();
            v_delivery_note_child_id  = data.delivery_note_child_id;
             if($(this).attr("name")=='edit_delivery_note')
             {
                  edit_delivery_item_data();
                 
             }
              if($(this).attr("name")=='delete_delivery_note')
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
					
					       cancel_delivery_item_list(v_delivery_note_child_id);
         						 
						} else {
						    
						   
						 
						}
					 });
             }
             
             
            
        //   swal("Confirm","Do you want to Edit or Delete?", {
        //                   buttons: {
        //                     cancel: "Cancel",
        //                     catch: {
        //                       text: "Edit",
        //                       value: "catch",
        //                     },
        //                     defeat: {
        //                       text: "Delete",
        //                       value: "delete",
        //                     },
        //                   },
        //                   icon:"warning",
        //                 })
        //                 .then((value) => {
        //                   switch (value) {
                         
        //                     case "delete":
        //                                              swal({
                                                        
        //                     							title: "Are you sure?",
        //                     							text: "Do you want to delete the entry?",
        //                     							icon: 'warning',
        //                     							dangerMode: true,
        //                     							allowOutsideClick: false,
        //                                                 closeOnClickOutside: false,
        //                     							buttons: {
        //                     							  cancel: 'No Cancel !',
        //                     							  delete: 'Yes Please Delete'
        //                     							}
        //                     							}).then(function (willDelete) {
        //                     							if (willDelete) {
                            						
        //                     						       cancel_delivery_item_list(v_delivery_note_child_id);
                                         						 
        //                     							} else {
                            							    
                            							   
                            							 
        //                     							}
        //                     						 });
        //                       break;
                         
        //                       case "catch":
                              
        //                       //swal("Edit!", "Please Edit your data", "success");
        //                       edit_delivery_item_data();
        //                       //closeNavR();
                              
        //                       break;
                         
        //                     default:
                            
        //                   }
                
        //   });  
           
           function edit_delivery_item_data()
           {
                $("#req_qty").html(data.quantity);
                $('#modal_quantity_change').modal();
                $('#modal_quantity_change').modal('open');
                
                
            
               
           }
           
            
            
          
            
      });
      
      
      
      function cancel_delivery_item_list(v_delivery_note_child_id)
      {
          
               $.post("../controller/delivery_note/delivery_note_controller.php",{action:'delete_delivery_item',v_delivery_note_child_id:v_delivery_note_child_id
               } , function(result,status){
                   var delivery_note_no=  $("#txt_delivery_note_no").val();
                 
                   load_data_to_grid_delivery_note_list_print(delivery_note_no);
                   
               });
               
          
          
      }

     

    $('#btn_generate_delivery_note').click(function(){
        var v_delivery_note_no=$("#txt_delivery_note_no").val();
        var provide_name =$('#provider_name').val();
        var received_by =$('#received_by').val();
        var notes =$('#txt_notes').val();
        var v_delivery_note_all_description= '<figure class="table"><table><tbody><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3">&nbsp;All the materials checked and confirmed<br><strong>&nbsp;Thank you for your business !</strong></td></tr></tbody></table></figure>';
        
        // const editorData = editor.getData();
        // var v_delivery_note_all_description= editorData;
        
        $.post("../controller/delivery_note/new_delivery_note_controller.php",{action:'generate_delivery_note',v_delivery_note_no:v_delivery_note_no,v_delivery_note_all_description:v_delivery_note_all_description,
            v_provide_name:provide_name,
            v_received_by:received_by,
            v_notes:notes
        }, 
        function(result,status){
            if(result=="success"){
                swal("Success"," Delivery note generated successfully", "success"); 
                $('#btn_generate_delivery_note').hide();
                $('#btn_edit_delivery_note').show();
                $("#txt_delivery_note_company_name,#txt_delivery_note_po_box,#txt_delivery_note_contact_no,#txt_delivery_note_fax,#txt_delivery_note_attn,#txt_delivery_note_no,#txt_delivery_note_date,#txt_delivery_note_quotation_ref,#txt_delivery_note_lpo_no").prop("readonly",false);
            }else {
                swal("Error"," Some Error Occures..", "error"); 
            }
        });
    });
      
      
      
      
$('#btn_edit_delivery_note').click(function(){
        var v_delivery_note_child_id=$("#txt_delivery_note_child_id").val();
        var v_delivery_note_company_name=$("#div_company_select option:selected").text();
        var v_delivery_note_company_id=$("#div_company_select option:selected").val();
        //var v_delivery_note_company_name=$("#txt_delivery_note_company_name").val();
        var v_delivery_note_po_box=$("#txt_delivery_note_po_box").val();
        var v_delivery_note_contact_no=$("#txt_delivery_note_contact_no").val();
        var v_delivery_note_fax=$("#txt_delivery_note_fax").val();
        var v_delivery_note_attn=$("#txt_delivery_note_attn").val();
        var v_delivery_note_no=$("#txt_delivery_note_no").val();
        var v_delivery_note_date=formatDate($("#txt_delivery_note_date").val());
        var v_delivery_note_quotation_ref=$("#txt_delivery_note_quotation_ref").val();
        var v_delivery_note_lpo_no=$('#txt_delivery_note_lpo_no').val();
        
        var provide_name =$('#provider_name').val();
        var received_by =$('#received_by').val();
        var notes =$('#txt_notes').val();
        var v_delivery_note_all_description= '<figure class="table"><table><tbody><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3">&nbsp;All the materials checked and confirmed<br><strong>&nbsp;Thank you for your business !</strong></td></tr></tbody></table></figure>';
        
        if($.trim(v_delivery_note_company_id)=="0"||$.trim(v_delivery_note_po_box)==""||$.trim(v_delivery_note_contact_no)==""||$.trim(v_delivery_note_fax)==""||$.trim(v_delivery_note_attn)==""||$.trim(v_delivery_note_date)==""||$.trim(v_delivery_note_lpo_no)==""){
            swal("Warning","Please provide all the details ....", "warning");
            v_but_delivery_note_edit.ladda( 'stop' );
            return false;
        }else{         
            $.post("../controller/delivery_note/new_delivery_note_controller.php",{
                action:'edit_delivery_note',
                v_delivery_note_company_name:v_delivery_note_company_name,
                v_delivery_note_po_box:v_delivery_note_po_box,
                v_delivery_note_contact_no:v_delivery_note_contact_no,
                v_delivery_note_fax:v_delivery_note_fax,
                v_delivery_note_attn:v_delivery_note_attn,
                v_delivery_note_no:v_delivery_note_no,
                v_delivery_note_date:v_delivery_note_date,
                v_delivery_note_quotation_ref:v_delivery_note_quotation_ref,
                v_delivery_note_lpo_no:v_delivery_note_lpo_no,
                v_delivery_note_no:v_delivery_note_no,
                v_delivery_note_all_description:v_delivery_note_all_description,
                v_delivery_note_child_id:v_delivery_note_child_id,
                v_provide_name:provide_name,
                v_received_by:received_by,
                v_notes:notes }, 
                
                function(result,status)
                    {
                       
                    result = $.trim(result);
                   
                    if(result.charAt(0)=='U')
                    {
                        v_but_delivery_note_edit.ladda( 'stop' );
                        swal("Error", result, "error");
                        //load_data_to_grid_delivery_note_list()
                        clear_text();
                       
                       

                    
                    }
                    else
                    {
                         v_but_delivery_note_edit.ladda( 'stop' );
                        
                         //swal("Success"," delivery_note added Successfully", "success");
                         $.toast({
                            heading: 'Success',
                            text: 'Item Edited to delivery_note Successfully..!',
                            showHideTransition: 'slide',
                            icon: 'success'
                        });
                         $( '#btn_delivery_note_add' ).show();
                         $( '#btn_delivery_note_edit' ).hide();
                         //$("#txt_delivery_note_no").val(result);
                         //$("#txt_delivery_note_company_name,#txt_delivery_note_po_box,#txt_delivery_note_contact_no,#txt_delivery_note_fax,#txt_delivery_note_attn,#txt_delivery_note_no,#txt_delivery_note_date,#txt_delivery_note_quotation_ref,#txt_delivery_note_lpo_no").prop("readonly",true);
                         
                         
                        load_data_to_grid_delivery_note_list( v_delivery_note_no);
                         clear_text()
                        
                    }
                
            }); 
         }

        
        
    });        
          
      
$('#btn_delivery_note_print').click(function(){
        var delivery_note_number=$('#txt_delivery_note_no').val();
       
        if($.trim(delivery_note_number)=="")
        {
             $.toast({
                            heading: 'Error',
                            text: 'Please select or create delivery_note for print',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
            return false;
        }
        else
        {
           $.post("../controller/delivery_note/delivery_note_controller.php",{action:'delivery_note_status',v_delivery_note_no:delivery_note_number},function(result,status){
           var obj= jQuery.parseJSON(result);
           var v_delivery_note_status=obj.data[0].delivery_note_status;
           if(v_delivery_note_status=="Pending")
           {
                       $.toast({
                            heading: 'Error',
                            text: 'Please generate delivery_note for print',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
                 return false;
               
           }
           else
           {
              window.open("reports/delivery_note_print_v3.php?delivery_note_number="+delivery_note_number,"_blank"); 
           }
           
           });
          
           
        }
        
        
    });
          
 $('#btn_delivery_note_print_without_head').click(function(){
        var delivery_note_number=$('#txt_delivery_note_no').val();
       
        if($.trim(delivery_note_number)=="")
        {
             $.toast({
                            heading: 'Error',
                            text: 'Please select or create delivery_note for print',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
            return false;
        }
        else
        {
           $.post("../controller/delivery_note/delivery_note_controller.php",{action:'delivery_note_status',v_delivery_note_no:delivery_note_number},function(result,status){
           var obj= jQuery.parseJSON(result);
           var v_delivery_note_status=obj.data[0].delivery_note_status;
           if(v_delivery_note_status=="Pending")
           {
                       $.toast({
                            heading: 'Error',
                            text: 'Please generate delivery_note for print',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
                 return false;
               
           }
           else
           {
              //window.open("reports/delivery_note_print_without_head.php?delivery_note_number="+delivery_note_number,"_blank"); 
			  window.open("reports/pdf/print/d_note.php?delivery_note_number="+delivery_note_number+"&x=1","_blank"); 
           
           }
           
           });
          
           
        }
        
        
    });
          
    $('#btn_delivery_note_export_excel').click(function(){
        var delivery_note_number=$('#txt_delivery_note_no').val();
       console.log("print"+delivery_note_number);
        if($.trim(delivery_note_number)=="")
        {
             $.toast({
                            heading: 'Error',
                            text: 'Please select or create delivery_note for print',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
            return false;
        }
        else
        {
           $.post("../controller/delivery_note/delivery_note_controller.php",{action:'delivery_note_status',v_delivery_note_no:delivery_note_number},function(result,status){
           var obj= jQuery.parseJSON(result);
           var v_delivery_note_status=obj.data[0].delivery_note_status;
           if(v_delivery_note_status=="Pending")
           {
                       $.toast({
                            heading: 'Error',
                            text: 'Please generate delivery_note for print',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
                 return false;
               
           }
           else
           {
              //window.open("reports/delivery_note_print_with_head.php?delivery_note_number="+delivery_note_number,"_blank"); 
			  window.open("reports/delivery_note_print_with_head.php?delivery_note_number="+delivery_note_number+"&x=0","_blank"); 
           
           }
           
           });
          
           
        }
        
        
    });
    
	$('#btn_delivery_note_print_with_head').click(function(){
        var delivery_note_number=$('#txt_delivery_note_no').val();
       console.log("print"+delivery_note_number);
        if($.trim(delivery_note_number)=="")
        {
             $.toast({
                            heading: 'Error',
                            text: 'Please select or create delivery_note for print',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
            return false;
        }
        else
        {
           $.post("../controller/delivery_note/delivery_note_controller.php",{action:'delivery_note_status',v_delivery_note_no:delivery_note_number},function(result,status){
           var obj= jQuery.parseJSON(result);
           var v_delivery_note_status=obj.data[0].delivery_note_status;
           if(v_delivery_note_status=="Pending")
           {
                       $.toast({
                            heading: 'Error',
                            text: 'Please generate delivery_note for print',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
                 return false;
               
           }
           else
           {
              //window.open("reports/delivery_note_print_with_head.php?delivery_note_number="+delivery_note_number,"_blank"); 
			  window.open("reports/pdf/print/d_notenew.php?delivery_note_number="+delivery_note_number+"&x=0","_blank"); 
           
           }
           
           });
          
           
        }
        
        
    });
    
    
    
        function load_data_to_grid_view_cancel_delivery_note_list()
        {
                 delivery_note_cancel_view_list_table.destroy();
                     
                 delivery_note_cancel_view_list_table = $('#list_of_cancel_delivery_notes').DataTable( {
                        
                         "ajax": {
                             'type': 'POST',
                             'url': '../controller/delivery_note/delivery_note_controller.php',
                             'data': {
                                action: 'list_delivery_note_cancel_view'
                               
                                
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
                          
                             { "data": "delivery_note_main_id","visible":false },
                             { "data": "delivery_note_date"},
                             { "data": "delivery_note_number"},
                             { "data": "LPO_no"},
                             {"data": "delivery_note_main_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancel_delivery_note" name="view_cancel_delivery_note" ><i class="material-icons ">remove_red_eye</i></button>';
            								
            								return str_active_status_view;
            
            							 },
            							 
            					

					 
					         }
         
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
    
    
    
   
              
            
     $('#btn_cancel_search_date').click(function(){
         var v_delivery_note_from_date = formatDate($("#txt_cancel_start_date").val());
         var v_delivery_note_to_date = formatDate($("#txt_cancel_end_date").val());
         load_data_to_grid_view_cancel_delivery_note_list_between(v_delivery_note_from_date,v_delivery_note_to_date);
       
      });
      
      function load_data_to_grid_view_cancel_delivery_note_list_between(v_delivery_note_from_date,v_delivery_note_to_date)
     {
          delivery_note_cancel_view_list_table.destroy();
             
         delivery_note_cancel_view_list_table = $('#list_of_cancel_delivery_notes').DataTable( {
                
                 "ajax": {
                     'type': 'POST',
                     'url': '../controller/delivery_note/delivery_note_controller.php',
                     'data': {
                        action: 'list_delivery_note_cancel_view_between',
                        v_delivery_note_from_date:v_delivery_note_from_date,
                        v_delivery_note_to_date:v_delivery_note_to_date
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
                  
                     { "data": "delivery_note_main_id","visible":false },
                     { "data": "delivery_note_date"},
                     { "data": "delivery_note_number"},
                     { "data": "LPO_no"},
                     { "data": "delivery_note_main_id" ,
			 
             
                              render: function ( data, type, rows, meta ) {
    						
    									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancel_delivery_note" name="view_cancel_delivery_note" ><i class="material-icons ">remove_red_eye</i></button>';
    								
    								return str_active_status_view;
    
    							 },
    							 
    					

			 
			         }
 
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
    $('#btn_view_list_of_cancelled_delivery_note').click(function(){
        
        var v_start_date_year= new Date().getFullYear();
        $("#txt_cancel_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
        load_data_to_grid_view_cancel_delivery_note_list(); 
         
     });  
     
     
     
     
   $('#list_of_cancel_delivery_notes tbody').on('click', 'td button', function (){
          var $row = $(this).closest('tr');
            var data = delivery_note_cancel_view_list_table.row($row).data();
            v_delivery_note_number  = data.delivery_note_number;
            quotation_no=data.quotation_reference;
            
            if($(this).attr("name")=='view_cancel_delivery_note')
             {
                 
                 
            load_data_to_grid_delivery_note_list(quotation_no);
            
            $('#txt_delivery_note_description').val('');
            $('#txt_delivery_note_quantity').val('');
            $('#txt_delivery_note_unit').val('');
            
            $( '#btn_delivery_note_add' ).show();
            $( '#btn_delivery_note_edit' ).hide();
       
             // $('#div_company_select option').map(function () {
            // if ($(this).text() == data.company_name) return this;
            // }).attr('selected', 'selected');
            $("#select_company").val(data.company_id);
            $("#select_company").trigger("chosen:updated");
			   
            //$("#txt_delivery_note_company_name").val(data.company_name);
            $("#txt_delivery_note_po_box").val(data.po_box);
            $("#txt_delivery_note_contact_no").val(data.telephone_no);
            $("#txt_delivery_note_fax").val(data.fax);
            $("#txt_delivery_note_attn").val(data.attn);
            $("#txt_delivery_note_no").val(data.delivery_note_number);
            
            var del_date=data.delivery_note_date.split(' ');
            var delivery_note_date= del_date[0].split('-');
            var delivery_data=delivery_note_date[1]+'/'+delivery_note_date[0]+'/'+delivery_note_date[2];
             $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                       if(status=="success")
                       {
                           $('#div_project_select_combo option').map(function () {
                            if ($(this).text() == data.project_name) return this;
                            }).attr('selected', 'selected');
                         // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                       }
            });
            $("#txt_delivery_note_date").val(delivery_data);
             $("#div_select_quotation_combo").load('../controller/delivery_note/delivery_note_controller.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:data.project_id},function(result,status){
                 if(status=="success")
                       {
                           $('#div_select_quotation_combo option').map(function () {
                            if ($(this).text() == data.quotation_reference) return this;
                            }).attr('selected', 'selected');
                         // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                       }
             }); 
            $("#txt_delivery_note_quotation_ref").val(data.quotation_reference);
            $('#txt_delivery_note_lpo_no').val(data.LPO_no);
            //load_data_to_grid_delivery_note_list(data.delivery_note_number);
            load_data_to_grid_delivery_note_list_print(data.delivery_note_number);
          
           
            $("#txt_delivery_note_all_description").val(data.description);
            //$( '#btn_delivery_note_add' ).hide();
           // $( '#btn_delivery_note_edit' ).show();
          
            
            $("#delivery_note_no_head").html(data.delivery_note_number);
             $('#btn_generate_delivery_note' ).hide();
             $('#btn_edit_delivery_note' ).hide();
             
            
            closeNavRCancel();
             }
    });         
                 
                
             
});