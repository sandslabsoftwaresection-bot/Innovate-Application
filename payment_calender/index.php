
<!--Drop Down Message-->
<div class="row" >
    <div class="col-12 col-md-2">
    </div>   
    <div class="col-12 col-md-2">
        <label for="validationTooltip05">Bank Name</label>
    	<div  class="col-sm-12 col-md-12 col-lg-12" id="div_select_bank_name_for_print" style="width:100%;padding-left:0px;">
    		<select  id="select_bank" name="select_bank" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-2"  aria-hidden="true"  >
    		<option value="0" >-Select Account Head--</option>
    	   
    		</select> 
    	</div>
    </div>
    <div class="col-12 col-md-3">
        <label>Select Date</label>
        <input type="text" class="form-control daterange w-100" name="daterange" value="<?PHP echo date('Y-m-d')?>" id="txt_date_range">
    </div>
    <div class="col-12 col-md-3">
        <label>Select Customer</label>
        <div  id="div_search_customer_name" >
            <select  id="select_customer" name="select_customer" class="chosen_select form-control form-control-sm" data-live-search="true" tabindex="-2"  aria-hidden="true"  >
                <option value="0" >-Select Customer--</option>
               
            </select> 
        </div>
    </div>
    <div class="col-12 col-md-1" style="padding-top:30px;padding-left:-10px;">
        <button type="button" class="mb-2 box-shadow mr-2 btn btn-primary " id="btn_search"><span class="material-icons">search</span></button>
        
    </div>
    <div class="col-12 col-md-1" style="padding-top:30px;padding-left:-10px;">
        <button type="button" class="mb-2 box-shadow mr-2 btn btn-secondary " id="btn_print"><span class="material-icons">print</span></button>
        
    </div>
 </div>
<div id="dropdownContent" style="text-align:center;">
  <!-- Content of your dropdown -->
</div>

<div class="container-fluid">

<div class="row" >
	<div class="col-3">
		<div class="sandscalendar">
			<div class="sandsdropdown">
					<select id="sandsMonthSelect" onchange="changeMonth(this.value)">
						<!-- You can generate the month options dynamically if needed -->
					</select>
					<select id="sandsYearSelect" onchange="changeYear(this.value)">
						<!-- You can generate the year options dynamically if needed -->
					</select>
				</div>
			   
			  <div class="sands-month">
				<div class="sands-prev">&#10094;</div>
					<div class="sands-month-name"></div>
				<div class="sands-next">&#10095;</div>
			  </div>
			  <div>
			  <ul class="sands-weekdays">
				<li>Sun</li>
				<li>Mon</li>
				<li>Tue</li>
				<li>Wed</li>
				<li>Thu</li>
				<li>Fri</li>
				<li>Sat</li>
			  </ul>
			  </div>
			  <div>
			  <ul class="sands-days"> </ul>
			  </div>
		</div>
	</div>
	<div class="col-9" >
			<div class="row" style="padding: 20px;">
				<div class="col-6">
					<div class="row">
						<div class="col-12 text-font-15-px" style="text-align:center">
							Income
						</div>
					</div>
					<div class="row">
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-left: 1px solid #D8D8D8;text-align: center;">
							<div id="sumApproved" class="text-font-12-px" style="padding-top: 10px;"></div>
						</div>
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-right: 1px solid #D8D8D8;text-align: center;">
							<div id="sumNotApproved" class="text-font-12-px" style="padding-top: 10px;"></div>
						</div>
					</div>
				</div>
				
				<div class="col-6">
						
					<div class="row">
						<div class="col-12 text-font-15-px" style="text-align:center">
							Expense
						</div>
					</div>
					<div class="row">
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-left: 0px solid #D8D8D8;text-align: center;">
							<div id="sumApprovedExp" class="text-font-12-px" style="padding-top: 10px;"></div>
						</div>
						<div class="col-6" style="border-top: 1px solid #D8D8D8;border-right: 1px solid #D8D8D8;text-align: center;">
							<div id="sumNotApprovedExp" class="text-font-12-px" style="padding-top: 10px;"></div>
						</div>
					</div>
				
						
				</div>
			</div>
	
		<table id="tlbTransaction" class="table table-striped table-bordered sands-dataTable" style="width:100%">
		  <thead>
			<tr>
			  <th>Type</th>
			  <th>Cheque/Ref No</th>
			  <th>Date</th>
			  <th>Income</th>
			  <th>Expense</th>
			  <th>Head</th>
			  <th>Status</th>
			  <th>From/To</th>
			  <th><div class="sands-delete-icon-head"></div></th>
			</tr>
			
		  </thead>
		  <tbody>
		
		  </tbody>
		  <tfoot>
			<tr>
			  <th colspan="3" style="text-align:right">Total:</th>
			  <th style="text-align:right"></th>
			  <th style="text-align:right"></th>
			  <th colspan="2" style="text-align:right"></th>
			 
			</tr>
		  </tfoot>
		</table>
			
	</div>
</div>
<div id="sum"></div>
</div>


