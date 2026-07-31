

<?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn = new DBConnection();$varDBConnection = $DBConn->ConnectToMYSQL();	
?>
    <select  id="select_iventory_item" name="select_iventory_item" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
    <option value="0" >-Select Item--</option>
    <?PHP 
        $result = mysqli_query($varDBConnection,"SELECT item_id, item_name, item_code,cat_id,cat_name,unit,tax_value FROM store_items WHERE status = 'Active' ORDER BY item_name ASC");
        while($row=mysqli_fetch_assoc($result)) {
                                                    		   
    ?>
    <option value="<?PHP echo $row['item_id'].'$'.$row['cat_id'].'$'.$row['cat_name'].'$'.$row['item_code'].'$'.$row['unit']. '$' .$row['tax_value']; ?>" > <?PHP echo $row['item_name']. '*' . $row['item_code']; ?></option>
                                                                                  
    <?PHP
                    
    }
                        
    ?> 
</select>  
<script>
        
        $('.chosen_select').chosen();
</script>
