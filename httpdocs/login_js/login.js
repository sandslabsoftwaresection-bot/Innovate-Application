$(document).ready(function(){
    	$('#inputUsername').val($.cookie("username"));
        $('#inputPassword').val($.cookie("auth"));
        
        // function api_check()
        //           {
                       
        //               	$.post("../controller/api_check/api_check.php",{action:'check_api'}, function(result,status){ 
                      	   
                      	 
        //               	    var error_code = jQuery.parseJSON(result);
        //             //   alert(result);
        //               	    if($.trim(error_code.ERROR)=="101" || $.trim(error_code.ERROR)=="102")
        //               	    {
        //               	    //$(location).attr('href','signin.php');
        //               	    alert(error.MESSAGE);
        //                     return;
        //               	    }
                      	    
        //               	});
                       
        //           } 
                  
    
    var v_but_login = $( '#btn_login' ).ladda();
          
    
    v_but_login.click(function(){
                v_but_login.ladda( 'start' );
                
                var username = $('#inputUsername').val();
				var password = $('#inputPassword').val();
			
			    var auto_login = "false";
			    var val = [];
			    
			     $('.custom-control-input:checked').each(function(i){
                  val[i]=$(this).val();
                });
                
            
			  
				if(val[0]==='1'||val[1]==='1')
				{
				
					$.cookie("username",username, { expires : 365 } );
					$.cookie("auth",password, { expires : 365 });
					
				  
				}
				else
				{
					$.removeCookie("username");
					$.removeCookie("auth");
				}
				
				
				if(val[0]==='2'|| val[1]==='2')
				{
					
				   
					$.cookie("autologin",'true', { expires : 365 } );
				
				  
				}
				else
				{
				    
						$.removeCookie("autologin");
				}
				
				$.post("../controller/login/login_controller.php",{action:'login',username:username,password: password}, function(result,status){
              	var str = result.split('#');
               
                if($.trim(str[0])=='true')
                {
                   
					v_but_login.ladda( 'stop' );
                    $(location).attr('href',str[1]);
                    
                }
                else
                {
                    $.toast({
                        heading: 'Error,',
                        text: 'Invalid Attempt..! Please Check your Username and Password...',
                        position: 'top-center',
                        stack: false,
                        hideAfter: 6000,
                        icon: 'error'
                    });
                   	v_but_login.ladda( 'stop' );
                }
               
             
           }); 
				
				
    });
    
    
});