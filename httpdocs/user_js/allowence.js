$(document).ready(function(){
       v_btn_add_allowence = $("#btn_add_allowence").ladda();
       v_btn_add_deduction = $("#btn_add_deduction").ladda();
       v_btn_edit_allowence = $("#btn_edit_allowence").ladda();
       v_btn_edit_deduction = $("#btn_edit_deduction").ladda();
        var list_of_allowence = $('#list_of_allowence').DataTable( {searching: true, paging: false, info: false,"ordering": false});
         var list_of_deduction = $('#list_of_deduction').DataTable( {searching: true, paging: false, info: false,"ordering": false});
       
    //   *************************add allowence*******************************
    v_btn_add_allowence.click(function(){
      
        v_btn_add_allowence.ladda( 'start' );           
	
	
		var v_allowence_name=$("#txt_allowence").val();
                  

		if(v_allowence_name==="")
		{ 
	       v_btn_add_allowence.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_allowence_name);
			$.post("../controller/allowence/allowence_controller.php",
			{action:'add_allowence',v_allowence_name:v_allowence_name}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_add_allowence.ladda( 'stop' );
				if(result=="exist")
				{
					 $.toast({
						heading: 'Warning',
						text: 'Allowance Name Already Exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
				}
				else
				{
				     $.toast({
						heading: 'Success',
						text: 'Allowance Added Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_allowence").val("");
				// 	location.reload();
		    });
                
		}
    });
    // ******************************end*****************************
    
    // ******************* add deduction**************************************
    
     v_btn_add_deduction.click(function(){
      
        v_btn_add_deduction.ladda( 'start' );           
	
	
		var v_deduction_name=$("#txt_deduction").val();
                  

		if(v_deduction_name==="")
		{ 
	       v_btn_add_deduction.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_allowence_name);
			$.post("../controller/allowence/allowence_controller.php",
			{action:'add_deduction',v_deduction_name:v_deduction_name}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_add_deduction.ladda( 'stop' );
				if(result=="exist")
				{
					 $.toast({
						heading: 'Warning',
						text: 'Deduction Name Already Exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
				}
				else
				{
				     $.toast({
						heading: 'Success',
						text: 'Deduction Added Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_deduction").val("");
				// 	location.reload();
		    });
                
		}
    });
//   ***********************end********************
        $('#view_allowence_list').click(function(){
            load_data_to_grid_allowence_list()
        });

// ************************list allowence****************************

function load_data_to_grid_allowence_list()
		 {
			 list_of_allowence.destroy();
				 
			 list_of_allowence = $('#list_of_allowence').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/allowence/allowence_controller.php',
						 'data': {
							action: 'list_allowence'
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
						 { "data": "allow_title"},
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
					         { "data": "ids" ,
			 
			 
							  render: function ( data, type, rows, meta ) {
							
										str_active_status_view = ' <button type="button" class="btn btn-sm btn-success mr-1" style="color: #fff;"  id="edit_allowence" name="edit_allowence" ><i class="material-icons ">edit</i></button>';
									
									return str_active_status_view;
	
								 },
			 
					 },
	 
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
// ****************************end********************************

// ********************************allowence list update and status change************************

  $('#list_of_allowence tbody').on('click', 'td button', function (){             
		  var $row = $(this).closest('tr');
		  var data = list_of_allowence.row($row).data();
		  var v_allowence_id  = data.ids;
		 
		  
		   if($(this).attr("name")=='approval')
                         {
                            //  alert("clicked");

                          var v_approved_status= data.status;
                          
                    			 $.post("../controller/allowence/allowence_controller.php",{action : "allowence_status_change",v_allowence_id:v_allowence_id,v_approved_status:v_approved_status},function(res){
        	                     swal("success","status changed successfully ....", "success");
        			             load_data_to_grid_allowence_list(); 
        						 });
                       
            			 }
            			 
		  if($(this).attr("name")=='edit_allowence')
                         {
                             var rowData = list_of_allowence.row($(this).closest('tr')).data();

                                // Now you can access the values from rowData object
                                var allowence_name = rowData.allow_title;
                                var v_id = rowData.ids;
                                $("#txt_allowence").val(allowence_name);
                            	$("#allowence_id").val(v_id);
                                $('#btn_add_allowence').hide();
		                        $('#btn_edit_allowence').show();
		                        closeNavR()
                         }


    });
    
    // ************ edit ******************
     $('#btn_edit_allowence').click(function(){
             v_btn_edit_allowence.ladda( 'start' );           
	
	
		var v_allowence_name=$("#txt_allowence").val();
              var v_allowence_id= $("#allowence_id").val();   

		if(v_allowence_name==="")
		{ 
	       v_btn_edit_allowence.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_allowence_name);
			$.post("../controller/allowence/allowence_controller.php",
			{action:'update_allowence',v_allowence_name:v_allowence_name, v_allowence_id:v_allowence_id}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_edit_allowence.ladda( 'stop' );
				if(result=="exist")
				{
					 $.toast({
						heading: 'Warning',
						text: 'Allowance Name Already Exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
				}
				else
				{
				     $.toast({
						heading: 'Success',
						text: 'Allowance Updated Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_allowence").val("");
				    $("#allowence_id").val("");
				     $('#btn_add_allowence').show();
		          $('#btn_edit_allowence').hide();
				// 	location.reload();
		    });
                
		}
        });
	
// *********************************end****************************************


 $('#view_deduction_list').click(function(){
            load_data_to_grid_deduction_list()
        });
        
        
// ************************list deduction****************************

function load_data_to_grid_deduction_list()
		 {
			 list_of_deduction.destroy();
				 
			 list_of_deduction = $('#list_of_deduction').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/allowence/allowence_controller.php',
						 'data': {
							action: 'list_deduction'
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
						 { "data": "deduc_name"},
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
					         { "data": "ids" ,
			 
			 
							  render: function ( data, type, rows, meta ) {
							
										str_active_status_view = ' <button type="button" class="btn btn-sm btn-success mr-1" style="color: #fff;"  id="edit_deduction" name="edit_deduction" ><i class="material-icons ">edit</i></button>';
									
									return str_active_status_view;
	
								 },
			 
					 },
	 
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
// ****************************end********************************

// ********************************deduction list update and status change************************

  $('#list_of_deduction tbody').on('click', 'td button', function (){             
		  var $row = $(this).closest('tr');
		  var data = list_of_deduction.row($row).data();
		  var v_deduction_id  = data.ids;
		 
		  
		   if($(this).attr("name")=='approval')
                         {
                            //  alert("clicked");

                          var v_approved_status= data.status;
                          
                    			 $.post("../controller/allowence/allowence_controller.php",{action : "deduction_status_change",v_deduction_id:v_deduction_id,v_approved_status:v_approved_status},function(res){
        	                     swal("success","status changed successfully ....", "success");
        			             load_data_to_grid_deduction_list(); 
        						 });
                       
            			 }
            			 
		  if($(this).attr("name")=='edit_deduction')
                         {
                             var rowData = list_of_deduction.row($(this).closest('tr')).data();

                                // Now you can access the values from rowData object
                                var deduction_name = rowData.deduc_name;
                                var v_deduction_id = rowData.ids;
                                $("#txt_deduction").val(deduction_name);
                            	$("#deduction_id").val(v_deduction_id);
                                $('#btn_add_deduction').hide();
		                        $('#btn_edit_deduction').show();
		                        closeNavRCancel()
                         }


    });
    
    // ************ edit ******************
     $('#btn_edit_deduction').click(function(){
             v_btn_edit_deduction.ladda( 'start' );           
	
	
		var v_deduction_name=$("#txt_deduction").val();
              var v_deduction_id= $("#deduction_id").val();   

		if(v_deduction_name==="")
		{ 
	       v_btn_edit_deduction.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_allowence_name);
			$.post("../controller/allowence/allowence_controller.php",
			{action:'update_deduction',v_deduction_name:v_deduction_name, v_deduction_id:v_deduction_id}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_edit_deduction.ladda( 'stop' );
				if(result=="exist")
				{
					 $.toast({
						heading: 'Warning',
						text: 'Deduction Name Already Exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
				}
				else
				{
				     $.toast({
						heading: 'Success',
						text: 'Deduction Update Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_deduction").val("");
				    $("#deduction_id").val("");
				     $('#btn_add_deduction').show();
		          $('#btn_edit_deduction').hide();
				// 	location.reload();
		    });
                
		}
        });
	
// *********************************end****************************************

   
});