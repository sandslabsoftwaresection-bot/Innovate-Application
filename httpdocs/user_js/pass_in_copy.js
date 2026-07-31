$(document).ready(function(){
                
				 var balance;
                //  var tbl_pass_in_list = $('#tbl_pass_in_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});              
                 var list_of_pass_in = $('#list_of_pass_in').DataTable( {searching: false, paging: false, info: false,"ordering": false});
               //  var list_of_cancel_gate_pass_table = $('#list_of_cancel_gate_pass').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 var v_but_gen_pass_in = $( '#btn_generate_pass_in' ).ladda();
                 $("#btn_pass_in_add").show();
                 $("#btn_pass_in_edit").hide();
            	$('#div_company_select').load('templates/company_combo.php');
			    //$('#div_item_load').load('templates/iventory_item_combo.php');
			      var tbl_pass_in_list = $('#tbl_pass_in_list').DataTable({
                    searching: false,
                    paging: false,
                    info: false,
                    ordering: false,
                    columnDefs: [
                        { targets: [2, 4,5,8,9], visible: false } // Adjust column indices as needed
                    ]
                });
			    
			    
			     $('#div_category_load').load('templates/inventory_category_load_com.php');
			    	$("#div_category_load").change(function(){
                      
                              var v_cat_id=  $( "#select_iventory_category option:selected" ).val();
        					  
        		              var v_category= $( "#select_iventory_category option:selected" ).text();
        					 
        					  $("#div_item_load").load("templates/inventory_item_code_load_com.php?category_id="+v_cat_id);
					
					  
				 });
			    
			    	$("#div_item_load").change(function(){
			    	         var v_item_id=  $( "#select_iventory_item option:selected" ).val();
        					  
			    	        $.post("../controller/gate_pass/gate_pass_controller.php",{action:'select_unit_for_pass_in',v_inventory_id:v_item_id},function(result,status){
			    	            if(status=="success")
                                {
                                   
                                var obj= jQuery.parseJSON(result);
                               
                                $("#unit").val(obj.data[0].unit);
                                }
			    	           
			    	            
			    	        });
			    	});
			    
			    
				// $('#div_category_load_pass').load('templates/inventory_category_combo.php');
				
				
				var category_name,unit;
				// $("#div_category_load_pass").change(function() {
                      
    //                 category_name = $('option:selected', this).val();
				// 	//alert(category_name);
    //                 $.post("../controller/gate_pass/gate_pass_controller.php",{action:'select_inventory_details',v_inventory_category:category_name},function(result,status){
                        
    //                             if(status=="success")
    //                             {
				// 					load_inventory_name('div_item_load', 'select_inventory_name');     
				// 					var obj= jQuery.parseJSON(result);
				// 					unit = obj.data[0].item_unit;
				// 					$("#div_item_select_combo").load('../controller/inventory/inventory_controller.php',{action:'select_category_item',v_ctrl_name:'select_category',v_category:obj.data[0].item_name},function(result,status){
                            
				// 					});
    //                             }
    //                             else
    //                             {
    //                                 return false;
    //                             }
    //                 });           
                   
    //              }); 
                 
				 
				//  function load_inventory_name(div_name, ctrl_name)
				// {
				// 	 $("#"+div_name).load('../controller/gate_pass/gate_pass_controller.php',{action:'select_category_item_name',v_ctrl_name:ctrl_name, pn_company_id:category_name},function(result,status){});
				// }
<!----------------------------------CurrentDate-----------------------------------------> 
 
                var currentDate = new Date(); 
                var formattedDate = currentDate.toISOString().substr(0, 10); 
                $('#pass_in_date').val(formattedDate);
                
<!----------------------------------CreateNewPassIn-----------------------------------------> 
 			  
				 $('#btn_create_passin').click(function(){
		         location.reload();
	             });
<!----------------------------------CompanyLoad-----------------------------------------> 
                // alert("pass_in");
                //load_company_select_box('div_company_select','select_company');
				load_unit_select_box('div_unit_select_combo','select_unit');
                				
                //   function load_company_select_box(div_name,ctrl_name)
                //     {
      
                //   $("#"+div_name).load('../controller/quotation/quotation_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});
        
                //     }
                  
				   function load_unit_select_box(div_name,ctrl_name)
                    {
      
                   $("#"+div_name).load('../controller/gate_pass/gate_pass_controller.php',{action:'select_unit',v_ctrl_name:ctrl_name},function(result,status){});
        
                    }
					
				   var pn_company_id;
                   $("#div_company_select").change(function() {
                      
                    $('#txt_delivery_note_company_name').val($('option:selected', this).text()) ;
                    $("#txt_delivery_note_company_id").val($('option:selected', this).val());
                    var company_id = $('option:selected', this).val();
                    pn_company_id = $('option:selected', this).val();
                    $.post("../controller/gate_pass/gate_pass_controller.php",{action:'select_company_details',v_company_id:company_id},function(result,status){
                        
                                if(status=="success")
                                {
                                load_project_name('div_slect_project', 'select_project_name');     
                                var obj= jQuery.parseJSON(result);
                               
                                $("#po_box").val(obj.data[0].contact_address_1);
                                $("#contact_no").val(obj.data[0].contact_phone);
                                $("#fax").val(obj.data[0].fax);
                                $("#attn").val(obj.data[0].contact_person);
								$("#address").val(obj.data[0].contact_address_2);
                                
                                $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                            
                               });
                                
                                var company_ids=$("#txt_delivery_note_company_id").val();
                               
                                }
                                else
                                {
                                    return false;
                                }
                    });           
                   
                 }); 
				 
				function load_project_name(div_name, ctrl_name)
				{
					 $("#"+div_name).load('../controller/gate_pass/gate_pass_controller.php',{action:'select_project_name',v_ctrl_name:ctrl_name, pn_company_id:pn_company_id},function(result,status){});
				}
				 $("#div_slect_project").change(function() { 
				    // alert("proj combo");
				
				     var v_project_id=$('option:selected', this).val() ;
				     //alert("proj combo"+v_project_id);
				      $("#div_select_job_no").load('../controller/gate_pass/gate_pass_controller.php',{action:'select_job_no_lst',v_ctrl_name:'select_job_no',v_project_id:v_project_id},function(result,status){
                                    console.log(result);
                          });  
				    
				});
				$("#div_select_job_no").change(function() { 
				    var v_job_id=$('option:selected', this).text() ;
				    console.log("job id : "+v_job_id);
				    var hrefValue = "templates/workorder_view.php?val="+v_job_id; // Change this to your desired href value
                    $("#list_workorder").attr("href", hrefValue);
				    
				});
				 
