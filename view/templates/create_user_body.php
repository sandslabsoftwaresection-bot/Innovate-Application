<?php

	include('../model/db_connection/connection.php');

	$DBConn1 = new DBConnection();
	$varDBConnection1 = $DBConn1->ConnectToMYSQL();
// 	$fetch_unit = mysqli_query($varDBConnection1, "SELECT * FROM unit_master");

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
						<h5 class="time-title mb-0  text-white">Create User</h5>
					</div>
				   
				</div>
            </div>
            <div class="card-body py-0" style="padding-bottom:0px;">
                <div class="row" style="padding-bottom:0px;">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card rounded-0 border-0 mb-5">
                            <div class="card-body"><input type="hidden" id="ids">
                                <div class="form-group custom-font">
									<div class="row">
									  <div class="col-sm-12 col-md-3 col-lg-3">
                                            <label>Name</label><br>
                                            	<input  type="text" class="form-control form-control-sm" name="txt_name" id="txt_name">
												<!--<textarea class="form-control" name="txt_item_name" id="txt_item_name" rows="1"></textarea>-->
												 
                                        </div>
										<div class="col-sm-12 col-md-3 col-lg-3">
                                            <label>Username</label><br>
                                            	<input  type="text" class="form-control form-control-sm" name="txt_user_namee" id="txt_user_namee" autocomplete="nope" readonly onfocus="this.removeAttribute('readonly');">
												<!--<textarea class="form-control" name="txt_item_name" id="txt_item_name" rows="1"></textarea>-->
												 
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3">
                                            <label>Email</label><br>
                                            	<input  type="email" class="form-control form-control-sm" name="txt_user_email" id="txt_user_email">
												<!--<textarea class="form-control" name="txt_item_name" id="txt_item_name" rows="1"></textarea>-->
												 
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3">
                                            <label>Password</label><br>
                                            	<input  type="password" class="form-control form-control-sm" name="txt_user_passwordd" id="txt_user_passwordd" value="12345">
												<!--<textarea class="form-control" name="txt_item_name" id="txt_item_name" rows="1"></textarea>-->
												 
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-sm-12 col-md-10 col-lg-10">
                                         </div>  
                                        <div class="col-sm-12 col-md-1 col-lg-1" style="padding-right:20px;">
    										<button class="btn btn-primary" id="btn_generate_user"><i class="material-icons">list</i>Save</button>
    										<button class="btn btn-warning" id="btn_edit_user" style="color: white;"><i class="material-icons">list</i>Update</button>
									</div>
									</div>
                                </div>        
                            </div>
                                    
                            <div class="card-footer">
								<div class="row">
								    
								</div>
								</div>
                            </div>
                                   
                        </div>
                    </div>      
                </div>
            </div>
            <div class="card" style="width:100%;">
                <div class="card-header" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
    				<div class="media w-100 ">
    				
    					<div class="media-body">
    						<h5 class="time-title mb-0 text-white">List of Users </h5>
    					</div>
    				   
    				</div>
                </div>
       
        <!--</div> -->
         <div class="card-body py-0" style="padding-bottom:0px;">
                <div class="row" style="padding-bottom:0px;">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card rounded-0 border-0 mb-5">
                            <div class="card-body">
                                <table id="tbl_user_list" class="display stripe cell-border" style="width:100%;font-size:12px;" >
            						<thead>
            							<tr>
            								<th>SI</th>
            								<th>Name</th>
            								<th>Username</th>
            								<th>Email</th>
            								<th>Password</th>
            								<th>Status</th>
            								<th>Edit</th>
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
            							
            							</tr>
            						</tfoot>   
            					</table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            
            
        </div>      
    </div>
        

    
    <!-- content page ends -->
        
    <!--<div id="mySidenavR" class="sidenavR " height="100%"  style="background-color:white;padding-top:70px;box-shadow: -10px 0px 10px #e3e3e3;">-->
    <!--    <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">-->
    <!--        <div class="card rounded-0 border-0 mb-12">-->
    <!--            <div class="card-header">-->
				<!--	<div class="row ">-->
				<!--		<div class="col-sm-6 col-md-6 col-lg-6">-->
				<!--			<h5 class="mb-0">List of Inventory Category</h5>-->
				<!--		</div>-->
				<!--		<div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">-->
				<!--			<button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>-->
				<!--		</div>-->
				<!--	</div>    -->
    <!--            </div>-->
    <!--            <div class="card-body ">-->
					<!--Table-->
				<!--	<table id="tbl_inventory_list" class="display stripe cell-border" style="width:100%;font-size:12px;" >-->
				<!--		<thead>-->
				<!--			<tr>-->
				<!--				<th>SI</th>-->
				<!--				<th>Category</th>-->
				<!--				<th>Status</th>-->
								<!--<th>Delete</th>-->
				<!--			</tr>-->
				<!--		</thead>-->
				<!--		<tbody>-->
						  
				<!--		</tbody>-->
				<!--		<tfoot>-->
				<!--			<tr>-->
				<!--				<th></th>-->
				<!--				<th></th>-->
				<!--				<th></th>-->
								<!--<th></th>-->
							
				<!--			</tr>-->
				<!--		</tfoot>   -->
				<!--	</table>-->
					<!-- /.table-responsive -->    
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->


