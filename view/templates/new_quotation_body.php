<!-- content page -->
<div class="container mt-1 main-container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body ">
                            
<div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of quotations</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
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
                            <table class="table " id="list_of_quotations" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Quotation No </th>
                                        <th>Company </th>
                                        <th>Amount </th>
                                        
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
                        </div>
                    </div>  
                </div> 
                </div> 
        
        
       
        
        
<!-- content page ends -->
        
<div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Quotation</h5>
                            <p class="mb-0  text-white">Quotation #: <inno id="quotation_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                        <div class="dropdown d-inline-block">
                            <a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons ">more_vertical</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="" class="dropdown-item">New</a>
                                <button  class="dropdown-item" onclick="openNavR()" id="btn_view_list_of_quotation">List Of Quotations</button>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0" style="padding-bottom:0px;">
                     
                   
                    <div class="row" style="padding-bottom:0px;">
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
                                                    <select class="form-control form-control-sm">
                                                        <option>--Select Company--</option>
                                                    </select>
                                                    </div>
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_quotation_company_name">
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_quotation_company_id"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>PO Box</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_quotation_po_box"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Telephone</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_quotation_contact_no"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Fax</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_quotation_fax"> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Attn</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_quotation_attn"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <!--<div class="input-group input-group-sm mb-12" style="padding-top:10px;">-->
                                        <!--    <div class="input-group-prepend">-->
                                        <!--        <span class="input-group-text" id="inputGroup-sizing-sm">Manama, Kingdom of Bahrain </span>-->
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
                                                        <label>Quotation No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_quotation_no"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label for="validationTooltip03">Project</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        
                                                        <div id="div_project_select_combo">
                                                        <select class="form-control form-control-sm">
                                                            <option>--Select Project--</option>
                                                        </select>
                                                        </div>
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_project"> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label for="validationTooltip03">Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_quotation_date"> 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                     
                                        
                                        
                                        
                                    </div>
                                   
                                </div>
                            </div>
                           
                    </div>
                </div>
                
            </div>
            
                                            
                                            
                                          <div class="row" style="padding-top:10px;padding-left:10px;padding-right:10px;">
                                               
                                                <div class="col-sm-12 col-md-5 col-lg-9">
                                                    <label for="validationTooltip03">Subject</label>
                                                        <input type="text" class="form-control form-control-sm" value=" "   id="txt_quotation_ref"  > 
                                                </div>
                                                <!-- <div class="col-sm-12 col-md-2 col-lg-2" style="" >-->
                                                <!--         <label for="validationTooltip03">Tax</label>-->
                                                <!--        <input type="text" class="form-control form-control-sm" id="txt_project_tax"> -->
                                                <!--</div>-->
                                                
                                                
                                      
                                                
                                                 
                                                <div class="col-sm-12 col-md-2 col-lg-3" style="" >
                                                         <label for="validationTooltip03">Introduction</label>
                                                          <div id="div_subject_combo">
                                                          <select class="form-control form-control-sm" id="subject_combo" name="subject_combo">
                                                            <option>--Select Subject--</option>
                                                        </select>
                                                        </div>
                                                         
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="row" style="padding-left:10px;padding-right:10px;padding-bottom:10px">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <label style="font-size:13px"> Selected Introduction (You can change the Introduction if needed...!)</label>
                                                </div>
                                                
                                                  <div class="col-sm-12 col-md-12 col-lg-12" style="" >
                                                        <!--<input type="text" class="form-control form-control-sm" id="txt_subject">-->
                                                        
                                                          <textarea class="form-control orm-control-sm" id="txt_subject" > </textarea>
                                                        
                                                        
                                                        
                                                    </div>
                                            </div>
                                            
                                            
            
        </div>
        

         <div class="container mt-1 main-container">
            <div class="row col-sm-12 col-md-6 col-lg-12">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body ">
                            
                            
                              
                        
                                        
                                        <div class="row " >
                                            <div class="col-md-4 mb-4 sm-12" style="">
                                                <label for="validationTooltip03">Description</label>
                                                <textarea class="form-control" id="txt_quotation_description" placeholder="Description" required=""> </textarea>
                                                 <input type="hidden" class="form-control" id="txt_quotation_child_id" placeholder="Description" required="">
                                               
                                            </div>
                                            <div class="col-md-1 mb-1 sm-12" style="">
                                                <label for="validationTooltip04">Qty</label>
                                                <input type="number" class="form-control" id="txt_quotation_quantity" placeholder="Qty" required="">
                                              
                                            </div>
                                            <div class="col-md-1 mb-1 sm-12" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Unit</label>
                                                <input type="text" class="form-control" id="txt_quotation_unit" placeholder="Unit" required="">
                                                
                                            </div>
                                            <div class="col-md-2 mb-2 sm-12" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Rate (BD)</label>
                                                <input type="text" class="form-control" id="txt_quotation_rate" style="text-align:right;" placeholder="0.000" required="">
                                               
                                            </div>
                                           <!-- <div class="col-md-2 mb-2" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Amount (BD)</label>
                                                <input type="text" class="form-control" id="txt_quotation_amount" style="color:black;font-weight:700;text-align:right;" disabled placeholder="0.000" required="">
                                               
                                            </div>-->
                                             
                                           
                                        
                                            
                                            <div class="col-md-2 mb-2 sm-12" >
                                                <label for="validationTooltip05">Discount%</label>
                                                <input type="text" class="form-control" id="txt_discount_percentage" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
                                               
                                            </div>
                                            <!--<div class="col-md-3 mb-3" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Amount After Discount</label>
                                                <input type="text" class="form-control" id="txt_amt_after_discount" style="color:black;font-weight:700;text-align:right;" disabled placeholder="0.000" required="">
                                               
                                            </div>-->
                                             <div class="col-md-2 mb-2 sm-12" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Tax%</label>
                                                <input type="text" class="form-control" id="txt_tax_percentage" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
                                               
                                            </div>
                                            <!-- <div class="col-md-3 mb-3" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Net Amount</label>
                                                <input type="text" class="form-control" id="txt_net_amount" style="color:black;font-weight:700;text-align:right;" disabled placeholder="0.000" required="">
                                               
                                            </div>-->
                                             <div class="col-md-1 mb-1 sm-12" style="padding-top:30px">
                                                <button type="button" class="mb-2 btn btn-primary" id="btn_quotation_add">ADD</button>
                                                <button type="button" class="mb-2 btn btn-warning" style="color:white" id="btn_quotation_edit">SAVE</button>
                                            </div>
                                            
                                            
                                        </div>
                               
                               
                               
                               
                               
                          </div>     
                        </div>
                    </div>  
                </div>         
           
      
        </div>
        
        
         <div class="container mt-1 main-container">
            <div class="row col-sm-12 col-md-6 col-lg-12">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body ">
                            
                              
                            
                            <table id="tbl_quotation_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
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
                                       
                                    </tr>
                                </tfoot>
                               
                            </table>
                            
                           <!--<div class="row">-->
                              
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>VAT%</label>-->
                           <!--             <input type="text" class="form-control form-control-sm" id="txt_quotation_vat"> -->
                           <!--     </div>-->
                                 
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Total Amount</label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" disabled id="txt_quotation_total_amount" placeholder="0.000"> -->
                           <!--     </div>-->
                                
                                  
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Received Amount </label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_quotation_received_amount" placeholder="0.000"> -->
                           <!--     </div>-->
                               
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Balance in Due </label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_quotation_balance_due" disabled placeholder="0.000"> -->
                           <!--     </div>-->
                                
                                
                                        
                           <!--</div> -->
                           
                           
                           
                           <div class="row">
                              
                                <div class="col-sm-12 col-md-6 col-lg-12 custom-font">
                                        <label>Description</label>
                                        
                                      <textarea class="form-control" id="editor">
                                          
                                          <p><strong>WORK DESCRIPTION</strong></p><p><strong>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SCOPE OF WORKS:</strong></p><p>1.1.&nbsp;&nbsp;</p><p><strong>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PAYMENT:</strong></p><p>2.1.&nbsp;&nbsp; 50% Advance along with order confirmation.</p><p>2.2.&nbsp;&nbsp; 50% as per the progress of works.</p><p>2.3.&nbsp;&nbsp; The above Quotation is subject to our Standard Terms of Contract Unless Otherwise Specified.</p><p>2.4.&nbsp;&nbsp; Back-to-back payment is not acceptable.</p><p>2.5.&nbsp;&nbsp; VAT No: 220009487800002.</p><p><strong>TERMS &amp; CONDITIONS</strong></p><p><strong>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NOTE: -</strong></p><p>3.1.&nbsp;&nbsp; Works shall be started upon receiving of order confirmation (LPO) and advance payment.</p><p>3.2.&nbsp;&nbsp; Our offer is based on the quantity provided by you. The final amount shall be adjusted as per the work executed at site after applying enclosed BOQ rate.</p><p><strong>4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; EXCLUSIONS:</strong></p><p>4.1.&nbsp;&nbsp; Any other protection coating on steel other than mentioned.</p><p>4.2.&nbsp;&nbsp; Any kind of civil, MEP, Wood, Gypsum, glass, &amp; signage works.</p><p>4.3.&nbsp;&nbsp; Dismantling &amp; cleaning.</p><p>4.4.&nbsp;&nbsp; Erected safe scaffolding with adequate wooden planks to be supplied by client with proper protection.</p><p>4.5.&nbsp;&nbsp; 240-volt electricity within 50 meters of our working area to be supplied by client with proper resources and provision.</p><p>4.6.&nbsp;&nbsp; Lifting equipment, electricity &amp; water.</p><p>4.7.&nbsp;&nbsp; Store for safe keeping of materials at site.</p><p>4.8.&nbsp;&nbsp; Any performance bond or advance payment guarantee.</p><p>4.9.&nbsp;&nbsp; Any other works other than mentioned above.</p><p><strong>5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; VARIATION:</strong></p><p>5.1.&nbsp;&nbsp; All works shall be carried out as per the drawings. Any change may lead to a variation in the price and the completion period.</p><p><strong>6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; GENERAL:</strong></p><p>6.1.&nbsp;&nbsp; This Quotation is valid for 15 days from the date of issue.</p><p>6.2.&nbsp;&nbsp; The contractual obligation for necessary permits (if any) shall be a part of the client.</p><p>6.3.&nbsp;&nbsp; Completion period to be discussed mutually after award of the contract.</p><p>6.4.&nbsp;&nbsp; All works shall be carried out as detailed in the scope of works. Any change may lead to a variation in the price and the completion period.</p><p>6.5.&nbsp;&nbsp; Our lump sum price is based on the enclosed BOQ which shall a part of this contract.</p><p>&nbsp;</p><p>We trust you will find our offer competitive and look forward for your order at the earliest. Please don't hesitate to contact our office for any further clarification.</p><p>Thanking you and assuring you of our best service at all the times.</p><p>Yours faithfully,</p><p>&nbsp;</p><p><strong>______________________</strong></p><p><strong>LAICY THOMAS</strong></p><p>GENERAL MANAGER</p> </textarea>
                                        
                                        
                                </div>
                                 
                               
                                
                                
                                        
                           </div> 
                           
                           
                           
                            
                        </div>
                        
                        
                        
                        
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-info" id="btn_quotation_print"><i class="material-icons">print</i> VAT Print </button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_quotation_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_quotation_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_quotation"> <i class="material-icons">list</i>  Generate Quotation</button>
                                    <button class="btn btn-warning" id="btn_edit_quotation" style="color:white"> <i class="material-icons">edit</i>  Update Quotation</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

   
</div>