<!--------------------------------------QuantityValidation--------------------------------------> 
   $('#qty').on('keypress', function(event) {
    var keycode = event.which;
    var inputValue = String.fromCharCode(keycode);
    var pattern = /^\d*\.?\d*$/;
    var isValidInput = pattern.test(inputValue);
    
    if (!isValidInput) {
      event.preventDefault(); // Prevent input if it doesn't match the pattern
    }
  });    
                    		  
<!---------------------------------------AddBtnAction------------------------------------------->                
               var counter = 1;   
          $('#btn_pass_in_add').click(function(){
                 
				  var company_id=$("#div_company_select option:selected").val();    
                  var company_name=$("#div_company_select option:selected").text();    
                  var pass_in_date=$("#pass_in_date").val();    
                  var approved_by=$("#approved_by").val();    
                  var checked_by=$("#checked_by").val();    
                  var received_by=$("#received_by").val();    
                  var description=$("#description").val();    
                  var qty=$("#qty").val();    
                  var pass_in_no=$("#txt_pass_in_no").val();    
                  //var unit=$("#div_unit_select_combo option:selected").text();
				  
		          var project_id = $('#div_slect_project option:selected').val();
		          var project_name = $('#div_slect_project option:selected').text();
                  var inventory_id = $('#select_iventory_item option:selected').val();
				  var inventory_name = $('#select_iventory_item option:selected').text();
				   var category_id = $('#select_iventory_category option:selected').val();
				   var category_name = $('#select_iventory_category option:selected').text();
				   var inventory_name_parts = inventory_name.split('/');
				   var item_name = inventory_name_parts[0];
                    var item_code = inventory_name_parts[1];
                    // alert(item_name+"-----"+item_code);
				  var unit = $("#unit").val();
				  
				  //alert(project_id+' '+project_name+' '+inventory_id+' '+inventory_name+unit);
			  if(company_id=="" || project_id=="0" ||  approved_by=="" || checked_by=="" || received_by==""|| inventory_id=="0" || description==""|| qty==""|| unit=="") 
			     {
				    swal("Warning","Please fill the required field", "warning");
				 }
				 else
				 {
				     
					 view_gate_list(category_name,category_id,item_name,inventory_id,item_code,description,qty, unit,'');
					  $('#btn_generate_pass_in').show();
		   
		           $('#select_iventory_category').val('');
                    $("#select_iventory_item").val("").trigger("chosen:updated");
                    $("#unit").val("");
                    $("#description").val("");
                     $("#qty").val("");
		  //          $.post("../controller/pass_in/pass_in_controller1.php",{action:'add_btn_action',v_company_id:company_id,v_company_name:company_name,v_pass_in_date:pass_in_date,v_project_id:project_id, v_project_name:project_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by,v_description:description,v_qty:qty,v_unit:unit, v_inventory_id:inventory_id, v_inventory_name:inventory_name,v_pass_in_no:pass_in_no},function(result,status)
				// 	{ 
					
				// 	   $('#pass_in_no_head').val(result);          
				// 	   $('#txt_pass_in_no').val(result); 
				// 	   $("#description").val("");		   
				// 	   $("#qty").val("");		   
				// 	   // $('#div_unit_select_combo select').val('');
				// 	   // $('#div_item_load select').val('');
				// 	   //$('#div_item_load').load('templates/iventory_item_combo.php');
				// 	   $('#div_category_load_pass').load('templates/inventory_category_combo.php');
				// 	   load_unit_select_box('div_unit_select_combo','select_unit');
				// 	   //load_company_select_box('div_company_select','select_company');
				// 	   load_inventory_name('div_item_load', 'select_inventory_name');     
				// 	   var pass_in_no=result.trim();		   
					  
 			// 		   view_pass_in_list(pass_in_no);   
				    // });
				 }
                    
});   


 function view_gate_list(category,categoryid,item,itemid,itemCode,description,qty, unit,childId)
                    { 
                    tbl_pass_in_list.row.add([
                    counter++,
                    category,
                    categoryid,
                    item,
                    itemid,
                    itemCode,
                    description,
                    qty,
                    unit,
                    childId,
                    '<button class="btn btn-danger btn-sm delete-row">Delete</button>' // Delete button
                    
                ]).draw();
                       
                        // Attach click event handler to delete button
                        $('#tbl_pass_in_list').on('click', '.delete-row', function() {
                            var row = $(this).closest('tr');
                            tbl_pass_in_list.row(row).remove().draw(false);
                        });
                                    
                    }
