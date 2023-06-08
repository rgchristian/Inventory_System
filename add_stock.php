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
    redirect('add_stock.php?id=' . $product['id'], false);
  } else {
    $session->msg('d', "Failed to add stock.");
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
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span>Add Product Stock</span>
        </strong>
      </div>

      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="add_stock.php?id=<?php echo (int)$product['id'] ?>">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-pencil"></i>
                </span>
                <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']); ?>">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="glyphicon glyphicon-shopping-cart"></i>
                </span>
                <input type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk(abs($product['quantity'])); ?>" placeholder="Product Quantity">
              </div>
            </div>

            <button type="submit" name="add_stock" class="btn btn-primary pull-right btn-sm"><span class="fa fa-check"></span> Done</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>




        


