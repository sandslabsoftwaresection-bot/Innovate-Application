$(document).ready(function(){
    
                
   
                var v_btn_company_add = $( '#btn_company_add' ).ladda();
                var v_btn_company_edit = $( '#btn_company_edit' ).ladda();
                
                //var company_list_table = $('#list_of_companies').DataTable({});
                
                var company_list_table = $('#list_of_companies').DataTable({ info: false,"ordering": false});
                $('#list_of_companies').addClass('pagination-sm');
				
				var project_list_table = $('#list_of_project').DataTable({ info: false,"ordering": false});
                $('#list_of_project').addClass('pagination-sm');
                
                //var invoice_view_list_table = $('#list_of_invoices').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                 $('#list_of_companies').removeClass( 'display' ).addClass('table table-striped table-bordered');
				 $('#list_of_project').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 //$('#list_of_invoices').removeClass( 'display' ).addClass('table table-striped table-bordered');
                  $('#list_of_companies tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { company_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
				  
				  $('#list_of_project tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { project_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                //  $('#list_of_invoices tbody').on( 'click', 'tr', function () {
                //     if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { invoice_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                //  }); 
                 
                 $( '#btn_company_edit' ).hide();
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
                
//          $("#upload_item_image").change(function () {
		   
// 		   //var limit=5;
// 		   var files = $(this)[0].files;
// 		   file_count=files.length;
// 		   //alert(file_count);
//         if(file_count > 1 ){
			
// 			swal("warning","You must select minimum one image", "info");
// 			$("#upload_item_image").val("");
// 			var dvPreview = $("#dvPreview");
//             dvPreview.html("");
//               return false;
			
                
		
// 		}
// 		else{
// 			if (typeof (FileReader) != "undefined") {
//                     var dvPreview = $("#dvPreview");
//                     dvPreview.html("");
//                     var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
//                     $($(this)[0].files).each(function () {
//                         var file = $(this);
//                         if (regex.test(file[0].name.toLowerCase())) {
//                             var reader = new FileReader();
//                             reader.onload = function (e) {
//                                 var img = $("<img />");
//                                 img.attr("style", "height:200px;width: 200px");
//                                 img.attr("src", e.target.result);
//                                 dvPreview.append(img);
//                             }
//                             reader.readAsDataURL(file[0]);
// 							//alert(file[0].name);
							
// 							$("#edit_item_image").val(file[0].name);
// 							//$("#upload_item_image").val(file[0].name);
//                         } else {
//                             alert(file[0].name + " is not a valid image file.");
//                             dvPreview.html("");
//                             $("#upload_item_image").val("");
//                             $("#edit_item_image").val("");
//                             return false;
//                         }
//                     });
//                 } else {
//                     alert("This browser does not support HTML5 FileReader.");
//                 }
		
// 			}
//             });     
            
       
                
            //     $('#txt_company_name,#txt_contact_person,#txt_city_name,#txt_state_name,#txt_contact_address_1,#txt_contact_address_2,#txt_company_description').keypress(function (e) {
           
            //         var str = $(this).val();
            //         str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            //         return letter.toUpperCase();
                    
            //         });
            //         $(this).val(str);
        

            //   });
               
               
                           
               $('#txt_contact_phone,#txt_fax_number').keypress(function (e) {
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
    
    
                v_btn_company_add.click(function(){
                    
                    v_btn_company_add.ladda( 'start' );
                    
                    var v_company_name=$("#txt_company_name").val();
                    var v_contact_person=$("#txt_contact_person").val();
                    var v_contact_email=$("#txt_contact_email").val();
                    var v_contact_phone=$("#txt_contact_phone").val();
                    var v_contact_address_1=$("#txt_contact_address_1").val();
                    var v_contact_address_2=$("#txt_contact_address_2").val();
                    var v_country_name=$("#select_country_name option:selected").text();
                    
                   // $('#select_dist option:selected').val();
                    var v_state_name=$("#txt_state_name").val();
                    var v_state_name='NA';
                    var v_city_name=$('#txt_city_name').val();
                    var v_fax_number=$('#txt_fax_number').val();
                    var v_company_description=$('#txt_company_description').val();
                    
                    var upload_item_image='user.png'; 
                    
                  //  var upload_item_image = $("#upload_item_image").val();
                //     var randomNum = Math.ceil(Math.random() * 999999);   
                    
                //   // var upload_item_image = upload_item_image.name;
                   
                //      if($("#upload_item_image").val() == "")
                // 		 {
                // 			 var upload_item_image='user.png'; 
                // 		 }
                // 		  else
                // 		  {
                // 			 var upload_item_image = $("#upload_item_image")[0].files[0];
                // 			 var upload = new ns.Upload(upload_item_image);
                // 			 upload.doUpload("../../httpdocs/user_upload/profile_image_upload.php?random_no="+randomNum);
                // 			 var upload_item_image = randomNum+'_'+upload_item_image.name; 
                // 	  }
                   
                    console.log("upload_item_image:"+upload_item_image+"v_company_name:"+v_company_name+",v_contact_person:"+v_contact_person+",v_contact_email:"+v_contact_email+",v_contact_phone:"+v_contact_phone+",v_contact_address_1:"+v_contact_address_1+",v_contact_address_2:"+v_contact_address_2+",v_country_name:"+v_country_name+",v_state_name:"+v_state_name+",v_fax_number:"+v_fax_number+",v_company_description:"+v_company_description);
                    
                   
                  
            
                    if($.trim(v_company_name)==""||$.trim(v_contact_person)==""||$.trim(v_contact_email)==""||$.trim(v_contact_phone)==""||$.trim(v_contact_address_1)==""||$.trim(v_contact_address_2)==""||$.trim(v_country_name)=="select"||$.trim(v_state_name)==""||$.trim(v_company_description)==""||$.trim(upload_item_image)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_company_add.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/company/company_controller.php",{action:'add_company',v_company_name:v_company_name,v_contact_person:v_contact_person,v_contact_email:v_contact_email,v_contact_phone:v_contact_phone,v_contact_address_1:v_contact_address_1,v_contact_address_2:v_contact_address_2,v_country_name:v_country_name,v_state_name:v_state_name,v_city_name:v_city_name,v_fax_number:v_fax_number,v_company_description:v_company_description,upload_item_image:upload_item_image }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_company_add.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   

                                
                                }
                                else 
                                {
                                     v_btn_company_add.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'New company added successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                   
                                    //  $("#txt_company_name,#txt_contact_person,#txt_city_name,#txt_state_name,#txt_contact_address_1,#txt_contact_address_2,#txt_company_description,#txt_contact_email,#txt_contact_phone,#txt_fax_number").prop("readonly",true);
                                     
                                     
                                    
                                    
                                    
                                    
                                     clear_text();
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
            
                
               
                      
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
                    
                    // $('#hidden_item_image').val('');
                    // $('#edit_item_image').val('');
                    // $('#dvPreview').html('');
                    // $('#upload_item_image').val('');
                    
                   
                    
                   
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
				// '<td ><div align="center">State </div></td>'+
				'<td ><div align="center">City </div></td>'+
				'<td ><div align="center">Fax </div></td>'+
				'<td ><div align="center">Created Date </div></td>'+
			  '</tr>'+
			  '<tr>'+
				'<td ><div align="center">'+d.contact_address_1+'</div></td>'+
				// '<td><div align="center">'+d.state+'</div></td>'+
				'<td><div align="center">'+d.city+' </div></td>'+
				'<td ><div align="center">'+d.fax+'</div></td>'+
				'<td><div align="center">'+d.default_date+'</div></td>'+
			  '</tr>'+
			 
			  
			 //  '<tr style="background: #989898;color:#ffffff;">'+
				
				// '<td colspan="3" ><div align="center">Description </div></td>'+
			 //   '<td ><div align="center">Created Date </div></td>'+
			 // '</tr>'+
			 // '<tr>'+
			 // '<td colspan="3"><div align="center">'+d.description+'</div></td>'+
				// '<td><div align="center">'+d.default_date+'</div></td>'+
			 // '</tr>'+
			  
			 // '<tr style="background: #989898;color:#ffffff;">'+
				// '<td colspan="3"><div align="center">Logo </div></td>'+
			
			 // '</tr>'+
			 // '<tr>'+
				// '<td colspan="3"><div align="center"><img src=../../httpdocs/images/profile_image/'+$.trim(d.profile_image)+' height="200px" width="200px"/></div></td>'+
			
			 // '</tr>'+
			  
			  
			'</table>' ;
			
		
		
		}
           
            
            
                function load_data_to_grid_company_list()
                 {
                     company_list_table.destroy();
                         
                     company_list_table = $('#list_of_companies').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/company/company_controller.php',
                                 'data': {
                                    action: 'list_company'
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            				"Paginate": true,
            				"bLengthChange": false,
            				"bFilter": false,
            				"bInfo": false,
            				"autoWidth": false,
                            "columns": [
                                  {
                                    "className":  'details-control',
                                    "orderable":  false,
                                    "data":        null,
                                    "defaultContent": '',
                                    "width":'10px'
                                 },
                                 { "data": null},
                                 { "data": "company_id","visible":false },
                                 { "data": "company_name" },
                                 { "data": "contact_address_1"},
                                 { "data": "country"},
                                 { "data": "contact_person"},
                                 { "data": "contact_phone"},
                                 { "data": "contact_email"},
                                 { "data": "description"},
                                 { "data": "company_id",
                                 
                                     render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_company" name="edit_company" ><i class="material-icons ">remove_red_eye</i></button>';
            								
            								return str_active_status_view;
            
            							 },
                                     
                                 },
                                 
								 { "data": "company_id",
                                 
                                     render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm success-gradient mr-1"  id="view_company" name="view_company" ><i class="material-icons ">dashboard</i></button>';
            								
            								return str_active_status_view;
            
            							 },
                                     
                                 },
								 
                                 { "data": "company_id",
                                 
                                     render: function ( data, type, rows, meta ) {
            						
            									str_active_status_delete = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_company" name="delete_company" ><i class="material-icons ">delete</i></button>';
            								
            								return str_active_status_delete;
            
            							 },
                                     
                                 },
                                
            				// 	 { "data": "contact_address_2"},
                //                  { "data": "state"},
            				// 	 { "data": "city"},
            				// 	 { "data": "fax"},
            				// 	 { "data": "description"},
             
                             ],
                             pageLength: 10,
            				 searching: true,
                             responsive: true,
                             "aoColumnDefs": [
            					{ "bSortable": false, "aTargets": [  0,1,2,3,4,5,6,7] }, 
            					
            				],
                            
            				
                             "initComplete": function( settings, json ) {
                                    
                               
             
                              },
                                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                 $("td:eq(1)", nRow).html(iDisplayIndex + 1);
                                 return nRow;
                              },
                              "drawCallback": function () {
                                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                                }
                            
                     });  
                
                 }
                 
            
              
                 
                
                 $('#btn_create_new_company').click(function(){
                     
                  location.reload(true);
                  
                 });
                 
               
                  
                 
                                 
                 $('#list_of_companies tbody').on('click', 'td button', function(){
                        var $row = $(this).closest('tr');
                        var data = company_list_table.row($row).data();
                        v_company_id  = data.company_id;
						$("#company_name").html(data.company_name);
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
                    // 	$('#upload_item_image').val('');
                    // 	$('#hidden_item_image').val('');
                    //     $('#edit_item_image').val('');
                    //     $('#dvPreview').html('');
                        $( '#btn_company_add' ).hide();
                        $( '#btn_company_edit' ).show();
                        
                         if($(this).attr("name")=='edit_company')
                         {
                             
            			   edit_data(v_company_id);
                           closeNavR(); 
            			
            			 }
						 $('#myDiv').hide();
						 if($(this).attr("name")=='view_company')
                         {
							
						   $('#view_project_modal').modal('show');
						   view_data(v_company_id);
            			
            			 }
                        
                         if($(this).attr("name")=='delete_company')
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
                                        						
                                        						       delete_company(v_company_id);
                                                     						 
                                        							} else {
                                        							    
                                        							   
                                        							 
                                        							}
                                        						 });
                         }
                         
                         
                        //  swal("Do you want to Edit or Delete?", {
                        //               buttons: {
                        //                 cancel: "Cancel",
                        //                 catch: {
                        //                   text: "Edit",
                        //                   value: "catch",
                        //                 },
                        //                 defeat: {
                        //                   text: "Delete",
                        //                   value: "delete",
                        //                 },
                        //               },
                                      
                        //               icon:"warning",
                        //             })
                        //             .then((value) => {
                        //               switch (value) {
                                     
                        //                 case "delete":
                        //                                          swal({
                                                                    
                        //                 							title: "Are you sure?",
                        //                 							text: "Do you want to delete the entry?",
                        //                 							icon: 'warning',
                        //                 							dangerMode: true,
                        //                 							allowOutsideClick: false,
                        //                                             closeOnClickOutside: false,
                        //                 							buttons: {
                        //                 							  cancel: 'No Cancel !',
                        //                 							  delete: 'Yes Please Delete'
                        //                 							}
                        //                 							}).then(function (willDelete) {
                        //                 							if (willDelete) {
                                        						
                        //                 						       delete_company(v_company_id);
                                                     						 
                        //                 							} else {
                                        							    
                                        							   
                                        							 
                        //                 							}
                        //                 						 });
                        //                   break;
                                     
                        //                   case "catch":
                                          
                        //                   //swal("Edit!", "Please Edit your data", "success");
                        //                   edit_data(v_company_id);
                        //                   closeNavR();
                                          
                        //                   break;
                                     
                        //                 default:
                        //                   //swal("Got away safely!");
                        //               }
                            
                       //});    
                        
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
                        if(data.country=="Bahrain"){
                        $("#select_country_name option:selected").text("Kingdom of Bahrain");
                        }
                        else{
                            $("#select_country_name option:selected").text(data.country);
                        }
                  // $('#select_dist option:selected').val();
                        $("#txt_state_name").val(data.state);
                        $('#txt_city_name').val(data.city);
                        $('#txt_fax_number').val(data.fax);
                        $('#txt_company_description').val(data.description);
                        // $("#dvPreview").prepend('<img  width="200px" height="200px" src="../../httpdocs/images/profile_image/'+$.trim(data.profile_image)+'"/> ');
                        
                        // // var img = $("<img />");
                        // //         img.attr("style", "height:100px;width: 100px");
                        // //         img.attr("src", '../../httpdocs/images/profile_image/'+data.profile_image);
                        // //         dvPreview.append(img);
                        // //$('#upload_item_image').val(data.profile_image);
                        
                        //  $('#edit_item_image').val(data.profile_image);
                        //  $("#hidden_item_image").val(data.profile_image);
                        
                    
                         $('#btn_company_edit' ).show();
                         
                        
                        closeNavR();
                       }  
                        
                 });
                 
				 function view_data(v_company_id)
				 {
					
					$.post("../controller/company/company_controller.php",{action:'get_project_count',v_company_id:v_company_id}
                                                , function(result,status)
                                                {
                                            //alert(result+status);
											if (status === 'success') 
											{
												$('#txt_project').text(result) ;
											}
                         });
						 
					$.post("../controller/company/company_controller.php",{action:'get_quotation_count',v_company_id:v_company_id}
                                                , function(result,status)
                                                {
                                            //alert(result+status);
											if (status === 'success') 
											{
												$('#txt_quotation').text(result) ;
											}
                         });

					$.post("../controller/company/company_controller.php",{action:'get_approv_quotation_count',v_company_id:v_company_id}
                                                , function(result,status)
                                                {
                                            //alert(result+status);
											if (status === 'success') 
											{
												$('#txt_app_quotation').text(result) ;
											}
                         });	 
				 }
				 
                function delete_company(v_company_id)
                    {
                        
                        $.post("../controller/company/company_controller.php",{action:'cancel_company',v_company_id:v_company_id}
                                                , function(result,status)
                                                {
                                            //         swal("System is deactivated the company", {
                                    								// title: 'Warning',
                                    								// icon: "warning",
                                    							 // });
                                    							 load_data_to_grid_company_list();
                                                    
                         });
                         
                         
                       
                    }
					
					function load_data_to_grid_project_list(v_company_id)
                 {
                     project_list_table.destroy();
                         
                     project_list_table = $('#list_of_project').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/company/company_controller.php',
                                 'data': {
                                    action: 'list_project',
									v_company_id:v_company_id,
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            				"Paginate": true,
            				"bLengthChange": false,
            				"bFilter": false,
            				"bInfo": false,
            				"autoWidth": false,
                            "columns": [
                                  {
                                    "className":  'details-control',
                                    "orderable":  false,
                                    "data":        null,
                                    "defaultContent": '',
                                    "width":'10px'
                                 },
                                 { "data": null},
                                 { "data": "project_main_name" },
                                 { "data": "tax_content"},
                                 { "data": "default_date"},
                             ],
                             pageLength: 10,
            				 searching: true,
                             responsive: true,
                             "aoColumnDefs": [
            					{ "bSortable": false, "aTargets": [  0,1,2,3,4] }, 
            					
            				],
                            
            				
                             "initComplete": function( settings, json ) {
                                    
                               
             
                              },
                                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                 $("td:eq(1)", nRow).html(iDisplayIndex + 1);
                                 return nRow;
                              },
                              "drawCallback": function () {
                                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                                }
                            
                     });  
                
                 }
                 
             
                  $('#btn_view_project_tbl').click(function(){
					  
					   $('#myDiv').show();
					  load_data_to_grid_project_list(v_company_id);
					  
				  });
				  $('#btn_view_quotation_tbl').click(function(){
					  
					   $('#myDiv').show();
					  load_data_to_grid_project_list(v_company_id);
					  
				  });
				  
				  
				  
				  $('#list_of_project tbody').on('click', 'td.details-control', function () {
						var tr = $(this).closest('tr');
						var row = project_list_table.row( tr );
						
						if ( row.child.isShown() ) {
							// This row is already open - close it
							row.child.hide();
							tr.removeClass('shown');
						}
						else {
							// Open this row
							createChild(row);
							tr.addClass('shown');
						}
					} );	
					  
                 
				    function createChild ( row ) {
            var rowData = row.data();
            // This is the table we'll convert into a DataTable
            var table = $('<table class="table table-striped" width="100%"/>');
            //alert(rowData.project_main_id);
            // Display it the child row
            row.child( table ).show();
            //requisition_history_list_table.destroy();
            var history_table = table.DataTable( {
                //dom: 'Bfrtip',
                //pageLength: 5,
                
                "language": {
                     "zeroRecords": "No records available",
                     "infoEmpty": "No records available",
                 },
				 
				 columnDefs: [{
						  "defaultContent": "-",
						  "targets": "_all"
					  }],

				"bPaginate": false,
				"bLengthChange": false,
				"bFilter": false,
				"bInfo": false,
				"autoWidth": true,
				"bRetrieve":true,
			    "ordering": false,
			    
                ajax: {
                    'url': '../controller/company/company_controller.php',
                    'type': 'post',
                    'data':function ( d ) {
                        d.action = 'list_quotation',
                         d.v_project_id = rowData.project_main_id;
                     }
                },
                columns: [
                    { title: 'Quotation Number',  data: "quotation_number",
						 render: function ( data, type, rows, meta ) 
					   {
							var quotation_number = data;
							var url = 'reports/quotation_print_with_head_v1.php?quotation_number=' + quotation_number;
							var link = '<a href="' + url + '" target="_blank">' + quotation_number + '</a>';
							return link;
					   }
					},
					    
                    { title: 'Quotation Amount', data: 'sub_total' },
                    { title: 'Created Date', data: 'quotation_date' },
                    { title: 'Status', data: 'approved_status',
						render: function ( data, type, rows, meta ) 
					   {
						 if(data=='Pending') 
						 {
							var request_approved_status ='<div class="align-self-center ms-1"><span class="badge bg-warning" style="color:white;">'+data+'</span></div>'
						 }
						  if(data=='Approved') 
						 {
							var request_approved_status ='<div class="align-self-center ms-1"><span class="badge bg-success" style="color:white;">'+data+'</span></div>'
						 }
						 return request_approved_status;
					   },
					},
                ],
                
				 searching: false,
                 responsive: false,
                
            } );
        }
				  
		
                  v_btn_company_edit.click(function(){
                      
                 
                    v_btn_company_edit.ladda( 'start' );
                    var v_company_id=$("#txt_company_id").val();
                    var v_company_name=$("#txt_company_name").val();
                    var v_contact_person=$("#txt_contact_person").val();
                    var v_contact_email=$("#txt_contact_email").val();
                    var v_contact_phone=$("#txt_contact_phone").val();
                    var v_contact_address_1=$("#txt_contact_address_1").val();
                    var v_contact_address_2=$("#txt_contact_address_2").val();
                    var v_country_name=$("#select_country_name option:selected").text();
                    
                   // $('#select_dist option:selected').val();
                    var v_state_name="NA";
                    var v_city_name=$('#txt_city_name').val();
                    var v_fax_number=$('#txt_fax_number').val();
                    var v_company_description=$('#txt_company_description').val();
                    //var upload_item_image=$("#upload_item_image").val();
                    // var edit_item_image=$("#edit_item_image").val();
                    // var hidden_item_image=$("#hidden_item_image").val();
                    // var randomNum = Math.ceil(Math.random() * 999999); 
                    
                    //  console.log(hidden_item_image);
                    //  console.log("Outside loop:"+edit_item_image);
                    // if($.trim(hidden_item_image)!=$.trim(edit_item_image))
                    // {
                    // var upload_item_image = $("#upload_item_image")[0].files[0];
                			 //var upload = new ns.Upload(upload_item_image);
                			 //upload.doUpload("../../httpdocs/user_upload/profile_image_upload.php?random_no="+randomNum);
                			 //edit_item_image=randomNum+'_'+upload_item_image.name; 
                			 //console.log("Inside loop:"+edit_item_image);
                			 
                    // }
                //     else
                //     {
                        
                //     }
                // 	var upload_item_image = upload_item_image.name;
                        
                  
            
                    if($.trim(v_company_name)==""||$.trim(v_contact_person)==""||$.trim(v_contact_email)==""||$.trim(v_contact_phone)==""||$.trim(v_contact_address_1)==""||$.trim(v_contact_address_2)==""||$.trim(v_country_name)=="select"||$.trim(v_state_name)==""||$.trim(v_company_description)=="")
                    
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_company_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/company/company_controller.php",{action:'edit_company',v_company_id:v_company_id,v_company_name:v_company_name,v_contact_person:v_contact_person,v_contact_email:v_contact_email,v_contact_phone:v_contact_phone,v_contact_address_1:v_contact_address_1,v_contact_address_2:v_contact_address_2,v_country_name:v_country_name,v_state_name:v_state_name,v_city_name:v_city_name,v_fax_number:v_fax_number,v_company_description:v_company_description,upload_item_image:'user.png'}
                                , function(result,status)
                               
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_company_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_invoice_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_btn_company_edit.ladda( 'stop' );
                                    
                                     //swal("Success"," Invoice added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Company details edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_company_add' ).show();
                                     $( '#btn_company_edit' ).hide();
                                     //$("#txt_invoice_no").val(result);
                                    
                                     
                                    load_data_to_grid_company_list();
                                     clear_text();
                                    
                                }
                            
                        }); 
                     }
            
                   
                });
                
				
				function load_data_to_grid_project_list2(v_company_id)
                 {
                     project_list_table.destroy();
                         
                     project_list_table = $('#list_of_project').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/company/company_controller.php',
                                 'data': {
                                    action: 'list_project1',
									v_company_id:v_company_id,
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            				"Paginate": true,
            				"bLengthChange": false,
            				"bFilter": false,
            				"bInfo": false,
            				"autoWidth": false,
                            "columns": [
                                  {
                                    "className":  'details-controls',
                                    "orderable":  false,
                                    "data":        null,
                                    "defaultContent": '<i class="fas fa-plus"></i>',
                                    "width":'10px'
                                 },
                                 { "data": null},
                                 { "data": "project_main_name" },
                                 { "data": "tax_content"},
                                 { "data": "default_date"},
                             ],
                             pageLength: 10,
            				 searching: true,
                             responsive: true,
                             "aoColumnDefs": [
            					{ "bSortable": false, "aTargets": [  0,1,2,3,4] }, 
            					
            				],
                            
            				
                             "initComplete": function( settings, json ) {
                                    
                               
             
                              },
                                "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                 $("td:eq(1)", nRow).html(iDisplayIndex + 1);
                                 return nRow;
                              },
                              "drawCallback": function () {
                                    $('.dataTables_paginate > .pagination').addClass('pagination-sm');
                                }
                            
                     });  
                
                 }
				 
				 $('#btn_approved_quotation_tbl').click(function(){
					  
					   $('#myDiv').show();
					  load_data_to_grid_project_list2(v_company_id);
					  
				  });
				  
				  $('#list_of_project tbody').on('click', 'td.details-controls', function () {
						var tr = $(this).closest('tr');
						var row = project_list_table.row( tr );
						
						if ( row.child.isShown() ) {
							// This row is already open - close it
							row.child.hide();
							tr.removeClass('shown');
						}
						else {
							// Open this row
							createChild2(row);
							tr.addClass('shown');
						}
					} );	
					  
                 
				    function createChild2 ( row ) {
            var rowData = row.data();
            // This is the table we'll convert into a DataTable
            var table = $('<table class="table table-striped" width="100%"/>');
            //alert(rowData.project_main_id);
            // Display it the child row
            row.child( table ).show();
            //requisition_history_list_table.destroy();
            var history_table = table.DataTable( {
                //dom: 'Bfrtip',
                //pageLength: 5,
                
                "language": {
                     "zeroRecords": "No records available",
                     "infoEmpty": "No records available",
                 },
				 
				 columnDefs: [{
						  "defaultContent": "-",
						  "targets": "_all"
					  }],

				"bPaginate": false,
				"bLengthChange": false,
				"bFilter": false,
				"bInfo": false,
				"autoWidth": true,
				"bRetrieve":true,
			    "ordering": false,
			    
                ajax: {
                    'url': '../controller/company/company_controller.php',
                    'type': 'post',
                    'data':function ( d ) {
                        d.action = 'list_quotation2',
                         d.v_project_id = rowData.project_main_id;
                     }
                },
                columns: [
                    { title: 'Quotation Number',  data: "quotation_number",
					 render: function ( data, type, rows, meta ) 
					   {
							var quotation_number = data;
							var url = 'reports/quotation_print_with_head_v1.php?quotation_number=' + quotation_number;
							var link = '<a href="' + url + '" target="_blank">' + quotation_number + '</a>';
							return link;
					   }
					},
					    
                    { title: 'Quotation Amount', data: 'sub_total' },
                    { title: 'Created Date', data: 'quotation_date' },
                    { title: 'Status', data: 'approved_status',
						render: function ( data, type, rows, meta ) 
						   {
							 
								return request_approved_status ='<div class="align-self-center ms-1"><span class="badge bg-success" style="color:white;">'+data+'</span></div>'
							 
							 
						   },
					},
                ],
                
				 searching: false,
                 responsive: false,
                
            } );
        }
              
                  
                 
               $('#close_modal').click(function(){
					
				  $('#view_project_modal').modal('hide');
			   });
                
                  
                 $('#btn_view_list_of_companies').click(function(){
                     
                    load_data_to_grid_company_list(); 
                     
                 });
                 
                 $('#btn_cancel').click(function(){
                     
                     clear_text();
                     
                 });  
                 
                 
                  

});