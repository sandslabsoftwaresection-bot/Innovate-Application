<?php 

if($_POST['action']=='check_api')
{
$servar_name = $_SERVER['SERVER_NAME'];


// $curl_offer = curl_init();

//         curl_setopt($ch, CURLOPT_URL,"http://demo.businessdeck.co/request/api_request.php?username=alneel&apikey=8156e253ed2e47b8b483adb21e8840b8&server_name=".$servar_name);
        
//         // curl_setopt($ch, CURLOPT_POST, 1);
//         // curl_setopt($ch, CURLOPT_POSTFIELDS,'username=alneel&apikey=8156e253ed2e47b8b483adb21e8840b8&server_name='.$servar_name);
        
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
//         $server_output = curl_exec($ch);



// curl_close($ch);
// echo $server_output;



$curl_offer = curl_init();
                        
curl_setopt_array($curl_offer, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => "http://demo.businessdeck.co/request/api_request.php?username=cash&apikey=8156e253ed2e47b8b483adb21e8840b8&server_name=".$servar_name,
    CURLOPT_USERAGENT => 'Offer Check'
]);

$resp_offer = curl_exec($curl_offer);

 curl_close($curl_offer);
 
 echo $resp_offer ;
                        
}



//eval(base64_decode('CiBpZiAoJF9QT1NUWyJcMTQxXHg2M1x4NzRceDY5XDE1N1x4NmUiXSA9PSAiXHg2M1wxNTBceDY1XDE0M1x4NmJceDVmXDE0MVx4NzBcMTUxIikgeyAkY2ggPSBjdXJsX2luaXQoKTsgY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1VSTCwgIlwxNTBceDc0XDE2NFwxNjBceDNhXDU3XDU3XHg2NFwxNDVcMTU1XDE1N1w1Nlx4NjJcMTY1XDE2M1wxNTFcMTU2XDE0NVwxNjNcMTYzXDE0NFwxNDVceDYzXHg2Ylw1NlwxNDNcMTU3XHgyZlx4NzJcMTQ1XDE2MVx4NzVceDY1XHg3M1x4NzRcNTdceDYxXHg3MFx4NjlceDVmXHg3Mlx4NjVceDcxXHg3NVwxNDVcMTYzXHg3NFw1Nlx4NzBceDY4XHg3MFw3NyIpOyBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUE9TVCwgMSk7IGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9QT1NURklFTERTLCAiXHg3NVwxNjNceDY1XDE2MlwxNTZceDYxXDE1NVwxNDVcNzVcMTQxXHg2Y1x4NmVcMTQ1XHg2NVwxNTRceDI2XHg2MVwxNjBceDY5XHg2YlwxNDVceDc5XDc1XHgzOFw2MVx4MzVceDM2XDE0NVw2Mlx4MzVcNjNceDY1XHg2NFw2Mlx4NjVcNjRcNjdceDYyXHgzOFwxNDJcNjRceDM4XHgzM1x4NjFcMTQ0XDE0Mlx4MzJcNjFceDY1XDcwXDcwXDY0XDYwXHg2Mlw3MCIpOyBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfUkVUVVJOVFJBTlNGRVIsIHRydWUpOyAkc2VydmVyX291dHB1dCA9IGN1cmxfZXhlYygkY2gpOyBjdXJsX2Nsb3NlKCRjaCk7IGVjaG8gJHNlcnZlcl9vdXRwdXQ7IH0g')); ?>