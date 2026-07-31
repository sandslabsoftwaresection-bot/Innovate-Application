
<?php
	    session_start();
		$_SESSION = array();
		session_destroy();
	
	
	
	

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

    <!-- swiper slider CSS -->
    <link rel="stylesheet" href="vendor/swiper/css/swiper.min.css">
    
    <!-- ladda CSS -->
    <link rel="stylesheet" href="css/ladda/ladda-themeless.min.css">
    
    <!-- Bootstra tour CSS -->
    <link rel="stylesheet" href="vendor/bootstrap_tour/css/bootstrap-tour-standalone.css">
    <link rel="stylesheet" type="text/css" href="js/sweetalert/sweetalert.css">
    <!-- app CSS -->
    <link id="theme" rel="stylesheet" href="css/purplesidebar.css" type="text/css">

    <?PHP include('templates/page_title.php')?>
</head>

<body class="fixed-header sidebar-right-close sidebar-left-close">
    <!-- page loader -->
    <?PHP include('templates/page_loader.php')?>
    <!-- page loader ends  -->

    <div class="wrapper h-100 justify-content-center h-sm-auto">
        <!-- main header -->
        <header class="main-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-auto pl-0">
                       <!--<button class="btn pink-gradient btn-icon" id="left-menu"><i class="material-icons">widgets</i></button>-->
                        <a href="#!" class="logo"><img src="../../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt=""><span class="text-hide-xs"><b>Business</b>DECK</span></a>
                    </div>
                    <div class="col text-center p-xs-0">
                        <ul class="time-day">
                            <li class="text-right">
                                <p class="header-color-primary"><span class="header-color-secondary"><?PHP date_default_timezone_set('Asia/Bahrain'); echo date("F");?></span><small><?PHP echo date("Y");?></small></p>
                                <h2><?PHP echo date("d");?></h2>
                            </li>
                            <li class="text-left">
                               <h2><?PHP echo round((int)($arr['main']['temp'])-273.15);?><span class="header-color-secondary font-weight-light"><sup>o</sup>C</span></h2>
                                <p class="header-color-primary text-hide-lg"><span class="header-color-secondary">Bahrain</span><small id="b_time"><?PHP echo date("h:i: a");?></small></p>
                            </li>
                        </ul>

                    </div>
                    <div class="col-auto">
                        <button class="btn btn-link text-hide-md header-color-secondary font-small px-0" type="button"><i class="material-icons">text_format</i></button>
                        <button class="btn btn-link text-hide-md header-color-secondary font-big px-0 mr-3" type="button"><i class="material-icons">text_format</i></button>
                        <!--<a href="signup1.html" class="btn pink-gradient rounded d-inline-block" ><i class="material-icons">person</i> Sign Up</a>-->
                    </div>
                </div>
            </div>
        </header>
        <!-- main header ends -->

      
        <!-- content page -->
        <div class="container-fluid h-100 h-sm-auto">
            <div class="row h-100 h-sm-auto">
                <div class="col-12 col-md-6 h-md-100  h-sm-auto order-2 order-md-1">
                    <div class="row align-items-center h-100 h-sm-auto">
                        <div class="col-10 col-md-10 col-lg-8 col-xl-6 mx-auto">
                            <h1 class="font-weight-light mb-3 mt-4 content-color-secondary text-left">We are Business<span class="font-weight-normal content-color-primary">DECK</span></h1>
                            <h4 class="font-weight-light mb-4 content-color-secondary text-left">Welcome back,<br>Please sign in to your account.</h4>
                            <div class="card mb-2">
                                <div class="card-body p-0">
                                    <label for="inputEmail" class="sr-only">Username</label>
                                    <input type="text" id="inputUsername" class="form-control form-control-lg border-0" placeholder="Username " required="" autofocus="">
                                    <hr class="my-0">
                                    <label for="inputPassword" class="sr-only">Password</label>
                                    <input type="password" id="inputPassword" class="form-control form-control-lg border-0" placeholder="Password" required="">
                                </div>
                            </div>
                            <small class="form-text text-muted">Authorized access only...! we are tracking your IP address : <?PHP echo $_SERVER['REMOTE_ADDR'];?></small>
                            <div class="my-4 row">
                              <div class="col-12 col-md-6 h-md-100  h-sm-auto order-2 order-md-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember_passord"  name="auth[]" value="1" checked>
                                            <label class="custom-control-label" for="remember_passord">Remember Me</label>
                                        </div>
                              </div>
                              <div class="col-12 col-md-6 h-md-100  h-sm-auto order-2 order-md-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="auto_login" name="auth[]" value="2" checked>
                                            <label class="custom-control-label" for="auto_login">Auto Login</label>
                                        </div>
                              </div>
                            </div>
                            <div class="text-left mb-4">
                                <a href="#" class=" btn btn-primary pink-gradient" id="btn_login">Sign In</a>
                                <br/><small class="form-text text-muted">If you forget your login credentials please contact your system administrator. </small>
                                <a href="#" class="float-right btn btn-outline-primary" id= "btn_forgot_pass">Forget Password</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 h-md-100 order-1 order-md-2 min-height-300 p-0 bg-dark ">
                    <div class="carosel swiper-location-carousel h-100 h-sm-auto">
                        <div data-pagination='{"el": ".swiper-pagination"}' data-space-between="0" data-slides-per-view="1" class="swiper-container swiper-init swiper-signin h-100">
                            <div class="swiper-pagination"></div>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide text-center ">
                                    <div class="background-img"><img src="img/banner.png" alt="" class="w-auto float-right"></div>
                                    <div class="row align-items-center h-100 text-white">
                                        <div class="col-10 col-md-8 col-lg-6 mx-auto">
                                            <h2 class="font-weight-light mb-4">BusinessDECK make your business more easy</h2>
                                            <p>BusinessDECK is a business application to track your business document easily..!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide text-center">
                                    <div class="background-img"><img src="img/banner2.png" alt="" class="w-auto"></div>
                                    <div class="row align-items-center h-100 text-white">
                                        <div class="col-10 col-md-8 col-lg-6 mx-auto">
                                            <h2 class="font-weight-light mb-4">Business Document Management</h2>
                                            <p>A portal to create and track your business documents...! </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- swiper slider jquery file -->
    <script src="vendor/bootstrap-daterangepicker-master/moment.js"></script>
    <script src="vendor/swiper/js/swiper.min.js"></script>
    
    <!-- swiper slider jquery file -->
    <script src="js/ladda/spin.min.js" type="text/javascript"></script>
	<script src="js/ladda/ladda.min.js" type="text/javascript"></script>
	<script src="js/ladda/ladda.jquery.min.js" type="text/javascript"></script>
    
     <!-- jquery toast message file -->
    <script src="vendor/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>
    <!-- sweet alert -->
	 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Application main common jquery file -->
    <script src="js/main-with-style-switcher.js"></script>
    <script src="js/timezone.js"></script>
   <script src="../httpdocs/login_js/login.js"></script>
    <!-- page specific script -->
    <script>
        'use strict';
        var mySwiper = new Swiper('.swiper-signin', {
            slidesPerView: 1,
            spaceBetween: 0,
            autoplay: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            }
        });

        $(window).on('resize', function() {
            var mySwiper = new Swiper('.swiper-signin', {
                slidesPerView: 1,
                spaceBetween: 0,
                autoplay: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                }
            });
        });



     var interval = setInterval(function() {
        var momentNow = moment();
        
            $('#b_time').html(momentNow.tz('Asia/Bahrain').format('hh:mm:ss a'));
        }, 100);
        
        
        $('#btn_forgot_pass').click(function(){
            $.post("../controller/login/login_controller.php",{action:"select_username_password"},function(result,status){
                
                var obj= jQuery.parseJSON(result);
                var v_user_name = obj.data[0].user_name;
                var v_user_password = obj.data[0].user_password;
               
                if(status=="success")
                {
                 $.post("sendmail.php",{action:"sendmail",v_user_name:v_user_name,v_user_password:v_user_password},function(){
                        swal("Success","Login credentials send to your email 38383956b@gmail.com ..", "success");
                  })
            
                }
            })
            
           
        })
       	
            
    </script>
</body>

</html>
