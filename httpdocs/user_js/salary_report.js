$(document).ready(function(){
    var tbl_supplier_report_list = $('#tbl_supplier_report_list').DataTable({searching: false, paging: false, info: false,"ordering": false});
//   var history_of_store_item = $('#history_of_store_item').DataTable( {searching: false, paging: false, info: false,"ordering": false});
  
  $('#history_of_store_item').removeClass( 'display' ).addClass('table table-striped table-bordered');
  
  $('#div_select_division').load('templates/division_load_com_for_report.php');
  $('#div_select_department').load('templates/department_comb_for_rep.php');
  $('#div_select_employee').load('templates/employee_names_load_second.php');
  
  
  
  
});