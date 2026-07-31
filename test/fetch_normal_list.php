<!DOCTYPE html>
<html>
<head>
    <title>DataTable Example</title>
    <!-- Include jQuery and DataTables CSS/JS files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
    
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
    <script src="https://cdn.datatables.net/rowgroup/1.1.3/js/dataTables.rowGroup.min.js"></script>

    <style>
        #example td.emp_name {
            white-space: nowrap; /* Prevent text from wrapping */
        }
        .nowrap {
            white-space: nowrap; /* Prevent text from wrapping */
        }
        .right-align {
            text-align: right;
        }
        body
        {
            font-size:14px;    
        }
        
        table.dataTable tr.dtrg-group.dtrg-end th {
            text-align: right;
            font-weight: normal;
        }
       
    </style>
</head>
<body>
<p style="font-size: 20px;">Consolidated Salary Report for the Month Of May 2024 </p>
                                <table class="table " id="salary_normal_table_load" class="display stripe cell-border" style="padding-top:5px;font-size:12px">
                                        <thead>
                                            <tr class="custom-font">
                                                <th>ID</th>
                                                <th>Employee Name</th>
                                                <th>Salary Date</th>
        										<th>Description</th>
                                                <th>Earning Amount</th>
        										<th>Deduction Amount</th>
        										
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr class="custom-font">
                                                <th></th>
                                                <th></th>
                                                <th></th>
        										<th></th>
                                                <th></th>
        										<th></th>
        										
                                            </tr>
                                        </tfoot>
                                    </table>

<script type="text/javascript">
$(document).ready(function() {
    $.get("fetch_normal_data.php", function(data) {
        if (data && data.length > 0) {
            var table = $('#salary_normal_table_load').DataTable({
                "paging": false,   // Disable pagination
                "ordering": false, // Disable sorting
                "searching": false, // Disable search
                 "rowGroup": {
                    dataSrc: 'emp_name', // Group by the Description field
                    endRender: function (rows, group) {
                            var avg =
                                rows
                                    .data()
                                    .pluck(3)
                                    .reduce((a, b) => a + b.replace(/[^\d]/g, '') * 1, 0) / rows.count();
                 
                            // Use the DataTables number formatter
                            return (
                                'Average salary in group: ' +
                                DataTable.render.number(null, null, 0, '$').display(avg)
                            );
                        }
                    
                },
                "footerCallback": function(row, data, start, end, display) {
                        var api = this.api();
                        var groups = {}; // Object to store sums for each group
                        
                        // Loop through each row to calculate sums for each group
                        api.rows({page: 'current', search: 'applied'}).every(function() {
                            var data = this.data();
                            var groupName = data.emp_name;
                            
                            // Initialize group sum if not exists
                            if (!groups[groupName]) {
                                groups[groupName] = {
                                    earningTotal: 0,
                                    deductionTotal: 0
                                };
                            }
                            
                            // Accumulate earning and deduction totals for the group
                            groups[groupName].earningTotal += parseFloat(data.earning_amt);
                            groups[groupName].deductionTotal += parseFloat(data.deduction_amt);
                        });
                        
                        // Set group sums in the footer
                        for (var groupName in groups) {
                            if (groups.hasOwnProperty(groupName)) {
                                var group = groups[groupName];
                                $(api.column(4).footer()).html(groupName + ' Total Earning: ' + group.earningTotal.toFixed(3));
                                $(api.column(5).footer()).html(groupName + ' Total Deduction: ' + group.deductionTotal.toFixed(3));
                            }
                        }
                    },
                language: {
                    info: "Total _TOTAL_ Employees Found"
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Consolidated Salary Report for the Month Of May 2024',
                    }
                ],
                data: data,
                "columns": [
					 { "data": "ids", "className": "text-center" },
					 { "data": "emp_name", visible:false},
					 { "data": "salary_date", "className": "text-center" },
					 { "data": "allow_deduction", "className": "text-left" },
					 { "data": "earning_amt", "className": "text-right" },
					 { "data": "deduction_amt", "className": "text-right" },
					 
				 ],
                
                
                
            });
        } else {
            console.error("No data received from server or data is empty.");
        }
    }).fail(function(xhr, textStatus, errorThrown) {
        console.error("Failed to fetch data from server:", errorThrown);
    });
});

</script>

</body>
</html>
