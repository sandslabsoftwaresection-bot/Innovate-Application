<?php

	include('../model/db_connection/connection.php');


?> 
<style>
.input-group-prepend .btn, .input-group-append .btn {
    position: relative;
    z-index: 0;
}
</style>
<!-- content page -->
    <div class="container mt-2 main-container" >
        <div class="card">
            <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
				<div class="media w-100 ">
					<figure class="avatar avatar-40 rounded-circle align-self-start ">
						<img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
					</figure>
					<div class="media-body">
						<h5 class="time-title mb-0  text-white">Accounts Ledger</h5>
					</div>
				   
					
					<div class="dropdown " style="padding-left:50px;">
						<button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							Accounts Ledger
						</button>
						<div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
							<a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_inventory" data-style="expand-right"><span class="ladda-label">List of Inventory Item</span><span class="ladda-spinner"></span></a>
						</div>
					</div>
				</div>
            </div>
            
            <div class="card-body py-0" style="padding-bottom:0px;">
                <div class="row" style="padding-bottom:0px;">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                       
                           
                                <div class="form-group custom-font" style= "padding-top:20px;">
                                   
									<div class="row">
									    <div class="col-sm-12 col-md-4 col-lg-4">
                                           <label>Company Name</label><br>
										
            
                                            <div class="form-group " style="vertical-align:middle;"> 
                                            	<div id="div_company_select" >
                                            		  <select  id="select_company_name" name="select_company_name" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
                                            		 </select>
                                            	</div>
                                            	
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label>Project Name</label><br>
                                            <div class="form-group " style="vertical-align:middle;"> 
                                                <div id="div_project_select_combo">
                                                    <select id="select_project_name" name="select_project_name" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                                                        <option value="0">Select Project</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label>Quotation</label><br>
                                            <div class="form-group " style="vertical-align:middle;"> 
                                                <div  id="div_select_quotation">
                                                    <select id="select_quotation" name="select_quotation" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                                                        <option value="0">Select Quotation</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>
                               
                                        </div>
                                        
                                        
										<div class="row" style="padding-left:20px;display:none;" >
										    
										     <table id="tbl_product_master_list" class="display" style="width:100%;font-size:12px;" >
                                                    <thead>
                                                        <tr>
                                                            <th>SI</th>
                                                            <th>Product Name</th>
                                                            <th>Description</th>
                                                            <th>Unit</th>
                                                            <th>Rate</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      
                                                    </tbody>
                                                     <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th ></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                           
                                                        </tr>
                                                    </tfoot>
                                                   
                                            </table>
                                                <!-- /.table-responsive -->
                        
										    
										    
										</div>
										
										
									<div class="container my-4">
                                      <h4 class="mb-4 text-primary"><i class="bi bi-folder-fill me-2"></i>Project: <span id="div_project_name"></span></h4>
                                    
                                      <div class="row g-3">
                                    
                                        <!-- Contract Value -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-primary text-white card-box text-center">
                                            <i class="bi bi-cash-coin fs-3"></i>
                                            <div class="card-title mt-2">Contract Value</div>
                                            <div class="amount" id="div_contract_value">99,276.397 BD</div>
                                          </div>
                                        </div>
                                    
                                        <!-- Variations -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-info text-white card-box text-center">
                                            <i class="bi bi-plus-circle fs-3"></i>
                                            <div class="card-title mt-2">Variations</div>
                                            <div class="amount" id="div_variations">0.000 BD</div>
                                          </div>
                                        </div>
                                    
                                        <!-- Total Value -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-success text-white card-box text-center">
                                            <i class="bi bi-bar-chart-fill fs-3"></i>
                                            <div class="card-title mt-2">Total Value</div>
                                            <div class="amount" id="div_total_value">109,204.038 BD</div>
                                          </div>
                                        </div>
                                    
                                        <!-- Received Amount -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-warning text-dark card-box text-center">
                                            <i class="bi bi-bank fs-3"></i>
                                            <div class="card-title mt-2">Received Amount</div>
                                            <div class="amount" id="div_received_amount">108,560.700 BD</div>
                                    
                                            <!-- Progress Bar -->
                                            <div class="progress mt-2" style="height: 5px;">
                                              <div class="progress-bar bg-success" role="progressbar" style="width: 99.4%;"></div>
                                            </div>
                                            <small class="text-muted" id="div_total">99.4% of Total</small>
                                          </div>
                                        </div>
                                    
                                        <!-- Net Income -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-light card-box text-center border border-success">
                                            <i class="bi bi-wallet2 fs-3 text-success"></i>
                                            <div class="card-title mt-2">Net Income</div>
                                            <div class="amount text-success" id="div_net_income">98,691.544 BD</div>
                                          </div>
                                        </div>
                                    
                                        <!-- Income VAT -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-light card-box text-center border border-success">
                                            <i class="bi bi-receipt fs-3 text-success"></i>
                                            <div class="card-title mt-2">Income VAT</div>
                                            <div class="amount text-success" id="div_income_vat" >9,869.156 BD</div>
                                          </div>
                                        </div>
                                    
                                        <!-- Expenses -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-light card-box text-center border border-danger">
                                            <i class="bi bi-credit-card-2-back fs-3 text-danger"></i>
                                            <div class="card-title mt-2">Expenses</div>
                                            <div class="amount text-danger" id="div_expense">45,937.117 BD</div>
                                          </div>
                                        </div>
                                    
                                        <!-- Expense VAT -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-light card-box text-center border border-danger">
                                            <i class="bi bi-file-earmark-minus fs-3 text-danger"></i>
                                            <div class="card-title mt-2">Expense VAT</div>
                                            <div class="amount text-danger" id="div_expense_vat">4,593.710 BD</div>
                                          </div>
                                        </div>
                                    
                                        <!-- Total Expense -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-dark text-white card-box text-center">
                                            <i class="bi bi-currency-exchange fs-3"></i>
                                            <div class="card-title mt-2">Total Expense</div>
                                            <div class="amount" id="div_total_expense">60,399.983 BD</div>
                                          </div>
                                        </div>
                                    
                                        <!-- Net Balance -->
                                        <div class="col-6 col-md-3">
                                          <div class="bg-light card-box text-center border border-primary">
                                            <i class="bi bi-piggy-bank fs-3 text-primary"></i>
                                            <div class="card-title mt-2">Net Balance</div>
                                            <div class="amount text-primary" id="div_net_expense">643.338 BD</div>
                                          </div>
                                        </div>
                                    
                                        <!-- Net Margin -->
                                        <div class="col-12 col-md-3">
                                          <div class="bg-success text-white card-box text-center">
                                            <i class="bi bi-graph-up-arrow fs-3"></i>
                                            <div class="card-title mt-2">Net Margin</div>
                                            <div class="amount" id="div_net_margin">48,160.717 BD</div>
                                          </div>
                                        </div>
                                    
                                      </div>
                                    </div>	
										
										
										
										
										
										
										
										
										
								
                                    
                            </div>
                                    
                            <div class="card-footer">
								<div class="row">
									<div class="col-sm-12 col-md-2 col-lg-2"></div>
									<div class="col-sm-12 col-md-2 col-lg-3"></div>
									<div class="col-sm-12 col-md-2 col-lg-2"></div>
								
								</div>
                            </div>
                                   
                        </div>
                    </div>      
                </div>
            </div>    
        </div>      
    </div>
        

    
       
        
        
    <!-- content page ends -->
        
    <div id="mySidenavR" class="sidenavR " height="100%"  style="background-color:white;padding-top:70px;box-shadow: -10px 0px 10px #e3e3e3;">
        <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
            <div class="card rounded-0 border-0 mb-12">
                <div class="card-header">
					<div class="row ">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<h5 class="mb-0">List of Inventory Item</h5>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
							<button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
						</div>
					</div>    
                </div>
                <div class="card-body ">
					<!--Table-->
					<table id="tbl_inventory_list" class="display stripe cell-border" style="width:100%;font-size:12px;" >
						<thead>
							<tr>
								<th>SI</th>
								<th>Category</th>
								<th>Sub Category</th>
								<th>Item Name</th>
								<th>Item Code</th>
								<th>Unit</th>
								<th>Status</th>
								<!--<th>View</th>-->
								
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
								<!--<th></th>-->
							
							</tr>
						</tfoot>   
					</table>
					<!-- /.table-responsive -->    
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_category_add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            <div class="modal-body">
                <div id="error_msg"></div> 
                    <div class="row">
						<div class="col-sm-12 col-md-9 col-lg-9">
							<label>Category Name</label>
							<input type="text" class="form-control" placeholder="" id="txt_category_name">
						</div>	
                    </div>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
				<button type="button" class="btn btn-primary" id="btn_category_save">Save</button>
			</div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalSubCategoryLabel" aria-hidden="true" id="modal_sub_category_add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Sub Category</h5>
                <button type="button" class="close" data-dismiss="modal" id="btn_sub_close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="sub_error_msg"></div> 
                <div class="row">
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <label>Sub Category Name</label>
                        <input type="text" class="form-control" placeholder="" id="txt_sub_category_name">
                        <input type="hidden" id="sub_main_cat_id"> <!-- Will store selected category ID -->
                    </div>	
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_sub_category_save">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalItemNameLabel" aria-hidden="true" id="modal_item_name_add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Item Name</h5>
                <button type="button" class="close" data-dismiss="modal" id="btn_sub_close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="sub_error_msg"></div> 
                <div class="row">
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <label>Item Name</label>
                        <input type="text" class="form-control" placeholder="" id="txt_item_name">
                       
                    </div>	
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_item_name_save">Save</button>
            </div>
        </div>
    </div>
</div>
  

