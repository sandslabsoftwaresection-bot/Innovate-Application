// $(document).ready(function(){
//   var project_text;
//     $('#div_company_select').load('templates/company_combo.php');
//     var tbl_accounts_list_table = $('#tbl_accounts_list').DataTable( {});
// 	 $("#div_company_select").change(function() {
	     
// 	      var company_id=$('option:selected', this).val() ;
// 	      $('#div_project_select_combo').load('templates/project_combo.php?v_company_id='+company_id);
	     
// 	 });
// 	 $("#div_project_select_combo").change(function() { 
	      
// 	      var project_id=$('option:selected', this).val() ;
// 	      project_text = $('option:selected', this).text() ;
	      
// 	      $('#div_select_quotation').load('templates/quotation_combo.php?v_project_id='+project_id);
	      
// 	 });
// 	 $("#div_select_quotation").change(function() { 
// 	     var quotation_id=$('option:selected', this).val() ;
// 	     var quotation_number=$('option:selected', this).text() ;
// 	     var v_project_id = $('#div_project_select_combo option:selected').val();
// 	        $("#div_project_name").text(project_text);  
	         
// 	                load_data_to_grid_accounts_list(quotation_number,v_project_id);
	 
// 	 }); 
	 
	 
	 
	 
// 	 function load_data_to_grid_accounts_list(quotation_number,v_project_id) {
//     alert("function  :" + quotation_number);

//     tbl_accounts_list_table.destroy();

//     tbl_accounts_list_table = $('#tbl_accounts_list').DataTable({
//         "ajax": {
//             'type': 'POST',
//             'url': '../controller/accounts/accounts_controller.php',
//             'data': {
//                 action: 'list_accounts_history',
//                 v_quotation_number: quotation_number,
//                 v_project_id:v_project_id
//             }
//         },
//         "language": {
//             "zeroRecords": "No records available",
//             "infoEmpty": "No records available",
//         },
//         "order": [[1, "asc"]], // Grouping by account_head
//         "bPaginate": false,
//         "bLengthChange": false,
//         "bFilter": false,
//         "bInfo": false,
//         "autoWidth": false,
//         "columns": [
//             { "data": null }, // Serial number
//             { "data": "account_head" },
//             {
//                 "data": "ids",
//                 render: function (data, type, row) {
//                     if (row['account_head'] === 'Contract Amount' || data === 'Tax Income') {
//                         return row['quotation_number'];
//                     } else {
//                         return row['invoice_number'];
//                     }
//                 }
//             },
//             { "data": "accounts_date" },
//             { "data": "credit_amount",
//                   render: function (data, type, row) {
//                     if (row['credit_amount'] != 0) {
//                         return row['credit_amount'];
//                     } else {
//                         return row['debit_amount'];
//                     }
//                 }
                
                
//             },
//             { "data": "debit_amount", "visible": false },
//         ],
//         pageLength: 25,
//         searching: false,
//         responsive: true,

//         "fnRowCallback": function (nRow, aData, iDisplayIndex) {
//             $("td:eq(0)", nRow).html(iDisplayIndex + 1);
//             return nRow;
//         },

//         "drawCallback": function (settings) {
//             var api = this.api();
//             var rows = api.rows({ page: 'current' }).nodes();
//             var data = api.rows({ page: 'current' }).data();

//             let lastGroup = null;
//             let groupCredit = 0;
//             let groupDebit = 0;

//             api.rows({ page: 'current' }).every(function (rowIdx, tableLoop, rowLoop) {
//                 var rowData = this.data();
//                 var group = rowData.account_head;

//                 var credit = parseFloat(rowData.credit_amount) || 0;
//                 var debit = parseFloat(rowData.debit_amount) || 0;

//                 if (lastGroup !== group) {
//                     // If it's a new group, insert a header before the row
//                     $(rows).eq(rowIdx).before(
//                         `<tr class="group-header" style="background-color: #f2f2f2; font-weight: bold;">
//                             <td colspan="6">Account Head: ${group}</td>
//                         </tr>`
//                     );

//                     // Reset totals
//                     groupCredit = 0;
//                     groupDebit = 0;

//                     lastGroup = group;
//                 }

//                 groupCredit += credit;
//                 groupDebit += debit;

//                 // If it's the last row OR next row is a different group, add total row
//                 var nextData = data[rowIdx + 1];
//                 var nextGroup = nextData ? nextData.account_head : null;

