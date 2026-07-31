$(document).ready(function(){
    // var salary_normal_table_load = $('#salary_normal_table_load').DataTable({searching: false, paging: false, info: false,"ordering": false});
    //   $("#normal_table").hide();
       
    // //   ****************************check box check*************************
    //         const checkboxes = document.querySelectorAll('input[name="type"]');

    //             // Loop through each checkbox
    //             checkboxes.forEach((checkbox) => {
    //                 // Add event listener to each checkbox
    //                 checkbox.addEventListener('change', function() {
    //                     // If the current checkbox is checked
    //                     if (this.checked) {
    //                         // Uncheck all other checkboxes
    //                         checkboxes.forEach((otherCheckbox) => {
    //                             if (otherCheckbox !== this) {
    //                                 otherCheckbox.checked = false;
    //                             }
    //                         });
    //                     }
    //                 });
    //             });
    
    
    // // *************************end*******************************************
       
    //   *****************************date change**********************************
       
        const input = document.getElementById('month-year');
        input.addEventListener('change', function() {
              
            const selectedMonthYear = input.value;
            console.log("Selected Month and Year:", selectedMonthYear);
             $('#loadingWrapper').show(); 
                // if ($('#pivote').is(":checked")) {
                //     $('#loadingWrapper').show(); 
                //     $('#load_table_div').load('templates/pivote_salary_report_load.php?param=' + encodeURIComponent(selectedMonthYear));
                //     // $("#pivote_table").show();
                //     $("#normal_table").hide();
                get_salary_consolidate(selectedMonthYear);
                
            // } else if ($('#normal').is(":checked")){
            //     $('#loadingWrapper').show(); 
            //     $('#load_table_div').load('templates/normal_salary_report_load.php?param=' + encodeURIComponent(selectedMonthYear));
                
            //     $("#pivote_table").hide();
            //     $("#normal_table").show();
            //   load_normal_salary_report(selectedMonthYear);
               
            // }else{
            //     alert("select checkbox");
            //     $("#pivote_table").hide();
            //     $("#normal_table").hide();
            //     $('#loadingWrapper').hide();
            // }
            
            
           
            
            
        });
       // var table = $('#tbl_salary_consolidate_list').DataTable();
    
// *************************end******************************************


//************************pivote table load************************************* 


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

// ********************************end*****************************************


// ******************************normal table load******************************

 var groupColumn = 1;
    function load_normal_salary_report(selectedMonthYear)
	{
		salary_normal_table_load.destroy();     
        salary_normal_table_load = $('#salary_normal_table_load').DataTable( {          
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/store_report/salary_consolidate_controller.php',
					 'data': {
						action: 'load_data_to_normal_table',
						startDate:selectedMonthYear
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
				"scroller": true,

				"columns": [
					 { "data": "ids", "className": "text-center" },
					 { "data": "emp_name", visible:false},
					 { "data": "salary_date", visible:false },
					 { "data": "allow_deduction", "className": "text-left" },
					 { "data": "earning_amt", "className": "text-right" },
					 { "data": "deduction_amt", "className": "text-right" },
					 
				 ],
				 pageLength: 25,
				 searching: false,
				// responsive: true,
			
				 "initComplete": function( settings, json ) {
                        $('#loadingWrapper').hide(); 
				  },
				  "fnDrawCallback": function() {
 
				 },
				 
				  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
					 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
					 return nRow;
				 },
        		"footerCallback": function (row, data, start, end, display) {
                   
			},
			
              columnDefs: [{ visible: false, targets: groupColumn }],
                order: [[groupColumn, 'asc']],
                displayLength: 25,
                drawCallback: function (settings) {
                    var v_salary_date="";
                    var api = this.api();
                    var rows = api.rows({ page: 'current' }).nodes();
                    api.rows({ page: 'current' }).every(function (rowIdx, tableLoop, rowLoop) {
                    var rowData = this.data(); // Get the data of the current row
                    // Access data from each cell in the row
                   
                    v_salary_date = rowData.salary_date;

                    })
                    
                    var last = null;
                    // console.log("datasssss : "+rows[0]['salary_date']);
                    api.column(groupColumn, { page: 'current' })
                        .data()
                        .each(function (group, i) {
                            if (last !== group) {
                                $(rows)
                                    .eq(i)
                                    .before(
                                        '<tr class="group" style="background-color:#D2B4DE;"><td colspan="5">' +
                                            group +" - "+v_salary_date+
                                            '</td></tr>'
                                    );
             
                                last = group;
                            }
                        });
                },
                 order: [[2, 'asc']],
                    rowGroup: {
                        dataSrc: 2,
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
                    }
              
        });
            
	}

//  *******************************end******************************************* 
  
});