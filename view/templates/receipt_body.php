<!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
               <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Payment Voucher</h5>
                            <p class="mb-0  text-white">Voucher #: <inno id="receipt_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                        <div class="dropdown d-inline-block">
                            
                             <button  onclick="openNavR()" id="btn_view_list_of_receipts" class="btn btn-sm btn-outline-light">List Of Payment Vouchers</button>
                            <!--<a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--    <i class="material-icons ">more_vertical</i>-->
                            <!--</a>-->
                            <!--<div class="dropdown-menu dropdown-menu-right">-->
                            <!--    <a href="" class="dropdown-item">New</a>-->
                            <!--    <button  class="dropdown-item" onclick="openNavR()" id="btn_view_list_of_receipts" > List Of Receipts </button>-->
                                
                            <!--</div>-->
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                     
                  
                    <div class="row" >
                            <div class="col-sm-12 col-md-6 col-lg-12">
                                <div class="card rounded-0 border-0 mb-12">
                                    
                                    <div class="card-body ">
                                       
                                        
                                           
                                           
                                        <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-2">
                                                        <label>Voucher No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-9" >
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700; width:300px;"  id="txt_receipt_no" disabled> 
                                                </div>
                                        </div>
                                        <div class="row" >
                                                <div class="col-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="option" class="custom-control-input" id="rdo_receipt_cash" value="Cash" checked>
                                                        <label class="custom-control-label" for="rdo_receipt_cash">Cash</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="option" class="custom-control-input" id="rdo_receipt_cheque" value="Cheque" >
                                                        <label class="custom-control-label" for="rdo_receipt_cheque">Cheque</label>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="option" class="custom-control-input" id="rdo_receipt_transfer" value="Transfer">
                                                        <label class="custom-control-label" for="rdo_receipt_transfer">Transfer</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-3" style="padding-top:28px;">
                                                        
                                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_receipt_date"> 
                                               
                                                </div>
                                        </div>
                                                
                                        <div class="row" >
                                                        
                                                        <div class="col-sm-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                                <label>Received with thanks from</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-5" style="padding-top:33px;">
                                                               <div id="div_company_receipt">
                                                                <select class="form-control form-control-sm">
                                                                    <option>--Select Company--</option>
                                                                </select>
                                                                </div>
                                                                <input type="hidden" class="form-control form-control-sm" value=" " style="color:black;"  id="txt_thanks"> 
                                                                <input type="hidden" class="form-control form-control-sm" value=" " style="color:black;"  id="txt_thanks_id"> 
                                                        </div>  
                                                        <!-- <div class="col-sm-12 col-md-6 col-lg-2" style="padding-top:5px;">-->
                                                        <!--        <label>The Sum of BD</label>-->
                                                        <!--</div>-->
                                                        <div class="col-sm-12 col-md-6 col-lg-4" style="padding-top:33px;">
                                                            <input type="text" class="form-control form-control-sm" value="" placeholder="Enter Name" "style="color:black;" id="other_company_add">
                                                            <!--<span style="color: blue; font-size: smaller;" id="other_company_span">Enter Name</span>-->
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-2" >
                                                                <input type="hidden" class="form-control form-control-sm" value=" "  style="color:black;text-align:right;"   id="txt_receipt_sum"> 
                                                        </div>
                                        </div>
                                        
                                         <div class="row" >
                                             <div class="col-sm-12 col-md-6 col-lg-2" style="padding-top:33px;" >
                                                                <label>By Cheque No/ TRF</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                                <input type="text" class="form-control form-control-sm" value=" " style="color:black;"  id="txt_receipt_method"> 
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-1" style=";padding-top:33px;">
                                                                <label>Bank</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-3" style="padding-top:33px;">
                                                                <input type="text" class="form-control form-control-sm" value=" " style="color:black;"  id="txt_receipt_bank"> 
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-1" style=";padding-top:33px;">
                                                                <label>Date</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                                <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_receipt_cheque_date">
                                                        </div>
                                         </div>
                                         <div class="row" >
                                                        <div class="col-sm-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                                <label>Settlement of Invoice(s)</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                                <input type="text" class="form-control form-control-sm" value=" " style="color:black;"  id="txt_receipt_settelment_invoice"> 
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-1" style="padding-top:33px;">
                                                                <label>Received by</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-3" style="padding-top:33px;">
                                                                <input type="text" class="form-control form-control-sm" value=" " style="color:black;"  id="txt_receipt_received_by"> 
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-1" style="padding-top:33px;">
                                                                <label>Verified by</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                                <input type="text" class="form-control form-control-sm" value=" " style="color:black;"  id="txt_receipt_varified_by">
                                                        </div>
                                        </div>
                                        
                                        <div class="row" >
                                                        <div class="col-sm-12 col-md-6 col-lg-8">
                                                            <label>Description</label>
                                                            <textarea class="form-control form-control-sm" id="txt_description" value=" " style="color:black;" rows="3" cols="30" placeholder="Enter your message here..."></textarea>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-1" style="padding-top:33px;">
                                                            <label>Amount BD</label>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-2" style="padding-top:33px;">
                                                                <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700;text-align:right"  id="txt_receipt_amount" value=0.000>
                                                        </div>
                                                         
                                        </div>
                                        
                                        <div class="card-footer">
                                            <div class="row">
                                                <!--<div class="col-sm-12 col-md-6 col-lg-6">-->
                                                <!--    <button class="btn btn-info" id="btn_receipt_print"><i class="material-icons">print</i> Print</button>-->
                                                <!--</div>-->
                                                <div class="col-sm-12 col-md-2 col-lg-3" style="padding-top:33px;">
                                                    <button class="btn btn-secondary" id="btn_receipt_print"><i class="material-icons">print</i> Print Without Head</button>
                                                    
                                                    
                                                </div>
                                                 <div class="col-sm-12 col-md-2 col-lg-2" style="padding-top:33px;">
                                                    <button class="btn btn-dark" id="btn_receipt_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                                    
                                                </div>
												<div class="col-sm-12 col-md-2 col-lg-2" style="padding-top:33px;">
													<button class="btn btn-info" id="btn_receipt_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>
												</div>
                                                 <div class="col-sm-12 col-md-6 col-lg-4" style="padding-top:33px;">
                                                    <button class="btn btn-primary" id="btn_generate_receipt"> <i class="material-icons">list</i>Generate Payment Voucher</button>
                                                    <button class="btn btn-warning" id="btn_edit_receipt"> <i class="material-icons">edit</i>Update Payment Voucher</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                                
                                    </div>
                                            
                                </div>
                                        
                                        
                                       
                                                    
                                                   
                                                     
                                        </div>
                                         
                                        
                                      
                                    </div>
                                   
                                </div>
                            </div>
                         
                           
                    </div>
                      
                    
                </div>
            </div>
            
            
        </div>
        
      
        
        
 <!--content page ends -->
        
<div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Payment Vouchers</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>
                                        <!--<button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>-->
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             <div class="row ">
                                    <div class="col-sm-6 col-md-5 col-lg-5">
                                        <label for="validationTooltip05">Start Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_start_date">
                                    </div>
                                    <div class="col-sm-6 col-md-5 col-lg-5" style="text-align:right">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_end_date">
                                    </div>
                                     <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_search_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                  
                                </div>
                        
                      <!--//  Table-->
                            <table class="table " id="list_of_receipt" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Receipt No </th>
                                        <th>Received From </th>
                                        <th>Amount</th>
                                        <th>View </th>
                                        <th>Delete </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                             <!--/.table-responsive -->
                        
                        
                        
                        
                        </div>
                        <div class="card-footer">
                            <!--<button class="btn btn-primary"> View</button>-->
                        </div>
                    </div>
                </div>

   
</div>


