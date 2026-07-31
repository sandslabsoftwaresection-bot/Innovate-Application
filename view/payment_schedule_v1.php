<?php 
include("session_check.php");
?>

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
	
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "api.openweathermap.org/data/2.5/weather?q=bahrain,manama&appid=b3073171c40282ef72ccfc65faec0db0",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
 
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
    $arr = json_decode($response, true);
	
	//307.63K − 273.15
}

?>

<?PHP 

include("templates/common_connection.php");
        
        
        ?>
        
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">

    <!-- favicons -->
    <link rel="apple-touch-icon" href="../../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png">
    <link rel="icon" href="../../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png">


    

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="vendor/materializeicon/material-icons.css">
   
    <!-- aniamte CSS -->
    <link rel="stylesheet" href="vendor/animatecss/animate.css">
    <link rel="stylesheet" href="vendor/chosen1.8/chosen.css">
     <!-- daterange CSS -->
    <link rel="stylesheet" href="vendor/bootstrap-daterangepicker-master/daterangepicker.css">
    
     <!-- ladda CSS -->
    <!-- dataTable CSS -->
    <link rel="stylesheet" href="vendor/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="../httpdocs/calendar/css/metallic/zebra_datepicker.min.css" type="text/css">
    <!-- app CSS -->
    <link id="theme" rel="stylesheet" href="css/purplesidebar.css" type="text/css">
    
    <link rel="stylesheet" type="text/css" href="js/sweetalert/sweetalert.css">
    
    
    
    <link rel="stylesheet" href="../payment_calender/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../payment_calender/css/dropdown.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../payment_calender/sands-alert/css/sands_alert_style.css" rel="stylesheet">
    
    
     <style>
         #tlbTransaction td:nth-child(4) {
            text-align: right; /* Align text in the 4th column to the right */
          }
           #tlbTransaction td:nth-child(5) {
            text-align: right;
          }
         .settings-sidebar {
            width: 900px;
         }
         .settings-sidebar.close-settings-sidebar-backdrop {
            right: -890px;
        }
        .settings-sidebar .tab-content .tab-pane {
            height: 100%;
            overflow-y: auto;
        }
        .daterange {
            max-width: 300px;
            width: 300px;
           
        }
        
        .card .card-header {
            background: none;
            border: 0;
            padding: 0.02em 0.95em;
        }
        
        .invalid {
            border: 1px solid red;
        }
        .dt-center {
            text-align: center;
        }
        /*------------------------*/
        
 .loadingWrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none; /* Initially hidden */
            justify-content: center;
            align-items: center;
        }

        .loadingBackdrop {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
        }

        .loadingIndicator {
			position: absolute; /* Position relative to its parent (.loadingWrapper) */
			top: 50%; /* Position at vertical center */
			left: 50%; /* Position at horizontal center */
			transform: translate(-50%, -50%); /* Center the indicator */
			width: 50px;
			height: 50px;
			border: 4px solid #fff; /* Light gray border */
			border-top: 4px solid #3498db; /* Blue border for animation */
			border-radius: 50%;
			animation: spin 2s linear infinite; /* Apply rotation animation */
		}
		
		.checkmark_red_icon {
            width: 15px;
            height: 15px;
            display: inline-block;
            position: relative;
            cursor: pointer;
        }
        
        .checkmark_red_icon::after {
            content: '';
            position: absolute;
            width: 9px;
            height: 18px;
            border: solid #DD4237;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
            top: 0;
            left: 8px;
        }
        .checkmark_green_icon {
            width: 15px;
            height: 15px;
            display: inline-block;
            position: relative;
           
        }
        
        .checkmark_green_icon::after {
            content: '';
            position: absolute;
            width: 9px;
            height: 18px;
            border: solid #2E7032;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
            top: 0;
            left: 8px;
        }

        .disabled-row {
            opacity: 0.5;  /* Make the row look disabled */
            pointer-events: none;  /* Prevent interaction */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
     </style>

  

    <?PHP include('templates/page_title.php')?>
</head>

<body class="fixed-header sidebar-right-close">
    <!-- page loader -->
    <?PHP include('templates/page_loader.php')?>
    <!-- page loader ends  -->

    <div class="wrapper">
        <!-- main header -->
       <?PHP include('templates/head.php')?>
        <!-- main header ends -->

        <!-- sidebar left -->
      <?PHP include('templates/left_menu.php')?>
        <!-- sidebar left ends -->

        <!-- sidebar right -->
       <?PHP include('templates/side_right.php')?>
        <!-- sidebar right ends -->
       
        <!-- setting sidebar -->
       <?PHP //include('templates/settings_chat.php')?>
        <!-- setting sidebar ends -->

        <!-- content page title -->
        <?PHP include('templates/payment_schedule_head.php')?>
       
        <!-- content page title ends -->

        <?PHP include('../payment_calender/index.php')?>
     
        <!-- content page -->
       <?PHP include('templates/payment_schedule_body_v1.php')?>
        <!-- content page ends -->
        
    </div>

    <?PHP include('templates/footer.php')?>
   <div id="tooltip" style="display: none;width: 300px;"></div>
<div class="loadingWrapper" id="loadingWrapper">
    <div class="loadingIndicator"></div>
    <div class="loadingBackdrop"></div>
    
</div>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script>
    <!-- Cookie jquery file -->
    <script src="vendor/cookie/jquery.cookie.js"></script>
     <script src="vendor/chosen1.8/chosen.jquery.min.js"></script>
     <!-- DataTable jquery file -->
    <script src="vendor/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="vendor/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
    
    
     <!-- swiper slider jquery file -->
    <script src="js/ladda/spin.min.js" type="text/javascript"></script>
	<script src="js/ladda/ladda.min.js" type="text/javascript"></script>
	<script src="js/ladda/ladda.jquery.min.js" type="text/javascript"></script>
	
     <!--Calender  -->
      <script src="https://cdn.jsdelivr.net/npm/zebra_pin@2.0.0/dist/zebra_pin.min.js"></script>
      <script src="../httpdocs/calendar/zebra_datepicker.min.js"></script>
      <script src="../httpdocs/calendar/examples.js"></script>
     <!-- datepicker jquery file -->
    <script src="vendor/bootstrap-daterangepicker-master/moment.js"></script>
    <script src="vendor/bootstrap-daterangepicker-master/daterangepicker.js"></script>
    <!-- sweet alert -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

       <script src="js/main.js"></script>
   <!-- User script file -->
    
    <script src="../httpdocs/user_js/sign_out.js"></script>
    <script src="../httpdocs/user_js/log_out_script.js"></script>
 
    
    
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../payment_calender/js/settings.js?timestamp=<?php echo time(); ?>"></script>
<script type="text/javascript" src="../payment_calender/js/messagedropdown.js?timestamp=<?php echo time(); ?>"></script>
<script src="../payment_calender/sands-alert/js/sandsalert.js"></script>
    
  
  
  
  
    <script>
        "use script";
        /* date range picker */
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('input[name="daterange"]').html(start.format('DD-MM-YY'));
            }
            $('input[name="datepicker"]').daterangepicker({
                format: 'DD-MM-YY'
            });

            $('input[name="daterange"]').daterangepicker({
                startDate: start,
                endDate: end,
                opens: 'right',
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });
        $(function() {
            $('input[name="datepicker"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                format: 'DD-MM-YY'
            }, function(start, end, label) {});
        });
        
      

    </script>
    
    
