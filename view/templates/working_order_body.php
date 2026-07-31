<!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Work Order</h5>
                            <p class="mb-0  text-white">Work Order #: <inno id="working_order_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                        
                        
                                                 <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Work Orders List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="view_work_order_list" data-style="expand-right"><span class="ladda-label">List of Work Orders</span><span class="ladda-spinner"></span></a>
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavRProject()" id="view_work_order_quotaion_list" data-style="expand-right"><span class="ladda-label">WO Based on Quotation</span><span class="ladda-spinner"></span></a>
                               
                                <a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_work_order">Cancelled Work Orders</a>
                                
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
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_company_name">
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_company_id"> 
                                                </div>
                                                
                                            </div>
                                        </div>
										<span id="span_work_order">
											<div class="form-group custom-font">
												<div class="row" >
													<div class="col-sm-12 col-md-6 col-lg-4">
															<label>PO Box</label>
													</div>
													<div class="col-sm-12 col-md-6 col-lg-8">
															<input type="text" class="form-control form-control-sm" id="txt_po_box" readonly> 
													</div>
												</div>
											</div>
											<div class="form-group custom-font">
												<div class="row" >
													<div class="col-sm-12 col-md-6 col-lg-4">
															<label>Telephone</label>
													</div>
													<div class="col-sm-12 col-md-6 col-lg-8">
															<input type="text" class="form-control form-control-sm" id="txt_contact_no" readonly> 
													</div>
												</div>
											</div>
											<div class="form-group custom-font">
												<div class="row" >
													<div class="col-sm-12 col-md-6 col-lg-4">
															<label>Fax</label>
													</div>
													<div class="col-sm-12 col-md-6 col-lg-8">
															<input type="text" class="form-control form-control-sm" id="txt_fax" readonly> 
													</div>
												</div>
											</div>
										  
											<div class="form-group custom-font">
												<div class="row" >
													<div class="col-sm-12 col-md-6 col-lg-4">
															<label>Attn</label>
													</div>
													<div class="col-sm-12 col-md-6 col-lg-8">
															<input type="text" class="form-control form-control-sm" id="txt_attn" readonly> 
													</div>
												</div>
											</div>
                                        </span>  
										
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
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_working">
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_working_project_id"> 
                                             </div>
                                        </div>
										
										<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Quotation Ref<span style="color:red;"> *</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8" id="div_select_quotation_combo">
                                                     <select class="form-control form-control-sm">
                                                        <option>--Select Quotations--</option>
                                                     </select>
                                                    
                                                    
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_quotation_ref"> 
                                                </div>
                                            </div>
                                        </div>
										
										
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Project No.<span style="color:red;"> *</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_location" disabled> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Note</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <textarea id="txt_note" name="txt_note" style="width: 100%;border-color: rgb(0 0 0 / 20%);"></textarea>
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
                                                        <label>Working Order No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_work_order_no"> 
                                                </div>
                                            </div>
                                        </div>
                                         
                                       <!--<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div id="no_of_dn"  ></div>
                                                </div>
                                                
                                            </div>
                                        </div>-->
  
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Start Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="date" class="form-control form-control-sm" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_working_date"> 
                                                </div>
                                            </div>
                                        </div>

										<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>End Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="date" class="form-control form-control-sm" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_working_end_date"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Received<span style="color:red;"> *</span></label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_received"> 
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
                            
                            <div id="quatation_view_div">
                                <table class="table stripe" id="quatation_table_modal" style="width:100%">
                    			    <thead>
                    			        <tr>
                    			            <th>SI</th>
                    			            <th>Description</th>
                    			            <th>Qty</th>
                    			            <th>Unit</th>
                    			            <th>Rate</th>
                    			            <th>Amount</th>
                    			        </tr>
                    			    </thead>
                    			</table>
                             </div>       
                            <div id="work_order_view_div">
                                 <table id="tbl_work_order_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                        <th width="5px">SI</th>
                                        <th width="5px">QNo</th>
										
                                        <th width="20px">Description</th>
                                        <th width="5px">Order Qty</th>
                                        <th width="5px">Required</th>
                                        <th width="5px">Supplied</th>
                                        <th width="5px">Balance</th>
                                        <th width="5px">Unit</th>
                                        <th width="10px">Date</th>
                                        <th width="10px">Status</th>
                                        <th width="30px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                  
				  
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
										<th></th>
                                       <th></th>
                                      
                                    </tr>
                                </tfoot>
                               
                            </table>
                            
                            </div>
                           
                           
                           
                      
                           
                           
                           
                            
                        </div>
                        
                       
                        
                        
                        <div class="card-footer">
                            <div class="row">
                                
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_work_order_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_work_order_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                </div>
								<div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-info" id="btn_work_order_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_working_order"> <i class="material-icons">list</i>  Generate Work Order</button>
                                    <button style="display:none;" class="btn btn-warning" id="btn_edit_working_order" style="color:white"> <i class="material-icons">edit</i>  Update Working Order</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
