

<?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn = new DBConnection();$varDBConnection = $DBConn->ConnectToMYSQL();	
?>
    <select  id="select_iventory_item" name="select_iventory_item" class="form-control form-control-sm">
    <option value="0" >-Select Item--</option>
    <?PHP 
        $result = mysqli_query($varDBConnection,"SELECT ids, item_name FROM inventory_tbl WHERE inventory_category != 'Finished' ORDER BY item_name ASC");
        while($row=mysqli_fetch_assoc($result)) {
                                                    		   
    ?>
    <option value="<?PHP echo $row['ids']; ?>" > <?PHP echo $row['item_name']; ?></option>
                                                                                  
    <?PHP
                    
    }
                        
    ?> 
</select>  