<?php
require_once('tcpdf/tcpdf.php'); // Include the TCPDF library
require_once('includes/load.php');
$page_title = '';
$results = '';

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
      redirect('stock_card.php', false);
    }
  } else {
    $session->msg("w", "Select date range");
    redirect('stock_card.php', false);
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

if ($results) {
    $html = '<div class="page-break">
    <div class="sale-head">
    
        <h1 style="color: #666666;">Tile Inventory Management System - Stock Report</h1>
        <strong style="color: #666666;">' . (isset($start_date) ? $start_date : '') . ' : ' . (isset($end_date) ? $end_date : '') . '</strong>
    </div>

    
   <table class="table table-bordered" style="color: #666666;">
     <thead>
       <tr>
           <th>Date</th>
           <th>Product Name</th>
           <th>Supplier</th>
           <th>Added Stock</th>
           <th>Sold Stock</th>
           <th>Available Stock</th>
       </tr>
     </thead>
     <tbody>';

    foreach ($results as $result) {
        $html .= '
        <tr>
            <td class="desc text-center">' . remove_junk($result['date']) . '</td>
            <td class="desc text-center">' . remove_junk(ucfirst($result['name'])) . '</td>
            <td class="text-right text-center">' . remove_junk($result['supplier']) . '</td>
            <td class="text-right text-center">' . $result['added_stock'] . '</td>
            <td class="text-right text-center">' . remove_junk($result['total_sales']) . '</td>
            <td class="text-right text-center">' . $result['quantity'] . '</td>
        </tr>';
    }

    $html .= '
            </tbody>
        </table>
    </div>';

} else {
    $session->msg("d", "Sorry, no sales have been found.");
    redirect('stock_card.php', false);
}

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('stock_card.pdf', 'I');