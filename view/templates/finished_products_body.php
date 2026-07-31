 <!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                           <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h4 class="time-title mb-0  text-white">Finished Products</h4> 
                            <!--<p class="mb-0  text-white">Click right icon to get Lists<span class="status bg-success"> </span></p>-->
                        </div>
                        <!--<div class="dropdown d-inline-block">-->
                        <!--    <a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--        <i class="material-icons ">more_vertical</i>-->
                        <!--    </a>-->
                        <!--    <div class="dropdown-menu dropdown-menu-right">-->
                        <!--        <a href="" class="dropdown-item">New</a>-->
						<div class="dropdown d-inline-block">
							<div class="dropdown " style="padding-left:50px;">
								<button class="btn btn-sm btn-outline-light" id="btn_refresh_page"><i class="material-icons">autorenew</i></button>
								<button class="btn btn-sm btn-outline-light dropdown-toggle ml-2 " type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">FP List</button>
									
								<div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
									<a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_finished_pdt" data-style="expand-right"><span class="ladda-label">List of FP</span><span class="ladda-spinner"></span></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                     
                   
                    <!--Company FORM-->
                    
                    
                <div class="card-body" id="div_card_1">
                    <div class="row justify-content-center">
                        <div class="col-md-10 ">
                            <div class="form-group row">
							
								<div class="col-sm-12 col-md-4 col-lg-4">
									<label>Select Finished Product</label>
									<div id="div_fin_invnt_select">
										<select class="form-control form-control-sm">
										
										</select>
									</div>
									<input type="hidden" class="form-control form-control-sm" id="txt_inventory_unit">
								</div>
                                
                                <div class="col-sm-12 col-md-4 col-lg-4">
									<label>Qty</label><br>
									<input type="text" class="form-control form-control-sm" placeholder= "0.00" id="txt_fin_qty">
								</div>
								
								<div class="col-sm-12 col-md-4 col-lg-4" style="padding-top:30px;">
									<button type="button" class="mb-2 btn btn-primary btn-sm" id="btn_add_list">Add Inventory</button>
								</div>
                               
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
                    
                    
                    <!--Company FORM End-->
					
                      
                    
                </div>
            </div><br>

    
			<div class="card rounded-0 border-0 mb-12" id = "div_card_2">
				<div class="card-header">
					
				   
						<div class="row ">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<h5 class="mb-0">List of Consumable Inventory - Store 2</h5> 
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6 text-right">
								<h5 class="mb-0">Finished Product : <span id="finished_in_name" style="color:red;"></span> , Qty : <span id="qty"style="color:red;"></span> , Unit : <span id="unit" style="color:red;"></span></h5>
							</div>
						</div>
					<input type="hidden" class="form-control form-control-sm" id="txt_last_id">
					
				</div>
				<div class="card-body ">
					 
				
				<!--Table-->
					<table class="table " id="list_of_consume_inventory" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
						<thead>
							<tr class="custom-font">
							   
								<th >SlNo </th>
								<th >Item Name </th>
								<th>Stock Qty </th>
								<th>Qty </th>
								<th>Action </th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table><br>
					<!-- /.table-responsive -->
					
					<div class="container mt-12 main-container">
						<div class="row ">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<h5 class="mb-0">Added Inventory</h5> 
							</div>
						</div><br>
						<div class="row ">
							<div class="col-sm-12 col-md-6 col-lg-12">
								<div class="card rounded-0 border-0 mb-12">
									<div class="card-body " style="padding-top:5px;font-size:12px">
										<table id="tbl_con_inventory_child" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
											<thead>
												<tr>
													<th>SI No</th>
													<th>Item Name</th>
													<th>Consume Qty</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											  
											</tbody>
										</table> 
									</div>
									
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
                                        <h5 class="mb-0">List of Finished Products</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             <!--<div class="row ">
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
                                  
                                </div>-->
                        
                        <!--Table-->
                            <table class="table " id="list_of_finished_pdt" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th>Sl No</th>
                                        <th>Finished Product </th>
                                        <th>Qty</th>
                                        <th>Unit </th>
                                        <th>Date</th>
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