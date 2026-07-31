$(document).ready(function(){
    
    
   var v_reset_password = $( '#reset_password' ).ladda();
	
	 
	 
// 	 $('#txt_old_password').blur(function() {
	     
// 	     var old_password=$('#txt_old_password').val();
// 	     //alert(old_password);
	     
// 	     $.post("../controller/login/login_controller.php",{action:'check_old_password',old_password:old_password}, function(result,status){
	         
// 	       // alert(result);
	        
// 	         if($.trim(result)=='0')
	         
// 	         {
// 	             $('#txt_old_password').val("");
// 	             $.toast({
//                         heading: 'Error,',
//                         text: 'Invalid Attempt..! Please Check your Old Password...',
//                         position: 'top-center',
//                         stack: false,
//                         hideAfter: 6000,
//                         icon: 'error'
//                     });
// 	         }
	         
	         
// 	     });
	     
	     
// 	 });
	 
	 
	 
	 
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
    $.post("../controller/login/login_controller.php",{action:'password_update',new_password:new_password}, function(result,status){   
    
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
	      
    
});
    
});