<script src="../payment_calender/js/script.js"></script>   
<script>
// claender load
LoadCalender();
 function LoadCalender()
 {
     

 $.ajax({
            url: '../controller/payment_schedule/payment_schedule_controller.php',
            method: 'POST',
            dataType: 'json',
            data: {
                action: 'get_schedule' // Add your desired action value here
            },
            success: function (data) {
                console.log(data);
                 highlightedDates = data;
                showCalendar(currentMonth, currentYear);
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
        
 }      
  
        
</script>        

<script src="../payment_calender/js/table_scripts.js"></script>
<script src="../httpdocs/payment_schedule/payment_schedule.js"></script>
<script>

$('#div_select_bank_name_for_print').load('templates/bank_names_comb_forprint.php');

 var startDate;
 var endDate;
$('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
    startDate = picker.startDate.format('YYYY-MM-DD');
    endDate = picker.endDate.format('YYYY-MM-DD');
    // Now you have the start and end date selected by the user
    console.log("Start Date: " + startDate);
    console.log("End Date: " + endDate);
});

var v_bank_name='';
$("#btn_search").click(function(){
    v_bank_name = $("#select_bank_forprint option:selected").text();
    if(v_bank_name=='-Select Bank--'){
        v_bank_name='empty';
    }
    
    var v_customer_id = $("#div_search_customer_name option:selected").val();
   
    load_transaction_tbl(startDate,endDate,v_customer_id,v_bank_name);
    
})

function load_transaction_tbl(v_start_date,v_end_date,v_customer_id,v_bank_name)
{
    if ($.fn.DataTable.isDataTable('#tlbTransaction')) {
        $('#tlbTransaction').DataTable().destroy();
    }
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
                       
                        d.action = 'get_search_data';
                        d.v_start_date = v_start_date;
                        d.v_end_date = v_end_date;
                        d.v_cut_id = v_customer_id;
                        d.v_bank_nm = v_bank_name;
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
    				        var app_status = row['approved_status'];
    				        var confirm_status = row['confirm_status'];
    				        if (app_status === "Not Approved") {
    				            return '<div class="sands-delete-icon"></div>';
    				        }
    				        else if (app_status === "Approved") {
    				            if (confirm_status === "Not Confirm") {
    				                return '<div class="checkmark_red_icon"></div>';
    				            }
    				            else if (confirm_status === "Confirm") {
    				                return '<div class="checkmark_green_icon"></div>';
    				            }
    				        }
    				        
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

$("#btn_print").click(function(){
     var v_customer_id = $("#div_search_customer_name option:selected").val();
     window.open("reports/pdf/print/payment_scheule.php?v_customer_id="+v_customer_id+"&v_start_date="+startDate+"&v_end_date="+endDate+"&bank="+$.trim(v_bank_name),"_blank");
    
})
$(document).ready(function(){
    
                // **********************************************
				var css = '.chosen-container { width: 100% !important;padding-left:0px; }';

                // Create a style element
                var style = document.createElement('style');
                style.type = 'text/css';
                
                // Append CSS rule to the style element
                if (style.styleSheet) {
                    style.styleSheet.cssText = css; // IE support
                } else {
                    style.appendChild(document.createTextNode(css)); // Other browsers
                }
                
                // Append the style element to the document head
                document.head.appendChild(style);  
                
				// *************************************************
				
				$('#select_bank').chosen({
                  no_results_text: ''
                });
                
                
               $('#div_select_bank_name').on('change', function(e) {
                
                   var selected_bank =$("#select_bank option:selected").text();
                   var selected_bank_id =$("#select_bank option:selected").val();
                  $('#txt_bank_name').attr('type', selected_bank_id == 1 ? 'text' : 'hidden').val(selected_bank_id == 1 ? '' : selected_bank);

                    
                });
})
</script>
</body>

</html>
