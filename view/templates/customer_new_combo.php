

 <?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn1 = new DBConnection();
$varDBConnection1 = $DBConn1->ConnectToMYSQL();
// $varDBConnection->query("SET character_set_client=utf8");
    //  $varDBConnection->query("SET character_set_connection=utf8");
    //  $varDBConnection->query("SET character_set_results=utf8");
 //echo $_POST['sport_id_sel'];
//	$result_association_for_club = mysqli_query($varDBConnection,"SELECT association_id,associationnameEn,associationnameAr FROM `view_association_sports` where sport_id='".$_POST['sport_id_sel']."'");
//	echo "SELECT association_id,associationnameEn,associationnameAr FROM `view_association_sports` where sport_id='".$_POST['sport_id_sel']."'";
	
?>
 <select  id="select_payment_search_customer" name="select_payment_search_customer" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true"  >
 <option value="0" >-Select Customer--</option>
<?PHP 
   $result1 = mysqli_query($varDBConnection1,"SELECT CustomerID,customer_name,type FROM view_list_of_all_customer_supplier_other  ");
   while($row=mysqli_fetch_assoc($result1)) {
                                                    		   
?>
  <option value="<?PHP echo $row['CustomerID']; ?>" >  <?PHP echo ucwords($row['customer_name']).'  || '.$row['type'] ?></option>
                             
                                                          
 <?PHP
                    
 }
                        
 ?> 
</select>
			

    <script>
        
        $('.chosen_select').chosen();
    </script>