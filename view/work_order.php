
<?php
include("session_check.php");
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

    <!-- swiper carousel CSS -->
    <link rel="stylesheet" href="vendor/swiper/css/swiper.min.css">

    <!-- daterange CSS -->
    <link rel="stylesheet" href="vendor/bootstrap-daterangepicker-master/daterangepicker.css">

    <!-- footable CSS -->
    <link rel="stylesheet" href="vendor/footable-bootstrap/css/footable.bootstrap.min.css">

    <!-- jvector map CSS -->
    <link rel="stylesheet" href="vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
      <link rel="stylesheet" href="vendor/chosen1.8/chosen.css">
     
     <!-- -LineControl-Editor CSS -->
    <link rel="stylesheet" href="vendor/LineControl-Editor/editor.css">
    
    
    
    <!-- dataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css">
    
     <!-- ladda CSS -->
    <link rel="stylesheet" href="css/ladda/ladda-themeless.min.css">
    
    <!-- app CSS -->
    <link id="theme" rel="stylesheet" href="css/purplesidebar.css" type="text/css">
    
     <link rel="stylesheet" type="text/css" href="js/sweetalert/sweetalert.css">

     <!--Roles and permissions-->
	
     <link rel="stylesheet" type="text/css" href="../permissions/css/datagrid.css">
     <link rel="stylesheet" type="text/css" href="../permissions/css/dropdown.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <!--**********************************************************-->

   <style>
         .sidenav{background-color:#111;height:100%;left:0;overflow-x:hidden;padding-top:60px;position:fixed;top:0;transition:.5s;width:0;z-index:1;}
.sidenavR{background-color:#d9d9d9;height:100%;overflow-x:hidden;padding-top:0px;position:fixed;right:0;top:0;transition:.5s;width:0;z-index:1;}
.sidenav a,.sidenavR a{color:#818181;display:block;font-size:25px;padding:8px 8px 8px 32px;text-decoration:none;transition:.3s;}
.sidenav a:hover,.offcanvas a:focus,.sidenavR a:hover,.offcanvas a:focus{color:#f1f1f1;}
.sidenav .closebtn,.sidenavR .closebtn{font-size:36px;margin-left:55px;position:absolute;right:25px;top:55px;}
@media screen and max-width 450px {
.sidenav,.sidenavR{padding-top:15px;}
.sidenav a,.sidenavR a{font-size:18px;}
.sidenav,.sidenavR {width:100%;}
}
@media screen and max-width 900px {
.sidenav,.sidenavR{padding-top:15px;}
.sidenav a,.sidenavR a{font-size:18px;}
.sidenav,.sidenavR {width:550px;}
}
.custom-font{
    font-size:13px;
}

.dashed{
    text-decoration: overline underline line-through;
    color:#999;
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
        <?PHP include('templates/working_order_head.php')?>
       
        <!-- content page title ends -->
       
        <!-- content page -->
       <?PHP include('templates/working_order_body.php')?>
        <!-- content page ends -->
        
    </div>

    <?PHP include('templates/footer.php');
    include_once('../permissions/permission_class/class_permission.php');
    ?>

  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script>

    <!-- Cookie jquery file -->
    <script src="vendor/cookie/jquery.cookie.js"></script>

    <!-- sparklines chart jquery file -->
    <script src="vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- Circular progress gauge jquery file -->
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/chosen1.8/chosen.jquery.min.js"></script>
    <!-- Swiper carousel jquery file -->
    <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- Chart js jquery file -->
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/chartjs/utils.js"></script>

    <!-- Footable jquery file -->
    <script src="vendor/footable-bootstrap/js/footable.min.js"></script>

    <!-- datepicker jquery file -->
    <script src="vendor/bootstrap-daterangepicker-master/moment.js"></script>
    <script src="vendor/bootstrap-daterangepicker-master/daterangepicker.js"></script>

    <!-- jVector map jquery file -->
    <script src="vendor/jquery-jvectormap/jquery-jvectormap.js"></script>
    <script src="vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    
   
      <!-- CK editor file -->
    <script src="vendor/ckeditor/ckeditor.js"></script>
     <!-- -LineControl-Editor file -->
    <script src="vendor/LineControl-Editor/editor.js"></script>
    


    <!-- DataTable jquery file -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>


        <!-- JSZip for Excel export -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        
        <!-- pdfmake for PDF export -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

     <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>    

    <!-- circular progress file -->
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    
	<script src="vendor/chosen1.8/chosen.jquery.min.js"></script>
	
    <!-- Dropzone jquery file -->
    <script src="vendor/dropzone-master/dropzone.js"></script>
    
    
     <!-- swiper slider jquery file -->
    <script src="js/ladda/spin.min.js" type="text/javascript"></script>
	<script src="js/ladda/ladda.min.js" type="text/javascript"></script>
	<script src="js/ladda/ladda.jquery.min.js" type="text/javascript"></script>
	
	<!-- jquery toast message file -->
    <script src="vendor/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>
    
	 <!-- sweet alert -->
	 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Application main common jquery file -->
    <script src="js/fileupload_ns.js"></script>
    <script src="js/timezone.js"></script>
    <script src="js/main-with-style-switcher.js"></script>
    <script src="../httpdocs/user_js/working_order.js"></script>
	<script src="../httpdocs/user_js/log_out_script.js"></script>
	
	 <script  src="../permissions/js/settings.js?timestamp=<?php echo time(); ?>"></script>
    <script  src="../permissions/js/permission.js?timestamp=<?php echo time(); ?>"></script>
    <script  src="../permissions/js/validations.js?timestamp=<?php echo time(); ?>"></script>
    <script  src="../permissions/js/jsfunctions.js?timestamp=<?php echo time(); ?>"></script>
    <script type="text/javascript" src="../permissions/js/messagedropdown.js?timestamp=<?php echo time(); ?>"></script>

   
    <!-- page specific script -->
    <script>
        var interval = setInterval(function() {
        var momentNow = moment();
        
            $('#b_time').html(momentNow.tz('Asia/Bahrain').format('hh:mm:ss a'));
        }, 100);
        
    $(document).ready(function() {    
        
                 var invoice_list_table = $('#tbl_invoice_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
                var invoice_view_list_table = $('#list_of_invoices').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 $('#tbl_invoice_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#list_of_invoices').removeClass( 'display' ).addClass('table table-striped table-bordered');
        
        var session = '<?PHP echo $_SESSION["loggedin"];?>'; 

     
	 	
        $("#my-dropzone").dropzone({
            url: "../file-upload",
            addRemoveLinks: "dictRemoveFile"
        });
    
        $('.datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901               
        }, function(start, end, label) { });

   
    
        
    });
    
     
    function openNavR() {
      
     const wd= window.matchMedia("(min-width:500px)");
      
      if(wd.matches)
      {
          document.getElementById("mySidenavR").style.width = "83%";
      }
      else
      {
          document.getElementById("mySidenavR").style.width = "100%";
      }
        
    }

    function closeNavR() {
        document.getElementById("mySidenavR").style.width = "0";
    } 
    
    function closeNavRCancel() {
        document.getElementById("mySidenavRCancel").style.width = "0";
    }  
    function openNavRCancel() {
        const wd= window.matchMedia("(min-width:500px)");
      
      if(wd.matches)
      {
          document.getElementById("mySidenavRCancel").style.width = "83%";
      }
      else
      {
          document.getElementById("mySidenavRCancel").style.width = "100%";
      }
    }
    
     function openNavRProject() {
                const wd= window.matchMedia("(min-width:500px)");
              
                      if(wd.matches)
                      {
                          document.getElementById("mySidenavRProject").style.width = "83%";
                      }
                      else
                      {
                          document.getElementById("mySidenavRProject").style.width = "100%";
                      }
                      
                  
                      
            }
     function closeNavRProject() {
              document.getElementById("mySidenavRProject").style.width = "0";
    } 

    
      
        
  </script>
    
  
   
    
</body>

</html>