<!-----------------------------------Generate_btn---------------------------------------------->
// **************************list of pass in view*******************************


 function view_gate_list_for_edit(category,categoryid,item,itemid,itemCode,description,qty, unit,childID)
                    { 
                        
                    tbl_pass_in_list.row.add([
                    counter++,
                    category,
                    categoryid,
                    item,
                    itemid,
                    itemCode,
                    description,
                    qty,
                    unit,
                    childID,
                    '<button class="btn btn-danger btn-sm delete-row">Delete</button>' + // Delete button
                    '<button class="btn btn-primary btn-sm update-row">Update</button>' // Update button
                    
                ]).draw();
             }      
                        // Attach click event handler to delete button
                        $('#tbl_pass_in_list').on('click', '.delete-row', function() {
                            var rowData = tbl_pass_in_list.row($(this).closest('tr')).data();
                            var v_child_ids = rowData[9];
                            var row = $(this).closest('tr');
                            
                            
                              swal({
								  title: "Do you want to delete the item?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {
                            
                                        $.post("../controller/pass_in/pass_in_controller1.php",{action:"delete_passin_child",child_ids:v_child_ids},function(result,status){
            											 
            											 //alert(result);
            											    if(result== 1)
            												{
            												    
            												    
                                                                 tbl_pass_in_list.row(row).remove().draw(false);
            												}
                                        });
                                        
                                        
								  }
								    
								});
                                        
                                        
                                        
                        });
                        $('#tbl_pass_in_list').on('click', '.update-row', function() {
                            
                            var row = $(this).closest('tr'); // Define 'row' here
                            var rowData = tbl_pass_in_list.row(row).data();
                             var item_id = rowData[4]; // Assuming itemid is the fifth column (index 4) in the row data
                            // load_data_to_grid_inventory_list(item_id,1);
                            // Extracting data from the row
                            var description = rowData[6];
                            var qty = rowData[7];
                           
                            // Creating input fields
                            var descriptionInput = '<input type="text" class="form-control" value="' + description + '" name="description">';
                            var qtyInput = '<input type="number" class="form-control" min=0 value="' + qty + '" name="qty">';
                        
                            // Replacing cell content with input fields
                            row.find('td:eq(3)').html(descriptionInput); // Replace cell content for description
                            row.find('td:eq(4)').html(qtyInput); // Replace cell content for qty
                            
                            // Changing the button text and class
                            $(this).text('Save').removeClass('update-row').addClass('save-row');
                                                   
                        });
                         $('#tbl_pass_in_list').on('click', '.save-row', function() {
                             var row = $(this).closest('tr');
                                var description = row.find('input[name="description"]').val(); // Assuming input field for description has name="description"
                                var qty = row.find('input[name="qty"]').val(); 
                                console.log("Changed description: " + description);
                                console.log("Changed qty: " + qty);
                                var row = $(this).closest('tr'); // Define 'row' here
                                var rowData = tbl_pass_in_list.row(row).data();
                                var child_ids = rowData[9]; 
                                // alert(child_id);
                                $.post("../controller/pass_in/pass_in_controller1.php",{action:"update_child", child_ids:child_ids, v_qty:qty, v_description:description},function(result,status){
											 
											 //alert(result);
											    if(result== 1)
												{
												    
												  swal("Success","Quantity updated successfully", "success");
                                                    //  tbl_gate_pass_list.row(row).remove().draw(false);
												}
                            });
                                
                                
                        
                         });
                                            


