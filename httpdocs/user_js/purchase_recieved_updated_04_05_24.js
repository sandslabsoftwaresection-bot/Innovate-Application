$(document).ready(function(){
   
   var flag;
   var v_btn_generate_pur_recie = $( '#btn_generate_pur_recie' ).ladda();
   var tbl_purchase_recieve_add = $('#tbl_purchase_recieve_add').DataTable({searching: false, paging: false, info: false,"ordering": false});
   $('#tbl_purchase_recieve_add').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#tbl_purchase_recieve_add tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_purchase_recieve_add.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
   });
   
   var tbl_purchase_recieve_second_add = $('#tbl_purchase_recieve_second_add').DataTable({searching: false, paging: false, info: false,"ordering": false,columnDefs: [
                        { targets: [1,2,4,5,11,12], visible: false } // Adjust column indices as needed
                    ]});
   $('#tbl_purchase_recieve_second_add').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#tbl_purchase_recieve_second_add tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_purchase_recieve_second_add.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
   });
   
   var list_of_purchase_recieve = $('#list_of_purchase_recieve').DataTable({searching: false, paging: false, info: false,"ordering": false});
   $('#list_of_purchase_recieve').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#list_of_purchase_recieve tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { list_of_purchase_recieve.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
   });
	
	  tbl_purchase_recieve_second_add.on('draw', function () {
                tbl_purchase_recieve_second_add.cells().every(function (rowIdx, colIdx) {
                    var column = this.column(colIdx);
                    if ([0, 6,7, 8,9].includes(colIdx)) {
                        $(column.nodes()).addClass('text-center');
                    } else if ([10].includes(colIdx)) {
                        $(column.nodes()).addClass('text-right');
                    }
                });
            });
            
            // tbl_salary_slip_list.column([4, 5]).nodes().to$().addClass('number-format'); // Ad
            $('.text-center').css('text-align', 'center');
            $('.text-right').css('text-align', 'right');
	        
	
   // load_supplier_select_box('div_supplier_select','select_supplier_recieve');
   // function load_supplier_select_box(div_name, supplier_ctrl_name)
	// {   
	  // $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_supplier_name',v_supplier_ctrl_name:supplier_ctrl_name},function(result,status){});  
	// }	
	
	// load_job_no_select('div_job_num_select','select_supplier_jobNo');
	// function load_job_no_select(div_name,job_ctrl_name)
	// { 
	   // $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_job_no',v_job_ctrl_name:job_ctrl_name},function(result,status){});
	// }
	
	var select_prn_jobNo;
	var V_PRN;
	// $('#div_job_num_select').change(function(){
	    // select_prn_jobNo = $('#select_supplier_jobNo option:selected').text();
		// load_prn_no_select('div_prno_select','select_PR_No',V_PRN);
	// }); 
	// function load_prn_no_select(div_name,pr_ctrl_name,prn_no)
	// { 
	   // $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no', v_pr_ctrl_name:pr_ctrl_name, v_jobNo:select_prn_jobNo, v_prnn_no:prn_no},function(result,status){  
		   // if(prn_no == undefined)
		   // {
			   // prn_no=0;
			   // $('#select_PR_No').val(prn_no);
		       // $('#select_PR_No').trigger('change');
		   // }
		   // else
		   // {
			   // $('#select_PR_No').val(prn_no);
		       // $('#select_PR_No').trigger('change');
		   // }
		   
	   // });
	// }
	$('#div_lpo_select').load('templates/lpo_combo.php');
	
// 	load_lpo_no_select('div_lpo_select','select_LPO_no');
// 	function load_lpo_no_select(div_name,lpo_ctrl_name)
// 	{ 
// 	   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_LPO_no',v_lpo_ctrl_name:lpo_ctrl_name},function(result,status){});
// 	}
	
	
	// load_unit_select('div_unit_select','select_unit_no');
	// function load_unit_select(div_name,unit_ctrl_name)
	// { 
	   // $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_unit_no',v_qty_ctrl_name:unit_ctrl_name},function(result,status){});
	// }
	
	load_tax_select('div_tax_select','select_tax_no');
	function load_tax_select(div_name, tax_ctrl_name)
	{ 
	   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_tax_no',v_tax_ctrl_name:tax_ctrl_name},function(result,status){});
	}
	
	 // var purchase_req_no; 
	// $('#div_prno_select').change(function(){
	    // purchase_req_no = $('option:selected', $(this)).val();
	   // load_purchase_recieve_add(purchase_req_no);
	// });
	var lpo_no;
	$("#div_lpo_select").change(function() {
		
		lpo_no=$('option:selected', this).val();
		//alert(lpo_no);
		$('#btn_generate_pur_recie').show();
	  
		$.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'select_lpo_details',v_lpo_no:lpo_no},function(result,status){
			
					if(status=="success")
					{
						
					var obj= jQuery.parseJSON(result);
				    console.log(result);
					$("#txt_supplier_id").val(obj.data[0].company_id);
					$("#txt_supplier_name").val(obj.data[0].company_name);
					$("#txt_job_no").val(obj.data[0].job_name);
					$("#txt_pr_no").val(obj.data[0].prn_number);
					load_purchase_recieve_add(lpo_no, false);
					
					}
					else
					{
						return false;
					}
		});           
	   
	});
	
