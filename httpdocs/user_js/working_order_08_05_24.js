$(document).ready(function(){
                
				 var balance;
                 var tbl_work_order_list = $('#tbl_work_order_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});              
                 var work_order_view_list_table = $('#list_of_work_order').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 var work_order_cancel_view_list_table = $('#list_of_cancel_work_order').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 var work_order_quotation_list_table = $('#list_of_work_order_quotation').DataTable({searching: false, paging: false, info: false,"ordering": false});
                 $('#span_work_order').hide();

			   // load_work_order_data();
 <!----------------------------------CompanyLoad----------------------------------------->               
                $('#div_company_select').load('templates/company_combo.php');
				
				
                 // load_company_select_box('div_company_select','select_company','quotation_main_tbl');
                 
                 
                 
                   // function load_company_select_box(div_name,ctrl_name,tbl_name)
                    // {
                        // $("#"+div_name).load('../controller/working_order/working_order_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name,v_tbl_name:tbl_name},function(result,status){});
                    // }
                   
                   
                   
                   
                   $("#div_company_select").change(function() {
                     
                    $('#txt_company_name').val($('option:selected', this).text()) ;
                    $("#txt_company_id").val($('option:selected', this).val());
                    var company_id=$('option:selected', this).val() ;
                    
                    $.post("../controller/quotation/quotation_controller.php",{action:'select_company_details',v_company_id:company_id},function(result,status){
                        
                                if(status=="success")
                                {
                                    
                                var obj= jQuery.parseJSON(result);
                                $("#txt_company_id").val(obj.data[0].company_id);
                                $("#txt_company_name").val(obj.data[0].company_name);
                                $("#txt_po_box").val(obj.data[0].city);
                                $("#txt_contact_no").val(obj.data[0].contact_phone);
                                $("#txt_fax").val(obj.data[0].fax);
                                $("#txt_attn").val(obj.data[0].contact_person);
                                
                                $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                            
                               });
                                
                                var delivery_company_id=$("#txt_company_id").val();
                               
                                }
                                else
                                {
                                    return false;
                                }
                    });           
                   
                 }); 
<!------------------------------------QuotationNoLoad----------------------------------------------------->               
                   
                 
                $("#div_project_select_combo").change(function(){
                    var project_id = ($('option:selected', this).val()); 
					
                     $('#txt_working').val($('option:selected', this).text()) ;
                     $("#txt_working_project_id").val($('option:selected', this).val());
                  
                   $("#div_select_quotation_combo").load('../controller/working_order/working_order_controller.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:project_id},function(result,status){
                            
                    });  
                     
                 });           
              
