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
                        { targets: [2, 4,5], visible: false } // Adjust column indices as needed
                    ]
                });
			    
			    
			  
			    
			    
			   
				
				
				var category_name,unit;
			
// <!----------------------------------CurrentDate-----------------------------------------> 
 
                var currentDate = new Date(); 
                var formattedDate = currentDate.toISOString().substr(0, 10); 
                $('#pass_in_date').val(formattedDate);
                
// <!----------------------------------CreateNewPassIn-----------------------------------------> 
 			  
				 $('#btn_create_passin').click(function(){
		         location.reload();
	             });
// <!----------------------------------CompanyLoad-----------------------------------------> 
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
                                     view_pass_in_list(v_project_id);
                          });  
                          
                       $("#div_select_issue_note_no").load("templates/issuenote_load_comb.php?project_id="+v_project_id);   
				    
				});
				$("#div_select_job_no").change(function() { 
				    var v_job_id=$('option:selected', this).text() ;
				    console.log("job id : "+v_job_id);
				    var hrefValue = "templates/workorder_view.php?val="+v_job_id; // Change this to your desired href value
                    $("#list_workorder").attr("href", hrefValue);
				    
				});
				 
// <!--------------------------------------QuantityValidation--------------------------------------> 
   $('#qty').on('keypress', function(event) {
    var keycode = event.which;
    var inputValue = String.fromCharCode(keycode);
    var pattern = /^\d*\.?\d*$/;
    var isValidInput = pattern.test(inputValue);
    
    if (!isValidInput) {
      event.preventDefault(); // Prevent input if it doesn't match the pattern
    }
  });    
                    		  
// <!---------------------------------------AddBtnAction------------------------------------------->                
             
         


 
<!-----------------------------------Generate_btn---------------------------------------------->
// **************************list of pass in view*******************************

