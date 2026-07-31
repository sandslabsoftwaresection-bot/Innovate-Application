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
     <style>
         
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
        .dt-center {
            text-align: center;
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
       
        <!-- content page -->
       <?PHP include('templates/payment_schedule_body.php')?>
        <!-- content page ends -->
        
    </div>

    <?PHP include('templates/footer.php')?>

  
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
    
    
  <script>
    $(document).ready(function() {
        $("#div_cheque").hide();
        $("#div_tbl_details").hide();
        $("#addRowButton").hide();
       $('#dataTables-example').DataTable({
                "order": [
                    [3, "desc"]
                ],
        });
        var chqValue,dateValue,amountValue,nameValue =[];
             
        var uniqueRefCode;
        var dataTable = $('#myDataTable').DataTable({
            bFilter: false,   // Hide the search bar
            bInfo: false,     // Hide the info display
            bPaginate: false  // Hide pagination
        });
        
         $('#addRowButton').on('click', function() {
         // Add a new row with some sample data
           var no_of_months= $("#txt_no_of_months").val();
           var starting_date = $("#txt_date").val();
           var payment_amount= $("#txt_total_amount").val();
           var bank_name= $("#txt_bank_name").val();
           var bank_chq_no= $("#txt_bank_chq_no").val();
            // Example usage
            const startDate = starting_date;
            const numberOfMonths = no_of_months;
            const nextMonths = getNextMonths(startDate, numberOfMonths);
            
            console.log(nextMonths);
            var selectedPaymentMethod = $('input[name="payment_method"]:checked').val();   
            if(selectedPaymentMethod=='Cheque')
                 {
                    for(i=0;i<no_of_months;i++)
                       {
                           
                            var newRowData = [ '<input type="text" class="name-input" value="'+bank_name+'"style="width: 150px;">',
                            '<input type="text" class="chq-input" value="'+bank_chq_no+'" style="width: 100px;">', '<input type="text" class="date-input" value="'+nextMonths[i]+'" style="width: 150px;">' , '<input type="text" class="amount-input" value="'+parseFloat(payment_amount/no_of_months).toFixed(3)+'" style="width: 100px; text-align:right">'  ];
                            dataTable.row.add(newRowData).draw();
                            bank_chq_no = parseInt(bank_chq_no) + 1;
                       }  
                     
                 }     
            else
                {
                  for(i=0;i<no_of_months;i++)
                       {
                            
                            var newRowData = ['','','<input type="text" class="date-input" value="'+nextMonths[i]+'" style="width: 150px;">' , '<input type="text" class="amount-input" value="'+parseFloat(payment_amount/no_of_months).toFixed(3)+'" style="width: 100px; text-align:right">'  ];
                            dataTable.column(0).visible(false);
                            dataTable.column(1).visible(false);
                            dataTable.row.add(newRowData).draw();
                            
                       }
                }
           
            
             $('#addRowButton').attr('disabled', 'disabled');
          });
          
   
      function getNextMonths(startDate, numberOfMonths) {
              // Parse the start date string to get day, month, and year
              const [day, month, year] = startDate.split('-').map(Number);
            
              // Create a Date object using the parsed values
              const startDateObj = new Date(year, month - 1, day); // Note: Month is 0-based in JavaScript Date object
            
              // Initialize an array to store the result dates
              const resultDates = [];
            
              // Array of month names
              const monthNames = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June',
                'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'
              ];
            
              // Loop to calculate the next n months
              for (let i = 0; i < numberOfMonths; i++) {
                // Calculate the next month
                const nextMonth = new Date(startDateObj.getFullYear(), startDateObj.getMonth() + i, startDateObj.getDate());
            
                // Format the date to 'dd-mm-yyyy' along with the month name
                const formattedDate = `${String(nextMonth.getDate()).padStart(2, '0')}-${String(nextMonth.getMonth()+1).padStart(2, '0')}-${nextMonth.getFullYear()} `;
            
                // Push the formatted date to the result array
                resultDates.push(formattedDate);
              }
            
              return resultDates;
            }
            
            $('input[name="payment_method"]').change(function() {
             var selectedPaymentMethod = $('input[name="payment_method"]:checked').val();   
            if(selectedPaymentMethod=='Cash')
                 {
                   $("#div_cheque").hide(); 
                   
                   $("#addRowButton").text('Enter Cash Details');
                 }
            else
                 {
                    $("#div_cheque").show(); 
                    
                   $("#addRowButton").text('Enter Cheque Details'); 
                     
                 }
            }); 
            function generateRefCode() {
              // Get current timestamp
              var timestamp = new Date().getTime();
        
              // Generate a random string (you can customize the length as needed)
              var randomString = Math.random().toString(36).substring(2, 10);
        
              // Combine timestamp and random string to create a unique reference code
              var refCode =  timestamp + randomString;
        
              return refCode;
            }
                    
            $("#txt_no_of_months").blur(function(){
                var no_of_months = $("#txt_no_of_months").val();
                   if(no_of_months==1)
                   {
                     $("#addRowButton").hide();
                     $("#div_tbl_details").hide();
                   }
                   else
                   {
                      $("#addRowButton").show();
                      
                      $("#div_tbl_details").show();
                      dataTable.destroy();
                      dataTable = $('#myDataTable').DataTable({
                        bFilter: false,   // Hide the search bar
                        bInfo: false,     // Hide the info display
                        bPaginate: false  // Hide pagination
                      });
                      
                   }
            })   
            $('#btn_save_payments').on('click', function() {
            
             var payment_acnt_id = $("#select_acnt_head option:selected").val();
             var payment_acnt_name = $("#select_acnt_head option:selected").text();
             var customer_id = $("#select_payment_customer option:selected").val();
             var customer_name = $("#select_payment_customer option:selected").text();
             var payment_start_date = $("#txt_date").val();
             var dateParts = payment_start_date.split("-");
             var payment_start_date = $.trim(dateParts[2] )+ "-" + dateParts[1] + "-" + dateParts[0];
             var no_of_months = $("#txt_no_of_months").val();
             var total_amount = $("#txt_total_amount").val();
             var schedule_description = $("#txt_schedule_description").val();
             var selectedPaymentMethod = $('input[name="payment_method"]:checked').val();
              uniqueRefCode = generateRefCode();
              
              var payment_type = payment_acnt_name.split('|');
               payments_type = payment_type[1];
             var bank_name= $("#txt_bank_name").val();
             var bank_chq_no= $("#txt_bank_chq_no").val();
            
             
                if ($.fn.dataTable.isDataTable('#myDataTable')) {
              // DataTable is initialized
              // Loop through each row
             // Declare arrays to store data
                var nameValue = [];
                var dateValue = [];
                var amountValue = [];
                var chqValue = [];
                dataTable.rows().every(function(rowIdx, tableLoop, rowLoop) {
                    // Get the data from textboxes in the current row
                    var bankNameValue = $(this.node()).find('.name-input').val();
                    var chqValueData = $(this.node()).find('.chq-input').val();
                    var dateValueData = $(this.node()).find('.date-input').val();
                    var amountValueData = $(this.node()).find('.amount-input').val();
                     var dateParts = dateValueData.split("-");
                    var formattedDate = $.trim(dateParts[2] )+ "-" + dateParts[1] + "-" + dateParts[0];
                    console.log(formattedDate);    
                    // Push data into arrays
                    nameValue.push(bankNameValue);
                    chqValue.push(chqValueData); // Uncomment if needed
                    dateValue.push(formattedDate);
                    amountValue.push(amountValueData);
                
                    // Returning true continues the iteration, false stops it
                    return true;
                });
                
              
            } else {
              console.log('DataTable is not initialized.');
            }
            
          
            $.post("../controller/payment_schedule/payment_schedule_controller.php",{action:"add_payment_schedule",selectedPaymentMethod:selectedPaymentMethod,payment_acnt_head:payment_acnt_id,customer_id:customer_id,customer_name:customer_name,payment_start_date:payment_start_date,no_of_months:no_of_months,total_amount:total_amount,schedule_description:schedule_description,nameValue:nameValue,chqValue:chqValue,dateValue:dateValue,amountValue:amountValue,uniqueRefCode:uniqueRefCode,payments_type:payments_type,bank_name:bank_name, chq_ref_no:bank_chq_no},function(result,status){
                alert(result);
                if(result>0)
                {
                     swal("Success","Payment details added successfully..","success");
                     clear_text();
                     $("#div_cheque").hide();
                     $("#div_tbl_details").hide();
                     $("#addRowButton").hide();
                     $('#addRowButton').removeAttr('disabled');
                     
                }
               
            });
      });
      function clear_text()
      {
        $('input[type="text"]').val('');
        $('input[type="number"]').val('');
        $('textarea').val('');

       
       // Clear the selected value
        $('#select_acnt_head').val('').trigger('chosen:updated');
            
            // Trigger the "change" event
        $('#select_acnt_head').trigger('change');
        
        $('#select_payment_customer').val('').trigger('chosen:updated');
            
            // Trigger the "change" event
        $('#select_payment_customer').trigger('change');
        
      }
    
        $('#datepicker-always-visible').Zebra_DatePicker({
              always_visible: $('#day_shedule_container'),
              format: 'Y-m-d',
              	onSelect: function(view, elements) {
        		    console.log('Data Click On Select');
        		    var monthNames = [
                        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                      ];
                      var selectedDate = $(this).val();
                      var components = selectedDate.split('-');
    	              var v_task_date = components[2] + '-' + monthNames[parseInt(components[1])-1] + '-' + components[0] ;
        		    
        		    slideContainer(v_task_date);
              	}
              
        });   
        function slideContainer(selectedDate)
        {
             $('#current_time').html(getCurrentTime());
           
             if ($('.close-setting-sidebar').hasClass('active') === true) {
                // $('.settings-sidebar').addClass('close-settings-sidebar-backdrop')
                // $('.close-setting-sidebar').removeClass('active');
                // $('body').removeClass('setting-sidebar-open');
                //$('.settings-sidebar-backdrop').fadeOut();
                $('#selected_date').html(selectedDate);
            } else {
                $('.settings-sidebar').removeClass('close-settings-sidebar-backdrop')
                $('.close-setting-sidebar').addClass('active');
                $('body').addClass('setting-sidebar-open');
                if ($('#hidebackdrop').is(':checked') != true) {
                    $('.settings-sidebar-backdrop').fadeIn()
                    $('#selected_date').html(selectedDate);
                }
            }
        }
        
        
        function getCurrentTime()
        {
            var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        
        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'

        // Add leading zeros if necessary
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;
        
        // Display the current time in a specific element with id="current-time"
        return (hours + ":" + minutes + ":" + seconds + " " + ampm);
        }
        
        $('.chosen_select').chosen();
        $('#div_select_accnt_head').load('templates/account_head_combo.php');
         $('#div_select_customer_name').load('templates/customer_combo.php');
         $('.datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                
                minYear: 1901  ,
                locale: {
                        format: 'DD-MM-YYYY' // Set the desired date format
                      }
        }, function(start, end, label) { });
        
        $("#btn_cust_add").click(function(){
            $("#modal_cust_details").modal('show');
        })
        $("#btn_add_acnt_head").click(function(){
            $("#modal_account_details").modal('show');
            
        })
        
        $("#btn_acnt_details").click(function(){
            var acnt_type= $('input[name="account_method"]:checked').val();
            var acnt_name= $("#txt_account_head").val() ;
        })
        
        
    });  
    
    
  </script>
    <script>
        "use script";
        /* date range picker */
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('input[name="daterange"]').html(start.format('MM/D/YY') + ' to ' + end.format('MM/D/YY'));
            }

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
                minYear: 1901
            }, function(start, end, label) {});
        });

    </script>
</body>

</html>
