$(document).ready(function(){
    var tbl_supplier_report_list = $('#tbl_supplier_report_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
//   var history_of_store_item = $('#history_of_store_item').DataTable( {searching: false, paging: false, info: false,"ordering": false});
  
  $('#history_of_store_item').removeClass( 'display' ).addClass('table table-striped table-bordered');
  
  $('#div_select_item_name').load('templates/item_load_com.php');
  $('#div_select_supplier').load('templates/supplier_comp_for_rep.php');
   var today = new Date();

    // Get the starting date of the year
    var startOfYear = new Date(today.getFullYear(), 0, 1);
    v_today= formatDate(today);
    var currentYear = today.getFullYear();
    var dateString = "01/01/" + currentYear;
    $('#txt_item_start_date').val(dateString);
    startOfYear = formatDate(startOfYear);
    
    
            var startDate=v_today;
             var endDate=v_today;
             
            //  var daterangepickerInstance = $('input[name="daterange"]').daterangepicker();

            // // Get the start and end dates
            // startDate = daterangepickerInstance.data('daterangepicker').startDate.format('YYYY-MM-DD');
            // endDate = daterangepickerInstance.data('daterangepicker').endDate.format('YYYY-MM-DD');
        
            console.log("Start Date: " + startDate);
            console.log("End Date: " + endDate);  
           

              
            $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
                startDate = picker.startDate.format('YYYY-MM-DD');
                endDate = picker.endDate.format('YYYY-MM-DD');
                // Now you have the start and end date selected by the user
                console.log("Start Date: " + startDate);
                console.log("End Date: " + endDate);
            });
         
            
    
      
    
   var groupColumn = 1;
    function load_supplier_report(stringItem,stringSupplier,startDate,endDate)
	{
		tbl_supplier_report_list.destroy();     
        tbl_supplier_report_list = $('#tbl_supplier_report_list').DataTable( {          
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/store_report/supplier_report_controller.php',
					 'data': {
						action: 'list_supplier_report',
						v_stringItem:stringItem,
						v_stringSupplier:stringSupplier,
						startDate:startDate,
						endDate:endDate
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
					 { "data": "inventory_name", visible:false},
					 { "data": "formatted_recieved_date", "className": "text-center" },
					 { "data": "ref_no", "className": "text-center" },
					 { "data": "supplier_name", "className": "text-left" },
					 { "data": "quantity", "className": "text-center" },
					 { "data": "rate", "className": "text-center" },
					 { "data": "item_amount", "className": "text-right", 
					 "render": function(data, type, row) {
                  
                            return parseFloat(data).toFixed(3);
					   //  "render": function (data, type, row) {
        //                     // Calculate the value: total_purch_qty - total_issued_qty + total_passin_return_qty
        //                     var calculatedValue1 = parseFloat(row.quantity) * parseFloat(row.rate);
        //                     return calculatedValue1.toFixed(2); // Assuming you want to display the result with two decimal places
                        },
					 },
					 { "data": "item_tax", "className": "text-right", 
					 
					        "render": function(data, type, row) {
                            return parseFloat(data).toFixed(3);
					   //   "render": function (data, type, row) {
        //                     // Calculate the value: total_purch_qty - total_issued_qty + total_passin_return_qty
        //                     var calculatedValue1 = (parseFloat(row.quantity) * parseFloat(row.rate))* parseFloat(row.tax)/100;
        //                     return calculatedValue1.toFixed(2); // Assuming you want to display the result with two decimal places
                        },
					 },
					  { "data": "amount", "className": "text-right" },
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
// 											'<tr class="group" style="background-color:#D2B4DE;"><td colspan="9">'+$.trim(group)+'</td></tr>'
// 										);
					 
// 										last = group;
// 									}
// 								} );
// 							}

          columnDefs: [{ visible: false, targets: groupColumn }],
            order: [[groupColumn, 'asc']],
            displayLength: 25,
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({ page: 'current' }).nodes();
                var last = null;
         
                api.column(groupColumn, { page: 'current' })
                    .data()
                    .each(function (group, i) {
                        if (last !== group) {
                            $(rows)
                                .eq(i)
                                .before(
                                    '<tr class="group" style="background-color:#D2B4DE;"><td colspan="9">' +
                                        group +
                                        '</td></tr>'
                                );
         
                            last = group;
                        }
                    });
            }

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
                            var selectedItemString = selectedItemValues.join(',');
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
                            var selectedSupplierString = selectedSupplier.join(',');
                            // view_pass_in_list(selectedString);
                            
                        } else {
                            swal("Warning", "Select supplier", "warning");
                        } 
                        if(startDate === undefined || startDate === "")
                        {
                            swal("Warning", "Select Date", "warning");
                        }
                        console.log("startDate"+startDate);
                        console.log("item"+selectedItemString);
                        console.log("supplier"+selectedSupplierString);
                        load_supplier_report(selectedItemString,selectedSupplierString,startDate,endDate);
			  });
	
	
	       //  $('#btn_print_with_head').click(function(){
             
        //          var selectedItemValues = $('#div_select_item_name select').val();
        //                 if (selectedItemValues !== null) {
        //                     // Ensure selectedValues is always treated as an array
        //                     if (!Array.isArray(selectedItemValues)) {
        //                         selectedItemValues = [selectedItemValues];
        //                     }
        //                     var selectedItemString = selectedItemValues.join(',');
        //                     // view_pass_in_list(selectedString);
                            
        //                 } else {
        //                     swal("Warning", "Select Item", "warning");
        //                 }
                         
                         
        //                  var selectedSupplier = $('#div_select_supplier select').val();
        //                 if (selectedSupplier !== null) {
        //                     // Ensure selectedValues is always treated as an array
        //                     if (!Array.isArray(selectedSupplier)) {
        //                         selectedSupplier = [selectedSupplier];
        //                     }
        //                     var selectedSupplierString = selectedSupplier.join(',');
        //                     // view_pass_in_list(selectedString);
                            
        //                 } else {
        //                     swal("Warning", "Select supplier", "warning");
        //                 } 
                       
        //      window.open("reports/pdf/print/supplier_report_print.php?item_id="+encodeURIComponent(selectedItemString)+"&x=0&supplier_id="+encodeURIComponent(selectedSupplierString),"_blank"); 
        // });
         $('#btn_print_with_head').click(function() {
                var selectedItemValues = $('#div_select_item_name select').val();
                var selectedSupplierValues = $('#div_select_supplier select').val();
            
                if (selectedItemValues !== null && selectedSupplierValues !== null) {
                    var selectedItemString = selectedItemValues.join(',');
                    var selectedSupplierString = selectedSupplierValues.join(',');
                    
                    window.open("reports/pdf/print/supplier_report_print.php?item_id=" + encodeURIComponent(selectedItemString) + "&x=0&supplier_id=" + encodeURIComponent(selectedSupplierString) +"&startDate="+startDate+"&endDate="+endDate,"_blank");
                } else {
                    swal("Warning", "Select item and supplier", "warning");
                }
            });


        $('#btn_print_without_head').click(function() {
                var selectedItemValues = $('#div_select_item_name select').val();
                var selectedSupplierValues = $('#div_select_supplier select').val();
            
                if (selectedItemValues !== null && selectedSupplierValues !== null) {
                    var selectedItemString = selectedItemValues.join(',');
                    var selectedSupplierString = selectedSupplierValues.join(',');
                    
                    window.open("reports/pdf/print/supplier_report_print.php?item_id=" + encodeURIComponent(selectedItemString) + "&x=1&supplier_id=" + encodeURIComponent(selectedSupplierString), "_blank");
                } else {
                    swal("Warning", "Select item and supplier", "warning");
                }
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