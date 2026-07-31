<?PHP 
include "../../model/db_connection/connection.php" ;
$DBConn = new DBConnection();$varDBConnection = $DBConn->ConnectToMYSQL();	
?>

<select  id="" name="" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
		<option value="0">-Select Item-</option>
		<option value="all">Select All</option>
		<?php  
			$result = mysqli_query($varDBConnection,"SELECT ids, item_name FROM inventory_tbl WHERE inventory_category='Finished' ORDER BY item_name ASC");
			while($row=mysqli_fetch_assoc($result)) {
		?>
		<option value="<?PHP echo $row['ids']; ?>" > <?PHP echo $row['item_name']; ?></option>
		<?php } ?>
</select>

<script>
   $('.chosen_select').chosen();
</script>