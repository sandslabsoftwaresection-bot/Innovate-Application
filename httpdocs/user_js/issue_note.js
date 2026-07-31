$(document).ready(function(){
                
				 var balance;
                //  var tbl_gate_pass_list = $('#tbl_gate_pass_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});              
                var tbl_gate_pass_list = $('#tbl_gate_pass_list').DataTable({
                    searching: false,
                    paging: false,
                    info: false,
                    ordering: false,
                    columnDefs: [
                        { targets: [2, 4,5,9,10], visible: false } // Adjust column indices as needed
                    ]
                });
                
                tbl_gate_pass_list.on('draw', function () {
                tbl_gate_pass_list.cells().every(function (rowIdx, colIdx) {
                    var column = this.column(colIdx);
                    if ([0, 7, 8].includes(colIdx)) {
                        $(column.nodes()).addClass('text-center');
                    } 
                });
            });
            
            // tbl_salary_slip_list.column([4, 5]).nodes().to$().addClass('number-format'); // Ad
            $('.text-center').css('text-align', 'center');
            
                
                var v_but_gen_gate_pass = $( '#btn_generate_gate_pass' ).ladda();
                 var list_of_gate_pass_table = $('#list_of_gate_pass').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 var list_of_cancel_gate_pass_table = $('#list_of_cancel_gate_pass').DataTable( {searching: false, paging: false, info: false,"ordering": false});
				 var tbl_inventory_list = $('#tbl_inventory_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});
				 
                 // $("#btn_gate_pass_add").show();
                 // $("#btn_gate_pass_edit").hide();
				 $('#div_gate_pass_child').hide();
                	$('#div_company_select').load('templates/company_combo.php');
			        $('#div_category_load').load('templates/inventory_category_load_com.php');
			    	$("#div_category_load").change(function(){
                      
                              var v_cat_id=  $( "#select_iventory_category option:selected" ).val();
        					  
        		              var v_category= $( "#select_iventory_category option:selected" ).text();
        					 
        					  $("#div_item_load_gp").load("templates/inventory_item_code_load_com.php?category_id="+v_cat_id);
					
					  
				 });
			    
 <!----------------------------------CompanyLoad-----------------------------------------> 
 
                var currentDate = new Date(); 
                var formattedDate = currentDate.toISOString().substr(0, 10); 
                $('#gate_pass_date').val(formattedDate);
                
			//	load_company_select_box('div_company_select','select_company');
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
                                $("#txt_delivery_note_company_id").val(obj.data[0].company_id);
                                $("#txt_delivery_note_company_name").val(obj.data[0].company_name);
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
				$("#div_select_job_no").change(function() { 
				    var v_job_id=$('option:selected', this).text() ;
				    console.log("job id : "+v_job_id);
				    var hrefValue = "templates/workorder_view.php?val="+v_job_id; // Change this to your desired href value
                    $("#list_workorder").attr("href", hrefValue);
				    
				});
				$("#div_slect_project").change(function() { 
				    // alert("proj combo");
				
				     var v_project_id=$('option:selected', this).val() ;
				     //alert("proj combo"+v_project_id);
				      $("#div_select_job_no").load('../controller/gate_pass/gate_pass_controller.php',{action:'select_job_no_lst',v_ctrl_name:'select_job_no',v_project_id:v_project_id},function(result,status){
                                    console.log(result);
                          });  
				    
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
      var v_category_name;  
      var v_item_id
	 $('#div_item_load_gp').change(function(){
		 v_item_id = $('option:selected', this).val() ;
// 		 alert(v_item_name);
            $('#tbl_inventory_list').show();
		  load_data_to_grid_inventory_list(v_item_id,0);
		  $('#btn_generate_gate_pass').show();
		 
	 });
				 
	var flag=0;		 
	function load_data_to_grid_inventory_list(v_item_id,flag)
	 {
		 tbl_inventory_list.destroy();
		 tbl_inventory_list = $('#tbl_inventory_list').DataTable( {
				
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/gate_pass/gp_controller.php',
					 'data': {
						action: 'load_inventory_list',
						v_item_id:v_item_id
					 }
				 },
				 "language": {
					 "zeroRecords": "No records available",
					 "infoEmpty": "No records available",
				  },
				"order": [[ 0, "desc" ]],
				"bPaginate": false,
				"bLengthChange": false,
				"bFilter": true,
				"bInfo": false,
				"autoWidth": false,
				"columns": [
					
					 { "data": null,"width":'5%',className: "text-center"},
					 { "data": "inventory_name","width":'20%' , className: "text-center"},
					 { "data": "Stock" , "width":'10%',className: "text-center",
				// 	 "render": function (data, type, rows, meta) 
				// 		{
				// 			return data + " (" + rows.unit + ")";
				// 		}
					 },
					 { "data": "ids" ,"width":'20%', className: "text-center",
					 render: function ( data, type, rows, meta ) 
						{
						    if(flag==0){
        							var trnsfr_amt_edit =' <textarea  id="txt_desc_'+rows["inventory_id"]+'" name="txt_desc" style="width: 50%;">';
        							return trnsfr_amt_edit;
						    }
						    else
						    {
						        var trnsfr_amt_edit =' <textarea  id="txt_desc_'+rows["inventory_id"]+'" name="txt_desc" style="width: 50%;" disabled>';
        							return trnsfr_amt_edit;
						    }
        							
						},
					 },
					 { "data": "ids" ,"width":'10%', className: "text-center",
						render: function ( data, type, rows, meta ) 
						{
						     if(flag==0){
        							var trnsfr_amt_edit =' <input type="number"  id="txt_qty_'+rows["inventory_id"]+'" name="txt_qty" style="width:100px; text-align: center;">';
        							return trnsfr_amt_edit;
						     }
						     else
						     {
						         	var trnsfr_amt_edit =' <input type="number"  id="txt_qty_'+rows["inventory_id"]+'" name="txt_qty" style="width:100px; text-align: center;" disabled>';
        							return trnsfr_amt_edit;
						     }
						},
					 },
					 { "data": "ids","width":'10%', className: "text-center",
						render: function ( data, type, rows, meta ) 
						{
						    if(flag==0){
    							str_transfer = ' <button type="button" class="btn btn-md success-gradient mr-2"  id="btn_add" name="btn_add">Add</button>';
    							return str_transfer;
						    }
						    else
						    {
						  //      str_transfer = ' <button type="button" class="btn btn-md warning-gradient mr-2"  id="btn_edit" name="btn_edit"><i class="material-icons">edit</i>Edit</button>';
    				             str_transfer = '';
    				             return str_transfer;
						    }
						},
						 
					 },
					 
				 ],
				 pageLength: 100,
				 searching: true,
				 responsive: true,
				 destroy: true,
				 
				 "initComplete": function( settings, json ) {
				  },
				   "order": [
					  [3, 'asc']
					],
				  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
					 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
					 return nRow;
				  },
					"displayLength": 100,
					
					"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [  0,1,2,3,4,5] }, 
					
				],
					
			 
				
		 });  
	
	 }
	 
	 $('#tbl_inventory_list tbody').on('change', 'td input', function() {
	    
	     if($(this).attr("name")=='txt_qty')
					{
					    	var $row = $(this).closest('tr');
		                	var data = tbl_inventory_list.row($row).data();
		                	var stock=data.Stock;
		                	var item_id=data.inventory_id;
		                	var v_qty = $('#txt_qty_'+item_id).val();
		                	if(parseFloat(v_qty)>parseFloat(stock))
		                	{
		                	    swal("Error","Please check the quantity enterd", "error");
		                	    	$('#txt_qty_'+item_id).val(0);
								$('#txt_qty_'+item_id).css('border-color', 'red');
		                	}
		                	else
		                	{
		                	    $('#txt_qty_'+item_id).css('border-color', '');
							
		                	}
					    
					}
	     
	 }); 
	 
	 
	 var counter = 1;
	  $('#tbl_inventory_list tbody').on('click', 'td button', function() {
			 
			var $row = $(this).closest('tr');
			var data = tbl_inventory_list.row($row).data();
// 			console.log("stock data"+data.Stock);
			var store_id = data.inventory_id;
			var inventory_name = data.item_name;
			var unit = data.unit;
			var item_id = data.inventory_id;
			var item_name = data.inventory_name;
			var inputIdd = 'txt_desc_' + store_id;
			var description = $('#' + inputIdd).val();
			var stock=data.Stock;
// 			alert(description);
			var category_name = data.store_category;
			var item_code = data.item_code;
			var category_id = data.store_category_id;
			var inputId = 'txt_qty_' + store_id;
			var qty = $('#' + inputId).val();
// 			alert(item_code);
			  var company_id=$("#div_company_select option:selected").val();    
			  var company_name=$("#div_company_select option:selected").text();    
			  var gate_pass_date=$("#gate_pass_date").val();    
			  var vehicle_no=$("#vehicle_no").val();    
			  var driver_name=$("#driver").val();    
			  var approved_by=$("#approved_by").val();    
			  var checked_by=$("#checked_by").val();    
			  var received_by=$("#received_by").val();
			  var pass_no=$("#txt_pass_no").val(); 			  
			  
			 //alert(company_id+company_name+gate_pass_date+vehicle_no+driver_name+approved_by+checked_by+received_by);
			  
			  var project_id = $('#div_slect_project option:selected').val();
			  var project_name = $('#div_slect_project option:selected').text();
			  
			  //alert(project_id+' '+project_name+' '+inventory_id+' '+inventory_name+unit+description);
			  vehicle_no = 0;
			  driver_name = 'NoName';
			  
			  if($.trim(company_id)=="" || $.trim(company_name)=="Select Company" || $.trim(project_id)=="0" || $.trim(vehicle_no)=="" || $.trim(driver_name)=="" || $.trim(approved_by)=="" || $.trim(checked_by)=="" || $.trim(received_by)=="" || description==""|| parseFloat(qty)==""|| qty<="0.00" || unit=="") 
			     {
				    swal("Warning","Please fill the required field", "warning");
					return false;
				 }
				 else
				 {
				     view_gate_list(category_name, category_id, item_name, item_id, item_code, description, qty, stock, unit,'');
		  //          $.post("../controller/gate_pass/gp_controller.php",{action:'add_btn_action',v_company_id:company_id,v_company_name:company_name,v_gate_pass_date:gate_pass_date,v_vehicle_no:vehicle_no,v_driver_name:driver_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by,v_description:description,v_qty:qty,v_unit:unit,v_pass_no:pass_no, v_project_id:project_id, v_project_name:project_name, v_inventory_id:store_id, v_inventory_name:inventory_name},function(result,status)
				// 	{
				// 	   $('#pass_no_head').val(result);          
				// 	   $('#txt_pass_no').val(result); 
				// 	   $("#description").val("");		   
				// 	   $("#qty").val("");		
					   $('#div_gate_pass_child').show();
					   $('#tbl_inventory_list').hide();
				// 	   load_data_to_grid_inventory_list(item_id);
				// 	   var pass_no=result.trim();		   
				// 	   //view_gate_list(pass_no);	
					  
				// 	   //load_company_select_box('div_company_select','select_company');
				//     });
				     $('#select_iventory_category').val(0);
                    $("#select_iventory_item").val("").trigger("chosen:updated");
				 }
			
	  });
     
<!-----------------------------------Generate_btn---------------------------------------------->
  $('#btn_generate_gate_pass').click(function(){
   v_but_gen_gate_pass.ladda('start');
   var pass_no=$('#txt_pass_no').val();
   var dataArray = [];

    // Iterate through each row in the DataTable
    tbl_gate_pass_list.rows().every(function() {
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
            'Unit': data[9],
            
            // Add other properties as needed
        });
    });

    // Log the resulting array to the console (you can perform any further actions here)
    // console.log(dataArray);
              var company_id=$("#div_company_select option:selected").val();    
			  var company_name=$("#div_company_select option:selected").text();    
			  var gate_pass_date=$("#gate_pass_date").val();
			  var project_id = $('#div_slect_project option:selected').val();
			  var project_name = $('#div_slect_project option:selected').text();
			  var vehicle_no=$("#vehicle_no").val();    
			  var driver_name=$("#driver").val();    
			  var approved_by=$("#approved_by").val();    
			  var checked_by=$("#checked_by").val();    
			  var received_by=$("#received_by").val();
			  var job_no_id = $('#div_select_job_no option:selected').val();
			  var job_no = $('#div_select_job_no option:selected').text();
			  var v_location=$("#location").val();
			  var note=$("#txt_note").val();
			  vehicle_no = 0;
			  driver_name = 'NoName';
			 // console.log(dataArray[0]['Qty']);
			  if($.trim(company_id)=="" || $.trim(company_name)=="Select Company" || $.trim(v_location)=="" || $.trim(job_no_id)=="0" || $.trim(project_id)=="0" || $.trim(vehicle_no)=="" || $.trim(driver_name)=="" || $.trim(approved_by)=="" || $.trim(checked_by)=="" || $.trim(received_by)=="" || dataArray[0]['Description']==""|| dataArray[0]['Qty']==""|| dataArray[0]['Qty']<="0.00") 
			     {
				    swal("Warning","Please fill the required field", "warning");
				    v_but_gen_gate_pass.ladda('stop');
					return false;
				 }
			    else
			    {
			  
			  
                      $.post("../controller/gate_pass/gp_controller.php",{action:'generate_gate_pass',v_pass_no:pass_no, v_dataArray:dataArray, v_company_id:company_id, v_company_name:company_name, v_gate_pass_date:gate_pass_date, v_project_id:project_id, v_project_name:project_name, v_vehicle_no:vehicle_no,v_driver_name:driver_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by, job_no_id:job_no_id, v_job_no:job_no, v_location:v_location, v_note:note},function(result,status){
                         
                      swal("Success","Issue note generated successfully", "success");
                      v_but_gen_gate_pass.ladda('stop');
                      // view_gate_list(pass_no);
                            var startIndex = result.indexOf('{');
                            var endIndex = result.lastIndexOf('}');
                            
                            // Extract the JSON string using substring
                            var jsonStr = result.substring(startIndex, endIndex + 1);
                            
                            // Parse the JSON string into an object
                            var jsonObj = JSON.parse(jsonStr);
                            $("#txt_pass_no").val(jsonObj.msg);
                            $('#btn_generate_gate_pass').hide();
	                    });
	                    
			    }
 });
 
 <!-----------------------------------Edit gate pass---------------------------------------------->
  $('#btn_edit_gate_pass').click(function(){
   
	var pass_no=$('#txt_pass_no').val();  
   
    var company_id=$("#div_company_select option:selected").val();    
	var company_name=$("#div_company_select option:selected").text();    
	var gate_pass_date=$("#gate_pass_date").val();    
	var vehicle_no=$("#vehicle_no").val();    
	var driver_name=$("#driver").val();    
	var approved_by=$("#approved_by").val();    
	var checked_by=$("#checked_by").val();    
	var received_by=$("#received_by").val();    
	
	var address = $("#address").val();    
	var po_box = $("#po_box").val();    
	var contact_no = $("#contact_no").val();    
	var fax = $(fax).val();    
	var attn = $("#attn").val();    
				  
   $.post("../controller/gate_pass/gp_controller.php",{action:'update_gate_pass',v_pass_no:pass_no,v_company_id:company_id,v_company_name:company_name,v_gate_pass_date:gate_pass_date,v_vehicle_no:vehicle_no,v_driver_name:driver_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by,v_address:address,v_po_box:po_box,v_telephone_no:contact_no,v_fax:fax,v_attn:attn},function(result,status){
     
   swal("Success","Gate Pass generated successfully", "success");
   
   $('#btn_edit_gate_pass').hide();
   $('#btn_generate_gate_pass').show();
   // view_gate_list(pass_no);
   
	});
 });
 
 <!----------------------------------DataTableLoad------------------------------------------------------------>
    //   function view_gate_list(pass_no)
    //                 { 
    //                          tbl_gate_pass_list.destroy();
    //                          tbl_gate_pass_list = $('#tbl_gate_pass_list').DataTable({
                                    
    //                                  "ajax": {
    //                                      'type': 'POST',
    //                                      'url': '../controller/gate_pass/gate_pass_controller.php',
    //                                      'data': {
    //                                         action: 'list_gate_pass',
				// 							v_pass_no:pass_no
                                            
    //                                      }
    //                                  },
    //                                  "language": {
    //                                      "zeroRecords": "No records available",
    //                                      "infoEmpty": "No records available",
    //                                   },
    //                                 "order": [[ 0, "desc" ]],
    //                 				"bPaginate": false,
    //                 				"bLengthChange": false,
    //                 				"bFilter": false,
    //                 				"bInfo": false,
    //                 				"autoWidth": false,
    //                                 "columns": [
									  
    //                                      { "data": "gate_pass_id"},
				// 						 { "data": "inventory_name"},
    //                                      { "data": "description"},
    //                                      { "data": "quantity"},
    //                                      { "data": "unit"},
    //                                      {"data": "gate_pass_id",
    //                                          render: function ( data, type, rows, meta )
				// 								    {
    //                     								order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_gate_pass_list" name="delete_gate_pass_list"><i class="material-icons ">delete</i></button>';
    //         								            return order_action;
    //                     							},
            					 
    //         					         }
                     
    //                                  ],
    //                                  pageLength: 25,
    //                 				 searching: false,
    //                                  responsive: true,
                    				
                                    
                                    
    //                                  "initComplete": function( settings, json ) {
                                      
                                                              
                     
    //                                   },
                                     
    //                                   "fnRowCallback": function(nRow,aData,iDisplayIndex) {
									
    //                                   $("td:first",nRow).html(iDisplayIndex+1);
				// 					   return nRow;

				// 					},
                     
    //                                  })
										 
                                 
    //                          }
                
				
             function view_gate_list(category,categoryid,item,itemid,itemCode,description,qty, stock, unit,childId)
                    { 
                    tbl_gate_pass_list.row.add([
                    counter++,
                    category,
                    categoryid,
                    item,
                    itemid,
                    itemCode,
                    description,
                    qty,
                    stock,
                    unit,
                    childId,
                    '<button class="btn btn-danger btn-sm delete-row">Delete</button>' // Delete button
                    
                ]).draw();
                       
                        // Attach click event handler to delete button
                        $('#tbl_gate_pass_list').on('click', '.delete-row', function() {
                            var row = $(this).closest('tr');
                            tbl_gate_pass_list.row(row).remove().draw(false);
                        });
                                    
                    }
      
                 function view_gate_list_for_edit(category,categoryid,item,itemid,itemCode,description,qty, stock, unit,childID)
                    { 
                    tbl_gate_pass_list.row.add([
                    counter++,
                    category,
                    categoryid,
                    item,
                    itemid,
                    itemCode,
                    description,
                    qty,
                    stock,
                    unit,
                    childID,
                    '<button class="btn btn-danger btn-sm delete-row">Delete</button>' + // Delete button
                    '<button class="btn btn-primary btn-sm update-row">Update</button>' // Update button
                    
                ]).draw();
             }      
                        // Attach click event handler to delete button
                        $('#tbl_gate_pass_list').on('click', '.delete-row', function() {
                            var rowData = tbl_gate_pass_list.row($(this).closest('tr')).data();
                            var v_child_ids = rowData[10];
                            var row = $(this).closest('tr');
                             swal({
								  title: "Do you want to delete the item?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {
                            
                                        $.post("../controller/gate_pass/gate_pass_controller.php",{action:"delete_gatepass_child",child_ids:v_child_ids},function(result,status){
            											 
            											 //alert(result);
            											    if(result== 1)
            												{
            												    
            												    
                                                                 tbl_gate_pass_list.row(row).remove().draw(false);
            												}
                                        });
                                        
								  }    
								});
                        });
                        $('#tbl_gate_pass_list').on('click', '.update-row', function() {
                            
                            var row = $(this).closest('tr'); // Define 'row' here
                            var rowData = tbl_gate_pass_list.row(row).data();
                             var item_id = rowData[4]; // Assuming itemid is the fifth column (index 4) in the row data
                            // load_data_to_grid_inventory_list(item_id,1);
                            // Extracting data from the row
                            var description = rowData[6];
                            var qty = rowData[7];
                            var stock=rowData[8];
                            var total_quantity=parseFloat(qty)+parseFloat(stock);
                           
                            $("#txt_total_quantity").val(total_quantity);
                            // Creating input fields
                            var descriptionInput = '<input type="text" class="form-control" value="' + description + '" name="description">';
                            var qtyInput = '<input type="number" class="form-control" min=0 value="' + qty + '" name="qty">';
                        
                            // Replacing cell content with input fields
                            row.find('td:eq(3)').html(descriptionInput); // Replace cell content for description
                            row.find('td:eq(4)').html(qtyInput); // Replace cell content for qty
                            
                              row.find('td:eq(4) input[name="qty"]').on('change', function() {
                                    var enteredQty = parseFloat($(this).val());
                                    if (enteredQty > total_quantity) {
                                        // Entered quantity is greater than total quantity
                                        swal("Warning","You can only enter the quantity upto "+ total_quantity, "warning");
                                        // Reset the entered quantity to the previous value
                                        $(this).val(qty);
                                    }
                                });
                        
                            // Changing the button text and class
                            $(this).text('Save').removeClass('update-row').addClass('save-row');
                                                   
                        });
                         $('#tbl_gate_pass_list').on('click', '.save-row', function() {
                             var row = $(this).closest('tr');
                                var description = row.find('input[name="description"]').val(); // Assuming input field for description has name="description"
                                var qty = row.find('input[name="qty"]').val(); 
                                console.log("Changed description: " + description);
                                console.log("Changed qty: " + qty);
                                var row = $(this).closest('tr'); // Define 'row' here
                                var rowData = tbl_gate_pass_list.row(row).data();
                                var child_ids = rowData[10]; 
                                var master_id = $("#txt_master_ref_id").val();
                                // alert(child_id);
                                $.post("../controller/gate_pass/gate_pass_controller.php",{action:"update_child", child_ids:child_ids, v_qty:qty, v_description:description},function(result,status){
											 
											 //alert(result);
											    if(result== 1)
												{
												    
												  swal("Success","Quantity updated successfully", "success");
                                                    //  tbl_gate_pass_list.row(row).remove().draw(false);
                                                    tbl_gate_pass_list.clear().draw();
                                                    load_data_to_grid_to_second_table(master_id);
												}
                            });
                                
                                
                        
                         });
                                            
                    // }
      
                
               
										           
 <!--------------------------------------DataTableBtnActions------------------------------------------->               
                      
   $('#tbl_gate_pass_list tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = tbl_gate_pass_list.row($row).data();
                        v_ids  = data.gate_pass_id;
                        v_pass_no  = data.pass_no;
                        v_company_id  = data.company_id;
                        v_company_name = data.company_name;
                        v_po_box  = data.po_box;
                        v_telephone_no  = data.telephone_no;
                        v_fax  = data.fax;
                        v_attn  = data.attn;
                        v_gate_pass_date  = data.gate_pass_date;
                        v_vehicle_no  = data.vehicle_no;
                        v_driver_name  = data.driver_name;
                        v_approved  = data.approved_by;
                        v_checked  = data.checked_by;
                        v_received  = data.received_by;
                        v_pass_no  = data.pass_no;
                        v_description  = data.description;
                        v_qty = data.quantity;
                        v_unit  = data.unit;
                        v_child_ids  = data.gate_pass_child_id;
                        $("#hid_child_id").val(v_child_ids);  
                         if($(this).attr("name")=='edit_gate_pass')
                         { 
					     $("#btn_gate_pass_add").hide();
                         $("#btn_gate_pass_edit").show();
					     $('#div_company_select option').map(function () {
                         if ($(this).text() == v_company_name) return this;
                         }).attr('selected', 'selected');
                         $("#po_box").val(v_po_box);
                         $("#contact_no").val(v_telephone_no);
                         $("#fax").val(v_fax);
                         $("#attn").val(v_attn);
                         $("#gate_pass_date").val(v_gate_pass_date);
                         $("#vehicle_no").val(v_vehicle_no);
                         $("#driver").val(v_driver_name);
                         $("#approved_by").val(v_approved);
                         $("#received_by").val(v_received);
                         $("#checked_by").val(v_checked);
                         $("#txt_pass_no").val(v_pass_no);
                         $("#description").val(v_description);
                         $("#qty").val(v_qty);
						 $('#select_unit option:selected').text(v_unit);
						 $('#div_item_load option:selected').text(data.inventory_name);
						 $('#txt_inventory_id').val(data.inventory_id);
						 //$('#div_item_load').trigger('change');
						 }
						  
						 
						 if($(this).attr("name")=='delete_gate_pass_list')
                         {  
					 	 swal({
								  title: "Do you want to delete the item?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {
										 $.post("../controller/gate_pass/gp_controller.php",{action:"delete_gate_pass",child_ids:v_child_ids,v_qty:v_qty,v_inventory_id:data.inventory_id},function(result,status){
											 
											    if(status=='success')
												{
											     swal("Success","Deleted Successfully...","success");
												 view_gate_list(v_pass_no);		
	                                              load_company_select_box('div_company_select','select_company');
				                                  load_unit_select_box('div_unit_select_combo','select_unit');
												}
												else
												{
												  swal('Error',"Something Went Wrong","error");	
												}
												
												
											});
								  } 
								//   else {
								// 	   swal('Error',"Something Went Wrong","error");
								//   }  
							});
						 }

   });						 
