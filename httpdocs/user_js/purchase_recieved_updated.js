$(document).ready(function(){
   
   var flag;
   var approve_item_id,v_prd_no;
   var v_btn_generate_pur_recie = $( '#btn_generate_pur_recie' ).ladda();
   
   $('#div_company_select').load('templates/company_combo.php');
  
   
    $("#div_company_select").change(function() {
	     
	      var company_id=$('option:selected', this).val() ;
	      $('#div_project_select_combo').load('templates/project_combo.php?v_company_id='+company_id);
	     
	 });
	 $("#div_project_select_combo").change(function() { 
	      
	      var project_id=$('option:selected', this).val() ;
	      project_text = $('option:selected', this).text() ;
	      
	      $('#div_select_quotation').load('templates/quotation_combo.php?v_project_id='+project_id);
	      
	 });
   var tbl_purchase_recieve_add = $('#tbl_purchase_recieve_add').DataTable({searching: false, paging: false, info: false,"ordering": false,columnDefs: [
                        { targets: [2,3,4,5], visible: false } ]});
   $('#tbl_purchase_recieve_add').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#tbl_purchase_recieve_add tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_purchase_recieve_add.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
   });
   
   var tbl_purchase_recieve_second_add = $('#tbl_purchase_recieve_second_add').DataTable({searching: false, paging: false, info: false,"ordering": false,columnDefs: [
                        { targets: [1,2,4,5,12,13,15,16], visible: false } // Adjust column indices as needed
                    ]});
   $('#tbl_purchase_recieve_second_add').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#tbl_purchase_recieve_second_add tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { tbl_purchase_recieve_second_add.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
   });
   
   var list_of_purchase_recieve = $('#list_of_purchase_recieve').DataTable({searching: false, paging: false, info: false,"ordering": false});
   var list_of_purchase_recieve_cancel = $('#list_cancelled_of_purchase_recieve').DataTable({searching: false, paging: false, info: false,"ordering": false});
   $('#list_cancelled_of_purchase_recieve').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#list_of_purchase_recieve').removeClass( 'display' ).addClass('table table-striped table-bordered');
   $('#list_of_purchase_recieve tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { list_of_purchase_recieve.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
   });
	
	  tbl_purchase_recieve_second_add.on('draw', function () {
                tbl_purchase_recieve_second_add.cells().every(function (rowIdx, colIdx) {
                    var column = this.column(colIdx);
                    if ([0, 6,7, 8,10].includes(colIdx)) {
                        $(column.nodes()).addClass('text-center');
                    } else if ([9,11].includes(colIdx)) {
                        $(column.nodes()).addClass('text-right');
                    }
                });
            });
            
            // tbl_salary_slip_list.column([4, 5]).nodes().to$().addClass('number-format'); // Ad
            $('.text-center').css('text-align', 'center');
            $('.text-right').css('text-align', 'right');
	        

	
	var select_prn_jobNo;
	var V_PRN;

	$('#div_lpo_select').load('templates/lpo_combo.php');
	

	
	load_tax_select('div_tax_select','select_tax_no');
	function load_tax_select(div_name, tax_ctrl_name)
	{ 
	   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_tax_no',v_tax_ctrl_name:tax_ctrl_name},function(result,status){});
	}
	

	var lpo_no;
//	$("#div_lpo_select").change(function(e) {
	   $(document).on('change', '#select_LPO_no', function(e) {
	 
	    $('#loadingWrapper').show(); 
		//lpo_no=$('option:selected', this).val();
		lpo_no=$("#select_LPO_no").val();
	console.log(lpo_no);
		$('#btn_generate_pur_recie').show();
	  
		$.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'select_lpo_details',v_lpo_no:lpo_no},function(result,status){
			
				if(status === "success")
                    {
                       let obj = JSON.parse(result);
                        //console.log(result);
                    
                     if (!obj.data || obj.data.length === 0) {
                            $("#txt_supplier_id").val('');
                            $("#txt_supplier_name").val('');
                            $("#txt_job_no").val('');
                            $("#txt_pr_no").val('');
                            $("#txt_project_no").val('');
                    
                             load_purchase_recieve_add(lpo_no, false);
                            return;
                        }
                        else
                        {
                        let row = obj.data[0];

                        $("#txt_supplier_id").val(row.company_id);
                        $("#txt_supplier_name").val(row.company_name);
                        $("#txt_job_no").val(row.job_name);
                        $("#txt_pr_no").val(row.prn_number);
                        $("#txt_project_no").val(row.project_number);
                    
                        load_purchase_recieve_add(lpo_no, false);
                        }
                    
                       
                    }
                    else
                    {
                        return false;
                    }

		});           
	   
	});
	

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
function view_purchase_list(category,categoryid,item,itemid,itemCode,qty, unit, rate,amount, tax, netamount, lpochildId,prchildid,description)
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
                    amount,
                    tax,
                    netamount,
                    lpochildId,
                    prchildid,
                    description,
                    '',
                    '',
                    '<button class="btn btn-danger btn-sm delete-rows" data-lpochildid="' + lpochildId + '" data-qty="' + qty + '">Delete</button>' // Delete button
                    
                ]).draw();
                footer_append();
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
                // rowData['quantity'] = combinedValue; // Assuming index 2 is for update_balance_qty
                 console.log('Updated Row Data:', rowData);
                dataTableApi.row(rowIndex).data(rowData);
                dataTableApi.draw();
                $('#btn_add_pur_recie'+lpochildIdToDelete).show();
                $(rowNode).removeClass('strikethrough');
                
            }
            // ************************************************************************************
                            
                            tbl_purchase_recieve_second_add.row(row).remove().draw(false);
                            footer_append();
                            
                            
                        });
                                    
                    // }

