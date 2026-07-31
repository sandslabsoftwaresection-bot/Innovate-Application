const monthElement = document.querySelector('.sands-month-name');
const daysElement = document.querySelector('.sands-days');
const prevMonthButton = document.querySelector('.sands-prev');
const nextMonthButton = document.querySelector('.sands-next');

// Get current date
const currentDate = new Date();
let currentMonth = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

// Event listeners for previous and next month buttons
prevMonthButton.addEventListener('click', showPreviousMonth);
nextMonthButton.addEventListener('click', showNextMonth);

// Initial call to display current month
var table;

function showCalendar(month, year) {
  

  const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

  // Clear existing calendar
  daysElement.innerHTML = '';

  // Display month name
  monthElement.textContent = `${monthNames[month]} ${year}`;

  // Get the first day of the month and the total number of days in the month
  const firstDay = new Date(year, month, 1).getDay();
  const totalDays = new Date(year, month + 1, 0).getDate();

  // Fill in the days
  for (let i = 0; i < firstDay; i++) {
    const li = document.createElement('li');
    li.textContent = '';
    daysElement.appendChild(li);
  }

  for (let i = 1; i <= totalDays; i++) {
    const li = document.createElement('li');
    li.textContent = i;
    const currentDateFormatted = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
    
	if (year === currentDate.getFullYear() && month === currentDate.getMonth() && i === currentDate.getDate()) {
      li.classList.add('sands-today');
    }
    const highlightedDate = highlightedDates.find(date => date[0] === currentDateFormatted);
    if (highlightedDate) {
      if (highlightedDate[1] === 0) {
        li.classList.add('sands-highlighted-multiple');
      } else {
		li.classList.add('sands-highlighted');
			 // Create a div element for the highlighted value
			  const div = document.createElement('div');
			  div.textContent = $.trim(highlightedDate[1]);
			  // Apply CSS styling to position the div in the top-right corner 
			  div.classList.add('sands-highlighted-value');
			  // Append the div to the list item
			  li.appendChild(div);
      }
    }
    daysElement.appendChild(li);
	
  }
   
}


   
function Calculations()
{
    console.log('Calculation Starts');
	var sumApproved = 0;
    var sumNotApproved = 0;
	
	var sumApproved_Exp = 0;
    var sumNotApproved_Exp = 0;
        
		table.rows().every(function() {
			  var data = this.data();
			 
			  var status = data['approved_status']; // Get the value from the 5th column
			 
			  var value = parseFloat(data['cr_amount']); // Get the value from the 4th column and convert to float
			  //console.log("Income : "+value);
			  if (status === "Approved") {
				sumApproved += value;
			  } else if (status === "Not Approved") {
				sumNotApproved += value;
			  }
			  
			  var valueExpense = parseFloat(data['dr_amount']); // Get the value from the 4th column and convert to float
			  //console.log("Expense : "+valueExpense);
			  if (status === "Approved") {
				sumApproved_Exp += valueExpense;
			  } else if (status === "Not Approved") {
				sumNotApproved_Exp += valueExpense;
			  }
		});
        
		$('#sumApproved').html('<span class="sands-badge sands-text-bg-success">Approved<span> Total: ' + sumApproved.toFixed(3));
		$('#sumNotApproved').html('<span class="sands-badge sands-text-bg-danger">Not Approved<span> Total: ' + sumNotApproved.toFixed(3));
		
		$('#sumApprovedExp').html('<span class="sands-badge sands-text-bg-success">Approved<span> Total: ' + sumApproved_Exp.toFixed(3));
		$('#sumNotApprovedExp').html('<span class="sands-badge sands-text-bg-danger">Not Approved<span> Total: ' + sumNotApproved_Exp.toFixed(3));
   
}// Calculations Close


// Add event listener for mouseover on the parent element
daysElement.addEventListener('mouseover', function(event) {
  const target = event.target;
  // Check if the mouseover event is triggered by a li element with the class sands-highlighted
  if (target.tagName === 'LI' && target.classList.contains('sands-highlighted')) {
    // Display tooltip or perform any desired action
    console.log('Mouse over sands-highlighted date:', target.textContent);
  }
  if (target.tagName === 'LI' && target.classList.contains('sands-highlighted-multiple')) {
    // Display tooltip or perform any desired action
    console.log('Mouse over sands-highlighted date:', target.textContent);
  }
});

