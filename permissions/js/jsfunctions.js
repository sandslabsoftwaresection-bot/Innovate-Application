   $(document).ready(function() {
        
         var v_btn_create_user = $( '#btn_generate_user' ).ladda();
        let rowwId='' ;
        //let UrlPostclassPath = 'permission_class/class_permission.php';
        let UrlPostclassPath = PermissionClassNamespace.varUrlPostclassPath;
        console.log('Path : '+UrlPostclassPath);
        var listOfRolls = $('#tlb_listOfRolls').DataTable({
                "paging": false,
                "info": false,
                "language": { search: '', searchPlaceholder: "Search..." },
                "ajax": {
                    'type': 'POST',
                    'url': UrlPostclassPath,
                    'data': {
                        action: 'listOfRolls'
                    }
                },
                "columns": [
                   
                    { "data": "id","visible": false},
                    { "data": "name"},
                   
                ]
                
        }); 
        
        var listOfRollsForUsers = $('#tlb_listOfRollsForUsers').DataTable({
                "paging": false,
                "info": false,
                "language": { search: '', searchPlaceholder: "Search..." },
                "ajax": {
                    'type': 'POST',
                    'url': UrlPostclassPath,
                    'data': {
                        action: 'listOfRolls'
                    }
                },
                "columns": [
                   
                    { "data": "id","visible": false},
                    { "data": "name"},
                   
                ]
                
        }); 
        
        
        
        var listOfControlsAndModules = $('#tlb_listOfControlsAndModules').DataTable({
                "paging": false,
                "info": false,
                language: { search: '', searchPlaceholder: "Search..." },
                "ajax": {
                    'type': 'POST',
                    'url': UrlPostclassPath,
                    'data': {
                        action: 'listData'
                    }
                },
                "columns": [
                   
                    { "data": "id","visible": false},
                    { "data": "name"},
                    { "data": "class_name","visible": false}
                ]
                
        });     
        
       
         var addedListOfControlsAndModules = $('#tlb_addedListOfControlsAndModules').DataTable({
                "paging": false,
                "info": false,
                language: { search: '', searchPlaceholder: "Search..." },
                "columns": [
                   
                    { "data": "id","visible": false},
                    { "data": "name"},
                    { "data": "class_name","visible": false}
                ]
        });   
        
        // Function to check if DataTable is empty
        function isDataTableEmpty(tableId) {
            // Check if DataTable is initialized
            if ($.fn.DataTable.isDataTable(tableId)) {
                // DataTable is initialized
                var table = $(tableId).DataTable();
                
                // Check if DataTable contains any rows
                return table.rows().count() === 0;
            } else {
                // DataTable is not initialized or not found
                return true; // Treat as empty
            }
        }
        
           // Event delegation for click events on table rows
        $('#tlb_listOfRolls').on('click', 'tbody tr', function() {
           
            // Remove 'selected' class from all rows
            $('#tlb_listOfRolls tbody tr').removeClass('activeTableRowColor');
            // Add 'selected' class to the clicked row
            $(this).addClass('activeTableRowColor');
            
            // Log row data to console for debugging
            var rowData = listOfRolls.row(this).data();
            console.log("Clicked row data:", rowData['id']);
            rowwId = rowData['id'];
           
            if ($.fn.DataTable.isDataTable('#tlb_addedListOfControlsAndModules')) {
                addedListOfControlsAndModules.destroy();
            }
            console.log('After Destroy');
            addedListOfControlsAndModules = $('#tlb_addedListOfControlsAndModules').DataTable({
                    "paging": false,
                    "info": false,
                    language: { search: '', searchPlaceholder: "Search...","emptyTable": "No Permissions Added" },
                    "ajax": {
                        'type': 'POST',
                        'url': UrlPostclassPath,
                        'data': {
                            action: 'listOfPermissionBasedOnRolls',
                            rollId : rowData['id']
                        },
                        'dataSrc': function(response) {
                            if (response.data && response.data.length > 0) {
                                return response.data; // Return the data array if it's not empty
                            } else {
                                return []; // Return an empty array if no data is available
                            }
                        }
                        
                    },
                    "columns": [
                       
                        { "data": "id","visible": false},
                        { "data": "name"},
                        { "data": "class_name","visible": false}
                       
                    ],
                    // New Added
                    "initComplete": function(settings, json) {
                       
                        if (isDataTableEmpty('#tlb_addedListOfControlsAndModules')) {
                                // DataTable is empty
                                console.log('DataTable is empty.');
                                listOfControlsAndModules.ajax.reload();
                        } 
                        
                        
                       // Reload the first DataTable and strike out corresponding items after reload completion
                        listOfControlsAndModules.ajax.reload(function() {
                            // Get array of IDs present in the second DataTable
                            var secondTableIds = addedListOfControlsAndModules.rows().data().pluck('id').toArray();
                            
                            // Iterate through rows of the first DataTable
                            listOfControlsAndModules.rows().every(function(rowIdx, tableLoop, rowLoop) {
                                var rowData = this.data(); // Get row data
                                var id = rowData.id; // Assuming the ID is present in rowData
                                
                                // Check if the ID is present in the array of IDs from the second DataTable
                                var isIdInSecondTable = secondTableIds.includes(id);
                                
                                // If the ID is present in the array, strike out the corresponding item in the first DataTable
                                if (isIdInSecondTable) {
                                    $(this.node()).addClass('strikethrough'); // Add CSS class for strikethrough style
                                    
                                }
                            });
                            
                            // Redraw the first DataTable to reflect changes
                            listOfControlsAndModules.draw();
                        });


                        
                    }
                    
                    //New added ends Here
                
            }); 
            
           // New Added

    
           //New added ends Here
            
            
        });
        
         $('#tlb_listOfControlsAndModules').on('click', 'tbody tr', function() {
            
            if (listOfControlsAndModules.rows().count() === 0) {
                console.log("First table has no data.");
                return; // Exit the function if there are no rows
            }
            
            var isStrikethrough = $(this).hasClass('strikethrough');
        
            // Output whether the item is strikethrough or not
            if (isStrikethrough) {
                console.log('Control/Module already add to permission');
                return false;
            } 
            
                
            // Remove 'selected' class from all rows
            $('#tlb_listOfControlsAndModules tbody tr').removeClass('activeTableRowColor');
            // Add 'selected' class to the clicked row
            $(this).addClass('activeTableRowColor');
            
            // Log row data to console for debugging
            var rowData = listOfControlsAndModules.row(this).data();
            console.log("Clicked row data:", rowData);
            addedListOfControlsAndModules.row.add(rowData).draw();
            //listOfControlsAndModules.row($(this)).remove().draw();
            $(this).toggleClass('strikethrough');
          
        });
        
        
        $('#tlb_addedListOfControlsAndModules').on('click', 'tbody tr', function() {
           
            if (addedListOfControlsAndModules.rows().count() === 0) {
                console.log("First table has no data.");
                return; // Exit the function if there are no rows
            }
            // Remove 'selected' class from all rows
            $('#tlb_addedListOfControlsAndModules tbody tr').removeClass('activeTableRowColor');
            // Add 'selected' class to the clicked row
            $(this).addClass('activeTableRowColor');
            
             var rowData = addedListOfControlsAndModules.row(this).data();
            if (rowData) {
                // Get the ID of the clicked row
                var id = rowData.id; // Assuming the ID is present in rowData
                
                // Iterate through rows of the first DataTable
                listOfControlsAndModules.rows().every(function(rowIdx, tableLoop, rowLoop) {
                    var rowData = this.data(); // Get row data
                    var rowId = rowData.id; // Assuming the ID is present in rowData
                    
                    // If the ID of the clicked row matches the ID of the row in the first DataTable, remove the strikethrough style
                    if (rowId === id) {
                        $(this.node()).removeClass('strikethrough'); // Remove CSS class for strikethrough style
                    }
                });
            }
             
            addedListOfControlsAndModules.row($(this)).remove().draw();
             
        });
        
        
        
        $('#btn_confim_privilages').on('click', function() {
            
            if(rowwId==='')
            {
                
                setupDropdown('dropdownContent','error',svgError+'Please Select Roll','click');
                return false;
            }
            var firstColumnData = [];
            
            // Iterate over each row in the DataTable
                addedListOfControlsAndModules.rows().every(function(rowIdx, tableLoop, rowLoop) {
                var rowData = this.data(); // Get data for the current row
                var firstColumnValue = rowData['id']; // Get data from the first column (index 0)
                firstColumnData.push(firstColumnValue); // Add the first column data to the array
            });
    
            // Now you have an array containing the data from the first column of all rows
            console.log(firstColumnData);
            $.post(UrlPostclassPath,{action:'save_privilages',privilage_data:firstColumnData, rollId : rowwId}, function(ret){
                console.log(svgSuccess+ret);
                 setupDropdown('dropdownContent','success',svgSuccess+ret,'click');
            });
              
        });
        
        
        
        // User List and functions
        
        var listOfUsers = $('#tlb_listOfUsers').DataTable({
                "paging": false,
                "info": false,
                "language": { search: '', searchPlaceholder: "Search..." },
                "ajax": {
                    'type': 'POST',
                    'url': UrlPostclassPath,
                    'data': {
                        action: 'listOfUsers'
                    }
                },
                "columns": [
                   
                    { "data": "id","visible": false},
                    // { "data": "id"},
                    { "data": "name"},
                    { "data": "username"},
                    { "data": "role_name","visible": false},
                   
                ]
                
        }); 
        var data,user_id,listOfRollsOfSelectedUser;
        $('#tlb_listOfUsers').on('click', 'tbody tr', function() {
           
            if (listOfUsers.rows().count() === 0) {
                console.log("First table has no data.");
                return; // Exit the function if there are no rows
            }
            // Remove 'selected' class from all rows
            $('#tlb_listOfUsers tbody tr').removeClass('activeTableRowColor');
            // Add 'selected' class to the clicked row
            $(this).addClass('activeTableRowColor');

            var rowData = listOfUsers.row(this).data();
            user_id = rowData['id'];
            
            
            if ($.fn.DataTable.isDataTable('#tlb_listOfSelectedUserRolls')) {
                listOfRollsOfSelectedUser.destroy();
            }
            listOfRollsOfSelectedUser = $('#tlb_listOfSelectedUserRolls').DataTable({
                "paging": false,
                "info": false,
                "language": { search: '', searchPlaceholder: "Search..." ,"emptyTable": "No Roles Added"},
                "ajax": {
                    'type': 'POST',
                    'url': UrlPostclassPath,
                    'data': {
                        action: 'listOfSelectedUserRolls',
                        userId:user_id
                    },
                    'dataSrc': function(response) {
                        if (response.data && response.data.length > 0) {
                            return response.data; // Return the data array if it's not empty
                        } else {
                            return []; // Return an empty array if no data is available
                        }
                    }
                },
                "columns": [
                   
                    { "data": "name"},
                   
                ]
                
            }); 
            
            
            
            
            
            
            
        });
        
        
        $('#tlb_listOfRollsForUsers').on('click', 'tbody tr', function() {
           
            if (listOfUsers.rows().count() === 0) {
                console.log("First table has no data.");
                return; // Exit the function if there are no rows
            }
            // Remove 'selected' class from all rows
            //$('#tlb_listOfRollsForUsers tbody tr').removeClass('activeTableRowColor');
            // Add 'selected' class to the clicked row
            //$(this).addClass('activeTableRowColor');
            if ($(this).hasClass('activeTableRowColor')) {
                $(this).removeClass('activeTableRowColor');
            } else {
                listOfRollsForUsers.$('tr.selected').removeClass('activeTableRowColor');
                $(this).addClass('activeTableRowColor');
            }
            
            
            var rowData = listOfRollsForUsers.row(this).data();
            console.log("Clicked row data:", rowData['id']);
            data = rowData['id'];
           
        });
        
        $('#btn_change_user_roll').on('click', function() {
            
            
            if(data==='')
            {
                setupDropdown('dropdownContent','error',svgError+'Please Select Roll/Groups','click');
                return false;
            }
            
            
            
            var columnIndex = 1; // Specify the index of the column you want to retrieve data from
            var selectedColumnData = [];
            
            // Iterate over each row in the table
            listOfRollsForUsers.rows().every(function() {
                // Check if the row has the class 'activeTableRowColor', indicating it's selected
                if ($(this.node()).hasClass('activeTableRowColor')) {
                    // Get the data from the specified column for the selected row
                    var rowData = this.data();
                    selectedColumnData.push(rowData.id);
                }
            });
    
            console.log(selectedColumnData);
            
          
            // Now you have an array containing the data from the first column of all rows
            $.post(UrlPostclassPath,{action:'updateUserPrivilageByUserID',privilage_id:selectedColumnData,userId:user_id}, function(ret){
                if (ret.indexOf('Error') !== -1) {
                    setupDropdown('dropdownContent','error',svgError+ret,'click');
                } else {
                    setupDropdown('dropdownContent','success',svgSuccess+ret,'click');
                }
                 listOfRollsOfSelectedUser.ajax.reload();
                
            });
              
        });
        
        $('#btn_addRolesOrGroups').on('click', function() {
           var addRolesOrGroups = $('#txt_addRolesOrGroups').val();
             $.post(UrlPostclassPath,{action:'addRolesOrGroups',add_RolesOrGroups:addRolesOrGroups}, function(ret){
                listOfRolls.ajax.reload();
                $('#txt_addRolesOrGroups').val("");
                 setupDropdown('dropdownContent','success',svgSuccess+'Role added successfully','click');
                 
            });
        });
        
        
        //$('.dataTables_filter input').css({'width':'0', 'padding':'0', 'margin':'0', 'border':'none', 'outline':'none'});
         $('#btn_create_user').on('click', function() {
             $('#modal_create_user').modal('show');
         });
         
          $('#cancel_user_modal').on('click', function() {
             $('#modal_create_user').modal('hide');
              $("#txt_name").val("");
        	    $("#txt_user_namee").val("");
                $("#txt_user_email").val("");
                $("#txt_user_passwordd").val("12345");
             
         });
          $('#btn_generate_user').on('click', function() {
               v_btn_create_user.ladda( 'start' );
                        var v_name=$("#txt_name").val();
                		var v_item_name=$("#txt_user_namee").val();
                        var v_user_email=$("#txt_user_email").val();
                        var v_user_pass=$("#txt_user_passwordd").val();
                // alert(v_item_name);
                		if(v_item_name==="" || v_user_email==="" || v_name==="" )
                		{ 
                	       v_btn_create_user.ladda( 'stop' );
                	       //swal('Warning',"Please fill the required field","warning");
                	       setupDropdown('dropdownContent','error',svgError+'Please fill the required field','click');
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
                				v_btn_create_user.ladda( 'stop' );
                				if(result=="exist"){
                				//     $.toast({
                				// 		heading: 'Warning',
                				// 		text: 'Both Username and Email are already exist..!',
                				// 		showHideTransition: 'slide',
                				// 		icon: 'warning'
                				// 	});
                				setupDropdown('dropdownContent','error',svgError+'Both Username and Email are already exist..!','click');
                 
                					$("#txt_user_namee").val("");
                					$("#txt_user_email").val("");
                				}
                				else if(result=="username"){
                				//     $.toast({
                				// 		heading: 'Warning',
                				// 		text: 'Username already exist..!',
                				// 		showHideTransition: 'slide',
                				// 		icon: 'warning'
                				// 	});
                				setupDropdown('dropdownContent','error',svgError+'Username already exist..!','click');
                					$("#txt_user_namee").val("");
                				}
                				else if(result=="email"){
                				//     $.toast({
                				// 		heading: 'Warning',
                				// 		text: 'Email already exist..!',
                				// 		showHideTransition: 'slide',
                				// 		icon: 'warning'
                				// 	});
                				setupDropdown('dropdownContent','error',svgError+'Email already exist..!','click');
                					 $("#txt_user_email").val("");
                				}
                				else{
                    				// 	 $.toast({
                    				// 		heading: 'Success',
                    				// 		text: 'User created successfully..!',
                    				// 		showHideTransition: 'slide',
                    				// 		icon: 'success'
                    				// 	});
                    				setupDropdown('dropdownContent','success',svgSuccess+'User created successfully..!','click');
                    				$('#modal_create_user').modal('hide');
                                      $("#txt_name").val("");
                                	    $("#txt_user_namee").val("");
                                        $("#txt_user_email").val("");
                                        $("#txt_user_passwordd").val("12345");
                				}	
                
                				 
                				   listOfUsers.ajax.reload();  
                				// 	location.reload();
                		    });
                                
                		}
             
                    });
         
    });