// ********************************************************************************




function view_purchase_list_edit(category,categoryid,item,itemid,itemCode,qty, unit, rate,amount, tax, netamount, lpochildId,prchildid,description)
                    { 
                    tbl_purchase_recieve_second_add.columns([15, 16,17]).visible(false);
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
                    amount,
                    tax,
                    netamount,
                    lpochildId,
                    prchildid,
                    description,
                    '',
                    '',
                    ''
                    // '<button class="btn btn-danger btn-sm delete-row" data-prchildid="' + prchildid + '" data-qty="' + qty + '">Delete</button>' +// Delete button
                    //  '<button class="btn btn-primary btn-sm update-row">Update</button>' // Update button
                    //  ''   
                ]).draw();
                footer_append();
             } 
             
     function view_purchase_list_approve(category,categoryid,item,itemid,itemCode,qty, unit, rate,amount, tax, netamount, lpochildId,prchildid,description,received_qty,prd_no)
                    { 
                       
                        // Remove any existing row with the same prchildid
                         tbl_purchase_recieve_second_add.columns([15, 16,17]).visible(true);
                    tbl_purchase_recieve_second_add.rows().every(function () {
                        let data = this.data();
                        if (data[13] == prchildid) { // Column index for prchildid
                            this.remove();
                        }
                    });
                        
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
                    amount,
                    tax,
                    netamount,
                    lpochildId,
                    prchildid,
                    description,
                    received_qty,
                    prd_no,
                    // '<button class="btn btn-danger btn-sm delete-row" data-prchildid="' + prchildid + '" data-qty="' + qty + '">Delete</button>' +// Delete button
                     '<button class="btn btn-primary btn-sm add_to_project">Add to Project</button>' // Update button
                    // ''   
                ]).draw();
                
                footer_append();
             } 
             
             
            var purchase_to_project = $('#tbl_purchase_to_project').DataTable( { }); 
             
             
            
               function list_purchase_to_project(approve_id)
                 {
                     purchase_to_project.destroy();
                         
                     purchase_to_project = $('#tbl_purchase_to_project').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
                                 'data': {
                                    action: 'list_purchase_approve',
                                    v_approve_id:approve_id
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
                                 { "data": "company_name"},
                                 { "data": "project_name"},
                                 { "data": "quotation_number", width:"20%"},
                                 { "data": "inventory_name"},
                                 { "data": "supplier_name"},
                                 { "data": "quantity"},
                                 
                                 
                    				{ "data": "ids","visible":false ,
        					 
                             
                                              render: function ( data, type, rows, meta ) {
                    						
                    									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_quotations" name="delete_quotations" ><i class="material-icons ">delete</i></button>';
                    								
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
                            
                     });
                 }
                 
             

                $('#tbl_purchase_recieve_second_add').on('click', '.delete-row', function() {
                   
                     var rowCount = $('#tbl_purchase_recieve_second_add tbody tr').length; // Count rows before deletion 
                            var rowData = tbl_purchase_recieve_second_add.row($(this).closest('tr')).data();
                            var v_child_ids = rowData[13];
                            var lpo_child_id = rowData[12];
                            var v_qty = rowData[6];
                            var row = $(this).closest('tr');
                            // alert(v_qty);
                            // alert("Deleted " + rowCount + " rows before delete operation."+v_child_ids+" lpo_child_id "+lpo_child_id);
                            if(rowCount==1){
                                swal({                                                       
            					title: "Are you sure?",
            					 content: {
                                    element: "div",
                                    attributes: {
                                        innerHTML: "<div style='text-align: center;'>Do you want to delete the entry?<br>Ones You Delete, You Will Lost PRD NO Permanently....</div>"
                                    },
                                },
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
            					    delete_purchase_recieve_second(v_child_ids,rowCount);
            						tbl_purchase_recieve_second_add.row(row).remove().draw(false);
            						
            				// 		***************************************************
            				        make_underline(lpo_child_id,v_qty);
                           // **************************************************************** 
            						
            					}
            		            });
                            }
                            else{
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
            					    delete_purchase_recieve_second(v_child_ids,rowCount);
            						tbl_purchase_recieve_second_add.row(row).remove().draw(false);
            						
            						// 		***************************************************
            					
            						make_underline(lpo_child_id,v_qty);
                           // **************************************************************** 
            						
            					}
            		        });
                        }
                        footer_append();    
                });
                var qtyFromOtherTable,purchase_qty;
                
                $('#tbl_purchase_recieve_second_add').on('click', '.add_to_project', function() {
                    
                    $("#modal_purchase_req_add_to_project").modal('show');
                    var row = $(this).closest('tr'); // Define 'row' here
                            var rowData = tbl_purchase_recieve_second_add.row(row).data();
                            
                            approve_item_id = rowData[13]; 
                            
                            
                            var description = rowData[14];
                            var category = rowData[3];
                            var purch_qty = rowData[6];
                            var lpochildId = rowData[12];
                            var required_qty = rowData[15];
                            v_prd_no = rowData[16];
                            console.log("Approve ID"+approve_item_id+"v_prd_no:"+v_prd_no);
                            
                            var balance_qty = parseInt(purch_qty)-parseInt(required_qty); 
                    $("#span_product").html(category);
                    $("#span_quantity").html(purch_qty);
                    $("#txt_available_quantity").val(balance_qty);
                    
                    
                    
                    if (balance_qty == 0) {
                        $("#txt_required_qty").val('').prop('disabled', true);
                        $("#btn_save_purchase_recie_add_to_project").prop('disabled', true);
                    } else {
                        $("#txt_required_qty").val('').prop('disabled', false);
                         $("#btn_save_purchase_recie_add_to_project").prop('disabled', false);
                    }
                    
                    list_purchase_to_project(approve_item_id);
                    
                    
                    
                });    
                
                
                 $("#txt_required_qty").change(function(){
                  
                   var v_req_qty= $("#txt_required_qty").val();
                  var v_avl_qty= $("#txt_available_quantity").val();
                  if(parseInt(v_req_qty)>parseInt(v_avl_qty))
                  {
                      swal("Warning","Please check the quantity", "warning");  
                      $("#txt_required_qty").val('');
        		     return false; 
                  }
              })   
                
            $('#modal_purchase_req_add_to_project').on('shown.bs.modal', function () {
                $('#select_company_name').trigger('chosen:updated');
                $('#select_company_name_chosen').css('width', '80%');
            
                $('#select_project_name').trigger('chosen:updated');
                $('#select_project_name_chosen').css('width', '80%');
            
                $('#select_quotation').trigger('chosen:updated');
                $('#select_quotation_chosen').css('width', '80%');
            });
            
            
            $("#btn_save_purchase_recie_add_to_project").click(function(){
                 var v_req_qty= $("#txt_required_qty").val();
                  var v_avl_qty= $("#txt_available_quantity").val();
                  if((v_req_qty)==''||parseInt(v_req_qty)==0)
                  {
                          swal("Warning","Please check the quantity", "warning");  
                          $("#txt_required_qty").val('');
            		      return false; 
                  }
                  
                  if(parseInt(v_req_qty)>parseInt(v_avl_qty))
                  {
                      swal("Warning","Please check the quantity", "warning");  
                      $("#txt_required_qty").val('');
        		     return false; 
                  }
                var company_id=$('#div_company_select option:selected').val() ;
        		var company_name =$('#div_company_select option:selected').text() ;
        		
        		var project_id=$('#div_project_select_combo option:selected').val() ;
        		var project_name =$('#div_project_select_combo option:selected').text() ;
        		
        		var quotation_id=$('#div_select_quotation option:selected').val() ;
        		var quotation_number =$('#div_select_quotation option:selected').text() ;
        		
        		var v_required_quantity = $("#txt_required_qty").val();
        		
        // 		alert(v_required_quantity);
        		
        		if(company_id=='0'||project_id=='0'||quotation_id=='0')
        		{
        		  swal("Warning","Please select all the fields", "warning");  
        		  return false;
        		}
        		
        		
        		$.post("../controller/purchase_recieve/purchase_rec_controller.php",{
        		    action:"add_to_project",
        		    v_approve_item_id:approve_item_id,
        			v_company_id:company_id,
        			v_company_name:company_name,
        			v_project_id:project_id,
        			v_project_name:project_name,
        			v_quotation_id:quotation_id,
        			v_quotation_number:quotation_number, 
        			v_required_quantity:v_required_quantity},function(result,status){
        			 //   alert(result)
        			    if(result>0)
        			    {
        			       swal("Success", "Item is added to the project" , "success");
        			       $("#txt_required_qty").val('');
        			       list_purchase_to_project(approve_item_id);
        			       load_purchase_recieve_load_second_approve(v_prd_no);
        			       
        			    }
        			    
        			    
        			})
        	
            })
                
                
                $('#tbl_purchase_recieve_second_add').on('click', '.update-row', function() {
                          
                            var row = $(this).closest('tr'); // Define 'row' here
                            var rowData = tbl_purchase_recieve_second_add.row(row).data();
                             var item_id = rowData[4]; // Assuming itemid is the fifth column (index 4) in the row data
                            // load_data_to_grid_inventory_list(item_id,1);
                            // Extracting data from the row
                            var description = rowData[14];
                            var purch_qty = rowData[6];
                            var lpochildId = rowData[12];
                            // alert(" lpo_child_id "+lpochildId);
                            // var total_quantity=parseFloat(qty)+parseFloat(stock);
                           
                            // $("#txt_total_quantity").val(total_quantity);
                            // Creating input fields
                            var descriptionInput = '<input type="text" class="form-control" value="' + description + '" name="description">';
                            var qtyInput = '<input type="number" class="form-control" min=0 value="' + purch_qty + '" name="qty">';
                             row.find('td:eq(8)').html(descriptionInput); // Replace cell content for description
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
                                            var v_tax = rowData[10];
                                            var updated_amount=parseFloat(enteredQty)*parseFloat(v_rate);
                                            var updated_tax_amount=(parseFloat(updated_amount)*parseFloat(v_tax))/100;
                                            var updated_net_amount=parseFloat(updated_tax_amount)+parseFloat(updated_amount);
                                            var formatted_net_amount = updated_net_amount.toFixed(3);
                                            row.find('td:eq(7)').html(formatted_net_amount);
                                           
                                    }
                                  footer_append();      
                                        
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
                                var new_net_amount = row.find('td:eq(7)').html();
                                // var row = $(this).closest('tr'); // Define 'row' here
                                var rowData = tbl_purchase_recieve_second_add.row(row).data();
                                var prchild_ids = rowData[13]; 
                                var lpochildId = rowData[12];
                                var initial_qty = rowData[6];
                                console.log("previous qty"+initial_qty);
                               var change_qty = parseFloat(updated_qty)-parseFloat(initial_qty);
                               console.log("change qty"+change_qty);
                               var qty_deff = parseFloat(initial_qty)-parseFloat(updated_qty);
                                $.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:"update_child_lpo_pr",v_pur_recie_child_id:prchild_ids,v_pr_child_id:lpochildId,v_quantity:change_qty,v_description:updated_disc,updated_qty:updated_qty,v_net_amount:new_net_amount},function(result,status){
											 
											 //alert(result);
											    if(result== 1)
												{
												    // load_purchase_recieve_add(lpo_num, true);
												    make_underline(lpochildId,qty_deff)
												  swal("Success","Updated Successfully", "success");
                                                     tbl_purchase_recieve_second_add.row(row).remove().draw(false);
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
				modifiedQuantity = parseFloat(originalQuantity) - parseFloat(purchasedQuantity);
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
				
		// ************************************************
		    var category_name = data.category_name;
		    var category_id = data.category_id;
			var item_name =  data.description;
			var inventory_id =  data.item_id;
			var item_code =  data.item_code;
			var unit =  data.unit;
			var rate =  data.rate;
			var tax =  data.vat_percentage;
			var recieved_qty =  data.quantity_purchased;
			var qty_accepting = $('#qty_accepting_' + pr_child_id).val();
			var remarks = $('#remarks_' + pr_child_id).val();
// 			alert(qty_accepting);
			var amount = parseFloat(qty_accepting)*parseFloat(rate);
			var tax_amt = (parseFloat(amount)*parseFloat(tax))/100;
			var after_tax = (parseFloat(amount)+parseFloat(tax_amt)).toFixed(3);
			
		// ******************************************************
				
				
			if($.trim(supplier_id)=="" || $.trim(supplier_name)=="" || $.trim(pur_recieve_date)=="" || $.trim(job_location)=="" || $.trim(requested_by)=="" || $.trim(approved_by)=="" || $.trim(lpo_no)=="Select LPO No" || $.trim(bill_no)=="")
			{
				swal("Warning","Please provide all the details ....", "warning");
				return false;
			}  
			else
			{	
			    
			 //   alert(modifiedQuantity);
			    var balance_new = parseFloat(modifiedQuantity)-parseFloat(qty_accepting);
			    var v_amount= (parseFloat(qty_accepting)*parseFloat(rate)).toFixed(3);
			    var v_qty = parseFloat(qty_accepting).toFixed(2);
			 //   alert(balance_new);
			    view_purchase_list(category_name,category_id,item_name,inventory_id,item_code,v_qty, unit, rate,v_amount, tax, after_tax, pr_child_id,'',remarks);
			
                var qtyPurchasedCell = tbl_purchase_recieve_add.cell($row, 10); // 10 is the index of the quantity_purchased column
                qtyPurchasedCell.data(parseFloat(recieved_qty) + parseFloat(qty_accepting));

            // Redraw the row to reflect the changes
            tbl_purchase_recieve_add.row($row).invalidate().draw();
                 $('#btn_add_pur_recie'+pr_child_id).hide();
			    $row.toggleClass('strikethrough');	
			}
		 }
                        
    });

    
	var counter = 1;

	
	$('#btn_view_list_of_pur_reci').click(function(){
		purchase_recieve_list();
		$('#loadingWrapper').show(); 
	});
	$('#btn_view_list_of_cancelled_prs').click(function(){
		purchase_recieve_cancel_list();
		$('#loadingWrapper').show(); 
	});
	$('#btn_view_list_of_pur_reci_approved').click(function(){
		purchase_recieve_approved_list();
		$('#loadingWrapper').show(); 
	});
	
	$('#list_of_purchase_recieve tbody').on('click','button', function () {
		var $row = $(this).closest('tr');
		var data = list_of_purchase_recieve.row($row).data();
            
		 if($(this).attr("name") == 'view_pur_recie_list')
		 {
		     $('#loadingWrapper').show(); 
		    $('#div_lpo_select').load('templates/lpo_com_for_view.php', function(response, status, xhr) {
		        if (status == "success") {
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
        			console.log("date"+data.purchase_recieved_date);
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
		        });            		    
		 }
		 
		 
		 if($(this).attr("name") == 'view_pur_recie_list_approve')
		 {
		    // $('#loadingWrapper').show(); 
		    $('#div_lpo_select').load('templates/lpo_com_for_view.php', function(response, status, xhr) {
		        if (status == "success") {
        			V_PRN = data.lpo_no;
        			console.log(data);
        
        			$('#btn_generate_pur_recie').hide();
        			 //$('#tbl_purchase_recieve_add [name="btn_add_pur_recie"]').hide();
        			tbl_purchase_recieve_second_add.clear().draw();
        			$("#select_LPO_no").val(data.lpo_no);
                    $("#select_LPO_no").trigger("chosen:updated");
        			$('#txt_supplier_id').val(data.supplier_id);
        			$('#txt_supplier_name').val(data.supplier_name);
        			$('#txt_recieve_date').val(data.purchase_recieved_date);
        			console.log("date"+data.purchase_recieved_date);
        			$('#txt_job_location').val(data.job_location);
        			$('#txt_recieve_requested_by').val(data.requested_by);
        			$('#txt_recieve_approved_by').val(data.approved_by);
        			$('#txt_prd_no').val(data.prd_no);
        			$('#select_lpo_no').val(data.lpo_no);
        			$('#select_lpo_no').trigger('change')
        			$('#txt_recieve_bill_no').val(data.bill_no);
        			$('#txt_job_no').val(data.work_order_no);
        			$('#txt_pr_no').val(data.purchase_req_no);
        			
        			$('#txt_project_no').val(data.project_number);
                    $("#div_tbl_purchase_recieve_add").hide();
        			//load_purchase_recieve_add(data.lpo_no, true);
        			load_purchase_recieve_load_second_approve(data.prd_no);
        			 closeNavR();
  
                        		    
		        }    		    
		        });            		    
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
	    $('#loadingWrapper').show(); 
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
					 { "data": "item_id",visible: false},
					 { "data": "category_name",visible: false},
					 { "data": "category_id",visible: false},
					 { "data": "item_code",visible: false},
					 { "data": "quantity", "className": "text-center"},
					 { "data": "unit", "className": "text-center"},
					 { "data": "rate", "className": "text-center"},
					 { "data": "vat_percentage", "className": "text-center"},
					 { "data": "quantity_purchased", "className": "text-center"},
					 { "data": null, "className": "text-center",
					 "render": function (data, type, rows, meta) 
						{
							var originalQuantity = parseFloat(rows.quantity);
							var purchasedQuantity = parseFloat(rows.quantity_purchased);
							var result = (originalQuantity - purchasedQuantity).toFixed(2);
							return result;
						}
					 },
					 { "data": null,
						 render: function ( data, type, rows, meta ) 
						   {
								var action_pur_recie = '<input type="number" min="0" name="qty_accepting" id="qty_accepting_'+rows["local_po_child_id"]+'" style="width:90px">';
								return action_pur_recie;
						
							}
					 },
					 { "data": null,
						 render: function ( data, type, rows, meta ) 
						   {
								var action_pur_recie = '<textarea name="remarks" id="remarks_'+rows["local_po_child_id"]+'"></textarea>';
								return action_pur_recie;
						
							}
					 },
					 { "data": "net_amount", "className": "text-right"},
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
                         $('#tbl_purchase_recieve_add').on('change', 'input[name^="qty_accepting"]', function() {
                            var inputValue = parseFloat($(this).val());
                            var row = tbl_purchase_recieve_add.row($(this).closest('tr')).data();
                            var originalQuantity = parseFloat(row.quantity);
                            var purchasedQuantity = parseFloat(row.quantity_purchased);
                            var remainingQuantity = originalQuantity - purchasedQuantity;
                            if (inputValue > remainingQuantity) {
                                swal("Warning","Quantity Entered is Greater than Balance Quantity ....", "warning");
                                $(this).val(''); // Empty the input field if value is greater
                                 $(this).css('border-color', 'red');
                            }
                            else{
                                $(this).css('border-color', '');
                            }
                        });
                        $('#loadingWrapper').hide(); 
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
					.column( 14 )
					.data()
					.reduce( function (a, b) {
						
						return intVal(a) + intVal(b);
					}, 0 );
			   
				// Total over this page Income
				pageTotal1 = api
					.column( 14, { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
			   
				// Update footer
				$( api.column( 14 ).footer() ).html(
					pageTotal1.toFixed(3)
				);
			   
			}
        });
	}
	
	// ****************************** footer append*************************************
    
        function footer_append(){
             sum = 0;
                            $('#tbl_purchase_recieve_second_add tbody tr').each(function() {
                                var rowData = tbl_purchase_recieve_second_add.row(this).data();
                                sum += parseFloat(rowData[11]); // Assuming net_total is at index 16
                            });
                            pageTotal1 = sum;
                            var sum_fortbl = sum.toFixed(3);
                            $('#foot_sum').text(sum_fortbl);
                            console.log("footer sum"+sum);
        }
    
    
    // *************************** end ***************************************************
	
	function load_purchase_recieve_load_second(prd_no)
	{
	     $.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'list_purchase_recieve_add_second',v_purchase_rd_no:prd_no},function(result,status){
                        
                                if(status=="success")
                                {
                                var obj= jQuery.parseJSON(result);
                                console.log("view items"+obj);
                                obj.data.forEach(function(item) {
                                    var amount= (parseFloat(item.quantity)*parseFloat(item.rate)).toFixed(3);
                                    console.log("view items"+item.store_category,item.store_category_id,item.inventory_name,item.inventory_id,item.item_code,item.quantity, item.unit, item.rate, item.tax, item.amount, item.purchase_req_child_id,item.ids,item.description);
                                    
                                    view_purchase_list_edit(item.store_category,item.store_category_id,item.inventory_name,item.inventory_id,item.item_code,item.quantity, item.unit, item.rate,amount, item.tax, item.amount, item.purchase_req_child_id,item.ids,item.description);
                        		   
                        		         
                                });
                                
                                }else
                                {
                                    return false;
                                }
						   });    
                        		 
	}
	
		function load_purchase_recieve_load_second_approve(prd_no)
	{
	     $.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'list_purchase_recieve_add_second',v_purchase_rd_no:prd_no},function(result,status){
                        
                                if(status=="success")
                                {
                                var obj= jQuery.parseJSON(result);
                                console.log("view items"+obj);
                                obj.data.forEach(function(item) {
                                    var amount= (parseFloat(item.quantity)*parseFloat(item.rate)).toFixed(3);
                                    console.log("view items"+item.store_category,item.store_category_id,item.inventory_name,item.inventory_id,item.item_code,item.quantity, item.unit, item.rate, item.tax, item.amount, item.purchase_req_child_id,item.ids,item.description);
                                    view_purchase_list_approve(item.store_category,item.store_category_id,item.inventory_name,item.inventory_id,item.item_code,item.quantity, item.unit, item.rate,amount, item.tax, item.amount, item.purchase_req_child_id,item.ids,item.description,item.received_qty,item.prd_no);
                        		   
                        		         
                                });
                                
                                }else
                                {
                                    return false;
                                }
						   });    
                        		 
	}
	

	function delete_purchase_recieve_second(delete_ids,rowCount)
	{
		$.post("../controller/purchase_recieve/purchase_rec_controller.php",{action:'delete_purchase_recieve_second',v_delete_ids:delete_ids,rowCount:rowCount},
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
				 { "data": "project_number"},
				 { "data": "job_location"},
				 { "data": "bill_no"},
				 { "data": null ,
						  render: function ( data, type, rows, meta ) 
							{
						    	var confirm_status = rows['confirm_status']
							    
							    if (confirm_status === "Not Confirm") {
    				                action_pur_recie = ' <button type="button" class="btn btn-sm primary-gradient mr-2 view_pur_recie_list" onclick="openNavR()" name="view_pur_recie_list" ><i class="material-icons ">remove_red_eye</i></button>';
								    return action_pur_recie;
    				            }
    				            else if (confirm_status === "Confirm") {
    				                return '';
    				            }
							},
				 },
				 { "data": "ids" ,
    				    render: function(data, type, rows) {
    				        var confirm_status = rows['confirm_status'];
    				       if (confirm_status === "Not Confirm") {
    				                return '<div class="checkmark_red_icon"></div>';
    				            }
    				            else if (confirm_status === "Confirm") {
    				                return '<div class="checkmark_green_icon"></div>';
    				            }
    				    }
    				},
				 
				//  { "data": null , "visible":false,
				// 		  render: function ( data, type, rows, meta )
				// 			{
				// 				action_pur_recie = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" name="cancel_pur_recie_list" ><i class="material-icons ">delete</i></button>';
				// 				return action_pur_recie;
				// 			},
				//  },

			 ],
			 pageLength: 50,
			 searching: true,
			 responsive: true,

			 "initComplete": function( settings, json ) {
                    $('#loadingWrapper').hide(); 
			  },
			  "fnDrawCallback": function() {

			 }
	    });  
                
    }
    
    function purchase_recieve_approved_list()
    {
		flag = 0;
        list_of_purchase_recieve.destroy();              
        list_of_purchase_recieve = $('#list_of_purchase_recieve').DataTable( {
                            
			 "ajax": {
				 'type': 'POST',
				 'url': '../controller/purchase_recieve/purchase_rec_controller.php',
				 'data': {
					action: 'list_table_pur_recie_approved',
					
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
				 { "data": "project_number"},
				 { "data": "job_location"},
				 { "data": "bill_no"},
				 { "data": null ,
						  render: function ( data, type, rows, meta ) 
							{
						    	var confirm_status = rows['confirm_status']
							    
							    if (confirm_status === "Confirm") {
    				                action_pur_recie = ' <button type="button" class="btn btn-sm primary-gradient mr-2 view_pur_recie_list_approve" onclick="openNavR()" name="view_pur_recie_list_approve" ><i class="material-icons ">remove_red_eye</i></button>';
								    return action_pur_recie;
    				            }
    				            
							},
				 },
				 { "data": "ids" ,
    				    render: function(data, type, rows) {
    				        var confirm_status = rows['confirm_status'];
    				       if (confirm_status === "Not Confirm") {
    				                return '<div class="checkmark_red_icon"></div>';
    				            }
    				            else if (confirm_status === "Confirm") {
    				                return '<div class="checkmark_green_icon"></div>';
    				            }
    				    }
    				},
				 
				//  { "data": null , "visible":false,
				// 		  render: function ( data, type, rows, meta )
				// 			{
				// 				action_pur_recie = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" name="cancel_pur_recie_list" ><i class="material-icons ">delete</i></button>';
				// 				return action_pur_recie;
				// 			},
				//  },

			 ],
			 pageLength: 50,
			 searching: true,
			 responsive: true,

			 "initComplete": function( settings, json ) {
                    $('#loadingWrapper').hide(); 
			  },
			  "fnDrawCallback": function() {

			 }
	    });  
                
    }
	
	
	$('#list_of_purchase_recieve').on('click', '.checkmark_red_icon', function(button) {
			 var session_id =$('#head_session_user_id').val();
             
            if(session_id=='1'){
                var clickedIcon = $(this); // Save reference to the clicked icon
                var closestRow = clickedIcon.closest('tr');
                var rowData = list_of_purchase_recieve.row(closestRow).data();
                
                
                // ***************************************
                                swal({                                                       
                					title: "Are you sure?",
                					text: "Do you want to confirn the entry?",
                					icon: 'warning',
                					dangerMode: true,
                					allowOutsideClick: false,
                					closeOnClickOutside: false,
                					buttons: {
                					  cancel: 'No Cancel !',
                					  delete: 'Yes Please Confirm'
                					}
                					}).then(function (willDelete) {
                					if (willDelete) {
                						
                					
                                        console.log(rowData);
                                        var ids= rowData['ids'];
                                        //  clickedIcon.removeClass('checkmark_red_icon').addClass('checkmark_green_icon');
                
                                        // // Hide the td:eq(9) element
                                        // closestRow.find('td:eq(8) .view_pur_recie_list').hide();
                						
                						statusApprovedfunction(ids,clickedIcon,closestRow);
                						
                						
                						
                					} else { 
                					    
                					}
                				 }); 
                // **************************************
                
                }
                else{
                    swal("Warning","You can't Confirm....", "warning");
                }
		
		});
	
	
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
							   
							    var confirm_status = rows['confirm_status']
							    
							    if (confirm_status === "Not Confirm") {
    				                action_pur_recie = ' <button type="button" class="btn btn-sm primary-gradient mr-2 view_pur_recie_list" onclick="openNavR()" name="view_pur_recie_list" ><i class="material-icons ">remove_red_eye</i></button>';
								    return action_pur_recie;
    				            }
    				            else if (confirm_status === "Confirm") {
    				                return '';
    				            }
							    
								
							},
				 },
				 
				 { "data": "ids" ,
    				    render: function(data, type, rows) {
    				        var confirm_status = rows['confirm_status'];
    				       if (confirm_status === "Not Confirm") {
    				                return '<div class="checkmark_red_icon"></div>';
    				            }
    				            else if (confirm_status === "Confirm") {
    				                return '<div class="checkmark_green_icon"></div>';
    				            }
    				    }
    				},
				 
				 
				//  { "data": null ,"visible":false,
				// 		  render: function ( data, type, rows, meta )
				// 			{
				// 				action_pur_recie = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" name="cancel_pur_recie_list" ><i class="material-icons ">delete</i></button>';
				// 				return action_pur_recie;
				// 			},
				//  },

			 ], 
			 pageLength: 50,
			 searching: true,
			 responsive: true,

			 "initComplete": function( settings, json ) {
                    $('#loadingWrapper').hide(); 
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
	
// 	********************** pr cancel view *******************************************

            function purchase_recieve_cancel_list()
                {
            // 		flag = 0;
                    list_of_purchase_recieve_cancel.destroy();              
                    list_of_purchase_recieve_cancel = $('#list_cancelled_of_purchase_recieve').DataTable( {
                                        
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
            				 { "data": "bill_no"}
            				 
            			 ],
            			 pageLength: 50,
            			 searching: true,
            			 responsive: true,
            
            			 "initComplete": function( settings, json ) {
                                $('#loadingWrapper').hide(); 
            			  },
            			  "fnDrawCallback": function() {
            
            			 }
            	    });  
                            
                }

