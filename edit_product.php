<?php
$page_title = 'Edit Product';
require_once('includes/load.php');

// Checking what level user has permission to view this page
page_require_level(2);
$product = find_by_id('products', (int)$_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');

if (!$product) {
  $session->msg("d", "Product doesn't exist.");
  redirect('product.php');
}

$supplier_id = $product['supplier']; // Get the supplier ID
$e_supplier = find_by_id('suppliers', $supplier_id); // Find the supplier by ID

if (!$e_supplier) {
  $session->msg("d", "Supplier doesn't exist.");
  redirect('product.php');
}

if (isset($_POST['product'])) {
  $req_fields = array('product-title', 'product-categorie', 'product-quantity', 'buying-price', 'saleing-price');
  validate_fields($req_fields);

  if (empty($errors)) {
    $p_name  = remove_junk($db->escape($_POST['product-title']));
    $p_cat   = (int)$_POST['product-categorie'];
    $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
    $p_buy   = remove_junk($db->escape($_POST['buying-price']));
    $p_sale  = remove_junk($db->escape($_POST['saleing-price']));

    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }

    $query   = "UPDATE products SET";
    $query  .= " name ='{$p_name}', quantity ='{$p_qty}',";
    $query  .= " buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}', media_id='{$media_id}'";
    $query  .= " WHERE id ='{$product['id']}'";

    $result = $db->query($query);

    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Product updated successfully.");
      redirect('product.php', false);
    } else {
      $session->msg('d', 'Failed to update product');
      redirect('edit_product.php?id=' . $product['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_product.php?id=' . $product['id'], false);
  }
}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-md-12">
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="panel panel-info">
      <div class="panel-heading clearfix">
        <strong>
          <span>Edit Tile Product</span>
        </strong>
        <div class="pull-right">
          <a href="product.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back">
            <span class="fas fa-arrow-left"></span>
          </a>
        </div>
      </div>

      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fas fa-pencil-alt" style="color: #666666;"></i>
                </span>
                <input data-toggle="tooltip" data-placement="bottom" title="Edit product name" type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']); ?>">
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fas fa-th-large" style="color: #666666;"></i>
                    </span>
                    <select class="form-control" name="product-categorie" data-toggle="tooltip" data-placement="bottom" title="Re-select tile type">
                      <option value="">Select Product Category</option>
                      <?php foreach ($all_categories as $cat) : ?>
                        <option value="<?php echo (int)$cat['id']; ?>" <?php if ($product['categorie_id'] === $cat['id']) : echo "selected"; endif; ?>>
                          <?php echo remove_junk($cat['name']); ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fas fa-image" style="color: #666666;"></i>
                    </span>
                    <select class="form-control" name="product-photo" data-toggle="tooltip" data-placement="bottom" title="Re-select product photo">
                      <option value="">Product Photos: </option>
                      <?php foreach ($all_photo as $photo) : ?>
                        <option value="<?php echo (int)$photo['id']; ?>" <?php if ($product['media_id'] === $photo['id']) : echo "selected"; endif; ?>>
                          <?php echo $photo['file_name'] ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fas fa-shopping-cart" style="color: #666666;"></i>
                      </span>
                      <input type="number" class="form-control" readonly name="product-quantity" data-toggle="tooltip" data-placement="bottom" title="Product quantity" value="<?php echo remove_junk($product['quantity']); ?>">
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fas fa-money" style="color: #666666;"></i>
                      </span>
                      <input type="number" class="form-control" name="buying-price" data-toggle="tooltip" data-placement="bottom" title="Edit buying price" value="<?php echo remove_junk($product['buy_price']); ?>">
                      <span class="input-group-addon">.00</span>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fas fa-tag" style="color: #666666;"></i>
                      </span>
                      <input type="number" class="form-control" name="saleing-price" data-toggle="tooltip" data-placement="bottom" title="Edit selling price" value="<?php echo remove_junk($product['sale_price']); ?>">
                      <span class="input-group-addon">.00</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
  <div class="row">
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon">
          <i class="fas fa-truck" style="color: #666666;"></i>
        </span>
        <input class="form-control" data-toggle="tooltip" readonly data-placement="bottom" title="Product supplier" value="<?php echo remove_junk($e_supplier['supp_name']); ?>">

      </div>
    </div>
  </div>
</div>

              <button type="submit" name="product" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Save changes">
                <span class="fas fa-check"></span> Save Changes
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
