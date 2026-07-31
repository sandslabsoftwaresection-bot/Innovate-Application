<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendar Interface</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/popup.css">
<link rel="stylesheet" type="text/css" href="css/dropdown.css">
<style>
  #tlbTransaction td:nth-child(4) {
    text-align: right; /* Align text in the 4th column to the right */
  }
   #tlbTransaction td:nth-child(5) {
    text-align: right;
  }
  
.custom-radio {
  display: inline-block;
  margin-right: 10px;
}

.custom-radio input[type="radio"] {
  display: none; /* Hide the default radio button */
}

.custom-radio label {
  display: inline-block;
  padding: 5px 10px;
  cursor: pointer;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size:12px;
}

.custom-radio input[type="radio"]:checked + label {
  background-color: #007bff;
  color: #fff;
}


.popup-header {
  cursor: move; /* Make the header draggable */
}


.sands-delete-icon {
  width: 20px;
  height: 20px;
  background-color: red;
  border-radius: 50%;
  position: relative;
  cursor: pointer;
}

.sands-delete-icon:before,
.sands-delete-icon:after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 60%;
  height: 2px;
  background-color: white;
}

.sands-delete-icon:before {
  transform: translate(-50%, -50%) rotate(45deg);
}

.sands-delete-icon:after {
  transform: translate(-50%, -50%) rotate(-45deg);
}



</style>
</head>
<body>
<!--Drop Down Message-->
<div id="dropdownContent" style="text-align:center;">
  <!-- Content of your dropdown -->
</div>
<!--Popup-->

<div class="popup-overlay" id="popupOverlay"></div>

<div class="popup-container" id="popupContainer">
    <div class="popup-header" style="background-color: #C6C6C6;">
        <div class="sands-container">
          <span class="sands-text">Confirmation</span>
          <div class="sands-close-button cancel">x</div>
        </div>
    </div>
  <div class="popup-content">
    <p id="message_matter">Are you sure you want to change the status?</p>
    <div class="popup-buttons">
      <button class="ok">OK</button>
      <button class="cancel">Cancel</button>
    </div>
  </div>
</div>

<div class="popup-container-change-type" id="popupContainerChangeType">
    <div class="popup-header" style="background-color: #C6C6C6;">
        <div class="sands-container">
          <span class="sands-text">Confirmation</span>
          <div class="sands-close-button cancel">x</div>
        </div>
    </div>
  <div class="popup-content-change-type">
    <p id="message_matter-change-type">Are you sure you want to change the type?</p>
    
    
    <div class="custom-radio">
      <input type="radio" id="radio1" value="Cash" name="radio-group">
      <label for="radio1">Cash</label>
    </div>
    <div class="custom-radio">
      <input type="radio" id="radio2" value="Cheque" name="radio-group">
      <label for="radio2">Cheque</label>
    </div>
    <div class="custom-radio">
      <input type="radio" id="radio3" value="Bank Transfer" name="radio-group">
      <label for="radio3">Bank Transfer</label>
    </div>
    
    
    <div class="popup-buttons-change-type">
      <button class="ok">Confirm</button>
      <button class="cancel">Cancel</button>
    </div>
  </div>
</div>





<div class="popup-container-delete" id="popupContainerDelete">
    <div class="popup-header" style="background-color: #C6C6C6;">
        <div class="sands-container">
          <span class="sands-text">Confirmation</span>
          <div class="sands-close-button cancel">x</div>
        </div>
    </div>
  <div class="popup-content-delete">
    <p id="message_matter">Are you sure you want to delete the transaction?</p>
    <div class="popup-buttons-delete">
      <button class="ok">OK</button>
      <button class="cancel">Cancel</button>
    </div>
  </div>
</div>
<!--Popup Ends Here -->



<div class="container-fluid">

