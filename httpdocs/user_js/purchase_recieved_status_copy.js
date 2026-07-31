$(document).ready(function(){
    var tbl_purchase_recived_report_list = $('#tbl_purchase_recived_report_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
//   var history_of_store_item = $('#history_of_store_item').DataTable( {searching: false, paging: false, info: false,"ordering": false});
  
//   $('#history_of_store_item').removeClass( 'display' ).addClass('table table-striped table-bordered');
  
//   $('#div_select_item_name').load('templates/item_load_com.php');
    // $('#show_details').hide();
  $('#div_select_supplier').load('templates/supplier_comp_for_rep.php');
  
  
  	// **********************************************
				var css = '.chosen-container { width: 100% !important; }';

                // Create a style element
                var style = document.createElement('style');
                style.type = 'text/css';
                
                // Append CSS rule to the style element
                if (style.styleSheet) {
                    style.styleSheet.cssText = css; // IE support
                } else {
                    style.appendChild(document.createTextNode(css)); // Other browsers
                }
                
                // Append the style element to the document head
                document.head.appendChild(style);  
                
				// *************************************************
  
  
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
         
       $("#div_option_select").change(function() {
           var option_id=$("#div_option_select option:selected").val();
           tbl_purchase_recived_report_list.clear().destroy(); 
          tbl_purchase_recived_report_list = $('#tbl_purchase_recived_report_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
           if(option_id==1){
            //   $('#show_details').show();
               $('#date_div').hide();
           }
          else if(option_id==2){
                // $('#show_details').show();
               $('#date_div').show();
          }
          else{
                // $('#show_details').hide();
               $('#date_div').hide();
          }
        //   $('#div_select_supplier').val("");
           
       });  
    $('#tbl_purchase_recived_report_list tbody').on('click', 'tr',function () {
			  
                var tr = $(this).closest('tr');
                var row = tbl_purchase_recived_report_list.row(tr);
				var data = tbl_purchase_recived_report_list.row( tr ).data();
			    company_id = data.company_id; 
			     //alert(company_id);
				if (row.child.isShown()) {
                    
                    row.child.hide();
                    
                    tr.removeClass('shown');
                    destroyChild(row);
                } 
				else {
                    row.child.show();
                    //row.child(format(row.data())).show();
                    createChild(row);
                    tr.addClass('shown');
                }
        });
        
        
	function destroyChild(row) {
            var table = $("table", row.child());
            table.detach();
            table.DataTable().destroy();
         
            // And then hide the row
            row.child.hide();
        }        
    
      
    
   var groupColumn = 1;
    function load_supplier_report(stringSupplier, date=null)
	{
		tbl_purchase_recived_report_list.destroy();     
        tbl_purchase_recived_report_list = $('#tbl_purchase_recived_report_list').DataTable( {          
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/store_report/purchase_recived_report_controller.php',
					 'data': {
						action: 'list_purchase_report',
					    v_stringSupplier:stringSupplier,
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
					 { "data": null, "className": "text-center" },
					 { "data": "company_name"},
					 { "data": "po_count", "className": "text-center" },
					 { "data": "total_amount", "className": "text-center" },
					 
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
                   
		    	}

        });
	}
	
	
	function createChild ( row ) {
            var rowData = row.data();
           
            table = $('<table id="child_table" class="table display table-striped table-bordered dt-responsive"style="background: linear-gradient(to right, #9039A7, #AE5DC3, #9039A7);color: white;width:100%;"/>');
           row.child( table ).show();
            
            history_table = table.DataTable( {
               
                "language": {
                     "zeroRecords": "No records available",
                     "infoEmpty": "No records available",
                 },

				"bPaginate": false,
				"bLengthChange": false,    
				"bFilter":true,
				"bInfo": false,
				//"autoWidth": true,
				"bRetrieve":true,
			    "ordering": false,
				//"scroller":true,
			    
                ajax: {
                    'url': '../controller/store_report/purchase_recived_report_controller.php',
                    'type': 'post',
                    'data':function ( d ) {
                      
					      d.action = 'list_of_lpo_pending', 
						
                         d.company_id =rowData.company_id    
						
                     }
                },
                columns: [
                      {title: 'SI',data:null,
                    	render: function(data, type, row, meta) {
                            if (type === 'display') {
                                // Return the count of rows
                                return meta.row + 1;
                            } else {
                                // For other types, return the data as it is
                                return data;
                            }
                        }
				    },
				    
                    { title: 'LPO Number',data:'local_po_number'},
                    { title: 'Sub Total',data:'sub_total'},
                    { title: 'Recieved Amount',data:'recieved_amount'},
                    
                  
                ],
				            pageLength: 10,
            				 searching: false,
                             responsive: true,
                             
                    "createdRow": function(row, data, dataIndex) {
                        // Apply inline CSS to alternate row background color
                        $(row).css('background-color', dataIndex % 2 === 0 ? '#E9DFEB' : '#D2ABD9');
                        $(row).css('color', '#000000');
                    }
            
            });
            
            table.on('click', 'tr', function() {
                    var tr = $(this).closest('tr');
                    var row = history_table.row(tr);
                    var clickedData = history_table.row(this).data();
                    var  v_lpo_number =clickedData.local_po_number;
                    if (row.child.isShown()) {
                            
                            row.child.hide();
                            tr.removeClass('shown');
                            destroyChild2(row);
                        } 
        				else {
        				    
                            row.child.show();
                            createChild2(row);
                            tr.addClass('shown');
                        }
                    // alert(v_lpo_number);

            });
        }   
        
        function destroyChild2(row) {
            var table = $("table2", row.child());
            table.detach();
            table.DataTable().destroy();
         
            // And then hide the row
            row.child.hide();
        }   
	           
  // ***************************** child 2 ***************************************
            	function createChild2 ( row ) {
                    var rowData = row.data();
                   
                    table2 = $('<table id="child_table_lpo" class="table display table-striped table-bordered dt-responsive"style="background-color:#6F559E;color: white;width:100%;"/>');
                   row.child( table2 ).show();
                    
                    history_table_lpo = table2.DataTable( {
                       
                        "language": {
                             "zeroRecords": "No records available",
                             "infoEmpty": "No records available",
                         },
        
        				"bPaginate": false,
        				"bLengthChange": false,    
        				"bFilter":true,
        				"bInfo": false,
        				//"autoWidth": true,
        				"bRetrieve":true,
        			    "ordering": false,
        				//"scroller":true,
        			    
                        ajax: {
                            'url': '../controller/store_report/purchase_recived_report_controller.php',
                            'type': 'post',
                            'data':function ( d ) {
                              
        					      d.action = 'list_of_lpo_child_table', 
        						
                                 d.local_po_number =rowData.local_po_number    
        						
                             }
                        },    
                        columns: [
                              {title: 'SI',data:null,
                            	render: function(data, type, row, meta) {
                                    if (type === 'display') {
                                        // Return the count of rows
                                        return meta.row + 1;
                                    } else {
                                        // For other types, return the data as it is
                                        return data;
                                    }
                                }
        				    },
        				    
                            { title: 'Item Name',data:'description'},
                            { title: 'Quantity',data:'quantity'},
                            { title: 'Unit',data:'unit'},
                            { title: 'Rate',data:'rate'},
                            { title: 'Amount',data:'amount'},
                            { title: 'Vat',data:'vat_percentage'},
                            { title: 'Net Amount',data:'net_amount'},
                            { title: 'Quantity Purchased',data:'quantity_purchased'},
                            { title: 'Balance Quantity',data:'balance'},
                        ],
        				            pageLength: 10,
                    				 searching: false,
                                     responsive: true,
                                     
                            "createdRow": function(row, data, dataIndex) {
                                // Apply inline CSS to alternate row background color
                                $(row).css('background-color', dataIndex % 2 === 0 ? '#E9E7ED' : '#D2CCDE');
                                $(row).css('color', '#000000');
                            }
                    
                    });
                    
                   
        }                 
	      
  
  
	   
// 	***************************** end ***********************************************
	                                              
	$("#btn_item_search_date").click(function()
			  {
                         var selectedSupplier = $('#div_select_supplier select').val();
                         var option_id=$("#div_option_select option:selected").val();
                        if(option_id==1){
                            
                         
                            if (selectedSupplier !== null) {
                                // Ensure selectedValues is always treated as an array
                                if (!Array.isArray(selectedSupplier)) {
                                    selectedSupplier = [selectedSupplier];
                                }
                                var selectedSupplierString = selectedSupplier.join(',');
                               
                            } else {
                                swal("Warning", "Select supplier", "warning");
                            } 
                            // if(startDate === undefined || startDate === "")
                            // {
                            //     swal("Warning", "Select Date", "warning");
                            // }
                            // console.log("startDate"+startDate);
                            // console.log("item"+selectedItemString);
                            console.log("supplier"+selectedSupplierString);
                            load_supplier_report(selectedSupplierString);
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