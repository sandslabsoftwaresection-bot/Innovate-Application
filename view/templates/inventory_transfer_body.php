 <!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                           <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h4 class="time-title mb-0  text-white">Inventory Transfer</h4> 
                            <!--<p class="mb-0  text-white">Click right icon to get Lists<span class="status bg-success"> </span></p>-->
                        </div>
                        <!--<div class="dropdown d-inline-block">-->
                        <!--    <a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--        <i class="material-icons ">more_vertical</i>-->
                        <!--    </a>-->
                        <!--    <div class="dropdown-menu dropdown-menu-right">-->
                        <!--        <a href="" class="dropdown-item">New</a>-->
                                <!--<button  class="btn btn-sm btn-outline-light" onclick="openNavR()" id="btn_view_list_of_project">List</button>-->
                                
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="card-body py-0">
                     
                   
                    <!--Company FORM-->
                    
                    
                    <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10 ">
                            <div class="form-group row">
								<div class="col-lg-2 col-md-2">
									<label>Transfer From</label>
								</div>
                                <div class="col-lg-4 col-md-4">
                                    <select class="form-control form-control-sm" id="select_store" data-live-search="true" tabindex="-1" aria-hidden="true">
                                        <option value="0">--Select--</option>   
                                        <option value="1">Store 1</option>   
										<option value="2">Store 2</option>  
                                     </select>
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

    
			<div class="card rounded-0 border-0 mb-12">
				<div class="card-header">
					
				   
						<div class="row ">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<h5 class="mb-0">List of Inventory&nbsp;&nbsp;<span id="head_tbl"></span></h5> 
							</div>
							
						</div>
					
					
				</div>
				<div class="card-body ">
					 
				
				<!--Table-->
					<table class="table " id="list_of_inventory" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
						<thead>
							<tr class="custom-font">
							   
								<th >SlNo </th>
								<th >Item Name </th>
								<th>Stock Qty </th>
								<th>Transfer Qty </th>
								<th>Transfer </th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<!-- /.table-responsive -->
				</div>
			</div>
		</div>


        
        
<!-- content page ends -->
        