function showPreviousMonth() {
  currentMonth--;
  if (currentMonth === -1) {
    currentMonth = 11;
    currentYear--;
  }
  showCalendar(currentMonth, currentYear);
}

function showNextMonth() {
  currentMonth++;
  if (currentMonth === 12) {
    currentMonth = 0;
    currentYear++;
  }
  showCalendar(currentMonth, currentYear);
}


function changeMonth(month) {
    const year = document.getElementById('sandsYearSelect').value;
    showCalendar(parseInt(month), parseInt(year));
}

function changeYear(year) {
    const month = document.getElementById('sandsMonthSelect').value;
	//console.log(month);
    showCalendar(parseInt(month), parseInt(year));
}

document.addEventListener('DOMContentLoaded', function() {
  var selectYear = document.getElementById('sandsYearSelect');
  for (var year = 1925; year <= 2100; year++) {
    var option = document.createElement('option');
    option.value = year;
    option.textContent = year;
    if (year === currentYear) { // Check if this is the current year
      option.selected = true; // Set this option as selected
    }
    selectYear.appendChild(option);
  }
});
document.addEventListener('DOMContentLoaded', function() {
  var selectMonth = document.getElementById('sandsMonthSelect');
  var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var currentMonth = new Date().getMonth(); // Get the current month (0-indexed)
  for (var i = 0; i < monthNames.length; i++) {
    var option = document.createElement('option');
    option.value = i;
    option.textContent = monthNames[i];
    if (i === currentMonth) { // Check if this is the current month
      option.selected = true; // Set this option as selected
    }
    selectMonth.appendChild(option);
  }
});





// Get all date cells
const dateCells = document.querySelectorAll('.days li sands-highlighted');

let selectedDateCell = null;

