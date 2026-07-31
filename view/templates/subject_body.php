<!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                         <figure class="avatar avatar-40 rounded-circle align-self-start ">
                           <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Introduction</h5>
                            <p class="mb-0  text-white">Click right icon to get List of Introduction<span class="status bg-success"> </span></p>
                        </div>
                        <!--<div class="dropdown d-inline-block">-->
                        <!--    <a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--        <i class="material-icons ">more_vertical</i>-->
                        <!--    </a>-->
                        <!--    <div class="dropdown-menu dropdown-menu-right">-->
                        <!--        <a href="" class="dropdown-item">New</a>-->
                                <button  class="btn btn-sm btn-outline-light" onclick="openNavR()" id="btn_view_list_of_subject">List Of Introduction</button>
                                
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                </div>
                <div class="card-body py-0">
                     
                   
                    <!--Company FORM-->
                    
                    
                    <div class="card-body">
                    
                      
                            
                          <div class="row" style="padding-left:10px;padding-right:10px;padding-bottom:10px">
                                <div class="col-lg-4 col-md-4">
                                    <label>Introduction Name</label>
                                    
                                    <input type="hidden" id="txt_subject_id" class="form-control" placeholder="">
                                    <input type="text" id="txt_subject" class="form-control" placeholder="">
                                </div>
                                
                                  <div class="col-lg-8 col-md-8">
                                    <label>Introduction Text</label>
                                    
                                    <textarea class="form-control orm-control-sm" id="txt_subject_text" name="txt_subject_text"> </textarea>
                                </div>
                               
                            </div>
                           
                           
                       
                        
                    </div>
                    
                   
                </div>
                <div class="card-footer">
                    <button class="btn btn-secondary" id="btn_subject_cancel">Cancel</button>
                    <button class="btn btn-success float-right" id="btn_subject_add">Save</button>
                     <button class="btn btn-warning text-white float-right" id="btn_subject_edit">Save</button>
                </div>
                    
                    
                    <!--Company FORM End-->
                      
                    
                </div>
            </div>
            
            
        </div>
        
        
<!-- content page ends -->
        
<div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;padding-top:70px;">
    
   
                <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
                    <div class="card rounded-0 border-0 mb-12">
                        <div class="card-header">
                            
                           
                                <div class="row ">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <h5 class="mb-0">List of Introduction</h5>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                        
                                        <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                                        <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                                    </div>
                                  
                                </div>
                            
                            
                        </div>
                        <div class="card-body ">
                             
                        
                        <!--Table-->
                            <table class="table " id="list_of_subject" class="custom-font" style="padding-top:5px;font-size:12px;">
                                <thead>
                                    <tr class="custom-font">
                                        <th>Sl No </th>
                                        <th>ID </th>
                                        <th>Introduction </th>
                                        <th>Introduction Text</th>
                                        <th>View</th>
                                        <th>Delete</th>
                                        
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