<?php

	include('../model/db_connection/connection.php');

	$DBConn1 = new DBConnection();
	$varDBConnection1 = $DBConn1->ConnectToMYSQL();
	$fetch_unit2 = mysqli_query($varDBConnection1, "SELECT * FROM unit_master");

?>



<!-- content page -->
        <div class="container mt-12 main-container" >
            
            
            
            
            <div class="card mb-12">
               <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Local Purchase Order</h5>
                            <p class="mb-0  text-white">Local Purchase Order #: <inno id="local_po_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                        <div class="dropdown d-inline-block">
                             <!--<button  onclick="openNavR()" id="btn_view_list_of_local_po" class="btn btn-sm btn-outline-light">List Of LPO</button>-->
                            <!--<a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--    <i class="material-icons ">more_vertical</i>-->
                            <!--</a>-->
                             <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                LPO List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_local_po" data-style="expand-right"><span class="ladda-label">List of LPO</span><span class="ladda-spinner"></span></a>
                                <a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_LPO">Cancelled LPO</a>
                                
                            </div>
                        </div>
                        
                            <!--<div class="dropdown-menu dropdown-menu-right">-->
                            <!--    <a href="" class="dropdown-item">New</a>-->
                            <!--    <button  class="dropdown-item" onclick="openNavR()" id="btn_view_list_of_local_po">List of LPOs</button>-->
                                
                            <!--</div>-->
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
                                                        <label>Company Name</label>
                                                </div>
              <!--                                   <div class="col-sm-12 col-md-6 col-lg-8">-->
              <!--                                      <div id="div_supplier_select">-->
														<!--<select class="form-control form-control-sm">-->
														<!--	<option>--Select Supplier--</option>-->
														<!--</select>-->
              <!--                                      </div>-->
              <!--                                         <input type="hidden" class="form-control form-control-sm" id="txt_local_po_company_name"> -->
              <!--                                          <input type="hidden" class="form-control form-control-sm" id="txt_local_po_company_id"> -->
              <!--                                  </div>-->
                                                    <div class="col-sm-12 col-md-6 col-lg-8">
                                                    	<div class="input-group mb-3" style="vertical-align:middle;"> 
                                                    		<div id="div_supplier_select" style="width:80%">
                                                    			<select class="form-control form-control-sm">
                                                    				<option>--Select Supplier--</option>
                                                    			</select>
                                                    		</div>
                                                    		<div class="input-group-append">
                                                    			<button class="btn btn-primary" id="btn_add_supplier">Add</button>
                                                    		</div>
                                                    		<input type="hidden" class="form-control form-control-sm" id="txt_local_po_company_name"> 
                                                    		<input type="hidden" class="form-control form-control-sm" id="txt_local_po_company_id"> 
                                                    	</div>
                                                    </div>
                                              
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>PO Box</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_po_box" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Telephone</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_contact_no" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Fax</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_fax" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Ref</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_quotation_ref"> 
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="input-group input-group-sm mb-12" style="padding-top:10px;">-->
                                        <!--    <div class="input-group-prepend">-->
                                        <!--        <span class="input-group-text" id="inputGroup-sizing-sm">Manama, Kingdom of Bahrain </span>-->
                                        <!--    </div>-->
                                            
                                        <!--</div>-->
                                        <!--<div class="form-group custom-font">-->
                                        <!--    <div class="row" >-->
                                        <!--        <div class="col-sm-12 col-md-6 col-lg-4">-->
                                        <!--                <label>Attn</label>-->
                                        <!--        </div>-->
                                        <!--        <div class="col-sm-12 col-md-6 col-lg-8">-->
                                        <!--                <input type="text" class="form-control form-control-sm" id="txt_local_po_attn"> -->
                                        <!--        </div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                                            
                                        
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
                                                        <label>PO No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_local_po_no"> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_local_po_date"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                      
                                       
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Payment Terms</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_payment_terms"> 
                                                </div>
                                            </div>
                                        </div>
										
										<div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Requisition No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <select class="form-control form-control-sm" id="txt_purchase_reqsition_number">
                                                        <option value="0">--Select PRN NO--</option>
                                                    </select>
                                                </div>
             <!--                                   <div class="col-sm-12 col-md-6 col-lg-8">-->
													<!--<div id="div_prno_select">-->
													<!--	<select class="form-control form-control-sm">-->
													<!--		<option>--Select PRN NO--</option>-->
													<!--	</select>-->
													<!-- </div>	-->
             <!--                                        <input type="hidden" class="form-control" id="txt_purchase_reqsition_number" name="txt_purchase_reqsition_number" />													 -->
             <!--                                   </div>-->
                                            </div>
                                        </div>
                                        
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Work Order No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_job_no"> 
                                                </div>
             <!--                                   <div class="col-sm-12 col-md-6 col-lg-8">-->
													<!--<div id="div_job_num_select">-->
													<!--	<select class="form-control form-control-sm">-->
													<!--		<option>--Select Job NO--</option>-->
													<!--	</select>-->
													<!--</div>-->
             <!--                                   </div>-->
                                            </div>
                                        </div>
                                        
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Project Number</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_local_po_project_no"> 
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
        <div class="container mt-12 main-container" id="prn_items_container" style="display: none;">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            <h5>PRN Items</h5>
                        </div>
                        <div class="card-body" style="padding-top:5px;font-size:12px">
                            <table id="tbl_prn_items" class="display stripe cell-border" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Quotation ID</th>
                                        <th>Quotation No</th>
                                        <th>Description</th>
                                        <th>item_id</th>
                                        <th>cat_name</th>
                                        <th>cat_id</th>
                                        <th>item_code</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th></th>
                                        <th>Dis </th>
                                        <th>Discount Amt</th>
                                        <th>Tax(%) </th>
                                        <th>Net Total</th>
                                        <th>View</th>
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
         <div class="container mt-12 main-container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-body" id="div_add_item">
                            
        
                            <!-- Second row: Qty, Unit, Rate, Discount, Tax, Save buttons -->
                            <div class="row">
                                <div class="col-md-2 mb-1 sm-12" style="display:none;">
                                    <label for="validationTooltip04">Qty</label>
                                    <input type="text" class="form-control" id="txt_local_po_quantity" value="0.00" placeholder="Qty" required="">
                                </div>
        
                                <div class="col-md-2 mb-1 sm-12" style="display:none;">
                                    <label for="validationTooltip05">Unit</label>
                                    <input type="text" class="form-control" id="txt_local_po_unit" placeholder="Unit" disabled>
                                </div>
        
                                <div class="col-md-2 mb-1 sm-12">
                                    <label for="validationTooltip05">Rate (BD)</label>
                                    <input type="text" class="form-control" id="txt_local_po_rate" style="text-align:right;" value="0.00" placeholder="0.000" required="">
                                </div>
        
                                <div class="col-md-3 mb-1 sm-12" style="display:none;">
                                    <label for="validationTooltip05">Discount</label>
                                    <div class="input-group mb-1" id="div_product_discount">
                                        <div class="input-group-prepend" id="div_product_discount_type">
                                            <select id="sel_dis_type">
                                                <option>%</option>
                                                <option>BD</option>
                                            </select>
                                        </div>
                                        <input type="number" id="txt_product_discount" class="form-control" value="0" style="text-align:right;">
                                    </div>
                                </div>
        
                                <div class="col-md-2 mb-1 sm-12">
                                    <label for="validationTooltip05">Tax%</label>
                                    <input type="text" class="form-control" id="txt_tax_percentage" style="color:black;font-weight:700;text-align:right;" value="10.00" placeholder="10.000" required="">
                                </div>
        
                                <div class="col-md-1 mb-1 sm-12" style="padding-top:30px">
                                    <!-- Bottom buttons -->
                                    <button type="button" class="mb-2 btn btn-danger" id="btn_local_po_add">Save</button>
                                    <button type="button" class="mb-2 btn btn-warning" style="color:white" id="btn_local_po_edit">Update</button>
                                </div>
        
                                <!-- Hidden fields -->
                                <input type="hidden" class="form-control" id="txt_local_po_amount" placeholder="0.000" required="">
                                <input type="hidden" class="form-control" id="txt_amt_after_discount" placeholder="0.000" required="">
                                <input type="hidden" class="form-control" id="txt_net_amount" placeholder="0.000" required="">
                            </div>
                            
                            <div class="row" style="display:none;">
                                <!-- First row: Category, Subcategory, Description -->
                                <div class="col-md-3 mb-4 sm-12">
                                    <label for="validationTooltip03">Inventory Category</label>
                                    <div class="input-group mb-3"> 
                                        <div id="div_category_load_v1" style="width:100%">
                                            <select id="inventory_cat_v1" class="chosen_select form-control form-control-sm" data-live-search="true">
                                            </select>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-md-3 mb-4 sm-12">
                                    <label for="validationTooltip03">Inventory Sub Category</label>
                                    <div class="input-group mb-3"> 
                                        <div id="div_item_load_lpo" style="width:100%">
                                            <select id="inventory_sub_cat_v1" class="chosen_select form-control form-control-sm" data-live-search="true">
                                            </select>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-md-6 mb-4 sm-12">
                                    <label for="validationTooltip03">Description</label>
                                    <div class="input-group mb-3"> 
                                        <div id="div_item_load_lpo" style="width:77%">
                                            <select id="select_iventory_item" name="select_iventory_item" class="chosen_select form-control form-control-sm" data-live-search="true">
                                            </select>
                                        </div>
                                        <div class="input-group-append">
                                            <!-- Keep original Add button (blue) -->
                                            <button class="btn btn-primary" id="btn_add_item">Add</button>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="txt_local_po_description">
                                    <input type="hidden" class="form-control" id="txt_local_po_child_id" required="">
                                </div>
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
                            
                              
                            
                            <table id="tbl_local_po_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                       <th>SI</th>
                                        <th>Quotation ID</th>
                                        <th>Quotation No</th>
                                        <th>Description</th>
                                        <th>item_id</th>
                                        <th>cat_name</th>
                                        <th>cat_id</th>
                                        <th>item_code</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
										<th></th>
                                        <th>Dis </th>
                                        <th>Discount Amt</th>
                                        <th>Tax(%) </th>
                                        <th>Net Total</th>
                                        <th>Edit</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th></th>
                                        <th style="display:none;"></th>
                                        <th style="display:none;"></th>
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
                                        <th id="foot_sum"></th>
                                        
                                    </tr>
                                </tfoot>
                               
                            </table>
                            
                           <!--<div class="row">-->
                              
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Less Discount %</label>-->
                           <!--             <input type="text" class="form-control form-control-sm" id="txt_local_po_discount" placeholder="0.000"> -->
                           <!--     </div>-->
                                 
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Sub Total</label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" disabled id="txt_local_po_total_amount" placeholder="0.000"> -->
                           <!--     </div>-->
                                
                                  
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>VAT %  </label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_local_po_vat" placeholder="0.000"> -->
                           <!--     </div>-->
                               
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Net Amount BD </label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_local_po_balance_due" disabled placeholder="0.000"> -->
                           <!--     </div>-->
                                
                                
                                        
                           <!--</div> -->
                           
                            <div class="row">
                              
                                <div class="col-sm-12 col-md-6 col-lg-12 custom-font">
                                        <label>Description</label>
                                        
                                      <textarea class="form-control" id="txt_local_po_all_description">
                                         <p><strong>Remarks</strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___________________________________________________________________________</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___________________________________________________________________________</p><p>&nbsp;</p><p><strong>&nbsp;Prepared by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Checked by&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Approved by</strong></p><p><strong>Special Conditions:</strong></p><ul><li>Order acknowledgement is mandatory on receipt of this purchase order</li><li>All quantity to be supplied as per the specification and details provided</li><li>On receipt of this purchase order please advise promptly if you are unable to meet the specified delivery</li></ul> 
                                      </textarea>
                                        
                                        
                                </div>
                                
                           </div> 
                           
                         
                           
                           
                            
                        </div>
                        
                        
                        
                        
                        <div class="card-footer">
                            <div class="row ">
                                <!--<div class="col-sm-12 col-md-6 col-lg-2">-->
                                <!--    <button class="btn btn-info" id="btn_local_po_print"><i class="material-icons">print</i> Print</button>-->
                                <!--</div>-->
                                <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_local_po_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                </div>
                                
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_local_po_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                </div>
								<div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-info" id="btn_local_po_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_local_po"> <i class="material-icons">list</i>  Generate LPO</button>
                                    <button class="btn btn-warning text-white" id="btn_edit_local_po"> <i class="material-icons">edit</i>  Update LPO</button>
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
                                        <h5 class="mb-0">List of Local PO</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             <div class="row ">
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
                                  
                                </div>
                        
                        <!--Table-->
                            <table class="table " id="list_of_local_pos" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>LPO No </th>
                                        <th>PR No</th>
                                        <th>WorkOrder No </th>
                                        <th>Project No</th>
                                        <th>Company </th>
                                        <th>Amount</th>
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



