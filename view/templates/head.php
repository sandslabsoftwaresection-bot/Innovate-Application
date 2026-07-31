<?PHP session_start();?>
<script src="js/jquery-3.2.1.min.js"></script>
 <header class="main-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-auto pl-0">
                        <button class="btn pink-gradient btn-icon" id="left-menu"><i class="material-icons">widgets</i></button>
                        <a href="index.php" class="logo"><img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt=""><span class="text-hide-xs"><b>Business</b>DECK</span></a>
                        <form class="search-header">
                            <div class="input-group">
                                <!--<input type="text" class="form-control" placeholder="Search...">-->
                                <!--<div class="input-group-append">-->
                                <!--    <button class="btn " type="button"><i class="material-icons">search</i></button>-->
                                <!--</div>-->
                            </div>

                        </form>
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
                    <div class="col-auto pr-0" >
                        <button class="btn btn-link text-hide-md header-color-secondary font-small px-0" type="button"><i class="material-icons">text_format</i></button>
                        <button class="btn btn-link text-hide-md header-color-secondary font-big px-0 mr-3" type="button"><i class="material-icons">text_format</i></button>

                        <button class="btn btn-search btn-icon header-color-secondary" type="button"><i class="material-icons">search</i></button>

                        
          
                        <div class="dropdown d-inline-block">
                            <a class="btn header-color-secondary dropdown-toggle username" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <figure class="userpic"><img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt=""></figure>
                                <h5 class="text-hide-xs">
                                    <small class="header-color-secondary">Welcome,</small>
                                    <span class="header-color-primary" id="header_name"><?PHP echo ucfirst($_SESSION["user_real_name"])?></span>
                                    <input type="hidden" id="head_session_user_id" value="<?PHP echo ucfirst($_SESSION["user_id"])?>">
                                    <input  type="hidden" class="form-control" name="txt_user_name" id="txt_user_name" value="<?PHP echo ucfirst($_SESSION["user_id"])?>">

                                </h5>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown" aria-labelledby="dropdownMenuLink">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <a href="profile.html">
                                            <figure class="avatar avatar-120 mx-auto my-3">
                                                <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="">
                                            </figure>
                                            <h5 class="card-title mb-2 header-color-primary"><?PHP echo ucfirst($_COOKIE['user_name'])?></h5>
                                            <h6 class="card-subtitle mb-3 header-color-secondary"><?PHP echo ucfirst($_COOKIE['user_type_name'])?></h6>
                                        </a>
                                        <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                        <!--<button class="btn btn-sm pink-gradient border-0 mb-3">Edit</button>-->
                                    </div>
                                </div>
                                <a class="dropdown-item pink-gradient-active" href="javascript:void(0);" id="open-right-sidebar">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            Setting
                                        </div>

                                        <div class="col-auto">
                                            <div class="header-color-secondary ml-2"><i class="material-icons vm">settings</i></div>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider m-0"></div>
                                <!--<a class="dropdown-item pink-gradient-active" href="javascript:void(0);">-->
                                <!--    <div class="row align-items-center">-->
                                <!--        <div class="col">-->
                                <!--            5458 <small class="header-color-secondary font-italic">Points Collected</small>-->
                                <!--        </div>-->

                                <!--        <div class="col-auto">-->
                                <!--            <i class="header-color-secondary material-icons vm">local_play</i>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</a>-->
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item pink-gradient-active" id="change_pass">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            Change Password
                                        </div>

                                        <div class="col-auto">
                                            <div class="text-warning ml-2"><i class="material-icons vm">edit</i></div>
                                        </div>
                                    </div>
                                </a>
                                <!--<div class="dropdown-divider m-0"></div>-->
                                <!--    <a class="dropdown-item pink-gradient-active" href="signin.php">-->
                                <!--    <div class="row align-items-center">-->
                                <!--        <div class="col">-->
                                <!--            Change Password-->
                                <!--        </div>-->

                                <!--        <div class="col-auto">-->
                                <!--            <div class="text-warning ml-2"><i class="material-icons vm">edit</i></div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</a>-->
                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item pink-gradient-active" href="signin.php">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            Logout
                                        </div>

                                        <div class="col-auto">
                                            <div class="text-danger ml-2"><i class="material-icons vm">exit_to_app</i></div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        
         <!-- Modal Purchase req child table -->
 <div class="modal modal-md fade" id="modal_password_change" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Change Password</h5>
					<button type="button" class="close" data-dismiss="modal" id="" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                   
                    <div id="div_reset_password_for_load">
                           
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        
                                        <div class="col-lg-4 col-md-4">
                                            <label>Old Password</label>
                                            	<input type="password" id="txt_old_password" class="form-control" name="minmaxlength" style="font-size:18px;font-weight: bold" required="" autocomplete="nope" readonly onfocus="this.removeAttribute('readonly');">
                                        </div>
                                        
        								<div class="col-lg-4 col-md-4">
                                            <label>New Password</label>
                                            	<input type="password" id="txt_new_password" class="form-control" name="number" style="font-size:18px;font-weight: bold" required="">
                                        </div>
                                        
        								<div class="col-lg-4 col-md-4">
                                            <label>Re-enter Password</label>
                                            <input type="password" id="txt_re_new_password" class="form-control" name="number" style="font-size:18px;font-weight: bold" required="">
                                        </div>					<!--End Network Operators-->
														
														
														
															<!--<div class="col-md-10" id="div_message_reset_password" style="color:red;text-align: center">-->
																
															<!--</div>-->
										</div>
										
                        
                        </div>
                        
                        </div>
                        </div>
                        
                    <br />
                    <div class="modal-footer">
					
                                    <button class="btn btn-secondary" id="cancel_reset"> Cancel</button>
                                    <button type="button" class="btn btn-warning text-white float-right ladda-button" id="reset_password" data-style="expand-right"><span class="ladda-label">Reset Now</span><span class="ladda-spinner"></span></button>
			    </div>    
                  
					</div>
						  
                    </div>
				        
                </div>
				
                       
            </div>
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <script>
    $(document).ready(function(){
        $('#change_pass').click(function(){
            $('#modal_password_change').modal('show');
            
        });
         var v_reset_password = $( '#reset_password' ).ladda();
      var user_id = $('#txt_user_name').val();
                $('#txt_old_password').blur(function() {
        	     
        	     var old_password=$('#txt_old_password').val();
        	   //  alert(old_password);
        	     
        	     $.post("../controller/login/login_controller.php",{action:'check_old_password_for_header',old_password:old_password,user_id:user_id}, function(result,status){
        	         
        	       // alert(result);
        	        
        	         if($.trim(result)=='0')
        	         
        	         {
        	             $('#txt_old_password').val("");
        	             $.toast({
                                heading: 'Error,',
                                text: 'Invalid Attempt..! Please Check your Old Password...',
                                position: 'top-center',
                                stack: false,
                                hideAfter: 6000,
                                icon: 'error'
                            });
        	         }
        	         
        	         
        	     });
        	     
        	     
        	 });
        	 
        	 
	 
	 
    	 $('#txt_new_password,#txt_re_new_password').blur(function() {
    	     
    	      var new_password = $('#txt_new_password').val();
    	      var re_new_password = $('#txt_re_new_password').val();
    	      
    	      if($.trim(re_new_password)=="")
        	      {
        	          
        	      }
    	      else if($.trim(new_password)==$.trim(re_new_password))
        	      {
        	            
        	      }
    	      else
    	      {
    	           $('#txt_new_password,#txt_re_new_password').val("");
    	             $.toast({
                            heading: 'Error,',
                            text: 'Invalid Attempt..! Password is mismatch...',
                            position: 'top-center',
                            stack: false,
                            hideAfter: 6000,
                            icon: 'error'
                        });
    	      }
    	      
    	     
    	 });
    	 
	 
            $('#reset_password').click(function(){
                
                v_reset_password.ladda( 'start' );
            
                var old_password=$('#txt_old_password').val();
                var new_password = $('#txt_new_password').val();
            	var re_new_password = $('#txt_re_new_password').val();
            	
                 if($.trim(old_password) == "" || $.trim(new_password) == "" || $.trim(re_new_password) == "" )
                {
                 $.toast({
                                    heading: 'Error,',
                                    text: 'Please fill all fields...',
                                    position: 'top-center',
                                    stack: false,
                                    hideAfter: 6000,
                                    icon: 'error'
                                });
                }
               else
               {
                $.post("../controller/login/login_controller.php",{action:'password_update_for_header',new_password:new_password,user_id:user_id}, function(result,status){   
                
            	$.toast({
                                    heading: 'Success,',
                                    text: 'Password is updated successfully',
                                    position: 'top-center',
                                    stack: false,
                                    hideAfter: 6000,
                                    icon: 'success'
                                });
            	     $('#txt_old_password').val("");
                     $('#txt_new_password').val("");
            	     $('#txt_re_new_password').val("");
            	
            	});
               }
                v_reset_password.ladda( 'stop' );
            });
            	 
            	 
            
            $('#cancel_reset').click(function(){
                
                     $('#txt_old_password').val("");
                     $('#txt_new_password').val("");
            	     $('#txt_re_new_password').val("");
            	   $('#modal_password_change').modal('hide');
                
            });
    });    
    </script>