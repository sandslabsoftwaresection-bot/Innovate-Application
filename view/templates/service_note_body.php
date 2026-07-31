<!-- content page -->
    <div class="container mt-2 main-container" >
            <div class="card">
                <div class="card-header text-white" style="background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);">
                    <div class="media w-100 ">
                        <figure class="avatar avatar-40 rounded-circle align-self-start ">
                            <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Generic placeholder image">
                        </figure>
                        <div class="media-body">
                            <h5 class="time-title mb-0  text-white">New Service Note</h5>
                            <p class="mb-0  text-white">Service Note #: <inno id="service_note_no_head"></inno></p>
                        </div>
                        <div class="dropdown " style="padding-left:50px;">
                            <button class="btn btn-sm btn-outline-light dropdown-toggle mb-2" type="button" id="dropdownMenuButton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                               Service Note List
                            </button>
                            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -101px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item ladda-button" href="#" onclick="openNavR()" id="btn_view_list_of_service_note" data-style="expand-right"><span class="ladda-label">List of Service Note</span><span class="ladda-spinner"></span></a>
                                <a class="dropdown-item" href="#" onclick="openNavRCancel()" id="btn_view_list_of_cancelled_service_note">Cancelled Service Note</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body py-0">
                    <div class="row" >
                        <div class="col-sm-12 col-md-6 col-lg-5" id='div_first'>
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
                                                    <input type="hidden" class="form-control form-control-sm" id="txt_service_note_company_name">
                                                    <input type="hidden" class="form-control form-control-sm" id="txt_service_note_company_id"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group custom-font">
                                        <div class="row" >
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>PO Box</label>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control form-control-sm" id="txt_service_note_po_box" readonly> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group custom-font">
                                        <div class="row" >
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Telephone</label>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control form-control-sm" id="txt_service_note_contact_no" readonly> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group custom-font">
                                        <div class="row" >
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Fax</label>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <input type="text" class="form-control form-control-sm" id="txt_service_note_fax" readonly> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group custom-font">
                                        <div class="row" >
                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Attn</label>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-8">
                                                <input type="text" class="form-control form-control-sm" id="txt_service_note_attn" readonly> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-sm-12 col-md-6 col-lg-2">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-5" id='div_second'>
                                <div class="card rounded-0 border-0 mb-5">
                                    <div class="card-body ">
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Service Note No</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control form-control-sm" value=" " style="color:black;font-weight:700" disabled id="txt_service_note_no"> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group custom-font">
                                            <div class="row" >
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                        <label>Date</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_service_note_date"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group custom-font">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-4">
                                                    <label>Service Type</label>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-8">
                                                    <div class="input-group mb-3" style="vertical-align:middle;"> 
                                                        <div id="div_service_select" style="width:80%">
                                                            <select class="chosen_select form-control form-control-sm">
                                                                <option>--Select Service--</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-primary" id="btn_add_service">Add</button>  
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
            </div>
        </div>
        
    <div class="container mt-12 main-container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-12">
                <div class="card rounded-0 border-0 mb-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-4 col-sm-12">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" style="color:black;font-weight:500" rows="2"></textarea>
                            </div>
                            <div class="col-md-3 mb-4 col-sm-12">
                                <label for="qty">Qty</label>
                                <input type="number" class="form-control" style="color:black;font-weight:500" id="qty"/>
                            </div>
                            <div class="col-md-2 mb-4 col-sm-12">
                                <div id="div_unit_select">
                                    <label for="qty">Unit</label>
                                <select class="form-control form-control-sm">
                                    <option>--Select Unit--</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-2 mb-4 col-sm-12">
                                <button class="btn btn-primary" style="margin-top: 30px;" id="add_btn">Add</button>
                            </div>
                            
                            <input type="hidden" class="form-control" id="txt_local_po_amount" aria-label="Local PO Amount" value="0.000">
                            <input type="hidden" class="form-control" id="txt_amt_after_discount" aria-label="Amount After Discount" value="0.000">
                            <input type="hidden" class="form-control" id="txt_net_amount" aria-label="Net Amount" value="0.000">
                            <input type="hidden" class="form-control" id="txt_total_quantity" aria-label="Total Quantity" value="0">
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
                    <div class="card-body " style="padding-top:5px;font-size:12px;overflow:auto;" id="div_service_note_child">
						<table id="tbl_child_service_note_list" class="display stripe cell-border" style="width:100%" style="padding-top:5px;font-size:12px">
							<thead>
								<tr>
                                    <th style="text-align: center;">SI</th>
                                    <th style="text-align: center;">Category ID</th>
                                    <th style="text-align: center;">Service Type</th>
                                    <th style="text-align: center;">Service ID</th>
                                    <th style="text-align: center;">Remarks</th>
                                    <th style="text-align: center;">Qty</th>
                                    <th style="text-align: center;">Unit</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
							</thead>
							<tbody>
			  
			  
							</tbody> 
						</table> 
                        <input type="hidden" id="hid_child_id">                             
                    </div>

                        <div class="card-footer">
                            <div class="row">
                                
                                 <div class="col-sm-12 col-md-2 col-lg-3">
                                    <button class="btn btn-secondary" id="btn_service_note_print_without_head"><i class="material-icons">print</i> Print Without Head</button>
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-2 col-lg-2">
                                    <button class="btn btn-dark" id="btn_service_note_pass_print_with_head"><i class="material-icons">print</i> Print With Head</button>
                                    
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                <!--    <button class="btn btn-info" id="btn_delivery_note_print"><i class="material-icons">print</i> Print</button>-->
                                    
                                    
                                </div>
                                 <div class="col-sm-12 col-md-6 col-lg-5" style="text-align:right">
                                    <button class="btn btn-primary" id="btn_generate_service_note"> <i class="material-icons">list</i>  Generate Service Note</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- content page ends -->
    <div id="mySidenavR" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
        <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
            <div class="card rounded-0 border-0 mb-12">
                <div class="card-header">
                    <div class="row ">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <h5 class="mb-0">List of Service Notes</h5>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2" style="text-align:right">
                            <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                            <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavR()"><span class="material-icons icon-sm">close</span></button>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                   <!-- <div class="row ">-->
                   <!--     <div class="col-sm-5 col-md-5 col-lg-5">-->
                   <!--         <label for="validationTooltip05">Start Date</label>-->
                   <!--         <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_start_date">-->
                   <!--     </div>-->
                   <!--     <div class="col-sm-5 col-md-5 col-lg-5" style="text-align:right">-->
                   <!--         <label for="validationTooltip05">End Date</label>-->
                   <!--         <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_end_date">-->
                   <!--     </div>-->
                   <!--     <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">-->
                   <!--         <button class="btn btn-info" id="btn_search_date"> <i class="material-icons">search</i> </button>-->
                   <!--     </div>-->
                   <!--</div>-->
                    Table
                    <table class="table " id="list_of_service_notes" class="custom-font" style="padding-top:5px;font-size:12px;">
                        <thead>
                            <tr class="custom-font">
                                <th style="display:none;">ID </th>
                                <th>Date </th>
                                <th>Service Note No </th>
                                <th>Company Name</th>
                                <th>Service Type</th>
                                <th>View </th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <!--<button class="btn btn-primary"> View</button>-->
                </div>
            </div>
        </div>
    </div>

    <!-- content page ends -->
    <div id="mySidenavRCancel" class="sidenavR " height="100%" style="background-color:white;z-index: 999">
        <div class="col-sm-12 col-md-12 col-lg-12" style="padding:0px">
            <div class="card rounded-0 border-0 mb-12">
                <div class="card-header">
                    <div class="row ">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                            <h5 class="mb-0">List of Cancelled Service Notes</h5>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2" style="text-align:right">
                            <!--<button type="button" class="mb-2 btn btn-sm btn-primary" onclick="closeNavR()">X</button>-->
                            <button class="btn btn-link p-0 chat-close vm header-color-secondary" onclick="closeNavRCancel()"><span class="material-icons icon-sm">close</span></button>
                        </div>
                    </div>
                </div>
                <div class="card-body " style="overflow:auto;">
                    <!--<div class="row ">-->
                    <!--    <div class="col-sm-5 col-md-5 col-lg-5">-->
                    <!--        <label for="validationTooltip05">Start Date</label>-->
                    <!--        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_start_date">-->
                    <!--    </div>-->
                    <!--    <div class="col-sm-5 col-md-5 col-lg-5" style="text-align:right">-->
                    <!--        <label for="validationTooltip05">End Date</label>-->
                    <!--        <input type="text" class="form-control datepicker" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="txt_cancel_end_date">-->
                    <!--    </div>-->
                    <!--    <div class="col-sm-2 col-md-2 col-lg-2" style="padding-top:29px">-->
                    <!--        <button class="btn btn-info" id="btn_cancel_search_date"> <i class="material-icons">search</i> </button>-->
                    <!--    </div>-->
                    <!--</div>-->
                    Table
                    <table class="table " id="list_of_cancel_service_notes" class="custom-font" style="padding-top:5px;font-size:12px;width:100%">
                        <thead>
                            <tr class="custom-font">
                                <th style="display:none;">ID </th>
                                <th>Date </th>
                                <th>Service Note No </th>
                                <th>Company Name</th>
                                <th>Service Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <!--<button class="btn btn-primary"> View</button>-->
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="modal_add_service" tabindex="-1" role="dialog" aria-labelledby="modalAddServiceLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- Added modal-lg here -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddServiceLabel">Add Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="serviceForm">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-10">
                                <label for="txt_service_name">Service Name</label>
                                <input type="text" class="form-control" id="txt_service_name" placeholder="Enter Service Name">
                                <input type="hidden" class="form-control" id="hidden_id">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" style="margin-top: 30px;" id="btn_save_service">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
                <table id="serviceTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Service Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>