$(document).ready(function(){
    var tbl_lpo_edit = $('#tbl_lpo_edit').DataTable({searching: false, paging: false, info: false,"ordering": false});
//   var history_of_store_item = $('#history_of_store_item').DataTable( {searching: false, paging: false, info: false,"ordering": false});
  
//   $('#history_of_store_item').removeClass( 'display' ).addClass('table table-striped table-bordered');
  var v_btn_generate_inventory = $( '#btn_add_item_mod' ).ladda();
//   $('#div_select_item_name').load('templates/item_load_com.php');
    // $('#show_details').hide();
  $('#div_select_supplier').load('templates/supplier_comp_for_rep.php');
  var action;
  
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
  
  
  load_lpo_edit_report();
      
    
   var groupColumn = 1;
    function load_lpo_edit_report() {
                // Destroy existing DataTable if it exists
                if ($.fn.DataTable.isDataTable('#tbl_lpo_edit')) {
                    $('#tbl_lpo_edit').DataTable().destroy();
                }
            
                // Initialize DataTable
                 tbl_lpo_edit = $('#tbl_lpo_edit').DataTable({
                    "ajax": {
                        'type': 'POST',
                        'url': '../controller/db_edit/lpo_edit_controller.php',
                        'data': {
                            action: "lpo_edit_load"
                        }
                    },
                    "language": {
                        "zeroRecords": "No records available",
                        "infoEmpty": "No records available",
                    },
                    "order": [[0, "desc"]],
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "info": false,
                    "autoWidth": false,
                    "scroller": true,
                    "columns": [
                        { "data": null, "className": "text-center" },
                        {
                            "data": "category_name",
                            "className": "text-center",
                            "render": function (data, type, row, meta) {
                                var action_pur_recie = '<div class="input-group mb-3" style="vertical-align:middle;width:100%"><div class="div_category_load" style="width:75%;"><select id="select_inventory_category" name="select_inventory_category" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1" aria-hidden="true"></select></div><div class="input-group-append"><button class="btn btn-primary" id="btn_add_category" name="btn_add_category">Add</button></div></div>';
                                return action_pur_recie;
                            }
                        },
                        {
                            "data": null,
                            "className": "text-center",
                            "render": function (data, type, row, meta) {
                                var action_pur_recie = '<div class="input-group mb-3" style="vertical-align:middle;width:100%"><div class="div_item_load" style="width:75%;"><select id="select_inventory_item" name="select_inventory_item" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1" aria-hidden="true"></select></div><div class="input-group-append"><button class="btn btn-primary" id="btn_add_item" name="btn_add_item">Add</button></div></div>';
                                return action_pur_recie;
                            }
                        },
                        { "data": "category_id", "className": "text-center", "visible": false },
                        { "data": "item_id", "className": "text-center", "visible": false },
                        { "data": "item_code", "className": "text-center", "visible": false },
                        { "data": "unit", "className": "text-center" },
                        { "data": "description", "className": "text-center" },
                        {
                            "data": null,
                            "className": "text-center",
                            "render": function (data, type, row, meta) {
                                var action_pur_recie = '<button type="button" class="btn btn-sm primary-gradient mr-2 lpo_save" name="lpo_save"><i class="material-icons ">save</i></button>';
                                return action_pur_recie;
                            }
                        }
                    ],
                    "pageLength": 25,
                    "drawCallback": function (settings) {
                        // Load content into the dropdowns
                        $('.div_category_load').load('templates/inventory_category_search_com.php', function () {
                            // Reinitialize the chosen plugin if necessary
                            $('.chosen_select').chosen();
                        });
                        
                        
                         // Function to load items based on selected category
                        function loadItems(category_id) {
                            var selectedCategoryId = $('#select_iventory_category').val();
                            $('.div_item_load').load('templates/inventory_item_load_com_lpoedit.php?category_id=' + selectedCategoryId, function () {
                                // Reinitialize the chosen plugin if necessary
                                $('.chosen_select').chosen();
                            });
                        }
                    
                        // Attach change event listener to the category dropdown
                        $(".div_category_load").change(function(){
			    	         var v_item_id=  $( "#select_iventory_category option:selected" ).val();
                            loadItems(v_item_id);
                        });
                    
                        // Optionally, load items for the initially selected category if needed
                        // loadItems();
                        
                        
                        $(".div_item_load").change(function(){
			    	         var v_category_id=  $( "#select_iventory_category option:selected" ).val();
			    	         var v_category_name=  $( "#select_iventory_category option:selected" ).text();
			    	        //  var v_item_details=  $( "#select_iventory_item option:selected" ).val();
			    	         
			    	         var item_details=$('#select_iventory_item option:selected').val();
                                var item_name_code=$('#select_iventory_item option:selected').text();
                                console.log("item_details: ", item_details);
                                console.log("item_name_code: ", item_name_code);
                                var details_array = item_details.split('$');
                                var item_id = details_array[0];
                                var cat_id = details_array[1];
                                var cat_name = details_array[2];
                                var item_code = details_array[3];
                                var tax_pr = details_array[5];
                                
                                var item_name_code_array = item_name_code.split('/');
                                console.log("details_array: ", details_array);
                                console.log("item_name_code_array: ", item_name_code_array);
                                var item_name = item_name_code_array[0];
                                $("#category_id").val(cat_id);
                                $("#category_name").val(cat_name);
                                $("#item_id").val(item_id);
                                $("#item_name").val(item_name);
                                $("#item_code").val(item_code);
                                        
                        });
                        
                    },
                    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                        $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                        return nRow;
                    },
                    "footerCallback": function (row, data, start, end, display) {
                        // Footer callback if needed
                    }
                });
                
                $('#tbl_lpo_edit').on('click', '#btn_add_category', function() {
                    // Show the modal
                    $('#modal_category_add').modal('show');
                });
                $('#tbl_lpo_edit').on('click', '#btn_add_item', function() {
                    $('#div_category_load_pur_recie').load('templates/inventory_category_search_com.php'); 
                    // Show the modal
                    $('#modal_item_add').modal('show');
                });
                
            }
            
            
            // *********************** save button click of table ********************************
            
            
            $('#tbl_lpo_edit').on('click', '.lpo_save', function() {
                            var $row = $(this).closest('tr');
			                var data = tbl_lpo_edit.row($row).data();
                            var v_child_ids = data.local_po_child_id;
                            // alert(v_child_ids);
                                var cat_id = $("#category_id").val();
                                var cat_name =$("#category_name").val();
                                var item_id =$("#item_id").val();
                                var item_name =$("#item_name").val();
                                var item_code =$("#item_code").val();
                            $.post("../controller/db_edit/lpo_edit_controller.php",{action:'update_lpo_child', v_child_ids:v_child_ids,cat_id:cat_id,cat_name:cat_name,item_id:item_id,item_name:item_name,item_code:item_code},
                            function(result,status){
                                if(result==1){
                                    $.toast({
            							heading: 'Success',
            							text: 'Updated successfully',
            							showHideTransition: 'slide',
            							icon: 'success'
            						});
            						load_lpo_edit_report();
                                }
                            });
            });                
            
            // ************************* end ***************************************************
            

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
                					$('.div_category_load').load('templates/inventory_category_search_com.php', function() {
                                        $('.chosen_select').chosen();
                                    });
                                    // $('#div_category_load_pur_recie').load('templates/inventory_category_search_com.php'); 
                                    $('#modal_category_add').modal('hide');
                                    
                		    });
                                
                		}
                    });
                    
    // *********************************end**************************************
    
    //  ********************* btn save item ***************************
                v_btn_generate_inventory.click(function(){
      
                        v_btn_generate_inventory.ladda( 'start' );           
                		var v_category_id=$("#div_category_load_pur_recie option:selected").val();
                		var v_category=$("#div_category_load_pur_recie option:selected").text();
                		var v_unit_id=$("#select_product_unit option:selected").val();
                		var v_unit_name=$("#select_product_unit option:selected").text();
                		var v_item_name=$("#txt_item_name").val();
                                  
                
                		if(v_category_id=="0" || v_unit_id=="0" || v_item_name=="")
                		{ 
                	       v_btn_generate_inventory.ladda( 'stop' );
                	       swal('Warning',"Please fill the required field","warning");
                		}
                		else
                		{	
                			$.post("../controller/inventory/inventory_controller.php",
                			{action:'generate_inventory_item',v_category_id:v_category_id,v_category:v_category,v_unit_name:v_unit_name,v_item_name:v_item_name,v_unit_id:v_unit_id}, 
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
                                    $('.div_item_load').load('templates/inventory_item_code_load_com.php', function () {
                                        // Reinitialize the chosen plugin if necessary
                                        $('.chosen_select').chosen();
                                    });
                                    $('#select_iventory_category').val(0); // Clear selected value if needed
                                    $('#select_iventory_category').trigger('change');
                                    // $('#select_iventory_category option:selected').text("Select Category");
                            	    $('#select_product_unit').val(0);
                                    $("#txt_item_name").val(''); 
                                    $("#modal_item_add").modal('hide');
                                    load_lpo_edit_report();
                		    });
                                
                		}
                    });
                // ************************end ***********************************
                
                 
	

	           
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