<div class="row" >
	<div class="col-3">
		<div class="sandscalendar">
			<div class="sandsdropdown">
					<select id="sandsMonthSelect" onchange="changeMonth(this.value)">
						<!-- You can generate the month options dynamically if needed -->
					</select>
					<select id="sandsYearSelect" onchange="changeYear(this.value)">
						<!-- You can generate the year options dynamically if needed -->
					</select>
				</div>
			   
			  <div class="sands-month">
				<div class="sands-prev">&#10094;</div>
					<div class="sands-month-name"></div>
				<div class="sands-next">&#10095;</div>
			  </div>
			  <div>
			  <ul class="sands-weekdays">
				<li>Sun</li>
				<li>Mon</li>
				<li>Tue</li>
				<li>Wed</li>
				<li>Thu</li>
				<li>Fri</li>
				<li>Sat</li>
			  </ul>
			  </div>
			  <div>
			  <ul class="sands-days"> </ul>
			  </div>
		</div>
	</div>
	<div class="col-9" >
			<div class="row" style="padding: 20px;">
				<div class="col-6">
					<div class="row">
						<div class="col-12 text-font-15-px" style="text-align:center">
							Income
						</div>
					</div>
					<div class="row">
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-left: 1px solid #D8D8D8;text-align: center;">
							<div id="sumApproved" class="text-font-12-px" style="padding-top: 10px;"></div>
						</div>
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-right: 1px solid #D8D8D8;text-align: center;">
							<div id="sumNotApproved" class="text-font-12-px" style="padding-top: 10px;"></div>
						</div>
					</div>
				</div>
				
				<div class="col-6">
						
					<div class="row">
						<div class="col-12 text-font-15-px" style="text-align:center">
							Expense
						</div>
					</div>
					<div class="row">
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-left: 0px solid #D8D8D8;text-align: center;">
							<div id="sumApprovedExp" class="text-font-12-px" style="padding-top: 10px;"></div>
						</div>
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-right: 1px solid #D8D8D8;text-align: center;">
							<div id="sumNotApprovedExp" class="text-font-12-px" style="padding-top: 10px;"></div>
						</div>
					</div>
				
						
				</div>
			</div>
	
		<table id="tlbTransaction" class="table table-striped table-bordered sands-dataTable">
		  <thead>
			<tr>
			  <th>Type</th>
			  <th>Cheque/Ref No</th>
			  <th>Date</th>
			  <th>Income</th>
			  <th>Expense</th>
			  <th>Head</th>
			  <th>Status</th>
			  <th>From/To</th>
			  <th><div class="sands-delete-icon"></div></th>
			</tr>
			
		  </thead>
		  <tbody>
			<tr>
			  <td>Federal Bank</td>
			  <td>C1524526</td>
			  <td>25-May-2024</td>
			  <td>0.000</td>
			  <td>10.256</td>
			  <td>Eletricity</td>
			  <td>Approved</td>
			  <td>Syskode</td>
			  <th><div class="sands-delete-icon"></div></th>
			</tr>
			<tr>
			  <td>Bank Transfer</td>
			  <td>C1524526</td>
			  <td>25-May-2024</td>
			  <td>100.256</td>
			  <td>0.000</td>
			  <td>Invoice Paid</td>
			  <td>Approved</td>
			  <td>Syskode</td>
			  <th><div class="sands-delete-icon"></div></th>
			</tr>
			<tr>
			  <td>Federal Bank</td>
			  <td>C1000125</td>
			  <td>15-May-2024</td>
			  <td>0.000</td>
			  <td>15.006</td>
			  <td>Travel</td>
			  <td>Approved</td>
			  <td>Innovate</td>
			  <th><div class="sands-delete-icon"></div></th>
			</tr>
			<tr>
			  <td>By Cash</td>
			  <td>C1000125</td>
			  <td>15-May-2024</td>
			  <td>125.006</td>
			  <td>0.000</td>
			  <td>Invoice</td>
			  <td>Not Approved</td>
			  <td>Innovate</td>
			  <th><div class="sands-delete-icon"></div></th>
			</tr>
			<tr>
			  <td>Federal Bank</td>
			  <td>C100006</td>
			  <td>25-May-2024</td>
			  <td>0.000</td>
			  <td>212.256</td>
			  <td>Salary</td>
			  <td>Not Approved</td>
			  <td>Saphair</td>
			  <th><div class="sands-delete-icon"></div></th>
			</tr>
			<tr>
			  <td>Federal Bank</td>
			  <td>C1125256</td>
			  <td>25-May-2024</td>
			  <td>0.000</td>
			  <td>178.256</td>
			  <td>Rent</td>
			  <td>Approved</td>
			  <td>Abc Company </td>
			  <th><div class="sands-delete-icon"></div></th>
			</tr>
			<!-- You can add more rows here -->
		  </tbody>
		  <tfoot>
			<tr>
			  <th colspan="3" style="text-align:right">Total:</th>
			  <th style="text-align:right"></th>
			  <th style="text-align:right"></th>
			  <th colspan="2" style="text-align:right"></th>
			 
			</tr>
		  </tfoot>
		</table>
			
	</div>