// ************************ list of pass in view ends here*******************************************


 $('#btn_generate_pass_in').click(function(){
   
   v_but_gen_pass_in.ladda('start');
//   var pass_in_no=$('#txt_pass_in_no').val(); 
   var dataArray = [];

    // Iterate through each row in the DataTable
    tbl_pass_in_list.rows().every(function() {
        var data = this.data();
        

        dataArray.push({
            'Counter': data[0],
            'Category': data[1],
            'CategoryID': data[2],
            'ItemName': data[3],
            'ItemID': data[4],
            'ItemCode': data[5],
            'Description': data[6],
            'Qty': data[7],
            'Unit': data[8],
            
            // Add other properties as needed
        });
    });
    
                var company_id=$("#div_company_select option:selected").val();    
                  var company_name=$("#div_company_select option:selected").text();    
                  var pass_in_date=$("#pass_in_date").val();    
                  var approved_by=$("#approved_by").val();    
                  var checked_by=$("#checked_by").val();    
                  var received_by=$("#received_by").val();    
                  var description=$("#description").val();    
                  var qty=$("#qty").val();    
                  var pass_in_no=$("#txt_pass_in_no").val();    
                  //var unit=$("#div_unit_select_combo option:selected").text();
				  
		          var project_id = $('#div_slect_project option:selected').val();
		          var project_name = $('#div_slect_project option:selected').text();
                  var inventory_id = $('#select_iventory_item option:selected').val();
				  var inventory_name = $('#select_iventory_item option:selected').text();
				  var job_no_id = $('#div_select_job_no option:selected').val();
    			  var job_no = $('#div_select_job_no option:selected').text();
    			  var v_location=$("#location").val();
    			  var note=$("#txt_note").val();
    // console.log("data array"+dataArray[0]['Category']+dataArray[1]['Category'])
    
                if($.trim(company_id)=="" || $.trim(company_name)=="Select Company" || $.trim(v_location)=="" || $.trim(job_no_id)=="0" || $.trim(project_id)=="0" || $.trim(approved_by)=="" || $.trim(checked_by)=="" || $.trim(received_by)=="" || dataArray[0]['Description']==""|| dataArray[0]['Qty']==""|| dataArray[0]['Qty']<="0.00") 
			     {
				    swal("Warning","Please fill the required field", "warning");
				    v_but_gen_pass_in.ladda('stop');
					return false;
				 }
			    else
			    {
    
                          $.post("../controller/pass_in/pass_in_controller1.php",{action:'generate_pass_in',v_dataArray:dataArray,v_company_id:company_id,v_company_name:company_name,v_pass_in_date:pass_in_date,v_project_id:project_id, v_project_name:project_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by, v_pass_in_no:pass_in_no, job_no_id:job_no_id, job_no:job_no, v_location:v_location, v_note:note},function(result,status){
                             
                             swal("Success","Pass in generated successfully", "success");
                             v_but_gen_pass_in.ladda('stop');
                                var startIndex = result.indexOf('{');
                                var endIndex = result.lastIndexOf('}');
                                
                                // Extract the JSON string using substring
                                var jsonStr = result.substring(startIndex, endIndex + 1);
                                
                                // Parse the JSON string into an object
                                var jsonObj = JSON.parse(jsonStr);
                                $("#txt_pass_in_no").val(jsonObj.msg);
                                $('#btn_generate_pass_in').hide();
                            
                        	});
                        	
			    }
	
	
 });
 
 <!----------------------------------DataTableLoad------------------------------------------------------------>
        // function view_pass_in_list(pass_in_no)
        //             { 
        //                      tbl_pass_in_list.destroy();
        //                      tbl_pass_in_list = $('#tbl_pass_in_list').DataTable({
                                    
        //                              "ajax": {
        //                                  'type': 'POST',
        //                                  'url': '../controller/pass_in/pass_in_controller1.php',
        //                                  'data': {
        //                                     action: 'list_pass_in',
								// 			v_pass_in_no:pass_in_no
                                            
        //                                  }
        //                              },
        //                              "language": {
        //                                  "zeroRecords": "No records available",
        //                                  "infoEmpty": "No records available",
        //                               },
        //                             "order": [[ 0, "desc" ]],
        //             				"bPaginate": false,
        //             				"bLengthChange": false,
        //             				"bFilter": false,
        //             				"bInfo": false,
        //             				"autoWidth": false,
        //                             "columns": [
                                      
									  
        //                                  { "data": "pass_in_id"},
        //                                  { "data": "inventory"},
        //                                  { "data": "description"},
        //                                  { "data": "quantity"},
        //                                  { "data": "unit"},
        //                                  //{ "data": "driver_name"},
        //                                  // {"data": "quantity"},
        //                                  // {"data": "unit"},
        //                               //  {"data": "gate_pass_date"},
            					 
        //                           // {"data": "pass_in_id",
        //                                           // render: function ( data, type, rows, meta ) {
                        						
        //                 									// order_action = '<button type="button" class="btn btn-sm primary-gradient mr-2"  id="edit_pass_in" name="edit_pass_in" ><i class="material-icons ">edit</i></button><button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_pass_in" name="delete_pass_in"><i class="material-icons ">delete</i></button>';
        //     								                // return order_action;
                                                            
								// 						 // },
                        						
        //     					         // }
                     
        //                           {"data": "pass_in_id",
        //                                           render: function ( data, type, rows, meta ) {
                        						
        //                 									order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_pass_in" name="delete_pass_in"><i class="material-icons ">delete</i></button>';
        //     								                return order_action;
                                                            
								// 						 },
                        						
        //     					         }
                     
        //                              ],
        //                              pageLength: 25,
        //             				 searching: false,
        //                              responsive: true,
                    				
                                    
                                    
        //                              "initComplete": function( settings, json ) {
                                      
                                                              
                     
        //                               },
                                     
        //                               "fnRowCallback": function(nRow,aData,iDisplayIndex) {
									
        //                               $("td:first",nRow).html(iDisplayIndex+1);
								// 	   return nRow;

								// 	},
                     
        //                              })
										 
                                 
        //                      }
                
