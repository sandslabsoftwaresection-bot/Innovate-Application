$(document).ready(function(){
    
    
    $('#div_employee_select').load('templates/employee_names_com_for_salary.php');
   
   
    
    // **************************load employee details**************************
    $("#div_employee_select").on("change","#select_employee_search", function() {
       
        var v_emp_id=$("#select_employee_search option:selected").val();
      alert(v_emp_id);
       
        
    });
    
    
    // ***********************************end***********************************
    
   $("#div_employee_select_for_search").on("change", "#select_employee_search", function() {
                var v_emp_name_id = $(this).val();
                alert(v_emp_name_id);
        
   });
    
});    