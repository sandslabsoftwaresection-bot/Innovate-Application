$(document).ready(function(){
    var tbl_purchase_recived_report_list = $('#tbl_purchase_recived_report_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
  var prd_history = $('#prd_history').DataTable( {searching: false, paging: false, info: false,"ordering": false});
  
//   $('#history_of_store_item').removeClass( 'display' ).addClass('table table-striped table-bordered');
  
//   $('#div_select_item_name').load('templates/item_load_com.php');
    // $('#show_details').hide();
  $('#div_select_supplier').load('templates/supplier_comp_for_rep.php');
  var action;
  
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
          else if(option_id==2 || option_id==3){
                // $('#show_details').show();
               $('#date_div').show();
          }
          else{
                // $('#show_details').hide();
               $('#date_div').hide();
          }
        //   $('#div_select_supplier').val("");
           
       });  
    $('#tbl_purchase_recived_report_list tbody').on('click', '.view-list-lpo',function () {        
			  
                var tr = $(this).closest('tr');
                var row = tbl_purchase_recived_report_list.row(tr);
				var data = tbl_purchase_recived_report_list.row( tr ).data();
			    company_id = data.company_id; 
			     //alert(company_id);
			     
	//******************* pending child*****************************
	   var option_id=$("#div_option_select option:selected").val();
	   //alert(option_id);
            if(option_id=='1'){
				if (row.child.isShown()) {
                    
                    row.child.hide();
                    
                    tr.removeClass('shown');
                    destroyChild(row);
                } 
				else {
                    row.child.show();
                    //row.child(format(row.data())).show();
                    action = "list_of_lpo_pending";
                    createChild(row,action,false);
                    tr.addClass('shown');
                }
            }    
    // *********************** end *************************************
    //******************* completed child*****************************
            if(option_id=='2'){
				if (row.child.isShown()) {
                    
                    row.child.hide();
                    
                    tr.removeClass('shown');
                    destroyChild(row);
                } 
				else {
                    row.child.show();
                    //row.child(format(row.data())).show();
                    action = "list_of_lpo_completed";
                    createChild(row,action,true,startDate,endDate);
                    tr.addClass('shown');
                }
            } 
         // *********************** end *************************************  
         
          //******************* Cancelled child*****************************
            if(option_id=='3'){
				if (row.child.isShown()) {
                    
                    row.child.hide();
                    
                    tr.removeClass('shown');
                    destroyChild(row);
                } 
				else {
                    row.child.show();
                    //row.child(format(row.data())).show();
                    action = "list_of_lpo_cancelled";
                    createChild(row,action,true,startDate,endDate);
                    tr.addClass('shown');
                }
            } 
         // *********************** end *************************************
         
        });
        
        
	function destroyChild(row) {
            var table = $("table", row.child());
            table.detach();
            table.DataTable().destroy();
         
            // And then hide the row
            row.child.hide();
        }        
    
      
    
   var groupColumn = 1;
    function load_supplier_report(stringSupplier,action, startDate=null,endDate=null)
	{
		tbl_purchase_recived_report_list.destroy();     
        tbl_purchase_recived_report_list = $('#tbl_purchase_recived_report_list').DataTable( {          
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/store_report/purchase_recived_report_controller.php',
					 'data': {
						action: action,
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
					 { "data": null, "className": "text-center" },
					 { "data": "company_name"},
					 { "data": "po_count", "className": "text-center" },
					 { "data": "total_amount", "className": "text-center" },
					 { "data": null ,
						  render: function ( data, type, rows, meta ) 
							{
								action_pur_recie = ' <button type="button" class="btn btn-sm primary-gradient mr-2 view-list-lpo"><i class="material-icons ">remove_red_eye</i></button>';
								return action_pur_recie;
							},
				 },
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
	
	
	function createChild ( row,action,cancel_btn_hide=false, startDate=null,endDate=null ) {
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
                      
					    d.action = action, 
						
                        d.company_id =rowData.company_id,
                        d.startDate=startDate,
						d.endDate=endDate
						
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
                    {title: 'View',data:null,
                    
                        render: function ( data, type, rows, meta ) 
						{
							action_pur_recie = ' <button type="button" class="btn btn-sm primary-gradient mr-2" name="lpo_history_view"><i class="material-icons ">remove_red_eye</i></button>';
							return action_pur_recie;
						},
                        
				    },
                    {title: 'Action',data:null,
                    
                        render: function ( data, type, rows, meta ) 
						{
						    var receivedAmount = rows['recieved_amount'];
						    console.log(cancel_btn_hide+'----'+parseInt(receivedAmount));
						    if(!cancel_btn_hide && parseInt(receivedAmount) ==0){
						  //  if(!cancel_btn_hide){      
						        action_pur_recie = ' <button type="button" class="btn btn-sm danger-gradient mr-2" name="cancel_on_demand"><i class="material-icons ">delete</i></button>';
							    return action_pur_recie;
						    }
						    else{
						        action_pur_recie = '<button type="button" class="btn btn-sm success-gradient mr-2" name="view_history"><i class="material-icons ">remove_red_eye</i></button>';
							    return action_pur_recie;
						    }
							
						},
                        
				    },
                  
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
            
            table.on('click', 'button', function() {
    //             var tr = $(this).closest('tr');
    //             var row = tbl_purchase_recived_report_list.row(tr);
				// var data = tbl_purchase_recived_report_list.row( tr ).data();
				
                    var tr = $(this).closest('tr');
                    var row = history_table.row(tr);
                    var clickedData = history_table.row(tr).data();
                    var  v_lpo_number =clickedData.local_po_number;
                    var buttonName = $(this).attr('name');
                    if(buttonName=='lpo_history_view'){
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
                    }
                    else if(buttonName=='cancel_on_demand'){
                        var $button = $(this);
                        $.post("send_mail_for_otp.php",{action:"sendmail_otp"},function(){
                        // swal("Success","Login credentials send to your email nasrinsandslab01@gmail.com ..", "success");
                        });
                        
                       swal("Enter The OTP", {
                          content: "input",
                          buttons: {
                            cancel: true,
                            confirm: true,
                          },
                        })
                        .then((value) => {
                          if (value === null) {
                               $.post("../controller/store_report/purchase_recived_report_controller.php",{action:'cancel_otp'},function(result,status){
                                    swal("cancelled!");
                            });
                          } else {
                              var v_otp =value;
                              
                                $.post("../controller/store_report/purchase_recived_report_controller.php",{action:'cancel_lpo_on_demand',local_po_number:v_lpo_number,v_otp:v_otp},function(result,status){
                            
                                    if($.trim(result)=="invalied")
                                    {
                                        swal("Error", "Invalied OTP", "error");
                                        // tr.addClass('strikethrough');
                                        // $button.hide();
                                    }
                                    else if($.trim(result)=='1'){
                                         tr.addClass('strikethrough');
                                        $button.hide();
                                        swal("Success", "LPO Cancelled Successfully", "success");
                                    }
                                    
                            });
                            // swal(`You typed: ${value}`);
                          }
                        });
                        
        //                 var $button = $(this);
        //                 swal({                                                       
    				// 	title: "Are you sure?",
    				// 	text: "Do you want to delete the entry?",
    				// 	icon: 'warning',
    				// 	dangerMode: true,
    				// 	allowOutsideClick: false,
    				// 	closeOnClickOutside: false,
    				// 	buttons: {
    				// 	  cancel: 'No Cancel !',
    				// 	  delete: 'Yes Please Delete'
    				// 	}
    				// 	}).then(function (willDelete) {
    				// 	if (willDelete) {
                        
                        
        //                      tr.addClass('strikethrough');
        //                       $button.hide();
        //                     $.post("../controller/store_report/purchase_recived_report_controller.php",{action:'cancel_lpo_on_demand',local_po_number:v_lpo_number},function(result,status){
                            
        //                             if(status=="success")
        //                             {
        //                                 swal("Success", "LPO Cancelled Successfully", "success");
        //                             }
        //                     });
                        
    				// 	} 
        // 			}); 
                        
                        
                    }
                    
                    else if(buttonName=='view_history'){
                        
                        $('#purchase_recieved_history').modal('show');
                        prd_history_report(v_lpo_number)
                        
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
                            {title: 'Cancel',data:null,
                                render: function ( data, type, rows, meta ) 
        						{
        						    var balance = rows['balance'];
        						    var cancel_status = rows['cancel_status'];
        						    var cancel_status_child = rows['cancel_ondemand_ch'];
        						    console.log(cancel_status+'----');
        						    if(parseInt(balance)!=0 && cancel_status!='Deactive' && cancel_status_child!='Deactive'){
        						  //  if(!cancel_btn_hide){      
        						        action_pur_recie = ' <button type="button" class="btn btn-sm danger-gradient mr-2" name="cancel_on_demand_child"><i class="material-icons ">delete</i></button>';
        							    return action_pur_recie;
        						    }
        						    else{
        						        var cancel_ondemand_ch = rows['cancel_ondemand_ch'];
        						        if(cancel_ondemand_ch=='Deactive'){
        						            action_pur_recie = '<span class="badge badge-danger" style="font-size: 13px;">Cancel On Demand</span>';
        						        }
        						        else if(cancel_ondemand_ch=='Active')
        						        {
        						            action_pur_recie = '<span class="badge badge-success" style="font-size: 13px;">Completed</span>';
        						        }
        						        
        							    return action_pur_recie;
        						    }
        							
        						},
                                
        				    },
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
                    
                    
                    table2.on('click', 'button', function() {
                         var tr = $(this).closest('tr');
                        var row = history_table_lpo.row(tr);
                        var clickedData = history_table_lpo.row(tr).data();
                        // console.log(clickedData);
                        var  local_po_child_id =clickedData.local_po_child_id;
                        var  balance =clickedData.balance;
                        var buttonName = $(this).attr('name');
                        if(buttonName=='cancel_on_demand_child'){
                            
                            // *****************************************************************
                            
                             var $button = $(this);
                        $.post("send_mail_for_otp.php",{action:"sendmail_otp"},function(){
                        // swal("Success","Login credentials send to your email nasrinsandslab01@gmail.com ..", "success");
                        });
                        
                       swal("Enter The OTP", {
                          content: "input",
                          buttons: {
                            cancel: true,
                            confirm: true,
                          },
                        })
                        .then((value) => {
                          if (value === null) {
                                $.post("../controller/store_report/purchase_recived_report_controller.php",{action:'cancel_otp'},function(result,status){
                                        swal("cancelled!");
                                });
                          } else {
                              var v_otp =value;
                              
                                $.post("../controller/store_report/purchase_recived_report_controller.php",{action:'cancel_lpo_child_on_demand',local_po_child_id:local_po_child_id,v_balance:balance,v_otp:v_otp},function(result,status){
                                    
                                    if($.trim(result)=="invalied")
                                    {
                                        swal("Error", "Invalied OTP", "error");
                                        // tr.addClass('strikethrough');
                                        // $button.hide();
                                    }
                                    else if($.trim(result)=='1'){
                                         tr.addClass('strikethrough');
                                        $button.hide();
                                        swal("Success", "LPO Cancelled Successfully", "success");
                                    }
                                    
                            });
                            // swal(`You typed: ${value}`);
                          }
                        });
                            
                            
                            // ********************************************************
                            
                            
                            
                //             alert(local_po_child_id);
                //                 var $button = $(this);
                //                 swal({                                                       
            				// 	title: "Are you sure?",
            				// 	text: "Do you want to delete the entry?",
            				// 	icon: 'warning',
            				// 	dangerMode: true,
            				// 	allowOutsideClick: false,
            				// 	closeOnClickOutside: false,
            				// 	buttons: {
            				// 	  cancel: 'No Cancel !',
            				// 	  delete: 'Yes Please Delete'
            				// 	}
            				// 	}).then(function (willDelete) {
            				// 	if (willDelete) {
                                
                                
                //                      tr.addClass('strikethrough');
                //                       $button.hide();
                //                     $.post("../controller/store_report/purchase_recived_report_controller.php",{action:'cancel_lpo_child_on_demand',local_po_child_id:local_po_child_id,v_balance:balance},function(result,status){
                                    
                //                             if(status=="success")
                //                             {
                //                                 swal("Success", "LPO Cancelled Successfully", "success");
                //                             }
                //                     });
                                
            				// 	} 
                // 			}); 
                        
                            
                        }
                        
                    });
                   
        }                 
	      
  
  
	   
// 	***************************** end ***********************************************
	     
	     
 //  ******************************** company search *****************************************
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
                             action = "list_purchase_report";
                            load_supplier_report(selectedSupplierString,action);
                        }    
                         else if(option_id==2){
                            
                         
                            if (selectedSupplier !== null) {
                                // Ensure selectedValues is always treated as an array
                                if (!Array.isArray(selectedSupplier)) {
                                    selectedSupplier = [selectedSupplier];
                                }
                                var selectedSupplierString = selectedSupplier.join(',');
                               
                            } else {
                                swal("Warning", "Select supplier", "warning");
                            } 
                            if(startDate === undefined || startDate === "")
                            {
                                swal("Warning", "Select Date", "warning");
                            }
                            // alert("startDate"+startDate);
                            // console.log("item"+selectedItemString);
                            console.log("supplier"+selectedSupplierString);
                             action = "list_purchase_report_completed";
                            load_supplier_report(selectedSupplierString,action,startDate,endDate);
                        }   
                        
                        else if(option_id==3){
                            
                         
                            if (selectedSupplier !== null) {
                                // Ensure selectedValues is always treated as an array
                                if (!Array.isArray(selectedSupplier)) {
                                    selectedSupplier = [selectedSupplier];
                                }
                                var selectedSupplierString = selectedSupplier.join(',');
                               
                            } else {
                                swal("Warning", "Select supplier", "warning");
                            } 
                            if(startDate === undefined || startDate === "")
                            {
                                swal("Warning", "Select Date", "warning");
                            }
                            // alert("startDate"+startDate);
                            // console.log("item"+selectedItemString);
                            console.log("supplier"+selectedSupplierString);
                             action = "list_purchase_report_cancelled";
                            load_supplier_report(selectedSupplierString,action,startDate,endDate);
                        }
			  });
	
// 	************************************ end ********************************************************



// ****************************** print with head***************************************************

        $("#btn_print_with_head").click(function()
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
                                 window.open("reports/pdf/print/prd_status_report.php?x=0&supplier="+encodeURIComponent(selectedSupplierString),"_blank");

                                
                            }
                            else if(option_id==2){
                            
                         
                            if (selectedSupplier !== null) {
                                // Ensure selectedValues is always treated as an array
                                if (!Array.isArray(selectedSupplier)) {
                                    selectedSupplier = [selectedSupplier];
                                }
                                var selectedSupplierString = selectedSupplier.join(',');
                               
                            } else {
                                swal("Warning", "Select supplier", "warning");
                            } 
                            if(startDate === undefined || startDate === "")
                            {
                                swal("Warning", "Select Date", "warning");
                            }
                            
                            window.open("reports/pdf/print/prd_status_report_completed.php?x=0&endDate="+encodeURIComponent(endDate)+"&startDate="+encodeURIComponent(startDate)+"&supplier="+encodeURIComponent(selectedSupplierString),"_blank");
                        }   
                        
                        else if(option_id==3){
                            
                         
                            if (selectedSupplier !== null) {
                                // Ensure selectedValues is always treated as an array
                                if (!Array.isArray(selectedSupplier)) {
                                    selectedSupplier = [selectedSupplier];
                                }
                                var selectedSupplierString = selectedSupplier.join(',');
                               
                            } else {
                                swal("Warning", "Select supplier", "warning");
                            } 
                            if(startDate === undefined || startDate === "")
                            {
                                swal("Warning", "Select Date", "warning");
                            }
                            // alert("startDate"+startDate);
                            window.open("reports/pdf/print/prd_status_report_cancelled.php?x=0&endDate="+encodeURIComponent(endDate)+"&startDate="+encodeURIComponent(startDate)+"&supplier="+encodeURIComponent(selectedSupplierString),"_blank");
                        }
                            
			  });    
                        //  $.toast({
                        //                 heading: 'Error',
                        //                 text: 'Please select or create work order for print',
                        //                 showHideTransition: 'slide',
                        //                 icon: 'error'
                        //             });
                        // return false;
                    
    //               else
    //                   {
    //                     //   window.open("reports/prd_status_report.php?supplier="+encodeURIComponent(selectedSupplierString)+"pass_no="+pass_no,"_blank"); 
    //                     window.open("reports/prd_status_report.php?supplier="+encodeURIComponent(selectedSupplierString),"_blank");
    //                   }
			 // });	



// ************************************** end *******************************************************

// ******************************************* PRD History ***********************************

var groupColumn = 1;
    function prd_history_report(lpo_number)
	{
		prd_history.destroy();     
        prd_history = $('#prd_history').DataTable( {          
				 "ajax": {
					 'type': 'POST',
					 'url': '../controller/store_report/purchase_recived_report_controller.php',
					 'data': {
						action: 'prd_history_report',
						local_po_number:lpo_number
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
					 { "data": "prd_no", visible:false},
					 { "data": "recieved_date", "className": "text-center" },
					 { "data": "inventory_name", "className": "text-left" },
					 { "data": "quantity", "className": "text-center" },
					 { "data": "unit", "className": "text-center" },
					 { "data": "rate", "className": "text-center" },
					 { "data": "tax", "className": "text-center" },
					 { "data": "amount", "className": "text-right"},
					  
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
                  
			},

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
                                    '<tr class="group" style="background-color:#D6D9EB;"><td colspan="9">' +
                                        group +
                                        '</td></tr>'
                                );
         
                            last = group;
                        }
                    });
            }

        });
	}
				



// ************************************** end ********************************************
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