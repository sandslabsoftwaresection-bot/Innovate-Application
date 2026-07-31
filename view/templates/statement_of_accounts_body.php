<style>
    .main-container {
        padding-top: 20px;
    }
    .card-header {
        background: linear-gradient(90deg, rgba(10,87,173,1) 0%, rgba(23,148,255,1) 13%, rgba(0,44,215,0.9780287114845938) 100%);
        color: white;
    }
    .avatar-40 {
        width: 40px;
        height: 40px;
    }
    .rounded-circle {
        border-radius: 50% !important;
    }
    .time-title {
        font-size: 1.1rem;
        font-weight: 500;
    }
    .date-picker-container {
        margin-bottom: 20px;
    }
    td.details-control {
        cursor: pointer;
        background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    }
    tr.shown td.details-control {
        background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
</style>
<div class="container mt-2 main-container">
    <div class="card">
        <div class="card-header text-white">
            <div class="media w-100">
                <figure class="avatar avatar-40 rounded-circle align-self-start">
                    <img src="../httpdocs/images/company_profile_image/995847_236195_504913_logo_main.png" alt="Company Logo">
                </figure>
                <div class="media-body">
                    <h5 class="time-title mb-0 text-white">Statement of Accounts</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Date Range Picker -->
            <div class="row date-picker-container">
                <div class="col-md-3">
                    <label for="company_select">Select Company</label>
                    <select id="company_select" class="form-control">
                        <option value="">All Companies</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="from_date">From Date</label>
                    <input type="text" id="from_date" class="form-control datepicker" placeholder="Select From Date">
                </div>
                <div class="col-md-3">
                    <label for="to_date">To Date</label>
                    <input type="text" id="to_date" class="form-control datepicker" placeholder="Select To Date">
                </div>
                <div class="col-md-3 align-self-end">
                    <button id="filter_btn" class="btn btn-primary" style="padding-bottom:5px;">Filter</button>
                    <button id="reset_btn" class="btn btn-secondary">Reset</button>
                    <button id="pdf_btn" class="btn btn-primary" style="background-color: #d9534f; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">
                        <i class="fa fa-file-pdf-o"></i> Generate PDF
                    </button>
                </div>
            </div>
            <!-- DataTable -->
            <table id="statement_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Date</th>
                        <th>Trans. No.</th>
                        <th>Type</th>
                        <th>Reference / PO No.</th>
                        <th>Contract Value</th>
                        <th>Debit (Invoice)</th>
                        <th>Credit (Payment/Credit)</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" style="text-align:right">Total:</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>