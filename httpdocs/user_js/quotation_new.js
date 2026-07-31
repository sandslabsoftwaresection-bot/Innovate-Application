$(document).ready(function(){
   var flag;
                var v_but_quotation_save = $( '#btn_quotation_add' ).ladda();
                var v_but_quotation_edit = $( '#btn_quotation_edit' ).ladda();
                var attn_save = $('#btn_attn_save').ladda();
                var v_btn_generate_product_master = $( '#btn_generate_product_master' ).ladda();
                var v_project_name,v_project_id;
                var quotation_list_table = $('#tbl_quotation_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
                var quotation_view_list_table = $('#list_of_quotations').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                var quotation_view_cancel_list_table = $('#list_of_cancel_quotations').DataTable( {searching: false, paging: false, info: false,"ordering": false});
                var quotation_view_list_company = $('#list_of_quotations_company').DataTable( {searching: false, paging: false, info: false,"ordering": false });
                
                
                 $("#txt_quotation_total_amount_edit").val('');
                $("#txt_quotation_total_amount_edit").hide();
                $('#div_product_combo').load('templates/product_combo.php');
                $('#div_company_select').load('templates/company_combo.php');
                $('#div_company_select_list').load('templates/company_combo.php');
                
                $('#list_of_cancel_quotations').removeClass( 'display' ).addClass('table table-striped table-bordered');                
                $('#tbl_quotation_list').removeClass( 'display' ).addClass('table table-striped table-bordered');
                $('#list_of_quotations').removeClass( 'display' ).addClass('table table-striped table-bordered');
                $('#tbl_quotation_list tbody').on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) { $(this).removeClass('selected'); } else { quotation_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                  }); 
                 $('#list_of_quotations tbody').on( 'click', 'tr', function () {
                    if ( $(this).hasClass('selected') ) 
					{ $(this).removeClass('selected'); 
				} 
				else { 
					quotation_view_list_table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
                 }); 
                 
                 $( '#btn_quotation_edit' ).hide();
                 $('#btn_edit_quotation' ).hide();   
                 check_pending_quotation();
                 
                // load_company_select_box('div_company_select','select_company');
                 
                 load_subject_combo('div_subject_combo','subject_combo');
                 
             
                   function load_company_select_box(div_name,ctrl_name)
                        { 
      
                   $("#"+div_name).load('../controller/quotation_new/quotation_new_controller.php',{action:'select_company_name',v_ctrl_name:ctrl_name},function(result,status){});
        
                        }    
                        
                        
                    function load_subject_combo(div_name,ctrl_name)
                        
                        {
                            $("#"+div_name).load('../controller/quotation_new/quotation_new_controller.php',{action:'select_subject',v_ctrl_name:ctrl_name},function(result,status){});
                            
                        }
                        
                     $("#div_project_select_combo").change(function() { 
                         var v_project_id=$('option:selected', this).val() ;
                        
                         $.post("../controller/quotation_new/quotation_new_controller.php",{action:'select_vat_content',v_project_id:v_project_id},function(result,status){
                           
                           var obj= jQuery.parseJSON(result);
                           $("#txt_tax_content").val(obj.data[0].tax_content); 
                           $("#txt_project_no").val(obj.data[0].project_number); 
                      }); 
                         
                     }); 
                        
                        
                    $("#div_product_combo").change(function() {
                        
                        var product_id=$('option:selected', this).val();
                     
                      $.post("../controller/quotation_new/quotation_new_controller.php",{action:'select_product_details',v_product_id:product_id},function(result,status){
                           
                           var obj= jQuery.parseJSON(result);
                           
                           $("#txt_quotation_new_unit option:selected").text(obj.data[0].product_unit_name); 
                           $("#txt_quotation_new_rate").val(obj.data[0].product_rate);
                           theEditor.setData(obj.data[0].product_description);
                           
                          
                      });
                      
                    });
                    let editor1;
                
                        ClassicEditor
                            .create( document.querySelector( '#txt_product_description' ) )
                            .then( newEditor => {
                                editor1 = newEditor;
                            } )
                            .catch( error => {
                                console.error( error );
                            } );
                    
                    $("#btn_add_product").click(function(){
                        $("#modal_product_add").modal('show');
                    });   
                    
        v_btn_generate_product_master.click(function(){
                      
                 
                    v_btn_generate_product_master.ladda( 'start' );
                    
                    var v_product_name=$("#txt_product_name").val();
                    var v_product_unit_id=$("#select_product_unit option:selected").val();
                    var v_product_unit_name=$("#select_product_unit option:selected").text();
                    var v_unit_rate=$("#txt_unit_rate").val();
                   
                    const editorData1 = editor1.getData();
                   
                    var v_product_description= editorData1;
                  console.log(v_product_description);
                    if($.trim(v_product_name)=="" || $.trim(v_product_unit_id)=="0" || $.trim(v_unit_rate)=="" || $.trim(v_product_description)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_btn_generate_product_master.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/master_product/master_product_controller.php",{action:'generate_master_product',v_product_name:v_product_name,v_product_unit_id:v_product_unit_id,v_product_unit_name:v_product_unit_name,v_unit_rate:v_unit_rate,v_product_description:v_product_description
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                              console.log(result);
                                if(result.charAt(0)=='U')
                                {
                                    v_btn_generate_product_master.ladda( 'stop' );
                                    swal("Error", result, "error");
                                   
                                }
                                else 
                                {
                                     v_btn_generate_product_master.ladda( 'stop' );
                                    $('#div_product_combo').load('templates/product_combo.php');
                                   
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item added to master product Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     
                                }
                                
                                 $("#txt_product_name").val("");
                                     $("#select_product_unit").val("");
                                    
                                    $("#txt_unit_rate").val("");
                                    const editorData = editor1.setData('');
                               
                                     var v_product_description= editorData;
                                   
                                    $("#txt_product_description").val(v_product_description);
                                    $("#modal_product_add").modal('hide');
                            
                        });
                        
                       
                        
                     }
                  
        });
            
                        
                   $("#div_subject_combo").change(function() {
                       
                      var subject_id=$('option:selected', this).val();
                     
                      $.post("../controller/quotation_new/quotation_new_controller.php",{action:'select_subject_details',v_subject_id:subject_id},function(result,status){
                           var obj= jQuery.parseJSON(result);
                        
                           $("#txt_subject").val(obj.data[0].subject_text); 
                          
                      });
                       
                       
                   });    
                        
                  $("#div_company_select").change(function() {
                      
                    $('#txt_quotation_company_name').val($('option:selected', this).text()) ;
                    var company_id=$('option:selected', this).val() ;
                    
                    $.post("../controller/quotation_new/quotation_new_controller.php",{action:'select_company_details',v_company_id:company_id},function(result,status){
                        
                                if(status=="success")
                                {
                                    
                                var obj= jQuery.parseJSON(result);
                                $("#txt_quotation_company_id").val(obj.data[0].company_id);
                                $("#txt_quotation_company_name").val(obj.data[0].company_name);
                                //$("#txt_quotation_po_box").val(obj.data[0].city);
                                $("#txt_quotation_po_box").val(obj.data[0].contact_address_1);
                                $("#txt_quotation_contact_no").val(obj.data[0].contact_phone);
                                $("#txt_quotation_fax").val(obj.data[0].fax);
                                $("#txt_quotation_attn").val(obj.data[0].contact_person);
                                $("#div_project_select_combo").load('../controller/quotation_new/quotation_new_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                            
                               });
                                
                                }
                                else
                                {
                                    return false;
                                }
                    });           
                   
                 });
               
                 
                // **********************update attr*******************************
                
                $('#btn_add_attr').click(function(){
                    var company_id=$("#select_company option:selected").val();
                    
                    if(company_id==0){
                        swal("Warning","Please Select Company name ....", "warning");
                    }
                    else{
                        var v_attn = $("#txt_quotation_attn").val();
                        $("#txt_attn_name").val(v_attn);
                        $("#update_attn").modal('show');
                    }
                   
                });   
                
                // ************************end*****************************************
                //  ********************************attn modal save********************
                $('#btn_attn_save').click(function(){
                    attn_save.ladda('start');
                    var company_id=$("#select_company option:selected").val();
                    var v_attn = $("#txt_attn_name").val();
                    $.post("../controller/quotation_new/quotation_new_controller.php",{action:'update_attn',v_attn:v_attn,v_company_id:company_id},function(result,status){
                        
                        attn_save.ladda('stop');
                        swal("Success","Attn Updated Successfully ....", "success");
                        $("#update_attn").modal('hide');
                        $("#txt_quotation_attn").val(v_attn);
                    });
                });
                
                
                // **************************end******************************
                 
                 
                 
                 let editor;
                
               
                        // ClassicEditor
                        //     .create( document.querySelector( '#editor2' ) )
                        //     .then( newEditor => {
                        //         editor = newEditor;
                                
                        //     } )
                        //     .catch( error => {
                        //         console.error( error );
                        //     } );
                         
                     //let editor_bottom;
                     
                     
              ClassicEditor
                .create( document.querySelector( '#editor2' ), {
                    alignment: {
                        options: [
                           'left' , 'right'
                        ]
                    },
                    toolbar: [ 'bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList','alignment' ]
                } )
                 .then( newEditor => {
                                editor = newEditor;
                                
                            } )
                .catch( error => {
                    console.log( error );
                } );
                
                
               let theEditor;

                    ClassicEditor
                         .create( document.querySelector( '#editor1' ), {
                    toolbar: [ 'bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList' ,'alignment:right']
                } )
                        .then( editor => {
                            theEditor = editor; // Save for later use.
                        } )
                        .catch( error => {
                            console.error( error );
                        } );
                        
                        // ClassicEditor
                        //     .create( document.querySelector( '#editor1' ) )
                        //     .then( newEditor => {
                        //         editor = newEditor;
                        //     } )
                        //     .catch( error => {
                        //         console.error( error );
                        //     } );  
                      
               function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
                function check_pending_quotation()
                    {
                        
                         $.post("../controller/quotation_new/quotation_new_controller.php",{action:'check_quotation_status'},function(result,status){
                               var obj= jQuery.parseJSON(result);
                               var v_quotation_count=obj.data[0].quotation_count;
                               var v_quotation_id=obj.data[0].quotation_main_id;
                               var v_quotation_number=obj.data[0].quotation_number;
                               
                               if(v_quotation_count>0)
                                {
                                            swal({
                                                                
                                    							title: "You have an uncompleted quotation request",
                                    							text: "Do you want to load again?",
                                    							icon: 'warning',
                                    							dangerMode: true,
                                    							allowOutsideClick: false,
                                                                closeOnClickOutside: false,
                                    							buttons: {
                                    							  cancel: 'No cancel old request!',
                                    							  delete: 'Yes please load'
                                    							}
                                    							}).then(function (willDelete) {
                                    							if (willDelete) {
                                    						
                                    						      select_quotation(v_quotation_number);
                                                 						 
                                    							} else {
                                    							    
                                    							  cancel_quotation(v_quotation_number);
                                    							 
                                    							}
                                    				});
                                    
                                   
                               }
                        });
                } 
                         
                        
                                             
                    function select_quotation(v_quotation_number)
                    {
                         
                         $.post("../controller/quotation_new/quotation_new_controller.php",{action:'select_quotation_pending_data',v_quotation_no:v_quotation_number},function(result,status){
                                var obj= jQuery.parseJSON(result);
                                
                                
                                // $('#div_company_select option[value='+obj.data[0].company_id+']').prop('selected','selected');
                               $("#select_company").val(obj.data[0].company_id);
                                $("#select_company").trigger("chosen:updated");
                                $("#txt_quotation_company_name").val(obj.data[0].company_name);
                                $("#txt_quotation_company_id").val(obj.data[0].company_id);
                                $("#txt_quotation_po_box").val(obj.data[0].po_box);
                                $("#txt_quotation_contact_no").val(obj.data[0].telephone_no);
                                $("#txt_quotation_fax").val(obj.data[0].fax);
                                $("#txt_quotation_attn").val(obj.data[0].attn);
                                $("#txt_quotation_no").val(obj.data[0].quotation_number);
                                $("#txt_tax_content").val(obj.data[0].tax_content);
                                var qut_date=obj.data[0].quotation_date.split(' ');
                                var quotation_date= qut_date[0].split('-');
                                var quotation_data=quotation_date[1]+'/'+quotation_date[2]+'/'+quotation_date[0];
                                $("#txt_quotation_date").val(quotation_data);
                                $("#txt_quotation_ref").val(obj.data[0].quotation_reference);
                                $('#div_subject_combo option[value='+obj.data[0].introduction_id+']').prop('selected','selected');
                               
                                $("#txt_subject").val(obj.data[0].subject);
                                
                                $("#div_project_select_combo").load('../controller/quotation_new/quotation_new_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:obj.data[0].company_id},function(result,status){
                                   if(status=="success")
                                   {
                                      $('#div_project_select_combo option[value='+obj.data[0].project_id+']').prop('selected','selected');  
                                   }
                                 });
                                 
                                 
                                load_data_to_grid_quotation_list(obj.data[0].quotation_number);
                               
                              
                               
                                $("#editor").val(obj.data[0].description);
                                $( '#btn_quotation_add' ).show();
                                $( '#btn_quotation_edit' ).hide();
                                
                                
                                $("#quotation_no_head").html(obj.data[0].quotation_number);
                                $('#btn_generate_quotation' ).show();
                                 
                                
                             });
                        
                       
                        
                        
                    }
                   
                   
                    
                    function cancel_quotation(v_quotation_number)
                    {
                        
                        $.post("../controller/quotation_new/quotation_new_controller.php",{action:'cancel_quotation_list',v_quotation_no:v_quotation_number
                                                }
                                                , function(result,status)
                                                {
                                                   
                         });
                       
                    }
   
                
                
                $('#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_attn').keypress(function (e) {
           
                    var str = $(this).val();
                    str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                    
                    });
                    $(this).val(str);
        

               });
               
               $('#txt_quotation_quantity, #txt_quotation_amount,#txt_quotation_rate,#txt_discount_percentage,#txt_tax_percentage').on("keypress", function (e) {
               
                if (e.which != 8 && e.which != 0 && ((e.which < 48 || e.which > 57) && e.which != 46)) {
                    e.preventDefault();
                }
               });
                           
               $('#txt_quotation_contact_no,#txt_quotation_fax').keypress(function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                       
                        e.preventDefault();
                        return false;
                    }
               });
               
               
                
                
                 $('#txt_quotation_new_rate,#txt_quotation_new_quantity,#txt_product_discount,#div_product_discount_type').change(function(){
                     var v_quotation_rate= $('#txt_quotation_new_rate').val();
                     var v_quotation_quantity= $('#txt_quotation_new_quantity').val();
                    $('#txt_discount_amount').val('');
                     
                     if(v_quotation_rate=='')
                     {
                         v_quotation_rate=0.000;
                     }
                      if(v_quotation_quantity=='')
                     {
                         v_quotation_quantity=0.000;
                     }
                    
                     var v_total_amount=parseFloat(v_quotation_rate)*parseFloat(v_quotation_quantity);
                     $('#txt_quotation_amount').val(v_total_amount);
                     
                     var v_product_discount_type=$("#div_product_discount_type option:selected").val();
                     if(v_product_discount_type=='%')
                     {
                         var v_discount_percentage=$('#txt_product_discount').val(); 
                         if(v_discount_percentage==''||v_discount_percentage=='0.000')
                         {
                            v_discount_percentage=0.000;
                            v_net_amount=parseFloat(v_quotation_rate)*parseFloat(v_quotation_quantity);
                             $('#txt_net_amount').val(v_net_amount)
                         }
                         else
                         {
                           v_discount_amount= (parseFloat(v_quotation_rate)*parseFloat(v_quotation_quantity)*parseFloat(v_discount_percentage))/100; 
                           v_net_amount=(parseFloat(v_quotation_rate)*parseFloat(v_quotation_quantity))-parseFloat(v_discount_amount);
                           $('#txt_net_amount').val(v_net_amount);
                           $("#txt_discount_amount").val(v_discount_amount);
                          
                         }
                     }
                     else
                     {
                       
                         var v_discount_amnt=$('#txt_product_discount').val();
                        
                         $("#txt_discount_amount").val(v_discount_amnt);
                          if(v_discount_amnt==''||v_discount_amnt=='0.000')
                         {
                            v_discount_amnt=0.000;
                            v_net_amount=parseFloat(v_quotation_rate)*parseFloat(v_quotation_quantity);
                             $('#txt_net_amount').val(v_net_amount)
                         }
                         else
                         {
                           v_net_amount= (parseFloat(v_quotation_rate)*parseFloat(v_quotation_quantity))-parseFloat(v_discount_amnt); 
                            $('#txt_net_amount').val(v_net_amount)
                           
                         }
                     }
                    
                 });
                 
               
                
                v_but_quotation_save.click(function(){
                      
                 
                    v_but_quotation_save.ladda( 'start' );
                    
                    var v_quotation_company_name=$("#txt_quotation_company_name").val();
                    var v_quotation_company_id=$("#txt_quotation_company_id").val();
                    var v_quotation_po_box=$("#txt_quotation_po_box").val();
                    var v_quotation_contact_no=$("#txt_quotation_contact_no").val();
                    var v_quotation_fax=$("#txt_quotation_fax").val();
                    var v_quotation_attn=$("#txt_quotation_attn").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                    var v_quotation_date=formatDate($("#txt_quotation_date").val());
                    var v_quotation_ref=$("#txt_quotation_ref").val();
                    var v_introduction_name=$("#div_subject_combo option:selected").text();
                    var v_introduction_id=$("#div_subject_combo option:selected").val();
                    var v_quotation_subject=$("#txt_subject").val();
               
                    var v_product_id=$('#select_product_name option:selected').val();
                    var v_product_name=$('#select_product_name option:selected').text();
                    var v_quotation_description=theEditor.getData();
                   
                    var v_quotation_quantity=$('#txt_quotation_new_quantity').val();
                    var v_quotation_unit=$('#txt_quotation_new_unit option:selected').text();
                    
                    var v_quotation_rate=$('#txt_quotation_new_rate').val();
                    var v_quotation_amount=$('#txt_quotation_amount').val();
                    
                    var v_project_name=$("#div_project_select_combo option:selected").text();
                    var v_project_id=$("#div_project_select_combo option:selected").val();
                    var v_tax_content=$('#txt_tax_content').val();
                    var v_product_discount_type=$("#div_product_discount_type option:selected").val();
                    
                    var v_discount_percentage=$('#txt_product_discount').val(); 
                  
                    var v_net_amount=$('#txt_net_amount').val();
                    var v_discount_amount=$("#txt_discount_amount").val();
                    
                   
                    if($.trim(v_quotation_company_name)=="select"||$.trim(v_quotation_company_name)==" "||$.trim(v_quotation_po_box)==""||$.trim(v_quotation_contact_no)==""||$.trim(v_quotation_fax)==""||$.trim(v_quotation_attn)==""||$.trim(v_quotation_date)==""||$.trim(v_quotation_ref)==""||$.trim(v_quotation_description)==""||$.trim(v_quotation_quantity)==""||$.trim(v_quotation_unit)==""||$.trim(v_quotation_rate)==""||$.trim(v_quotation_amount)==""|| $.trim(v_discount_percentage)==" " ||  $.trim(v_net_amount)==" " || $.trim(v_project_id) == "0")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_quotation_save.ladda( 'stop' );
                        return false;
                    }
                   
                    else
                    {         
                         $.post("../controller/quotation_new/quotation_new_controller.php",{action:'add_quotation_new',v_quotation_company_name:v_quotation_company_name,v_quotation_po_box:v_quotation_po_box,v_quotation_contact_no:v_quotation_contact_no,v_quotation_fax:v_quotation_fax,v_quotation_attn:v_quotation_attn,v_quotation_no:v_quotation_no,v_quotation_date:v_quotation_date,v_quotation_ref:v_quotation_ref,v_product_id:v_product_id,v_product_name:v_product_name,v_quotation_description:v_quotation_description,v_quotation_quantity:v_quotation_quantity,v_quotation_unit:v_quotation_unit,v_quotation_rate:v_quotation_rate,v_quotation_amount:v_quotation_amount,v_quotation_subject:v_quotation_subject,v_company_id:v_quotation_company_id,v_project_name:v_project_name,v_project_id:v_project_id,v_discount_percentage:v_discount_percentage,v_net_amount:v_net_amount,v_introduction_name:v_introduction_name,v_introduction_id:v_introduction_id,v_product_discount_type:v_product_discount_type,v_tax_content:v_tax_content,v_product_discount_amount:v_discount_amount
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_quotation_save.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_quotation_list()
                                    clear_text();
                                   

                                
                                }
                                else 
                                {
                                     v_but_quotation_save.ladda( 'stop' );
                                    
                                   
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item added to quotation Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                    
                                    
                                    
                                     $("#txt_quotation_no").val(result);
                                     $("#quotation_no_head").html(result);
                                     
                                     
                                     
                                    load_data_to_grid_quotation_list(result);
                                    
                                    
                                    
                                     clear_text();
                                    
                                }
                                
                                 
                            
                        });
                        
                       
                        
                     }
                  
                });
            
               
                      
                 function clear_text()
                 {
                     
                    $('#txt_quotation_description').val('');
                    $('#txt_quotation_quantity').val('');
                    $('#txt_quotation_unit').val('');
                    $('#txt_quotation_rate').val('0.000');
                    $('#txt_quotation_amount').val('0.000');
                    $('#txt_discount_percentage').val('0.000');
                    $('#txt_amt_after_discount').val('0.000');
                    $('#txt_tax_percentage').val('0.000');
                    $('#txt_net_amount').val('0.000');
                     const editorData = theEditor.setData('');
                     $('#select_product_name').val('0').trigger('chosen:updated');
                    // $("#select_product_name").val('0').trigger('change');  
                  $('#txt_quotation_new_unit').val('');
                  $('#txt_quotation_new_rate').val('');
                  $('#txt_quotation_new_quantity').val('');
                  $('#txt_product_discount').val(0);
                  $('#txt_quotation_new_unit').val('0').trigger('chosen:updated');
                    $('#editor1').val('');
                  
                 }
            
            
               
            
                
            
            
                function load_data_to_grid_quotation_list(quotation_no)
                 {
                     quotation_list_table.destroy();
                         
                     quotation_list_table = $('#tbl_quotation_list').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/quotation_new/quotation_new_controller.php',
                                 'data': {
                                    action: 'list_quotation',
                                    v_quotation_no:quotation_no
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
                            "columns": [
                                 { "data": null },
                                 { "data": "quotation_child_id","visible":false },
                                 { "data": "quotation_no","visible":false },
                                 { "data": "description", width:"20%"},
                                 { "data": "quantity"},
                                 { "data": "unit"},
                                 { "data": "rate", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "discount_type",className: "text-center"},
                                 { "data": "discount_precentage",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 //{ "data": "vat_percentage", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
            					 { "data": "quotation_child_id" ,
					 
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-1"  id="edit_quotations" name="edit_quotations" ><i class="material-icons ">edit</i></button>';
            								
            								return str_active_status_view;
            
            							 },
					         },
            				{ "data": "quotation_child_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm btn-danger mr-1"  id="delete_quotations" name="delete_quotations" ><i class="material-icons ">delete</i></button>';
            								
            								return str_active_status_view;
            
            							 },
					 
					         },	
							 
             
                             ],
                             pageLength: 25,
            				 searching: false,
                             responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                                    
                               
             
                              },
                              "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                                 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                                 return nRow;
                             },
                              "fnDrawCallback": function() {
                               
             
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
                                .column( 10 )
                                .data()
                                .reduce( function (a, b) {
                                    
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Total over this page Income
                            pageTotal1 = api
                                .column( 10, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0 );
                           
                            // Update footer
                            $( api.column( 10 ).footer() ).html($.fn.dataTable.render.number(',', '.', 3, '').display( pageTotal1 )
                                
                            );
                            var quotation_total=pageTotal1.toFixed(3);
                            $("#txt_quotation_total_amount").val(quotation_total); 
                            $("#txt_quotation_total_amount_hidden").val(quotation_total); 
                            
                             var v_discount_type=$("#div_discount_type option:selected").val();
                    var v_total_discount=$("#txt_total_discount").val();
                    var v_quotation_net_amount=$("#txt_quotation_total_amount_hidden").val();
                    v_quotation_net_amount=parseFloat(v_quotation_net_amount).toFixed(3);
                    $("#txt_discount_amount_total").val('');
                    $("#txt_quotation_total_amount_edit").val('');
                    $("#txt_quotation_total_amount").val(v_quotation_net_amount);
                    $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                     if(v_discount_type=='%')
                     {
                        
                         if(v_total_discount==''||v_total_discount=='0.000')
                         {
                            v_total_discount=0.000;
                           $("#txt_quotation_total_amount").val(v_quotation_net_amount);
                            $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                         }
                         else
                         {
                           v_discount_amount= (parseFloat(v_quotation_net_amount)*parseFloat(v_total_discount))/100; 
                           v_quotation_net_amount=(parseFloat(v_quotation_net_amount))-parseFloat(v_discount_amount);
                            v_quotation_net_amount=parseFloat(v_quotation_net_amount).toFixed(3);
                            $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                           $('#txt_quotation_total_amount').val(v_quotation_net_amount);
                           $("#txt_discount_amount_total").val(v_discount_amount);
                         }
                     }
                     else
                     {
                       
                          if(v_total_discount==''||v_total_discount=='0.000')
                         {
                            v_total_discount=0.000;
                              $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                              $("#txt_quotation_total_amount").val(v_quotation_net_amount);
                         }
                         else
                         {
                           var v_quotation_net_amount=$("#txt_quotation_total_amount").val();
                           v_quotation_net_amount= (parseFloat(v_quotation_net_amount))-parseFloat(v_total_discount); 
                            v_quotation_net_amount=parseFloat(v_quotation_net_amount).toFixed(3);
                           $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                           $("#txt_quotation_total_amount").val(v_quotation_net_amount);
                            $("#txt_discount_amount_total").val(v_total_discount);
                         }
                            
                        }
                       
                      }
                     });
                 }
                 
                 $("#txt_total_discount,#div_discount_type,#txt_quotation_total_amount").change(function(){
                    var v_discount_type=$("#div_discount_type option:selected").val();
                    var v_total_discount=$("#txt_total_discount").val();
                    var v_quotation_net_amount=$("#txt_quotation_total_amount_hidden").val();
                    v_quotation_net_amount=parseFloat(v_quotation_net_amount).toFixed(3);
                   $("#txt_discount_amount_total").val('');
                    $("#txt_quotation_total_amount_edit").val('');
                    $("#txt_quotation_total_amount").val(v_quotation_net_amount);
                 $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                     if(v_discount_type=='%')
                     {
                        
                         if(v_total_discount==''||v_total_discount=='0.000')
                         {
                            v_total_discount=0.000;
                           $("#txt_quotation_total_amount").val(v_quotation_net_amount);
                            $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                         }
                         else
                         {
                           v_discount_amount= (parseFloat(v_quotation_net_amount)*parseFloat(v_total_discount))/100; 
                           v_quotation_net_amount=(parseFloat(v_quotation_net_amount))-parseFloat(v_discount_amount);
                           var v_quotation_net_amount=parseFloat(v_quotation_net_amount).toFixed(3);
                            $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                           $('#txt_quotation_total_amount').val(v_quotation_net_amount);
                           $("#txt_discount_amount_total").val(v_discount_amount);
                         }
                     }
                     else
                     {
                       
                          if(v_total_discount==''||v_total_discount=='0.000')
                         {
                            v_total_discount=0.000;
                              $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                              $("#txt_quotation_total_amount").val(v_quotation_net_amount);
                         }
                         else
                         {
                           var v_quotation_net_amount=$("#txt_quotation_total_amount").val();
                           var v_quotation_net_amount=parseFloat(v_quotation_net_amount).toFixed(3);
                           v_quotation_net_amount= (parseFloat(v_quotation_net_amount))-parseFloat(v_total_discount).toFixed(3); 
                           v_quotation_net_amount=v_quotation_net_amount.toFixed(3);
                           $("#txt_quotation_total_amount_edit").val(v_quotation_net_amount);
                           $("#txt_quotation_total_amount").val(v_quotation_net_amount);
                            $("#txt_discount_amount_total").val(v_total_discount);
                         }
                     }
                   
                     
                 })
                //   $('#btn_generate_quotation').click(function(){
                       
                //       const editorData = editor.getData();
                   
                //     var v_quotation_all_description= editorData;
                    
                    
                //      console.log("Test : "+v_quotation_all_description);
                //   });       
                      
                  $('#btn_generate_quotation').click(function(){
                 
                    var v_quotation_company_name=$("#txt_quotation_company_name").val();
                    var v_quotation_company_id=$("#txt_quotation_company_id").val();
                    var v_quotation_po_box=$("#txt_quotation_po_box").val();
                    var v_quotation_contact_no=$("#txt_quotation_contact_no").val();
                    var v_quotation_fax=$("#txt_quotation_fax").val();
                    var v_quotation_attn=$("#txt_quotation_attn").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                    var v_quotation_date=formatDate($("#txt_quotation_date").val());
                    var v_quotation_ref=$("#txt_quotation_ref").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                    //  const editorData1 = editor1.getData();
                   
                    // var v_quotation_subject= editorData1;
                    var v_introduction_name=$("#div_subject_combo option:selected").text();
                    var v_introduction_id=$("#div_subject_combo option:selected").val();
                    var v_quotation_subject=$("#txt_subject").val();
                    var v_project_name=$("#div_project_select_combo option:selected").text();
                    var v_project_id=$("#div_project_select_combo option:selected").val();
                    const editorData = editor.getData();
                   
                    var v_quotation_all_description= editorData;
                    
                    
                    console.log(v_quotation_all_description);
                    var v_quotation_net_amount= $("#txt_quotation_total_amount").val();
                    var v_discount_type=$("#div_discount_type option:selected").val();
                    var v_discount_amount=$("#txt_total_discount").val();
                  
                    var v_total_discount=$("#txt_discount_amount_total").val();
                   
                    var v_quotation_sub_total=pageTotal1;
                  // alert(v_quotation_sub_total);
                     if($.trim(v_quotation_company_name)=="select"||$.trim(v_quotation_company_name)==" "||$.trim(v_quotation_po_box)==""||$.trim(v_quotation_contact_no)==""||$.trim(v_quotation_fax)==""||$.trim(v_quotation_attn)==""||$.trim(v_quotation_date)==""||$.trim(v_quotation_ref)==""||$.trim(v_quotation_subject)=="")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_quotation_save.ladda( 'stop' );
                        return false;
                    }
                     else
                     {
                      $.post("../controller/quotation_new/quotation_new_controller.php",{action:'generate_quotation',v_quotation_no:v_quotation_no,
                      v_quotation_all_description:v_quotation_all_description,v_quotation_company_name:v_quotation_company_name,v_quotation_po_box:v_quotation_po_box,v_quotation_contact_no:v_quotation_contact_no,v_quotation_fax:v_quotation_fax,v_quotation_attn:v_quotation_attn,v_quotation_no:v_quotation_no,v_quotation_date:v_quotation_date,v_quotation_ref:v_quotation_ref,v_quotation_subject:v_quotation_subject,v_company_id:v_quotation_company_id,v_project_name:v_project_name,v_project_id:v_project_id,v_quotation_sub_total:v_quotation_sub_total,v_introduction_name:v_introduction_name,v_introduction_id:v_introduction_id,v_net_amount:v_quotation_sub_total,v_quotation_net_amount:v_quotation_net_amount,v_discount_type:v_discount_type,v_total_discount:v_total_discount,v_discount_amount:v_discount_amount
                       
                                }
                               
                                , function(result,status)
                                {
                                  if(result=="success")
                                  {
                                    swal("Success","Quotation generated successfully", "success"); 
                                     $('#btn_generate_quotation').hide();
                                    //   $('#btn_edit_quotation').show();
                                    
                                    var session_id = $('#head_session_user_id').val();
                                     if(session_id==1){
                                         $('#btn_edit_quotation' ).show();
                                     }
                                     else{
                                         $('#btn_edit_quotation' ).hide();
                                     }
                                   
                                  }
                                  else
                                  {
                                    swal("Error"," Some Error Occures..", "error"); 
                                    clear_all_after_generate_quotation(); 
                                  }
                          });
                     }
                  });
                  
                   $('#btn_search_date').click(function(){
                     var v_quotation_from_date = formatDate($("#txt_start_date").val());
                     var v_quotation_to_date = formatDate($("#txt_end_date").val());
                     var option_select = $('#all_app').val();
					
                    //  load_data_to_grid_view_quotation_list_between(v_quotation_from_date,v_quotation_to_date,option_select);
                            var session_id = $('#head_session_user_id').val();
						    if(session_id==1){
                             load_data_to_grid_view_quotation_list_between(false,v_quotation_from_date,v_quotation_to_date);
                             }
                             else{
                                 load_data_to_grid_view_quotation_list_between(true,v_quotation_from_date,v_quotation_to_date); 
                             }
                   
                  });
                
                  $('#btn_cancel_search_date').click(function(){
                     var v_quotation_from_cancel_date = formatDate($("#txt_cancel_start_date").val());
                     var v_quotation_to_cancel_date = formatDate($("#txt_cancel_end_date").val());
                    //  load_data_to_grid_view_quotation_list_between(v_quotation_from_cancel_date,v_quotation_to_cancel_date);
                            var session_id = $('#head_session_user_id').val();
						    if(session_id==1){
                             load_data_to_grid_view_quotation_list_between(false,v_quotation_from_date,v_quotation_to_date);
                             }
                             else{
                                 load_data_to_grid_view_quotation_list_between(true,v_quotation_from_date,v_quotation_to_date); 
                             }
                   
                  });
                  
                 function clear_all_after_generate_quotation()
                 {
                   $('#txt_quotation_vat,#txt_quotation_total_amount,#txt_quotation_received_amount,#txt_quotation_balance_due,#txt_quotation_no,#txt_quotation_all_description,#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_contact_no,#txt_quotation_fax,#txt_quotation_attn,#txt_quotation_ref,#txt_quotation_lpo_no').val('');  
                   $("#txt_quotation_company_name,#txt_quotation_po_box,#txt_quotation_contact_no,#txt_quotation_fax,#txt_quotation_attn,#txt_quotation_no,#txt_quotation_date,#txt_quotation_quotation_ref,#txt_quotation_lpo_no").prop("readonly",false);
                   var quotation_no=0;
                   load_data_to_grid_quotation_list(quotation_no);
                 }
                 $("#btn_list_of_qtns_close").click(function(){
                //   load_data_to_grid_view_quotation_list();  
                         var session_id = $('#head_session_user_id').val();
                     if(session_id==1){
                         load_data_to_grid_view_quotation_list(false); 
                     }
                     else{
                         load_data_to_grid_view_quotation_list(true); 
                     }
                
                 })
                 
                 function load_data_to_grid_view_quotation_list(approvedbtn=false)
                 {
					  flag=0;
                     quotation_view_list_table.destroy();
                         
                     quotation_view_list_table = $('#list_of_quotations').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/quotation_new/quotation_new_controller.php',
                                 'data': {
                                    action: 'list_quotation_view',
                                    
                                 }
                             },
                             "language": {
                                 "zeroRecords": "Loading...",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            			    	"bPaginate": false,
   
            			    
                            "columns": [
                              
                                 { "data": "quotation_main_id","visible":false },
                                 { "data": "quotation_date"},
                                 { "data": "quotation_number"},
                                 { "data": "company_name", visible:false},
                                 { "data": "project_name"},
                                 { "data": "project_number",
                                      render: function ( data, type, rows, meta ) {
                                          if(data=='')
                                          {
                                              project_no = 'NA';
                                          }
                                          else
                                          {
                                               project_no = data;
                                          }
            						
            								
            								return project_no;
            
            							 },
                                     
                                 },
                                 { "data": "sub_total",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 { "data": "discount_amount",className: "text-center"},
                                 { "data": "quotation_main_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_quotations" name="view_quotations" ><i class="material-icons ">remove_red_eye</i></button>';
            								
            								return str_active_status_view;
            
            							 },
            							 
            					

					 
					         },
					       
								 { "data": "approved_status" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
                                         if(!approvedbtn){
            						
                        						if(rows['approved_status']=='Pending')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm primary-gradient mr-2"  id="approval" name="approval" ><i class="material-icons">check_circle</i></button>';
                        								
                                                return approval_status;
            									}
            									
            									if(rows['approved_status']=='Approved')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm  mr-2" style="    background-color: green !important;color: #fff;" id="approval" name="approval" ><i class="material-icons">check_circle</i></button>';
                        								
                                                return approval_status;
            									}
            									
                                            }
                                            else{
                                                
                                                	if(rows['approved_status']=='Pending')
                									{
                                							
                            								var	approval_status = '<button type="button" class="btn btn-sm primary-gradient mr-2"  id="approval" name="approval" disabled><i class="material-icons">check_circle</i></button>';
                            								
                                                    return approval_status;
                									}
                									
                									if(rows['approved_status']=='Approved')
                									{
                                							
                            								var	approval_status = '<button type="button" class="btn btn-sm  mr-2" style="    background-color: green !important;color: #fff;" id="approval" name="approval" disabled><i class="material-icons">check_circle</i></button>';
                            								
                                                    return approval_status;
                									}
                                            }
									
            							 },
            							 
            					

					 
					         },
                                 
                             ],
                             dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'excelHtml5',
                                    title: 'Quotation_List',
                                    text: '<i class="material-icons">grid_on</i> Excel',
                                    className: 'btn btn-sm btn-success'
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: 'Quotation_List',
                                    orientation: 'landscape',
                                    pageSize: 'A4',
                                    text: '<i class="material-icons">picture_as_pdf</i> PDF',
                                    className: 'btn btn-sm btn-danger'
                                },
                                {
                                    extend: 'print',
                                    title: 'Quotation_List',
                                    text: '<i class="material-icons">print</i> Print',
                                    className: 'btn btn-sm btn-info'
                                }
                            ],
                             pageLength: 25,
            				 searching: true,
                             responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                                                      
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             },
							 "drawCallback": function ( settings ) {
								var api = this.api();
								var rows = api.rows( {page:'current'} ).nodes();
								var last=null;
					 
								api.column(3, {page:'current'} ).data().each( function ( group, i ) {
									if ( last !== group ) {
										$(rows).eq( i ).before(
											'<tr class="group" style="background-color:#D2B4DE;"><td colspan="9">'+group+'</td></tr>'
										);
					 
										last = group;	
									}
								} );
							}
                        
                         
                     });  
                
                 }
                 
                 
                 function load_data_to_grid_view_quotation_list_between(btn_approval=false,v_quotation_from_date,v_quotation_to_date,option_select)
                 { 
				  flag=1;
                      quotation_view_list_table.destroy();
                      var start=$('#txt_start_date').val();
                      var end=$('#txt_end_date').val();
                      var option_select=$('#all_app').val();
				  
                     quotation_view_list_table = $('#list_of_quotations').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/quotation_new/quotation_new_controller.php',
                                 'data': {
                                    action: 'list_quotation_view_between',
                                    v_quotation_from_date:v_quotation_from_date,
                                    v_quotation_to_date:v_quotation_to_date,
                                   option_select:option_select
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            				"bPaginate": false,
  
                            "columns": [
                              
                                 { "data": "quotation_main_id","visible":false },
                                 { "data": "quotation_date"},
                                 { "data": "quotation_number"},
                                 { "data": "company_name", visible:false},
                                 { "data": "project_name"},
                                 { "data": "project_number"},
                                 { "data": "sub_total",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 { "data": "discount_amount",className: "text-center"},
                                 { "data": "quotation_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_quotations" name="view_quotations" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         },
    					      
								 { "data": "approved_status" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
                                          
                                          if(!btn_approval)
                                          {
                        						if(rows['approved_status']=='Pending')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm primary-gradient mr-2"  id="approval" name="approval" ><i class="material-icons">check_circle</i></button>';
                        								
                                               
            									}
            									
            									if(rows['approved_status']=='Approved')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm  mr-2" style="    background-color: green !important;color: #fff;" id="approval" name="approval" ><i class="material-icons">check_circle</i></button>';
                        								
                                                
            									}
            											return approval_status;
                                            }
                                            else{
                                                
                                                	if(rows['approved_status']=='Pending')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm primary-gradient mr-2"  id="approval" name="approval" disabled><i class="material-icons">check_circle</i></button>';
                        								
                                               
            									}
            									
            									if(rows['approved_status']=='Approved')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm  mr-2" style="    background-color: green !important;color: #fff;" id="approval" name="approval" disabled><i class="material-icons">check_circle</i></button>';
                        								
                                                
            									}
            											return approval_status;
                                                
                                            }
            							 },
            							 
            					

					 
					         },
             
                             ],
                              dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'excelHtml5',
                                    title: 'Quotation_List',
                                    text: '<i class="material-icons">grid_on</i> Excel',
                                    className: 'btn btn-sm btn-success',
                                     exportOptions: {
                                        columns: [0,1, 2, 3,4, 5,6]  // Export only these column indexes
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: 'Quotation_List',
                                    orientation: 'landscape',
                                    pageSize: 'A4',
                                    text: '<i class="material-icons">picture_as_pdf</i> PDF',
                                    className: 'btn btn-sm btn-danger',
                                    exportOptions: {
                                            columns: [0,1, 2,3, 4, 5,6]  // Export only these column indexes
                                        }
                                },
                                {
                                    extend: 'print',
                                    title: 'Quotation_List',
                                    text: '<i class="material-icons">print</i> Print',
                                    className: 'btn btn-sm btn-info',
                                     exportOptions: {
                                        columns: [0,1, 2,3, 4, 5,6]  // Export only these column indexes
                                    }
                                }
                            ],
                             pageLength: 25,
            				 searching: true,
                             responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                               
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             },
							 "drawCallback": function ( settings ) {
								var api = this.api();
								var rows = api.rows( {page:'current'} ).nodes();
								var last=null;
					 
								api.column(3, {page:'current'} ).data().each( function ( group, i ) {
									if ( last !== group ) {
										$(rows).eq( i ).before(
											'<tr class="group" style="background-color:#D2B4DE;"><td colspan="9">'+group+'</td></tr>'
										);
					 
										last = group;
									}
								} );
							}
                        
                         
                     });  
                
                 
                 }
                 
                 $('#btn_create_quotation').click(function(){
                    location.reload(); 
                 
                 });
                 
                 $("#txt_end_date").on("change", function() {
                     var v_quotation_from_date = formatDate($("#txt_start_date").val());
                     var v_quotation_to_date = formatDate($("#txt_end_date").val());
                    //  load_data_to_grid_view_quotation_list_between(v_quotation_from_date,v_quotation_to_date);
                    
                            var session_id = $('#head_session_user_id').val();
						    if(session_id==1){
                             load_data_to_grid_view_quotation_list_between(false,v_quotation_from_date,v_quotation_to_date);
                             }
                             else{
                                 load_data_to_grid_view_quotation_list_between(true,v_quotation_from_date,v_quotation_to_date); 
                             }
                   
                  });
             
                 $('#list_of_quotations tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = quotation_view_list_table.row($row).data();
                        v_quotation_number  = data.quotation_number;
                        var v_quotation_from_date = formatDate($("#txt_start_date").val());
                        var v_quotation_to_date = formatDate($("#txt_end_date").val());       
                       
                        $('#txt_quotation_description').val('');
                        $('#txt_quotation_quantity').val('');
                        $('#txt_quotation_unit').val('');
                        $('#txt_quotation_rate').val('0.000');
                        $('#txt_quotation_amount').val('0.000');
                        $('#txt_discount_percentage').val('0.000');
                        $('#txt_amt_after_discount').val('0.000');
                        $('#txt_tax_percentage').val('0.000');
                        $('#txt_net_amount').val('0.000');
                        $( '#btn_quotation_add' ).show();
                        $( '#btn_quotation_edit' ).hide();
                        
                        if($(this).attr("name")=='view_quotations')
                         {
                             //alert(data.approved_status);
                             if(data.approved_status=='Pending')
                             {
                                 $('#txt_tax_content').prop('disabled', false);
                             }
                             else
                             {
                                  $('#txt_tax_content').prop('disabled', false);
                             }
            			    edit_data(); 
            			
            			 }
						 
						 if($(this).attr("name")=='approval')
                         {
                             
                         console.log(data.discount_amount);
                         if(data.discount_amount==0.000 ){
                          var v_approved_status= data.approved_status;
                          
                    			 $.post("../controller/quotation_new/quotation_new_controller.php",{action : "quotation_approval",v_quotation_number:v_quotation_number,v_approved_status:v_approved_status},function(res){
        	                     swal("success","Quotation approved status changed successfully ....", "success");
        			             if(flag==0)
        						 {
        				// 		 load_data_to_grid_view_quotation_list();
        				         var session_id = $('#head_session_user_id').val();
                                 if(session_id==1){
                                     load_data_to_grid_view_quotation_list(false); 
                                 }
                                 else{
                                     load_data_to_grid_view_quotation_list(true); 
                                 }
        				
        						 }
        						 else{ 
        						  //  load_data_to_grid_view_quotation_list_between(v_quotation_from_date,v_quotation_to_date);
        						    var session_id = $('#head_session_user_id').val();
        						    if(session_id==1){
                                     load_data_to_grid_view_quotation_list_between(false,v_quotation_from_date,v_quotation_to_date);
                                     }
                                     else{
                                         load_data_to_grid_view_quotation_list_between(true,v_quotation_from_date,v_quotation_to_date); 
                                     }
        						 }
        						 });
                         }
                         else
                         {
                             swal("error","Discount Amount is not zero ....", "error");
                         }
            			
            			 }
						 
            			 
            			  if($(this).attr("name")=='delete_quotations')
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
            						
            						       cancel_quotation(v_quotation_number);
            						       
            						       
                         				   //load_data_to_grid_view_quotation_list(); 
                         				    var session_id = $('#head_session_user_id').val();
                                             if(session_id==1){
                                                 load_data_to_grid_view_quotation_list(false); 
                                             }
                                             else{
                                                 load_data_to_grid_view_quotation_list(true); 
                                             }
                         				   
            							} else {
            							    
            							   
            							 
            							}
            						 });
                             
                         }     
                        
                        
                      
                     function  edit_data() 
                       {
                       // alert(data.company_name);
                        // $('#div_company_select option').map(function () {
                        // if ($(this).val() == $.trim(data.company_id)) return this;
                        // }).attr('selected', 'selected');
                        $("#select_company").val(data.company_id);
                        $("#select_company").trigger("chosen:updated");
                        
                        //$('#div_company_select option[value='+data.company_id+']').prop('selected','selected');  
                        $("#txt_quotation_company_id").val(data.company_id);
                        $("#txt_quotation_company_name").val(data.company_name);
                        $("#txt_project_no").val(data.project_number);
                       
                        $("#txt_quotation_po_box").val(data.po_box);
                        $("#txt_quotation_contact_no").val(data.telephone_no);
                        $("#txt_quotation_fax").val(data.fax);
                        $("#txt_quotation_attn").val(data.attn);
                        $("#txt_quotation_no").val(data.quotation_number);
                        $("#txt_tax_content").val(data.tax_content);
                     
                         $('#div_subject_combo option').map(function () {
                        if ($(this).text() == data.introduction_name) return this;
                        }).attr('selected', 'selected');
                        
                          
                        var qut_date=data.quotation_date.split(' ');
                        var quotation_date= qut_date[0].split('-');
                        var quotation_data=quotation_date[1]+'/'+quotation_date[0]+'/'+quotation_date[2];
                        
                        $("#txt_quotation_date").val(quotation_data);
                         $("#div_project_select_combo").load('../controller/quotation_new/quotation_new_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                                   if(status=="success")
                                   {
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).text() == data.project_name) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
                        });
                        
                      
                        
                       
                        $("#txt_quotation_ref").val(data.quotation_reference);
                        $('#txt_subject').val(data.subject);
                        
                        
                         
                        load_data_to_grid_quotation_list(data.quotation_number);
                        var total_amount_edit=parseFloat(data.sub_total)-parseFloat(data.total_discount_amount)
                        $("#txt_quotation_total_amount").val(data.sub_total);
                        $("#txt_quotation_total_amount_edit").val(data.sub_total);
                        $("#txt_quotation_total_amount").hide();
                         $("#txt_quotation_total_amount_edit").show();
                        $("#txt_total_discount").val(data.discount_amount);
                        $('#div_discount_type option').map(function () {
                        if ($.trim($(this).text()) == $.trim(data.discount_type)) return this;
                        }).attr('selected', 'selected');
                       
                         const editorData = editor.setData(data.description);
                   
                         var v_quotation_all_description= editorData;
                       
                        $("#editor").val(v_quotation_all_description);
                        //$( '#btn_quotation_add' ).hide();
                       // $( '#btn_quotation_edit' ).show();
                        
                        
                        $("#quotation_no_head").html(data.quotation_number);
                         $('#btn_generate_quotation' ).hide();
                         
                         var session_id = $('#head_session_user_id').val();
                         if(session_id==1){
                             $('#btn_edit_quotation' ).show();
                         }
                         else{
                             $('#btn_edit_quotation' ).hide();
                         }
                         
                         
                        
                        closeNavR();
                       }  
                        
                 });
                 
                
                
                 
                  $('#tbl_quotation_list tbody').on('click', 'td button', function (){
                      
                      var $row = $(this).closest('tr');
                      var data = quotation_list_table.row($row).data();
                      v_quotation_number  = data.quotation_no;
                         if($(this).attr("name")=='edit_quotations')
                         {
                       
                      	   edit_current_data(); 
            			
            			 }
            			 
            			  if($(this).attr("name")=='delete_quotations')
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
        						
        						       cancel_quotation_item_list(data.quotation_child_id,data.quotation_no);
                     						 
        							} else {
        							    
        							   
        							 
        							}
        						 });
            			
            			 }
                        
                  
            
                   
            function edit_current_data()
                 {
                        
                       
                        
                        $("#txt_quotation_child_id").val(data.quotation_child_id);
                       // $('#txt_quotation_description').val(data.description);
                        $('#txt_quotation_new_quantity').val(data.quantity);
                        
                        //$('#txt_quotation_new_unit').text(data.unit);
                        //$("#txt_quotation_new_unit").trigger("chosen:updated");
                        $('#txt_quotation_amount').val(data.amount);
                        $('#txt_product_discount').val(data.discount_precentage);
                        $('#txt_amt_after_discount').val(data.discount_amount);
                       
                        $("#select_product_name").val(data.product_id);
                        $("#select_product_name").trigger("chosen:updated");
                             
                        // Clear all selected options first
                        $('#txt_quotation_new_unit option').prop('selected', false);
                        
                        // Find the correct option and select it
                        $('#txt_quotation_new_unit option').filter(function() {
                            return $.trim($(this).text()) == $.trim(data.unit);  // Match based on the text
                        }).prop('selected', true);
                        
                        // Optionally trigger change if needed to reflect the change in the UI
                        $('#txt_quotation_new_unit').trigger('change');
                       
                        
                        
                        $('#div_product_discount option').map(function () {
                        if ($.trim($(this).text()) == $.trim(data.discount_type)) return this;
                        }).attr('selected', 'selected');
                        $('#txt_quotation_new_rate').val(data.rate);
                       
                        
                         const editorData = theEditor.setData(data.description);
                   
                         var v_quotation_all_description= editorData;
                       
                       $("#editor").val(v_quotation_all_description);
                       
                        $('#txt_net_amount').val(data.net_amount);
                       
                     
                        $( '#btn_quotation_add' ).hide();
                        $( '#btn_quotation_edit' ).show();
                 }
                      
                  });
                  
                  
                function cancel_quotation_item_list(v_quotation_id,quotation_no)
                    {
                        
                        $.post("../controller/quotation_new/quotation_new_controller.php",{action:'cancel_quotation_item',v_quotation_child_id:v_quotation_id
                                                }
                                                , function(result,status)
                                                {
                                             load_data_to_grid_quotation_list(quotation_no);
                                              $('#txt_quotation_description,#txt_quotation_quantity,#txt_quotation_unit,#txt_quotation_rate,#txt_discount_percentage,#txt_tax_percentage').val('');
                                                   
                         });
                       
                    }   
                  
                  
                  
                  
                
                  v_but_quotation_edit.click(function(){
                      
                 
                    v_but_quotation_edit.ladda( 'start' );
                    var v_quotation_child_id=$("#txt_quotation_child_id").val();
                    
                    var v_quotation_company_name=$("#txt_quotation_company_name").val();
                    var v_quotation_company_id=$("#txt_quotation_company_id").val();
                    var v_quotation_po_box=$("#txt_quotation_po_box").val();
                    var v_quotation_contact_no=$("#txt_quotation_contact_no").val();
                    var v_quotation_fax=$("#txt_quotation_fax").val();
                    var v_quotation_attn=$("#txt_quotation_attn").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                    var v_quotation_date=formatDate($("#txt_quotation_date").val());
                    var v_quotation_ref=$("#txt_quotation_ref").val();
                    var v_introduction_name=$("#div_subject_combo option:selected").text();
                    var v_introduction_id=$("#div_subject_combo option:selected").val();
                    var v_quotation_subject=$("#txt_subject").val();
               
                    var v_product_id=$('#select_product_name option:selected').val();
                    var v_product_name=$('#select_product_name option:selected').text();
                    var v_quotation_description=theEditor.getData();
                   
                    var v_quotation_quantity=$('#txt_quotation_new_quantity').val();
                    var v_quotation_unit=$('#txt_quotation_new_unit option:selected').text();
                    var v_quotation_rate=$('#txt_quotation_new_rate').val();
                    var v_quotation_amount=$('#txt_quotation_amount').val();
                    
                    var v_project_name=$("#div_project_select_combo option:selected").text();
                    var v_project_id=$("#div_project_select_combo option:selected").val();
                    var v_tax_content=$('#txt_tax_content').val();
                    var v_product_discount_type=$("#div_product_discount_type option:selected").val();
                    
                    var v_discount_percentage=$('#txt_product_discount').val(); 
                   // alert("Discount Percentage"+v_discount_percentage);
                    var v_product_discount_amount=$('#txt_product_discount').val();
                   // alert("Discount amount"+v_product_discount_amount);
                    var v_net_amount=$('#txt_net_amount').val();
                   // alert("Net Amount"+v_net_amount);
                    var v_discount_amount_product=$("#txt_discount_amount").val();
                  //  alert("Discount Amount product"+v_discount_amount_product);
                    const editorData = editor.getData();
                   
                    var v_quotation_all_description= editorData;
                    var v_quotation_net_amount= $("#txt_quotation_total_amount_edit").val();
                    var v_discount_type=$("#div_discount_type option:selected").val();
                    var v_discount_amount=$("#txt_total_discount").val();
                     // alert("Total Discount_amount"+v_discount_amount);
                    var v_total_discount=$("#txt_discount_amount_total").val();
                   
                    if($.trim(v_quotation_company_name)=="select"||$.trim(v_quotation_company_name)==" "||$.trim(v_quotation_po_box)==""||$.trim(v_quotation_contact_no)==""||$.trim(v_quotation_fax)==""||$.trim(v_quotation_attn)==""||$.trim(v_quotation_date)==""||$.trim(v_quotation_ref)==""||$.trim(v_quotation_description)==""||$.trim(v_quotation_quantity)==""||$.trim(v_quotation_unit)==""||$.trim(v_quotation_rate)==""||$.trim(v_quotation_amount)==""|| $.trim(v_discount_percentage)==" " ||  $.trim(v_net_amount)==" " || $.trim(v_project_id) == "0")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_quotation_save.ladda( 'stop' );
                        return false;
                    }
                  
                  
                    
                    
                   
                    else
                    {         
                         $.post("../controller/quotation_new/quotation_new_controller.php",{action:'edit_quotation',v_quotation_company_name:v_quotation_company_name,v_quotation_po_box:v_quotation_po_box,v_quotation_contact_no:v_quotation_contact_no,v_quotation_fax:v_quotation_fax,v_quotation_attn:v_quotation_attn,v_quotation_no:v_quotation_no,v_quotation_date:v_quotation_date,v_quotation_ref:v_quotation_ref,v_product_id:v_product_id,v_product_name:v_product_name,v_quotation_description:v_quotation_description,v_quotation_quantity:v_quotation_quantity,v_quotation_unit:v_quotation_unit,v_quotation_rate:v_quotation_rate,v_quotation_amount:v_quotation_amount,v_quotation_subject:v_quotation_subject,v_company_id:v_quotation_company_id,v_project_name:v_project_name,v_project_id:v_project_id,v_discount_percentage:v_discount_percentage,v_net_amount:v_net_amount,v_introduction_name:v_introduction_name,v_introduction_id:v_introduction_id,v_product_discount_type:v_product_discount_type,v_tax_content:v_tax_content,v_product_discount_amount:v_product_discount_amount,v_quotation_child_id:v_quotation_child_id,v_quotation_all_description:v_quotation_all_description,v_quotation_net_amount:v_quotation_net_amount,v_discount_type:v_discount_type,v_total_discount:v_total_discount,v_discount_amount:v_discount_amount,v_discount_amount_product:v_discount_amount_product

                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_quotation_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_quotation_list(v_quotation_no);
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_but_quotation_edit.ladda( 'stop' );
                                    
                                     
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Item edited to quotation Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_quotation_add' ).show();
                                     $( '#btn_quotation_edit' ).hide();
                                     
                                    $('#txt_quotation_new_unit option').each(function () {
                                        // Clear all previously selected options
                                        $(this).prop('selected', false).removeAttr('selected');
                                    });
                                     
                                    // load_data_to_grid_view_quotation_list();
                                    
                                     var session_id = $('#head_session_user_id').val();
                                     if(session_id==1){
                                         load_data_to_grid_view_quotation_list(false); 
                                     }
                                     else{
                                         load_data_to_grid_view_quotation_list(true); 
                                     }
                                    
                                    load_data_to_grid_quotation_list( v_quotation_no);
                                     clear_text();
                                    
                                }
                            
                        }); 
                     }
            
                   
                });
                
                $('#btn_edit_quotation').click(function(){
                    
                    var v_quotation_child_id=$("#txt_quotation_child_id").val();
                    var v_quotation_company_name=$("#txt_quotation_company_name").val();
                    var v_quotation_company_id=$("#txt_quotation_company_id").val();
                    var v_quotation_po_box=$("#txt_quotation_po_box").val();
                    var v_quotation_contact_no=$("#txt_quotation_contact_no").val();
                    var v_quotation_fax=$("#txt_quotation_fax").val();
                    var v_quotation_attn=$("#txt_quotation_attn").val();
                    var v_quotation_no=$("#txt_quotation_no").val();
                    var v_quotation_date=formatDate($("#txt_quotation_date").val());
                    var v_quotation_ref=$("#txt_quotation_ref").val();
                    // const editorData1 = editor1.getData();
                    // var v_quotation_subject=editorData1;
                    var v_quotation_subject=$('#txt_subject').val();
                    var v_project_name=$("#div_project_select_combo option:selected").text();
                    var v_project_id=$("#div_project_select_combo option:selected").val();
                    
                     var v_introduction_name=$("#div_subject_combo option:selected").text();
                    var v_introduction_id=$("#div_subject_combo option:selected").val();
                    
                    // alert(v_quotation_company_name);
                     const editorData = editor.getData();
                   
                    var v_quotation_all_description= editorData;
                     var v_tax_content=$('#txt_tax_content').val();
                     var v_quotation_net_amount= $("#txt_quotation_total_amount_edit").val();
                    var v_discount_type=$("#div_discount_type option:selected").val();
                    var v_discount_amount=$("#txt_total_discount").val();
                  
                    var v_total_discount=$("#txt_discount_amount_total").val();
                   
                    var v_quotation_sub_total=pageTotal1;
                   
                    
                    
                     
                     var v_quotation_sub_total=pageTotal1;
               
                    // alert(v_quotation_company_name+'----'+v_quotation_po_box+'----'+v_quotation_contact_no+'----'+v_quotation_fax+'-----'+v_quotation_attn+'----'+v_quotation_date+'---'+v_quotation_ref+'-----'+''+v_quotation_subject);
            
                 
                    if($.trim(v_quotation_company_id)=="0"||$.trim(v_quotation_company_id)==" " ||$.trim(v_quotation_company_name)=="Select Company" || $.trim(v_quotation_company_name)==" " ||$.trim(v_quotation_po_box)==""||$.trim(v_quotation_contact_no)==""||$.trim(v_quotation_fax)==""||$.trim(v_quotation_attn)==" "||$.trim(v_quotation_date)==""||$.trim(v_quotation_ref)==""||$.trim(v_quotation_subject)==""||
                    $.trim(v_quotation_all_description)=="" || $.trim(v_project_id) == "0" || $.trim(v_introduction_id)=="0")
                    {
                        swal("Warning","Please provide all the details ....", "warning");
                        v_but_quotation_edit.ladda( 'stop' );
                        return false;
                    }
                    
                    
                   
                    else
                    {         
                         $.post("../controller/quotation_new/quotation_new_controller.php",{action:'edit_quotation',v_quotation_company_name:v_quotation_company_name,v_company_id:v_quotation_company_id,
                         v_quotation_po_box:v_quotation_po_box,v_quotation_contact_no:v_quotation_contact_no,v_quotation_fax:v_quotation_fax,
                         v_quotation_attn:v_quotation_attn,v_quotation_no:v_quotation_no,v_quotation_date:v_quotation_date,v_quotation_ref:v_quotation_ref,
                         v_quotation_subject:v_quotation_subject,v_quotation_no:v_quotation_no,
                         v_quotation_all_description:v_quotation_all_description,v_quotation_child_id:v_quotation_child_id,v_project_name:v_project_name,v_project_id:v_project_id,v_introduction_name:v_introduction_name,v_introduction_id:v_introduction_id,v_quotation_sub_total:v_quotation_sub_total,v_quotation_net_amount:v_quotation_net_amount,v_discount_type:v_discount_type,v_total_discount:v_total_discount,v_discount_amount:v_discount_amount,v_tax_content:v_tax_content
                                }
                                , function(result,status)
                                {
                                   
                                result = $.trim(result);
                               
                                if(result.charAt(0)=='U')
                                {
                                    v_but_quotation_edit.ladda( 'stop' );
                                    swal("Error", result, "error");
                                    //load_data_to_grid_quotation_list()
                                    clear_text();
                                   
                                   

                                
                                }
                                else
                                {
                                     v_but_quotation_edit.ladda( 'stop' );
                                    
                                    
                                     $.toast({
                                        heading: 'Success',
                                        text: 'Quotation Edited Successfully..!',
                                        showHideTransition: 'slide',
                                        icon: 'success'
                                    });
                                     $( '#btn_quotation_add' ).show();
                                     $( '#btn_quotation_edit' ).hide();
                                    
                                      
                                     
                                    load_data_to_grid_quotation_list( v_quotation_no);
                                     clear_text()
                                    
                                }
                            
                        }); 
                     }
            
                    
                    
                });        
                
                  
                 
                $('#btn_quotation_print').click(function(){
                    var quotation_number=$('#txt_quotation_no').val();
                   
                    if($.trim(quotation_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/quotation_new/quotation_new_controller.php",{action:'quotation_status',v_quotation_no:quotation_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_quotation_status=obj.data[0].quotation_status;
                       if(v_quotation_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/pdf/quotation/index.php?quotation_number="+quotation_number,"_blank"); 
                       }
                       
                       });
                      
                       
                    }
                    
                    
                });
                
                 $('#btn_quotation_print_without_head').click(function(){
                     
                      var quotation_number=$('#txt_quotation_no').val();
                        if($.trim(quotation_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/quotation_new/quotation_new_controller.php",{action:'quotation_status',v_quotation_no:quotation_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_quotation_status=obj.data[0].quotation_status;
                       if(v_quotation_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                         window.open("reports/pdf/print/index.php?quotation_number="+quotation_number+"&x=1","_blank"); 
                       }
                       
                       });
                      
                       
                    }
                      
                 });
                  
                 $('#btn_quotation_print_with_head').click(function(){
                      var quotation_number=$('#txt_quotation_no').val();
                           if($.trim(quotation_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/quotation_new/quotation_new_controller.php",{action:'quotation_status',v_quotation_no:quotation_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_quotation_status=obj.data[0].quotation_status;
                       if(v_quotation_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/pdf/print/index.php?quotation_number="+quotation_number+"&x=0","_blank"); 
                       }
                       
                       });
                      
                       
                    }
                     
                 });  
				 
				 $('#btn_quotation_export_excel').click(function(){
                      var quotation_number=$('#txt_quotation_no').val();
                           if($.trim(quotation_number)=="")
                    {
                         $.toast({
                                        heading: 'Error',
                                        text: 'Please select or create quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                        return false;
                    }
                    else
                    {
                       $.post("../controller/quotation_new/quotation_new_controller.php",{action:'quotation_status',v_quotation_no:quotation_number},function(result,status){
                       var obj= jQuery.parseJSON(result);
                       var v_quotation_status=obj.data[0].quotation_status;
                       if(v_quotation_status=="Pending")
                       {
                                   $.toast({
                                        heading: 'Error',
                                        text: 'Please generate quotation for print',
                                        showHideTransition: 'slide',
                                        icon: 'error'
                                    });
                             return false;
                           
                       }
                       else
                       {
                          window.open("reports/quotation_print_with_head_v1.php?quotation_number="+quotation_number+"&x=0","_blank"); 
                       }
                       
                       });
                      
                       
                    }
                     
                 });
                  
                 $('#btn_view_list_of_cancelled_quotation').click(function(){
                    
                     var v_start_date_year= new Date().getFullYear();
                     $("#txt_cancel_start_date").val('01'+'/'+'01'+'/'+v_start_date_year);
                    load_data_to_grid_view_cancel_quotation_list(); 
                     
                 });   
                 
                 $('#btn_view_list_of_quotations').click(function(){
                    
                     var v_start_date_year= new Date().getFullYear();
                     $("#txt_start_date").val('01'+'/'+'01'+'/'+v_start_date_year);
                     
                     var session_id = $('#head_session_user_id').val();
                     if(session_id==1){
                         load_data_to_grid_view_quotation_list(false); 
                     }
                     else{
                         load_data_to_grid_view_quotation_list(true); 
                     }
                    
                    
                     
                 });  
                 
                 function load_data_to_grid_view_cancel_quotation_list()
                 {
                     quotation_view_cancel_list_table.destroy();
                         
                     quotation_view_cancel_list_table = $('#list_of_cancel_quotations').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/quotation_new/quotation_new_controller.php',
                                 'data': {
                                    action: 'list_of_cancel_quotations',
                                    
                                    
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
                            "columns": [
                              
                                 { "data": "quotation_main_id","visible":false },
                                 { "data": "quotation_date"},
                                 { "data": "quotation_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 { "data": "quotation_main_id" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
            						
            								var	str_active_status_view = '<button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancel_quotations" name="view_cancel_quotations" ><i class="material-icons ">remove_red_eye</i></button>';
            								
            								return str_active_status_view;
            
            							 },
            							 
            					

					 
					         }
                              ,
                            							  
                             ],
                             pageLength: 25,
            				 searching: true,
                             responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                                                      
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 }
                 
                 
                 function load_data_to_grid_view_cancel_quotation_list_between(v_quotation_from_date,v_quotation_to_date)
                 {
                      quotation_view_cancel_list_table.destroy();
                         
                     quotation_view_cancel_list_table = $('#list_of_cancel_quotations').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/quotation_new/quotation_new_controller.php',
                                 'data': {
                                    action: 'list_quotation_cancel_view_between',
                                    v_quotation_from_date:v_quotation_from_date,
                                    v_quotation_to_date:v_quotation_to_date
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
                            "columns": [
                              
                                 { "data": "quotation_main_id","visible":false },
                                 { "data": "quotation_date"},
                                 { "data": "quotation_number"},
                                 { "data": "company_name"},
                                 { "data": "sub_total",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 { "data": "quotation_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCancel()" id="view_cancel_quotations" name="view_cancel_quotations" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         }
                             ],
                             pageLength: 25,
            				 searching: false,
                             responsive: true,
            				
                            
                            
                             "initComplete": function( settings, json ) {
                              
                               
             
                              },
                              "fnDrawCallback": function() {
                               
             
                             }
                        
                         
                     });  
                
                 
                 }
                 
                 
                 $('#list_of_cancel_quotations tbody').on('click', 'td button', function (){
                         var $row = $(this).closest('tr');
                        var data = quotation_view_cancel_list_table.row($row).data();
                        v_quotation_number  = data.quotation_number;
                        // $('#div_company_select option').map(function () {
                        // if ($(this).text() == data.company_name) return this;
                        // }).attr('selected', 'selected');
                        
                        $("#select_company").val(data.company_id);
                        $("#select_company").trigger("chosen:updated");
                        //$('#div_company_select option[value='+data.company_id+']').prop('selected','selected');  
                        $("#txt_quotation_company_id").val(data.company_id);
                        $("#txt_quotation_company_name").val(data.company_name);
                       
                        $("#txt_quotation_po_box").val(data.po_box);
                        $("#txt_quotation_contact_no").val(data.telephone_no);
                        $("#txt_quotation_fax").val(data.fax);
                        $("#txt_quotation_attn").val(data.attn);
                        $("#txt_quotation_no").val(data.quotation_number);
                        
                     
                         $('#div_subject_combo option').map(function () {
                        if ($(this).text() == data.introduction_name) return this;
                        }).attr('selected', 'selected');
                        
                  
                        var qut_date=data.quotation_date.split(' ');
                        var quotation_date= qut_date[0].split('-');
                        var quotation_data=quotation_date[1]+'/'+quotation_date[0]+'/'+quotation_date[2];
                        
                        $("#txt_quotation_date").val(quotation_data);
                         $("#div_project_select_combo").load('../controller/quotation_new/quotation_new_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                                   if(status=="success")
                                   {
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).text() == data.project_name) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
                        });
                        
                      
                        
                       
                        $("#txt_quotation_ref").val(data.quotation_reference);
                        $('#txt_subject').val(data.subject);
                        
                        
                         
                        load_data_to_grid_quotation_list(data.quotation_number);
                       
                         const editorData = editor.setData(data.description);
                   
                         var v_quotation_all_description= editorData;
                       
                        $("#editor").val(v_quotation_all_description);
                        //$( '#btn_quotation_add' ).hide();
                       // $( '#btn_quotation_edit' ).show();
                        
                        
                        $("#quotation_no_head").html(data.quotation_number);
                         $('#btn_generate_quotation' ).hide();
                         $('#btn_edit_quotation' ).hide();
                         
                        
                        closeNavRCancel();
                       
                 }); 
                 
                   $("#btn_search_company_approve_prjct").click(function(){
                
                     var v_company_id = $("#div_company_select_list option:selected").val();
                     var v_project_id = $("#div_project_select_combo_list option:selected").val();
                     var option_select = $('#div_company_select_approve option:selected').val();
				
                     load_data_to_grid_view_quotation_company(btn_approval=false,v_company_id,v_project_id,option_select);
                           
            })
          
           
           function load_data_to_grid_view_quotation_company(btn_approval=false,v_company_id,v_project_id,option_select)
           {
               
              quotation_view_list_company.destroy();
                     
                     quotation_view_list_company = $('#list_of_quotations_company').DataTable( {
                            
                             "ajax": {
                                 'type': 'POST',
                                 'url': '../controller/quotation_new/quotation_new_controller.php',
                                 'data': {
                                    action: 'list_quotation_company_list',
                                    v_company_id:v_company_id,
                                    v_project_id:v_project_id,
                                    option_select:option_select
                                 }
                             },
                             "language": {
                                 "zeroRecords": "No records available",
                                 "infoEmpty": "No records available",
                              },
                            "order": [[ 0, "desc" ]],
            				"bPaginate": false,
   
                            "columns": [
                              
                                 { "data": "quotation_main_id","visible":false },
                                 { "data": "quotation_date"},
                                 { "data": "quotation_number"},
                                 { "data": "company_name", visible:false},
                                 { "data": "project_name"},
                                 { "data": "project_number"},
                                 { "data": "sub_total",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                                 { "data": "discount_amount",className: "text-center"},
                                 { "data": "quotation_main_id" ,
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavRCompany()" id="view_quotations" name="view_quotations" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                							 
                					
    
    					 
    					         },
    					     
								 { "data": "approved_status" ,
					 
                     
                                      render: function ( data, type, rows, meta ) {
                                          
                                          if(!btn_approval)
                                          {
                        						if(rows['approved_status']=='Pending')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm primary-gradient mr-2"  id="approval" name="approval" ><i class="material-icons">check_circle</i></button>';
                        								
                                               
            									}
            									
            									if(rows['approved_status']=='Approved')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm  mr-2" style="    background-color: green !important;color: #fff;" id="approval" name="approval" ><i class="material-icons">check_circle</i></button>';
                        								
                                                
            									}
            											return approval_status;
                                            }
                                            else{
                                                
                                                	if(rows['approved_status']=='Pending')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm primary-gradient mr-2"  id="approval" name="approval" disabled><i class="material-icons">check_circle</i></button>';
                        								
                                               
            									}
            									
            									if(rows['approved_status']=='Approved')
            									{
                            							
                        								var	approval_status = '<button type="button" class="btn btn-sm  mr-2" style="    background-color: green !important;color: #fff;" id="approval" name="approval" disabled><i class="material-icons">check_circle</i></button>';
                        								
                                                
            									}
            											return approval_status;
                                                
                                            }
            							 },
            							 
            					

					 
					         },
             
                             ],
                              dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'excelHtml5',
                                    title: 'Quotation_List',
                                    text: '<i class="material-icons">grid_on</i> Excel',
                                    className: 'btn btn-sm btn-success',
                                     exportOptions: {
                                        columns: [0,1, 2, 3,4, 5,6]  // Export only these column indexes
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: 'Quotation_List',
                                    orientation: 'landscape',
                                    pageSize: 'A4',
                                    text: '<i class="material-icons">picture_as_pdf</i> PDF',
                                    className: 'btn btn-sm btn-danger',
                                    exportOptions: {
                                            columns: [0,1, 2,3, 4, 5,6]  // Export only these column indexes
                                        }
                                },
                                {
                                    extend: 'print',
                                    title: 'Quotation_List',
                                    text: '<i class="material-icons">print</i> Print',
                                    className: 'btn btn-sm btn-info',
                                     exportOptions: {
                                        columns: [0,1, 2,3, 4, 5,6]  // Export only these column indexes
                                    }
                                }
                            ],
                             pageLength: 25,
            				 searching: true,
                             responsive: true,
            				
                            
                            
							 
                        
                         
                     });   
               
               
               
           }
           
           
           $("#div_company_select_list").change(function() {
                      var company_id=$('option:selected', this).val() ;
                      $("#div_project_select_combo_list").load('../controller/quotation_new/quotation_new_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:company_id},function(result,status){
                            
                               });
            });
            
            
            
              $('#list_of_quotations_company tbody').on('click', 'td button', function (){
                        var $row = $(this).closest('tr');
                        var data = quotation_view_list_company.row($row).data();
                        v_quotation_number  = data.quotation_number;
                        var v_quotation_from_date = formatDate($("#txt_start_date").val());
                        var v_quotation_to_date = formatDate($("#txt_end_date").val());       
                       
                        $('#txt_quotation_description').val('');
                        $('#txt_quotation_quantity').val('');
                        $('#txt_quotation_unit').val('');
                        $('#txt_quotation_rate').val('0.000');
                        $('#txt_quotation_amount').val('0.000');
                        $('#txt_discount_percentage').val('0.000');
                        $('#txt_amt_after_discount').val('0.000');
                        $('#txt_tax_percentage').val('0.000');
                        $('#txt_net_amount').val('0.000');
                        $( '#btn_quotation_add' ).show();
                        $( '#btn_quotation_edit' ).hide();
                        
                        if($(this).attr("name")=='view_quotations')
                         {
                             if(data.approved_status=='Pending')
                             {
                                 $('#txt_tax_content').prop('disabled', false);
                             }
                             else
                             {
                                  $('#txt_tax_content').prop('disabled', true);
                             }
            			    edit_data(); 
            			
            			 }
						 
						 if($(this).attr("name")=='approval')
                         {
                             
                         console.log(data.discount_amount);
                         if(data.discount_amount==0.000 ){
                          var v_approved_status= data.approved_status;
                          
                    			 $.post("../controller/quotation_new/quotation_new_controller.php",{action : "quotation_approval",v_quotation_number:v_quotation_number,v_approved_status:v_approved_status},function(res){
        	                     swal("success","Quotation approved status changed successfully ....", "success");
        			             if(flag==0)
        						 {
        				// 		 load_data_to_grid_view_quotation_list();
        				         var session_id = $('#head_session_user_id').val();
                                 if(session_id==1){
                                     load_data_to_grid_view_quotation_list(false); 
                                 }
                                 else{
                                     load_data_to_grid_view_quotation_list(true); 
                                 }
        				
        						 }
        						 else{ 
        						  //  load_data_to_grid_view_quotation_list_between(v_quotation_from_date,v_quotation_to_date);
        						    var session_id = $('#head_session_user_id').val();
        						    if(session_id==1){
                                     load_data_to_grid_view_quotation_list_between(false,v_quotation_from_date,v_quotation_to_date);
                                     }
                                     else{
                                         load_data_to_grid_view_quotation_list_between(true,v_quotation_from_date,v_quotation_to_date); 
                                     }
        						 }
        						 });
                         }
                         else
                         {
                             swal("error","Discount Amount is not zero ....", "error");
                         }
            			
            			 }
						 
            			 
            			  if($(this).attr("name")=='delete_quotations')
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
            						
            						       cancel_quotation(v_quotation_number);
            						       
            						       
                         				   //load_data_to_grid_view_quotation_list(); 
                         				    var session_id = $('#head_session_user_id').val();
                                             if(session_id==1){
                                                 load_data_to_grid_view_quotation_list(false); 
                                             }
                                             else{
                                                 load_data_to_grid_view_quotation_list(true); 
                                             }
                         				   
            							} else {
            							    
            							   
            							 
            							}
            						 });
                             
                         }     
                        
                        
                      
                     function  edit_data() 
                       {
                       // alert(data.company_name);
                        // $('#div_company_select option').map(function () {
                        // if ($(this).val() == $.trim(data.company_id)) return this;
                        // }).attr('selected', 'selected');
                        $("#select_company").val(data.company_id);
                        $("#select_company").trigger("chosen:updated");
                        
                        //$('#div_company_select option[value='+data.company_id+']').prop('selected','selected');  
                        $("#txt_quotation_company_id").val(data.company_id);
                        $("#txt_quotation_company_name").val(data.company_name);
                        $("#txt_project_no").val(data.project_number);
                        $("#txt_quotation_po_box").val(data.po_box);
                        $("#txt_quotation_contact_no").val(data.telephone_no);
                        $("#txt_quotation_fax").val(data.fax);
                        $("#txt_quotation_attn").val(data.attn);
                        $("#txt_quotation_no").val(data.quotation_number);
                        $("#txt_tax_content").val(data.tax_content);
                     
                         $('#div_subject_combo option').map(function () {
                        if ($(this).text() == data.introduction_name) return this;
                        }).attr('selected', 'selected');
                        
                          
                        var qut_date=data.quotation_date.split(' ');
                        var quotation_date= qut_date[0].split('-');
                        var quotation_data=quotation_date[1]+'/'+quotation_date[0]+'/'+quotation_date[2];
                        
                        $("#txt_quotation_date").val(quotation_data);
                         $("#div_project_select_combo").load('../controller/quotation_new/quotation_new_controller.php',{action:'select_company_project',v_ctrl_name:'select_project',v_company_id:data.company_id},function(result,status){
                                   if(status=="success")
                                   {
                                       $('#div_project_select_combo option').map(function () {
                                        if ($(this).text() == data.project_name) return this;
                                        }).attr('selected', 'selected');
                                     // $('#div_project_select_combo option[value='+data.project_id+']').prop('selected','selected');  
                                   }
                        });
                        
                      
                        
                       
                        $("#txt_quotation_ref").val(data.quotation_reference);
                        $('#txt_subject').val(data.subject);
                        
                        
                         
                        load_data_to_grid_quotation_list(data.quotation_number);
                        var total_amount_edit=parseFloat(data.sub_total)-parseFloat(data.total_discount_amount)
                        $("#txt_quotation_total_amount").val(data.sub_total);
                        $("#txt_quotation_total_amount_edit").val(data.sub_total);
                        $("#txt_quotation_total_amount").hide();
                         $("#txt_quotation_total_amount_edit").show();
                        $("#txt_total_discount").val(data.discount_amount);
                        $('#div_discount_type option').map(function () {
                        if ($.trim($(this).text()) == $.trim(data.discount_type)) return this;
                        }).attr('selected', 'selected');
                       
                         const editorData = editor.setData(data.description);
                   
                         var v_quotation_all_description= editorData;
                       
                        $("#editor").val(v_quotation_all_description);
                        //$( '#btn_quotation_add' ).hide();
                       // $( '#btn_quotation_edit' ).show();
                        
                        
                        $("#quotation_no_head").html(data.quotation_number);
                         $('#btn_generate_quotation' ).hide();
                         
                         var session_id = $('#head_session_user_id').val();
                         if(session_id==1){
                             $('#btn_edit_quotation' ).show();
                         }
                         else{
                             $('#btn_edit_quotation' ).hide();
                         }
                         
                         
                        
                        closeNavR();
                        closeNavRCompany();
                       }  
                        
                 });
                 
                  
                  

});