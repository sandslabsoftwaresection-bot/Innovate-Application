$(document).ready(function(){

                
    var v_btn_generate_inventory = $( '#btn_generate_inventory' ).ladda();
    
               
    var tbl_inventory_list_list_table = $('#tbl_inventory_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});
    $('#tbl_inventory_list').removeClass( 'display' ).addClass('table table-striped table-bordered');                
               
        //load_data_to_grid_product_master_list();
    $( '#btn_edit_inventory' ).hide();
              
    $('#div_category_load_pur_recie').load('templates/inventory_category_search_com.php'); 
    
    $('#div_select_item_name').load('templates/inventory_item_combo.php'); 
    
    $(document).on('change', '#select_iventory_category', function () {
        const catId = $(this).val();
        $('#sub_main_cat_id').val(catId);
    
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

                // success: function (response) {
                //     const $subCat = $('#select_inventory_sub_category');
                //     $subCat.empty(); // Clear old options
    
                //     // Default option
                //     $subCat.append('<option value="0">Select Sub Category</option>');
    
                //     // Loop and populate options
                //     if (response.data && Array.isArray(response.data)) {
                //         response.data.forEach(function (item) {
                //             $subCat.append(
                //                 `<option value="${item.ids}">${item.sub_cat_name}</option>`
                //             );
                //         });
    
                //         // If you're using Chosen plugin, update it
                //         $subCat.trigger("chosen:updated");
                //     }
                // }
            });
        }
    });
    
    // Open modal to add item_name
    $('#btn_add_item_name').on('click', function() {
        $('#modal_item_name_add').modal('show');
    }); 
    
    
    // Open modal to add sub category
    $('#btn_add_sub_category').on('click', function() {
        const selectedMainCat = $('#select_iventory_category').val();
        if (selectedMainCat === '0') {
            $.toast({
				heading: 'Warning',
				text: 'Please select a main category first',
				showHideTransition: 'slide',
				icon: 'warning'
			});
            return;
        }
        $('#txt_sub_category_name').val('');
        $('#modal_sub_category_add').modal('show');
    });
    
    
    $("#btn_item_name_save").click(function(){
        
        const itemName = $('#txt_item_name').val().trim();
        if(itemName!='')
        {
         $.ajax({
            url: '../controller/inventory/inventory_controller.php', // Create this file
            type: 'POST',
            data: {
                action:'add_item_name',
                v_itemName: itemName,
                
            },
            success: function(response) {
                if (response>0) {
                    
                    
                    $('#modal_item_name_add').modal('hide');
                    $('#div_select_item_name').load('templates/inventory_item_combo.php');
                    $('#txt_item_name').val('')// Refresh sub categories
                    $.toast({
        				heading: 'Success',
        				text: 'Successfully added to ItemName.',
        				showHideTransition: 'slide',
        				icon: 'success'
        			});
                } else {
                    $('#sub_error_msg').html('<div class="alert alert-danger">' + response + '</div>');
                }
            }
        });
        }
        else
        {
          $('#sub_error_msg').html('<div class="alert alert-danger"> Please Enter Item Name</div>');  
        }
        
    });
    
    

    // Save new sub category
    $('#btn_sub_category_save').on('click', function() {
        const mainCatId = $('#sub_main_cat_id').val();
        const subCatName = $('#txt_sub_category_name').val().trim();

        if (!subCatName) {
            $.toast({
				heading: 'Warning',
				text: 'Please enter sub category name.',
				showHideTransition: 'slide',
				icon: 'warning'
			});
            // $('#sub_error_msg').html('<div class="alert alert-danger">Please enter sub category name.</div>');
            return;
        }

        $.ajax({
            url: '../controller/inventory/inventory_controller.php', // Create this file
            type: 'POST',
            data: {
                action:'add_sub_category',
                v_category_id: mainCatId,
                sub_cat_name: subCatName
            },
            success: function(response) {
                if (response>0) {
                    $('#modal_sub_category_add').modal('hide');
                    $('#select_iventory_category').trigger('change'); // Refresh sub categories
                    $.toast({
        				heading: 'Success',
        				text: 'Successfully added to Sub category.',
        				showHideTransition: 'slide',
        				icon: 'success'
        			});
                } else {
                    $('#sub_error_msg').html('<div class="alert alert-danger">' + response + '</div>');
                }
            }
        });
    });
    
    v_btn_generate_inventory.click(function(){
      
        v_btn_generate_inventory.ladda( 'start' );           
		var v_category_id=$("#div_category_load_pur_recie option:selected").val();
		var v_category=$("#div_category_load_pur_recie option:selected").text();
	    var v_sub_category_id = $("#select_inventory_sub_category option:selected").val(); 
        var v_sub_category = $("#select_inventory_sub_category option:selected").text(); 
		var v_unit_id=$("#select_unit option:selected").val();
		var v_unit_name=$("#select_unit option:selected").text();
		var v_item_name=$("#select_iventory_item option:selected").text();
                  

		if(v_category_id ==="0" || v_sub_category_id === "0" || v_unit_id ==="0" || v_item_name ==="")
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

				   load_data_to_grid_inventory_list(); 
				    clear_text();
				    // $("#txt_item_code").val(result).css("font-weight", "bold");
					location.reload();
		    });
                
		}
    });
            
            $("#btn_add_category").click(function()
    		 {
                    $('#modal_category_add').modal('show');
    		 });
            
            
         $("#btn_view_list_of_inventory").click(function()
		 {
           load_data_to_grid_inventory_list();
		 });
		 
         function load_data_to_grid_inventory_list()
		 {
			 tbl_inventory_list_list_table.destroy();
				 
			 tbl_inventory_list_list_table = $('#tbl_inventory_list').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/inventory/inventory_controller.php',
						 'data': {
							action: 'list_inventory_item'
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
						 { "data": "cat_name"},
						 { "data": "sub_cat_name"},
						 { "data": "item_name"},
						 { "data": "item_code"},
						 { "data": "unit"},
						 { "data": "status" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            						if(rows['status']=='Active')
									{
                							
            								var	approval_status = '<button type="button" class="btn btn-sm primary-gradient mr-2"  id="approval" name="approval" ><i class="material-icons">check_circle</i></button>';
            								
                                    return approval_status;
									}
									
									if(rows['status']=='Deactive')
									{
                							
            								var	approval_status = '<button type="button" class="btn btn-sm  mr-2" style="   background-color: red; color: #fff;" id="approval" name="approval" ><i class="material-icons">check_circle</i></button>';
            								
                                    return approval_status;
									}
            							 },
            							 
            					

					 
					         },
					       //  { "data": "item_id",
    					 
                         
            //                               render: function ( data, type, rows, meta ) {
                						
            //     									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_invoice" name="view_invoice" ><i class="material-icons ">remove_red_eye</i></button>';
                								
            //     								return str_active_status_view;
                
            //     							 },
                							 
                					
    
    					 
    					   //      }
					 ],
					 pageLength: 25,
					 searching: true,
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
				 
			$('#btn_inventory').click(function(){
				location.reload();
			});	 
                 
                 
    $('#tbl_inventory_list tbody').on('click', 'td button', function (){             
		  var $row = $(this).closest('tr');
		  var data = tbl_inventory_list_list_table.row($row).data();
		  var v_item_id  = data.item_id;
		  var v_item_unit  = data.item_unit;
		  $('#btn_generate_inventory').hide();
		  $('#btn_edit_inventory').show();
		  
		 if($(this).attr("name")=='approval')
                         {
                             

                          var v_approved_status= data.status;
                          
                    			 $.post("../controller/inventory/inventory_controller.php",{action : "item_status_change",v_item_id:v_item_id,v_approved_status:v_approved_status},function(res){
        	                     swal("success","Item status changed successfully ....", "success");
        			             load_data_to_grid_inventory_list();
        						 });
        						 
        						 
                       
            			 }
    // 		 if($(this).attr("name")=='view_invoice')
    //                  {	
    //                      	$("#select_iventory_category").val(data.cat_id);
    //                         $("#select_iventory_category").trigger("chosen:updated");
    //                     //  $('#btn_edit_inventory').show();
    //                      closeNavR();
    //                  }
		 
				 
	
						
						
	/////////////////////////////////	
           
    });
    
    
    
    // ******************************add category********************************
    
        $('#btn_category_save').click(function(){
      
		var v_item_name=$("#txt_category_name").val();
                  

		if(v_item_name=="")
		{ 
	       v_btn_generate_inventory.ladda( 'stop' );
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
					$("#txt_category_name").val("");
                    $('#div_category_load_pur_recie').load('templates/inventory_category_search_com.php'); 
                    $('#modal_category_add').modal('hide');
		    });
                
		}
    });
    
    // *********************************end**************************************
	   
