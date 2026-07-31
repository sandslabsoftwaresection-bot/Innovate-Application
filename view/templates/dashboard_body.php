<?PHP session_start();?>
<div class="container mt-3 main-container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card mb-4 success-gradient">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-white mb-0">Company</p>
                                    <h4 class="mb" id="txt_company_count"></h4>
                                </div>
                                <div class="icon-circle icon-50 bg-light-white">
                                    <i class="material-icons">assignment_turned_in</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card mb-4 danger-gradient">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-white mb-0">Suppliers</p>
                                    <h4 class="text-white mb" id="txt_supplier_count"></h4>
                                </div>
                                <div class="icon-circle icon-50 bg-light-white">
                                    <i class="material-icons">assignment_returned</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card mb-4 warning-gradient">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-white mb-0">Projects</p>
                                    <h4 class="text-white mb" id="txt_projects_count"></h4>
                                </div>
                                <div class="icon-circle icon-50 bg-light-white">
                                    <i class="material-icons">verified_user</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card mb-4 primary-gradient">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-white mb-0">Users</p>
                                    <h4 class="text-white mb" id="txt_user_count"></h4>
                                </div>
                                <div class="icon-circle icon-50 bg-light-white">
                                    <i class="material-icons">assignment_ind</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <div class="row justify-content-center">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card mb-4 pink-gradient">
                        <div class="card-body text-center">
                            <div class="row align-items-center no-gutters">
                                <a href="#" class="col">
                                    <p class="content-color-secondary mb-0">Welcome</p>
                                </a>
                            </div>
                            <h5 class="card-title mb-2 content-color-primary text-center"><?PHP echo ucfirst($_SESSION["user_real_name"])?></h5>
                            <h6 class="card-subtitle mb-3 text-center text-uppercase"><?PHP echo ucfirst($_SESSION["user_username"])?></h6>
                        </div>   
                        <!--<div class="card-footer border-top text-center">-->
                        <!--    <a href="" class="content-color-secondary mx-2"><img class="border-0 vm" src="img/twitter.png" alt=""></a>-->
                        <!--    <a href="" class="content-color-secondary mx-2"><img class="border-0 vm" src="img/facebook.png" alt=""></a>-->
                        <!--    <a href="" class="content-color-secondary mx-2"><img class="border-0 vm" src="img/linkedin.png" alt=""></a>-->
                        <!--    <a href="" class="content-color-secondary mx-2"><img class="border-0 vm" src="img/pinterest.png" alt=""></a>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>       
        </div>
        
        
       