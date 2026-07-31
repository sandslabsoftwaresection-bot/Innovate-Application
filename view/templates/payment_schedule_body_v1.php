
        <!-- setting sidebar -->
        <div class="settings-sidebar close-settings-sidebar-backdrop">
            <button type="button" class="btn close-setting-sidebar pink-gradient"><i class="material-icons">keyboard_arrow_left</i></button>
            <ul class="nav nav-tabs row no-gutters pink-gradient" role="tablist">
                <li class="nav-item text-center col">
                    <a class="nav-link active" id="payment-schedule-tab" data-toggle="tab" href="#payment-schedule" role="tab" aria-controls="tabhome1settings" aria-selected="true">
                        <h5 class="content-color-primary mb-0"><i class="material-icons">event</i></h5>
                        <p class="content-color-secondary mb-0 small">Payment Schedule</p>
                    </a>
                </li>
                <li class="nav-item text-center col">
                    <!--<a class="nav-link " id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="tabhome1settings" aria-selected="true">-->
                    <!--    <h5 class="content-color-primary mb-0"><i class="material-icons">book</i></h5>-->
                    <!--    <p class="content-color-secondary mb-0 small">Petty Cash</p>-->
                    <!--</a>-->
                </li>
                
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="payment-schedule" role="tabpanel" aria-labelledby="payment-schedule-tab">
                    <ul class="list-group list-group-flush" id="chat-list">
                        <li class="list-group-item new">
                            
                                    <h6 class="my-0" ><span id="selected_date"></span> <small class="float-right content-color-secondary" id="current_time"></small></h6>
                                     <div class="container mt-2 main-container"  style="height:100%">
                                         <div class="card">
                                              
                                                    <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12 ">
                                                            <div class="form-group row">
                                                                
                                                              <div class="col-lg-12 col-md-12">
                                                                     
                                                                <div class="form-group " style="padding-left:20px;">
                                                                   <div class="row" >
                                                                        <div class="custom-radio">
                                                                            <input type="radio" name="payment_method"  id="feedback111" value="Cash" checked>
                                                                            <label  for="feedback111">Cash</label>
                                                                        </div>
                                                                        <div class="custom-radio">
                                                                        <input type="radio" name="payment_method" id="feedback1112" value="Cheque">
                                                                        <label  for="feedback1112">Cheque</label>
                                                                        </div>
                                                                     
                                                                    <div class="custom-radio">
                                                                        <input type="radio" name="payment_method"  id="feedback1113" value="Bank Transfer">
                                                                        <label  for="feedback1113">Bank Transfer</label>
                                                                    
                                                                    </div>
                                                                    <div class="custom-radio">
                                                                        <input type="radio" name="payment_method"  id="feedback1114" value="Benefit Pay">
                                                                        <label  for="feedback1114">Benefit Pay</label>
                                                                    </div>
                                                                   </div>
                                                                   
                                                                </div>
                                                            </div>
                                                            
                                                               <div class="col-lg-12 col-md-12">
                                                                     <label>Customer Name <st style="color:red">*</st></label>
                                                                <div class="input-group ">     
                                                                   <div  id="div_select_customer_name" style="width:90%">
                                                                    <select  id="select_customer" name="select_customer" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-2"  aria-hidden="true"  >
                                                                        <option value="0" >-Select Customer--</option>
                                                                       
                                                                    </select> 
                                                                    </div>
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-outline-secondary" type="button" id="btn_cust_add">Add</button>
                                                                    </div>
                                                                   
                                                                  </div> 
                                                                </div>
                                                                
                                                                <div class="col-lg-5 col-md-5">
                                                                     <label>Payment Method <st style="color:red">*</st></label>
                                                                <div class="input-group ">     
                                                                   <div  id="div_select_accnt_head" style="width:80%">
                                                                    <select  id="select_company" name="select_company" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-2"  aria-hidden="true"  >
                                                                        <option value="0" >-Select Account Head--</option>
                                                                       
                                                                    </select> 
                                                                    </div>
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-outline-secondary" type="button" id="btn_add_acnt_head">Add</button>
                                                                    </div>
                                                                   
                                                                  </div> 
                                                                </div>
                                                                
                                                                
                                                               
                                                                
                                                                
                                                                <div class="col-sm-12 col-md-3 col-lg-3" >
                                                                    <label for="validationTooltip05">Payment Date</label>
                                                                    <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_date">
                                                                </div>
                                                                <div class="col-sm-12 col-md-2 col-lg-2" >
                                                                    <label for="validationTooltip05">No of Months</label>
                                                                     <input type="number" id="txt_no_of_months" class="form-control" placeholder="" min=1>
                                                                </div>
                                                                 <div class="col-sm-12 col-md-2 col-lg-2" >
                                                                    <label for="validationTooltip05">Total Amount</label>
                                                                     <input type="number" id="txt_total_amount" class="form-control" placeholder="" min="0">
                                                                </div>
                                                                <div class="col-sm-12 col-md-12 col-lg-12" >
                                                                     <label for="validationTooltip05">Description</label>
                                                                     <textarea class="form-control"  rows="3" id="txt_schedule_description"></textarea>
                                                                </div>
                                                               
                                                               
                                                                    
                                                                
                                                            </div>
                                                            
                                                            <div class="form-group row" id="div_cheque">
                                                                
                                                                    <!--<div class="col-sm-12 col-md-4 col-lg-4" >-->
                                                                    <!--    <label for="validationTooltip05">Bank Name</label>-->
                                                                    <!--     <input type="text" id="txt_bank_name" class="form-control" placeholder="">-->
                                                                    <!--</div>-->
                                                                     
                                                                     <div  class="col-sm-12 col-md-4 col-lg-4" style="width:100%;">
                                                                         
                                                                        <label for="validationTooltip05">Bank Name</label>
                                                                        <div  class="col-sm-12 col-md-12 col-lg-12" id="div_select_bank_name" style="width:100%;padding-left:0px;">
                                                                            <select  id="select_bank" name="select_bank" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-2"  aria-hidden="true"  >
                                                                            <option value="0" >-Select Account Head--</option>
                                                                           
                                                                            </select> 
                                                                        </div>
                                                                        <input type="hidden" id="txt_bank_name" class="form-control" placeholder="" >
                                                                    </div>
                                                                   
                                                                    <div class="col-sm-12 col-md-4 col-lg-4" >
                                                                        <label for="validationTooltip05">Cheque No/Ref No</label>
                                                                         <input type="text" id="txt_bank_chq_no" class="form-control" placeholder="">
                                                                    </div>
                                                            </div>
                                                            
                                                          <button type="button" class="mb-2 box-shadow mr-2 btn btn-primary " id="addRowButton">Enter Cash Details</button>
                                                        </div>
                                                        
                                                           <div class="col-md-12 ">
                                                               <div id="div_tbl_details">
                                                                <table id="myDataTable" class="table table-bordered"  border="1">
                                                                      <thead>
                                                                        <tr>
                                                                          <th>Bank Name</th>
                                                                          <th>Cheque No</th>
                                                                          <th>Date</th>
                                                                          <th>Amount</th>
                                                                          
                                                                        </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                        <!-- Existing rows, if any -->
                                                                      </tbody>
                                                                </table>
                                                            </div> 
                                                        </div>
                                                         
                                                          <div class="col-md-12 " style="padding-bottom:50px;">
                                                              <button type="button" class="mb-2 box-shadow mr-2 btn btn-primary " id="btn_save_payments">Save Details</button>
                                                        
                                                          </div>
                                                          
                                                        </div>  
                                                    
                                                   </div>
                                             
                                     </div>     
                               </div>    
                        </li>
                        
                    </ul>
                </div>
                
                <!-- Petty Cash -->
                
                <div class="tab-pane " id="payments" role="tabpanel" aria-labelledby="payments-tab">
                    <ul class="list-group list-group-flush" id="chat-list">
                        <li class="list-group-item new">
                            <div class="container mt-2 main-container"  style="height:100%">
                                         <div class="card">
                                              
                                            <div class="card-body">
                                                    <div class="row justify-content-center">
                                                            <div class="form-group row">
                                                                   <div class="col-sm-12 col-md-2 col-lg-2" >
                                                                     <label for="validationTooltip05">Opening Balance</label>
                                                                     <input type="number" id="txt_no_of_months" class="form-control" placeholder="" min=1>
                                                                    </div>
                                                            </div>
                                                    </div> 
                                            </div>        
                        </li>
                        
                    </ul>
                </div>
             
             </div>
        </div>
        <div class="settings-sidebar-backdrop pink-gradient"></div>
    	<!-- setting sidebar ends -->
    	
    	 <div class="modal fade" id="modal_cust_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="height:500px;overflow-y: auto;">
                           <div class="row"> 
                               <div class="col-sm-12 col-md-6 col-lg-6" >
                                    <label for="validationTooltip05">Customer Name</label>
                                     <input type="text" id="txt_cust_name" class="form-control" placeholder="" >
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-6" >
                                    <label for="validationTooltip05">Contact Number</label>
                                     <input type="number" id="txt_contact_no" class="form-control" placeholder="" >
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12" style="padding-top:20px;">
                                <div id="div_tbl_cust_details">
                                    <table id="myCustDataTable" class="table table-bordered"  border="1" style="width:100%">
                                          <thead>
                                            <tr>
                                              <th>Name</th>
                                              <th>Number</th>
                                              <th>Status</th>
                                              
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <!-- Existing rows, if any -->
                                          </tbody>
                                    </table>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn_cust_details">Add Customer</button>
                        </div>
                    </div>
                </div>
            </div>
    	
    	<div class="modal fade" id="modal_account_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Account Head Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="height:500px;overflow-y: auto;">
                            <div class="col-sm-12 col-md-12 col-lg-12" >
                                <label for="validationTooltip05">Account Type</label>
                                <div class="row">
                                     <div class="col-lg-3 col-md-3">  
                                        <div class="custom-radio">
                                            <input type="radio" name="account_method"  id="radio_income" value="Income" checked>
                                            <label  for="radio_income">Income</label>
                                        </div>
                                     </div>
                                     <div class="col-lg-3 col-md-3">
                                        <div class="custom-radio">
                                        <input type="radio" name="account_method"  id="radio_expense" value="Expenditure">
                                        <label  for="radio_expense">Expense</label>
                                        </div>
                                     </div>
                                     
                               </div>     
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6" >
                                        <label for="validationTooltip05">Account Head</label>
                                         <input type="text" id="txt_account_head" class="form-control" placeholder="" >
                                    </div>
                            
                            
                            
                            <div class="col-sm-12 col-md-12 col-lg-12" style="padding-top:20px;">
                                <div id="div_tbl_acnt_details">
                                    <table id="myAcntDataTable" class="table table-bordered"  border="1" style="width:100%">
                                          <thead>
                                            <tr>
                                              <th>Acnt Head</th>
                                              <th>Type</th>
                                              <th>Status</th>
                                             
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <!-- Existing rows, if any -->
                                          </tbody>
                                    </table>
                                </div>  
                            </div>    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn_acnt_details">Add Account Head </button>
                        </div>
                    </div>
                </div>
            </div>
    	
    	
    	
