$(document).ready(function(){
    
    
        v_btn_add_allowence = $("#btn_allowence_save").ladda();
        v_btn_add_deduction = $("#btn_deduction_save").ladda();
        v_btn_employee_register = $("#btn_employee_register").ladda();
         var tbl_salary_slip_list = $('#tbl_salary_slip_list').DataTable({ searching: false, paging: false, info: false, ordering: false,
                    columnDefs: [
                        { targets: [2, 8], visible: false } // Adjust column indices as needed
                    ]
                });
                
                   
            // Apply className properties to specific columns
                 tbl_salary_slip_list.on('draw', function () {
                tbl_salary_slip_list.cells().every(function (rowIdx, colIdx) {
                    var column = this.column(colIdx);
                    if ([0, 3, 4, 9].includes(colIdx)) {
                        $(column.nodes()).addClass('text-center');
                    } else if ([5, 6].includes(colIdx)) {
                        $(column.nodes()).addClass('text-right');
                    }
                });
            });
            
            // tbl_salary_slip_list.column([4, 5]).nodes().to$().addClass('number-format'); // Ad
            $('.text-center').css('text-align', 'center');
            $('.text-right').css('text-align', 'right');
            $('.number-format').each(function() {
                // var text = $(this).text().trim(); // Get the text content
                // var number = parseFloat(text.replace(/,/g, '')); // Parse the number (remove commas)
                
                if (!isNaN(number)) {
                    var formattedNumber = number.toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                    $(this).text(formattedNumber); // Update the text content with the formatted number
                }
            });
            var today = new Date();
            var formated_date=formatDate(today);
            $("#txt_date").val(formated_date);
                    
            var list_of_salary_slip = $('#list_of_salary_slip').DataTable({ searching: false, paging: false, info: false, ordering: false });
                
             var basic_salary_list = $('#basic_salary_list').DataTable({ searching: false, paging: false, info: false, ordering: false }); 
                
            $('#div_final_stlmt').hide();    
                
    $('#div_employee_select').load('templates/employee_names_com_for_salary.php');
    $('#div_allowence_select').load('templates/allowence_load_combo.php');
    $('#div_deduction_select').load('templates/deduction_load_combo.php');
    $('#div_divis_select_for_search').load('templates/division_load_combo.php');
    $('#div_dpt_select_for_search').load('templates/department_load_combo.php');
    $('#div_employee_select_for_search').load('templates/employee_names_load_second.php');
    
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
    
    
    
    $("#btn_new_salary_slip").click(function()
    {
        location.reload();
    });
    
    $('#btn_add_allowence').click(function(){
        $('#modal_allowence_add').modal('show');
    });  
    
    
   
   var clickedOnce = false;
    var timer;

  
    
     //   *************************add allowence*******************************
    v_btn_add_allowence.click(function(){
      
        v_btn_add_allowence.ladda( 'start' );           
	
	
		var v_allowence_name=$("#txt_allowence_name").val();
                  

		if(v_allowence_name==="")
		{ 
	       v_btn_add_allowence.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_allowence_name);
			$.post("../controller/allowence/allowence_controller.php",
			{action:'add_allowence',v_allowence_name:v_allowence_name}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_add_allowence.ladda( 'stop' );
				if(result=="exist")
				{
					 $.toast({
						heading: 'Warning',
						text: 'Allowence Name Already Exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
				}
				else
				{
				     $.toast({
						heading: 'Success',
						text: 'Allowence Added Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_allowence_name").val("");
				    $('#div_allowence_select').load('templates/allowence_load_combo.php');
				// 	location.reload();
		    });
                
		}
    });
    // *******************************end***************************************
    
    $('#btn_add_deduction').click(function(){
        $('#modal_deduction_add').modal('show');
    });
    
     // ******************* add deduction***************************************
    
     v_btn_add_deduction.click(function(){
      
        v_btn_add_deduction.ladda( 'start' );           
	
	
		var v_deduction_name=$("#txt_deduction_name").val();
                  

		if(v_deduction_name==="")
		{ 
	       v_btn_add_deduction.ladda( 'stop' );
	       swal('Warning',"Please fill the required field","warning");
		}
		else
		{	
		    
		  //  alert(v_allowence_name);
			$.post("../controller/allowence/allowence_controller.php",
			{action:'add_deduction',v_deduction_name:v_deduction_name}, 
			function(result,status)
			{   
				result = $.trim(result);
				console.log(result);
				v_btn_add_deduction.ladda( 'stop' );
				if(result=="exist")
				{
					 $.toast({
						heading: 'Warning',
						text: 'Deduction Name Already Exist..!',
						showHideTransition: 'slide',
						icon: 'warning'
					});
				}
				else
				{
				     $.toast({
						heading: 'Success',
						text: 'Deduction Added Successfully..!',
						showHideTransition: 'slide',
						icon: 'success'
					});
				}
				    $("#txt_deduction_name").val("");
				     $('#div_deduction_select').load('templates/deduction_load_combo.php');
				// 	location.reload();
		    });
                
		}
    });
//   **********************************end**************************************
    
    
    // **************************load employee details**************************
    $("#div_employee_select").on("change","#select_employee_search", function() {
        $('#loadingWrapper').show();  
        var v_emp_id=$("#select_employee_search option:selected").val();
        $("#txt_basic_salary").val("");
        $.post("../controller/salary/salary_controller.php",
			{action:'load_employee_details',v_emp_id:v_emp_id}, 
			function(result,status)
			{
			    if(status=="success")
                                        {
                                      try
                                      {
                                        console.log(result);    
                                        var obj= jQuery.parseJSON(result);
                                        $("#employee_division").val(obj.data[0].division_name);
                                        $("#employee_department").val(obj.data[0].dpmt_name);
                                        $("#contact_no").val(obj.data[0].contact_no);
                                        $("#employee_id").val(obj.data[0].employee_id);
                                        $("#txt_normal_ot").val(obj.data[0].normal_ot_amt);
                                        $("#txt_special_ot").val(obj.data[0].special_ot_amt);
                                        $("#txt_duty_hr").val(obj.data[0].duty_hr);
                                        //$("#txt_days").val(obj.data[0].days);
                                        $("#txt_days").val(30);
                                        $("#txt_starting_time").val(obj.data[0].starting_time);
                                        $("#txt_ending_time").val(obj.data[0].ending_time);
                                        $("#txt_gosi_pr").val(obj.data[0].gosi_pr);
                                        $("#txt_travel_allo_rt").val(obj.data[0].travel_allo_rate);
                                        $("#txt_indemnity_rt").val(obj.data[0].indemnity_rate);
                                        $("#txt_rejoining_date").val(obj.data[1].rejoin_date);
                                        $("#txt_basic_salary").val(obj.data[2].earning_amt);
                                      }
                                      catch (error) {
                                          $('#loadingWrapper').hide();  
                                      }
                                        }
                                        else
                                        {
                                            return false;
                                        } 
                                        $('#loadingWrapper').hide();  
			});
        
    });
    
    
    // ***********************************end***********************************
    
    
    // *****************************last date change****************************
            $("#txt_last_date").on("change", function() {
                var v_rejoining = formatDate($("#txt_rejoining_date").val());
                var v_last = formatDate($("#txt_last_date").val());
                
                months_calc(v_rejoining,v_last);
               
            });
    // ***********************************end***********************************
    
    // **********************months calculation*********************************
    
     function months_calc(v_rejoining,v_last){
                     v_rejoining=new Date(v_rejoining);
                v_last=new Date(v_last);
               var differenceMs = Math.abs(v_last - v_rejoining);
                // Convert milliseconds to days
                var differenceDays = Math.ceil(differenceMs / (1000 * 60 * 60 * 24));
                // var months=((parseFloat(differenceDays)/365)*12).toFixed(3);
                var monthsDifference = Math.floor(differenceDays / 30.41);
                var remainingDays = (differenceDays % 30.41).toFixed(0);
               var result = monthsDifference + '.' + remainingDays;
                $("#txt_calc_month").val(result);
                $("#lbl_number_of_days").val(differenceDays);
                
                
                }
    
    // *************************end*********************************************
    
    
    
    
    var counter = 1;
    let totalAlloAmt = 0;
    let totalDeduAmt = 0;
    let netamount = 0;
    // *********************table salay slip****************************
    
     function view_salary_slip_list(allo_dedu,allo_dedu_id,hrs,days,allo_amt,dedu_amt,desc,status,showDeleteButton = true)
                    { 
                         totalAlloAmt += parseFloat(allo_amt);
                        totalDeduAmt += parseFloat(dedu_amt);
                        netamount=parseFloat(totalAlloAmt)-parseFloat(totalDeduAmt);
                         var totalAlloAmt_for_table=parseFloat(totalAlloAmt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            var totalDeduAmt_for_table=parseFloat(totalDeduAmt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            var netamount_for_table=parseFloat(netamount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                        $('#total_allowance_amount').text(totalAlloAmt_for_table);
                        $('#total_deduction_amount').text(totalDeduAmt_for_table);
                        $('#span_net_amount').text(netamount_for_table);
                        let deleteButtonHtml = showDeleteButton ? '<button class="btn btn-danger btn-sm delete-row">Delete</button>' : '';
                    
                    
                    tbl_salary_slip_list.row.add([
                    counter++,
                    allo_dedu,
                    allo_dedu_id,
                    hrs,
                    days,
                    allo_amt,
                    dedu_amt,
                    desc,
                    status,
                    deleteButtonHtml
                        ]).draw();
                    }
                       
                        // Attach click event handler to delete button
                        $('#tbl_salary_slip_list').on('click', '.delete-row', function() {
                            var row = $(this).closest('tr');
                            var rowData = tbl_salary_slip_list.row(row).data();
                            
                            var alloAmt = parseFloat(rowData[5]) || 0;
                             var deduAmt = parseFloat(rowData[6]) || 0;
                            
                            totalAlloAmt -= alloAmt; // Subtract allowance amount
                            totalDeduAmt -= deduAmt; // Subtract deduction amount
                            netamount=parseFloat(totalAlloAmt)-parseFloat(totalDeduAmt);
                            var totalAlloAmt_for_table=parseFloat(totalAlloAmt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            var totalDeduAmt_for_table=parseFloat(totalDeduAmt).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            var netamount_for_table=parseFloat(netamount).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            $('#total_allowance_amount').text(totalAlloAmt_for_table); // Update total allowance amount in footer
                            $('#total_deduction_amount').text(totalDeduAmt_for_table); // Update total deduction amount in footer
                            $('#span_net_amount').text(netamount_for_table);
                            tbl_salary_slip_list.row(row).remove().draw(false);
                        });
                                    
                    // }
      
    
    // *********************************end*************************************
    
    // ********************allowence change*************************************
    
     $("#div_allowence_select").on("change", function() {
         var v_allo_id=$("#select_allowence_search option:selected").val();
         if(v_allo_id==1){
             var basic= $("#txt_basic_salary").val();
             $("#txt_allo_amount").val(basic);
             $("#txt_allo_amount").prop("disabled", false);
         }
         else
         {
             $("#txt_allo_amount").val("");
             $("#txt_allo_amount").prop("disabled", false);
         }
         
         if(v_allo_id==2 || v_allo_id==3){
             $('#label_allo').text('Hrs');
             $("#txt_allo_amount").prop("disabled", false);
         }
         else if(v_allo_id==4 || v_allo_id==5){
             $('#label_allo').text('Days');
              $("#txt_allo_amount").val(30);
              $("#txt_allo_amount").prop("disabled", true);
         }
         else if(v_allo_id==6){
             $('#label_allo').text('Days');
             $("#txt_allo_amount").prop("disabled", false);
         }
         else{
             $('#label_allo').text('Amount');
             $("#txt_allo_amount").prop("disabled", false);
         }
         
     });
    
    // *****************************end*****************************************
    
    
    
    
    // *********************click btn save allowence****************************
    
    $("#btn_save_allo").click(function(){
        	var v_emp_name_id=$("#select_employee_search option:selected").val();
        	
        	var v_duty_hr=$("#txt_duty_hr").val();
        	var v_days=$("#txt_days").val();
        	var v_start_time=$("#txt_starting_time").val();
        	var v_end_time=$("#txt_ending_time").val();
        	var v_normal_ot=$("#txt_normal_ot").val();
            var v_special_ot=$("#txt_special_ot").val();
            var v_allo_id=$("#select_allowence_search option:selected").val();
            var v_allo_title=$("#select_allowence_search option:selected").text();
            var v_allo_amt_hr=$("#txt_allo_amount").val();
            var v_number_of_days=$("#lbl_number_of_days").val();
            var v_allo_desc=$("#txt_allo_desc").val();

            if($.trim(v_emp_name_id)==0 || $.trim(v_duty_hr)=="" || $.trim(v_days)=="" || $.trim(v_start_time)=="" || $.trim(v_end_time)=="" || $.trim(v_normal_ot)=="" || $.trim(v_special_ot)=="" || $.trim(v_allo_id)==0 || $.trim(v_allo_amt_hr)=="") 
			     {
				    swal("Warning","Please fill the required field", "warning");
					return false;
				 }
				 else
				 {
				  
				     switch(parseInt(v_allo_id))
				     {
				         case 1:
				             console.log('Case 1');
				             var v_allo_mt=$("#txt_allo_amount").val();
				            $("#txt_basic_salary").val(v_allo_mt);
				            v_allo_amt_hr = parseFloat(v_allo_amt_hr).toFixed(3);
				            view_salary_slip_list(v_allo_title,v_allo_id,0.00,0.00,v_allo_amt_hr,0.00,v_allo_desc,"Allowence",true);
			             break;
			             case 2:
			                 console.log('Case 2');
				             var basic_sal = $("#txt_basic_salary").val();
    				         var allo_amount= (((parseFloat(basic_sal)/30)/parseFloat(v_duty_hr))*(parseFloat(v_allo_amt_hr)*parseFloat(v_normal_ot))).toFixed(3);
    				        //  var allo_amount= parseFloat(v_allo_amt_hr)*parseFloat(v_normal_ot);
    				         view_salary_slip_list(v_allo_title,v_allo_id,v_allo_amt_hr,0.00,allo_amount,0.00,v_allo_desc,"Allowence",true);
			             break;
			             case 3:
			                 console.log('Case 3');
				             var basic_sal = $("#txt_basic_salary").val();
    				         var allo_amount= (((parseFloat(basic_sal)/30)/parseFloat(v_duty_hr))*(parseFloat(v_allo_amt_hr)*parseFloat(v_special_ot))).toFixed(3);
    				        //  var allo_amount= parseFloat(v_allo_amt_hr)*parseFloat(v_special_ot);
    				         view_salary_slip_list(v_allo_title,v_allo_id,v_allo_amt_hr,0.00,allo_amount,0.00,v_allo_desc,"Allowence",true);
			             break;
			             case 4:
			                 console.log('Case 4');
				             var basic_sal = $("#txt_basic_salary").val();
    				         var travel_allo_rt = $("#txt_travel_allo_rt").val();
    				         var days = v_allo_amt_hr;
    				         
    				         var v_cal_months = $("#txt_calc_month").val();
    				         if(v_cal_months==""){
    				             swal("Warning","Enter Last Date", "warning");
    				         }
    				         else{
    				             var allo_amount= ((parseFloat(basic_sal)*parseFloat(travel_allo_rt)*parseFloat(v_cal_months))/parseFloat(days)).toFixed(3);
    				             view_salary_slip_list(v_allo_title,v_allo_id,0.00,v_number_of_days,allo_amount,0.00,v_allo_desc,"Allowence",true);
    				         }
				         
			             break;
			             case 5:
			                 console.log('Case 5');
				             var basic_sal = $("#txt_basic_salary").val();
    				         var indemnity_rt = $("#txt_indemnity_rt").val();
    				         var days = v_allo_amt_hr;
    				         var v_cal_months = $("#txt_calc_month").val();
    				         if(v_cal_months==""){
    				             swal("Warning","Enter Last Date", "warning");
    				         }
    				         else{
    				             var allo_amount= ((parseFloat(basic_sal)*parseFloat(indemnity_rt)*parseFloat(v_cal_months))/parseFloat(days)).toFixed(3);
    				             view_salary_slip_list(v_allo_title,v_allo_id,0.00,v_number_of_days,allo_amount,0.00,v_allo_desc,"Allowence",true);
    				         }
				         
			             break;
			             case 6:
			                 console.log('Case 6');
				             var basic_sal = $("#txt_basic_salary").val();
    				         var days = v_allo_amt_hr;
    				         var allo_amount = ((parseFloat(basic_sal)/30)*parseFloat(v_allo_amt_hr)).toFixed(3);
				             view_salary_slip_list(v_allo_title,v_allo_id,0.00,v_allo_amt_hr,allo_amount,0.00,v_allo_desc,"Allowence",true);
				        
			             break;
			             
			             default:
			                console.log('Case Default');
			                v_allo_amt_hr = parseFloat(v_allo_amt_hr).toFixed(3);
				            view_salary_slip_list(v_allo_title,v_allo_id,0.00,0.00,v_allo_amt_hr,0.00,v_allo_desc,"Allowence",true);
			             break;
				     }
				     
				 }
				  $("#select_allowence_search").val("0").trigger("chosen:updated");
                    $("#txt_allo_amount").val("");
                    $("#txt_allo_desc").val("");
        
    });
    
    // ****************************end******************************************
    
    
    // ***************************ded dropdown change***************************
            $("#div_deduction_select").on("change", function() {
                var v_ded_id=$("#select_deduction_search option:selected").val();
                 var basic_sal = $("#txt_basic_salary").val();
                if(v_ded_id==1){
                    var gosi_pr = $("#txt_gosi_pr").val();
                    var v_gosi_amount= (parseFloat(basic_sal)*(parseFloat(gosi_pr)/100)).toFixed(3);
                    $("#txt_deduc_amount").val(v_gosi_amount);
                }
                if(v_ded_id==2){
                    
                    var v_work_days = $("#txt_days").val();
                    var days_def = 30-parseFloat(v_work_days);
                    var ded_amount = ((parseFloat(basic_sal)/30)*parseFloat(days_def)).toFixed(3);
                    $("#txt_deduc_amount").val(ded_amount);
                }
                       
            });
    
    // *****************************end*****************************************
    
    
     // *********************click btn save deduction****************************
    
    $("#btn_save_dedu").click(function(){
        	var v_emp_name_id=$("#select_employee_search option:selected").val();
        	
        	var v_duty_hr=$("#txt_duty_hr").val();
        	var v_days=$("#txt_days").val();
        	var v_start_time=$("#txt_starting_time").val();
        	var v_end_time=$("#txt_ending_time").val();
        	var v_normal_ot=$("#txt_normal_ot").val();
            var v_special_ot=$("#txt_special_ot").val();
            var v_ded_id=$("#select_deduction_search option:selected").val();
            var v_ded_title=$("#select_deduction_search option:selected").text();
            var v_ded_amt=$("#txt_deduc_amount").val();
            var v_dedc_desc=$("#txt_dedc_desc").val();
            if($.trim(v_emp_name_id)==0 || $.trim(v_duty_hr)=="" || $.trim(v_days)=="" || $.trim(v_start_time)=="" || $.trim(v_end_time)=="" || $.trim(v_normal_ot)=="" || $.trim(v_special_ot)=="" || $.trim(v_ded_id)==0 || $.trim(v_ded_amt)=="") 
			     {
				    swal("Warning","Please fill the required field", "warning");
					return false;
				 }
				 else
				 {
				        v_ded_amt = parseFloat(v_ded_amt).toFixed(3);
				         view_salary_slip_list(v_ded_title,v_ded_id,0.00,0.00,0.000,v_ded_amt,v_dedc_desc,"Deduction",true);
				     
				     
				 }
				  $("#select_deduction_search").val("0").trigger("chosen:updated");
                    $("#txt_deduc_amount").val("");
                    $("#txt_dedc_desc").val("");
        
    });
    
    // ****************************end******************************************
    // ****************************show and hide final settlement div***********
    $('#checkbox').change(function(){
        if($(this).is(':checked')){
            $('#div_final_stlmt').show(); // Show the button if checkbox is checked
        } else {
            $('#div_final_stlmt').hide(); // Hide the button if checkbox is unchecked
        }
    });
    
    // *********************************end*************************************
    
    
    // *****************************generate salary slip************************
    var v_checkbx =0;
    var final_sts='';
    $("#btn_employee_register").click(function(){
        
        v_btn_employee_register.ladda( 'start' ); 
        
          if ($('#checkbox').prop('checked')) {
        v_checkbx=1;
        final_sts="Final Settlement";
        
      } 
         var dataArray = [];

    // Iterate through each row in the DataTable
        tbl_salary_slip_list.rows().every(function() {
        var data = this.data();
        

                dataArray.push({
                    'Counter': data[0],
                    'allo_ded': data[1],
                    'allo_ded_id': data[2],
                    'hrs': data[3],
                    'days': data[4],
                    'allo_amt': data[5],
                    'ded_amt': data[6],
                    'Description': data[7],
                    'status': data[8],
                   
                    // Add other properties as needed
                });
            });
        console.log(dataArray);
            var v_emp_name_id=$("#select_employee_search option:selected").val();
        	var v_emp_name=$("#select_employee_search option:selected").text();
        	var v_duty_hr=$("#txt_duty_hr").val();
        	var v_days=$("#txt_days").val();
        	var v_start_time=$("#txt_starting_time").val();
        	var v_end_time=$("#txt_ending_time").val();
        	var v_normal_ot=$("#txt_normal_ot").val();
            var v_special_ot=$("#txt_special_ot").val();
            var v_note=$("#txt_note").val();
            var v_date=$("#txt_date").val();
            var gosi_pr = $("#txt_gosi_pr").val();
            var travel_allo_rt = $("#txt_travel_allo_rt").val();
            var indemnity_rt = $("#txt_indemnity_rt").val();
            var rejoining_date = $("#txt_rejoining_date").val();
            var last_date = $("#txt_last_date").val();
            var total_months = $("#txt_calc_month").val();
            
        //   alert(netamount);
            if($.trim(v_emp_name_id)==0 || $.trim(v_duty_hr)=="" || $.trim(v_days)=="" || $.trim(v_start_time)=="" || $.trim(v_end_time)=="" || $.trim(v_normal_ot)=="" || $.trim(v_special_ot)=="" || dataArray[0]['status']=="") 
			     {
			                 v_btn_employee_register.ladda( 'stop' ); 

				    swal("Warning","Please fill the required field", "warning");
					return false;
				 }
				 else
				 {
				     $.post("../controller/salary/salary_controller.php",
        			{action:'generate_salary_slip', v_emp_name_id:v_emp_name_id, v_emp_name:v_emp_name, v_duty_hr:v_duty_hr, v_days:v_days, v_start_time:v_start_time, 
        			    v_end_time:v_end_time, v_normal_ot:v_normal_ot, v_special_ot:v_special_ot, v_note:v_note, dataArray:dataArray,netamount:netamount,v_date:v_date,gosi_pr:gosi_pr,v_checkbx:v_checkbx,travel_allo_rt:travel_allo_rt,
        			    indemnity_rt:indemnity_rt,rejoining_date:rejoining_date,last_date:last_date,total_months:total_months
        			}, 
        			function(result,status)
        			{
        			  v_btn_employee_register.ladda( 'stop' );
        			  if(result=='exist'){
        			       swal("Warning","This Month Salary Slip Already Generated", "warning");
        			  }
        			  else{
            			  swal("Success","Salary Slip Generated Successfully", "success");
            			  var firstPart = result.substring(0, result.indexOf('-'));
                            // console.log("first"+firstPart);
                            $("#v_salary_main_id").val(firstPart);
                            $("#v_final_stlmt").val(final_sts);
                            $('#btn_employee_register').hide();
        			  }
        			});
                // 			$("#select_employee_search option:selected").val();
                            	
                            // 	$("#txt_duty_hr").val("");
                            // 	$("#txt_days").val("");
                            // 	$("#txt_starting_time").val("");
                            // 	$("#txt_ending_time").val("");
                            // $("#employee_id").val("");
                            // $("#employee_division").val("");
                            // $("#employee_department").val("");
                            // $("#contact_no").val("");
                            // $("#txt_note").val("");
                    
				 }
        
    });
    
    // **********************************end************************************
    
     // ***********************salary slip list view*******************************
     $("#view_salary_slip").click(function()
		 {
           load_data_to_grid_salary_slip_list();
                // $("#select_employee_search").val(0);
                // $("#select_employee_search").trigger("chosen:updated");
                 $('#txt_start_date').val("");
                $('#txt_end_date').val("");
                 $("#select_department_search").val(0).trigger("chosen:updated");
                $("#select_division_search").val(0).trigger("chosen:updated");
                $("#select_employee_name").val(0).trigger("chosen:updated");
                
		 });
		 
         function load_data_to_grid_salary_slip_list()
		 {
			 list_of_salary_slip.destroy();
				 
			 list_of_salary_slip = $('#list_of_salary_slip').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/salary/salary_controller.php',
						 'data': {
							action: 'list_salary_slips'
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
						 { "data": "emp_name"},
						 { "data": "emp_id"},
						 { "data": "division"},
						 { "data": "department"},
						 { "data": "salary_date"
                				//  "render": function(data, type, row) {
                    //                 // Assuming 'default_date' is in datetime format (e.g., 'YYYY-MM-DD HH:mm:ss')
                    //                 // Convert the datetime to date format ('YYYY-MM-DD')
                    //                 var dateParts = data.split(' ')[0]; // Extract date part from datetime
                    //                 return dateParts;
                    //             }
						 },
						 { "data": "net_amount", className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '') },
					    { "data": "status",
					        "render": function (data, type, row) {
                                                if (data === 'salary') {
                                                    return '<span class="badge badge-success" style="font-size: 12px;">Salary<span>';
                                                } else if (data === 'Final Settlement') {
                                                    return '<span class="badge badge-danger" style="font-size: 12px;">Final Settlement<span>';
                                                } else {
                                                    return data;
                                                }
                                            },
					    },
					    { "data": "ids",
    					 
                         
                                          render: function ( data, type, rows, meta ) {
                						
                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_user" name="view_user" ><i class="material-icons ">remove_red_eye</i></button>';
                								
                								return str_active_status_view;
                
                							 },
                						
    					         },
			         { "data": "ids",
			 
             
                              render: function ( data, type, rows, meta ) {
    						
    									str_active_status_view = ' <button type="button" class="btn btn-sm danger-gradient mr-2" onclick="openNavR()" id="delete_salary" name="delete_salary" ><i class="material-icons ">delete</i></button>';
    								
    								return str_active_status_view;
    
    							 },
    						
			         }
					 ],
					 
					 
					 "footerCallback": function(row, data, start, end, display) {
                            var api = this.api();
                
                            // Calculate the sum of 'net_amount' column
                            var sum = api.column(6, { page: 'current' }).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);
                
                            // Update the footer cell with the sum
                            sum= parseFloat(sum).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            $(api.column(6).footer()).html('<b>' + sum + '</b>');
                        },
                        
                        "pageLength": 25,
                        "searching": true,
                        "responsive": true,
					
					
					 "initComplete": function( settings, json ) {
							
					   
	 
					  },
					  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
						 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
						 return nRow;
					 },
					  "fnDrawCallback": function() {
					   
	 
					 },
			   
				
				 
			 });  
		
		 }
    
    // **************************end********************************************
    
    
     // ******************** table click (view and delete)****************
    
     $('#list_of_salary_slip tbody').on('click', 'td button', function (){             
		  var $row = $(this).closest('tr');
		  var data = list_of_salary_slip.row($row).data();
		  var v_main_id  = data.ids;
		  var v_emp_tbl_id = data.emp_tbl_id;
		  var v_emp_name = data.emp_name;
		  var v_emp_id = data.emp_id;
		  var v_division = data.division;
		  var v_department = data.department;
		  var v_contact_no = data.contact_no;
		  var v_note = data.note;
		  var v_duty_hr = data.duty_hr;
		  var v_days = data.days;
		  var v_starting_time = data.starting_time;
		  var v_ending_time = data.ending_time;
		  var v_normal_ot_rate = data.normal_ot_rate;
		  var v_special_ot_rate = data.special_ot_rate;
		  var v_date = date_convert(data.salary_date);
		  var v_gosi = data.gosi_pr;
		  var status = data.status;
		  var travel_allo_rate = data.travel_allo_rate;
		  var indemnity_rate = data.indemnity_rate;
		  var rejoining_date = data.rejoining_date;
		  var ending_date = data.ending_date;
		  //var dateParts = v_join_date.split('-');
    //         var joinDate = dateParts[1] + '/' + dateParts[2] + '/' + dateParts[0];
		  $('#btn_employee_register').hide();
		  //$('#btn_edit_inventory').show();
		  
		 if($(this).attr("name")=='delete_salary')
                         {
                            swal({
								  title: "Do you want to delete the item?",
								 
								  icon: "warning",
								  buttons: true,
								  dangerMode: true,
								})
								.then((willDelete) => {
								  if (willDelete) {  

                            			 $.post("../controller/salary/salary_controller.php",{action : "Delete_salary_slip",v_main_id:v_main_id},function(res){
                	                     swal("success","Salary Slip Deleted Successfully ....", "success");
                			             //load_data_to_grid_salary_slip_list();
                			             list_of_salary_slip.row($row).remove().draw(false);
                			                 //$("#select_employee_search").val(0);
                                    //          $("#select_employee_search").trigger("chosen:updated");
                                             $('#txt_start_date').val("");
                                             $('#txt_end_date').val("");
                                              $("#select_department_search").val(0).trigger("chosen:updated");
                                                $("#select_division_search").val(0).trigger("chosen:updated");
                                                $("#select_employee_name").val(0).trigger("chosen:updated");
                						 });
                						 
							        }	 
								});
								
            			 }
    		 if($(this).attr("name")=='view_user')
                     {	
                        
                                totalAlloAmt = 0;
                                totalDeduAmt = 0;
                                netamount = 0;
                        
		                    $("#select_employee_search").val(v_emp_tbl_id);
                            $("#select_employee_search").trigger("chosen:updated");
                            	$("#txt_duty_hr").val(v_duty_hr);
                            	$("#txt_days").val(v_days);
                            	$("#txt_starting_time").val(v_starting_time);
                            	$("#txt_ending_time").val(v_ending_time);
                            $("#employee_id").val(v_emp_id);
                            $("#employee_division").val(v_division);
                            $("#employee_department").val(v_department);    
                            $("#contact_no").val(v_contact_no);
                            $("#txt_note").val(v_note);
                            $("#v_salary_main_id").val(v_main_id);
                            $("#v_final_stlmt").val(status);
                            $("#txt_normal_ot").val(v_normal_ot_rate);
                            $("#txt_special_ot").val(v_special_ot_rate);
                            $("#txt_date").val(v_date);
                            $("#txt_gosi_pr").val(v_gosi);
                            $("#txt_travel_allo_rt").val(travel_allo_rate);
                            $("#txt_indemnity_rt").val(indemnity_rate);
                            if(status=="Final Settlement"){
                                 $("#txt_rejoining_date").val(rejoining_date);
                                $("#txt_last_date").val(ending_date);
                                months_calc(rejoining_date,ending_date);
                                $('#div_final_stlmt').show(); 
                                
                            }
                            else{
                                 $("#txt_rejoining_date").val("");
                                $("#txt_last_date").val("");
                                $("#txt_calc_month").val("");
                                $('#div_final_stlmt').hide(); 
                            }
                           
                            tbl_salary_slip_list.clear().draw();
                            load_salary_child_tbl(v_main_id);
		                 
		  
                         closeNavR();
                     }
		 
			
						
	/////////////////////////////////	
           
    });
    
    // ********************************end**************************************
    
    function date_convert(dateString)
{
    var monthNames = {
      "Jan": 0, "Feb": 1, "Mar": 2, "Apr": 3, "May": 4, "Jun": 5,
      "Jul": 6, "Aug": 7, "Sep": 8, "Oct": 9, "Nov": 10, "Dec": 11
    };
    // Parse the input date string
            var dateParts = dateString.split("-");
            var day = parseInt(dateParts[0], 10);
            var month = monthNames[dateParts[1]];
            var year = parseInt(dateParts[2], 10);
            
            // Create a Date object using the parsed components
            var dateObj = new Date(year, month, day);
            
            // Format the date to "yyyy-MM-dd"
            var formattedDate = dateObj.getFullYear() + '-' + ('0' + (dateObj.getMonth() + 1)).slice(-2) + '-' + ('0' + dateObj.getDate()).slice(-2);
    
    return(formattedDate);
}

    
    
    // ***************************function load salary child table**************
    
            function load_salary_child_tbl(v_main_id)
            {
                 $.post("../controller/salary/salary_controller.php",{action : "select_child_tbl",v_main_id:v_main_id},	function(result,status)
        			{
        			    if(status=="success")
                                                {
                                                    
                                                var obj= jQuery.parseJSON(result);
                                                     $.each(obj.data, function(index, rowData) {
                                                // $("#employee_division").val(obj.data[0].division_name);
                                                //   view_salary_slip_list(obj.data[0].allow_deduction,obj.data[0].allo_ded_tbl_id,obj.data[0].hrs,obj.data[0].earning_amt,obj.data[0].deduction_amt,obj.data[0].description,obj.data[0].status,false);
                                                
                                                       view_salary_slip_list(rowData.allow_deduction, rowData.allo_ded_tbl_id, rowData.hrs,rowData.days, rowData.earning_amt, rowData.deduction_amt, rowData.description, rowData.status, false);
                                                    });
                                                     
                                                 }
                                                else
                                                {
                                                    return false;
                                                } 
        			});
            }
    
   
    // ***********************************end***********************************
    let action_title;
    // ****************************employee name search*************************
    
     $("#div_employee_select_for_search").on("change", function() {
        var v_emp_name_id=$("#select_employee_name option:selected").val();
         var v_from_date = formatDate($('#txt_start_date').val());
         var v_to_date = formatDate($('#txt_end_date').val());
         
        $("#select_department_search").val(0).trigger("chosen:updated");
        $("#select_division_search").val(0).trigger("chosen:updated");
        // $("#select_employee_name").val(0).trigger("chosen:updated");
        
         if(v_from_date=='NaN-NaN-NaN' || v_to_date=='NaN-NaN-NaN')
         {
             $.toast({
								heading: 'Error',
								text: 'Please select date',
								showHideTransition: 'slide',
								icon: 'error'
                         });
                        return false;
         }
         else{
                action_title ="list_salary_slips_name_search";
                load_data_to_grid_salary_slip_list_name_srch(v_from_date,v_to_date,v_emp_name_id,action_title);
             
         }
         
        
     });
    
                     function load_data_to_grid_salary_slip_list_name_srch(v_from_date,v_to_date,v_emp_name_id,action_title)
                		 {
                			 list_of_salary_slip.destroy();
                				 
                			 list_of_salary_slip = $('#list_of_salary_slip').DataTable( {
                					
                					 "ajax": {
                						 'type': 'POST',
                						 'url': '../controller/salary/salary_controller.php',
                						 'data': {
                							action: action_title,
                							v_from_date:v_from_date,
                							v_to_date:v_to_date,
                							v_emp_name_id:v_emp_name_id
                							
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
                						 { "data": "emp_name"},
                						 { "data": "emp_id"},
                						 { "data": "division"},
                						 { "data": "department"},
                						 { "data": "salary_date"
                                				//  "render": function(data, type, row) {
                                    //                 // Assuming 'default_date' is in datetime format (e.g., 'YYYY-MM-DD HH:mm:ss')
                                    //                 // Convert the datetime to date format ('YYYY-MM-DD')
                                    //                 var dateParts = data.split(' ')[0]; // Extract date part from datetime
                                    //                 return dateParts;
                                    //             }
                						 },
                						{ "data": "net_amount",className: "text-right",render: $.fn.dataTable.render.number(',', '.', 3, '')},
                					    { "data": "status",
                					        "render": function (data, type, row) {
                                                                if (data === 'salary') {
                                                                    return '<span class="badge badge-success" style="font-size: 12px;">Salary<span>';
                                                                } else if (data === 'Final Settlement') {
                                                                    return '<span class="badge badge-danger" style="font-size: 12px;">Final Settlement<span>';
                                                                } else {
                                                                    return data;
                                                                }
                                                            },
                					    },
                					    { "data": "ids",
                    					 
                                         
                                                          render: function ( data, type, rows, meta ) {
                                						
                                									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_user" name="view_user" ><i class="material-icons ">remove_red_eye</i></button>';
                                								
                                								return str_active_status_view;
                                
                                							 },
                                						
                    					         },
                			         { "data": "ids",
                			 
                             
                                              render: function ( data, type, rows, meta ) {
                    						
                    									str_active_status_view = ' <button type="button" class="btn btn-sm danger-gradient mr-2" onclick="openNavR()" id="delete_salary" name="delete_salary" ><i class="material-icons ">delete</i></button>';
                    								
                    								return str_active_status_view;
                    
                    							 },
                    						
                			         }
                					 ],
                					 
                					 
                					 "footerCallback": function(row, data, start, end, display) {
                                            var api = this.api();
                                
                                            // Calculate the sum of 'net_amount' column
                                            var sum = api.column(6, { page: 'current' }).data().reduce(function(a, b) {
                                                return parseFloat(a) + parseFloat(b);
                                            }, 0);
                                
                                            sum= parseFloat(sum).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                                            // Update the footer cell with the sum
                                            $(api.column(6).footer()).html('<b>' + sum + '</b>');
                                        },
                                        
                                        "pageLength": 25,
                                        "searching": false,
                                        "responsive": true,
                					
                					
                					 "initComplete": function( settings, json ) {
                							
                					   
                	 
                					  },
                					  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                						 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                						 return nRow;
                					 },
                					  "fnDrawCallback": function() {
                					   
                	 
                					 },
                			   
                				
                				 
                			 });  
                		
                		 }
    
    
    // ********************************end**************************************
    
    
     // ****************************salary slip division search*************************
    
     $("#div_divis_select_for_search").on("change", function() {
        var v_div_id=$("#select_division_search option:selected").val();
         var v_from_date = formatDate($('#txt_start_date').val());
         var v_to_date = formatDate($('#txt_end_date').val());
          $("#select_department_search").val(0).trigger("chosen:updated");
        $("#select_employee_name").val(0).trigger("chosen:updated");
        
         if(v_from_date=='NaN-NaN-NaN' || v_to_date=='NaN-NaN-NaN')
         {
             $.toast({
								heading: 'Error',
								text: 'Please select date',
								showHideTransition: 'slide',
								icon: 'error'
                         });
                        return false;
         }
         else{
                
                //  load_data_to_grid_salary_slip_list_div_srch(v_from_date,v_to_date,v_div_id);
                 action_title ="list_salary_slips_division_search";
                 load_data_to_grid_salary_slip_list_name_srch(v_from_date,v_to_date,v_div_id,action_title);
         }
        
        
     });
    
    // ********************************end**************************************
    
      // ****************************salary slip department search*************************
    
     $("#div_dpt_select_for_search").on("change", function() {
        var v_deptm_id=$("#select_department_search option:selected").val();
        // $("#select_department_search").val(0).trigger("chosen:updated");
        $("#select_division_search").val(0).trigger("chosen:updated");
        $("#select_employee_name").val(0).trigger("chosen:updated");
        
         var v_from_date = formatDate($('#txt_start_date').val());
         var v_to_date = formatDate($('#txt_end_date').val());
         
          if(v_from_date=='NaN-NaN-NaN' || v_to_date=='NaN-NaN-NaN')
         {
             $.toast({
								heading: 'Error',
								text: 'Please select date',
								showHideTransition: 'slide',
								icon: 'error'
                         });
                        return false;
         }
         else{
              //  load_data_to_grid_salary_slip_list_depmnt_srch(v_from_date,v_to_date,v_deptm_id);
             action_title ="list_salary_slips_depmnt_search";
             load_data_to_grid_salary_slip_list_name_srch(v_from_date,v_to_date,v_deptm_id,action_title);
             
         }
       
        
     });
    
    
    // ********************************end**************************************
    
    
    // ***********************************print with head***********************
    
    $("#btn_salary_slip_print_with_head").click(function()
		 {
		         var main_tbl_id = $("#v_salary_main_id").val();
		         var v_final_stmt = $("#v_final_stlmt").val();
		          if($.trim(main_tbl_id)=="")
                   {
                         $.toast({
								heading: 'Error',
								text: 'Please select or create salary slip for print',
								showHideTransition: 'slide',
								icon: 'error'
                         });
                        return false;
                   }
                   else
                   {
                    //   alert(main_tbl_id);
                        if(v_final_stmt!='Final Settlement'){
                            window.open("reports/pdf/print//salary_slip_print.php?main_id="+main_tbl_id+"&x=0","_blank"); 
                        }
                        else{
                            window.open("reports/pdf/print//final_settlement_print.php?main_id="+main_tbl_id+"&x=0","_blank"); 
                        }
                   }

		     
		 });
    
    // ********************************end**************************************
    
    // ***********************************print without head***********************
    
    $("#btn_salary_slip_print_without_head").click(function()
		 {
		         var main_tbl_id = $("#v_salary_main_id").val();
		          var v_final_stmt = $("#v_final_stlmt").val();
		          //alert(v_final_stmt);
		          if($.trim(main_tbl_id)=="")
                   {
                         $.toast({
								heading: 'Error',
								text: 'Please select or create salary slip for print',
								showHideTransition: 'slide',
								icon: 'error'
                         });
                        return false;
                   }
                   else
                   {
                    //   alert(main_tbl_id);
                            if(v_final_stmt!='Final Settlement'){
                                
                                window.open("reports/pdf/print//salary_slip_print.php?main_id="+main_tbl_id+"&x=1","_blank"); 

                            }
                            else{
                                // alert("final");
                                window.open("reports/pdf/print//final_settlement_print.php?main_id="+main_tbl_id+"&x=1","_blank"); 
                            }
                   }

		     
		 });
    
    // ********************************end**************************************
    
     // ***********************basic salaries list view*******************************
     $("#btn_view_basic_salaries").click(function()
		 {
           load_data_to_basic_salary_list();
                
                
		 });
		 
         function load_data_to_basic_salary_list()
		 {
			 basic_salary_list.destroy();
				 
			 basic_salary_list = $('#basic_salary_list').DataTable( {
					
					 "ajax": {
						 'type': 'POST',
						 'url': '../controller/salary/salary_controller.php',
						 'data': {
							action: 'list_basic_salaries'
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
						 { "data": "employee_Name"},
						 { "data": "employee_id"},
						 { "data": "division_name"},
						 { "data": "dpmt_name"},
						 { "data": "earning_amt"},
					 ],
					 
					 
					 "footerCallback": function(row, data, start, end, display) {
                            var api = this.api();
                
                            // Calculate the sum of 'net_amount' column
                            var sum = api.column(5, { page: 'current' }).data().reduce(function(a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);
                
                            // Update the footer cell with the sum
                            sum= parseFloat(sum).toLocaleString("en-IN", { minimumFractionDigits: 3, maximumFractionDigits: 3 });
                            $(api.column(5).footer()).html('<b>' + sum + '</b>');
                        },
                        
                        "pageLength": 25,
                        "searching": true,
                        "responsive": true,
					
					
					 "initComplete": function( settings, json ) {
							
					   
	 
					  },
					  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
						 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
						 return nRow;
					 },
					  "fnDrawCallback": function() {
					   
	 
					 },
			   
				
				 
			 });  
		
		 }
    
    // **************************end********************************************
    // ********************basic salary print with head*************************
        $("#btn_basic_salary_print_with_head").click(function()
		    {
		         
		          //alert(v_final_stmt);
		      //    if($.trim(main_tbl_id)=="")
        //           {
        //                  $.toast({
								// heading: 'Error',
								// text: 'Please select or create salary slip for print',
								// showHideTransition: 'slide',
								// icon: 'error'
        //                  });
        //                 return false;
        //           }
                   
                                window.open("reports/pdf/print//basic_salary_reprt.php?x=0","_blank"); 

                          
                   

		     
		 });
    // ***************************end*******************************************
    
    
    
    function formatDate(date) {
                     var d = new Date(date),
                         month = '' + (d.getMonth() + 1),
                         day = '' + d.getDate(),
                         year = d.getFullYear();
                
                     if (month.length < 2) month = '0' + month;
                     if (day.length < 2) day = '0' + day;
                
                     return [year, month, day].join('-');
                }
                
                //      function load_data_to_grid_salary_slip_list_div_srch(v_from_date,v_to_date,v_div_id)
                // 		 {
                // 			 list_of_salary_slip.destroy();
                				 
                // 			 list_of_salary_slip = $('#list_of_salary_slip').DataTable( {
                					
                // 					 "ajax": {
                // 						 'type': 'POST',
                // 						 'url': '../controller/salary/salary_controller.php',
                // 						 'data': {
                // 							action: 'list_salary_slips_division_search',
                // 							v_from_date:v_from_date,
                // 							v_to_date:v_to_date,
                // 							v_div_id:v_div_id
                							
                // 							 }
                // 					 },
                // 					 "language": {
                // 						 "zeroRecords": "No records available",
                // 						 "infoEmpty": "No records available",
                // 					  },
                // 					"order": [[ 0, "desc" ]],
                // 					"bPaginate": false,
                // 					"bLengthChange": false,
                // 					"bFilter": false,
                // 					"bInfo": false,
                // 					"autoWidth": false,
                // 					"columns": [
                // 						 { "data": null },
                // 						 { "data": "emp_name"},
                // 						 { "data": "emp_id"},
                // 						 { "data": "division"},
                // 						 { "data": "department"},
                // 						 { "data": "default_date",
                //                 				 "render": function(data, type, row) {
                //                                     // Assuming 'default_date' is in datetime format (e.g., 'YYYY-MM-DD HH:mm:ss')
                //                                     // Convert the datetime to date format ('YYYY-MM-DD')
                //                                     var dateParts = data.split(' ')[0]; // Extract date part from datetime
                //                                     return dateParts;
                //                                 }
                // 						 },
                // 						 { "data": "net_amount"},
                // 					    { "data": "ids",
                    					 
                                         
                //                                           render: function ( data, type, rows, meta ) {
                                						
                //                 									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_user" name="view_user" ><i class="material-icons ">remove_red_eye</i></button>';
                                								
                //                 								return str_active_status_view;
                                
                //                 							 },
                                						
                //     					         },
                // 			         { "data": "ids",
                			 
                             
                //                               render: function ( data, type, rows, meta ) {
                    						
                //     									str_active_status_view = ' <button type="button" class="btn btn-sm danger-gradient mr-2" onclick="openNavR()" id="delete_salary" name="delete_salary" ><i class="material-icons ">delete</i></button>';
                    								
                //     								return str_active_status_view;
                    
                //     							 },
                    						
                // 			         }
                // 					 ],
                					 
                					 
                // 					 "footerCallback": function(row, data, start, end, display) {
                //                             var api = this.api();
                                
                //                             // Calculate the sum of 'net_amount' column
                //                             var sum = api.column(6, { page: 'current' }).data().reduce(function(a, b) {
                //                                 return parseFloat(a) + parseFloat(b);
                //                             }, 0);
                                
                //                             // Update the footer cell with the sum
                //                             $(api.column(6).footer()).html('<b>' + sum + '</b>');
                //                         },
                                        
                //                         "pageLength": 25,
                //                         "searching": false,
                //                         "responsive": true,
                					
                					
                // 					 "initComplete": function( settings, json ) {
                							
                					   
                	 
                // 					  },
                // 					  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                // 						 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                // 						 return nRow;
                // 					 },
                // 					  "fnDrawCallback": function() {
                					   
                	 
                // 					 },
                			   
                				
                				 
                // 			 });  
                		
                // 		 }
    
    
             //      function load_data_to_grid_salary_slip_list_depmnt_srch(v_from_date,v_to_date,v_deptm_id)
                // 		 {
                // 			 list_of_salary_slip.destroy();
                				 
                // 			 list_of_salary_slip = $('#list_of_salary_slip').DataTable( {
                					
                // 					 "ajax": {
                // 						 'type': 'POST',
                // 						 'url': '../controller/salary/salary_controller.php',
                // 						 'data': {
                // 							action: 'list_salary_slips_depmnt_search',
                // 							v_from_date:v_from_date,
                // 							v_to_date:v_to_date,
                // 							v_deptm_id:v_deptm_id
                							
                // 							 }
                // 					 },
                // 					 "language": {
                // 						 "zeroRecords": "No records available",
                // 						 "infoEmpty": "No records available",
                // 					  },
                // 					"order": [[ 0, "desc" ]],
                // 					"bPaginate": false,
                // 					"bLengthChange": false,
                // 					"bFilter": false,
                // 					"bInfo": false,
                // 					"autoWidth": false,
                // 					"columns": [
                // 						 { "data": null },
                // 						 { "data": "emp_name"},
                // 						 { "data": "emp_id"},
                // 						 { "data": "division"},
                // 						 { "data": "department"},
                // 						 { "data": "default_date",
                //                 				 "render": function(data, type, row) {
                //                                     // Assuming 'default_date' is in datetime format (e.g., 'YYYY-MM-DD HH:mm:ss')
                //                                     // Convert the datetime to date format ('YYYY-MM-DD')
                //                                     var dateParts = data.split(' ')[0]; // Extract date part from datetime
                //                                     return dateParts;
                //                                 }
                // 						 },
                // 						 { "data": "net_amount"},
                // 					    { "data": "ids",
                    					 
                                         
                //                                           render: function ( data, type, rows, meta ) {
                                						
                //                 									str_active_status_view = ' <button type="button" class="btn btn-sm primary-gradient mr-2" onclick="openNavR()" id="view_user" name="view_user" ><i class="material-icons ">remove_red_eye</i></button>';
                                								
                //                 								return str_active_status_view;
                                
                //                 							 },
                                						
                //     					         },
                // 			         { "data": "ids",
                			 
                             
                //                               render: function ( data, type, rows, meta ) {
                    						
                //     									str_active_status_view = ' <button type="button" class="btn btn-sm danger-gradient mr-2" onclick="openNavR()" id="delete_salary" name="delete_salary" ><i class="material-icons ">delete</i></button>';
                    								
                //     								return str_active_status_view;
                    
                //     							 },
                    						
                // 			         }
                // 					 ],
                					 
                					 
                // 					 "footerCallback": function(row, data, start, end, display) {
                //                             var api = this.api();
                                
                //                             // Calculate the sum of 'net_amount' column
                //                             var sum = api.column(6, { page: 'current' }).data().reduce(function(a, b) {
                //                                 return parseFloat(a) + parseFloat(b);
                //                             }, 0);
                                
                //                             // Update the footer cell with the sum
                //                             $(api.column(6).footer()).html('<b>' + sum + '</b>');
                //                         },
                                        
                //                         "pageLength": 25,
                //                         "searching": false,
                //                         "responsive": true,
                					
                					
                // 					 "initComplete": function( settings, json ) {
                							
                					   
                	 
                // 					  },
                // 					  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                // 						 $("td:eq(0)", nRow).html(iDisplayIndex + 1);
                // 						 return nRow;
                // 					 },
                // 					  "fnDrawCallback": function() {
                					   
                	 
                // 					 },
                			   
                				
                				 
                // 			 });  
                		
                // 		 }
    
    
});    