<!------------------------------------GenerateWorkingOrder--------------------------------->                
              
                  
          $('#btn_generate_working_order').click(function(){
                  var company_id=$("#div_company_select option:selected").val();    
                  var company_name=$("#div_company_select option:selected").text();    
                  var project_id=$("#div_project_select_combo option:selected").val();    
                  var project_name=$("#div_project_select_combo option:selected").text();    
                  var quotation_id=$("#div_select_quotation_combo option:selected").val();    
                  var quotation_no=$("#div_select_quotation_combo option:selected").text();    
                  var location_txt=$("#txt_location").val();
                  var received=$("#txt_received").val();
                  var working_date=$("#txt_working_date").val();
				  var working_end_date=$("#txt_working_end_date").val();
				//   alert(working_end_date);
				if(company_id=="" || project_id=="" || quotation_id=="" || working_date=="" || working_end_date=="" || location_txt=="" || received=="") {
				swal("Warning","Please fill the required field", "warning");
            	 
				 }
				 else
				 {
           
		   $.post("../controller/working_order/working_order_controller.php",{action:'generate_working_order',v_company_id:company_id,v_company_name:company_name,v_project_id:project_id,v_project_name:project_name,v_quotation_id:quotation_id,v_quotation_no:quotation_no,v_location_txt:location_txt,v_received:received,v_working_date:working_date,v_working_end_date:working_end_date},function(result,status){
           $('#txt_work_order_no').val(result);          

		   swal("Success","Working Order generated successfully", "success");
            
           $('#btn_generate_working_order').prop('disabled', true);
          
		   load_work_order_data(result);	
		   		   
		
				});
                 }       
});   
 <!----------------------------------DataTableLoad------------------------------------------------------------>
 
			
              
		    function load_work_order_data(quotation_no)
                    {
                             tbl_work_order_list.destroy();
                                 
                             tbl_work_order_list = $('#tbl_work_order_list').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/working_order/working_order_controller.php',
                                         'data': {
                                            action: 'list_work_order',
                                            v_quotation_no:quotation_no
                                            
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
                                      
									  
                                         { "data": "work_order_child_id",className: "text-center"},
                                         { "data": "quotation_no"},
                                         
                                         //{ "data": "description"},
										 
										 {
											"data": null,
											"render": function(data, type, row) {
												return '<strong>' + row.product_name + '</strong><br>' + row.description;
											}
										},
										 
										 
                                         { "data": "quantity",className: "text-center"},
                                         { "data": "required_quantity",className: "text-center"},
                                         { "data": "received_quantity",className: "text-center"},
                                         { "data": "balance_quantity",className: "text-center"},
                                         {"data": "unit",className: "text-center"},
                                         {"data": "work_order_date",className: "text-center"},
                                         {"data": "quotation_status",className: "text-center"},
            					 
                                          {"data": "work_order_child_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = ' <button type="button" class="btn btn-sm" style="background-color: #10911a;color: #fff;margin-left: -6px;margin-right:2px;" id="change_status" name="change_status" ><i class="material-icons">assignment_turned_in</i></button><button type="button" class="btn btn-sm primary-gradient mr-2"  id="edit_work_order" name="edit_work_order" ><i class="material-icons ">edit</i></button><button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_work_order" name="delete_work_order"><i class="material-icons ">delete</i></button>';
            								                return order_action;
                                                            
															
            
						
                        							 },
                        							 
                        					 
            					         }
                     
                                     ],
                                     pageLength: 25,
                    				 searching: false,
                                     responsive: true,
                    				
                                    
                                    
                                     "initComplete": function( settings, json ) {
                                      
                                                              
                     
                                      },
                                     /*  "fnDrawCallback": function() {
									  }, */
                                      "fnRowCallback": function(nRow,aData,iDisplayIndex) {
									
                                       $("td:first",nRow).html(iDisplayIndex+1);
									   return nRow;

									},
                     
                                     })
										 
                                 
                             }
                
                 
                
                
                
               
										           
 <!--------------------------------------ActionBtn------------------------------------------->               
                          
   $('#tbl_work_order_list tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = tbl_work_order_list.row($row).data();
                        v_ids  = data.work_order_child_id;
                        v_work_order_main_id  = data.work_order_main_id;
                        v_work_order_number  = data.work_order_number;
                        v_qty  = data.quantity;
                        v_required_quantity  = data.required_quantity;
                        v_received_quantity  = data.received_quantity;
                       
                        v_balance_quantity   = data.balance_quantity;
                        v_quotation_no  = data.quotation_no;
						v_description = data.description;
						
                         if($(this).attr("name")=='change_status')
                         { 
					 
					     $('#modal_status_change').modal('show'); 
                            
						 }
                             if($(this).attr("name")=='edit_work_order')
                         { 
                             $('#modal_quantity_change').modal('show'); 
                             $("#txt_work_order_number").val(v_ids);
                             $("#txt_quantity").val(v_qty);
                             $("#txt_required_qty").val(v_required_quantity);
                             $("#txt_received_qty").val(v_received_quantity);
                             
                             $("#txt_qty").val(v_qty);
                             $("#hid_quotation_no").val(v_quotation_no);
                             $("#txt_balance").val(v_balance_quantity);
							 $("#txt_description").val(v_description);
							//alert(v_received_quantity); v_description
							
                         }
						 
						  if($(this).attr("name")=='delete_work_order')
                         { 
					 	 swal({
								  title: "Do you want to delete the item?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {
										 $.post("../controller/working_order/working_order_controller.php",{action:"delete_work_orders",v_work_order_main_id:v_work_order_main_id,v_ids:v_ids},function(result,status){
											 
											    if(status=='success')
												{
											     swal("Success","deleted successfully...","success");
												load_work_order_data(v_quotation_no);		
	  
												}
												else
												{
												  swal('Error',"Something Went Wrong","error");	
												}
												
												
											});
								  } 
								  else {
									   // swal('Error',"Something Went Wrong","error");
								  }  
							});
						 }

   });						 
