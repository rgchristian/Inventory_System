<?php
$page_title = '';
$results = '';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
  if(isset($_POST['submit'])){
    $req_dates = array('start-date','end-date');
    validate_fields($req_dates);

    if(empty($errors)):
      $start_date   = remove_junk($db->escape($_POST['start-date']));
      $end_date     = remove_junk($db->escape($_POST['end-date']));
      $results      = find_sale_by_dates($start_date,$end_date);
    else:
      $session->msg("d", $errors);
      redirect('sales_report.php', false);
    endif;

  } else {
    $session->msg("d", "Select dates");
    redirect('sales_report.php', false);
  }
?>

<script>
  function printPDF() {
    window.print();
  }
</script>

<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Sales Report</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
     <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #666666;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #666666;";
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #666666;
     }table tbody tr td{
       vertical-align: middle;
       border: 1px solid #666666;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #666666;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       text-transform: uppercase;
       color: #666666;
       font-weight: 500;
     }
     .custom-primary-btn {
  background-color: #567189;
  color: white;
  margin-right: 230px;
}
  .custom-primary-btn:hover {
    background-color: white;
    border-color: black;
  }
   a .pull-right {
    visibility: hidden;
  }
   </style>

<div class="pull-right">
  
  <a href="sales_report.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
  <div>

  </div>
  <a href="sales_report_pdf.php" class="btn custom-primary-btn btn-sm pull-right" style="margin-top: 10px" onclick="printPDF()" data-toggle="tooltip" data-placement="bottom" title="Print as PDF"><span class="fas fa-print"></span></a>
</div>


</head>
<body>
  <?php if($results): ?>
    <div class="page-break">
       <div class="sale-head">
           <h1 style="color: #666666;">Tile Inventory Management System - Sales Report</h1>
           <strong style="color: #666666;"><?php if(isset($start_date)){ echo $start_date;}?> : <?php if(isset($end_date)){echo $end_date;}?> </strong>
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
        <tbody>
          <?php foreach($results as $result): ?>
           <tr>
              <td class="desc text-center"><?php echo remove_junk($result['date']);?></td>
              <td class="desc text-center"><?php echo remove_junk(ucfirst($result['name']));?></td>
              <td class="text-right text-center"><?php echo remove_junk($result['buy_price']);?></td>
              <td class="text-right text-center"><?php echo remove_junk($result['sale_price']);?></td>
              <td class="text-right text-center"><?php echo remove_junk($result['total_sales']);?></td>
              <td class="text-right text-center"><?php echo remove_junk($result['total_saleing_price']);?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
         <tr class="text-right text-center">
           <td colspan="4"></td>
           <td style="color: #666666;" colspan="1">Grand Total</td>
           <td style="color: #666666;"> ₱
           <?php echo number_format(total_price($results)[0], 2);?>
          </td>
         </tr>
         <tr class="text-right text-center" style="color: #666666;">
           <td colspan="4"></td>
           <td colspan="1">Profit</td>
           <td style="color: #666666;"> ₱ <?php echo number_format(total_price($results)[1], 2);?></td>
         </tr>
        </tfoot>
      </table>
    </div>
  <?php
    else:
        $session->msg("d", "Sorry no sales has been found. ");
        redirect('sales_report.php', false);
     endif;
  ?>
  
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
