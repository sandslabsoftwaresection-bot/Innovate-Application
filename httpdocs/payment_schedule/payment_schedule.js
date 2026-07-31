 $(document).ready(function() {
        $("#div_cheque").hide();
        $("#div_tbl_details").hide();
        $("#addRowButton").hide();
        $('#dataTables-example').DataTable({
                "order": [
                    [3, "desc"]
                ],
        });
        var cust_tbl =  $('#myCustDataTable').DataTable({});
        var acnts_tbl =  $('#myAcntDataTable').DataTable({});
        
        load_cust_details();
        load_acnt_details()
        var chqValue,dateValue,amountValue,nameValue =[];
             
        var uniqueRefCode;
        var dataTable = $('#myDataTable').DataTable({
            bFilter: false,   // Hide the search bar
            bInfo: false,     // Hide the info display
            bPaginate: false  // Hide pagination
        });
        
         $('#addRowButton').on('click', function() {
         // Add a new row with some sample data
           var no_of_months= $("#txt_no_of_months").val();
           var starting_date = $("#txt_date").val();
           var payment_amount= $("#txt_total_amount").val();
           
            // Example usage
            const startDate = starting_date;
            const numberOfMonths = no_of_months;
            const nextMonths = getNextMonths(startDate, numberOfMonths);
            var selectedPaymentMethod = $('input[name="payment_method"]:checked').val(); 
            if(selectedPaymentMethod=='Cheque')
            {
              var bank_name= $("#txt_bank_name").val();
              var bank_chq_no= $("#txt_bank_chq_no").val();  
            }
            else
            {
               var bank_name= 'NA';
               var bank_chq_no= "0"; 
            }
            
            
           if(no_of_months==''||starting_date==''||payment_amount==''||bank_name==''||bank_chq_no=='')
           {
               swal("Warning","Please fill all the fields..","warning");
               return false;
           }
           else
           {
                if(selectedPaymentMethod=='Cheque')
                    {
                        for(i=0;i<no_of_months;i++)
                           {
                               
                                var newRowData = [ '<input type="text" class="name-input" value="'+bank_name+'"style="width: 150px;">',
                                '<input type="text" class="chq-input" value="'+bank_chq_no+'" style="width: 100px;">', '<input type="text" class="date-input" value="'+nextMonths[i]+'" style="width: 150px;">' , '<input type="text" class="amount-input" value="'+parseFloat(payment_amount/no_of_months).toFixed(3)+'" style="width: 100px; text-align:right">'  ];
                                dataTable.row.add(newRowData).draw();
                                bank_chq_no = parseInt(bank_chq_no) + 1;
                           }  
                         
                    }     
                else if(selectedPaymentMethod=='Cash')
                    {
                      for(i=0;i<no_of_months;i++)
                           {
                                
                                var newRowData = ['','','<input type="text" class="date-input" value="'+nextMonths[i]+'" style="width: 150px;">' , '<input type="text" class="amount-input" value="'+parseFloat(payment_amount/no_of_months).toFixed(3)+'" style="width: 100px; text-align:right">'  ];
                                dataTable.column(0).visible(false);
                                dataTable.column(1).visible(false);
                                dataTable.row.add(newRowData).draw();
                                
                           }
                    }
                else if(selectedPaymentMethod=='Bank Transfer')
                    {
                      for(i=0;i<no_of_months;i++)
                           {
                                
                                var newRowData = [ '<input type="text" class="name-input" value="'+bank_name+'"style="width: 150px;">',
                                '<input type="text" class="chq-input" value="'+bank_chq_no+'" style="width: 100px;">', '<input type="text" class="date-input" value="'+nextMonths[i]+'" style="width: 150px;">' , '<input type="text" class="amount-input" value="'+parseFloat(payment_amount/no_of_months).toFixed(3)+'" style="width: 100px; text-align:right">'  ];
                                dataTable.row.add(newRowData).draw();
                               // bank_chq_no = parseInt(bank_chq_no) + 1;
                                
                           }
                    } 
                else if(selectedPaymentMethod=='Benefit Pay')
                    {
                      for(i=0;i<no_of_months;i++)
                           {
                                
                                var newRowData = [ '<input type="text" class="name-input" value="'+bank_name+'"style="width: 150px;">',
                                '<input type="text" class="chq-input" value="'+bank_chq_no+'" style="width: 100px;">', '<input type="text" class="date-input" value="'+nextMonths[i]+'" style="width: 150px;">' , '<input type="text" class="amount-input" value="'+parseFloat(payment_amount/no_of_months).toFixed(3)+'" style="width: 100px; text-align:right">'  ];
                                dataTable.row.add(newRowData).draw();
                               // bank_chq_no = parseInt(bank_chq_no) + 1;
                                
                           }
                    }    
           }
            
             $('#addRowButton').attr('disabled', 'disabled');
          });
          
   
      function getNextMonths(startDate, numberOfMonths) {
              // Parse the start date string to get day, month, and year
              const [day, month, year] = startDate.split('-').map(Number);
            
              // Create a Date object using the parsed values
              const startDateObj = new Date(year, month - 1, day); // Note: Month is 0-based in JavaScript Date object
            
              // Initialize an array to store the result dates
              const resultDates = [];
            
              // Array of month names
              const monthNames = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June',
                'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'
              ];
            
              // Loop to calculate the next n months
              for (let i = 0; i < numberOfMonths; i++) {
                // Calculate the next month
                const nextMonth = new Date(startDateObj.getFullYear(), startDateObj.getMonth() + i, startDateObj.getDate());
            
                // Format the date to 'dd-mm-yyyy' along with the month name
                const formattedDate = `${String(nextMonth.getDate()).padStart(2, '0')}-${String(nextMonth.getMonth()+1).padStart(2, '0')}-${nextMonth.getFullYear()} `;
            
                // Push the formatted date to the result array
                resultDates.push(formattedDate);
              }
            
              return resultDates;
            }
            
            $('input[name="payment_method"]').change(function() {
             var selectedPaymentMethod = $('input[name="payment_method"]:checked').val();   
            if(selectedPaymentMethod=='Cash')
                 {
                   $("#div_cheque").hide(); 
                   
                   $("#addRowButton").text('Enter Cash Details');
                 }
            else
                 {
                    $("#div_cheque").show(); 
                    
                   $("#addRowButton").text('Enter  Details'); 
                     
                 }
            });
            
            
            function generateRefCode() {
              // Get current timestamp
              var timestamp = new Date().getTime();
        
              // Generate a random string (you can customize the length as needed)
              var randomString = Math.random().toString(36).substring(2, 10);
        
              // Combine timestamp and random string to create a unique reference code
              var refCode =  timestamp + randomString;
        
              return refCode;
            }
                    
            $("#txt_no_of_months").blur(function(){
                var no_of_months = $("#txt_no_of_months").val();
                   if(no_of_months==1)
                   {
                     $("#addRowButton").hide();
                     $("#div_tbl_details").hide();
                   }
                   else
                   {
                      $("#addRowButton").show();
                      
                      $("#div_tbl_details").show();
                      dataTable.destroy();
                      dataTable = $('#myDataTable').DataTable({
                        bFilter: false,   // Hide the search bar
                        bInfo: false,     // Hide the info display
                        bPaginate: false  // Hide pagination
                      });
                      
                   }
            })   
            $('#btn_save_payments').on('click', function() {
            
             var payment_acnt_id = $("#select_acnt_head option:selected").val();
             var payment_acnt_name = $("#select_acnt_head option:selected").text();
             var customer_id = $("#select_payment_customer option:selected").val();
             var customer_name = $("#select_payment_customer option:selected").text();
             var payment_start_date = $("#txt_date").val();
             var dateParts = payment_start_date.split("-");
             var payment_start_date = $.trim(dateParts[2] )+ "-" + dateParts[1] + "-" + dateParts[0];
             var no_of_months = $("#txt_no_of_months").val();
             var total_amount = $("#txt_total_amount").val();
             var schedule_description = $("#txt_schedule_description").val();
             var selectedPaymentMethod = $('input[name="payment_method"]:checked').val();
              uniqueRefCode = generateRefCode();
              
            var payment_type = payment_acnt_name.split('|');
            payments_type = payment_type[1];
            
            if(selectedPaymentMethod=='Cash')
            {
                var bank_name= 'Cash';
                var bank_chq_no= "NA";
                 
            }
            else
            {
                 var bank_name= $("#txt_bank_name").val();
                 var bank_chq_no= $("#txt_bank_chq_no").val();
            }
            
                if (no_of_months === null || no_of_months.trim() === '') {
                    $("#txt_no_of_months").addClass('invalid');
                    swal("Warning","Please enter no of months..","warning"); 
                    return false;
                } else {
                    $("#txt_no_of_months").removeClass('invalid');
                }
                
             if (total_amount === null || total_amount.trim() === '') {
                    $("#txt_total_amount").addClass('invalid');
                    swal("Warning","Please enter amount..","warning"); 
                    return false;
                } else {
                    $("#txt_total_amount").removeClass('invalid');
                }
            
            if(payment_acnt_id=='0')
            {
               swal("Warning","Please select account head..","warning"); 
               return false;
            }
            if(customer_id=='0')
            {
               swal("Warning","Please select customer name..","warning"); 
               return false;
            }
                if ($.fn.dataTable.isDataTable('#myDataTable')) {
              // DataTable is initialized
              // Loop through each row
             // Declare arrays to store data
                var nameValue = [];
                var dateValue = [];
                var amountValue = [];
                var chqValue = [];
                dataTable.rows().every(function(rowIdx, tableLoop, rowLoop) {
                    // Get the data from textboxes in the current row
                    var bankNameValue = $(this.node()).find('.name-input').val();
                    var chqValueData = $(this.node()).find('.chq-input').val();
                    var dateValueData = $(this.node()).find('.date-input').val();
                    var amountValueData = $(this.node()).find('.amount-input').val();
                     var dateParts = dateValueData.split("-");
                    var formattedDate = $.trim(dateParts[2] )+ "-" + dateParts[1] + "-" + dateParts[0];
                    console.log(formattedDate);    
                    // Push data into arrays
                    nameValue.push(bankNameValue);
                    chqValue.push(chqValueData); // Uncomment if needed
                    dateValue.push(formattedDate);
                    amountValue.push(amountValueData);
                
                    // Returning true continues the iteration, false stops it
                    return true;
                });
                
              
            } else {
              console.log('DataTable is not initialized.');
            }
            
          
            $.post("../controller/payment_schedule/payment_schedule_controller.php",{action:"add_payment_schedule",selectedPaymentMethod:selectedPaymentMethod,payment_acnt_head:payment_acnt_id,customer_id:customer_id,customer_name:customer_name,payment_start_date:payment_start_date,no_of_months:no_of_months,total_amount:total_amount,schedule_description:schedule_description,nameValue:nameValue,chqValue:chqValue,dateValue:dateValue,amountValue:amountValue,uniqueRefCode:uniqueRefCode,payments_type:payments_type,bank_name:bank_name, chq_ref_no:bank_chq_no},function(result,status){
                
                if(result>0)
                {
                     //swal("Success","Payment details added successfully..","success");
                     clear_text();
                     $("#div_cheque").hide();
                     $("#div_tbl_details").hide();
                     $("#addRowButton").hide();
                     $('#addRowButton').removeAttr('disabled');
                     dataTable.clear().draw();
                     setupDropdown('dropdownContent','success',svgSuccess+'Entered Successfully..!','click');    
                     LoadCalender();
                     if ($('#txt_bank_name').attr('type') == 'text') {
                        $('#div_select_bank_name').load('templates/bank_names_combo.php');
                     }
                }
                
                
               
            });
      });
      
      
      function clear_text()
      {
        $('input[type="text"]').val('');
        $('input[type="number"]').val('');
        $('textarea').val('');

       
       // Clear the selected value
        $('#select_acnt_head').val('').trigger('chosen:updated');
            
            // Trigger the "change" event
        $('#select_acnt_head').trigger('change');
        
        $('#select_payment_customer').val('').trigger('chosen:updated');
            
            // Trigger the "change" event
        $('#select_payment_customer').trigger('change');
        
      }
    
        $('#datepicker-always-visible').Zebra_DatePicker({
              always_visible: $('#day_shedule_container'),
              format: 'Y-m-d',
              	onSelect: function(view, elements) {
        		    console.log('Data Click On Select');
        		    var monthNames = [
                        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                      ];
                      var selectedDate = $(this).val();
                      var components = selectedDate.split('-');
    	              var v_task_date = components[2] + '-' + monthNames[parseInt(components[1])-1] + '-' + components[0] ;
        		    
        		    slideContainer(v_task_date);
              	}
              
        });   
        function slideContainer(selectedDate)
        {
             $('#current_time').html(getCurrentTime());
           
             if ($('.close-setting-sidebar').hasClass('active') === true) {
                // $('.settings-sidebar').addClass('close-settings-sidebar-backdrop')
                // $('.close-setting-sidebar').removeClass('active');
                // $('body').removeClass('setting-sidebar-open');
                //$('.settings-sidebar-backdrop').fadeOut();
                $('#selected_date').html(selectedDate);
            } else {
                $('.settings-sidebar').removeClass('close-settings-sidebar-backdrop')
                $('.close-setting-sidebar').addClass('active');
                $('body').addClass('setting-sidebar-open');
                if ($('#hidebackdrop').is(':checked') != true) {
                    $('.settings-sidebar-backdrop').fadeIn()
                    $('#selected_date').html(selectedDate);
                }
            }
        }
        
        
        function getCurrentTime()
        {
            var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        
        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'

        // Add leading zeros if necessary
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        seconds = (seconds < 10 ? "0" : "") + seconds;
        
        // Display the current time in a specific element with id="current-time"
        return (hours + ":" + minutes + ":" + seconds + " " + ampm);
        }
        
        $('.chosen_select').chosen();
        $('#div_select_accnt_head').load('templates/account_head_combo.php');
        $('#div_select_customer_name').load('templates/customer_combo.php');
        $('#div_search_customer_name').load('templates/customer_new_combo.php');
        $('#div_select_bank_name').load('templates/bank_names_combo.php');
        
         $('.datepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                
                minYear: 1901  ,
                locale: {
                        format: 'DD-MM-YYYY' // Set the desired date format
                      }
        }, function(start, end, label) { });
        
        $("#btn_cust_add").click(function(){
            $("#modal_cust_details").modal('show');
        })
        $("#btn_add_acnt_head").click(function(){
            $("#modal_account_details").modal('show');
            
        })
        
      
        $("#btn_cust_details").click(function(){
            v_customer_name = $("#txt_cust_name").val();
            v_contact_no= $("#txt_contact_no").val();
            newRowData= ['v_customer_name','v_contact_no','Active'];
             if(v_customer_name==='')
            {
              setupDropdown('dropdownContent','error',svgError+'Please enter customer name','click');    
              return false;
            }
            else if(v_contact_no==='')
            {
              setupDropdown('dropdownContent','error',svgError+'Please enter customer number','click');    
              return false;
            }
            else
            {
                $.post("../controller/payment_schedule/payment_schedule_controller.php",{action:"add_customer_details",v_customer_name:v_customer_name,v_contact_no:v_contact_no},function(result,status){
                  setupDropdown('dropdownContent','success',svgSuccess+'Customer added Successfully..!','click');
                 var newRow = '<tr>' +
                   '<td><i class="fas fa-edit edit-ref-number-icon"></i> <span class="reference-num-display">'+v_customer_name+'</span></td>' +
                   '<td><i class="fas fa-edit edit-ref-number-icon"></i> <span class="reference-num-display">'+v_contact_no+'</span></td>' +
                   '<td style="text-align:center;"><span class="sands-badge-grid sands-text-bg-success">Active</span></td>' +
                 '</tr>';
                    // Append the new row to the table body
                    $('#myCustDataTable tbody').append(newRow);
                });
            }
        });
        
        $("#btn_acnt_details").click(function(){
            var acnt_name= $("#txt_account_head").val() ;
            var acnt_type= $('input[name="account_method"]:checked').val();
            if(acnt_name==='')
            {
              setupDropdown('dropdownContent','error',svgError+'Please enter account name','click');    
              return false;
            }
            else if(acnt_type==='')
            {
              setupDropdown('dropdownContent','error',svgError+'Please enter account type','click');    
              return false;
            }
            else
            {
            $.post("../controller/payment_schedule/payment_schedule_controller.php",{action:"add_account_details",v_acnt_name:acnt_name,v_acnt_type:acnt_type},function(result,status){
              setupDropdown('dropdownContent','success',svgSuccess+'Account head added Successfully..!','click');
               var newRow = '<tr>' +
                   '<td>'+acnt_name+'</td>' +
                   '<td>'+acnt_type+'</td>' +
                   '<td style="text-align:center;"><span class="sands-badge-grid sands-text-bg-success">Active</span></td>' +
                 '</tr>';
                    // Append the new row to the table body
                    $('#myAcntDataTable tbody').append(newRow);
              $("#txt_account_head").val('');
            })
            }
        }); 
        
        
       
       
    
       function load_cust_details()
       {
              cust_tbl.destroy();
              cust_tbl =  $('#myCustDataTable').DataTable({
              paging: false, // Hide pagination
              searching: false, // Hide search
              "order": [],
        	  language: {
                //info: "Displaying _START_ to _END_ of _TOTAL_ entries"
        		info: "Total _TOTAL_ entries (Click to change Type and Status)"
              },
      
            "ajax": {
                method: 'POST',
                "url": "../controller/payment_schedule/payment_schedule_controller.php",
                dataType: 'json',
                "data": function (d) {
                        d.action = 'get_customer_list';
                       
                    },
            },
             "columns": [
                   
                    { "data": "customer_name"},
                    { "data": "contact_number"},
                    { "data": "customer_status" ,"className": "dt-center",
                          render: function(data, type, row) {
                              if (data === "Active") {
                                return '<span class="sands-badge-grid sands-text-bg-success">Active</span>';
                              } else if (data === "DeActive") {
                                return '<span class="sands-badge-grid sands-text-bg-danger">Deactive</span>';
                              } 
                         }
                    },
                    
                ],
         
            
        
         }); 
    }
    
       function load_acnt_details()
       {    acnts_tbl.destroy();
            acnts_tbl =  $('#myAcntDataTable').DataTable({
              paging: false, // Hide pagination
              searching: false, // Hide search
              "order": [],
        	  language: {
                //info: "Displaying _START_ to _END_ of _TOTAL_ entries"
        		info: "Total _TOTAL_ entries (Click to change Type and Status)"
              },
      
      "ajax": {
                method: 'POST',
                "url": "../controller/payment_schedule/payment_schedule_controller.php",
                dataType: 'json',
                "data": function (d) {
                        d.action = 'get_acount_list';
                       
                    },
            },
             "columns": [
                   
                    { "data": "accounts_head"},
                    { "data": "Type"},
                    { "data": "status" ,"className": "dt-center",
                          render: function(data, type, row) {
                              if (data === "Active") {
                                return '<span class="sands-badge-grid sands-text-bg-success">Active</span>';
                              } else if (data === "Deactive") {
                                return '<span class="sands-badge-grid sands-text-bg-danger">Deactive</span>';
                              } 
                         }
                    },
                    
                ],
         
            });
       }    
        
    }); 