// Attach click event listener to the container of date cells (daysElement)
daysElement.addEventListener('click', event => {
  const target = event.target;
  if (target.tagName === 'LI') {
    // Remove background color from previously selected date cell
    if (selectedDateCell) {
      selectedDateCell.style.backgroundColor = '';
    }

    // Get the text content of the clicked cell
    const cellContent = target.firstChild.textContent.trim();
    
    
    
    // Extract year and month information from the cell's text content
    const selectedYear = currentYear;
    const selectedMonth = currentMonth + 1 ; // Adding 1 since months are zero-based
    const selectedDate = `${selectedYear}-${String(selectedMonth).padStart(2, '0')}-${String(cellContent).padStart(2, '0')}`;

    console.log(`Selected date: ${selectedYear}-${String(selectedMonth).padStart(2, '0')}-${String(cellContent).padStart(2, '0')}`);

    // Set background color for the clicked cell
    target.style.backgroundColor = 'orange';
    // Update the selectedDateCell variable to store the currently selected cell
    selectedDateCell = target;
    
    if ($.fn.DataTable.isDataTable('#tlbTransaction')) {
        $('#tlbTransaction').DataTable().destroy();
    }
   
   
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
   
   
    
      $('#loadingWrapper').show();   
            
    table =  $('#tlbTransaction').DataTable({
      paging: false, // Hide pagination
      searching: false, // Hide search
      "order": [],
	  language: {
        //info: "Displaying _START_ to _END_ of _TOTAL_ entries"
		info: "Total _TOTAL_ entries (Click to change Type and Status)",
		zeroRecords: "No Payment Shedules Available"
      },
      
      "ajax": {
                method: 'POST',
                "url": "../controller/payment_schedule/payment_schedule_controller.php",
                dataType: 'json',
                "data": function (d) {
                    d.action = 'get_schedule_list';
                    d.selected_date = selectedDate;
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
                   
                    { "data": "payment_method",
                      render: function(data, type, row) {
                        
                                return '<span class="sands-badge-grid-1 sands-text-bg-info">'+data+'</span>';
                      }
                        
                    },
                    { "data": "cheque_no_receipt_no",
                        render: function(data, type, row) {
                        
                                return '<i class="fas fa-edit edit-ref-number-icon"></i> <span class="reference-num-display">'+data+'</span>';
                        }
                        
                    },
                    { "data": "due_date" ,
                         render: function(data, type, row) {
                            
                                    return ' <span class="date-display">'+data+'</span> <i class="fas fa-edit edit-icon"></i>';
                          }
                    },
                    { "data": "cr_amount" },
                    { "data": "dr_amount" },
                    { "data": "account_head" },
                    { "data": "approved_status" ,
                         render: function(data, type, row) {
                              if (data === "Approved") {
                                return '<span class="sands-badge-grid sands-text-bg-success">Approved</span>';
                              } else if (data === "Not Approved") {
                                return '<span class="sands-badge-grid sands-text-bg-danger">Not Approved</span>';
                              } 
                         }
                    },
                    { "data": "customer_name","className":'truncate-tooltip',
                     
                    },
                    { "data": "ids" ,
    				    render: function(data, type, row) {
    				        return '<div class="sands-delete-icon"></div>';
    				    }
    				},
                ],
      footerCallback: function (row, data, start, end, display) {
        var api = this.api();
        var sum = api.column(3, { page: 'current' }).data().reduce(function (a, b) {
          return parseFloat(a) + parseFloat(b);
        }, 0);

        $(api.column(3).footer()).html(sum.toFixed(3));
		
		var sumof_exp = api.column(4, { page: 'current' }).data().reduce(function (a, b) {
          return parseFloat(a) + parseFloat(b);
        }, 0);
        $(api.column(4).footer()).html(sumof_exp.toFixed(3));
      },
	  columnDefs: [{
        targets: [0,6], // Targeting the 5th column
        render: function(data, type, row) {
          if (data === "Approved") {
            return '<span class="sands-badge-grid sands-text-bg-success">Approved</span>';
          } else if (data === "Not Approved") {
            return '<span class="sands-badge-grid sands-text-bg-danger">Not Approved</span>';
          } else {
            return '<span class="sands-badge-grid-1 sands-text-bg-info">'+data+'</span>';
          }
        }},
        { targets: '_all', orderable: false },
        {
            "targets": 7, // Replace 0 with the index of the column you want to modify
            
            "render": function (data, type, row, meta) {
                
              if (type === 'display' && data.length > 10) {
                return data.substr(0, 10) + '...'; // Display only the first 8 characters with ellipsis
              }
              return data;
            }
         } ,
         {
            "targets": 7, // Replace 0 with the index of the "customer_name" column
            "createdCell": function (td, cellData, rowData, row, col) {
              $(td).addClass('truncate-tooltip');
              $(td).attr('data-customer-name', cellData + ' ## '+rowData['description']);
            }
      }
        ],
         "initComplete": function(settings, json) {
                        if (isDataTableEmpty('#tlbTransaction')) {
                                // DataTable is empty
                                console.log('DataTable is empty.');
                                
                        } 
            Calculations();
            $('#loadingWrapper').hide();
        }
    });

    
  }// close of if (target.tagName === 'LI')
  
//   $('#tlbTransaction tbody td.truncate-tooltip').mouseenter(function(e) {
   $(document).on('mouseenter', 'td.truncate-tooltip', function(e) {
      console.log("Test data");
    //var tooltipHtml = $(this).html();
    var tooltipHtml =$(this).attr('data-customer-name');// Get HTML content of the cell
    console.log("data: "+tooltipHtml);
    var tooltip = $('#tooltip');
    tooltipHtml = tooltipHtml.replace(/##/g, '<br>');
    tooltip.html(tooltipHtml); // Set HTML content to the tooltip
    tooltip.css({
      display: 'block',
      top: e.pageY - tooltip.outerHeight() - 10, // Adjust position to place tooltip above mouse cursor
      right: $(window).width() - e.pageX + 10 // Align tooltip with right edge of viewport and adjust position
    });
  });
  

//   $('#tlbTransaction tbody td.truncate-tooltip').mouseleave(function() {
  $(document).on('mouseleave', 'td.truncate-tooltip', function(e) {      
    $('#tooltip').css('display', 'none');
  });
});