</div>
<div id="sum"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/settings.js?timestamp=<?php echo time(); ?>"></script>
<script type="text/javascript" src="js/messagedropdown.js?timestamp=<?php echo time(); ?>"></script>

<script>


  $(document).ready(function() {
      // Popup Moments 
  var popupContainer = document.getElementById('popupContainer, popup-container-change-type, popup-container-delete');
  var popupHeader = document.querySelector('.popup-header');
  var isDragging = false;
  var offset = { x: 0, y: 0 };

  popupHeader.addEventListener('mousedown', function(e) {
    isDragging = true;
    offset.x = e.clientX - popupContainer.offsetLeft;
    offset.y = e.clientY - popupContainer.offsetTop;
  });

  document.addEventListener('mousemove', function(e) {
    if (isDragging) {
      var newX = e.clientX - offset.x;
      var newY = e.clientY - offset.y;
      popupContainer.style.left = newX + 'px';
      popupContainer.style.top = newY + 'px';
    }
  });

  document.addEventListener('mouseup', function() {
    isDragging = false;
  });
      
      //POpupMoment Ends Here
      
      
      
      
      
      
     var table =  $('#tlbTransaction').DataTable({
      paging: false, // Hide pagination
      searching: false, // Hide search
      "order": [],
	  language: {
        //info: "Displaying _START_ to _END_ of _TOTAL_ entries"
		info: "Total _TOTAL_ entries (Click to change Type and Status)"
      },
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
        { targets: '_all', orderable: false }
        ]
	  
    });
// 	var sum = 0;
//     table.column(3).data().each(function(value) {
//       sum += parseFloat(value);
//     });

//     $('#sum').text('Sum of 4th column: ' + sum.toFixed(3)); // Display the sum
    Calculations();
function Calculations()
{
    console.log('Calculation Starts');
	var sumApproved = 0;
    var sumNotApproved = 0;
	
	var sumApproved_Exp = 0;
    var sumNotApproved_Exp = 0;
        
		table.rows().every(function() {
			  var data = this.data();
			  //console.log(data);
			  var status = data[6]; // Get the value from the 5th column
			 
			  var value = parseFloat(data[3]); // Get the value from the 4th column and convert to float
			  if (status === "Approved") {
				sumApproved += value;
			  } else if (status === "Not Approved") {
				sumNotApproved += value;
			  }
			  
			  var valueExpense = parseFloat(data[4]); // Get the value from the 4th column and convert to float
			  if (status === "Approved") {
				sumApproved_Exp += valueExpense;
			  } else if (status === "Not Approved") {
				sumNotApproved_Exp += valueExpense;
			  }
		});
        console.log(sumApproved);
		$('#sumApproved').html('<span class="sands-badge sands-text-bg-success">Approved<span> Total: ' + sumApproved.toFixed(3));
		$('#sumNotApproved').html('<span class="sands-badge sands-text-bg-danger">Not Approved<span> Total: ' + sumNotApproved.toFixed(3));
		
		$('#sumApprovedExp').html('<span class="sands-badge sands-text-bg-success">Approved<span> Total: ' + sumApproved_Exp.toFixed(3));
		$('#sumNotApprovedExp').html('<span class="sands-badge sands-text-bg-danger">Not Approved<span> Total: ' + sumNotApproved_Exp.toFixed(3));
   
}// Calculations Close

	  //$('#tlbTransaction').on('dblclick', '.sands-badge-grid', function(button) {
	  $('#tlbTransaction').on('click', '.sands-badge-grid', function(button) {		 
					var statusElement = $(this);
					var currentStatus = statusElement.text().trim(); // Get the current status
					var newStatus = (currentStatus === "Approved") ? "Not Approved" : "Approved"; // Toggle the status
				
					// Set confirmation message in popup
					$('#message_matter').html("Are you sure you want to change the status to '" + newStatus + "'?");
					
					// Save the status element and new status in data attributes for access in the button click event
					$('#popupContainer').data('statusElement', statusElement);
					$('#popupContainer').data('newStatus', newStatus);
					
					var popupOverlay = document.getElementById('popupOverlay');
					var popupContainer = document.getElementById('popupContainer');
					popupOverlay.style.display = 'block';
					popupContainer.style.display = 'block';
					
				//}
				  
				  
				  
		});
		
		
		document.querySelectorAll('.popup-buttons button, .sands-close-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var popupOverlay = document.getElementById('popupOverlay');
            var popupContainer = document.getElementById('popupContainer');
            popupOverlay.style.display = 'none';
            popupContainer.style.display = 'none';


            // Check which button was clicked
            if (button.classList.contains('ok')) {
                
                var statusElement = $('#popupContainer').data('statusElement');
                var newStatus = $('#popupContainer').data('newStatus');
               
                // OK button clicked, perform action
                statusElement.removeClass("sands-text-bg-success sands-text-bg-danger"); // Remove existing classes
                statusElement.addClass((newStatus === "Approved") ? "sands-text-bg-success" : "sands-text-bg-danger"); // Add appropriate class based on the new status
                statusElement.text(newStatus); // Update the status text
                console.log('Checking');
 
                // Find the row index corresponding to the status element
                    var rowIndex = statusElement.closest('tr').index();
                    console.log('Row Index: ' + rowIndex);

                    // Update the DataTable's internal data structure
                    table.cell(rowIndex, 6).data(newStatus);
                    
                    // Optionally, redraw the DataTable to reflect the changes
                    table.draw();
                
              
                setTimeout(function() {
                     
                    // Retrieve the column data
                      var columnData = table.column(6).data(); // Assuming the status column is the 7th column (index 6)
                        console.log(columnData)
                
                    //CalculationsAfterUpdate(columnData);
                    Calculations();
                     setupDropdown('dropdownContent','success',svgSuccess+'Status Changed Successfully..!','click');
                }, 500); // Adjust the delay time as needed
                
                console.log(table.data().toArray());
                
            } else if (button.classList.contains('cancel')) {
                // Cancel button clicked, do nothing
                //alert('Action canceled!');
                setTimeout(function() {
                    setupDropdown('dropdownContent','error',svgError+'User cancelled the status change.','click');
                }, 500); // Adjust the delay time as needed
            }
        });
    });
	
