$(document).ready(function(){
   
                var v_btn_subject_add = $( '#btn_subject_add' ).ladda();
                var v_btn_subject_edit = $( '#btn_subject_edit' ).ladda();
                
                //var company_list_table = $('#list_of_companies').DataTable({});
                
                var list_of_subject_table = $('#list_of_subject').DataTable({searching: true, paging: true, info: false,"ordering": false});
                
                //var invoice_view_list_table = $('#list_of_invoices').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 $('#list_of_subject').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 //$('#list_of_invoices').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#list_of_subject').addClass('pagination-sm');
                  $('#list_of_subject tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { list_of_subject_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                //  $('#list_of_invoices tbody').on( 'click', 'tr', function () {
                //     if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { invoice_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                //  }); 
                 
                 $( '#btn_subject_edit' ).hide();
                
               function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
         
   
                
                
           
    
                v_btn_subject_add.click(function(){
                    
                    v_btn_subject_add.ladda( 'start' );
                    
                    var v_subject=$("#txt_subject").val();
                    var v_subject_text=$("#txt_subject_text").val();
                  
            
                    if($.trim(v_subject)==""||$.trim(v_subject_text)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_subject_add.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/subject/subject_controller.php",{action:'add_subject',v_subject:v_subject,v_subject_text:v_subject_text }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_subject_add.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   

                                
                                }
                                else 
                                {
                                     v_btn_subject_add.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'New subject added successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                   
                                    //  $("#txt_account_head").prop("readonly",true);
                                     
                                     
                                    
                                    
                                    
                                    
                                     clear_text();
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
            
                
               
                      
                 function clear_text()
                 {
                     
                    
                    
                    $("#txt_subject").val('');
                   $("#txt_subject_text").val('');
                    
                   
                 }
            
          
       
           
            
            
                function load_data_to_grid_subject_list()
                 {
                    // company_list_table.destroy();
                         
                     list_of_subject_table = $('#list_of_subject').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/subject/subject_controller.php',
                                 'data': {
                                    action: 'list_subject'
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            				"bPaginate": true,
            				"bLengthChange": false,
            				"bFilter": false,
            				"bInfo": false,
            				"autoWidth": false,
                            "columns": [
                                //   {
                                //     "className":  'details-control',
                                //     "orderable":  false,
                                //     "data":        null,
                                //     "defaultContent": ''
                                //  },
                                 { "data": null},
                                 { "data": "subject_id","visible":false },
                                 { "data": "subject" },
                                 { "data": "subject_text" },
                                 
                                 { "data": "subject_id",
                                 
                                     render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_subject" name="edit_subject" ><i class="material-icons ">remove_red_eye</i></button>';
            								
            								return str_active_status_view;
            
            							 },
                                     
                                 },
                                 
                                 { "data": "subject_id",
                                 
                                     render: function ( data, type, rows, meta ) {
            						
            									str_active_status_delete = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_subject" name="delete_subject" ><i class="material-icons ">delete</i></button>';
            								
            								return str_active_status_delete;
            
            							 },
                                     
                                 },
             
                             ],
                             pageLength: 25,
            				 searching: true,
                             responsive: true,
                             destroy: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                                    
                               
             
                              },
                              "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                     $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                     return nRow;
                  },
                  "drawCallback": function (settings) {
                       $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                  }
                            
                     });  
                    
                
                 }
                 
            
              
                 
                
                 $('#btn_create_new_subject').click(function(){
                  location.reload(true); 
                 
                 });
                 
               
                  
                 
                                 
                 $('#list_of_subject tbody').on('click', 'td button', function(){
                        var $row = $(this).closest('tr');
                        var data = list_of_subject_table.row($row).data();
                        v_subject_id  = data.subject_id;
                        $("#txt_subject").val('');
                       // $("#txt_contact_person").val('');
                      
                    
                        $( '#btn_subject_add' ).hide();
                        $( '#btn_subject_edit' ).show();
                        
                         if($(this).attr("name")=='edit_subject')
                         {
                             edit_data(v_subject_id);
                             closeNavR();
                         }
                         
                         
                          if($(this).attr("name")=='delete_subject')
                         {
                             swal({
                                                                    
                                        							title: "Are you sure?",
                                        							text: "Do you want to delete the entry?",
                                        							icon: 'warning',
                                        							dangerMode: true,
                                        							allowOutsideClick: false,
                                                                    closeOnClickOutside: false,
                                        							buttons: {
                                        							  cancel: 'No Cancel !',
                                        							  delete: 'Yes Please Delete'
                                        							}
                                        							}).then(function (willDelete) {
                                        							if (willDelete) {
                                        						
                                        						       delete_subject(v_subject_id);
                                                     						 
                                        							} else {
                                        							    
                                        							   
                                        							 
                                        							}
                                        						 });
                         }
                        
                        
                       
                    //   swal("Confirm","Do you want to Edit or Delete?", {
                    //                   buttons: {
                    //                     cancel: "Cancel",
                    //                     catch: {
                    //                       text: "Edit",
                    //                       value: "catch",
                    //                     },
                    //                     defeat: {
                    //                       text: "Delete",
                    //                       value: "delete",
                    //                     },
                    //                   },
                    //                   icon:"warning",
                    //                 })
                    //                 .then((value) => {
                    //                   switch (value) {
                                     
                    //                     case "delete":
                    //                                              swal({
                                                                    
                    //                     							title: "Are you sure?",
                    //                     							text: "Do you want to delete the entry?",
                    //                     							icon: 'warning',
                    //                     							dangerMode: true,
                    //                     							allowOutsideClick: false,
                    //                                                 closeOnClickOutside: false,
                    //                     							buttons: {
                    //                     							  cancel: 'No Cancel !',
                    //                     							  delete: 'Yes Please Delete'
                    //                     							}
                    //                     							}).then(function (willDelete) {
                    //                     							if (willDelete) {
                                        						
                    //                     						       delete_subject(v_subject_id);
                                                     						 
                    //                     							} else {
                                        							    
                                        							   
                                        							 
                    //                     							}
                    //                     						 });
                    //                       break;
                                     
                    //                       case "catch":
                                          
                    //                       //swal("Edit!", "Please Edit your data", "success");
                    //                       edit_data(v_subject_id);
                    //                       closeNavR();
                                          
                    //                       break;
                                     
                    //                     default:
                                         
                    //                   }
                            
                    //   });    
                        
                        
                     function  edit_data(v_subject_id) 
                       {
                        //alert(data.account_name);
                        // $("#txt_account_name").prop("readonly",false);
                        $("#txt_subject_id").val(v_subject_id);   
                        $("#txt_subject").val(data.subject);
                       $("#txt_subject_text").val(data.subject_text);
                        $('#btn_subject_edit' ).show();
                         
                        
                        closeNavR();
                       }  
                        
                 });
                 
                function delete_subject(v_subject_id)
                    {
                        
                        $.post("../controller/subject/subject_controller.php",{action:'cancel_subject',v_subject_id:v_subject_id}
                                                , function(result,status)
                                                {
                                            //         swal("System is deactivated the subject", {
                                    								// title: 'Warning',
                                    								// icon: "warning",
                                    							 // });
                                                    
                         });
                         
                         load_data_to_grid_subject_list();
                       
                    }
                 
             
                  
                 
                  v_btn_subject_edit.click(function(){
                      
                 
                    v_btn_subject_edit.ladda( 'start' );
                    var v_subject_id=$("#txt_subject_id").val();
                    var v_subject=$("#txt_subject").val();
                     var v_subject_text=$("#txt_subject_text").val();
                    if($.trim(v_subject)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_subject_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/subject/subject_controller.php",{action:'edit_subject',v_subject_id:v_subject_id,v_subject:v_subject,v_subject_text:v_subject_text }
                                , function(result,status)
                               
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_subject_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_btn_subject_edit.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Subject details edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $("#txt_subject_text").val('');
                                     $("#txt_subject").val('');
                                     $( '#btn_subject_add' ).show();
                                     $( '#btn_subject_edit' ).hide();
                                     //$("#txt_invoice_no").val(result);
                                    
                                     
                                    load_data_to_grid_subject_list();
                                     clear_text();
                                    
                                }
                            
                        }); 
                     }
            
                   
                });
                
              
                  
                 
               
                
                  
                 $('#btn_view_list_of_subject').click(function(){
                     
                    load_data_to_grid_subject_list(); 
                     
                 });     
                 
                 
                 
                 $('#btn_subject_cancel').click(function(){
                     
                    clear_text();
                     
                 }); 
                  

});