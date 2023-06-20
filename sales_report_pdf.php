<?php
require_once('tcpdf/tcpdf.php');
require_once('includes/load.php');
$page_title = '';
$results = '';

// Check the user's permission level to view this page
page_require_level(3);

if (isset($_POST['submit'])) {
  $req_dates = array('start-date', 'end-date');
  validate_fields($req_dates);

  if (empty($errors)) {
    $start_date = remove_junk($db->escape($_POST['start-date']));
    $end_date = remove_junk($db->escape($_POST['end-date']));
    $results = find_sale_by_dates($start_date, $end_date);
  } else {
    $session->msg("d", $errors);
    redirect('sales_report.php', false);
  }
} else {
  $session->msg("w", "Select date range");
  redirect('sales_report.php', false);
}

// Generate PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Sales Report');
$pdf->SetHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(true, 15);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetFont('helvetica', '', 10);

$pdf->AddPage();
$pdf->writeHTML('<div class="pull-right">
    <a href="sales_report.php" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
  </div>');

if ($results) {
  $html = '<div class="page-break">
      <div class="sale-head">
          <h1 style="color: #666666;">Tile Inventory Management System - Sales Report</h1>
          <strong style="color: #666666;">' . (isset($start_date) ? $start_date : '') . ' : ' . (isset($end_date) ? $end_date : '') . '</strong>
      </div>
      <table class="table table-bordered" style="color: #666666;">
        <thead>
          <tr>
              <th>Date</th>
              <th>Product Name</th>
              <th>Buying Price</th>
              <th>Selling Price</th>
              <th>Total Quantity</th>
              <th>Total</th>
          </tr>
        </thead>
        <tbody>';

  foreach ($results as $result) {
    $html .= '<tr>
                <td class="desc text-center">' . remove_junk($result['date']) . '</td>
                <td class="desc text-center">' . remove_junk(ucfirst($result['name'])) . '</td>
                <td class="text-right text-center">' . remove_junk($result['buy_price']) . '</td>
                <td class="text-right text-center">' . remove_junk($result['sale_price']) . '</td>
                <td class="text-right text-center">' . remove_junk($result['total_sales']) . '</td>
                <td class="text-right text-center">' . remove_junk($result['total_saleing_price']) . '</td>
              </tr>';
  }

  $html .= '</tbody>
            <tfoot>
             <tr class="text-right text-center">
               <td colspan="4"></td>
               <td style="color: #666666;" colspan="1">Grand Total</td>
               <td style="color: #666666;"> ₱' . number_format(total_price($results)[0], 2) . '</td>
             </tr>
             <tr class="text-right text-center" style="color: #666666;">
               <td colspan="4"></td>
               <td colspan="1">Profit</td>
               <td style="color: #666666;"> ₱ ' . number_format(total_price($results)[1], 2) . '</td>
             </tr>
            </tfoot>
          </table>
        </div>';

  $pdf->writeHTML($html);
} else {
  $session->msg("d", "Sorry, no sales have been found.");
  redirect('sales_report.php', false);
}

$pdf->Output('sales_report.pdf', 'I');