<!----------------------------------SaveBtnAction------------------------------------>
           
                  
          $('#btn_gate_pass_edit').click(function(){
                  var company_id=$("#div_company_select option:selected").val();    
                  var company_name=$("#div_company_select option:selected").text();    
                  var address=$("#address").val();    
                  var po_box=$("#po_box").val();    
                  var telephone_no=$("#contact_no").val();    
                  var fax=$("#fax").val();    
                  var attn=$("#attn").val();    
                  var gate_pass_date=$("#gate_pass_date").val();    
                  var vehicle_no=$("#vehicle_no").val();    
                  var driver_name=$("#driver").val();    
                  var approved_by=$("#approved_by").val();    
                  var checked_by=$("#checked_by").val();    
                  var received_by=$("#received_by").val();    
                  var description=$("#description").val();    
                  var qty=$("#qty").val();    
                  var unit=$("#div_unit_select_combo option:selected").text();    
                  var pass_no=$('#txt_pass_no').val(); 
		          var child_ids= $("#hid_child_id").val();
                  var inventory_id = $("#txt_inventory_id").val();
		   $.post("../controller/gate_pass/gate_pass_controller.php",
		   {action:'save_btn_action',v_company_id:company_id,v_company_name:company_name,v_address:address,v_po_box:po_box,v_telephone_no:telephone_no,v_fax:fax,v_attn:attn,v_gate_pass_date:gate_pass_date,v_vehicle_no:vehicle_no,v_driver_name:driver_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by,v_description:description,v_qty:qty,v_unit:unit,v_pass_no:pass_no,child_ids:child_ids, v_inventory_id:inventory_id},
		   function(result,status){
           $('#pass_no_head').val(result);          
           //$('#txt_pass_no').val(result); 
           $("#description").val("");		   
           $("#qty").val("");	
           //load_unit_select_box("#div_unit_select_combo","ctrl_name");		   
           // $("#div_unit_select_combo").val("Please Select").trigger("change");
           view_gate_list(pass_no);		   
		   swal("Success","Data updated successfully...","success");
		   load_unit_select_box('div_unit_select_combo','select_unit');	
		   load_company_select_box('div_company_select','select_company');
           $("#btn_gate_pass_add").show();
           $("#btn_gate_pass_edit").hide();		   
		  	});
                    
}); 
   
