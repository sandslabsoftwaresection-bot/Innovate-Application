
	<div class="container mt-12 mb-0 main-container">
        <div class="card mb-12">
            <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
				<div class="media w-100 ">
					<figure class="avatar avatar-40 rounded-circle align-self-start ">
						<img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
					</figure>
					<div class="media-body">
						<h5 class="time-title mb-0  text-white">Fixed Report</h5>
					</div>
				</div>
            </div>
			
            <div class="card-body py-0">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card rounded-0 border-0 mb-5">   
                            <div class="card-body w-100">
								<div class="row" >
									<div class="col-lg-12 col-md-12 col-sm-12">
										<label for="validationTooltip03">Select Inventory</label>
									</div>
									<div class="col-lg-6 col-md-4 col-sm-6">
                                        <div id="div_load_inventory">									
											
                                        </div>										
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4">
                                       	<button class="btn btn-dark" id="btn_print_pur_machinery"><i class="material-icons">print</i> Print All</button>								
									</div>
								</div>		 
                            </div>      
                        </div>
                    </div>                            
                </div>
            </div>

         <div class="container mt-0 main-container">
            <div class="row ">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            <table id="tbl_inventory_mahinery" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Inventory Item</th>
                                        <th>Unit</th>
                                        <th>Store 1 Stock</th>
                                        <th>Store 2 Stock</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                            </table>  
                        </div>
                        <!--<div class="card-footer">
                            <div class="row ">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_print_pur_machinery"><i class="material-icons">print</i> Print Inventory</button>
                                </div>
                            </div>
                        </div>-->
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
					<div class="row col-sm-12 col-md-12 col-lg-12">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<h5 class="mb-0" id="span_iten_name_machinery"></h5>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-6" style="text-align:right"> 
							<!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
							<button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()" id="list_pr_sidenav"><span class="material-icons icon-sm">close</span></button>
						</div>
					</div>
				</div>
				<div class="card-body ">
				    <div class="row mb-3">
					  <div class="col-lg-4 col-md-4 col-sm-4 text-center">
						  <h3 class="mb-1" id="span_iten_name"></h3>
						  <input type="hidden" class="form-control" id="txt_view_row_id">
					  </div>
					  <div class="col-lg-4 col-md-4 col-sm-4">
						 	<button class="btn btn-dark" id="btn_view_inventory_print_mac"><i class="material-icons">print</i> Print</button>
					  </div>
				   </div>
					<!--Table-->
					<table class="table " id="tbl_view_inventory_details_mac" class="custom-font" style="padding-top:5px;font-size:12px">
						<thead>
							<tr class="custom-font">
								<th>Sl No</th>
								<th>Date</th>
								<th>Inventory</th>
								<th>Description</th>
								<th>Qty</th>
								<th>Unit</th>
								<th>Action</th>
								<th>Ref</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
						<tfoot>
							
                        </tfoot>
					</table>
				</div>
			</div>
		</div>
    </div>
                           
               