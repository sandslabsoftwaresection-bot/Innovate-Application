<?php
include("../../../../session_check.php");
require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    // Page header
    public function Header() {
        $this->SetFont('helvetica', 'B', 12);
        $this->Ln(5);
    }
    
    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C');
    }
}

// Create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Company');
$pdf->SetTitle('Statement of Account');
$pdf->SetSubject('Statement of Account');
$pdf->SetKeywords('Statement, Account, PDF');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 35, 15);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage();

// Inputs
$company_id = isset($_GET['company_id']) ? $_GET['company_id'] : '';
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$to_date   = isset($_GET['to_date']) ? $_GET['to_date'] : '';

if (!empty($from_date)) {
    $from_date = date('Y-m-d', strtotime($from_date));
}
if (!empty($to_date)) {
    $to_date = date('Y-m-d', strtotime($to_date));
}

$from_date_display = $from_date ? date('d M Y', strtotime($from_date)) : 'From DD MMM YYYY';
$to_date_display = $to_date ? date('d M Y', strtotime($to_date)) : 'To DD MMM YYYY';
$statement_date = date('d M Y');

// DB connection
require_once('../../../../model/common/common_functions.php');
$db_con = new DBConnection();
$conn = $db_con->ConnectToMYSQL();

// Company name
$company_name = 'All Companies';
$customer_id_display = '12345';
if (!empty($company_id)) {
    $name_result = $conn->query("SELECT company_name FROM credit_debit_ledger WHERE company_id = '" . $conn->real_escape_string($company_id) . "' LIMIT 1");
    if ($name_row = $name_result->fetch_assoc()) {
        $company_name = $name_row['company_name'];
        $customer_id_display = $company_id;
    }
}

// Main Query (Unchanged)
$sql = "
    SELECT 
        main.ids,
        main.accounts_date,
        main.invoice_number,
        main.type,
        main.reference_no,
        main.project_name AS description,
        main.account_head,

        -- Contract Value only on Contract Amount row
        CASE 
            WHEN main.account_head = 'Contract Amount' THEN (
                SELECT SUM(
                    CASE 
                        WHEN sub.account_head IN ('Contract Amount','Tax Income') 
                            THEN sub.contract_amount ELSE 0 END
                )
                FROM credit_debit_ledger sub
                WHERE sub.quotation_number = main.quotation_number
            )
            ELSE 0
        END AS contract_value,

        -- Debit calculation
        CASE 
            WHEN main.account_head = 'Received Amount' THEN (
            SELECT SUM(sub.debit_amount)
            FROM credit_debit_ledger sub
            WHERE sub.quotation_number = main.quotation_number
              AND sub.invoice_number = main.invoice_number
              AND sub.account_head IN ('Received Amount','Tax Receivable')
            )
            ELSE main.debit_amount
        END AS debit_amount,

        -- Credit calculation
        CASE 
            WHEN main.account_head = 'Received Amount' THEN 0
            ELSE main.credit_amount
        END AS credit_amount

    FROM credit_debit_ledger main
    WHERE 1=1
      AND main.account_head NOT IN ('Tax Income', 'Tax Receivable', 'Advance Received Amount', 'Retention Amount')
";

if (!empty($company_id)) {
    $sql .= " AND main.company_id = '" . $conn->real_escape_string($company_id) . "'";
}
if (!empty($from_date) && !empty($to_date)) {
    $sql .= " AND main.accounts_date BETWEEN '" . $conn->real_escape_string($from_date) . "' AND '" . $conn->real_escape_string($to_date) . "'";
} elseif (!empty($from_date)) {
    $sql .= " AND main.accounts_date >= '" . $conn->real_escape_string($from_date) . "'";
} elseif (!empty($to_date)) {
    $sql .= " AND main.accounts_date <= '" . $conn->real_escape_string($to_date) . "'";
}
$sql .= " ORDER BY main.accounts_date ASC, main.ids ASC";

// Execute main query
$result = $conn->query($sql);

// Initialize totals and first contract flag
$total_debit = 0;
$total_credit = 0;
$total_contract_value = 0;
$running_balance = 0;
$first_contract_processed = false;