// ************************ list of pass in view ends here*******************************************
    // $('#list_issue_no').click(function(){
    //      var selectedValues = $('#select_issue_note_no').val();
    //             if(selectedValues !== null) {
    //             // Ensure selectedValues is always treated as an array
    //             if (!Array.isArray(selectedValues)) {
    //                 selectedValues = [selectedValues];
    //             }
    //             var selectedString = selectedValues.join(', ');
    //             view_pass_in_list(selectedString);
    //             console.log(selectedString);
    //         } else {
    //                 swal("Warning","Select Issue Note No","warning");
    //         }
    // });

 $('#btn_generate_pass_in').click(function(){
     
    
     
   
  v_but_gen_pass_in.ladda('start');
         var array_table_data = tbl_pass_in_list.rows().data().toArray();
        for (var i = 0; i < array_table_data.length; i++) {
           
                var row_id = array_table_data[i].ids;
                
                var updated_return_qty = $('#txt_return_qty_'+row_id).val();
                var updated_return_remark = $('#txt_return_discription_'+row_id).val();
                var updated_damaged_qty = $('#txt_damaged_qty_'+row_id).val();
                var updated_damaged_remark = $('#txt_damage_discription_'+row_id).val();
                array_table_data[i]['return_qty'] = updated_return_qty;
                array_table_data[i]['return_remark'] = updated_return_remark;
                array_table_data[i]['damaged_qty'] = updated_damaged_qty;
                array_table_data[i]['damaged_remark'] = updated_damaged_remark;
                  console.log(array_table_data);
           
        }
      
    
                var company_id=$("#div_company_select option:selected").val();    
                  var company_name=$("#div_company_select option:selected").text();    
                  var pass_in_date=$("#pass_in_date").val();    
                  var approved_by=$("#approved_by").val();    
                  var checked_by=$("#checked_by").val();    
                  var received_by=$("#received_by").val();    
                  var description=$("#description").val();    
                  var qty=$("#qty").val();    
                  var pass_in_no=$("#txt_pass_in_no").val();  
                //   var issue_note_no = $('#select_issue_note_no').val();
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
    
                if($.trim(company_id)=="" || $.trim(company_name)=="Select Company" || $.trim(v_location)=="" || $.trim(job_no_id)=="0" || $.trim(project_id)=="0" || $.trim(approved_by)=="" || $.trim(checked_by)=="" || $.trim(received_by)=="") 
			     {
			         v_but_gen_pass_in.ladda('stop');
				    swal("Warning","Please fill the required field", "warning");
					return false;
				 }
			    else
			    {
    
                          $.post("../controller/pass_in/pass_in_controller1.php",{action:'generate_pass_in',v_dataArray:array_table_data,v_company_id:company_id,v_company_name:company_name,v_pass_in_date:pass_in_date,v_project_id:project_id, v_project_name:project_name,v_approved_by:approved_by,v_checked_by:checked_by,v_received_by:received_by, v_pass_in_no:pass_in_no, job_no_id:job_no_id, job_no:job_no, v_location:v_location, v_note:note},function(result,status){
                             
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
 
  $('#btn_edit_pass_in').click(function(){
     
    
     
   
//   v_but_gen_pass_in.ladda('start');
         var array_table_data = tbl_pass_in_list.rows().data().toArray();
        for (var i = 0; i < array_table_data.length; i++) {
           
                var row_id = array_table_data[i].ids;
                
                var updated_return_qty = $('#txt_return_qty_'+row_id).val();
                var updated_return_remark = $('#txt_return_discription_'+row_id).val();
                var return_child_id = $('#hidden_return_child_'+row_id).val();
                var updated_damaged_qty = $('#txt_damaged_qty_'+row_id).val();
                var updated_damaged_remark = $('#txt_damage_discription_'+row_id).val();
                var damaged_child_id = $('#hidden_damage_child_'+row_id).val();
                if (typeof damaged_child_id === 'undefined') {
                        damaged_child_id = 0;
                    }
                if (typeof return_child_id === 'undefined') {
                        return_child_id = 0;
                    }
                array_table_data[i]['up_return_qty'] = updated_return_qty;
                array_table_data[i]['up_return_remark'] = updated_return_remark;
                array_table_data[i]['up_damaged_qty'] = updated_damaged_qty;
                array_table_data[i]['up_damaged_remark'] = updated_damaged_remark;
                array_table_data[i]['up_return_child_id'] = return_child_id;
                array_table_data[i]['up_damaged_child_id'] = damaged_child_id;
                  console.log(array_table_data);
           
        }
        
        var v_note = $("#txt_note").val();
        var v_passin_no = $("#txt_pass_in_no").val();
        
         $.post("../controller/pass_in/pass_in_controller1.php",{action:'update_pass_in',v_dataArray:array_table_data,v_note:v_note,v_pass_in_no:v_passin_no},function(result,status){
                             
                             swal("Success","Pass in updated successfully", "success");
                            //  v_but_gen_pass_in.ladda('stop');
                            //     var startIndex = result.indexOf('{');
                            //     var endIndex = result.lastIndexOf('}');
                                
                                // Extract the JSON string using substring
                                // var jsonStr = result.substring(startIndex, endIndex + 1);
                                
                                // Parse the JSON string into an object
                                // var jsonObj = JSON.parse(jsonStr);
                                // $("#txt_pass_in_no").val(jsonObj.msg);
                                // $('#btn_generate_pass_in').hide(); 
                            
                        	});
        
  });
 
 <!----------------------------------DataTableLoad------------------------------------------------------------>
        function view_pass_in_list(v_project_id)
                    { 
                             tbl_pass_in_list.destroy();
                             tbl_pass_in_list = $('#tbl_pass_in_list').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/pass_in/pass_in_controller1.php',
                                         'data': {
                                            action: 'list_pass_in',
											v_project_id:v_project_id
                                            
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
                                      
									  
                                        { "data": "ids", "className": "text-center" },
                                        { "data": "store_category"},
                                        { "data": "store_category_id","visible":false},
                                        { "data": "inventory_name"},
                                        { "data": "inventory_id","visible":false},
                                        { "data": "item_code","visible":false},
                                        {"data": "total_quantity","className": "text-center" },
                                        {"data": "unit","className": "text-center" },
                                        {"data": "quantity",
                                             render: function ( data, type, rows, meta ){
            					                    if($.trim(rows['return_qty']) === null)
            					                    {
            					                        var return_qty=0;
            					                    }
            					                    else{
            					                        return_qty=rows['return_qty'];
            					                    }
            								                // var grade_edit ='<input type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_return_qty_'+rows["ids"]+'" name="txt_return_qty" value=0 style="width:100px;">';
                        					        var grade_edit ='<div class="input-group mb-3" style="vertical-align:middle; width:100%;padding-top:9px;"> <input type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_return_qty_'+rows["ids"]+'" name="txt_return_qty" value=0 style="width:100px;"><div class="input-group-append"><span class="input-group-text" style="font-size:12px;" id="span_return_qty_'+rows["ids"]+'">'+return_qty+'</span></div></div>';
            										       return grade_edit;
                            					},
            								},
								        {"data": "description" ,
                                                render: function ( data, type, rows, meta ){
    					        
    								                var grade_edit ='<input type="text" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_return_discription_'+rows["ids"]+'" name="txt_return_discription" style="width:100px;">';
                					       
    										       return grade_edit;
                            					},
                                            },
                                       
                                        {"data": "damage_qty",
                                             render: function ( data, type, rows, meta ){
            					                    
            					                    if($.trim(rows['damage_qty']) === null){
            					                        var damage_qty=0;
            					                    }
            					                    else{
            					                        damage_qty=rows['damage_qty'];
            					                    }
            					                    
            								                // var grade_edit ='<input type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_damaged_qty_'+rows["ids"]+'" name="txt_damaged_qty" value=0 style="width:100px;">';
                        					                var grade_edit ='<div class="input-group mb-3" style="vertical-align:middle ; width:100%;padding-top:9px;"> <input type="number" min="0" style="font-size: 12px; padding: 2px; text-align: center;" class="discount-input form-control" id="txt_damaged_qty_'+rows["ids"]+'" name="txt_damaged_qty" value=0 style="width: 100px;"><div class="input-group-append"><span class="input-group-text" style="font-size:12px;" id="span_damaged_qty_'+rows["ids"]+'">'+damage_qty+'</span></div></div>';
            										       return grade_edit;
                            					},
            							
                                        },
                                        {"data": "description" ,
                                                render: function ( data, type, rows, meta ){
    					        
    								                var grade_edit ='<input type="text" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_damage_discription_'+rows["ids"]+'" name="txt_damage_discription" style="width:100px;">';
                					       
    										       return grade_edit;
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
                
// ---------------------------------------------- Datatable load end --------------------------------------------
                 
     function view_pass_in_list_edit(passin_no,v_project_id)
                    { 
                             tbl_pass_in_list.destroy();
                             tbl_pass_in_list = $('#tbl_pass_in_list').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/pass_in/pass_in_controller1.php',
                                         'data': {
                                            action: 'list_pass_in_for_edit',
											v_pass_in_no:passin_no,
											v_project_id:v_project_id
                                            
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
                                      
									  
                                        { "data": "ids"},
                                        { "data": "store_category"},
                                        { "data": "store_category_id","visible":false},
                                        { "data": "inventory_name"},
                                        { "data": "inventory_id","visible":false},
                                        { "data": "item_code","visible":false},
                                        {"data": "total_quantity"},
                                        {"data": "unit"},
                                        {"data": "quantity",
                                             render: function ( data, type, rows, meta ){
                                                 
                                                 if (rows['current_return_qty'] !== null) {
                                                         var values = rows['current_return_qty'].split('; '); // Split the concatenated string into an array of values
                                                        // var grade_edit = '';
                                                        for (var i = 0; i < values.length; i++) {
                                                            var parts = values[i].split(','); // Split each value into parts
                                                            var ret_quantity = parts[0];
                                                            var description = parts.slice(1, -1).join(',');
                                                            var ids = parts[parts.length - 1];
                                                         
                                                        }
                                                 
            								                // var grade_edit ='<input type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_return_qty_'+rows["ids"]+'" name="txt_return_qty" value=0 style="width:100px;">';
                        					        var grade_edit ='<div class="input-group mb-3" style="vertical-align:middle; width:100%;padding-top:9px;"><input type="hidden" id="hidden_return_child_'+rows["ids"]+'" value='+ids+'><input type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_return_qty_'+rows["ids"]+'" name="txt_return_qty" value='+ret_quantity+' style="width:100px;"><div class="input-group-append"><span class="input-group-text" style="font-size:12px;" id="span_return_qty_'+rows["ids"]+'">'+rows["return_qty"]+'</span></div></div>';
                                                 }	  
                                                 else{
                                                     var grade_edit ='<div class="input-group mb-3" style="vertical-align:middle; width:100%;padding-top:9px;"><input type="hidden" id="hidden_return_child" value='+ids+'><input type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_return_qty_'+rows["ids"]+'" name="txt_return_qty" value='+ret_quantity+' style="width:100px;" disabled><div class="input-group-append"><span class="input-group-text" style="font-size:12px;" id="span_return_qty_'+rows["ids"]+'">'+rows["return_qty"]+'</span></div></div>';
                                                 }
            										       
            										       return grade_edit;
                            					},
            								},
								        {"data": "description" ,
                                                render: function ( data, type, rows, meta ){
                                                    
                                                    
                                                     if (rows['current_return_qty'] !== null) {
                                                         var values = rows['current_return_qty'].split('; '); // Split the concatenated string into an array of values
                                                        // var grade_edit = '';
                                                        for (var i = 0; i < values.length; i++) {
                                                            var parts = values[i].split(','); // Split each value into parts
                                                            // var ret_quantity = parts[0];
                                                            var description = parts.slice(1, -1).join(',');
                                                            var ids = parts[parts.length - 1];
                                                         
                                                        }
                                                
    								                    var grade_edit ='<input type="hidden" id="hidden_return_disc" value='+ids+'><input type="text" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_return_discription_'+rows["ids"]+'" name="txt_return_discription" style="width:100px;" value='+description+'>';
                                                     }
                                                     else{
                                                         var grade_edit ='<input type="text" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_return_discription_'+rows["ids"]+'" name="txt_return_discription" style="width:100px;" disabled>';
                                                     }
                					       
    										       return grade_edit;
                            					},
                                            },
                                       
                                        {"data": "damage_qty",
                                             render: function ( data, type, rows, meta ){
            					                    
            					                   if (rows['current_damage_qty'] !== null) {
                                                         var values = rows['current_damage_qty'].split('; '); // Split the concatenated string into an array of values
                                                        // var grade_edit = '';
                                                        for (var i = 0; i < values.length; i++) {
                                                            var parts = values[i].split(','); // Split each value into parts
                                                            var ret_damage = parts[0];
                                                            var description = parts[1];
                                                            var ids = parts[2];
                                                         
                                                        }
                                                 
            								                // var grade_edit ='<input type="number" min="0" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_damaged_qty_'+rows["ids"]+'" name="txt_damaged_qty" value=0 style="width:100px;">';
                        					                var grade_edit ='<div class="input-group mb-3" style="vertical-align:middle ; width:100%;padding-top:9px;"><input type="hidden" id="hidden_damage_child_'+rows["ids"]+'" value='+ids+'><input type="number" min="0" style="font-size: 12px; padding: 2px; text-align: center;" class="discount-input form-control" id="txt_damaged_qty_'+rows["ids"]+'" name="txt_damaged_qty" style="width: 100px;" value='+ret_damage+'><div class="input-group-append"><span class="input-group-text" style="font-size:12px;" id="span_damaged_qty_'+rows["ids"]+'">'+rows["damage_qty"]+'</span></div></div>';
            										       
            					                        }  
            					                        else{
            					                             var grade_edit ='<div class="input-group mb-3" style="vertical-align:middle ; width:100%;padding-top:9px;"><input type="hidden" id="hidden_damage_child" value='+ids+'><input type="number" min="0" style="font-size: 12px; padding: 2px; text-align: center;" class="discount-input form-control" id="txt_damaged_qty_'+rows["ids"]+'" name="txt_damaged_qty" style="width: 100px;" value='+ret_damage+' disabled><div class="input-group-append"><span class="input-group-text" style="font-size:12px;" id="span_damaged_qty_'+rows["ids"]+'">'+rows["damage_qty"]+'</span></div></div>';
            					                        }
            										       return grade_edit;
                            					},
            							
                                        },
                                        {"data": "description" ,
                                                render: function ( data, type, rows, meta ){
                                                    
                                                    
                                                      if (rows['current_damage_qty'] !== null) {
                                                         var values = rows['current_damage_qty'].split('; '); // Split the concatenated string into an array of values
                                                        // var grade_edit = '';
                                                        for (var i = 0; i < values.length; i++) {
                                                            var parts = values[i].split(','); // Split each value into parts
                                                            // var ret_damage = parts[0];
                                                            var description = parts[1];
                                                            var ids = parts[2];
                                                         
                                                        }
                                                
    								                    var grade_edit ='<input type="hidden" id="hidden_damage_disc" value='+ids+'><input type="text" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_damage_discription_'+rows["ids"]+'" name="txt_damage_discription" style="width:100px;" value='+description+'>';
                                                      }
                                                      else{
                                                           var grade_edit ='<input type="text" style="font-size:12px;padding:2px;text-align:center;" class="discount-input form-control" id="txt_damage_discription_'+rows["ids"]+'" name="txt_damage_discription" style="width:100px;" disabled>';
                                                      }
                                                      
    										       return grade_edit;
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
                
                
               
										           
 <!--------------------------------------DataTableBtnActions------------------------------------------->               
   $('#tbl_pass_in_list tbody').on('change', 'td input', function() {
       	    var $row = $(this).closest('tr');
            var data = tbl_pass_in_list.row($row).data();
            var v_child_id= data.ids;
            var v_issue_qty = data.total_quantity;
            var passin_return=$('#span_return_qty_'+v_child_id).text();
			var passin_damage=$('#span_damaged_qty_'+v_child_id).text();
            
            if($(this).attr("name")=='txt_return_qty')
					{
						
						var v_txt_return_qty = $('#txt_return_qty_'+v_child_id).val();
						if(v_txt_return_qty==""){
						    v_txt_return_qty=0.00;
						}
						var v_txt_damaged_qty = $('#txt_damaged_qty_'+v_child_id).val();
							if(v_txt_damaged_qty==""){
						    v_txt_damaged_qty=0.00;
						}
						var v_sum = parseFloat(v_txt_return_qty)+parseFloat(v_txt_damaged_qty)+parseFloat(passin_return)+parseFloat(passin_damage);
						if(v_sum>v_issue_qty)
						{
						    swal("Error","Check the Quantity Enterd!!","error");
								$('#txt_return_qty_'+v_child_id).val(0);
								// $('#txt_return_qty'+v_child_id).css('border-color', 'red');
						}
				// 		alert(passin_return+"---"+passin_damage+"issued qty"+v_issue_qty+"sum"+v_sum);
				// 		else{
				// 		    $('#txt_return_qty'+v_child_id).css('border-color', '');
				// 		}
						
					}
					
			if($(this).attr("name")=='txt_damaged_qty')
					{
					    var v_txt_return_qty = $('#txt_return_qty_'+v_child_id).val();
					    if(v_txt_return_qty==""){
						    v_txt_return_qty=0.00;
						}
						var v_txt_damaged_qty = $('#txt_damaged_qty_'+v_child_id).val();
							if(v_txt_damaged_qty==""){
						    v_txt_damaged_qty=0.00;
						}
						var v_sum = parseFloat(v_txt_return_qty)+parseFloat(v_txt_damaged_qty)+parseFloat(passin_return)+parseFloat(passin_damage);
						if(v_sum>v_issue_qty)
						{
						    swal("Error","Check the Quantity Enterd!!","error");
								$('#txt_damaged_qty_'+v_child_id).val(0);
								// $('#txt_damaged_qty'+v_child_id).css('border-color', 'red');
						}
				// 		else{
				// 		    $('#txt_damaged_qty'+v_child_id).css('border-color', '');
				// 		}
						
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
					$('#btn_edit_pass_in').show();
				// 	 var parts = v_pass_in_date.split("-");
    //                  var v_formattedDate = parts[2] + "-" + parts[1] + "-" + parts[0];
	                    var v_formattedDate = date_convert(v_pass_in_date);
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
				            view_pass_in_list_edit(v_pass_in_no,data.project_id);
				            // tbl_pass_in_list.clear().draw();
				        // $.post("../controller/pass_in/pass_in_controller1.php",{action:'select_child_table_details',v_master_ids:v_ids},function(result,status){
				            
				        //          if(status=="success")
            //                     {
            //                     var obj= jQuery.parseJSON(result);
            //                     console.log(obj);
            //                     // view_gate_list(category,categoryid,item,itemid,itemCode,description,qty,unit)
            //                     // view_gate_list(obj.data[0].company_id);
            //                     obj.data.forEach(function(item) {
				                
				        //         //   view_gate_list_for_edit(item.store_category, item.store_category_id, item.inventory_name, item.inventory_id, item.item_code, item.description, item.quantity, item.unit, item.ids);
                                
                                  
                                    
            //                     });
                                
            //                     }else
            //                     {
            //                         return false;
            //                     }
				            
				        // });
						  
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