
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
			<div class="row" >
                        <div class="col-3 col-md-4">
                            <label>Select Date</label>
                            <input type="text" class="form-control daterange w-100" name="daterange" value="<?PHP echo date('Y-m-d')?>" id="txt_date_range">
                        </div>
                        <div class="col-2 col-md-1" style="padding-top:30px;padding-left:-10px;">
                            <button type="button" class="mb-2 box-shadow mr-2 btn btn-primary " id="btn_search"><span class="material-icons">search</span></button>
                            
                        </div>
                        <div class="col-2 col-md-1" style="padding-top:30px;padding-left:-10px;">
                            <button type="button" class="mb-2 box-shadow mr-2 btn btn-secondary " id="btn_print"><span class="material-icons">print</span></button>
                            
                        </div>
						<div class="col-3 text-font-15-px" style="text-align:right;padding-top:40px;">
							Cash Balance
						</div>
						<div class="col-2" id="cash_balance" style="margin-top:30px;padding-top:10px;border: 1px solid #D8D8D8;text-align: center;background-color: #F5C400; height: 45px;font-size:20px; font-weight: bold;">
							0.000
						</div>
			</div>
			<div class="row" style="padding: 5px;">
				<div class="col-6">
					<div class="row">
						<div class="col-12 text-font-15-px" style="text-align:center">
							Credit
						</div>
					</div>
					<div class="row">
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-right: 1px solid #D8D8D8;text-align: center;">
							<div id="creditEntry" class="text-font-12-px" style="padding-top: 10px;"><span style="cursor: pointer;" class="sands-badge sands-text-bg-success">Credit Entry <span></div>
						</div>
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-left: 1px solid #D8D8D8;text-align: center;">
							<div id="sumApproved" class="text-font-12-px" style="padding-top: 10px;"><span class="sands-badge sands-text-bg-success">Credit<span> Total: 0.000</div>
						</div>
						
					</div>
				</div>
				
				<div class="col-6">
						
					<div class="row">
						<div class="col-12 text-font-15-px" style="text-align:center">
							Debit
						</div>
					</div>
					<div class="row">
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-right: 1px solid #D8D8D8;text-align: center;">
							<div id="debitEntry" class="text-font-12-px" style="padding-top: 10px;"><span style="cursor: pointer;" class="sands-badge sands-text-bg-danger">Debit Entry <span></div>
						</div>
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-left: 0px solid #D8D8D8;text-align: center;">
							<div id="sumApprovedExp" class="text-font-12-px" style="padding-top: 10px;"><span class="sands-badge sands-text-bg-danger">Debit<span> Total: 0.000</div>
						</div>
						
					</div>
				
						
				</div>
			</div>
	
		<table id="tbl_cashbook" class="table table-striped table-bordered sands-dataTable">
		  <thead>
			<tr>
			  <th>Description</th>
			  <th>Date</th>
			  <th>Credit</th>
			  <th>Debit</th>
			  <th>Status</th>
			  <th>Remarks</th>
			  <th><div class="sands-delete-icon" ></div></th>
			  <th>Action</th>
			</tr>
			
		  </thead>
		  <tbody>
			
			
			<!-- You can add more rows here -->
		  </tbody>
		  <tfoot>
			<tr>
			  <th colspan="2" style="text-align:right">Total:</th>
			  <th style="text-align:right"></th>
			  <th style="text-align:right"></th>
			  <th colspan="3" style="text-align:right"></th>
			 
			</tr>
		  </tfoot>
		</table>
			
	</div>
</div>
<div id="sum"></div>


<div id="popupWindowCredit" class="popupWindow" style="display: none;">
	<div class="speechBubble">
		<button class="closeButton">X</button>
	  <div class="speechIcon"></div>
		<div class="textbox-container">
		  <input type="text" class="sandsTextBox" id="txt_credit" placeholder="Credit Amount">
		  <button id="btn_credit" class="sandsButton">Save</button>
		  
		</div>
		<div class="textbox-container" style="padding-top:10px;">
		  <textarea id="txt_credit_description" name="txt_credit_description" rows="4" style="width:100%"></textarea>
		</div>


	</div>
