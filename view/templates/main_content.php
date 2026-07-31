 <div class="container mt-4 main-container">
            
        <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="content-color-secondary mb-0">No of Requisitions <span class="text-success float-right"><i class="material-icons icon-sm">arrow_drop_up</i> 15</span></p>
                                    <h4 class="content-color-primary mb-3">20</h4>
                                </div>
                            </div>
                            <div class="progress progress-small">
                                <div class="progress-bar bg-success col-6" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="media">
                                <div class="icon-circle icon-50 bg-light-danger mr-3">
                                    <i class="material-icons">settings</i>
                                </div>
                                <div class="media-body">
                                    <p class="content-color-secondary mb-0">Raw Material<span class="text-danger float-right"><i class="material-icons icon-sm">arrow_drop_down</i> 250</span></p>
                                    <h4 class="content-color-primary mb-3"> 1506.00 <small style="font-size:9px;">BHD</small></h4>
                                </div>
                            </div>
                            <div class="progress progress-small">
                                <div class="progress-bar bg-danger col-6" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="media">
                                <div class="icon-rounded icon-50 bg-light-warning mr-3">
                                    <i class="material-icons">account_balance_wallet</i>
                                </div>
                                <div class="media-body">
                                    <p class="content-color-secondary mb-0">Shortage Balance</p>
                                    <h4 class="content-color-primary mb-3">26</h4>
                                </div>
                            </div>
                            <div class="progress progress-small">
                                <div class="progress-bar bg-warning col-6" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="icon-rounded icon-50 shadow-light primary-gradient top-right-icon">
                                <i class="material-icons">account_balance</i>
                            </div>
                            <div class="media">
                                <div class="media-body">
                                    <p class="content-color-secondary mb-0">Profit Target</p>
                                    <h4 class="content-color-primary mb-3">40% <small class="content-color-secondary">achieved</small></h4>
                                </div>
                            </div>
                            <div class="progress progress-small">
                                <div class="progress-bar bg-primary col-4" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
       <div class="row"> 
       <div class="col-12 col-md-6 col-lg-3">
                	<?PHP 
            
                        $con = mysqli_connect("localhost","sianlab_zaedon","s@nds1@b","sianlab_zaedon");
                        
                             // $con = mysqli_connect("localhost","madonnam_admin","s@nds1@b","madonnam_db");
                        
                              if (mysqli_connect_errno())
                                {
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                                }
                              
                            
            
            
                  ?>        
            
                    <?PHP 
                            
                          $result = mysqli_query($con,"SELECT count(*) as count from requisition_note where requisition_note_status='Confirmed' ");
                                while($row=mysqli_fetch_assoc($result)) {
                                    	$str=$str.$row['count'];  
                                }
                            
                           if($str>0)
                           {
                    
                    ?>
           
                
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="img/birtmsg.png" class="mw-100 mx-auto mb-3" alt="">
                            </div>
                            <h1 class="font-weight-light">Request Received!</h1>
                        </div>
                        <div class="card-footer">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="content-color-primary mb-0">Request ID : 5246</h5>
                                    <p class="content-color-secondary mb-0 small">Waiting for Approvel</p>
                                </div>
                                <a href="" class="icon-circle icon-40 content-color-secondary">
                                    <i class="material-icons icon-lg">keyboard_arrow_right</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                      <? } else {?>
                 
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="img/norequest.png" class="mw-100 mx-auto mb-3" alt="">
                            </div>
                            <h1 class="font-weight-light">No Request</h1>
                        </div>
                        <div class="card-footer">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="content-color-primary mb-0">Request ID : NA</h5>
                                    <p class="content-color-secondary mb-0 small">Waiting for Request</p>
                                </div>
                                <a href="" class="icon-circle icon-40 content-color-secondary">
                                    <i class="material-icons icon-lg">keyboard_arrow_right</i>
                                </a>
                            </div>
                        </div>
                    </div>
                
                <?PHP } ?>
                
                </div>
                <div class="col-12 col-md-6 col-lg-9">
                    <div class="card mb-4 fullscreen">
                        <div class="card-header">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="content-color-primary mb-0">Request History</h4>
                                </div>
                                <a href="javascript:void(0);" class="icon-circle icon-30 content-color-secondary fullscreenbtn">
                                    <i class="material-icons ">crop_free</i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table border-bottom mb-0 ">
                                <thead class="d-none">
                                    <tr>
                                        <th>Request</th>
                                        <th data-breakpoints="xs">Total</th>
                                        <th data-breakpoints="xs sm">Status</th>
                                        <th data-breakpoints="xs sm">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="icon-circle icon-50 bg-light-primary mr-3">
                                                    <i class="material-icons">business</i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="my-0 mt-1">Project 1</h6>
                                                    <p class="small">By Anisha Icara</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="my-0 mt-1">3250</h6>
                                            <p class="content-color-secondary small mb-0">Approved By QC</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="btn btn-rounded btn-outline-success px-3 btn-sm">2nd Approved</span>
                                        </td>
                                        <td class="text-center">
                                            <b>250</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="icon-circle icon-50 bg-light-primary mr-3">
                                                    <i class="material-icons">business</i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="my-0 mt-1">Site 3</h6>
                                                    <p class="small">By Rincy</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="my-0 mt-1">1250</h6>
                                            <p class="content-color-secondary small mb-0">Approved By Service Engg</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="btn btn-rounded btn-outline-danger px-3 btn-sm">Waiting</span>
                                        </td>
                                        <td class="text-center">
                                            <b>250</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="icon-circle icon-50 bg-light-primary mr-3">
                                                    <i class="material-icons">business</i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="my-0 mt-1">Site 2</h6>
                                                    <p class="small">By Ebin Rose</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="my-0 mt-1">5250</h6>
                                            <p class="content-color-secondary small mb-0">Sent to Store</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="btn btn-rounded btn-outline-warning px-3 btn-sm">On Processing</span>
                                        </td>
                                        <td class="text-center">
                                            <b>250</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                
                
                
                
                
                
                
            </div>
</div>