<!----------------------------------ChangeQuotationStatus------------------------------------>

$("#btn_change_status").click(function()
{
	var quotation_status=$("#quotation_status").val();
	var work_order_no = $("#txt_work_order_no").val();
	      $.post("../controller/working_order/working_order_controller.php",{action:'change_quotation_status',v_ids:v_ids,v_quotation_status:quotation_status,v_quotation_no:v_quotation_no},function(result,status){
           //$('#txt_work_order_no').val(result);          
		
		  swal("Success","Quotation status changed successfully", "success");
		  $('#modal_status_change').modal('hide');
          load_work_order_data(work_order_no); 
		  
});
});
<!----------------------------------------BalanceCalc---------------------------------------->
$("#txt_required_qty").change(function() {

                             var v_required_quantity=$("#txt_required_qty").val();         
                             var v_qty=$("#txt_qty").val(); 
							 var balance_qty= $("#txt_balance").val();
							 var received_qty=$("#txt_received_qty").val();     
		
		                         balance = parseInt(v_qty)-(parseInt(received_qty)+parseInt(v_required_quantity));  
					
				  
				   
				  if(parseInt(balance)<0)
				  {
				      	 swal(
        					  "Warning",
        					  "Delivered quantity should not be greater than total quantity... ",
        					  "warning"
        					);
				      $("#txt_required_qty").val(v_required_quantity);
				      return false;
				  }
		
		
    						  
                             $("#txt_balance").val(parseFloat(balance));
});	

  
  
<!----------------------------------ChangeQty------------------------------------------------->
  $("#btn_save").click(function()
  {
           var received_qty=$("#txt_received_qty").val();         
           var required_qty=$("#txt_required_qty").val();         
           var balance_qty=$("#txt_balance").val();
           
           var qty=$("#txt_qty").val();         
           var remarks=$("#txt_remarks").val(); 
          // var hid_required=$("#hid_required").val();		   
		   var quotation_no=$("#hid_quotation_no").val();
		 
	     var work_order_no=$("#txt_work_order_no").val();
		 var description =$('#txt_description').val();
		 //var received_qtys=parseFloat(required_qty)+parseFloat(received_qty); 
                             	   
		   $.post("../controller/working_order/working_order_controller.php",{action:'change_qty',v_ids:v_ids,v_qty:qty,v_received_qty:received_qty,v_required_qty:required_qty,v_balance_qty:balance_qty,v_remarks:remarks,v_quotation_no:quotation_no,description:description},function(result,status){
           
		   $('#modal_quantity_change').modal();
		   $('#modal_quantity_change').modal('hide');
		   swal("Success","Updated successfully", "success");
     
	      $("#txt_received_qty").val(""); 
	      $("#txt_required_qty").val(""); 
	      $("#txt_balance").val(""); 
	      $("#txt_qty").val(""); 
	      $("#remarks").val(""); 
          load_work_order_data(work_order_no);		
		
				});
				
				
				
				
  });	

   $('#btn_create_WorkingOrder').click(function(){
	  location.reload(); 
   });  
          
                 
             
             
                     
         
     
                  $('#view_work_order_list').click(function(){
             
                    var v_start_date_year= new Date().getFullYear();
                    $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                    load_data_to_grid_view_list_of_work_order(); 
                     
                 });    
                        
            
			function load_data_to_grid_view_list_of_work_order()
			{
				 work_order_view_list_table.destroy();
                                 
                             work_order_view_list_table = $('#list_of_work_order').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/working_order/working_order_controller.php',
                                         'data': {
                                            action: 'list_work_order_view'
                                            
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
                                      
                                    { "data": "work_order_main_id"},
									{ "data": "work_order_number"},
                                    { "data": "quotation_reference"},
                                    { "data": "location"},
            					    { "data": "work_order_date"},
                                   
										 {"data": "work_order_main_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="view_work_order" name="view_work_order" ><i class="material-icons ">remove_red_eye</i></button>';
            								                return order_action;
                                                         },
                        						  },
										 {"data": "work_order_main_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_work_order" name="delete_work_order" ><i class="material-icons ">delete</i></button>';
            								                return order_action;
                                                            
														
                        							 },
                        							 
                        					 
                                                 
            					 
            					         }
                     
                                     ],
                                     pageLength: 50,
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
                
              
 <!---------------------------------------Work_order_view----------------------------------------------->
 