// ---------------------------------------------- Datatable load end --------------------------------------------
                 
        // $('#view_gate_list').click(function(){
           
		   // view_gate_list();	
		   	       

		// });				  
                
                
               
										           
 <!--------------------------------------DataTableBtnActions------------------------------------------->               
                     
   $('#tbl_pass_in_list tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = tbl_pass_in_list.row($row).data();
                        v_ids  = data.pass_in_id;
                        v_pass_in_no  = data.pass_in_no;
                        v_company_id  = data.company_id;
                        v_company_name = data.company_name;
                        v_project_name = data.project_name;
                        v_po_box  = data.po_box;
                        v_telephone_no  = data.telephone;
                        v_fax  = data.fax;
                        v_attn  = data.attn;
                        v_pass_in_date  = data.pass_in_date;
                        v_approved  = data.approved_by;
                        v_checked  = data.checked_by;
                        v_received  = data.received_by;
                        v_description  = data.description;
                        v_qty = data.quantity;
                        v_inventory_id  = data.inventory_id;
                        v_inventory_name  = data.inventory;
                        v_unit  = data.unit;
                        v_child_ids  = data.pass_in_child_id;
                        $("#hid_child_id").val(v_child_ids);  
                      
					  
						// if($(this).attr("name")=='edit_pass_in')
                         // { 
					     // $("#btn_pass_in_add").hide();
                         // $("#btn_pass_in_edit").show();
					     // $("#description").val(v_description);
                         // $("#qty").val(v_qty);
						 // $('#div_unit_select_combo option:selected').text(v_unit);
						 // $('#div_item_load option:selected').text(v_inventory_name);
						 // }
						 
						 if($(this).attr("name")=='delete_pass_in')
                         {  
					 	 swal({
								  title: "Do you want to delete the item?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {
										 $.post("../controller/pass_in/pass_in_controller1.php",{action:"delete_pass_in_child",child_ids:v_child_ids,v_inventory_id:v_inventory_id},function(result,status){
											 
											    if(status=='success')
												{
											     swal("Success","Deleted Successfully...","success");
												 view_pass_in_list(v_pass_in_no);
												 
												}
												else
												{
												  swal('Error',"Something Went Wrong","error");	
												}
												
												
											});
								  } 
								  else {
									   swal('Error',"Something Went Wrong","error");
								  }  
							});
						 
						 }
						 
						


   });	
   
