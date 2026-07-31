<!-- content page -->
        <div class="container mt-12 main-container" >
            
            
            
            
            <div class="card mb-12">
               <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Local Purchase Order</h5>
                            <p class="mb-0  text-white">Local Purchase Order #: <inno id="local_po_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                        <div class="dropdown d-inline-block">
                             <!--<button  onclick="openNavR()" id="btn_view_list_of_local_po" class="btn btn-sm btn-outline-light">List Of LPO</button>-->
                            <!--<a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--    <i class="material-icons ">more_vertical</i>-->
                            <!--</a>-->
                             <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                LPO List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_local_po" data-style="expand-right"><span class="ladda-label">List of LPO</span><span class="ladda-spinner"></span></a>
                                <a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_LPO">Cancelled LPO</a>
                                
                            </div>
                        </div>
                        
                            <!--<div class="dropdown-menu dropdown-menu-right">-->
                            <!--    <a href="" class="dropdown-item">New</a>-->
                            <!--    <button  class="dropdown-item" onclick="openNavR()" id="btn_view_list_of_local_po">List of LPOs</button>-->
                                
                            <!--</div>-->
                        </div>
                    </div>
                </div>
                <div class="card-body py-0 ">
                     
                   
                    <div class="row " >
                            <div class="col-sm-12 col-md-6 col-lg-5">
                                <div class="card rounded-0 border-0 mb-5">
                                    
                                    <div class="card-body ">
                                        
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Company Name</label>
                                                </div>
                                                 <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <div id="div_company_select">
                                                    <select class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
                                                        <option>--Select Company--</option>
                                                    </select>
                                                    </div>
                                                       <input type="hidden" class="form-control form-control-sm" id="txt_local_po_company_name"> 
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_local_po_company_id"> 
                                                </div>
                                              
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>PO Box</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_po_box" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Telephone</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_contact_no" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Fax</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_fax" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Ref</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_quotation_ref"> 
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="input-group input-group-sm mb-12" style="padding-top:10px;">-->
                                        <!--    <div class="input-group-prepend">-->
                                        <!--        <span class="input-group-text" id="inputGroup-sizing-sm">Manama, Kingdom of Bahrain </span>-->
                                        <!--    </div>-->
                                            
                                        <!--</div>-->
                                        <!--<div class="form-group custom-font">-->
                                        <!--    <div class="row" >-->
                                        <!--        <div class="col-sm-12 col-md-6 col-lg-4">-->
                                        <!--                <label>Attn</label>-->
                                        <!--        </div>-->
                                        <!--        <div class="col-sm-12 col-md-6 col-lg-8">-->
                                        <!--                <input type="text" class="form-control form-control-sm" id="txt_local_po_attn"> -->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                                            
                                        
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                               
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-5">
                                <div class="card rounded-0 border-0 mb-5">
                                    
                                    <div class="card-body ">
                                        
                                        
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>PO No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_local_po_no"> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_local_po_date"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                      
                                       
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Payment Terms</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_payment_terms"> 
                                                </div>
                                            </div>
                                        </div>
										<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Job No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_job_no"> 
                                                </div>
             <!--                                   <div class="col-sm-12 col-md-6 col-lg-8">-->
													<!--<div id="div_job_num_select">-->
													<!--	<select class="form-control form-control-sm">-->
													<!--		<option>--Select Job NO--</option>-->
													<!--	</select>-->
													<!--</div>-->
             <!--                                   </div>-->
                                            </div>
                                        </div>
										<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Prn No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_purchase_reqsition_number"> 
                                                </div>
             <!--                                   <div class="col-sm-12 col-md-6 col-lg-8">-->
													<!--<div id="div_prno_select">-->
													<!--	<select class="form-control form-control-sm">-->
													<!--		<option>--Select PRN NO--</option>-->
													<!--	</select>-->
													<!-- </div>	-->
             <!--                                        <input type="hidden" class="form-control" id="txt_purchase_reqsition_number" name="txt_purchase_reqsition_number" />													 -->
             <!--                                   </div>-->
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </div>
                                   
                                </div>
                            </div>
                           
                    </div>
                      
                    
                </div>
            </div>
            
            
        </div>
        
         <div class="container mt-12 main-container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body ">
                            
                                        <div class="row " >
                                            <div class="col-md-4 mb-4 sm-12" style="">
                                                <label for="validationTooltip03">Description</label>
                                                 <textarea class="form-control" id="txt_local_po_description" placeholder="Description" required="" rows="1"> </textarea>
                                                <!--<input type="text" class="form-control" id="txt_local_po_description" placeholder="Description" required="">-->
                                                 <input type="hidden" class="form-control" id="txt_local_po_child_id" placeholder="Description" required="">
                                               
                                            </div>
                                            <div class="col-md-1 mb-1 sm-12" style="">
                                                <label for="validationTooltip04">Qty</label>
                                                <input type="text" class="form-control" id="txt_local_po_quantity" value=0.00 placeholder="Qty" required="">
                                              
                                            </div>
                                            <div class="col-md-1 mb-1 sm-12" style="padding-left:5px;padding-right:5px;">
                                                <label for="validationTooltip05">Unit</label>
                                                <input type="text" class="form-control" id="txt_local_po_unit" placeholder="Unit" required="">
                                                
                                            </div>
                                            <div class="col-md-2 mb-2 sm-12" style="padding-left:5px;padding-right:5px;">
                                                <label for="validationTooltip05">Rate (BD)</label>
                                                <input type="text" class="form-control" id="txt_local_po_rate" style="text-align:right;" value=0.00 placeholder="0.000" required="">
                                               
                                            </div>
                                            <div class="col-md-1 mb-1 sm-12" style="padding-left:5px;padding-right:5px;">
                                                <label for="validationTooltip05">Discount%</label>
                                                <input type="text" class="form-control" id="txt_discount_percentage" style="color:black;font-weight:700;text-align:right;" value=0.00 placeholder="0.000" required="">
                                               
                                            </div>
                                             <div class="col-md-1 mb-1 sm-12" style="padding-left:5px;padding-right:5px;">
                                                <label for="validationTooltip05">Tax%</label>
                                                <input type="text" class="form-control" id="txt_tax_percentage" style="color:black;font-weight:700;text-align:right;" value=10.00 placeholder="10.000" required="">
                                               
                                            </div>
                                            <div class="col-md-1 mb-1 sm-12" style="padding-top:30px">
                                                <button type="button" class="mb-2 btn btn-primary" id="btn_local_po_add">ADD</button>
                                                <button type="button" class="mb-2 btn btn-warning" style="color:white" id="btn_local_po_edit">SAVE</button>
                                            </div>
                                            <input type="hidden" class="form-control" id="txt_local_po_amount" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
                                                  <input type="hidden" class="form-control" id="txt_amt_after_discount" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
                                                   <input type="hidden" class="form-control" id="txt_net_amount" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
                                            </div>
                                                 
                                              
                                            <!--<div class="col-md-2 mb-2" style="padding-left:5px;padding-right:5px;visibility:hidden">-->
                                            <!--    <label for="validationTooltip05">Amount (BD)</label>-->
                                            <!--    <input type="text" class="form-control" id="txt_local_po_amount" style="color:black;font-weight:700;text-align:right;" disabled placeholder="0.000" required="">-->
                                               
                                            <!--</div>-->
                                            
                                            
                                            <!--<div class="col-md-3 mb-3" style="padding-left:5px;padding-right:5px;visibility:hidden">-->
                                            <!--    <label for="validationTooltip05">Amount After Discount</label>-->
                                            <!--    <input type="text" class="form-control" id="txt_amt_after_discount" style="color:black;font-weight:700;text-align:right;" disabled placeholder="0.000" required="">-->
                                               
                                            <!--</div>-->
                                            
                                            <!-- <div class="col-md-3 mb-3" style="padding-left:5px;padding-right:5px;visibility:hidden">-->
                                            <!--    <label for="validationTooltip05">Net Amount</label>-->
                                            <!--    <input type="text" class="form-control" id="txt_net_amount" style="color:black;font-weight:700;text-align:right;" disabled placeholder="0.000" required="">-->
                                               
                                            <!--</div>-->
                                            
                                          
                               
                            </div>
                          </div>  
                   </div>         
            </div>
      
        </div>
        
        
         <div class="container mt-12 main-container">
            <div class="row ">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            
                              
                            
                            <table id="tbl_local_po_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                       <th>SI</th>
                                        <th style="display:none;">Quotation ID</th>
                                        <th style="display:none;">Quotation No</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Dis(%) </th>
                                        <th>Discount Amt</th>
                                        <th>Tax(%) </th>
                                        <th>Net Total</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th></th>
                                        <th style="display:none;"></th>
                                        <th style="display:none;"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Sub Total</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                       
                                    </tr>
                                </tfoot>
                               
                            </table>
                            
                           <!--<div class="row">-->
                              
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Less Discount %</label>-->
                           <!--             <input type="text" class="form-control form-control-sm" id="txt_local_po_discount" placeholder="0.000"> -->
                           <!--     </div>-->
                                 
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Sub Total</label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" disabled id="txt_local_po_total_amount" placeholder="0.000"> -->
                           <!--     </div>-->
                                
                                  
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>VAT %  </label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_local_po_vat" placeholder="0.000"> -->
                           <!--     </div>-->
                               
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Net Amount BD </label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_local_po_balance_due" disabled placeholder="0.000"> -->
                           <!--     </div>-->
                                
                                
                                        
                           <!--</div> -->
                           
                            <div class="row">
                              
                                <div class="col-sm-12 col-md-6 col-lg-12 custom-font">
                                        <label>Description</label>
                                        
                                      <textarea class="form-control" id="txt_local_po_all_description">
                                         <p><strong>Remarks</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___________________________________________________________________________</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___________________________________________________________________________</p><p>&nbsp;</p><p><strong>&nbsp;Prepared by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Checked by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Approved by</strong></p><p><strong>Special Conditions:</strong></p><ul><li>Order acknowledgement is mandatory on receipt of this purchase order</li><li>All quantity to be supplied as per the specification and details provided</li><li>On receipt of this purchase order please advise promptly if you are unable to meet the specified delivery</li></ul> 
                                      </textarea>
                                        
                                        
                                </div>
                                
                           </div> 
                           
                         
                           
                           
                            
                        </div>
                        
                        
                        
                        
                        <div class="card-footer">
                            <div class="row ">
                                <!--<div class="col-sm-12 col-md-6 col-lg-2">-->
                                <!--    <button class="btn btn-info" id="btn_local_po_print"><i class="material-icons">print</i> Print</button>-->
                                <!--</div>-->
                                <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_local_po_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                </div>
                                
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_local_po_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                </div>
								<div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-info" id="btn_local_po_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_local_po"> <i class="material-icons">list</i>  Generate LPO</button>
                                    <button class="btn btn-warning text-white" id="btn_edit_local_po"> <i class="material-icons">edit</i>  Update LPO</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
       
        
        
