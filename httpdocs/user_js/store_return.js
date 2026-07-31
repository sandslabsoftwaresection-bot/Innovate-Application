$(document).ready(function(){
    // var tbl_store_return = $('#tbl_store_return_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
 
 
  var tbl_store_return = $('#tbl_store_return_list').DataTable({
        searching: false,
        paging: false,
        info: false,
        ordering: false,
        columnDefs: [
            { targets: [3, 5], visible: false } // Adjust column indices as needed
        ]
    });
    
    var store_return_list_view = $('#list_of_store_return').DataTable( {searching: false, paging: false, info: false,"ordering": false});
     $('#list_of_store_return').removeClass( 'display' ).addClass('table table-striped table-bordered');
      $('#list_of_store_return tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) 
                    { $(this).removeClass('selected');
                    } 
                    else {
                        store_return_list_view.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); 
                        
                        }
                 }); 
     
    var counter = 1;
    $('#div_company_select').load('templates/company_combo.php');
     $("#div_company_select").change(function() {
                      
                            $('#txt_invoice_company_name').val($('option:selected', this).text()) ;
                            $('#txt_invoice_company_id').val($('option:selected', this).val()) ;
                            var company_id=$('option:selected', this).val() ;
                            
                           
                                        $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:company_id},function(result,status){
                                    
                                       });
                                        
                                        
                            });  
                            
                            
    	$('#div_category_load_pur_recie').load('templates/inventory_category_load_com.php');
    		$("#div_category_load_pur_recie").change(function(){
                      
                      var v_cat_id=  $( "#select_iventory_category option:selected" ).val();
					  
		              var v_category= $( "#select_iventory_category option:selected" ).text();
					 
					  $("#div_item_load_pur_recie").load("templates/inventory_item_code_load_com.php?category_id="+v_cat_id);
					
					  
				 });
				 
		$("#txt_return_rate, #txt_return_quantity").change(function() {
	        var v_qty = $('#txt_return_quantity').val();
	        var v_rate = $('#txt_return_rate').val();
	        if(v_qty==''){
	            v_qty=0;
	        }
	        if(v_rate==''){
	            v_rate=0;
	        }
	        var v_amount=parseFloat(v_qty)*parseFloat(v_rate);
	        $('#txt_return_amount').val(v_amount);
		});
	
        $('#btn_store').on('click', function() {
        // Retrieve values from input fields 
        var company_id = $('#select_company option:selected').val();
        var project_id = $('#select_project option:selected').val();
        var v_ref_no = $('#txt_ref_no').val();
        var v_date = $('#txt_return_date').val();
        var v_recieved_by = $('#txt_recieved_by').val();
        
        
        var description = $('#txt_return_description').val();
        var category = $('#select_iventory_category option:selected').text();
        var categoryid=$('#select_iventory_category option:selected').val();
        var item = $('#select_iventory_item option:selected').text();
        var itemid = $('#select_iventory_item option:selected').val();
        var qty = $('#txt_return_quantity').val();
        var unit = $('#select_unit option:selected').text();
        var unit_id = $('#select_unit option:selected').val();
        var rate = $('#txt_return_rate').val();
        var amount = $('#txt_return_amount').val();
        var taxPercentage = $('#txt_tax_percentage').val();
            if(company_id<=0 || project_id<=0 || v_ref_no=='' || v_date=='' || v_recieved_by=='' || description=='' || categoryid<=0 || itemid<=0 || qty=='' || unit_id<=0 || rate=='')
               {
                  swal("Warning","Please provide all the details ....", "warning");
				return false; 
               }
               else
               {
                // Add a new row to the DataTable
                tbl_store_return.row.add([
                    counter++,
                    description,
                    category,
                    categoryid,
                    item,
                    itemid,
                    qty,
                    unit,
                    rate,
                    amount,
                    taxPercentage,
                    'Delete' // Delete button (you can add functionality later)
                ]).draw();
                
                    $('#txt_return_description').val('');
                    $('#select_iventory_category').val('');
                    $('#select_iventory_item').val('');
                    $('#txt_return_quantity').val('');
                    $('#select_unit').val('');
                    $('#txt_return_rate').val('');
                    $('#txt_return_amount').val('');
                    $('#txt_tax_percentage').val('');
               }
    });
    
    
    
    $('#btn_generate_return').on('click', function() {
    // Array to store data
    var dataArray = [];

    // Iterate through each row in the DataTable
    tbl_store_return.rows().every(function() {
        var data = this.data();
         var itemParts = data[4].split(' / ');
        var itemName = itemParts[0].trim();
        var itemCode = itemParts[1].trim();

        dataArray.push({
            'Counter': data[0],
            'Description': data[1],
            'Category': data[2],
            'CategoryID': data[3],
            'ItemName': itemName,
            'ItemCode': itemCode,
            'ItemID': data[5],
            'Qty': data[6],
            'Unit': data[7],
            'Rate': data[8],
            'Amount': data[9],
            'TaxPercentage': data[10]
            // Add other properties as needed
        });
    });

    // Log the resulting array to the console (you can perform any further actions here)
    console.log(dataArray);
        var company_name = $('#select_company option:selected').text();
         var company_id = $('#select_company option:selected').val();
         var project_name = $('#select_project option:selected').text();
        var project_id = $('#select_project option:selected').val();
        var v_ref_no = $('#txt_ref_no').val();
        var v_date = formatDate($('#txt_return_date').val());
        var v_recieved_by = $('#txt_recieved_by').val();
        	
        	if(company_id<=0 || project_id<=0 || v_ref_no=='' || v_date=='' || v_recieved_by=='')
               {
                  swal("Warning","Please provide all the details ....", "warning");
				return false; 
               }
               else
               {
        	
                	$.post("../controller/purchase_recieve/purchase_rec_controller.php",
        			{action:'generate_store_return', company_name:company_name,company_id:company_id,project_name:project_name,project_id:project_id,v_ref_no:v_ref_no,v_date:v_date,v_recieved_by:v_recieved_by,array_table_data:dataArray}, 
        			function(result,status){  
        			result = $.trim(result);
        				swal("Success","Return added to the store successfully", "success"); 
        				// $('#btn_generate_pur_recie').prop('disabled', true);
        				// $('#btn_generate_edit_pur_recie').show();
        			});
        			
               }
});


        $('#btn_view_list_of_return').click(function(){
                    
					var v_start_date_year= new Date().getFullYear();
                    // $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                     var today = new Date();

                        // Get the starting date of the year
                        var startOfYear = new Date(today.getFullYear(), 0, 1);
                        today= formatDate(today);
                        startOfYear = formatDate(startOfYear);
                    load_data_to_store_return_list(startOfYear,today); 
                     
        });  
        
        	   function load_data_to_store_return_list(v_from_date,v_to_date)
                 {
                      store_return_list_view.destroy();
                         
                     store_return_list_view = $('#list_of_store_return').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
                                 'data': {
                                    action: 'list_store_return_view',
                                    v_startDate:v_from_date,
                                    v_endDate:v_to_date
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
                              
                                 { "data": "ids",visible:false},
                                 { "data": "recieved_date"},
                                 { "data": "company_name", visible:false},
                                 { "data": "inventory_name"},
                                 { "data": "project_name"},
                                 { "data": "ids",
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_invoice" name="view_invoice" ><i class="material-icons ">remove_red_eye</i></button>';
                								
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
							 "drawCallback": function ( settings ) {
								var api = this.api();
								var rows = api.rows( {page:'current'} ).nodes();
								var last=null;
					 
								api.column(2, {page:'current'} ).data().each( function ( group, i ) {
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
				 
	   
      	function formatDate(date) 
	{
		 var d = new Date(date),
			 month = '' + (d.getMonth() + 1),
			 day = '' + d.getDate(),
			 year = d.getFullYear();
	
		 if (month.length < 2) month = '0' + month;
		 if (day.length < 2) day = '0' + day;
	
		 return [year, month, day].join('-');
    }
	 
	$('#btn_search_date').click(function(){
                     var v_invoice_from_date = formatDate($("#txt_start_date").val());
                     var v_invoice_to_date = formatDate($("#txt_end_date").val());
                     load_data_to_store_return_list(v_invoice_from_date,v_invoice_to_date);
                    
    }); 
	$('#list_of_store_return tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = store_return_list_view.row($row).data();
                       
                        // v_invoice_number  = data.invoice_number;
                        // $('#txt_invoice_description').val('');
                        // $('#txt_invoice_quantity').val('');
                        // $('#txt_invoice_unit').val('');
                        // $('#txt_invoice_rate').val('');
                        // $('#txt_invoice_amount').val('');
                        // $( '#btn_invoice_add' ).show();
                        // $( '#btn_invoice_edit' ).hide();
                        
                         if($(this).attr("name")=='view_invoice')
                         {
                       
                            // $('#div_company_select option').map(function () {
                            // if ($(this).text() == $.trim(data.company_name)) return this;
                            // }).attr('selected', 'selected');
    						$("#select_company").val(data.company_id);
                            $("#select_company").trigger("chosen:updated");
                             $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                                    
                                       
                                     $('#div_project_select_combo option').map(function () {
                                                if ($(this).text() == $.trim(data.project_name)) return this;
                                                }).attr('selected', 'selected');
                                                
                             });
                            $("#txt_ref_no").val(data.ref_no);
                            $("#txt_return_date").val(data.recieved_date);
                            $("#txt_recieved_by").val(data.recieved_name);
                            $("#txt_return_description").val(data.description);
                            $("#txt_return_quantity").val(data.quantity);
                            $("#txt_return_rate").val(data.rate);
                            $("#txt_return_amount").val(data.amount);
                        //     $('#txt_invoice_discount_amount').val(data.total_discount_amount);
                        //   // $('#txt_hidden_discount_type').val(data.discount_type);
                        //     $('#txt_hidden_discount_amount').val(data.discount_amount);
                        //     $('#txt_discount_amount_qt').val(data.discount_amount);
                         }
                         closeNavR();
	});
	           
                 
});