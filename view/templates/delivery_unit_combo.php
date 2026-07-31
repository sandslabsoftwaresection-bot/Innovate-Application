<?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn = new DBConnection();
$varDBConnection = $DBConn->ConnectToMYSQL();
?>
 <label for="Unit">Unit</label>
 <select  id="unit" name="unit" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true"  >
 <option value="0" >-Select Unit--</option>
<?PHP 
   $result = mysqli_query($varDBConnection,"SELECT unit_id,unit FROM store_items where status = 'Active'");
   while($row=mysqli_fetch_assoc($result)) {
                                                    		   
?>
  <option value="<?PHP echo $row['unit_id']; ?>" >  <?PHP echo $row['unit'] ?></option>
                             
                                                          
 <?PHP
                    
 }
                        
 ?> 
</select>
			

    <script>
        
        $('.chosen_select').chosen();
    </script>