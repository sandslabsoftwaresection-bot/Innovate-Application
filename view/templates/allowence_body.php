<!-- content page -->
    <div class="container mt-2 main-container">
        <div class="card">
            <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
				<div class="media w-100 ">
					<figure class="avatar avatar-40 rounded-circle align-self-start ">
						<img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
					</figure>
					<div class="media-body">
						<h5 class="time-title mb-0  text-white">New Allowance / Deduction</h5>
					</div>   
					<div class="dropdown " style="padding-left:50px;">
						<button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Allowance / Deduction List
						</button>
						<div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
							<a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="view_allowence_list" data-style="expand-right"><span class="ladda-label">List of Allowance</span><span class="ladda-spinner"></span></a>
							<a class="dropdown-item" href="#" onclick="openNavRCancel()" id="view_deduction_list">List of Deduction</a>
						</div>
					</div>
				</div>
            </div>
            <div class="card-body py-0">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6" id='div_first'>
                        <div class="card rounded-0 border-0 mb-5">       
                            <div class="card-body ">
                                	<div class="form-group custom-font">
									<!--<div class="row" >-->
										<div class="col-sm-12 col-md-6 col-lg-4">
												<label>Allowance</label>
										</div>
										<div class="col-sm-12 col-md-12 col-lg-12">
												<input type="text" class="form-control form-control-sm" id="txt_allowence"> 
										</div>
										<div class="col-sm-12 col-md-12 col-lg-12" style="text-align:right">
                                                <button class="btn btn-primary" id="btn_add_allowence"> <i class="material-icons">list</i>Add</button>
                                                <button style="display:none;" class="btn btn-warning" id="btn_edit_allowence" style="color:white"> <i class="material-icons">edit</i>Update</button>

                                        </div>
									<!--</div>-->
								</div>
                            </div>      
                        </div>
                    </div>
					<!--<div class="col-sm-12 col-md-6 col-lg-2"></div>-->
                    <div class="col-sm-12 col-md-6 col-lg-6" id='div_second'>
                        <div class="card rounded-0 border-0 mb-5">
                            <div class="card-body ">
    							<div class="form-group custom-font">
    									<!--<div class="row" >-->
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											<label>Deduction</label>
    										</div>
    										<div class="col-sm-12 col-md-12 col-lg-12">
    											<input type="text" class="form-control form-control-sm" id="txt_deduction"> 
    										     
    										</div>
    										<div class="col-sm-12 col-md-12 col-lg-12" style="text-align:right">
                                                <button class="btn btn-primary" id="btn_add_deduction"> <i class="material-icons">list</i>Add</button>
                                                <button style="display:none;" class="btn btn-warning" id="btn_edit_deduction" style="color:white"> <i class="material-icons">edit</i>Update</button>

                                        </div>
    									<!--</div>-->
    								</div>
                                </div> 
                             </div>
         <!--               <div class="form-group custom-font">-->
									<!--<div class="row" >-->
									<!--    <div class="col-sm-12 col-md-6 col-lg-7" style="text-align:right">-->
									<!--     </div>   -->
    					<!--				 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">-->
         <!--                                       <button class="btn btn-primary" id="btn_employee_register"> <i class="material-icons">list</i>Register</button>-->
                                                <!--<button style="display:none;" class="btn btn-warning" id="btn_edit_employee" style="color:white"> <i class="material-icons">edit</i>  Update Gate Pass</button>-->
         <!--                               </div>-->
									<!--</div>-->
         <!--                        </div> -->
                    </div>         
                </div>   
            </div>
        </div>   
    </div>
        
  
    <div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
        <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
            <div class="card rounded-0 border-0 mb-12">
                <div class="card-header">
					<div class="row">
						<div class="col-sm-10 col-md-10 col-lg-10">
							<h5 class="mb-0">List of Allowance</h5>
							<input type="hidden" class="form-control form-control-sm" id="allowence_id">
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2" style="text-align:right">
							<!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
							<button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
						</div>
					</div>          
                </div>
                <div class="card-body " style="overflow:auto;">
                    <div class="row ">
                               
                    </div>
                        
                        <!--Table-->
						    <table class="table " id="list_of_allowence" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Edit</th>
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
							<h5 class="mb-0">List of Deduction</h5>
							<input type="hidden" class="form-control form-control-sm" id="deduction_id">
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2" style="text-align:right">  
							<!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
							<button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRCancel()"><span class="material-icons icon-sm">close</span></button>
						</div>
					</div>       
                </div>
                <div class="card-body " style="overflow:auto;">
                    <div class="row">
					       
                    </div>
                        
                        <!--Table-->
                             <table class="table " id="list_of_deduction" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th>ID </th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        
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
                        <div class="row">
							<div class="col-sm-6 col-md-6 col-lg-3">
								<label>Qty</label>
								<input type="text" class="form-control" placeholder="" id="txt_qty" readonly>
							</div>	
							<div class="col-sm-6 col-md-6 col-lg-3">
								<label>Received</label>
								<input type="text" class="form-control" placeholder="" id="txt_received_qty" readonly>
							</div>	
							<div class="col-sm-6 col-md-6 col-lg-3">
								<label>Required</label>
								<input type="text" class="form-control" placeholder="" id="txt_required_qty" >
							</div>	
							<div class="col-sm-6 col-md-6 col-lg-3">
								<label>Balance</label>
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
  
  
  