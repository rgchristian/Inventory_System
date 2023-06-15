<?php
$page_title = 'Add Stock';
require_once('includes/load.php');

// Checking what level of user has permission to view this page
page_require_level(2);

$errors = array();
$product = find_by_id('products', (int)$_GET['id']);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $stock = (int)$_POST['product-quantity'];

  if (update_product_qty_stock($stock, $product['id'])) {
    $session->msg('s', "Stock added successfully.");
    redirect('product.php?id=' . $product['id'], false);
  } else {
    $session->msg('d', "Failed to add product stock.");
    redirect('add_stock.php?id=' . $product['id'], false);
  }
}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-5">
    <div class="panel panel-info">
      <div class="panel-heading clearfix">
        <strong>
          <span>Add Product Stock</span>
        </strong>
        <div class="pull-right">
          <a href="product.php" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
      </div>
      <div class="panel-body">
        <form method="post" action="add_stock.php?id=<?php echo (int)$product['id'] ?>">
          <div class="form-group">
            <label style="color: #7f7f7f;">Product Name</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-pencil-alt" style="color: #666666;"></i>
              </span>
              <input type="text" class="form-control" name="product-title" readonly data-toggle="tooltip" data-placement="bottom" title="Product name" value="<?php echo remove_junk($product['name']); ?>">
            </div>
          </div>

          <div class="form-group">
            <label style="color: #7f7f7f;">Add Quantity</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fas fa-shopping-cart" style="color: #666666"></i>
              </span>
              <input type="text" class="form-control" name="product-quantity" data-toggle="tooltip" data-placement="bottom" title="Add product quantity" value="<?php echo remove_junk(abs($product['quantity'])); ?>" placeholder="Product Quantity">
            </div>
          </div>

          <button type="submit" name="add_stock" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Done"><span class="fas fa-check"></span> Done</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
