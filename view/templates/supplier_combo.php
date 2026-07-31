<?PHP 
include "../../model/db_connection/connection.php";
$DBConn = new DBConnection();
$varDBConnection = $DBConn->ConnectToMYSQL();
?>
<select id="select_company" name="select_company" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
    <option value="0">-Select Company--</option>
    <?PHP 
    $result = mysqli_query($varDBConnection,"SELECT company_id,company_name FROM supplier_details where status = 'Active'");
    while($row = mysqli_fetch_assoc($result)) {
    ?>
    <option value="<?PHP echo $row['company_id']; ?>"><?PHP echo $row['company_name'] ?></option>
    <?PHP } ?> 
</select>