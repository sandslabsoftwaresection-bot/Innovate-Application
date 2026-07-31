
    <div class="container mt-12 main-container">
            <div class="row ">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            <div class="row">
								<div class="col-sm-5 col-md-5 col-lg-5">
									<label for="validationTooltip05">Start Date</label>
									<input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_item_start_date">
								</div>
								<div class="col-sm-5 col-md-5 col-lg-5" style="text-align:right">
									<label for="validationTooltip05">End Date</label>
									<input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_item_end_date">
								</div>
								<div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
									<button class="btn btn-info" id="btn_item_search_date"> <i class="material-icons">search</i> </button>
								</div>   
                            </div>
                              
                            
                            <table id="tbl_store_report_list" class="table table-striped table-bordered" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                       <th>SI</th>
                                        <th>Description</th>
                                        <th>Unit</th>
                                        <th>Total Qty</th>
                                        <th>Issued Qty</th>
                                        <th>Damaged Qty</th>
                                        <th>Balance Qty</th>
                                        <th>view</th>
                                        
                                       
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
                                        
                                    </tr>
                                </tfoot>
                               
                            </table>
                        </div>  
                        <div class="card-footer">
                            <div class="row ">
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                </div>
								<!--<div class="col-sm-12 col-md-2 col-lg-2">-->
        <!--                            <button class="btn btn-info" id="btn_local_po_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>-->
        <!--                        </div>-->
                                 
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
                                       
                                        <input type="hidden" id="hidden_item_id">
                                        <!--<h1 ></h1>-->
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:right"> 
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()" id="list_store_rep_sidenav"><span class="material-icons icon-sm">close</span></button>
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
                         <h5 class="mb-0" id="item_history_span"></h5>
                            <!--Table-->
                            
                            <table class="table " id="history_of_store_item" class="display stripe cell-border" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th>ID</th>
                                        <th>Status</th>
										<th>Date</th>
                                        <th>Ref No</th>
										<th>Qty</th>
										<th>Company Name</th>
                                        <th>Project Name</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="row ">
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_print_history_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_print_history_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                </div>
								<!--<div class="col-sm-12 col-md-2 col-lg-2">-->
        <!--                            <button class="btn btn-info" id="btn_local_po_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>-->
        <!--                        </div>-->
                                 
                            </div>
                    </div>
                </div>
</div>

        