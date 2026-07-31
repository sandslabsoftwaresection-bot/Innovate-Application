$(document).ready(function(){
                
				 var balance;
                 var tbl_pass_in_list = $('#tbl_pass_in_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});              
                 var list_of_pass_in = $('#list_of_pass_in').DataTable( {searching: false, paging: false, info: false,"ordering": false});
               //  var list_of_cancel_gate_pass_table = $('#list_of_cancel_gate_pass').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 $("#btn_pass_in_add").show();
                 $("#btn_pass_in_edit").hide();
            	$('#div_company_select').load('templates/company_combo.php');
			    //$('#div_item_load').load('templates/iventory_item_combo.php');
				$('#div_category_load_pass').load('templates/inventory_category_combo.php');
				
				
				var category_name,unit;
				$("#div_category_load_pass").change(function() {
                      
                    category_name = $('option:selected', this).val();
					//alert(category_name);
                    $.post("../controller/gate_pass/gate_pass_controller.php",{action:'select_inventory_details',v_inventory_category:category_name},function(result,status){
                        
                                if(status=="success")
                                {
									load_inventory_name('div_item_load', 'select_inventory_name');     
									var obj= jQuery.parseJSON(result);
									unit = obj.data[0].item_unit;
									$("#div_item_select_combo").load('../controller/inventory/inventory_controller.php',{action:'select_category_item',v_ctrl_name:'select_category',v_category:obj.data[0].item_name},function(result,status){
                            
									});
                                }
                                else
                                {
                                    return false;
                                }
                    });           
                   
                 }); 
                 
				 
				 function load_inventory_name(div_name, ctrl_name)
				{
					 $("#"+div_name).load('../controller/gate_pass/gate_pass_controller.php',{action:'select_category_item_name',v_ctrl_name:ctrl_name, pn_company_id:category_name},function(result,status){});
				}
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
                  var inventory_id = $('#select_inventory_name option:selected').val();
				  var inventory_name = $('#select_inventory_name option:selected').text();
				  
				  
				  //alert(project_id+' '+project_name+' '+inventory_id+' '+inventory_name+unit);
			  if(company_id=="" || project_id=="0" ||  approved_by=="" || checked_by=="" || received_by==""|| inventory_id=="0" || description==""|| qty==""|| unit=="") 
			     {
				    swal("Warning","Please fill the required field", "warning");
				 }
				 else
				 {
					 
		   
		            $.post("../controller/pass_in/pass_in_controller1.php",{action:'add_btn_action',v_company_id:company_id,v_company_name:company_name,v_pass_in_date:pass_in_date,v_project_id:project_id, v_project_name:project_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by,v_description:description,v_qty:qty,v_unit:unit, v_inventory_id:inventory_id, v_inventory_name:inventory_name,v_pass_in_no:pass_in_no},function(result,status)
					{ 
					
					   $('#pass_in_no_head').val(result);          
					   $('#txt_pass_in_no').val(result); 
					   $("#description").val("");		   
					   $("#qty").val("");		   
					   // $('#div_unit_select_combo select').val('');
					   // $('#div_item_load select').val('');
					   //$('#div_item_load').load('templates/iventory_item_combo.php');
					   $('#div_category_load_pass').load('templates/inventory_category_combo.php');
					   load_unit_select_box('div_unit_select_combo','select_unit');
					   //load_company_select_box('div_company_select','select_company');
					   load_inventory_name('div_item_load', 'select_inventory_name');     
					   var pass_in_no=result.trim();		   
					  
 					   view_pass_in_list(pass_in_no);   
				    });
				 }
                    
});   
<!-----------------------------------Generate_btn---------------------------------------------->
 $('#btn_generate_pass_in').click(function(){
   
   var pass_in_no=$('#txt_pass_in_no').val(); 
   $.post("../controller/pass_in/pass_in_controller1.php",{action:'generate_pass_in',v_pass_in_no:pass_in_no},function(result,status){
     
   swal("Success","Gate Pass in generated successfully", "success");
    
	});
	
	
 });
 
 <!----------------------------------DataTableLoad------------------------------------------------------------>
        function view_pass_in_list(pass_in_no)
                    { 
                             tbl_pass_in_list.destroy();
                             tbl_pass_in_list = $('#tbl_pass_in_list').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/pass_in/pass_in_controller1.php',
                                         'data': {
                                            action: 'list_pass_in',
											v_pass_in_no:pass_in_no
                                            
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
                                         { "data": "inventory"},
                                         { "data": "description"},
                                         { "data": "quantity"},
                                         { "data": "unit"},
                                         //{ "data": "driver_name"},
                                         // {"data": "quantity"},
                                         // {"data": "unit"},
                                       //  {"data": "gate_pass_date"},
            					 
                                  // {"data": "pass_in_id",
                                                  // render: function ( data, type, rows, meta ) {
                        						
                        									// order_action = '<button type="button" class="btn btn-sm primary-gradient mr-2"  id="edit_pass_in" name="edit_pass_in" ><i class="material-icons ">edit</i></button><button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_pass_in" name="delete_pass_in"><i class="material-icons ">delete</i></button>';
            								                // return order_action;
                                                            
														 // },
                        						
            					         // }
                     
                                  {"data": "pass_in_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_pass_in" name="delete_pass_in"><i class="material-icons ">delete</i></button>';
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
                    //$("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
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
                        
                         
						if($(this).attr("name")=='view_pass_in')
                         { 
					 
					
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
						  $.post("../controller/pass_in/pass_in_controller1.php",{action:'select_address',v_company_id:v_company_id},function(result,status){
                          var obj= jQuery.parseJSON(result);
					      var v_address=obj.data[0].address;		
					      $("#address").val(v_address); 	
				            });
						  view_pass_in_list(v_pass_in_no);
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
										 $.post("../controller/pass_in/pass_in_controller1.php",{action:"delete_pass_in",v_pass_in_no:v_pass_in_no,v_ids:v_ids},function(result,status){
											 
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
						   window.open("reports/pdf/print/passin_new.php?pass_in_no="+pass_in_no+"&x=1","_blank"); 
                
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
                          window.open("reports/pdf/print/passin_new.php?pass_in_no="+pass_in_no+"&x=0","_blank"); 
                
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