// Prepare table rows
$rows = '';
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $date = date('d/m/Y', strtotime($row['accounts_date']));
        $trans_no = $row['invoice_number'] ?: '';
        $type = $row['type'] ?: '';
        $account_head = $row['account_head'] ?: '';
        $reference = $row['reference_no'] ?: '';
        $description = $row['description'] ?: '';
        $contract_value = $row['contract_value'] > 0 ? 'BD ' . number_format($row['contract_value'], 3) : '';
        $debit = $row['debit_amount'] > 0 ? 'BD ' . number_format($row['debit_amount'], 3) : '';
        $credit = $row['credit_amount'] > 0 ? 'BD ' . number_format($row['credit_amount'], 3) : '';

        // Totals
        $total_debit += $row['debit_amount'];
        $total_credit += $row['credit_amount'];
        $total_contract_value += $row['contract_value'];

        if ($row['account_head'] === 'Contract Amount') {
            if (!$first_contract_processed) {
                $running_balance = 0;
                $first_contract_processed = true;
            }
        } else {
            if ($row['debit_amount'] > 0) {
                $running_balance += $row['debit_amount'];
            }
            if ($row['credit_amount'] > 0) {
                $running_balance -= $row['credit_amount'];
            }
        }

        $balance = 'BD ' . number_format($running_balance, 3);

        $rows .= <<<EOD
            <tr>
                <td style="border: 1px solid #000; padding: 4px;">$date</td>
                <td style="border: 1px solid #000; padding: 4px;">$trans_no</td>
                <td style="border: 1px solid #000; padding: 4px;">$type</td>
                <td style="border: 1px solid #000; padding: 4px;">$reference</td>
                <td style="border: 1px solid #000; padding: 4px;">$description</td>
                <td style="border: 1px solid #000; padding: 4px; text-align: right;">$contract_value</td>
                <td style="border: 1px solid #000; padding: 4px; text-align: right;">$debit</td>
                <td style="border: 1px solid #000; padding: 4px; text-align: right;">$credit</td>
                <td style="border: 1px solid #000; padding: 4px; text-align: right;">$balance</td>
            </tr>
        EOD;
    }
} else {
    $rows = '<tr><td colspan="9" style="border: 1px solid #000; padding: 4px; text-align: center;">No records found</td></tr>';
}

// Totals formatting
$total_contract_value_formatted = 'BD ' . number_format($total_contract_value, 3);
$total_debit_formatted = 'BD ' . number_format($total_debit, 3);
$total_credit_formatted = 'BD ' . number_format($total_credit, 3);
$closing_balance_formatted = 'BD ' . number_format($running_balance, 3);
$net_balance_due = 'BD ' . number_format(($total_contract_value - $total_credit), 3);

// New Query for Aging Summary of Retention Amount (Using debit_amount)
$aging_sql = "
    SELECT 
        debit_amount,
        accounts_date
    FROM credit_debit_ledger
    WHERE account_head = 'Retention Amount'
";

if (!empty($company_id)) {
    $aging_sql .= " AND company_id = '" . $conn->real_escape_string($company_id) . "'";
}
if (!empty($from_date) && !empty($to_date)) {
    $aging_sql .= " AND accounts_date BETWEEN '" . $conn->real_escape_string($from_date) . "' AND '" . $conn->real_escape_string($to_date) . "'";
} elseif (!empty($from_date)) {
    $aging_sql .= " AND accounts_date >= '" . $conn->real_escape_string($from_date) . "'";
} elseif (!empty($to_date)) {
    $aging_sql .= " AND accounts_date <= '" . $conn->real_escape_string($to_date) . "'";
}

$aging_result = $conn->query($aging_sql);

// Initialize aging buckets
$current = 0; // 0–30 days
$days_31_60 = 0;
$days_61_90 = 0;
$over_90 = 0;
$total_retention = 0;

$current_date = new DateTime('2025-09-10'); // Current date as per system date

if ($aging_result && $aging_result->num_rows > 0) {
    while ($row = $aging_result->fetch_assoc()) {
        $accounts_date = new DateTime($row['accounts_date']);
        $interval = $current_date->diff($accounts_date);
        $days = $interval->days;
        $debit = $row['debit_amount'];

        $total_retention += $debit;

        if ($days <= 30) {
            $current += $debit;
        } elseif ($days <= 60) {
            $days_31_60 += $debit;
        } elseif ($days <= 90) {
            $days_61_90 += $debit;
        } else {
            $over_90 += $debit;
        }
    }
}

// Format aging amounts
$current_formatted = 'BD ' . number_format($current, 3);
$days_31_60_formatted = 'BD ' . number_format($days_31_60, 3);
$days_61_90_formatted = 'BD ' . number_format($days_61_90, 3);
$over_90_formatted = 'BD ' . number_format($over_90, 3);
$total_retention_formatted = 'BD ' . number_format($total_retention, 3);

// HTML (Updated Aging Summary Section)
$html = <<<EOD
<table style="width:100%; font-size:10px; margin-bottom:10px;">
    <tr>
        <td style="text-align:left;">
            Your Address | Phone | Email | VAT / TRN No.
        </td>
        <td style="text-align:right; font-size:14px; font-weight:bold; color: blue;">
            STATEMENT OF ACCOUNT
        </td>
    </tr>
