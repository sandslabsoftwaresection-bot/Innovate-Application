<?php 
include "../../model/db_connection/connection.php";
$DBConn = new DBConnection();
$varDBConnection = $DBConn->ConnectToMYSQL();   
?>
<select id="select_issue_note_no" name="select_issue_note_no[]" class="chosen-select form-control form-control-sm" data-placeholder="-Select Issue Notes--" multiple>
    <?php 
    $result = mysqli_query($varDBConnection, "SELECT gate_pass_id, pass_no FROM gate_pass_tbl WHERE project_id= '".$_REQUEST['project_id']."' and gate_pass_status = 'Generated' ORDER BY gate_pass_id ASC");
    while ($row = mysqli_fetch_assoc($result)) {
    ?>              
        <option value="<?php echo $row['gate_pass_id']; ?>"><?php echo $row['pass_no']; ?></option>
    <?php
    }
    ?> 
</select>

<!--<script src="path_to_chosen/chosen.jquery.min.js"></script>-->
<!--<link rel="stylesheet" href="path_to_chosen/chosen.min.css">-->

<script>
    $(document).ready(function(){
        $('.chosen-select').chosen({
            width: '100%'
        });
    });
</script>