$('#list_of_work_order tbody').on('click', 'td button', function (){
	
	                    var $row = $(this).closest('tr');
                        var data = work_order_view_list_table.row($row).data();
                        v_work_order_id  = data.work_order_main_id;
                        v_company_id = data.company_id;
                        v_company_name = data.company_name;
                        v_po_box  = data.po_box;
                        v_work_order_number=data.work_order_number;
                        v_quotation_no=data.quotation_reference;
                        v_telephone_no=data.telephone_no;
                        v_fax=data.fax;
                        v_attn=data.attn;
                        v_work_order_date=data.work_order_date;
						v_work_order_end_date=data.work_order_end_date;
                        v_work_order_number=data.work_order_number;
                        v_project_id=data.project_id;
                        v_received=data.received;
                        v_location=data.location;
                       var dateParts = v_work_order_date.split('-');
                       var woDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                
					   //var datePartss = v_work_order_end_date.split('-');
                       //var woDates = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];

                       if($(this).attr("name")=='view_work_order')
                         {
						 closeNavR();
 						 //$('#mySidenavR').modal().hide();	 
                         // $('#div_company_select option').map(function () {
                         // if ($(this).text() == v_company_name) return this;
                         // }).attr('selected', 'selected');
						 $("#select_company").val(data.company_id);
                        $("#select_company").trigger("chosen:updated");
                          $("#txt_po_box").val(v_po_box);     
                          $("#txt_contact_no").val(data.telephone_no);
                          $("#txt_fax").val(data.fax);
                          $("#txt_attn").val(data.attn);
                          $("#txt_working_date").val(woDate);
						  $("#txt_working_end_date").val(v_work_order_end_date);
                          $("#txt_work_order_no").val(v_work_order_number);
                          
					   
					       $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:v_company_id},function(result,status){
                            if(status=="success")
                                   {
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).val() ==v_project_id) return this;
                                        }).attr('selected', 'selected');
                                   }
                               });
                         
						  $("#div_select_quotation_combo").load('../controller/working_order/working_order_controller.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:v_project_id},function(result,status){
                          if(status=="success")
                                   {
                                       $('#div_select_quotation_combo option').map(function () {
                                        if ($(this).text() ==v_quotation_no) return this;
                                        }).attr('selected', 'selected');
                                   }  
                          });  
						  
						   $("#txt_location").val(v_location);
                           $("#txt_received").val(v_received);
						  // alert(v_quotation_no);
                           load_work_order_data(v_work_order_number);
                            $("#btn_generate_working_order").hide();
                            $("#btn_edit_working_order").show();
                         
						 }
						 
						 
						 
						 if($(this).attr("name")=='status_work_order')
						 {
						 closeNavR();	 
						 load_work_order_data(v_work_order_number);	 
							 
							 
						 }
						 
						 
						 
						 
						  if($(this).attr("name")=='delete_work_order')
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
                                        						        //alert(v_delivery_note_number);
                                        						       delete_work_order(v_work_order_id);
                                                     				   load_data_to_grid_view_list_of_work_order();
                                                     				    
                                        							} else {
                                        							    
                                        							    swal('Error',"Something Went Wrong","error");	
                                        							 
                                        							}
                                        						 });
																 
		 function delete_work_order(v_work_order_id)
            {
            
            $.post("../controller/working_order/working_order_controller.php",{action:'cancel_work_orders_list',v_work_order_main_id:v_work_order_id}, function(result,status)
                                                {
                     swal("Success","deleted successfully...","success");
					 load_data_to_grid_view_list_of_work_order();							                               
                                                    
                         });
            }
					 
						 }
              });
			  
			  
			  $("#btn_search_date").click(function()
			  {
				
                  var txt_start_date=$('#txt_start_date').val();				 
                  var txt_end_date=$('#txt_end_date').val();				 
				
				 
				  // $.post("../controller/working_order/working_order_controller.php",{action:'search_with_date',txt_start_date:txt_start_date,txt_end_date:txt_end_date}, function(result,status)
                                                // {
                    //swal("Success","deleted successfully...","success");
												                               
                                                    
                         // });
						 
			   load_data_to_grid_view_list_of_work_order_with_date(txt_start_date,txt_end_date); 
  
  
			  });
            
			function load_data_to_grid_view_list_of_work_order_with_date(txt_start_date,txt_end_date)
			{
             work_order_view_list_table.destroy();
                                 
                             work_order_view_list_table = $('#list_of_work_order').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/working_order/working_order_controller.php',
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
                                      
                                    { "data": "work_order_main_id"},
									{ "data": "work_order_number"},
                                    { "data": "quotation_reference"},
                                    { "data": "location"},
            					    { "data": "work_order_date"},
                                    {"data": "work_order_main_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="view_work_order" name="view_work_order" ><i class="material-icons ">remove_red_eye</i></button>';
            								                return order_action;
                                                            
															
            
						
                        							 },
                        							 
                        					 
                                                 
            					 
            					         },
										 {"data": "work_order_main_id",
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_work_order" name="delete_work_order" ><i class="material-icons ">delete</i></button>';
            								                return order_action;
                                                            
															
            
						
                        							 },
                        							 
                        					 
                                                 
            					 
            					         }
                     
                                     ],
                                     pageLength: 50,
                    				 searching: false,
                                     responsive: true,
                    				
                                    
                                    
                                     "initComplete": function( settings, json ) {
                                      
                                                              
                     
                                      },
                                     /*  "fnDrawCallback": function() {
									  }, */
                                      "fnRowCallback": function(nRow,aData,iDisplayIndex) {
									
                                       $("td:first",nRow).html(iDisplayIndex+1);
									   return nRow;

									},
                     
                                     })
			}

