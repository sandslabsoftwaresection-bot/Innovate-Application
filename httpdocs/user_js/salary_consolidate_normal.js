$(document).ready(function(){
    
    //   *****************************date change**********************************
       var selectedMonthYear;
        const input = document.getElementById('month-year');
        input.addEventListener('change', function() {
            //   $('#loadingWrapper').show();
            selectedMonthYear = input.value;
            console.log("Selected Month and Year:", selectedMonthYear);
            // load_normal_salary_report(selectedMonthYear);
               if ($.fn.DataTable.isDataTable('#salary_normal_table_load')) {
                    $('#salary_normal_table_load').DataTable().destroy();
                }
                // $('#salary_normal_table_load').empty();
                
            var table = new DataTable('#salary_normal_table_load', {
                "paging": false, // Disable paging
                "searching": false,
                "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/store_report/salary_consolidate_controller.php',
                                 'data': {
                                    action: 'load_data_to_normal_table',
                                    startDate:selectedMonthYear
                                 }
                             },
 
                "columns": [
                                {"data": null, "className": "text-center"},
                                {"data": "emp_name","visible": false},
                                {"data": "salary_date", "visible": false},
                                {"data": "allow_deduction", "className": "text-left"},
                                {"data": "earning_amt", "className": "text-right"},
                                {"data": "deduction_amt", "className": "text-right"},
                ],
                "language": {
                    "emptyTable": "No data available in table" // Custom message for empty table
                },
                "processing": true, // Show loading indicator during data loading
                "serverSide": true, // Enable server-side processing (optional)
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
                                         '<td style="width: ' + columnWidths[0] + 'px; background-color: #C0C8CD;"></td>' + // First column
                                         '<td style="width: ' + columnWidths[1] + 'px; background-color: #C0C8CD;"></td>' + // Second column
                                         '<td style="width: ' + columnWidths[2] + 'px; background-color: #C0C8CD;"></td>' + // Third column
                                         '<td style="width: ' + columnWidths[3] + 'px; background-color: #C0C8CD;"></td>' + // Fourth column
                                         '<td style="width: ' + columnWidths[4] + 'px;text-align: right; background-color: #C0C8CD;">Total CR: ' + formatted_cr_total + '</td>' + // Total CR amount
                                         '<td style="width: ' + columnWidths[5] + 'px;text-align: right; background-color: #C0C8CD;">Total DR: ' + formatted_dr_total + '</td>' + // Total DR amount
                                         '</tr></tfoot>';
            
                        // Return the rendered HTML for the group with the footer
                        return footerHtml;
            // 		 $(rows[0].node()).addClass('first-row-of-group');	  
                    }
                },
                "initComplete": function(settings, json) {
                    // Hide the columns after DataTable initialization is complete
                    // this.api().column(0).visible(false);
                    this.api().column(1).visible(false); // Assuming 'emp_name' is the second column (index 1)
                    this.api().column(2).visible(false); // Assuming 'emp_name' is the second column (index 1)
                    $('#loadingWrapper').hide();
                },
                "rowCallback": function(row, data, index) {
                    // Add sequential numbers to the first column
                    $('td:eq(0)', row).text(index + 1);
                }
                
                
                
            });
            
            table.column(1).visible(false); 
            table.column(2).visible(false); 
            

               
        });
       // var table = $('#tbl_salary_consolidate_list').DataTable();
    function reloadDataTable() {
    table.ajax.reload();
}
// *************************end******************************************

// ********************************print with head*********************************
    $('#btn_print_with_head').click(function() {
                 if (selectedMonthYear !== undefined && selectedMonthYear !== null) {
                
                     window.open("reports/pdf/print/consolidate_salary_report.php?sal_date=" + encodeURIComponent(selectedMonthYear) + "&x=0","_blank");
                 } else {
                    swal("Warning", "Select date", "warning");
                }
            });

// **********************************end********************************************