<!----------------------------------SaveBtnAction------------------------------------>
           
                  
          $('#btn_pass_in_edit').click(function(){
                  var company_id=$("#div_company_select option:selected").val();    
                  var company_name=$("#div_company_select option:selected").text();    
                  var address=$("#address").val();    
                  var po_box=$("#po_box").val();    
                  var telephone_no=$("#contact_no").val();    
                  var fax=$("#fax").val();    
                  var attn=$("#attn").val();    
                  var pass_in_date=$("#pass_in_date").val();    
                  var inventory_id = $('#select_iventory_item option:selected').val();
				  var inventory_name = $('#select_iventory_item option:selected').text();
				  var approved_by=$("#approved_by").val();    
                  var checked_by=$("#checked_by").val();    
                  var received_by=$("#received_by").val();    
                  var description=$("#description").val();    
                  var qty=$("#qty").val();    
                  var unit=$("#div_unit_select_combo option:selected").text();    
                  var pass_in_no=$('#txt_pass_in_no').val(); 
		          var child_ids= $("#hid_child_id").val();
		
		
		
		   $.post("../controller/pass_in/pass_in_controller1.php",{action:'save_btn_action',v_company_id:company_id,v_company_name:company_name,v_address:address,v_po_box:po_box,v_telephone_no:telephone_no,v_fax:fax,v_attn:attn,v_pass_in_date:pass_in_date,v_inventory_id:inventory_id,v_inventory_name:inventory_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by,v_description:description,v_qty:qty,v_unit:unit,v_pass_in_no:pass_in_no,child_ids:child_ids},function(result,status){
           $('#pass_no_head').val(result);          
            
           $("#description").val("");		   
           $("#qty").val("");	
           load_unit_select_box("div_unit_select_combo","ctrl_name");		   
           view_pass_in_list(pass_in_no);		   
		   swal("Success","Data updated successfully...","success");
		   load_unit_select_box('div_unit_select_combo','select_unit');
        //   load_company_select_box('div_company_select','select_company');	   
           $("#btn_pass_in_add").show();
           $("#btn_pass_in_edit").hide();		   
		  	});
                    
}); 
  
<!--------------------------------------ListOfPassIn---------------------------------------->                     
       
                  $('#view_pass_in_list').click(function(){
              // alert("hhh");
                    // var v_start_date_year= new Date().getFullYear();
                    // $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                    load_data_to_grid_view_list_of_pass_in(); 
                     
                 });    
             
