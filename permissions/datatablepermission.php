<?php
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // For V1 you have to Pass RoleId from the User Table, 
        //for V2 You have to pass User ID from User Table to this Session
       
        $_SESSION['USERROLLID'] =  isset($_GET['userid']) ? $_GET['userid'] : null;
        include_once('permission_class/class_permission.php');
        
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- DataTables JavaScript -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<table id="tlb_listOfRolls" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                           
                            <th>List of Rolls/Groups</th>
                            <th>Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

<script>
    //console.log(permissions);
    //var permissions = ["Add","Active","Delete","Deactive","Uploads","Print"];
    
    var listOfRolls = $('#tlb_listOfRolls').DataTable({
                "paging": false,
                "info": false,
                "language": { search: '', searchPlaceholder: "Search..." },
                "ajax": {
                    'type': 'POST',
                    'url': 'permission_class/class_permission.php',
                    'data': {
                        action: 'listOfRolls'
                    }
                },
                "columns": [
                   
                    { "data": "id","visible": false},
                    { "data": "name"},
                    { "data": "id",
                        
                        render: function (data, type, rows, meta) {
                                // Define the dropdown options based on permissions
                                var dropdownOptions = {
                                    "Add": "Add New",
                                    "Active": "Active",
                                    "Deactive": "Deactive",
                                    "List": "View",
                                    "Edit": "Edit"
                                };
                        
                                // Filter dropdown options based on permissions
                                var filteredOptions = Object.keys(dropdownOptions).filter(function(option) {
                                    return permissions.includes(option);
                                });
                        
                                // Generate the dropdown menu HTML
                                var dropdownHTML = '<div class="dropdown"> <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button><ul class="dropdown-menu">';
                        
                                // Append options to dropdown menu
                                filteredOptions.forEach(function(option) {
                                    //dropdownHTML += '<a href="#" class="dropdown-item" name="' + option + '" style="color:orange"><i class="icon-database-edit2"></i> ' + dropdownOptions[option] + '</a>';
                                    dropdownHTML += '<li><a class="dropdown-item" href="#">'+dropdownOptions[option]+'</a></li>';
                                });
                        
                                dropdownHTML += '</ul></div>';
                        
                                return dropdownHTML;
                            }
                        
                    },
                   
                ]
                
        }); 
</script>