// **************************** end **********************************************
$('#btn_search_cancel_date').click(function(){
		var txt_view_start_date = formatDate($('#txt_cancel_start_date').val());
		var txt_view_end_date = formatDate($('#txt_cancel_end_date').val());
	    purchase_recieve_list_cancel_between(txt_view_start_date, txt_view_end_date);
	    $('#loadingWrapper').show(); 
	});

// *************************** pr cancel view between *********************************
	function purchase_recieve_list_cancel_between(startDate, endDate)
    {
// 		flag = 1;
        list_of_purchase_recieve_cancel.destroy();              
        list_of_purchase_recieve_cancel = $('#list_cancelled_of_purchase_recieve').DataTable( {
                            
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
				 { "data": "bill_no"}
			 ], 
			 pageLength: 50,
			 searching: true,
			 responsive: true,

			 "initComplete": function( settings, json ) {
                    $('#loadingWrapper').hide(); 
                        
            },
			  "fnDrawCallback": function() {

			 }
	    });         
                
    }
	

// ******************************* end **********************************************
	
	
	
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
		
// 		var company_id=$('#div_company_select option:selected').val() ;
// 		var company_name =$('#div_company_select option:selected').text() ;
		
// 		var project_id=$('#div_project_select_combo option:selected').val() ;
// 		var project_name =$('#div_project_select_combo option:selected').text() ;
		
