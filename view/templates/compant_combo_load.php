

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
 <select  id="select_company_search" name="select_company_search" class="chosen_select form-control form-control-lg" data-live-search="true" tabindex="-1"  aria-hidden="true" style="width:100%" >
 <option value="0" >All</option>
<?PHP 
   $result = mysqli_query($varDBConnection,"SELECT company_id,company_name FROM company_details where status='Active'");
   while($row=mysqli_fetch_assoc($result)) {
                                                    		   
?>
  <option value="<?PHP echo $row['company_id']; ?>" >  <?PHP echo $row['company_name'] ?></option>
                             
                                                          
 <?PHP
                    
 }
                        
 ?> 
</select>
			

    <script>
        
        $('.chosen_select').chosen();
    </script>