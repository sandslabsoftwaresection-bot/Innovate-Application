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

//include("templates/common_connection.php");
        
        
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
    
    <!--Roles and permissions-->
	 
     <link rel="stylesheet" type="text/css" href="../permissions/css/datagrid.css">
     <link rel="stylesheet" type="text/css" href="../permissions/css/dropdown.css">
    <!--**********************************************************-->

    
    <link rel="stylesheet" href="../payment_calender/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../payment_calender/css/dropdown.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../payment_calender/sands-alert/css/sands_alert_style.css" rel="stylesheet">
    <link rel="stylesheet" href="../cashbook/css/styles.css">
    <link rel="stylesheet" href="../cashbook/css/sandsbaloon.css">
    <link rel="stylesheet" href="../cashbook/css/other.css">
    
     <style>
              #tbl_cashbook td:nth-child(2) {
                text-align: center; /* Align text in the 4th column to the right */
              }
              #tbl_cashbook td:nth-child(3) {
                text-align: right; /* Align text in the 4th column to the right */
              }
               #tbl_cashbook td:nth-child(4) {
                text-align: right;
              }
               #tbl_cashbook td:nth-child(5) {
                text-align: center;
              }
              #tbl_cashbook td:nth-child(7) {
                text-align: center;
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
        <?PHP include('templates/cashbook_head.php')?>
       
        <!-- content page title ends -->

        <?PHP include('../cashbook/index.php')?>
     
        <!-- content page -->
       <?PHP //include('templates/payment_schedule_body_v1.php')?>
        <!-- content page ends -->
        
    </div>

    <?PHP include('templates/footer.php');
     include_once('../permissions/permission_class/class_permission.php');
    ?>
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
      <!--<script src="https://cdn.jsdelivr.net/npm/zebra_pin@2.0.0/dist/zebra_pin.min.js"></script>-->
      <!--<script src="../httpdocs/calendar/zebra_datepicker.min.js"></script>-->
      <!--<script src="../httpdocs/calendar/examples.js"></script>-->
     <!-- datepicker jquery file -->
    <script src="vendor/bootstrap-daterangepicker-master/moment.js"></script>
    <script src="vendor/bootstrap-daterangepicker-master/daterangepicker.js"></script>
    <!-- sweet alert -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

       <script src="js/main.js"></script>
   <!-- User script file -->
   
     
    <script  src="../permissions/js/settings.js?timestamp=<?php echo time(); ?>"></script>
    <script  src="../permissions/js/permission.js?timestamp=<?php echo time(); ?>"></script>
    <script  src="../permissions/js/validations.js?timestamp=<?php echo time(); ?>"></script>
    <script  src="../permissions/js/jsfunctions.js?timestamp=<?php echo time(); ?>"></script>

    
    <script src="../httpdocs/user_js/sign_out.js"></script>
    <script src="../httpdocs/user_js/log_out_script.js"></script>
 
    
    
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<!--<script type="text/javascript" src="../payment_calender/js/settings.js?timestamp=<?php //echo time(); ?>"></script>-->
<!--<script type="text/javascript" src="../payment_calender/js/messagedropdown.js?timestamp=<?php echo time(); ?>"></script>-->
<script src="../payment_calender/sands-alert/js/sandsalert.js"></script>


<script src="../cashbook/js/script.js"></script>
<script src="../cashbook/js/sandsbaloon.js"></script>   

  <script>
        "use script";
        /* date range picker */
        $(function() {

            var start = moment();
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
    


<script>
    let highlightedDates=[];
    showDataCalender();
    function showDataCalender()
    {
        console.log('Sample Show Calender');
            $.post("../cashbook/counts_of_dates.php", function(res) {
               try { 
                    var parsedData = JSON.parse(res);
                    var dataArray = parsedData.data; // Assuming the array is stored under 'data' key
                    if (dataArray.length > 0) {
                        var result = dataArray.map(function(item) {
                            return [item.entry_date, item.entry_count];
                        });
                    }
                    console.log(result);
                     // Declare a global variable and assign the highlightedDates array
                    highlightedDates = result;
                    showCalendar(currentMonth, currentYear); 
               }
               catch (error) {
                    // Handle the error
                    console.log('Error Log');
                    showCalendar(currentMonth, currentYear); 
                }
                
                
            });
   
    }
    
 
   

</script>
  
  
  


</body>

</html>