</table>

<div style="text-align: left; margin-bottom: 10px; font-size:10px;">
    <div>Customer: $company_name</div>
    <div>Customer ID / Account No.: $customer_id_display</div>
    <div>Customer Address: [Customer Address]</div>
    <div>Statement Date: $statement_date</div>
    <div>Period Covered: $from_date_display to $to_date_display</div>
</div>

<table cellpadding="2" cellspacing="0" style="width: 100%; border-collapse: collapse; font-size: 9px;">
    <thead>
        <tr style="background-color:#f2f2f2; text-align:center; font-weight:bold;">
            <th style="border:1px solid #000; padding:4px;">Date</th>
            <th style="border:1px solid #000; padding:4px;">Trans. No.</th>
            <th style="border:1px solid #000; padding:4px;">Type</th>
            <th style="border:1px solid #000; padding:4px;">Reference / PO No.</th>
            <th style="border:1px solid #000; padding:4px;">Description</th>
            <th style="border:1px solid #000; padding:4px; text-align:right;">Contract Value</th>
            <th style="border:1px solid #000; padding:4px; text-align:right;">Debit (Invoice)</th>
            <th style="border:1px solid #000; padding:4px; text-align:right;">Credit (Payment/Credit)</th>
            <th style="border:1px solid #000; padding:4px; text-align:right;">Balance</th>
        </tr>
    </thead>
    <tbody>
        $rows
        <tr>
            <td colspan="6" style="border:1px solid #000; padding:4px; text-align:right; font-weight:bold;">Total Invoices (Debits):</td>
            <td style="border:1px solid #000; text-align:right; font-weight:bold;">$total_debit_formatted</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="7" style="border:1px solid #000; padding:4px; text-align:right; font-weight:bold;">Total Payments/Credits:</td>
            <td style="border:1px solid #000; text-align:right; font-weight:bold;">$total_credit_formatted</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="8" style="border:1px solid #000; padding:4px; text-align:right; font-weight:bold;">Closing / Current Balance:</td>
            <td style="border:1px solid #000; text-align:right; font-weight:bold;">$closing_balance_formatted</td>
        </tr>
        <tr>
            <td colspan="5" style="border:1px solid #000; padding:4px; text-align:right; font-weight:bold;">Net Balance in Due:</td>
            <td style="border:1px solid #000; text-align:right; font-weight:bold;">$total_contract_value_formatted</td>
            <td style="border:1px solid #000; text-align:right; font-weight:bold;">$total_debit_formatted</td>
            <td style="border:1px solid #000; text-align:right; font-weight:bold;">$total_credit_formatted</td>
            <td style="border:1px solid #000; text-align:right; font-weight:bold;">$net_balance_due</td>
        </tr>
    </tbody>
</table>

<div style="margin-top:10px;">
    <h3 style="font-size:11px; font-weight:bold;">AGING SUMMARY OF RETENTION AMOUNT</h3>
    <table cellpadding="2" cellspacing="0" style="width:100%; border-collapse:collapse; font-size:9px;">
        <tr style="background-color:#f2f2f2; font-weight:bold;">
            <td style="border:1px solid #000; padding:4px;">Ageing bucket</td>
            <td style="border:1px solid #000; padding:4px; text-align:right;">Amount</td>
        </tr>
        <tr><td style="border:1px solid #000; padding:4px;">Current (0–30 days)</td><td style="border:1px solid #000; text-align:right;">$current_formatted</td></tr>
        <tr><td style="border:1px solid #000; padding:4px;">31–60 days</td><td style="border:1px solid #000; text-align:right;">$days_31_60_formatted</td></tr>
        <tr><td style="border:1px solid #000; padding:4px;">61–90 days</td><td style="border:1px solid #000; text-align:right;">$days_61_90_formatted</td></tr>
        <tr><td style="border:1px solid #000; padding:4px;">Over 90 days</td><td style="border:1px solid #000; text-align:right;">$over_90_formatted</td></tr>
        <tr><td style="border:1px solid #000; padding:4px; font-weight:bold;">Total</td><td style="border:1px solid #000; text-align:right; font-weight:bold;">$total_retention_formatted</td></tr>
    </table>
</div>

<div style="margin-top:0px; font-size:9px;">
    <h4 style="font-size:11px; font-weight:bold;">Payment Instructions & Notes</h3>
    <p>- Please remit payment to: Bank Name — Account Name — IBAN / Account No. —</p>
</div>
EOD;

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('statement_of_account.pdf', 'I');
$conn->close();
?>