//                 if (nextGroup !== group) {
//                     $(rows).eq(rowIdx).after(
//                         `<tr class="group-total" style="background-color: #e0e0e0; font-weight: bold;">
//                             <td colspan="4" style="text-align: right;">Total for ${group}:</td>
//                             <td>${groupCredit.toFixed(2)}</td>
//                             <td>${groupDebit.toFixed(2)}</td>
//                         </tr>`
//                     );
//                 }
//             });
//         }
//     });
// }




//   $("#btn_account_add").click(function(){
      
//       v_company_id= $("#div_company_select option:selected").val();
//       v_comapny_name = $("#div_company_select option:selected").text();
      
//       project_id=$('#div_project_select_combo option:selected').val() ;
// 	  project_text = $('#div_project_select_combo option:selected').text() ;
      
//       account_type = $("#select_account_type option:selected").text();
//       v_amount = $("#txt_account_amount").val();
//       v_account_date = $("#txt_account_date").val();
      
//       $.post("../controller/accounts/accounts_controller.php",{action:"add_salary_mis_account",v_company_id:v_company_id,v_comapny_name:v_comapny_name,project_id:project_id,project_text:project_text,account_type:account_type,v_amount:v_amount},function(result,res){
          
//       })
      
//   })

	 
// });

$(document).ready(function(){
    var project_text;
    
    // Initially hide both figures sections
    $('#figures_project').hide();
    $('#figures_quotation').hide();
    
    $('#div_company_select').load('templates/company_combo.php');
    
    $("#div_company_select").change(function() {
        // Hide both with animation
        $('#figures_project').hide(1000);
        $('#figures_quotation').hide(1000);
        
        var company_id = $('option:selected', this).val();
        $('#div_project_select_combo').load('templates/project_combo.php?v_company_id=' + company_id);
    });
    
    $("#div_project_select_combo").change(function() {
        // Hide quotation card but keep project card if already shown
        $('#figures_quotation').hide(1000);
        
        var project_id = $('option:selected', this).val();
        var company_id = $('#div_company_select option:selected').val(); // Get selected company ID
        project_text = $('option:selected', this).text();
        
        // Show project financials
        $('#figures_project').hide(0, function() {
            $('#figures_project').show(1000);
        });
        
        // Load project financial summary with company ID
        load_project_financial_summary(project_id, company_id);
        
        // Load quotation combo
        $('#div_select_quotation').load('templates/quotation_combo.php?v_project_id=' + project_id);
    });
    
    $("#div_select_quotation").change(function() {
        var quotation_id = $('option:selected', this).val();
        var quotation_number = $('option:selected', this).text();
        var v_project_id = $('#div_project_select_combo option:selected').val();
        v_company_id = $("#div_company_select option:selected").val();
        // Show quotation financials
        $('#figures_quotation').hide(0, function() {
            $('#figures_quotation').show(1000);
        });
        
        // Load quotation financial summary
        load_quotation_financial_summary(v_project_id, quotation_number,v_company_id);
    });
    
    function load_project_financial_summary(v_project_id, v_company_id) {
        $.post("../controller/accounts/accounts_controller.php", {
            action: 'get_project_financial_summary',
            v_project_id: v_project_id,
            v_company_id: v_company_id // Pass company ID here
        }, function(data, status) {
            var financialData = JSON.parse(data);
            displayProjectFinancialSummary(financialData);
        });
    }
    
    function load_quotation_financial_summary(v_project_id, quotation_number,v_company_id) {
        $.post("../controller/accounts/accounts_controller.php", {
            action: 'get_quotation_financial_summary',
            v_project_id: v_project_id,
            v_quotation_number: quotation_number,
            v_company_id: v_company_id
        }, function(data, status) {
            var financialData = JSON.parse(data);
            displayQuotationFinancialSummary(financialData, quotation_number);
        });
    }
    
    function displayProjectFinancialSummary(data) {
        var summaryContainer = $('#financial_summary_project_container');
        summaryContainer.empty();
    
        // ---------------------------
        // Calculations
        // ---------------------------
    
        // 1st Row (Project Value)
        let projectValue = parseFloat(data.contract_value) || 0;
        let projectVat = projectValue * 0.10;
        let projectTotal = projectValue + projectVat;
    
        // 3rd Row (Received Amount)
        let receivedAmount = parseFloat(data.received_amount) || 0;
        let receivedVat = receivedAmount * 0.10;
        let receivedTotal = receivedAmount + receivedVat;
    
        // 2nd Row (Net Balance)
        let netBalance = projectTotal - receivedTotal;
    
        // 4th Row (Expenses)
        let expense = parseFloat(data.expense) || 0;
        let expenseVat = expense * 0.10;
        let expenseTotal = expense + expenseVat;
    
        // 5th Row (Margin)
        let margin = receivedAmount - expense;
        let marginPercent = (margin / receivedAmount) * 100;
        // 6th Row (VAT Calculations)
        let totalSalesVat = projectVat;
        let totalExVat = expenseVat;
        let vatPayable = totalSalesVat - totalExVat;
    
        // ---------------------------
        // UI Rendering
        // ---------------------------
        var summaryCard = `
            <div class="card mb-3">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100">
                        <figure class="avatar avatar-40 rounded-circle align-self-start">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0 text-white">Project Financial Summary</h5>
                            <p class="mb-0 text-white">Project: ${$("#div_project_select_combo option:selected").text()}<span class="status bg-success"></span></p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary drop_shadow py-2" role="alert" style="padding-left:20px; padding-right:20px;">
                        <div class="row mb-1">
                            <div class="col-lg-8 col-md-8" style="padding-left:15px; padding-right:15px;">
                                <h5 class="alert-heading mb-1">Project: <span id="span_project_name">${$("#div_project_select_combo option:selected").text()}</span></h5>
                            </div>
                            <div class="col-lg-4 col-md-4" style="text-align: right; padding-right: 15px;">
                                <button type="button" class="btn btn-sm alert-primary p-1" id="hide_me_top_project">X</button>
                            </div>
                        </div>
    
                        <!-- First Row -->
                        <div class="row mb-1">
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Project Value</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(projectValue)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">VAT 10%</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(projectVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total Amount</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(projectTotal)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <!-- Second Row -->
                        <div class="row mb-1">
                            <div class="col-lg-8 col-md-8"></div>
                            <div class="col-lg-3 col-md-3" style="text-align: left; style">
                                <span style="font-size:13px;">NET BALANCE</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(netBalance)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <!-- Third Row -->
                        <div class="row mb-1">
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Received Amount</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(receivedAmount)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">VAT 10%</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(receivedVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total Amount</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(receivedTotal)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
                        <br><br>
                        <!-- Fourth Row -->
                        <div class="row mb-1">
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Expenses</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(expense)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">VAT 10%</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(expenseVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total Amount</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(expenseTotal)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <!-- Fifth Row -->
                        <div class="row mb-1">
                            <div class="col-lg-8 col-md-8"></div>
                            <div class="col-lg-3 col-md-3" style="text-align: left;">
                                <span style="font-size:13px;">MARGIN</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(margin)}  ( ${formatCurrency(marginPercent)} % ) </span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <!-- Sixth Row -->
                        <div class="row mb-1">
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total Sales VAT</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(totalSalesVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total EX VAT 10%</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(totalExVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">VAT Payable</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(vatPayable)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-lg-10 col-md-10">
                                <p class="mb-0" style="font-size: 12px;">The present financials of the selected project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
    
        summaryContainer.html(summaryCard);
    
        // Close button
        $("#hide_me_top_project").click(function () {
            $('#figures_project').hide(1000);
        });
    }


    
    function displayQuotationFinancialSummary(data, quotation_number) {
        var summaryContainer = $('#financial_summary_quotation_container');
        summaryContainer.empty();
    
        // ---------------------------
        // Calculations
        // ---------------------------
    
        // Contract Value
        let contractValue = parseFloat(data.contract_value) || 0;
        let contractVat = contractValue * 0.10;
        let contractTotal = contractValue + contractVat;
    
        // Received Amount
        let receivedAmount = parseFloat(data.received_amount) || 0;
        let receivedVat = receivedAmount * 0.10;
        let receivedTotal = receivedAmount + receivedVat;
    
        // Net Balance
        let netBalance = contractTotal - receivedTotal;
    
        // Expenses
        let expense = parseFloat(data.expense) || 0;
        let expenseVat = expense * 0.10;
        let expenseTotal = expense + expenseVat;
    
        // Margin
        let margin = receivedAmount - expense;
    
        // VAT calculations
        let totalSalesVat = contractVat;
        let totalExVat = expenseVat;
        let vatPayable = totalSalesVat - totalExVat;
    
        // ---------------------------
        // UI Rendering
        // ---------------------------
        var summaryCard = `
            <div class="card mb-3">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100">
                        <figure class="avatar avatar-40 rounded-circle align-self-start">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Logo">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0 text-white">Quotation Financial Summary</h5>
                            <p class="mb-0 text-white">Quotation: ${quotation_number}<span class="status bg-success"></span></p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary drop_shadow py-2" role="alert" style="padding-left:20px; padding-right:20px;">
                        <div class="row mb-1">
                            <div class="col-lg-9 col-md-9">
                                <h5 class="alert-heading mb-1">Quotation: <span id="span_quotation_number">${quotation_number}</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3" style="text-align: right;">
                                <button type="button" class="btn btn-sm alert-primary p-1" id="hide_me_top_quotation">X</button>
                            </div>
                        </div>
    
                        <!-- First Row: Contract Value -->
                        <div class="row mb-1">
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Contract Value</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(contractValue)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">VAT 10%</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(contractVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total Amount</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(contractTotal)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <!-- Second Row: Net Balance -->
                        <div class="row mb-1">
                            <div class="col-lg-8 col-md-8"></div>
                            <div class="col-lg-3 col-md-3" style="text-align: left;">
                                <span style="font-size:13px;">NET BALANCE</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(netBalance)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <!-- Third Row: Received Amount -->
                        <div class="row mb-1">
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Received Amount</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(receivedAmount)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">VAT 10%</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(receivedVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total Amount</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(receivedTotal)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
                        <br><br>
                        <!-- Fourth Row: Expenses -->
                        <div class="row mb-1">
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Expense</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(expense)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">VAT 10%</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(expenseVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total Amount</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(expenseTotal)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <!-- Fifth Row: Margin -->
                        <div class="row mb-1">
                            <div class="col-lg-8 col-md-8"></div>
                            <div class="col-lg-3 col-md-3" style="text-align: left;">
                                <span style="font-size:13px;">MARGIN</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(margin)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <!-- Sixth Row: VAT Summary -->
                        <div class="row mb-1">
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total Sales VAT</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(totalSalesVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">Total EX VAT 10%</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(totalExVat)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <span style="font-size:13px;">VAT Payable</span>
                                <h5 class="mb-0"><span class="badge badge-info">${formatCurrency(vatPayable)}</span> <span style="font-size:10px;">BD</span></h5>
                            </div>
                        </div>
    
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-lg-10 col-md-10">
                                <p class="mb-0" style="font-size: 12px;">The present financials of the selected quotation</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
    
        summaryContainer.html(summaryCard);
    
        // Close button
        $("#hide_me_top_quotation").click(function () {
            $('#figures_quotation').hide(1000);
        });
    }



    
    function formatCurrency(amount) {
        return parseFloat(amount).toLocaleString('en-US', {
            minimumFractionDigits: 3,
            maximumFractionDigits: 3
        });
    }
    
    $("#btn_account_add").click(function() {
        v_company_id = $("#div_company_select option:selected").val();
        v_comapny_name = $("#div_company_select option:selected").text();
        
        project_id = $('#div_project_select_combo option:selected').val();
        project_text = $('#div_project_select_combo option:selected').text();
        
        account_type = $("#select_account_type option:selected").text();
        v_amount = $("#txt_account_amount").val();
        v_account_date = $("#txt_account_date").val();
      
        
        $.post("../controller/accounts/accounts_controller.php", {
            action: "add_salary_mis_account",
            v_company_id: v_company_id,
            v_comapny_name: v_comapny_name,
            project_id: project_id,
            project_text: project_text,
            account_type: account_type,
            v_amount: v_amount
            
        }, function(result, res) {
            // Refresh data after adding
            var project_id = $('#div_project_select_combo option:selected').val();
            var quotation_number = $('#div_select_quotation option:selected').text();
            
            if (project_id) {
                load_project_financial_summary(project_id);
            }
            
            if (quotation_number && quotation_number !== "Select Quotation") {
                load_quotation_financial_summary(project_id, quotation_number,v_company_id);
            }
        });
    });
});