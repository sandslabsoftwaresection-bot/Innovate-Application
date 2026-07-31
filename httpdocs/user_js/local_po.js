$(document).ready(function(){
   
                var v_but_local_po_save = $( '#btn_local_po_add' ).ladda();
                var v_but_local_po_edit = $( '#btn_local_po_edit' ).ladda();
                
                var local_po_list_table = $('#tbl_local_po_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
                var local_po_view_list_table = $('#list_of_local_pos').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                var local_po_view_cancelled_list_table = $('#list_of_cancelled_local_pos').DataTable( {searching: false, paging: false, info: false,"ordering": false});
				
				
				//$('#div_company_select').load('templates/supplier_combo.php');
                
                 $('#tbl_local_po_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#list_of_local_pos').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#list_of_cancelled_local_pos').removeClass( 'display' ).addClass('table table-striped table-bordered');
                 $('#tbl_local_po_list tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { local_po_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                 $('#list_of_local_pos tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { local_po_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                 }); 
                  $('#list_of_cancelled_local_pos tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { local_po_view_cancelled_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                 }); 
                 
                // $("#div_company_select").load('templates/supplier_combo.php');
                   //load_supplier_select_box('div_company_select','select_company');
                //   function load_supplier_select_box(div_name,ctrl_name)
                //         { 
      
                //                 $("#"+div_name).load('../controller/local_po/local_po_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});
        
                //         }
						load_job_no_select('div_job_num_select','select_supplier_jobNo');
						function load_job_no_select(div_name,job_ctrl_name)
						{ 
						   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_job_no',v_job_ctrl_name:job_ctrl_name},function(result,status){});
						}
						var select_prn_jobNo;
						var V_PRN;
						$('#div_job_num_select').change(function(){
							select_prn_jobNo = $('#select_supplier_jobNo option:selected').text();
							load_prn_no_select('div_prno_select','select_PR_No',V_PRN);
						}); 
						function load_prn_no_select(div_name,pr_ctrl_name,prn_no)
	                        { 
						   $("#"+div_name).load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1', v_pr_ctrl_name:pr_ctrl_name, v_jobNo:select_prn_jobNo, v_prnn_no:prn_no},function(result,status){  
							   if(prn_no == undefined)
							   {
								   prn_no=0;
								   $('#select_PR_No').val(prn_no);
								   $('#select_PR_No').trigger('change');
							   }
							   else
							   {
								   $('#select_PR_No').val(prn_no);
								   $('#select_PR_No').trigger('change');
							   }
							   
						   });
	                       }
						// var purchase_req_no; 
						// $('#div_prno_select').change(function(){
							// purchase_req_no = $('option:selected', $(this)).val();
						   // load_purchase_recieve_add(purchase_req_no);
						// });
											
                        
                         $("#div_company_select").change(function() {
                      
                   // $('#txt_quotation_company_name').val($('option:selected', this).text()) ;
                    var company_id=$('option:selected', this).val() ;
                  
                    $.post("../controller/local_po/local_po_controller.php",{action:'select_company_details',v_company_id:company_id},function(result,status){
                        
                                if(status=="success")
                                {
                                    
                                var obj= jQuery.parseJSON(result);
                               console.log(obj.data[0].company_name);
                                $("#txt_local_po_company_id").val(obj.data[0].company_id);
                                $("#txt_local_po_company_name").val(obj.data[0].company_name);
                                $("#txt_local_po_po_box").val(obj.data[0].city);
                                $("#txt_local_po_contact_no").val(obj.data[0].contact_phone);
                                $("#txt_local_po_fax").val(obj.data[0].fax);
                                $("#txt_local_po_attn").val(obj.data[0].contact_person);
                                
                                
                                }
                                else
                                {
                                    return false;
                                }
                    });           
                   
                 });
                 
                 $( '#btn_local_po_edit' ).hide();
                 $('#btn_edit_local_po' ).hide();
                 check_pending_local_po();
               function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
                
                 let editor;
                
                        ClassicEditor
                            .create( document.querySelector( '#txt_local_po_all_description' ) )
                            .then( newEditor => {
                                editor = newEditor;
                            } )
                            .catch( error => {
                                console.error( error );  
                            } );
                
                
                
                function check_pending_local_po()
                    {
                        
                         $.post("../controller/local_po/local_po_controller.php",{action:'check_local_po_status'},function(result,status){
                               var obj= jQuery.parseJSON(result);
                               var v_local_po_count=obj.data[0].local_po_count;
                               var v_local_po_id=obj.data[0].local_po_main_id;
                               var v_local_po_number=obj.data[0].local_po_number;
                               
                               if(v_local_po_count>0)
                                {
                                            swal({
                                                                
                                    							title: "You have an uncompleted local_po Request",
                                    							text: "Do you want to load again?",
                                    							icon: 'warning',
                                    							dangerMode: true,
                                    							allowOutsideClick: false,
                                                                closeOnClickOutside: false,
                                    							buttons: {
                                    							  cancel: 'No Cancel Old Request!',
                                    							  delete: 'Yes Please Load'
                                    							}
                                    							}).then(function (willDelete) {
                                    							if (willDelete) {
                                    						
                                    						      select_local_po(v_local_po_number);
                                                 						 
                                    							} else {
                                    							    
                                    							  cancel_local_po(v_local_po_number);
                                    							 
                                    							}
                                    				});
                                    
                                   
                               }
                        });
                } 
                         
                        
                                             
                    function select_local_po(v_local_po_number)
                    {
                         $.post("../controller/local_po/local_po_controller.php",{action:'select_local_po_pending_data',v_local_po_no:v_local_po_number},function(result,status){
                                var obj= jQuery.parseJSON(result); 
								//console.log(result);
								var v_jobname=obj.data[0].job_name;
								//console.log(v_jobname);
								var pnr_number=obj.data[0].prn_number;
								//console.log(pnr_number);
                                //$('#div_company_select option[value='+obj.data[0].company_id+']').prop('selected','selected');
                                $('#div_company_select option').map(function () {
                                if ($(this).text() == $.trim(obj.data[0].company_name)) return this;
                                }).attr('selected', 'selected');
                                $("#txt_local_po_company_name").val(obj.data[0].company_name);
                                $("#txt_local_po_po_box").val(obj.data[0].po_box);
                                $("#txt_local_po_contact_no").val(obj.data[0].telephone_no);
                                $("#txt_local_po_fax").val(obj.data[0].fax);
                                $("#txt_local_po_attn").val(obj.data[0].attn);
                                $("#txt_local_po_no").val(obj.data[0].local_po_number);
                                $("#txt_local_po_date").val(obj.data[0].local_po_date);
                                $("#txt_local_po_quotation_ref").val(obj.data[0].quotation_reference);
                                $('#txt_local_po_payment_terms').val(obj.data[0].payment_terms);
                                load_data_to_grid_local_po_list(obj.data[0].local_po_number);
                               
                              
                                $('#txt_local_po_vat').val(obj.data[0].less_discount);
                                $('#txt_local_po_total_amount').val(obj.data[0].total_amount);
                                $('#txt_local_po_discount').val(obj.data[0].vat);
                                $('#txt_local_po_balance_due').val(obj.data[0].balane_in_due);
                                $("#txt_local_po_all_description").val(obj.data[0].description);
								$('#div_job_num_select option').map(function () {
								 if ($(this).text() == obj.data[0].job_name) return this;
								 }).attr('selected', 'selected');
								$("#div_prno_select").load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1',v_jobNo:v_jobname,v_prnn_no:pnr_number},function(result,status){  
								if(status=="success")
								{
								
									$('#div_prno_select option').map(function () {
                                        if ($(this).text() == obj.data[0].prn_number) return this;
                                     }).attr('selected', 'selected');
								}
							
								});
                                $( '#btn_local_po_add' ).show();
                                $( '#btn_local_po_edit' ).hide();
                                
                                
                                $("#local_po_no_head").html(obj.data[0].local_po_number);
                                 $('#btn_generate_local_po' ).show();
                                 
                                
                             });
                        
                       
                        
                        
                    }
                   
                   
                    
                    function cancel_local_po(v_local_po_number)
                    {
                        
                        $.post("../controller/local_po/local_po_controller.php",{action:'cancel_local_po_list',v_local_po_no:v_local_po_number
                                                }
                                                , function(result,status)
                                                {
                                                   
                                                    
                         });
                       
                    }
   
                
                
                $('#txt_local_po_company_name,#txt_local_po_po_box').keypress(function (e) {
           
                    var str = $(this).val();
                    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                    
                    });
                    $(this).val(str);
        

               });
               
               $('#txt_local_po_quantity, #txt_local_po_amount,#txt_local_po_rate,#txt_discount_percentage,#txt_tax_percentage').on("keypress", function (e) {
               
                if (e.which != 8 && e.which != 0 && ((e.which < 48 || e.which > 57) && e.which != 46)) {
                    e.preventDefault();
                }
               });
                           
               $('#txt_local_po_contact_no,#txt_local_po_fax').keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       
                        e.preventDefault();
                        return false;
                    }
               });
               
               
                $('#txt_local_po_rate').change(function(){
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var tax_percentage= $('#txt_tax_percentage').val();
                    var discount_percentage= $('#txt_discount_percentage').val();
                    
                    
                
                      if(parseFloat(v_local_po_quantity) > 0 )
                     {
                    
                             var v_amount=(parseFloat(v_local_po_quantity)*parseFloat(v_local_po_rate)).toFixed(3);
                             $('#txt_local_po_amount').val(v_amount);
                             var local_po_amount=$('#txt_local_po_amount').val();
                             $('#txt_amt_after_discount').val(v_amount);
                             var amt_after_discount= $('#txt_amt_after_discount').val();
                             $('#txt_net_amount').val(v_amount);
                             
                              if(parseFloat(discount_percentage) > 0 )
                             {
                               
                               var discount_amount=parseFloat(local_po_amount)*(parseFloat(discount_percentage)/100);
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_amount);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                             
                             }
                             if(parseFloat(tax_percentage) > 0 )
                             {
                               
                               var tax_amount=parseFloat(amt_after_discount)*(parseFloat(tax_percentage)/100);
                               var amt_after_tax=parseFloat(amt_after_discount)+parseFloat(tax_amount);
                               $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                             
                             }
                     
                     }
                     else
                     {
                               $('#txt_local_po_amount').val(0.00);
                               $('#txt_amt_after_discount').val(0.00);
                               $('#txt_net_amount').val(0.00); 
                     }
                    
                     
                     
                 });
                 
                 
                  $('#txt_local_po_quantity').change(function(){
                      
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var tax_percentage= $('#txt_tax_percentage').val();
                    var discount_percentage= $('#txt_discount_percentage').val();
                    
                    
                
                      if(parseFloat(v_local_po_quantity) >= 0 )
                     {
                    
                             var v_amount=(parseFloat(v_local_po_quantity)*parseFloat(v_local_po_rate)).toFixed(3);
                             $('#txt_local_po_amount').val(v_amount);
                             var local_po_amount=$('#txt_local_po_amount').val();
                             $('#txt_amt_after_discount').val(v_amount);
                             var amt_after_discount= $('#txt_amt_after_discount').val();
                             $('#txt_net_amount').val(v_amount);
                              
                              if(parseFloat(discount_percentage) >= 0 )
                             {
                               
                               var discount_amount=parseFloat(local_po_amount)*(parseFloat(discount_percentage)/100);
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_amount);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                               
                             
                             }
                             if(parseFloat(tax_percentage) >= 0 )
                             {
                               
                               var tax_amount=parseFloat(amt_after_discount)*(parseFloat(tax_percentage)/100);
                               var amt_after_tax=parseFloat(amt_after_discount)+parseFloat(tax_amount);
                               $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                              
                             
                             }
                     
                     }
                    
                    
                     
                  });
                   $('#txt_discount_percentage').change(function(){
                        
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var tax_percentage= $('#txt_tax_percentage').val();
                    var discount_percentage= $('#txt_discount_percentage').val();
                    
                    
                
                      if(parseFloat(v_local_po_quantity) >= 0 )
                     {
                    
                             var v_amount=(parseFloat(v_local_po_quantity)*parseFloat(v_local_po_rate)).toFixed(3);
                             $('#txt_local_po_amount').val(v_amount);
                             var local_po_amount=$('#txt_local_po_amount').val();
                             $('#txt_amt_after_discount').val(v_amount);
                             var amt_after_discount= $('#txt_amt_after_discount').val();
                             $('#txt_net_amount').val(v_amount);
                              
                              if(parseFloat(discount_percentage) >= 0 )
                             {
                               
                               var discount_amount=parseFloat(local_po_amount)*(parseFloat(discount_percentage)/100);
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_amount);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                               
                             
                             }
                             if(parseFloat(tax_percentage) >= 0 )
                             {
                               
                               var tax_amount=parseFloat(amt_after_discount)*(parseFloat(tax_percentage)/100);
                               var amt_after_tax=parseFloat(amt_after_discount)+parseFloat(tax_amount);
                               $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                              
                             
                             }
                     
                     }
                   });
                   
                   
                   $('#txt_tax_percentage').change(function(){
                       
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var tax_percentage= $('#txt_tax_percentage').val();
                    var discount_percentage= $('#txt_discount_percentage').val();
                    
                    
                
                      if(parseFloat(v_local_po_quantity) >= 0 )
                     {
                    
                             var v_amount=(parseFloat(v_local_po_quantity)*parseFloat(v_local_po_rate)).toFixed(3);
                             $('#txt_local_po_amount').val(v_amount);
                             var local_po_amount=$('#txt_local_po_amount').val();
                             $('#txt_amt_after_discount').val(v_amount);
                             var amt_after_discount= $('#txt_amt_after_discount').val();
                             $('#txt_net_amount').val(v_amount);
                              
                              if(parseFloat(discount_percentage) >= 0 )
                             {
                               
                               var discount_amount=parseFloat(local_po_amount)*(parseFloat(discount_percentage)/100);
                               var amt_after_discount=parseFloat(local_po_amount)-parseFloat(discount_amount);
                               $('#txt_amt_after_discount').val(amt_after_discount);
                               $('#txt_net_amount').val(amt_after_discount);
                               
                             
                             }
                             if(parseFloat(tax_percentage) >= 0 )
                             {
                               
                               var tax_amount=parseFloat(amt_after_discount)*(parseFloat(tax_percentage)/100);
                               var amt_after_tax=parseFloat(amt_after_discount)+parseFloat(tax_amount);
                               $('#txt_net_amount').val(amt_after_tax.toFixed(3));
                              
                             
                             }
                     
                     }
                       
                   });
                  
                  
                
                v_but_local_po_save.click(function(){
                      
                 
                    v_but_local_po_save.ladda( 'start' );
                    
                    var v_local_po_company_name=$("#txt_local_po_company_name").val();
					var v_local_po_company_id=$("#txt_local_po_company_id").val();
                    var v_local_po_po_box=$("#txt_local_po_po_box").val();
                    var v_local_po_contact_no=$("#txt_local_po_contact_no").val();
                    var v_local_po_fax=$("#txt_local_po_fax").val();
                    //var v_local_po_attn=$("#txt_local_po_attn").val();
                    var v_local_po_no=$("#txt_local_po_no").val();
                    var v_local_po_date=formatDate($("#txt_local_po_date").val());
                    var v_local_po_quotation_ref=$("#txt_local_po_quotation_ref").val();
                    var v_local_po_payment=$('#txt_local_po_payment_terms').val();
                    
                    
                    
                    var v_local_po_description=$('#txt_local_po_description').val();
                    
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_unit=$('#txt_local_po_unit').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var v_local_po_amount=$('#txt_local_po_amount').val();
                    
                    var v_discount_percentage=$('#txt_discount_percentage').val();
                    var v_amt_after_discount=$('#txt_amt_after_discount').val();
                    var v_tax_percentage=$('#txt_tax_percentage').val();
					console.log(v_tax_percentage);
                    var v_net_amount=$('#txt_net_amount').val();
    //                 var job_ids = $('#select_supplier_jobNo option:selected').val();
				// 	console.log(job_ids);
				// 	var job_name = $('#select_supplier_jobNo option:selected').text();
				// 	console.log(job_name);
				// 	var prn_no = $('#select_PR_No option:selected').text();
			 //       console.log(prn_no);
			 
			   	var job_name = $("#txt_local_po_job_no").val();
			    var prn_no = $("#txt_purchase_reqsition_number").val();       
                    //alert(job_name+'------'+prn_no);
                  // alert(v_local_po_company_name+'----'+v_local_po_po_box+'----'+v_local_po_contact_no+'----'+v_local_po_fax+'-----'+v_local_po_date);
                  
            
                    if($.trim(v_local_po_company_name)==""||$.trim(v_local_po_company_id)==""||$.trim(v_local_po_po_box)==""||$.trim(v_local_po_contact_no)==""||$.trim(v_local_po_fax)==""||$.trim(v_local_po_date)==""||$.trim(v_local_po_quotation_ref)==""||$.trim(v_local_po_payment)==""||$.trim(v_local_po_description)==""||$.trim(v_local_po_quantity)==""||$.trim(v_local_po_unit)==""||$.trim(v_local_po_rate)==""||$.trim(v_local_po_amount)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_local_po_save.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/local_po/local_po_controller.php",{action:'add_local_po',v_local_po_company_name:v_local_po_company_name,v_company_id:v_local_po_company_id,v_local_po_po_box:v_local_po_po_box,v_local_po_contact_no:v_local_po_contact_no,v_local_po_fax:v_local_po_fax,v_local_po_no:v_local_po_no,v_local_po_date:v_local_po_date,v_local_po_quotation_ref:v_local_po_quotation_ref,v_local_po_payment:v_local_po_payment,v_local_po_description:v_local_po_description,v_local_po_quantity:v_local_po_quantity,v_local_po_unit:v_local_po_unit,v_local_po_rate:v_local_po_rate,v_local_po_amount:v_local_po_amount,v_discount_percentage:v_discount_percentage,v_amt_after_discount:v_amt_after_discount,v_tax_percentage:v_tax_percentage,v_net_amount:v_net_amount,v_job_name:job_name,v_prn_no:prn_no
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_local_po_save.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_local_po_list()
                                    clear_text()
                                   

                                
                                }
                                else 
                                {
                                     v_but_local_po_save.ladda( 'stop' );
                                    
                                     //swal("Success"," local_po added Successfully", "success");
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item added  successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                    
                                    
                                     $("#txt_local_po_no").val(result);
                                     $("#local_po_no_head").html(result);
                                     $("#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_no,#txt_local_po_date,#txt_local_po_quotation_ref,#txt_local_po_payment_terms").prop("readonly",true);
                                     
                                     
                                    load_data_to_grid_local_po_list(result);
                                   // load_supplier_select_box('div_company_select','select_company');
                                     $("#div_company_select").load('templates/supplier_combo.php');
                                    
                                     clear_text()
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
            
                
               
                      
                 function clear_text()
                 {
                     
                    $('#txt_local_po_description').val('');
                    $('#txt_local_po_quantity').val('');
                    $('#txt_local_po_unit').val('');
                    $('#txt_local_po_rate').val('');
                    $('#txt_local_po_amount').val('');
                   
                    $('#txt_discount_percentage').val('');
                    $('#txt_amt_after_discount').val('');
                    $('#txt_tax_percentage').val('');
                    $('#txt_net_amount').val('');
                   
                 }
            
            
               
            
                
            
            
                function load_data_to_grid_local_po_list(local_po_no)
                 {
                     local_po_list_table.destroy();
                         
                     local_po_list_table = $('#tbl_local_po_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/local_po/local_po_controller.php',
                                 'data': {
                                    action: 'list_local_po',
                                    v_local_po_no:local_po_no
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
            				"scrollY": 300,
                            "scrollX": true,
                            "scroller": true,
            			    "fixedHeader": {
                                header: false,
                               footer: false
                            },
                            "columns": [
                                 { "data": null },
                                 { "data": "local_po_child_id","visible":false },
                                 { "data": "local_po_no","visible":false },
                                 { "data": "description", width:"50%"},
                                 { "data": "quantity"},
                                 { "data": "unit"},
                                 { "data": "rate", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "discount_precentage",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 { "data": "discount_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 { "data": "vat_percentage", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "local_po_child_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_local_po" name="edit_local_po" ><i class="material-icons ">edit</i></button>';
            								
            								return str_active_status_view;
            
            							 },
            							 
            					

					 
					          },
            			      { "data": "local_po_child_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_local_po" name="delete_local_po" ><i class="material-icons ">delete</i></button>';
            								
            								return str_active_status_view;
            
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
                             "footerCallback": function ( row, data, start, end, display ) {
                            var api = this.api(), data;
                 
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                 
                            // Total over all pages Income
                            total1 = api
                                .column( 11 )
                                .data()
                                .reduce( function (a, b) {
                                    
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Total over this page Income
                            pageTotal1 = api
                                .column( 11, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Update footer
                            $( api.column( 11 ).footer() ).html(
                                pageTotal1.toFixed(3)
                            );
                            
                                   var v_local_po_discount=$('#txt_local_po_discount').val();
 
                                    if(parseFloat(v_local_po_discount)>0)
                                    {
                                    
                                    var total_amount=(parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_local_po_discount))/100)).toFixed(3);
                                    $('#txt_local_po_total_amount').val(total_amount);
                                    }
                                    
                                    var v_local_po_vat =$('#txt_local_po_vat').val();
                                    if(parseFloat(v_local_po_vat)>0)
                                    {
                                    
                                    var v_local_po_total_amount=$('#txt_local_po_total_amount').val(); 
                                   
                                    var balance_amount=(parseFloat(v_local_po_total_amount)+((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)).toFixed(3);
                                    $('#txt_local_po_balance_due').val(balance_amount);
                                    }
                                   
                           
                           
                        }
                        
                         
                     });  
                
                 }
                 
                 $('#txt_local_po_vat').change(function(){
                     
                     
                     var v_local_po_total_amount=$('#txt_local_po_total_amount').val(); 
                     var v_local_po_vat=$('#txt_local_po_vat').val();
                     var balance_amount=(parseFloat(v_local_po_total_amount)+((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)).toFixed(3);
                     $('#txt_local_po_balance_due').val(balance_amount);
                     
                     
                    
                     
                     
                 });
                 
                 $('#txt_local_po_discount').change(function(){
                     
                     var v_local_po_discount=$('#txt_local_po_discount').val();
                     var total_amount=(parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_local_po_discount))/100)).toFixed(3);
                     $('#txt_local_po_total_amount').val(total_amount);
                     var v_local_po_total_amount=$('#txt_local_po_total_amount').val();
                     
                     var v_local_po_vat=$('#txt_local_po_vat').val(); 
                     
                     if(v_local_po_vat>0)
                     {
                     
                     var balance_amount=(parseFloat(v_local_po_total_amount)+((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)).toFixed(3);
                     $('#txt_local_po_balance_due').val(balance_amount);
                     var v_local_po_balance_due= $('#txt_local_po_balance_due').val(); 
                     
                     }
                     
                     
                 }); 
                 
                 
                  $('#btn_generate_local_po').click(function(){
                 
                    var v_local_po_vat=$('#txt_local_po_vat').val();
                    var v_local_po_total_amount=$('#txt_local_po_total_amount').val();
                    var v_local_po_discount=$('#txt_local_po_discount').val();
                    var v_local_po_balance_due=$('#txt_local_po_balance_due').val();
                    var v_local_po_no=$("#txt_local_po_no").val();
                    var v_local_po_all_description=$("#txt_local_po_all_description").val();
                    const editorData = editor.getData();
                   
                    var v_local_po_all_description= editorData;
                    var v_local_po_sub_total=pageTotal1;
                    
                    if($.trim(v_local_po_all_description)=="")
                     {
                        swal("Warning"," Please Fill All The Fields ", "warning");
                        
                        
                     }
                     else
                     {
                       $.post("../controller/local_po/local_po_controller.php",{action:'generate_local_po',v_local_po_no:v_local_po_no,v_local_po_vat:v_local_po_vat,v_local_po_total_amount:v_local_po_total_amount,v_local_po_discount:v_local_po_discount,v_local_po_balance_due:v_local_po_balance_due,v_local_po_all_description:v_local_po_all_description,v_local_po_sub_total:v_local_po_sub_total
                                }
                               
                                , function(result,status)
                                {
                                  if(result=="success")
                                  {
                                    swal("Success"," LPO generated successfully", "success"); 
                                     $('#btn_generate_local_po').hide();
                                     $('#btn_edit_local_po').show();
                                   // clear_all_after_generate_local_po();
                                    $("#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_no,#txt_local_po_date,#txt_local_po_quotation_ref,#txt_local_po_payment_terms").prop("readonly",false);
                                     
                                  }
                                  else
                                  {
                                    swal("Error","Some Error Occurs...", "error"); 
                                    clear_all_after_generate_local_po(); 
                                  }
                          });
                     }
                  });
                  
                  
                
                 
                  
                 function clear_all_after_generate_local_po()
                 {
                   $('#txt_local_po_vat,#txt_local_po_total_amount,#txt_local_po_discount,#txt_local_po_balance_due,#txt_local_po_no,#txt_local_po_all_description,#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_quotation_ref,#txt_local_po_payment_terms,#txt_discount_percentage,#txt_amt_after_discount,#txt_tax_percentage,#txt_net_amount').val('');  
                   $("#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_no,#txt_local_po_date,#txt_local_po_quotation_ref,#txt_local_po_payment_terms").prop("readonly",false);
                   var local_po_no=0;
                   load_data_to_grid_local_po_list(local_po_no);
                 }
                 
                 
                 function load_data_to_grid_view_local_po_list()
                 {
                     local_po_view_list_table.destroy();
                         
                     local_po_view_list_table = $('#list_of_local_pos').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/local_po/local_po_controller.php',
                                 'data': {
                                    action: 'list_local_po_view',
                                    
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            					"bPaginate": false,
                    			"bLengthChange": true,
                    			"bFilter": true,
                    			"bInfo": true,
                    			"autoWidth": false,
                            "columns": [
                              
                                 { "data": "local_po_main_id","visible":false },
                                 { "data": "local_po_date"},
                                 { "data": "local_po_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                 { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_local_po" name="view_local_po" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
    					 
    					         },
    					         { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_local_po" name="delete_local_po" ><i class="material-icons ">delete</i></button>';
                								
                								return str_active_status_view;
                
                							 },
    					 
    					         },
             
             
                             ],
                             pageLength: 25,
            				 searching: false,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                                                      
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 }
                 
                  function load_data_to_grid_view_cancel_local_po_list()
                 {
                     local_po_view_cancelled_list_table.destroy();
                         
                     local_po_view_cancelled_list_table = $('#list_of_cancelled_local_pos').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/local_po/local_po_controller.php',
                                 'data': {
                                    action: 'list_cancelled_local_po_view',
                                    
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            					"bPaginate": false,
                    			"bLengthChange": true,
                    			"bFilter": true,
                    			"bInfo": true,
                    			"autoWidth": false,
                            "columns": [
                              
                                 { "data": "local_po_main_id","visible":false },
                                 { "data": "local_po_date"},
                                 { "data": "local_po_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                  { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="closeNavRCancel()" id="view_cancel_local_po" name="view_cancel_local_po" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
    					 
    					         }
             
                             ],
                             pageLength: 25,
            				 searching: false,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                                                      
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 }
                 
                 
                 function load_data_to_grid_view_local_po_list_between(v_local_po_from_date,v_local_po_to_date)
                 {
                      local_po_view_list_table.destroy();
                         
                     local_po_view_list_table = $('#list_of_local_pos').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/local_po/local_po_controller.php',
                                 'data': {
                                    action: 'list_local_po_view_between',
                                    v_local_po_from_date:v_local_po_from_date,
                                    v_local_po_to_date:v_local_po_to_date
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            					"bPaginate": false,
                    			"bLengthChange": true,
                    			"bFilter": true,
                    			"bInfo": true,
                    			"autoWidth": false,
                            "columns": [
                              
                                 { "data": "local_po_main_id","visible":false },
                                 { "data": "local_po_date"},
                                 { "data": "local_po_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                 { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_local_po" name="view_local_po" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
    					 
    					         },
    					         { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-2" onclick="openNavR()" id="delete_local_po" name="delete_local_po" ><i class="material-icons ">delete</i></button>';
                								
                								return str_active_status_view;
                
                							 },
    					 
    					         },
             
                             ],
                             pageLength: 25,
            				 searching: false,
                             //responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                               
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 
                 }
                 
                 
                 $('#btn_create_new_local_po').click(function(){
                  
                  location.reload();
                  
                 });
                 
                  function load_data_to_grid_view_cancel_local_po_list_between(v_local_po_from_date,v_local_po_to_date)
                 {
                      local_po_view_cancelled_list_table.destroy();
                         
                     local_po_view_cancelled_list_table = $('#list_of_cancelled_local_pos').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/local_po/local_po_controller.php',
                                 'data': {
                                    action: 'list_local_po_cancel_view_between',
                                    v_local_po_from_date:v_local_po_from_date,
                                    v_local_po_to_date:v_local_po_to_date
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
            				"scrollY": 300,
                            "scrollX": true,
                            "scroller": true,
            			    "fixedHeader": {
                                header: false,
                               footer: false
                            },
                            "columns": [
                              
                                 { "data": "local_po_main_id","visible":false },
                                 { "data": "local_po_date"},
                                 { "data": "local_po_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total"},
                                 { "data": "local_po_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="closeNavRCancel()" id="view_cancel_local_po" name="view_cancel_local_po" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
    					 
    					         }
             
                             ],
                             pageLength: 25,
            				 searching: false,
                            // responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                               
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 
                 }
                 
                 $('#list_of_cancelled_local_pos tbody').on('click', 'td button', function (){
                    
                        var $row = $(this).closest('tr');
                        var data = local_po_view_cancelled_list_table.row($row).data();
                        v_local_po_number  = data.local_po_number;
						var v_jobname=data.job_name;
						var pnr_number=data.prn_number;
						console.log(data.job_name);
						console.log(data.address);
                        $('#txt_local_po_description').val('');
                        $('#txt_local_po_quantity').val('');
                        $('#txt_local_po_unit').val('');
                        $('#txt_local_po_rate').val('');
                        $('#txt_local_po_amount').val('');
                        $( '#btn_local_po_add' ).show();
                        $( '#btn_local_po_edit' ).hide();   
                       if($(this).attr("name")=='view_cancel_local_po')
                         {
                   
                                 $('#div_company_select option').map(function () {
                                if ($(this).text() == data.company_name) return this;
                                }).attr('selected', 'selected');
                                  
                                $("#txt_local_po_company_name").val(data.company_name);
                                $("#txt_local_po_po_box").val(data.po_box);
                                $("#txt_local_po_contact_no").val(data.telephone_no);
                                $("#txt_local_po_fax").val(data.fax);
                                $("#txt_local_po_attn").val(data.attn);
                                $("#txt_local_po_no").val(data.local_po_number);
                                
                                var local_date=data.local_po_date.split(' ');
                                var local_po_date= local_date[0].split('-');
                                var local_po_date=local_po_date[1]+'/'+local_po_date[0]+'/'+local_po_date[2];
                                $("#txt_local_po_date").val(local_po_date);
                               
                                $("#txt_local_po_quotation_ref").val(data.quotation_reference);
                                $('#txt_local_po_payment_terms').val(data.payment_terms);
                                load_data_to_grid_local_po_list(data.local_po_number);
                                
                                $('#txt_local_po_quantity').val(data.quantity);
                                $('#txt_local_po_unit').val(data.unit);
                                $('#txt_local_po_rate').val(data.rate);
                                $('#txt_local_po_amount').val(data.amount);
                               
                              
                                $('#txt_discount_percentage').val(data.discount_precentage);
                                $('#txt_amt_after_discount').val(data.discount_amount);
                                $('#txt_tax_percentage').val(data.vat_percentage);
                                $('#txt_net_amount').val(data.net_amount);
                                
                                
                                
                                $("#txt_local_po_all_description").val(data.description);
                                //$( '#btn_local_po_add' ).hide();
                               // $( '#btn_local_po_edit' ).show();
                                
                                
                                $("#local_po_no_head").html(data.local_po_number);
								$('#div_job_num_select option').map(function () {
								 if ($(this).text() == data.job_name) return this;
								 }).attr('selected', 'selected');
								$("#div_prno_select").load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1',v_jobNo:v_jobname,v_prnn_no:pnr_number},function(result,status){  
								if(status=="success")
								{
								
									$('#div_prno_select option').map(function () {
                                        if ($(this).text() == data.prn_number) return this;
                                     }).attr('selected', 'selected');
								}
							
								});
                                // $('#btn_generate_local_po' ).hide();
                                 $('#btn_edit_local_po' ).hide();
                                 
                                
                                closeNavR();
                              
                     } 
                        
                       
                  
                   });
                 
                  $('#list_of_local_pos tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = local_po_view_list_table.row($row).data();
                        v_local_po_number  = data.local_po_number;
						var v_jobname=data.job_name;
						var pnr_number=data.prn_number;
						console.log(data.job_name);
						console.log(data.address);
                        $('#txt_local_po_description').val('');
                        $('#txt_local_po_quantity').val('');
                        $('#txt_local_po_unit').val('');
                        $('#txt_local_po_rate').val('');
                        $('#txt_local_po_amount').val('');
                        $( '#btn_local_po_add' ).show();
                        $( '#btn_local_po_edit' ).hide();   
                       if($(this).attr("name")=='view_local_po')
                         {
                   
                                $('#div_company_select option').map(function () {
                                if ($(this).text() == data.company_name) return this;
                                }).attr('selected', 'selected');
                                  // $('#select_company').val(data.company_id);
									// $('#select_company').trigger("chosen:updated");
                                $("#txt_local_po_company_name").val(data.company_name);
                                $("#txt_local_po_po_box").val(data.po_box);
                                $("#txt_local_po_contact_no").val(data.telephone_no);
                                $("#txt_local_po_fax").val(data.fax);
                                $("#txt_local_po_attn").val(data.attn);
                                $("#txt_local_po_no").val(data.local_po_number);
                                
                                var local_date=data.local_po_date.split(' ');
                                var local_po_date= local_date[0].split('-');
                                var local_po_date=local_po_date[1]+'/'+local_po_date[0]+'/'+local_po_date[2];
                                $("#txt_local_po_date").val(local_po_date);
                                
                                $("#txt_local_po_quotation_ref").val(data.quotation_reference);
                                $('#txt_local_po_payment_terms').val(data.payment_terms);
                                
                                $("#txt_local_po_job_no").val(data.job_name);
                                $('#txt_purchase_reqsition_number').val(data.prn_number);
                                
                                load_data_to_grid_local_po_list(data.local_po_number);
                                
                                $('#txt_local_po_quantity').val(data.quantity);
                                $('#txt_local_po_unit').val(data.unit);
                                $('#txt_local_po_rate').val(data.rate);
                                $('#txt_local_po_amount').val(data.amount);
                               
                                
                                $('#txt_discount_percentage').val(data.discount_precentage);
                                $('#txt_amt_after_discount').val(data.discount_amount);
                                $('#txt_tax_percentage').val(data.vat_percentage);
                                $('#txt_net_amount').val(data.net_amount);
								$('#div_job_num_select option').map(function () {
								 if ($(this).text() == data.job_name) return this;
								 }).attr('selected', 'selected');
								$("#div_prno_select").load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1',v_jobNo:v_jobname,v_prnn_no:pnr_number},function(result,status){  
								if(status=="success")
								{
								
									$('#div_prno_select option').map(function () {
                                        if ($(this).text() == data.prn_number) return this;
                                     }).attr('selected', 'selected');
								}
							
								});
								const editorData_lpo = editor.setData(data.description);
                                $("#txt_local_po_all_description").val(editorData_lpo); 
                                //$( '#btn_local_po_add' ).hide();
                               // $( '#btn_local_po_edit' ).show();
                                
                                
                                $("#local_po_no_head").html(data.local_po_number);
                                 $('#btn_generate_local_po' ).hide();
                                 $('#btn_edit_local_po' ).show();
                                 
                                
                                closeNavR();
                              
                     }
                      if($(this).attr("name")=='delete_local_po')
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
            						
            						       cancel_local_po(v_local_po_number);
                         				    load_data_to_grid_view_local_po_list(); 
                         				
            							} else {
            							    
            							   
            							 
            							}
            						 });
                     }			 
                     
                     
                      
                  });
                 

                 
                 $("#txt_end_date").on("change", function() {
                     var v_local_po_from_date = formatDate($("#txt_start_date").val());
                     var v_local_po_to_date = formatDate($("#txt_end_date").val());
                     load_data_to_grid_view_local_po_list_between(v_local_po_from_date,v_local_po_to_date);
                   
                  });
                  
                  
                  
                 
                                 
                //  $('#list_of_local_pos tbody').on('dblclick', 'tr', function(){
                //         var $row = $(this).closest('tr');
                //         var data = local_po_view_list_table.row($row).data();
                //         v_local_po_number  = data.local_po_number;
                //         $('#txt_local_po_description').val('');
                //         $('#txt_local_po_quantity').val('');
                //         $('#txt_local_po_unit').val('');
                //         $('#txt_local_po_rate').val('');
                //         $('#txt_local_po_amount').val('');
                //         $( '#btn_local_po_add' ).show();
                //         $( '#btn_local_po_edit' ).hide();
                //          swal("Do you want to Edit or Delete?", {
                //                       buttons: {
                //                         cancel: "Cancel",
                //                         catch: {
                //                           text: "Edit",
                //                           value: "catch",
                //                         },
                //                         defeat: {
                //                           text: "Delete",
                //                           value: "delete",
                //                         },
                //                       },
                //                     })
                //                     .then((value) => {
                //                       switch (value) {
                                     
                //                         case "delete":
                //                                                  swal({
                                                                    
                //                         							title: "Are you sure?",
                //                         							text: "Do you want to delete the entry?",
                //                         							icon: 'warning',
                //                         							dangerMode: true,
                //                         							allowOutsideClick: false,
                //                                                     closeOnClickOutside: false,
                //                         							buttons: {
                //                         							  cancel: 'No Cancel !',
                //                         							  delete: 'Yes Please Delete'
                //                         							}
                //                         							}).then(function (willDelete) {
                //                         							if (willDelete) {
                                        						
                //                         						       cancel_local_po(v_local_po_number);
                                                     						 
                //                         							} else {
                                        							    
                                        							   
                                        							 
                //                         							}
                //                         						 });
                //                           break;
                                     
                //                           case "catch":
                                          
                //                           //swal("Edit!", "Please Edit your data", "success");
                //                           edit_data();
                //                           closeNavR();
                                          
                //                           break;
                                     
                //                         default:
                //                           //swal("Got away safely!");
                //                       }
                            
                //       });    
                        
                //      function  edit_data() 
                //       {
                           
                //          $('#div_company_select option').map(function () {
                //         if ($(this).text() == data.company_name) return this;
                //         }).attr('selected', 'selected');
                          
                //         $("#txt_local_po_company_name").val(data.company_name);
                //         $("#txt_local_po_po_box").val(data.po_box);
                //         $("#txt_local_po_contact_no").val(data.telephone_no);
                //         $("#txt_local_po_fax").val(data.fax);
                //         $("#txt_local_po_attn").val(data.attn);
                //         $("#txt_local_po_no").val(data.local_po_number);
                //         var local_date=data.local_po_date.split(' ');
                //         var local_po_date= local_date[0].split('-');
                //         var local_po_date=local_po_date[1]+'/'+local_po_date[0]+'/'+local_po_date[2];
                //         $("#txt_local_po_date").val(local_po_date);
                        
                //         $("#txt_local_po_quotation_ref").val(data.quotation_reference);
                //         $('#txt_local_po_payment_terms').val(data.payment_terms);
                //         load_data_to_grid_local_po_list(data.local_po_number);
                       
                      
                //         $('#txt_local_po_vat').val(data.vat);
                //         $('#txt_local_po_total_amount').val(data.total_amount);
                //         $('#txt_local_po_discount').val(data.less_discount);
                //         $('#txt_local_po_balance_due').val(data.balane_in_due);
                        
                        
                //          const editorData = editor.setData(data.description);
                //          $("#txt_local_po_all_description").val(editorData);
                //       // $("#txt_local_po_all_description").val(data.description);
                //         //$( '#btn_local_po_add' ).hide();
                //       // $( '#btn_local_po_edit' ).show();
                        
                        
                //         $("#local_po_no_head").html(data.local_po_number);
                //          $('#btn_generate_local_po' ).hide();
                //          $('#btn_edit_local_po' ).show();
                         
                        
                //         closeNavR();
                //       }  
                        
                //  });
                 
                
                 
                  $('#tbl_local_po_list tbody').on('click', 'td button', function (){
                   
                        var $row = $(this).closest('tr');
                        var data = local_po_list_table.row($row).data();
                        v_local_po_number  = data.local_po_no;
						// var v_job_ids = data.job_ids;
						// console.log(v_job_ids);
						
                        $("#txt_local_po_child_id").val(data.local_po_child_id);
                       v_local_po_child_id  = data.local_po_child_id;
                        if($(this).attr("name")=='edit_local_po')
                         {
                                $('#txt_local_po_description').val(data.description);
                                $('#txt_local_po_quantity').val(data.quantity);
                                $('#txt_local_po_unit').val(data.unit);
                                $('#txt_local_po_rate').val(data.rate);
                                $('#txt_local_po_amount').val(data.amount);
                               
                              
                                $('#txt_discount_percentage').val(data.discount_precentage);
                                $('#txt_amt_after_discount').val(data.discount_amount);
                                $('#txt_tax_percentage').val(data.vat_percentage);
                                $('#txt_net_amount').val(data.net_amount); 
								
								// $('#select_supplier_jobNo option').map(function () {
								 // if ($(this).text() == v_job_ids) return this;
								 // }).attr('selected', 'selected');
										
								//$('#select_supplier_jobNo').val(data.job_ids);
			                    //$('#select_supplier_jobNo').trigger('change');
                             
                         }
                        if($(this).attr("name")=='delete_local_po')
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
            						
            						       cancel_local_po_list(v_local_po_child_id);
                         				    load_data_to_grid_local_po_list(v_local_po_number);		 
            							} else {
            							    
            							   
            							 
            							}
            						 }); 
                             
                             
                         }
                        $( '#btn_local_po_add' ).hide();
                        $( '#btn_local_po_edit' ).show();
                      
                  });
                  
                 function cancel_local_po_list(v_local_po_child_id)
                  {
                      
                           $.post("../controller/local_po/local_po_controller.php",{action:'delete_local_item',v_local_po_child_id:v_local_po_child_id
                           } , function(result,status){
                               //var local_po_no=  $("#txt_local_po_no").val();
                               // load_data_to_grid_local_po_list(local_po_no);
                               //load_data_to_grid_local_po_list_print(local_po_no);
                               
                           });
                           
                      
                      
                  }
                  
                  v_but_local_po_edit.click(function(){
                      
                 
                    v_but_local_po_edit.ladda( 'start' );
                    var v_local_po_child_id=$("#txt_local_po_child_id").val();
                    var v_local_po_company_name=$("#div_company_select option:selected").text();
                    //var v_local_po_company_name=$("#txt_local_po_company_name").val();
                    var v_local_po_po_box=$("#txt_local_po_po_box").val();
                    var v_local_po_contact_no=$("#txt_local_po_contact_no").val();
                    var v_local_po_fax=$("#txt_local_po_fax").val();
                    //var v_local_po_attn=$("#txt_local_po_attn").val();
                    var v_local_po_no=$("#txt_local_po_no").val();
                    var v_local_po_date=formatDate($("#txt_local_po_date").val());
                    var v_local_po_quotation_ref=$("#txt_local_po_quotation_ref").val();
                    var v_local_po_payment=$('#txt_local_po_payment_terms').val();
                    
                     
                    
                    var v_local_po_description=$('#txt_local_po_description').val();
                    
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_unit=$('#txt_local_po_unit').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var v_local_po_amount=$('#txt_local_po_amount').val();
                    
                    var v_local_po_discount=$('#txt_local_po_discount').val();
                    var total_amount=(parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_local_po_discount))/100)).toFixed(3);
                    $('#txt_local_po_total_amount').val(total_amount);
                    var v_local_po_total_amount=$('#txt_local_po_total_amount').val();
                    
                     var v_local_po_vat=$('#txt_local_po_vat').val();
                     var balance_amount=(((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)+parseFloat(v_local_po_total_amount)).toFixed(3);
                     $('#txt_local_po_balance_due').val(balance_amount);
                     var v_local_po_balance_due= $('#txt_local_po_balance_due').val();
                    
                    var v_discount_percentage=$('#txt_discount_percentage').val();
                    var v_amt_after_discount=$('#txt_amt_after_discount').val();
                    var v_tax_percentage=$('#txt_tax_percentage').val();
                    var v_net_amount=$('#txt_net_amount').val();
					// var job_ids = $('#select_supplier_jobNo option:selected').val();
					// console.log(job_ids);
					// var job_name = $('#select_supplier_jobNo option:selected').text();
					// console.log(job_name);
					// var prn_no = $('#select_PR_No option:selected').text();
			        // console.log(prn_no);
                     
                     
                     var v_local_po_balance_due=$('#txt_local_po_balance_due').val();
                     
                      const editorData = editor.getData();
                   
                      var v_local_po_all_description= editorData;
                     //var v_local_po_all_description=$("#txt_local_po_all_description").val();
                     var v_local_po_sub_total=pageTotal1;
                  
            
                    if($.trim(v_local_po_company_name)==""||$.trim(v_local_po_po_box)==""||$.trim(v_local_po_contact_no)==""||$.trim(v_local_po_fax)==""||$.trim(v_local_po_date)==""||$.trim(v_local_po_payment)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_local_po_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/local_po/local_po_controller.php",{action:'edit_local_po_list',v_local_po_description:v_local_po_description,v_local_po_quantity:v_local_po_quantity,v_local_po_unit:v_local_po_unit,v_local_po_rate:v_local_po_rate,v_local_po_amount:v_local_po_amount,v_local_po_child_id:v_local_po_child_id,v_discount_percentage:v_discount_percentage,v_amt_after_discount:v_amt_after_discount,v_tax_percentage:v_tax_percentage,v_net_amount:v_net_amount
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_local_po_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_local_po_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_but_local_po_edit.ladda( 'stop' );
                                    
                                     //swal("Success"," local_po added Successfully", "success");
                                    $.toast({
                                        heading: 'Success',
                                        text: 'Local PO edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_local_po_add' ).show();
                                     $( '#btn_local_po_edit' ).hide();
                                     //$("#txt_local_po_no").val(result);
                                     //$("#txt_local_po_company_name,#txt_local_po_po_box,#txt_local_po_contact_no,#txt_local_po_fax,#txt_local_po_attn,#txt_local_po_no,#txt_local_po_date,#txt_local_po_quotation_ref,#txt_local_po_payment_terms").prop("readonly",true);
                                     
                                     
                                    load_data_to_grid_local_po_list( v_local_po_no);
								//	load_supplier_select_box('div_company_select','select_company');
									$("#div_company_select").load('templates/supplier_combo.php');
                                    clear_text()
                                    
                                }
                            
                        }); 
                     }
            
                   
                });
                
                
                
                $('#btn_edit_local_po').click(function(){
                    var v_local_po_child_id=$("#txt_local_po_child_id").val();
                    
                    var v_local_po_company_name=$("#div_company_select option:selected").text();
                   // var v_local_po_company_name=$("#txt_local_po_company_name").val();
                    var v_local_po_po_box=$("#txt_local_po_po_box").val();
                    var v_local_po_contact_no=$("#txt_local_po_contact_no").val();
                    var v_local_po_fax=$("#txt_local_po_fax").val();
                    //var v_local_po_attn=$("#txt_local_po_attn").val();
                    var v_local_po_no=$("#txt_local_po_no").val();
                    var v_local_po_date=formatDate($("#txt_local_po_date").val());
                    var v_local_po_quotation_ref=$("#txt_local_po_quotation_ref").val();
                    var v_local_po_payment=$('#txt_local_po_payment_terms').val();
              
                    var v_local_po_description=$('#txt_local_po_description').val();
                    var v_local_po_quantity=$('#txt_local_po_quantity').val();
                    var v_local_po_unit=$('#txt_local_po_unit').val();
                    var v_local_po_rate=$('#txt_local_po_rate').val();
                    var v_local_po_amount=$('#txt_local_po_amount').val();
				// 	var job_ids = $('#select_supplier_jobNo option:selected').val();
				// 	console.log(job_ids);
				// 	var job_name = $('#select_supplier_jobNo option:selected').text();
				// 	console.log(job_name);
				// 	var prn_no = $('#select_PR_No option:selected').text();
			 //       console.log(prn_no);
			 
			 
			       var job_name = $("#txt_local_po_job_no").val();
			       var prn_no = $("#txt_purchase_reqsition_number").val();    
                    
					var v_local_po_all_description = $('#txt_local_po_all_description').val();
					const editorData = editor.getData();
                    v_local_po_all_description= editorData;
					
					
                    var v_local_po_discount=$('#txt_local_po_discount').val();
                    var total_amount=(+parseFloat(pageTotal1)-((parseFloat(pageTotal1)*parseFloat(v_local_po_discount))/100)).toFixed(3);
                    $('#txt_local_po_total_amount').val(total_amount);
                     var v_local_po_total_amount=$('#txt_local_po_total_amount').val();
                    
                     var v_local_po_vat=$('#txt_local_po_vat').val();
                     var balance_amount=(((parseFloat(v_local_po_total_amount)*parseFloat(v_local_po_vat))/100)+parseFloat(v_local_po_total_amount)).toFixed(3);
                     $('#txt_local_po_balance_due').val(balance_amount);
                     var v_local_po_balance_due=$('#txt_local_po_balance_due').val();
                     
                    
                     
                    // var v_local_po_all_description=$("#txt_local_po_all_description").val();
                     var v_local_po_sub_total=pageTotal1;
                  
                   //alert(v_local_po_company_name+'----'+v_local_po_po_box+'------'+v_local_po_contact_no+'-----'+v_local_po_fax+'_-------'+v_local_po_date+'-------'+v_local_po_quotation_ref+'--------'+v_local_po_payment+'__-----'+v_local_po_all_description);
            
                    if($.trim(v_local_po_company_name)==""||$.trim(v_local_po_po_box)==""||$.trim(v_local_po_contact_no)==""||$.trim(v_local_po_fax)==""||$.trim(v_local_po_date)==""||$.trim(v_local_po_quotation_ref)==""||$.trim(v_local_po_payment)==""||$.trim(v_local_po_all_description)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_local_po_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/local_po/local_po_controller.php",
						 {action:'edit_local_po', v_local_po_company_name:v_local_po_company_name, v_local_po_po_box:v_local_po_po_box, v_local_po_contact_no:v_local_po_contact_no, v_local_po_fax:v_local_po_fax, v_local_po_no:v_local_po_no, v_local_po_description:v_local_po_description, v_local_po_date:v_local_po_date, v_local_po_quotation_ref:v_local_po_quotation_ref, v_local_po_payment:v_local_po_payment, v_local_po_all_description:v_local_po_all_description, v_local_po_sub_total:v_local_po_sub_total, v_local_po_child_id:v_local_po_child_id,v_job_name:job_name,v_prn_no:prn_no}, 
						 function(result,status)
                                {
                                   
                                result = $.trim(result);
                               console.log("console is "+result);
                                if(result.charAt(0)=='U')
                                {
                                    v_but_local_po_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_local_po_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_but_local_po_edit.ladda( 'stop' );
                                    
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item edited successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_local_po_add' ).show();
                                     $( '#btn_local_po_edit' ).hide();
                                    
                                    load_data_to_grid_local_po_list( v_local_po_no);
                                     clear_text()
                                    
                                }
                            
                        }); 
                     }
            
                    
                    
                });        
                
                  
                 
                $('#btn_local_po_print').click(function(){
                    var local_po_number=$('#txt_local_po_no').val();
                   
                    if($.trim(local_po_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/local_po/local_po_controller.php",{action:'local_po_status',v_local_po_no:local_po_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_local_po_status=obj.data[0].local_po_status;
                       if(v_local_po_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/local_po_print.php?local_po_number="+local_po_number,"_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                    
                });
                
                      
                 $('#btn_local_po_print_without_head').click(function(){
                     
                      var local_po_number=$('#txt_local_po_no').val();
                   
                    if($.trim(local_po_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/local_po/local_po_controller.php",{action:'local_po_status',v_local_po_no:local_po_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_local_po_status=obj.data[0].local_po_status;
                       if(v_local_po_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/pdf/print/lpo.php?local_po_number="+local_po_number+"&x=1","_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                       
                       
                      
                 });
                  
                 $('#btn_local_po_print_with_head').click(function(){
                      var local_po_number=$('#txt_local_po_no').val();
                   
                    if($.trim(local_po_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/local_po/local_po_controller.php",{action:'local_po_status',v_local_po_no:local_po_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_local_po_status=obj.data[0].local_po_status;
                       if(v_local_po_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/pdf/print/lpo.php?local_po_number="+local_po_number+"&x=0","_blank"); 
                       }
                       
                       });
                      
                       
                    }
					        
                 }); 
                
                   $('#btn_local_po_export_excel').click(function(){

                      var local_po_number=$('#txt_local_po_no').val();
                   
                    if($.trim(local_po_number)=="")
                    {
                         $.toast({  
                                        heading: 'Error',
                                        text: 'Please select or create LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/local_po/local_po_controller.php",{action:'local_po_status',v_local_po_no:local_po_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_local_po_status=obj.data[0].local_po_status;
                       if(v_local_po_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate LPO ',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/local_po_print_with_head.php?local_po_number="+local_po_number+"&x=0","_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                    
                     
                 });  
                    
             
                  $('#btn_search_cancel_date').click(function(){
                     var v_local_po_from_date = formatDate($("#txt_cancel_start_date").val());
                     var v_local_po_to_date = formatDate($("#txt_cancel_end_date").val());
                     load_data_to_grid_view_cancel_local_po_list_between(v_local_po_from_date,v_local_po_to_date);
                  });


                    $('#btn_search_date').click(function(){
                     var v_local_po_from_date = formatDate($("#txt_start_date").val());
                     var v_local_po_to_date = formatDate($("#txt_end_date").val());
                    load_data_to_grid_view_local_po_list_between(v_local_po_from_date,v_local_po_to_date);
                   
                  });
                
                  
                 $('#btn_view_list_of_local_po').click(function(){
                    
                    var v_start_date_year= new Date().getFullYear();
                    $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
                    load_data_to_grid_view_local_po_list(); 
                     
                 });     
                 
                  $('#btn_view_list_of_cancelled_LPO').click(function(){
                    	var v_start_date_year= new Date().getFullYear();
                    $("#txt_cancel_start_date").val('01'+'/'+'01'+'/'+v_start_date_year); 
				
                   load_data_to_grid_view_cancel_local_po_list();
                     
                 });   
	            	$("#div_prno_select").load('../controller/purchase_recieve/purchase_rec_controller.php',{action:'select_pr_no_v1',v_prnn_no:'0'},function(result,status){  
								
							
								});
                 
                  

});