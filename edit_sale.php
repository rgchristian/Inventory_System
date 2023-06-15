<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sale = find_by_id('sales', (int)$_GET['id']);
if (!$sale) {
  $session->msg("d", "Missing product id.");
  redirect('sales.php');
}
?>
<?php $product = find_by_id('products', $sale['product_id']); ?>
<?php

if (isset($_POST['update_sale'])) {
  $req_fields = array('title', 'quantity', 'price', 'total', 'date');
  validate_fields($req_fields);
  if (empty($errors)) {
    $p_id   = $db->escape((int)$product['id']);
    $s_qty  = $db->escape((int)$_POST['quantity']);
    $s_total = $db->escape($_POST['total']);
    $date   = $db->escape($_POST['date']);
    $s_date = date("Y-m-d", strtotime($date));

    $sql  = "UPDATE sales SET";
    $sql .= " product_id = '{$p_id}', qty = {$s_qty}, price = '{$s_total}', date = '{$s_date}'";
    $sql .= " WHERE id = '{$sale['id']}'";
    $result = $db->query($sql);
    if ($result && $db->affected_rows() === 1) {
      update_product_qty($s_qty, $p_id);
      $session->msg('s', "Sale record successfully updated.");
      redirect('edit_sale.php?id=' . $sale['id'], false);
    } else {
      $session->msg('d', ' Failed to update sale record.');
      redirect('sales.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_sale.php?id=' . (int)$sale['id'], false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-info">
      <div class="panel-heading clearfix">
        <strong>
          
          <span >Edit Sales</span>
        </strong>

        <div class="pull-right">
        <a href="sales.php" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
      </div>

      <div class="panel-body">
        <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
          <table class="table table-bordered table-striped">
            
          <thead>
              <tr>
                <th class="text-center"> Product Name</th>
                <th class="text-center"> Quantity </th>
                <th class="text-center" style="width: 15%;"> Price</th>
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Date </th>
                <th class="text-center" style="width: 100px;"> Action </th>
              </tr>
            </thead>

            <tbody id="product_info">
              <tr>
                <td id="s_name">
                  <input type="text" class="form-control" id="sug_input" name="title" data-toggle="tooltip" data-placement="bottom" readonly title="Product name" value="<?php echo remove_junk($product['name']); ?>">
                  <div id="result" class="list-group"></div>
                </td>
                <td id="s_qty">
                  <input type="text" class="form-control" name="quantity" data-toggle="tooltip" data-placement="bottom" title="Edit sold product quantity" value="<?php echo (int)$sale['qty']; ?>">
                </td>
                <td id="s_price">
                  <input type="text" class="form-control" name="price" data-toggle="tooltip" data-placement="bottom" readonly title="Product selling price" value="<?php echo remove_junk($product['sale_price']); ?>">
                </td>
                <td>
                  <input type="text" class="form-control" name="total" data-toggle="tooltip" data-placement="bottom" readonly title="Product total price amount" value="<?php echo remove_junk($sale['price']); ?>">
                </td>
                <td id="s_date">
                  <input type="date" class="form-control datepicker" name="date" data-date-format="" data-toggle="tooltip" data-placement="bottom" readonly title="Product sold date" value="<?php echo remove_junk($sale['date']); ?>">
                </td>
                <td>
                  <button type="submit" name="update_sale" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Save changes">Save Changes</button>
                </td>
              </tr>
            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
