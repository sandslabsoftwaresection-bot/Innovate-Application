<?php

	include('../model/db_connection/connection.php');

	$DBConn1 = new DBConnection();
	$varDBConnection1 = $DBConn1->ConnectToMYSQL();
	$fetch_unit = mysqli_query($varDBConnection1, "SELECT * FROM unit_master");
	$fetch_category = mysqli_query($varDBConnection1, "SELECT ids,cat_name FROM inventory_main_category WHERE status='Active'");

?> 
<style>
.input-group-prepend .btn, .input-group-append .btn {
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
						<h5 class="time-title mb-0  text-white">Inventory Item</h5>
					</div>
				   
					
					<div class="dropdown " style="padding-left:50px;">
						<button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							Inventory Item List
						</button>
						<div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
							<a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_inventory" data-style="expand-right"><span class="ladda-label">List of Inventory Item</span><span class="ladda-spinner"></span></a>
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
                                    <!--<div class="row">-->
                                    <!--    <div  class="col-sm-12 col-md-10 col-lg-10">-->
                                    <!--    </div>-->
                                    <!--    <div  class="col-sm-12 col-md-2 col-lg-2">-->
                                    <!--        <label>Item Code</label><br>-->
                                    <!--        <input  type="text" class="form-control form-control-sm" name="txt_item_code" id="txt_item_code" disabled>-->
                                    <!--    </div>-->
                                    <!--</div>-->
									<div class="row">
									    <div class="col-sm-12 col-md-3 col-lg-3">
                                           <label>Inventory Category</label><br>
										
            
                                            <div class="input-group mb-3" style="vertical-align:middle;"> 
                                            	<div id="div_category_load_pur_recie" style="width:70%">
                                            		  <select  id="select_iventory_category" name="select_iventory_category" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
                                            		 </select>
                                            	</div>
                                            	<div class="input-group-append">
                                            		<button class="btn btn-primary" id="btn_add_category">Add</button>
                                            	</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3">
                                            <label>Inventory Sub Category</label><br>
                                            <div class="input-group mb-3" style="vertical-align:middle;"> 
                                                <div style="width:70%">
                                                    <select id="select_inventory_sub_category" name="select_inventory_sub_category" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                                                        <option value="0">Select Sub Category</option>
                                                    </select>
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" id="btn_add_sub_category">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 col-lg-3">
                                            <label>Inventory Item Name</label><br>
                                            <div class="input-group mb-3" style="vertical-align:middle;"> 
                                                <div style="width:70%" id="div_select_item_name">
                                                    <select id="select_item_name" name="select_item_name" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                                                        <option value="0">Select Item Name</option>
                                                    </select>
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" id="btn_add_item_name">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                        
            <!--                            <div class="col-sm-12 col-md-3 col-lg-3">-->
            <!--                                <label>Inventory Item Name</label><br>-->
												<!--<textarea class="form-control" name="txt_item_name" id="txt_item_name" rows="1"></textarea>-->
            <!--                            </div>-->
                                        
                                        
                                        <div class="col-sm-12 col-md-2 col-lg-2">
                                            <label>Unit</label><br>
											<select class="form-control form-control-sm" id="select_unit">
												<option value="0">Select Unit</option>
												<?php while($row = mysqli_fetch_assoc($fetch_unit)) { ?>
												<option value="<?php echo $row['unit_id']; ?>"><?php echo $row['unit_name']; ?></option>
												<?php } ?>
											</select>
                                        </div>
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
										<!--<button class="btn btn-warning" id="btn_edit_inventory" style="color: white;"><i class="material-icons">list</i>Update</button>-->
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
							<h5 class="mb-0">List of Inventory Item</h5>
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
								<th>Sub Category</th>
								<th>Item Name</th>
								<th>Item Code</th>
								<th>Unit</th>
								<th>Status</th>
								<!--<th>View</th>-->
								
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
								<!--<th></th>-->
							
							</tr>
						</tfoot>   
					</table>
					<!-- /.table-responsive -->    
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_category_add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
				<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            <div class="modal-body">
                <div id="error_msg"></div> 
                    <div class="row">
						<div class="col-sm-12 col-md-9 col-lg-9">
							<label>Category Name</label>
							<input type="text" class="form-control" placeholder="" id="txt_category_name">
						</div>	
                    </div>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
				<button type="button" class="btn btn-primary" id="btn_category_save">Save</button>
			</div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalSubCategoryLabel" aria-hidden="true" id="modal_sub_category_add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Sub Category</h5>
                <button type="button" class="close" data-dismiss="modal" id="btn_sub_close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="sub_error_msg"></div> 
                <div class="row">
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <label>Sub Category Name</label>
                        <input type="text" class="form-control" placeholder="" id="txt_sub_category_name">
                        <input type="hidden" id="sub_main_cat_id"> <!-- Will store selected category ID -->
                    </div>	
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_sub_category_save">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalItemNameLabel" aria-hidden="true" id="modal_item_name_add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Item Name</h5>
                <button type="button" class="close" data-dismiss="modal" id="btn_sub_close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="sub_error_msg"></div> 
                <div class="row">
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <label>Item Name</label>
                        <input type="text" class="form-control" placeholder="" id="txt_item_name">
                       
                    </div>	
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_item_name_save">Save</button>
            </div>
        </div>
    </div>
</div>
  

