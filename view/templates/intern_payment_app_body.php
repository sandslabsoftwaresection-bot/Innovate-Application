<?php

	include('../model/db_connection/connection.php');

	$DBConn1 = new DBConnection();
	$varDBConnection1 = $DBConn1->ConnectToMYSQL();
	$fetch_amnt_type = mysqli_query($varDBConnection1, "SELECT * FROM amount_type_tbl");
	

?>
<!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Interim Payment Application</h5>
                            <p class="mb-0  text-white">Interim Payment Application #: <inno id="invoice_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                        <!--<div class="dropdown d-inline-block">-->
                        <!--    <button  onclick="openNavR()" id="btn_view_list_of_invoice" class="btn btn-sm btn-outline-light">List of Invoices</button>-->
                            <!--<a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--    <i class="material-icons ">more_vertical</i>-->
                            <!--</a>-->
                            
                        <!--</div>-->
                        <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Interim Payment Application List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_invoice" data-style="expand-right"><span class="ladda-label">List of Interim Payment</span><span class="ladda-spinner"></span></a>
                                <a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_invoice">Cancelled Interim Payment</a>
                                
                            </div>
                        </div>
                        
                        
                    
                        
                           <!--<div class="dropdown-menu dropdown-menu-right">-->
                           <!--     <a href="" class="dropdown-item">New</a>-->
                           <!--     <button  class="dropdown-item" onclick="openNavR()" id="btn_view_list_of_invoice">List of Invoices</button>-->
                           <!--     <button  class="dropdown-item" onclick="openNavR()" id="btn_view_list_of_invoice">Cancel Invoices</button>-->
                           <!-- </div>-->
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
                                                        <label>PO Box</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_invoice_po_box" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Telephone</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_invoice_contact_no" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Fax</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_invoice_fax" readonly> 
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="input-group input-group-sm mb-12" style="padding-top:10px;">-->
                                        <!--    <div class="input-group-prepend">-->
                                        <!--        <span class="input-group-text" id="inputGroup-sizing-sm">Manama, Kingdom of Bahrain </span>-->
                                        <!--    </div>-->
                                            
                                        <!--</div>-->
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Attn</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_invoice_attn" readonly> 
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
                                                        <label>Interim No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="hidden" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_invoice_no"> 
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_interim_real_no"> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_invoice_date"> 
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
                                                                    <label>Quotation Ref From</label>
                                                            </div>  
                                                             <div class="col-sm-6 col-md-6 col-lg-4">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" name="option" class="custom-control-input" id="customradio1" value="1" checked="">
                                                                    <label class="custom-control-label" for="customradio1">Quotation</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-4">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" name="option" class="custom-control-input" id="customradio2" value="2" checked="">
                                                                    <label class="custom-control-label" for="customradio2">Delivery Note</label>
                                                                </div>
                                                            </div>
                                                 </div>      
                                        
                                               
                                         </div>
                                      <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Quotation Ref</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8" id="div_select_quotation_combo">
                                                     <select class="form-control form-control-sm">
                                                        <option>--Select Quotations--</option>
                                                     </select>
                                                   
                                                </div>
                                                
                                                  <input type="hidden" class="form-control form-control-sm" id="txt_invoice_quotation_ref">
                                                  <input type="hidden" class="form-control form-control-sm" id="txt_quotation_total_discount_amount">
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>LPO No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" id="txt_invoice_lpo_no"> 
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
        
      
        
         <div class="container mt-1 main-container" id="div_hide">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            
							
                              
                            
                           <table id="tbl_invoice_main_list" class="display stripe cell-border" style="width:100%;" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                        <th style="display:none;">Invoice ID</th>
                                        <th >Select</th>
                                        <th>Delivery Note No</th>
                                        <th>Date</th>
                                        <th>LPO</th>
                                        
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th style="display:none;"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        
                                       
                                    </tr>
                                </tfoot>
                               
                            </table>  
                        </div>
                      </div>
                </div>
            </div>
        </div>
          
                        
        
        
        
         <div class="container mt-1 main-container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            
                              
                         
                           
                           <div id="quotation_list_div" style="padding-bottom: 8px;">
                               
                                <table id="tbl_delivery_note_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:10px">
                                <thead>
									<tr>
									<th style="text-align: center;" colspan="6">Approved Quotation QN:</th>
									<th style="text-align: center;" colspan="2">Gross Value Of Work</th>
									<th style="text-align: center;" colspan="2">Up to Last Period</th>
									<th style="text-align: center;" colspan="2">This Period</th>
									<th style="text-align: center;" colspan="1"></th>
									</tr>
                                    <tr>
                                        <th style="text-align: center;">SI</th>
                                        <th style="text-align: center;">Description</th>
                                        <th style="text-align: center;">Qty</th>
                                        <th style="text-align: center;">Unit</th>
										<th style="text-align: center;">Rate</th>
                                        <th style="text-align: center;">Amount</th>
                                        <th style="text-align: center;">Executed Work</th>
                                        <th style="text-align: center;">Amount</th>
                                        <th style="text-align: center;">Executed Work</th>
                                        <th style="text-align: center;">Amount</th>
                                        <th style="text-align: center;">Executed Work</th>
										<th style="text-align: center;">Net Amount</th>
                                        <th style="text-align: center;">Edit</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th></th>
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th ></th>
                                        <th ></th>
                                        <th ></th>
                                        
                                        
                                       
                                    </tr>
                                </tfoot>
                               
                            </table>
							  <div class="row">
                               <div class="col-sm-12 col-md-2 col-lg-2 custom-font" >
                                       <!-- <label style="font-weight: bold;">Contract Value <span id="lbl_contract_value"></span></label>-->
                                        <div class="card mb-4">
                                            <div class="card-footer bg-light-secondary border-top">
                                                <div class="media">
                                                   
                                                    <div class="media-body">
                                                        <h5 class="content-color-primary mb-0" id="lbl_contract_value"></h5>
                                                        <p class="content-color-secondary mb-0 small">Contract Value </p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--<input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_contract_value" disabled placeholder="0.000">   -->
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 custom-font" >
                                        <!--<label style="font-weight: bold;">Discount<span id="lbl_discount"></span></label>-->
                                         <div class="card mb-4">
                                            <div class="card-footer bg-light-secondary border-top">
                                                <div class="media">
                                                   
                                                    <div class="media-body">
                                                        <h5 class="content-color-primary mb-0" id="lbl_discount"></h5>
                                                        <p class="content-color-secondary mb-0 small">Discount<span id="lbl_discount_perc"></p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2 custom-font" >
                                        <!--<label style="font-weight: bold;">Net Amount (Ex-VAT) <span id="lbl_net_amount_exvat"></span></label>-->
                                        <div class="card mb-4">
                                            <div class="card-footer bg-light-secondary border-top">
                                                <div class="media">
                                                   
                                                    <div class="media-body">
                                                        <h5 class="content-color-primary mb-0" id="lbl_net_amount_exvat"></h5>
                                                        <p class="content-color-secondary mb-0 small">Net Amount (Ex-VAT) </p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 custom-font" >
                                        <!--<label style="font-weight: bold;">VAT<span id="lbl_vat_perc"></span><span id="lbl_vat_amt"></span></label>-->
                                        <div class="card mb-4">
                                            <div class="card-footer bg-light-secondary border-top">
                                                <div class="media">
                                                   
                                                    <div class="media-body">
                                                        <h5 class="content-color-primary mb-0" id="lbl_vat_amt"></h5>
                                                        <p class="content-color-secondary mb-0 small">VAT<span id="lbl_vat_perc"></span></p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2 custom-font" >
                                       <!-- <label style="font-weight: bold;">Gross Amount BD <span id="lbl_gross_amt_bd"></span></label>-->
                                        <div class="card mb-4">
                                            <div class="card-footer bg-light-secondary border-top">
                                                <div class="media">
                                                   
                                                    <div class="media-body">
                                                        <h5 class="content-color-primary mb-0" id="lbl_gross_amt_bd"></h5>
                                                        <p class="content-color-secondary mb-0 small">Gross Amount BD</p>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2 custom-font"  style="padding-top:13px;">
                                      <button type="button" class="btn btn-lg success-gradient mr-2"  id="update_all_invoice_list" name="update_all_invoice_list" style="float: right; width: 100px;"><i class="material-icons ">save</i></button>
                        
                                        </div>
                               
                            </div>
                           
                           </div>
                           
                           
                           
                            <div id="delivery_note_tbl_div">
                              
                            <table id="tbl_invoice_list" class="display stripe cell-border" style="width:100%;" style="padding-top:5px;font-size:10px">
                                <thead>
                                    <tr>
                                        <!--<th style="display:none;">Invoice ID</th>-->
                                        <!--<th style="display:none;">Invoice No</th>-->
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th style="display:none;">Amount</th>
                                        <th style="display:none;">Dis(%) </th>
                                        <th style="display:none;">Discount Amt</th>
                                        <th style="display:none;">Tax(%) </th>
                                        <th>Net Total</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <!--<th style="display:none;"></th>-->
                                        <!--<th style="display:none;"></th>-->
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th style="display:none;"></th>
                                        <th style="display:none;"></th>
                                        <th>Sub Total</th>
                                        <th></th>
                                       
                                    </tr>
                                </tfoot>
                               
                            </table>
                          </div>
                           
                           <div class="row">
                               <!-- <div class="col-sm-12 col-md-6 col-lg-2 custom-font"> -->
                                        <!--<label>Dis Type</label>-->
                                        <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" placeholder="%" id="txt_invoice_discount_type" disabled> 
                                         <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right"  id="txt_hidden_discount_type" placeholder="0.000"> 
                                        <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right"  id="txt_hidden_discount_amount" placeholder="0.000">
                                <!--</div>-->
                              
                                <!--<div class="col-sm-12 col-md-6 col-lg-2 custom-font">-->
                                        <!--<label>Total Dis Amount</label>-->
                                        <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" placeholder="0.000" id="txt_invoice_discount_amount" disabled> 
                                         <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" disabled id="txt_tax_content" placeholder="0.000"> 
                                        
                                <!--</div>-->
                                 
                                <!--<div class="col-sm-12 col-md-6 col-lg-2 custom-font">-->
                                <!--        <label>Total Amount</label>-->
                                <!--        <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" disabled id="txt_invoice_total_amount" placeholder="0.000"> -->
                                <!--</div>-->
                                
                               
                                <div class="col-sm-12 col-md-6 col-lg-2 custom-font" style="display:none">
                                        <label id="">Discount Amount </label>
                                         <div class="input-group mb-1" id="" disabled>
                                                            <div class="input-group-prepend" id="div_discount_amount_type" disabled>
                                                                <select >
                                                                    <option>%</option>
                                                                    <option>BD</option>
                                                                </select>
                                                            </div>
                                        <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_discount_amount_qt" disabled placeholder="0.000"> 
                                        <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_discount_amount_qt_hidden" disabled placeholder="0.000"> 
                                
                                           
                                        </div>
                                       
                                </div> 
                                 
                               
                                 
                                 
                                 
                                <div class="col-sm-12 col-md-6 col-lg-3 custom-font" style="display:none;">
									<label>Amount Type</label>
									<select class="form-control form-control-sm" id="select_amount_type">
										
										<?php while($row = mysqli_fetch_assoc($fetch_amnt_type)) { ?>
											<option value="<?php echo $row['type_id']; ?>"><?php echo $row['type_name']; ?></option>
										<?php } ?>
									 </select>
                                </div>  
                                
                                
                                
                                <div class="col-sm-12 col-md-6 col-lg-3 custom-font">
                                        <label id="lbl_received">Less Advance Received Amount </label>
                                         <div class="input-group mb-1" id="div_discount">
                                                            <div class="input-group-prepend" id="div_received_amount_type">
                                                                <!--<span class="input-group-text form-control-sm" id="basic-addon3">BD</span>-->
                                                                <select >
                                                                    
                                                                    <option>%</option>
                                                                    <option>BD</option>
                                                                </select>
                                                            </div>
                                        <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_invoice_received_amount" placeholder="0.000"> 
                                        <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_invoice_balance_due" disabled placeholder="0.000"> 
                                
                                           
                                        </div>
                                       
                                </div>
                               
                                            
                                 <div class="col-sm-12 col-md-6 col-lg-3 custom-font"  >
                                        <label>Less Retention Amount  </label>
                                        <div class="input-group mb-1" id="div_discount">
                                                            <div class="input-group-prepend" id="div_retention_amount_type">
                                                                <!--<span class="input-group-text form-control-sm" id="basic-addon3">BD</span>-->
                                                                <select >
                                                                    
                                                                    <option>%</option>
                                                                    <option>BD</option>
                                                                </select>
                                                            </div>
                                                            
                                                    <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_invoice_retention_percentage" placeholder="0.000"> 
                                                    <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_invoice_retention_amount" disabled placeholder="0.000"> 
                                        </div>
                                </div>
                                
                                
                                <div class="col-sm-12 col-md-6 col-lg-2 custom-font" style="display:none">
                                        <label>Previous Bill Amount</label>
                                        <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_invoice_previous_bill_amount" disabled placeholder="0.000"> 
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-2 custom-font" style="display:none">
                                        <label>Balance in Due </label>
                                        <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_invoice_net_balance_due" disabled placeholder="0.000"> 
                                </div>
                                
                                
                                <!-- <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                                <!--        <label>Received Amount </label>-->
                                <!--        <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_invoice_balance_due" disabled placeholder="0.000"> -->
                                <!--</div>-->
                            </div>
                           <!--  <div class="row" style="padding-top:10px;">-->
                           <!--     <div class="col-sm-12 col-md-6 col-lg-3 custom-font"  >-->
                           <!--             <label>Retention %  </label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_invoice_retention_percentage" placeholder="0.000"> -->
                           <!--     </div>-->
                           <!--      <div class="col-sm-12 col-md-6 col-lg-3 custom-font" >-->
                           <!--             <label>Retention Amount </label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_invoice_retention_amount" disabled placeholder="0.000"> -->
                           <!--     </div>-->
                           <!--      <div class="col-sm-12 col-md-6 col-lg-3 custom-font" >-->
                           <!--             <label>Previous Bill Amount</label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_invoice_previous_bill_amount" placeholder="0.000"> -->
                           <!--     </div>-->
                                
                           <!--      <div class="col-sm-12 col-md-6 col-lg-3 custom-font">-->
                           <!--             <label>Balance in Due </label>-->
                           <!--             <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_invoice_net_balance_due" disabled placeholder="0.000"> -->
                           <!--     </div>-->
                                
                                
                                        
                           <!--</div> -->
			<!--*************table invoice details*************-->			<div class="container mt-1 main-container" id="div_invoice_details">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            
							
                              
                            
                           <table id="tbl_invoice_details_list" class="display stripe cell-border" style="width:60%;" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid #dddddd; width:45%">Gross Value of Work BD</th>
                                        <th id="table_gross_value" style="border: 1px solid #dddddd; text-align: right;"></th>
                                    </tr>
									<tr>
                                        <th style="border: 1px solid #dddddd; width:45%">Less Previous Bill received BD</th>
                                        <th id="table_previous_bill" style="border: 1px solid #dddddd; text-align: right;"></th>
                                    </tr>
                                    
									<tr>
                                        <th style="border: 1px solid #dddddd; width:45%">Gross Amount Due to Date BD</th>
                                        <th id="table_gross_amount_due" style="border: 1px solid #dddddd; text-align: right;"></th>
                                    </tr>
                                    <!--<tr>-->
                                    <!--    <th style="border: 1px solid #dddddd; width:45%">Discount(<span id="disc_prc"></span>%)</th>-->
                                    <!--    <th id="disc_prc_amt" style="border: 1px solid #dddddd; text-align: right;"></th>-->
                                    <!--</tr>-->
									<tr>
                                        <th style="border: 1px solid #dddddd; width:45%">Less Retention %</th>
                                        <th id="table_less_retention" style="border: 1px solid #dddddd; text-align: right;"></th>
                                    </tr>
									<tr>
                                        <th style="border: 1px solid #dddddd; width:45%">Less Advance Received %</th>
                                        <th id="table_less_advance_rec" style="border: 1px solid #dddddd; text-align: right;"></th>
                                    </tr>
									<tr>
                                        <th style="border: 1px solid #dddddd; width:45%">Net Amount Due (Ex-VAT)</th>
                                        <th id="table_net_amount_due" style="border: 1px solid #dddddd; text-align: right;"></th>
                                    </tr>
									<tr>
                                        <th style="border: 1px solid #dddddd; width:45%">Value Add Tax (VAT <span id="table_vat_perc"></span>)</th>
                                        <th id="table_tax_value" style="border: 1px solid #dddddd; text-align: right;"></th>
                                    </tr>
									<tr>
                                        <th style="border: 1px solid #dddddd; width:45%">Total amount Due BD </th>
                                        <th id="table_total_amount" style="border: 1px solid #dddddd; text-align: right;"></th>
                                    </tr>
									<tr>
                                        <th colspan="2" style="border: 1px solid #dddddd; width:45%; text-align: center;">Bahrain Dinars:  <span id="table_bahrain_dinars"></span></th>
                                        <!--<th colspan="2" id="table_bahrain_dinars" style="border: 1px solid #dddddd;"></th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                               
                            </table>  
                        </div>
                      </div>
                </div>
            </div>
        </div>   
						   
						   
				<!--*****************************************-->		   
						   
                            <div class="row">
                               
                                
                            </div>
                           
                           
                                <div class="row">
                              
                                <div class="col-sm-12 col-md-6 col-lg-12 custom-font">
                                        <label>Description</label>
                                        
                                 <textarea class="form-control custom-font"  rows="3" id="txt_invoice_all_description"><figure class="table"><table><tbody><tr><td>For Sapphire Industries W.L.L &nbsp; &nbsp;</td><td>&nbsp;</td><td>Received By</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>Name :</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Signature _____________________&nbsp;</td><td>&nbsp;</td><td>&nbsp;Signature _____________________</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;All the materials checked and confirmed<br><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Thank you for your business !</strong></td></tr></tbody></table></figure></textarea>
                                
                                
                                        
                           </div> 
                           
                         <!--  <div class="row">
                              
                                <div class="col-sm-12 col-md-6 col-lg-12">
                                        <label>Description</label>
                                        <textarea class="form-control"   id="txt_invoice_all_description"><p>For BusinessDeck &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Received By</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Signature_____________________</p><p><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Name ________________________</p><p>Signature______________________ &nbsp; &nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; All the materials checked and confirmed<br><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Thank you for your business !</strong></p><</textarea>
                                </div>
                                 
                               
                                
                                
                                        
                           </div> -->
                           
                           
                           
                            
                        </div>
                        
                        
                        
                        
                        <div class="card-footer">
                            <div class="row">
                                 <!--<div class="col-sm-12 col-md-2 col-lg-2">
                                   <button class="btn btn-info" id="btn_invoice_print"><i class="material-icons">print</i>VAT Print</button>
                                </div>-->
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_invoice_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_invoice_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                </div>
								<!--<div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-info" id="btn_invoice_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>
                                </div>-->
                               <!-- <div class="col-sm-12 col-md-2 col-lg-2" style="text-align:right">
									<button class="btn btn-primary" id="btn_intern_payment_application"> <i class="material-icons">list</i>Intern Payment Application</button>
								</div>-->
								<div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
									<button class="btn btn-primary" id="btn_intern_payment_application"> <i class="material-icons">list</i>Interim Payment Application</button>
                                   <!-- <button class="btn btn-primary" id="btn_generate_invoice"> <i class="material-icons">list</i> Tax Generate Invoice</button>
                                     <button class="btn btn-warning text-white" id="btn_edit_invoice"> <i class="material-icons">edit</i>  Update Invoice</button>-->
									 
                                </div>
								
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
       
        
        
