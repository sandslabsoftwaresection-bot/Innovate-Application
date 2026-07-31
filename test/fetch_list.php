<!DOCTYPE html>
<html>
<head>
    <title>DataTable Example</title>
    <!-- Include jQuery and DataTables CSS/JS files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
    
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <style>
        #example td.emp_name {
            white-space: nowrap; /* Prevent text from wrapping */
        }
        .nowrap {
            white-space: nowrap; /* Prevent text from wrapping */
        }
        .right-align {
            text-align: right;
        }
        body
        {
            font-size:14px;    
        }
       
    </style>
</head>
<body>
<p style="font-size: 20px;">Consolidated Salary Report for the Month Of May 2024 </p>
<table id="example" class="display" style="width:100%"></table>

<script type="text/javascript">
$(document).ready(function() {
    $.get("datafetch.php", function(data) {
        if (data && data.length > 0) {
            var table = $('#example').DataTable({
                "paging": false,   // Disable pagination
                "ordering": false, // Disable sorting
                "searching": false, // Disable search
                language: {
                    info: "Total _TOTAL_ Employees Found"
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Consolidated Salary Report for the Month Of May 2024',
                    }
                ],
                data: data,
                columns: Object.keys(data[0]).map(function(key) {
                    
                    
                        if (key === 'emp_name' || key === 'salary_date') {
                            // For emp_name and salary_date columns, do not apply right-align class
                           return { title: key, data: key ,className: key === 'emp_name' ? 'emp_name nowrap' : ''  };
                        } else {
                            // For other columns, apply right-align class
                            return { title: key, data: key, className: 'right-align' };
                        }
                    
                    
                    
                    
                    
                    
                    
                })
                
                
                
            });
        } else {
            console.error("No data received from server or data is empty.");
        }
    }).fail(function(xhr, textStatus, errorThrown) {
        console.error("Failed to fetch data from server:", errorThrown);
    });
});

</script>

</body>
</html>
