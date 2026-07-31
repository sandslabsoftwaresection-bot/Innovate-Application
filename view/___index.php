
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

    <!-- app CSS -->
    <link id="theme" rel="stylesheet" href="css/purplesidebar.css" type="text/css">

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
        <?PHP include('templates/main_content_head.php')?>
       
        <!-- content page title ends -->
       
        <!-- content page -->
       <?PHP include('templates/main_content.php')?>
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

    <!-- sparklines chart jquery file -->
    <script src="vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- Circular progress gauge jquery file -->
    <script src="vendor/circle-progress/circle-progress.min.js"></script>

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

    <!-- circular progress file -->
    <script src="vendor/circle-progress/circle-progress.min.js"></script>

    <!-- Application main common jquery file -->
    <script src="js/main-with-style-switcher.js"></script>
    <script src="js/timezone.js"></script>

    <!-- page specific script -->
    
    
   <script>
        var interval = setInterval(function() {
        var momentNow = moment();
        
            $('#b_time').html(momentNow.tz('Asia/Bahrain').format('hh:mm:ss a'));
        }, 100);
       
    
    
     $(document).ready(function() {    
        
        var session = '<?PHP echo $_SESSION["loggedin"];?>'; 

       if(session ==='true')
        {
            
            
           
    	    $.cookie("user_id","<?PHP echo $_SESSION["user_id"]; ?>", { expires : 365 } );
    	 	$.cookie("user_name","<?PHP echo $_SESSION["user_name"]; ?>", { expires : 365 } );
    	 	$.cookie("user_contact_number","<?PHP echo $_SESSION["user_contact_number"]; ?>", { expires : 365 } );
    	    $.cookie("user_address","<?PHP echo $_SESSION["user_address"]; ?>", { expires : 365 } );
	        $.cookie("user_whatsapp_no","<?PHP echo $_SESSION["user_whatsapp_no"]; ?>", { expires : 365 } );
	        $.cookie("user_email_id","<?PHP echo $_SESSION["user_email_id"]; ?>", { expires : 365 } );
    	 	$.cookie("user_type_id","<?PHP echo $_SESSION["user_type_id"]; ?>", { expires : 365 } );
    	 	$.cookie("user_type_name","<?PHP echo $_SESSION["user_type_name"];?>", { expires : 365 } );
    	 	$.cookie("user_username","<?PHP echo $_SESSION["user_username"]; ?>", { expires : 365 } );
    	 	$.cookie("user_image","<?PHP echo $_SESSION["user_image"]; ?>", { expires : 365 } );
    	 	$.cookie("user_status","<?PHP echo $_SESSION["user_status"]; ?>", { expires : 365 } );
    	 	$.cookie("user_privilege",'<?PHP echo $_SESSION['privilege']; ?>', { expires : 365 } );
    	 	
    	 	
    	 	 var obj = jQuery.parseJSON($.cookie("user_privilege"));
    	 	  for(var i=0; i <= 3; i++)
             {
              if(obj.data[i].add_privilege==='1')
              {
               $.cookie("add_privilege_"+i,'1', { expires : 365 } ); 
                
              }
              else
              {
                 $.cookie("add_privilege_"+i,'0', { expires : 365 } );  
              }
              
             }
    		  for(var i=0; i <= 3; i++)
             {
              if(obj.data[i].edit_privilege==='1')
              {
               $.cookie("edit_privilege_"+i,'1', { expires : 365 } ); 
                
              }
              else
              {
                 $.cookie("edit_privilege_"+i,'0', { expires : 365 } );  
              }
              
             }
              for(var i=0; i <= 3; i++)
             {
              if(obj.data[i].delete_privilege==='1')
              {
               $.cookie("delete_privilege_"+i,'1', { expires : 365 } ); 
                
              }
              else
              {
                 $.cookie("delete_privilege_"+i,'0', { expires : 365 } );  
              }
              
             }
              for(var i=0; i <= 3; i++)
             {
              if(obj.data[i].view_privilege==='1')
              {
               $.cookie("view_privilege_"+i,'1', { expires : 365 } ); 
               
              }
              else
              {
                 $.cookie("view_privilege_"+i,'0', { expires : 365 } );  
              }
              
             }
            
    	 
        }
        else
        {
            
            
             if($.cookie("autologin")!='true')
             {
                $(location).attr('href','signin.php');
                return;
             }
        
        }
	  
        
    });
    
    
	//window.location="http://www.sands	window.location="index.php"

   
    </script>  
   
    
</body>

</html>
