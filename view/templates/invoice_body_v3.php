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
                            <h5 class="time-title mb-0  text-white">New Invoice</h5>
                        </div>
                        <!--<div class="dropdown d-inline-block">-->
                        <!--    <button  onclick="openNavR()" id="btn_view_list_of_invoice" class="btn btn-sm btn-outline-light">List of Invoices</button>-->
                            <!--<a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--    <i class="material-icons ">more_vertical</i>-->
                            <!--</a>-->
                            
                        <!--</div>-->
                        <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Invoice List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_invoice" data-style="expand-right"><span class="ladda-label">List of Invoices</span><span class="ladda-spinner"></span></a>
                                <a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_invoice">Cancelled Invoices</a>
                                
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
                                                        <label>Invoice No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_invoice_no"> 
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
                            
                              
                         
                           
                           <div id="quotation_list_div">
                               
                                <table id="tbl_delivery_note_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:10px">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th style="display:none;">Quotation ID</th>
                                        <th style="display:none;">Quotation No</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th style="display:none;">Amount</th>
                                        <th style="display:none;">Dis(%) </th>
                                        <th style="display:none;">Discount Amt</th>
                                        <th>Tax(%) </th>
                                        <th>Net Total</th>
                                        <th>Edit</th>
                                        <th style="display:none;">Delete</th>
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
                                        <th style="display:none;></th>
                                        <th style="display:none;"></th>
                                        <th style="display:none;"></th>
                                        <th></th>
                                        <th>Sub Total</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                               
                            </table>
                            
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
                               <!--<div class="col-sm-12 col-md-6 col-lg-2 custom-font">-->
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
                                
                                <div class="col-sm-12 col-md-6 col-lg-3 custom-font" style="display:none;"> 
									<label>Amount Type</label>
									<select class="form-control form-control-sm" id="select_amount_type">
										
										<?php //while($row = mysqli_fetch_assoc($fetch_amnt_type)) { ?>
											<option value="<?php //echo $row['type_id']; ?>"><?php //echo $row['type_name']; ?></option>
										<?php } ?>
									 </select>
                                </div>  
                                <div class="col-sm-12 col-md-6 col-lg-2 custom-font">
                                        <label id="lbl_received">Received Amount </label>
                                        <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_invoice_received_amount" placeholder="0.000"> 
                                        <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_invoice_balance_due" disabled placeholder="0.000"> 
                                
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-2 custom-font"  >
                                        <label>Retention %  </label>
                                        <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_invoice_retention_percentage" placeholder="0.000"> 
                                        <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right; " id="txt_invoice_retention_amount" disabled placeholder="0.000"> 
                               
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2 custom-font" >
                                        <label>Previous Bill Amount</label>
                                        <input type="text" class="form-control form-control-sm" style="text-align:right;" id="txt_invoice_previous_bill_amount" placeholder="0.000"> 
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-2 custom-font">
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
                            <div class="row">
                               
                                
                            </div>
                           
                           
                                <div class="row">
                              
                                <div class="col-sm-12 col-md-6 col-lg-12 custom-font">
                                        <label>Description</label>
                                        
                                 <textarea class="form-control custom-font"  rows="3" id="txt_invoice_all_description"><p>For Sapphire Industries W.L.L  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Received By</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Signature_____________________</p><p><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Name ________________________</p><p>Signature ______________________ &nbsp; &nbsp;</p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; All the materials checked and confirmed<br><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Thank you for your business !</strong></p></textarea>
                                </div>
                                 
                               
                                
                                
                                        
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
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <!--<button class="btn btn-info" id="btn_invoice_print"><i class="material-icons">print</i>VAT Print</button>-->
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_invoice_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_invoice_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_invoice"> <i class="material-icons">list</i>  Generate Invoice</button>
                                     <button class="btn btn-warning text-white" id="btn_edit_invoice"> <i class="material-icons">edit</i>  Update Invoice</button>
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
                                        <h5 class="mb-0">List of Invoices</h5>
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
                            <table class="table no-footer table-striped table-bordered dataTable" id="list_of_invoices" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr >
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Invoice No </th>
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






<!-- content page ends -->
        
<div id="mySidenavRCancel" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Cancel Invoices</h5>
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
                            <table class="table responsive" id="list_of_cancel_invoices" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Invoice No </th>
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
                       
                           
                           <div class="row ">
                                    <!--<div class="col-sm-6 col-md-6 col-lg-4" disabled>-->
                                    <!--     <label>Required </label>-->
                                    <!--    <div id="req_qty"></div>-->
                                        
                                        
                                    <!--</div>-->
                                  
                                    
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label>Description </label>
                                        <textarea class="form-control" placeholder="" id="txt_reissue_desc" rows="4" ></textarea>
                                    </div>
                           
                           </div>
                            <div class="row ">
                               <div class="col-sm-12 col-md-6 col-lg-4">
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_child_id" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_quantity" >
										 <label>Rate</label>
                                         <input type="text" class="form-control" placeholder="" id="txt_quotation_rate" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_discount_precentag" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_vat_percentage" >
                                         <input type="hidden" class="form-control" placeholder="" id="txt_quotation_discount_type" >
                                        <label>Quantity </label>
                                        <input type="text" class="form-control" placeholder="" id="txt_reissue_qty" >
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