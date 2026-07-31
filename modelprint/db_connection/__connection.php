<?php
class DBConnection
{

    function ConnectToMYSQL()
    {
        
     // $con = mysqli_connect("localhost","sapphire_invoice_user","s@nds1@b","sapphire_invoice_db");
     $con = mysqli_connect("localhost","sianlab_incomedeck","s@nds1@b","sianlab_incomedeck");
      if (mysqli_connect_errno())
        {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $con;
    }


}
// class AcntConnection
// {

//     function ConnectToMYSQLAcnts()
//     {
        
//       $acnt_con = mysqli_connect("localhost","sianlab_accountsuser","s@nds1@b","sianlab_accounts");

//       if (mysqli_connect_errno())
//         {
//         echo "Failed to connect to MySQL: " . mysqli_connect_error();
//         }
//         return $acnt_con;
//     }


// }


?>
