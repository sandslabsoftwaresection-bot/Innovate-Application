

<?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn = new DBConnection();$varDBConnection = $DBConn->ConnectToMYSQL();	
?>
    <select  id="inventory_cat_v1" name="inventory_cat_v1" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
    <!--<select  id="select_iventory_category" name="select_iventory_category" class="form-control form-control-sm">-->
    <option value="0" >-Select Category--</option>
    <?PHP 
        $result = mysqli_query($varDBConnection,"SELECT ids, cat_name FROM inventory_main_category WHERE status = 'Active' ORDER BY cat_name ASC");
        while($row=mysqli_fetch_assoc($result)) {
                                                    		   
    ?>
    <option value="<?PHP echo $row['ids']; ?>" > <?PHP echo $row['cat_name']; ?></option>
                                                                                  
    <?PHP
                    
    }
                        
    ?> 
</select>  
 <script>
        
        $('.chosen_select').chosen();
    </script>