<!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Delivery Note</h5>
                            <p class="mb-0  text-white">Delivery Note #: <inno id="delivery_note_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                        <!--<div class="dropdown d-inline-block">-->
                        <!--     <button  onclick="openNavR()" id="btn_view_list_of_delivery_note" class="btn btn-sm btn-outline-light">List Of Delivery Notes</button>-->
                            <!--<a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--    <i class="material-icons ">more_vertical</i>-->
                            <!--</a>-->
                        <!--    <div class="dropdown-menu dropdown-menu-right">-->
                        <!--        <a href="" class="dropdown-item">New</a>-->
                        <!--        <button  class="dropdown-item" onclick="openNavR()" id="btn_view_list_of_delivery_note">List Of Delivery Notes</button>-->
                                
                        <!--    </div>-->
                        <!--</div>-->
                        
                         <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                               Delivery Note List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_delivery_note" data-style="expand-right"><span class="ladda-label">List of Delivery Note</span><span class="ladda-spinner"></span></a>
                                <a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_delivery_note">Cancelled Delivery Note</a>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body py-0">
                     
                   
                    <div class="row" >
                            <div class="col-sm-12 col-md-6 col-lg-5" id='div_first'>
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
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_delivery_note_company_name">
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_delivery_note_company_id"> 
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>PO Box</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_delivery_note_po_box" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Telephone</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_delivery_note_contact_no" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Fax</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_delivery_note_fax" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                      
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Attn</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_delivery_note_attn" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                                            
                                        
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                               
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-5" id='div_second'>
                                <div class="card rounded-0 border-0 mb-5">
                                    
                                    <div class="card-body ">
                                        
                                        
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Delivery Note No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_delivery_note_no"> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_delivery_note_date"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                        
                                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Project<span style="color:red;"> *</span></label>
                                                     </div>  
                                                    
                                                         <div class="col-sm-12 col-md-6 col-lg-8" id="div_project_select_combo">
                                                                <select class="form-control form-control-sm">
                                                                    <option>--Select Project--</option>
                                                                </select>
                                                       
                                                         </div>
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_delivery_note_project_name">
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_delivery_note_project_id"> 
                                             </div>
                                        </div>
                                        
                                        
                                      
                                       <div class="form-group custom-font" id="div_quotation">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Quotation Ref<span style="color:red;"> *</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8" id="div_select_quotation_combo">
                                                     <select class="form-control form-control-sm">
                                                        <option>--Select Quotations--</option>
                                                     </select>
                                                    
                                                    
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_delivery_note_quotation_ref"> 
                                                </div>
                                            </div>
                                        </div>
                                         
                                       <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div id="no_of_dn"  ></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>LPO No<span style="color:red;"> *</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_delivery_note_lpo_no"> 
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
        
   
        
         <div class="container mt-1 main-container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px;overflow:auto;">
                            
                              
                            
                            <table id="tbl_delivery_note_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
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
                                        <th>Add</th>
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
                                    </tr>
                                </tfoot>
                               
                            </table>
                            
                      
                           
                           
                           
                      
                           
                           
                           
                            
                        </div>
                        
                        
                         <div class="card-body " style="padding-top:5px;font-size:12px;overflow:auto;">
                            
                              
                            
                            <table id="tbl_delivery_note_list_original" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th style="display:none;">delivery_note ID</th>
                                        <th style="display:none;">delivery_note No</th>
                                        
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th style="display:none;"></th>
                                        <th style="display:none;"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                       
                                    </tr>
                                </tfoot>
                               
                            </table>
                            
                          
                           
                           
                           
                           <div class="row">
                              
                                <div class="col-sm-12 col-md-6 col-lg-12 custom-font">
                                        <label>Description</label>
                                        <textarea class="form-control custom-font"  rows="3" id="txt_delivery_note_all_description"><figure class="table"><table><tbody><tr><td style="text-align: left;">For Sapphire Industries W.L.L &nbsp; &nbsp;</td><td>&nbsp;</td><td>&nbsp;&nbsp;&nbsp;Received By</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>Signature_____________________</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Signature ______________________&nbsp;</td><td>&nbsp;</td><td>Name ________________________</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td>&nbsp;</td><td >&nbsp;All the materials checked and confirmed<br><strong>&nbsp;Thank you for your business !</strong></td><td>&nbsp;</td></tr></tbody></table></figure></textarea>
                                </div>
                                 
                               
                                
                                
                                        
                           </div> 
                           
                           
                           
                            
                        </div> 
                        
                        
                        
                        <div class="card-footer">
                            <div class="row">
                                <!--<div class="col-sm-12 col-md-2 col-lg-2">-->
                                <!--    <button class="btn btn-info" id="btn_delivery_note_print"><i class="material-icons">print</i> Print</button>-->
                                    
                                    
                                <!--</div>-->
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_delivery_note_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_delivery_note_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_delivery_note"> <i class="material-icons">list</i>  Generate Delivery Note</button>
                                    <button class="btn btn-warning" id="btn_edit_delivery_note" style="color:white"> <i class="material-icons">edit</i>  Update Delivery Note</button>
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
                            
                           
                                <div class="row ">
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <h5 class="mb-0">List of Delivery Notes</h5>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body " style="overflow:auto;">
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
                            <table class="table " id="list_of_delivery_notes" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Delivery Note No </th>
                                        <th>LPO </th>
                                        <th>View </th>
                                        <th>Delete</th>
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





<!-- content page ends -->
        
<div id="mySidenavRCancel" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <h5 class="mb-0">List of Cancelled Delivery Notes</h5>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRCancel()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body " style="overflow:auto;">
                             <div class="row ">
                                    <div class="col-sm-5 col-md-5 col-lg-5">
                                        <label for="validationTooltip05">Start Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_start_date">
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="text-align:right">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_end_date">
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_cancel_search_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                  
                                </div>
                        
                        <!--Table-->
                            <table class="table " id="list_of_cancel_delivery_notes" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Delivery Note No </th>
                                        <th>LPO </th>
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





 <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_quantity_change">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Item Qty</h5>
                            <button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       
                           
                           <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                         <label>Required </label>
                                        <div id="req_qty"></div>
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_child_id" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_quantity" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_rate" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_discount_precentag" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_vat_percentage" >
                                        
                                    </div>
                                  
                                    <div class="col-sm-6 col-md-6 col-lg-4">
                                        <label>Delivered </label>
                                        <input type="text" class="form-control" placeholder="" id="txt_reissue_qty" >
                                    </div>
                           
                           </div>
                           <div class="row ">
                               <div class="col-sm-12 col-md-12 col-lg-12">
                                         <label>Remarks </label>
                                         <textarea class="form-control custom-font"  rows="3" id="txt_remarks"></textarea>
                               </div>
                           </div>
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
                            <button type="button" class="btn btn-primary" id="btn_reissue_qnty">Save</button>
                        </div>
                    </div>
                </div>
            </div>
  