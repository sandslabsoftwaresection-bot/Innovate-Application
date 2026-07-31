$(document).ready(function(){
       v_btn_add_division = $("#btn_add_division").ladda();
       v_btn_add_department = $("#btn_add_department").ladda();
       v_btn_edit_division = $("#btn_edit_division").ladda();
       v_btn_edit_department = $("#btn_edit_department").ladda();
        var list_of_division = $('#list_of_division').DataTable( {searching: true, paging: false, info: false,"ordering": false});
         var list_of_departments = $('#list_of_departments').DataTable( {searching: true, paging: false, info: false,"ordering": false});
       
    //   *************************add division*******************************
    v_btn_add_division.click(function(){
      
        v_btn_add_division.ladda( 'start' );           
	
	
		var v_division_name=$("#txt_division").val();
                  

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
				    $("#txt_division").val("");
				// 	location.reload();
		    });
                
		}
    });
    // ******************************end*****************************
    
    // ******************* add departments**************************************
    
     v_btn_add_department.click(function(){
      
        v_btn_add_department.ladda( 'start' );           
	
	
		var v_department_name=$("#txt_department").val();
                  

		if(v_department_name==="")
		{ 
	       v_btn_add_department.ladda( 'stop' );
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
				v_btn_add_department.ladda( 'stop' );
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
				    $("#txt_department").val("");
				// 	location.reload();
		    });
                
		}
    });
//   ***********************end********************
        $('#view_division_list').click(function(){
            load_data_to_grid_division_list()
        });

// ************************list division****************************

function load_data_to_grid_division_list()
		 {
			 list_of_division.destroy();
				 
			 list_of_division = $('#list_of_division').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/division/division_controller.php',
						 'data': {
							action: 'list_division'
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
						 { "data": "division_name"},
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
							
										str_active_status_view = ' <button type="button" class="btn btn-sm btn-success mr-1" style="color: #fff;"  id="edit_division" name="edit_division" ><i class="material-icons ">edit</i></button>';
									
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

// ********************************division list update and status change************************

  $('#list_of_division tbody').on('click', 'td button', function (){             
		  var $row = $(this).closest('tr');
		  var data = list_of_division.row($row).data();
		  var v_division_id  = data.ids;
		 
		  
		   if($(this).attr("name")=='approval')
                         {
                            //  alert("clicked");

                          var v_approved_status= data.status;
                          
                    			 $.post("../controller/division/division_controller.php",{action : "division_status_change",v_division_id:v_division_id,v_approved_status:v_approved_status},function(res){
        	                     swal("success","status changed successfully ....", "success");
        			             load_data_to_grid_division_list(); 
        						 });
                       
            			 }
            			 
		  if($(this).attr("name")=='edit_division')
                         {
                             var rowData = list_of_division.row($(this).closest('tr')).data();

                                // Now you can access the values from rowData object
                                var division_name = rowData.division_name;
                                var v_id = rowData.ids;
                                $("#txt_division").val(division_name);
                            	$("#division_id").val(v_id);
                                $('#btn_add_division').hide();
		                        $('#btn_edit_division').show();
		                        closeNavR()
                         }


    });
    
    // ************ edit ******************
     $('#btn_edit_division').click(function(){
             v_btn_edit_division.ladda( 'start' );           
	
	
		var v_division_name=$("#txt_division").val();
              var v_division_id= $("#division_id").val();   

		if(v_division_name==="")
		{ 
	       v_btn_edit_division.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_division_name);
			$.post("../controller/division/division_controller.php",
			{action:'update_division',v_division_name:v_division_name, v_division_id:v_division_id}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_edit_division.ladda( 'stop' );
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
						text: 'Division Updated Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_division").val("");
				    $("#division_id").val("");
				     $('#btn_add_division').show();
		          $('#btn_edit_division').hide();
				// 	location.reload();
		    });
                
		}
        });
	
// *********************************end****************************************


 $('#view_department_list').click(function(){
            load_data_to_grid_department_list()
        });
        
        
// ************************list department****************************

function load_data_to_grid_department_list()
		 {
			 list_of_departments.destroy();
				 
			 list_of_departments = $('#list_of_departments').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/division/division_controller.php',
						 'data': {
							action: 'list_departments'
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
						 { "data": "department_name"},
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
							
										str_active_status_view = ' <button type="button" class="btn btn-sm btn-success mr-1" style="color: #fff;"  id="edit_department" name="edit_department" ><i class="material-icons ">edit</i></button>';
									
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

// ********************************department list update and status change************************

  $('#list_of_departments tbody').on('click', 'td button', function (){             
		  var $row = $(this).closest('tr');
		  var data = list_of_departments.row($row).data();
		  var v_department_id  = data.ids;
		 
		  
		   if($(this).attr("name")=='approval')
                         {
                            //  alert("clicked");

                          var v_approved_status= data.status;
                          
                    			 $.post("../controller/division/division_controller.php",{action : "department_status_change",v_department_id:v_department_id,v_approved_status:v_approved_status},function(res){
        	                     swal("success","status changed successfully ....", "success");
        			             load_data_to_grid_department_list(); 
        						 });
                       
            			 }
            			 
		  if($(this).attr("name")=='edit_department')
                         {
                             var rowData = list_of_departments.row($(this).closest('tr')).data();

                                // Now you can access the values from rowData object
                                var department_name = rowData.department_name;
                                var v_department_id = rowData.ids;
                                $("#txt_department").val(department_name);
                            	$("#department_id").val(v_department_id);
                                $('#btn_add_department').hide();
		                        $('#btn_edit_department').show();
		                        closeNavRCancel()
                         }


    });
    
    // ************ edit ******************
     $('#btn_edit_department').click(function(){
             v_btn_edit_department.ladda( 'start' );           
	
	
		var v_department_name=$("#txt_department").val();
              var v_department_id= $("#department_id").val();   

		if(v_department_name==="")
		{ 
	       v_btn_edit_department.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_division_name);
			$.post("../controller/division/division_controller.php",
			{action:'update_department',v_department_name:v_department_name, v_department_id:v_department_id}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_edit_department.ladda( 'stop' );
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
						text: 'Department Update Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_department").val("");
				    $("#department_id").val("");
				     $('#btn_add_department').show();
		          $('#btn_edit_department').hide();
				// 	location.reload();
		    });
                
		}
        });
	
// *********************************end****************************************

   
});