// 		var quotation_id=$('#div_select_quotation option:selected').val() ;
// 		var quotation_number =$('#div_select_quotation option:selected').text() ;
		
		var v_total = sum;
		
		
		
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
			{action:'generate_purchase_recieve', 
			v_supplier_id:supplier_id,
			v_supplier_name:supplier_name,
			v_job_name:job_name, v_prn_no:prn_no, 
			v_pur_recieve_date:pur_recieve_date, 
			v_job_location:job_location, 
			v_requested_by:requested_by, 
			v_approved_by:approved_by, 
			v_prd_no:txt_prd_no, 
			v_lpo_no:lpo_no,
			v_bill_no:bill_no, 
			
			
			v_total:v_total,
			
			array_table_data:array_table_data}, 
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
	
	
	function statusApprovedfunction(ids,clickedIcon,closestRow){
	    
	    $.post("../controller/purchase_recieve/purchase_rec_controller.php",
			{action:'update_confirm_status', confirm_id:ids}, 
			function(result,status){
			    
			        clickedIcon.removeClass('checkmark_red_icon').addClass('checkmark_green_icon');
                
                    closestRow.find('td:eq(8) .view_pur_recie_list').hide();
			    
			});
	    
	    
	}
	
	
	
	function make_underline(lpo_child_id,v_qty){
	    
	    var dataTableApi = $('#tbl_purchase_recieve_add').DataTable();
            var rowIndexObject = dataTableApi.rows().indexes().filter(function(value, index) {
                var rowData = dataTableApi.row(value).data();
                console.log("Row ID: " + rowData.local_po_child_id + ", lpo_child_id: " + lpo_child_id);
                return rowData.local_po_child_id == lpo_child_id;
            });
            
            console.log("Filtered Rows: " + rowIndexObject.toArray());
            
            // Check if any matching rows were found
            if (rowIndexObject.length > 0) {
                var updatedRowIndex = rowIndexObject[0]; // Get the index of the first matching row
            
                // Update the first matching row
                var rowData = dataTableApi.row(updatedRowIndex).data();
                console.log("Updating Row ID: " + rowData.local_po_child_id);
            
                // Get the column index of the 'quantity' column (assuming it's the 6th column, index 5)
                var quantityPurchaseColumnIndex = 10; // Adjust this according to your actual column index
                // Get the column index of the 'quantity_purchased' column (assuming it's the 10th column, index 9)
                var quantityBalanceColumnIndex = 11; // Adjust this according to your actual column index
                
                // Recalculate the values based on your logic
                var originalQuantity = parseFloat(rowData.quantity);
                var purchasedQuantity = parseFloat(rowData.quantity_purchased);
                var updatedprQuantity = (purchasedQuantity - v_qty).toFixed(2);
                var Balance = originalQuantity - purchasedQuantity;
                var updated_balance = Balance + parseFloat(v_qty);
            
                // Update the DataTable with the recalculated values using column indexes
                dataTableApi.cell(updatedRowIndex, quantityPurchaseColumnIndex).data(updatedprQuantity);
                dataTableApi.cell(updatedRowIndex, quantityBalanceColumnIndex).data(updated_balance);
            
                // Redraw the table to reflect the changes
                dataTableApi.draw(false); 
            
                // Apply styling to the updated row
                var rowNode = dataTableApi.row(updatedRowIndex).node();
                $(rowNode).css({
                    'text-decoration': 'underline',
                    'color': 'red'
                });
            } else {
                console.log("No matching rows found for lpo_child_id: " + lpo_child_id);
            }

           
	}
	
});