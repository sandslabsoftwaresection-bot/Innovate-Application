$(document).ready(function(){
    var tbl_store_report_list = $('#tbl_store_report_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
   var history_of_store_item = $('#history_of_store_item').DataTable( {searching: false, paging: false, info: false,"ordering": false});
  
  $('#history_of_store_item').removeClass( 'display' ).addClass('table table-striped table-bordered');
   var today = new Date();
    v_today= formatDate(today);
var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
var firstday=formatDate(firstDayOfMonth);
var month = today.getMonth() + 1; // Adding 1 because January is 0
var year = today.getFullYear();
var dateString = month+"/01/"+year; 
    $('#txt_item_start_date').val(dateString);
    // startOfYear = formatDate(startOfYear);
    //  alert(startOfYear);
   load_store_report(firstday,v_today);
   
    function load_store_report(v_from_date,v_to_date)
	{
		tbl_store_report_list.destroy();     
        tbl_store_report_list = $('#tbl_store_report_list').DataTable( {          
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/store_report/store_report_controller.php',
					 'data': {
						action: 'list_store_item',
						v_from_date:v_from_date,
						v_to_date:v_to_date
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
				"scroller": true,

				"columns": [
					 { "data": "ids", "className": "text-center" },
					 { "data": "inventory_name"},
					 { "data": "unit", "className": "text-center" },
					 { "data": "total_purch_qty", "className": "text-center" },
					 { "data": null,"className": "text-center", 
					     "render": function (data, type, row) {
                            // Calculate the value: total_purch_qty - total_issued_qty + total_passin_return_qty
                            var calculatedValue1 = parseFloat(row.total_issued_qty) - parseFloat(row.tot_damage_qty) - parseFloat(row.total_passin_return_qty);
                            return calculatedValue1.toFixed(2); // Assuming you want to display the result with two decimal places
                        },
					 },
					 { "data": "tot_damage_qty", "className": "text-center" },
					 { "data": "current_stock","className": "text-center",
					    "render": function (data, type, row) {
                        		return '<span class="badge badge-danger" style="font-size: 13px;">'+data+'<span>';
                        },
					     
					 },
				// 	 {   "data": null,
    //                     "render": function (data, type, row) {
    //                         // Calculate the value: total_purch_qty - total_issued_qty + total_passin_return_qty
    //                         var calculatedValue = parseFloat(row.total_purch_qty) - parseFloat(row.total_issued_qty) + parseFloat(row.total_passin_return_qty);
    //                         return calculatedValue.toFixed(2); // Assuming you want to display the result with two decimal places
    //                     },
				// 	 },
					 { "data": "ids", "className": "text-center",  
					 render: function ( data, type, rows, meta ) {
                        						
									order_action = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()"  id="view_store_report" name="view_store_report" ><i class="material-icons ">remove_red_eye</i></button>';
					                return order_action;
                                 },
						  },	 
					 
				 ],
				 pageLength: 25,
				 searching: true,
				responsive: true,
			
				 "initComplete": function( settings, json ) {

				  },
				  "fnDrawCallback": function() {
 
				 },
				 
				  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
					 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
					 return nRow;
				 },
        		"footerCallback": function (row, data, start, end, display) {
                    // Remove the formatting to get integer data for summation
                    // var intVal = function (i) {
                    //     return typeof i === 'string' ?
                    //         i.replace(/[\$,]/g, '') * 1 :
                    //         typeof i === 'number' ?
                    //             i : 0;
                    // };
	 
				// Total over all pages Income
				// total1 = api
				// 	.column( 7 )
				// 	.data()
				// 	.reduce( function (a, b) {
						
				// 		return intVal(a) + intVal(b);
				// 	}, 0 );
			   
				// Update footer
				// $( api.column( 7 ).footer() ).html(
				// 	pageTotal1.toFixed(3)
				// );
			   
			}
        });
        $('.dataTables_filter input').css('text-align', 'left');
        $('.dataTables_filter input').css('width', '200px');
        
        
	}
	$("#btn_item_search_date").click(function()
			  {
			      var txt_start_date=$('#txt_item_start_date').val();
			      txt_start_date=formatDate(txt_start_date);
                  var txt_end_date=$('#txt_item_end_date').val();				 
				    txt_end_date=formatDate(txt_end_date);
				load_store_report(txt_start_date,txt_end_date); 
  
  
			  });
	
	$('#btn_print_with_head').click(function() {
                var txt_start_date=$('#txt_item_start_date').val();
			      txt_start_date=formatDate(txt_start_date);
                  var txt_end_date=$('#txt_item_end_date').val();				 
			 txt_end_date=formatDate(txt_end_date);
                    window.open("reports/pdf/print/store_report_print.php?start=" +txt_start_date+ "&x=0&end=" +txt_end_date, "_blank");
                
            });
            
    $('#btn_print_without_head').click(function() {
                var txt_start_date=$('#txt_item_start_date').val();
			      txt_start_date=formatDate(txt_start_date);
                  var txt_end_date=$('#txt_item_end_date').val();				 
			 txt_end_date=formatDate(txt_end_date);
                    window.open("reports/pdf/print/store_report_print.php?start=" +txt_start_date+ "&x=1&end=" +txt_end_date, "_blank");
                
            });
            
	 $('#tbl_store_report_list').on('click', 'button#view_store_report', function() {
       
        var closestRow = $(this).closest('tr');
        var rowData = tbl_store_report_list.row(closestRow).data();
          
          var inventory_id = rowData.inventory_id;
                    load_data_to_grid_view_history_of_item(firstday,v_today, inventory_id); 
                    $('#item_history_span').html(rowData.inventory_name);
                    $('#hidden_item_id').val(inventory_id);
                    
                     
                 });    
             
function load_data_to_grid_view_history_of_item(v_from_date,v_to_date,inventory_id)
			 {

       history_of_store_item.destroy();
                             history_of_store_item = $('#history_of_store_item').DataTable({
                                    
                                     "ajax": {
                                         'type': 'POST',
                                         'url': '../controller/store_report/store_report_controller.php',
                                         'data': {
                                            action: 'list_history_store_item',
                                            v_inventory_id:inventory_id,
                                            v_from_date:v_from_date,
                                            v_to_date:v_to_date
                                         }
                                     },
                                     "language": {
                                         "zeroRecords": "No records available",
                                         "infoEmpty": "No records available",
                                      },
                                    // "order": [[ 0, "desc" ]],
                    				"bPaginate": false,
                    				"bLengthChange": false,
                    				"bFilter": false,
                    				"bInfo": false,
                    				"autoWidth": false,
                                    "columns": [                                   
									  
                                         { "data": "ids", "className": "text-center" },
                                         { "data": "entry_type", 
                                             "render": function (data, type, row) {
                                                if (data === 'Purchase_recieved' && row.quantity > 0) {
                                                    return '<span class="badge badge-primary" style="font-size: 12px;">Purchase Received<span>';
                                                } else if (data === 'IssueNote' && row.qty_out > 0) {
                                                    return '<span class="badge badge-success" style="font-size: 12px;">Stock Issued<span>';
                                                } else if (data === 'PassIN' && row.quantity > 0) {
                                                    return '<span class="badge badge-warning" style="font-size: 12px;">Return<span>';
                                                } else if (data === 'PassIN' && row.damage_qty > 0) {
                                                    return '<span class="badge badge-danger" style="font-size: 12px;">Damage<span>';
                                                } else {
                                                    return data;
                                                }
                                            },
                                         },
                                         { "data": "formatted_recieved_date", "className": "text-center" },
                                         { "data": "ref_no", "className": "text-center" },
                                         {"data": function(row) {
                                                if (row.quantity > 0) {
                                                    return row.quantity;
                                                } else if (row.qty_out > 0) {
                                                    return row.qty_out;
                                                } else if (row.damage_qty > 0) {
                                                    return row.damage_qty;
                                                } else {
                                                    return '';
                                                }
                                            },
                                            "render": function(data, type, row) {
                                                if (type === 'display' && data !== '') {
                                                    return '<div class="text-center">' + data + '</div>';
                                                }
                                                return data;
                                            }
                                         },
                                         {"data": "company_name"},
                                         {"data": "project_name"},
                                         {"data": "description"}
            					 
                                     ],
                                     pageLength: 25,
                    				 searching: false,
                                     responsive: true,
                    				
                                    
                                    
                                     "initComplete": function( settings, json ) {
                                      
                                                              
                     
                                      },
                                     
                                      "fnRowCallback": function(nRow,aData,iDisplayIndex) {
									
                                       $("td:first",nRow).html(iDisplayIndex+1);
									   return nRow;

									},
                     
                                     })
										 
			}				
            $('#txt_view_start_date').val(dateString);
            
            
			$("#btn_view_search_date").click(function()
			  {
			      
			      
			      var txt_start_date=$('#txt_view_start_date').val();
			      txt_start_date=formatDate(txt_start_date);
                  var txt_end_date=$('#txt_view_end_date').val();				 
				    txt_end_date=formatDate(txt_end_date);
				    var item_id= $('#hidden_item_id').val();
				load_data_to_grid_view_history_of_item(txt_start_date,txt_end_date,item_id); 
  
  
			  });	
	
	$('#btn_print_history_with_head').click(function() {
                var txt_start_date=$('#txt_view_start_date').val();
			      txt_start_date=formatDate(txt_start_date);
                  var txt_end_date=$('#txt_view_end_date').val();				 
			 txt_end_date=formatDate(txt_end_date);
			 var item_id= $('#hidden_item_id').val();
                    window.open("reports/pdf/print/item_history_print.php?start=" +txt_start_date+ "&x=0&end=" +txt_end_date+"&id="+item_id, "_blank");
                
            });
            
            $('#btn_print_history_without_head').click(function() {
                // alert("click");
                var txt_start_date=$('#txt_view_start_date').val();
			      txt_start_date=formatDate(txt_start_date);
                  var txt_end_date=$('#txt_view_end_date').val();				 
			 txt_end_date=formatDate(txt_end_date);
			 var item_id= $('#hidden_item_id').val();
                    window.open("reports/pdf/print/item_history_print.php?start=" +txt_start_date+ "&x=1&end=" +txt_end_date+"&id="+item_id, "_blank");
                
            });
	
       	function formatDate(date) 
	{
		 var d = new Date(date),
			 month = '' + (d.getMonth() + 1),
			 day = '' + d.getDate(),
			 year = d.getFullYear();
	
		 if (month.length < 2) month = '0' + month;
		 if (day.length < 2) day = '0' + day;
	
		 return [year, month, day].join('-');
    }
	     
});