</div>

<div id="popupWindowDebit" class="popupWindow" style="display: none;">
	<div class="speechBubble">
		<button class="closeButton">X</button>
	  <div class="speechIcon"></div>
	  
		<div class="textbox-container">
		  <input type="text" class="sandsTextBox" id="txt_debit" placeholder="Debit Amount">
		  <button id="btn_debit" class="sandsButton">Save</button>
		  
		</div>
		<div class="textbox-container" style="padding-top:10px;">
		  <textarea id="txt_debit_description" name="txt_debit_description" rows="4" style="width:100%"></textarea>
		</div>
	  
	</div>
</div>

</div>
<div class="modal fade" id="add_remarks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Remarks</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Modal body content goes here -->
        <textarea id="txt_remarks" name="txt_remarks" style="width:100%"></textarea>
        <input type="hidden" class="sandsTextBox" id="hidden_ids">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_add_remarks">Add Remarks</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="../permissions/js/messagedropdown.js?timestamp=<?php echo time(); ?>"></script>
<script>
  $(document).ready(function() {
      
      
      
      var table =  $('#tbl_cashbook').DataTable({
     
      pageLength: 50,
      "lengthChange": false,
      paging: true, // Hide pagination
      searching: false, // Hide search
	  "order": [],
	  language: {
        //info: "Displaying _START_ to _END_ of _TOTAL_ entries"
		info: "Total _TOTAL_ entries"
	  },
	  dom: "t<'row'<'col-12 d-flex justify-content-center'p>>"
      });
      
      
window.load_cashbook_tbl = function(v_start_date,v_end_date)
{
      if ($.fn.DataTable.isDataTable('#tbl_cashbook')) {
        $('#tbl_cashbook').DataTable().destroy();
    }
     table =  $('#tbl_cashbook').DataTable({
        
      pageLength: 50,
      "lengthChange": false,
      dom: "t<'row'<'col-12 d-flex justify-content-center'p>>",
      paging: true, // Hide pagination
      searching: false, // Hide search
	  "order": [],
	  language: {
        //info: "Displaying _START_ to _END_ of _TOTAL_ entries"
		info: "Total _TOTAL_ entries",
		zeroRecords: "No data available"
      },
	  "ajax": {
                    method: 'POST',
                    "url": "../cashbook/list_of_data.php",
                    dataType: 'json',
                    "data": function (d) {
                            d.v_start_date = v_start_date;
                            d.v_end_date = v_end_date;
                    },
                },
				"columns": [
                   
                    { "data": "description",
                      render: function(data, type, row) {
                        
                                return '<span class="sands-badge-grid-1 ">'+data+'</span>';
                      }
                        
                    },
                    { "data": "date_of_entry"},
                    { "data": "credit" },
                    { "data": "debit" },
                    { "data": "status" ,
                         render: function(data, type, row) {
                              if (data === "Credit") {
                                return '<span class="sands-badge-grid sands-text-bg-success">Credit</span>';
                              } else if (data === "Debit") {
                                return '<span class="sands-badge-grid sands-text-bg-danger">Debit</span>';
                              } 
                         }
                    },
                    { "data": "notes",
                         render: function(data, type, row) {
                              
                                return '<span id="span_remarks_'+row.ids+'">'+data+'</span>';
                              
                         }
                    },
                    { "data": "ids" ,
    				    render: function(data, type, row) {
    				        var confirm_status = row['confirm_status'];
    				       if (confirm_status === "Not Confirm") {
    				            return '<div class="sands-delete-icon sands-delete-data" data_id='+data+'></div>';
    				       }
    				       else{
    				           return '';
    				       }
    				    }
    				},
    				{ "data": "ids" ,
    				    render: function(data, type, row) {
    				        var confirm_status = row['confirm_status'];
    				       if (confirm_status === "Not Confirm") {
    				                return '<div class="checkmark_red_icon"></div>';
    				            }
    				            else if (confirm_status === "Confirm") {
    				                return '<div class="checkmark_green_icon"></div>';
    				            }
    				    }
    				},
                ],
				
				
	  
      footerCallback: function (row, data, start, end, display) {
        var api = this.api();
        var sum = api.column(2, { page: 'current' }).data().reduce(function (a, b) {
          return parseFloat(a) + parseFloat(b);
        }, 0);

        $(api.column(2).footer()).html(sum.toFixed(3));
		
		var sumof_exp = api.column(3, { page: 'current' }).data().reduce(function (a, b) {
          return parseFloat(a) + parseFloat(b);
        }, 0);
        $(api.column(3).footer()).html(sumof_exp.toFixed(3));
      },
	  columnDefs: [{
        targets: 4, // Targeting the 5th column
        render: function(data, type, row) {
          if (data === "Credit") {
            return '<span class="sands-badge-grid sands-text-bg-success">Credit</span>';
          } else if (data === "Debit") {
            return '<span class="sands-badge-grid sands-text-bg-danger">Debit</span>';
          } else {
            return data;
          }
        }
      },
      { targets: '_all', orderable: false }
      
      
      ],
	  "initComplete": function(settings, json) {
          
            Calculations();
      }
	  
    });
	

	var sum = 0;
    table.column(2).data().each(function(value) {
      sum += parseFloat(value);
    });
}
      
      
      
      
       var today = new Date();
        var year = today.getFullYear();
        var month = String(today.getMonth() + 1).padStart(2, '0'); // Month is zero-based, so add 1 and pad with 0 if needed
        var day = String(today.getDate()).padStart(2, '0'); // Pad with 0 if needed
        selected_date = year + '/' + month + '/' + day;
      load_cashbook_tbl(selected_date,selected_date);
      
             var startDate;
             var endDate;
            $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
                startDate = picker.startDate.format('YYYY-MM-DD');
                endDate = picker.endDate.format('YYYY-MM-DD');
                // Now you have the start and end date selected by the user
                console.log("Start Date: " + startDate);
                console.log("End Date: " + endDate);
            });
            $("#btn_search").click(function(){
                 load_cashbook_tbl(startDate,endDate);
            })


    //$('#sum').text('Sum of 4th column: ' + sum.toFixed(3)); // Display the sum
