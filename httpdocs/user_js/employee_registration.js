$(document).ready(function(){
    
    v_btn_add_division = $("#btn_division_save").ladda();
    v_btn_department_save = $("#btn_department_save").ladda();
    v_btn_employee_register = $("#btn_employee_register").ladda();
    v_btn_edit_employee = $("#btn_edit_employee").ladda();
    var tbl_list_of_employees = $('#list_of_employees').DataTable( {searching: false, paging: false, info: false,"ordering": false});
    // $('#tbl_inventory_list').removeClass( 'display' ).addClass('table table-striped table-bordered');                
     $('#btn_create_registration').click(function(){
         location.reload();
     });
    
    $("#btn_update_rejoining_date").hide();
    
    $('#div_division_select').load('templates/division_load_combo.php');
    
    $('#div_department_select').load('templates/department_load_combo.php');
    $('#div_employee_select').load('templates/employee_names_load_combo.php');
   
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
    
    // **********************load ot rates**************************************
    load_otrates_input();
    function load_otrates_input(){
        $.post("../controller/employee/employee_registration_controller.php",
            			{action:'select_ot_rates'}, 
            			function(result,status)
            			{   
            			    var decodedData = jQuery.parseJSON(result);
            			    var normalOTAmt = decodedData.data[0].normal_ot_amt;
            			    var specialOTAmt = decodedData.data[0].special_ot_amt;
            			    var gosi_pr = decodedData.data[0].gosi_pr;
            			    var travel_allo_rate = decodedData.data[0].travel_allo_rate;
            			    var indemnity_rate = decodedData.data[0].indemnity_rate;
            			    $("#txt_normal_ot_amt").val(normalOTAmt);
            			    $("#txt_special_ot_amt").val(specialOTAmt);
            			    $("#txt_gosi_pr").val(gosi_pr);
            			    $("#txt_travel_allo").val(travel_allo_rate);
            			    $("#txt_indemnity").val(indemnity_rate);
            			    
            			});
    }
    
    // ****************************end******************************************
    
    // ****************************update special ot for all*********************
    
    $('#btn_add_specialot_all').click(function(){
        
        var v_specialot= $("#txt_special_ot_amt").val();
        swal({
								  title: "Do you want to update all?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {  
                                             $.post("../controller/employee/employee_registration_controller.php",
                                                			{action:'update_special_for_all',v_special_ot:v_specialot}, 
                                                			function(result,status)
                                                			{  
                                                			    swal('Success',"Special OT Rate Updated Successfully","success");
                                                			});
                                                			
								        }
								});
								  
                                            
    });
    
    // *********************************end*************************************
    
    
    // ****************************update_normal ot for all*********************
    
    $('#btn_add_normalot_all').click(function(){
        
        var v_normalot= $("#txt_normal_ot_amt").val();
        swal({
								  title: "Do you want to update all?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {  
                                             $.post("../controller/employee/employee_registration_controller.php",
                                                			{action:'update_normalot_for_all',v_normal_ot:v_normalot}, 
                                                			function(result,status)
                                                			{  
                                                			    swal('Success',"Normal OT Rate Updated Successfully","success");
                                                			});
                                                			
								        }
								});
								  
                                            
    });
    
    // *********************************end*************************************
    
       // ****************************update_gosi for all*********************
    
    $('#btn_add_gosi_all').click(function(){
        
        var v_gosi= $("#txt_gosi_pr").val();
        swal({
								  title: "Do you want to update all?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {  
                                             $.post("../controller/employee/employee_registration_controller.php",
                                                			{action:'update_gosi_for_all',v_gosi:v_gosi}, 
                                                			function(result,status)
                                                			{  
                                                			    swal('Success',"GOSI Percentage Updated Successfully","success");
                                                			});
                                                			
								        }
								});
								  
                                            
    });
    
    // *********************************end*************************************
    
     // ****************************update_travel allo rate for all*********************
    
    $('#btn_add_travel_allo').click(function(){
        
        var v_travel_allo= $("#txt_travel_allo").val();
        swal({
								  title: "Do you want to update all?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {  
                                             $.post("../controller/employee/employee_registration_controller.php",
                                                			{action:'update_travel_allo_for_all',v_travel_allo:v_travel_allo}, 
                                                			function(result,status)
                                                			{  
                                                			    swal('Success',"Travel Allowance Rate Updated Successfully","success");
                                                			});
                                                			
								        }
								});
								  
                                            
    });
    
    // *********************************end*************************************
    
    
     // ****************************update indemnity rate for all*********************
    
    $('#btn_add_indemnity_all').click(function(){
        
        var v_indemnity= $("#txt_indemnity").val();
        swal({
								  title: "Do you want to update all?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {  
                                             $.post("../controller/employee/employee_registration_controller.php",
                                                			{action:'update_indemnity_for_all',v_indemnity:v_indemnity}, 
                                                			function(result,status)
                                                			{  
                                                			    swal('Success',"Indemnity Bonus Rate Updated Successfully","success");
                                                			});
                                                			
								        }
								});
								  
                                            
    });
    
    // *********************************end*************************************
    
    
    
    $('#btn_add_division').click(function(){
        $('#modal_division_add').modal('show');
    });  
    
    
    
     //   *************************add division*******************************
    v_btn_add_division.click(function(){
      
        v_btn_add_division.ladda( 'start' );           
	
	
		var v_division_name=$("#txt_division_name").val();
                  

		if(v_division_name==="")
		{ 
	       v_btn_add_division.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_division_name);
			$.post("../controller/division/division_controller.php",
			{action:'add_division',v_division_name:v_division_name}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_add_division.ladda( 'stop' );
				if(result=="exist")
				{
					 $.toast({
						heading: 'Warning',
						text: 'Division Name Already Exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
				}
				else
				{
				     $.toast({
						heading: 'Success',
						text: 'Division Added Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_division_name").val("");
				    $('#div_division_select').load('templates/division_load_combo.php');
				// 	location.reload();
		    });
                
		}
    });
    // ******************************end*****************************
    
    
    $('#btn_add_department').click(function(){
        $('#modal_department_add').modal('show');
    });
    
      //   *************************add department*******************************
    v_btn_department_save.click(function(){
      
        v_btn_department_save.ladda( 'start' );           
	
	
		var v_department_name=$("#txt_department_name").val();
                  

		if(v_department_name==="")
		{ 
	       v_btn_department_save.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_division_name);
			$.post("../controller/division/division_controller.php",
			{action:'add_department',v_department_name:v_department_name}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_department_save.ladda( 'stop' );
				if(result=="exist")
				{
					 $.toast({
						heading: 'Warning',
						text: 'Department Name Already Exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
				}
				else
				{
				     $.toast({
						heading: 'Success',
						text: 'Department Added Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_department_name").val("");
				     $('#div_department_select').load('templates/department_load_combo.php');
				// 	location.reload();
		    });
                
		}
    });
    // ******************************end*****************************************
    
    
    
    // *****************************Register employee*****************************
     $('#btn_employee_register').click(function(){
     
            v_btn_employee_register.ladda( 'start' );
     
        var v_employee_name=$("#employee_name").val();
        var v_employee_id=$("#employee_id").val();
        var v_employee_cpr=$("#employee_cpr").val();
        var v_passporrt_no=$("#employee_passport_no").val();
        var v_joining_date=$("#joining_date").val();
        var v_email=$("#employee_email").val();
        var v_contact=$("#employee_phone_no").val();
        var v_native_con=$("#emp_native_ph_no").val();
        var v_native_con_pr=$("#emp_native_contact_person").val();
        var v_div_name=$("#select_division_search option:selected").text();
        var v_div_id=$("#select_division_search option:selected").val();
        var v_depmt_name=$("#select_department_search option:selected").text();
        var v_depmt_id=$("#select_department_search option:selected").val();
        var v_normal_ot=$("#txt_normal_ot_amt").val();
        var v_special_ot=$("#txt_special_ot_amt").val();
        var v_gosi=$("#txt_gosi_pr").val();
        var v_travel_allo=$("#txt_travel_allo").val();
        var v_indemnity=$("#txt_indemnity").val();
         var v_rejoining_date =$("#txt_rejoining_date").val();
        // alert(v_rejoining_date);
        	if(v_employee_name==="" || v_employee_id==="" || v_employee_cpr==="" || v_passporrt_no==="" || v_joining_date=="" || v_rejoining_date=="" || v_email==="" || v_contact==="" || v_native_con==="" || v_native_con_pr==="" || v_div_id==0 ||  v_depmt_id==0 || v_normal_ot=="" || v_special_ot=="" || v_gosi=="" || v_travel_allo==0.000 || v_indemnity==0.000)
            		{ 
            	       v_btn_employee_register.ladda( 'stop' );
            	       swal('Warning',"Please fill the required field","warning");
            		}
            	else
            		{	
            		    
            		  //  alert(v_division_name);
            			$.post("../controller/employee/employee_registration_controller.php",
            			{action:'register_emp',v_employee_name:v_employee_name,v_employee_id:v_employee_id,v_employee_cpr:v_employee_cpr,v_passporrt_no:v_passporrt_no,v_joining_date:v_joining_date,v_email:v_email,v_contact:v_contact,v_native_con:v_native_con,v_native_con_pr:v_native_con_pr,
            			    v_div_name:v_div_name,v_div_id:v_div_id,v_depmt_name:v_depmt_name,v_depmt_id:v_depmt_id,v_normal_ot:v_normal_ot,v_special_ot:v_special_ot,v_gosi:v_gosi,v_travel_allo:v_travel_allo,v_indemnity:v_indemnity,v_rejoining_date:v_rejoining_date
            			}, 
            			function(result,status)
            			{   
            				result = $.trim(result);
            				console.log(result);
            				v_btn_employee_register.ladda( 'stop' );
            				if(result=="exist")
            				{
            					 $.toast({
            						heading: 'Warning',
            						text: 'CPR Already Exist..!',
            						showHideTransition: 'slide',
            						icon: 'warning'
            					});
            				}
            				else
            				{
            				     $.toast({
            						heading: 'Success',
            						text: 'Empoyee Registration Successfully Completed..!',
            						showHideTransition: 'slide',
            						icon: 'success'
            					});
            				}
                                $("#employee_name").val("");
                                 $("#employee_id").val("");
                                 $("#employee_cpr").val("");
                                 $("#employee_passport_no").val("");
                                //  $("#joining_date").val();
                                 $("#employee_email").val("");
                                 $("#employee_phone_no").val("");
                                  $("#emp_native_ph_no").val("");
                                  $("#emp_native_contact_person").val("");
                                  $("#select_department_search").val(0);
                                 $("#select_department_search").trigger("chosen:updated");
                                 $("#select_division_search").val(0);
                                 $("#select_division_search").trigger("chosen:updated");
            				// 	location.reload();
            		    });
                            
            		}
                 
                 
                     
     });
     
     
     // *****************************end****************************************
    
    // ***********************employeee list view*******************************
     $("#view_gate_list").click(function()
		 {
           load_data_to_grid_employee_list();
                $("#select_employee_search").val(0);
                $("#select_employee_search").trigger("chosen:updated");
                 $('#txt_start_date').val("");
                $('#txt_end_date').val("");
                $('#ph_search').val("");
                
		 });
		 
         function load_data_to_grid_employee_list()
		 {
			 tbl_list_of_employees.destroy();
				 
			 tbl_list_of_employees = $('#list_of_employees').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/employee/employee_registration_controller.php',
						 'data': {
							action: 'list_employees'
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
						 { "data": "employee_Name"},
						 { "data": "join_date"},
						 { "data": "division_name"},
						 { "data": "dpmt_name"},
						 { "data": "contact_no"},
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
					         { "data": "ids",
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_user" name="view_user" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         }
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
    
    // **************************end********************************************
    
    // ******************** table click (view and status update)****************
    
     $('#list_of_employees tbody').on('click', 'td button', function (){             
		  var $row = $(this).closest('tr');
		  var data = tbl_list_of_employees.row($row).data();
		  var v_id  = data.ids;
		  var v_emp_name = data.employee_Name;
		  var v_emp_id = data.employee_id;
		  var v_emp_cpr = data.cpr;
		  var v_passport_no = data.passport_no;
		  var v_join_date = date_convert(data.join_date);
		  
		  var v_email = data.email;
		  var v_contact_no = data.contact_no;
		  var v_ntv_cont_no = data.native_contact_no;
		  var v_ntv_cont_pr = data.native_contact_person;
		  var v_div_name = data.division_name;
		  var v_div_id = data.division_id;
		  var v_dpmt_name = data.dpmt_name;
		  var v_dpmt_id = data.dpmt_id;
		  var v_normal_otamt = data.normal_ot_amt;
		  var v_special_otamt = data.special_ot_amt;
		  var v_txt_gosi_pr = data.gosi_pr;
		  var v_travel_allo_rate = data.travel_allo_rate;
		  var v_indemnity_rate = data.indemnity_rate;
		  var v_rejoin_date = data.rejoining_date;
		  //var dateParts = v_join_date.split('-');
    //         var joinDate = dateParts[1] + '/' + dateParts[2] + '/' + dateParts[0];
		  //$('#btn_generate_inventory').hide();
		  //$('#btn_edit_inventory').show();
		  
		 if($(this).attr("name")=='approval')
                         {
                             

                          var v_approved_status= data.status;
                          
                    			 $.post("../controller/employee/employee_registration_controller.php",{action : "user_status_change",v_id:v_id,v_approved_status:v_approved_status},function(res){
        	                     swal("success","User status changed successfully ....", "success");
        			             load_data_to_grid_employee_list();
        			                 $("#select_employee_search").val(0);
                                     $("#select_employee_search").trigger("chosen:updated");
                                     $('#txt_start_date').val("");
                                     $('#txt_end_date').val("");
                                     $('#ph_search').val("");
        						 });
        						 
        						 
                       
            			 }
    		 if($(this).attr("name")=='view_user')
                     {	
                        //  alert(v_join_date);
                         $("#v_id").val(v_id);
                         $("#employee_name").val(v_emp_name);
                         $("#employee_id").val(v_emp_id);
                         $("#employee_cpr").val(v_emp_cpr);
                         $("#employee_passport_no").val(v_passport_no);
                         $("#joining_date").val(v_join_date);
                         $("#employee_email").val(v_email);
                         $("#employee_phone_no").val(v_contact_no);
                         $("#emp_native_ph_no").val(v_ntv_cont_no);
                         $("#txt_normal_ot_amt").val(v_normal_otamt);
                        $("#txt_special_ot_amt").val(v_special_otamt);
                         $("#emp_native_contact_person").val(v_ntv_cont_pr);
                         $("#select_department_search").val(v_dpmt_id);
                         $("#select_department_search").trigger("chosen:updated");
                         $("#select_division_search").val(v_div_id);
                         $("#select_division_search").trigger("chosen:updated");
                         $("#txt_gosi_pr").val(v_txt_gosi_pr);
                         $("#txt_travel_allo").val(v_travel_allo_rate);
                         $("#txt_indemnity").val(v_indemnity_rate);
                         $("#txt_rejoining_date").val(v_rejoin_date);
                            $('#btn_employee_register').hide();
		                    $('#btn_edit_employee').show();
		                    $('#btn_update_rejoining_date').show();
		                     
		  
                         closeNavR();
                     }
		 
				 
	
						
						
	/////////////////////////////////	
           
    });
    
    // ********************************end**************************************
    
    
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

    
    
     // *****************************Update rejoining date*****************************
    $('#btn_update_rejoining_date').click(function(){
        var v_id= $("#v_id").val();
        var v_rejoining_date =$("#txt_rejoining_date").val();
        	$.post("../controller/employee/employee_registration_controller.php",
            			{action:'update_rejoining_date',v_rejoining_date:v_rejoining_date,v_id:v_id},
            			function(result,status)
            			{
            			    $.toast({
            						heading: 'Success',
            						text: 'Rejoining Date Updted Successfully..!',
            						showHideTransition: 'slide',
            						icon: 'success'
            			    });
            			});
    });
    
     // *****************************Update employee*****************************
     $('#btn_edit_employee').click(function(){
     
            v_btn_edit_employee.ladda( 'start' );
        var v_id= $("#v_id").val();
        var v_employee_name=$("#employee_name").val();
        var v_employee_id=$("#employee_id").val();
        var v_employee_cpr=$("#employee_cpr").val();
        var v_passporrt_no=$("#employee_passport_no").val();
        var v_joining_date=$("#joining_date").val();
        var v_email=$("#employee_email").val();
        var v_contact=$("#employee_phone_no").val();
        var v_native_con=$("#emp_native_ph_no").val();
        var v_native_con_pr=$("#emp_native_contact_person").val();
        var v_div_name=$("#select_division_search option:selected").text();
        var v_div_id=$("#select_division_search option:selected").val();
        var v_depmt_name=$("#select_department_search option:selected").text();
        var v_depmt_id=$("#select_department_search option:selected").val();
        var v_normal_ot=$("#txt_normal_ot_amt").val();
        var v_special_ot=$("#txt_special_ot_amt").val();
        var v_gosi_pr=$("#txt_gosi_pr").val();
        var v_travel_allo=$("#txt_travel_allo").val();
        var v_indemnity=$("#txt_indemnity").val();
          
        // alert(v_joining_date);
        	if(v_employee_name==="" || v_employee_id==="" || v_employee_cpr==="" || v_passporrt_no==="" || v_joining_date=="" || v_email==="" || v_contact==="" || v_native_con==="" || v_native_con_pr==="" || v_div_id==0 ||  v_depmt_id==0 || v_normal_ot=="" || v_special_ot=="" || v_gosi_pr=="" || v_indemnity=="" || v_travel_allo=="")
            		{ 
            	       v_btn_edit_employee.ladda( 'stop' );
            	       swal('Warning',"Please fill the required field","warning");
            		}
            	else
            		{	
            		    
            		  //  alert(v_division_name);
            			$.post("../controller/employee/employee_registration_controller.php",
            			{action:'update_emp',v_employee_name:v_employee_name,v_employee_id:v_employee_id,v_employee_cpr:v_employee_cpr,v_passporrt_no:v_passporrt_no,v_joining_date:v_joining_date,v_email:v_email,v_contact:v_contact,v_native_con:v_native_con,v_native_con_pr:v_native_con_pr,
            			    v_div_name:v_div_name,v_div_id:v_div_id,v_depmt_name:v_depmt_name,v_depmt_id:v_depmt_id,v_id:v_id,v_normal_ot:v_normal_ot,v_special_ot:v_special_ot,v_gosi:v_gosi_pr,v_travel_allo:v_travel_allo,v_indemnity:v_indemnity
            			}, 
            			function(result,status)
            			{   
            				result = $.trim(result);
            				console.log(result);
            				v_btn_edit_employee.ladda( 'stop' );
            				if(result=="exist")
            				{
            					 $.toast({
            						heading: 'Warning',
            						text: 'CPR Already Exist..!',
            						showHideTransition: 'slide',
            						icon: 'warning'
            					});
            				}
            				else
            				{
            				     $.toast({
            						heading: 'Success',
            						text: 'Empoyee Details Updted Successfully..!',
            						showHideTransition: 'slide',
            						icon: 'success'
            					});
            				}
                                // $("#employee_name").val("");
                                //  $("#employee_id").val("");
                                //  $("#employee_cpr").val("");
                                //  $("#employee_passport_no").val("");
                                // $("#joining_date").val("");
                                //  $("#employee_email").val("");
                                //  $("#employee_phone_no").val("");
                                //   $("#emp_native_ph_no").val("");
                                //   $("#emp_native_contact_person").val("");
                                //   $("#select_department_search").val(0);
                                //  $("#select_department_search").trigger("chosen:updated");
                                //  $("#select_division_search").val(0);
                                //  $("#select_division_search").trigger("chosen:updated");
                                //  $("#txt_normal_ot_amt").val("");
                                // $("#txt_special_ot_amt").val("");
            				// 	location.reload();
            		    });
                            
            		}
                 
                 
                     
     });
     
     
     // *****************************end****************************************
     
     
    //  **************************search by date********************************
    
     $('#btn_search_date').click(function(){
         var v_from_date = formatDate($('#txt_start_date').val());
         var v_to_date = formatDate($('#txt_end_date').val());
         load_data_to_grid_employee_list_between(v_from_date,v_to_date);
                $("#select_employee_search").val(0);
                $("#select_employee_search").trigger("chosen:updated");
                $('#ph_search').val("");
     });
     function load_data_to_grid_employee_list_between(v_from_date,v_to_date)
		 {
			 tbl_list_of_employees.destroy();
				 
			 tbl_list_of_employees = $('#list_of_employees').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/employee/employee_registration_controller.php',
						 'data': {
							action: 'list_employees_between_date',
							v_from_date:v_from_date,
							v_to_date:v_to_date
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
						 { "data": "employee_Name"},
						 { "data": "join_date"},
						 { "data": "division_name"},
						 { "data": "dpmt_name"},
						 { "data": "contact_no"},
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
					         { "data": "ids",
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_user" name="view_user" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         }
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
    
     
    // ****************************end******************************************
    
    
     //  **************************search by employee name********************************
    
     $("#ph_search").on("change", function() {
            var v_contact_no = $("#ph_search").val();     
         load_data_to_grid_employee_search_by_number(v_contact_no);
                $('#txt_start_date').val("");
                $('#txt_end_date').val("");
                $("#select_employee_search").val(0);
                $("#select_employee_search").trigger("chosen:updated");
         
     });
     function load_data_to_grid_employee_search_by_number(v_contact)
		 {
			 tbl_list_of_employees.destroy();
				 
			 tbl_list_of_employees = $('#list_of_employees').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/employee/employee_registration_controller.php',
						 'data': {
							action: 'list_employees_searchby_number',
							v_contact:v_contact
							
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
						 { "data": "employee_Name"},
						 { "data": "join_date"},
						 { "data": "division_name"},
						 { "data": "dpmt_name"},
						 { "data": "contact_no"},
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
					         { "data": "ids",
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_user" name="view_user" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         }
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
    
     
    // ****************************end******************************************
    
     //  **************************search by contact number********************************
    
     $("#div_employee_select").on("change", function() {
            var v_ids= $("#select_employee_search option:selected").val();     
         load_data_to_grid_employee_search_by_name(v_ids);
                $('#txt_start_date').val("");
                $('#txt_end_date').val("");
                $('#ph_search').val("");
         
     });
     function load_data_to_grid_employee_search_by_name(v_id)
		 {
			 tbl_list_of_employees.destroy();
				 
			 tbl_list_of_employees = $('#list_of_employees').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/employee/employee_registration_controller.php',
						 'data': {
							action: 'list_employees_searchby_name',
							v_id:v_id
							
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
						 { "data": "employee_Name"},
						 { "data": "join_date"},
						 { "data": "division_name"},
						 { "data": "dpmt_name"},
						 { "data": "contact_no"},
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
					         { "data": "ids",
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_user" name="view_user" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         }
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
    
     
    // ****************************end******************************************
    
    // **************************employee print with head*********************************
    
    $("#btn_employee_print_with_head").click(function()
		 {
		        var v_type= $("#employee_type option:selected").val();
                window.open("reports/pdf/print//employee_print.php?type="+v_type+"&x=0","_blank"); 
		 });
    
    // *****************************end*****************************************
    // **************************employee print without head*********************************
    
    $("#btn_employee_print_without_head").click(function()
		 {
		        var v_type= $("#employee_type option:selected").val();
                window.open("reports/pdf/print//employee_print.php?type="+v_type+"&x=1","_blank"); 
		 });
    
    // *****************************end*****************************************
    
    // **************************employee print with date*********************************
    
    $("#btn_print_with_date").click(function()
		 {
		        var startDate= formatDate($("#txt_start_date").val());
		        var endDate= formatDate($("#txt_end_date").val());
                window.open("reports/pdf/print//employee_print_withdate.php?x=0&startDate="+startDate+"&endDate="+endDate,"_blank"); 
		 });
    
    // *****************************end*****************************************
    
    
    function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
    
    
});