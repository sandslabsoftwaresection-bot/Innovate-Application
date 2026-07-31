$(function () {
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    //Popover
    $('[data-toggle="popover"]').popover();
    
    
    
    
    $('#signout').click(function(){
    
        $.post("../controller/login/login_controller.php",{action:'signout' }, function(result,status){
            
            $(location).attr('href','../view/signin.php');
        });
    
    
         //Tooltip
      
    });
    
    
    //  $('#reset_password').on('click', function () {
		
//	alert("hai");
		// $("#frm_reset_password")[0].reset();
// 		 $('#div_reset_password').html('');
		 //grecaptcha.reset();
		
        // var color = $(this).data('color');
        // $('#ChangePassModal .modal-content').removeAttr('class').addClass('modal-content modal-col-deep-orange');
// 		//$('#DTHModal .modal-title').html('DATA CARD RECHARGE');
// 		$('#ChangePassModal').modal('show');
//     });
    
    //   $("#txt_re_new_password").blur(function(){

    //     if($('#txt_re_new_password').val()!=$('#txt_new_password').val())
    //     {
    //         swal("Error", "Passwords don't match", "error");
    //         $('#txt_re_new_password').val("");
    //         $('#txt_new_password').val("");
    //         return false;
    //     }
    // });

   
    
    //   $('#but_reset_password').on('click', function () {
    //       var oldpassword=$('#txt_old_password').val();

    //       $.post("../../controller/company/company_controller.php",{action:'check_password',password:oldpassword}, function(result,status){
            
            
    //         if($.trim(result)==='success')
    //         {

    //             var newpassword = $('#txt_new_password').val();
          
    //             var renewpassword = $('#txt_re_new_password').val();
              
              
    //             if($.trim(newpassword)==='' || $.trim(renewpassword)==='')
    //                 {
    //                     $("#div_message_reset_password").html("Please provide new password...");
    //                     $("#div_reset_password_for_load").LoadingOverlay("hide", true); 
    //                 }
    //                 else
    //                 {
    //                     if($('#txt_re_new_password').val()!=="")
    //                     {
    //                         if($('#txt_re_new_password').val()!=$('#txt_new_password').val())
    //                         {
    //                             swal("Error", "Passwords don't match", "error");
    //                             $('#txt_re_new_password').val("");
    //                             $('#txt_new_password').val("");
    //                             return false;
    //                         }
    //                         else
    //                         {
    //                             $.post("../../controller/company/company_controller.php",{action:'insert_new_password',v_new_password:newpassword}, function(result,status){
    //                                 //alert(result);
    //                                 swal("success", "Password changed successfully", "success");
    //                             $('#txt_re_new_password').val("");
    //                             $('#txt_new_password').val("");
    //                             $('#txt_old_password').val("");
    //                             $("#div_reset_password_for_load").LoadingOverlay("hide", true);
    //                             });
    //                         }
    //                     }
                        
    //                 }

    //             }   
    //             else
    //             {
    //                 swal("Error", result, "error");
    //                 $('#txt_re_new_password').val("");
    //                 $('#txt_new_password').val("");
    //                 return false;
    //             }
    //     });

    
    
          
       
          
    //   });	
    
})
