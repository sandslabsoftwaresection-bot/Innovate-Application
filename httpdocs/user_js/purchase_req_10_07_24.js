$(document).ready(function(){
 	
	var flag;
    var tbl_purchase_req_list = $('#tbl_purchase_req_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
	var list_of_prs = $('#list_of_prs').DataTable( {searching: true, paging: true, info: true,"ordering": false});
	var list_of_cancelled_prs = $('#list_of_cancelled_prs').DataTable( {searching: false, paging: false, info: false,"ordering": false});
	
	$('#tbl_purchase_req_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
	$('#list_of_prs').removeClass( 'display' ).addClass('table table-striped table-bordered');
	$('#list_of_cancelled_prs').removeClass( 'display' ).addClass('table table-striped table-bordered');
	$('#tbl_purchase_req_list tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_purchase_req_list.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
    });
	$('#div_supplier_select').load('templates/supplier_combo.php');
	
	load_supplier_select_box('div_supplier_select','select_supplier');
    function load_supplier_select_box(div_name, supplier_ctrl_name)
    {   
      $("#"+div_name).load('../controller/purchase_requisition/purchase_req_controller.php',{action:'select_company_name',v_supplier_ctrl_name:supplier_ctrl_name},function(result,status){});  
    }
    
	$('#div_supplier_select').change(function(){
		var suppier_ids = $('option:selected', this).val();
		$.post("../controller/purchase_requisition/purchase_req_controller.php",{action:'fetch_company_details', v_suppier_ids:suppier_ids},function(result,status){
                        
			if(status=="success")
			{
				var obj= jQuery.parseJSON(result);
				 console.log(obj.data[0].company_name);
				$("#txt_pr_supplier_id").val(obj.data[0].company_id);
				$("#txt_pr_supplier_name").val(obj.data[0].company_name);
				$("#txt_pr_address_box").val(obj.data[0].contact_address_2);
				$("#txt_pr_contact_no").val(obj.data[0].contact_phone);
				$("#txt_pr_fax").val(obj.data[0].fax);
			}
			else
			{
				return false;
			}
        });           
	});
		
	//load_job_no_select('div_job_num_select','select_jobNo');
	function load_job_no_select(div_name,ctrl_name)
	{ 

	   $("#"+div_name).load('../controller/purchase_requisition/purchase_req_controller.php',{action:'select_job_no',v_ctrl_name:ctrl_name},function(result,status){});

	}
	
	$('#div_item_load').load('templates/iventory_item_combo.php');
				
	load_unit_select('div_unit_select','select_unit');
	function load_unit_select(div_name,unit_ctrl_name)
	{ 

	   $("#"+div_name).load('../controller/purchase_requisition/purchase_req_controller.php',{action:'select_unit',v_unit_ctrl_name:unit_ctrl_name},function(result,status){});

	}
	
	load_tax('div_tax_select','select_tax');
	function load_tax(div_name,tax_ctrl_name)
	{
		$("#"+div_name).load('../controller/purchase_requisition/purchase_req_controller.php',{action:'select_tax',v_tax_ctrl_name:tax_ctrl_name},function(result,status){});
	}
	
	$('#div_item_load').change(function(){
	  $('#txt_iventory_purchase_req_id').val($('option:selected', this).val());
	  $('#txt_iventory_purchase_req_name').val($('option:selected', this).text());
	});

	$('#btn_pr_edit').hide();
	$('#btn_pr_add').click(function(){
	 
	  var supplier_id = $('#txt_pr_supplier_id').val();
	  var supplier_name = $('#txt_pr_supplier_name').val();
	  var purchase_req_no = $('#txt_pr_no').val();
	  var requsition_date = formatDate($("#txt_local_po_date").val());
	  var requested_by = $('#txt_requested_by').val();
	  var approved_by = $('#txt_approved_by').val();
	  var txt_job_No = $('#txt_job_No').val();
	  //var work_order_id = $('#select_jobNo option:selected').val();
	  //var work_order_no = $('#select_jobNo option:selected').text();
	  // if(work_order_no=="Select Job No")
	  // {
		// work_order_no = 'NA';  
	  // }
	  var inventory_item_id =  $('#txt_iventory_purchase_req_id').val(); 	
	  var inventory_item_name = $('#txt_iventory_purchase_req_name').val();
	  
	  var pr_decription = $('#txt_pr_description').val();
	  var pr_qnty = $('#txt_pr_quantity').val();
	  var pr_unit = $('#select_unit option:selected').text();
	  var pr_rate = $('#txt_pr_rate').val();
	  var pr_tax = $('#select_tax option:selected').text();
	  
	  if(pr_rate=="" || pr_rate=="0.000")
	  {
		 var v_amount = 0;
		 var net_amount = 0; 
	  }
      else
	  {	  
		  var v_amount= (parseFloat(pr_qnty)*parseFloat(pr_rate));
		  var tax_amount =v_amount*(parseInt(pr_tax)/100);
		  var net_amount = (parseFloat(v_amount)+parseFloat(tax_amount));
	  }
	  if($.trim(inventory_item_name)==""||$.trim(supplier_name)=="Select Supplier"||$.trim(requsition_date)==""||$.trim(requested_by)==""|| $.trim(approved_by)==""||$.trim(inventory_item_id)=="0"||$.trim(pr_decription)==""||$.trim(pr_qnty)==""||$.trim(pr_unit)==""||$.trim(pr_tax)=="")
		{
			swal("Warning","Please provide all the details ....", "warning");
			return false;
		}          
		else
		{         
			$.post("../controller/purchase_requisition/purchase_req_controller.php",
			 {action:'add_purchase_requisition',v_supplier_id:supplier_id, v_supplier_name:supplier_name, v_purchase_req_no:purchase_req_no, v_requsition_date:requsition_date, v_requested_by:requested_by, v_approved_by:approved_by, v_work_order_no:txt_job_No, v_inventory_item_id:inventory_item_id, v_inventory_item_name:inventory_item_name, v_pr_decription:pr_decription, v_pr_qnty:pr_qnty, v_pr_unit:pr_unit, v_pr_rate:pr_rate, v_pr_tax:pr_tax, v_net_amount:net_amount}, 
				function(result,status){  
				result = $.trim(result);
				if(result.charAt(0)=='U')
					{
						clearText();
						swal("Error", result, "error");
					}
				else
					{
						$('#txt_pr_no').val(result);
						$.toast({
							heading: 'Success',
							text: 'Item added successfully..!',
							showHideTransition: 'slide',
							icon: 'success'
						});  
                        load_unit_select('div_unit_select','select_unit');	
                        load_tax('div_tax_select','select_tax');	
                        $('#div_item_load').load('templates/iventory_item_combo.php');						
						load_data_to_grid_pr_list(result); 
						clearText();
					}
			});
		}
	  
	});
	
	var pr_child_tbl_ids;
	$('#tbl_purchase_req_list tbody').on('click','button', function () {
        var $row = $(this).closest('tr');
        var data = tbl_purchase_req_list.row($row).data();
        var pr_no = data.purchase_requsition_no;
		pr_child_tbl_ids = data.ids;
		 if($(this).attr("name") == 'btn_edit_pr')
		 {
			$('#btn_pr_edit').show();
			$('#btn_pr_add').hide();
			
			$('#txt_iventory_purchase_req_id').val(data.inventory_id);
			$('#txt_iventory_purchase_req_name').val(data.inventory_name);
			
			$('#txt_pr_description').val(data.description);
			$('#txt_pr_quantity').val(data.quantity);
			$('#select_unit option:selected').text(data.unit);
			$('#txt_pr_rate').val(data.rate);
			$('#select_tax option:selected').text(data.tax);
		 }
		 
		 if($(this).attr("name") == 'btn_delete_pr')
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
				
					    delete_pr_row(pr_child_tbl_ids);
						load_unit_select('div_unit_select','select_unit');	
                        load_tax('div_tax_select','select_tax');
						load_data_to_grid_pr_list(pr_no);		 
					} else {
						
					   
					 
					}
				 }); 
		 }
                        
    });
	
	$('#list_of_prs tbody').on('click', 'td button', function (){
        var $row = $(this).closest('tr');
        var data = list_of_prs.row($row).data();
        var pr_no = data.purchase_req_no;
		var main_tbl_ids = data.ids;
		var supplier_ids = data.supplier_id;
		var work_order_no = data.work_order_no;
		clearText();
		$('#btn_pr_add').show();
		$('#btn_pr_edit').hide();   
		
		if($(this).attr("name")=='view_pr_list')
		{
	        load_data_to_grid_pr_list(pr_no);
			closeNavR();	
            $('#txt_pr_no').val(pr_no);	
		    $('#select_company').val(supplier_ids);
			$('#select_company').trigger("chosen:updated");
			$('#txt_job_No').val(work_order_no);
			// $('#txt_pr_address_box').val(data.contact_address_2);
			// $('#txt_pr_contact_no').val(data.txt_pr_contact_no);
			
			// $('#select_jobNo').val(work_order_id);
		//	$('#select_jobNo').trigger('change');
		}
		if($(this).attr("name")=='cancel_pr_list')
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
				if (willDelete) 
				{
				 $.post('../controller/purchase_requisition/purchase_req_controller.php',{action:"cancel_pr_data", cancel_ids:main_tbl_ids},function(result){});
				 load_data_to_grid_view_pr_list(); 
				} else {  
				 
				}
			 });   		
		}
    });
	
	
	$('#list_of_cancelled_prs tbody').on('click', 'td button', function (){
		var $row = $(this).closest('tr');
        var data = list_of_cancelled_prs.row($row).data();
        var pr_no = data.purchase_req_no;
		clearText();
		$('#btn_pr_add').show();
		$('#btn_pr_edit').hide(); 	
		if($(this).attr("name")=='view_cancelled_pr_list')
		{
	       load_data_to_grid_pr_list(pr_no);
		   $('#select_company').val(supplier_ids);
			$('#select_company').trigger("chosen:updated");
		   closeNavRCancel();	 
		} 
    });


	$('#btn_pr_edit').click(function(){
		
      var purchase_req_no = $('#txt_pr_no').val();
	  var inventory_item_id = $('#txt_iventory_purchase_req_id').val(); 	
	  var inventory_item_name = $('#txt_iventory_purchase_req_name').val();
	  var pr_decription = $('#txt_pr_description').val();
	  var pr_qnty = $('#txt_pr_quantity').val();
	  var pr_unit = $('#select_unit option:selected').text();
	  var pr_rate = $('#txt_pr_rate').val();
	  var pr_tax = $('#select_tax option:selected').text();
	  if(pr_rate=="" || pr_rate=="0.000")
	  {
		 var v_amount = 0;
		 var net_amount = 0; 
	  }
      else
	  {	  
		  var v_amount= (parseFloat(pr_qnty)*parseFloat(pr_rate));
		  var tax_amount =v_amount*(parseInt(pr_tax)/100);
		  var net_amount = (parseFloat(v_amount)+parseFloat(tax_amount));
	  }

	   if($.trim(inventory_item_name)==""||$.trim(pr_decription)==""||$.trim(pr_qnty)==""||$.trim(pr_unit)==""||$.trim(pr_tax)=="")
		{
			swal("Warning","Please provide all the details...", "warning");
			return false;
		}         
       else
		{         
			$.post("../controller/purchase_requisition/purchase_req_controller.php",
			 {action:'edit_purchase_requisition', v_inventory_item_id:inventory_item_id, v_inventory_item_name:inventory_item_name, v_pr_decription:pr_decription, v_pr_qnty:pr_qnty, v_pr_unit:pr_unit, v_pr_rate:pr_rate, v_pr_tax:pr_tax, v_net_amount:net_amount, v_pr_child_id:pr_child_tbl_ids}, 
				function(result,status){  
				//result = $.trim(result);
					$.toast({
						heading: 'Success',
						text: 'Purchase Requisition Updated successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
					load_unit_select('div_unit_select','select_unit');	
                    load_tax('div_tax_select','select_tax');	
                    $('#div_item_load').load('templates/iventory_item_combo.php');
					load_data_to_grid_pr_list(purchase_req_no);
					load_data_to_grid_view_pr_list();
					$('#btn_pr_add').show();
                    $('#btn_pr_edit').hide();
					clearText();
				
			});
		}
	  
	});
	
	$('#btn_edit_pr_no').hide();
	$('#btn_generate_pr_no').click(function(){
		
	  var supplier_id = $('#txt_pr_supplier_id').val();
	  var supplier_name = $('#txt_pr_supplier_name').val();
	  var purchase_req_no = $('#txt_pr_no').val();
	  var requsition_date = formatDate($("#txt_local_po_date").val());
	  var requested_by = $('#txt_requested_by').val();
	  var approved_by = $('#txt_approved_by').val();
	//  var work_order_id = $('#select_jobNo option:selected').val();
	 // var work_order_no = $('#select_jobNo option:selected').text();
	  var work_order_no = $('#txt_job_No').val();
	   var work_order_id = 0;
// 	  if(work_order_no=="Select Job No")
// 	  {
// 		work_order_id = 0;
// 		work_order_no = 'NA';  
// 	  }
	  
	  if(supplier_name=="Select Supplier"|| purchase_req_no==""|| requsition_date==""|| requested_by==""|| approved_by=="")
	  {
		  swal("Warning","Please provide all information...", "warning");
	  }
      else
      {
		    $.post("../controller/purchase_requisition/purchase_req_controller.php",
			{action:'purchase_requisition_generate',v_supplier_id:supplier_id, v_supplier_name:supplier_name, v_purchase_req_no:purchase_req_no, v_requsition_date:requsition_date, v_requested_by:requested_by, v_approved_by:approved_by, v_work_order_id:work_order_id, v_work_order_no:work_order_no}, 
				function(result,status){  
				result = $.trim(result);
				swal("Success","Purchase Requisition generated successfully", "success"); 
				$('#btn_generate_pr_no').prop('disabled', true);
				$('#btn_edit_pr_no').show();
			}); 
	  }		  
	});
	
	$('#btn_edit_pr_no').click(function(){
	  var supplier_id = $('#txt_pr_supplier_id').val();
	  var supplier_name = $('#txt_pr_supplier_name').val();
	  var purchase_req_no = $('#txt_pr_no').val();
	  var requsition_date = formatDate($("#txt_local_po_date").val());
	  var requested_by = $('#txt_requested_by').val();
	  var approved_by = $('#txt_approved_by').val();
	   var work_order_no = $('#txt_job_No').val();
	   var work_order_id = 0;
	  //var work_order_id = $('#select_jobNo option:selected').val();
	  //var work_order_no = $('#select_jobNo option:selected').text();
// 	  if(work_order_no=="Select Job No")
// 	  {
// 		work_order_id = 0;
// 		work_order_no = 'NA';  
// 	  }
	  if(supplier_id==""|| supplier_name==""||  requsition_date==""|| requested_by==""|| approved_by=="")
	  {
		  swal("Warning","Please provide all information...", "warning");
	  }
      else
      {
		    $.post("../controller/purchase_requisition/purchase_req_controller.php",
			{action:'purchase_requisition_generate',v_supplier_id:supplier_id, v_supplier_name:supplier_name, v_purchase_req_no:purchase_req_no, v_requsition_date:requsition_date, v_requested_by:requested_by, v_approved_by:approved_by, v_work_order_id:work_order_id, v_work_order_no:work_order_no}, 
				function(result,status){  
				result = $.trim(result);
				  swal("Success","Purchase Requisition generated successfully", "success"); 
				  $('#btn_generate_pr_no').prop('disabled', true);
				  $('#btn_edit_pr_no').show();
			}); 
	  }
	});
	
	$('#btn_pr_print_without_head').click(function(){
		var purchase_req_no = $('#txt_pr_no').val();
		if($.trim(purchase_req_no)=="")
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
			$.post("../controller/purchase_requisition/purchase_req_controller.php",{action:'purchase_requisition_status', v_purchase_req_no:purchase_req_no},function(result,status){
                var obj = jQuery.parseJSON(result);
                var v_pr_status = obj.data[0].requisition_status;
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
					  
                     window.open("reports/pdf/print/purchase_requisitionnew.php?pr_number="+purchase_req_no+"&x=1","_blank"); 
                    
					  
					  //window.open("reports/pr_print_without_head.php?pr_number="+purchase_req_no,"_blank"); 
				   }
                       
            });
		}
	});
	
	$('#btn_pr_print_with_head').click(function(){
		var purchase_req_no = $('#txt_pr_no').val();
		if($.trim(purchase_req_no)=="")
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
			$.post("../controller/purchase_requisition/purchase_req_controller.php",{action:'purchase_requisition_status', v_purchase_req_no:purchase_req_no},function(result,status){
                var obj = jQuery.parseJSON(result);
                var v_pr_status = obj.data[0].requisition_status;
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
					 // window.open("reports/pr_print_with_head.php?pr_number="+purchase_req_no,"_blank");
					 
					 window.open("reports/pdf/print/purchase_requisitionnew.php?pr_number="+purchase_req_no+"&x=0","_blank"); 
                    
					
				   }      
            });
		}
	});
	
	$('#btn_pr_export_excel').click(function(){
		var purchase_req_no = $('#txt_pr_no').val();
		if($.trim(purchase_req_no)=="")
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
			$.post("../controller/purchase_requisition/purchase_req_controller.php",{action:'purchase_requisition_status', v_purchase_req_no:purchase_req_no},function(result,status){
                var obj = jQuery.parseJSON(result);
                var v_pr_status = obj.data[0].requisition_status;
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
					 window.open("reports/pr_print_with_head.php?pr_number="+purchase_req_no,"_blank");
					 
				   }      
            });
		}
	});
	
	$('#btn_view_list_of_prs').click(function(){
		load_data_to_grid_view_pr_list();
	});
	
	$('#btn_view_list_of_cancelled_prs').click(function(){
		load_cancel_data_to_grid_view_pr_list();
	});
	
	$('#btn_create_new_pr').click(function(){  
        location.reload();          
    });
	
	$('#list_pr_sidenav').click(function(){
	   $('#txt_view_start_date').val('');
	   $('#txt_view_end_date').val('');
	});
	
	$('#btn_canceled_pr_list').click(function(){
		$('#txt_cancel_start_date').val('');
		$('#txt_cancel_end_date').val('');
	});
	
	//date searching
	$('#btn_view_search_date').click(function(){
		var txt_view_start_date = formatDate($('#txt_view_start_date').val());
		var txt_view_end_date = formatDate($('#txt_view_end_date').val());
	    load_data_view_pr_list_between(txt_view_start_date, txt_view_end_date);
	});
	$('#btn_search_cancel_date').click(function(){
		var txt_cancel_start_date = formatDate($('#txt_cancel_start_date').val());
		var txt_cancel_end_date = formatDate($('#txt_cancel_end_date').val());
		load_cancel_view_pr_list_between(txt_cancel_start_date, txt_cancel_end_date);
	}); 
	

	//-- common functions ---//
	function load_data_to_grid_pr_list(pr_no)
	
    {  
                    tbl_purchase_req_list.destroy();     
                    tbl_purchase_req_list = $('#tbl_purchase_req_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/purchase_requisition/purchase_req_controller.php',
                                 'data': {
                                    action: 'list_purchase_req',
                                    v_pr_no:pr_no
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
            						
            								action_edit_pr = ' <button type="button" class="btn btn-sm primary-gradient mr-1" name="btn_edit_pr"><i class="material-icons">edit</i></button>';
            								
            								return action_edit_pr;
            
            							},
								 },
								 {"data": null,
								     render: function ( data, type, rows, meta ) 
									   {
            						
            								action_edit_pr = '<button type="button" class="btn btn-sm btn-danger mr-1" name="btn_delete_pr"><i class="material-icons">delete</i></button>';
            								
            								return action_edit_pr;
            
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
	
	function delete_pr_row(pr_child_ids)
    {           
		$.post("../controller/purchase_requisition/purchase_req_controller.php",{action:'delete_pr_item',v_pr_child_id:pr_child_ids},
		function(result,status){});       
    }
	
	function load_data_to_grid_view_pr_list()
    {
		flag = 0;
        list_of_prs.destroy();              
        list_of_prs = $('#list_of_prs').DataTable( {
                            
			 "ajax": {
				 'type': 'POST',
				 'url': '../controller/purchase_requisition/purchase_req_controller.php',
				 'data': {
					action: 'list_table_pr_view',
					
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
				 { "data": "requsition_date"},
				 { "data": "purchase_req_no"},
				 { "data": "supplier_name"},
				 { "data": "work_order_no"},
				 { "data": null ,
						  render: function ( data, type, rows, meta ) 
							{
								str_active_status = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_pr_list" name="view_pr_list" ><i class="material-icons ">remove_red_eye</i></button>';
								return str_active_status;
							},
				 },
				 { "data": null ,
						  render: function ( data, type, rows, meta )
							{
								str_active_status = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="cancel_pr_list" name="cancel_pr_list" ><i class="material-icons ">delete</i></button>';
								return str_active_status;
							},
				 },

			 ],
			 pageLength: 100,
			 searching: true,
			 responsive: true,

			 "initComplete": function( settings, json ) {

			  },
			  "fnDrawCallback": function() {

			 }
	    });  
                
    }
	
	function load_data_view_pr_list_between(startDate, endDate)
    {
		flag = 1;
        list_of_prs.destroy();              
        list_of_prs = $('#list_of_prs').DataTable( {
                            
			 "ajax": {
				 'type': 'POST',
				 'url': '../controller/purchase_requisition/purchase_req_controller.php',
				 'data': {
					action: 'list_table_pr_view_between',
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
				 { "data": "requsition_date"},
				 { "data": "purchase_req_no"},
				 { "data": "supplier_name"},
				 { "data": "work_order_no"},
				 { "data": null ,
						  render: function ( data, type, rows, meta ) 
							{
								str_active_status = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_pr_list" name="view_pr_list" ><i class="material-icons ">remove_red_eye</i></button>';
								return str_active_status;
							},
				 },
				 { "data": null ,
						  render: function ( data, type, rows, meta )
							{
								str_active_status = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="cancel_pr_list" name="cancel_pr_list" ><i class="material-icons ">delete</i></button>';
								return str_active_status;
							},
				 },

			 ],
			 pageLength: 100,
			 searching: true,
			 responsive: true,

			 "initComplete": function( settings, json ) {

			  },
			  "fnDrawCallback": function() {

			 }
	    });  
                
    }
	
	
	
	function load_cancel_data_to_grid_view_pr_list()
    {
		flag = 0;
        list_of_cancelled_prs.destroy();              
        list_of_cancelled_prs = $('#list_of_cancelled_prs').DataTable( {
                            
			 "ajax": {
				 'type': 'POST',
				 'url': '../controller/purchase_requisition/purchase_req_controller.php',
				 'data': {
					action: 'list_cancelled_table_pr_view',
					
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
			  
				 { "data": "ids","visible":false },
				 { "data": "requsition_date"},
				 { "data": "purchase_req_no"},
				 { "data": "supplier_name"},
				 { "data": "work_order_no"},
				 { "data": null ,
						  render: function ( data, type, rows, meta ) 
							{
								str_active_status = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancelled_pr_list" name="view_cancelled_pr_list" ><i class="material-icons ">remove_red_eye</i></button>';
								return str_active_status;
							},
				 },

			 ],
			 pageLength: 100,
			 searching: false,
			// responsive: true,

			 "initComplete": function( settings, json ) {

			  },
			  "fnDrawCallback": function() {

			 }
	    });  
                
    }
	
	function load_cancel_view_pr_list_between(fromDate, lastDate)
    {
		flag = 1;
        list_of_cancelled_prs.destroy();              
        list_of_cancelled_prs = $('#list_of_cancelled_prs').DataTable( {
                            
			 "ajax": {
				 'type': 'POST',
				 'url': '../controller/purchase_requisition/purchase_req_controller.php',
				 'data': {
					action: 'list_cancelled_table_pr_view_between',
					v_startDate:fromDate,
					v_endDate:lastDate
					
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
			  
				 { "data": "ids","visible":false },
				 { "data": "requsition_date"},
				 { "data": "purchase_req_no"},
				 { "data": "supplier_name"},
				 { "data": "work_order_no"},
				 { "data": null ,
						  render: function ( data, type, rows, meta ) 
							{
								str_active_status = '<button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancelled_pr_list" name="view_cancelled_pr_list" ><i class="material-icons ">remove_red_eye</i></button>';
								return str_active_status;
							},
				 },

			 ],
			 pageLength: 100,
			 searching: false,
			// responsive: true,

			 "initComplete": function( settings, json ) {

			  },
			  "fnDrawCallback": function() {

			 }
	    });  
                
    }
	
	
	
	function clearText()
	{
		$('#select_iventory_item option:selected').text("Select Item");
		$('#txt_pr_description').val('');
		$('#txt_pr_quantity').val('');
		$('#select_unit option:selected').text("Select Unit");
		$('#txt_pr_rate').val('');
		$('#select_tax option:selected').text("10.00");
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
	
});