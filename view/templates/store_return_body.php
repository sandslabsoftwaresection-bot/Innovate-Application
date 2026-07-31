<?php

	include('../model/db_connection/connection.php');

	$DBConn1 = new DBConnection();
	$varDBConnection1 = $DBConn1->ConnectToMYSQL();
	$fetch_unit = mysqli_query($varDBConnection1, "SELECT * FROM unit_master");
	$fetch_amnt_type = mysqli_query($varDBConnection1, "SELECT * FROM amount_type_tbl");
	

?>

<div class="container mt-2 main-container" >
     <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New store return</h5>
                            <p class="mb-0  text-white">Store Return #: <inno id="return_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                        
                        <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Store Return List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_return" data-style="expand-right"><span class="ladda-label">List of Store Return</span><span class="ladda-spinner"></span></a>
                                
                                
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="card-body py-0">
                     
                   
                    <div class="row" >
                            <div class="col-sm-12 col-md-6 col-lg-5">
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
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_invoice_company_name">
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_invoice_company_id"> 
                                                </div>
                                        </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                                            <label for="validationTooltip03">Project</label>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-8">
                                                            
                                                            <div id="div_project_select_combo">
                                                            <select class="form-control form-control-sm">
                                                                <option>--Select Project--</option>
                                                            </select>
                                                            </div>
                                                            <input type="hidden" class="form-control form-control-sm" id="txt_invoice_project_name"> 
                                                            <input type="hidden" class="form-control form-control-sm" id="txt_invoice_project_id"> 
                                                    </div>
                                                </div>
                                         </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Ref No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " id="txt_ref_no"> 
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
                                        
                                        
                                        <!-- <div class="form-group custom-font">-->
                                        <!--    <div class="row" >-->
                                        <!--        <div class="col-sm-12 col-md-6 col-lg-4">-->
                                        <!--                <label>Return No</label>-->
                                        <!--        </div>-->
                                        <!--        <div class="col-sm-12 col-md-6 col-lg-8">-->
                                        <!--                <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_return_no"> -->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_return_date"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                         
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Recieved By</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_recieved_by"> 
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
                                            <div class="col-md-4 mb-4 sm-12" style="">
                                                <label for="validationTooltip03">Description</label>
                                                 <textarea class="form-control" id="txt_return_description" placeholder="Description" required="" rows="1"> </textarea>
                                                <!--<input type="text" class="form-control" id="txt_local_po_description" placeholder="Description" required="">-->
                                                 <input type="hidden" class="form-control" id="txt_local_po_child_id" placeholder="Description" required="">
                                               
                                            </div>
                                            <div class="col-md-3 mb-3 sm-12" style="">
                        						<label for="validationTooltip03">Category</label>
                        						  <div id="div_category_load_pur_recie">
                        						  
                        						  
                        						  </div>
                        					</div>
                        					<div class="col-md-3 mb-3 sm-12" style="">
                        					    
                        						<label for="validationTooltip03">Item</label>
                        						  <div id="div_item_load_pur_recie">
                        						 
                        						  <select class="form-control form-control-sm" id=""></select>
                        						  </div>
                        					</div>
                                            <div class="col-md-1 mb-1 sm-12" style="">
                                                <label for="validationTooltip04">Qty</label>
                                                <input type="text" class="form-control" id="txt_return_quantity" placeholder="Qty" required="">
                                              
                                            </div>
                                        </div>
                                        <div class="row " >
                                            <div class="col-md-2 mb-2 sm-12" style="">
                                               <label>Unit</label><br>
											    <select class="form-control form-control-sm" id="select_unit">
												<option value="0">Select Unit</option>
												<?php while($row = mysqli_fetch_assoc($fetch_unit)) { ?>
												<option value="<?php echo $row['unit_id']; ?>"><?php echo $row['unit_name']; ?></option>
												<?php } ?>
											</select>
                                                
                                            </div>
                                            <div class="col-md-2 mb-2 sm-12" style="padding-left:5px;padding-right:5px;">
                                                <label for="validationTooltip05">Rate (BD)</label>
                                                <input type="text" class="form-control" id="txt_return_rate" style="text-align:right;" placeholder="0.000" required="">
                                               
                                            </div>
                                            <div class="col-md-2 mb-2 sm-12" style="padding-left:5px;padding-right:5px;">
                                                <label for="validationTooltip05">Amount (BD)</label>
                                                <input type="text" class="form-control" id="txt_return_amount" style="text-align:right;" placeholder="0.000" disabled>
                                               
                                            </div>
                                             <div class="col-md-1 mb-1 sm-12" style="padding-left:5px;padding-right:5px;">
                                                <label for="validationTooltip05">Tax%</label>
                                                <input type="text" class="form-control" id="txt_tax_percentage" style="text-align:right;" placeholder="0.000" required="">
                                               
                                            </div>
                                            <div class="col-md-1 mb-1 sm-12" style="padding-top:30px">
                                                <button type="button" class="mb-2 btn btn-primary" id="btn_store">ADD</button>
                                                <!--<button type="button" class="mb-2 btn btn-warning" style="color:white" id="btn_local_po_edit">SAVE</button>-->
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
         <div class="container mt-12 main-container">
            <div class="row ">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            
                              
                            
                            <table id="tbl_store_return_list" class="display stripe cell-border table table-striped table-bordered dataTable" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                       <th>SI</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th style="display:none;">Category ID</th>
                                        <th>Item</th>
                                         <th style="display:none;">Item ID</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Tax(%) </th>
                                        <th>Delete</th>
                                       
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
                                    </tr>
                                </tfoot>
                               
                            </table>
                        </div>  
                        <div class="card-footer">
                            <div class="row ">
                                <!--<div class="col-sm-12 col-md-6 col-lg-2">-->
                                <!--    <button class="btn btn-info" id="btn_local_po_print"><i class="material-icons">print</i> Print</button>-->
                                <!--</div>-->
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-info" id="btn_local_po_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-3">
                                    <!--<button class="btn btn-secondary" id="btn_local_po_print_without_head"><i class="material-icons">print</i> Print Without Head</button>-->
                                </div>
                                
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <!--<button class="btn btn-dark" id="btn_local_po_print_with_head"><i class="material-icons">print</i> Print With Head</button>-->
                                </div>
								
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_return"> <i class="material-icons">list</i>  Generate Return</button>
                                    <!--<button class="btn btn-warning text-white" id="btn_edit_return"> <i class="material-icons">edit</i>  Update Return</button>-->
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
      
    
</div> 


<!--****************list of store return****************************************-->
<div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;padding-top:70px;box-shadow: -10px 0px 10px #e3e3e3;">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Store Return</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:right">
                                         <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body " >
                             <div class="row ">
                                    <div class="col-sm-12 col-md-5 col-lg-5">
                                        <label for="validationTooltip05">Start Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_start_date">
                                    </div>
                                    <div class="col-sm-12 col-md-5 col-lg-5" style="text-align:right">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_end_date">
                                    </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_search_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                  
                                </div>
                        
                        <!--Table-->
                            <table class="table no-footer table-striped table-bordered dataTable" id="list_of_store_return" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr >
                                        <th>ID </th>
                                        <th>Date </th>
                                        <th>Company </th>
                                        <th>Item Name </th>
                                        <th>project </th>
                                        <th>View </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                         
                        </div>
                      
                    </div>
                </div>

   
</div>


