<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Calendar Interface</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/styles.css">
<style>
  #example td:nth-child(4) {
    text-align: right; /* Align text in the 4th column to the right */
  }
   #example td:nth-child(5) {
    text-align: right;
  }
  
 /* Popup container */
  .popup-container {
    display: none; /* Initially hidden */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    z-index: 1000;
  }
  
  /* Popup overlay */
  .popup-overlay {
    display: none; /* Initially hidden */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
  }
  
  /* Popup content */
  .popup-content {
    text-align: center;
  }
  
  /* Popup buttons */
  .popup-buttons {
    margin-top: 20px;
  }
  
  .popup-buttons button {
    padding: 10px 20px;
    margin: 0 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
  
  .popup-buttons button.ok {
    background-color: #28a745;
    color: #fff;
  }
  
  .popup-buttons button.cancel {
    background-color: #dc3545;
    color: #fff;
  }
</style>
</head>
<body>
<!--Popup-->

<div class="popup-overlay" id="popupOverlay"></div>

<div class="popup-container" id="popupContainer">
  <div class="popup-content">
    <p id="message_matter">Are you sure you want to change the status?</p>
    <div class="popup-buttons">
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
	
		<table id="example" class="table table-striped table-bordered sands-dataTable">
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

<script>
  $(document).ready(function() {
     var table =  $('#example').DataTable({
      paging: false, // Hide pagination
      searching: false, // Hide search
	  language: {
        //info: "Displaying _START_ to _END_ of _TOTAL_ entries"
		info: "Total _TOTAL_ entries"
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
        targets: 6, // Targeting the 5th column
        render: function(data, type, row) {
          if (data === "Approved") {
            return '<span class="sands-badge-grid sands-text-bg-success">Approved</span>';
          } else if (data === "Not Approved") {
            return '<span class="sands-badge-grid sands-text-bg-danger">Not Approved</span>';
          } else {
            return data;
          }
        }
      }]
	  
    });
	var sum = 0;
    table.column(3).data().each(function(value) {
      sum += parseFloat(value);
    });

    $('#sum').text('Sum of 4th column: ' + sum.toFixed(3)); // Display the sum
	
	var sumApproved = 0;
    var sumNotApproved = 0;
	
	var sumApproved_Exp = 0;
    var sumNotApproved_Exp = 0;

		table.rows().every(function() {
			  var data = this.data();
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

		$('#sumApproved').html('<span class="sands-badge sands-text-bg-success">Approved<span> Total: ' + sumApproved.toFixed(3));
		$('#sumNotApproved').html('<span class="sands-badge sands-text-bg-danger">Not Approved<span> Total: ' + sumNotApproved.toFixed(3));
		
		$('#sumApprovedExp').html('<span class="sands-badge sands-text-bg-success">Approved<span> Total: ' + sumApproved_Exp.toFixed(3));
		$('#sumNotApprovedExp').html('<span class="sands-badge sands-text-bg-danger">Not Approved<span> Total: ' + sumNotApproved_Exp.toFixed(3));
   
   
   
	  $('#example').on('dblclick', '.sands-badge-grid', function(button) {
			 
					var statusElement = $(this);
					var currentStatus = statusElement.text().trim(); // Get the current status
					var newStatus = (currentStatus === "Approved") ? "Not Approved" : "Approved"; // Toggle the status
					
					var popupOverlay = document.getElementById('popupOverlay');
					var popupContainer = document.getElementById('popupContainer');
					popupOverlay.style.display = 'block';
					popupContainer.style.display = 'block';
					
					// Set confirmation message in popup
					$('#message_matter').html("Are you sure you want to change the status to '" + newStatus + "'?");
					
					// Save the status element and new status in data attributes for access in the button click event
					$('#popupContainer').data('statusElement', statusElement);
					$('#popupContainer').data('newStatus', newStatus);
				//}
				  
				  
				  
		});
		
		document.querySelectorAll('.popup-buttons button').forEach(function(button) {
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
                // You may want to perform further actions here, such as updating the DataTable or sending an AJAX request to update the backend
                //alert('Status changed!');
            } else if (button.classList.contains('cancel')) {
                // Cancel button clicked, do nothing
                //alert('Action canceled!');
            }
        });
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