// 	check_pending_invoice();
	
	function check_pending_invoice()
                    {
                        
                         $.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'check_prd_status'},function(result,status){
                               var obj= jQuery.parseJSON(result);
                               var v_prd_number=obj.data[0].prd_no;
                               
                               if(v_prd_number!="")
                                {
                                            swal({
                                                                
                            							title: "You have an uncompleted prd request",
                            							text: "Cancel the request",
                            							icon: 'warning',
                            							dangerMode: true,
                            							allowOutsideClick: false,
                                                        closeOnClickOutside: false,
                            							buttons: {
                            							 // cancel: 'No Cancel Old Request!',
                            							  delete: 'Cancel Old Request!'
                            							}
                            							}).then(function (willDelete) {
                            							if (willDelete) {
                            						
                            						      cancel_prd(v_prd_number);
                                         				
                            							} 
                            				// 			else {
                            							    
                            				// 			  cancel_prd(v_prd_number);
                            							 
                            				// 			}
                                    			});
                                    
                                   
                               }
                        });
                    }
    //**************************************************************************************  
    // select prd
                 function select_prd(v_prd_number)
                    {
                         $.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'select_prd_pending_data',v_prd_number:v_prd_number},function(result,status){
                                var obj= jQuery.parseJSON(result); 
                                $("#select_LPO_no").val(obj.data[0].lpo_no);
                                $("#select_LPO_no").trigger("chosen:updated");
                                $("#txt_supplier_name").val(obj.data[0].supplier_name);
                                $("#txt_supplier_id").val(obj.data[0].supplier_id);
                                $("#txt_recieve_approved_by").val(obj.data[0].approved_by);
                                $("#txt_job_location").val(obj.data[0].job_location);
                                $("#txt_prd_no").val(obj.data[0].prd_no);
                                $("#txt_recieve_bill_no").val(obj.data[0].bill_no);
                                $("#txt_job_no").val(obj.data[0].work_order_no);
                                $("#txt_pr_no").val(obj.data[0].purchase_req_no);
                                $("#txt_recieve_date").val(obj.data[0].purchase_recieved_date);
                                load_purchase_recieve_add(obj.data[0].lpo_no, false);
                                load_purchase_recieve_add_second(obj.data[0].prd_no);
						       
                             });
                        
                    }
                   
                          
 //**************************************************************************************  
//  cancel prd
            function cancel_prd(v_prd_number)
                    {
                        
                        $.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'cancel_prd_list',v_prd_number:v_prd_number
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                    
                         });
                       
                    }
 
//  **************************************************************************************
// *****************************child table load*****************************************
function view_purchase_list(category,categoryid,item,itemid,itemCode,qty, unit, rate, tax, netamount, lpochildId,prchildid,description)
                    { 
                    tbl_purchase_recieve_second_add.row.add([
                    counter++,
                    category,
                    categoryid,
                    item,
                    itemid,
                    itemCode,
                    qty,
                    unit,
                    rate,
                    tax,
                    netamount,
                    lpochildId,
                    prchildid,
                    description,
                    '<button class="btn btn-danger btn-sm delete-rows" data-lpochildid="' + lpochildId + '" data-qty="' + qty + '">Delete</button>' // Delete button
                    
                ]).draw();
             }            
                        // Attach click event handler to delete button
                        $('#tbl_purchase_recieve_second_add').on('click', '.delete-rows', function() {
                            var row = $(this).closest('tr');
                            var lpochildIdToDelete = $(this).data('lpochildid');
                            var childqty = $(this).data('qty');
                            
    // ****************************updating main table*************************************
    
     var dataTableApi = $('#tbl_purchase_recieve_add').DataTable();
            
            // Search for the row index based on the value of 'local_po_child_id'
                        var rowIndexObject = dataTableApi
                .rows()
                .indexes()
                .filter(function(value, index) {
                    return dataTableApi.row(value).data().local_po_child_id == lpochildIdToDelete;
                });
            
            // Check if the row was found
            if (rowIndexObject.length > 0) {
                // Extract the actual index from the DataTables row object
                var rowIndex = rowIndexObject[0];
            // alert(rowIndex)
                // Get the actual row node using the row index
                var rowNode = dataTableApi.row(rowIndex).node();
                
                var rowData = dataTableApi.row(rowIndex).data();
                // console.log(rowData);
                // console.log(rowData['quantity']);
                // console.log(rowData['quantity_purchased']);
                var database_quantity=rowData['quantity'];
                var database_prch_quantity=rowData['quantity_purchased'];
                var update_balance_qty=(parseFloat(database_quantity)-parseFloat(database_prch_quantity)+parseFloat(childqty)).toFixed(2);
                // console.log(update_balance_qty);
                var updated_rec_qty=(parseFloat(database_prch_quantity)-parseFloat(childqty)).toFixed(2);
                // console.log(updated_rec_qty);
                var combinedValue = database_quantity + "(" + update_balance_qty + ")";
                rowData['quantity_purchased'] = updated_rec_qty; // Assuming index 6 is for updated_rec_qty
                rowData['quantity'] = combinedValue; // Assuming index 2 is for update_balance_qty
                 console.log('Updated Row Data:', rowData);
                dataTableApi.row(rowIndex).data(rowData);
                dataTableApi.draw();
                $('#btn_add_pur_recie'+lpochildIdToDelete).show();
                $(rowNode).removeClass('strikethrough');
                
            }
            // ************************************************************************************
                            
                            tbl_purchase_recieve_second_add.row(row).remove().draw(false);
                            
                            
                            
                        });
                                    
                    // }

// ********************************************************************************