function load_data_to_grid_view_list_of_pass_in()
			 {

       list_of_pass_in.destroy();
                             list_of_pass_in = $('#list_of_pass_in').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/pass_in/pass_in_controller1.php',
                                         'data': {
                                            action: 'list_pass_in_view'
                                            
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
									  
                                         { "data": "pass_in_id"},
                                         { "data": "pass_in_no"},
                                         { "data": "company_name"},
                                         { "data": "project_name"},
                                         {"data": "pass_in_date"},
            					 
                                 {"data": "pass_in_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="view_pass_in" name="view_pass_in" ><i class="material-icons ">remove_red_eye</i></button>';
            								                return order_action;
                                                         },
                        						  },
										 {"data": "pass_in_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_pass_in_list" name="delete_pass_in_list" ><i class="material-icons ">delete</i></button>';
            								                return order_action;
                                                            
														
                        							 },
										 }			 
                     
                                     ],
                                     pageLength: 25,
                    				 searching: false,
                                     responsive: true,
                    				
                                    
                                    
                                     "initComplete": function( settings, json ) {
                                      
                                                              
                     
                                      },
                                     
                                      "fnRowCallback": function(nRow,aData,iDisplayIndex) {
									
                                       $("td:first",nRow).html(iDisplayIndex+1);
									   return nRow;

									},
                     
                                     })
										 
			}				
            
			
<!-----------------------------------ListOfGatePassWithDate----------------------------------------------->
 $("#btn_search_date").click(function()
			  {
			      var txt_start_date=$('#txt_start_date').val();				 
                  var txt_end_date=$('#txt_end_date').val();				 
				
				load_data_to_grid_view_list_of_pass_in_with_date(txt_start_date,txt_end_date); 
  
  
			  });
            
			
			
			function load_data_to_grid_view_list_of_pass_in_with_date(txt_start_date,txt_end_date)
			{
             list_of_pass_in.destroy();
                                 
                            list_of_pass_in = $('#list_of_pass_in').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/pass_in/pass_in_controller1.php',
                                         'data': {
                                            action: 'search_with_date',
											txt_start_date:txt_start_date,
											txt_end_date:txt_end_date
                                            
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
                                      
                                         { "data": "pass_in_id"},
                                         { "data": "pass_in_no"},
                                         { "data": "company_name"},
                                         { "data": "project_name"},
                                         {"data": "pass_in_date"},
                                   
                                    {"data": "pass_in_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="view_pass_in" name="view_pass_in" ><i class="material-icons ">remove_red_eye</i></button>';
            								                return order_action;
                                                            
															
            
						
                        							 },
                        							 
                        					 
                                                 
            					 
            					         },
										 {"data": "pass_in_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_pass_in_list" name="delete_pass_in_list" ><i class="material-icons ">delete</i></button>';
            								                return order_action;
                                                            
															
            
						
                        							 },
                        							 
                        					 
                                                 
            					 
            					         }
                     
                                     ],
                                     pageLength: 25,
                    				 searching: false,
                                     responsive: true,
                    				
                                    
                                    
                                     "initComplete": function( settings, json ) {
                                      
                                                              
                     
                                      },
                                   
                                      "fnRowCallback": function(nRow,aData,iDisplayIndex) {
									
                                       $("td:first",nRow).html(iDisplayIndex+1);
									   return nRow;

									},
                     
                                     })
			}
 
             
 <!---------------------------------------GatePassViewAction----------------------------------------------->

