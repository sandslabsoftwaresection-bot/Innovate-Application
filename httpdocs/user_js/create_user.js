$(document).ready(function(){

                
                var btn_generate_user = $( '#btn_generate_user' ).ladda();
    
               var v_btn_edit_user = $( '#btn_edit_user' ).ladda();
    var tbl_user_list = $('#tbl_user_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});
    $('#tbl_user_list').removeClass( 'display' ).addClass('table table-striped table-bordered');                
               
        //load_data_to_grid_product_master_list();
    // $( '#btn_edit_inventory' ).hide();
     $('#btn_edit_user').hide();         
                
               
    btn_generate_user.click(function(){
      
        btn_generate_user.ladda( 'start' );           
	
	    var v_name=$("#txt_name").val();
		var v_item_name=$("#txt_user_namee").val();
        var v_user_email=$("#txt_user_email").val();
        var v_user_pass=$("#txt_user_passwordd").val();
// alert(v_item_name);
		if(v_item_name==="" || v_user_email==="" || v_name==="" )
		{ 
	       btn_generate_user.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
			$.post("../controller/login/login_controller.php",
			{action:'generate_new_user',v_item_name:v_item_name, v_name:v_name, v_user_email:v_user_email,txt_user_password:v_user_pass}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				// alert(result);
				btn_generate_user.ladda( 'stop' );
				if(result=="exist"){
				    $.toast({
						heading: 'Warning',
						text: 'Both Username and Email are already exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
					$("#txt_user_namee").val("");
					$("#txt_user_email").val("");
				}
				else if(result=="username"){
				    $.toast({
						heading: 'Warning',
						text: 'Username already exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
					$("#txt_user_namee").val("");
				}
				else if(result=="email"){
				    $.toast({
						heading: 'Warning',
						text: 'Email already exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
					 $("#txt_user_email").val("");
				}
				else{
    					 $.toast({
    						heading: 'Success',
    						text: 'User created successfully..!',
    						showHideTransition: 'slide',
    						icon: 'success'
    					});
    					clear_text();
				}	

				  load_data_to_grid_user_list(); 
				    
				// 	location.reload();
		    });
                
		}
    });
            
       v_btn_edit_user.click(function(){  
           v_btn_edit_user.ladda( 'start' );           
	
	    var v_name=$("#txt_name").val();
        var v_user_email=$("#txt_user_email").val();
        var v_user_pass=$("#txt_user_passwordd").val();
        // alert(v_user_pass);
        var v_id= $("#ids").val();
        // alert(v_id);
        	$.post("../controller/login/login_controller.php",
			{action:'edit_user_details',v_name:v_name, v_user_email:v_user_email,txt_user_password:v_user_pass,v_id:v_id}, 
			function(result,status)
			{
			    result = $.trim(result);
			    v_btn_edit_user.ladda( 'stop' );
			    	if(result=="email"){
				    $.toast({
						heading: 'Warning',
						text: 'Email already exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
				
					$("#txt_user_email").val("");
				}
				else{
				    	 $.toast({
    						heading: 'Success',
    						text: 'User updated successfully..!',
    						showHideTransition: 'slide',
    						icon: 'success'
    					});
    					clear_text();
    					$('#btn_generate_user').show();
		                        $('#btn_edit_user').hide();
		                        $('#txt_user_namee').prop('disabled', false);
				}
				load_data_to_grid_user_list();
				
			});
           
       });
         
           load_data_to_grid_user_list();
		
		 
         function load_data_to_grid_user_list()
		 {
			 tbl_user_list.destroy();
				 
			 tbl_user_list = $('#tbl_user_list').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/login/login_controller.php',
						 'data': {
							action: 'list_user_detais'
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
						 { "data": "name"},
						 { "data": "username"},
						 { "data": "email"},
						 { "data": "password",
						     
						     render: function ( data, type, rows, meta ) {
							
                            		var outputString='';			
                                    for (var i = 0; i < data.length; i++) {
                                        outputString += '*';
                                    }
                                    
									return outputString;
	
								 },
			 
						     
						 },
				// 		{ "data": "status"},
				// 	        { "data": "ids" ,
			 
			 
				// 			  render: function ( data, type, rows, meta ) {
							
				// 						str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_inventory" name="delete_inventory" ><i class="material-icons ">delete</i></button>';
									
				// 					return str_active_status_view;
	
				// 				 },
			 
				// 	 },	
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
					         { "data": "id" ,
			 
			 
							  render: function ( data, type, rows, meta ) {
							
										str_active_status_view = ' <button type="button" class="btn btn-sm btn-success mr-1" style="color: #fff;"  id="edit_user_pass" name="edit_user_pass" ><i class="material-icons ">edit</i></button>';
									
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
				 
			$('#btn_inventory').click(function(){
				location.reload();
			});	 
                 
                 
    $('#tbl_user_list tbody').on('click', 'td button', function (){             
		  var $row = $(this).closest('tr');
		  var data = tbl_user_list.row($row).data();
		  var v_user_id  = data.id;
		 
		  
		   if($(this).attr("name")=='approval')
                         {
                            //  alert("clicked");

                          var v_approved_status= data.status;
                          
                    			 $.post("../controller/login/login_controller.php",{action : "status_change",user_id:v_user_id,v_approved_status:v_approved_status},function(res){
        	                     swal("success","status changed successfully ....", "success");
        			             load_data_to_grid_user_list(); 
        						 });
                       
            			 }
            			 
		  if($(this).attr("name")=='edit_user_pass')
                         {
                             var rowData = tbl_user_list.row($(this).closest('tr')).data();

                                // Now you can access the values from rowData object
                                var name = rowData.name;
                                var username = rowData.username;
                                var email = rowData.email;
                                var password = rowData.password;
                                var v_id = rowData.id;
                                $("#txt_name").val(name);
                            	$("#txt_user_namee").val(username);
                                $("#txt_user_email").val(email);
                                $("#txt_user_passwordd").val(password);
                                $("#ids").val(v_id);
                                $('#btn_generate_user').hide();
		                        $('#btn_edit_user').show();
		                        $('#txt_user_namee').prop('disabled', true);
                         }

	/////////////////////////////////	
           
    });
	
    function clear_text()
	{
	  $("#txt_name").val("");
	$("#txt_user_namee").val("");
        $("#txt_user_email").val("");
        $("#txt_user_passwordd").val("12345");
	}

});