<?php
$page_title = 'Add Product';
require_once('includes/load.php');
// Checking what level user has permission to view this page
page_require_level(2);
$all_categories = find_all('categories');
$all_photo = find_all('media');
$all_suppliers = find_suppliers('suppliers');
?>

<?php
if (isset($_POST['add_product'])) {
  $req_fields = array('product-title', 'product-categorie', 'product-quantity', 'buying-price', 'saleing-price', 'tile-size', 'supplier');
  validate_fields($req_fields);
  if (empty($errors)) {
    $p_name = remove_junk($db->escape($_POST['product-title']));
    $p_cat = remove_junk($db->escape($_POST['product-categorie']));
    $p_qty = remove_junk($db->escape($_POST['product-quantity']));
    $p_buy = remove_junk($db->escape($_POST['buying-price']));
    $p_sale = remove_junk($db->escape($_POST['saleing-price']));
    $p_size = remove_junk($db->escape($_POST['tile-size']));
    $p_supplier = remove_junk($db->escape($_POST['supplier']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }
    $date = make_date();
    $query = "INSERT INTO products (";
    $query .= "name, quantity, buy_price, sale_price, categorie_id, media_id, date, tile_size, supplier";
    $query .= ") VALUES (";
    $query .= "'{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}', '{$p_size}', '{$p_supplier}'";
    $query .= ")";
    $query .= " ON DUPLICATE KEY UPDATE name='{$p_name}', tile_size='{$p_size}'";
    if ($db->query($query)) {
      $session->msg('s', "Product successfully added.");
      redirect('add_product.php', false);
    } else {
      $session->msg('d', 'Failed to add product.');
      redirect('product.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_product.php', false);
  }
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
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span>Add New Product</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">

            <div class="form-group">
              <div class="row">
                <div class="col-md-9">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-pencil"></i>
                    </span>
                    <input type="text" class="form-control" name="product-title" placeholder="Product Title">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <select class="form-control" name="tile-size" style="width: 116%;">
                      <option value="">Select Tile Size</option>
                      <!-- Add the options for different tile sizes here -->
                      <option value="10x10">10x10</option>
                      <option value="20x20">20x20</option>
                      <option value="30x30">30x30</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <select class="form-control" name="product-categorie">
                    <option value="">Select Product Category</option>
                    <?php foreach ($all_categories as $cat) : ?>
                      <option value="<?php echo (int) $cat['id'] ?>">
                        <?php echo $cat['name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-6">
                  <select class="form-control" name="product-photo">
                    <option value="">Select Product Photo</option>
                    <?php foreach ($all_photo as $photo) : ?>
                      <option value="<?php echo (int) $photo['id'] ?>">
                        <?php echo $photo['file_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                    </span>
                    <input type="number" class="form-control" name="product-quantity" placeholder="Product Quantity">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-money"></i>
                    </span>
                    <input type="number" class="form-control" name="buying-price" placeholder="Buying Price">
                    <span class="input-group-addon">.00</span>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-tag"></i>
                    </span>
                    <input type="number" class="form-control" name="saleing-price" placeholder="Selling Price">
                    <span class="input-group-addon">.00</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <select class="form-control" name="supplier">
                    <option value="">Select Supplier</option>
                    <?php foreach ($all_suppliers as $sup) : ?>
                      <option value="<?php echo (int) $sup['id'] ?>">
                        <?php echo $sup['supp_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <button type="submit" name="add_product" class="btn btn-primary pull-right btn-sm">
              <span class="fa fa-check"></span> Done
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
