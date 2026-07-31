<?php

	include('../model/db_connection/connection.php');

	$DBConn1 = new DBConnection();
	$varDBConnection1 = $DBConn1->ConnectToMYSQL();
	$fetch_unit2 = mysqli_query($varDBConnection1, "SELECT * FROM unit_master");

?>


    <div class="container mt-12 main-container">
            <div class="row ">
                <div class="col-sm-12 col-md-6 col-lg-12">
                    <div class="card rounded-0 border-0 mb-12">
                        
                        <div class="card-body " style="padding-top:5px;font-size:12px">
                           
						<!--<div id="show_details"> 		-->
                           
                                <table id="tbl_lpo_edit" class="table table-striped table-bordered" style="width:100%" style="padding-top:5px;font-size:12px">
                                <thead>
                                    <tr>
                                       <th>SI</th>
                                        <th>Category Name</th>
                                        <th>Item Name</th>
                                        <th>Category Id</th>
                                        <th>Item Id</th>
                                        <th>Item Code</th>
                                        <th>Unit</th>
                                        <th>Description</th>
                                        <th>save</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                <!-- <tfoot>-->
                                <!--    <tr>-->
                                <!--        <th></th>-->
                                <!--        <th></th>-->
                                <!--        <th></th>-->
                                <!--        <th></th>-->
                                <!--        <th></th>-->
                                       
                                <!--    </tr>-->
                                <!--</tfoot>-->
                               
                            </table>
                        <!--</div> -->
                    </div>  
                        <div class="card-footer">
                            <div class="row ">
                                
                                <input type="hidden" id="category_id">
                                <input type="hidden" id="category_name">
                                <input type="hidden" id="item_id">
                                <input type="hidden" id="item_name">
                                <input type="hidden" id="item_code">
                                
                                <!--<div class="col-sm-12 col-md-2 col-lg-3">-->
                                <!--    <button class="btn btn-secondary" id="btn_print_without_head"><i class="material-icons">print</i> Print Without Head</button>-->
                                    
                                <!--</div>-->
                                <!-- <div class="col-sm-12 col-md-2 col-lg-2">-->
                                <!--    <button class="btn btn-dark" id="btn_print_with_head"><i class="material-icons">print</i> Print With Head</button>-->
                                    
                                <!--</div>-->
								<!--<div class="col-sm-12 col-md-2 col-lg-2">-->
        <!--                            <button class="btn btn-info" id="btn_local_po_export_excel"><i class="material-icons">exit_to_app</i> Export to Excel</button>-->
        <!--                        </div>-->
                                 
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_category_add">
        <div class="modal-dialog modal-xl" role="document" style="max-width: 60%;">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row" style="padding:10px;">
							<div class="form-group custom-font">
                                            <div class="row" >
                                              
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                   <label>Inventory Category</label><br>
                                                    
                                                    <div class="input-group mb-3" style="vertical-align:middle;width:100%" id="cat_div"> 
                                                    	 <input type="text" class="form-control" id="txt_category">
                                                    	<div class="input-group-append">
                                                    		<button class="btn btn-warning" id="btn_save_cat">Add</button>
                                                    	</div>
                                                    </div>
                                                   
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    	
                        </div>
                        <div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
        					<!--<button type="button" class="btn btn-primary" id="btn_add_item_mod">Save</button>-->
        				</div>
                </div>
			
            </div>
        </div>
        
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_item_add">
        <div class="modal-dialog modal-xl" role="document" style="max-width: 60%;">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add item</h5>
					<button type="button" class="close" data-dismiss="modal" id="btn_top_reissue_close" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
                </div>
                <div class="modal-body">
                    <div id="error_msg"></div> 
                        <div class="row" style="padding:10px;">
							<div class="form-group custom-font">
                                            <div class="row" >
                                              
                                                <div class="col-sm-12 col-md-5 col-lg-5">
                                                   <label>Inventory Category</label><br>
                                                    <!--<div class="input-group mb-3" style="vertical-align:middle;width:100%"> -->
                                                    	<div id="div_category_load_pur_recie">
                                                    		  <select  id="select_iventory_category" name="select_iventory_category" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-1"  aria-hidden="true">
                                                    		 </select>
                                                    	</div>
                                                    	<!--<div class="input-group-append">-->
                                                    		<!--<button class="btn btn-primary" id="btn_add_category">Add</button>-->
                                                    	<!--</div>-->
                                                    <!--</div>-->
                                                    
                                                </div>
                                                
                                                <div class="col-sm-12 col-md-2 col-lg-2">
                                                    <label>Unit</label>
                                                    <select class="form-control form-control-sm" id="select_product_unit" style="width:100%;">
                                                        <option value="0">--Select Unit--</option>
														<?php while($row1 = mysqli_fetch_assoc($fetch_unit2)) { ?>
														<option value="<?php echo $row1['unit_id']; ?>"><?php echo $row1['unit_name']; ?></option>
														<?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-sm-12 col-md-5 col-lg-5">
                                                    <label>Inventory Item Name</label><br>
        												<textarea class="form-control" name="txt_item_name" id="txt_item_name" rows="1"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    	
                        </div>
                        <div class="modal-footer">
        					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reissue_close">Close</button>
        					<button type="button" class="btn btn-primary" id="btn_add_item_mod">Save</button>
        				</div>
                </div>
			
            </div>
        </div>
        
        