<!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">Pass In</h5>
                       <!--     <p class="mb-0  text-white"> Pass In #: <inno id="pass_in_no_head"></inno><span class="status bg-success"> </span></p>-->
                        </div>
                        
                        
                                                 <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                             Pass In List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="view_pass_in_list" data-style="expand-right"><span class="ladda-label">List of Pass in</span><span class="ladda-spinner"></span></a>
                                <!--<a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_gate_pass">Cancelled Gate Pass</a>-->
                                
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
										<div class="form-group custom-font">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Project Name</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <div id="div_slect_project">
                                                    <select class="form-control form-control-sm">
                                                        <option>--Select Project--</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										 <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Address</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="address" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>PO Box</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="po_box" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Telephone</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="contact_no" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Fax</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="fax" readonly> 
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
                                                        <label>Pass In No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm"  style="color:black;font-weight:700" disabled id="txt_pass_in_no"> 
                                                </div>
                                            </div>
                                        </div>
                                        
										
										            <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Attn</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="attn" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                          
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="pass_in_date"> 
                                                </div>
                                            </div>
                                        </div>

                                         
										
                                          <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Approved By</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700"  id="approved_by"> 
                                                </div>
                                            </div>
                                        </div>
                                      
                                        
                                          <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Checked By</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700"  id="checked_by"> 
                                                </div>
                                            </div>
                                        </div>
                                      
                                        
                                         
                                          <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Received By</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700"  id="received_by"> 
                                                </div>
                                            </div>
                                        </div>
                                      
                                        
                                           
                                         <!-- <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Description</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700"  id="description"> 
                                                </div>
                                            </div>
                                        </div>
                                      
                                        
                                           <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Qty</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700"  id="qty"> 
                                                </div>
                                            </div>
                                        </div>
                                      
                                        
                                        
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                        
                                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Unit</label>
                                                     </div>  
                                                    
                                                         <div class="col-sm-12 col-md-6 col-lg-8" id="div_unit_select_combo">
                                                                <select class="form-control form-control-sm">
                                                                    <option>--Select Unit--</option>
                                                                </select>
                                                       
                                                         </div>
                                                      </div>
                                        </div>-->
                                        
                                        
                                      
                                      
                                         
                                       <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div id="no_of_dn"  ></div>
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
        
           
         <div class="container mt-12 main-container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body ">
                            
                                        <div class="row " >
											<div class="col-md-3 mb-4 sm-12" style="">
                                                <label for="validationTooltip03">Inventory Category</label>
                                                 <div id="div_category_load_pass">
												  
												  
												  </div>
                                            </div>
										    <div class="col-md-3 mb-4 sm-12" style="">
                                                <label for="validationTooltip03">Inventory Item</label>
                                                 <div id="div_item_load">
												  <select class=" form-control form-control-sm" >
                                                        <option>--Select Item--</option>
                                                    </select>
												  
												  </div>
                                            </div>
                                            <div class="col-md-3 mb-4 sm-12" style="">
                                                <label for="validationTooltip03">Description</label>
                                                 <textarea class="form-control form-control-sm" id="description" placeholder="Description" required="" rows="1"> </textarea>
                                                <!--<input type="text" class="form-control" id="txt_local_po_description" placeholder="Description" required="">-->
                                                 <input type="hidden" class="form-control" id="description" placeholder="Description" required="">
                                               
                                            </div>
                                            <div class="col-md-1 mb-1 sm-12" style="">
                                                <label for="validationTooltip04">Qty</label>
                                                <input type="text" class="form-control form-control-sm" id="qty" placeholder="Qty" required="">
                                              
                                            </div>
                                            <div class="col-md-2 mb-1 sm-12" style="padding-left:10px;padding-right:10px;display:none;">
                                                <label for="validationTooltip05">Unit</label>
                                                <div id="div_unit_select_combo">
													<select class="form-control form-control-sm">
														<option>Select</option>
													</select>
                                                </div>  
                                            </div>
                                            
                                            <div class="col-md-1 mb-1 sm-12" style="padding-top:30px">
                                                <button type="button" class="mb-2 btn btn-primary" id="btn_pass_in_add">ADD</button>
                                                <button type="button" class="mb-2 btn btn-warning" style="color:white" id="btn_pass_in_edit">SAVE</button>
                                            </div>
                                            <input type="hidden" class="form-control" id="txt_local_po_amount" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
                                                  <input type="hidden" class="form-control" id="txt_amt_after_discount" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
                                                  <input type="hidden" class="form-control" id="txt_net_amount" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
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
                            <table id="tbl_pass_in_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
									
                                        <th width="5px">SI</th>
                                        <th width="10px">Inventory</th>
                                        <th width="20px">Description</th>
                                        <th width="10px">Qty</th>
                                        <th width="20px">Unit</th>
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
                                    </tr>
                                </tfoot>
                               
                            </table>
                            
                      
                           
            
			
    <input type="hidden" id="hid_child_id">                       
                      
                           
                           
                           
                            
                        </div>
                        
                       <!-- 
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
                                        <textarea class="form-control custom-font"  rows="3" id="txt_delivery_note_all_description"><p>For Sapphire &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Received By</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Signature_____________________</p><p><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Name ________________________</p><p>Signature ______________________ &nbsp; &nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; All the materials checked and confirmed<br><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Thank you for your business !</strong></p></textarea>
                                </div>
                                 
                               
                                
                                
                                        
                           </div> 
                           
                           
                           
                            
                        </div> 
                        -->
                        
                        
                        <div class="card-footer">
                            <div class="row">
                                <!--<div class="col-sm-12 col-md-2 col-lg-2">-->
                                <!--    <button class="btn btn-info" id="btn_delivery_note_print"><i class="material-icons">print</i> Print</button>-->
                                    
                                    
                                <!--</div>-->
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_pass_in_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_pass_in_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                </div>
								<div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-info" id="btn_pass_in_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_pass_in"> <i class="material-icons">list</i>  Generate Pass In</button>
                                  <!--  <button style="display:none;" class="btn btn-warning" id="btn_edit_delivery_note" style="color:white"> <i class="material-icons">edit</i>  Update Working Order</button>-->
                                </div>
                            </div>
                            
                        </div>
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
                                        <h5 class="mb-0">List of Pass In</h5>
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
                                        <input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_start_date">
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="text-align:right">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_end_date">
                                    </div>
                                    
									<div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_search_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                  
                                </div>
                        
                        <!--Table-->
						    <table class="table " id="list_of_pass_in" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Pass In No</th>
                                        <th>Company</th>
                                        <th>Project</th>
                                         <th>Date</th>
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
                             <table class="table " id="list_of_cancel_gate_pass" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Pass No</th>
                                        <th>Company</th>
                                        <th>Vehicle No</th>
                                        <th>Driver Name</th>
                                        <th>Date</th>
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
                                        <label>Received </label>
                                        <input type="text" class="form-control" placeholder="" id="txt_received_qty" readonly>
                                    </div>
									
									<div class="col-sm-6 col-md-6 col-lg-3">
                                        <label>Required </label>
                                        <input type="text" class="form-control" placeholder="" id="txt_required_qty" >
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
                           <div class="row ">
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