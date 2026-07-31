$(document).ready(function(){
                
				 var balance;
                 var tbl_gate_pass_list = $('#tbl_gate_pass_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});              
                 var list_of_gate_pass_table = $('#list_of_gate_pass').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 var list_of_cancel_gate_pass_table = $('#list_of_cancel_gate_pass').DataTable( {searching: false, paging: false, info: false,"ordering": false});
				 var tbl_inventory_list = $('#tbl_inventory_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});
				 
                 // $("#btn_gate_pass_add").show();
                 // $("#btn_gate_pass_edit").hide();
				 $('#div_gate_pass_child').hide();
                	$('#div_company_select').load('templates/company_combo.php');
			    $('#div_category_load').load('templates/inventory_category_combo.php');
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
	 $('#div_category_load').change(function(){
		 v_category_name = $('option:selected', this).val() ;
		 //alert(v_category_name);
		   load_data_to_grid_inventory_list(v_category_name);
		 
	 });
				 
				 
	function load_data_to_grid_inventory_list(v_category_name)
	 {
		 tbl_inventory_list.destroy();
		 tbl_inventory_list = $('#tbl_inventory_list').DataTable( {
				
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/gate_pass/gp_controller.php',
					 'data': {
						action: 'load_inventory_list',
						v_category_name:v_category_name
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
					 { "data": "item_name","width":'20%' , className: "text-center"},
					 { "data": "Stock" , "width":'10%',className: "text-center",
					 "render": function (data, type, rows, meta) 
						{
							return data + " (" + rows.item_unit + ")";
						}
					 },
					 { "data": "ids" ,"width":'20%', className: "text-center",
					 render: function ( data, type, rows, meta ) 
						{
							var trnsfr_amt_edit =' <textarea  id="txt_desc_'+rows["ids"]+'" name="txt_desc" style="width: 50%;">';
							return trnsfr_amt_edit;
						},
					 },
					 { "data": "ids" ,"width":'10%', className: "text-center",
						render: function ( data, type, rows, meta ) 
						{
							var trnsfr_amt_edit =' <input type="number"  id="txt_qty_'+rows["ids"]+'" name="txt_qty" value = "0.00" style="width:100px; text-align: center;">';
							return trnsfr_amt_edit;
						},
					 },
					 { "data": "ids","width":'10%', className: "text-center",
						render: function ( data, type, rows, meta ) 
						{
							str_transfer = ' <button type="button" class="btn btn-md success-gradient mr-2"  id="btn_add" name="btn_add">Add</button>';
							return str_transfer;
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
	 
	 
	  $('#tbl_inventory_list tbody').on('click', 'td button', function() {
			 
			var $row = $(this).closest('tr');
			var data = tbl_inventory_list.row($row).data();
			
			var inventory_id = data.ids;
			var inventory_name = data.item_name;
			var unit = data.item_unit;
			
			var inputId = 'txt_desc_' + inventory_id;
			var description = $('#' + inputId).val();
			
			var inputId = 'txt_qty_' + inventory_id;
			var qty = $('#' + inputId).val();
			
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
			  
			  if($.trim(company_id)=="" || $.trim(company_name)=="Select Company" || $.trim(project_id)=="0" || $.trim(vehicle_no)=="" || $.trim(driver_name)=="" || $.trim(approved_by)=="" || $.trim(checked_by)=="" || $.trim(received_by)=="" || description==""|| parseFloat(qty)==""|| qty<="0.00" || unit=="") 
			     {
				    swal("Warning","Please fill the required field", "warning");
					return false;
				 }
				 else
				 {
		            $.post("../controller/gate_pass/gp_controller.php",{action:'add_btn_action',v_company_id:company_id,v_company_name:company_name,v_gate_pass_date:gate_pass_date,v_vehicle_no:vehicle_no,v_driver_name:driver_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by,v_description:description,v_qty:qty,v_unit:unit,v_pass_no:pass_no, v_project_id:project_id, v_project_name:project_name, v_inventory_id:inventory_id, v_inventory_name:inventory_name},function(result,status)
					{
					   $('#pass_no_head').val(result);          
					   $('#txt_pass_no').val(result); 
					   $("#description").val("");		   
					   $("#qty").val("");		
					   $('#div_gate_pass_child').show();				
					   load_data_to_grid_inventory_list(v_category_name);
					   var pass_no=result.trim();		   
					   view_gate_list(pass_no);	
					   load_company_select_box('div_company_select','select_company');
				    });
				 }
			
	  });
     
<!-----------------------------------Generate_btn---------------------------------------------->
  $('#btn_generate_gate_pass').click(function(){
   
   var pass_no=$('#txt_pass_no').val();  
   $.post("../controller/gate_pass/gate_pass_controller.php",{action:'generate_gate_pass',v_pass_no:pass_no},function(result,status){
     
   swal("Success","Gate Pass generated successfully", "success");
   // view_gate_list(pass_no);
	});
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
       function view_gate_list(pass_no)
                    { 
                             tbl_gate_pass_list.destroy();
                             tbl_gate_pass_list = $('#tbl_gate_pass_list').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/gate_pass/gate_pass_controller.php',
                                         'data': {
                                            action: 'list_gate_pass',
											v_pass_no:pass_no
                                            
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
										 { "data": "inventory_name"},
                                         { "data": "description"},
                                         { "data": "quantity"},
                                         { "data": "unit"},
                                         {"data": "gate_pass_id",
                                             render: function ( data, type, rows, meta )
												    {
                        								order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_gate_pass_list" name="delete_gate_pass_list"><i class="material-icons ">delete</i></button>';
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
                
				
                 
        // $('#view_gate_list').click(function(){
           
		   // view_gate_list();	
		   	       

		// });				  
                
                
               
										           
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
								  else {
									   swal('Error',"Something Went Wrong","error");
								  }  
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
               
                   // var v_start_date_year= new Date().getFullYear();
                    //$("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
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
                        v_vehicle_no  = data.vehicle_no;
                        v_driver_name  = data.driver_name;
                        v_approved  = data.approved_by;
                        v_checked  = data.checked_by;
                        v_received  = data.received_by;
                        //v_pass_no  = data.pass_no;
                        v_description  = data.description;
                        v_qty = data.quantity;
                        v_unit  = data.unit;
                        v_child_ids  = data.gate_pass_child_id;
                        console.log(data);
                        
						if($(this).attr("name")=='view_gate_pass')
                         { 
					     closeNavR();
						  //$('#div_company_select option').map(function () {
        //                  if ($(this).text() == v_company_name) return this;
        //                  }).attr('selected', 'selected');
						 
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
						  $('#div_gate_pass_child').show();
						  $('#btn_edit_gate_pass').show();
						  $('#btn_generate_gate_pass').hide();
						  //$("#select_iventory_category").val(v_company_id);
        //                 $("#select_iventory_category").trigger("chosen:updated");
						  //$('#div_category_load').load('templates/inventory_category_combo.php');
						  
						  
						  view_gate_list(v_pass_no);
						  load_data_to_grid_inventory_list();
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
                          window.open("reports/pdf/print/gp_new.php?pass_no="+pass_no+"&x=1","_blank"); 
                
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
                          
						  window.open("reports/pdf/print/gp_new.php?pass_no="+pass_no+"&x=0","_blank"); 
                
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