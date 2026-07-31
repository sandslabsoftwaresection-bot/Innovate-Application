
<?php
include("session_check.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
   
}
?>
<?

    $random_number = rand(100000, 999999);
    echo $random_number;
    
    if(isset($_SESSION['otp']))
    {
        return false;
        exit;
    }
	if( $_POST['action']=='sendmail_otp')
	{
	    $_SESSION['otp']=$random_number;
	   // $user_name=$_POST['v_user_name'];
	   // $user_password= $_POST['v_user_password'];
		$useremail="innovate.sapphirebh.com";
		 $to = "info@sapphirebh.com";
		//$to = "ancysinto016@gmail.com";
         $subject = "OTP";
         
        // $message = $usermsg.'</ br></ br> '.' With Thanks, </ br></ br>'.$username;
		
		
	$message =	'<html><style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #666666;
}
.style1 {color: #FFFFFF}
.style2 {
	font-size: 9px;
	color: #FFFFFF;
}
a:link {
	color: #FFFFFF;
}
-->
</style>


<body>

<table width="100%" border="0">
  <tr>
    <td height="39" colspan="2" align="center" bgcolor="#eeeee4"><span class="style1">Kindly find the below OTP for cancel the LPO</span></td>
  </tr>
  <tr>
    <td width="17%" height="30" align="center" valign="middle">'.$random_number.'</td>
   
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle" bgcolor="#666666"><span class="style2"><a href="#" target="_blank">  </a></span></td>
  </tr>
</table>
</body>
</html>';

        
         
         $header = "From:".$useremail." \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent... Try later";
		}
	}
	
	
	

	
	
?>