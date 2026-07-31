$(document).ready(function(){
   var project_text;
    $('#div_company_select').load('templates/company_combo.php');
    
	 $("#div_company_select").change(function() {
	     
	      var company_id=$('option:selected', this).val() ;
	      $('#div_project_select_combo').load('templates/project_combo.php?v_company_id='+company_id);
	     
	 });
	 $("#div_project_select_combo").change(function() { 
	      
	      var project_id=$('option:selected', this).val() ;
	      project_text = $('option:selected', this).text() ;
	      
	      $('#div_select_quotation').load('templates/quotation_combo.php?v_project_id='+project_id);
	      
	 });
	 $("#div_project_select_combo").change(function() { 
	     var quotation_id=$('option:selected', this).val() ;
	       alert(project_text);
	        $("#div_project_name").text(project_text);  
	   //  $.post('../controller/report/report_controller.php',{action:"total_project_value",v_quotation_id:quotation_id},function(){
	      
	         
	   //  })
	 });    
	 
});