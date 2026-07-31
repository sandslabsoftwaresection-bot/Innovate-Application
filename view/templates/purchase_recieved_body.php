<!-- content page -->
        <div class="container mt-12 main-container" >

            <div class="card mb-12">
               <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">Purchase Received</h5>
                        </div>
						
                        <div class="dropdown d-inline-block">
                            <div class="dropdown " style="padding-left:50px;">
								<button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									PR List
								</button>
								<div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
									<a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_pur_reci" data-style="expand-right"><span class="ladda-label">List of PR</span><span class="ladda-spinner"></span></a>
									<a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_pur_reci_approved" data-style="expand-right"><span class="ladda-label">Approved PR</span><span class="ladda-spinner"></span></a>
									<a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_prs">Cancelled PR</a>
								</div>
                            </div>
                        </div>
						
                    </div>
                </div>
                <div class="card-body py-0 ">
                     
                   
                    <div class="row " >
                            <div class="col-sm-12 col-md-6 col-lg-5">
                                <div class="card rounded-0 border-0 mb-5">
                                    
                                    <div class="card-body ">
                                        
										<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                     <label>LPO NO</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <div id="div_lpo_select">
														<select class="form-control form-control-sm">
															<option>--Select LPO NO--</option>
														</select>
													</div>	
                                                </div>
                                            </div>
                                        </div> 	
										
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Supplier Name</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control" id="txt_supplier_name">
													<input type="hidden" class="form-control" id="txt_supplier_id">													
                                                </div>
                                            </div>
                                        </div>
										
                                       <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_recieve_date"> 
                                                </div>
                                            </div>
                                        </div>  
                                         
										<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Job Location</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control" id="txt_job_location"> 
                                                </div>
                                            </div>
                                        </div>
										
										<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Requested by</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control" id="txt_recieve_requested_by" value="Krishan"> 
                                                </div>
                                            </div>
                                        </div> 
										
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                               
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-5">
                                <div class="card rounded-0 border-0 mb-5">
                                    
                                    <div class="card-body ">
                                        
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Approved by</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control" id="txt_recieve_approved_by"> 
                                                </div>
                                            </div>
                                        </div> 
    
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>PRD - NO</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_prd_no"> 
                                                </div>
                                            </div>
                                        </div>
										
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Bill No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control" id="txt_recieve_bill_no"> 
                                                </div>
                                            </div>
                                        </div> 
										
										<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Work Order No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
													<input type="text" class="form-control" id="txt_job_no"> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Requisition NO</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
													<input type="text" class="form-control" id="txt_pr_no">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Project NO</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
													<input type="text" class="form-control" id="txt_project_no">
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
            <div class="row " id="div_tbl_purchase_recieve_add">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            <table id="tbl_purchase_recieve_add" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Description</th>
                                        <th>Item Id</th>
                                        <th>Category Name</th>
                                        <th>Category id</th>
                                        <th>Item Code</th>
                                        <th>Qty Req</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Tax(%)</th>
										<th>Qty Recieved</th>
										<th>Qty Bal</th>
										<th>Qty accepting</th>
										<th>Remarks</th>
                                        <th>Net Total</th>
                                        <th>Add</th>
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
                                        <th></th>
                                        <th></th>
                                        <th>Sub Total</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table> 
                        </div>
						
                    </div>
                </div>
            </div>
        </div>
		
		<div class="container mt-12 main-container">
            <div class="row ">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            <table id="tbl_purchase_recieve_second_add" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
                                <!--<thead>-->
                                <!--    <tr>-->
                                <!--        <th>SI</th>-->
                                <!--        <th>Description</th>-->
                                <!--        <th>Qty</th>-->
                                <!--        <th>Unit</th>-->
                                <!--        <th>Rate</th>-->
                                <!--        <th>Tax(%)</th>-->
                                <!--        <th>Net Total</th>-->
                                <!--        <th>Delete</th>-->
                                <!--    </tr>-->
                                <!--</thead>-->
                                 <thead>
                                    <tr>
                                        <th style="text-align: center;">SI</th>
                                        <th style="text-align: center;">Category</th>
                                        <th>Category Id</th>
                                        <th>Description</th>
                                        <th>item Id</th>
                                        <th>item code</th>
                                        <th style="text-align: center;">Qty</th>
                                        <th style="text-align: center;">Unit</th>
                                        <th style="text-align: center;">Rate</th>
                                        <th>Amount</th>
                                        <th style="text-align: center;">Tax(%)</th>
                                        <th style="text-align: center;">Net Total</th>
                                        <th>Child id</th>
                                        <th>PRChild id</th>
                                        <th style="text-align: center;">Remarks</th>
                                        <th>Request Qty</th>
                                        <th>Purchase No</th>
                                        
                                        <th>Action</th>
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
                                        <th>Total</th>
                                        <th id="foot_sum" style="text-align: right;"></th>
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
                        
                        <div class="card-footer">
                            <div class="row ">
                                <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_pur_recie_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                </div>
                                
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_pur_recie_with_head"><i class="material-icons">print</i> Print With Head</button>
                                </div>
								<!--<div class="col-sm-12 col-md-2 col-lg-2">-->
        <!--                            <button class="btn btn-info" id="btn_pur_recie_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>-->
        <!--                        </div>-->
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_pur_recie"> <i class="material-icons">list</i>  Generate PR</button>
									<!--<button class="btn btn-warning text-white" id="btn_generate_edit_pur_recie"> <i class="material-icons">edit</i>  Update PR</button>-->
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
                                        <h5 class="mb-0">List of Purchase Received</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:right"> 
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()" id="list_pr_sidenav"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                            <div class="row">
								<div class="col-sm-5 col-md-5 col-lg-5">
									<label for="validationTooltip05">Start Date</label>
									<input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_view_start_date">
								</div>
								<div class="col-sm-5 col-md-5 col-lg-5" style="text-align:right">
									<label for="validationTooltip05">End Date</label>
									<input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_view_end_date">
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
									<button class="btn btn-info" id="btn_view_search_date"> <i class="material-icons">search</i> </button>
								</div>   
                            </div>
                        
                            <!--Table-->
                            <table class="table " id="list_of_purchase_recieve" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID</th>
                                        <th>Date</th>
										<th>Supplier</th>
                                        <th>PR No</th>
										<th>PRD No</th>
										<th>LPO No</th>
                                        <th>WorkOrder No</th>
                                        <th>Project No</th>
                                        <th>Job Location</th>
										<th>Bill No</th>
                                        <th>View</th> 
                                        <th>status</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
