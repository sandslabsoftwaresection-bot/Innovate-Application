
//var table;
  $(document).ready(function() {
      document.querySelectorAll('.popup-buttons button').forEach(function(button) {
            button.addEventListener('click', function() {
              var popupOverlay = document.getElementById('popupOverlay');
              var popupContainer = document.getElementById('popupContainer');
              popupOverlay.style.display = 'none';
              popupContainer.style.display = 'none';
              // Check which button was clicked
              if (button.classList.contains('ok')) {
                // OK button clicked, perform action
                var switchData = $('#message_matter').attr('data-switch-values');
                switch (switchData) {
                    case 'ChangeStatus':
                        ChangeStatus();
                        break;
                    case 'DeleteData':
                        DeleteRowFromTheTable();
                        break;
                    case 'ChangeType':
                        ChangeType();
                        break;
                    default:
                         setTimeout(function() {
                            setupDropdown('dropdownContent', 'warning', svgSuccess + 'No action defined for this message.', 'click');
                        }, 500);
                }
              } else if (button.classList.contains('cancel')) {
                // Cancel button clicked, do nothing
                 setTimeout(function() {
                            setupDropdown('dropdownContent', 'danger', svgSuccess + 'Action canceled!', 'click');
                        }, 500);
                
              }
            });
        });
        
        
     var todaysDate = new Date().toISOString().split('T')[0];
      
      table =  $('#tlbTransaction').DataTable({
      paging: false, // Hide pagination
      searching: false, // Hide search
      "order": [],
	  language: {
        //info: "Displaying _START_ to _END_ of _TOTAL_ entries"
		info: "Total _TOTAL_ entries (Click to change Type and Status)"
      },
      "ajax": {
                    method: 'POST',
                    "url": "../controller/payment_schedule/payment_schedule_controller.php",
                    dataType: 'json',
                    "data": function (d) {
                        d.action = 'get_schedule_list';
                        d.selected_date = todaysDate;
                    },
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
          
            Calculations();
        }
        // "drawCallback": function(settings) {
        //      Calculations();
        // }
	  
	  
    });



	  //$('#tlbTransaction').on('dblclick', '.sands-badge-grid', function(button) {
	  $('#tlbTransaction').on('click', '.sands-badge-grid', function(button) {
	                var rowData = table.row($(this).closest('tr')).data();
	               
					var statusElement = $(this);
					var currentStatus = statusElement.text().trim(); // Get the current status
					var newStatus = (currentStatus === "Approved") ? "Not Approved" : "Approved"; // Toggle the status
				
					// Set confirmation message in popup
					//$('#message_matter').html("Are you sure you want to change the status to '" + newStatus + "'?");
					$(".otherContent").empty();
					SaNDSAlert("Are you sure you want to change the status to '" + newStatus + "'?",'ChangeStatus','warning','#60A200','Confirm','Do nothing');
					
					// Save the status element and new status in data attributes for access in the button click event
					$('#popupContainer').data('statusElement', statusElement);
					$('#popupContainer').data('newStatus', newStatus);
					$('#popupContainer').data('clickRowId', rowData['ids']);
					
		
				  
				  
		});
	
	    function ChangeStatus()
	    {
	            var statusElement = $('#popupContainer').data('statusElement');
                var newStatus = $('#popupContainer').data('newStatus');
                var row_Id = $('#popupContainer').data('clickRowId');
               
                // OK button clicked, perform action
                statusElement.removeClass("sands-text-bg-success sands-text-bg-danger"); // Remove existing classes
                statusElement.addClass((newStatus === "Approved") ? "sands-text-bg-success" : "sands-text-bg-danger"); // Add appropriate class based on the new status
                statusElement.text(newStatus); // Update the status text
                
               

                $.post("../controller/payment_schedule/payment_schedule_controller.php",{action:"change_status",v_newStatus:newStatus,v_rowId:row_Id},function(result,status){
                     // Find the row index corresponding to the status element
                     var rowIndex = statusElement.closest('tr').index();
                    
                    // Update the DataTable's internal data structure
                    table.cell(rowIndex, 6).data(newStatus);
                    
                    // Optionally, redraw the DataTable to reflect the changes
                    table.draw();
                        setTimeout(function() {
                         
                        // Retrieve the column data
                          var columnData = table.column(6).data(); // Assuming the status column is the 7th column (index 6)
                          
                    
                        //CalculationsAfterUpdate(columnData);
                        Calculations();
                         setupDropdown('dropdownContent','success',svgSuccess+'Status Changed Successfully..!','click');
                    }, 500); // Adjust the delay time as needed
                    LoadCalender();
                })
                
              
                
                
                
	    }
		
	
// 	Change Status 
        $('#tlbTransaction').on('click', '.sands-badge-grid-1', function(button) {
			       
			    // Set confirmation message in popup
					//$('#message_matter-change-type').html("Are you sure you want to change the status to '" + newStatus + "'?");
					var statusElement = $(this);
					 var rowData = table.row($(this).closest('tr')).data();
                    $('#popupContainer').data('statusElementChangeType', statusElement);
                    $('#popupContainer').data('clickPaymentMethod', rowData['ids']);
				    $(".otherContent").empty();
				    $(".otherContent").html('<div class="custom-radio"><input type="radio" id="radio1" value="Cash" name="radio-group"> <label for="radio1">Cash</label>  </div> <div class="custom-radio"> <input type="radio" id="radio2" value="Cheque" name="radio-group"> <label for="radio2">Cheque</label> </div><div class="custom-radio"><input type="radio" id="radio3" value="Bank Transfer" name="radio-group"> <label for="radio3">Bank Transfer</label></div>');
			    	SaNDSAlert("Are you sure you want to change the Type?",'ChangeType','warning','#3E8BD3','Confirm','Do nothing');
				    
		});
		
		
    var radioValue='';    
    $(document).on('change', '.custom-radio input[type="radio"]', function() {
        // Get the value of the selected radio button
        radioValue = $(this).val();
        var row_Id = $('#popupContainer').data('clickPaymentMethod');		
        	    console.log(row_Id);
        	     $.post("../controller/payment_schedule/payment_schedule_controller.php",{action:"change_payment_method",v_rowId:row_Id,v_payment_method:radioValue},function(result,status){
        	     });
        
    });       
        
function ChangeType()
{
               
                    if(radioValue=='')
                    {
                         setTimeout(function() {
                             setupDropdown('dropdownContent','error',svgSuccess+'Please select type.','click');
                        }, 500); // Adjust the delay time as needed
                        return false;
                    }
                    var statusElementChangeType = $('#popupContainer').data('statusElementChangeType');
                
                
                    var rowIndex = statusElementChangeType.closest('tr').index();
                    // Update the DataTable's internal data structure/
                    table.cell(rowIndex, 0).data(radioValue);
                    
                    // Optionally, redraw the DataTable to reflect the changes
                    table.draw()
                   
                setTimeout(function() {
                     setupDropdown('dropdownContent','success',svgSuccess+'Type Changed Successfully..!','click');
                }, 500); // Adjust the delay time as needed
                LoadCalender();
        
}
	
	// Delete Items
         $('#tlbTransaction').on('click', '.sands-delete-icon', function() {
              var rowData = table.row($(this).closest('tr')).data();
            var statusElement = $(this);
            $('#popupContainer').data('statusElementDelete', statusElement);
            $(".otherContent").empty();
          	SaNDSAlert("Are you sure you want delete this row?",'DeleteData','danger','#DE3E3E','Confirm','Do nothing');
			$('#popupContainer').data('clickRowIdForDelete', rowData['ids']);		
        });
        
        
        
function DeleteRowFromTheTable()
{
                var statusElementDelete = $('#popupContainer').data('statusElementDelete');
                var row = statusElementDelete.closest('tr');
                 var rowData = table.row($(this).closest('tr')).data();
        	    console.log(row);
        	     var row_Id = $('#popupContainer').data('clickRowIdForDelete');		
        	    
        	     $.post("../controller/payment_schedule/payment_schedule_controller.php",{action:"delete_row",v_rowId:row_Id},function(result,status){
              
                        table = $('#tlbTransaction').DataTable();
                        table.row(row).remove().draw();
                
                        setTimeout(function() {
                             Calculations();
                            setupDropdown('dropdownContent', 'success', svgSuccess + 'Data Deleted Successfully..!', 'click');
                        }, 500);
                        LoadCalender();
        	     });
}    
      


//   $('#tlbTransaction tbody td.truncate-tooltip').mouseenter(function(e) {
   $(document).on('mouseenter', 'td.truncate-tooltip', function(e) {
     
    //var tooltipHtml = $(this).html();
    var tooltipHtml =$(this).attr('data-customer-name');// Get HTML content of the cell
  
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
  
  
  
  
$(document).ready(function() {
    // Event delegation for clicking the edit icon
    $(document).on('click', '.edit-icon', function(event) {
        event.stopPropagation(); // Stop event propagation to prevent immediate execution of outside click handler
        var rowData = table.row($(this).closest('tr')).data();
        console.log(rowData);
            	    console.log(rowData['ids']);
            	    var row_Id = rowData['ids'];
        
        var cell = $(this).closest('td');
        var dateText = cell.find('.date-display').text();
        var input = $('<input type="date" class="date-input" style="width:100px;">');
        input.val(convertDateFormat(dateText)); // Convert the date to "YYYY-MM-DD" format
        cell.find('.date-display').replaceWith(input);

        // Event listener for clicking outside the date input
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.date-input').length) {
                // Check if any date was selected
                if (!input.val()) {
                    // Revert to the old date
                    cell.find('.date-input').replaceWith('<span class="date-display">' + dateText + '</span>');
                } else {
                    // Update the displayed date in the cell
                    var selectedDate = input.val();
                    cell.find('.date-input').replaceWith('<span class="date-display">' + formatDate(selectedDate) + '</span>');
                   
                }
            }
        });

        // Event listener for changing the date input
        input.on('change', function() {
            // Update the displayed date in the cell
            var selectedDate = $(this).val();
            cell.find('.date-input').replaceWith('<span class="date-display">' + formatDate(selectedDate) + '</span>');
              
            	     $.post("../controller/payment_schedule/payment_schedule_controller.php",{action:"change_due_date",v_chq_date:selectedDate,v_rowId:row_Id},function(result,status){
                            setupDropdown('dropdownContent','success',svgSuccess+'Changed Successfully..!','click');
                            LoadCalender();
                    });
            
        });
    });
});

// Function to convert date format from "DD-Mon-YYYY" to "YYYY-MM-DD"
function convertDateFormat(dateText) {
    var parts = dateText.split('-');
    var year = parts[2];
    var month = parts[1];
    var day = parts[0];
    return year + '-' + month + '-' + day;
}

// Function to format date to "DD-Mon-YYYY" format
function formatDate(selectedDate) {
    var parts = selectedDate.split('-');
    var year = parts[0];
    var month = parts[1];
    var day = parts[2];
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return day + '-' + months[parseInt(month) - 1] + '-' + year;
}




 $(document).ready(function() {
    // Event listener for clicking the edit icon
    let changeStatus =0;
    $(document).on('click', '.edit-ref-number-icon', function(event) {
        event.stopPropagation(); // Prevent event bubbling
         var rowData = table.row($(this).closest('tr')).data();
	    console.log(rowData['ids']);
	    var row_Id = rowData['ids'];
        changeStatus =0;
        var cell = $(this).closest('td');
        
        var originalText = cell.find('.reference-num-display').text();
        var input = $('<input type="text" class="edit-reference-input" style="width:100px;">');
        input.val(originalText);
        cell.find('.reference-num-display').replaceWith(input);

        // Event listener for pressing the Enter key
        input.on('keypress', function(event) {
            if (event.which === 13) { // 13 is the key code for Enter key
              
                $.post("../controller/payment_schedule/payment_schedule_controller.php",{action:"change_ref_no",v_chq_ref_no:input.val(),v_rowId:row_Id},function(result,status){
                     // Find the row index corresponding to the status element
                     updateText(input, cell);
                });  
            
                
            }
        });

        // Event listener for clicking outside the text input
        $(document).on('click', function(event) {
           
            if (!$(event.target).closest('.edit-reference-input').length) {
              
                updateText(input, cell);
            }
        });
    });

    // Function to update the text based on the input field
    function updateText(input, cell) {
        var newText = input.val();
        cell.find('.edit-reference-input').replaceWith('<span class="reference-num-display">' + newText + '</span>');
        if(changeStatus===0)
        {
            setupDropdown('dropdownContent','success',svgSuccess+'Changed Successfully..!','click');
            changeStatus = 1;
        }
    }
});








// $('.edit-icon').on('click', function() {
//     // Here, you can trigger the display of a calendar popup
//     var statusElement = $(this);
//     $('#popupContainer').data('statusElementChangeType', statusElement);
//     $(".otherContent").empty();
//     $(".otherContent").html('<div class=""><input type="calender" id="date_calender" > </div>');
// 	SaNDSAlert("Are you sure you want to change the Date?",'DateChange','warning','#3E8BD3','Confirm','Do nothing');
// });

    
      
  });
  
 