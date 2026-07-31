

<?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn = new DBConnection();$varDBConnection = $DBConn->ConnectToMYSQL();	
?>
    <select  id="select_iventory_category" name="select_iventory_category" class="form-control form-control-sm" >
    <option value="0" >Select Category</option>
    <?PHP 
        $result = mysqli_query($varDBConnection,"SELECT DISTINCT inventory_category FROM inventory_tbl ORDER BY inventory_category ASC ");
        while($row=mysqli_fetch_assoc($result)) {
                                                    		   
    ?>
    <option value="<?PHP echo $row['inventory_category']; ?>" > <?PHP echo $row['inventory_category']; ?></option>
                                                                                  
    <?PHP
                    
    }
                        
    ?> 
</select> 
  <script>
      $('.chosen_select').chosen();
  </script> 