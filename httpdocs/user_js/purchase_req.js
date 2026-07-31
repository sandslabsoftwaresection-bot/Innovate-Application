$(document).ready(function(){
 	
	var flag;
    // var tbl_purchase_req_list = $('#tbl_purchase_req_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
     var tbl_purchase_req_list = $('#tbl_purchase_req_list').DataTable({
                    searching: false,
                    paging: false,
                    info: false,
                    ordering: false,
                    columnDefs: [
                        { targets: [1,2], visible: false } // Adjust column indices as needed
                    ]
                });
    
    
	var list_of_prs = $('#list_of_prs').DataTable( {searching: true, paging: true, info: true,"ordering": false});
	var list_of_cancelled_prs = $('#list_of_cancelled_prs').DataTable( {searching: false, paging: false, info: false,"ordering": false});
	
	$('#tbl_purchase_req_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
	$('#list_of_prs').removeClass( 'display' ).addClass('table table-striped table-bordered');
	$('#list_of_cancelled_prs').removeClass( 'display' ).addClass('table table-striped table-bordered');
	$('#tbl_purchase_req_list tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_purchase_req_list.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
    });
	$('#div_supplier_select').load('templates/supplier_combo.php');
	
// 	load_supplier_select_box('div_supplier_select','select_supplier');
//     function load_supplier_select_box(div_name, supplier_ctrl_name)
//     {   
//       $("#"+div_name).load('../controller/purchase_requisition/purchase_req_controller.php',{action:'select_company_name',v_supplier_ctrl_name:supplier_ctrl_name},function(result,status){});  
//     }
    
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
	
	$('#div_job_num_select').change(function(){
		work_order_number  = $('#select_supplier_jobNo option:selected').text();
		console.log("Work Order No"+work_order_number );
		
    	load_project_no_select(work_order_number);
	});
	
	function load_project_no_select(work_order_number )
	{
	         $.post("../controller/purchase_requisition/purchase_req_controller.php",{action:'select_project_number',v_work_order_no:work_order_number},function(result,status){
                        
                                if(status=="success")
                                {
                                    
                                var obj= jQuery.parseJSON(result);
                              
                                $('#txt_project_No').val(obj.data[0].project_number);
                                
                                }
                                else
                                {
                                    return false;
                                }
                    }); 
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
	
	
// 	*********************** add to table ******************************************
	 var counter = 1;
    function tbl_purchase_req_list_fn(pr_req_id,inventory_id,inventory_name,description,quantity,unit,rate, tax, netamount)
                    { 
                    tbl_purchase_req_list.row.add([
                    counter++,
                    pr_req_id,
                    inventory_id,
                    inventory_name,
                    description,
                    quantity,
                    unit,
                    rate,
                    tax,
                    netamount,
                    '<button class="btn btn-danger btn-sm delete-rows">Delete</button>' // Delete button
                    
                ]).draw();
                       
                        // // Update the footer with the sum
                        // footer_append();
                    
                        // Attach click event handler to delete button
                        $('#tbl_purchase_req_list').on('click', '.delete-rows', function() {
                            var row = $(this).closest('tr');
                            tbl_purchase_req_list.row(row).remove().draw(false);
                    
                            // Recalculate sum after deletion
                        //     footer_append();
                        //   $('#btn_local_po_edit').hide();
                        //   $('#btn_local_po_add').show();
                        });
                    
                        clear_text();
                    }
    
    // ************************* end************************************************
      
	// ******************************** table view for update**********************
    
                function tbl_purchase_req_list_fn_edit(pr_req_id,inventory_id,inventory_name,description,quantity,unit,rate, tax, netamount)
                    { 
                    tbl_purchase_req_list.row.add([
                    counter++,
                    pr_req_id,
                    inventory_id,
                    inventory_name,
                    description,
                    quantity,
                    unit,
                    rate,
                    tax,
                    netamount,
                    '<button class="btn btn-danger btn-sm delete-row"><i class="material-icons">delete</i></button>' +
                        '<button class="btn btn-primary btn-sm update-row"><i class="material-icons">edit</i></button>'
                ]).draw();
            
                // Conditionally add the buttons
               
            
                // Update the footer with the sum
                // footer_append();
            }
                
    
             // Attach click event handler to delete button
                        $('#tbl_purchase_req_list').on('click', '.delete-row', function() {
                            var rowData = tbl_purchase_req_list.row($(this).closest('tr')).data();
                            var v_child_ids = rowData[1];
                            var row = $(this).closest('tr');
                             swal({
								  title: "Do you want to delete the item?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {
                            
                                        $.post("../controller/purchase_requisition/purchase_req_controller.php",{action:"delete_pr_item",v_pr_child_id:v_child_ids},function(result,status){
            											 
            											 //alert(result);
            											    if(result== 1)
            												{
            												    
                                                                 tbl_purchase_req_list.row(row).remove().draw(false);
                                                                //  footer_append();
            												}
                                        });
                                        
								  }    
								});
                        });
                        $('#tbl_purchase_req_list').on('click', '.update-row', function() {
                             var row = $(this).closest('tr');
                            var rowData = tbl_purchase_req_list.row($(this).closest('tr')).data();
                            var v_child_ids = rowData[1];
                            
                            var qty = rowData[5];
                            // var rate=rowData[10];
                            var disc=rowData[4];
                            // var taxpr =rowData[15];
                            // var net_amt = rowData[16];
                            
                            // var total_quantity=parseFloat(qty)+parseFloat(stock);
                           
                            // $("#txt_total_quantity").val(total_quantity);
                            // Creating input fields
                            var qtyInput = '<input type="number" class="form-control" min=0 value="' + qty + '" name="qty" style="width:85px">';
                            // var rateInput = '<input type="number" class="form-control" min=0 value="' + rate + '" name="rate" style="width:85px">';
                            var discInput = '<input type="text" class="form-control" min=0 value="' + disc + '" name="disc" style="width:85px">';
                        
                            // Replacing cell content with input fields
                            row.find('td:eq(3)').html(qtyInput); // Replace cell content for qty
                            // row.find('td:eq(4)').html(rateInput);
                            row.find('td:eq(2)').html(discInput);
                            
                                // ************************ qty, rate, disc pr change ************************
                                row.find('td:eq(3) input[name="qty"], td:eq(2) input[name="disc"]').on('change', function() {
                                    
                                    // var net_amt = row.find('td:eq(9)').html();
                                    var qtyValue = row.find('td:eq(3) input[name="qty"]').val();
                                    // var rateValue = row.find('td:eq(4) input[name="rate"]').val();
                                    var discValue = row.find('td:eq(2) input[name="disc"]').val();
                                    // alert(qtyValue+" "+rateValue+" "+discValue);
                                    // var amountvalue = parseFloat(qtyValue)*parseFloat(rateValue);
                                    
                                    // var amountvalue_tbl = amountvalue.toFixed(3);
                                    // row.find('td:eq(5)').html(amountvalue_tbl);
                                    
                                    // var dics_amount = (parseFloat(amountvalue)*parseFloat(discValue))/100;
                                    // var less_dics_amount = parseFloat(amountvalue)-parseFloat(dics_amount);
                                    
                                    // var less_dics_amount_tbl =less_dics_amount.toFixed(3);
                                    // row.find('td:eq(7)').html(less_dics_amount_tbl);
                                    
                                    
                                    // var tax_amt = (parseFloat(less_dics_amount)*parseFloat(taxpr))/100;
                                    // var amount_after_tax = parseFloat(less_dics_amount)+parseFloat(tax_amt);
                                    
                                    // var amount_after_tax_tbl = amount_after_tax.toFixed(3);
                                    // row.find('td:eq(9)').html(amount_after_tax_tbl);
                                    
                                    // console.log("page_total "+pageTotal1+" net amt "+net_amt);
                                    // var footer_amt = parseFloat(pageTotal1)-parseFloat(net_amt);
                                    // var footer_new = parseFloat(footer_amt)+parseFloat(amount_after_tax);
                                    // var footr_fortbl = footer_new.toFixed(3);
                                    // $('#foot_sum').text(footr_fortbl);
                                    // pageTotal1=footer_new;
                                    
                                });
                                // *********************************************
                                
                                $(this).html('<i class="material-icons ">save</i>').removeClass('update-row').addClass('save-row');

                        });
    
    // ********************************** end *****************************************
    var pr_no;
    // ****************************update table row **************************************
                 $('#tbl_purchase_req_list').on('click', '.save-row', function() {
                    //  alert("hhhhhhhhhh");
                    //  $('#loadingWrapper').show(); 
                     var row = $(this).closest('tr');
                            var rowData = tbl_purchase_req_list.row($(this).closest('tr')).data();
                            var v_child_ids = rowData[1];
                            // var v_lpo_no = rowData[2];
                            var qtyValue = row.find('td:eq(3) input[name="qty"]').val();
                            // var rateValue = row.find('td:eq(4) input[name="rate"]').val();
                            // var item_amt = row.find('td:eq(5)').html();
                            var discValue = row.find('td:eq(2) input[name="disc"]').val();
                            // var after_disc_amt = row.find('td:eq(7)').html();
                            // var net_amt = row.find('td:eq(9)').html();
                            // pageTotal1
                             $.post("../controller/purchase_requisition/purchase_req_controller.php",{action:"edit_purchase_requisition",v_pr_child_id:v_child_ids,v_pr_qnty:qtyValue,v_pr_decription:discValue},function(result,status){
            											 
											 //alert(result);
											    if(result== 1)
												{
												    
                    									 $.toast({
                                                            heading: 'Success',
                                                            text: 'Updated Successfully..!',
                                                            showHideTransition: 'slide',
                                                            icon: 'success'
                                                        });
												    // load_data_to_grid_for_edit(v_lpo_no,false);
												    load_data_to_grid_for_edit(pr_no);
                                                    //  local_po_list_table.row(row).remove().draw(false);
                                                    //  footer_append();
												}
                            });
                     
                 });
    
    // ****************************** end ***************************	    
		    
	
	
	

	$('#btn_pr_edit').hide();
	$('#btn_pr_add').click(function(){
	 
	  var supplier_id = $('#txt_pr_supplier_id').val();
	  var supplier_name = $('#txt_pr_supplier_name').val();
	  var purchase_req_no = $('#txt_pr_no').val();
	  var requsition_date = formatDate($("#txt_local_po_date").val());
	  var requested_by = $('#txt_requested_by').val();
	  var approved_by = $('#txt_approved_by').val();
	  var txt_job_No = $('#txt_job_No').val();
// 	  var work_order_id = $('#select_jobNo option:selected').val();
// 	  var work_order_no = $('#select_jobNo option:selected').text();
// 	   if(work_order_no=="Select Job No")
// 	   {
// 		work_order_no = 'NA';  
// 	   }
	  var inventory_item_id =  $('#txt_iventory_purchase_req_id').val(); 	
	  var inventory_item_name = $('#txt_iventory_purchase_req_name').val();
	  
	  var pr_decription = $('#txt_pr_description').val();
	  var pr_qnty = $('#txt_pr_quantity').val();
	  var pr_unit = $('#select_unit option:selected').text();
	  var pr_rate = $('#txt_pr_rate').val();
	  var pr_tax = $('#select_tax option:selected').text();
	  
	  if(pr_rate=="" || pr_rate=="0.000")
	  {
	      pr_rate=0.00;
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
		  
		 tbl_purchase_req_list_fn('',inventory_item_id,inventory_item_name,pr_decription,pr_qnty,pr_unit,pr_rate, pr_tax, net_amount);
		    
		   
	//  **************************** add to database **********************
		  
// 			$.post("../controller/purchase_requisition/purchase_req_controller.php",
// 			 {action:'add_purchase_requisition',v_supplier_id:supplier_id, v_supplier_name:supplier_name, v_purchase_req_no:purchase_req_no, v_requsition_date:requsition_date, v_requested_by:requested_by, v_approved_by:approved_by, v_work_order_no:txt_job_No, v_inventory_item_id:inventory_item_id, v_inventory_item_name:inventory_item_name, v_pr_decription:pr_decription, v_pr_qnty:pr_qnty, v_pr_unit:pr_unit, v_pr_rate:pr_rate, v_pr_tax:pr_tax, v_net_amount:net_amount}, 
// 				function(result,status){  
// 				result = $.trim(result);
// 				if(result.charAt(0)=='U')
// 					{
// 						clearText();
// 						swal("Error", result, "error");
// 					}
// 				else
// 					{
// 						$('#txt_pr_no').val(result);
// 						$.toast({
// 							heading: 'Success',
// 							text: 'Item added successfully..!',
// 							showHideTransition: 'slide',
// 							icon: 'success'
// 						});  
//                         load_unit_select('div_unit_select','select_unit');	
//                         load_tax('div_tax_select','select_tax');	
//                         $('#div_item_load').load('templates/iventory_item_combo.php');						
// 						load_data_to_grid_pr_list(result); 
// 						clearText();
// 					}
// 			});

// ********************** end ********************************
		}
	  
	});
	
	
	
	
	 function clear_text()
                 {
                     
                        $('#txt_pr_description').val('');
                    	  $('#txt_pr_quantity').val('');
                    	  $('#txt_pr_rate').val('');
                        $('#txt_iventory_purchase_req_id').val(''); 	
	                    $('#txt_iventory_purchase_req_name').val('');
                        $('#select_tax option:selected').val('');
                        
                   
                   $("#select_iventory_item").val(0);
                    $("#select_iventory_item").trigger("chosen:updated");
                    $("#select_unit").val(0);
                    $("#select_unit").trigger("chosen:updated");
                   
                 }
	
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
        pr_no = data.purchase_req_no;
		var main_tbl_ids = data.ids;
		var supplier_ids = data.supplier_id;
		var work_order_no = data.work_order_no;
		clearText();
		$('#btn_pr_add').show();
		$('#btn_pr_edit').hide();   
		
		if($(this).attr("name")=='view_pr_list')
		{
	        load_data_to_grid_for_edit(pr_no);
			closeNavR();	
            $('#txt_pr_no').val(pr_no);	
		    $('#select_company').val(supplier_ids);
			$('#select_company').trigger("chosen:updated");
			$('#txt_job_No').val(work_order_no);
			
			$('#txt_requested_by').val(data.requested_by);
			$('#txt_approved_by').val(data.approved_by);
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
	
	
	 // *********************************funtion load data datatable for edit ***************
    
    function load_data_to_grid_for_edit(pr_req_no)
    {
        tbl_purchase_req_list.clear().draw();
        $.post("../controller/purchase_requisition/purchase_req_controller.php",{action:'list_pr_child',v_pr_no:pr_req_no}
        ,function(result,status){
                        
                                if(status=="success")
                                {
                                var obj= jQuery.parseJSON(result);
                                console.log(obj);
                                
                                obj.data.forEach(function(item) {
                                    
                                        tbl_purchase_req_list_fn_edit(item.	ids,item.inventory_id,item.inventory_name,item.description,item.quantity,item.unit,item.rate, item.tax, item.amount)
                                    $('#btn_generate_pr_no').hide();
                                    $('#inventory_add_div').hide();
                                });
                                
                                }else
                                {
                                    return false;
                                }
						   });  
    }
    
    // *************************************end ****************************************
                  
                 
	
	
	
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
	  var txt_job_No = $('#txt_job_No').val();
	  
	                        var dataArray = [];

                            // Iterate through each row in the DataTable
                            tbl_purchase_req_list.rows().every(function() {
                                var data = this.data();
                 
                                dataArray.push({
                                    'Counter': data[0],
                                    'prch_req_id': data[1],
                                    'inventory_id': data[2],
                                    'inventory_name': data[3],
                                    'description': data[4],
                                    'qty': data[5],
                                    'unit': data[6],
                                    'rate': data[7],
                                    'tax': data[8],
                                    'net_total': data[9],
                                    
                                    // Add other properties as needed
                                });
                            });
                            
	  
	 var work_order_id = $('#select_supplier_jobNo option:selected').val();
	  var work_order_no = $('#select_supplier_jobNo option:selected').text();

// 	  var work_order_no = $('#txt_job_No').val();
// 	   var work_order_id = 0;
	  if(work_order_no=="Select Job No")
	  {
		work_order_id = 0;
		work_order_no = 'NA';  
	  }
	  
	  if(supplier_name=="Select Supplier"|| requsition_date==""|| requested_by==""|| approved_by=="")
	  {
		  swal("Warning","Please provide all information...", "warning");
	  }
      else
      {
          
          
          	$.post("../controller/purchase_requisition/purchase_req_controller.php",
			 {action:'add_purchase_requisition',v_supplier_id:supplier_id, v_supplier_name:supplier_name, v_purchase_req_no:purchase_req_no, v_requsition_date:requsition_date, v_requested_by:requested_by, v_approved_by:approved_by, v_work_order_no:work_order_no,dataArray:dataArray}, 
				function(result,status){  
				result = $.trim(result);
				if(result.charAt(0)=='U')
					{
						clearText();
						swal("Error", result, "error");
					}
				else
					{
						swal("Success","Purchase Requisition generated successfully", "success"); 
						
					    	var startIndex = result.indexOf('{');
                            var endIndex = result.lastIndexOf('}');
                            
                            // Extract the JSON string using substring
                            var jsonStr = result.substring(startIndex, endIndex + 1);
                            
                            // Parse the JSON string into an object
                            var jsonObj = JSON.parse(jsonStr);
                            $("#txt_pr_no").val(jsonObj.msg);
        				$('#btn_generate_pr_no').prop('disabled', true);
        				// $('#btn_edit_pr_no').show();
					}
				});	
          
// 		    $.post("../controller/purchase_requisition/purchase_req_controller.php",
// 			{action:'purchase_requisition_generate',v_supplier_id:supplier_id, v_supplier_name:supplier_name, v_purchase_req_no:purchase_req_no, v_requsition_date:requsition_date, v_requested_by:requested_by, v_approved_by:approved_by, v_work_order_id:work_order_id, v_work_order_no:work_order_no}, 
// 				function(result,status){  
// 				result = $.trim(result);
// 				swal("Success","Purchase Requisition generated successfully", "success"); 
// 				$('#btn_generate_pr_no').prop('disabled', true);
// 				$('#btn_edit_pr_no').show();
// 			}); 
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
     $('#div_category_load_v1').load('templates/inventory_main_cateogory.php'); 
                 $('#div_category_load_pur_recie').load('templates/inventory_category_search_com.php'); 
    
      $(document).on('change', '#select_iventory_category', function () {
                    const catId = $(this).val();
                    if (catId !== '0') {
                        $.ajax({
                            url: '../controller/inventory/inventory_controller.php',
                            type: 'POST',
                            data: {
                                action: 'get_sub_category',
                                v_category_id: catId
                            },
                            dataType: 'json',
                            success: function (response) {
                                const $subCat = $('#select_inventory_sub_category');
                                $subCat.empty(); // Clear old options
                            
                                if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                                    $subCat.append('<option value="0">Select Sub Category</option>');
                                    
                                    response.data.forEach(function (item) {
                                        $subCat.append(`<option value="${item.ids}">${item.sub_cat_name}</option>`);
                                    });
                            
                                    $subCat.trigger("chosen:updated"); // If using Chosen
                                } else {
                                    $subCat.append('<option value="0">No Sub Categories Available</option>');
                                    $subCat.trigger("chosen:updated");
                                }
                            }
                        });
                    }
                });
                
                
                $(document).on('change', '#inventory_cat_v1', function () {
                    // alert('inventory_cat_v1');
                    const catId = $(this).val();
                    if (catId !== '0') {
                        $.ajax({
                            url: '../controller/inventory/inventory_controller.php',
                            type: 'POST',
                            data: {
                                action: 'get_sub_category',
                                v_category_id: catId
                            },
                            dataType: 'json',
                            success: function (response) {
                                const $subCat = $('#inventory_sub_cat_v1');
                                $subCat.empty(); // Clear old options
                                
                                $subCat.append('<option value="" selected disabled>Select Sub Category</option>');
                                $subCat.append('<option value="0">N/A</option>');
                
                                if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                                    response.data.forEach(function (item) {
                                        $subCat.append(`<option value="${item.ids}">${item.sub_cat_name}</option>`);
                                    });
                                } else {
                                    $subCat.append('<option disabled>No Sub Categories Available</option>');
                                }
                
                                $subCat.trigger("chosen:updated"); // If using Chosen
                            }
                        });
                    }
                });
                
                $(document).on('change', '#inventory_sub_cat_v1', function () {
                    const subcatId = $(this).val();
                    const catId = $('#inventory_cat_v1 option:selected').val();
                
                    if (subcatId !== '') {
                        $.ajax({
                            url: '../controller/inventory/inventory_controller.php',
                            type: 'POST',
                            data: {
                                action: 'get_store_item',
                                v_category_id: catId,
                                v_sub_category_id:subcatId
                            },
                            dataType: 'json',
                            success: function (response) {
                                const $subCat = $('#select_iventory_item');
                                $subCat.empty(); // Clear old options
                            
                                if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                                    $subCat.append('<option value="0">Select Sub Category</option>');
                            
                                    response.data.forEach(function (item) {
                                        const value = `${item.item_id}$${item.cat_id}$${item.cat_name}$${item.item_code}$${item.unit}$${item.tax_value}`;
                                        const text = `${item.item_name}*${item.item_code}`;
                                        $subCat.append(`<option value="${value}">${text}</option>`);
                                    });

                            
                                    $subCat.trigger("chosen:updated"); // If using Chosen
                                } else {
                                    $subCat.append('<option value="0">No Sub Categories Available</option>');
                                    $subCat.trigger("chosen:updated");
                                }
                            }

                        });
                    }
                });

	$(document).on('change', '#select_iventory_item', function () {
                        const item_details = $(this).val();
                        const item_name_code = $('option:selected', this).text();
                    
                        const details_array = item_details.split('$');
                        $("#select_unit option:selected").text(details_array[4]);
                        // $('#txt_local_po_unit').val(details_array[4]);
                        
                        // $('#txt_tax_percentage').val(details_array[5]);
                    
                       // const item_name_code_array = item_name_code.split('*');
                        //$('#txt_local_po_description').val(item_name_code_array[0]);
                    });
	
});