function view_purchase_list_edit(category,categoryid,item,itemid,itemCode,qty, unit, rate, tax, netamount, lpochildId,prchildid,description)
                    { 
                    tbl_purchase_recieve_second_add.row.add([
                    counter++,
                    category,
                    categoryid,
                    item,
                    itemid,
                    itemCode,
                    qty,
                    unit,
                    rate,
                    tax,
                    netamount,
                    lpochildId,
                    prchildid,
                    description,
                    '<button class="btn btn-danger btn-sm delete-row" data-prchildid="' + prchildid + '" data-qty="' + qty + '">Delete</button>' +// Delete button
                    '<button class="btn btn-primary btn-sm update-row">Update</button>' // Update button
                ]).draw();
             }       

                $('#tbl_purchase_recieve_second_add').on('click', '.delete-row', function() {
                            var rowData = tbl_purchase_recieve_second_add.row($(this).closest('tr')).data();
                            var v_child_ids = rowData[12];
                            var lpo_child_id = rowData[11];
                            var v_qty = rowData[6];
                            var row = $(this).closest('tr');
                            alert(v_qty);
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
            						updateQty(lpo_child_id, v_qty);
            				// 		updateQtyIn_Inventory(inventory_id, quantity);
            					    delete_purchase_recieve_second(v_child_ids);
            						tbl_purchase_recieve_second_add.row(row).remove().draw(false);
            						
            						
            					}
            		});
                });
                var qtyFromOtherTable,purchase_qty;
                $('#tbl_purchase_recieve_second_add').on('click', '.update-row', function() {
                            
                            var row = $(this).closest('tr'); // Define 'row' here
                            var rowData = tbl_purchase_recieve_second_add.row(row).data();
                             var item_id = rowData[4]; // Assuming itemid is the fifth column (index 4) in the row data
                            // load_data_to_grid_inventory_list(item_id,1);
                            // Extracting data from the row
                            var description = rowData[13];
                            var purch_qty = rowData[6];
                            var lpochildId = rowData[11];
                            // var total_quantity=parseFloat(qty)+parseFloat(stock);
                           
                            // $("#txt_total_quantity").val(total_quantity);
                            // Creating input fields
                            var descriptionInput = '<input type="text" class="form-control" value="' + description + '" name="description">';
                            var qtyInput = '<input type="number" class="form-control" min=0 value="' + purch_qty + '" name="qty">';
                             row.find('td:eq(7)').html(descriptionInput); // Replace cell content for description
                            row.find('td:eq(2)').html(qtyInput); 
                        // ********* Quantity validation*********************************************************************************
                        tbl_purchase_recieve_add.rows().every(function() {
                            var data = this.data();
                            var lpochildIdFromRow = data.local_po_child_id; // Adjust the index according to your data structure
                            if (lpochildId === lpochildIdFromRow) {
                                // Match found, you can access corresponding data here
                                qtyFromOtherTable = data.quantity;
                                purchase_qty = data.quantity_purchased;
                                // Do whatever you need with this data
                            }
                        });
                        var bal_qty = parseFloat(qtyFromOtherTable)-parseFloat(purchase_qty);
                        // ************************************************************************************************************** 
                         
                        var max_qty =  parseFloat(bal_qty) +parseFloat(purch_qty);
                        //   console.log("max qty"+max_qty);
                            // Replacing cell content with input fields
                            row.find('td:eq(2) input[name="qty"]').on('change', function() {
                                var enteredQty = parseFloat($(this).val());
                                    if(enteredQty>max_qty){
                                        swal("Warning","You can only enter the quantity upto "+ max_qty, "warning");
                                        // Reset the entered quantity to the previous value
                                        $(this).val(purch_qty);
                                    }
                                    else{
                                             //  changing net amount
                                            var v_rate = rowData[8];
                                            var v_tax = rowData[9];
                                            var updated_amount=parseFloat(enteredQty)*parseFloat(v_rate);
                                            var updated_tax_amount=(parseFloat(updated_amount)*parseFloat(v_tax))/100;
                                            var updated_net_amount=parseFloat(updated_tax_amount)+parseFloat(updated_amount);
                                            var formatted_net_amount = updated_net_amount.toFixed(3);
                                            row.find('td:eq(6)').html(formatted_net_amount);
                                           
                                    }
                                            
                                        
                            });   
                            // Changing the button text and class
                              $(this).text('Save').removeClass('update-row').addClass('save-row');
                        });

                         $('#tbl_purchase_recieve_second_add').on('click', '.save-row', function() {
                             var row = $(this).closest('tr');
                             var lpo_num=$('#div_lpo_select option:selected').val();
                             var prd_no = $('#txt_prd_no').val();
                            //  alert(lpo_no);
                                var updated_disc = row.find('input[name="description"]').val(); // Assuming input field for description has name="description"
                                var updated_qty = row.find('input[name="qty"]').val(); 
                                console.log("Changed description: " + updated_disc);
                                console.log("Changed qty: " + updated_qty);
                                var new_net_amount = row.find('td:eq(6)').html();
                                // var row = $(this).closest('tr'); // Define 'row' here
                                var rowData = tbl_purchase_recieve_second_add.row(row).data();
                                var prchild_ids = rowData[12]; 
                                var lpochildId = rowData[11];
                                var initial_qty = rowData[6];
                                console.log("previous qty"+initial_qty);
                               var change_qty = parseFloat(updated_qty)-parseFloat(initial_qty);
                               console.log("change qty"+change_qty);
                                $.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:"update_child_lpo_pr",v_pur_recie_child_id:prchild_ids,v_pr_child_id:lpochildId,v_quantity:change_qty,v_description:updated_disc,updated_qty:updated_qty,v_net_amount:new_net_amount},function(result,status){
											 
											 //alert(result);
											    if(result== 1)
												{
												    load_purchase_recieve_add(lpo_num, true);
												  swal("Success","Updated Successfully", "success");
                                                    //  tbl_purchase_recieve_second_add.row(row).remove().draw(false);
                                                    tbl_purchase_recieve_second_add.clear().draw();
                                                    load_purchase_recieve_load_second(prd_no);
                                                     
												}
                            });
                                
                                
                        
                         });