<!-- content page ends -->
        
<div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;padding-top:70px;box-shadow: -10px 0px 10px #e3e3e3;">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Interim</h5>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6" style="text-align:right">
                                         <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body " >
                             <div class="row ">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <label for="validationTooltip05">Start Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_start_date">
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_end_date">
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label for="validationTooltip05">Company Name</label>
                                        <div id="div_company_select_forview">
                                                    <select class="form-control form-control-lg" style="width:100%">
                                                        <option>--Select Company--</option>
                                                    </select>
                                        </div>
                                       </div>
                                    <div class="col-sm-12 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_search_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                  
                                </div>
                        
                        <!--Table-->
                            <table class="table no-footer table-striped table-bordered dataTable" id="list_of_invoices" class="custom-font" style="padding-top:5px;font-size:12px;width:100%;">
                                <thead>
                                    <tr >
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Interim No </th>
                                        <th>Company </th>
                                        <th>Contract Value </th>
                                        <th>Amount</th>
                                        <th>View </th>
                                        <!--<th>Delete </th>-->
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






<!-- content page ends -->
        
<div id="mySidenavRCancel" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Cancel Interim</h5>
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
                            <table class="table responsive" id="list_of_cancel_invoices" class="custom-font" style="padding-top:5px;font-size:12px;width:100%;">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Interim No </th>
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


    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_quantity_change">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				   <div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<label>Description </label>
							<textarea class="form-control" placeholder="" id="txt_reissue_desc" rows="4" ></textarea>
						</div>
				   
				   </div>
				   <div class="row">
					   <div class="col-sm-12 col-md-6 col-lg-4">
							 <input type="hidden" class="form-control" placeholder="" id="txt_quotation_child_id" >
							 <input type="hidden" class="form-control" placeholder="" id="txt_quotation_quantity" >
							 <label style="display: none;">Rate</label>
							 <input type="hidden" class="form-control" placeholder="" id="txt_quotation_rate" >
							 <input type="hidden" class="form-control" placeholder="" id="txt_quotation_discount_precentag" >
							 <input type="hidden" class="form-control" placeholder="" id="txt_quotation_vat_percentage" >
							 <input type="hidden" class="form-control" placeholder="" id="txt_quotation_discount_type" >
							<label style="display: none;">Quantity </label>
							<input type="hidden" class="form-control" placeholder="" id="txt_reissue_qty" >
						</div>
					 </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
					<button type="button" class="btn btn-primary" id="btn_reissue_qnty">Save</button>
				</div>
			</div>
		</div>
    </div>