

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
 <select  id="select_bank" name="select_bank" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true"  >
 <option value="0" >-Select Bank--</option>
 <option value="1" >Not Available</option>
<?PHP 
    $itemNumber=2;
   $result1 = mysqli_query($varDBConnection1,"SELECT DISTINCT trim(bank_name) as bank_name FROM  tlb_income_and_expence  where bank_name !='' and bank_name !='NA' order by bank_name");
   while($row=mysqli_fetch_assoc($result1)) {
                                                    		   
?>
  <option value="<?PHP echo $itemNumber; $itemNumber++; ?>" >  <?PHP echo ucwords($row['bank_name']) ?></option>
                             
                                                          
 <?PHP
                    
 }
                        
 ?> 
 
</select>
			

    <script>
        
        $('.chosen_select').chosen();
    </script>