// 	$('#div_item_load_pur_recie').load('templates/iventory_load_combo.php');   
	$('#div_category_load_pur_recie').load('templates/inventory_category_load_com.php');
	$("#div_category_load_pur_recie").change(function(){
                      
                      var v_cat_id=  $( "#select_iventory_category option:selected" ).val();
					  
		              var v_category= $( "#select_iventory_category option:selected" ).text();
					 
					  $("#div_item_load_pur_recie").load("templates/inventory_item_code_load_com.php?category_id="+v_cat_id);
					
					  
				 });
	
	$("#div_item_load_pur_recie").change(function(){
			    	         var v_item_id=  $( "#select_iventory_item option:selected" ).val();
        					  
			    	        $.post("../controller/gate_pass/gate_pass_controller.php",{action:'select_unit_for_pass_in',v_inventory_id:v_item_id},function(result,status){
			    	            if(status=="success")
                                {
                                   
                                var obj= jQuery.parseJSON(result);
                               
                                $("#txt_unit").val(obj.data[0].unit);
                                }
			    	           
			    	            
			    	        });
			    	});
			    
	
	
	var pr_child_id,modifiedQuantity; 
	$('#tbl_purchase_recieve_add tbody').on('click','button', function () {
			var $row = $(this).closest('tr');
			var data = tbl_purchase_recieve_add.row($row).data();
// 			alert(data.local_po_child_id);
			$('#txt_hidden_balance').val('');
			$('#txt_purchase_recieve_quantity').css('border-color', '');
		 if($(this).attr("name") == 'btn_add_pur_recie')
		 {      
			    pr_child_id = data.local_po_child_id;
				$('#txt_purchase_recieve_description').val(data.description);
				// Calculate the modified quantity and set it as the value
				var originalQuantity = parseFloat(data.quantity);
				var purchasedQuantity = parseFloat(data.quantity_purchased);
				modifiedQuantity = (originalQuantity - purchasedQuantity).toFixed(2);
				var mod_amount=(originalQuantity - purchasedQuantity)*parseFloat(data.rate);
		    	var mod_amount_for_mod=mod_amount.toFixed(3);
			    $('#txt_hidden_lpo_id').val(data.local_po_child_id);
			    $('#txt_lpo_quantity').val(data.quantity);
				$('#txt_purchase_recieve_quantity').val(modifiedQuantity);
			    $('#txt_balance_quantity').val(modifiedQuantity);
			    $('#txt_hidden_balance').val(modifiedQuantity);
				$('#txt_purchase_recieve_rate').val(data.rate);	
				$('#txt_purchase_recieve_amount').val(mod_amount_for_mod);
				$('#txt_purchase_recieve_unit').val(data.unit);
				var supplier_id = $('#txt_supplier_id').val();
				var supplier_name = $('#txt_supplier_name').val();
				var job_name = $('#txt_job_no').val();
				var prn_no = $('#txt_pr_no').val();
				var pur_recieve_date = formatDate($('#txt_recieve_date').val());
				var job_location = $('#txt_job_location').val();
				var requested_by = $('#txt_recieve_requested_by').val();
				var approved_by = $('#txt_recieve_approved_by').val();
				var txt_prd_no = $('#txt_prd_no').val();
				var lpo_no = $('#select_lpo_no option:selected').val();
				var bill_no = $('#txt_recieve_bill_no').val();
				
			if($.trim(supplier_id)=="" || $.trim(supplier_name)=="" || $.trim(pur_recieve_date)=="" || $.trim(job_location)=="" || $.trim(requested_by)=="" || $.trim(approved_by)=="" || $.trim(lpo_no)=="Select LPO No" || $.trim(bill_no)=="")
			{
				swal("Warning","Please provide all the details ....", "warning");
				return false;
			}  
			else
			{	  		
				$('#modal_purchase_req_child').modal('show');
				
			}
		 }
                        
    });

        $("#txt_purchase_recieve_quantity").change(function() {
            
               var recieved_qty= $('#txt_purchase_recieve_quantity').val();
                     recieved_qty=parseFloat(recieved_qty).toFixed(2);
			   var balance_qty= $('#txt_balance_quantity').val();
			        
				var recev_rate= $('#txt_purchase_recieve_rate').val();
				var hidden_bal= $('#txt_hidden_balance').val();
				    
				// alert("recieved"+recieved_qty+"  balance qty"+balance_qty+"  hidden"+hidden_bal);
				if(recieved_qty>parseFloat(hidden_bal) || recieved_qty==0){
				    $('#txt_purchase_recieve_quantity').css('border-color', 'red');
				    swal("Warning","Recieved Quantity is Greater than Balance Quantity ....", "warning");
				}
				else{
				    $('#txt_purchase_recieve_quantity').css('border-color', '');
				    var balance_after=(parseFloat(hidden_bal)-parseFloat(recieved_qty)).toFixed(2);
				    $('#txt_balance_quantity').val(balance_after);
				    var tax_amount=(parseFloat(recieved_qty)*parseFloat(recev_rate)).toFixed(3);
				     $('#txt_purchase_recieve_amount').val(tax_amount);
				}
				
			
        });

	var counter = 1;
	$('#btn_save_purchase_recie').click(function(){
		    
// 			alert(modifiedQuantity);
			
			var lpo_id=$('#txt_hidden_lpo_id').val();
			var quantity = $('#txt_purchase_recieve_quantity').val();
// 			alert("quantity"+quantity);
        		    // Get DataTable API
            var dataTableApi = $('#tbl_purchase_recieve_add').DataTable();
            
            // Search for the row index based on the value of 'local_po_child_id'
                        var rowIndexObject = dataTableApi
                .rows()
                .indexes()
                .filter(function(value, index) {
                    return dataTableApi.row(value).data().local_po_child_id == lpo_id;
                });
            
            // Check if the row was found
            if (rowIndexObject.length > 0) {
                // Extract the actual index from the DataTables row object
                var rowIndex = rowIndexObject[0];
            // alert(rowIndex)
                // Get the actual row node using the row index
                var rowNode = dataTableApi.row(rowIndex).node();
                
                var rowData = dataTableApi.row(rowIndex).data();
                // console.log(rowData);
                // console.log(rowData['quantity']);
                // console.log(rowData['quantity_purchased']);
                var database_quantity=rowData['quantity'];
                var database_prch_quantity=rowData['quantity_purchased'];
                var update_balance_qty=(parseFloat(database_quantity)-parseFloat(database_prch_quantity)-parseFloat(quantity)).toFixed(2);
                // console.log(update_balance_qty);
                var updated_rec_qty=(parseFloat(database_prch_quantity)+parseFloat(quantity)).toFixed(2);
                // console.log(updated_rec_qty);
                var combinedValue = database_quantity + "(" + update_balance_qty + ")";
                rowData['quantity_purchased'] = updated_rec_qty; // Assuming index 6 is for updated_rec_qty
                rowData['quantity'] = combinedValue; // Assuming index 2 is for update_balance_qty
                 console.log('Updated Row Data:', rowData);
                dataTableApi.row(rowIndex).data(rowData);
                dataTableApi.draw();
                $('#btn_add_pur_recie'+lpo_id).hide();
                $(rowNode).toggleClass('strikethrough');
                
            }
			var supplier_id = $('#txt_supplier_id').val();
			var supplier_name = $('#txt_supplier_name').val();
			var job_name = $('#txt_job_no').val();
			var prn_no = $('#txt_pr_no').val();
			var pur_recieve_date = formatDate($('#txt_recieve_date').val());
			var job_location = $('#txt_job_location').val();
			var requested_by = $('#txt_recieve_requested_by').val();
			var approved_by = $('#txt_recieve_approved_by').val();
			var txt_prd_no = $('#txt_prd_no').val();
			var lpo_no = $('#select_LPO_no option:selected').val();
			var bill_no = $('#txt_recieve_bill_no').val();
			
			var inventory_id = $('#select_iventory_item option:selected').val();
			var inventory_name = $('#select_iventory_item option:selected').text(); 
			var inventory_name_parts = inventory_name.split('/');
			var item_name = inventory_name_parts[0];
            var item_code = inventory_name_parts[1];
			
		    var description = $('#txt_purchase_recieve_description').val();
			
// 			var unit = $('#txt_purchase_recieve_unit').val();
            var unit = $('#txt_unit').val();
			var rate = $('#txt_purchase_recieve_rate').val();
			var tax = $('#select_tax_no option:selected').text();
			var category_id = $('#select_iventory_category option:selected').val();
			var category_name = $('#select_iventory_category option:selected').text();
			var lpo_quantity = $('#txt_lpo_quantity').val();
			
			
		    if(rate=="" || rate=="0.000")
		    {
			 var v_amount = 0;
			 var net_amount = 0; 
		    }
		    else
		    {	  
			  var v_amount= (parseFloat(quantity)*parseFloat(rate));
			  var tax_amount =v_amount*(parseInt(tax)/100);
			  var net_amount = (parseFloat(v_amount)+parseFloat(tax_amount)).toFixed(3);
		    }			
			if($.trim(inventory_id)=="0" || quantity == '' || description == '' || unit == '' || rate == '' )
			{
				swal("Warning","Please provide all the details ....", "warning");
				return false;
			} 
			else
			{
			    view_purchase_list(category_name,category_id,item_name,inventory_id,item_code,quantity, unit, rate, tax, net_amount, lpo_id,'',description);
			    $('#modal_purchase_req_child').modal('hide');
			    
			}
// 			if(parseFloat(quantity) > parseFloat(modifiedQuantity) )
// 			{
// 				swal("Warning","Please quantity...!", "warning");
// 				return false;
// 			}
// 			else
// 			{			
				 
// 				$.post("../controller/purchase_recieve/purchase_rec_controller.php",
// 				{action:'add_purchase_recieve',v_supplier_id:supplier_id, v_supplier_name:supplier_name,v_job_name:job_name, v_prn_no:prn_no, v_pur_recieve_date:pur_recieve_date, v_job_location:job_location, v_requested_by:requested_by, v_approved_by:approved_by, v_prd_no:txt_prd_no, v_lpo_no:lpo_no, v_bill_no:bill_no, v_pr_child_id:pr_child_id, v_inventory_item_id:inventory_id, v_inventory_item_name:inventory_name, v_description:description, v_quantity:quantity, v_unit:unit, v_rate:rate, v_tax:tax, v_net_amount:net_amount, category_id:category_id, category_name:category_name, lpo_quantity:lpo_quantity}, 
// 				function(result,status){ 			
// 				result = $.trim(result);
// 					if(result.charAt(0)=='U')
// 						{
// 							swal("Error", result, "error");
// 						}
// 					else
// 						{
// 							$('#modal_purchase_req_child').modal('hide');
							
// 							$('#txt_prd_no').val(result); 
// 							$('#pur_recieve_head').html(result);
// 							$.toast({
// 								heading: 'Success',
// 								text: 'Item added successfully..!',
// 								showHideTransition: 'slide',
// 								icon: 'success'
// 							}); 
// 							load_purchase_recieve_add_second(result);
// 						}
// 				});
// 			}    
            
	});           
	
	
	
	$('#tbl_purchase_recieve_second_add tbody').on('click','button', function () {
			var $row = $(this).closest('tr');
			var data = tbl_purchase_recieve_second_add.row($row).data();
            var child_ids = data.purchase_req_child_id;
			var quantity = data.quantity;
			var inventory_id = data.inventory_id;
			var tatal_qty=data.total_quantity;
		 if($(this).attr("name") == 'btn_delete_purchase_recieve')
		 {
		  //   alert(data.purchase_req_child_id);
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
						updateQty(child_ids, quantity);
						updateQtyIn_Inventory(inventory_id, quantity);
					    delete_purchase_recieve_second(data.ids);
						load_purchase_recieve_add_second(data.prd_no);	 
				// 		load_purchase_recieve_add(lpo_no);
				 var dataTableApi = $('#tbl_purchase_recieve_add').DataTable();
            
            // Search for the row index based on the value of 'local_po_child_id'
                        var rowIndexObject = dataTableApi
                .rows()
                .indexes()
                .filter(function(value, index) {
                    return dataTableApi.row(value).data().local_po_child_id == data.purchase_req_child_id;
                });
            
            // Check if the row was found
            if (rowIndexObject.length > 0) {
                // Extract the actual index from the DataTables row object
                var rowIndex = rowIndexObject[0];
            // alert(rowIndex)
                // Get the actual row node using the row index
                var rowNode = dataTableApi.row(rowIndex).node();
                var rowData = dataTableApi.row(rowIndex).data();
                
                var database_quantity=rowData['quantity'];
                var database_prch_quantity=rowData['quantity_purchased'];
                var update_balance_qty=(parseFloat(database_quantity)-parseFloat(database_prch_quantity)+parseFloat(quantity)).toFixed(2);
                
                var updated_rec_qty=(parseFloat(database_prch_quantity)-parseFloat(quantity)).toFixed(2);
                
                var combinedValue = database_quantity + "(" + update_balance_qty + ")";
                rowData['quantity_purchased'] = updated_rec_qty; 
                rowData['quantity'] = combinedValue;
                
                dataTableApi.row(rowIndex).data(rowData);
                
                dataTableApi.draw();
           
                 $(rowNode).removeClass('strikethrough');
            }
				
					} else { 
					}
				 }); 
		 }                
    });
	
	$('#btn_view_list_of_pur_reci').click(function(){
		purchase_recieve_list();
	});
	
	
	$('#list_of_purchase_recieve tbody').on('click','button', function () {
		var $row = $(this).closest('tr');
		var data = list_of_purchase_recieve.row($row).data();
            
		 if($(this).attr("name") == 'view_pur_recie_list')
		 {
			V_PRN = data.lpo_no;
			console.log(data);
// 			alert("button");
			$('#btn_generate_pur_recie').hide();
			 //$('#tbl_purchase_recieve_add [name="btn_add_pur_recie"]').hide();
			tbl_purchase_recieve_second_add.clear().draw();
			$("#select_LPO_no").val(data.lpo_no);
            $("#select_LPO_no").trigger("chosen:updated");
// 			$('#select_LPO_no').val(data.supplier_id);
// 			$("#select_LPO_no").trigger("chosen:updated");
            
			$('#txt_supplier_id').val(data.supplier_id);
			$('#txt_supplier_name').val(data.supplier_name);
			$('#txt_recieve_date').val(data.purchase_recieved_date);
			$('#txt_job_location').val(data.job_location);
			$('#txt_recieve_requested_by').val(data.requested_by);
			$('#txt_recieve_approved_by').val(data.approved_by);
			$('#txt_prd_no').val(data.prd_no);
			$('#select_lpo_no').val(data.lpo_no);
			$('#select_lpo_no').trigger('change')
			$('#txt_recieve_bill_no').val(data.bill_no);
			$('#txt_job_no').val(data.work_order_no);
			$('#txt_pr_no').val(data.purchase_req_no);

			load_purchase_recieve_add(data.lpo_no, true);
			load_purchase_recieve_load_second(data.prd_no);
			 closeNavR();
// 			load_purchase_recieve_add_second(data.prd_no); 

        //      $.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'list_purchase_recieve_add_second',v_purchase_rd_no:data.prd_no},function(result,status){
                        
        //                         if(status=="success")
        //                         {
        //                         var obj= jQuery.parseJSON(result);
        //                         console.log("view items"+obj);
        //                         obj.data.forEach(function(item) {
        //                             console.log("view items"+item.store_category,item.store_category_id,item.inventory_name,item.inventory_id,item.item_code,item.quantity, item.unit, item.rate, item.tax, item.amount, item.purchase_req_child_id,item.ids,item.description);
        //                             view_purchase_list_edit(item.store_category,item.store_category_id,item.inventory_name,item.inventory_id,item.item_code,item.quantity, item.unit, item.rate, item.tax, item.amount, item.purchase_req_child_id,item.ids,item.description);
        //                 		    closeNavR();
                        		         
        //                         });
                                
        //                         }else
        //                         {
        //                             return false;
        //                         }
						  // });    
                        		    
                        		    
                        		    
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
						deleteAll_purchase_recieve(data.ids);
						purchase_recieve_list();
					} else { 
					}
				 }); 
		 }
                        
    });
	
	//date search
	$('#btn_view_search_date').click(function(){
		var txt_view_start_date = formatDate($('#txt_view_start_date').val());
		var txt_view_end_date = formatDate($('#txt_view_end_date').val());
	    purchase_recieve_list_between(txt_view_start_date, txt_view_end_date);
	});
	
    $('#btn_generate_edit_pur_recie').hide();
	$('#btn_generate_pur_recie').click(function(){
		common_insert("PR Generated Successfully");
		
	});
	
	$('#btn_generate_edit_pur_recie').click(function(){
	   common_insert("PR Updated Successfully");
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
					   window.open("reports/pdf/print/purchase_received_new.php?pur_recie_number="+txt_prd_no+"&x=1","_blank"); 
                      
					  //window.open("reports/pur_recie_without_head.php?pur_recie_number="+txt_prd_no,"_blank"); 
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
					  window.open("reports/pdf/print/purchase_received_new.php?pur_recie_number="+txt_prd_no+"&x=0","_blank"); 
                      
					  //window.open("reports/pur_recie_with_head.php?pur_recie_number="+txt_prd_no,"_blank"); 
				   }
                       
            });
		}
	});
	
	$('#btn_pur_recie_export_excel').click(function(){
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
					  window.open("reports/pur_recie_with_head.php?pur_recie_number="+txt_prd_no+"&x=0","_blank"); 
                      
					  //window.open("reports/pur_recie_with_head.php?pur_recie_number="+txt_prd_no,"_blank"); 
				   }
                       
            });
		}
	});
	
	$('#btn_create_new_precieved').click(function(){
		location.reload();
	});
	
	
   //common functions----------------------------------------------------------------------//
	function load_purchase_recieve_add(lpo_no, hideButtons = false)
	{
		tbl_purchase_recieve_add.destroy();     
        tbl_purchase_recieve_add = $('#tbl_purchase_recieve_add').DataTable( {          
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
					 'data': {
						action: 'list_purchase_recieve_add',
						v_purchase_recieve_no:lpo_no
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
				"scroller": true,

				"columns": [
					 { "data": "local_po_child_id", "className": "text-center"},
					 { "data": "description"},
					 { "data": "quantity", "className": "text-center",
					 "render": function (data, type, rows, meta) 
						{
							var originalQuantity = parseFloat(rows.quantity);
							var purchasedQuantity = parseFloat(rows.quantity_purchased);
							var result = (originalQuantity - purchasedQuantity).toFixed(2);
							return originalQuantity.toFixed(2) + " (" + result + ")";
						}
					 },
					 { "data": "unit", "className": "text-center"},
					 { "data": "rate", "className": "text-center"},
					 { "data": "vat_percentage", "className": "text-center"},
					 { "data": "quantity_purchased", "className": "text-center"},
					 { "data": "amount", "className": "text-right"},
					 { "data": null,
						 render: function ( data, type, rows, meta ) 
						   {
						
								if (parseInt(rows.quantity) - parseInt(rows.quantity_purchased) > 0 && !hideButtons) {
								// Display the "Add" button
								var action_pur_recie = '<button type="button" class="waves-effect waves-light btn green box-shadow-none border-round mr-1 mb-1" style="color:white;" name="btn_add_pur_recie" id="btn_add_pur_recie'+rows["local_po_child_id"]+'">Add</button>';
								return action_pur_recie;
							} else {
								// Return an empty string if the condition is not met
								return '';
							}

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
					.column( 7 )
					.data()
					.reduce( function (a, b) {
						
						return intVal(a) + intVal(b);
					}, 0 );
			   
				// Total over this page Income
				pageTotal1 = api
					.column( 7, { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
			   
				// Update footer
				$( api.column( 7 ).footer() ).html(
					pageTotal1.toFixed(3)
				);
			   
			}
        });
	}
	
	function load_purchase_recieve_load_second(prd_no)
	{
	     $.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'list_purchase_recieve_add_second',v_purchase_rd_no:prd_no},function(result,status){
                        
                                if(status=="success")
                                {
                                var obj= jQuery.parseJSON(result);
                                console.log("view items"+obj);
                                obj.data.forEach(function(item) {
                                    console.log("view items"+item.store_category,item.store_category_id,item.inventory_name,item.inventory_id,item.item_code,item.quantity, item.unit, item.rate, item.tax, item.amount, item.purchase_req_child_id,item.ids,item.description);
                                    view_purchase_list_edit(item.store_category,item.store_category_id,item.inventory_name,item.inventory_id,item.item_code,item.quantity, item.unit, item.rate, item.tax, item.amount, item.purchase_req_child_id,item.ids,item.description);
                        		   
                        		         
                                });
                                
                                }else
                                {
                                    return false;
                                }
						   });    
                        		 
	}
	
// 	function load_purchase_recieve_add_second(prd_no)
// 	{
// 		tbl_purchase_recieve_second_add.destroy();     
//         tbl_purchase_recieve_second_add = $('#tbl_purchase_recieve_second_add').DataTable( {          
// 				 "ajax": {
// 					 'type': 'POST',
// 					 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
// 					 'data': {
// 						action: 'list_purchase_recieve_add_second',
// 						v_purchase_rd_no:prd_no
// 					 }
// 				 },
// 				 "language": {
// 					 "zeroRecords": "No records available",
// 					 "infoEmpty": "No records available",
// 				  },
// 				"order": [[ 0, "desc" ]],
// 				"bPaginate": false,
// 				"bLengthChange": false,
// 				"bFilter": false,
// 				"bInfo": false,
// 				"autoWidth": false,
// 				"scroller": true,
// 				"columns": [
// 					 { "data": null},
// 					 { "data": "description"},
// 					 { "data": "quantity"},
// 					 { "data": "unit"},
// 					 { "data": "rate"},
// 					 { "data": "tax"},
// 					 { "data": "amount"},
// 					 { "data": null,
// 						 render: function ( data, type, rows, meta ) 
// 						   {
						
// 								action_pur_recie = '<button type="button" class="btn btn-sm btn-danger mr-1" name="btn_delete_purchase_recieve"><i class="material-icons">delete</i></button>';
								
// 								return action_pur_recie;

// 							},
// 					 },
// 				 ],
// 				 pageLength: 25,
// 				 searching: false,
				 
// 				  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
// 					 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
// 					 return nRow;
// 				 },
//         });
// 	}
	
	function delete_purchase_recieve_second(delete_ids)
	{
		$.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'delete_purchase_recieve_second',v_delete_ids:delete_ids},
		function(result,status){});  
	}
	
	function updateQty(pr_child_ids, quantity)
	{
		$.post('../controller/purchase_recieve/purchase_rec_controller.php',
		{action:"update_qty_in_delete", v_pr_child_id:pr_child_ids, v_quantity:quantity},function(result, status){});
	}
	
	function updateQtyIn_Inventory(inventory_ids, quantity)
	{
		$.post('../controller/purchase_recieve/purchase_rec_controller.php',
		{action:"update_qty_in_delete_inventory", v_inventory_item_id:inventory_ids, v_quantity:quantity},function(result, status){});
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
				 { "data": null , "visible":false,
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
				 { "data": null ,"visible":false,
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
	
	function deleteAll_purchase_recieve(ids)
	{
		$.post('../controller/purchase_recieve/purchase_rec_controller.php',
		{action:"delete_main_purchase_recieve", v_pr_child_id:ids},function(result){});
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
	
	function common_insert(swal_name)
	{
	    
	     v_btn_generate_pur_recie.ladda('start');
		var supplier_id = $('#txt_supplier_id').val();
		var supplier_name = $('#txt_supplier_name').val();
		var job_name = $('#txt_job_no').val();
		var prn_no = $('#txt_pr_no').val();
		var pur_recieve_date = formatDate($('#txt_recieve_date').val());
		var job_location = $('#txt_job_location').val();
		var requested_by = $('#txt_recieve_requested_by').val();
		var approved_by = $('#txt_recieve_approved_by').val();
		var txt_prd_no = $('#txt_prd_no').val();
		var lpo_no = $('#select_LPO_no option:selected').val();
		var bill_no = $('#txt_recieve_bill_no').val();
		
		var array_table_data = tbl_purchase_recieve_second_add.rows().data().toArray();
		 console.log('Array Table Data:', array_table_data);
		 
		if($.trim(supplier_id)=="" || $.trim(supplier_name)=="" || $.trim(pur_recieve_date)=="" || $.trim(job_location)=="" || $.trim(requested_by)=="" || $.trim(approved_by)=="" || $.trim(lpo_no)=="Select LPO No" || $.trim(bill_no)=="")
		{
		    v_btn_generate_pur_recie.ladda('stop');
			swal("Warning","Please provide all the details ....", "warning");
			return false;
		}          
		else
		{   
			$.post("../controller/purchase_recieve/purchase_rec_controller.php",
			{action:'generate_purchase_recieve', v_supplier_id:supplier_id,v_supplier_name:supplier_name,v_job_name:job_name, v_prn_no:prn_no, v_pur_recieve_date:pur_recieve_date, v_job_location:job_location, v_requested_by:requested_by, v_approved_by:approved_by, v_prd_no:txt_prd_no, v_lpo_no:lpo_no, v_bill_no:bill_no, array_table_data:array_table_data}, 
			function(result,status){  
			result = $.trim(result);
			
			v_btn_generate_pur_recie.ladda('stop');
				swal("Success",swal_name, "success"); 
				
				            var startIndex = result.indexOf('{');
                            var endIndex = result.lastIndexOf('}');
                            
                            // Extract the JSON string using substring
                            var jsonStr = result.substring(startIndex, endIndex + 1);
                            
                            // Parse the JSON string into an object
                            var jsonObj = JSON.parse(jsonStr);
                            $("#txt_prd_no").val(jsonObj.msg);
				$('#btn_generate_pur_recie').prop('disabled', true);
				$('#btn_generate_edit_pur_recie').show();
			});
		}
		
		 
	
	}
	
});