// 	Change Status 
        $('#tlbTransaction').on('click', '.sands-badge-grid-1', function(button) {
			 
			    // Set confirmation message in popup
					//$('#message_matter-change-type').html("Are you sure you want to change the status to '" + newStatus + "'?");
					var statusElement = $(this);
                    $('#popupContainerChangeType').data('statusElementChangeType', statusElement);
				
					var popupOverlay = document.getElementById('popupOverlay');
					var popupContainer = document.getElementById('popupContainerChangeType');
					popupOverlay.style.display = 'block';
					popupContainer.style.display = 'block';	    
			
				  
		});
		
        var radioValue='';
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(button => {
          button.addEventListener('change', function() {
            if (this.checked) {
              console.log("Selected option: " + this.value);
              radioValue=this.value;
            }
          });
        });
        
		document.querySelectorAll('.popup-buttons-change-type, .sands-close-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var popupOverlay = document.getElementById('popupOverlay');
            var popupContainer = document.getElementById('popupContainerChangeType');
            popupOverlay.style.display = 'none';
            popupContainer.style.display = 'none';


            // Check which button was clicked
            if (button.classList.contains('ok')) {
                    if(radioValue=='')
                    {
                         setTimeout(function() {
                             setupDropdown('dropdownContent','error',svgSuccess+'Please select type.','click');
                        }, 500); // Adjust the delay time as needed
                        return false;
                    }
                    var statusElementChangeType = $('#popupContainerChangeType').data('statusElementChangeType');
                
                
                    var rowIndex = statusElementChangeType.closest('tr').index();
                    // Update the DataTable's internal data structure/
                    table.cell(rowIndex, 0).data(radioValue);
                    
                    // Optionally, redraw the DataTable to reflect the changes
                    table.draw()
                
                setTimeout(function() {
                     setupDropdown('dropdownContent','success',svgSuccess+'Type Changed Successfully..!','click');
                }, 500); // Adjust the delay time as needed
                
               // console.log(table.data().toArray());
                
            } else if (button.classList.contains('cancel')) {
                
                setTimeout(function() {
                    setupDropdown('dropdownContent','error',svgError+'User cancelled the Type change.','click');
                }, 500); // Adjust the delay time as needed
            }
        });
    });
		
	
	
	// Delete Items
         $('#tlbTransaction').on('click', '.sands-delete-icon', function() {
            var statusElement = $(this);
            $('#popupContainerDelete').data('statusElementDelete', statusElement);
        
            var popupOverlay = document.getElementById('popupOverlay');
            var popupContainer = document.getElementById('popupContainerDelete');
            popupOverlay.style.display = 'block';
            popupContainer.style.display = 'block';
        });
        
        $('.popup-buttons-delete button, .sands-close-button').on('click', function(event) {
            var button = event.target;
            //console.log('Button clicked:', button);
            
            var popupOverlay = document.getElementById('popupOverlay');
            var popupContainer = document.getElementById('popupContainerDelete');
            popupOverlay.style.display = 'none';
            popupContainer.style.display = 'none';
        
            if ($(button).hasClass('ok')) {
                console.log('OK button clicked');
                
                var statusElementDelete = $('#popupContainerDelete').data('statusElementDelete');
                var row = statusElementDelete.closest('tr');
        
                var table = $('#tlbTransaction').DataTable();
                table.row(row).remove().draw();
        
                setTimeout(function() {
                    setupDropdown('dropdownContent', 'success', svgSuccess + 'Data Deleted Successfully..!', 'click');
                }, 500);
            } else if ($(button).hasClass('cancel')) {
                console.log('Cancel button clicked');
                
                setTimeout(function() {
                    setupDropdown('dropdownContent', 'error', svgError + 'User cancelled the transaction', 'click');
                }, 500);
            }
        });


    
    
    
    
	
  });
</script>

	



<script src="js/script.js"></script>
<script>
  // Declare a global variable and assign the highlightedDates array
  const highlightedDates = [['2024-02-25',0], ['2024-02-28',3], ['2024-03-15',48], ['2024-03-25',0],['2024-03-05',0]];
  showCalendar(currentMonth, currentYear);
</script>

</body>
</html>