// 	$('#btn_edit_inventory').click(function(){	
	
// 		var v_category = $("#select_category option:selected").text();
// 		var v_unit_name = $("#select_unit option:selected").text();
// 		var v_item_name = $("#txt_item_name").val();
// 		var ids = $("#ids").val();
	
// 		if($.trim(v_category)=="Select Category" || $.trim(v_unit_name)=="Select Unit" || $.trim(v_item_name)=="")
// 		{
// 		   swal('Warning',"Please fill the required field","warning");
// 		}
// 		else
// 		{		
// 			 $.post("../controller/inventory/inventory_controller.php",
// 			 {action:'edit_inventory',v_category:v_category, v_item_name:v_item_name, v_unit_name:v_unit_name, v_ids:ids}, 
// 			 function(result,status)
// 			 {
// 				result = $.trim(result);
// 				$.toast({
// 					heading: 'Success',
// 					text: 'Inventory updated successfully..!',
// 					showHideTransition: 'slide',
// 					icon: 'success'
// 				});
// 				load_data_to_grid_inventory_list();
// 				$("#btn_edit_inventory").hide();
// 				$("#btn_generate_inventory").show();
// 				clear_text();  
// 				location.reload();
// 			});			 
// 		}
// 	});
                
	
    function clear_text()
	{
	  $('#select_iventory_category option:selected').text("Select Category");
	  $('#select_unit option:selected').text("Select Unit");
      $("#txt_item_name").val(''); 
	}

});