// ********************************print without head*********************************
    $('#btn_print_without_head').click(function() {
               
                if (selectedMonthYear !== undefined && selectedMonthYear !== null) {
                
                    window.open("reports/pdf/print/consolidate_salary_report.php?sal_date=" + encodeURIComponent(selectedMonthYear) + "&x=1","_blank");
                } else {
                    swal("Warning", "Select date", "warning");
                }
            });

// **********************************end********************************************


// ******************************normal table load******************************

    // function load_normal_salary_report(selectedMonthYear)
// 	{
		   
        // var table = new DataTable('#salary_normal_table_load', {
        //         "paging": false, // Disable paging
        //         "searching": false,
        //         "ajax": {
        //             "url": "templates/normal.php", // Your server-side script to fetch data
        //         },
        //         "columns": [
        //                         {"data": "ids", "className": "text-center"},
        //                         {"data": "emp_name","visible": false},
        //                         {"data": "salary_date", "visible": false},
        //                         {"data": "allow_deduction", "className": "text-left"},
        //                         {"data": "earning_amt", "className": "text-right"},
        //                         {"data": "deduction_amt", "className": "text-right"},
        //         ],
        //         order: [[1, 'asc']],
        //         rowGroup: {
        //             dataSrc: ['emp_name'], // Group by the "Name" column (index 1)
        //             endRender: function (rows, group) {
        //                 console.log("Grouping rows:", rows);
        //                 console.log("Group value:", group);
                        
        //                 var dr_sum = 0;
        //     			var cr_sum = 0;
        //                 var count = 0;
                        
        //                 rows.every(function () {
        //                     var data = this.data();
        //                     var cr_amount = data['earning_amt']; // Assuming salary is at index 4 (column "cr_amount")
        //                     var dr_amount = data['deduction_amt']; 
        //                     // Check if salary is defined and in the expected format
        //                     if (!isNaN(parseFloat(cr_amount))) {
        //                         cr_sum += parseFloat(cr_amount);
        //                         count++;
        //                     }
        //                     if (!isNaN(parseFloat(dr_amount))) {
        //                         dr_sum += parseFloat(dr_amount);
        //                         count++;
        //                     }
        //                     return true;
        //                 });
                        
        //                 // Get the widths of the data columns
        //                 var columnWidths = $('#salary_normal_table_load').DataTable().columns().nodes().map(function (node) {
        //                     return $(node).width()+50;
        //                 });
            
        //     			var formatted_cr_total = DataTable.render.number(',', '.', 3, '').display(cr_sum);
        //                 var formatted_dr_total = DataTable.render.number(',', '.', 3, '').display(dr_sum);
            
        //                 // Construct the HTML for the footer
        //                 var footerHtml = '<tfoot style="width:100%"><tr style="border: 1px solid #ddd;">' +
        //                                  '<td style="width: ' + columnWidths[0] + 'px;"></td>' + // First column
        //                                  '<td style="width: ' + columnWidths[1] + 'px;"></td>' + // Second column
        //                                  '<td style="width: ' + columnWidths[2] + 'px;"></td>' + // Third column
        //                                  '<td style="width: ' + columnWidths[3] + 'px;"></td>' + // Fourth column
        //                                  '<td style="width: ' + columnWidths[4] + 'px;text-align: right;">Total CR: ' + formatted_cr_total + '</td>' + // Total CR amount
        //                                  '<td style="width: ' + columnWidths[5] + 'px;text-align: right;">Total DR: ' + formatted_dr_total + '</td>' + // Total DR amount
        //                                  '</tr></tfoot>';
            
        //                 // Return the rendered HTML for the group with the footer
        //                 return footerHtml;
        //     		 $(rows[0].node()).addClass('first-row-of-group');	  
        //             }
        //         },
        //         "initComplete": function(settings, json) {
        //             // Hide the columns after DataTable initialization is complete
        //             this.api().column(1).visible(false); // Assuming 'emp_name' is the second column (index 1)
        //             this.api().column(2).visible(false); // Assuming 'emp_name' is the second column (index 1)
        //         }
                
                
                
        //     });
            
        //     table.column(1).visible(false); 
        //     table.column(2).visible(false); 
            

            
// 	}

//  *******************************end******************************************* 
  
});