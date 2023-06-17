<?php
$page_title = 'Inventory';
require_once('includes/load.php');
page_require_level(2);

$products = join_product_table();

// Function to search products based on the search term
function search_products($search_term) {
    global $products;
    $search_results = array();

    foreach ($products as $product) {
        if (stripos($product['name'], $search_term) !== false ||
            stripos($product['tile_size'], $search_term) !== false ||
            stripos($product['categorie'], $search_term) !== false ||
            stripos($product['supplier'], $search_term) !== false) {
            $search_results[] = $product;
        }
    }

    return $search_results;
}

// Function to filter products by category
function filter_products($category) {
    global $products;
    $filtered_results = array();

    foreach ($products as $product) {
        if (strcasecmp($product['categorie'], $category) === 0) {
            $filtered_results[] = $product;
        }
    }

    return $filtered_results;
}

// Check if a search term or category is provided
if (isset($_POST['search'])) {
    $search_term = $_POST['search'];
    $products = search_products($search_term);
} elseif (isset($_POST['category'])) {
    $category = $_POST['category'];
    $products = filter_products($category);

    $filter_result = "<div class='pull-right'>
                          <a href='product.php' class='btn custom-primary-btn btn-sm'><span class='fas fa-cube'></span></a>
                      </div>";
}
?>

<?php include_once('layouts/header.php'); ?>

<style>
  body {
    background-color: #DDDDDD;
  }

  .critical-stock {
    background-color: #f4dcdc !important;
  }

  .over-stock {
    background-color: #fffce4 !important; 
  }

  .button-container {
  display: flex;
  align-items: center;
  gap: 10px;
}


  .readonly-button {
    background-color: #f5f5f5;
    border-color: #ddd;
    color: #999;
    cursor: not-allowed;
  }
  .custom-primary-btn {
  margin-right: 10px;
}

</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var quantityInput = document.querySelector('input[name="quantity"]');
    var sellButton = document.querySelector('button[name="add_sale"]');

    quantityInput.addEventListener('input', function() {
      if (quantityInput.value === '0') {
        sellButton.disabled = true;
      } else {
        sellButton.disabled = false;
      }
    });
  });
</script>

<div class="row">
  <div class="col-md-12">
    <?php
    // Check for critical stock
    $critical_stock_message = '';
    $over_stock_message = '';
    
    // Initialize the over-stock message
    foreach ($products as $product) {
      $stock = remove_junk($product['quantity']);
      if ($stock <= 99) {
        $critical_stock_message .= '' . remove_junk($product['name']) . '<br>';
      }
      if ($stock >= 499) {
        $over_stock_message .= '' . remove_junk($product['name']) . '<br>'; 
      }
    }
    if (!empty($critical_stock_message)) {
      $_SESSION['danger'] = "The following product(s) have critical stock:<br>{$critical_stock_message}";
    }
    if (!empty($over_stock_message)) {
      $_SESSION['warning'] = "The following product(s) are in danger of over-stock:<br>{$over_stock_message}";
    }
    ?>
  </div>
  
  <div class="col-md-12">
    <div class="panel panel-info" >
        <div class="panel-heading clearfix">
            <strong>
                <span >Tile Products</span>
            </strong>
            <div class="pull-right button-container">
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="">
                            <div class="input-group pull-right">
                                <input type="text" class="form-control" name="search" placeholder="Search for tile" data-toggle="tooltip" data-placement="bottom" title="Input product name" style="font-size: 13px;" value="<?php echo isset($search_term) ? $search_term : ''; ?>">
                                <span class="input-group-btn">
                                    <button class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Search product" type="submit" style="font-size: 13px;"><i class="fa fa-search" style="font-size: 13px;"></i></button>&nbsp;
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="button-group">
                            <a href="add_product.php" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Add new tile product"><i class="fas fa-plus"></i> Add New Tile Product</a>
                            <a href="product.php" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Inventory"><span class="fab fa-delicious"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <?php echo display_msg($msg); ?>
            <?php if (isset($_SESSION['danger'])): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $_SESSION['danger']; ?>
                </div>
                <?php unset($_SESSION['danger']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['warning'])): ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $_SESSION['warning']; ?>
                </div>
                <?php unset($_SESSION['warning']); ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-3">
                    <form method="POST" action="">
                        <div class="input-group clearfix">
                            <div class="input-group-prepend">
                                <button class="btn custom-primary-btn btn-sm dropdown-toggle pull-right" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-filter">&nbsp;</i>&nbsp;<i class="fas fa-th-large">&nbsp;</i>&nbsp;<i class="fas fa-caret-down"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a href="product.php" class="btn custom-primary-btn btn-sm pull-right" data-toggle="tooltip" data-placement="bottom" title="Clear filter"><span class="fas fa-times"></span></a>
                                    <?php
                                    $categories = array_unique(array_column($products, 'categorie'));
                                    foreach ($categories as $category) {
                                        echo "<button class='dropdown-item' type='submit' name='category' value='$category'>$category</button>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

 
      <div class="panel-body">
        
        <?php if (isset($_SESSION['danger'])): ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $_SESSION['danger']; ?>
          </div>
          <?php unset($_SESSION['danger']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['warning'])): ?>
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $_SESSION['warning']; ?>
          </div>
          <?php unset($_SESSION['warning']); ?>
        <?php endif; ?>

        

        <table class="table table-bordered" style="color: #567189;">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th class="text-center" style="width: 10%;">Product Photo</th>
              <th class="text-center" style="width: 10%;">Product Name</th>
              <th class="text-center" style="width: 7%;">Tile Size</th>
              <th class="text-center" style="width: 10%;">Tile Type</th>
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
              $over_stock = $stock >= 499;
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
                <td class="text-center <?php if ($critical_stock) echo 'critical-stock'; ?><?php if ($over_stock) echo 'over-stock'; ?>">
  <?php echo ($stock > 0) ? $stock : 'Out of Stock'; ?>
</td>
                <td class="text-center"><?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"><?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"><?php echo date('Y-m-d H:i:s', strtotime($product['date'].'+6 hours')); ?></td>
                <td class="text-center"><?php echo remove_junk($product['supplier']); ?></td>
                <td class="text-center">

                  <div class="btn-group">
                    
                    <a class="text-center" href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-warning btn-xs" title="Edit product" data-toggle="tooltip">
                      <span class="fas fa-pencil-square-o" style="color: #567189;"></span>
                    </a>

                    <a class="text-center" href="add_stock.php?id=<?php echo (int)$product['id'];?>" class="btn btn-primary btn-xs" title="Add product stock" data-toggle="tooltip">
                      <span class="fas fa-plus-square" style="color: #567189;"></span>
                    </a>

                    <!-- <a class="text-center" href="add_sale.php?id=<?php echo (int)$product['id'];?>" class="btn btn-success btn-xs" title="Sell product" data-toggle="tooltip">
                      <span class="fas fa-cart-plus" style="color: #567189;"></span>
                    </a> -->

                    <?php if ($stock > 0): ?>
  <a class="text-center" href="add_sale.php?id=<?php echo (int)$product['id'];?>" class="btn btn-success btn-xs" title="Sell product" data-toggle="tooltip">
    <span class="fas fa-cart-plus" style="color: #567189;"></span>
  </a>
<?php else: ?>
  <a class="text-center" class="btn btn-success btn-xs" title="Sell product" data-toggle="tooltip" disabled>
    <span class="fas fa-cart-plus" style="color: #567189;"></span>
</a>
<?php endif; ?>


                    <a class="text-center" href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs" title="Remove product" data-toggle="tooltip">
                      <span class="fas fa-trash" style="color: #567189;"></span>
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