<!-----------------------------------WorkOrderCancelledList------------------------------------>			
              // $('#btn_cancel_search_date').click(function(){
                     // var v_from_date = formatDate($("#txt_cancel_start_date").val());
                     // var v_to_date = formatDate($("#txt_cancel_end_date").val());
                     // load_data_to_grid_view_cancel_work_order_list_between(v_from_date,v_delivery_note_to_date);
                   
                  // });    
				   $('#btn_view_list_of_cancelled_work_order').click(function(){
                    
                    var v_start_date_year= new Date().getFullYear();
                    $("#txt_cancel_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                    load_data_to_grid_view_cancel_work_order_list(); 
                     
                 }); 
				   function load_data_to_grid_view_cancel_work_order_list()
                    {
                             work_order_cancel_view_list_table.destroy();
                                 
                             work_order_cancel_view_list_table = $('#list_of_cancel_work_order').DataTable( {
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/working_order/working_order_controller.php',
                                         'data': {
                                            action: 'list_work_order_cancel_view'
                                           
                                            
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
                                      
                                         { "data": "work_order_main_id","visible":false },
                                         { "data": "work_order_number"},
                                         { "data": "quotation_reference"},
                                         { "data": "location"},
                                         { "data": "work_order_start_date"},
                                         {"data": "work_order_main_id" ,
            					 
                                 
                                                  render: function ( data, type, rows, meta ) {
                        						
                        									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancel_work_order" name="view_cancel_work_order" ><i class="material-icons ">remove_red_eye</i></button>';
                        								
                        								return str_active_status_view;
                        
                        							 },
                        							 
                        					
            
            					 
            					         }
                     
                                     ],
                                     pageLength: 50,
                    				 searching: false,
                                     responsive: true,
                    				
                                    
                                    
                                     "initComplete": function( settings, json ) {
                                      
                                                              
                     
                                      },
                                      "fnDrawCallback": function() {
                                       
                     
                                     }
                                
                                 
                             });  
                
                 }
                
                  $('#list_of_cancel_work_order tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = work_order_cancel_view_list_table.row($row).data();
                  
						 
						
						v_work_order_id  = data.work_order_main_id;
                        v_company_id = data.company_id;
                        v_company_name = data.company_name;
                        v_po_box  = data.po_box;
                        v_work_order_number=data.work_order_number;
                        quotation_no=data.quotation_reference;
                        v_telephone_no=data.telephone_no;
                        v_fax=data.fax;
                        v_attn=data.attn;
                        v_work_order_date=data.work_order_start_date;
						v_work_order_end_date=data.work_order_end_date;
                        v_work_order_number=data.work_order_number;
                        v_project_id=data.project_id;
                        v_received=data.received;
                        v_location=data.location;
                       var dateParts = v_work_order_date.split('-');
                       var woDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                

                      
					  if($(this).attr("name")=='view_cancel_work_order')
                         { //alert(quotation_no);
					     closeNavRCancel();
					    
 						 //$('#mySidenavR').modal().hide();	 
                         $('#div_company_select option').map(function () {
                         if ($(this).text() == v_company_name) return this;
                         }).attr('selected', 'selected');
                          $("#txt_po_box").val(v_po_box);     
                          $("#txt_contact_no").val(data.telephone_no);
                          $("#txt_fax").val(data.fax);
                          $("#txt_attn").val(data.attn);
                          $("#txt_working_date").val(woDate);
						  $("#txt_working_end_date").val(v_work_order_end_date);
                          $("#txt_work_order_no").val(v_work_order_number);
                       
					   
					       $("#div_project_select_combo").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:v_company_id},function(result,status){
                            if(status=="success")
                                   {
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).val() ==v_project_id) return this;
                                        }).attr('selected', 'selected');
                                   }
                               });
                        
						
						
						  $("#div_select_quotation_combo").load('../controller/working_order/working_order_controller.php',{action:'select_quotation_list',v_ctrl_name:'select_quotation',v_project_id:v_project_id},function(result,status){
                          
						  if(status=="success")
                                   {
                                       $('#div_select_quotation_combo option').map(function () {
                                        if ($(this).text() ==quotation_no) return this;
                                        }).attr('selected', 'selected');
                                   }  
                          });  
						  
						   $("#txt_location").val(v_location);
                           $("#txt_received").val(v_received);
						   load_work_order_data(quotation_no);
						
                          	
						 }
               });         
    
                $('#btn_cancel_search_date').click(function(){   
			
                     var v_from_date = $("#txt_cancel_start_date").val();
                     var v_to_date = $("#txt_cancel_end_date").val();
                     load_data_view_cancel_work_order_list_between(v_from_date,v_to_date);
                 
                  });
                  
                  
                  
                  function load_data_view_cancel_work_order_list_between(v_from_date,v_to_date)
                 {
                      work_order_cancel_view_list_table.destroy();
                         
                      work_order_cancel_view_list_table = $('#list_of_cancel_work_order').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                  'url': '../controller/working_order/working_order_controller.php',
                                  'data': {
                                    action: 'list_work_order_cancel_view_between',
                                    txt_start_date:v_from_date,
                                    txt_end_date:v_to_date
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
                              
                                 { "data": "work_order_main_id","visible":false },
                                 { "data": "work_order_number"},
                                 { "data": "quotation_reference"},
                                   { "data": "location"},
                                 { "data": "work_order_start_date"},
                                 { "data": "work_order_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancel_delivery_note" name="view_cancel_delivery_note" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         }
             
                             ],
                             pageLength: 50,
            				 searching: false,
                             responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                               
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 
                 }	
