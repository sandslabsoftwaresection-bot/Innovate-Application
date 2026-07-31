<?php session_start();
//echo "Session Check :  ".$_SESSION["LOGINSTATUS"]."tttt";

if($_SESSION["LOGINSTATUS"]!="true")
{
    // header("Location: ../index.php"); /* Redirect browser */
    // echo '<script>window.location="http://"'+location.hostname+'"/index.php"</script>';
        $URL="http://".$_SERVER['SERVER_NAME']."/view/signin.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    
    exit();
}


?>