</div>



<div id="mySidenavRCancel" class="sidenavR " height="100%" style="background-color:white;z-index: 999">

                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Cancel PR</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRCancel()" id="btn_canceled_pr_list"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body ">
                             <div class="row ">
                                    <div class="col-sm-6 col-md-5 col-lg-5">
                                        <label for="validationTooltip05">Start Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_start_date">
                                    </div>
                                    <div class="col-sm-6 col-md-5 col-lg-5" style="text-align:right">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_end_date">
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_search_cancel_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                  
                                </div>
                        
                           <!--Table-->
                           <table class="table" id="list_cancelled_of_purchase_recieve" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date</th>
										<th>Supplier</th>
                                        <th>PR No</th>
										<th>PRD No</th>
										<th>LPO No</th>
                                        <th>Work Order No</th>
                                        <th>Project No</th>
                                        <th>Job Location</th>
										<th>Bill No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

   
</div>


 <!-- Modal Purchase req child table -->
 <div class="modal modal-md fade" id="modal_purchase_req_child" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_quantity_change">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Add Entry</h5>
					<button type="button" class="close" data-dismiss="modal" id="" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                    <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<label>Description</label>
							 <textarea class="form-control custom-font"  rows="3" id="txt_purchase_recieve_description"></textarea>
						</div>
					</div><br />

                    <div class="row">					
						<div class="col-sm-6 col-md-6 col-lg-6">
							 <label>LPO Quantity</label>
							 <input type="text" class="form-control" id="txt_lpo_quantity" placeholder="Qty" disabled>
                        </div>
						<div class="col-sm-6 col-md-6 col-lg-4 ">
							 <label>Unit</label>
							 <input type="text" class="form-control" id="txt_purchase_recieve_unit" disabled>
                        </div>   
                    </div><br />
                    <div class="row">					
						<div class="col-sm-6 col-md-6 col-lg-6">
							 <label>Recieved Quantity</label>
							 <input type="text" class="form-control" id="txt_purchase_recieve_quantity" placeholder="Qty">
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
							 <label>Balance Quantity</label>
							 <input type="text" class="form-control" id="txt_balance_quantity" placeholder="Qty" disabled>
							 <input type="hidden" class="form-control" id="txt_hidden_balance" placeholder="Qty" disabled>
                        </div>
						
                    </div><br />
                    
					
					<div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
							 <label>Rate (BD)</label>
							 <input type="text" class="form-control" id="txt_purchase_recieve_rate" placeholder="0.00" disabled>
                        </div>  
                        <div class="col-sm-6 col-md-6 col-lg-6">
							 <label>Amount (BD)</label>
							 <input type="text" class="form-control" id="txt_purchase_recieve_amount" placeholder="0.00" disabled>
							 <input type="hidden" class="form-control" id="txt_hidden_lpo_id" disabled>
                        </div> 
                        	<input type="hidden" class="form-control" id="txt_unit">
					
                    </div><br />
                    <div class="row">					
							<div class="col-sm-6 col-md-6 col-lg-6">
						    <label>Tax%</label>
						    <div id="div_tax_select">												
							   <select class="form-control form-control-sm">
								  <option>Select</option> 
							   </select>
							</div>
						</div>
						
						  
                    </div><br />
					
				  <!---->	
				  <div class="row">
				      
				      <div class="col-sm-6 col-md-6 col-lg-6" style="">
						<label for="validationTooltip03">Store</label>
						
						  <div id="div_category_load_pur_recie">
						  <select  id="select_iventory_category" name="select_iventory_category" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
						 </select>
						  
						  </div>
					</div>
				      
					<div class="col-sm-6 col-md-6 col-lg-6" style="">
						<label for="validationTooltip03">Item</label>
						  <div id="div_item_load_pur_recie">
						    <select class="form-control form-control-sm" id="">
						        <option value="0" >-Select Item--</option>
						    </select>
						  </div>
					</div>
				
				  </div>
				  <!----><br />           
                </div>
				
                <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="">Close</button>
					<button type="button" class="btn btn-primary" id="btn_save_purchase_recie">Add</button>
			    </div>           
            </div>
            </div>
        </div>
    </div>
    <!-- /Modal Purchase req child table -->
    
    
    
    
    <div class="modal modal-md fade" id="modal_purchase_req_add_to_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_quantity_change">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Add to Project</h5> &nbsp;&nbsp;&nbsp; <h5 id="span_product" style="color:red"></h5>&nbsp;&nbsp;&nbsp; Quantity : <h5 id="span_quantity"></h5>
					<button type="button" class="close" data-dismiss="modal" id="" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                   
                <div class="row" >
									    <div class="col-sm-12 col-md-6 col-lg-6">
                                           <label>Company Name</label><br>
										
            
                                            <div class="form-group " style="vertical-align:middle;"> 
                                            	<div id="div_company_select" style="width:400px;" >
                                            		  <select  id="select_company_name" name="select_company_name" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
                                            		 </select>
                                            	</div>
                                            	
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label>Project Name</label><br>
                                            <div class="form-group " style="vertical-align:middle;"> 
                                                <div id="div_project_select_combo" style="width:400px;">
                                                    <select id="select_project_name" name="select_project_name" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                                                        <option value="0">Select Project</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>
                                       
                               
                        </div>
                        <div class="row">
                             <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label>Quotation</label><br>
                                            <div class="form-group " style="vertical-align:middle;"> 
                                                <div  id="div_select_quotation" style="width:400px;">
                                                    <select id="select_quotation" name="select_quotation" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                                                        <option value="0">Select Quotation</option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>
                          <div class="col-sm-12 col-md-2 col-lg-2">
                            <label>Available Qty</label><br>
                            <div class="form-group " style="vertical-align:middle;"> 
                              <input type="text" class="form-control" id="txt_available_quantity" disabled>  
                                
                            </div>
                        </div> 
                       <div class="col-sm-12 col-md-2 col-lg-2">
                            <label>Required Qty</label><br>
                            <div class="form-group " style="vertical-align:middle;"> 
                              <input type="text" class="form-control" id="txt_required_qty">  
                                
                            </div>
                        </div> 
                        <div class="col-sm-12 col-md-3 col-lg-2 pt-4 mt-1">
                            	<button type="button" class="btn btn-primary" id="btn_save_purchase_recie_add_to_project">Add</button>
                        </div>
                             
                        </div> 
                          
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12">
                              <table class="table" id="tbl_purchase_to_project" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th>SI No</th>
                                        <th>Company</th>
										<th>Project</th>
                                        <th>Quotation</th>
										<th>Item Name</th>
										<th>Supplier</th>
										<th>Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                          </div>              
                                         
                            
                        
                    
                   
                    
					
					
                  
					
				          
                </div>
				
                <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="">Close</button>
				
			    </div>           
            </div>
            </div>
        </div>
