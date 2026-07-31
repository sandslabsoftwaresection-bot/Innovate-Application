$(document).ready(function(){
   
                var v_but_local_po_save = $( '#btn_local_po_add' ).ladda();
                var v_but_local_po_edit = $( '#btn_local_po_edit' ).ladda();
                var v_btn_company_add = $( '#btn_company_add' ).ladda();
                
                var v_btn_generate_local_po = $( '#btn_generate_local_po' ).ladda();
                var v_btn_generate_inventory = $( '#btn_add_item_mod' ).ladda();
                // var local_po_list_table = $('#tbl_local_po_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
                var local_po_list_table = $('#tbl_local_po_list').DataTable({
                    searching: false,
                    paging: false,
                    info: false,
                    ordering: false,
                    columnDefs: [
                        { targets: [1,2,4,5,6,7,12], visible: false } // Adjust column indices as needed
                    ]
                });
                var prn_items_table = $('#tbl_prn_items').DataTable({
                    searching: false,
                    paging: false,
                    info: false,
                    ordering: false,
                    columnDefs: [
                        { targets: [1,2,4,5,6,7,12], visible: false }
                    ]
                });
                
                var local_po_view_list_table = $('#list_of_local_pos').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                var local_po_view_cancelled_list_table = $('#list_of_cancelled_local_pos').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                
				//$('#div_company_select').load('templates/supplier_combo.php');
				
                 $('#tbl_local_po_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#list_of_local_pos').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#list_of_cancelled_local_pos').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#tbl_local_po_list tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { local_po_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                 $('#list_of_local_pos tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { local_po_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                 }); 
                  $('#list_of_cancelled_local_pos tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { local_po_view_cancelled_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                 }); 
                 
                 
                  // load_supplier_select_box('div_supplier_select','select_company');
                   $('#div_supplier_select').load('templates/supplier_combo.php');
                //   $('#div_item_load_lpo').load('templates/inventory_all_item_load.php');
                   
                   	// **********************************************
    				var css = '.chosen-container { width: 100% !important; }';
    
                    // Create a style element
                    var style = document.createElement('style');
                    style.type = 'text/css';
                    
                    // Append CSS rule to the style element
                    if (style.styleSheet) {
                        style.styleSheet.cssText = css; // IE support
                    } else {
                        style.appendChild(document.createTextNode(css)); // Other browsers
                    }
                    
                    // Append the style element to the document head
                    document.head.appendChild(style);  
                    
    				// *************************************************
    				
                //   function load_supplier_select_box(div_name,ctrl_name)
                //         { 
      
                //   $("#"+div_name).load('../controller/local_po/local_po_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});
        
                //         }
                
                
						load_job_no_select('div_job_num_select','select_supplier_jobNo');
						function load_job_no_select(div_name,job_ctrl_name)
						{ 
						   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_job_no',v_job_ctrl_name:job_ctrl_name},function(result,status){});
						}
						var select_prn_jobNo;
						var V_PRN;
						$('#div_job_num_select').change(function(){
							select_prn_jobNo = $('#select_supplier_jobNo option:selected').text();
							load_prn_no_select('div_prno_select','select_PR_No',V_PRN);
						}); 
						function load_prn_no_select(div_name,pr_ctrl_name,prn_no)
	                        { 
						   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1', v_pr_ctrl_name:pr_ctrl_name, v_jobNo:select_prn_jobNo, v_prnn_no:prn_no},function(result,status){  
							   if(prn_no === undefined)
							   {
								   prn_no=0;
								   $('#select_PR_No').val(prn_no);
								   $('#select_PR_No').trigger('change');
							   }
							   else
							   {
								   $('#select_PR_No').val(prn_no);
								   $('#select_PR_No').trigger('change');
							   }
							   
						   });
	                       }
						
                         $("#div_supplier_select").change(function() {
                      
                  
                    var company_id = $('#select_company option:selected').val();
                  
                    $.post("../controller/local_po/local_po_controller.php", {
                        action: 'select_company_details',
                        v_company_id: company_id
                    },
                    function(result,status){
                        
                                if(status=="success")
                                {
                                    
                                var obj= jQuery.parseJSON(result);
                               console.log(obj.data[0].company_name);
                                $("#txt_local_po_company_id").val(obj.data[0].company_id);
                                $("#txt_local_po_company_name").val(obj.data[0].company_name);
                                $("#txt_local_po_po_box").val(obj.data[0].contact_address_1);
                                $("#txt_local_po_contact_no").val(obj.data[0].contact_phone);
                                $("#txt_local_po_fax").val(obj.data[0].fax);
                                $("#txt_local_po_attn").val(obj.data[0].contact_person);
                                
                                
                                }
                                else
                                {
                                    return false;
                                }
                    });           
                    if (company_id != "0") {
                        load_purchase_requisitions(company_id);
                    }
                   
                 });
                 
                 $( '#btn_local_po_edit' ).hide();
                 $('#btn_edit_local_po' ).hide();
                 check_pending_local_po();
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
                            .create( document.querySelector( '#txt_local_po_all_description' ) )
                            .then( newEditor => {
                                editor = newEditor;
                            } )
                            .catch( error => {
                                console.error( error );  
                            } );
                
                
                
                function check_pending_local_po()
                    {
                        
                         $.post("../controller/local_po/local_po_controller.php",{action:'check_local_po_status'},function(result,status){
                               var obj= jQuery.parseJSON(result);
                               var v_local_po_count=obj.data[0].local_po_count;
                               var v_local_po_id=obj.data[0].local_po_main_id;
                               var v_local_po_number=obj.data[0].local_po_number;
                               
                               if(v_local_po_count>0)
                                {
                                            swal({
                                                                
                                    							title: "You have an uncompleted local_po Request",
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
                                    						
                                    						      select_local_po(v_local_po_number);
                                                 						 
                                    							} else {
                                    							    
                                    							  cancel_local_po(v_local_po_number);
                                    							 
                                    							}
                                    				});
                                    
                                   
                               }
                        });
                } 
                         
                $("#select_company").change(function() {
                   
                    var company_id = $(this).val();
                    
                    if (company_id != "0") {
                        load_purchase_requisitions(company_id);
                    } else {
                        $("#txt_purchase_reqsition_number").html('<option value="0">--Select PRN NO--</option>');
                    }
                });
                
                // Function to load purchase requisitions based on company
                function load_purchase_requisitions(company_id) {
                     console.log("PR called");
                    $.post("../controller/local_po/local_po_controller.php", {
                        action: 'get_purchase_requisitions',
                        v_company_id: company_id
                    }, function(result, status) {
                        if (status == "success") {
                            try {
                                var obj = jQuery.parseJSON(result);
                                var options = '<option value="0">--Select PRN NO--</option>';
                                
                                if (obj.data && obj.data.length > 0) {
                                    obj.data.forEach(function(item) {
                                        options += '<option value="' + item.purchase_req_no + '">' + item.purchase_req_no + '</option>';
                                    });
                                }
                                
                                $("#txt_purchase_reqsition_number").html(options);
                                
                                // If using chosen select, refresh it
                                if ($("#txt_purchase_reqsition_number").hasClass('chosen-select')) {
                                    $("#txt_purchase_reqsition_number").trigger("chosen:updated");
                                }
                            } catch (e) {
                                console.error("Error parsing JSON response:", e, result);
                                $("#txt_purchase_reqsition_number").html('<option value="0">--Select PRN NO--</option>');
                            }
                        }
                    }).fail(function(xhr, status, error) {
                        console.error("AJAX request failed:", status, error);
                        $("#txt_purchase_reqsition_number").html('<option value="0">--Select PRN NO--</option>');
                    });
                }
                                             
                    function select_local_po(v_local_po_number)
                    {
                         $.post("../controller/local_po/local_po_controller.php",{action:'select_local_po_pending_data',v_local_po_no:v_local_po_number},function(result,status){
                                var obj= jQuery.parseJSON(result); 
								//console.log(result);
								var v_jobname=obj.data[0].job_name;
								//console.log(v_jobname);
								var pnr_number=obj.data[0].prn_number;
								//console.log(pnr_number);
                                //$('#div_company_select option[value='+obj.data[0].company_id+']').prop('selected','selected');
                                $('#div_company_select option').map(function () {
                                if ($(this).text() == $.trim(obj.data[0].company_name)) return this;
                                }).attr('selected', 'selected');
                                $("#txt_local_po_company_name").val(obj.data[0].company_name);
                                $("#txt_local_po_po_box").val(obj.data[0].po_box);
                                $("#txt_local_po_contact_no").val(obj.data[0].telephone_no);
                                $("#txt_local_po_fax").val(obj.data[0].fax);
                                $("#txt_local_po_attn").val(obj.data[0].attn);
                                $("#txt_local_po_no").val(obj.data[0].local_po_number);
                                $("#txt_local_po_date").val(obj.data[0].local_po_date);
                                $("#txt_local_po_quotation_ref").val(obj.data[0].quotation_reference);
                                $('#txt_local_po_payment_terms').val(obj.data[0].payment_terms);
                                load_data_to_grid_local_po_list(obj.data[0].local_po_number);
                               
                              
                                $('#txt_local_po_vat').val(obj.data[0].less_discount);
                                $('#txt_local_po_total_amount').val(obj.data[0].total_amount);
                                $('#txt_local_po_discount').val(obj.data[0].vat);
                                $('#txt_local_po_balance_due').val(obj.data[0].balane_in_due);
                                $("#txt_local_po_all_description").val(obj.data[0].description);
								$('#div_job_num_select option').map(function () {
								 if ($(this).text() == obj.data[0].job_name) return this;
								 }).attr('selected', 'selected');
								$("#div_prno_select").load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1',v_jobNo:v_jobname,v_prnn_no:pnr_number},function(result,status){  
								if(status=="success")
								{
								
									$('#div_prno_select option').map(function () {
                                        if ($(this).text() == obj.data[0].prn_number) return this;
                                     }).attr('selected', 'selected');
								}
							
								});
                                $( '#btn_local_po_add' ).show();
                                $( '#btn_local_po_edit' ).hide();
                                
                                
                                $("#local_po_no_head").html(obj.data[0].local_po_number);
                                 $('#btn_generate_local_po' ).show();
                                 
                                
                             });
                        
                       
                        
                        
                    }
                   
                   $("#txt_purchase_reqsition_number").change(function() {
                        var selectedPrn = $(this).val();
                        
                        if (selectedPrn != "0") {
                             $.post("../controller/local_po/local_po_controller.php", {
                            action: 'get_work_order_no',
                            v_prn_no: selectedPrn
                        }, function(result, status) {
                            var obj = jQuery.parseJSON(result);
                            $("#txt_local_po_job_no").val(obj.data[0].work_order_no);
                            $("#txt_local_po_project_no").val(obj.data[0].location);
                        });
                            
                            
                            load_prn_items(selectedPrn);
                        }
                    });
                    
                    $('#tbl_prn_items').removeClass('display').addClass('table table-striped table-bordered');

                    function load_prn_items(prnNumber) {
                        $.post("../controller/local_po/local_po_controller.php", {
                            action: 'get_prn_items',
                            v_prn_no: prnNumber
                        }, function(result, status) {
                            if (status == "success") {
                                try {
                                    var obj = jQuery.parseJSON(result);
                                    
                                    if (obj.data && obj.data.length > 0) {
                                        // Show the PRN items container
                                        $('#prn_items_container').show();
                                        
                                        // Clear the PRN items table
                                        prn_items_table.clear().draw();
                                        
                                        // Reset counter
                                        var prnCounter = 1;
                                        
                                        // Add each item to the PRN table
                                        obj.data.forEach(function(item) {
                                            prn_items_table.row.add([
                                                prnCounter++,
                                                '', // lpo_id
                                                '', // lpo_no
                                                // item.description,
                                                 item.inventory_name,
                                                item.inventory_id,
                                                '', // cat_name
                                                '', // cat_id
                                                '', // item_code
                                                item.quantity,
                                                item.unit,
                                                item.rate,
                                                item.amount,
                                                '%', // disc_type
                                                0, // disc_pr
                                                item.amount, // disc_amount
                                                item.tax, // tax_pr
                                                item.amount, // net_total
                                                '<i class="material-icons view-row" style="cursor: pointer; color: blue; margin-right: 5px;" title="View Item Details">visibility</i>'
                                            ]).draw();
                                        });
                                        
                                        $.toast({
                                            heading: 'Success',
                                            text: 'PRN items loaded successfully!',
                                            showHideTransition: 'slide',
                                            icon: 'success'
                                        });
                                    } else {
                                        $('#prn_items_container').hide();
                                        $.toast({
                                            heading: 'Info',
                                            text: 'No items found for this PRN number',
                                            showHideTransition: 'slide',
                                            icon: 'info'
                                        });
                                    }
                                } catch (e) {
                                    console.error("Error parsing JSON response:", e, result);
                                    $('#prn_items_container').hide();
                                    $.toast({
                                        heading: 'Error',
                                        text: 'Error loading PRN items',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                                }
                            }
                        }).fail(function(xhr, status, error) {
                            console.error("AJAX request failed:", status, error);
                            $('#prn_items_container').hide();
                            $.toast({
                                heading: 'Error',
                                text: 'Failed to load PRN items',
                                showHideTransition: 'slide',
                                icon: 'error'
                            });
                        });
                    }
                   var disabledViewButtons = {};

                    $('#tbl_prn_items').on('click', '.view-row', function() {
                        if ($(this).hasClass('viewed')) {
                            return false; // Prevent action if already clicked
                        }
                        
                        // Get the row data and inventory ID
                        var rowData = prn_items_table.row($(this).closest('tr')).data();
                        var inventory_id = rowData[4]; // itemid is at index 4
                         console.log("qty "+rowData[8])
                        $('#txt_local_po_quantity').val(rowData[8]);
                        // Mark as viewed and change style
                        $(this).addClass('viewed').css({
                            'color': 'gray',
                            'cursor': 'default'
                        }).prop('disabled', true);
                        
                        // Store reference to this button with the inventory ID
                        disabledViewButtons[inventory_id] = $(this);
                        
                        // Call function to get item details and populate form
                        getItemDetailsAndPopulateForm(inventory_id);
                    });
                    
                    function cancel_local_po(v_local_po_number)
                    {
                        
                        $.post("../controller/local_po/local_po_controller.php",{action:'cancel_local_po_list',v_local_po_no:v_local_po_number
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                    
                         });
                       
                    }
   
                
                
                $('#txt_local_po_company_name,#txt_local_po_po_box').keypress(function (e) {
           
                    var str = $(this).val();
                    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                    
                    });
                    $(this).val(str);
        

               });
               
               $('#txt_local_po_quantity, #txt_local_po_amount,#txt_local_po_rate,#txt_product_discount,#txt_tax_percentage').on("keypress", function (e) {
               
                if (e.which != 8 && e.which != 0 && ((e.which < 48 || e.which > 57) && e.which != 46)) {
                    e.preventDefault();
                }
               });
                           
               $('#txt_local_po_contact_no,#txt_local_po_fax').keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       
                        e.preventDefault();
                        return false;
                    }
               });
               
               
                $('#txt_local_po_rate').change(function(){
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var tax_percentage= $('#txt_tax_percentage').val();
                    var discount_percentage= $('#txt_product_discount').val();
					var discount_type = $('#div_product_discount_type option:selected').val();
                    
                
                      if(parseFloat(v_local_po_quantity) > 0 )
                     {
                    
                             var v_amount=(parseFloat(v_local_po_quantity)*parseFloat(v_local_po_rate)).toFixed(3);
                             $('#txt_local_po_amount').val(v_amount);
                             var local_po_amount=$('#txt_local_po_amount').val();
                             $('#txt_amt_after_discount').val(v_amount);
                             var amt_after_discount= $('#txt_amt_after_discount').val();
                             $('#txt_net_amount').val(v_amount);
                             
                              if(parseFloat(discount_percentage) > 0 && discount_type == '%')   
                             {
                               
                               var discount_amount=parseFloat(local_po_amount)*(parseFloat(discount_percentage)/100);
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_amount);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                             }
							 if(parseFloat(discount_percentage) > 0 && discount_type == 'BD')
                             {
                               
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_percentage);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                               
                             }
                             if(parseFloat(tax_percentage) > 0 )
                             {
                               
                               var tax_amount=parseFloat(amt_after_discount)*(parseFloat(tax_percentage)/100);
                               var amt_after_tax=parseFloat(amt_after_discount)+parseFloat(tax_amount);
                               $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                             
                             }
                     
                     }
                     else
                     {
                               $('#txt_local_po_amount').val(0.00);
                               $('#txt_amt_after_discount').val(0.00);
                               $('#txt_net_amount').val(0.00); 
                     }
                    
                     
                     
                 });
                 
                //  ************************* add new supplier **********************
                
                        $("#btn_add_supplier").click(function(){
                            $("#modal_supplier_add").modal('show');
                            
                        });
                
                // *********************** end *************************************
                 
                 
                //  ************************ item change************************
                
        //             $("#div_item_load_lpo").change(function() {
                      
                  
        //                 var item_details=$('option:selected', this).val();
        //                 var item_name_code=$('option:selected', this).text() ;
        //                 // alert(item_details);
        //                 var details_array = item_details.split('$');
        //                 $('#txt_local_po_unit').val(details_array[4]);
        //                 $('#txt_tax_percentage').val(details_array[5]);
        //                 var item_name_code_array = item_name_code.split('*');
                        
        //                 $('#txt_local_po_description').val(item_name_code_array[0]);
    				// });
    				$(document).on('change', '#select_iventory_item', function () {
                        const item_details = $(this).val();
                        const item_name_code = $('option:selected', this).text();
                    
                        const details_array = item_details.split('$');
                        $('#txt_local_po_unit').val(details_array[4]);
                        $('#txt_tax_percentage').val(details_array[5]);
                    
                        const item_name_code_array = item_name_code.split('*');
                        $('#txt_local_po_description').val(item_name_code_array[0]);
                    });

    				
                // ********************** end *************************************
                 $('#div_category_load_v1').load('templates/inventory_main_cateogory.php'); 
                 $('#div_category_load_pur_recie').load('templates/inventory_category_search_com.php'); 
                 
                //  ********************* item add button click******************
                        $("#btn_add_item").click(function(){
                            $("#modal_item_add").modal('show');
                            $('#cat_div').hide();
                            $('#sub_cat_div').hide();
                        });
                
                // *********************** end ***********************************
                 
                //  ********************* btn save item ***************************
                v_btn_generate_inventory.click(function(){
      
                        v_btn_generate_inventory.ladda( 'start' );           
                		var v_category_id=$("#div_category_load_pur_recie option:selected").val();
                		var v_category=$("#div_category_load_pur_recie option:selected").text();
                		var v_sub_category_id = $("#select_inventory_sub_category option:selected").val(); 
                        var v_sub_category = $("#select_inventory_sub_category option:selected").text(); 
                		var v_unit_id=$("#select_product_unit option:selected").val();
                		var v_unit_name=$("#select_product_unit option:selected").text();
                		var v_item_name=$("#txt_item_name").val();
                                  
                
                		if(v_category_id=="0" || v_sub_category_id === "0" || v_unit_id=="0" || v_item_name=="")
                		{ 
                	       v_btn_generate_inventory.ladda( 'stop' );
                	       swal('Warning',"Please fill the required field","warning");
                		}
                		else
                		{	
                			$.post("../controller/inventory/inventory_controller.php",
                			{action:'generate_inventory_item',v_category_id:v_category_id,v_category:v_category,v_sub_category_id: v_sub_category_id,
                                sub_cat_name: v_sub_category,v_unit_name:v_unit_name,v_item_name:v_item_name,v_unit_id:v_unit_id}, 
                			function(result,status)
                			{   
                				result = $.trim(result);
                				console.log(result);
                				v_btn_generate_inventory.ladda( 'stop' );
                					 $.toast({
                						heading: 'Success',
                						text: 'New Item Code: <strong>' + result + '</strong>',
                						showHideTransition: 'slide',
                						icon: 'success',
                						hideAfter: 5000
                					});
                                    // $('#div_item_load_lpo').load('templates/inventory_all_item_load.php');
                                    $('#select_iventory_category').val(0); // Clear selected value if needed
                                    $('#select_iventory_category').trigger('change');
                                    // $('#select_iventory_category option:selected').text("Select Category");
                            	    $('#select_product_unit').val(0);
                                    $("#txt_item_name").val(''); 
                                    $("#modal_item_add").modal('hide');
                		    });
                                
                		}
                    });
                // ************************end ***********************************
                
                 $('#btn_add_category').click(function(){
                     $('#cat_div').show();
                 });
                
                $('#btn_add_sub_category').click(function(){
                    var v_item_name=$("#select_iventory_category").val();
                    if(v_item_name=="0")
            		{ 
            	        swal('Warning',"Please choose category first");
            		}else {
                        $('#sub_cat_div').show();
            		}
                 });
                 
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

                
                $('#btn_save_sub_cat').click(function(){
                    var mainCatId = $("#select_iventory_category").val();
            		var v_sub_category = $("#txt_sub_category").val();
            		if(v_sub_category=="")
            		{ 
            	       swal('Warning',"Please fill the required field","warning");
            		}else{
            		   
            		    $.ajax({
                            url: '../controller/inventory/inventory_controller.php', // Create this file
                            type: 'POST',
                            data: {
                                action:'add_sub_category',
                                v_category_id: mainCatId,
                                sub_cat_name: v_sub_category
                            },
                            success: function(response) {
                                if (response>0) {
                                    swal('Success',"Successfully added to Sub category.");
                                    $('#select_iventory_category').trigger('change');
                                    $("#txt_sub_category").val('');
                                    $('#sub_cat_div').hide();
                                } else {
                                    swal('Error',"Something Went Wrong");
                                }
                            }
                        });
            		}
                });
                
                 // ******************************add category********************************
    
                        $('#btn_save_cat').click(function(){
                      
                    		var v_item_name=$("#txt_category").val();
                                      
                    
                    		if(v_item_name=="")
                    		{ 
                    	       swal('Warning',"Please fill the required field","warning");
                    		}
                    		else
                    		{	
                    			$.post("../controller/inventory/inventory_controller.php",
                    			{action:'generate_inventory_category',v_item_name:v_item_name}, 
                    			function(result,status)
                    			{   
                    				result = $.trim(result);
                    				console.log(result);
                    					 $.toast({
                    						heading: 'Success',
                    						text: 'Item added to Inventory Category..!',
                    						showHideTransition: 'slide',
                    						icon: 'success'
                    					});
                    					$("#txt_category").val("");
                                        $('#div_category_load_pur_recie').load('templates/inventory_category_search_com.php'); 
                                        // $('#modal_category_add').modal('hide');
                                        $('#cat_div').hide();
                                        $('#sub_cat_div').hide();
                    		    });
                                    
                    		}
                        });
                        
                        
                    
    // *********************************end**************************************
                 
                  $('#txt_local_po_quantity').change(function(){
                      
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var tax_percentage= $('#txt_tax_percentage').val();
                    var discount_percentage= $('#txt_product_discount').val();
                    var discount_percentage= $('#txt_product_discount').val();
					var discount_type = $('#div_product_discount_type option:selected').val();
                    
                
                      if(parseFloat(v_local_po_quantity) >= 0 )
                     {
                    
                             var v_amount=(parseFloat(v_local_po_quantity)*parseFloat(v_local_po_rate)).toFixed(3);
                             $('#txt_local_po_amount').val(v_amount);
                             var local_po_amount=$('#txt_local_po_amount').val();
                             $('#txt_amt_after_discount').val(v_amount);
                             var amt_after_discount= $('#txt_amt_after_discount').val();
                             $('#txt_net_amount').val(v_amount);
                              if(parseFloat(discount_percentage) >= 0 &&  discount_type == '%')
                             {
                               
                               var discount_amount=parseFloat(local_po_amount)*(parseFloat(discount_percentage)/100);
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_amount);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                             
                             }
							 if(parseFloat(discount_percentage) >= 0 &&  discount_type == 'BD')
                             {
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_percentage);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                             
                             }
                             if(parseFloat(tax_percentage) >= 0 )
                             {
                               
                               var tax_amount=parseFloat(amt_after_discount)*(parseFloat(tax_percentage)/100);
                               var amt_after_tax=parseFloat(amt_after_discount)+parseFloat(tax_amount);
                               $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                              
                             
                             }
                     
                     }
                    
                    
                     
                  });
                   $('#txt_product_discount').change(function(){
                        
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var tax_percentage= $('#txt_tax_percentage').val();
                    var discount_percentage= $('#txt_product_discount').val();
					var discount_type = $('#div_product_discount_type option:selected').val();
                    
                    
                
                      if(parseFloat(v_local_po_quantity) >= 0 )
                     {
                    
                             var v_amount=(parseFloat(v_local_po_quantity)*parseFloat(v_local_po_rate)).toFixed(3);
                             $('#txt_local_po_amount').val(v_amount);
                             var local_po_amount=$('#txt_local_po_amount').val();
                             $('#txt_amt_after_discount').val(v_amount);
                             var amt_after_discount= $('#txt_amt_after_discount').val();
                             $('#txt_net_amount').val(v_amount);
                              
                              if(parseFloat(discount_percentage) >= 0 &&  discount_type == '%')
                             {
                               
                               var discount_amount=parseFloat(local_po_amount)*(parseFloat(discount_percentage)/100);
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_amount);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                               
                             
                             }
							 if(parseFloat(discount_percentage) >= 0 &&  discount_type == 'BD')
                             {
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_percentage);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                               
                             
                             }
                             if(parseFloat(tax_percentage) >= 0 )
                             {
                               
                               var tax_amount=parseFloat(amt_after_discount)*(parseFloat(tax_percentage)/100);
                               var amt_after_tax=parseFloat(amt_after_discount)+parseFloat(tax_amount);
                               $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                              
                             
                             }
                     
                     }
                   });
                   
                   
                   $('#txt_tax_percentage').change(function(){
                       
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var tax_percentage= $('#txt_tax_percentage').val();
                    var discount_percentage= $('#txt_product_discount').val();
					var discount_type = $('#div_product_discount_type option:selected').val();
                    
                    
                
                      if(parseFloat(v_local_po_quantity) >= 0 )
                     {
                    
                             var v_amount=(parseFloat(v_local_po_quantity)*parseFloat(v_local_po_rate)).toFixed(3);
                             $('#txt_local_po_amount').val(v_amount);
                             var local_po_amount=$('#txt_local_po_amount').val();
                             $('#txt_amt_after_discount').val(v_amount);
                             var amt_after_discount= $('#txt_amt_after_discount').val();
                             $('#txt_net_amount').val(v_amount);
                              
                              if(parseFloat(discount_percentage) >= 0 &&  discount_type == '%')
                             {
                               
                               var discount_amount=parseFloat(local_po_amount)*(parseFloat(discount_percentage)/100);
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_amount);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                               
                             
                             }
							 if(parseFloat(discount_percentage) >= 0 &&  discount_type == 'BD')
                             {
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_percentage);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                               
                             
                             }
                             if(parseFloat(tax_percentage) >= 0 )
                             {
                               
                               var tax_amount=parseFloat(amt_after_discount)*(parseFloat(tax_percentage)/100);
                               var amt_after_tax=parseFloat(amt_after_discount)+parseFloat(tax_amount);
                               $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                              
                             
                             }
                     
                     }
                       
                   });
    //************************** add table function **********************************
    var counter = 1;
    function lpo_items_add_totable(lpo_id, lpo_no, item, itemid, cat_name, cat_id, item_code, qty, unit, rate, amount, disc_type, disc_pr, disc_amount, tax_pr, net_total) {
        var newRow = local_po_list_table.row.add([
            counter++,
            lpo_id,
            lpo_no,
            item,
            itemid,
            cat_name,
            cat_id,
            item_code,
            qty,
            unit,
            rate,
            amount,
            disc_type,
            disc_pr,
            disc_amount,
            tax_pr,
            net_total,
            '<button class="btn btn-danger btn-sm delete-rows">Delete</button>'
        ]).draw();
        
        // Add data attribute to track the inventory ID
        $(newRow.node()).data('inventory-id', itemid);
        
        // Update the footer with the sum
        footer_append();
        
        // Clear the form
        clear_text();
    }

    
    // ************************* end************************************************
    
    // ****************************** footer append*************************************
    
        function footer_append(){
             sum = 0;
                            $('#tbl_local_po_list tbody tr').each(function() {
                                var rowData = local_po_list_table.row(this).data();
                                sum += parseFloat(rowData[16]); // Assuming net_total is at index 16
                            });
                            pageTotal1 = sum;
                            var sum_fortbl = sum.toFixed(3);
                            $('#foot_sum').text(sum_fortbl);
                            console.log("footer sum"+sum);
        }
    
    
    // *************************** end ***************************************************
                 
    // ******************************* add items to table new ***************************
                v_but_local_po_save.click(function(){
                    
                    var item_details=$('#select_iventory_item option:selected').val();
                    var item_name_code=$('#select_iventory_item option:selected').text();
                    var details_array = item_details.split('$');
                    var item_id = details_array[0];
                    console.log("item_details: ", item_details);
                console.log("item_name_code: ", item_name_code);
                    var details_array = item_details.split('$');
                    var item_id = details_array[0];
                    var cat_id = details_array[1];
                    var cat_name = details_array[2];
                    var item_code = details_array[3];
                    var tax_pr = details_array[5];
                    
                    var item_name_code_array = item_name_code.split('*');
                    console.log("details_array: ", details_array);
                    console.log("item_name_code_array: ", item_name_code_array);
                    var item_name = item_name_code_array[0];
                     var quantity=$('#txt_local_po_quantity').val();
                    var v_unit=$('#txt_local_po_unit').val();
                    var v_rate=$('#txt_local_po_rate').val();
                    var v_amount=$('#txt_local_po_amount').val();
                    var v_discount_percentage=$('#txt_product_discount').val()
                    var v_discount_type=$('#div_product_discount_type option:selected').val();
                    var v_amt_after_discount=$('#txt_amt_after_discount').val();
                    var v_tax_percentage=$('#txt_tax_percentage').val();
                    var v_net_amount=$('#txt_net_amount').val();
                    lpo_items_add_totable('','',item_name,item_id,cat_name,cat_id,item_code, quantity, v_unit,v_rate,v_amount,v_discount_type,v_discount_percentage,v_amt_after_discount,v_tax_percentage,v_net_amount);
                });
    
    // ******************************* end *********************************************
    
    
    
    // ******************************** table view for update**********************
    
                function lpo_items_add_totable_for_update(lpo_id, lpo_no, item, itemid, cat_name, cat_id, item_code, qty, unit, rate, amount, disc_type, disc_pr, disc_amount, tax_pr, net_total, hideButtons = false) {
                    // Initialize the row data array
                    let rowData = [
                        counter++,
                        lpo_id,
                        lpo_no,
                        item,
                        itemid,
                        cat_name,
                        cat_id,
                        item_code,
                        qty,
                        unit,
                        rate,
                        amount,
                        disc_type,
                        disc_pr,
                        disc_amount,
                        tax_pr,
                        net_total
                    ];
                
                    // Conditionally add the buttons
                    if (!hideButtons) {
                        rowData.push(
                            '<i class="material-icons delete-row" style="cursor: pointer; color: red; margin-right: 5px;" title="Delete Item">delete</i>' + // Delete icon
                            '<button class="btn btn-primary btn-sm update-row"><i class="material-icons">edit</i></button>' // Edit button
                        );
                    } else {
                        rowData.push('');
                    }
                
                    // Add the row to the table
                    local_po_list_table.row.add(rowData).draw();
                
                    // Update the footer with the sum
                    footer_append();
                }
                
                $('#tbl_local_po_list').on('click', '.view-row', function() {
                    var rowData = local_po_list_table.row($(this).closest('tr')).data();
                    var inventory_id = rowData[4]; // itemid is at index 4
                   
                    // Call function to get item details and populate form
                    getItemDetailsAndPopulateForm(inventory_id);
                });
                
                function getItemDetailsAndPopulateForm(inventory_id) {
                    $.post("../controller/local_po/local_po_controller.php", {
                        action: 'get_item_details',
                        v_inventory_id: inventory_id
                    }, function(result, status) {
                        if (status === "success") {
                            try {
                                var obj = jQuery.parseJSON(result);
                                
                                if (obj.data && obj.data.length > 0) {
                                    var item = obj.data[0];
                                    
                                    // Step 1: Populate Inventory Category dropdown
                                    $('#inventory_cat_v1').val(item.cat_id);
                                    $('#inventory_cat_v1').trigger('chosen:updated');
                
                                    // Step 2: Load subcategories explicitly (without triggering change to avoid race conditions)
                                    $.ajax({
                                        url: '../controller/inventory/inventory_controller.php',
                                        type: 'POST',
                                        data: {
                                            action: 'get_sub_category',
                                            v_category_id: item.cat_id
                                        },
                                        dataType: 'json'
                                    }).then(function(response) {
                                        // Populate Inventory Sub Category dropdown
                                        const $subCat = $('#inventory_sub_cat_v1');
                                        $subCat.empty(); // Clear existing options
                                        $subCat.append('<option value="" selected disabled>Select Sub Category</option>');
                                        $subCat.append('<option value="0">N/A</option>');
                
                                        if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                                            response.data.forEach(function(subItem) {
                                                $subCat.append(`<option value="${subItem.ids}">${subItem.sub_cat_name}</option>`);
                                            });
                                        } else {
                                            $subCat.append('<option disabled>No Sub Categories Available</option>');
                                        }
                                        $subCat.val(item.sub_cat_id); // Set the sub_cat_id
                                        $subCat.trigger('chosen:updated');
                
                                        // Step 3: Load items for the selected subcategory explicitly
                                        return $.ajax({
                                            url: '../controller/inventory/inventory_controller.php',
                                            type: 'POST',
                                            data: {
                                                action: 'get_store_item',
                                                v_category_id: item.cat_id,
                                                v_sub_category_id: item.sub_cat_id
                                            },
                                            dataType: 'json'
                                        });
                                    }).then(function(response) {
                                        // Populate Description (select_iventory_item) dropdown
                                        const $itemSelect = $('#select_iventory_item');
                                        $itemSelect.empty(); // Clear existing options
                                        $itemSelect.append('<option value="0">Select Item</option>');
                
                                        if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                                            response.data.forEach(function(storeItem) {
                                                const value = `${storeItem.item_id}$${storeItem.cat_id}$${storeItem.cat_name}$${storeItem.item_code}$${storeItem.unit}$${storeItem.tax_value}`;
                                                const text = `${storeItem.item_name}*${storeItem.item_code}`;
                                                $itemSelect.append(`<option value="${value}">${text}</option>`);
                                            });
                                        } else {
                                            $itemSelect.append('<option value="0">No Items Available</option>');
                                        }
                                        const formattedValue = `${item.item_id}$${item.cat_id}$${item.cat_name}$${item.item_code}$${item.unit}$${item.tax_value}`;
                                        $itemSelect.val(formattedValue);
                                        $itemSelect.trigger('chosen:updated');
                
                                        // Populate additional fields if needed
                                        $('#txt_local_po_description').val(item.item_name);
                                        $('#txt_local_po_unit').val(item.unit);
                                        $('#txt_tax_percentage').val(item.tax_value);
                                        
                
                                        $.toast({
                                            heading: 'Success',
                                            text: 'Item details loaded successfully!',
                                            showHideTransition: 'slide',
                                            icon: 'success'
                                        });
                                    }).fail(function(xhr, status, error) {
                                        console.error("Error loading subcategories or items:", status, error);
                                        $.toast({
                                            heading: 'Error',
                                            text: 'Failed to load subcategories or item details',
                                            showHideTransition: 'slide',
                                            icon: 'error'
                                        });
                                    });
                                } else {
                                    $.toast({
                                        heading: 'Error',
                                        text: 'No item details found',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                                }
                            } catch (e) {
                                console.error("Error parsing JSON response:", e, result);
                                $.toast({
                                    heading: 'Error',
                                    text: 'Error loading item details',
                                    showHideTransition: 'slide',
                                    icon: 'error'
                                });
                            }
                        }
                    }).fail(function(xhr, status, error) {
                        console.error("AJAX request failed:", status, error);
                        $.toast({
                            heading: 'Error',
                            text: 'Failed to load item details',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
                    });
                }
    
            // function lpo_items_add_totable_for_update(lpo_id,lpo_no,item,itemid,cat_name,cat_id,item_code, qty, unit,rate,amount,disc_type,disc_pr,disc_amount,tax_pr,net_total,hideButtons = false)
            //         { 
            //         local_po_list_table.row.add([
            //         counter++,
            //         lpo_id,
            //         lpo_no,
            //         item,
            //         itemid,
            //         cat_name,
            //         cat_id,
            //         item_code,
            //         qty,
            //         unit,
            //         rate,
            //         amount,
            //         disc_type,
            //         disc_pr,
            //         disc_amount,
            //         tax_pr,
            //         net_total,
            //         if(!hideButtons){
            //             '<button class="btn btn-danger btn-sm delete-row"><i class="material-icons ">delete</i></button>' + // Delete button
            //             '<button class="btn btn-primary btn-sm update-row"><i class="material-icons ">edit</i></button>' // Update button
            //         }
            //     ]).draw();
                       
            //             // Update the footer with the sum
            //             footer_append();
            // }
            
             // Attach click event handler to delete button
                        $('#tbl_local_po_list').on('click', '.delete-row', function() {
                            var rowData = local_po_list_table.row($(this).closest('tr')).data();
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
                            
                                        $.post("../controller/local_po/local_po_test_controller.php",{action:"delete_lpo_child",v_local_po_child_id:v_child_ids},function(result,status){
            											 
            											 //alert(result);
            											    if(result== 1)
            												{
            												    
            												    
                                                                 local_po_list_table.row(row).remove().draw(false);
                                                                 footer_append();
            												}
                                        });
                                        
								  }    
								});
                        });
             
             
                        $('#tbl_local_po_list').on('click', '.delete-rows', function() {
                            var row = $(this).closest('tr');
                            var inventoryId = $(row).data('inventory-id');
                            
                            // Re-enable the corresponding view button in the PRN items table
                            if (inventoryId && disabledViewButtons[inventoryId]) {
                                disabledViewButtons[inventoryId].removeClass('viewed').css({
                                    'color': 'blue',
                                    'cursor': 'pointer'
                                }).prop('disabled', false);
                                
                                // Remove from our tracking object
                                delete disabledViewButtons[inventoryId];
                            }
                            
                            // Remove the row from the table
                            local_po_list_table.row(row).remove().draw(false);
                            footer_append();
                            $('#btn_local_po_edit').hide();
                            $('#btn_local_po_add').show();
                        });
                        
                        $('#tbl_local_po_list').on('click', '.update-row', function() {
                             var row = $(this).closest('tr');
                            var rowData = local_po_list_table.row($(this).closest('tr')).data();
                            var v_child_ids = rowData[1];
                            
                            var description = rowData[3];
                            var qty = rowData[8];
                            var rate=rowData[10];
                            var disc=rowData[13];
                            var taxpr =rowData[15];
                            // var net_amt = rowData[16];
                            
                            // var total_quantity=parseFloat(qty)+parseFloat(stock);
                           
                            // $("#txt_total_quantity").val(total_quantity);
                            // Creating input fields
                            var descInput = '<input type="text" class="form-control"  value="' + description + '" name="desc" style="width:200px">';
                           
                            var qtyInput = '<input type="number" class="form-control" min=0 value="' + qty + '" name="qty" style="width:85px">';
                            var rateInput = '<input type="number" class="form-control" min=0 value="' + rate + '" name="rate" style="width:85px">';
                            var discInput = '<input type="number" class="form-control" min=0 value="' + disc + '" name="disc" style="width:85px">';
                        
                            // Replacing cell content with input fields
                            row.find('td:eq(1)').html(descInput);
                            row.find('td:eq(2)').html(qtyInput); // Replace cell content for qty
                            row.find('td:eq(4)').html(rateInput);
                            row.find('td:eq(6)').html(discInput);
                            
                                // ************************ qty, rate, disc pr change ************************
                                row.find('td:eq(2) input[name="qty"], td:eq(4) input[name="rate"], td:eq(6) input[name="disc"]').on('change', function() {
                                    
                                    var net_amt = row.find('td:eq(9)').html();
                                    var qtyValue = row.find('td:eq(2) input[name="qty"]').val();
                                    var rateValue = row.find('td:eq(4) input[name="rate"]').val();
                                    var discValue = row.find('td:eq(6) input[name="disc"]').val();
                                    // alert(qtyValue+" "+rateValue+" "+discValue);
                                    var amountvalue = parseFloat(qtyValue)*parseFloat(rateValue);
                                    
                                    var amountvalue_tbl = amountvalue.toFixed(3);
                                    row.find('td:eq(5)').html(amountvalue_tbl);
                                    
                                    var dics_amount = (parseFloat(amountvalue)*parseFloat(discValue))/100;
                                    var less_dics_amount = parseFloat(amountvalue)-parseFloat(dics_amount);
                                    
                                    var less_dics_amount_tbl =less_dics_amount.toFixed(3);
                                    row.find('td:eq(7)').html(less_dics_amount_tbl);
                                    
                                    
                                    var tax_amt = (parseFloat(less_dics_amount)*parseFloat(taxpr))/100;
                                    var amount_after_tax = parseFloat(less_dics_amount)+parseFloat(tax_amt);
                                    
                                    var amount_after_tax_tbl = amount_after_tax.toFixed(3);
                                    row.find('td:eq(9)').html(amount_after_tax_tbl);
                                    
                                    console.log("page_total "+pageTotal1+" net amt "+net_amt);
                                    var footer_amt = parseFloat(pageTotal1)-parseFloat(net_amt);
                                    var footer_new = parseFloat(footer_amt)+parseFloat(amount_after_tax);
                                    var footr_fortbl = footer_new.toFixed(3);
                                    $('#foot_sum').text(footr_fortbl);
                                    pageTotal1=footer_new;
                                    
                                });
                                // *********************************************
                                
                                $(this).html('<i class="material-icons ">save</i>').removeClass('update-row').addClass('save-row');

                        });
    
    // ********************************** end *****************************************
    
    // ****************************update table row **************************************
                 $('#tbl_local_po_list').on('click', '.save-row', function() {
                     
                     $('#loadingWrapper').show(); 
                     var row = $(this).closest('tr');
                            var rowData = local_po_list_table.row($(this).closest('tr')).data();
                            var v_child_ids = rowData[1];
                            var v_lpo_no = rowData[2];
                            var qtyValue = row.find('td:eq(2) input[name="qty"]').val();
                            var rateValue = row.find('td:eq(4) input[name="rate"]').val();
                            var item_amt = row.find('td:eq(5)').html();
                            var discValue = row.find('td:eq(6) input[name="disc"]').val();
                            var after_disc_amt = row.find('td:eq(7)').html();
                            var net_amt = row.find('td:eq(9)').html();
                            var descValue = row.find('td:eq(1) input[name="desc"]').val();
                            
                            // pageTotal1
                             $.post("../controller/local_po/local_po_test_controller.php",{action:"update_lpo_child",v_local_po_child_id:v_child_ids,v_local_po_quantity:qtyValue,v_local_po_rate:rateValue,v_local_po_amount:item_amt,v_discount_percentage:discValue,v_amt_after_discount:after_disc_amt,v_net_amount:net_amt,v_local_po_sub_total:pageTotal1,v_local_po_lpo_no:v_lpo_no,v_descValue:descValue },function(result,status){
            											 
											 //alert(result);
											    if(result== 1)
												{
												    
                    									 $.toast({
                                                            heading: 'Success',
                                                            text: 'Updated Successfully..!',
                                                            showHideTransition: 'slide',
                                                            icon: 'success'
                                                        });
												    load_data_to_grid_for_edit(v_lpo_no,false);
                                                    //  local_po_list_table.row(row).remove().draw(false);
                                                    //  footer_append();
												}
												else
												{
												    	 $.toast({
                                                            heading: 'Success',
                                                            text: 'Updated Successfully..!',
                                                            showHideTransition: 'slide',
                                                            icon: 'success'
                                                        });
												    load_data_to_grid_for_edit(v_lpo_no,false);
												}
                            });
                     
                 });
    
    // ****************************** end ************************************************
                 
     // *************************** add items to table old ***************************
    //             v_but_local_po_save.click(function(){
                      
                 
    //                 v_but_local_po_save.ladda( 'start' );
                    
    //                 var v_local_po_company_name=$("#txt_local_po_company_name").val();
				// 	var v_local_po_company_id=$("#txt_local_po_company_id").val();
    //                 var v_local_po_po_box=$("#txt_local_po_po_box").val();
    //                 var v_local_po_contact_no=$("#txt_local_po_contact_no").val();
    //                 var v_local_po_fax=$("#txt_local_po_fax").val();
    //                 //var v_local_po_attn=$("#txt_local_po_attn").val();
    //                 var v_local_po_no=$("#txt_local_po_no").val();
    //                 var v_local_po_date=formatDate($("#txt_local_po_date").val());
    //                 var v_local_po_quotation_ref=$("#txt_local_po_quotation_ref").val();
    //                 var v_local_po_payment=$('#txt_local_po_payment_terms').val();
                    
                    
                    
    //                 var v_local_po_description=$('#txt_local_po_description').val();
                    
    //                 var v_local_po_quantity=$('#txt_local_po_quantity').val();
    //                 var v_local_po_unit=$('#txt_local_po_unit').val();
    //                 var v_local_po_rate=$('#txt_local_po_rate').val();
    //                 var v_local_po_amount=$('#txt_local_po_amount').val();
                    
    //                 var v_discount_percentage=$('#txt_product_discount').val();
				// 	var v_discount_type=$('#div_product_discount_type option:selected').val();
    //                 var v_amt_after_discount=$('#txt_amt_after_discount').val();
    //                 var v_tax_percentage=$('#txt_tax_percentage').val();
				// 	//alert(v_tax_percentage);
    //                 var v_net_amount=$('#txt_net_amount').val();
    // //                 var job_ids = $('#select_supplier_jobNo option:selected').val();
				// // 	console.log(job_ids);
				// // 	var job_name = $('#select_supplier_jobNo option:selected').text();
				// // 	console.log(job_name);
				// // 	var prn_no = $('#select_PR_No option:selected').text();
			 ////       console.log(prn_no);
			 
			 //  	var job_name = $("#txt_local_po_job_no").val();
			 //   var prn_no = $("#txt_purchase_reqsition_number").val();       
    //                 //alert(job_name+'------'+prn_no);
    //               // alert(v_local_po_company_name+'----'+v_local_po_po_box+'----'+v_local_po_contact_no+'----'+v_local_po_fax+'-----'+v_local_po_date);
                  
            
    //                 if($.trim(v_local_po_company_name)==""||$.trim(v_local_po_company_id)==""||$.trim(v_local_po_po_box)==""||$.trim(v_local_po_contact_no)==""||$.trim(v_local_po_fax)==""||$.trim(v_local_po_date)==""||$.trim(v_local_po_quotation_ref)==""||$.trim(v_local_po_payment)==""||$.trim(v_local_po_description)==""||$.trim(v_local_po_quantity)==""||$.trim(v_local_po_unit)==""||$.trim(v_local_po_rate)==""||$.trim(v_local_po_amount)=="")
    //                 {
    //                     swal("Warning","Please provide all the details ....", "warning");
    //                     v_but_local_po_save.ladda( 'stop' );
    //                     return false;
    //                 }
                   
    //                 else
    //                 {         
    //                      $.post("../controller/local_po/local_po_test_controller.php",{action:'add_local_po',v_local_po_company_name:v_local_po_company_name,v_company_id:v_local_po_company_id,v_local_po_po_box:v_local_po_po_box,v_local_po_contact_no:v_local_po_contact_no,v_local_po_fax:v_local_po_fax,v_local_po_no:v_local_po_no,v_local_po_date:v_local_po_date,v_local_po_quotation_ref:v_local_po_quotation_ref,v_local_po_payment:v_local_po_payment,v_local_po_description:v_local_po_description,v_local_po_quantity:v_local_po_quantity,v_local_po_unit:v_local_po_unit,v_local_po_rate:v_local_po_rate,v_local_po_amount:v_local_po_amount,v_discount_percentage:v_discount_percentage,v_discount_type:v_discount_type,v_amt_after_discount:v_amt_after_discount,v_tax_percentage:v_tax_percentage,v_net_amount:v_net_amount,v_job_name:job_name,v_prn_no:prn_no
    //                             }
    //                             , function(result,status)
    //                             {
                                   
    //                             result = $.trim(result);
                               
    //                             if(result.charAt(0)=='U')
    //                             {
    //                                 v_but_local_po_save.ladda( 'stop' );
    //                                 swal("Error", result, "error");
    //                                 //load_data_to_grid_local_po_list()
    //                                 clear_text()
                                   

                                
    //                             }
    //                             else 
    //                             {
    //                                  v_but_local_po_save.ladda( 'stop' );
                                    
    //                                  //swal("Success"," local_po added Successfully", "success");
    //                                  $.toast({
    //                                     heading: 'Success',
    //                                     text: 'Item added  successfully..!',
    //                                     showHideTransition: 'slide',
    //                                     icon: 'success'
    //                                 });
                                    
                                    
                                    
    //                                  $("#txt_local_po_no").val(result);
    //                                  $("#local_po_no_head").html(result);
    //                                  $("#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_no,#txt_local_po_date,#txt_local_po_quotation_ref,#txt_local_po_payment_terms").prop("readonly",true);
                                     
                                     
    //                                 load_data_to_grid_local_po_list(result);
    //                                 load_supplier_select_box('div_company_select','select_company');
                                    
                                    
    //                                  clear_text()
                                    
    //                             }
                                
                                 
                            
    //                     });
                        
                       
                        
    //                  }
                  
    //             });
    // ********************************* end *********************************************
                
               
                      
                 function clear_text()
                 {
                     
                    $('#div_item_load_lpo option:selected').val('');
                    $('#txt_local_po_quantity').val('');
                    $('#txt_local_po_unit').val('');
                    $('#txt_local_po_rate').val('');
                    $('#txt_local_po_amount').val('');
                   
                    $('#txt_discount_percentage').val(0.00);
                    $('#txt_product_discount').val(0);
                    $('#txt_amt_after_discount').val('');
                    $('#txt_tax_percentage').val('');
                    $('#txt_net_amount').val('');
                    $("#select_iventory_item").val(0);
                    $("#select_iventory_item").trigger("chosen:updated");
                   
                 }
            
    //****************************** table load function old ************************** 
            
        //         function load_data_to_grid_local_po_list(local_po_no)
        //          {
        //              local_po_list_table.destroy();
                         
        //              local_po_list_table = $('#tbl_local_po_list').DataTable( {
                            
        //                      "ajax": {
        //                          'type': 'POST',
        //                          'url': '../controller/local_po/local_po_test_controller.php',
        //                          'data': {
        //                             action: 'list_local_po',
        //                             v_local_po_no:local_po_no
        //                          }
        //                      },
        //                      "language": {
        //                          "zeroRecords": "No records available",
        //                          "infoEmpty": "No records available",
        //                       },
        //                     "order": [[ 0, "desc" ]],
        //     				"bPaginate": false,
        //     				"bLengthChange": false,
        //     				"bFilter": false,
        //     				"bInfo": false,
        //     				"autoWidth": false,
        //     				"scrollY": 300,
        //                     "scrollX": true,
        //                     "scroller": true,
        //     			    "fixedHeader": {
        //                         header: false,
        //                       footer: false
        //                     },
        //                     "columns": [
        //                          { "data": null },
        //                          { "data": "local_po_child_id","visible":false },
        //                          { "data": "local_po_no","visible":false },
        //                          { "data": "description", width:"50%"},
        //                          { "data": "quantity"},
        //                          { "data": "unit"},
        //                          { "data": "rate", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
        //     					 { "data": "amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
								//  { "data": "discount_type","visible":false },
        //     					 { "data": "discount_precentage",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, ''),
								//  "render": function (data, type, rows) {
								// 		var discountType = rows.discount_type; // Replace 'discount_type' with your actual column name
								// 		return data + " (" + discountType + ")";
								// 	}
								//  },
        //                          { "data": "discount_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
        //                          { "data": "vat_percentage", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
        //     					 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
        //     					 { "data": "local_po_child_id" ,
					 
                     
        //                               render: function ( data, type, rows, meta ) {
            						
        //     									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_local_po" name="edit_local_po" ><i class="material-icons ">edit</i></button>';
            								
        //     								return str_active_status_view;
            
        //     							 },
            							 
            					

					 
					   //       },
        //     			      { "data": "local_po_child_id" ,
					 
                     
        //                               render: function ( data, type, rows, meta ) {
            						
        //     									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_local_po" name="delete_local_po" ><i class="material-icons ">delete</i></button>';
            								
        //     								return str_active_status_view;
            
        //     							 },
					 
					   //      },	 
             
             
        //                      ],
        //                      pageLength: 25,
        //     				 searching: false,
        //                     // responsive: true,
            				
                            
                            
        //                      "initComplete": function( settings, json ) {
                                    
                               
             
        //                       },
        //                       "fnDrawCallback": function() {
                               
             
        //                      },
                             
        //                       "fnRowCallback": function (nRow, aData, iDisplayIndex) {
        //                          $("td:eq(0)", nRow).html(iDisplayIndex + 1);
        //                          return nRow;
        //                      },
        //                      "footerCallback": function ( row, data, start, end, display ) {
        //                     var api = this.api(), data;
                 
        //                     // Remove the formatting to get integer data for summation
        //                     var intVal = function ( i ) {
        //                         return typeof i === 'string' ?
        //                             i.replace(/[\$,]/g, '')*1 :
        //                             typeof i === 'number' ?
        //                                 i : 0;
        //                     };
                 
        //                     // Total over all pages Income
        //                     total1 = api
        //                         .column( 11 )
        //                         .data()
        //                         .reduce( function (a, b) {
                                    
        //                             return intVal(a) + intVal(b);
        //                         }, 0 );
                           
        //                     // Total over this page Income
        //                     pageTotal1 = api
        //                         .column( 12, { page: 'current'} )
        //                         .data()
        //                         .reduce( function (a, b) {
        //                             return intVal(a) + intVal(b);
        //                         }, 0 );
                           
        //                     // Update footer
        //                     $( api.column( 11 ).footer() ).html(
        //                         pageTotal1.toFixed(3)
        //                     );
                            
        //                           var v_local_po_discount=$('#txt_local_po_discount').val();
 
        //                             if(parseFloat(v_local_po_discount)>0)
        //                             {
                                    
        //                             var total_amount=(parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_local_po_discount))/100)).toFixed(3);
        //                             $('#txt_local_po_total_amount').val(total_amount);
        //                             }
                                    
        //                             var v_local_po_vat =$('#txt_local_po_vat').val();
        //                             if(parseFloat(v_local_po_vat)>0)
        //                             {
                                    
        //                             var v_local_po_total_amount=$('#txt_local_po_total_amount').val(); 
                                   
        //                             var balance_amount=(parseFloat(v_local_po_total_amount)+((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)).toFixed(3);
        //                             $('#txt_local_po_balance_due').val(balance_amount);
        //                             }
                                   
                           
                           
        //                 }
                        
                         
        //              });  
                
        //          }
                 
    // ******************************* end *********************************************** 
                 
                 $('#txt_local_po_vat').change(function(){
                     
                     
                     var v_local_po_total_amount=$('#txt_local_po_total_amount').val(); 
                     var v_local_po_vat=$('#txt_local_po_vat').val();
                     var balance_amount=(parseFloat(v_local_po_total_amount)+((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)).toFixed(3);
                     $('#txt_local_po_balance_due').val(balance_amount);
                     
                     
                    
                     
                     
                 });
                 
                 $('#txt_local_po_discount').change(function(){
                     
                     var v_local_po_discount=$('#txt_local_po_discount').val();
                     var total_amount=(parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_local_po_discount))/100)).toFixed(3);
                     $('#txt_local_po_total_amount').val(total_amount);
                     var v_local_po_total_amount=$('#txt_local_po_total_amount').val();
                     
                     var v_local_po_vat=$('#txt_local_po_vat').val(); 
                     
                     if(v_local_po_vat>0)
                     {
                     
                     var balance_amount=(parseFloat(v_local_po_total_amount)+((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)).toFixed(3);
                     $('#txt_local_po_balance_due').val(balance_amount);
                     var v_local_po_balance_due= $('#txt_local_po_balance_due').val(); 
                     
                     }
                     
                     
                 }); 
                 
                 
        // *****************************************generate local po ****************
                $('#btn_generate_local_po').click(function(){
                    $('#prn_items_container').hide();
                    v_btn_generate_local_po.ladda( 'start' );
                    
                    var dataArray = [];
                    // Iterate through each row in the DataTable
                    local_po_list_table.rows().every(function() {
                        var data = this.data();
                        dataArray.push({
                            'Counter': data[0],
                            'lpo_id': data[1],
                            'lpo_no': data[2],
                            'item': data[3],
                            'itemid': data[4],
                            'cat_name': data[5],
                            'cat_id': data[6],
                            'item_code': data[7],
                            'qty': data[8],
                            'unit': data[9],
                            'rate': data[10],
                            'amount': data[11],
                            'disc_type': data[12],
                            'disc_pr': data[13],
                            'disc_amount': data[14],
                            'tax_pr': data[15],
                            'net_total': data[16]
                        });
                    });
                
                    // Collect form data
                    var v_local_po_company_name = $("#txt_local_po_company_name").val();
                    var v_local_po_company_id = $("#txt_local_po_company_id").val();
                    var v_local_po_po_box = $("#txt_local_po_po_box").val();
                    var v_local_po_contact_no = $("#txt_local_po_contact_no").val();
                    var v_local_po_fax = $("#txt_local_po_fax").val();
                    var v_local_po_no = $("#txt_local_po_no").val();
                    var v_local_po_date = formatDate($("#txt_local_po_date").val());
                    var v_local_po_quotation_ref = $("#txt_local_po_quotation_ref").val();
                    var v_local_po_payment = $('#txt_local_po_payment_terms').val();
                    var job_name = $("#txt_local_po_job_no").val();
                    var prn_no = $("#txt_purchase_reqsition_number option:selected").text(); // Updated to get selected text
                    var v_local_po_vat = $('#txt_local_po_vat').val();
                    var v_local_po_total_amount = $('#txt_local_po_total_amount').val();
                    var v_local_po_discount = $('#txt_local_po_discount').val();
                    var v_local_po_balance_due = $('#txt_local_po_balance_due').val();
                    var v_local_po_all_description = editor.getData();
                    var v_local_po_sub_total = pageTotal1;
                
                    // Validation
                    if ($.trim(v_local_po_all_description) == "" || $.trim(v_local_po_company_name) == "" || $.trim(v_local_po_company_id) == "" || $.trim(v_local_po_po_box) == "" || $.trim(v_local_po_contact_no) == "" || $.trim(v_local_po_fax) == "" || $.trim(v_local_po_date) == "" || $.trim(v_local_po_quotation_ref) == "" || $.trim(v_local_po_payment) == "") {
                        swal("Warning", "Please Fill All The Fields", "warning");
                        v_btn_generate_local_po.ladda('stop');
                        return;
                    }
                
                    // AJAX call to generate LPO
                    $.post("../controller/local_po/local_po_test_controller.php", {
                        action: 'generate_local_po',
                        dataArray: dataArray,
                        v_local_po_no: v_local_po_no,
                        v_local_po_vat: v_local_po_vat,
                        v_local_po_total_amount: v_local_po_total_amount,
                        v_local_po_discount: v_local_po_discount,
                        v_local_po_balance_due: v_local_po_balance_due,
                        v_local_po_all_description: v_local_po_all_description,
                        v_local_po_sub_total: v_local_po_sub_total,
                        v_job_name: job_name,
                        v_prn_no: prn_no, // Pass the selected text
                        v_local_po_company_name: v_local_po_company_name,
                        v_company_id: v_local_po_company_id,
                        v_local_po_po_box: v_local_po_po_box,
                        v_local_po_contact_no: v_local_po_contact_no,
                        v_local_po_fax: v_local_po_fax,
                        v_local_po_date: v_local_po_date,
                        v_local_po_quotation_ref: v_local_po_quotation_ref,
                        v_local_po_payment: v_local_po_payment
                    }, function(result, status) {
                        result = $.trim(result);
                        if (result.charAt(0) == 'U') {
                            v_btn_generate_local_po.ladda('stop');
                            swal("Error", result, "error");
                        } else {
                            v_btn_generate_local_po.ladda('stop');
                            $.toast({
                                heading: 'Success',
                                text: 'Item added successfully..!',
                                showHideTransition: 'slide',
                                icon: 'success'
                            });
                            $("#txt_local_po_no").val(result);
                            $("#local_po_no_head").html(result);
                            $("#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_no,#txt_local_po_date,#txt_local_po_quotation_ref,#txt_local_po_payment_terms").prop("readonly", true);
                            $("#btn_generate_local_po").hide();
                            $('#tbl_local_po_list').find('.delete-rows').hide();
                        }
                    });
                });
        
        // ************************* end ********************************************
                 
    //  *************************************** generate local_po old *********************
                //   $('#btn_generate_local_po').click(function(){
                 
                //     var v_local_po_vat=$('#txt_local_po_vat').val();
                //     var v_local_po_total_amount=$('#txt_local_po_total_amount').val();
                //     var v_local_po_discount=$('#txt_local_po_discount').val();
                //     var v_local_po_balance_due=$('#txt_local_po_balance_due').val();
                //     var v_local_po_no=$("#txt_local_po_no").val();
                //     var v_local_po_all_description=$("#txt_local_po_all_description").val();
                //     const editorData = editor.getData();
                   
                //     var v_local_po_all_description= editorData;
                //     var v_local_po_sub_total=pageTotal1;
                    
                //     if($.trim(v_local_po_all_description)=="")
                //      {
                //         swal("Warning"," Please Fill All The Fields ", "warning");
                        
                        
                //      }
                //      else
                //      {
                //       $.post("../controller/local_po/local_po_controller.php",{action:'generate_local_po',v_local_po_no:v_local_po_no,v_local_po_vat:v_local_po_vat,v_local_po_total_amount:v_local_po_total_amount,v_local_po_discount:v_local_po_discount,v_local_po_balance_due:v_local_po_balance_due,v_local_po_all_description:v_local_po_all_description,v_local_po_sub_total:v_local_po_sub_total
                //                 }
                               
                //                 , function(result,status)
                //                 {
                //                   if(result=="success")
                //                   {
                //                     swal("Success"," LPO generated successfully", "success"); 
                //                      $('#btn_generate_local_po').hide();
                //                      $('#btn_edit_local_po').show();
                //                   // clear_all_after_generate_local_po();
                //                     $("#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_no,#txt_local_po_date,#txt_local_po_quotation_ref,#txt_local_po_payment_terms").prop("readonly",false);
                                     
                //                   }
                //                   else
                //                   {
                //                     swal("Error","Some Error Occurs...", "error"); 
                //                     clear_all_after_generate_local_po(); 
                //                   }
                //           });
                //      }
                //   });
                  
    // ***************************************** end **********************************************  
                
                 
                  
                 function clear_all_after_generate_local_po()
                 {
                   $('#txt_local_po_vat,#txt_local_po_total_amount,#txt_local_po_discount,#txt_local_po_balance_due,#txt_local_po_no,#txt_local_po_all_description,#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_quotation_ref,#txt_local_po_payment_terms,#txt_discount_percentage,#txt_amt_after_discount,#txt_tax_percentage,#txt_net_amount').val('');  
                   $("#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_no,#txt_local_po_date,#txt_local_po_quotation_ref,#txt_local_po_payment_terms").prop("readonly",false);
                   var local_po_no=0;
                   load_data_to_grid_local_po_list(local_po_no);
                 }
                 
                 
                 function load_data_to_grid_view_local_po_list()
                 {
                     local_po_view_list_table.destroy();
                         
                     local_po_view_list_table = $('#list_of_local_pos').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/local_po/local_po_controller.php',
                                 'data': {
                                    action: 'list_local_po_view',
                                    
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
                              
                                 { "data": "local_po_main_id","visible":false },
                                 { "data": "local_po_date"},
                                 { "data": "local_po_number"},
                                 { "data": "prn_number"},
                                 { "data": "job_name"},
                                 { "data": "project_no"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                 { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_local_po" name="view_local_po" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
    					 
    					         },
    					         { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                                              if(rows["qty_pr"]==0)
                                              {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_local_po" name="delete_local_po" ><i class="material-icons ">delete</i></button>';
                								
                								return str_active_status_view;
                                              }
                                              else{
                                                  return '<span class="badge badge-success" style="font-size: 14px;cursor: help;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="You already generated a Purchase Received, you can not delete this item">Purchase Received</span>';
                                              }
                							 },
    					 
    					         },
             
             
                             ],
                            pageLength: 25,
            				 searching: true,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              $('#loadingWrapper').hide(); 
                                                      
                                // Optionally, you can apply the CSS here if needed
                                $('.dataTables_filter input').css({
                                    width: '200px',
                                    padding: '5px'
                                });
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 }
                 
                  function load_data_to_grid_view_cancel_local_po_list()
                 {
                     local_po_view_cancelled_list_table.destroy();
                         
                     local_po_view_cancelled_list_table = $('#list_of_cancelled_local_pos').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/local_po/local_po_controller.php',
                                 'data': {
                                    action: 'list_cancelled_local_po_view',
                                    
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
                              
                                 { "data": "local_po_main_id","visible":false },
                                 { "data": "local_po_date"},
                                 { "data": "local_po_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                  { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="closeNavRCancel()" id="view_cancel_local_po" name="view_cancel_local_po" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
    					 
    					         }
             
                             ],
                             pageLength: 25,
            				 searching: true,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              $('#loadingWrapper').hide(); 
                                                      
                                // Optionally, you can apply the CSS here if needed
                                $('.dataTables_filter input').css({
                                    width: '200px',
                                    padding: '5px'
                                });
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 }
                 
                 
                 function load_data_to_grid_view_local_po_list_between(v_local_po_from_date,v_local_po_to_date)
                 {
                      local_po_view_list_table.destroy();
                         
                     local_po_view_list_table = $('#list_of_local_pos').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/local_po/local_po_controller.php',
                                 'data': {
                                    action: 'list_local_po_view_between',
                                    v_local_po_from_date:v_local_po_from_date,
                                    v_local_po_to_date:v_local_po_to_date
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
                              
                                 { "data": "local_po_main_id","visible":false },
                                 { "data": "local_po_date"},
                                 { "data": "local_po_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                 { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_local_po" name="view_local_po" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
    					 
    					         },
    					         { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                                              
                                              if(rows["qty_pr"]==0)
                                              {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_local_po" name="delete_local_po" ><i class="material-icons ">delete</i></button>';
                								
                								return str_active_status_view;
                                              }
                                              else{
                                                  return '<span class="badge badge-success" style="font-size: 14px;cursor: help;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="You already generated a Purchase Received, you can not delete this item">Purchase Received</span>';
                                              }
                							 },
    					 
    					         },
             
                             ],
                             pageLength: 25,
            				 searching: true,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              $('#loadingWrapper').hide(); 
                                                      
                                // Optionally, you can apply the CSS here if needed
                                $('.dataTables_filter input').css({
                                    width: '200px',
                                    padding: '5px'
                                });
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 
                 }
                 
                 
                 $('#btn_create_new_local_po').click(function(){
                  
                  location.reload();
                  
                 });
                 
                  function load_data_to_grid_view_cancel_local_po_list_between(v_local_po_from_date,v_local_po_to_date)
                 {
                      local_po_view_cancelled_list_table.destroy();
                         
                     local_po_view_cancelled_list_table = $('#list_of_cancelled_local_pos').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/local_po/local_po_controller.php',
                                 'data': {
                                    action: 'list_local_po_cancel_view_between',
                                    v_local_po_from_date:v_local_po_from_date,
                                    v_local_po_to_date:v_local_po_to_date
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
                              
                                 { "data": "local_po_main_id","visible":false },
                                 { "data": "local_po_date"},
                                 { "data": "local_po_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                 { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="closeNavRCancel()" id="view_cancel_local_po" name="view_cancel_local_po" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
    					 
    					         }
             
                             ],
                             pageLength: 25,
            				 pageLength: 25,
            				 searching: true,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              $('#loadingWrapper').hide(); 
                                                      
                                // Optionally, you can apply the CSS here if needed
                                $('.dataTables_filter input').css({
                                    width: '200px',
                                    padding: '5px'
                                });
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 
                 }
                 
                 $('#list_of_cancelled_local_pos tbody').on('click', 'td button', function (){
                    
                        var $row = $(this).closest('tr');
                        var data = local_po_view_cancelled_list_table.row($row).data();
                        v_local_po_number  = data.local_po_number;
						var v_jobname=data.job_name;
						var pnr_number=data.prn_number;
						console.log(data.job_name);
						console.log(data.address);
                        $('#txt_local_po_description').val('');
                        $('#txt_local_po_quantity').val('');
                        $('#txt_local_po_unit').val('');
                        $('#txt_local_po_rate').val('');
                        $('#txt_local_po_amount').val('');
                        $( '#btn_local_po_add' ).show();
                        $( '#btn_local_po_edit' ).hide();   
                       if($(this).attr("name")=='view_cancel_local_po')
                         {
                   
                                //  $('#div_company_select option').map(function () {
                                // if ($(this).text() == data.company_name) return this;
                                // }).attr('selected', 'selected');
                                 $("#select_company").val(data.company_id);
                                $("#select_company").trigger("chosen:updated");
                                  
                                $("#txt_local_po_company_name").val(data.company_name);
                                $("#txt_local_po_po_box").val(data.po_box);
                                $("#txt_local_po_contact_no").val(data.telephone_no);
                                $("#txt_local_po_fax").val(data.fax);
                                $("#txt_local_po_attn").val(data.attn);
                                $("#txt_local_po_no").val(data.local_po_number);
                                
                                var local_date=data.local_po_date.split(' ');
                                var local_po_date= local_date[0].split('-');
                                var local_po_date=local_po_date[1]+'/'+local_po_date[0]+'/'+local_po_date[2];
                                $("#txt_local_po_date").val(local_po_date);
                               
                                $("#txt_local_po_quotation_ref").val(data.quotation_reference);
                                $('#txt_local_po_payment_terms').val(data.payment_terms);
                                load_data_to_grid_local_po_list(data.local_po_number);
                                
                                $('#txt_local_po_quantity').val(data.quantity);
                                $('#txt_local_po_unit').val(data.unit);
                                $('#txt_local_po_rate').val(data.rate);
                                $('#txt_local_po_amount').val(data.amount);
                               
                              
                                $('#txt_discount_percentage').val(data.discount_precentage);
                                $('#txt_amt_after_discount').val(data.discount_amount);
                                $('#txt_tax_percentage').val(data.vat_percentage);
                                $('#txt_net_amount').val(data.net_amount);
                                
                                
                                
                                $("#txt_local_po_all_description").val(data.description);
                                //$( '#btn_local_po_add' ).hide();
                               // $( '#btn_local_po_edit' ).show();
                                
                                
                                $("#local_po_no_head").html(data.local_po_number);
								$('#div_job_num_select option').map(function () {
								 if ($(this).text() == data.job_name) return this;
								 }).attr('selected', 'selected');
								$("#div_prno_select").load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1',v_jobNo:v_jobname,v_prnn_no:pnr_number},function(result,status){  
								if(status=="success")
								{
								
									$('#div_prno_select option').map(function () {
                                        if ($(this).text() == data.prn_number) return this;
                                     }).attr('selected', 'selected');
								}
							
								});
                                // $('#btn_generate_local_po' ).hide();
                                 $('#btn_edit_local_po' ).hide();
                                 
                                
                                closeNavR();
                              
                     } 
                        
                       
                  
                   });
                   
                   
                   
                   
                 
                  $('#list_of_local_pos tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = local_po_view_list_table.row($row).data();
                        v_local_po_number  = data.local_po_number;
						var v_jobname=data.job_name;
						var pnr_number=data.prn_number;
						 console.log(data);
						 
						 $('#div_add_item').hide();
				// 		console.log(data.job_name);
				// 		console.log(data.address);
                        $('#txt_local_po_description').val('');
                        $('#txt_local_po_quantity').val('');
                        $('#txt_local_po_unit').val('');
                        $('#txt_local_po_rate').val('');
                        $('#txt_local_po_amount').val('');
                        $( '#btn_local_po_add' ).show();
                        $( '#btn_local_po_edit' ).hide();   
                       if($(this).attr("name")=='view_local_po')
                         {
                                $('#loadingWrapper').show();
                                // $('#select_company option').map(function () {
                                // if ($(this).text() == data.company_name) return this;
                                // }).attr('selected', 'selected');
                              
                                $("#txt_local_po_company_name").val(data.company_name);
                                $("#select_company").val(data.company_id);
                                $("#select_company").trigger("chosen:updated");
                                $('#select_company').val(data.company_id).trigger('change');
                                $("#txt_local_po_po_box").val(data.po_box);
                                $("#txt_local_po_contact_no").val(data.telephone_no);
                                $("#txt_local_po_fax").val(data.fax);
                                $("#txt_local_po_attn").val(data.attn);
                                $("#txt_local_po_no").val(data.local_po_number);
                                
                                var local_date=data.local_po_date.split(' ');
                                var local_po_date= local_date[0].split('-');
                                var local_po_date=local_po_date[1]+'/'+local_po_date[0]+'/'+local_po_date[2];
                                $("#txt_local_po_date").val(local_po_date);
                                
                                $("#txt_local_po_quotation_ref").val(data.quotation_reference);
                                $('#txt_local_po_payment_terms').val(data.payment_terms);
                                
                                $("#txt_local_po_job_no").val(data.job_name);
                                // $('#txt_purchase_reqsition_number').val(data.prn_number).trigger('change');
                                 $("#txt_purchase_reqsition_number").val(data.prn_number);
                                $("#txt_purchase_reqsition_number").trigger("chosen:updated");
                                console.log(data.prn_number);
                                //  $("#txt_purchase_reqsition_number").trigger('change');
                                 $('#txt_local_po_project_no').val(data.project_no);
                                // load_data_to_grid_local_po_list(data.local_po_number);
                                var v_pr_status = data.qty_pr;
                                // ******** datatable load**************
                                if(v_pr_status>0){
                                    load_data_to_grid_for_edit(data.local_po_number,true);
                                }
                                else{
                                    load_data_to_grid_for_edit(data.local_po_number,false);
                                }
                                // load_data_to_grid_for_edit(data.local_po_number,v_pr_status);
                                // **************end****************
                                
                                $('#txt_local_po_quantity').val(data.quantity);
                                $('#txt_local_po_unit').val(data.unit);
                                $('#txt_local_po_rate').val(data.rate);
                                $('#txt_local_po_amount').val(data.amount);
                               
                                $('#sel_dis_type').val('%');
                                $('#txt_product_discount').val(data.discount_precentage);
                                $('#txt_amt_after_discount').val(data.discount_amount);
                                $('#txt_tax_percentage').val(data.vat_percentage);
                                $('#txt_net_amount').val(data.net_amount);
								$('#div_job_num_select option').map(function () {
								 if ($(this).text() == data.job_name) return this;
								 }).attr('selected', 'selected');
								$("#div_prno_select").load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1',v_jobNo:v_jobname,v_prnn_no:pnr_number},function(result,status){  
								if(status=="success")
								{
								
									$('#div_prno_select option').map(function () {
                                        if ($(this).text() == data.prn_number) return this;
                                     }).attr('selected', 'selected');
								}
							
								});
								const editorData_lpo = editor.setData(data.description);
                                $("#txt_local_po_all_description").val(editorData_lpo); 
                                //$( '#btn_local_po_add' ).hide();
                               // $( '#btn_local_po_edit' ).show();
                                
                                
                                $("#local_po_no_head").html(data.local_po_number);
                                 $('#btn_generate_local_po' ).hide();
                                 $('#btn_edit_local_po' ).show();
                                 
                                
                                closeNavR();
                              
                     }
                      if($(this).attr("name")=='delete_local_po')
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
            						
            						       cancel_local_po(v_local_po_number);
                         				    load_data_to_grid_view_local_po_list(); 
                         				
            							} else {
            							    
            							   
            							 
            							}
            						 });
                     }			 
                     
                     
                      
                  });
                 

                 
                 $("#txt_end_date").on("change", function() {
                     var v_local_po_from_date = formatDate($("#txt_start_date").val());
                     var v_local_po_to_date = formatDate($("#txt_end_date").val());
                     load_data_to_grid_view_local_po_list_between(v_local_po_from_date,v_local_po_to_date);
                   
                  });
                  
    // *********************************funtion load data datatable for edit ***************
    
    function load_data_to_grid_for_edit(local_po_no,pr_button_hide=false)
    {
        local_po_list_table.clear().draw();
        $.post("../controller/local_po/local_po_test_controller.php",{action:'list_local_po',v_local_po_no:local_po_no}
        ,function(result,status){
                        $('#loadingWrapper').hide();
                                if(status=="success")
                                {
                                var obj= jQuery.parseJSON(result);
                                console.log(obj);
                                
                                obj.data.forEach(function(item) {
                                    if(!pr_button_hide){
                                        lpo_items_add_totable_for_update(item.local_po_child_id, item.local_po_no, item.description, item.item_id, item.category_name, item.category_id, item.item_code, item.quantity, item.unit, item.rate,item.amount,item.discount_type,item.discount_precentage,item.discount_amount,item.vat_percentage,item.net_amount,false);
                                    }
                                    else{
                                        lpo_items_add_totable_for_update(item.local_po_child_id, item.local_po_no, item.description, item.item_id, item.category_name, item.category_id, item.item_code, item.quantity, item.unit, item.rate,item.amount,item.discount_type,item.discount_precentage,item.discount_amount,item.vat_percentage,item.net_amount,true);
                                    }
                                // lpo_items_add_totable_for_update(item.local_po_child_id, item.local_po_no, item.description, item.item_id, item.category_name, item.category_id, item.item_code, item.quantity, item.unit, item.rate,item.amount,item.discount_type,item.discount_precentage,item.discount_amount,item.vat_percentage,item.net_amount);

                                });
                                
                                }else
                                {
                                    return false;
                                }
						   });  
    }
    
    // *************************************end ****************************************
                  
                 
                                 
                //  $('#list_of_local_pos tbody').on('dblclick', 'tr', function(){
                //         var $row = $(this).closest('tr');
                //         var data = local_po_view_list_table.row($row).data();
                //         v_local_po_number  = data.local_po_number;
                //         $('#txt_local_po_description').val('');
                //         $('#txt_local_po_quantity').val('');
                //         $('#txt_local_po_unit').val('');
                //         $('#txt_local_po_rate').val('');
                //         $('#txt_local_po_amount').val('');
                //         $( '#btn_local_po_add' ).show();
                //         $( '#btn_local_po_edit' ).hide();
                //          swal("Do you want to Edit or Delete?", {
                //                       buttons: {
                //                         cancel: "Cancel",
                //                         catch: {
                //                           text: "Edit",
                //                           value: "catch",
                //                         },
                //                         defeat: {
                //                           text: "Delete",
                //                           value: "delete",
                //                         },
                //                       },
                //                     })
                //                     .then((value) => {
                //                       switch (value) {
                                     
                //                         case "delete":
                //                                                  swal({
                                                                    
                //                         							title: "Are you sure?",
                //                         							text: "Do you want to delete the entry?",
                //                         							icon: 'warning',
                //                         							dangerMode: true,
                //                         							allowOutsideClick: false,
                //                                                     closeOnClickOutside: false,
                //                         							buttons: {
                //                         							  cancel: 'No Cancel !',
                //                         							  delete: 'Yes Please Delete'
                //                         							}
                //                         							}).then(function (willDelete) {
                //                         							if (willDelete) {
                                        						
                //                         						       cancel_local_po(v_local_po_number);
                                                     						 
                //                         							} else {
                                        							    
                                        							   
                                        							 
                //                         							}
                //                         						 });
                //                           break;
                                     
                //                           case "catch":
                                          
                //                           //swal("Edit!", "Please Edit your data", "success");
                //                           edit_data();
                //                           closeNavR();
                                          
                //                           break;
                                     
                //                         default:
                //                           //swal("Got away safely!");
                //                       }
                            
                //       });    
                        
                //      function  edit_data() 
                //       {
                           
                //          $('#div_company_select option').map(function () {
                //         if ($(this).text() == data.company_name) return this;
                //         }).attr('selected', 'selected');
                          
                //         $("#txt_local_po_company_name").val(data.company_name);
                //         $("#txt_local_po_po_box").val(data.po_box);
                //         $("#txt_local_po_contact_no").val(data.telephone_no);
                //         $("#txt_local_po_fax").val(data.fax);
                //         $("#txt_local_po_attn").val(data.attn);
                //         $("#txt_local_po_no").val(data.local_po_number);
                //         var local_date=data.local_po_date.split(' ');
                //         var local_po_date= local_date[0].split('-');
                //         var local_po_date=local_po_date[1]+'/'+local_po_date[0]+'/'+local_po_date[2];
                //         $("#txt_local_po_date").val(local_po_date);
                        
                //         $("#txt_local_po_quotation_ref").val(data.quotation_reference);
                //         $('#txt_local_po_payment_terms').val(data.payment_terms);
                //         load_data_to_grid_local_po_list(data.local_po_number);
                       
                      
                //         $('#txt_local_po_vat').val(data.vat);
                //         $('#txt_local_po_total_amount').val(data.total_amount);
                //         $('#txt_local_po_discount').val(data.less_discount);
                //         $('#txt_local_po_balance_due').val(data.balane_in_due);
                        
                        
                //          const editorData = editor.setData(data.description);
                //          $("#txt_local_po_all_description").val(editorData);
                //       // $("#txt_local_po_all_description").val(data.description);
                //         //$( '#btn_local_po_add' ).hide();
                //       // $( '#btn_local_po_edit' ).show();
                        
                        
                //         $("#local_po_no_head").html(data.local_po_number);
                //          $('#btn_generate_local_po' ).hide();
                //          $('#btn_edit_local_po' ).show();
                         
                        
                //         closeNavR();
                //       }  
                        
                //  });
                 
                
                 
                  $('#tbl_local_po_list tbody').on('click', 'td button', function (){
                   
                        var $row = $(this).closest('tr');
                        var data = local_po_list_table.row($row).data();
                        v_local_po_number  = data.local_po_no;
						// var v_job_ids = data.job_ids;
						// console.log(v_job_ids);
						
                        $("#txt_local_po_child_id").val(data.local_po_child_id);
                       v_local_po_child_id  = data.local_po_child_id;
                        if($(this).attr("name")=='edit_local_po')
                         {
                                $('#txt_local_po_description').val(data.description);
                                $('#txt_local_po_quantity').val(data.quantity);
                                $('#txt_local_po_unit').val(data.unit);
                                $('#txt_local_po_rate').val(data.rate);
                                $('#txt_local_po_amount').val(data.amount);
                               
								
								$('#sel_dis_type').val(data.discount_type).trigger('change');
                                $('#txt_product_discount').val(data.discount_precentage);
                                $('#txt_amt_after_discount').val(data.discount_amount);
                                $('#txt_tax_percentage').val(data.vat_percentage);
                                $('#txt_net_amount').val(data.net_amount); 
								
								// $('#select_supplier_jobNo option').map(function () {
								 // if ($(this).text() == v_job_ids) return this;
								 // }).attr('selected', 'selected');
										
								//$('#select_supplier_jobNo').val(data.job_ids);
			                    //$('#select_supplier_jobNo').trigger('change');
                             
                         }
                        if($(this).attr("name")=='delete_local_po')
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
            						
            						       cancel_local_po_list(v_local_po_child_id);
                         				    load_data_to_grid_local_po_list(v_local_po_number);		 
            							} else {
            							    
            							   
            							 
            							}
            						 }); 
                             
                             
                         }
                        $( '#btn_local_po_add' ).show();
                        // $( '#btn_local_po_edit' ).show();
                      
                  });
                  
                 function cancel_local_po_list(v_local_po_child_id)
                  {
                      
                           $.post("../controller/local_po/local_po_controller.php",{action:'delete_local_item',v_local_po_child_id:v_local_po_child_id
                           } , function(result,status){
                               //var local_po_no=  $("#txt_local_po_no").val();
                               // load_data_to_grid_local_po_list(local_po_no);
                               //load_data_to_grid_local_po_list_print(local_po_no);
                               
                           });
                           
                      
                      
                  }
                  
                  v_but_local_po_edit.click(function(){
                      
                 
                    v_but_local_po_edit.ladda( 'start' );
                    var v_local_po_child_id=$("#txt_local_po_child_id").val();
                    var v_local_po_company_name=$("#div_company_select option:selected").text();
                    //var v_local_po_company_name=$("#txt_local_po_company_name").val();
                    var v_local_po_po_box=$("#txt_local_po_po_box").val();
                    var v_local_po_contact_no=$("#txt_local_po_contact_no").val();
                    var v_local_po_fax=$("#txt_local_po_fax").val();
                    //var v_local_po_attn=$("#txt_local_po_attn").val();
                    var v_local_po_no=$("#txt_local_po_no").val();
                    var v_local_po_date=formatDate($("#txt_local_po_date").val());
                    var v_local_po_quotation_ref=$("#txt_local_po_quotation_ref").val();
                    var v_local_po_payment=$('#txt_local_po_payment_terms').val();
                    
                     
                    
                    var v_local_po_description=$('#txt_local_po_description').val();
                    
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_unit=$('#txt_local_po_unit').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var v_local_po_amount=$('#txt_local_po_amount').val();
                    
                    var v_local_po_discount=$('#txt_local_po_discount').val();
                    var total_amount=(parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_local_po_discount))/100)).toFixed(3);
                    $('#txt_local_po_total_amount').val(total_amount);
                    var v_local_po_total_amount=$('#txt_local_po_total_amount').val();
                    
                     var v_local_po_vat=$('#txt_local_po_vat').val();
                     var balance_amount=(((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)+parseFloat(v_local_po_total_amount)).toFixed(3);
                     $('#txt_local_po_balance_due').val(balance_amount);
                     var v_local_po_balance_due= $('#txt_local_po_balance_due').val();
                    
					var discount_type = $('#div_product_discount_type option:selected').val();
                    var v_discount_percentage=$('#txt_product_discount').val();
                    var v_amt_after_discount=$('#txt_amt_after_discount').val();
                    var v_tax_percentage=$('#txt_tax_percentage').val();
                    var v_net_amount=$('#txt_net_amount').val();
					// var job_ids = $('#select_supplier_jobNo option:selected').val();
					// console.log(job_ids);
					// var job_name = $('#select_supplier_jobNo option:selected').text();
					// console.log(job_name);
					// var prn_no = $('#select_PR_No option:selected').text();
			        // console.log(prn_no);
                     
                     
                     var v_local_po_balance_due=$('#txt_local_po_balance_due').val();
                     
                      const editorData = editor.getData();
                   
                      var v_local_po_all_description= editorData;
                     //var v_local_po_all_description=$("#txt_local_po_all_description").val();
                     var v_local_po_sub_total=pageTotal1;
                  
            
                    if($.trim(v_local_po_company_name)==""||$.trim(v_local_po_po_box)==""||$.trim(v_local_po_contact_no)==""||$.trim(v_local_po_fax)==""||$.trim(v_local_po_date)==""||$.trim(v_local_po_payment)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_local_po_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/local_po/local_po_test_controller.php",{action:'edit_local_po_list',v_local_po_description:v_local_po_description,v_local_po_quantity:v_local_po_quantity,v_local_po_unit:v_local_po_unit,v_local_po_rate:v_local_po_rate,v_local_po_amount:v_local_po_amount,v_local_po_child_id:v_local_po_child_id,v_discount_type:discount_type,v_discount_percentage:v_discount_percentage,v_amt_after_discount:v_amt_after_discount,v_tax_percentage:v_tax_percentage,v_net_amount:v_net_amount
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_local_po_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_local_po_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_but_local_po_edit.ladda( 'stop' );
                                    
                                     //swal("Success"," local_po added Successfully", "success");
                                    $.toast({
                                        heading: 'Success',
                                        text: 'Local PO edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_local_po_add' ).show();
                                     $( '#btn_local_po_edit' ).hide();
                                     //$("#txt_local_po_no").val(result);
                                     //$("#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_no,#txt_local_po_date,#txt_local_po_quotation_ref,#txt_local_po_payment_terms").prop("readonly",true);
                                     
                                     
                                    load_data_to_grid_local_po_list( v_local_po_no);
									load_supplier_select_box('div_company_select','select_company');
                                    clear_text()
                                    
                                }
                            
                        }); 
                     }
            
                   
                });
                
                
                
                $('#btn_edit_local_po').click(function(){
                    var v_local_po_child_id=$("#txt_local_po_child_id").val();
                    
                    // var v_local_po_company_name=$("#div_company_select option:selected").text();
                    var v_local_po_company_name=$("#div_supplier_select option:selected").text();
                   // var v_local_po_company_name=$("#txt_local_po_company_name").val();
                    var v_local_po_po_box=$("#txt_local_po_po_box").val();
                    var v_local_po_contact_no=$("#txt_local_po_contact_no").val();
                    var v_local_po_fax=$("#txt_local_po_fax").val();
                    //var v_local_po_attn=$("#txt_local_po_attn").val();
                    var v_local_po_no=$("#txt_local_po_no").val();
                    var v_local_po_date=formatDate($("#txt_local_po_date").val());
                    var v_local_po_quotation_ref=$("#txt_local_po_quotation_ref").val();
                    var v_local_po_payment=$('#txt_local_po_payment_terms').val();
              
                    var v_local_po_description=$('#txt_local_po_description').val();
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_unit=$('#txt_local_po_unit').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var v_local_po_amount=$('#txt_local_po_amount').val();
				// 	var job_ids = $('#select_supplier_jobNo option:selected').val();
				// 	console.log(job_ids);
				// 	var job_name = $('#select_supplier_jobNo option:selected').text();
				// 	console.log(job_name);
				// 	var prn_no = $('#select_PR_No option:selected').text();
			 //       console.log(prn_no);
			 
			 
			       var job_name = $("#txt_local_po_job_no").val();
			       var prn_no = $("#txt_purchase_reqsition_number option:selected").text();    
                    
					var v_local_po_all_description = $('#txt_local_po_all_description').val();
					const editorData = editor.getData();
                    v_local_po_all_description= editorData;
					
					
                    var v_local_po_discount=$('#txt_local_po_discount').val();
                    var total_amount=(+parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_local_po_discount))/100)).toFixed(3);
                    $('#txt_local_po_total_amount').val(total_amount);
                     var v_local_po_total_amount=$('#txt_local_po_total_amount').val();
                    
                     var v_local_po_vat=$('#txt_local_po_vat').val();
                     var balance_amount=(((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)+parseFloat(v_local_po_total_amount)).toFixed(3);
                     $('#txt_local_po_balance_due').val(balance_amount);
                     var v_local_po_balance_due=$('#txt_local_po_balance_due').val();
                     
                    
                     
                    // var v_local_po_all_description=$("#txt_local_po_all_description").val();
                     var v_local_po_sub_total=pageTotal1;
                  
                   //alert(v_local_po_company_name+'----'+v_local_po_po_box+'------'+v_local_po_contact_no+'-----'+v_local_po_fax+'_-------'+v_local_po_date+'-------'+v_local_po_quotation_ref+'--------'+v_local_po_payment+'__-----'+v_local_po_all_description);
            
                    if($.trim(v_local_po_company_name)==""||$.trim(v_local_po_po_box)==""||$.trim(v_local_po_contact_no)==""||$.trim(v_local_po_fax)==""||$.trim(v_local_po_date)==""||$.trim(v_local_po_quotation_ref)==""||$.trim(v_local_po_payment)==""||$.trim(v_local_po_all_description)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_local_po_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/local_po/local_po_controller.php",
						 {action:'edit_local_po', v_local_po_company_name:v_local_po_company_name, v_local_po_po_box:v_local_po_po_box, v_local_po_contact_no:v_local_po_contact_no, v_local_po_fax:v_local_po_fax, v_local_po_no:v_local_po_no, v_local_po_description:v_local_po_description, v_local_po_date:v_local_po_date, v_local_po_quotation_ref:v_local_po_quotation_ref, v_local_po_payment:v_local_po_payment, v_local_po_all_description:v_local_po_all_description, v_local_po_sub_total:v_local_po_sub_total, v_local_po_child_id:v_local_po_child_id,v_job_name:job_name,v_prn_no:prn_no}, 
						 function(result,status)
                                {
                                   
                                result = $.trim(result);
                               console.log("console is "+result);
                                if(result.charAt(0)=='U')
                                {
                                    v_but_local_po_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_local_po_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_but_local_po_edit.ladda( 'stop' );
                                    
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_local_po_add' ).show();
                                     $( '#btn_local_po_edit' ).hide();
                                    
                                    load_data_to_grid_local_po_list( v_local_po_no);
                                     clear_text()
                                    
                                }
                            
                        }); 
                     }
            
                    
                    
                });        
                
                  
                 
                $('#btn_local_po_print').click(function(){
                    var local_po_number=$('#txt_local_po_no').val();
                   
                    if($.trim(local_po_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/local_po/local_po_controller.php",{action:'local_po_status',v_local_po_no:local_po_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_local_po_status=obj.data[0].local_po_status;
                       if(v_local_po_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/local_po_print.php?local_po_number="+local_po_number,"_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                    
                });
                
                      
                 $('#btn_local_po_print_without_head').click(function(){
                     
                      var local_po_number=$('#txt_local_po_no').val();
                   
                    if($.trim(local_po_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/local_po/local_po_controller.php",{action:'local_po_status',v_local_po_no:local_po_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_local_po_status=obj.data[0].local_po_status;
                       if(v_local_po_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                         // window.open("reports/pdf/print/localpo_new.php?local_po_number="+local_po_number+"&x=1","_blank");
                          window.open("reports/pdf/print/localpo_220425.php?local_po_number="+local_po_number+"&x=1","_blank");
                       }
                       
                       });
                      
                       
                    }
                    
                       
                       
                      
                 });
                  
                 $('#btn_local_po_print_with_head').click(function(){
                      var local_po_number=$('#txt_local_po_no').val();
                   
                    if($.trim(local_po_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/local_po/local_po_controller.php",{action:'local_po_status',v_local_po_no:local_po_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_local_po_status=obj.data[0].local_po_status;
                       if(v_local_po_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/pdf/print/localpo_new.php?local_po_number="+local_po_number+"&x=0","_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                    
                     
                 }); 
				 
				 $('#btn_local_po_export_excel').click(function(){
                      var local_po_number=$('#txt_local_po_no').val();
                   
                    if($.trim(local_po_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/local_po/local_po_controller.php",{action:'local_po_status',v_local_po_no:local_po_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_local_po_status=obj.data[0].local_po_status;
                       if(v_local_po_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/local_po_print_with_head.php?local_po_number="+local_po_number+"&x=0","_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                    
                     
                 }); 
                
                  $('#btn_search_cancel_date').click(function(){
                     var v_local_po_from_date = formatDate($("#txt_cancel_start_date").val());
                     var v_local_po_to_date = formatDate($("#txt_cancel_end_date").val());
                     load_data_to_grid_view_cancel_local_po_list_between(v_local_po_from_date,v_local_po_to_date);
                  });


                    $('#btn_search_date').click(function(){
                     var v_local_po_from_date = formatDate($("#txt_start_date").val());
                     var v_local_po_to_date = formatDate($("#txt_end_date").val());
                    load_data_to_grid_view_local_po_list_between(v_local_po_from_date,v_local_po_to_date);
                   
                  });
                
                  
                 $('#btn_view_list_of_local_po').click(function(){
                    $('#loadingWrapper').show(); 
                    var v_start_date_year= new Date().getFullYear();
                    $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                    load_data_to_grid_view_local_po_list(); 
                     
                 });     
                 
                  $('#btn_view_list_of_cancelled_LPO').click(function(){
                    	var v_start_date_year= new Date().getFullYear();
                    $("#txt_cancel_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
				
                   load_data_to_grid_view_cancel_local_po_list();
                     
                 });   
	            	$("#div_prno_select").load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1',v_prnn_no:'0'},function(result,status){  
								
							
								});
                 
          
        //   ************************************ buttom add supplier**************************************
                v_btn_company_add.click(function(){
                    
                    v_btn_company_add.ladda( 'start' );
                    
                    var v_company_name=$("#txt_company_name").val();
                    var v_contact_person=$("#txt_contact_person").val();
                    var v_contact_email=$("#txt_contact_email").val();
                    var v_contact_phone=$("#txt_contact_phone").val();
                    var v_contact_address_1=$("#txt_contact_address_1").val();
                    var v_contact_address_2=$("#txt_contact_address_2").val();
                    var v_country_name=$("#select_country_name option:selected").text();
                    
                   // $('#select_dist option:selected').val();
                    var v_state_name=$("#txt_state_name").val();
                    var v_state_name='NA';
                    var v_city_name=$('#txt_city_name').val();
                    var v_fax_number=$('#txt_fax_number').val();
                    var v_company_description=$('#txt_company_description').val();
                    
                    var upload_item_image='user.png'; 
                    
               
                    console.log("upload_item_image:"+upload_item_image+"v_company_name:"+v_company_name+",v_contact_person:"+v_contact_person+",v_contact_email:"+v_contact_email+",v_contact_phone:"+v_contact_phone+",v_contact_address_1:"+v_contact_address_1+",v_contact_address_2:"+v_contact_address_2+",v_country_name:"+v_country_name+",v_state_name:"+v_state_name+",v_fax_number:"+v_fax_number+",v_company_description:"+v_company_description);
                    
                   
                  
            
                    if($.trim(v_company_name)==""||$.trim(v_contact_person)==""||$.trim(v_contact_email)==""||$.trim(v_contact_phone)==""||$.trim(v_contact_address_1)==""||$.trim(v_contact_address_2)==""||$.trim(v_country_name)=="select"||$.trim(v_state_name)==""||$.trim(v_company_description)==""||$.trim(upload_item_image)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_company_add.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/supplier/supplier_controller.php",{action:'add_company',v_company_name:v_company_name,v_contact_person:v_contact_person,v_contact_email:v_contact_email,v_contact_phone:v_contact_phone,v_contact_address_1:v_contact_address_1,v_contact_address_2:v_contact_address_2,v_country_name:v_country_name,v_state_name:v_state_name,v_city_name:v_city_name,v_fax_number:v_fax_number,v_company_description:v_company_description,upload_item_image:upload_item_image }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_company_add.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text_modal_sup();
                                   

                                
                                }
                                else 
                                {
                                     v_btn_company_add.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'New Supplier added successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                   
                                    //  $("#txt_company_name,#txt_contact_person,#txt_city_name,#txt_state_name,#txt_contact_address_1,#txt_contact_address_2,#txt_company_description,#txt_contact_email,#txt_contact_phone,#txt_fax_number").prop("readonly",true);
                                     
                                     $('#div_supplier_select').load('templates/supplier_combo.php');
                                    
                                    
                                    
                                    
                                     clear_text_modal_sup();
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
            
         function clear_text_modal_sup()
                 {
                     
                    
                    
                    $("#txt_company_name").val('');
                    $("#txt_contact_person").val('');
                    $("#txt_contact_email").val('');
                    $("#txt_contact_phone").val('');
                    $("#txt_contact_address_1").val('');
                    $("#txt_contact_address_2").val('');
                    //var v_country_name=$("#select_country_name option:selected").val();
                    
                   // $('#select_dist option:selected').val();
                    $("#txt_state_name").val('');
                    $('#txt_city_name').val('');
                    $('#txt_fax_number').val('');
                    $('#txt_company_description').val('');
                    
                    // $('#hidden_item_image').val('');
                    // $('#edit_item_image').val('');
                    // $('#dvPreview').html('');
                    // $('#upload_item_image').val('');
                    
                   
                    
                   
                 }
            
            
        // *************************** end ********************************************************
          
                  

});