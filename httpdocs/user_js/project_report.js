$(document).ready(function(){
    var tbl_project_report_list = $('#tbl_project_report_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
//   var history_of_store_item = $('#history_of_store_item').DataTable( {searching: false, paging: false, info: false,"ordering": false});
  
  $('#history_of_store_item').removeClass( 'display' ).addClass('table table-striped table-bordered');
  
 $('#div_select_company').load('templates/company_combo.php');
 $("#div_select_company").change(function() {
                      
                            var company_id=$('option:selected', this).val() ;
                            
                            $.post("../controller/quotation/quotation_controller.php",{action:'select_company_details',v_company_id:company_id},function(result,status){
                                
                                        if(status=="success")
                                        {
                                            
                                        var obj= jQuery.parseJSON(result);
                                        
                                        $("#div_select_project").load('../controller/quotation/quotation_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                                    
                                       });
                                        
                                        }
                                        else
                                        {
                                            return false;
                                        }
                            });           
                   
                 });
                 
   var today = new Date();

    // Get the starting date of the year
    var startOfYear = new Date(today.getFullYear(), 0, 1);
    v_today= formatDate(today);
   var currentYear = today.getFullYear();
var dateString = "01/01/" + currentYear;
    $('#txt_item_start_date').val(dateString);
    startOfYear = formatDate(startOfYear);
    //  alert(startOfYear);
//   load_store_report(startOfYear,v_today);
 $("#div_select_project").change(function() { 
                         var v_project_id=$('option:selected', this).val() ;
                        load_supplier_report(v_project_id);
                        
                });
               
   
    function load_supplier_report(project_id)
	{
		tbl_project_report_list.destroy();     
        tbl_project_report_list = $('#tbl_project_report_list').DataTable( {          
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/store_report/project_report_controller.php',
					 'data': {
						action: 'list_project_report',
						v_project_id:project_id
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
					 { "data": "ids", "className": "text-center"},
					 { "data": "ref_no", "className": "text-center"},
					 { "data": "recieved_date", "className": "text-center"},
					 { "data": "entry_type",
					 "render": function (data, type, row) {
                            if (data === 'IssueNote') {
                                return '<span class="badge badge-success" style="font-size: 12px;">Issue<span>';
                            }else if (data === 'PassIN' && row.quantity > 0) {
                                return '<span class="badge badge-warning" style="font-size: 12px;">Return<span>';
                            } else if (data === 'PassIN' && row.damage_qty > 0) {
                                return '<span class="badge badge-danger" style="font-size: 12px;">Damage<span>';
                            } else {
                                return data;
                            }
                        },
					 },
					 { "data": "store_category"},
					 { "data": "inventory_name"},
					 { "data": "qty_out", "className": "text-center"},
					 { "data": "quantity", "className": "text-center"},
					 { "data": "damage_qty", "className": "text-center"},
					  { "data": "unit", "className": "text-center"}
				// 	 { "data": null,
				// 	     "render": function (data, type, row) {
    //                         // Calculate the value: total_purch_qty - total_issued_qty + total_passin_return_qty
    //                         var calculatedValue1 = parseFloat(row.total_issued_qty) - parseFloat(row.tot_damage_qty) - parseFloat(row.total_passin_return_qty);
    //                         return calculatedValue1.toFixed(2); // Assuming you want to display the result with two decimal places
    //                     },
				// 	 },
					 
					 
				 ],
				 pageLength: 25,
				 searching: false,
				// responsive: true,
			
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
			   
			},
// 			"drawCallback": function ( settings ) {
// 								var api = this.api();
// 								var rows = api.rows( {page:'current'} ).nodes();
// 								var last=null;
					 
// 								api.column(1, {page:'current'} ).data().each( function ( group, i ) {
// 									if ( last !== group ) {
// 										$(rows).eq( i ).before(
// 											'<tr class="group" style="background-color:#D2B4DE;"><td colspan="9">'+group+'</td></tr>'
// 										);
					 
// 										last = group;
// 									}
// 								} );
				// 			}
        });
	}
	$("#btn_item_search_date").click(function()
			  {
			    
                    var selectedItemValues = $('#div_select_item_name select').val();
                        if (selectedItemValues !== null) {
                            // Ensure selectedValues is always treated as an array
                            if (!Array.isArray(selectedItemValues)) {
                                selectedItemValues = [selectedItemValues];
                            }
                            var selectedItemString = selectedItemValues.join(', ');
                            // view_pass_in_list(selectedString);
                            
                        } else {
                            swal("Warning", "Select Item", "warning");
                        }
                         
                         
                         var selectedSupplier = $('#div_select_supplier select').val();
                        if (selectedSupplier !== null) {
                            // Ensure selectedValues is always treated as an array
                            if (!Array.isArray(selectedSupplier)) {
                                selectedSupplier = [selectedSupplier];
                            }
                            var selectedSupplierString = selectedSupplier.join(', ');
                            // view_pass_in_list(selectedString);
                            
                        } else {
                            swal("Warning", "Select supplier", "warning");
                        } 
                        console.log("item"+selectedItemString);
                        console.log("supplier"+selectedSupplierString);
                        load_supplier_report(selectedItemString,selectedSupplierString);
			  });
	
	
// 	 $('#tbl_store_report_list').on('click', 'button#view_store_report', function() {
       
//         var closestRow = $(this).closest('tr');
//         var rowData = tbl_store_report_list.row(closestRow).data();
          
//           var inventory_id = rowData.inventory_id;
//                     load_data_to_grid_view_history_of_item(startOfYear,v_today, inventory_id); 
//                     $('#item_history_span').html(rowData.inventory_name);
//                     $('#hidden_item_id').val(inventory_id);
                    
                     
//                  });    
             
// function load_data_to_grid_view_history_of_item(v_from_date,v_to_date,inventory_id)
// 			 {

//       history_of_store_item.destroy();
//                              history_of_store_item = $('#history_of_store_item').DataTable({
                                    
//                                      "ajax": {
//                                          'type': 'POST',
//                                          'url': '../controller/store_report/store_report_controller.php',
//                                          'data': {
//                                             action: 'list_history_store_item',
//                                             v_inventory_id:inventory_id,
//                                             v_from_date:v_from_date,
//                                             v_to_date:v_to_date
//                                          }
//                                      },
//                                      "language": {
//                                          "zeroRecords": "No records available",
//                                          "infoEmpty": "No records available",
//                                       },
//                                     "order": [[ 0, "desc" ]],
//                     				"bPaginate": false,
//                     				"bLengthChange": false,
//                     				"bFilter": false,
//                     				"bInfo": false,
//                     				"autoWidth": false,
//                                     "columns": [                                   
									  
//                                          { "data": "ids"},
//                                          { "data": "entry_type",
//                                              "render": function (data, type, row) {
//                                                 if (data === 'Purchase_recieved' && row.quantity > 0) {
//                                                     return 'Purchase Received';
//                                                 } else if (data === 'IssueNote' && row.qty_out > 0) {
//                                                     return 'Stock Issued';
//                                                 } else if (data === 'PassIN' && row.quantity > 0) {
//                                                     return 'Return';
//                                                 } else if (data === 'PassIN' && row.damage_qty > 0) {
//                                                     return 'Damage';
//                                                 } else {
//                                                     return data;
//                                                 }
//                                             },
//                                          },
//                                          { "data": "recieved_date"},
//                                          { "data": "ref_no"},
//                                          {"data": function(row) {
//                                                 if (row.quantity > 0) {
//                                                     return row.quantity;
//                                                 } else if (row.qty_out > 0) {
//                                                     return row.qty_out;
//                                                 } else if (row.damage_qty > 0) {
//                                                     return row.damage_qty;
//                                                 } else {
//                                                     return '';
//                                                 }
//                                             }
                                             
//                                          },
//                                          {"data": "company_name"},
//                                          {"data": "project_name"},
//                                          {"data": "description"}
            					 
//                                      ],
//                                      pageLength: 25,
//                     				 searching: false,
//                                      responsive: true,
                    				
                                    
                                    
//                                      "initComplete": function( settings, json ) {
                                      
                                                              
                     
//                                       },
                                     
//                                       "fnRowCallback": function(nRow,aData,iDisplayIndex) {
									
//                                       $("td:first",nRow).html(iDisplayIndex+1);
// 									   return nRow;

// 									},
                     
//                                      })
										 
// 			}				
//             $('#txt_view_start_date').val(dateString);
            
            
// 			$("#btn_view_search_date").click(function()
// 			  {
			      
			      
// 			      var txt_start_date=$('#txt_view_start_date').val();
// 			      txt_start_date=formatDate(txt_start_date);
//                   var txt_end_date=$('#txt_view_end_date').val();				 
// 				    txt_end_date=formatDate(txt_end_date);
// 				    var item_id= $('#hidden_item_id').val();
// 				load_data_to_grid_view_history_of_item(txt_start_date,txt_end_date,item_id); 
  
  
// 			  });	


        $('#btn_project_report_print_with_head').click(function(){
             var v_project_id=$('#div_select_project option:selected').val();
            //  alert(v_project_id);
             window.open("reports/pdf/print/project_report_print.php?project_id="+v_project_id+"&x=0","_blank"); 
        });
	$('#btn_project_report_print_without_head').click(function(){
             var v_project_id=$('#div_select_project option:selected').val();
            //  alert(v_project_id);
             window.open("reports/pdf/print/project_report_print.php?project_id="+v_project_id+"&x=1","_blank"); 
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