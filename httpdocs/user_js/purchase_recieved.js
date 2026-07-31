$(document).ready(function(){
  
   var flag;  
   var tbl_purchase_recieve_list = $('#tbl_purchase_recieve_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
   $('#tbl_purchase_recieve_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#tbl_purchase_recieve_list tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_purchase_recieve_list.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
   });
   var list_of_purchase_recieve = $('#list_of_purchase_recieve').DataTable({searching: false, paging: false, info: false,"ordering": false});
   $('#list_of_purchase_recieve').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#list_of_purchase_recieve tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { list_of_purchase_recieve.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
   });
   
   var list_cancelled_of_purchase_recieve = $('#list_cancelled_of_purchase_recieve').DataTable({searching: false, paging: false, info: false,"ordering": false});
   $('#list_cancelled_of_purchase_recieve').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#list_cancelled_of_purchase_recieve tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { list_cancelled_of_purchase_recieve.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
   });
      
    
   
   load_supplier_select_box('div_supplier_select','select_supplier_recieve');
   function load_supplier_select_box(div_name, supplier_ctrl_name)
	{   
	  $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_supplier_name',v_supplier_ctrl_name:supplier_ctrl_name},function(result,status){});  
	}
    
	load_job_no_select('div_job_num_select','select_supplier_jobNo');
	function load_job_no_select(div_name,job_ctrl_name)
	{ 
	   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_job_no',v_job_ctrl_name:job_ctrl_name},function(result,status){});
	}
	
	
	
	var select_prn_jobNo;
	$('#div_job_num_select').change(function(){
	    select_prn_jobNo = $('#select_supplier_jobNo option:selected').text();
		load_prn_no_select('div_prno_select','select_PR_No');
	}); 
	function load_prn_no_select(div_name,pr_ctrl_name)
	{ 
	   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no', v_pr_ctrl_name:pr_ctrl_name, v_jobNo:select_prn_jobNo},function(result,status){});
	}
	
	// $('#div_prno_select').change(function(){
	 // var purchase_req_no = $('option:selected', $(this)).val();
	 // load_data_pur_rece_list_by_prno(purchase_req_no);
	// });
	
	
    
	
	load_lpo_no_select('div_lpo_select','select_lpo_no');
	function load_lpo_no_select(div_name,lpo_ctrl_name)
	{ 
	   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_LPO_no',v_lpo_ctrl_name:lpo_ctrl_name},function(result,status){});
	}
	
	
	load_unit_select('div_unit_select','select_unit_no');
	function load_unit_select(div_name,unit_ctrl_name)
	{ 
	   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_unit_no',v_qty_ctrl_name:unit_ctrl_name},function(result,status){});
	}
	
	load_tax_select('div_tax_select','select_tax_no');
	function load_tax_select(div_name, tax_ctrl_name)
	{ 
	   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_tax_no',v_tax_ctrl_name:tax_ctrl_name},function(result,status){});
	}
	
	
	
	$('#btn_pur_rece_edit').hide();
	$('#btn_pur_rece_add').click(function(){
			var supplier_id = $('#div_supplier_select option:selected').val();
			var supplier_name = $('#div_supplier_select option:selected').text();
			var job_ids = $('#select_supplier_jobNo option:selected').val();
			var job_name = $('#select_supplier_jobNo option:selected').text();
			var prn_no = $('#select_PR_No option:selected').text();
			var pur_recieve_date = formatDate($('#txt_recieve_date').val());
			var job_location = $('#txt_job_location').val();
			var requested_by = $('#txt_recieve_requested_by').val();
			var approved_by = $('#txt_recieve_approved_by').val();
			var txt_prd_no = $('#txt_prd_no').val();
			var lpo_no = $('#select_lpo_no option:selected').val();
			var bill_no = $('#txt_recieve_bill_no').val();
			
			var description = $('#txt_purchase_recieve_description').val();
			var quantity = $('#txt_purchase_recieve_quantity').val();
			var unit = $('#select_unit_no option:selected').text();
			var rate = $('#txt_purchase_recieve_rate').val();
			var tax = $('#select_tax_no option:selected').text();
		
			  if(rate=="" || rate=="0.000")
			  {
				 var v_amount = 0;
				 var net_amount = 0; 
			  }
			  else
			  {	  
				  var v_amount= (parseFloat(quantity)*parseFloat(rate));
				  var tax_amount =v_amount*(parseInt(tax)/100);
				  var net_amount = (parseFloat(v_amount)+parseFloat(tax_amount));
			  }
		  if($.trim(supplier_name)=="Select Supplier" || $.trim(job_ids)==""|| $.trim(job_name)=="Select Job No" || $.trim(prn_no)=="Select PR No" || $.trim(pur_recieve_date)=="" || $.trim(job_location)=="" || $.trim(requested_by)=="" || $.trim(approved_by)=="" || $.trim(lpo_no)=="Select LPO No" || $.trim(bill_no)=="" || $.trim(description)=="" || $.trim(quantity)=="" || $.trim(unit)=="Select Unit" || $.trim(tax)=="" )
			{
				swal("Warning","Please provide all the details ....", "warning");
				return false;
			}          
		  else
			{         
				$.post("../controller/purchase_recieve/purchase_rec_controller.php",
			    {action:'add_purchase_recieve',v_supplier_id:supplier_id, v_supplier_name:supplier_name, v_job_ids:job_ids, v_job_name:job_name, v_prn_no:prn_no, v_pur_recieve_date:pur_recieve_date, v_job_location:job_location, v_requested_by:requested_by, v_approved_by:approved_by, v_prd_no:txt_prd_no, v_lpo_no:lpo_no, v_bill_no:bill_no, v_description:description, v_quantity:quantity, v_unit:unit, v_rate:rate, v_tax:tax, v_net_amount:net_amount}, 
				function(result,status){  
				result = $.trim(result);
					if(result.charAt(0)=='U')
						{
							clearText();
							swal("Error", result, "error");
						}
					else
						{
							$('#txt_prd_no').val(result);
							$('#pur_recieve_head').html(result);
							$.toast({
								heading: 'Success',
								text: 'Item added successfully..!',
								showHideTransition: 'slide',
								icon: 'success'
							});        
							load_data_pur_rece_list(result);
							clearText();
						}
			    });
			}
	});
			
	var pur_recie_child_tbl_ids;
	$('#tbl_purchase_recieve_list tbody').on('click','button', function () {
			var $row = $(this).closest('tr');
			var data = tbl_purchase_recieve_list.row($row).data();
            var pur_recie = data.prd_no;
		    pur_recie_child_tbl_ids = data.ids;
		 if($(this).attr("name") == 'btn_edit_pur_recie')
		 {
			$('#btn_pur_rece_edit').show();
			$('#btn_pur_rece_add').hide();
			$('#txt_purchase_recieve_description').val(data.description);
			$('#txt_purchase_recieve_quantity').val(data.quantity);
			$('#select_unit_no option:selected').text(data.unit);
			$('#txt_purchase_recieve_rate').val(data.rate);
			$('#select_tax_no option:selected').text(data.tax);
		 }
		 
		 if($(this).attr("name") == 'btn_delete_pur_recie')
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
				
					    delete_pur_recie_row(pur_recie_child_tbl_ids);
						load_data_pur_rece_list(pur_recie);	 
					} else { 
					}
				 }); 
		 }
                        
    });
	
	$('#btn_pur_rece_edit').click(function(){
		var txt_prd_no = $('#txt_prd_no').val();
		var description = $('#txt_purchase_recieve_description').val();
		var quantity = $('#txt_purchase_recieve_quantity').val();
		var unit = $('#select_unit_no option:selected').text();
		var rate = $('#txt_purchase_recieve_rate').val();
		var tax = $('#select_tax_no option:selected').text();
		  if(rate=="" || rate=="0.000")
		  {
			 var v_amount = 0;
			 var net_amount = 0; 
		  }
		  else
		  {	  
			  var v_amount= (parseFloat(quantity)*parseFloat(rate));
			  var tax_amount =v_amount*(parseInt(tax)/100);
			  var net_amount = (parseFloat(v_amount)+parseFloat(tax_amount));
		  }
		  if($.trim(description)=="" || $.trim(quantity)=="" || $.trim(unit)=="Select Unit" || $.trim(tax)=="")
		  {
			 swal("Warning","Please provide all the details...", "warning");
			 return false; 
		  }
		  else
		  {
			$.post("../controller/purchase_recieve/purchase_rec_controller.php",
			 {action:'edit_purchase_recieve', v_description:description, v_quantity:quantity, v_unit:unit, v_rate:rate, v_tax:tax, v_net_amount:net_amount, v_prd_no:txt_prd_no}, 
				function(result,status){  
				result = $.trim(result);
				alert(result);
				if(result>=1)
				{
					$.toast({
						heading: 'Success',
						text: 'Purchase Requisition Updated successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
					load_data_pur_rece_list(txt_prd_no);	
					$('#btn_pur_rece_add').show();
                    $('#btn_pur_rece_edit').hide();
					clearText(); 
				}
                else
                {
					swal("Error", result, "error");
					clearText();
				}					
			}); 
		  }
	});
	
	
	$('#btn_generate_edit_pur_recie').hide();
	$('#btn_generate_pur_recie').click(function(){
		common_insert();
	});
	
	$('#btn_generate_edit_pur_recie').click(function(){
	   common_insert();
	});
	
	$('#btn_create_new_precieved').click(function(){
		 location.reload(); 
	});
	
	$('#btn_view_list_of_pur_reci').click(function(){
		purchase_recieve_list();
	});
	
	$('#btn_view_list_of_cancelled_prs').click(function(){
	   load_cancelled_purchase_recieve();
	});
	
	$('#list_of_purchase_recieve tbody').on('click','button', function () {
			var $row = $(this).closest('tr');
			var data = list_of_purchase_recieve.row($row).data();
            var pur_recie = data.prd_no;
		    var main_tbl = data.ids;
			var supplier_ids = data.supplier_id;
			var job_ids = data.work_order_id;
			var pr_no = data.purchase_req_no;
			var date = data.purchase_recieved_date;
			var job_location = data.job_location;
			var requested_by = data.requested_by;
			var approved_by = data.approved_by;
			var lpo = data.lpo_no;
			var bill_no = data.bill_no;
			clearText();
		    $('#btn_pur_rece_add').show();
		    $('#btn_pur_rece_edit').hide();   
		 if($(this).attr("name") == 'view_pur_recie_list')
		 {
			load_data_pur_rece_list(pur_recie);
			closeNavR();
            $('#txt_prd_no').val(pur_recie);	
		    $('#select_supplier_recieve').val(supplier_ids);
			$('#select_supplier_recieve').trigger('change');
			$('#select_supplier_jobNo').val(job_ids);
			$('#select_supplier_jobNo').trigger('change');		
            $('#select_PR_No').val(pr_no);	
            $('#select_PR_No').trigger('change');
            $('#txt_recieve_date').val(date);
            $('#txt_job_location').val(job_location);		
            $('#txt_recieve_requested_by').val(requested_by);			
			$('#txt_recieve_approved_by').val(approved_by);
			$('#select_lpo_no').val(lpo);
			$('#select_lpo_no').trigger('change');
			$('#txt_recieve_bill_no').val(bill_no);
		 }
		 
		 if($(this).attr("name") == 'cancel_pur_recie_list')
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
				
					    cancel_pur_recie_list(main_tbl);
						purchase_recieve_list();	 
					} else { 
					}
				 }); 
		 }
                        
    });
	
	
	$('#list_cancelled_of_purchase_recieve tbody').on('click','button', function () {
			var $row = $(this).closest('tr');
			var data = list_cancelled_of_purchase_recieve.row($row).data();
            var pur_recie = data.prd_no;
			clearText();
		    $('#btn_pur_rece_add').show();
		    $('#btn_pur_rece_edit').hide();   
		 if($(this).attr("name") == 'view_cancelled_pur_recie_list')
		 {
			load_data_pur_rece_list(pur_recie);
			closeNavRCancel(); 
		 }          
    });
	
    //date searching
	$('#btn_view_search_date').click(function(){
		var txt_view_start_date = formatDate($('#txt_view_start_date').val());
		var txt_view_end_date = formatDate($('#txt_view_end_date').val());
	    purchase_recieve_list_between(txt_view_start_date, txt_view_end_date);
	});
	$('#btn_search_cancel_date').click(function(){
		var txt_cancel_start_date = formatDate($('#txt_cancel_start_date').val());
		var txt_cancel_end_date = formatDate($('#txt_cancel_end_date').val());
		load_cancelled_purchase_recieve_between(txt_cancel_start_date, txt_cancel_end_date);
	}); 	
	
	$('#btn_pur_recie_without_head').click(function(){
		var txt_prd_no = $('#txt_prd_no').val();
		if($.trim(txt_prd_no)=="")
		{
			$.toast({
				heading: 'Error',
				text: 'Please select or create PR',
				showHideTransition: 'slide',
				icon: 'error'
			});
            return false;
		}
		else
		{
			$.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'purchase_recieve_status', v_prn_no:txt_prd_no},function(result,status){
                var obj = jQuery.parseJSON(result);
                var v_pr_status = obj.data[0].purchase_received_status;
				   if(v_pr_status=="Pending")
				   {
						$.toast({
							heading: 'Error',
							text: 'Please generate PR',
							showHideTransition: 'slide',
							icon: 'error'
						});
						return false;   
				   }
				   else
				   {
					  window.open("reports/pur_recie_without_head.php?pur_recie_number="+txt_prd_no,"_blank"); 
				   }
                       
            });
		}
	});
	
	$('#btn_pur_recie_with_head').click(function(){
		var txt_prd_no = $('#txt_prd_no').val();
		if($.trim(txt_prd_no)=="")
		{
			$.toast({
				heading: 'Error',
				text: 'Please select or create PR',
				showHideTransition: 'slide',
				icon: 'error'
			});
            return false;
		}
		else
		{
			$.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'purchase_recieve_status', v_prn_no:txt_prd_no},function(result,status){
                var obj = jQuery.parseJSON(result);
                var v_pr_status = obj.data[0].purchase_received_status;
				   if(v_pr_status=="Pending")
				   {
						$.toast({
							heading: 'Error',
							text: 'Please generate PR',
							showHideTransition: 'slide',
							icon: 'error'
						});
						return false;   
				   }
				   else
				   {
					  window.open("reports/pur_recie_with_head.php?pur_recie_number="+txt_prd_no,"_blank"); 
				   }
                       
            });
		}
	});
	
	$('#list_pr_sidenav').click(function(){
	   $('#txt_view_start_date').val('');
	   $('#txt_view_end_date').val('');
	});
	
	$('#btn_canceled_pr_list').click(function(){
		$('#txt_cancel_start_date').val('');
		$('#txt_cancel_end_date').val('');
	});
	
	
	//-- common functions ---//
	function load_data_pur_rece_list(purchase_recieve_no)
    {  
                    tbl_purchase_recieve_list.destroy();     
                    tbl_purchase_recieve_list = $('#tbl_purchase_recieve_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
                                 'data': {
                                    action: 'list_purchase_recieve',
                                    v_purchase_recieve_no:purchase_recieve_no
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
                               header: false,
                               footer: false
                            },
                            "columns": [
							     { "data": "ids"},
                                 { "data": "description"},
                                 { "data": "quantity"},
                                 { "data": "unit"},
                                 { "data": "rate"},
								 { "data": "tax"},
            					 { "data": "amount"},
							     { "data": null,
								     render: function ( data, type, rows, meta ) 
									   {
            						
            								action_pur_recie = ' <button type="button" class="btn btn-sm primary-gradient mr-1" name="btn_edit_pur_recie"><i class="material-icons">edit</i></button>';
            								
            								return action_pur_recie;
            
            							},
								 },
								 {"data": null,
								     render: function ( data, type, rows, meta ) 
									   {
            						
            								action_pur_recie = '<button type="button" class="btn btn-sm btn-danger mr-1" name="btn_delete_pur_recie"><i class="material-icons">delete</i></button>';
            								
            								return action_pur_recie;
            
            							},
								 },
                             ],
							 pageLength: 25,
            				 searching: false,
                            // responsive: true,
            			
                             "initComplete": function( settings, json ) {

                              },
                              "fnDrawCallback": function() {
             
                             },
                             
                              "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                                 return nRow;
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
                                .column( 6 )
                                .data()
                                .reduce( function (a, b) {
                                    
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Total over this page Income
                            pageTotal1 = api
                                .column( 6, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Update footer
                            $( api.column( 6 ).footer() ).html(
                                pageTotal1.toFixed(3)
                            );
                           
						}
                    });
	    	
    }	
	
	function load_data_pur_rece_list_by_prno(purchase_recieve_no)
    {  
                    tbl_purchase_recieve_list.destroy();     
                    tbl_purchase_recieve_list = $('#tbl_purchase_recieve_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
                                 'data': {
                                    action: 'list_purchase_recieve_by_prno',
                                    v_purchase_recieve_no:purchase_recieve_no
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
                               header: false,
                               footer: false
                            },
                            "columns": [
							     { "data": "ids"},
                                 { "data": "description"},
                                 { "data": "quantity"},
                                 { "data": "unit"},
                                 { "data": "rate"},
								 { "data": "tax"},
            					 { "data": "amount"},
							     { "data": null,
								     render: function ( data, type, rows, meta ) 
									   {
            						
            								action_pur_recie = ' <button type="button" class="btn btn-sm primary-gradient mr-1" name="btn_edit_pur_recie"><i class="material-icons">edit</i></button>';
            								
            								return action_pur_recie;
            
            							},
								 },
								 {"data": null,
								     render: function ( data, type, rows, meta ) 
									   {
            						
            								action_pur_recie = '<button type="button" class="btn btn-sm btn-danger mr-1" name="btn_delete_pur_recie"><i class="material-icons">delete</i></button>';
            								
            								return action_pur_recie;
            
            							},
								 },
                             ],
							 pageLength: 25,
            				 searching: false,
                            // responsive: true,
            			
                             "initComplete": function( settings, json ) {

                              },
                              "fnDrawCallback": function() {
             
                             },
                             
                              "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                                 return nRow;
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
                                .column( 6 )
                                .data()
                                .reduce( function (a, b) {
                                    
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Total over this page Income
                            pageTotal1 = api
                                .column( 6, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Update footer
                            $( api.column( 6 ).footer() ).html(
                                pageTotal1.toFixed(3)
                            );
                           
						}
                    });
	    	
    }
	
	function delete_pur_recie_row(pur_recie_child_ids)
    {           
		$.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'delete_pur_recie_item',v_pur_recie_child_id:pur_recie_child_ids},
		function(result,status){});       
    }
	
	function cancel_pur_recie_list(ids)
	{
		$.post('../controller/purchase_recieve/purchase_rec_controller.php',{action:"pur_recie_status_to_cancel", cancel_ids:ids},function(){result,status})
	}
	
	
	function purchase_recieve_list()
    {
		flag = 0;
        list_of_purchase_recieve.destroy();              
        list_of_purchase_recieve = $('#list_of_purchase_recieve').DataTable( {
                            
			 "ajax": {
				 'type': 'POST',
				 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
				 'data': {
					action: 'list_table_pur_recie',
					
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
			  
				 { "data": "ids","visible":false },
				 { "data": "purchase_recieved_date"},
				 { "data": "supplier_name"},
				 { "data": "purchase_req_no"},
				 { "data": "prd_no"},
				 { "data": "lpo_no"},
				 { "data": "work_order_no"},
				 { "data": "job_location"},
				 { "data": "bill_no"},
				 { "data": null ,
						  render: function ( data, type, rows, meta ) 
							{
								action_pur_recie = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" name="view_pur_recie_list" ><i class="material-icons ">remove_red_eye</i></button>';
								return action_pur_recie;
							},
				 },
				 { "data": null ,
						  render: function ( data, type, rows, meta )
							{
								action_pur_recie = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" name="cancel_pur_recie_list" ><i class="material-icons ">delete</i></button>';
								return action_pur_recie;
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
	
	function purchase_recieve_list_between(startDate, endDate)
    {
		flag = 1;
        list_of_purchase_recieve.destroy();              
        list_of_purchase_recieve = $('#list_of_purchase_recieve').DataTable( {
                            
			 "ajax": {
				 'type': 'POST',
				 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
				 'data': {
					action: 'list_table_pur_recie_view_between',
					v_startDate:startDate,
					v_endDate:endDate
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
			  
				 { "data": "ids","visible":false },
				 { "data": "purchase_recieved_date"},
				 { "data": "supplier_name"},
				 { "data": "purchase_req_no"},
				 { "data": "prd_no"},
				 { "data": "lpo_no"},
				 { "data": "work_order_no"},
				 { "data": "job_location"},
				 { "data": "bill_no"},
				 { "data": null ,
						  render: function ( data, type, rows, meta ) 
							{
								action_pur_recie = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" name="view_pur_recie_list" ><i class="material-icons ">remove_red_eye</i></button>';
								return action_pur_recie;
							},
				 },
				 { "data": null ,
						  render: function ( data, type, rows, meta )
							{
								action_pur_recie = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" name="cancel_pur_recie_list" ><i class="material-icons ">delete</i></button>';
								return action_pur_recie;
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
	
	function load_cancelled_purchase_recieve()
	{	
		flag = 0;
        list_cancelled_of_purchase_recieve.destroy();              
        list_cancelled_of_purchase_recieve = $('#list_cancelled_of_purchase_recieve').DataTable( {
                            
			 "ajax": {
				 'type': 'POST',
				 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
				 'data': {
					action: 'list_table_cancelled_pur_recie',
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
			  
				 { "data": "ids","visible":false },
				 { "data": "purchase_recieved_date"},
				 { "data": "supplier_name"},
				 { "data": "purchase_req_no"},
				 { "data": "prd_no"},
				 { "data": "lpo_no"},
				 { "data": "work_order_no"},
				 { "data": "job_location"},
				 { "data": "bill_no"},
				 { "data": null ,
					  render: function ( data, type, rows, meta ) 
						{
							action_pur_recie = '<button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancelled_pr_list" name="view_cancelled_pur_recie_list" ><i class="material-icons ">remove_red_eye</i></button>';
							return action_pur_recie;
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
	
	function load_cancelled_purchase_recieve_between(startDate, endDate)
	{	
		flag = 1;
        list_cancelled_of_purchase_recieve.destroy();              
        list_cancelled_of_purchase_recieve = $('#list_cancelled_of_purchase_recieve').DataTable( {
                            
			 "ajax": {
				 'type': 'POST',
				 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
				 'data': {
					action: 'list_table_cancelled_pur_recie_between',
					v_startDate:startDate,
					v_endDate:endDate
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
			  
				 { "data": "ids","visible":false },
				 { "data": "purchase_recieved_date"},
				 { "data": "supplier_name"},
				 { "data": "purchase_req_no"},
				 { "data": "prd_no"},
				 { "data": "lpo_no"},
				 { "data": "work_order_no"},
				 { "data": "job_location"},
				 { "data": "bill_no"},
				 { "data": null ,
					  render: function ( data, type, rows, meta ) 
						{
							action_pur_recie = '<button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancelled_pr_list" name="view_cancelled_pur_recie_list" ><i class="material-icons ">remove_red_eye</i></button>';
							return action_pur_recie;
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
	
	function clearText()
	{
		$('#txt_purchase_recieve_description').val('');
		$('#txt_purchase_recieve_quantity').val('');
		$('#select_unit_no option:selected').text('Select Unit');
		$('#txt_purchase_recieve_rate').val('');
		$('#select_tax_no option:selected').text('10.00');
	}
	
	function common_insert()
	{
		var supplier_id = $('#div_supplier_select option:selected').val();
		var supplier_name = $('#div_supplier_select option:selected').text();
		var job_ids = $('#select_supplier_jobNo option:selected').val();
		var job_name = $('#select_supplier_jobNo option:selected').text();
		var prn_no = $('#select_PR_No option:selected').text();
		var pur_recieve_date = formatDate($('#txt_recieve_date').val());
		var job_location = $('#txt_job_location').val();
		var requested_by = $('#txt_recieve_requested_by').val();
		var approved_by = $('#txt_recieve_approved_by').val();
		var txt_prd_no = $('#txt_prd_no').val();
		var lpo_no = $('#select_lpo_no option:selected').val();
		var bill_no = $('#txt_recieve_bill_no').val();
		if($.trim(supplier_name)=="Select Supplier" || $.trim(job_ids)==""|| $.trim(job_name)=="Select Job No" || $.trim(prn_no)=="Select PR No" || $.trim(pur_recieve_date)=="" || $.trim(job_location)=="" || $.trim(requested_by)=="" || $.trim(approved_by)=="" || $.trim(lpo_no)=="Select LPO No" || $.trim(bill_no)=="")
		{
			swal("Warning","Please provide all the details ....", "warning");
			return false;
		}          
		else
		{         
			$.post("../controller/purchase_recieve/purchase_rec_controller.php",
			{action:'generate_purchase_recieve',v_supplier_id:supplier_id, v_supplier_name:supplier_name, v_job_ids:job_ids, v_job_name:job_name, v_prn_no:prn_no, v_pur_recieve_date:pur_recieve_date, v_job_location:job_location, v_requested_by:requested_by, v_approved_by:approved_by, v_prd_no:txt_prd_no, v_lpo_no:lpo_no, v_bill_no:bill_no}, 
			function(result,status){  
			result = $.trim(result);
				swal("Success","Generated successfully", "success"); 
				$('#btn_generate_pur_recie').prop('disabled', true);
				$('#btn_generate_edit_pur_recie').show();
			});
		}
	}
	
});