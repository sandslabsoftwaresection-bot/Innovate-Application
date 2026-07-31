
$(document).ready(function() {
    // Your JavaScript code here
    function hasPermission(permission) {
        return permissions.includes(permission);
    }
    
    window.hasPermission = hasPermission;

    // Hide controls based on permissions
//     var addActionButtons = document.querySelectorAll(".addAction");
//     var editActionButtons = document.querySelectorAll(".editAction");
//     var deleteActionButtons = document.querySelectorAll(".deleteAction");
//     var listActionButtons = document.querySelectorAll(".listAction");
// 	var saveActionButtons = document.querySelectorAll(".saveAction");
// 	var printActionButtons = document.querySelectorAll(".printAction");
// 	var uploadActionButtons = document.querySelectorAll(".uploadAction");
// 	var exportToExcelActionButtons = document.querySelectorAll(".exportToExcelAction");
// 	var exportToPDFActionButtons = document.querySelectorAll(".exportToPDFAction");
	



	var eventQuotation = document.querySelectorAll(".classQuotation");

	var eventPurchaserequisition = document.querySelectorAll(".classPurchaserequisition");

	var eventLocalpo = document.querySelectorAll(".classLocalpo");

	var eventPurchaseRecieved = document.querySelectorAll(".classPurchaseRecieved");

	var eventWorkOrder = document.querySelectorAll(".classWorkOrder");

	var eventDeliveryNote = document.querySelectorAll(".classDeliveryNote");

	var eventInterimPayment = document.querySelectorAll(".classInterimPayment");

	var eventTaxInvoice = document.querySelectorAll(".classTaxInvoice");

	var eventPaymentVoucher = document.querySelectorAll(".classPaymentVoucher");

	var eventIssueNote = document.querySelectorAll(".classIssueNote");

	var eventGatePass = document.querySelectorAll(".classGatePass");

	var eventPassIn = document.querySelectorAll(".classPassIn");

	var eventStoreReport = document.querySelectorAll(".classStoreReport");

	var eventSupplierReport = document.querySelectorAll(".classSupplierReport");

	var eventProjectReport = document.querySelectorAll(".classProjectReport");

	var eventCompanyProfile = document.querySelectorAll(".classCompanyProfile");

	var eventCompanyClients = document.querySelectorAll(".classCompanyClients");

	var eventProjects = document.querySelectorAll(".classProjects");

	var eventProductMaster = document.querySelectorAll(".classProductMaster");

	var eventUnits = document.querySelectorAll(".classUnits");

	var eventIntroduction = document.querySelectorAll(".classIntroduction");

	var eventSuppliers = document.querySelectorAll(".classSuppliers");

	var eventInventoryCategory = document.querySelectorAll(".classInventoryCategory");

	var eventInventoryItem = document.querySelectorAll(".classInventoryItem");

	var eventAmountType = document.querySelectorAll(".classAmountType");

	var eventCreateNewUser = document.querySelectorAll(".classCreateNewUser");

	var eventSetPermissions = document.querySelectorAll(".classSetPermissions");


	var eventActivities = document.querySelectorAll(".classActivities");

	var eventMasters = document.querySelectorAll(".classMasters");

	var eventReports = document.querySelectorAll(".classReports");

	var eventPayments = document.querySelectorAll(".classPayments");

	var eventPaymentSchedule = document.querySelectorAll(".classPaymentSchedule");

	var eventHR = document.querySelectorAll(".classHR");

	var eventEmployeeRegistration = document.querySelectorAll(".classEmployeeRegistration");

	var eventAllowenceDeduction = document.querySelectorAll(".classAllowenceDeduction");

	var eventDivisionDepartment = document.querySelectorAll(".classDivisionDepartment");

	var eventSalary = document.querySelectorAll(".classSalary");

	var eventCashBook = document.querySelectorAll(".classCashBook");

	var eventSalaryBreakupsOne = document.querySelectorAll(".classSalaryBreakupsOne");

	var eventSalaryBreakupsTwo = document.querySelectorAll(".classSalaryBreakupsTwo");

	var eventPurchaseRecievedStatus = document.querySelectorAll(".classPurchaseRecievedStatus");

	var eventDBEdit = document.querySelectorAll(".classDBEdit");
	
	var eventServiceNote = document.querySelectorAll(".classServiceNote");
	// add_new_var
	
		// Donot Remove The above line 



//     addActionButtons.forEach(function(obj) {
//             obj.style.display = "none";
//         }
//     });

//     editActionButtons.forEach(function(obj) {
//             obj.style.display = "none";
//         }
//     });

//     deleteActionButtons.forEach(function(obj) {
//             obj.style.display = "none";
//         }
//     });

//     listActionButtons.forEach(function(obj) {
//             obj.style.display = "none";
//         }
//     });
	
// 	saveActionButtons.forEach(function(obj) {
//             obj.style.display = "none";
//         }
//     });
    
// 	uploadActionButtons.forEach(function(obj) {
//             obj.style.display = "none";
//         }
//     });
	
// 	printActionButtons.forEach(function(obj) {
//             obj.style.display = "none";
//         }
//     });
	
// 	exportToExcelActionButtons.forEach(function(obj) {
//             obj.style.display = "none";
//         }
//     });
	
// 	exportToPDFActionButtons.forEach(function(obj) {
//             obj.style.display = "none";
//         }
//     });
	





	eventQuotation.forEach(function(obj) {if (!hasPermission("Quotation")) {obj.style.display = "none";}});

	eventPurchaserequisition.forEach(function(obj) {if (!hasPermission("Purchaserequisition")) {obj.style.display = "none";}});

	eventLocalpo.forEach(function(obj) {if (!hasPermission("Localpo")) {obj.style.display = "none";}});

	eventPurchaseRecieved.forEach(function(obj) {if (!hasPermission("PurchaseRecieved")) {obj.style.display = "none";}});

	eventWorkOrder.forEach(function(obj) {if (!hasPermission("WorkOrder")) {obj.style.display = "none";}});

	eventDeliveryNote.forEach(function(obj) {if (!hasPermission("DeliveryNote")) {obj.style.display = "none";}});

	eventInterimPayment.forEach(function(obj) {if (!hasPermission("InterimPayment")) {obj.style.display = "none";}});

	eventTaxInvoice.forEach(function(obj) {if (!hasPermission("TaxInvoice")) {obj.style.display = "none";}});

	eventPaymentVoucher.forEach(function(obj) {if (!hasPermission("PaymentVoucher")) {obj.style.display = "none";}});

	eventIssueNote.forEach(function(obj) {if (!hasPermission("IssueNote")) {obj.style.display = "none";}});

	eventGatePass.forEach(function(obj) {if (!hasPermission("GatePass")) {obj.style.display = "none";}});

	eventPassIn.forEach(function(obj) {if (!hasPermission("PassIn")) {obj.style.display = "none";}});

	eventStoreReport.forEach(function(obj) {if (!hasPermission("StoreReport")) {obj.style.display = "none";}});

	eventSupplierReport.forEach(function(obj) {if (!hasPermission("SupplierReport")) {obj.style.display = "none";}});

	eventProjectReport.forEach(function(obj) {if (!hasPermission("ProjectReport")) {obj.style.display = "none";}});

	eventCompanyProfile.forEach(function(obj) {if (!hasPermission("CompanyProfile")) {obj.style.display = "none";}});

	eventCompanyClients.forEach(function(obj) {if (!hasPermission("CompanyClients")) {obj.style.display = "none";}});

	eventProjects.forEach(function(obj) {if (!hasPermission("Projects")) {obj.style.display = "none";}});

	eventProductMaster.forEach(function(obj) {if (!hasPermission("ProductMaster")) {obj.style.display = "none";}});

	eventUnits.forEach(function(obj) {if (!hasPermission("Units")) {obj.style.display = "none";}});

	eventIntroduction.forEach(function(obj) {if (!hasPermission("Introduction")) {obj.style.display = "none";}});

	eventSuppliers.forEach(function(obj) {if (!hasPermission("Suppliers")) {obj.style.display = "none";}});

	eventInventoryCategory.forEach(function(obj) {if (!hasPermission("InventoryCategory")) {obj.style.display = "none";}});

	eventInventoryItem.forEach(function(obj) {if (!hasPermission("InventoryItem")) {obj.style.display = "none";}});

	eventAmountType.forEach(function(obj) {if (!hasPermission("AmountType")) {obj.style.display = "none";}});

	eventCreateNewUser.forEach(function(obj) {if (!hasPermission("CreateNewUser")) {obj.style.display = "none";}});

	eventSetPermissions.forEach(function(obj) {if (!hasPermission("SetPermissions")) {obj.style.display = "none";}});


	eventActivities.forEach(function(obj) {if (!hasPermission("Activities")) {obj.style.display = "none";}});

	eventMasters.forEach(function(obj) {if (!hasPermission("Masters")) {obj.style.display = "none";}});

	eventReports.forEach(function(obj) {if (!hasPermission("Reports")) {obj.style.display = "none";}});

	eventPayments.forEach(function(obj) {if (!hasPermission("Payments")) {obj.style.display = "none";}});

	eventPaymentSchedule.forEach(function(obj) {if (!hasPermission("PaymentSchedule")) {obj.style.display = "none";}});

	eventHR.forEach(function(obj) {if (!hasPermission("HR")) {obj.style.display = "none";}});

	eventEmployeeRegistration.forEach(function(obj) {if (!hasPermission("EmployeeRegistration")) {obj.style.display = "none";}});

	eventAllowenceDeduction.forEach(function(obj) {if (!hasPermission("AllowenceDeduction")) {obj.style.display = "none";}});

	eventDivisionDepartment.forEach(function(obj) {if (!hasPermission("DivisionDepartment")) {obj.style.display = "none";}});

	eventSalary.forEach(function(obj) {if (!hasPermission("Salary")) {obj.style.display = "none";}});

	eventCashBook.forEach(function(obj) {if (!hasPermission("CashBook")) {obj.style.display = "none";}});

	eventSalaryBreakupsOne.forEach(function(obj) {if (!hasPermission("SalaryBreakupsOne")) {obj.style.display = "none";}});

	eventSalaryBreakupsTwo.forEach(function(obj) {if (!hasPermission("SalaryBreakupsTwo")) {obj.style.display = "none";}});

	eventPurchaseRecievedStatus.forEach(function(obj) {if (!hasPermission("PurchaseRecievedStatus")) {obj.style.display = "none";}});

	eventDBEdit.forEach(function(obj) {if (!hasPermission("DBEdit")) {obj.style.display = "none";}});
	
	eventServiceNote.forEach(function(obj) {if (!hasPermission("ServiceNote")) {obj.style.display = "none";}});
	// adding_new_permission
	
		// Donot Remove The above line 
});

