<?php
$page_title = 'Product Stock Inventory';
require_once('includes/load.php');
page_require_level(2);

$products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>

<style>
  body {
    background-color: #DDDDDD;
  }

  .critical-stock {
    background-color: #fffce4 !important;
  }

  .over-stock {
    background-color: #f4dcdc !important;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <?php
    // Check for critical stock
    $critical_stock_message = '';
    $over_stock_message = ''; // Initialize the over-stock message
    foreach ($products as $product) {
      $stock = remove_junk($product['quantity']);
      if ($stock <= 99) {
        $critical_stock_message .= '' . remove_junk($product['name']) . '<br>';
      }
      if ($stock >= 999) {
        $over_stock_message .= '' . remove_junk($product['name']) . '<br>'; 
      }
    }
    if (!empty($critical_stock_message)) {
      $_SESSION['warning'] = "The following product(s) have critical stock:<br>{$critical_stock_message}";
    }
    if (!empty($over_stock_message)) {
      $_SESSION['danger'] = "The following product(s) are in danger of over-stock:<br>{$over_stock_message}";
    }
    ?>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span>Manage Products Stock</span>
        </strong>
        <div class="pull-right">
          <a href="add_product.php" class="btn btn-primary btn-sm"><i class="fa fa-plus">&nbsp;</i> Add New Product Stock</a>
        </div>
      </div>

      <div class="panel-body">
        <?php echo display_msg($msg); ?>
        <?php if (isset($_SESSION['warning'])): ?>
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $_SESSION['warning']; ?>
          </div>
          <?php unset($_SESSION['warning']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['danger'])): ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $_SESSION['danger']; ?>
          </div>
          <?php unset($_SESSION['danger']); ?>
        <?php endif; ?>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th class="text-center" style="width: 10%;">Product Photo</th>
              <th class="text-center" style="width: 10%;">Product Name</th>
              <th class="text-center" style="width: 10%;">Tile Size</th>
              <th class="text-center" style="width: 10%;">Category</th>
              <th class="text-center" style="width: 10%;">In-Stock</th>
              <th class="text-center" style="width: 10%;">Buying Price</th>
              <th class="text-center" style="width: 10%;">Selling Price</th>
              <th class="text-center" style="width: 12%;">Product Added</th>
              <th class="text-center" style="width: 100px;">Supplier</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product): ?>
              <?php
              $barcode = isset($product['barcode']) ? remove_junk($product['barcode']) : '';
              $stock = remove_junk($product['quantity']);
              $critical_stock = $stock <= 99;
              $over_stock = $stock >= 999;
              ?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center">
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                    <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                  <?php endif; ?>
                </td>
                <td class="text-center"><?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['tile_size']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center <?php if ($critical_stock) echo 'critical-stock'; ?><?php if ($over_stock) echo 'over-stock'; ?>"><?php echo $stock; ?></td>
                <td class="text-center"><?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"><?php echo date('Y-m-d H:i:s', strtotime($product['date'].'+6 hours')); ?></td>
                <td class="text-center"><?php echo remove_junk($product['supplier']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-warning btn-xs" title="Edit Stock" data-toggle="tooltip">
                      <span class="fa fa-pencil-square-o"></span>
                    </a>

                    <a href="add_stock.php?id=<?php echo (int)$product['id']; ?>&quantity=<?php echo (int)$product['quantity']; ?>" class="btn btn-success btn-xs" title="Add Stock" data-toggle="tooltip">
                      <span class="fa fa-plus"></span>
                    </a>
                  
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs" title="Remove" data-toggle="tooltip">
                      <span class="fa fa-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