<div id="mySidenavRCancel" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Cancel LPO</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRCancel()"><span class="material-icons icon-sm">close</span></button>
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
                           <table class="table " id="list_of_cancelled_local_pos" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>LPO No </th>
                                        <th>Company </th>
                                        <th>Amount</th>
                                        <th>View </th> 
                                        
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


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_item_add">
        <div class="modal-dialog modal-xl" role="document" style="max-width: 60%;">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add item</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row" style="padding:10px;">
							<div class="form-group custom-font">
                                            <div class="row" >
                                              
                                                <div class="col-sm-12 col-md-5 col-lg-5">
                                                   <label>Inventory Category</label><br>
                                                    <div class="input-group mb-3" style="vertical-align:middle;width:100%"> 
                                                    	<div id="div_category_load_pur_recie" style="width:75%;">
                                                    		  <select  id="select_iventory_category" name="select_iventory_category" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
                                                    		 </select>
                                                    	</div>
                                                    	<div class="input-group-append">
                                                    		<button class="btn btn-primary" id="btn_add_category">Add</button>
                                                    	</div>
                                                    </div>
                                                    <div class="input-group mb-3" style="vertical-align:middle;width:100%" id="cat_div"> 
                                                    	 <input type="text" class="form-control" id="txt_category">
                                                    	<div class="input-group-append">
                                                    		<button class="btn btn-warning" id="btn_save_cat">Add</button>
                                                    	</div>
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <div class="col-sm-12 col-md-5 col-lg-5">
                                                   <label>Inventory Sub Category</label><br>
                                                    <div class="input-group mb-3" style="vertical-align:middle;width:100%"> 
                                                    	<div id="" style="width:75%;">
                                                    		  <select  id="select_inventory_sub_category" name="select_inventory_sub_category" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
                                                    		 </select>
                                                    	</div>
                                                    	<div class="input-group-append">
                                                    		<button class="btn btn-primary" id="btn_add_sub_category">Add</button>
                                                    	</div>
                                                    </div>
                                                    <div class="input-group mb-3" style="vertical-align:middle;width:100%" id="sub_cat_div"> 
                                                    	 <input type="text" class="form-control" id="txt_sub_category">
                                                    	<div class="input-group-append">
                                                    		<button class="btn btn-warning" id="btn_save_sub_cat">Add</button>
                                                    	</div>
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <div class="col-sm-12 col-md-2 col-lg-2">
                                                    <label>Unit</label>
                                                    <select class="form-control form-control-sm" id="select_product_unit" style="width:100%;">
                                                        <option value="0">--Select Unit--</option>
														<?php while($row1 = mysqli_fetch_assoc($fetch_unit2)) { ?>
														<option value="<?php echo $row1['unit_id']; ?>"><?php echo $row1['unit_name']; ?></option>
														<?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-sm-12 col-md-5 col-lg-5">
                                                    <label>Inventory Item Name</label><br>
        												<textarea class="form-control" name="txt_item_name" id="txt_item_name" rows="1"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    	
                        </div>
                        <div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
        					<button type="button" class="btn btn-primary" id="btn_add_item_mod">Save</button>
        				</div>
                </div>
			
            </div>
        </div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_supplier_add">
        <div class="modal-dialog modal-xl" role="document" style="max-width: 50%;">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add New Suppliers</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row" style="padding:10px;">
        							 <div class="form-group row" style="width:100%;">
                                        <div class="col-lg-6 col-md-6">
                                            <label>Supplier Name <st style="color:red">*</st></label>
                                            <input type="hidden" id="txt_company_id" class="form-control" placeholder="">
                                            <input type="text" id="txt_company_name" class="form-control" placeholder="">
                                             <label>PO Box <st style="color:red">*</st></label>
                                            <input type="text" id="txt_contact_address_1" class="form-control" placeholder="">
                                             <label>Address <st style="color:red">*</st></label>
                                            <input type="text" id="txt_contact_address_2" class="form-control" placeholder="">
                                            <label>City <st style="color:red">*</st></label>
                                            <input type="text" id="txt_city_name" class="form-control" placeholder="">
                                            <label>Country <st style="color:red">*</st></label>
                                                    <select class="form-control " id="select_country_name" data-live-search="true" tabindex="-1" aria-hidden="true">
                                                       <option value="Afghanistan">Afghanistan</option>
                                                        <option value="Åland Islands">Åland Islands</option>
                                                        <option value="Albania">Albania</option>
                                                        <option value="Algeria">Algeria</option>
                                                        <option value="American Samoa">American Samoa</option>
                                                        <option value="Andorra">Andorra</option>
                                                        <option value="Angola">Angola</option>
                                                        <option value="Anguilla">Anguilla</option>
                                                        <option value="Antarctica">Antarctica</option>
                                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                        <option value="Argentina">Argentina</option>
                                                        <option value="Armenia">Armenia</option>
                                                        <option value="Aruba">Aruba</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Austria">Austria</option>
                                                        <option value="Azerbaijan">Azerbaijan</option>
                                                        <option value="Bahamas">Bahamas</option>
                                                        <option value="Kingdom of Bahrain" selected>Kingdom of Bahrain</option>
                                                        <option value="Bangladesh">Bangladesh</option>
                                                        <option value="Barbados">Barbados</option>
                                                        <option value="Belarus">Belarus</option>
                                                        <option value="Belgium">Belgium</option>
                                                        <option value="Belize">Belize</option>
                                                        <option value="Benin">Benin</option>
                                                        <option value="Bermuda">Bermuda</option>
                                                        <option value="Bhutan">Bhutan</option>
                                                        <option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
                                                        <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                        <option value="Botswana">Botswana</option>
                                                        <option value="Bouvet Island">Bouvet Island</option>
                                                        <option value="Brazil">Brazil</option>
                                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                        <option value="Bulgaria">Bulgaria</option>
                                                        <option value="Burkina Faso">Burkina Faso</option>
                                                        <option value="Burundi">Burundi</option>
                                                        <option value="Cambodia">Cambodia</option>
                                                        <option value="Cameroon">Cameroon</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="Cape Verde">Cape Verde</option>
                                                        <option value="Cayman Islands">Cayman Islands</option>
                                                        <option value="Central African Republic">Central African Republic</option>
                                                        <option value="Chad">Chad</option>
                                                        <option value="Chile">Chile</option>
                                                        <option value="China">China</option>
                                                        <option value="Christmas Island">Christmas Island</option>
                                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                        <option value="Colombia">Colombia</option>
                                                        <option value="Comoros">Comoros</option>
                                                        <option value="Congo">Congo</option>
                                                        <option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                                                        <option value="Cook Islands">Cook Islands</option>
                                                        <option value="Costa Rica">Costa Rica</option>
                                                        <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                                        <option value="Croatia">Croatia</option>
                                                        <option value="Cuba">Cuba</option>
                                                        <option value="Curaçao">Curaçao</option>
                                                        <option value="Cyprus">Cyprus</option>
                                                        <option value="Czech Republic">Czech Republic</option>
                                                        <option value="Denmark">Denmark</option>
                                                        <option value="Djibouti">Djibouti</option>
                                                        <option value="Dominica">Dominica</option>
                                                        <option value="Dominican Republic">Dominican Republic</option>
                                                        <option value="Ecuador">Ecuador</option>
                                                        <option value="Egypt">Egypt</option>
                                                        <option value="El Salvador">El Salvador</option>
                                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                        <option value="Eritrea">Eritrea</option>
                                                        <option value="Estonia">Estonia</option>
                                                        <option value="Ethiopia">Ethiopia</option>
                                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                        <option value="Faroe Islands">Faroe Islands</option>
                                                        <option value="Fiji">Fiji</option>
                                                        <option value="Finland">Finland</option>
                                                        <option value="France">France</option>
                                                        <option value="French Guiana">French Guiana</option>
                                                        <option value="French Polynesia">French Polynesia</option>
                                                        <option value="French Southern Territories">French Southern Territories</option>
                                                        <option value="Gabon">Gabon</option>
                                                        <option value="Gambia">Gambia</option>
                                                        <option value="Georgia">Georgia</option>
                                                        <option value="Germany">Germany</option>
                                                        <option value="Ghana">Ghana</option>
                                                        <option value="Gibraltar">Gibraltar</option>
                                                        <option value="Greece">Greece</option>
                                                        <option value="Greenland">Greenland</option>
                                                        <option value="Grenada">Grenada</option>
                                                        <option value="Guadeloupe">Guadeloupe</option>
                                                        <option value="Guam">Guam</option>
                                                        <option value="Guatemala">Guatemala</option>
                                                        <option value="Guernsey">Guernsey</option>
                                                        <option value="Guinea">Guinea</option>
                                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                        <option value="Guyana">Guyana</option>
                                                        <option value="Haiti">Haiti</option>
                                                        <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                        <option value="Honduras">Honduras</option>
                                                        <option value="Hong Kong">Hong Kong</option>
                                                        <option value="Hungary">Hungary</option>
                                                        <option value="Iceland">Iceland</option>
                                                        <option value="India">India</option>
                                                        <option value="Indonesia">Indonesia</option>
                                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                        <option value="Iran, Islamic Republic of">Iraq</option>
                                                        <option value="Ireland">Ireland</option>
                                                        <option value="Isle of Man">Isle of Man</option>
                                                        <option value="Israel">Israel</option>
                                                        <option value="Italy">Italy</option>
                                                        <option value="Jamaica">Jamaica</option>
                                                        <option value="Japan">Japan</option>
                                                        <option value="Jersey">Jersey</option>
                                                        <option value="Jordan">Jordan</option>
                                                        <option value="Kazakhstan">Kazakhstan</option>
                                                        <option value="Kenya">Kenya</option>
                                                        <option value="Kiribati">Kiribati</option>
                                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                                        <option value="Kuwait">Kuwait</option>
                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                        <option value="Latvia">Latvia</option>
                                                        <option value="Lebanon">Lebanon</option>
                                                        <option value="Lesotho">Lesotho</option>
                                                        <option value="Liberia">Liberia</option>
                                                        <option value="Libya">Libya</option>
                                                        <option value="Liechtenstein">Liechtenstein</option>
                                                        <option value="Lithuania">Lithuania</option>
                                                        <option value="Luxembourg">Luxembourg</option>
                                                        <option value="Macao">Macao</option>
                                                        <option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
                                                        <option value="Madagascar">Madagascar</option>
                                                        <option value="Malawi">Malawi</option>
                                                        <option value="Malaysia">Malaysia</option>
                                                        <option value="Maldives">Maldives</option>
                                                        <option value="Mali">Mali</option>
                                                        <option value="Malta">Malta</option>
                                                        <option value="Marshall Islands">Marshall Islands</option>
                                                        <option value="Martinique">Martinique</option>
                                                        <option value="Mauritania">Mauritania</option>
                                                        <option value="Mauritius">Mauritius</option>
                                                        <option value="Mayotte">Mayotte</option>
                                                        <option value="Mexico">Mexico</option>
                                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                        <option value="Monaco">Monaco</option>
                                                        <option value="Mongolia">Mongolia</option>
                                                        <option value="Montenegro">Montenegro</option>
                                                        <option value="Montserrat">Montserrat</option>
                                                        <option value="Morocco">Morocco</option>
                                                        <option value="Mozambique">Mozambique</option>
                                                        <option value="Myanmar">Myanmar</option>
                                                        <option value="Namibia">Namibia</option>
                                                        <option value="Nauru">Nauru</option>
                                                        <option value="Nepal">Nepal</option>
                                                        <option value="Netherlands">Netherlands</option>
                                                        <option value="New Caledonia">New Caledonia</option>
                                                        <option value="New Zealand">New Zealand</option>
                                                        <option value="Nicaragua">Nicaragua</option>
                                                        <option value="Niger">Niger</option>
                                                        <option value="Nigeria">Nigeria</option>
                                                        <option value="Niue">Niue</option>
                                                        <option value="Norfolk Island">Norfolk Island</option>
                                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                        <option value="Norway">Norway</option>
                                                        <option value="Oman">Oman</option>
                                                        <option value="Pakistan">Pakistan</option>
                                                        <option value="Palau">Palau</option>
                                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                        <option value="Panama">Panama</option>
                                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                                        <option value="Paraguay">Paraguay</option>
                                                        <option value="Peru">Peru</option>
                                                        <option value="Philippines">Philippines</option>
                                                        <option value="Pitcairn">Pitcairn</option>
                                                        <option value="Poland">Poland</option>
                                                        <option value="Portugal">Portugal</option>
                                                        <option value="Puerto Rico">Puerto Rico</option>
                                                        <option value="Qatar">Qatar</option>
                                                        <option value="Réunion">Réunion</option>
                                                        <option value="Romania">Romania</option>
                                                        <option value="Russian Federation">Russian Federation</option>
                                                        <option value="Rwanda">Rwanda</option>
                                                        <option value="Saint Barthélemy">Saint Barthélemy</option>
                                                        <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                        <option value="Saint Lucia">Saint Lucia</option>
                                                        <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                        <option value="Samoa">Samoa</option>
                                                        <option value="San Marino">San Marino</option>
                                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                                        <option value="Senegal">Senegal</option>
                                                        <option value="Serbia">Serbia</option>
                                                        <option value="Seychelles">Seychelles</option>
                                                        <option value="Sierra Leone">Sierra Leone</option>
                                                        <option value="Singapore">Singapore</option>
                                                        <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                                                        <option value="Slovakia">Slovakia</option>
                                                        <option value="Slovenia">Slovenia</option>
                                                        <option value="Solomon Islands">Solomon Islands</option>
                                                        <option value="Somalia">Somalia</option>
                                                        <option value="South Africa">South Africa</option>
                                                        <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                                        <option value="South Sudan">South Sudan</option>
                                                        <option value="Spain">Spain</option>
                                                        <option value="Sri Lanka">Sri Lanka</option>
                                                        <option value="Sudan">Sudan</option>
                                                        <option value="Suriname">Suriname</option>
                                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                        <option value="Swaziland">Swaziland</option>
                                                        <option value="Sweden">Sweden</option>
                                                        <option value="Switzerland">Switzerland</option>
                                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                        <option value="Tajikistan">Tajikistan</option>
                                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                        <option value="Thailand">Thailand</option>
                                                        <option value="Timor-Leste">Timor-Leste</option>
                                                        <option value="Togo">Togo</option>
                                                        <option value="Tokelau">Tokelau</option>
                                                        <option value="Tonga">Tonga</option>
                                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                        <option value="Tunisia">Tunisia</option>
                                                        <option value="Turkey">Turkey</option>
                                                        <option value="Turkmenistan">Turkmenistan</option>
                                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                        <option value="Tuvalu">Tuvalu</option>
                                                        <option value="Uganda">Uganda</option>
                                                        <option value="Ukraine">Ukraine</option>
                                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="United States">United States</option>
                                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                        <option value="Uruguay">Uruguay</option>
                                                        <option value="Uzbekistan">Uzbekistan</option>
                                                        <option value="Vanuatu">Vanuatu</option>
                                                        <option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
                                                        <option value="Viet Nam">Viet Nam</option>
                                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                        <option value="Western Sahara">Western Sahara</option>
                                                        <option value="Yemen">Yemen</option>
                                                        <option value="Zambia">Zambia</option>
                                                        <option value="Zimbabwe">Zimbabwe</option>
                                                    </select>
                                                    <label>VAT No <st style="color:red">*</st></label>
                                                    <input type="text" id="txt_company_description" class="form-control" placeholder="">
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label>Fax</label>
                                            <input type="text" id="txt_fax_number" class="form-control" placeholder="">
                                            <label>Attention <st style="color:red">*</st></label>
                                            <input type="text" id="txt_contact_person" class="form-control" placeholder="">
                                            <label>Email <st style="color:red">*</st></label>
                                            <input type="email" id="txt_contact_email" class="form-control" placeholder="" autocomplete="nope" readonly onfocus="this.removeAttribute('readonly');">
                                            <label>Phone Number <st style="color:red">*</st></label>
                                            <input type="text" id="txt_contact_phone" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    </div>
                                    	
                        </div>
                        <div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
        					<button type="button" class="btn btn-primary" id="btn_company_add">Save</button>
        				</div>
                </div>
			
            </div>
        </div>



