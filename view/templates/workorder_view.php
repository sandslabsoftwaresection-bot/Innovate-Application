<?php
include("session_check.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$value= $_GET['val'];
?>
<head>
      <!-- daterange CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap-daterangepicker-master/daterangepicker.css">

    <!-- footable CSS -->
    <link rel="stylesheet" href="../vendor/footable-bootstrap/css/footable.bootstrap.min.css">

 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css">
        <link id="theme" rel="stylesheet" href="../css/purplesidebar.css" type="text/css">
   
</head>
<div class="container mt-1 main-container" style="padding-top: 35px; ">
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-1 col-lg-1" style="font-weight: bold;">
                                                        <label>Job No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_work_order_no"> 
                                                </div>
                                            </div>
                                        </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">

                        <div class="card-body " style="padding-top:15px;font-size:12px;overflow:auto;">
                            
                              
                            
                            <table id="tbl_work_order_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                        <th width="5px">SI</th>
                                        <th width="5px">QNo</th>
										
                                        <th width="20px">Description</th>
                                        <th width="5px">Order Qty</th>
                                        <th width="5px">Required</th>
                                        <th width="5px">Supplied</th>
                                        <th width="5px">Balance</th>
                                        <th width="5px">Unit</th>
                                        <th width="10px">Date</th>
                                        <th width="10px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                  
				  
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
										<th></th>
                                       
                                    </tr>
                                </tfoot>
                               
                            </table>
                          
                        </div>
                        <input type="hidden" class="form-control form-control-sm" id="txt_workorder_id" value="<?PHP echo $value; ?>">
                        
                    </div>
                </div>
            </div>
        </div>
   <script src="../js/jquery-3.2.1.min.js"></script>     
 <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
     <script src="../vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script>  
<script>
$(document).ready(function() {
    
     var tbl_work_order_list = $('#tbl_work_order_list').DataTable( {searching: false, paging: false, info: false,"ordering": false});  
     var job_id =$.trim($("#txt_workorder_id").val());
      $("#txt_work_order_no").val(job_id);
     load_work_order_data(job_id);
     function load_work_order_data(quotation_no)
                    {
                             tbl_work_order_list.destroy();
                                 
                             tbl_work_order_list = $('#tbl_work_order_list').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../../controller/working_order/working_order_controller.php',
                                         'data': {
                                            action: 'list_work_order',
                                            v_quotation_no:quotation_no
                                            
                                         }
                                     },
                                     "language": {
                                         "zeroRecords": "No records available",
                                         "infoEmpty": "No records available",
                                      },
                                    "order": [[ 0, "desc" ]],
                    				"bPaginate": false,
                    				"bLengthChange": false,
                    				"bFilter": false,
                    				"bInfo": false,
                    				"autoWidth": false,
                                    "columns": [
                                      
									  
                                         { "data": "work_order_child_id",className: "text-center"},
                                         { "data": "quotation_no"},
                                         
                                         //{ "data": "description"},
										 
										 {
											"data": null,
											"render": function(data, type, row) {
												return '<strong>' + row.product_name + '</strong><br>' + row.description;
											}
										},
										 
										 
                                         { "data": "quantity",className: "text-center"},
                                         { "data": "required_quantity",className: "text-center"},
                                         { "data": "received_quantity",className: "text-center"},
                                         { "data": "balance_quantity",className: "text-center"},
                                         {"data": "unit",className: "text-center"},
                                         {"data": "work_order_date",className: "text-center"},
                                         {"data": "quotation_status",className: "text-center"},

                                     ],
                                     pageLength: 25,
                    				 searching: false,
                                     responsive: true,
                    				
                                    
                                    
                                     "initComplete": function( settings, json ) {
                                      
                                                              
                     
                                      },
                                     /*  "fnDrawCallback": function() {
									  }, */
                                      "fnRowCallback": function(nRow,aData,iDisplayIndex) {
									
                                       $("td:first",nRow).html(iDisplayIndex+1);
									   return nRow;

									},
                     
                                     })
										 
                                 
                             }
                
                 
                
                
});
</script>