<!----------------------------------PrintWithoutHead------------------------------------------->
	
                 $('#btn_work_order_print_without_head').click(function(){
                    var work_order_no=$('#txt_work_order_no').val();
                   
                    if($.trim(work_order_no)=="")
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
                          //window.open("reports/work_order_print_without_head.php?work_order_no="+work_order_no,"_blank"); 
						  window.open("reports/pdf/print/work_ordernew.php?work_order_no="+work_order_no+"&x=1","_blank"); 
                       
                       }
                    
                    
                });
                      
<!-----------------------------------PrintWithHead-------------------------------------------->

       $('#btn_work_order_print_with_head').click(function(){
                    var work_order_no=$('#txt_work_order_no').val();
                   
                    if($.trim(work_order_no)=="")
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
                          //window.open("reports/work_order_print_with_head.php?work_order_no="+work_order_no,"_blank"); 
						  window.open("reports/pdf/print/work_ordernew.php?work_order_no="+work_order_no+"&x=0","_blank"); 
                       
                       }
                    
                    
                });
				
				$('#btn_work_order_export_excel').click(function(){
                    var work_order_no=$('#txt_work_order_no').val();
                   
                    if($.trim(work_order_no)=="")
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
                          //window.open("reports/work_order_print_with_head.php?work_order_no="+work_order_no,"_blank"); 
						  window.open("reports/work_order_print_with_head.php?work_order_no="+work_order_no+"&x=0","_blank"); 
                       
                       }
                    
                    
                });
                
 <!-----------------------------------Edit Work Order-------------------------------------------->               
                
                   
                $("#btn_edit_working_order").click(function(){
                     var company_id=$("#div_company_select option:selected").val();    
                  var company_name=$("#div_company_select option:selected").text();    
                  var project_id=$("#div_project_select_combo option:selected").val();    
                  var project_name=$("#div_project_select_combo option:selected").text();    
                  var quotation_id=$("#div_select_quotation_combo option:selected").val();    
                  var quotation_no=$("#div_select_quotation_combo option:selected").text();    
                  var location_txt=$("#txt_location").val();
                  var received=$("#txt_received").val();
                  var working_date=$("#txt_working_date").val();
				  var working_end_date=$("#txt_working_end_date").val();
                  var work_order_no = $("#txt_work_order_no").val();
				if(company_id=="" || project_id=="" || quotation_id=="" || working_date=="" || working_end_date=="" || location_txt=="" || received=="") {
				swal("Warning","Please fill the required field", "warning");
            	 
				 }
				 else
				 {
           
            		   $.post("../controller/working_order/working_order_controller.php",{action:'update_working_order',v_company_id:company_id,v_company_name:company_name,v_project_id:project_id,v_project_name:project_name,v_quotation_id:quotation_id,v_quotation_no:quotation_no,v_location_txt:location_txt,v_received:received,v_working_date:working_date,v_working_end_date:working_end_date,work_order_no:work_order_no},function(result,status){
                               $('#txt_work_order_no').val(result);          
                    		  
                    		   swal("Success","Working order updated successfully", "success");
                                
                               $('#btn_generate_working_order').prop('disabled', true);
                        	   load_work_order_data(work_order_no);
            		    });
                 }      
                    
                });

