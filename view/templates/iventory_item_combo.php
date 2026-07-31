

<?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn = new DBConnection();$varDBConnection = $DBConn->ConnectToMYSQL();	
?>
    <select  id="select_iventory_item" name="select_iventory_item" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true" >
    <option value="0" >Select Item</option>
    <?PHP 
        $result = mysqli_query($varDBConnection,"SELECT ids, item_name FROM inventory_tbl ORDER BY item_name ASC");
        while($row=mysqli_fetch_assoc($result)) {
                                                    		   
    ?>
    <option value="<?PHP echo $row['ids']; ?>" > <?PHP echo $row['item_name']; ?></option>
                                                                                  
    <?PHP
                    
    }
                        
    ?> 
</select> 
  <script>
      $('.chosen_select').chosen();
  </script> 