$('#list_of_pass_in tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = list_of_pass_in.row($row).data();
                        v_ids  = data.pass_in_id;
                        //v_address  = data.address;
                        v_pass_in_no  = data.pass_in_no;
                        v_company_id  = data.company_id;
                        v_company_name = data.company_name;
                        v_project_name= data.project_name;
                        v_po_box  = data.po_box;
                        v_telephone_no  = data.telephone;
                        v_fax  = data.fax;
                        v_attn  = data.attn;
                        v_pass_in_date  = data.pass_in_date;
                        v_approved  = data.approved_by;
                        v_checked  = data.checked_by;
                        v_received  = data.received_by;
                        v_inventory_id  = data.inventory_id;
                        v_inventory_name  = data.inventory_name;
                        v_description  = data.description;
                        v_qty = data.quantity;
                        v_unit  = data.unit;
                        v_child_ids  = data.pass_in_child_id;
                        var job_no  = data.job_no;
                        var v_location = data.location;
                        var v_note = data.note;
						if($(this).attr("name")=='view_pass_in')
                         { 
				// 	 alert(v_location);
					$('#btn_generate_pass_in').hide();
					 var parts = v_pass_in_date.split("-");
                     var v_formattedDate = parts[2] + "-" + parts[1] + "-" + parts[0];
	  
					     closeNavR();
				// 		 $('#div_company_select option').map(function () {
    //                      if ($(this).text() == v_company_name) return this;
    //                      }).attr('selected', 'selected');
						 $("#select_company").val(data.company_id);
                        $("#select_company").trigger("chosen:updated");
						  console.log(data);
                          $('#div_slect_project option:selected').text(v_project_name);
                          $('#div_select_job_no option:selected').text(job_no);
						  $("#po_box").val(v_po_box);     
                          $("#contact_no").val(v_telephone_no);
                          $("#fax").val(v_fax);
                          $("#attn").val(v_attn);
                          $("#txt_pass_in_no").val(v_pass_in_no);
						  $("#pass_in_date").val(v_formattedDate);
                          $("#approved_by").val(v_approved);
                          $("#checked_by").val(v_checked);
                          $("#received_by").val(v_received);
						  $('#div_category_load_pass option:selected').text();
						  $("#location").val(v_location);
						  $("#txt_note").val(v_note);
						   var hrefValue = "templates/workorder_view.php?val="+data.job_no; // Change this to your desired href value
                        $("#list_workorder").attr("href", hrefValue);
						  
						  
						  $.post("../controller/pass_in/pass_in_controller1.php",{action:'select_address',v_company_id:v_company_id},function(result,status){
                          var obj= jQuery.parseJSON(result);
					      var v_address=obj.data[0].address;		
					      $("#address").val(v_address); 	
				            });
				            tbl_pass_in_list.clear().draw();
				        $.post("../controller/pass_in/pass_in_controller1.php",{action:'select_child_table_details',v_master_ids:v_ids},function(result,status){
				            
				                 if(status=="success")
                                {
                                var obj= jQuery.parseJSON(result);
                                console.log(obj);
                                // view_gate_list(category,categoryid,item,itemid,itemCode,description,qty,unit)
                                // view_gate_list(obj.data[0].company_id);
                                obj.data.forEach(function(item) {
				                
				                  view_gate_list_for_edit(item.store_category, item.store_category_id, item.inventory_name, item.inventory_id, item.item_code, item.description, item.quantity, item.unit, item.ids);
                                });
                                
                                }else
                                {
                                    return false;
                                }
				            
				        });
						  
						 }
						 
						 
						 
						 
						 
						   if($(this).attr("name")=='delete_pass_in_list')
                         { 
					 
					  swal({
								  title: "Do you want to delete the item?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {
										 $.post("../controller/pass_in/pass_in_controller1.php",{action:"delete_pass_in_main",v_master_ids:v_ids},function(result,status){
											 
											    if(status=='success')
												{
											     swal("Success","Deleted successfully...","success");
												 load_data_to_grid_view_list_of_pass_in();		
	  
												}
												else
												{
												  swal('Error',"Something Went Wrong","error");	
												}
												
												
											});
								  } 
								  else {
									   swal('Error',"Something Went Wrong","error");
								  }  
							});
						 }
						 
});

$('#btn_pass_in_print_without_head').click(function()
{
	var pass_in_no=$('#txt_pass_in_no').val();
                   
                    if($.trim(pass_in_no)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create pass in for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                  else
                       {
						   window.open("reports/pdf/print/passin_updated.php?pass_in_no="+pass_in_no+"&x=1","_blank"); 
                
                          //window.open("reports/pass_in_without_head.php?pass_in_no="+pass_in_no,"_blank"); 
                       }
	
});

$('#btn_pass_in_print_with_head').click(function()
{
	var pass_in_no=$('#txt_pass_in_no').val();
                   
                    if($.trim(pass_in_no)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create pass in for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                  else
                       {
                          window.open("reports/pdf/print/passin_updated.php?pass_in_no="+pass_in_no+"&x=0","_blank"); 
                
						  //window.open("reports/pass_in_with_head.php?pass_in_no="+pass_in_no,"_blank"); 
                       }
	
});

$('#btn_pass_in_export_excel').click(function()
{
	var pass_in_no=$('#txt_pass_in_no').val();
                   
                    if($.trim(pass_in_no)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create pass in for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                  else
                       {
                         
						  window.open("reports/pass_in_with_head.php?pass_in_no="+pass_in_no,"_blank"); 
                       }
	
});
	});