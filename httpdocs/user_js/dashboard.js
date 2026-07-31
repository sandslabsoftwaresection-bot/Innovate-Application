$(document).ready(function(){
     $.post("../controller/dashboard/dashboard_controller.php",{action : "count_of_companies"},function(res){
        
        var parsedData = JSON.parse(res);
        var companyCount = parsedData.data[0].company_count;
                            
        var txtCompanyCount = document.getElementById('txt_company_count');
        txtCompanyCount.innerHTML = companyCount; 
        			             
    });
    $.post("../controller/dashboard/dashboard_controller.php",{action : "count_of_suppliers"},function(res){
        
        var parsedData = JSON.parse(res);
        var supplierCount = parsedData.data[0].supplier_count;
                            
        var txtCompanyCount = document.getElementById('txt_supplier_count');
        txtCompanyCount.innerHTML = supplierCount; 
        			             
    });
    $.post("../controller/dashboard/dashboard_controller.php",{action : "count_of_projects"},function(res){
        
        var parsedData = JSON.parse(res);
        var projectCount = parsedData.data[0].project_count;
                            
        var txtCompanyCount = document.getElementById('txt_projects_count');
        txtCompanyCount.innerHTML = projectCount; 
        			             
    });
    $.post("../controller/dashboard/dashboard_controller.php",{action : "count_of_users"},function(res){
        
        var parsedData = JSON.parse(res);
        var userCount = parsedData.data[0].user_count;
                            
        var txtCompanyCount = document.getElementById('txt_user_count');
        txtCompanyCount.innerHTML = userCount; 
        			             
    });
});