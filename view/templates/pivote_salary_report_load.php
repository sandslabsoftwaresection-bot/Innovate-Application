 <link rel="stylesheet" href="view/vendor/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

<div class="table-responsive" id="pivote_table">
                                
        <table id="tbl_salary_consolidate_list" class="table table-striped table-bordered" style="width:100%" style="padding-top:5px;font-size:12px">
           
        </table>
        
       <input type="hidden" id="hiddenInput" value="<?php echo $_GET['param']; ?>">
</div>

<!--<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>-->

<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script>
$(document).ready(function() {   
    var v_date = $('#hiddenInput').val();
    
    get_salary_consolidate(v_date);
    function get_salary_consolidate(selectedMonthYear) {
    // Clear the content of the HTML table
     if ($.fn.DataTable.isDataTable('#tbl_salary_consolidate_list')) {
        $('#tbl_salary_consolidate_list').DataTable().destroy();
    }
    $('#tbl_salary_consolidate_list').empty();
    var total_amount = {}; // Object to store column-wise sums

    $.post("../controller/store_report/salary_consolidate_controller.php", {
        action: "get_data",
        startDate: selectedMonthYear
    }, function(data) {
        // Check if data is received and not empty
        if (Array.isArray(data) && data.length > 0) {
            console.log('Inside If');
            // Initialize the DataTable
            var table = $('#tbl_salary_consolidate_list').DataTable({
                "paging": false,
                "ordering": false,
                "searching": false,
                language: {
                    info: "Total _TOTAL_ Employees Listed"
                },
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    title: 'Consolidated Salary Report for the Month Of ' + selectedMonthYear,
                    customize: function(xlsx) {
                        // Add custom XML to include footer row in the Excel export
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var lastRowIndex = $('row', sheet).length - 1;
                        var footerRow = '<row>';
                        table.columns().every(function(index) {
                            if (index === 0) {
                                footerRow += '<c><v>Total:</v></c>';
                            } else if (index === 1) {
                                footerRow += '<c></c>';
                            } else {
                                var columnName = table.column(index).header().innerText;
                                var sum = total_amount[columnName] || 0; // Get column sum or default to 0
                                footerRow += '<c><v>' + sum + '</v></c>';
                            }
                        });
                        footerRow += '</row>';
                        // Append the custom XML to the sheetData element
                        $(sheet).find('sheetData').append(footerRow);
                        // Set background color for the footer row
                        $(sheet).find('row:last').attr('fill', '#f2f2f2');
                    }
                    
                }],
                data: data,
                columns: Object.keys(data[0]).map(function(key) {
                    if (key === 'EMP_NAME' || key === 'SALARY_DATE') {
                        // For emp_name and salary_date columns, do not apply right-align class
                        return {
                            title: key,
                            data: key,
                            className: key === 'EMP_NAME' ? 'emp_name nowrap' : ''
                        };
                    } else {
                       
                        // For other columns, apply right-align class
                        return {
                            title: key,
                            data: key,
                            className: 'right-align'
                        };
                        
                        
                    }
                    
                     
                    
                })
               
            });
             
             
          // Calculate sum for each column except the first two (EMP_NAME and SALARY_DATE)
            table.columns().every(function(index) {
                if (index > 1) { // Exclude first two columns
                    var columnName = table.column(index).header().innerText;
                    var sum = table.column(index).data().reduce(function(a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0);
                    total_amount[columnName] = sum.toFixed(3);
                }
            });
            
            console.log('Column-wise Sum:', total_amount);
            
            // Append a new row to the table to display column-wise sums
            var sumRowHtml = '<tr style="background-color:#D4D4D4;">';
            table.columns().every(function(index) {
                if (index === 0) {
                    sumRowHtml += '<td style="font-weight:700;">Total:</td>';
                } else if (index === 1) {
                    sumRowHtml += '<td></td>';
                } else {
                    var columnName = table.column(index).header().innerText;
                    sumRowHtml += '<td style="text-align:right;font-weight:700;">' + total_amount[columnName] + '</td>';
                }
            });
            sumRowHtml += '</tr>';
            $('#tbl_salary_consolidate_list').append(sumRowHtml);
             
        } else {
            console.log("No data received from server or data is empty.");
            $('#tbl_salary_consolidate_list').html('<tr><td colspan="your_column_count">No Data Found</td></tr>');
            
        }
        $('#loadingWrapper').hide(); // Hide loading indicator
    }).fail(function(xhr, textStatus, errorThrown) {
        // Log an error message if the request fails
        console.log("Failed to fetch data from server:", errorThrown);
    });
}

    
});    

</script>