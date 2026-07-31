<!-- content page -->
    <div class="container mt-2 main-container">
        <div class="card">
            <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
				<div class="media w-100 ">
					<figure class="avatar avatar-40 rounded-circle align-self-start ">
						<img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
					</figure>
					<div class="media-body">
						<h5 class="time-title mb-0  text-white">New Salary Slip</h5>
					</div>   
					<div class="dropdown " style="padding-left:50px;">
						<button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Salary Slip List
						</button>
						<div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
							<a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="view_salary_slip" data-style="expand-right"><span class="ladda-label">List of Salary Slips</span><span class="ladda-spinner"></span></a>
							<a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_basic_salaries">List Of Basic Salaries</a>
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
											<div id="div_employee_select">
    											<select class="form-control form-control-sm">
    												<option>--Select Employee--</option>
    											</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
												<label>ID</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
												<input type="text" class="form-control form-control-sm" id="employee_id" disabled> 
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
												<label>Division</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
												<input type="text" class="form-control form-control-sm" id="employee_division" disabled> 
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
												<label>Department</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
												<input type="text" class="form-control form-control-sm" id="employee_department" disabled> 
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
												<label>Contact No</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
												<input type="text" class="form-control form-control-sm" id="contact_no" disabled> 
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											<label>GOSI Pr</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    											<div class="input-group mb-3" style="vertical-align:middle;"> 
                                            		<input type="text" class="form-control form-control-sm" id="txt_gosi_pr" disabled>
                                            		<div class="input-group-append">
                                            			<span class="input-group-text">%</span>
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
    												<input type="text" class="form-control form-control-sm" id="txt_travel_allo_rt" disabled> 
    										</div>
    									</div>
    								</div>
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
												<label>Note</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
												<textarea type="text" class="form-control form-control-sm" id="txt_note"></textarea> 
										</div>
									</div>
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
												<label>Duty Hr</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
												<input type="text" class="form-control form-control-sm" id="txt_duty_hr"> 
										</div>
									</div>
								</div>	 
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
											<label>Days</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
											<input type="text" class="form-control form-control-sm" id="txt_days"> 
										     
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
											<label>Starting Time</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
											<input type="time" class="form-control form-control-sm" id="txt_starting_time"> 
										     
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
											<label>Ending Time</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
											<input type="time" class="form-control form-control-sm" id="txt_ending_time"> 
										     
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
											<label>Date</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
											<input type="date" class="form-control form-control-sm" id="txt_date"> 
										     
										</div>
									</div>
								</div>
    							<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    											<label>Normal OT Rate</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    											<input type="text" class="form-control form-control-sm" id="txt_normal_ot" disabled> 
    										     
    										</div>
    									</div>
    								</div>
    								<div class="form-group custom-font">
									<div class="row" >
										<div class="col-sm-12 col-md-6 col-lg-4">
												<label>Special OT Rate</label>
										</div>
										<div class="col-sm-12 col-md-6 col-lg-8">
												<input type="text" class="form-control form-control-sm" id="txt_special_ot" disabled> 
												<input type="hidden" class="form-control form-control-sm" id="txt_basic_salary">
												
										</div>
									</div>
								</div>
								<div class="form-group custom-font">
    									<div class="row" >
    										<div class="col-sm-12 col-md-6 col-lg-4">
    												<label>Indemnity Bonus Rate</label>
    										</div>
    										<div class="col-sm-12 col-md-6 col-lg-8">
    												<input type="text" class="form-control form-control-sm" id="txt_indemnity_rt" disabled> 
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
                    <div class="card-body">
                       
                        <div class="row">
                            <div class="col-md-2 mb-4 sm-12" style="">
                                    <label for="checkbox">Final Settlement:</label>
                                    <input type="checkbox" id="checkbox" name="checkbox">
                            </div> 
                            <div class="col-md-10 mb-4 sm-12" id="div_final_stlmt">
                                <div class="row">
                                    <div class="col-md-3 mb-4 sm-12" style="">
                                            <label>Rejoining Date</label>
                                            <input type="date" class="form-control form-control-sm" id="txt_rejoining_date" disabled> 
                                    </div>
                                    <div class="col-md-3 mb-4 sm-12" style="">
                                            <label>Last Date</label>
                                            <input type="date" class="form-control form-control-sm" id="txt_last_date"> 
                                    </div>
                                    <div class="col-md-2 mb-4 sm-12" style="">
                                            <label>Months</label>
                                            <input type="text" class="form-control form-control-sm" id="txt_calc_month" disabled> 
                                    </div>
                                    <div class="col-md-2 mb-4 sm-12" style="">
                                            <label>No Of Days</label>
                                            <input type="text" class="form-control form-control-sm" id="lbl_number_of_days" disabled> 
                                            
                                    </div>
                                </div>    
                            </div>       
                        </div>               
                            
                        <div class="row">
							<div class="col-md-4 mb-4 sm-12" style="">
								<label for="validationTooltip03">Allowance</label>
								<div class="input-group mb-3" style="vertical-align:middle;"> 
                            		<div id="div_allowence_select" style="width:80%;">
                            			<select class="form-control form-control-sm">
                            				<option>--Select Allowance--</option>
                            			</select>
                            		</div>
                            		<div class="input-group-append">
                            			<button class="btn btn-primary" id="btn_add_allowence">Add</button>
                            		</div>
                            	</div>
                            	<textarea type="text" class="form-control form-control-sm" id="txt_allo_desc"></textarea>
							    
							</div>
							<div class="col-md-2 mb-4 sm-12">
                            	 <label for="validationTooltip03" id="label_allo">Amount</label>
                            	  <div class="input-group mb-3" style="vertical-align:middle;"> 
                            		<input type="text" class="form-control" id="txt_allo_amount" style="width:55%;"/>
                            		<div class="input-group-append">
                            			<button class="btn btn-success" id="btn_save_allo"><i class="material-icons ">save</i></button>
                            		</div>
                            	</div>
                            </div>
							<div class="col-md-4 mb-4 sm-12" style="">
				                 <label for="validationTooltip03">Deduction</label>
        						  <div class="input-group mb-3" style="vertical-align:middle;"> 
                                	<div id="div_deduction_select" style="width:80%;">
                                		<select class="form-control form-control-sm">
                                			<option>--Select Deduction--</option>
                                		</select>
                                	</div>
                                	<div class="input-group-append">
                                		<button class="btn btn-primary" id="btn_add_deduction">Add</button>
                                	</div>
                                </div>
                                <textarea type="text" class="form-control form-control-sm" id="txt_dedc_desc"></textarea>
                        	</div>
                        	<div class="col-md-2 mb-4 sm-12">
                            	 <label for="validationTooltip03">Amount</label>
                            	  <div class="input-group mb-3" style="vertical-align:middle;"> 
                            		<input type="text" class="form-control" id="txt_deduc_amount" style="width:55%;"/>
                            		<div class="input-group-append">
                            			<button class="btn btn-success" id="btn_save_dedu"><i class="material-icons ">save</i></button>
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
                    <div class="card-body " style="padding-top:5px;font-size:12px;overflow:auto;" id="div_salary_slip_child">
						<table id="tbl_salary_slip_list" class="table table-striped table-bordered dataTable" style="width:100%" style="padding-top:5px;font-size:12px">
							<thead>
								<tr>
									<th>SI</th>
									<th>Allowance/Deduction</th>
									<th>Allo/Dedu id</th>
									<th>Hrs</th>
									<th>Days</th>
									<th>Allowance Amount</th>
									<th>Deduction Amount</th>
									<th>Description</th>
									<th>status</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
			                    
							</tbody>
							<tfoot>
                                <tr>
                                    <td></td>
                                    <!--<td></td>-->
                                    <!--<td></td>-->
                                    <td colspan="4"><strong>Total</strong></td>
                                    <td style="text-align: right;"><span id="total_allowance_amount" style="font-weight: bold; text-align: right;">0.000</span></td>
                                    <td style="text-align: right;"><span id="total_deduction_amount" style="font-weight: bold; text-align: right;">0.000</span></td>
                                    <td colspan="2"><strong>Net Amount</strong></td>
                                    <td style="text-align: right;"><span id="span_net_amount" style="font-weight: bold; text-align: right;">0.000</span></td>
                                </tr>
                            </tfoot>
						</table> 
                        <input type="hidden" id="hid_child_id">                             
                    </div>
                        
                    
                        <div class="card-footer">
                            <div class="row">
                               
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_salary_slip_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_salary_slip_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                </div>
								
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                      
                                        <button class="btn btn-primary" id="btn_employee_register"> <i class="material-icons">list</i>Generate</button>
                                        <button style="display:none;" class="btn btn-warning" id="btn_edit_employee" style="color:white"> <i class="material-icons">edit</i>  Update Gate Pass</button>
                                        <input type="hidden" class="form-control form-control-sm" id="v_id"> 
                                        <input type="hidden" class="form-control form-control-sm" id="v_salary_main_id">
                                        <input type="hidden" class="form-control form-control-sm" id="v_final_stlmt">
                                            
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
					<div class="row">
						<div class="col-sm-10 col-md-10 col-lg-10">
							<h5 class="mb-0">List of Salary Slips</h5>
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
						<!--<div class="col-sm-2 col-md-1 col-lg-1" style="padding-top:29px">-->
						<!--	<button class="btn btn-info" id="btn_search_date"> <i class="material-icons">search</i> </button>-->
						<!--</div> -->
						<div class="col-sm-6 col-md-2 col-lg-2">
						    <label>Employee Name</label>
							<div id="div_employee_select_for_search">  
    							<select class="form-control form-control-sm">
    								<option>--Select Employee--</option>
    							</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-lg-3">
						    <label>Division</label>
							<div id="div_divis_select_for_search">  
    							<select class="form-control form-control-sm">
    								<option>--Select Division--</option>
    							</select>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-lg-3">
						    <label>Department</label>
							<div id="div_dpt_select_for_search">  
    							<select class="form-control form-control-sm">
    								<option>--Select Department--</option>
    							</select>
							</div>
						</div>
						<!--<div class="col-sm-6 col-md-3 col-lg-3">-->
						<!--	<label>Contact no</label>-->
						<!--	<input type="text" class="form-control form-control-sm" id="ph_search"> -->
						<!--</div>-->
						
                    </div>
                        
                        <!--Table-->
						    <table class="table " id="list_of_salary_slip" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th>ID</th>
                                        <th>Employee Name</th>
                                        <th>ID</th>
                                        <th>Division</th>
                                        <th>Department</th>
                                        <th>Salary Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>View </th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total:</stong></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
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
							<h5 class="mb-0">List of Basic Salaries</h5>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2" style="text-align:right">  
							<!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
							<button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRCancel()"><span class="material-icons icon-sm">close</span></button>
						</div>
					</div>       
                </div>
                <div class="card-body " style="overflow:auto;">
                    <div class="row">
						<!--<div class="col-sm-5 col-md-5 col-lg-5">-->
						<!--	<label for="validationTooltip05">Start Date</label>-->
						<!--	<input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_start_date">-->
						<!--</div>-->
						<!--<div class="col-sm-5 col-md-5 col-lg-5" style="text-align:right">-->
						<!--	<label for="validationTooltip05">End Date</label>-->
						<!--	<input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_end_date">-->
						<!--</div>-->
						<!--<div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">-->
						<!--	<button class="btn btn-info" id="btn_cancel_search_date"> <i class="material-icons">search</i> </button>-->
						<!--</div>        -->
                    </div>
                        
                        <!--Table-->
                             <table class="table " id="basic_salary_list" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                        <th>ID</th>
                                        <th>Employee Name</th>
                                        <th>Employee ID</th>
                                        <th>Division</th>
                                        <th>Department</th>
                                        <th>Basic Salary</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                 <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total:</stong></td>
                                    <td></td>
                                    <td></td>
                                    
                                </tr>
                            </tfoot>
                            </table>
                            <!-- /.table-responsive -->
                        
                        
                        
                        
                        
                </div>
                 				
            </div>
               
        </div>
            <div class="col-sm-12 col-md-2 col-lg-2">
                <button class="btn btn-dark" id="btn_basic_salary_print_with_head"><i class="material-icons">print</i> Print With Head</button>
            </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_allowence_add">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Allowence</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row">
							<div class="col-sm-12 col-md-9 col-lg-9">
								<label>Title</label>
								<input type="text" class="form-control" placeholder="" id="txt_allowence_name">
							</div>	
                        </div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
					<button type="button" class="btn btn-primary" id="btn_allowence_save">Save</button>
				</div>
            </div>
        </div>
    </div>
  
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_deduction_add">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Deduction</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row">
							<div class="col-sm-12 col-md-9 col-lg-9">
								<label>Title</label>
								<input type="text" class="form-control" placeholder="" id="txt_deduction_name">
							</div>	
                        </div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
					<button type="button" class="btn btn-primary" id="btn_deduction_save">Save</button>
				</div>
            </div>
        </div>
    </div>
  
  