<!--------------------------------------ListOfGatePass---------------------------------------->                     
        
                  $('#view_gate_list').click(function(){
                   
                    // 	var v_start_date_year= new Date().getFullYear();
                    	   // alert(v_start_date_year);
               
                    // $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                    load_data_to_grid_view_list_of_gate_pass(); 
                     
                 });    
                        
            
			function load_data_to_grid_view_list_of_gate_pass()
			{
				 list_of_gate_pass_table.destroy();
                                 
                             list_of_gate_pass_table = $('#list_of_gate_pass').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/gate_pass/gate_pass_controller.php',
                                         'data': {
                                            action: 'list_gate_pass_view'
                                            
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
                                      
                                         { "data": "gate_pass_id"},
                                         { "data": "pass_no"},
                                         { "data": "job_no"},
                                         { "data": "company_name"},
                                         { "data": "project_name"},
                                         {"data": "gate_pass_date"},
                                   
										 {"data": "gate_pass_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="view_gate_pass" name="view_gate_pass" ><i class="material-icons ">remove_red_eye</i></button>';
            								                return order_action;
                                                         },
                        						  },
										 {"data": "gate_pass_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_gate_pass" name="delete_gate_pass" ><i class="material-icons ">delete</i></button>';
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
				
				load_data_to_grid_view_list_of_gate_pass_with_date(txt_start_date,txt_end_date); 
  
  
			  });
            
			function load_data_to_grid_view_list_of_gate_pass_with_date(txt_start_date,txt_end_date)
			{
             list_of_gate_pass_table.destroy();
                                 
                            list_of_gate_pass_table = $('#list_of_gate_pass').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/gate_pass/gate_pass_controller.php',
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
                                      
                                         { "data": "gate_pass_id"},
                                         { "data": "pass_no"},
                                         { "data": "job_no"},
                                         { "data": "company_name"},
                                         { "data": "project_name"},
                                         {"data": "gate_pass_date"},
                                   
										 {"data": "gate_pass_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="view_gate_pass" name="view_gate_pass" ><i class="material-icons ">remove_red_eye</i></button>';
            								                return order_action;
                                                         },
                        						  },
										 {"data": "gate_pass_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_gate_pass" name="delete_gate_pass" ><i class="material-icons ">delete</i></button>';
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

$('#list_of_gate_pass tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = list_of_gate_pass_table.row($row).data();
                        v_ids  = data.gate_pass_id;
                        v_address  = data.address;
                        v_pass_no  = data.pass_no;
                        v_company_id  = data.company_id;
                        v_company_name = data.company_name;
                        v_po_box  = data.po_box;
                        v_telephone_no  = data.telephone_no;
                        v_fax  = data.fax;
                        v_attn  = data.attn;
                        v_gate_pass_date  = data.gate_pass_date;
                        v_gate_pass_date = date_convert(v_gate_pass_date);
                        v_vehicle_no  = data.vehicle_no;
                        v_driver_name  = data.driver_name;
                        v_approved  = data.approved_by;
                        v_checked  = data.checked_by;
                        v_received  = data.received_by;
                       var v_location = data.location;
                       var v_note = data.note;
                        //v_pass_no  = data.pass_no;
                        // v_description  = data.description;
                        // v_qty = data.quantity;
                        // v_unit  = data.unit;
                        // v_child_ids  = data.gate_pass_child_id;
                        // console.log("main"+data.job_no+"--"+data.job_id);
                        
						if($(this).attr("name")=='view_gate_pass')
                         { 
					     closeNavR();
						  //$('#div_company_select option').map(function () {
        //                  if ($(this).text() == v_company_name) return this;
        //                  }).attr('selected', 'selected');
						 tbl_gate_pass_list.clear().draw();
						 	$("#select_company").val(v_company_id);
                             $("#select_company").trigger("chosen:updated");
                       $("#div_slect_project").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:v_company_id},function(result,status){
                                   if(status=="success")
                                   {
                                     
                                       $('#div_slect_project option').map(function () {
                                        if ($(this).text() == $.trim(data.project_name)) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
                        });
                        $("#div_select_job_no").load('../controller/gate_pass/gate_pass_controller.php',{action:'select_job_no_lst',v_ctrl_name:'select_job_no',v_project_id:data.project_id},function(result,status){
                         
                                   if(status=="success")
                                   {
                                     
                                       $('#div_select_job_no option').map(function () {
                                        if ($(this).text() == $.trim(data.job_no)) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }  
                                    
                          });  
                          var hrefValue = "templates/workorder_view.php?val="+data.job_no; // Change this to your desired href value
                        $("#list_workorder").attr("href", hrefValue);
                        
                          $("#address").val(v_address);     
                          $("#po_box").val(v_po_box);     
                          $("#contact_no").val(v_telephone_no);
                          $("#fax").val(v_fax);
                          $("#attn").val(v_attn);
                          $("#gate_pass_date").val(v_gate_pass_date);
                          $("#txt_pass_no").val(v_pass_no);
                          $("#vehicle_no").val(v_vehicle_no);
                          $("#driver").val(v_driver_name);
                          $("#approved_by").val(v_approved);
                          $("#location").val(v_location);
                          $("#checked_by").val(v_checked);
                          $("#received_by").val(v_received);
                          $("#txt_note").val(v_note);
						  $('#div_gate_pass_child').show();
						  $('#btn_edit_gate_pass').show();
						  $('#btn_generate_gate_pass').hide();
						  //$("#select_iventory_category").val(v_company_id);
        //                 $("#select_iventory_category").trigger("chosen:updated");
						  //$('#div_category_load').load('templates/inventory_category_combo.php');
						     
						    $("#txt_master_ref_id").val(v_ids);
						  load_data_to_grid_to_second_table(v_ids)
						  //view_gate_list(v_pass_no);
						  //load_data_to_grid_inventory_list();
						 }
						 
						   if($(this).attr("name")=='delete_gate_pass')
                         { 
					  swal({
								  title: "Do you want to delete the item?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {
										 $.post("../controller/gate_pass/gate_pass_controller.php",{action:"delete_gate_pass_action",v_pass_no:v_pass_no},function(result,status){
											 
											    if(status=='success')
												{
											     swal("Success","Deleted successfully...","success");
												 load_data_to_grid_view_list_of_gate_pass();		
	  
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


function date_convert(dateString)
{
    var monthNames = {
      "Jan": 0, "Feb": 1, "Mar": 2, "Apr": 3, "May": 4, "Jun": 5,
      "Jul": 6, "Aug": 7, "Sep": 8, "Oct": 9, "Nov": 10, "Dec": 11
    };
    // Parse the input date string
            var dateParts = dateString.split("-");
            var day = parseInt(dateParts[0], 10);
            var month = monthNames[dateParts[1]];
            var year = parseInt(dateParts[2], 10);
            
            // Create a Date object using the parsed components
            var dateObj = new Date(year, month, day);
            
            // Format the date to "yyyy-MM-dd"
            var formattedDate = dateObj.getFullYear() + '-' + ('0' + (dateObj.getMonth() + 1)).slice(-2) + '-' + ('0' + dateObj.getDate()).slice(-2);
    
    return(formattedDate);
}




function load_data_to_grid_to_second_table(v_ids)
{
    $.post("../controller/gate_pass/gate_pass_controller.php",{action:'select_child_table_details',v_gate_pass_ids:v_ids},function(result,status){
                        
                                if(status=="success")
                                {
                                var obj= jQuery.parseJSON(result);
                                console.log(obj);
                                // view_gate_list(category,categoryid,item,itemid,itemCode,description,qty,unit)
                                // view_gate_list(obj.data[0].company_id);
                                obj.data.forEach(function(item) {
                                // var company_id = item.company_id;
                                view_gate_list_for_edit(item.store_category, item.store_category_id, item.inventory_name, item.inventory_id, item.item_code, item.description, item.qty_out, item.stock, item.unit, item.ids);
                                $('#tbl_inventory_list').hide();
                                    
                                });
                                
                                }else
                                {
                                    return false;
                                }
						   });  
}
<!-----------------------------------CancelledGatePass---------------------------------------->
/*  $('#btn_view_list_of_cancelled_gate_pass').click(function(){
                
                    var v_start_date_year= new Date().getFullYear();
                    $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                    load_data_to_grid_view_list_of_gate_pass_cancel(); 
                     
                 });  


	function load_data_to_grid_view_list_of_gate_pass_cancel()
			{
             list_of_cancel_gate_pass_table.destroy();
                                 
                            list_of_cancel_gate_pass_table = $('#list_of_cancel_gate_pass').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/gate_pass/gate_pass_controller.php',
                                         'data': {
                                            action: 'list_cancelled_gate_pass'
											
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
                                      
                                         { "data": "gate_pass_id"},
                                         { "data": "pass_no"},
                                         { "data": "company_name"},
                                         { "data": "vehicle_no"},
                                         { "data": "driver_name"},
                                         {"data": "gate_pass_date"},
                                   
                                    {"data": "gate_pass_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="cancel_view_gate_pass" name="cancel_view_gate_pass" ><i class="material-icons ">remove_red_eye</i></button>';
            								                return order_action;
                                                            
															
            
						
                        							 },
                        							 
                        					 
                                                 
            					 
            					         },
									
                     
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
<!---------------------------------------CancelledGatePassViewAction----------------------------------------------->

$('#list_of_cancel_gate_pass tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = list_of_cancel_gate_pass_table.row($row).data();
                        v_ids  = data.gate_pass_id;
                        v_pass_no  = data.pass_no;
                        v_company_id  = data.company_id;
                        v_company_name = data.company_name;
                        v_address = data.address;
                        v_po_box  = data.po_box;
                        v_telephone_no  = data.telephone_no;
                        v_fax  = data.fax;
                        v_attn  = data.attn;
                        v_gate_pass_date  = data.gate_pass_date;
                        v_vehicle_no  = data.vehicle_no;
                        v_driver_name  = data.driver_name;
                        v_approved  = data.approved_by;
                        v_checked  = data.checked_by;
                        v_received  = data.received_by;
                        //v_pass_no  = data.pass_no;
                        // v_description  = data.description;
                        // v_qty = data.quantity;
                        // v_unit  = data.unit;
                        // v_child_ids  = data.gate_pass_child_id;
                        
                         if($(this).attr("name")=='cancel_view_gate_pass')
                         { 
					
					     closeNavRCancel();
						  $('#div_company_select option').map(function () {
                         if ($(this).text() == v_company_name) return this;
                         }).attr('selected', 'selected');
                          $("#address").val(v_address);     
                          $("#po_box").val(v_po_box);     
                          $("#contact_no").val(v_telephone_no);
                          $("#fax").val(v_fax);
                          $("#attn").val(v_attn);
                          $("#gate_pass_date").val(v_gate_pass_date);
                          $("#txt_pass_no").val(v_pass_no);
                          $("#vehicle_no").val(v_vehicle_no);
                          $("#driver").val(v_driver_name);
                          $("#approved_by").val(v_approved);
                          $("#checked_by").val(v_checked);
                          $("#received_by").val(v_received);
                          view_gate_list(v_pass_no);
                 
						 }
				  });


<!-----------------------------------ListOfGatePassWithDate----------------------------------------------->
$("#btn_cancel_search_date").click(function()
			  {
			      var txt_start_date=$('#txt_start_date').val();				 
                  var txt_end_date=$('#txt_end_date').val();				 
				
				load_data_to_grid_view_list_of_cancelled_gate_pass_with_date(txt_start_date,txt_end_date); 
  
  
			  });
            
			function load_data_to_grid_view_list_of_cancelled_gate_pass_with_date(txt_start_date,txt_end_date)
			{
             list_of_cancel_gate_pass_table.destroy();
                                 
                            list_of_cancel_gate_pass_table = $('#list_of_cancel_gate_pass').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/gate_pass/gate_pass_controller.php',
                                         'data': {
                                            action: 'cancelled_search_with_date',
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
                                      
                                         { "data": "gate_pass_id"},
                                         { "data": "pass_no"},
                                         { "data": "company_name"},
                                         { "data": "vehicle_no"},
                                         { "data": "driver_name"},
                                         {"data": "gate_pass_date"},
                                   
                                    {"data": "gate_pass_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="view_gate_pass" name="view_gate_pass" ><i class="material-icons ">remove_red_eye</i></button>';
            								                return order_action;
                                                            
															
            
						
                        							 },
                        							 
                        					 
                                                 
            					 
            					         },
										
                     
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
 */
 <!-------------------------------------PrintWithoutHead-------------------------------------->
$("#btn_gate_pass_print_without_head").click(function()
			  {
               var pass_no=$('#txt_pass_no').val();
                   
                    if($.trim(pass_no)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create work order for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                  else
                       {
                          window.open("reports/pdf/print/issue_note_print.php?pass_no="+pass_no+"&x=1","_blank"); 
                
						  //window.open("reports/gate_pass_without_head.php?pass_no="+pass_no,"_blank"); 
                       }
			  });				  
 <!-------------------------------------PrintWithoutHead-------------------------------------->
$("#btn_gate_pass_print_with_head").click(function()
			  {
               var pass_no=$('#txt_pass_no').val();
                   
                    if($.trim(pass_no)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create work order for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                  else
                       {
                          
						  window.open("reports/pdf/print/issue_note_print.php?pass_no="+pass_no+"&x=0","_blank"); 
                
						  //window.open("reports/gate_pass_with_head.php?pass_no="+pass_no,"_blank"); 
                       }
			  });	

$("#btn_gate_pass_export_excel").click(function()
			  {
               var pass_no=$('#txt_pass_no').val();
                   
                    if($.trim(pass_no)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create work order for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                  else
                       {
                          
						  window.open("reports/gate_pass_with_head.php?pass_no="+pass_no,"_blank"); 
                       }
			  });	

	$('#btn_create_new_gp').click(function(){
		location.reload();
	});		  

});