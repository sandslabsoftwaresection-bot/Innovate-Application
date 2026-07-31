$(document).ready(function(){
  var project_text;
  var company_id ,project_id;
    $('#div_company_select').load('templates/company_combo.php');
    
    var tbl_accounts_list_table = $('#tbl_product_master_list').DataTable({});
    
	 $("#div_company_select").change(function() {
	     
	      company_id=$('option:selected', this).val() ;
	      $('#div_project_select_combo').load('templates/project_combo.php?v_company_id='+company_id);
	     
	 });
	 $("#div_project_select_combo").change(function() { 
	      
	      project_id=$('option:selected', this).val() ;
	      project_text = $('option:selected', this).text() ;
	      
	      $('#div_select_quotation').load('templates/quotation_combo.php?v_project_id='+project_id);
	      load_data_to_grid_accounts_list(company_id,project_id)
	 });
// 	 $("#div_select_quotation").change(function() { 
// 	     var quotation_id=$('option:selected', this).val() ;
// 	     var quotation_number=$('option:selected', this).text() ;
// 	     var v_project_id = $('#div_project_select_combo option:selected').val();
// 	        $("#div_project_name").text(project_text);  
	         
// 	                load_data_to_grid_accounts_list(quotation_number,v_project_id);
	 
// 	 }); 
	 
	 
	 
	 
	 function load_data_to_grid_accounts_list(v_company_id,project_id) {
    
    tbl_accounts_list_table.destroy();

    tbl_accounts_list_table = $('#tbl_product_master_list').DataTable({
        "ajax": {
            'type': 'POST',
            'url': '../controller/accounts/accounts_controller.php',
            'data': {
                action: 'list_accounts_history_expense',
                v_company_id: v_company_id,
                project_id:project_id
            }
        },
        "language": {
            "zeroRecords": "No records available",
            "infoEmpty": "No records available",
        },
        "order": [[1, "asc"]], // Grouping by account_head
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "autoWidth": false,
        "columns": [
            { "data": null }, // Serial number
            
            { "data": "account_head" },
             {"data":"description"},
            { "data": "accounts_date" },
            { "data": "credit_amount",
                  render: function (data, type, row) {
                    if (row['credit_amount'] != 0) {
                        return row['credit_amount'];
                    } else {
                        return row['debit_amount'];
                    }
                }
                
                
            },
            { "data": "ids",
                  render: function ( data, type, rows, meta ) {
					
								str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_expense" name="edit_expense" ><i class="material-icons ">edit</i></button>';
							
							return str_active_status_view;

						 },
    	       },
    	       { "data": "ids",
                  render: function ( data, type, rows, meta ) {
					
								str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_expense" name="delete_expense" ><i class="material-icons ">delete</i></button>';
							
							return str_active_status_view;

						 },
    	       }
        ],
        pageLength: 25,
        searching: false,
        responsive: true,

        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            $("td:eq(0)", nRow).html(iDisplayIndex + 1);
            return nRow;
        },

        
    });
}

function load_account_types() {
    $.ajax({
        type: 'POST',
        url: '../controller/accounts/accounts_controller.php',
        data: {action: 'list_account_heads'},
        dataType: 'json',
        success: function(data) {
            var options = '<option value="">Select Account Type</option><option value="add_new">Add New Account Type</option>';
            $.each(data, function(index, item) {
                if(item.status === 'Active') {
                    options += '<option value="' + item.account_head_name + '">' + item.account_head_name + '</option>';
                }
            });
            $('#select_account_type').html(options);
            $('#select_account_type').selectpicker('refresh');
        }
    });
}

load_account_types();

$('#select_account_type').change(function(){
    if($(this).val() === 'add_new') {
        $('#modal_account_head').modal('show');
        load_account_heads_table();
        $(this).val('');
        $(this).selectpicker('refresh');
    }
});

$('#modal_account_head').on('hidden.bs.modal', function () {
    $('#txt_account_head_name').val('');
    $('#account_head_error_msg').html('');
});

function load_account_heads_table() {
    if($.fn.DataTable.isDataTable('#tbl_account_heads')) {
        $('#tbl_account_heads').DataTable().destroy();
    }
    $('#tbl_account_heads').DataTable({
        ajax: {
            type: 'POST',
            url: '../controller/accounts/accounts_controller.php',
            data: {action: 'list_all_account_heads'}
        },
        columns: [
            { data: null },
            { data: 'account_head_name' },
            { data: 'status' },
            { 
              data: null,
              render: function(data, type, row) {
                  // Thumbs up if Active, thumbs down if Inactive
                  var toggleIcon = (row.status === 'Active') 
                      ? '<button class="btn btn-sm btn-success toggle-status" data-id="' + row.ids + '"><i class="material-icons">thumb_up</i></button>'
                      : '<button class="btn btn-sm btn-warning toggle-status" data-id="' + row.ids + '"><i class="material-icons">thumb_down</i></button>';
            
                  // Trash icon for delete
                  var deleteBtn = '<button class="btn btn-sm btn-danger delete-head ml-1" data-id="' + row.ids + '"><i class="material-icons">delete</i></button>';
            
                  return toggleIcon + ' ' + deleteBtn;
              }
            }
        ],
        fnRowCallback: function(nRow, aData, iDisplayIndex) {
            $('td:eq(0)', nRow).html(iDisplayIndex + 1);
            return nRow;
        },
        pageLength: 10,
        searching: false,
        responsive: true,
        bPaginate: false, // Disable pagination
        bInfo: false      // Disable info
    });
}

$('#btn_save_account_head').click(function(){
    var name = $('#txt_account_head_name').val().trim();
    if(name === '') {
        swal("Warning", "Please enter account head name", "warning");
        return;
    }
    $.post('../controller/accounts/accounts_controller.php', {
        action: 'add_account_head',
        name: name
    }, function(result){
        if(result > 0) {
            swal("Success", "Account head added", "success");
            $('#txt_account_head_name').val('');
            load_account_heads_table();
            load_account_types();
        } else {
            swal("Error", "Failed to add", "error");
        }
    });
});

$(document).on('click', '.toggle-status', function(){
    var id = $(this).data('id');
    $.post('../controller/accounts/accounts_controller.php', {
        action: 'toggle_account_head_status',
        id: id
    }, function(result){
        if(result == 1) {
            load_account_heads_table();
            load_account_types();
        }
    });
});

$(document).on('click', '.delete-head', function(){
    var id = $(this).data('id');
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this account head!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.post('../controller/accounts/accounts_controller.php', {
                action: 'delete_account_head',
                id: id
            }, function(result){
                if(result == 1) {
                    swal("Success", "Account head deleted", "success");
                    load_account_heads_table();
                    load_account_types();
                } else {
                    swal("Error", "Failed to delete", "error");
                }
            });
        }
    });
});


 $("#btn_account_add").click(function(){
    // Trim all input values to remove leading/trailing spaces
    var v_company_id   = $("#div_company_select option:selected").val().trim();
    var v_comapny_name = $("#div_company_select option:selected").text().trim();
    var project_id     = $('#div_project_select_combo option:selected').val().trim();
    var project_text   = $('#div_project_select_combo option:selected').text().trim();
    var account_type   = $("#select_account_type").val().trim();
    var v_amount       = $("#txt_account_amount").val().trim();
    var v_account_date = $("#txt_account_date").val().trim();
    var quotation_id   = $("#div_select_quotation option:selected").val().trim();
    var quotation_number = $("#div_select_quotation option:selected").text().trim();
    var v_description=$("#txt_narration").val();
    // Validate inputs
    if(v_company_id === '0' || project_id === '0' || account_type === '' || v_amount === '' || quotation_id === '0') {
        swal("Warning", "Please fill all the fields", "warning");
        return false;
    }

    // Log the data being sent for debugging
    console.log("AJAX Data:", {
        action: "add_salary_mis_account",
        v_company_id: v_company_id,
        v_comapny_name: v_comapny_name,
        project_id: project_id,
        project_text: project_text,
        account_type: account_type,
        v_amount: v_amount,
        v_account_date: v_account_date,
        quotation_id: quotation_id,
        quotation_number: quotation_number,
        v_description:v_description
    });

    // Send AJAX request
    $.post("../controller/accounts/accounts_controller.php", {
        action: "add_salary_mis_account",
        v_company_id: v_company_id,
        v_comapny_name: v_comapny_name,
        project_id: project_id,
        project_text: project_text,
        account_type: account_type,
        v_amount: v_amount,
        v_account_date: v_account_date,
        quotation_id: quotation_id,
        quotation_number: quotation_number,
        v_description:v_description
    }, function(result, res){
        if(result > 0) {
            swal("Success", "Expenses added to the list", "success");
            load_data_to_grid_accounts_list(v_company_id, project_id);
        } else {
            swal("Error", "Failed to add expense", "error");
        }
    });
});


});