<div id="mySidenavRProject" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <h5 class="mb-0">Work Orders Based on Project</h5>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRProject()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body " style="overflow:auto;">
                             <div class="row ">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <label for="validationTooltip05">Company</label>
                                        <div id="div_work_order_company_select">
                                            <select class="form-control form-control-sm">
                                                <option>--Select Company--</option>
                                            </select>
                                        </div>
                                     </div>
                                     <div class="col-sm-12 col-md-3 col-lg-3">
                                        <label for="validationTooltip05">Project</label>
                                        <div id="div_work_order_project_select">
                                            <select class="form-control form-control-sm">
                                                <option>--Select Project--</option>
                                            </select>
                                        </div>
                                     </div>
                                     <div class="col-sm-12 col-md-3 col-lg-3">
                                        <label for="validationTooltip05">Quotation</label>
                                        <div id="div_work_order_quotation_select">
                                            <select class="form-control form-control-sm">
                                                <option>--Select Quotation--</option>
                                            </select>
                                        </div>
                                     </div>
                                     
                                    
                                    <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_search_workorder"> <i class="material-icons">search</i> </button>
                                    </div>
                                  
                                </div>
                        
                        <!--Table-->
                            <table class="table stripe" id="list_of_work_order_quotation" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Work Order No </th>
                                        <th>Description  </th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Req</th>
                                        <th>Supply</th>
                                        <th>Bal</th>
                                        <th>Status</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        
                        
                        
                        
                        </div>
                       
                    </div>
                </div>
                
         
</div>

            
     
        
           
<div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <h5 class="mb-0">List of Work Orders</h5>
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
                            <table class="table " id="list_of_work_order" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Work Order No. </th>
                                        <th>Quotation No. </th>
                                        <th>Project No. </th>
                                        <th>Word Order Date </th>
                                        <!--<th>Status</th>-->
                                        <th>View</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        
                        
                        
                        
                        </div>
                       
                    </div>
                </div>
                
         
</div>

     
        

<!-- content page ends -->
       
<!-- content page ends -->
        
<div id="mySidenavRCancel" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <h5 class="mb-0">List of Cancelled Work Orders</h5>
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
                            <table class="table " id="list_of_cancel_work_order" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Work Order No. </th>
                                        <th>Quotation No.</th>
                                        <th>Project No. </th>
                                        <th>Work Order Date </th>
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
                       
                           <div id="error_msg"></div> 
                           <div class="row ">
						   
									
									 <div class="col-sm-6 col-md-6 col-lg-3">
                                        <label>Qty </label>
                                        <input type="text" class="form-control" placeholder="" id="txt_qty" readonly>
                                    </div>
									<div class="col-sm-6 col-md-6 col-lg-3">
                                        <label>Required </label>
                                        <input type="text" class="form-control" placeholder="" id="txt_required_qty" >
                                    </div>
									
									 <div class="col-sm-6 col-md-6 col-lg-3">
                                        <label>Received </label>
                                        <input type="text" class="form-control" placeholder="" id="txt_received_qty" readonly>
                                    </div>
									
								
									
                                    <div class="col-sm-6 col-md-6 col-lg-3">
                                         <label>Balance </label>
                                        <input type="text" class="form-control"  id="txt_balance" readonly>
                                    
                                          <input type="hidden" class="form-control" placeholder="" id="hid_quotation_no" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_discount_precentag" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_vat_percentage" >
                                        
                                    </div>
                                  <input type="hidden" class="form-control" placeholder="" id="txt_work_order_number" >
                                  <input type="hidden" class="form-control" placeholder="" id="txt_quantity" >
                                            
                                   
                           
                           </div>
						   <div class="row">
                               <div class="col-sm-12 col-md-12 col-lg-12">
                                         <label>Description</label>
                                         <textarea class="form-control custom-font"  rows="3" id="txt_description"></textarea>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-sm-12 col-md-12 col-lg-12">
                                         <label>Remarks </label>
                                         <textarea class="form-control custom-font"  rows="3" id="txt_remarks"></textarea>
                               </div>
                           </div>
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
                            <button type="button" class="btn btn-primary" id="btn_save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
  
  
  
  
 <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_status_change">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Quotation Status</h5>
                            <button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       
                           <div id="error_msg"></div> 
                           <div class="row ">
						   
									
									 <div class="col-sm-6" style="margin-bottom:20px;">
                                        <label>Quotation Status </label>  </div>
										 <div class="col-sm-6">
                                       <select class="form-control form-control-sm" id="quotation_status">
                                       <option>--Select Status--</option>
                                       <option>Material Received</option>
                                       <option>Fabrication completed </option>
                                       <option>Delivered</option>
                                       <option>Site fixing completed </option>
                                       </select>
                                  
                                    </div>
									
									
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
                            <button type="button" class="btn btn-primary" id="btn_change_status">Save</button>
                        </div>
                    </div>
                </div>
            </div>
			</div>
  
  
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="quotation_modal">
                <div class="modal-dialog modal-xl" role="document" style="max-width:90%">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">View Quotation</h5>
                            <button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       
                           <div id="error_msg"></div> 
                           <!--<div class="row " style="width:100%">-->
						   
								<table class="table stripe" id="quatation_table_modal" style="width:100%">
								    <thead>
								        <tr>
								            <th>SI</th>
								            <th>Description</th>
								            <th>Qty</th>
								            <th>Unit</th>
								            <th>Rate</th>
								            <th>Amount</th>
								        </tr>
								    </thead>
								</table>	
	
                           
                        <!--</div>-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="quotation_modal_close">Close</button>
                            <button type="button" class="btn btn-primary" id="quotation_modal_generate">Generate</button>
                        </div>
                    </div>
                </div>
            </div>
			</div>
  