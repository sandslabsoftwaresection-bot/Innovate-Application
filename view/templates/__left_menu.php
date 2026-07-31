<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
 <div class="sidebar sidebar-left">
            <ul class="nav flex-column">
                <!--<li class="nav-item">-->
                <!--    <a href="javascript:void(0);" class="nav-link dropdwown-toggle"><i class="material-icons icon">dashboard</i> <span>Dashboard</span><i class="material-icons icon arrow">expand_more</i></a>-->
                <!--    <ul class="nav flex-column">-->
                <!--        <li class="nav-item">-->
                <!--            <a href="index.php" class="nav-link pink-gradient-active"><i class="material-icons icon"></i> <span>Dashboard</span></a>-->
                <!--        </li>-->
                <!--    </ul>-->
                <!--</li>-->
                   <li class="nav-item <?if($_GET['sm']==1){echo 'active';}?>">
                    <a href="javascript:void(0);" class="nav-link dropdwown-toggle"><i class="material-icons icon">computer</i> <span>Masters</span><i class="material-icons icon arrow">expand_more</i></a>
                    <ul class="nav flex-column">
                        <li class="nav-item <?if($_GET['m']==2){echo 'active';}?>">
                            <a href="company_profile.php?m=2&sm=1" class="nav-link pink-gradient-<?if($_GET['m']==2){echo 'active';}?>"><i class="material-icons icon"></i> <span>Company Profile</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==1){echo 'active';}?>">
                            <a href="company.php?m=1&sm=1" class="nav-link pink-gradient-<?if($_GET['m']==1){echo 'active';}?>"><i class="material-icons icon"></i> <span>Company/Clients</span></a>
                        </li>
                       <li class="nav-item <?if($_GET['m']==4){echo 'active';}?>">
                            <a href="projects.php?m=4&sm=1" class="nav-link pink-gradient-<?if($_GET['m']==4){echo 'active';}?>"><i class="material-icons icon"></i> <span>Projects</span></a>
                        </li>
                        
                        <li class="nav-item <?if($_GET['m']==6){echo 'active';}?>">
                            <a href="product_master.php?m=6&sm=1" class="nav-link pink-gradient-<?if($_GET['m']==6){echo 'active';}?>"><i class="material-icons icon"></i> <span>Product Master</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==7){echo 'active';}?>">
                            <a href="unit.php?m=7&sm=1" class="nav-link pink-gradient-<?if($_GET['m']==7){echo 'active';}?>"><i class="material-icons icon"></i> <span>Units</span></a>
                        </li>
                       
                        <li class="nav-item" <?if($_GET['m']==5){echo 'active';}?>>
                            <a href="subject.php?m=5&sm=1" class="nav-link pink-gradient-<?if($_GET['m']==5){echo 'active';}?>"><i class="material-icons icon"></i> <span>Introduction</span></a>
                        </li>
                         <!--<li class="nav-item <?if($_GET['m']==3){echo 'active';}?>">
                            <a href="supplier.php?m=3&sm=1" class="nav-link pink-gradient-<?if($_GET['m']==3){echo 'active';}?>"><i class="material-icons icon"></i> <span>S-->
							
							<ul>