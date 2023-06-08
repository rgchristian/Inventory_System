<?php
  $page_title = 'Home';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>

<?php
 $c_categorie     = count_by_id('categories');
 $c_product       = count_by_id('products');
 $c_sale          = count_by_id('sales');
 $c_user          = count_by_id('users');
 $products_sold   = find_higest_saleing_product('10');
 $recent_products = find_recent_product_added('5');
 $recent_sales    = find_recent_sale_added('5');
 $supplier_count = count_by_id('suppliers');
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
  <a href="users.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left" style="background-color: #5d7cb1;">
          <i class="fa fa-user">&nbsp;</i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php echo $c_user['total'];?></h2>
          <p class="text-muted">Users</p>
        </div>
      </div>
    </div>
  </a>

  <a href="categorie.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left" style="background-color: #756f4b;"> 
          <i class="fa fa-th-large">&nbsp;</i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_categorie['total'];?> </h2>
          <p class="text-muted">Categories</p>
        </div>
      </div>
    </div>
  </a>

  <a href="product.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left" style="background-color: #8B5742;">
          <i class="fa fa-delicious">&nbsp;</i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_product['total'];?> </h2>
          <p class="text-muted">Products Stock</p>
        </div>
      </div>
    </div>
  </a>

  <a href="sales.php" style="color:black;">
    <div class="col-md-3">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left" style="background-color: #617A55;">
          <i class="fa fa-dollar">&nbsp;</i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_sale['total'];?></h2>
          <p class="text-muted">Stock-Out</p>
        </div>
      </div>
    </div>
  </a>
</div>

<div class="row">
  <div class="col-md-3">
    <a href="supplier.php" style="color:black;">
      <div class="panel panel-box clearfix">
        <div class="panel-icon pull-left" style="background-color: #E8A0BF;">
          <i class="fa fa-truck">&nbsp;</i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"><?php echo $supplier_count['total']; ?></h2>
          <p class="text-muted">Suppliers</p>
        </div>
      </div>
    </a>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span <i class="fa fa-line-chart">&nbsp;</i></span>
          <span>Highest Selling Products</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th>Title</th>
              <th>Total Sales</th>
              <th>Total Quantity</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products_sold as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                <td><?php echo (int)$product_sold['totalQty']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="fa fa-bullhorn"></span>
          <span>LATEST SALES</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Product Name</th>
              <th>Date</th>
              <th>Total Sale</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recent_sales as  $recent_sale): ?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <!-- <a href="edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>"> -->
                  <?php echo remove_junk(first_character($recent_sale['name'])); ?>
                  </a>
                </td>
                <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
                <td>₱ <?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
        <span class="fa fa-history"></span>
          <span>Recently Added Products</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="list-group">
          <?php foreach ($recent_products as  $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?id=<?php echo (int)$recent_product['id'];?>">
              <h4 class="list-group-item-heading">
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
              <span class="list-group-item-text pull-right">
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
