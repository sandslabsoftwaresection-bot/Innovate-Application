<?php

	include('../model/db_connection/connection.php');

	$DBConn1 = new DBConnection();
	$varDBConnection1 = $DBConn1->ConnectToMYSQL();
	$fetch_unit = mysqli_query($varDBConnection1, "SELECT * FROM unit_master");
	$fetch_unit2 = mysqli_query($varDBConnection1, "SELECT * FROM unit_master");

?>

<style>
.input-group-append .btn {
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
                            <h5 class="time-title mb-0  text-white">New Quotation</h5>
                            <p class="mb-0  text-white">Quotation #: <inno id="quotation_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                       
                        
                        <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Quotation List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_quotations" data-style="expand-right"><span class="ladda-label">List of Quotations</span><span class="ladda-spinner"></span></a>
                                <a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_quotation">Cancelled Quotations</a>
                                <a class="dropdown-item" href="#" onclick="openNavRCompany()" id="btn_view_list_of_company_quotation">Company Quotations</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0" style="padding-bottom:0px;">
                     
                   
                    <div class="row" style="padding-bottom:0px;">
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
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_quotation_company_name">
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_quotation_company_id"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>PO Box</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" readonly id="txt_quotation_po_box"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Telephone</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" readonly id="txt_quotation_contact_no"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Fax</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" readonly id="txt_quotation_fax"> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Attn</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <!--<input type="text" class="form-control form-control-sm" readonly id="txt_quotation_attn"> -->
                                                
                                                <div class="input-group mb-3" style="vertical-align:middle;"> 
                                                		<input type="text" class="form-control form-control-sm" readonly id="txt_quotation_attn"> 
                                                	<div class="input-group-append">
                                                		<button class="btn btn-primary" id="btn_add_attr">Update</button>
                                                	</div>
                                                </div>  
                                                
                                                
                                                
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
                                                        <label>Quotation No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_quotation_no"> 
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
                                                        <input type="hidden" class="form-control form-control-sm" id="txt_project"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Project Number</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black" disabled id="txt_project_no"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Tax Content</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black" disabled id="txt_tax_content"> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label for="validationTooltip03">Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_quotation_date"> 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                     
                                        
                                        
                                        
                                    </div>
                                   
                                </div>
                            </div>
                           
                    </div>
                </div>
                
            </div>
            
                                            
                                            
                                          <div class="row" style="padding-top:10px;padding-left:10px;padding-right:10px;">
                                               
                                                <div class="col-sm-12 col-md-5 col-lg-9">
                                                    <label for="validationTooltip03">Subject</label>
                                                        <input type="text" class="form-control form-control-sm" value=" "   id="txt_quotation_ref"  > 
                                                </div>
                                                <!-- <div class="col-sm-12 col-md-2 col-lg-2" style="" >-->
                                                <!--         <label for="validationTooltip03">Tax</label>-->
                                                <!--        <input type="text" class="form-control form-control-sm" id="txt_project_tax"> -->
                                                <!--</div>-->
                                                
                                                
                                      
                                                
                                                 
                                                <div class="col-sm-12 col-md-2 col-lg-3" style="" >
                                                         <label for="validationTooltip03">Introduction</label>
                                                          <div id="div_subject_combo">
                                                          <select class="form-control form-control-sm" id="subject_combo" name="subject_combo">
                                                            <option>--Select Subject--</option>
                                                        </select>
                                                        </div>
                                                         
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="row" style="padding-left:10px;padding-right:10px;padding-bottom:10px">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <label style="font-size:13px"> Selected Introduction </label>
                                                </div>
                                                
                                                <div class="col-sm-12 col-md-12 col-lg-12" style="" >
                                                        <!--<input type="text" class="form-control form-control-sm" id="txt_subject">-->
                                                        
                                                          <textarea class="form-control orm-control-sm" id="txt_subject" rows="1" > </textarea>
                                                        <!--<input type="text" class="form-control" id="txt_subject" placeholder="Introduction" required="">-->
                                                         
                                                        
                                                </div>
                                            </div>
                                            
                                            
            
        </div>
        

         <div class="container mt-1 main-container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body ">
                            
                            
                              
                        
                                        
                                        <div class="row " >
                                            <div class="col-md-4 mb-4" style="" >
                                                <label for="validationTooltip03">Product<span style="color:red">*</span></label>
                                                <!--<div id="div_product_combo">-->
                                                    <!--<select class="form-control" data-live-search="true" id="product_combo" placeholder="Description" required="">-->
                                                    
                                                    <!--</select>-->
                                                <!--</div>-->
                                                	<div class="input-group mb-3" style="vertical-align:middle;"> 
                                                		<div id="div_product_combo" style="width:80%;">
                                                			<!--<select class="form-control form-control-sm">-->
                                                			<!--	<option>--Select Allowance--</option>-->
                                                			<!--</select>-->
                                                		</div>
                                                		<div class="input-group-append">
                                                			<button class="btn btn-primary" id="btn_add_product">Add</button>
                                                		</div>
                                                	</div>
                                                <!--<textarea class="form-control" id="txt_quotation_description" placeholder="Description" required="" rows="1"> </textarea>-->
                                                 <input type="hidden" class="form-control " id="txt_quotation_child_id" placeholder="Description" required="">
                                               
                                            </div>
                                           <div class="col-md-2 mb-2" style="">
                                                <label for="validationTooltip04">Quantity<span style="color:red">*</span></label>
                                                <input type="number" min="0" class="form-control " id="txt_quotation_new_quantity" style="text-align:right;" placeholder="0.000"  required="">
                                              
                                            </div>
                                            <div class="col-md-2 mb-2" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Unit<span style="color:red">*</span></label>
                                                
												
												<select class="form-control" id="txt_quotation_new_unit">
                                                        <option value="0">--Select Unit--</option>
														<?php while($row = mysqli_fetch_assoc($fetch_unit)) { ?>
														<option value="<?php echo $row['unit_id']; ?>"><?php echo $row['unit_name']; ?></option>
														<?php } ?>
                                                    </select>
                                                
                                            </div>
                                            <div class="col-md-2 mb-2" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Rate (BD)<span style="color:red">*</span></label>
                                                <input type="number" class="form-control " id="txt_quotation_new_rate"  style="text-align:right;" placeholder="0.000" required="">
                                                <input type="number" class="form-control " id="txt_quotation_new_rate_edit"  style="text-align:right;display:none" placeholder="0.000"  >
                                            </div>
                                             
                                            <!--<div class="col-md-2 mb-2" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Amount (BD)</label>
                                                <input type="text" class="form-control" id="txt_quotation_amount" style="color:black;font-weight:700;text-align:right;" disabled placeholder="0.000" required="">
                                               
                                            </div>-->
                                            <input type="hidden" class="form-control " id="txt_quotation_amount" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required=""> 
                                           
                                        
                                            
                                            <div class="col-md-2 mb-1" style="padding-left:1px;paddibng-right:1px;">
                                                <label for="validationTooltip05">Discount</label>
                                                <!--<input type="text" class="form-control" id="txt_discount_percentage" style="color:black;font-weight:700;text-align:right;"  placeholder="0" required="">-->
                                                <div class="input-group mb-1" id="div_product_discount">
                                            <div class="input-group-prepend" id="div_product_discount_type">
                                                <!--<span class="input-group-text form-control-sm" id="basic-addon3">BD</span>-->
                                                <select >
                                                    
                                                    <option>%</option>
                                                    <option>BD</option>
                                                </select>
                                            </div>
                                            <input type="number" min="0" id="txt_product_discount" class="form-control " value="0" placeholder="" style="text-align:right;">
                                            
                                           
                                        </div>
                                            </div>
                                           
                                           <!-- <div class="col-md-3 mb-3" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Amount After Discount</label>
                                                <input type="text" class="form-control" id="txt_amt_after_discount" style="color:black;font-weight:700;text-align:right;" disabled placeholder="0.000" required="">
                                               
                                            </div>-->
                                              <input type="hidden" class="form-control form-control-sm" id="txt_amt_after_discount" style="color:black;font-weight:700;text-align:right;"  placeholder="0" required="">
                                            <!-- <div class="col-md-1 mb-1" style="padding-left:1px;paddibng-right:1px;">-->
                                            <!--    <label for="validationTooltip05">Tax%</label>-->
                                            <!--    <input type="text" class="form-control" id="txt_tax_percentage" style="color:black;font-weight:700;text-align:right;"  placeholder="0" required="">-->
                                               
                                            <!--</div>-->
                                            
                                           <!--  <div class="col-md-3 mb-3" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Net Amount</label>
                                                <input type="text" class="form-control" id="txt_net_amount" style="color:black;font-weight:700;text-align:right;" disabled placeholder="0.000" required="">
                                               
                                            </div>-->
                                            <input type="hidden" class="form-control form-control-sm" id="txt_discount_amount" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
                                            
                                            <input type="hidden" class="form-control form-control-sm" id="txt_net_amount" style="color:black;font-weight:700;text-align:right;"  placeholder="0.000" required="">
                                            
                                            
                                            
                                        </div>
                                        <div class="row " >
                                            
                                             <div class="col-md-11 mb-2" style="padding-left:5px;paddibng-right:5px;">
                                                <label for="validationTooltip05">Description</label>
                                                <!--<input type="text" class="form-control" id="txt_quotation_rate"  style="text-align:right;" placeholder="0.000" required="">-->
                                                       <textarea class="form-control" id="editor1">
                                                                     
                                                        </textarea>
                                            </div>
                                             <div class="col-md-1 mb-1" style="padding-top:30px;text-align:right">
                                                 <button type="button" class="mb-2 btn btn-primary" id="btn_quotation_add">ADD</button>
                                                <button type="button" class="mb-2 btn btn-warning" style="color:white" id="btn_quotation_edit">SAVE</button>
                                            </div>
                                        </div>
                               
                               
                               
                               
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
                            
                              
                            
                            <table id="tbl_quotation_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:10px">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th style="display:none;">Quotation ID</th>
                                        <th style="display:none;">Quotation No</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Dis Type </th>
                                        <th>Discount</th>
                                       
                                        <th>Net Total</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                       
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
                                       
                                        <th>Sub Total</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                       
                                    </tr>
                                </tfoot>
                               
                            </table>
                            
                           <div class="row">
                              
                                 <div class="col-md-6 mb-6" style="padding-right:1px"></div>
                                            <div class="col-md-3 mb-3" style="padding-right:1px">
                                                <label for="validationTooltip05">Total Discount</label>
                                                <!--<input type="text" class="form-control" id="txt_discount_percentage" style="color:black;font-weight:700;text-align:right;"  placeholder="0" required="">-->
                                                <div class="input-group mb-1" id="div_discount">
                                            <div class="input-group-prepend" id="div_discount_type">
                                                <!--<span class="input-group-text form-control-sm" id="basic-addon3">BD</span>-->
                                                <select >
                                                    
                                                    <option>%</option>
                                                    <option>BD</option>
                                                </select>
                                            </div>
                                            <input type="number" min="0" id="txt_total_discount" class="form-control form-control-sm" value="0" placeholder="" style="text-align:right;">
                                             <input type="hidden" id="txt_discount_amount_total" class="form-control form-control-sm" value="0" placeholder="" style="text-align:right;">
                                            
                                           
                                        </div>
                                            </div>
                                 
                                <div class="col-sm-12 col-md-6 col-lg-3 custom-font">
                                        <label>Total Amount</label>
                                        <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" disabled id="txt_quotation_total_amount" placeholder="0.000">
                                        <input type="text" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" disabled id="txt_quotation_total_amount_edit" placeholder="0.000"> 
                                        <input type="hidden" class="form-control form-control-sm" style="color:black;font-weight:700;text-align:right" disabled id="txt_quotation_total_amount_hidden" placeholder="0.000"> 
                                </div>
                                
                             
                                
                                
                                        
                           </div> 
                           
                           
                           
                           <div class="row">
                              
                                <div class="col-sm-12 col-md-6 col-lg-12 custom-font">
                                        <label>Description</label>
                                        
                                      <textarea class="form-control" id="editor2">
                                          <p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; WORKS AND DESCRIPTION</strong></p><p><strong>SCOPE OF WORK</strong></p><p><strong>General Notes</strong></p><ol><li>This quotation and the scope of work are prepared based on the information, drawings, and specifications currently provided. All works shall be executed in accordance with the Issued for Construction (IFC) drawings, approved shop drawings, project specifications, and client/consultant requirements.</li><li>Any modification, revision, or additional requirements issued after approval shall be treated as a variation, subject to review of cost and schedule impact.</li><li>Sapphire Industries shall not be responsible for any design errors or omissions in the IFC drawings, consultant designs, or client-provided data.</li></ol><p>1<strong>. DESIGN CALCULATIONS</strong></p><ol><li>Design services are not included in the current scope of work.</li><li>If design or structural calculation services are required, they can be provided by Sapphire Industries through a qualified third-party design consultant at additional cost, subject to prior client approval.</li><li>All design calculations, if provided, shall follow relevant international standards (BS, ASTM, EN, or equivalent) and shall be limited to the parameters provided by the client/consultant.</li><li>Professional Indemnity (PI) insurance can be arranged, if required by the client, at additional cost to cover design-related responsibilities.</li></ol><p><strong>2. MATERIAL</strong></p><ol><li>Supply of structural steel materials such as beams, columns, channels, plates, angles, hollow sections, and other components as per approved shop drawings and project specifications.</li><li>All materials shall be procured from approved manufacturers with valid mill test certificates, ensuring compliance with applicable standards (ASTM, BS, or EN).</li><li>Any change in material grade, specification, or source after approval shall be subject to cost and schedule adjustments.</li></ol><p><strong>3. ACCESSORIES</strong></p><ol><li>Provision of all required accessories such as bolts, nuts, washers, anchor bolts, and fasteners as per approved drawings and standards.</li><li>Accessories shall conform to the specified grades (e.g., ASTM A325/A490 or equivalent) and shall be galvanized or coated as per project requirements.</li><li>Any special accessories not indicated in the IFC drawings or BOQ shall be treated as additional scope.</li></ol><p><strong>4. PAINTING / COATING</strong></p><ol><li>All surface preparation and coating works shall be performed in accordance with the approved painting system and project specifications.</li><li>The process shall include cleaning, sandblasting (if specified), primer, and finish coats with the required Dry Film Thickness (DFT).</li><li>Painting materials shall be sourced from approved suppliers and supported by technical data sheets.</li><li>Touch-up or repair work due to handling or other trades is excluded unless specifically mentioned.</li></ol><p><strong>5. SHOP DRAWINGS</strong></p><ol><li>Preparation and submission of shop drawings shall be based on the latest IFC drawings, project specifications, and consultant instructions.</li><li>Shop drawings shall include member details, material grades, connections, weld symbols, and assembly references.</li><li>Fabrication shall commence only after receiving formal approval of shop drawings.</li><li>Any revisions to IFC drawings or comments from the consultant after shop drawing approval may impact the project schedule, and fabrication and delivery timelines will be adjusted accordingly.</li></ol><p><strong>6. TIMELINE</strong></p><ol><li>Fabrication and delivery schedules shall follow the mutually agreed project program, subject to timely approval of drawings and material release by the client/consultant.</li><li>Any delays due to late approvals, revisions, or site constraints beyond our control shall entitle Sapphire Industries to a corresponding extension of time.</li></ol><p><strong>7. TERMS AND CONDITIONS</strong></p><ol><li>All works shall conform to IFC drawings, project specifications, and consultant-approved documents within the defined scope.</li><li>Sapphire Industries shall execute works strictly as per approved shop drawings.</li><li>Any additional requirements, site changes, or design modifications shall be executed only upon receiving written confirmation from the client or main contractor.</li><li>PI Insurance, if required for design or related works, will be arranged at additional cost.</li><li>Design responsibility shall remain with the client or consultant unless specifically assigned to Sapphire Industries under a separate written agreement.</li></ol><p><strong>8. PAYMENT TERMS</strong></p><p>Payment shall be made as per mutually agreed terms, typically as follows:</p><ol><li>Advance Payment: 50% upon order confirmation.</li><li>Progress Payment: 45% upon fabrication completion and inspection.</li><li>Final Payment: 5% upon delivery or installation.</li></ol><p><strong>Notes:</strong></p><ol><li>All quoted prices are exclusive of applicable taxes. Taxes will be charged in accordance with Bahrain NBRA regulations.</li><li>VAT Account No: 220009487800002</li><li>For zero VAT sites, a valid Zero VAT Certificate must be provided by the client for accounting purposes.</li><li>Back-to-back payment terms are not acceptable under any circumstances.</li><li>The quotation is subject to Sapphire Industries  standard contract terms, unless otherwise specified in writing</li><li>All invoices shall be settled within the agreed credit period. Retention, if applicable, shall be released as per contract conditions.</li></ol><p><strong>9. EXCLUSIONS</strong></p><p>Unless specifically stated in our quotation, the following items are excluded from the scope of work:</p><ol><li>Design, engineering, and structural calculations (unless quoted separately).</li><li>Civil, concrete, or masonry works.</li><li>MEP, wood, aluminum, gypsum, glass, or signage works.</li><li>Third-party inspection, testing, or NDT (unless specified).</li><li>Any protective coating on steel other than what is specified in the drawings or specifications.</li><li>Power supply, scaffolding, lifting equipment, or site facilities; safe scaffolding with wooden planks and safety measures must be provided by the client.</li><li>The client is responsible for providing a 240-volt electricity supply within 50 meters of the working area and a water supply at the site.</li><li>Dismantling, site cleaning, on-site storage of materials, and security.</li><li>Any performance bond, advance payment guarantee, or other financial securities.</li><li>Any works not explicitly mentioned in this scope, IFC drawings, BOQ, or project specifications.</li></ol><p><strong>10. VARIATION</strong></p><ol><li>Any change in drawings, specifications, quantities, or instructions after shop drawing approval shall be treated as a variation.</li><li>Variations will be executed only after receiving official instruction and mutual agreement on cost and schedule impact.</li></ol><p><strong>Notes:</strong></p><ol><li>All items, quantities, and specifications included in this quotation are strictly based on the drawings and documents currently available.</li><li>Any changes in drawings, specifications, grades, materials, accessories, painting systems, or other project requirements that differ from the present IFC or tender drawings shall be treated as additional scope.</li><li>Accordingly, quoted prices shall be adjusted, and the difference shall be considered a variation.</li></ol><p><strong>11. GENERAL TERMS</strong></p><ol><li>All workmanship shall comply with international standards and project-specific quality requirements.</li><li>Sapphire Industries shall not be responsible for discrepancies in client/consultant-provided drawings or designs.</li><li>Works will be executed strictly as per approved IFC drawings and consultant instructions.</li><li>This quotation is valid for 30 days from the date of issue.</li><li>All applicable taxes, duties, or levies shall be charged extra if applicable.</li><li>PI insurance and design services are optional, subject to separate approval and additional cost.</li></ol><p>We trust this proposal meets your expectations and look forward to receiving your confirmation. Should you require any further clarification, please do not hesitate to contact us.</p><p><strong>Yours faithfully,</strong></p><p>&nbsp;</p><p><br><strong>__________________</strong><br><strong>THOMAS MAMMEN</strong><br><strong>GENERAL MANAGER</strong></p><p><strong>M-38383956</strong></p><p>&nbsp;</p>
                                       </textarea>
                                </div>
                                 
                               
                                
                                
                                        
                           </div> 
                           
                           
                           
                            
                        </div>
                        
                        
                        
                        
                        <div class="card-footer">
                            <div class="row">
                                <!--<div class="col-sm-12 col-md-2 col-lg-2">-->
                                <!--    <button class="btn btn-info" id="btn_quotation_print"><i class="material-icons">print</i> VAT Print </button>-->
                                    
                                    
                                <!--</div>-->
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_quotation_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_quotation_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                </div>
								<div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-info" id="btn_quotation_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>
                                    
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_quotation"> <i class="material-icons">list</i>  Generate Quotation</button>
                                    <button class="btn btn-warning" id="btn_edit_quotation" style="color:white"> <i class="material-icons">edit</i>  Update Quotation</button>
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
                                        <h5 class="mb-0">List of quotations</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span id="btn_list_of_qtns_close" class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             <div class="row ">
                                    <div class="col-sm-5 col-md-5 col-lg-3">
                                        <label for="validationTooltip05">Start Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_start_date">
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-3" style="text-align:right">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_end_date">
                                    </div>
									<div class="col-sm-5 col-md-5 col-lg-4" style="text-align:right; margin-top: 14px;">
                                        
                                        <div id="div_company_select">
										<label for="validationTooltip05"></label>
                                                    <select class="form-control form-control-sm" id="all_app">
                                                        
                                                        <option value="all">All</option>
                                                        <option value="approval">Approved</option>
                                                    </select>
                                                    </div>
                                    </div>
                                   <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_search_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                </div>
                        
                        <!--Table-->
                            <table class="table  table-striped table-bordered dataTable" id="list_of_quotations" class="custom-font" style="padding-top:5px;font-size:12px;width:100%;">
                                <thead>
                                    <tr>
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Quotation No </th>
										 <th>Company </th>
                                        <th>Project </th>
                                        <th>Project No</th>
                                        <th>Amount </th>
                                         <th>Discount </th>
                                        <th>View </th>
                                        <!--<th>Delete </th>-->
                                        <th>Approved </th>
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
        
<div id="mySidenavRCancel" class="sidenavR " height="100%"  style="background-color:white;padding-top:70px;box-shadow: -10px 0px 10px #e3e3e3;">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of cancelled quotations</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRCancel()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             <div class="row ">
                                    <div class="col-sm-5 col-md-5 col-lg-5">
                                        <label for="validationTooltip05">Start Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_start_date">
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-5" style="text-align:right">
                                        <label for="validationTooltip05">End Date</label>
                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_end_date">
                                    </div>
                                   <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">
                                        <button class="btn btn-info" id="btn_cancel_search_date"> <i class="material-icons">search</i> </button>
                                    </div>
                                </div>
                        
                        <!--Table-->
                            <table class="table " id="list_of_cancel_quotations" class="custom-font" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr class="custom-font">
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Quotation No </th>
                                        <th>Company </th>
                                        <th>Amount </th>
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
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_product_add">
        <div class="modal-dialog modal-xl" role="document" style="max-width: 50%;">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row" style="padding:10px;">
							<div class="form-group custom-font">
                                            <div class="row" >
                                                <!--<div class="col-sm-12 col-md-1 col-lg-1 ">-->
                                                <!--        <label>Product</label>-->
                                                <!--</div>-->
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                        <label>Product</label>
                                                        <input type="text" class="form-control form-control-sm"  id="txt_product_name"> 
                                                        <input type="hidden"  id="txt_master_product_id_hidden"> 
                                                </div>
                                                <!--<div class="col-sm-12 col-md-1 col-lg-1 " >-->
                                                <!--        <label>Unit</label>-->
                                                <!--</div>-->
                                                <div class="col-sm-12 col-md-4 col-lg-4" style="width:200px;">
                                                    <label>Unit</label>
                                                    <select class="form-control form-control-sm" id="select_product_unit">
                                                        <option value="0">--Select Unit--</option>
														<?php while($row1 = mysqli_fetch_assoc($fetch_unit2)) { ?>
														<option value="<?php echo $row1['unit_id']; ?>"><?php echo $row1['unit_name']; ?></option>
														<?php } ?>
                                                    </select>
                                                </div>
                                                <!-- <div class="col-sm-12 col-md-1 col-lg-1">-->
                                                <!--        <label>Unit Rate</label>-->
                                                <!--</div>-->
                                                 <div class="col-sm-12 col-md-2 col-lg-2" style="width:500px;">
                                                     <label>Unit Rate</label>
                                                        <input type="text" class="form-control form-control-sm" id="txt_unit_rate"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                           
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <!--<div class="col-sm-12 col-md-1 col-lg-1" style="padding-bottom:10px">-->
                                                        <!--<label>Description</label>-->
                                                <!--</div>-->
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                     <label>Description</label>
                                                       <textarea class="form-control" id="txt_product_description">
                                                             
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    	
                        </div>
                        <div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
        					<button type="button" class="btn btn-primary" id="btn_generate_product_master">Save</button>
        				</div>
                </div>
			
            </div>
        </div>
    <!--</div>-->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="update_attn">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Attn</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row">
							<div class="col-sm-12 col-md-9 col-lg-9">
								<label>Name</label>
								<input type="text" class="form-control" placeholder="" id="txt_attn_name">
							</div>	
                        </div>
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
					<button type="button" class="btn btn-primary" id="btn_attn_save">Save</button>
				</div>
            </div>
        </div>
    </div>
  
<!-- Company Quotations  -->
<div id="mySidenavRCompany" class="sidenavR " height="100%"  style="background-color:white;padding-top:70px;box-shadow: -10px 0px 10px #e3e3e3;">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of quotations</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRCompany()"><span id="btn_list_of_qtns_close" class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             <div class="row ">
                                    <div class="col-sm-5 col-md-5 col-lg-3">
                                       
                                        <div id="div_company_select_list">
                                        <select class="form-control form-control-sm">
                                            <option>--Select Company--</option>
                                        </select>
                                        </div>
                                                             
                                    </div>
                                    <div class="col-sm-5 col-md-5 col-lg-3" style="text-align:right">
                                        <div id="div_project_select_combo_list">
                                        <select class="form-control form-control-sm">
                                            <option>--Select Project--</option>
                                        </select>
                                        </div>
                                        
                                        
                                    </div>
									<div class="col-sm-5 col-md-5 col-lg-3" style="text-align:right;">
                                        
                                            <div id="div_company_select_approve">
									
                                                    <select class="form-control form-control-sm" id="all_app_list">
                                                        
                                                        <option value="All">All</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Pending">Not Approved</option>
                                                    </select>
                                            </div>
                                    </div>
                                   <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:0px">
                                        <button class="btn btn-info" id="btn_search_company_approve_prjct"> <i class="material-icons">search</i> </button>
                                    </div>
                                </div>
                        
                        <!--Table-->
                            <table class="table  table-striped table-bordered dataTable" id="list_of_quotations_company" class="custom-font" style="padding-top:5px;font-size:12px;width:100%;">
                                <thead>
                                    <tr>
                                        <th style="display:none;">ID </th>
                                        <th>Date </th>
                                        <th>Quotation No </th>
										 <th>Company </th>
                                        <th>Project </th>
                                        <th>Project No </th>
                                        <th>Amount </th>
                                         <th>Discount </th>
                                        <th>View </th>
                                        <!--<th>Delete </th>-->
                                        <th>Approved </th>
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


 

