<?php

	include('../model/db_connection/connection.php');

	$DBConn1 = new DBConnection();
	$varDBConnection1 = $DBConn1->ConnectToMYSQL();
	$fetch_unit = mysqli_query($varDBConnection1, "SELECT * FROM unit_master");
	

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
                            <h5 class="time-title mb-0  text-white">New Product Master</h5>
                            <p class="mb-0  text-white">Product Master #: <inno id="quotation_no_head"></inno><!--<span class="status bg-success"> </span>--></p>
                        </div>
                       
                        
                        <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Product Master List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_quotations" data-style="expand-right"><span class="ladda-label">List of Products</span><span class="ladda-spinner"></span></a>
                               
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0" style="padding-bottom:0px;">
                     
                   
                    <div class="row" style="padding-bottom:0px;">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card rounded-0 border-0 mb-5">
                                    
                                    <div class="card-body ">
                                      
                                        <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-1 col-lg-1 ">
                                                        <label>Product</label>
                                                </div>
                                                <div class="col-sm-12 col-md-5 col-lg-5">
                                                        <input type="text" class="form-control form-control-sm"  id="txt_product_name"> 
                                                        <input type="hidden"  id="txt_master_product_id_hidden"> 
                                                </div>
                                                <div class="col-sm-12 col-md-1 col-lg-1 " >
                                                        <label>Unit</label>
                                                </div>
                                                <div class="col-sm-12 col-md-2 col-lg-2">
                                                    <select class="form-control form-control-sm" id="select_product_unit">
                                                        <option value="0">--Select Unit--</option>
														<?php while($row = mysqli_fetch_assoc($fetch_unit)) { ?>
														<option value="<?php echo $row['unit_id']; ?>"><?php echo $row['unit_name']; ?></option>
														<?php } ?>
                                                    </select>
                                                </div>
                                                 <div class="col-sm-12 col-md-1 col-lg-1">
                                                        <label>Unit Rate</label>
                                                </div>
                                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                                        <input type="text" class="form-control form-control-sm" id="txt_unit_rate"> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                           
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-1 col-lg-1">
                                                        <label>Description</label>
                                                </div>
                                                <div class="col-sm-12 col-md-11 col-lg-11">
                                                       <textarea class="form-control" id="txt_product_description">
                                                             
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                   
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                   
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                   
                                    
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_product_master"> <i class="material-icons">list</i> Save</button>
                                    <button class="btn btn-warning" id="btn_edit_product_master"> <i class="material-icons">list</i> Update</button>
                                    </div>
                            </div>
                            
                        </div>
                                   
                                </div>
                            </div>
                           
                           <!--<div class="col-sm-12 col-md-6 col-lg-5">-->
                           <!--     <div class="card rounded-0 border-0 mb-5">-->
                                    
                           <!--         <div class="card-body ">-->
                                       
                                        
                                        
                           <!--         </div>-->
                                   
                           <!--     </div>-->
                           <!-- </div>  -->
                           
                    </div>
                </div>
                
            </div>
            
                                            
                             
                                            
            
        </div>
        

     
        
         <div class="container mt-1 main-container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                            
                              
                            
                            
                            
                         
                           
                           
                           <!--<div class="row">-->
                              
                           <!--     <div class="col-sm-12 col-md-6 col-lg-12 custom-font">-->
                           <!--             <label>Description</label>-->
                                        
                           <!--           <textarea class="form-control" id="editor">-->
                                          
                           <!--               <p><strong>WORK DESCRIPTION</strong></p><p><strong>HANDRAIL:</strong></p><ol><li>All the handrail shall be 48 dia mm schedule 40 pipes.</li><li>Material shall be hot dipped galvanized.</li><li>All the material spray paint finished.</li><li>All the joint shall be 6mm continues fillet welds.</li><li>All the accessories shall be as per the construction drawing.</li></ol><p><strong>STRUCTURAL STEEL MEMBERS:</strong></p><ol><li>All the Structural steel members as per specification.</li><li>All the bolt shall be of Grade 8.8. All nuts shall be compatible to the grade &amp; size of the bolts.</li><li>Electrodes used in metal arch welding of mild steel and medium tensile steel shall be as per the specification.</li><li>All the joint shall be 6mm continues fillet welds.</li><li>All outer metal installations shall be spray paint finished.</li></ol><p><strong>GRATING:</strong></p><ol><li>All the 200x100x10mm angle frames shall be hot dipped galvanized.</li><li>All the grating shall be 30x30x4mm thick connected with grating clamps.</li><li>All the grating supports shall be as per the specification.</li></ol><p>&nbsp;</p><p><strong>CAGE LADDER:</strong></p><ol><li>50mm dia G.I pipe shall be stringers.</li><li>65mm plate rings @ 300c/c.</li><li>Cage support shall be 50 x 10mm flat bar hot dipped galvanized with the paint finished.</li></ol><p><strong>1.)&nbsp;&nbsp;&nbsp; Payment:</strong></p><p>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 50% Advance along with order confirmation.</p><p>b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 50% as per the progress of works.</p><p>c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The above Quotation is subject to our Standard Terms of Contract Unless Otherwise Specified.</p><p><strong>TERMS &amp; CONDITIONS</strong></p><p><strong>1.)&nbsp;&nbsp;&nbsp; Note:-</strong></p><p>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Works shall be started upon receiving of order confirmation (LPO) and advance payment.</p><p>b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our offer is based on the quantity provided by you. The final subcontract amount shall be adjusted as per the work executed at site after applying enclosed BOQ rate.</p><p><strong>2.)&nbsp;&nbsp;&nbsp; Exclusions:</strong></p><p>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any other protection coating on steel other than mentioned.</p><p>b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any kind of civil, MEP, stainless steel, glass, gypsum, carpentry / wooden &amp; signage works.</p><p>c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any other works other than mentioned above.</p><p>d)&nbsp;&nbsp;&nbsp;&nbsp; Dismantling &amp; cleaning.</p><p>e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Erected safe scaffolding with adequate wooden planks to be supplied by client with proper protection.</p><p>f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 240 volt electricity within 25 meters of our working area to be supplied by client with proper resources and provision.</p><p>g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any other works other than mentioned above.</p><p>h)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lifting equipment, electricity &amp; water.</p><p>i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Store for safe keeping of materials at site.</p><p>j)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any performance bond or advance payment guarantee.</p><p>k)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Tensioning strap stainless steel supplied by main contractor</strong>.</p><p><strong>3.)&nbsp;&nbsp;&nbsp; Variation: </strong>All works shall be carried out as per the drawings. Any change may lead to a variation in the price and the completion period.</p><p><strong>4.)&nbsp;&nbsp;&nbsp; General:</strong></p><p>a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; This Quotation is valid for 30 days from the date of issue.</p><p>b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The contractual obligation for necessary permits (if any) shall be a part of the client.</p><p>c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Completion period to be discussed mutually after award of the contract.</p><p>d)&nbsp;&nbsp;&nbsp;&nbsp; All works shall be carried out as detailed in the scope of works. Any change may lead to a variation in the price and the completion period.</p><p>e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our lump sum price is based on the enclosed BOQ which shall a part of this contract.</p><p>We trust you will find our offer competitive and look forward for your order at the earliest. Please don't hesitate to contact our office for any further clarification.</p><p>Thanking you and assuring you of our best service at all the times.</p><p>Yours faithfully,</p><p>&nbsp;</p><p><strong>_______________________</strong></p><p><strong>THOMAS MAMMEN</strong></p><p><strong>GENERAL MANAGER</strong></p>-->
                           <!--           </textarea>-->
                                        
                                        
                           <!--     </div>-->
                                 
                               
                                
                                
                                        
                           <!--</div> -->
                           
                           
                           
                            
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
                                        <h5 class="mb-0">List of products</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                            
                        
                        <!--Table-->
                          <table id="tbl_product_master_list" class="display stripe cell-border" style="width:100%;font-size:12px;" >
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
                                        <th style="display:none;"></th>
                                        <th style="display:none;"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                       
                                    </tr>
                                </tfoot>
                               
                            </table>
                            <!-- /.table-responsive -->
                        
                        
                        
                        
                        </div>
                        <!--<div class="card-footer">-->
                        <!--    <button class="btn btn-primary"> View</button>-->
                        <!--</div>-->
                    </div>
                </div>

   
</div>


