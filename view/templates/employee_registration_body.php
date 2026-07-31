<!-- content page -->
    <div class="container mt-2 main-container">
        <div class="card">
            <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
				<div class="media w-100 ">
					<figure class="avatar avatar-40 rounded-circle align-self-start ">
						<img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
					</figure>
					<div class="media-body">
						<h5 class="time-title mb-0  text-white">New Employee Registration</h5>
					</div>   
					<div class="dropdown " style="padding-left:50px;">
						<button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Employee List
						</button>
						<div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
							<a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="view_gate_list" data-style="expand-right"><span class="ladda-label">List of Employees</span><span class="ladda-spinner"></span></a>
							<!--<a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_gate_pass">Cancelled Gate Pass</a>-->
						</div>
					</div>
				</div>
            </div>
            <div class="card-body py-0">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-5" id='div_first'>
                        <div class="card rounded-0 border-0 mb-5">       
                            <div class="card-body ">
                                	<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
												<label>Name</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
												<input type="text" class="form-control form-control-sm" id="employee_name"> 
										</div>
									</div>
								</div>
    								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    												<label>ID</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    												<input type="text" class="form-control form-control-sm" id="employee_id"> 
    										</div>
    									</div>
    								</div>
    								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    												<label>CPR</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    												<input type="text" class="form-control form-control-sm" id="employee_cpr"> 
    										</div>
    									</div>
    								</div>
    								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    												<label>Passport No</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    												<input type="text" class="form-control form-control-sm" id="employee_passport_no"> 
    										</div>
    									</div>
    								</div>
                                    <div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											 <label>Division</label>
    										</div>
    										<!--<div class="col-sm-12 col-md-6 col-lg-6">-->
    										<!--	<div id="div_division_select">-->
    										<!--	<select class="form-control form-control-sm">-->
    										<!--		<option>--Select Division--</option>-->
    										<!--	</select>-->
    										<!--	</div>-->
    												
    										<!--</div> -->
    										<!--<div class="col-sm-12 col-md-6 col-lg-2">-->
              <!--                                  <button class="btn btn-primary" id="btn_add_division">Add</button>-->
              <!--                              </div>-->
              
                                        <!--grouping--> 
                                                <div class="col-sm-12 col-md-8 col-lg-8">
                                                	<div class="input-group mb-3" style="vertical-align:middle; padding-top:9px;"> 
                                                		<div id="div_division_select" style="width:80%;">
                                                			<select class="form-control form-control-sm">
                                                				<option>--Select Division--</option>
                                                			</select>
                                                		</div>
                                                		<div class="input-group-append">
                                                			<button class="btn btn-primary" id="btn_add_division">Add</button>
                                                		</div>
                                                	</div>
                                                </div>
                                         <!--end-->
    									</div>
                                    </div>
    								<div class="form-group custom-font">
    									<div class="row">
    										<div class="col-sm-12 col-md-6 col-lg-4">
    												<label>Department</label>
    										</div>
    										<!--<div class="col-sm-12 col-md-6 col-lg-6">-->
    										<!--	<div id="div_department_select">-->
    										<!--	<select class="form-control form-control-sm">-->
    										<!--		<option>--Select Department--</option>-->
    										<!--	</select>-->
    										<!--	</div>-->
    										<!--</div>-->
    										<!-- <div class="col-sm-12 col-md-6 col-lg-2">-->
              <!--                                  <button class="btn btn-primary" id="btn_add_department">Add</button>-->
              <!--                              </div>-->
                                             <!--grouping-->
                                            <div class="col-sm-12 col-md-8 col-lg-8">
                                                <div class="input-group mb-3" style="vertical-align:middle; padding-top:9px;"> 
                                                	<div id="div_department_select" style="width:80%;">
                                                		<select class="form-control form-control-sm">
                                                			<option>--Select Department--</option>
                                                		</select>
                                                	</div>
                                                	<div class="input-group-append">
                                                		<button class="btn btn-primary" id="btn_add_department">Add</button>
                                                	</div>
                                                </div>
                                            </div> 
                                            <!--end-->
    									</div>
    								</div>
    								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    												<label>Date of Join</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    												<input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="joining_date"> 
    										</div>
    									</div>
    								</div>
    								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
											<label>Email</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
											<input type="text" class="form-control form-control-sm" id="employee_email"> 
										     
										</div>
									</div>
								</div>
								
                            </div> 
                            
                        </div>
                            <div class="col-sm-12 col-md-8 col-lg-8" style="text-align:left">
                                <div class="form-group custom-font">
									<div class="row" >
										<!--<div class="col-sm-12 col-md-6 col-lg-4">-->
											<label>Rejoinig Date</label>
										<!--</div>-->
										<!--<div class="col-sm-12 col-md-6 col-lg-8">-->
											<div class="input-group mb-3" style="vertical-align:middle; padding-top:9px;"> 
                                            	<input type="date" class="form-control form-control-sm" id="txt_rejoining_date"> 
                                            	<div class="input-group-append">
                                            		<button class="btn btn-success" id="btn_update_rejoining_date">Update</button>
                                            	</div>
                                            </div>
                                                										     
										<!--</div>-->
									</div>
								</div>
							</div>	
                    </div>
					<div class="col-sm-12 col-md-6 col-lg-2"></div>
                    <div class="col-sm-12 col-md-6 col-lg-5" id='div_second'>
                        <div class="card rounded-0 border-0 mb-5">
                            <div class="card-body ">
                                	 
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
											<label>Contact Number</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
											<input type="text" class="form-control form-control-sm" id="employee_phone_no"> 
										     
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
											<label>Native Contact Number</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
											<input type="text" class="form-control form-control-sm" id="emp_native_ph_no"> 
										     
										</div>
									</div>
								</div>
    							<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											<label>Native Contact Person</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    											<input type="text" class="form-control form-control-sm" id="emp_native_contact_person"> 
    										     
    										</div>
    									</div>
    								</div>
    								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											<label>Normal OT Rate</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    											<div class="input-group mb-3" style="vertical-align:middle; padding-top:9px;"> 
                                                	<input type="text" class="form-control form-control-sm" id="txt_normal_ot_amt">
                                                	<div class="input-group-append">
                                                		<button class="btn btn-primary" id="btn_add_normalot_all">Apply to All</button>
                                                	</div>
                                                </div>
    										     
    										</div>
    									</div>
    								</div>
    								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											<label>Special OT Rate</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    											<div class="input-group mb-3" style="vertical-align:middle; padding-top:9px;"> 
                                                	<input type="text" class="form-control form-control-sm" id="txt_special_ot_amt"> 
                                                	<div class="input-group-append">
                                                		<button class="btn btn-primary" id="btn_add_specialot_all">Apply to All</button>
                                                	</div>
                                                </div>
                                                    										     
    										</div>
    									</div>
    								</div>
    								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											<label>GOSI</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    											<div class="input-group mb-3" style="vertical-align:middle; padding-top:9px;"> 
                                                	<input type="text" class="form-control form-control-sm" id="txt_gosi_pr"><span class="input-group-text">%</span> 
                                                	<div class="input-group-append">
                                                		<button class="btn btn-primary" id="btn_add_gosi_all">Apply to All</button>
                                                	</div>
                                                </div>
                                                    										     
    										</div>
    									</div>
    								</div>
    								
    								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											<label>Leave Travel Allowance Rate</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    											<div class="input-group mb-3" style="vertical-align:middle; padding-top:9px;"> 
                                                	<input type="text" class="form-control form-control-sm" id="txt_travel_allo">
                                                	<div class="input-group-append">
                                                		<button class="btn btn-primary" id="btn_add_travel_allo">Apply to All</button>
                                                	</div>
                                                </div>
    										     
    										</div>
    									</div>
    								</div>
    								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											<label>Indemnity Bonus Rate</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    											<div class="input-group mb-3" style="vertical-align:middle; padding-top:9px;"> 
                                                	<input type="text" class="form-control form-control-sm" id="txt_indemnity"> 
                                                	<div class="input-group-append">
                                                		<button class="btn btn-primary" id="btn_add_indemnity_all">Apply to All</button>
                                                	</div>
                                                </div>
                                                    										     
    										</div>
    									</div>
    								</div>
    								
    								
                                </div> 
                             </div>
                        <div class="form-group custom-font">
									<div class="row" >
									    <div class="col-sm-12 col-md-8 col-lg-8" style="text-align:left">
									        
									     </div>   
    									 <div class="col-sm-12 col-md-4 col-lg-4" style="text-align:right">
                                                <button class="btn btn-primary" id="btn_employee_register"> <i class="material-icons">list</i>Register</button>
                                                <button style="display:none;" class="btn btn-warning" id="btn_edit_employee" style="color:white"> <i class="material-icons">edit</i>  Update Details</button>
                                                <input type="hidden" class="form-control form-control-sm" id="v_id"> 
                                        </div>
									</div>
                                 </div> 
                    </div>         
                </div>   
            </div>
        </div>   
    </div>
        
           
    <!--<div class="container mt-12 main-container">-->
    <!--    <div class="row">-->
    <!--        <div class="col-sm-12 col-md-6 col-lg-12">-->
    <!--            <div class="card rounded-0 border-0 mb-12">-->
    <!--                <div class="card-body">-->
    <!--                    <div class="row">-->
				<!--			<div class="col-md-4 mb-4 sm-12" style="">-->
				<!--				<label for="validationTooltip03">Inventory Category</label>-->
				<!--				<div id="div_category_load">-->
				<!--				  <select class="form-control form-control-sm" id="">-->
				<!--				      <option value="0" >-Select Category--</option>-->
				<!--				  </select>-->
								  
				<!--				</div>-->
				<!--			    <input type="hidden" class="form-control" id="txt_inventory_id"/>-->
				<!--			</div>-->
				<!--			<div class="col-md-4 mb-4 sm-12" style="">-->
				<!--                 <label for="validationTooltip03">Item</label>-->
    <!--    						  <div id="div_item_load_gp">-->
        						 
    <!--    						     <select class="form-control form-control-sm" id="">-->
    <!--    						         <option value="0" >-Select Item--</option>-->
    <!--    						     </select>-->
    <!--    						  </div>-->
    <!--                    	</div>-->
								
    <!--                       <input type="hidden" class="form-control" id="txt_total_quantity">-->
    <!--                    </div>       -->
    <!--                </div>-->
    <!--            </div>  -->
    <!--        </div>         -->
    <!--    </div>-->
    <!--</div>-->

    <!--<div class="container mt-1 main-container">-->
    <!--    <div class="row">-->
    <!--        <div class="col-sm-12 col-md-6 col-lg-12">-->
    <!--            <div class="card rounded-0 border-0 mb-12">    -->
    <!--                <div class="card-body " style="padding-top:5px;font-size:12px;overflow:auto;" id="div_gate_pass_child">-->
				<!--		<table id="tbl_gate_pass_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">-->
				<!--			<thead>-->
				<!--				<tr>-->
				<!--					<th>SI</th>-->
				<!--					<th>Category</th>-->
				<!--					<th>Category ID</th>-->
				<!--					<th>Item</th>-->
				<!--					<th>Item ID</th>-->
				<!--					<th>Item Code</th>-->
				<!--					<th>Remarks</th>-->
				<!--					<th>Qty</th>-->
				<!--					<th>Stock</th>-->
				<!--					<th>Unit</th>-->
				<!--					<th style="display:none;">childID </th>-->
				<!--					<th>Action</th>-->
									
				<!--				</tr>-->
				<!--			</thead>-->
				<!--			<tbody>-->
			  
			  
				<!--			</tbody> -->
				<!--		</table> -->
    <!--                    <input type="hidden" id="hid_child_id">                             -->
    <!--                </div>-->
                        
                    
    <!--                    <div class="card-footer">-->
    <!--                        <div class="row">-->
                               
                                <!-- <div class="col-sm-12 col-md-2 col-lg-3">-->
                                <!--    <button class="btn btn-secondary" id="btn_gate_pass_print_without_head"><i class="material-icons">print</i> Print Without Head</button>-->
                                
                                <!--</div>-->
                                <!-- <div class="col-sm-12 col-md-2 col-lg-2">-->
                                <!--    <button class="btn btn-dark" id="btn_gate_pass_print_with_head"><i class="material-icons">print</i> Print With Head</button>-->
                                <!--</div>-->
								
                                <!-- <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">-->
                                <!--    <button class="btn btn-primary" id="btn_employee_register"> <i class="material-icons">list</i>Register</button>-->
                                <!--    <button style="display:none;" class="btn btn-warning" id="btn_edit_gate_pass" style="color:white"> <i class="material-icons">edit</i>  Update Gate Pass</button>-->
                                <!--</div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
           
           
    <div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
        <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
            <div class="card rounded-0 border-0 mb-12">
                <div class="card-header">
					<div class="row">
						<div class="col-sm-10 col-md-10 col-lg-10">
							<h5 class="mb-0">List of Employees</h5>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2" style="text-align:right">
							<!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
							<button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
						</div>
					</div>          
                </div>
                <div class="card-body " style="overflow:auto;">
                    <div class="row ">
                        <div class="col-sm-5 col-md-2 col-lg-2">
							<label for="validationTooltip05">Start Date</label>
							<input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_start_date">
                        </div>
						<div class="col-sm-5 col-md-2 col-lg-2">
							<label for="validationTooltip05">End Date</label>
							<input type="date" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_end_date">
						</div>
						<div class="col-sm-2 col-md-1 col-lg-1" style="padding-top:29px">
							<button class="btn btn-info" id="btn_search_date"> <i class="material-icons">search</i> </button>
						</div> 
						<div class="col-sm-2 col-md-1 col-lg-1" style="padding-top:30px;padding-left:-10px;">
                            <button type="button" class="mb-2 box-shadow mr-2 btn btn-secondary " id="btn_print_with_date"><span class="material-icons">print</span></button>
                        </div>
						<div class="col-sm-6 col-md-3 col-lg-3">
						    <label>Employee Name</label>
							<div id="div_employee_select">  
    							<select class="form-control form-control-sm">
    								<option>--Select Employee--</option>
    							</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-lg-3">
							<label>Contact No</label>
							<input type="text" class="form-control form-control-sm" id="ph_search"> 
						</div>
						
                    </div>
                        
                        <!--Table-->
						    <table class="table " id="list_of_employees" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th>ID</th>
                                        <th>Employee Name</th>
                                        <th>Joining Date</th>
                                        <th>Division</th>
                                        <th>Department</th>
                                        <th>Contact No</th>
                                        <th>Status</th>
                                        <th>View </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                            <div class="card-footer">
                                <div class="row">
                                   
                                     <div class="col-sm-12 col-md-2 col-lg-3">
                                        <button class="btn btn-secondary" id="btn_employee_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                    </div>
                                     <div class="col-sm-12 col-md-2 col-lg-2">
                                        <button class="btn btn-dark" id="btn_employee_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    </div>
    								<div class="col-sm-12 col-md-6 col-lg-5">
    								   <label for="employee_type">Select Employee Type</label>
                                        <select id="employee_type" name="employee_type">
                                          <option value="1">All</option>
                                          <option value="2">Active</option>
                                          <option value="3">Deactive</option>
                                        </select>
 
    								</div>
    								
                                </div>
                            </div>
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
                    <div class="row">
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
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_division_add">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Division</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row">
							<div class="col-sm-12 col-md-9 col-lg-9">
								<label>Division Name</label>
								<input type="text" class="form-control" placeholder="" id="txt_division_name">
							</div>	
                        </div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
					<button type="button" class="btn btn-primary" id="btn_division_save">Save</button>
				</div>
            </div>
        </div>
    </div>
  
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_department_add">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row">
							<div class="col-sm-12 col-md-9 col-lg-9">
								<label>Department Name</label>
								<input type="text" class="form-control" placeholder="" id="txt_department_name">
							</div>	
                        </div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
					<button type="button" class="btn btn-primary" id="btn_department_save">Save</button>
				</div>
            </div>
        </div>
    </div>
  
  