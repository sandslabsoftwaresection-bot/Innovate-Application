$(document).ready(function(){
   
                var v_btn_add_project = $( '#btn_add_project' ).ladda();
                var v_btn_edit_project = $( '#btn_edit_project' ).ladda();
                
                //var company_list_table = $('#list_of_companies').DataTable({});
                
                var project_list_table = $('#list_of_projects').DataTable({searching: true, paging: true, info: false,"ordering": false});
                var project_with_number_list_table = $('#list_of_projects_with_number').DataTable({searching: true, paging: true, info: false,"ordering": false});
                
                //var invoice_view_list_table = $('#list_of_invoices').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 $('#list_of_projects').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 //$('#list_of_invoices').removeClass( 'display' ).addClass('table table-striped table-bordered');
                  $('#list_of_projects tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { project_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                //  $('#list_of_invoices tbody').on( 'click', 'tr', function () {
                //     if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { invoice_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                //  }); list_of_projects_with_number
                 
                 $( '#btn_edit_project' ).hide();
                 
                 
               
                 $('#list_of_projects tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = project_list_table.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );	
                
             
       
                
                
               function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
                
                $('#div_company_select,#div_company_select_project,#div_company_select_project_number').load('templates/company_combo.php');
         
                //     load_company_select_box('div_company_select','select_company');
                 
                 
                //   function load_company_select_box(div_name,ctrl_name)
                //         { 
      
                //   $("#"+div_name).load('../controller/project/project_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});
        
                //         }
                        
                       
                        
                        
                         
                       
                        
                  $("#div_company_select").change(function() {
                      
                    $('#txt_quotation_company_name').val($('option:selected', this).text()) ;
                    var company_id=$('option:selected', this).val() ;
                    
                     $.post("../controller/project/project_controller.php",{action:'display_company_details',v_company_id:company_id}, function(result,status)
                                {
                                            
                                if(status=="success")
                                {
                                    
                                var obj= jQuery.parseJSON(result);
                                
                                $("#txt_phone_number").val(obj.data[0].contact_phone);
                                $("#txt_contact_person").val(obj.data[0].contact_person);
                                $("#txt_address").val(obj.data[0].contact_address_1);
                                $("#txt_fax_number").val(obj.data[0].fax);  
                                
                                }
                                else
                                {
                                    return false;
                                }
                                                    
                         });
                    
                   
                 });
                
                
                  $("#div_company_select_project").change(function() {
                      
                  
                    var company_id_project=$('option:selected', this).val() ;
                    
                     load_data_to_grid_project_list_companywise(company_id_project)
                    
                   
                 });
                 
                 $("#div_company_select_project_number").change(function() {
                      
                  
                    var company_id_project_generated=$('option:selected', this).val() ;
                    
                     load_data_to_grid_project_with_number_list_companywise(company_id_project_generated)
                    
                   
                 });
                 
                 
                 
                 function load_data_to_grid_project_list_companywise(company_id_project)
                     {
                        // company_list_table.destroy();
                             
                         project_list_table = $('#list_of_projects').DataTable( {
                                
                                 "ajax": {
                                     'type': 'POST',
                                     'url': '../controller/project/project_controller.php',
                                     'data': {
                                        action: 'list_project_companywise',
                                        v_company_id:company_id_project
                                     }
                                 },
                                 "language": {
                                     "zeroRecords": "No records available",
                                     "infoEmpty": "No records available",
                                  },
                                // "order": [[ 4, "desc" ]],
                				"bPaginate": true,
                				"bLengthChange": false,
                				"bFilter": false,
                				"bInfo": false,
                				"autoWidth": false,
                                "columns": [
                                    
                                     { "data": null,"width":'20px'},
                                     { "data": "project_main_id","visible":false },
                                     { "data": "project_main_name" },
                                     { "data": "tax_content" },
                                     { "data": "company_name","visible":false},
                                     { "data": "company_id","visible":false},
                                     { "data": "default_date"},
                                     { "data": "project_main_id",
                                     
                                         render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_project" name="edit_project" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                                         
                                     },
                                     
                                     { "data": "project_main_id",
                                     
                                         render: function ( data, type, rows, meta ) {
                						
                									str_active_status_delete = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_project" name="delete_project" ><i class="material-icons ">delete</i></button>';
                								
                								return str_active_status_delete;
                
                							 },
                                         
                                     },
                                     
                                     { "data": "project_main_id",
                                     
                                         render: function ( data, type, rows, meta ) {
                                                if(rows['project_number']=='' || rows['project_number']== null)
                                                {
                						
                									str_active_status_delete = ' <button type="button" class="btn btn-sm btn-info mr-1"  id="generate_project_number" name="generate_project_number" ><i class="material-icons ">check_circle</i></button>';
                                                }
                                                else
                                                {
                                                   return  rows['project_number'];
                                                }
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
                                //   "order": [
                                //       [3, 'asc']
                                //     ],
                                  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                     $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                                     return nRow;
                                  },
                                    "displayLength": 25,
                                    
                                    "aoColumnDefs": [
                					{ "bSortable": false, "aTargets": [  0,1,2,3,4,5] }, 
                					
                				],
                                    
                                 
                              "drawCallback": function (settings) {
                                           
                                            var api = this.api();
                                        
                                          var rows = api.rows({
                                            page: 'current'
                                          }).nodes(); 
                                          var last = null;
                                
                                          api.column(4, {
                                            page: 'current'
                                          }).data().each(function (group, i) {
                                            if (last !== group) {
                                              $(rows).eq(i).before(
                                               
                                                '<tr class="group" style="background-color:#4da6ff;font-size: 12px;color:white;font-weight: bold; "><td colspan="11"> Company : ' + group + '</td></tr>'
                                              );
                                              
                                                last = group;
                                          }
                                              
                                            
                                      });
                                 
                                     
                                  $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                                    
                               
                               
                               
                                }              
                         
                                
                         });  
                    
                     }
                        
                  
                  
                    function load_data_to_grid_project_with_number_list_companywise(company_id_project_generated)
                 {
                    // company_list_table.destroy();
                         
                     project_with_number_list_table = $('#list_of_projects_with_number').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/project/project_controller.php',
                                 'data': {
                                    action: 'list_project_with_number_companywise',
                                    v_company_id:company_id_project_generated
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            // "order": [[ 4, "desc" ]],
            				"bPaginate": true,
            				"bLengthChange": false,
            				"bFilter": false,
            				"bInfo": false,
            				"autoWidth": false,
                            "columns": [
                                
                                 { "data": null,"width":'20px'},
                                 { "data": "project_main_id","visible":false },
                                 { "data": "project_main_name" },
                                 { "data": "tax_content" },
                                 { "data": "company_name","visible":false},
                                 { "data": "company_id","visible":false},
                                 { "data": "default_date"},
                                 { "data": "project_main_id",
                                 
                                     render: function ( data, type, rows, meta ) {
                                         
                                          if (rows['project_status'] === 'DeActivate') {
                                              
                                            return ""; // hide button
                                        }
            						
            								str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_project" name="edit_project" ><i class="material-icons ">remove_red_eye</i></button>';
            								
            								return str_active_status_view;
            
            							 },
                                     
                                 },
                                 
                                 { "data": "project_main_id",
                                 
                                     render: function ( data, type, rows, meta ) {
                                         
                                          if (rows['project_status'] === 'DeActivate') {
                                                return ""; // hide button
                                            }
            						
            								str_active_status_delete = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_project" name="delete_project" ><i class="material-icons ">delete</i></button>';
            								
            								return str_active_status_delete;
            
            							 },
                                     
                                 },
                                 
                                 { "data": "project_main_id",
                                 
                                     render: function ( data, type, rows, meta ) {
                                            if(rows['project_number']=='')
                                            {
            						
            									str_active_status_delete = ' <button type="button" class="btn btn-sm btn-info mr-1"  id="generate_project_number" name="generate_project_number" ><i class="material-icons ">check_circle</i></button>';
                                            }
                                            else
                                            {
                                                if (rows['project_status'] === 'DeActivate') {
                                                       // Show project number with strike-through
                                                        return '<span style="text-decoration: line-through; color: #888;">' + rows['project_number'] + '</span>';

                                                 }
                                               return  rows['project_number'];
                                            }
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
                            //   "order": [
                            //       [3, 'asc']
                            //     ],
                              "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                                 return nRow;
                              },
                                "displayLength": 25,
                                
                                "aoColumnDefs": [
            					{ "bSortable": false, "aTargets": [  0,1,2,3,4,5] }, 
            					
            				],
                                
                             
                          "drawCallback": function (settings) {
                                       
                                        var api = this.api();
                                    
                                      var rows = api.rows({
                                        page: 'current'
                                      }).nodes(); 
                                      var last = null;
                            
                                      api.column(4, {
                                        page: 'current'
                                      }).data().each(function (group, i) {
                                        if (last !== group) {
                                          $(rows).eq(i).before(
                                           
                                            '<tr class="group" style="background-color:#4da6ff;font-size: 12px;color:white;font-weight: bold; "><td colspan="11"> Company : ' + group + '</td></tr>'
                                          );
                                          
                                            last = group;
                                      }
                                          
                                        
                                  });
                             
                                 
                              $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                                
                           
                           
                           
                            }              
                     
                            
                     });  
                
                 }
                 
                
                 $('#txt_tax_content').on("keypress", function (e) {
               
                    if (e.which != 8 && e.which != 0 && ((e.which < 48 || e.which > 57) && e.which != 46)) {
                        e.preventDefault();
                    }
               });
    
                v_btn_add_project.click(function(){
                    
                    v_btn_add_project.ladda( 'start' );
                    
                    var v_company_id=$("#div_company_select option:selected").val();
                    var v_company_name=$("#div_company_select option:selected").text();
                   
                    var v_project_name=$("#project_name").val();
                    var v_tax_content= $("#txt_tax_content").val();    
                    
                  
            
                    if($.trim(v_company_name)==""||$.trim(v_company_id)=="0"||$.trim(v_project_name)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_add_project.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/project/project_controller.php",{action:'add_project',v_company_id:v_company_id,v_company_name:v_company_name,v_project_name:v_project_name,v_tax_content:v_tax_content}
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_add_project.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   

                                
                                }
                                else 
                                {
                                     v_btn_add_project.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'New project details added Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                   
                                    
                                    
                                    
                                     clear_text();
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
            
                
               
                      
                 function clear_text()
                 {
                     
                    
                   $("input:text"). val("") ;
                   
                  
                //   load_company_select_box('div_company_select','select_company');
                    $('#div_company_select').load('templates/company_combo.php');
                   
                    // $('#div_company_select option').map(function () {
                    // if ($(this).text() == "Select") return this;
                    // }).attr('selected', 'selected') ;
                    
                    $("#select_company").val("").trigger("chosen:updated");
                    
                //   $("#select_company").removeClass("chzn-done").removeAttr("style");
                //     $("#select_company").next(".chzn-container").remove();
                //     $("#select_company").data("chosen", null);
                    
                   
                 }
            
            
               
      
             function load_data_to_grid_project_list()
             {
                // company_list_table.destroy();
                     
                 project_list_table = $('#list_of_projects').DataTable( {
                        
                         "ajax": {
                             'type': 'POST',
                             'url': '../controller/project/project_controller.php',
                             'data': {
                                action: 'list_project'
                             }
                         },
                         "language": {
                             "zeroRecords": "No records available",
                             "infoEmpty": "No records available",
                          },
                        // "order": [[ 4, "desc" ]],
        				"bPaginate": true,
        				"bLengthChange": false,
        				"bFilter": false,
        				"bInfo": false,
        				"autoWidth": false,
                        "columns": [
                            
                             { "data": null,"width":'20px'},
                             { "data": "project_main_id","visible":false },
                             { "data": "project_main_name" },
                             { "data": "tax_content" },
                             { "data": "company_name","visible":false},
                             { "data": "company_id","visible":false},
                             { "data": "default_date"},
                             { "data": "project_main_id",
                             
                                 render: function ( data, type, rows, meta ) {
        						
        									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_project" name="edit_project" ><i class="material-icons ">remove_red_eye</i></button>';
        								
        								return str_active_status_view;
        
        							 },
                                 
                             },
                             
                             { "data": "project_main_id",
                             
                                 render: function ( data, type, rows, meta ) {
        						
        									str_active_status_delete = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_project" name="delete_project" ><i class="material-icons ">delete</i></button>';
        								
        								return str_active_status_delete;
        
        							 },
                                 
                             },
                             
                             { "data": "project_main_id",
                             
                                 render: function ( data, type, rows, meta ) {
                                        if(rows['project_number']=='' || rows['project_number'] == null)
                                        {
        						
        									str_active_status_delete = ' <button type="button" class="btn btn-sm btn-info mr-1"  id="generate_project_number" name="generate_project_number" ><i class="material-icons ">check_circle</i></button>';
                                        }
                                        else
                                        {
                                           return  rows['project_number'];
                                        }
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
                        //   "order": [
                        //       [3, 'asc']
                        //     ],
                          "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                             $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                             return nRow;
                          },
                            "displayLength": 25,
                            
                            "aoColumnDefs": [
        					{ "bSortable": false, "aTargets": [  0,1,2,3,4,5] }, 
        					
        				],
                            
                         
                      "drawCallback": function (settings) {
                                   
                                    var api = this.api();
                                
                                  var rows = api.rows({
                                    page: 'current'
                                  }).nodes(); 
                                  var last = null;
                        
                                  api.column(4, {
                                    page: 'current'
                                  }).data().each(function (group, i) {
                                    if (last !== group) {
                                      $(rows).eq(i).before(
                                       
                                        '<tr class="group" style="background-color:#4da6ff;font-size: 12px;color:white;font-weight: bold; "><td colspan="11"> Company : ' + group + '</td></tr>'
                                      );
                                      
                                        last = group;
                                  }
                                      
                                    
                              });
                         
                             
                          $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                            
                       
                       
                       
                        }              
                 
                        
                 });  
            
             }
                 
             function load_data_to_grid_project_with_number_list()
                 {
                    // company_list_table.destroy();
                         
                     project_with_number_list_table = $('#list_of_projects_with_number').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/project/project_controller.php',
                                 'data': {
                                    action: 'list_project_with_number'
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            // "order": [[ 4, "desc" ]],
            				"bPaginate": true,
            				"bLengthChange": false,
            				"bFilter": false,
            				"bInfo": false,
            				"autoWidth": false,
                            "columns": [
                                
                                 { "data": null,"width":'20px'},
                                 { "data": "project_main_id","visible":false },
                                 { "data": "project_main_name" },
                                 { "data": "tax_content" },
                                 { "data": "company_name","visible":false},
                                 { "data": "company_id","visible":false},
                                 { "data": "default_date"},
                                 { "data": "project_main_id",
                                 
                                     render: function ( data, type, rows, meta ) {
                                         
                                          if (rows['project_status'] === 'DeActivate') {
                                              
                                            return ""; // hide button
                                        }
            						
            								str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_project" name="edit_project" ><i class="material-icons ">remove_red_eye</i></button>';
            								
            								return str_active_status_view;
            
            							 },
                                     
                                 },
                                 
                                 { "data": "project_main_id",
                                 
                                     render: function ( data, type, rows, meta ) {
                                         
                                          if (rows['project_status'] === 'DeActivate') {
                                                return ""; // hide button
                                            }
            						
            								str_active_status_delete = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_project" name="delete_project" ><i class="material-icons ">delete</i></button>';
            								
            								return str_active_status_delete;
            
            							 },
                                     
                                 },
                                 
                                 { "data": "project_main_id",
                                 
                                     render: function ( data, type, rows, meta ) {
                                            if(rows['project_number']=='')
                                            {
            						
            									str_active_status_delete = ' <button type="button" class="btn btn-sm btn-info mr-1"  id="generate_project_number" name="generate_project_number" ><i class="material-icons ">check_circle</i></button>';
                                            }
                                            else
                                            {
                                                if (rows['project_status'] === 'DeActivate') {
                                                       // Show project number with strike-through
                                                        return '<span style="text-decoration: line-through; color: #888;">' + rows['project_number'] + '</span>';

                                                 }
                                               return  rows['project_number'];
                                            }
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
                            //   "order": [
                            //       [3, 'asc']
                            //     ],
                              "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                                 return nRow;
                              },
                                "displayLength": 25,
                                
                                "aoColumnDefs": [
            					{ "bSortable": false, "aTargets": [  0,1,2,3,4,5] }, 
            					
            				],
                                
                             
                          "drawCallback": function (settings) {
                                       
                                        var api = this.api();
                                    
                                      var rows = api.rows({
                                        page: 'current'
                                      }).nodes(); 
                                      var last = null;
                            
                                      api.column(4, {
                                        page: 'current'
                                      }).data().each(function (group, i) {
                                        if (last !== group) {
                                          $(rows).eq(i).before(
                                           
                                            '<tr class="group" style="background-color:#4da6ff;font-size: 12px;color:white;font-weight: bold; "><td colspan="11"> Company : ' + group + '</td></tr>'
                                          );
                                          
                                            last = group;
                                      }
                                          
                                        
                                  });
                             
                                 
                              $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                                
                           
                           
                           
                            }              
                     
                            
                     });  
                
                 }
              
                 
                 
                 
                 
                    
                 function load_data_to_grid_project_quotation_list(v_project_id)
             {
                // company_list_table.destroy();
                     
                 project_list_table = $('#list_of_projects_quotation').DataTable( {
                        
                         "ajax": {
                             'type': 'POST',
                             'url': '../controller/project/project_controller.php',
                             'data': {
                                action: 'list_project_quotation',
                               
                                v_project_id : v_project_id
                             }
                         },
                         "language": {
                             "zeroRecords": "No records available",
                             "infoEmpty": "No records available",
                          },
                        // "order": [[ 4, "desc" ]],
        				"bPaginate": true,
        				"bLengthChange": false,
        				"bFilter": false,
        				"bInfo": false,
        				"autoWidth": false,
                        "columns": [
                            
                             { "data": null,"width":'20px'},
                             { "data": "company_name"},
                             { "data": "project_name" },
                             { "data": "project_number" },
                             { "data": "quotation_number"},
                             { "data": "quotation_date"},
                             { "data": "sub_total"},
                             
                            
                             
                         ],
                         pageLength: 25,
        				 searching: false,
                         responsive: true,
                         destroy: true,
        				
                        
                        
                         "initComplete": function( settings, json ) {
                                
                           
         
                          },
                        //   "order": [
                        //       [3, 'asc']
                        //     ],
                          "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                             $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                             return nRow;
                          },
                            "displayLength": 25,
                            
                            "aoColumnDefs": [
        					{ "bSortable": false, "aTargets": [  0,1,2,3,4] }, 
        					
        				],
                            
                         
                                 
                 
                        
                 });  
            
             }
                 
                 
                
                 $('#btn_create_new_users').click(function(){
                    //clear_all_after_generate_invoice(); 
                 
                 });
                 
               
                  
                 
                                 
                 $('#list_of_projects, #list_of_projects_with_number tbody').on('click', 'td button', function(){
                     
                     
                        var $row = $(this).closest('tr');
                        var data = project_list_table.row($row).data();
                        
                         // Detect which table the clicked row belongs to
                        var table = $(this).closest('table').DataTable();
                
                        // Get row data from the correct table
                        var data = table.row($row).data();
                        
                        v_project_id  = data.project_main_id;
                        
                        load_data_to_grid_project_quotation_list(v_project_id)
                    
                    $("#project_name").val('');
                   
                    //load_company_select_box('div_company_select','select_company');
                   
                    
                        $( '#btn_add_project' ).hide();
                        $( '#btn_edit_project' ).show();
                        
                        
                        if($(this).attr("name")=='edit_project')
                         {
                             
            			   edit_data(v_project_id);
                           closeNavR(); 
            			   closeNavRProject();
            			 }
                        
                        
                         if($(this).attr("name")=='delete_project')
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
                                        						
                                        						       delete_project_entry(v_project_id);
                                                     						 
                                        							} else {
                                        							    
                                        							   
                                        							 
                                        							}
                                        						 });
                         }
                         
                          if($(this).attr("name")=='generate_project_number')
                         {
                             swal({
                                                                    
                                        							title: "Are you sure?",
                                        							text: "Do you want to generate project number?",
                                        							icon: 'warning',
                                        							dangerMode: true,
                                        							allowOutsideClick: false,
                                                                    closeOnClickOutside: false,
                                        							buttons: {
                                        							  cancel: 'No Cancel !',
                                        							  delete: 'Yes Please Generate'
                                        							}
                                        							}).then(function (willDelete) {
                                        							if (willDelete) {
                                        						
                                        						       generate_project_no(v_project_id);
                                                     						 
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
                                        						
                    //                     						       delete_project_entry(v_project_id);
                                                     						 
                    //                     							} else {
                                        							    
                                        							   
                                        							 
                    //                     							}
                    //                     						 });
                    //                       break;
                                     
                    //                       case "catch":
                                          
                    //                       //swal("Edit!", "Please Edit your data", "success");
                    //                       edit_data(v_project_id);
                    //                       closeNavR();
                                          
                    //                       break;
                                     
                    //                     default:
                                         
                    //                   }
                            
                    //   });    
                        
                        
                     function  edit_data(v_project_id) 
                       {
                        
                        $("#txt_project_id").val(v_project_id);   
                       
                        $("#project_name").val(data.project_main_name);
                        $("#txt_tax_content").val(data.tax_content);
                        //$("#div_company_select option:selected").val(data.company_id);
                        
                        //$("#div_company_select option:selected").text(data.company_name);
                        //alert(data.company_name);
                        
                        // $('#div_company_select option').map(function () {
                        // if ($(this).val() == data.company_id) return this;
                        // }).attr('selected', 'selected') ;
                        
                        // $("#select_account_type").find('option').removeAttr("selected");
                        //  $('#div_company_select option').map(function () {
                        // if ($(this).text() == $.trim(data.company_name)) return this;
                        // }).attr('selected', 'selected');
                       
                       $("#select_company").val(data.company_id);
                        $("#select_company").trigger("chosen:updated");
                       
                       
                        $('#btn_edit_project' ).show();
                         
                        
                        closeNavR();
                        closeNavRProject();
                       }  
                        
                 });
                 
                function delete_project_entry(v_project_id)
                    {
                        
                        $.post("../controller/project/project_controller.php",{action:'cancel_project_entry',v_project_id:v_project_id}
                                                , function(result,status)
                                                {
                                            //         swal("System is deactivated the project entry", {
                                    								// title: 'Warning',
                                    								// icon: "warning",
                                    							 // });
                                                    
                         });
                         
                         load_data_to_grid_project_list();
                         load_data_to_grid_project_with_number_list();
                       
                    }
                    
                function generate_project_no(v_project_id)
                    {
                        
                        $.post("../controller/project/project_controller.php",{action:'generate_project_number',v_project_id:v_project_id}
                                                , function(result,status)
                                                {
                                                    
                                                   
                                                    swal("The Project Number is Generated , Please Check in Generated List", {
                                    								title: 'Success',
                                    								icon: "success",
                                    							  });
                                                    
                         });
                         
                         load_data_to_grid_project_list();
                         load_data_to_grid_project_with_number_list();
                       
                    }        
                 
             
                  
                 
                  v_btn_edit_project.click(function(){
                      
                 
                    v_btn_edit_project.ladda( 'start' );
                    var v_project_id=$("#txt_project_id").val();
                    var v_company_id=$("#div_company_select option:selected").val();
                    var v_company_name=$("#div_company_select option:selected").text();
                    
                    var v_project_name=$("#project_name").val();
                    var v_tax_content=$("#txt_tax_content").val();
                  
            
                    if($.trim(v_company_name)==""||$.trim(v_company_id)=="0"||$.trim(v_project_name)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_edit_project.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                        //  $.post("../controller/project/project_controller.php",{action:'edit_project',v_project_id:v_project_id,v_company_id:v_company_id,v_company_name:v_company_name,v_project_name:v_project_name,v_reference_no:v_reference_no,v_signed_date:v_signed_date,v_contact_phone:v_contact_phone,v_contact_person:v_contact_person,v_contact_address:v_contact_address,v_fax_number:v_fax_number,v_contract_value:v_contract_value,v_variations:v_variations,v_tax_id:v_tax_id,v_tax_name:v_tax_name_value,v_tax_value:v_tax_value,v_project_description:v_project_description}
                        //         , function(result,status)
                                
                                $.post("../controller/project/project_controller.php",{action:'edit_project',v_project_id:v_project_id,v_company_id:v_company_id,v_company_name:v_company_name,v_project_name:v_project_name,v_tax_content:v_tax_content}
                                , function(result,status)
                                
                               
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_edit_project.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_btn_edit_project.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Project details edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_add_project' ).show();
                                     $( '#btn_edit_project' ).hide();
                                     //$("#txt_invoice_no").val(result);
                                    
                                     
                                    load_data_to_grid_project_list();
                                     clear_text();
                                    
                                }
                            
                        }); 
                     }
            
                   
                });
                
              
                  
                 
               
                
                  
                 $('#btn_view_list_of_project').click(function(){
                     
                     
                    load_data_to_grid_project_list(); 
                    
                    //  ('#div_company_select_project').load('templates/company_combo.php');
                     
                 });     
                  
                  
                   $('#btn_view_list_of_project_with_number').click(function(){
                     
                    load_data_to_grid_project_with_number_list();
                    //   ('#div_company_select_project_number').load('templates/company_combo.php');
                     
                 });
                 
                   $('#btn_create_new_projects').click(function(){
                     
                    location.reload(true);
                     
                 }); 
                  
                  $('#btn_cancel').click(function(){
                     
                     clear_text(); 
                     
                 }); 

});