function Calculations()
{
	

	var sumApproved = 0;
 	
	var sumApproved_Exp = 0;
    
		table.rows().every(function() {
			
			  var data = this.data();
			  var status = data['status']; // Get the value from the 5th column
			  var value = parseFloat(data['credit']); // Get the value from the 4th column and convert to float
			  if (status === "Credit") {
				sumApproved += value;
			  }
			  var valueExpense = parseFloat(data['debit']); // Get the value from the 4th column and convert to float
			  if (status === "Debit") {
				sumApproved_Exp += valueExpense;
			  }
		});
    
		$('#sumApproved').html('<span class="sands-badge sands-text-bg-success">Credit<span> Total: ' + sumApproved.toFixed(3));
		$('#creditEntry').html('<span style="cursor: pointer;" class="sands-badge sands-text-bg-success">Credit Entry <span>');
		
		$('#sumApprovedExp').html('<span class="sands-badge sands-text-bg-danger">Debit<span> Total: ' + sumApproved_Exp.toFixed(3));
		$('#debitEntry').html('<span style="cursor: pointer;" class="sands-badge sands-text-bg-danger">Debit Entry <span>');
		
		
}	

 $.post("../cashbook/balance_amount.php", function(res) {
            var parsedData = JSON.parse(res);
             var balance = parsedData.balance; 
            console.log(balance);
            if(balance==null)
            {
                balance = '0.000';
            }
          $('#cash_balance').html(balance);
        });
   
    $('#tbl_cashbook').on('click', '.sands-text-bg-success, .sands-text-bg-danger', function() {
        var rowData = table.row($(this).closest('tr')).data();
        var status = rowData.status;
        var table_ids = rowData.ids;
        var v_remark= rowData.notes;
       var remark= $('#span_remarks_'+table_ids).html();
        $('#txt_remarks').val(remark);
         $('#add_remarks').modal('show'); 
         $('#hidden_ids').val(table_ids);
         
         
        //   $.post("../cashbook/add_remarks.php", function(res) {
           
        // });
        
    });
   
    $('#btn_add_remarks').on('click', function() {
        
         var table_id = $('#hidden_ids').val();
         var v_remark = $('#txt_remarks').val();
         
          $.post("../cashbook/add_remarks.php",{table_id:table_id,v_remark:v_remark}, function(res) {
            
                $('#span_remarks_'+table_id).html(v_remark);
                $('#hidden_ids').val("");
                $('#add_remarks').modal('hide'); 
                swal('Success',"Remarks Added Successfully","success");
               
        });
        
    });
   
	  $('#tbl_cashbook').on('click', '.sands-delete-data', function(button) {
			 
					var statusElement = $(this);
					var element = $('.sands-delete-data');

					// Read the value of the data_id attribute
					var dataIdValue = statusElement.attr('data_id');
					// var newStatus = (currentStatus === "Debit") ? "Credit" : "Debit"; // Toggle the status
				
					var popupOverlay = document.getElementById('popupOverlay');
					var popupContainer = document.getElementById('popupContainer');
					popupOverlay.style.display = 'block';
					popupContainer.style.display = 'block';
					
					//Set confirmation message in popup
					$('#message_matter').html("Are you sure you want to Delete?'");
					
					// Save the status element and new status in data attributes for access in the button click event
					$('#popupContainer').data('deleteID', dataIdValue);
					 var row = $(this).closest('tr');
					 
					 
					 var credit = row.find('td:eq(2)').text();
					 var debit = row.find('td:eq(3)').text();
					var balance= $('#cash_balance').html();
					
					$('#popupContainer').data('creditAmount', credit);
					$('#popupContainer').data('debitAmount', debit);
					$('#popupContainer').data('balanceAmount', balance);
					
				
					$('#popupContainer').data('tableTr', row);
				//}
				
			
				  
				  
				  
		});
		
		$('#tbl_cashbook').on('click', '.checkmark_red_icon', function(button) {
			 var session_id =$('#head_session_user_id').val();
             
            if(session_id=='1' || session_id=='14'){
                    var closestRow = $(this).closest('tr');
                    var rowData = table.row($(this).closest('tr')).data();
                    var statusElement = $(this);
                    var eighthElement = closestRow.find('td:eq(6) .sands-delete-icon');
                    $('#popupContainer').data('statusElementConfirm', statusElement);
                //   alert(rowData['ids']);
                    $(".otherContent").empty();
                  	SaNDSAlert("Are you sure you want to confim this row?",'ConfirmData','danger','#DE3E3E','Confirm','Do nothing');
        			$('#popupContainer').data('clickRowIdForConfirm', rowData['ids']);	
        			$('#popupContainer').data('eighthElement', eighthElement);
                }
                else{
                    $(".otherContent").empty();
                    SaNDSAlert("You can't change!",'','','','','cancel');
                }
		
		});
		
		
		document.querySelectorAll('.popup-buttons button').forEach(function(button) {
        button.addEventListener('click', function() {
            var popupOverlay = document.getElementById('popupOverlay');
            var popupContainer = document.getElementById('popupContainer');
            popupOverlay.style.display = 'none';
            popupContainer.style.display = 'none';

            // Check which button was clicked
            if (button.classList.contains('ok')) {
                
                var switchData = $('#message_matter').attr('data-switch-values');
                if(switchData =='ConfirmData'){
                    // ******************************** confirm ********************************
                    
                        var statusElementConfirm = $('#popupContainer').data('statusElementConfirm');
                    //     var row = statusElementConfirm.closest('tr');
                    //      var rowData = table.row($(this).closest('tr')).data();
                	   // console.log(row);
                	     var row_Id = $('#popupContainer').data('clickRowIdForConfirm');		
                	    
                	     $.post("../cashbook/confirm_data.php",{v_rowId:row_Id},function(result,status){
                      
                                // table = $('#tlbTransaction').DataTable();
                                // table.row(row).remove().draw();
                                statusElementConfirm.removeClass('checkmark_red_icon').addClass('checkmark_green_icon');
                               var eighthElement = $('#popupContainer').data('eighthElement');
                                eighthElement.hide();
                        
                                // setTimeout(function() {
                                    //  Calculations();
                                    setupDropdown('dropdownContent', 'success', svgSuccess + 'Data Confirmed Successfully..!', 'click');
                                // }, 500);
                                // LoadCalender();
                	     });
                            
                    
                    // ***************************** end **************************************
                }
                else{
                    var deleteID = $('#popupContainer').data('deleteID');
    				var TableTR = $('#popupContainer').data('tableTr');
    				
    				var credit = $('#popupContainer').data('creditAmount');
    				var debit = $('#popupContainer').data('debitAmount');
    				var balance = $('#popupContainer').data('balanceAmount');
                    
    			   $.post('../cashbook/delete_data.php',{deleteId:deleteID},function(res){
    				   
    				  
    					// Get the row index
    					var rowIndex = table.row(TableTR).index();
    					// Remove the row from the DataTable
    					table.row(rowIndex).remove().draw();
    					
    					
    					var correct_balance= parseFloat(balance)-(parseFloat(credit)-parseFloat(debit));
    					$('#cash_balance').html(correct_balance.toFixed(3));
    					
    					
    					Calculations();
    					showDataCalender();
    				  });
                }
			   
            } else if (button.classList.contains('cancel')) {
                // Cancel button clicked, do nothing
                //alert('Action canceled!');
            }
        });
    });
		
		
	$('#creditEntry').click(function() {
	//$('.speechBubble').removeClass('hidden'); // Show the speech bubble
	sandsBaloon(this, '#popupWindowCredit');
    
	});
	$('#debitEntry').click(function() {
		//$('.speechBubble').removeClass('hidden'); // Show the speech bubble
		sandsBaloon(this, '#popupWindowDebit');
		
	});	
	
	function sandsAjaxPost(url, postData, successCallback, errorCallback) {
	  $.ajax({
		url: url,
		type: 'POST',
		data: postData,
		success: function(response) {
		  if (typeof successCallback === 'function') {
			successCallback(response);
		  }
		},
		error: function(jqXHR, textStatus, errorThrown) {
		  if (typeof errorCallback === 'function') {
			errorCallback(jqXHR, textStatus, errorThrown);
		  }
		}
	  });
	}
	
