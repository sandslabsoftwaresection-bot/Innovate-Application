$(document).ready(function () {
    console.log("Statement of Accounts JS loaded ✅");

    // -------------------------
    // Populate Company Dropdown
    // -------------------------
    $.ajax({
        url: '../controller/accounts/accounts_controller.php',
        type: 'POST',
        data: { action: 'get_companies' },
        success: function (response) {
            try {
                let companies = JSON.parse(response);
                $('#company_select').append('<option value="">All Companies</option>');
                companies.forEach(function (comp) {
                    $('#company_select').append(`<option value="${comp.company_id}">${comp.company_name}</option>`);
                });
            } catch (e) {
                console.error("Error parsing companies:", e);
            }
        },
        error: function (xhr) {
            console.error("AJAX error fetching companies:", xhr.responseText);
        }
    });

    // -------------------------
    // Date Pickers (Single Date)
    // -------------------------
    $('#from_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: { format: 'YYYY-MM-DD' }
    }, function (start) {
        $('#from_date').val(start.format('YYYY-MM-DD'));
    });

    $('#to_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: { format: 'YYYY-MM-DD' }
    }, function (start) {
        $('#to_date').val(start.format('YYYY-MM-DD'));
    });

    // -------------------------
    // Filter Button
    // -------------------------
    $(document).on('click', '#filter_btn', function () {
        console.log("Filter clicked ✅");
        if ($('#from_date').val() || $('#to_date').val() || $('#company_select').val()) {
            // Destroy existing DataTable if it exists
            if ($.fn.DataTable.isDataTable('#statement_table')) {
                $('#statement_table').DataTable().destroy();
                $('#statement_table tbody').empty();
            }
            // Load DataTable
            loadStatementTable();
        } else {
            alert('Please select at least one filter (company or date).');
        }
    });

    // -------------------------
    // Reset Button
    // -------------------------
    $(document).on('click', '#reset_btn', function () {
        console.log("Reset clicked ✅");
        $('#company_select').val('');
        $('#from_date').val('');
        $('#to_date').val('');
        // Destroy DataTable and clear table body
        if ($.fn.DataTable.isDataTable('#statement_table')) {
            $('#statement_table').DataTable().destroy();
            $('#statement_table tbody').empty();
        }
    });

    // -------------------------
    // PDF Button Click Handler
    // -------------------------
    $(document).on('click', '#pdf_btn', function () {
        const companyId = $('#company_select').val();
        const fromDate = $('#from_date').val();
        const toDate = $('#to_date').val();
        
        // Open PDF in new window with parameters
        window.open(`reports/pdf/print/soa.php?company_id=${companyId}&from_date=${fromDate}&to_date=${toDate}`, '_blank');
    });

    // Child row format function
    function formatChildRow(data) {
        return '<div style="padding: 15px;">Description: ' + data.type + '</div>';
    }

    function loadStatementTable() {
        let runningBalance = 0; // Initialize running balance
        let firstContractProcessed = false; // Flag to track the first Contract Amount row

        $('#statement_table').DataTable({
            processing: true,
            ajax: {
                url: '../controller/accounts/accounts_controller.php',
                type: 'POST',
                data: function (d) {
                    d.action = 'list_statement_of_accounts';
                    // Pass the filter values
                    if ($('#company_select').val()) {
                        d.company_id = $('#company_select').val();
                    }
                    if ($('#from_date').val()) {
                        d.from_date = $('#from_date').val(); // Already in YYYY-MM-DD format
                    }
                    if ($('#to_date').val()) {
                        d.to_date = $('#to_date').val(); // Already in YYYY-MM-DD format
                    }
                    
                    // For debugging - check what is being sent
                    console.log("Sending to server:", {
                        company_id: d.company_id,
                        from_date: d.from_date,
                        to_date: d.to_date
                    });
                },
                dataSrc: function (json) {
                    // Add index to each row for serial number
                    json.data.forEach(function (row, index) {
                        row.sl_no = index + 1;
                    });
                    return json.data;
                },
                error: function (xhr) {
                    console.error("DataTable AJAX error:", xhr.responseText);
                }
            },
            createdRow: function (row, data, dataIndex) {
                // Calculate running balance for each row
                if (data.account_head === 'Contract Amount') {
                    // Reset balance only for the first Contract Amount row
                    if (!firstContractProcessed) {
                        runningBalance = 0;
                        firstContractProcessed = true; // Set flag after first reset
                    }
                } else {
                    runningBalance += (parseFloat(data.debit_amount || 0) - parseFloat(data.credit_amount || 0));
                }
                // Update the balance cell (column 8) with the calculated value
                $('td:eq(8)', row).html('BD ' + runningBalance.toFixed(3));
            },
            columns: [
                {
                    data: 'sl_no',
                    className: 'details-control',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'accounts_date',
                    render: function (data) {
                        return moment(data).format('DD/MM/YYYY'); // Format date to dd/mm/yyyy
                    }
                },
                { data: 'invoice_number' },
                { data: 'account_head' },
                { data: 'reference_no' },
                {
                    data: 'contract_value',
                    render: function (data) {
                        return data > 0 ? 'BD ' + parseFloat(data).toFixed(3) : ''; // Add BD prefix, show empty if 0
                    }
                },
                {
                    data: 'debit_amount',
                    render: function (data) {
                        return data > 0 ? 'BD ' + parseFloat(data).toFixed(3) : ''; // Add BD prefix, show empty if 0
                    }
                },
                {
                    data: 'credit_amount',
                    render: function (data) {
                        return data > 0 ? 'BD ' + parseFloat(data).toFixed(3) : ''; // Add BD prefix, show empty if 0
                    }
                },
                {
                    data: null, // Balance will be calculated dynamically
                    defaultContent: '' // Initial empty content, will be updated in createdRow
                }
            ],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();

                // Calculate totals for the current page
                var contractTotal = api.column(5, { page: 'current' }).data()
                    .reduce((a, b) => parseFloat(a) + parseFloat(b || 0), 0);
                var debitTotal = api.column(6, { page: 'current' }).data()
                    .reduce((a, b) => parseFloat(a) + parseFloat(b || 0), 0);
                var creditTotal = api.column(7, { page: 'current' }).data()
                    .reduce((a, b) => parseFloat(a) + parseFloat(b || 0), 0);
                // Get the balance of the last row on the current page
                var balanceTotal = data.length > 0 ? parseFloat($('td:eq(8)', api.row(data.length - 1).node()).text().replace('BD ', '')) : 0;

                // Update footer with formatted totals
                $(api.column(5).footer()).html(contractTotal > 0 ? 'BD ' + contractTotal.toFixed(3) : '');
                $(api.column(6).footer()).html(debitTotal > 0 ? 'BD ' + debitTotal.toFixed(3) : '');
                $(api.column(7).footer()).html(creditTotal > 0 ? 'BD ' + creditTotal.toFixed(3) : '');
                $(api.column(8).footer()).html(balanceTotal !== 0 ? 'BD ' + balanceTotal.toFixed(3) : '');
            },
            order: [], // Remove default sorting to respect SQL ORDER BY accounts_date ASC, ids ASC
            pageLength: 10,
            paging: true,
            responsive: {
                details: {
                    renderer: function (api, rowIdx, columns) {
                        var data = api.row(rowIdx).data();
                        return formatChildRow(data);
                    }
                }
            }
        });

        // Add event listener for opening and closing details
        $('#statement_table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = $('#statement_table').DataTable().row(tr);
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(formatChildRow(row.data())).show();
                tr.addClass('shown');
            }
        });
    }
});