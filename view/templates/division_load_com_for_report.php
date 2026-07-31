

<?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn = new DBConnection();$varDBConnection = $DBConn->ConnectToMYSQL();	
?>
    <select  id="select_division" name="select_division" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true" multiple>
    <option value="0" >-Select Item--</option>
    <?PHP 
        $result = mysqli_query($varDBConnection,"SELECT ids,division_name FROM division_master where status!='Deactive'");
        while($row=mysqli_fetch_assoc($result)) {
                                                    		   
    ?>
    <option value="<?PHP echo $row['ids']; ?>" > <?PHP echo $row['division_name']; ?></option>
                                                                                  
    <?PHP
                    
    }
                        
    ?> 
</select>  
<script>
        
        $('.chosen_select').chosen();
</script>
