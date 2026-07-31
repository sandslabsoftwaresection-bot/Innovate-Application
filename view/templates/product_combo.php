

 <?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn = new DBConnection();
$varDBConnection = $DBConn->ConnectToMYSQL();
// $varDBConnection->query("SET character_set_client=utf8");
    //  $varDBConnection->query("SET character_set_connection=utf8");
    //  $varDBConnection->query("SET character_set_results=utf8");
 //echo $_POST['sport_id_sel'];
//	$result_association_for_club = mysqli_query($varDBConnection,"SELECT association_id,associationnameEn,associationnameAr FROM `view_association_sports` where sport_id='".$_POST['sport_id_sel']."'");
//	echo "SELECT association_id,associationnameEn,associationnameAr FROM `view_association_sports` where sport_id='".$_POST['sport_id_sel']."'";
	
?>
 <select  id="select_product_name" name="select_product_name" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true"  >
 <option value="0" >-Select Product--</option>
<?PHP 
   $result = mysqli_query($varDBConnection,"SELECT product_id,product_name FROM product_master_tbl");
   while($row=mysqli_fetch_assoc($result)) {
                                                    		   
?>
  <option value="<?PHP echo $row['product_id']; ?>" >  <?PHP echo $row['product_name'] ?></option>
                             
                                                          
 <?PHP
                    
 }
                        
 ?> 
</select>
			

    <script>
        
        $('.chosen_select').chosen();
    </script>