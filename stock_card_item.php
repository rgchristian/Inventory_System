<?php
  $page_title = 'Stock Card';
  require_once('includes/load.php');
  page_require_level(1);
  $all_users = find_all_user();
  $products = array_unique(join_product_table(), SORT_REGULAR);
  $all_products = find_all('products');

  $total_added_stock = 0;
  $total_qty = 0;

  // Check if the product ID is provided in the URL
  if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
    $product = find_product_by_id($product_id);

    if (!$product) {
        $_SESSION['warning'] = 'Product not found.';
        redirect('product.php');
    }
  } else {
    $_SESSION['warning'] = 'Invalid product ID.';
    redirect('product.php');
  }
?>

<?php include_once('layouts/header.php'); ?>

<style>
  body {
    background-color: #DDDDDD;
  }
</style>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-info">
      <div class="panel-heading clearfix">
        <strong>
          <span >Stock Card</span>
       </strong>
       <!-- <a href="add_user.php" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add new user to the system"><i class="fas fa-plus">&nbsp;</i> Add New User</a> -->
      </div>
      <div class="panel-body">
        <table class="table table-bordered" style="color: #567189;">
          <thead>
            <tr>
              <th class="text-center" style="width: 20%;">Date</th>
              <th class="text-center">Product Name</th>
              <!-- <th class="text-center" style="width: 20%;">Stock</th> -->
              <th class="text-center" style="width: 10%;">In</th>
              <th class="text-center" style="width: 10%;">Out</th>
              <th class="text-center" style="width: 20%;">Supplier</th>
              <!-- <th class="text-center" style="width: 100px;">Actions</th> -->
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product) : ?>
              <tr>
                <td class="text-center"><?php echo date('Y-m-d H:i:s', strtotime($product['date'] . '+6 hours')); ?></td>
                <td class="text-center"><?php echo remove_junk($product['name']); ?></td>
                <!-- <td class="text-center"><?php echo $product['stock_status']; ?></td> -->
                <td class="text-center"><?php echo $product['added_stock']; ?></td>
                <td class="text-center"><?php echo remove_junk($product['qty']); ?></td>
                <td class="text-center"><?php echo $product['supplier']; ?></td>
              </tr>
              <?php
              $total_added_stock += $product['added_stock'];
              $total_qty += $product['qty'];
              ?>
            <?php endforeach; ?>
            <tr>
              <td colspan="2" class="text-right"><strong>Total:</strong></td>
              <td class="text-center"><strong><?php echo $total_added_stock; ?></strong></td>
              <td class="text-center"><strong><?php echo $total_qty; ?></strong></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
