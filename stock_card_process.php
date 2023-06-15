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
      redirect('stock_card.php', false);
    endif;

  } else {
    $session->msg("d", "Select dates");
    redirect('stock_card.php', false);
  }
?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Stock Report</title>
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

   </style>

<div class="pull-right">
          <a href="stock_card.php" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
</head>

<body>
  <?php if($results): ?>
    <div class="page-break">
       <div class="sale-head">
       
           <h1 style="color: #666666;">Tile Inventory Management System - Stock Report</h1>
           <strong style="color: #666666;"><?php if(isset($start_date)){ echo $start_date;}?> : <?php if(isset($end_date)){echo $end_date;}?> </strong>
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
        <tbody>
          <?php foreach($results as $result): ?>
           <tr>
              <td class="desc text-center"><?php echo remove_junk($result['date']);?></td>
              <td class="desc text-center">
                <?php echo remove_junk(ucfirst($result['name']));?>
              </td>
              <td class="text-right text-center"><?php echo remove_junk($result['supplier']); ?></td>
              <td class="text-right text-center"><?php echo $result['added_stock']; ?></td>
              <td class="text-right text-center"><?php echo remove_junk($result['total_sales']);?></td>
              <td class="text-right text-center"><?php echo $result['quantity']; ?></td>

              
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php
    else:
        $session->msg("d", "Sorry no sales has been found. ");
        redirect('stock_card.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>


