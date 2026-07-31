$(document).ready(function(){
    
                
   
                //var v_btn_company_add = $( '#btn_company_add' ).ladda();
                var v_btn_profile_edit = $( '#btn_profile_edit' ).ladda();
                
                //var company_list_table = $('#list_of_companies').DataTable({});
                
                var list_of_profile_table = $('#list_of_profile').DataTable({ info: false,"ordering": false});
                $('#list_of_profile').addClass('pagination-sm');
                
                //var invoice_view_list_table = $('#list_of_invoices').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 $('#list_of_profile').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 //$('#list_of_invoices').removeClass( 'display' ).addClass('table table-striped table-bordered');
                  $('#list_of_profile tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { company_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                //  $('#list_of_invoices tbody').on( 'click', 'tr', function () {
                //     if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { invoice_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                //  }); 
                 
                 //$( '#btn_profile_edit' ).hide();
                 company_profile();
                 //$('#btn_edit_invoice' ).hide();
              // load_data_to_grid_company_list();
               function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
         $("#upload_item_image").change(function () {
		   
		   //var limit=5;
		   var files = $(this)[0].files;
		   file_count=files.length;
		   //alert(file_count);
        if(file_count > 1 ){
			
			swal("warning","You must select minimum one image", "info");
			$("#upload_item_image").val("");
			var dvPreview = $("#dvPreview");
            dvPreview.html("");
               return false;
			
                
		
		}
		else{
			if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#dvPreview");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:65px;width: 330px");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
							//alert(file[0].name);
							
							$("#edit_item_image").val(file[0].name);
							//$("#upload_item_image").val(file[0].name);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            $("#upload_item_image").val("");
                            $("#edit_item_image").val("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
		
			}
            });     
            
       
                
//             $("#upload_top_logo").change(function () {
		   
// 		   //var limit=5;
// 		   var files = $(this)[0].files;
// 		   file_count=files.length;
// 		   //alert(file_count);
//         if(file_count > 1 ){
			
// 			swal("warning","You must select minimum one image", "info");
// 			$("#upload_top_logo").val("");
// 			var dvPreview_top_logo = $("#dvPreview_top_logo");
//             dvPreview_top_logo.html("");
//               return false;
			
                
		
// 		}
// 		else{
// 			if (typeof (FileReader) != "undefined") {
//                     var dvPreview_top_logo = $("#dvPreview_top_logo");
//                     dvPreview_top_logo.html("");
//                     var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
//                     $($(this)[0].files).each(function () {
//                         var file = $(this);
//                         if (regex.test(file[0].name.toLowerCase())) {
//                             var reader = new FileReader();
//                             reader.onload = function (e) {
//                                 var img = $("<img />");
//                                 img.attr("style", "height:200px;width: 200px");
//                                 img.attr("src", e.target.result);
//                                 dvPreview_top_logo.append(img);
//                             }
//                             reader.readAsDataURL(file[0]);
// 							//alert(file[0].name);
							
// 							$("#edit_front_logo").val(file[0].name);
// 							//$("#upload_item_image").val(file[0].name);
//                         } else {
//                             alert(file[0].name + " is not a valid image file.");
//                             dvPreview_top_logo.html("");
//                             $("#upload_top_logo").val("");
//                             $("#edit_front_logo").val("");
//                             return false;
//                         }
//                     });
//                 } else {
//                     alert("This browser does not support HTML5 FileReader.");
//                 }
		
// 			}
//             });  
               
               
                           
               $('#txt_contact_phone,#txt_fax').keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       
                        e.preventDefault();
                        return false;
                    }
               });
               
               
                $('#txt_contact_email').blur(function() {
                
                var sEmail = $('#txt_contact_email').val();
                if( !isValidEmailAddress( sEmail ) )
                {
                    //swal("Warning", "Provide valid email id...", "warning");
                    
                     $.toast({
                                        heading: 'warning',
                                        text: 'Provide valid email id..!',
                                        showHideTransition: 'slide',
                                        icon: 'warning'
                                    });
                                    
                    $('#txt_contact_email').val("");
        
                    return false;
                }
             });
      
      
      
      function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }
    
    
             
            
                
               
                      
                 function clear_text()
                 {
                     
                    
                    
                    $("#txt_company_name").val('');
                    $("#txt_contact_person").val('');
                    $("#txt_contact_email").val('');
                    $("#txt_contact_phone").val('');
                    $("#txt_contact_address_1").val('');
                    $("#txt_contact_address_2").val('');
                    //var v_country_name=$("#select_country_name option:selected").val();
                    
                   // $('#select_dist option:selected').val();
                    $("#txt_state_name").val('');
                    $('#txt_city_name').val('');
                    $('#txt_fax_number').val('');
                    $('#txt_company_description').val('');
                    
                    $('#hidden_item_image').val('');
                    $('#edit_item_image').val('');
                    $('#dvPreview').html('');
                    $('#upload_item_image').val('');
                    
                   
                    
                   
                 }
            
            
               
            $('#list_of_companies tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = company_list_table.row( tr );
         
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
                
                
        function format(d)
		{
		
			return '<table style="table-layout: fixed; width: 100%; word-wrap: break-word;">'+
			 '<tr style="background: #989898;color:#ffffff;">'+
				'<td ><div align="center">Address </div></td>'+
				'<td ><div align="center">State </div></td>'+
				'<td ><div align="center">City </div></td>'+
			  '</tr>'+
			  '<tr>'+
				'<td ><div align="center">'+d.contact_address_1+'</div></td>'+
				'<td><div align="center">'+d.state+'</div></td>'+
				'<td><div align="center">'+d.city+' </div></td>'+
			  '</tr>'+
			 
			  
			   '<tr style="background: #989898;color:#ffffff;">'+
				'<td ><div align="center">Fax </div></td>'+
				'<td ><div align="center">Description </div></td>'+
			    '<td ><div align="center">Created Date </div></td>'+
			  '</tr>'+
			  '<tr>'+
				'<td ><div align="center">'+d.fax+'</div></td>'+
				'<td><div align="center">'+d.description+'</div></td>'+
				'<td><div align="center">'+d.default_date+'</div></td>'+
			  '</tr>'+
			  
			  '<tr style="background: #989898;color:#ffffff;">'+
				'<td colspan="3"><div align="center">Logo </div></td>'+
			
			  '</tr>'+
			  '<tr>'+
				'<td colspan="3"><div align="center"><img src=../../httpdocs/images/profile_image/'+$.trim(d.profile_image)+' height="330px" width="65px"/></div></td>'+
			
			  '</tr>'+
			  
			  
			'</table>' ;
			
		
		
		}
           
           
           function company_profile()
           {
               
                $.post("../controller/company/profile_controller.php",{action:'list_profile'}
                                                , function(data,status)
                                                {
                                                   // alert(data);
                                              var company= jQuery.parseJSON(data);
                                              $('#txt_company_name').val(company.data[0].company_name);
                                              $('#lastname').val(company.data[0].lastname);
                                              $('#txt_contact_address').val(company.data[0].address);
                                               $('#txt_vat_number').val(company.data[0].VAT_no);
                                               $('#txt_contact_email').val(company.data[0].email);
                                              $('#txt_contact_phone').val(company.data[0].phone_no);
                                               $('#txt_fax').val(company.data[0].fax);
                                               $('#dvPreview').html('');
                                            //   $('#dvPreview_top_logo').html('');
                                            //   $("#dvPreview_top_logo").prepend('<img  width="200px" height="200px" src="../../httpdocs/images/company_profile_image/'+$.trim(company.data[0].front_logo)+'"/> ');
                                            //   $('#edit_front_logo').val(company.data[0].front_logo);
                                               
                                            //   $('#hidden_front_logo').val(company.data[0].front_logo);
                                               
                                               $("#dvPreview").prepend('<img  width="330px" height="65px" src="../../httpdocs/images/company_profile_image/'+$.trim(company.data[0].print_logo)+'"/> ');
                                               $('#edit_item_image').val(company.data[0].print_logo);
                                               
                                               $('#hidden_item_image').val(company.data[0].print_logo);
                                                    
                         });
               
           }
            
            
                // function load_data_to_grid_company_list()
                //  {
                //      company_list_table.destroy();
                         
                //      company_list_table = $('#list_of_profile').DataTable( {
                            
                //              "ajax": {
                //                  'type': 'POST',
                //                  'url': '../controller/company/profile_controller.php',
                //                  'data': {
                //                     action: 'list_profile'
                //                  }
                //              },
                //              "language": {
                //                  "zeroRecords": "No records available",
                //                  "infoEmpty": "No records available",
                //               },
                //             "order": [[ 0, "desc" ]],
            				// "Paginate": true,
            				// "bLengthChange": false,
            				// "bFilter": false,
            				// "bInfo": false,
            				// "autoWidth": false,
                //             "columns": [
                //                   {
                //                     "className":  'details-control',
                //                     "orderable":  false,
                //                     "data":        null,
                //                     "defaultContent": '',
                //                     "width":'10px'
                //                  },
                //                  { "data": null},
                //                  { "data": "company_id","visible":false },
                //                  { "data": "company_name" },
                //                  { "data": "contact_address_1"},
                //                  { "data": "country"},
                //                  { "data": "contact_person"},
                //                  { "data": "contact_phone"},
                //                  { "data": "contact_email"}
                                
            				// // 	 { "data": "contact_address_2"},
                // //                  { "data": "state"},
            				// // 	 { "data": "city"},
            				// // 	 { "data": "fax"},
            				// // 	 { "data": "description"},
             
                //              ],
                //              pageLength: 10,
            				//  searching: true,
                //              responsive: true,
                //              "aoColumnDefs": [
            				// 	{ "bSortable": false, "aTargets": [  0,1,2,3,4,5,6,7] }, 
            					
            				// ],
                            
            				
                //              "initComplete": function( settings, json ) {
                                    
                               
             
                //               },
                //                 "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                //                  $("td:eq(1)", nRow).html(iDisplayIndex + 1);
                //                  return nRow;
                //               },
                //               "drawCallback": function () {
                //                     $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                //                 }
                            
                //      });  
                
                //  }
                 
            
              
                 
                
                 $('#btn_create_new_company').click(function(){
                     
                  location.reload(true);
                  
                 });
                 
               
                  
                 
                                 
                 $('#list_of_companies tbody').on('dblclick', 'tr', function(){
                        var $row = $(this).closest('tr');
                        var data = company_list_table.row($row).data();
                        v_company_id  = data.company_id;
                        $("#txt_company_name").val('');
                        $("#txt_contact_person").val('');
                        $("#txt_contact_email").val('');
                        $("#txt_contact_phone").val('');
                        $("#txt_contact_address_1").val('');
                        $("#txt_contact_address_2").val('');
                        
                        //var v_country_name=$("#select_country_name option:selected").val();
                        
                       // $('#select_dist option:selected').val();
                        $("#txt_state_name").val('');
                        $('#txt_city_name').val('');
                        $('#txt_fax_number').val('');
                        $('#txt_company_description').val('');
                    	$('#upload_item_image').val('');
                    	$('#hidden_item_image').val('');
                        $('#edit_item_image').val('');
                        $('#dvPreview').html('');
                        $( '#btn_company_add' ).hide();
                        $( '#btn_company_edit' ).show();
                        
                         swal("Do you want to Edit or Delete?", {
                                      buttons: {
                                        cancel: "Cancel",
                                        catch: {
                                          text: "Edit",
                                          value: "catch",
                                        },
                                        defeat: {
                                          text: "Delete",
                                          value: "delete",
                                        },
                                      },
                                      
                                      icon:"warning",
                                    })
                                    .then((value) => {
                                      switch (value) {
                                     
                                        case "delete":
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
                                        						
                                        						       delete_company(v_company_id);
                                                     						 
                                        							} else {
                                        							    
                                        							   
                                        							 
                                        							}
                                        						 });
                                          break;
                                     
                                          case "catch":
                                          
                                          //swal("Edit!", "Please Edit your data", "success");
                                          edit_data(v_company_id);
                                          closeNavR();
                                          
                                          break;
                                     
                                        default:
                                          //swal("Got away safely!");
                                      }
                            
                       });    
                        
                     function  edit_data(v_company_id) 
                       {
                           
                        // $("#txt_company_name,#txt_contact_person,#txt_city_name,#txt_state_name,#txt_contact_address_1,#txt_contact_address_2,#txt_company_description,#txt_contact_email,#txt_contact_phone,#txt_fax_number").prop("readonly",false);
                                     
                                     
                        
                        $("#txt_company_id").val(v_company_id);   
                        $("#txt_company_name").val(data.company_name);
                        $("#txt_contact_person").val(data.contact_person);
                        $("#txt_contact_email").val(data.contact_email);
                        $("#txt_contact_phone").val(data.contact_phone);
                        $("#txt_contact_address_1").val(data.contact_address_1);
                        $("#txt_contact_address_2").val(data.contact_address_2);
                        $("#select_country_name option:selected").text(data.country);
                    
                  // $('#select_dist option:selected').val();
                        $("#txt_state_name").val(data.state);
                        $('#txt_city_name').val(data.city);
                        $('#txt_fax_number').val(data.fax);
                        $('#txt_vat_number').val(data.VAT_no);
                        $('#txt_company_description').val(data.description);
                        $("#dvPreview").prepend('<img  width="330px" height="65px" src="../../httpdocs/images/profile_image/'+$.trim(data.profile_image)+'"/> ');
                        
                        // var img = $("<img />");
                        //         img.attr("style", "height:100px;width: 100px");
                        //         img.attr("src", '../../httpdocs/images/profile_image/'+data.profile_image);
                        //         dvPreview.append(img);
                        //$('#upload_item_image').val(data.profile_image);
                        
                         $('#edit_item_image').val(data.profile_image);
                         $("#hidden_item_image").val(data.profile_image);
                        
                    
                         $('#btn_company_edit' ).show();
                         
                        
                        closeNavR();
                       }  
                        
                 });
                 
                function delete_company(v_company_id)
                    {
                        
                        $.post("../controller/company/company_controller.php",{action:'cancel_company',v_company_id:v_company_id}
                                                , function(result,status)
                                                {
                                            //         swal("System is deactivated the company", {
                                    								// title: 'Warning',
                                    								// icon: "warning",
                                    							 // });
                                    							// load_data_to_grid_company_list();
                                                    
                         });
                         
                         
                       
                    }
                 
             
                  
                 
                  v_btn_profile_edit.click(function(){
                      
                      
                      
                 
                    v_btn_profile_edit.ladda( 'start' );
                    
                     var company_name=$('#txt_company_name').val();
                     
                     var lastname=$('#lastname').val();
                     var contact_address= $('#txt_contact_address').val();
                     
                      var contact_email= $('#txt_contact_email').val();
                      var contact_phone=$('#txt_contact_phone').val();
                      var fax= $('#txt_fax').val();
                      var vat_number=$('#txt_vat_number').val();
                      //var front_logo= $('#edit_front_logo').val();
                      var print_logo= $('#edit_item_image').val();
                      
                                               
                                               
                  
                    var upload_item_image=$("#upload_item_image").val();
                    var edit_item_image=$("#edit_item_image").val();
                    var hidden_item_image=$("#hidden_item_image").val();
                    
                    // var upload_top_logo=$("#upload_top_logo").val();
                    // var edit_front_image=$("#edit_front_logo").val();
                    // var hidden_front_image=$("#hidden_front_logo").val();
                    
                    
                    var randomNum = Math.ceil(Math.random() * 999999); 
                    
                     console.log(hidden_item_image);
                     console.log("Outside loop:"+edit_item_image);
                    if($.trim(hidden_item_image)!=$.trim(edit_item_image))
                    {
                    var upload_item_image = $("#upload_item_image")[0].files[0];
                			 var upload = new ns.Upload(upload_item_image);
                			 upload.doUpload("../../httpdocs/user_upload/print_logo_image_upload.php?random_no="+randomNum);
                			 edit_item_image=randomNum+'_'+upload_item_image.name; 
                			 console.log("Inside loop:"+edit_item_image);
                			 
                    }
                    
                    //  if($.trim(hidden_front_image)!=$.trim(edit_front_image))
                    // {
                    // var upload_top_logo = $("#upload_top_logo")[0].files[0];
                			 //var upload = new ns.Upload(upload_top_logo);
                			 //upload.doUpload("../../httpdocs/user_upload/front_image_upload.php?random_no="+randomNum);
                			 //edit_front_image=randomNum+'_'+upload_top_logo.name; 
                			 //console.log("Inside loop:"+edit_front_image);
                			 
                    // }
                    
                //     else
                //     {
                        
                //     }
                // 	var upload_item_image = upload_item_image.name;
                        
                  
            
                   // if($.trim(company_name)==""||$.trim(lastname)==""||$.trim(contact_address)==""||$.trim(contact_email)==""||$.trim(contact_phone)==""||$.trim(fax)==""||$.trim(front_logo)==""||$.trim(edit_item_image)=="")
                    if($.trim(company_name)==""||$.trim(lastname)==""||$.trim(contact_address)==""||$.trim(contact_email)==""||$.trim(contact_phone)==""||$.trim(edit_item_image)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_profile_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                        // $.post("../controller/company/profile_controller.php",{action:'edit_profile',company_name:company_name,lastname:lastname,contact_address:contact_address,contact_email:contact_email,contact_phone:contact_phone,fax:fax,front_logo:edit_front_image,print_logo:edit_item_image}
                               
                           $.post("../controller/company/profile_controller.php",{action:'edit_profile',company_name:company_name,lastname:lastname,contact_address:contact_address,contact_email:contact_email,contact_phone:contact_phone,fax:fax,print_logo:edit_item_image,v_vat_number:vat_number}
                              
                                , function(result,status)
                               
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_profile_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_btn_profile_edit.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Company details edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    // $( '#btn_company_add' ).show();
                                     $( '#btn_profile_edit' ).show();
                                     //$("#txt_invoice_no").val(result);
                                    
                                     location.reload(true);
                                    
                                }
                            
                        }); 
                     }
            
                   
                });
                
              
                  
                 
               
                
                  
                 $('#btn_view_list_of_companies').click(function(){
                     
                    //load_data_to_grid_company_list(); 
                     
                 });
                 
                 $('#btn_cancel').click(function(){
                     
                     clear_text();
                     
                 });  
                 
                 
     


 

});