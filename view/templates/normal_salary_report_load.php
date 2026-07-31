<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>-->

<link rel="stylesheet" href="../vendor/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.5.0/css/rowGroup.dataTables.css">


<style>
table.dataTable tr.dtrg-group.dtrg-end th {
    text-align: right;
    font-weight: normal;
}

table tbody tr:nth-child(odd) {
    background-color: #f2f2f2;
}

/* White background for even rows */
table tbody tr:nth-child(even) {
    background-color: #ffffff;
}
</style>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.5.0/js/dataTables.rowGroup.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.5.0/js/rowGroup.dataTables.js"></script>


<!--normal_table-->
 <!--salary_normal_table_load-->
 <!--table table-striped table-bordered-->
 <!--table display stripe cell-border-->
 
 <div class="" id="normal_table">
        <table class="table " id="salary_normal_table_load" class="display stripe cell-border" style="padding-top:5px;font-size:12px">
            <thead>
                <tr class="custom-font">
                    <th >ID</th>
                    <th style="display:none">Employee Name</th>
                    <th style="display:none">Salary Date</th>
					<th>Description</th>
                    <th>Earning Amount</th>
					<th>Deduction Amount</th>
					
                </tr>
            </thead>
            <tbody>
                
            </tbody>
     <!--       <tfoot>-->
     <!--       <tr>-->
     <!--           <th>ID</th>-->
     <!--               <th>Employee Name</th>-->
     <!--               <th>Salary Date</th>-->
					<!--<th>Description</th>-->
     <!--               <th>Earning Amount</th>-->
					<!--<th>Deduction Amount</th>-->
     <!--       </tr>-->
     <!--   </tfoot>-->
        </table>
        <input type="hidden" id="hiddenInput" value="<?php echo $_GET['param']; ?>">
</div>


<script>
$(document).ready(function() {   
    var month_and_date = $('#hiddenInput').val();
    
    
    var table = new DataTable('#salary_normal_table_load', {
        "paging": false, // Disable paging
    "searching": false,
    "ajax": {
        "url": "normal.php", // Your server-side script to fetch data
    },
    "columns": [
                    {"data": "ids", "className": "text-center"},
                    {"data": "emp_name","visible": false},
                    {"data": "salary_date", "visible": false},
                    {"data": "allow_deduction", "className": "text-left"},
                    {"data": "earning_amt", "className": "text-right"},
                    {"data": "deduction_amt", "className": "text-right"},
    ],
    order: [[1, 'asc']],
    rowGroup: {
        dataSrc: ['emp_name'], // Group by the "Name" column (index 1)
        endRender: function (rows, group) {
            console.log("Grouping rows:", rows);
            console.log("Group value:", group);
            
            var dr_sum = 0;
			var cr_sum = 0;
            var count = 0;
            
            rows.every(function () {
                var data = this.data();
                var cr_amount = data['earning_amt']; // Assuming salary is at index 4 (column "cr_amount")
                var dr_amount = data['deduction_amt']; 
                // Check if salary is defined and in the expected format
                if (!isNaN(parseFloat(cr_amount))) {
                    cr_sum += parseFloat(cr_amount);
                    count++;
                }
                if (!isNaN(parseFloat(dr_amount))) {
                    dr_sum += parseFloat(dr_amount);
                    count++;
                }
                return true;
            });
            
            // Get the widths of the data columns
            var columnWidths = $('#salary_normal_table_load').DataTable().columns().nodes().map(function (node) {
                return $(node).width()+50;
            });

			var formatted_cr_total = DataTable.render.number(',', '.', 3, '').display(cr_sum);
            var formatted_dr_total = DataTable.render.number(',', '.', 3, '').display(dr_sum);

            // Construct the HTML for the footer
            var footerHtml = '<tfoot style="width:100%"><tr style="border: 1px solid #ddd;">' +
                             '<td style="width: ' + columnWidths[0] + 'px;"></td>' + // First column
                             '<td style="width: ' + columnWidths[1] + 'px;"></td>' + // Second column
                             '<td style="width: ' + columnWidths[2] + 'px;"></td>' + // Third column
                             '<td style="width: ' + columnWidths[3] + 'px;"></td>' + // Fourth column
                             '<td style="width: ' + columnWidths[4] + 'px;text-align: right;">Total CR: ' + formatted_cr_total + '</td>' + // Total CR amount
                             '<td style="width: ' + columnWidths[5] + 'px;text-align: right;">Total DR: ' + formatted_dr_total + '</td>' + // Total DR amount
                             '</tr></tfoot>';

            // Return the rendered HTML for the group with the footer
            return footerHtml;
		 $(rows[0].node()).addClass('first-row-of-group');	  
        }
    },
    "initComplete": function(settings, json) {
        // Hide the columns after DataTable initialization is complete
        this.api().column(1).visible(false); // Assuming 'emp_name' is the second column (index 1)
        this.api().column(2).visible(false); // Assuming 'emp_name' is the second column (index 1)
    }
    
    
    
});

table.column(1).visible(false); 
table.column(2).visible(false); 



});    

</script>

