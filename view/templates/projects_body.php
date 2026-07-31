 <!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                           <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Projects</h5>
                            <p class="mb-0  text-white">Click right icon to get List of Projects<span class="status bg-success"> </span></p>
                        </div>
                        <!--<div class="dropdown d-inline-block">-->
                        <!--    <a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--        <i class="material-icons ">more_vertical</i>-->
                        <!--    </a>-->
                        <!--    <div class="dropdown-menu dropdown-menu-right">-->
                        <!--        <a href="" class="dropdown-item">New</a>-->
                                <!--<button  class="btn btn-sm btn-outline-light" onclick="openNavR()" id="btn_view_list_of_project">List of Projects</button>-->
                                
                        <!--    </div>-->
                        <!--</div>-->
                        
                         <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Project List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_project" data-style="expand-right"><span class="ladda-label">Waiting for Generation</span><span class="ladda-spinner"></span></a>
                                <a class="dropdown-item" href="#" onclick="openNavRProject()" id="btn_view_list_of_project_with_number">Generated List</a>
                                <!--<a class="dropdown-item" href="#" onclick="openNavRCompany()" id="btn_view_list_of_company_quotation">Company Quotations</a>-->
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                     
                   
                    <!--Company FORM-->
                    
                    
                    <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-10 ">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4">
                                    
                                    <label>Company/Client Name</label>
                                   <div id="div_company_select">
                                                    <select class="form-control form-control-sm">
                                                        <option>--Select Company--</option>
                                                    </select>
                                                    </div>
                                    
                                    <input type="hidden" class="form-control form-control-sm" id="txt_quotation_company_name">
                                    <input type="hidden" class="form-control form-control-sm" id="txt_quotation_company_id"> 
                                </div>
                                
                                <div class="col-lg-6 col-md-6">
                                    <div id="existing_project" style="display:none">
                                         <label>Select Project</label>
                                    <div id="div_project_select">
                                    <select class="form-control form-control-sm" id="select_project" data-live-search="true" tabindex="-1" aria-hidden="true">
                                            <option>Select Project</option>   
                                               
                                     </select>
                                    </div>
                                        
                                    </div>
                                    <div id="new_project" >
                                    <label>Project Name</label>
                                    
                                    <input type="hidden" id="txt_project_id" class="form-control" placeholder="">
                                    <input type="text" id="project_name" class="form-control form-control-sm" placeholder="">
                                    </div>
                                </div>
                                 <div class="col-lg-2 col-md-2 ">
                                   
                                    
                                    <label>Tax Content</label>
                                    
                                   
                                    <input type="text" id="txt_tax_content" class="form-control form-control-sm" placeholder="" value="0.000">
                                    
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-secondary" id="btn_cancel">Cancel</button>
                    <button class="btn btn-success float-right" id="btn_add_project">Save</button>
                    <button class="btn btn-warning text-white float-right" id="btn_edit_project">Save</button>
                </div>
                
                    <!--Company FORM End-->
                      
                    
                </div>
            </div>
             
            
        </div>
     <div class="container mt-2 main-container" >    
        
        <div class="card">
                <div class="card-body">
                             
                        
                        <!--Table-->
                            <table class="table" id="list_of_projects_quotation" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                       
                                        <th>SlNo </th>
                                        <th>Company </th>
                                        <th>Project </th>
                                        <th>Project No</th>
                                        <th>Quotation No</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                       
                                        
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
        
<div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;padding-top:70px;">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <h5 class="mb-0">List of Projects</h5>
                                    </div>
                                </div>
                           
                                <div class="row mt-5">
                                    
                                    <div class="col-lg-6 col-md-6">
                                        
                                       <label>Company/Client Name</label>
                                       <div id="div_company_select_project">
                                        <select class="form-control form-control-sm">
                                            <option>--Select Company--</option>
                                        </select>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             
                        
                        <!--Table-->
                            <table class="table" id="list_of_projects" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                       
                                        <th>SlNo </th>
                                        <th>ID </th>
                                        <th>Project </th>
                                        <th>Tax </th>
                                        <th>Company </th>
                                        <th>Company ID</th>
                                        <th>Default Date </th>
                                        <th>View</th>
                                        <th>Delete</th>
                                        <th>Generate</th>
                                        
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

<div id="mySidenavRProject" class="sidenavR " height="100%" style="background-color:white;padding-top:70px;">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Projects With Project Number</h5>
                                    </div>
                                    </div>
                                    <div class="row ">
                                     <div class="col-lg-6 col-md-4">
                                        
                                       <label>Company/Client Name</label>
                                       <div id="div_company_select_project_number">
                                        <select class="form-control form-control-sm">
                                            <option>--Select Company--</option>
                                        </select>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRProject()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             
                        
                        <!--Table-->
                            <table class="table " id="list_of_projects_with_number" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                                <thead>
                                    <tr class="custom-font">
                                       
                                        <th>SlNo </th>
                                        <th>ID </th>
                                        <th>Project </th>
                                        <th>Tax </th>
                                        <th>Company </th>
                                        <th>Company ID</th>
                                        <th>Default Date </th>
                                        <th>View</th>
                                        <th>Delete</th>
                                        <th>Generate</th>
                                        
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