<!-- content page ends -->
        
<div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row col-sm-12 col-md-12 col-lg-12">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Local PO</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             <div class="row ">
                                    <div class="col-sm-5 col-md-5 col-lg-5">
                                        <label for="validationTooltip05">Start Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_start_date">
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="text-align:right">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_end_date">
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_search_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                  
                                </div>
                        
                        <!--Table-->
                            <table class="table " id="list_of_local_pos" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>LPO No </th>
                                        <th>Company </th>
                                        <th>Amount</th>
                                        <th>View </th> 
                                        <th>Delete </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        
                        
                        
                        
                        </div>
                        <!--<div class="card-footer">-->
                        <!--    <button class="btn btn-primary"> View</button>-->
                        <!--</div>-->
                    </div>
                </div>

   
</div>



<div id="mySidenavRCancel" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Cancel LPO</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRCancel()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             <div class="row ">
                                    <div class="col-sm-6 col-md-5 col-lg-5">
                                        <label for="validationTooltip05">Start Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_start_date">
                                    </div>
                                    <div class="col-sm-6 col-md-5 col-lg-5" style="text-align:right">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_end_date">
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_search_cancel_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                  
                                </div>
                        
                        <!--Table-->
                           <table class="table " id="list_of_cancelled_local_pos" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>LPO No </th>
                                        <th>Company </th>
                                        <th>Amount</th>
                                        <th>View </th> 
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        
                        
                        
                        
                        </div>
                        <!--<div class="card-footer">-->
                        <!--    <button class="btn btn-primary"> View</button>-->
                        <!--</div>-->
                    </div>
                </div>

   
</div>
