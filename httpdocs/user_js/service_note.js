$(document).ready(function(){

    $('#div_company_select').load('templates/company_combo.php');
    $('#div_service_select').load('templates/service_combo.php');
    $('#div_unit_select').load('templates/service_unit_combo.php');
    var balance;
    var tbl_child_service_note_list = $('#tbl_child_service_note_list').DataTable({
        searching: false,
        paging: false,
        info: false,
        ordering: false,
        columnDefs: [
            { targets: [1,2,3,6], visible: false } // Adjust column indices as needed
        ]
    });
    var list_of_service_note_table = $('#list_of_service_notes').DataTable( {searching: false, paging: false, info: false,"ordering": false});    
        
    tbl_child_service_note_list.on('draw', function () {
        tbl_child_service_note_list.cells().every(function (rowIdx, colIdx) {
            var column = this.column(colIdx);
            if ([0, 7, 8].includes(colIdx)) {
                $(column.nodes()).addClass('text-center');
            } 
        });
    });
    var list_of_cancelled_service_note_table = $('#list_of_cancel_service_notes').DataTable( {searching: false, paging: false, info: false,"ordering": false});    
        
        tbl_child_service_note_list.on('draw', function () {
        tbl_child_service_note_list.cells().every(function (rowIdx, colIdx) {
            var column = this.column(colIdx);
            if ([0, 7, 8].includes(colIdx)) {
                $(column.nodes()).addClass('text-center');
            } 
        });
    });
    
	$( '#btn_service_note_edit' ).hide();
    $('#btn_edit_service_note' ).hide();
	
    function formatDate(date) {
         var d = new Date(date),
             month = '' + (d.getMonth() + 1),
             day = '' + d.getDate(),
             year = d.getFullYear();
    
         if (month.length < 2) month = '0' + month;
         if (day.length < 2) day = '0' + day;
    
         return [year, month, day].join('-');
    }

    $("#btn_add_service").click(function(){
        load_data_to_grid_service_list();
        $("#modal_add_service").modal('show');
        $('#btn_save_service').text("SAVE");
        $('#txt_service_name').val('');
    });
    
    //  $('#tbl_child_service_note_list tbody').on('click', 'button.btn-danger', function() {
    //     table.row($(this).parents('tr')).remove().draw();
    // });
    
    $("#btn_save_service").click(function() {
        var serviceName = $("#txt_service_name").val().trim();
        var buttonText = $(this).text().trim();
        if (serviceName === "") { 
            swal('Warning', 'Please fill the required field', 'warning');
        } else {
            if(buttonText === "SAVE")
            {
                $.post("../controller/service_note/service_note_controller.php", 
                    { action: 'add_service_name', serviceName: serviceName },
                    function(result, status) {   
                    if (status === 'success') {
                        $.toast({
                            heading: 'Success',
                            text: 'New Service Item Added Successfully..',
                            showHideTransition: 'slide',
                            icon: 'success',
                            hideAfter: 5000
                        });
                        $("#txt_service_name").val('');
                        $('#div_service_select').load('templates/service_combo.php');
                        $('#service_select').load('templates/service_combo.php');
                         $("#modal_add_service").modal('hide');
                        // load_data_to_service_list();
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Something Went Wrong.',
                            showHideTransition: 'slide',
                            icon: 'error',
                            hideAfter: 5000
                        });
                    }
                });  
            } 
            else 
            {
                var ids = $('#hidden_id').val();
                $.post("../controller/service_note/service_note_controller.php", 
                    { action: 'edit_service_name', serviceName: serviceName,v_ids:ids },
                    function(result, status) {   
                    if (status === 'success') {
                        $.toast({
                            heading: 'Success',
                            text: 'Service Item Updated Successfully..',
                            showHideTransition: 'slide',
                            icon: 'success',
                            hideAfter: 5000
                        });
                        $("#txt_service_name").val('');
                        $('#div_service_select').load('templates/service_combo.php');
                        $('#service_select').load('templates/service_combo.php');
                         $("#modal_add_service").modal('hide');
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Something Went Wrong.',
                            showHideTransition: 'slide',
                            icon: 'error',
                            hideAfter: 5000
                        });
                    }
                });
            }
        }
    });
    function load_data_to_grid_service_list()
	{
		 tbl_service_list = $('#serviceTable').DataTable( {
				
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/service_note/service_note_controller.php',
					 'data': {
						action: 'service_list'
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
                    { "data": null,"width": '8%',"className": "text-center"},
                    { "data": "service_name","width": '30%'},
                    { "data": "status","width": "20%","className": "text-center",
                    "render": function (data, type, rows, meta) {
                            if (data === 'Active') {
                                return '<span class="badge rounded-pill bg-success text-white">' + data + '</span>';
                            } else {
                                return '<span class="badge rounded-pill bg-danger text-white">' + data + '</span>';
                            }
                        }
                    },
                    { "data": "ids", "width": "8%", "render": function (data, type, rows) {
                            return `
                                <div class="d-flex gap-4">
                                    <a href="javascript:void(0);" class="text-primary" id="edit_service_type" name="edit_service_type">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a href="javascript:void(0);" style="margin-left: 10px;" class="${rows['status'] === 'Active' ? 'text-info' : 'text-warning'}" id="change_status" name="change_status">
                                        <i class="material-icons">${rows['status'] === 'Active' ? 'thumb_up' : 'thumb_down'}</i>
                                    </a>
                                    <a href="javascript:void(0);" style="margin-left: 10px;" class="text-danger delete-service" id="delete_service_type" name="delete_service_type">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </div>`;
                        }
                    }
                ],
				 pageLength: 100,
				 searching: false,
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
					"displayLength": 15,
					
					"aoColumnDefs": [
					{ "bSortable": false, "aTargets": [  0,1,2,3] }, 
					
				],
		 });  
	}
	
	$('#serviceTable tbody').on('click','a', function () {
    	var service_list = $('#serviceTable').DataTable();
    	var $row = $(this).closest('tr');
    	var data = service_list.row($row).data();
    	v_id  = data.ids;
    	v_status = data.status;

    	if( $(this).attr("name") == 'edit_service_type' )
    	{
			 $('#btn_save_service').text("UPDATE");
			 $('#txt_service_name').val(data.service_name);
			 $('#hidden_id').val(v_id);
    	}
    	if($(this).attr("name")=='change_status')
    	{
    		 $.post("../controller/service_note/service_note_controller.php",{
    			 action : "change_status_service",
    			 v_ids :v_id, 
    			 v_status:v_status
    		},function(res){
    			swal("Success","Status updated successfully","success");
    			$('#div_service_select').load('templates/service_combo.php');
    			load_data_to_grid_service_list();
    		});  
        }
        if($(this).attr("name")=='delete_service_type')
    	{
    	    swal({
    			  title: "Do you want to delete the item?",
    			  icon: "warning",
    			  buttons: true,
    			  dangerMode: true,
    		})
    		.then((willDelete) => {
    		    if (willDelete) {
                    $.post("../controller/service_note/service_note_controller.php",{
                        action:"delete_service_type",
                        v_ids:v_id
                        
                    },function(result,status){
    				    if(result== 1)
    					{
    					    swal('Success', 'Your data is Deleted', 'success');
    					    $('#div_service_select').load('templates/service_combo.php');
                                	load_data_to_grid_service_list();
    					}
                    });
    		    } else {
    		        swal('Success', 'Your data is safe', 'success');
    		    }    
    		});
        }
    });
    $("#div_company_select").change(function() {
                      
        $('#txt_service_note_company_name').val($('option:selected', this).text()) ;
        $("#txt_service_note_company_id").val($('option:selected', this).val());
        var company_id=$('option:selected', this).val() ;
        
        $.post("../controller/service_note/service_note_controller.php",{action:'select_company_details_for_service_note',v_company_id:company_id},function(result,status){
            
            if(status=="success")
            {
                
            var obj= jQuery.parseJSON(result);
            $("#txt_service_note_company_id").val(obj.data[0].company_id);
            $("#txt_service_note_company_name").val(obj.data[0].company_name);
            $("#txt_service_note_po_box").val(obj.data[0].contact_address_1);
            $("#txt_service_note_contact_no").val(obj.data[0].contact_phone);
            $("#txt_service_note_fax").val(obj.data[0].fax);
            $("#txt_service_note_attn").val(obj.data[0].contact_person);

            var service_company_id=$("#txt_service_note_company_id").val();
           
            }
            else
            {
                return false;
            }
        });           
       
    });
    
    $('#btn_create_service_note').click(function(){
		location.reload();
	});	
	
	tbl_child_service_note_list.destroy();
    tbl_child_service_note_list = $('#tbl_child_service_note_list').DataTable({
        searching: false,
        paging: false,
        info: false,
        ordering: false,
        columnDefs: [
            { targets: [0,1,2,3,6], visible: false } // Adjust column indices as needed
        ]
    });
    var siCounter = 1;  
    $("#add_btn").click(function() {
        var desc = $('#description').val();
        var qty = $('#qty').val();
        var unit = $("#unit option:selected").text();
        var unitID = $("#unit option:selected").val();
        
        console.log('unit',unit);
        console.log('unitID',unitID);
        
        var v_service_note_company_name = $("#txt_service_note_company_name").val();
        var v_service_note_company_id = $("#txt_service_note_company_id").val();
        var v_service_type_name = $("#service_name option:selected").text();
        var v_service_type_id = $("#service_name option:selected").val();
      
        if (desc === '' || qty === '' || $.trim(v_service_note_company_id) == "0" ||$.trim(v_service_type_id) == "0" ||$.trim(unitID) == "0") {
            swal('Warning', 'Please fill the required fields', 'warning');
        } else {
            tbl_child_service_note_list.row.add([
                siCounter++,
                v_service_note_company_id,
                v_service_type_name,
                v_service_type_id,
                desc,
                qty,
                unit,
                '<button class="btn btn-danger btn-sm delete-row">Delete</button>' 
            ]).draw();

            $('#description').val('');
            $('#qty').val('');
            $('#unit').val('0').change();
        }
    });
    
    $('#tbl_child_service_note_list').on('click', '.delete-row', function() {
        var row = $(this).closest('tr');
        tbl_child_service_note_list.row(row).remove().draw(false);
    });
    
    $('#btn_generate_service_note').click(function(){
        var pass_no=$('#txt_service_note_no').val();
        var dataArray = [];
        var v_service_note_company_name = $("#txt_service_note_company_name").val();
        var v_service_note_company_id = $("#txt_service_note_company_id").val();
        var v_service_note_po_box = $("#txt_service_note_po_box").val();
        var v_service_note_contact_no = $("#txt_service_note_contact_no").val();
        var v_service_note_fax = $("#txt_service_note_fax").val();
        var v_service_note_attn = $("#txt_service_note_attn").val();
        var v_service_note_no = $("#txt_service_note_no").val();
        var v_service_note_date = formatDate($("#txt_service_note_date").val());
        var v_service_type_name = $("#service_name option:selected").text();
        var v_service_type_id = $("#service_name option:selected").val();
        console.log('dataArray:',dataArray);
        
        if($.trim(v_service_note_company_id) == "0" ||$.trim(v_service_note_po_box) == "" ||$.trim(v_service_note_contact_no) == "" ||$.trim(v_service_note_fax) == "" ||$.trim(v_service_note_attn) == "" ||$.trim(v_service_type_id) == "0") {
           
            swal("Warning", "Please provide all the details ....", "warning");
            return false;
        } 
        $('#tbl_child_service_note_list tbody tr').each(function() {
            var row = $(this);
            var rowData = tbl_child_service_note_list.row(row).data();
            console.log(rowData);
            dataArray.push({
                si: rowData[0],
                CompanyID: rowData[1],
                ServiceName: rowData[2],
                ServiceID: rowData[3],
                Description: rowData[4],
                Quantity: rowData[5],
                Unit: rowData[6]
            });
        });
        $.post("../controller/service_note/service_note_controller.php", {
            action: 'add_service_note',
            v_dataArray:dataArray,
            v_service_note_company_name: v_service_note_company_name,
            v_service_note_po_box: v_service_note_po_box,
            v_service_note_contact_no: v_service_note_contact_no,
            v_service_note_fax: v_service_note_fax,
            v_service_note_attn: v_service_note_attn,
            v_service_note_no: v_service_note_no,
            v_service_note_date: v_service_note_date,
            v_company_id: v_service_note_company_id,
            serviceName: v_service_type_name,
            v_service_type_id: v_service_type_id
        }, function(result, status) {
                 result = $.trim(result);
                var jsonEnd = result.indexOf('}') + 1;
                var jsonString = result.substring(0, jsonEnd);
                try {
                    var data = JSON.parse(jsonString);
                    // console.log("Parsed data:", data);
                    
                    var msgValue = data.msg;
                    // console.log("Extracted msg value:", msgValue);
                    if(result.charAt(0) == 'U') {
                        swal("Error", result, "error");
                        clear_text(); // Ensure this function is defined
                    } else {
                        $.toast({
                            heading: 'Success',
                            text: 'Item added to service note successfully!',
                            showHideTransition: 'slide',
                            icon: 'success'
                        });
                        $("#txt_service_note_no").val(msgValue);
                        $("#service_note_no_head").html(msgValue);
                        $("#txt_service_note_company_name, #txt_service_note_po_box, #txt_service_note_contact_no, #txt_service_note_fax, #txt_service_note_attn, #txt_service_note_no, #txt_service_note_date").prop("readonly", true);
                        $("#div_first :input").prop("disabled", true);
                        $("#div_second :input").prop("disabled", true);
                        $("#btn_generate_service_note").hide();
                        $("#btn_generate_service_note").prop("disabled", true);
                    }
                    
                } catch (e) {
                    console.error("JSON parsing error:", e);
                }
        });
    });
	
	$('#btn_view_list_of_cancelled_service_note').click(function(){
       load_data_to_grid_of_cancelled_service_note(); 
    });
	
	function load_data_to_grid_of_cancelled_service_note()
	{
	    
	    list_of_cancelled_service_note_table.destroy();
                         
        list_of_cancelled_service_note_table = $('#list_of_cancel_service_notes').DataTable({
                            
            "ajax": {
             'type': 'POST',
             'url': '../controller/service_note/service_note_controller.php',
             'data': {
                action: 'list_cancelled_service_note'
                
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
          
                { "data": "service_note_main_id"},
                { "data": 'service_note_date',
                    render: function (data, type, row) {
                        return data.split(' ')[0];
                    }
                },
                { "data": "service_note_number"},
                { "data": "company_name"},
                { "data": "service_name"},
			    {"data": "service_note_main_id",
                    render: function ( data, type, rows, meta ) {
					    order_action ='<button type="button" class="btn btn-sm btn-danger mr-1"  id="reinitialize_service_note" name="reinitialize_service_note" ><i class="material-icons ">refresh</i></button>';
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
        });
	}
	
	$('#list_of_cancel_service_notes tbody').on('click', 'td button', function (){
        var $row = $(this).closest('tr');
        var data = list_of_cancelled_service_note_table.row($row).data();
        v_ids  = data.service_note_main_id;
        v_service_note_no =data.service_note_number;
        console.log(data);
			if($(this).attr("name")=='reinitialize_service_note')
            { 
		        swal({
					  title: "Do you want to Reinitialize?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
				})
				.then((willDelete) => {
			    if (willDelete) {
					$.post("../controller/service_note/service_note_controller.php",{action:"reinitialize_service_note",v_ids:v_ids},function(result,status){
						if(status=='success')
						{
						    load_data_to_grid_of_cancelled_service_note(); 
						    load_data_to_grid_view_list_of_service_note(); 
							swal("Success","Reinitialize successfully...","success");
                        }
						else
						{
							swal('Error',"Something Went Wrong","error");	
						}
					});
				} 
				else {
					swal('Success', 'Your data is safe', 'success');
				}  
			});
		}
    }); list_of_service_note_table.destroy();
	
	function list_child_note(category,categoryid,item,itemid,itemCode,description,qty, stock, unit,childId)
    { 
        tbl_child_service_note_list.row.add([
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
        '<button class="btn btn-danger btn-sm delete-row">Delete</button>'
        
        ]).draw();
       
        // Attach click event handler to delete button
        $('#tbl_child_service_note_list').on('click', '.delete-row', function() {
            var row = $(this).closest('tr');
            tbl_child_service_note_list.row(row).remove().draw(false);
        });
    }
    
    $('#btn_view_list_of_service_note').click(function(){
       load_data_to_grid_view_list_of_service_note(); 
    });  
    
    function load_data_to_grid_view_list_of_service_note()
	{
	    if ($.fn.dataTable.isDataTable('#list_of_service_notes')) {
            $('#list_of_service_notes').DataTable().clear().destroy();
        }
        
        list_of_service_note_table = $('#list_of_service_notes').DataTable({
                            
            "ajax": {
             'type': 'POST',
             'url': '../controller/service_note/service_note_controller.php',
             'data': {
                action: 'list_service_note'
                
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
          
                { "data": "service_note_main_id"},
                { "data": 'service_note_date',
                    render: function (data, type, row) {
                        return data.split(' ')[0];
                    }
                },
                { "data": "service_note_number"},
                { "data": "company_name"},
                { "data": "service_name"},
			    {"data": "service_note_main_id",
                    render: function ( data, type, rows, meta ) {
					    order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2"  id="view_service_note" name="view_service_note" ><i class="material-icons ">remove_red_eye</i></button>';
				        return order_action;
                    },
				},
			    {"data": "service_note_main_id",
                    render: function ( data, type, rows, meta ) {
					    order_action = '<button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_service_note" name="delete_service_note" ><i class="material-icons ">delete</i></button>';
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
        });
	}

	$('#list_of_service_notes tbody').on('click', 'td button', function (){
        var $row = $(this).closest('tr');
        var data = list_of_service_note_table.row($row).data();
        v_ids  = data.service_note_main_id;
        v_service_note_no =data.service_note_number;
        console.log(data);
			if($(this).attr("name")=='delete_service_note')
            { 
		        swal({
					  title: "Do you want to delete the item?",
					  icon: "warning",
					  buttons: true,
					  dangerMode: true,
				})
				.then((willDelete) => {
			    if (willDelete) {
					$.post("../controller/service_note/service_note_controller.php",{action:"cancelled_service_note",v_ids:v_ids},function(result,status){
						if(status=='success')
						{
							swal("Success","Deleted successfully...","success");
							load_data_to_grid_view_list_of_service_note()
                        }
						else
						{
							swal('Error',"Something Went Wrong","error");	
						}
					});
				} 
				else {
					swal('Success', 'Your data is safe', 'success');
				}  
			});
		}
		if($(this).attr("name")=='view_service_note')
        { 
	        closeNavR();
		    tbl_child_service_note_list.clear().draw();
		    $("#btn_generate_service_note").hide();
		 	$("#select_company").val(data.company_id);
            $("#select_company").trigger("chosen:updated");
            $("#service_name").val(data.service_id);
            $("#service_name").trigger("chosen:updated");
            
            $("#txt_service_note_po_box").val(data.po_box);     
            $("#txt_service_note_contact_no").val(data.telephone_no);
            $("#txt_service_note_fax").val(data.fax);
            $("#txt_service_note_attn").val(data.attn);
            $("#txt_service_note_no").val(data.service_note_number);
            $("#service_note_no_head").html(data.service_note_number);
            counter = 1;
		    load_data_to_grid_to_second_table(v_service_note_no)
	    }
						 
    });
    
    function load_data_to_grid_to_second_table(v_service_note_no) {
        $.post("../controller/service_note/service_note_controller.php", {
            action: 'select_service_child_table_details',
            v_service_note_no: v_service_note_no
        }, function(result, status) {
            if (status === "success") {
                var obj = jQuery.parseJSON(result);
                obj.data.forEach(function(item) {
                    view_service_note_list_for_edit(
                        item.cat_id,
                        item.service_name,
                        item.service_id,
                        item.remarks,
                        item.quantity,
                        item.service_note_child_id,
                        item.service_note_number
                    );
                });
            } else {
                console.error("Failed to load data");
            }
        });
    }
    
    var tbl_child_service_note_list;
    tbl_child_service_note_list.destroy();
    tbl_child_service_note_list = $('#tbl_child_service_note_list').DataTable({
        searching: false,
        paging: false,
        info: false,
        ordering: false,
        columnDefs: [
            { targets: [1,2,3,6], visible: false } 
        ]
    });
    var counter = 1;
    function view_service_note_list_for_edit(categoryid, service, serviceid, remarks, qty, childID, servicenumber) {
        tbl_child_service_note_list.row.add([
            counter++,
            categoryid,
            service,
            serviceid,
            remarks,
            qty,
            unit,
            '<button class="btn btn-danger btn-sm del-row" data-id="' + childID + '">Delete</button>' + 
            '<button class="btn btn-primary btn-sm update-row" data-id="' + childID + '" data-servicenumber="' + servicenumber + '" style="margin-left: 10px;">Edit</button>'
        ]).draw();
    }
    
    $('#tbl_child_service_note_list').on('click', '.del-row', function() {
        var childID = $(this).data('id');
        var row = $(this).closest('tr');
        swal({
			  title: "Do you want to delete the item?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
		})
		.then((willDelete) => {
		    if (willDelete) {
                $.post("../controller/service_note/service_note_controller.php",{action:"delete_child_service_note",v_ids:childID},function(result,status){
				    if(result== 1)
					{
                        tbl_child_service_note_list.row(row).remove().draw(false);
					}
                });
		    }else
		    {
		       swal('Success', 'Your data is safe', 'success');
		    }
		});
    });
    $('#tbl_child_service_note_list').on('click', '.update-row', function() {
        var row = $(this).closest('tr'); 
        var rowData = tbl_child_service_note_list.row(row).data();
        console.log('rowData:',rowData);
        var description = rowData[4];
        var qty = rowData[5];
        
        var descriptionInput = '<input type="text" class="form-control" value="' + description + '" name="description">';
        var qtyInput = '<input type="number" class="form-control" min=0 value="' + qty + '" name="qty">';

        row.find('td:eq(1)').html(descriptionInput); 
        row.find('td:eq(2)').html(qtyInput); 
    
        $(this).text('Save').removeClass('update-row').addClass('save-row');
    });
    
    $('#tbl_child_service_note_list').on('click', '.save-row', function() {
        var row = $(this).closest('tr');
        var remarks = row.find('input[name="description"]').val(); 
        var qty = row.find('input[name="qty"]').val(); 
            console.log("Changed description: " + remarks);
            console.log("Changed qty: " + qty);
        var rowData = tbl_child_service_note_list.row(row).data();
        var childID = $(this).data('id'); 
        var servicenumber = $(this).data('servicenumber');
        console.log('childID:',childID);
        console.log('servicenumber:',servicenumber);
        $.post("../controller/service_note/service_note_controller.php",{action:"update_child_service_note", v_ids:childID, v_qty:qty, v_remarks:remarks},function(result,status){
    	    if(result== 1)
    	    console.log(result);
    		{
    		  swal("Success","Updated successfully", "success");
                tbl_child_service_note_list.clear().draw();
                counter = 1;
                load_data_to_grid_to_second_table(servicenumber);
    		}
        });
    });
    
    $("#btn_service_note_print_without_head").click(function()
    {
        var serviceNote = $('#txt_service_note_no').val();
       
        if($.trim(serviceNote)=="")
        {
             $.toast({
                            heading: 'Error',
                            text: 'Please select or create order for print',
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
            return false;
        }
        else
           {
              window.open("reports/pdf/print/service_note_print.php?service_note_number="+serviceNote+"&x=1","_blank"); 
           }
    });
    
    $("#btn_service_note_pass_print_with_head").click(function()
	{
        var serviceNote=$('#txt_service_note_no').val();
        if($.trim(serviceNote)=="")
        {
            $.toast({
                heading: 'Error',
                text: 'Please select or create order for print',
                showHideTransition: 'slide',
                icon: 'error'
            });
            return false;
        }
        else
           {
              
			  window.open("reports/pdf/print/service_note_print.php?service_note_number="+serviceNote+"&x=0","_blank"); 
           }
	});
});