<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 //$_SESSION['USERROLLID'] =  isset($_GET['userid']) ? $_GET['userid'] : null;

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
                    <li class="nav-item <?if($_GET['sm']==5){echo 'active';}?>">
                        <a href="dashboard.php?sm=5" class="nav-link"><i class="material-icons icon">dashboard</i><span>Dashboard</span></a>
                    </li>
                   <li class="nav-item <?if($_GET['sm']==1){echo 'active';}?>">
                    <a href="javascript:void(0);" class="nav-link classMasters dropdwown-toggle"><i class="material-icons icon">computer</i> <span>Masters</span><i class="material-icons icon arrow">expand_more</i></a>
                    <ul class="nav flex-column">
                         <li class="nav-item <?if($_GET['m']==13){echo 'active';}?>">
                            <a href="create_new_user.php?m=13&sm=1" class="nav-link classCreateNewUser pink-gradient-<?if($_GET['m']==13){echo 'active';}?>"><i class="material-icons icon"></i> <span>Create User</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==12){echo 'active';}?>">
                            <a href="roles_permission.php?m=12&sm=1" class="nav-link classSetPermissions pink-gradient-<?if($_GET['m']==12){echo 'active';}?>"><i class="material-icons icon"></i> <span>Set Permissions</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==2){echo 'active';}?>">
                            <a href="company_profile.php?m=2&sm=1" class="nav-link classCompanyProfile pink-gradient-<?if($_GET['m']==2){echo 'active';}?>"><i class="material-icons icon"></i> <span>Company Profile</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==1){echo 'active';}?>">
                            <a href="company.php?m=1&sm=1" class="nav-link classCompanyClients pink-gradient-<?if($_GET['m']==1){echo 'active';}?>"><i class="material-icons icon"></i> <span>Company/Clients</span></a>
                        </li>
                       <li class="nav-item <?if($_GET['m']==4){echo 'active';}?>">
                            <a href="projects.php?m=4&sm=1" class="nav-link classProjects pink-gradient-<?if($_GET['m']==4){echo 'active';}?>"><i class="material-icons icon"></i> <span>Projects</span></a>
                        </li>
                        
                        <li class="nav-item <?if($_GET['m']==6){echo 'active';}?>">
                            <a href="product_master.php?m=6&sm=1" class="nav-link classProductMaster pink-gradient-<?if($_GET['m']==6){echo 'active';}?>"><i class="material-icons icon"></i> <span>Product Master</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==7){echo 'active';}?>">
                            <a href="unit.php?m=7&sm=1" class="nav-link classUnits pink-gradient-<?if($_GET['m']==7){echo 'active';}?>"><i class="material-icons icon"></i> <span>Units</span></a>
                        </li>
                       
                        <li class="nav-item" <?if($_GET['m']==5){echo 'active';}?>>
                            <a href="subject.php?m=5&sm=1" class="nav-link classIntroduction pink-gradient-<?if($_GET['m']==5){echo 'active';}?>"><i class="material-icons icon"></i> <span>Introduction</span></a>
                        </li>
                         <li class="nav-item <?if($_GET['m']==3){echo 'active';}?>">
                            <a href="supplier.php?m=3&sm=1" class="nav-link classSuppliers pink-gradient-<?if($_GET['m']==3){echo 'active';}?>"><i class="material-icons icon"></i> <span>Suppliers</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==10){echo 'active';}?>">
                            <a href="inventory_category.php?m=10&sm=1" class="nav-link classInventoryCategory pink-gradient-<?if($_GET['m']==10){echo 'active';}?>"><i class="material-icons icon"></i> <span>Inventory Category</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==11){echo 'active';}?>">
                            <a href="inventory_item.php?m=11&sm=1" class="nav-link classInventoryItem pink-gradient-<?if($_GET['m']==11){echo 'active';}?>"><i class="material-icons icon"></i> <span>Inventory Item</span></a>
                        </li>
						<!--<li class="nav-item <?if($_GET['m']==9){echo 'active';}?>">-->
      <!--                      <a href="inventory.php?m=9&sm=1" class="nav-link pink-gradient-<?if($_GET['m']==9){echo 'active';}?>"><i class="material-icons icon"></i> <span>Inventory</span></a>-->
      <!--                  </li>-->
						<li class="nav-item <?if($_GET['m']==8){echo 'active';}?>">
                            <a href="amount_type.php?m=8&sm=1" class="nav-link classAmountType pink-gradient-<?if($_GET['m']==8){echo 'active';}?>"><i class="material-icons icon"></i> <span>Amount Type</span></a>
                        </li>
                       <li class="nav-item <?if($_GET['m']==15){echo 'active';}?>">
                            <a href="division_department.php?m=15&sm=1" class="nav-link classDivisionDepartment pink-gradient-<?if($_GET['m']==15){echo 'active';}?>"><i class="material-icons icon"></i> <span>Division/Department</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==16){echo 'active';}?>">
                            <a href="allowence_deductions.php?m=16&sm=1" class="nav-link classAllowenceDeduction pink-gradient-<?if($_GET['m']==16){echo 'active';}?>"><i class="material-icons icon"></i> <span>Allowance/Deduction</span></a>
                        </li>
                       
                    </ul>
                </li>
                
                <li class="nav-item <?if($_GET['sm']==2){echo 'active';}?>">
                    <a href="javascript:void(0);" class="nav-link classActivities dropdwown-toggle"><i class="material-icons icon">accessibility</i> <span>Activities</span><i class="material-icons icon arrow">expand_more</i></a>
                    <ul class="nav flex-column">
                        <!--<li class="nav-item <?//if($_GET['m']==1){echo 'active';}?>">-->
                        <!--    <a href="quotation.php?m=1&sm=2" class="nav-link pink-gradient-<?//if($_GET['m']==1){echo 'active';}?>"><i class="material-icons icon"></i> <span>Quotation Old</span></a>-->
                        <!--</li>-->
                         <li class="nav-item <?if($_GET['m']==7){echo 'active';}?>">
                            <a href="quotation_new.php?m=7&sm=2" class="nav-link classQuotation pink-gradient-<?if($_GET['m']==7){echo 'active';}?>"><i class="material-icons icon"></i> <span>Quotation</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==5){echo 'active';}?>">
                            <a href="work_order.php?m=5&sm=2" class="nav-link classWorkOrder pink-gradient-<?if($_GET['m']==5){echo 'active';}?>"><i class="material-icons icon"></i> <span>Work Order</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==6){echo 'active';}?>">
                            <a href="purchase_requisition.php?m=6&sm=2" class="nav-link classPurchaserequisition pink-gradient-<?if($_GET['m']==6){echo 'active';}?>"><i class="material-icons icon"></i> <span>Purchase Requisition</span></a>
                        </li>
                        <!--<li class="nav-item <?//if($_GET['m']==4){echo 'active';}?>">-->
                        <!--    <a href="local_po.php?m=4&sm=2" class="nav-link pink-gradient-<?//if($_GET['m']==4){echo 'active';}?>"><i class="material-icons icon"></i> <span>Local PO</span></a>-->
                        <!--</li>-->
						<li class="nav-item <?if($_GET['m']==14){echo 'active';}?>">
                            <a href="local_po_test.php?m=14&sm=2" class="nav-link classLocalpo pink-gradient-<?if($_GET['m']==14){echo 'active';}?>"><i class="material-icons icon"></i> <span>Local PO</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==7){echo 'active';}?>">
                            <a href="purchase_received.php?m=7&sm=2" class="nav-link classPurchaseRecieved pink-gradient-<?if($_GET['m']==7){echo 'active';}?>"><i class="material-icons icon"></i> <span>Purchase Received</span></a>
                        </li>
                        <!--<li class="nav-item <?//if($_GET['m']==16){echo 'active';}?>">-->
                        <!--    <a href="store_return.php?m=16&sm=2" class="nav-link pink-gradient-<?//if($_GET['m']==16){echo 'active';}?>"><i class="material-icons icon"></i> <span>Store Return</span></a>-->
                        <!--</li>-->
                        
						<!--<li class="nav-item <?//if($_GET['m']==10){echo 'active';}?>">-->
      <!--                      <a href="inventory_transfer.php?m=10&sm=2" class="nav-link pink-gradient-<?//if($_GET['m']==10){echo 'active';}?>"><i class="material-icons icon"></i> <span>Inventory Transfer</span></a>-->
      <!--                  </li>-->
						<!--<li class="nav-item <?//if($_GET['m']==11){echo 'active';}?>">-->
      <!--                      <a href="finished_products.php?m=11&sm=2" class="nav-link pink-gradient-<?//if($_GET['m']==11){echo 'active';}?>"><i class="material-icons icon"></i> <span>Finished Product</span></a>-->
      <!--                  </li>-->
                         
                         <li class="nav-item <?if($_GET['m']==3){echo 'active';}?>">
                            <a href="new_delivery_note.php?m=3&sm=2" class="nav-link classDeliveryNote pink-gradient-<?if($_GET['m']==3){echo 'active';}?>"><i class="material-icons icon"></i> <span>Delivery Note</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==10){echo 'active';}?>">
                            <a href="service_note.php?m=10&sm=2" class="nav-link classServiceNote pink-gradient-<?if($_GET['m']==10){echo 'active';}?>"><i class="material-icons icon"></i> <span>Service Note</span></a>
                        </li>
                        <!--<li class="nav-item <?//if($_GET['m']==2){echo 'active';}?>">-->
                        <!--    <a href="invoice.php?m=2&sm=2" class="nav-link pink-gradient-<?//if($_GET['m']==2){echo 'active';}?>"><i class="material-icons icon"></i> <span>Invoice</span></a>-->
                        <!--</li>-->
						<li class="nav-item <?if($_GET['m']==15){echo 'active';}?>">
                            <a href="intern_payment_app.php?m=15&sm=2" class="nav-link classInterimPayment pink-gradient-<?if($_GET['m']==15){echo 'active';}?>"><i class="material-icons icon"></i> <span>Interim Payment</span></a>
                        </li>
                         <li class="nav-item <?if($_GET['m']==2){echo 'active';}?>">
                            <a href="new_invoice.php?m=2&sm=2" class="nav-link classTaxInvoice pink-gradient-<?if($_GET['m']==2){echo 'active';}?>"><i class="material-icons icon"></i> <span>Tax Invoice</span></a>
                        </li>
						
                        <!--<li class="nav-item <?//if($_GET['m']==3){echo 'active';}?>">-->
                        <!--    <a href="delivery_note.php?m=3&sm=2" class="nav-link pink-gradient-<?//if($_GET['m']==3){echo 'active';}?>"><i class="material-icons icon"></i> <span>Delivery Note</span></a>-->
                        <!--</li>-->
                       
                        	
                        <li class="nav-item <?if($_GET['m']==5){echo 'active';}?>">
                            <a href="receipt.php?m=5&sm=2" class="nav-link classPaymentVoucher pink-gradient-<?if($_GET['m']==5){echo 'active';}?>"><i class="material-icons icon"></i> <span>Payment Voucher</span></a>
                        </li>
						
						
                        
                        <!--<li class="nav-item <?//if($_GET['m']==8){echo 'active';}?>">
                            <a href="gate_pass.php?m=8&sm=2" class="nav-link pink-gradient-<?//if($_GET['m']==8){echo 'active';}?>"><i class="material-icons icon"></i> <span>Gate Pass</span></a>
                        </li>-->
						<li class="nav-item <?if($_GET['m']==12){echo 'active';}?>">
                            <a href="issue_note.php?m=12&sm=2" class="nav-link classIssueNote pink-gradient-<?if($_GET['m']==12){echo 'active';}?>"><i class="material-icons icon"></i> <span>Issue Note</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==17){echo 'active';}?>">
                            <a href="gatepass_new.php?m=17&sm=2" class="nav-link classGatePass pink-gradient-<?if($_GET['m']==17){echo 'active';}?>"><i class="material-icons icon"></i> <span>Gate Pass</span></a>
                        </li>
						<li class="nav-item <?if($_GET['m']==9){echo 'active';}?>">
                            <a href="pass_in.php?m=9&sm=2" class="nav-link classPassIn pink-gradient-<?if($_GET['m']==9){echo 'active';}?>"><i class="material-icons icon"></i> <span>Pass In</span></a>
                        </li>
					    
                        
                        <!--<li class="nav-item <?//if($_GET['m']==12){echo 'active';}?>">-->
                        <!--    <a href="invoice_v3.php?m=12&sm=2" class="nav-link pink-gradient-<?//if($_GET['m']==12){echo 'active';}?>"><i class="material-icons icon"></i> <span>Invoice New</span></a>-->
                        <!--</li>-->
                        
                    </ul>
                </li>
                 <li class="nav-item <?if($_GET['sm']==3){echo 'active';}?>">
                    <a href="javascript:void(0);" class="nav-link classReports dropdwown-toggle"><i class="material-icons icon">menu</i> <span>Reports</span><i class="material-icons icon arrow">expand_more</i></a>
                    <ul class="nav flex-column">
                        <!--<li class="nav-item <?//if($_GET['m']==10){echo 'active';}?>">-->
                        <!--    <a href="inventory_material.php?m=10&sm=3" class="nav-link pink-gradient-<?//if($_GET['m']==10){echo 'active';}?>"><i class="material-icons icon"></i> <span>Consumable</span></a>-->
                        <!--</li>-->
						<!--<li class="nav-item <?//if($_GET['m']==11){echo 'active';}?>">-->
      <!--                      <a href="inventory_machinery.php?m=11&sm=3" class="nav-link pink-gradient-<?//if($_GET['m']==11){echo 'active';}?>"><i class="material-icons icon"></i> <span>Fixed</span></a>-->
      <!--                  </li>-->
						<!--<li class="nav-item <?//if($_GET['m']==12){echo 'active';}?>">-->
      <!--                      <a href="inventory_finished.php?m=12&sm=3" class="nav-link pink-gradient-<?//if($_GET['m']==12){echo 'active';}?>"><i class="material-icons icon"></i> <span>Finished</span></a>-->
      <!--                  </li>-->
                        <li class="nav-item <?if($_GET['m']==13){echo 'active';}?>">
                            <a href="store_report.php?m=13&sm=3" class="nav-link classStoreReport pink-gradient-<?if($_GET['m']==13){echo 'active';}?>"><i class="material-icons icon"></i> <span>Store Report</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==14){echo 'active';}?>">
                            <a href="supplier_report.php?m=14&sm=3" class="nav-link classSupplierReport pink-gradient-<?if($_GET['m']==14){echo 'active';}?>"><i class="material-icons icon"></i> <span>Supplier Report</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==15){echo 'active';}?>">
                            <a href="project_report.php?m=15&sm=3" class="nav-link classProjectReport pink-gradient-<?if($_GET['m']==15){echo 'active';}?>"><i class="material-icons icon"></i> <span>Project Report</span></a>
                        </li>
                        <!--<li class="nav-item <?if($_GET['m']==16){echo 'active';}?>">-->
                        <!--    <a href="salary_report.php?m=16&sm=3" class="nav-link classProjectReport pink-gradient-<?if($_GET['m']==16){echo 'active';}?>"><i class="material-icons icon"></i> <span>Salary Report</span></a>-->
                        <!--</li>-->
                        <li class="nav-item <?if($_GET['m']==17){echo 'active';}?>">
                            <a href="salary_consolidate.php?m=17&sm=3" class="nav-link classSalaryBreakupsOne pink-gradient-<?if($_GET['m']==17){echo 'active';}?>"><i class="material-icons icon"></i> <span>Salary Breakups 1</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==18){echo 'active';}?>">
                            <a href="salary_consolidate_normal.php?m=18&sm=3" class="nav-link classSalaryBreakupsTwo pink-gradient-<?if($_GET['m']==18){echo 'active';}?>"><i class="material-icons icon"></i> <span>Salary Breakups 2</span></a>
                        </li>
                        <li class="nav-item <?if($_GET['m']==19){echo 'active';}?>">
                            <a href="purchase_recieved_status.php?m=19&sm=3" class="nav-link classPurchaseRecievedStatus pink-gradient-<?if($_GET['m']==19){echo 'active';}?>"><i class="material-icons icon"></i> <span>PRD Status</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item <?if($_GET['sm']==20){echo 'active';}?>">
                    <a href="javascript:void(0);" class="nav-link classPayments dropdwown-toggle"><i class="material-icons icon">account_balance_wallet</i> <span>Accounts</span><i class="material-icons icon arrow">expand_more</i></a>
                    <ul class="nav flex-column">
                      <li class="nav-item <?if($_GET['m']==1){echo 'active';}?>">
                            <a href="accounts_ledger_project.php?m=1&sm=20" class="nav-link classPaymentSchedule pink-gradient-<?if($_GET['m']&&$_GET['sm']==20){echo 'active';}?>"><i class="material-icons icon"></i> <span>Transactions</span></a>
                      </li>
                      <li class="nav-item <?if($_GET['m']==1){echo 'active';}?>">
                            <a href="account_head.php?m=1&sm=21" class="nav-link classPaymentSchedule pink-gradient-<?if($_GET['m']&&$_GET['sm']==21){echo 'active';}?>"><i class="material-icons icon"></i> <span>Miscellaneous/Salary</span></a>
                      </li>
                      <li class="nav-item <?if($_GET['m']==1){echo 'active';}?>">
                            <a href="statement_of_accounts.php?m=1&sm=22" class="nav-link classPaymentSchedule pink-gradient-<?if($_GET['m']&&$_GET['sm']==22){echo 'active';}?>"><i class="material-icons icon"></i> <span>SOA</span></a>
                      </li>
                      
                     
                     </ul>
                </li>
                
                 <li class="nav-item <?if($_GET['sm']==4){echo 'active';}?>">
                    <a href="javascript:void(0);" class="nav-link classPayments dropdwown-toggle"><i class="material-icons icon">date_range</i> <span>Payments</span><i class="material-icons icon arrow">expand_more</i></a>
                    <ul class="nav flex-column">
                      <li class="nav-item <?if($_GET['m']==1){echo 'active';}?>">
                            <a href="payment_schedule_v1.php?m=1&sm=4" class="nav-link classPaymentSchedule pink-gradient-<?if($_GET['m']&&$_GET['sm']==4){echo 'active';}?>"><i class="material-icons icon"></i> <span>Payment Schedule</span></a>
                      </li>  
                      <li class="nav-item <?if($_GET['m']==2){echo 'active';}?>">
                            <a href="cashbook.php?m=2&sm=4" class="nav-link classCashBook pink-gradient-<?if($_GET['m']&&$_GET['sm']==4){echo 'active';}?>"><i class="material-icons icon"></i> <span>Cash Book</span></a>
                      </li> 
                     </ul>
                </li>
                
                
                <li class="nav-item <?if($_GET['sm']==6){echo 'active';}?>">
                    <a href="javascript:void(0);" class="nav-link classHR classPayments dropdwown-toggle"><i class="material-icons icon">business_center</i> <span>HR</span><i class="material-icons icon arrow">expand_more</i></a>
                    <ul class="nav flex-column">
                      <li class="nav-item <?if($_GET['m']==1){echo 'active';}?>">
                            <a href="employee_registration.php?m=1&sm=6" class="nav-link classEmployeeRegistration classPaymentSchedule pink-gradient-<?if($_GET['m']&&$_GET['sm']==6){echo 'active';}?>"><i class="material-icons icon"></i> <span>Employee Registration</span></a>
                      </li> 
                      <li class="nav-item <?if($_GET['m']==2){echo 'active';}?>">
                            <a href="salary.php?m=2&sm=6" class="nav-link classSalary pink-gradient-<?if($_GET['m']&&$_GET['sm']==6){echo 'active';}?>"><i class="material-icons icon"></i> <span>Salary</span></a>
                        </li>
                     </ul>
                </li>
                
                
                
                <li class="nav-item <?if($_GET['sm']==7){echo 'active';}?>">
                    <a href="javascript:void(0);" class="nav-link classDBEdit dropdwown-toggle"><i class="material-icons icon">edit</i> <span>DB Edit</span><i class="material-icons icon arrow">expand_more</i></a>
                    <ul class="nav flex-column">
                      <li class="nav-item <?if($_GET['m']==1){echo 'active';}?>">
                            <a href="lpo_cat_edit.php?m=1&sm=7" class="nav-link classDBEdit pink-gradient-<?if($_GET['m']&&$_GET['sm']==7){echo 'active';}?>"><i class="material-icons icon"></i> <span>LPO Edit</span></a>
                      </li> 
                      <!--<li class="nav-item <?//if($_GET['m']==2){echo 'active';}?>">-->
                      <!--      <a href="salary.php?m=2&sm=6" class="nav-link classSalary pink-gradient-<?//if($_GET['m']&&$_GET['sm']==6){echo 'active';}?>"><i class="material-icons icon"></i> <span>Salary</span></a>-->
                      <!--  </li>-->
                     </ul>
                </li>
            </ul>
        </div>