$('#btn_credit, #btn_debit').click(function(res){
    $('#loadingWrapper').show();
	//console.log("Selected Date : "+selectedDateFromCalender);
	var clickedButtonId = $(this).attr('id');
    var postDataArray = [];
    postData_foradd=[];
	var postData;
	var buttonStatus = '';
	var buttonStatus = '';
	var selected_date;
    if (selectedDateFromCalender === null || selectedDateFromCalender === '') {
        // If selectedDateFromCalender is null or empty, set selected_date to today's date
        var today = new Date();
        var year = today.getFullYear();
        var month = String(today.getMonth() + 1).padStart(2, '0'); // Month is zero-based, so add 1 and pad with 0 if needed
        var day = String(today.getDate()).padStart(2, '0'); // Pad with 0 if needed
        selected_date = year + '-' + month + '-' + day;
    } else {
        // If selectedDateFromCalender is not null or empty, use its value for selected_date
        selected_date = selectedDateFromCalender;
    }

    // Now you can check the id of the clicked button
    if (clickedButtonId === 'btn_credit') {
        postData = {
		  cr_amount: $('#txt_credit').val(),
		  dr_amount : 0,
		  cr_dr_description : $('#txt_credit_description').val(),
		  selected_date :selected_date,
		  status :'Credit'
		};
		postData_foradd = [
		  $('#txt_credit_description').val(),
		  selected_date,
		  $('#txt_credit').val(),
		  '0.000',
		  'Credit',
		  ''
		];
		buttonStatus ='Credit';
    } else if (clickedButtonId === 'btn_debit') {
        postData = {
		  cr_amount: 0,
		  dr_amount : $('#txt_debit').val(),
		  cr_dr_description : $('#txt_debit_description').val(),
		  selected_date :selected_date,
		  status : 'Debit'
		};
		postData_foradd = [
		  $('#txt_debit_description').val(),
		  selected_date,
		  '0.000',
		  $('#txt_debit').val(),
		  'Debit',
		  ''
		];
		
		buttonStatus ='Debit';
    }
	
	
	postDataArray.push(postData);
	var jsonString = JSON.stringify(postDataArray);

    var postDataEntry = {
      cash_book_entry_data: jsonString
    };
	

	sandsAjaxPost('../cashbook/insert_to_cashbook.php', postDataEntry, function(res) {
      // Success callback
      
	  if(buttonStatus==='Credit')
	  {
		  $('#txt_credit_description').val('');
		  $('#txt_credit').val('');
		 
	  }
	  if(buttonStatus==='Debit')
	  {
		  $('#txt_debit_description').val('');
		  $('#txt_debit').val('');
		 
	  }
	  $('#tbl_cashbook').DataTable().row.add({
            "description":postData_foradd[0],
            "date_of_entry":postData_foradd[1],
            "credit":postData_foradd[2],
            "debit":postData_foradd[3],
            "status":postData_foradd[4],
            "notes":postData_foradd[5]
    }).draw();
    
	var balance= $('#cash_balance').html();
	var correct_balance= (parseFloat(balance)+(parseFloat(postData_foradd[2])-parseFloat(postData_foradd[3]))).toFixed(3);
	$('#cash_balance').html(correct_balance);
	
	 Calculations();
	 showDataCalender();  
	  setupDropdown('dropdownContent', 'success', res, 'click');
      $('#loadingWrapper').hide();
    }, function(jqXHR, textStatus, errorThrown) {
      // Error callback
      if (errorThrown === 'net::ERR_HTTP2_PROTOCOL_ERROR') {
        // Handle HTTP/2 protocol error
        console.log('HTTP/2 protocol error occurred');
         setupDropdown('dropdownContent', 'error', 'Network error, please try again..!', 'click');
        // You can attempt to retry the request here or display an appropriate message to the user
      } else {
        // Handle other errors
        console.error('Error:', textStatus, errorThrown);
         setupDropdown('dropdownContent', 'error', res, 'click');
      }
      //$('#loadingWrapper').hide(); // Hide loading indicator in case of error
    });
	
	
})// Button Credit Close 
            // var startDate;
            //  var endDate;
	
	$("#btn_print").click(function(){
	   // alert(startDate);
    //  var v_customer_id = $("#div_search_customer_name option:selected").val();
    //  window.open("reports/pdf/print/cashbook_print.php?v_customer_id="+v_customer_id+"&v_start_date="+startDate+"&v_end_date="+endDate+",_blank");
    window.open("reports/pdf/print/cashbook_print_new.php?v_start_date="+startDate+"&v_end_date="+endDate);
})	
	
  });
</script>

	




