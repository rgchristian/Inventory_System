<?php
  $page_title = 'Dashboard';
  require_once('includes/load.php');
  // Checking what level user has permission to view this page
  page_require_level(2);
?>

<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('sales');
 $products_sold   = find_higest_saleing_product('10');
 $recent_products = find_recent_product_added('5');
 $recent_sales    = find_recent_sale_added('5');
?>

<?php include_once('layouts/header.php');?>

<style>
  body {
    background-color: #DDDDDD;
    }
</style>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>

<div class="row">
  <a href="categorie.php" style="color:black;">
    <div class="col-md-4">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left" style="background-color: #567189;"> 
          <i class="fas fa-th-large"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 style="color: #567189;" class="margin-top"> <?php echo $c_categorie['total'];?> </h2>
          <p class="text-muted">Tile Types</p>
        </div>
      </div>
    </div>
  </a>

  <a href="product.php" style="color:black;">
    <div class="col-md-4">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left" style="background-color: #567189;">
          <i class="fab fa-delicious"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 style="color: #567189;" class="margin-top"> <?php echo $c_product['total'];?> </h2>
          <p class="text-muted">Tile Products</p>
        </div>
      </div>
    </div>
  </a>

  <a href="sales.php" style="color:black;">
    <div class="col-md-4">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left" style="background-color: #567189;">
          <i class="fas fa-dollar"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 style="color: #567189;" class="margin-top"> <?php echo $c_sale['total'];?></h2>
          <p class="text-muted">Sold Product</p>
        </div>
      </div>
    </div>
  </a>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading clearfix">
        <strong>
        <span ></span>
          <span> Highest Selling Products</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-condensed" style="color: #567189;">
          <thead>
            <tr>
              <th>Product Name</th>
              <th class="text-center">Total Sales</th>
              <th class="text-center">Total Sold</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products_sold as $product_sold): ?>
            <tr>
              <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
              <td class="text-center"><?php echo (int)$product_sold['totalSold']; ?></td>
              <td class="text-center"><?php echo (int)$product_sold['totalQty']; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading clearfix">
        <strong>
          <span ></span>
          <span > Latest Sales</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-condensed" style="color: #567189;">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Product Name</th>
              <th class="text-center">Date</th>
              <th class="text-center">Total Sale</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recent_sales as $recent_sale): ?>
            <tr>
              <td class="text-center"><?php echo count_id();?></td>
              <td>
                <a href="edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>">
                  <?php echo remove_junk(first_character($recent_sale['name'])); ?>
                </a>
              </td>
              <td class="text-center"><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
              <td class="text-center">₱ <?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <strong>
          <span ></span>
          <span >Recently Added Products</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="table table-condensed" style="color: #567189;">
          <?php foreach ($recent_products as $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo (int)$recent_product['id'];?>">
              <h4 class="list-group-item-heading" style="color: #567189;">
                <?php if($recent_product['media_id'] === '0'): ?>
                  <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image'];?>" alt="" />
                <?php endif;?>
                <?php echo remove_junk(first_character($recent_product['name']));?>
                <span class="label label-warning pull-right">
                  ₱ <?php echo (int)$recent_product['sale_price']; ?>
                </span>
              </h4>
              <span style="color: #567189;" class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['categorie'])); ?>
              </span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>