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
						<h5 class="time-title mb-0  text-white">Inventory</h5>
					</div>
				   
					
					<div class="dropdown " style="padding-left:50px;">
						<button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							Inventory List
						</button>
						<div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
							<a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_inventory" data-style="expand-right"><span class="ladda-label">List of Inventory</span><span class="ladda-spinner"></span></a>
						</div>
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
									    <div class="col-sm-12 col-md-4 col-lg-4">
                                            <label>Category</label><br>
											<select class="form-control form-control-sm" id="select_category">
												<option value="0">Select Category</option>
												<option value="Consumable">Consumable</option>
												<option value="Fixed">Fixed</option>
												<option value="Finished">Finished</option>
											</select>
                                        </div>
										
										<div class="col-sm-12 col-md-2 col-lg-2">
                                            <label>Unit</label><br>
											<select class="form-control form-control-sm" id="select_unit">
												<option value="0">Select Unit</option>
												<?php while($row = mysqli_fetch_assoc($fetch_unit)) { ?>
												<option value="<?php echo $row['unit_id']; ?>"><?php echo $row['unit_name']; ?></option>
												<?php } ?>
											</select>
                                        </div>
										
										<div class="col-sm-12 col-md-6 col-lg-6">
                                            <label>Inventory Name</label><br>
												<textarea class="form-control" name="txt_item_name" id="txt_item_name" rows="1"></textarea>
                                        </div>
									</div>
                                </div>        
                            </div>
                                    
                            <div class="card-footer">
								<div class="row">
									<div class="col-sm-12 col-md-2 col-lg-2"></div>
									<div class="col-sm-12 col-md-2 col-lg-3"></div>
									<div class="col-sm-12 col-md-2 col-lg-2"></div>
									<div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
										<button class="btn btn-primary" id="btn_generate_inventory"><i class="material-icons">list</i>Save</button>
										<button class="btn btn-warning" id="btn_edit_inventory" style="color: white;"><i class="material-icons">list</i>Update</button>
									</div>
								</div>
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
							<h5 class="mb-0">List of Inventory</h5>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6" style="text-align:right">
							<button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
						</div>
					</div>    
                </div>
                <div class="card-body ">
					<!--Table-->
					<table id="tbl_inventory_list" class="display stripe cell-border" style="width:100%;font-size:12px;" >
						<thead>
							<tr>
								<th>SI</th>
								<th>Category</th>
								<th>Inventory</th>
								<th>Unit</th>
								<th>Edit</th>
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
							</tr>
						</tfoot>   
					</table>
					<!-- /.table-responsive -->    
                </div>
            </div>
        </div>
    </div>


