<!-- content page -->
        <div class="container mt-2 main-container" >
            
            
            
            
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                           <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Roles and Permissions</h5>
                            <!--<p class="mb-0  text-white">Click right icon to get List of Companies/Clients<span class="status bg-success"> </span></p>-->
                        </div>
                        <div class="dropdown d-inline-block">
                            <!--<a href="#" class="icon-circle icon-30 text-white ml-3 mt-1 dropdown-toggle caret-none" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                            <!--    <i class="material-icons ">more_vertical</i>-->
                            <!--</a>-->
                            
                            <!--<div class="dropdown-menu dropdown-menu-right">-->
                            <!--    <a href="" class="dropdown-item">New</a>-->
                                <!--<button  class="btn btn-sm btn-outline-light" onclick="openNavR()" id="developer_view">Developer view</button>-->
                                
                            <!--</div>-->
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                     
                   
                    <!--Company FORM-->
                    
                    
                    <div class="card-body">
                   
                                    <div id="dropdownContent" style="text-align:center;">
                                       <svg id="svgIcon" width="50" height="50" viewBox="0 0 24 24">
                                        <!-- SVG content goes here -->
                                      </svg>
                                      <!-- Content of your dropdown -->
                                    </div>
                                    <div class="container" style="padding-top:5px;">
                                        <div class="row">
                                            <div class="col-9" style="padding-top:20px;">
                                                
                                            </div>
                                            <div class="col-3" style="padding-top:20px;text-align:right;">
                                                <button type="button" class="btn btn-primary" id="btn_confim_privilages">Confirm Privilages</button>
                                               
                                            </div>
                                        </div>
                                       <!--<button id="dropdownButton">Click me</button> -->
                                    <div class="row" style="padding-top:20px; display: flex; justify-content: space-between; margin: 0 -5px;">
                                        <div class="col-sm-12 col-md-4 col-lg-4 fixed-height-div" style="padding:20px; margin: 0 -13px;">
                                            <table id="tlb_listOfRolls" class="display" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                               
                                                                <th>List of Roles/Groups</th>
                                                               
                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                <!--</div>-->
                                                 <div class="col-12" style="padding-top:20px;">
                                                    <div class="row" style="padding:20px;">
                                                      <!--<label for="" class="form-label">Rolls/Groups</label>-->
                                                      <input type="text" class="form-control" placeholder="Roles/Groups" id="txt_addRolesOrGroups"><p style="padding-top:10px;"/>
                                                      <button type="button" class="btn btn-primary" id="btn_addRolesOrGroups" style="width:100%">Add Roles/Groups</button>
                                                    </div>
                                                 </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 fixed-height-div" style="padding:20px; margin: 0 -13px;">
                                                <table id="tlb_listOfControlsAndModules" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                       
                                                        <th>Permissions</th>
                                                        <th>Class Name</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                        <div class="col-sm-12 col-md-4 col-lg-4 fixed-height-div" style="padding:20px; margin: 0 -13px;">
                                            <table id="tlb_addedListOfControlsAndModules" class="display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                       
                                                        <th>Permissions for Selected Role</th>
                                                       <th>Class Name</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>   
                                    </div>    
                                        <div class="row" style="padding-top:20px; display: flex; justify-content: space-between; margin: 0 -5px;">
                                            <div class="col-sm-12 col-md-4 col-lg-4 fixed-height-div" style="padding:20px; margin: 0 -13px;">
                                                <table id="tlb_listOfUsers" class="display" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                           <th>Name</th>
                                                            <th>Username</th>
                                                            <th>Roll</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                 <div class="col-12" style="padding-top:20px;">
                                                    <div class="row" style="padding:20px;">
                                                      <button type="button" class="btn btn-primary" id="btn_create_user" style="width:100%">Create User</button>
                                                    </div>
                                                 </div>
                                            </div>   
                                            <div class="col-sm-12 col-md-4 col-lg-4 fixed-height-div" style="padding:20px; margin: 0 -13px;">
                                                 <table id="tlb_listOfRollsForUsers" class="display" style="width:100%">
                                                     <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                               
                                                                <th>List of Roles/Groups</th>
                                                               
                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                </table>
                                            </div> 
                                            <div class="col-sm-12 col-md-4 col-lg-4 fixed-height-div" style="padding:20px; margin: 0 -13px;">
                                                <table id="tlb_listOfSelectedUserRolls" class="display" style="width:100%">
                                                     <thead>
                                                            <tr>
                                                                <th>Selected User's Roles/Groups</th>
                                                               
                                                               
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                </table>
                                            </div> 
                                        </div>
                                        <!--<div class="col-3 fixed-height-div" style="padding-top:20px;">-->
                                        <!--    <div class="row">-->
                                        <!--        <div class="col-12" >-->
                                                <!--    <table id="tlb_listOfRolls" class="display" style="width:100%">-->
                                                <!--        <thead>-->
                                                <!--            <tr>-->
                                                <!--                <th>ID</th>-->
                                                               
                                                <!--                <th>List of Rolls/Groups</th>-->
                                                               
                                                               
                                                <!--            </tr>-->
                                                <!--        </thead>-->
                                                <!--        <tbody>-->
                                                <!--        </tbody>-->
                                                <!--    </table>-->
                                                <!--</div>-->
                                                <!-- <div class="col-12" style="padding-top:20px;">-->
                                                <!--    <div class="row" style="padding:20px;">-->
                                                      <!--<label for="" class="form-label">Rolls/Groups</label>-->
                                                <!--      <input type="text" class="form-control" placeholder="Rolls/Groups" id="txt_addRolesOrGroups"><p style="padding-top:10px;"/>-->
                                                <!--      <button type="button" class="btn btn-primary" id="btn_addRolesOrGroups" style="width:100%">Add Rolls/Groups</button>-->
                                                <!--    </div>-->
                                                <!-- </div>-->
                                        <!--    </div>-->
                                           
                                        <!--</div>-->
                                        <!-- <div class="col-3 fixed-height-div" style="padding-top:20px;">-->
                                            <!--<table id="tlb_listOfControlsAndModules" class="display" style="width:100%">-->
                                            <!--    <thead>-->
                                            <!--        <tr>-->
                                            <!--            <th>ID</th>-->
                                                       
                                            <!--            <th>Permissions</th>-->
                                            <!--            <th>Class Name</th>-->
                                                       
                                            <!--        </tr>-->
                                            <!--    </thead>-->
                                            <!--    <tbody>-->
                                            <!--    </tbody>-->
                                            <!--</table>-->
                                        <!--</div>-->
                                        
                                        <!--<div class="col-3 fixed-height-div" style="padding-top:20px;">-->
                                            <!--<table id="tlb_addedListOfControlsAndModules" class="display" style="width:100%">-->
                                            <!--    <thead>-->
                                            <!--        <tr>-->
                                            <!--            <th>ID</th>-->
                                                       
                                            <!--            <th>Permissions for Selected Roll</th>-->
                                            <!--           <th>Class Name</th>-->
                                                       
                                            <!--        </tr>-->
                                            <!--    </thead>-->
                                            <!--    <tbody>-->
                                            <!--    </tbody>-->
                                            <!--</table>-->
                                        <!--</div>-->
                                        
                                        
                                        
                                    <!--</div>-->
                                    
                                    <!--<div class="row" style="padding-top:20px;">-->
                                        
                                    <!--    <div class="col-3 fixed-height-div" style="padding-top:20px;">-->
                                    <!--          <table id="tlb_listOfUsers" class="display" style="width:100%">-->
                                    <!--            <thead>-->
                                    <!--                <tr>-->
                                    <!--                    <th>ID</th>-->
                                                       
                                    <!--                    <th>User Name</th>-->
                                    <!--                    <th>Roll</th>-->
                                                       
                                    <!--                </tr>-->
                                    <!--            </thead>-->
                                    <!--            <tbody>-->
                                    <!--            </tbody>-->
                                    <!--        </table>-->
                                    <!--    </div>-->
                                        <!--<div class="col-3 fixed-height-div" style="padding-top:20px;">-->
                                        <!--       <table id="tlb_listOfRollsForUsers" class="display" style="width:100%">-->
                                        <!--         <thead>-->
                                        <!--                <tr>-->
                                        <!--                    <th>ID</th>-->
                                                           
                                        <!--                    <th>List of Rolls/Groups</th>-->
                                                           
                                                           
                                        <!--                </tr>-->
                                        <!--            </thead>-->
                                        <!--            <tbody>-->
                                        <!--            </tbody>-->
                                        <!--    </table>-->
                                        <!--</div>-->
                                        <!--<div class="col-3 fixed-height-div" style="padding-top:20px;">-->
                                        <!--       <table id="tlb_listOfSelectedUserRolls" class="display" style="width:100%">-->
                                        <!--         <thead>-->
                                        <!--                <tr>-->
                                        <!--                    <th>Selected User's Rolls/Groups</th>-->
                                                           
                                                           
                                        <!--                </tr>-->
                                        <!--            </thead>-->
                                        <!--            <tbody>-->
                                        <!--            </tbody>-->
                                        <!--    </table>-->
                                        <!--</div>     -->
                                        
                                    <!--</div>-->
                                    
                                    <div class="row" style="padding-top:10px;padding-bottom:10px;">
                                         <div class="col-9" >
                                             
                                         </div>
                                        <div class="col-3" style="text-align:right;">
                                           
                                           <button type="button" class="btn btn-primary" id="btn_change_user_roll">Change User Role</button>
                                        </div>
                                    </div>
                                    
                                    </div>

                    </div>
                    <div class="card-footer">
                       
                    </div>
            
            
        </div>
        
 </div>
 </div>
  <div class="modal modal-md fade" id="modal_create_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="">Create User</h5>
					<button type="button" class="close" data-dismiss="modal" id="" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
                <div class="modal-body">
                   
                    <div id="div_create_user">
                           
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        
                                        <div class="col-lg-6 col-md-6">
                                             <label>Name</label><br>
                                            	<input  type="text" class="form-control form-control-sm" name="txt_name" id="txt_name">
                                            </div>
                                        
        								<div class="col-lg-6 col-md-6">
        								    <label>Username</label><br>
                                            	<input  type="text" class="form-control form-control-sm" name="txt_user_namee" id="txt_user_namee" autocomplete="nope" readonly onfocus="this.removeAttribute('readonly');">
												
                                           </div>
                                        </div>
                                        <div class="row">
            								<div class="col-lg-6 col-md-6">
            								     <label>Email</label><br>
                                            	<input  type="email" class="form-control form-control-sm" name="txt_user_email" id="txt_user_email">
												
                                               </div>
                                               <div class="col-lg-6 col-md-6">
            								     <label>Password</label><br>
                                            	<input  type="text" class="form-control form-control-sm" name="txt_user_passwordd" id="txt_user_passwordd" value="12345">
											
                                               </div>	
                                               <!--End Network Operators-->
														
														
														
															<!--<div class="col-md-10" id="div_message_reset_password" style="color:red;text-align: center">-->
																
															<!--</div>-->
										</div>
										
                        
                        </div>
                        
                        </div>
                        </div>
                        
                    <br />
                    <div class="modal-footer">
					
                                    <button class="btn btn-secondary" id="cancel_user_modal"> Cancel</button>
                                   	<button class="btn btn-primary" id="btn_generate_user"><i class="material-icons">list</i>Save</button>
			    </div>    
                  
					</div>
						  
                    </div>
				        
                </div>
				
                       
            </div>
 