<!-----------------------------------Report Work Order based on Quotation-------------------------------------------->  

        $("#view_work_order_quotaion_list").click(function(){
           load_company_select_box('div_work_order_company_select','select_work_order_company','work_order_tbl'); 
        })
        
         $("#div_work_order_company_select").change(function() {
                      
                   
                    var v_company_id = $('option:selected', this).val() ;
                    $("#div_work_order_project_select").load('../controller/working_order/working_order_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:v_company_id},function(result,status){
                            
                    });
         }); 
         
         $("#div_work_order_project_select").change(function() {
                      
                    
                    var v_project_id = $('option:selected', this).val() ;
                    $("#div_work_order_quotation_select").load('../controller/working_order/working_order_controller.php',{action:'select_project_quotation',v_ctrl_name:'select_quotation',v_project_id:v_project_id},function(result,status){
                            
                    });
         }); 
        $("#btn_search_workorder").click(function(){
            var v_quotaion_no =  $("#div_work_order_quotation_select option:selected").val();
            //alert(v_quotaion_no);
            load_work_order_details(v_quotaion_no);   
        });
        
        function load_work_order_details(v_quotaion_no)
			{
				 work_order_quotation_list_table.destroy();
                                 
                             work_order_quotation_list_table = $('#list_of_work_order_quotation').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/working_order/working_order_controller.php',
                                         'data': {
                                            action: 'list_work_order_quotation',
                                            v_quotation_no:v_quotaion_no
                                         }
                                     },
                                     "language": {
                                         "zeroRecords": "No records available",
                                         "infoEmpty": "No records available",
                                      },
                                    "order": [[ 0, "asc" ]],
                    				"bPaginate": false,
                    				"bLengthChange": false,
                    				"bFilter": false,
                    				"bInfo": false,
                    				"autoWidth": false,
                                    "columns": [
                                      
                                    { "data": "work_order_child_id"},
									{ "data": "work_order_no"},
                                    { "data": "description"},
            					    { "data": "quantity"},
                                    { "data": "unit"},
									{ "data": "required_quantity"},
                                    { "data": "received_quantity"},
            					    { "data": "balance_quantity"},
            					    { "data": "quotation_status"},
									
            					       
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
                
        

	});