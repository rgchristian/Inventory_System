<?php
  $page_title = 'Sold Products';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
$sales = find_all_sale();
?>
<?php include_once('layouts/header.php'); ?>

<style>
  body {
    background-color: #DDDDDD;
    }

    .button-container {
  display: flex;
  align-items: center;
  gap: 10px;
}
</style>

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
            <span >Sold Products</span>
          </strong>

          <div class="pull-right button-container">
  <a href="product.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Inventory"><span class="fab fa-delicious"></span></a>
  <a href="add_sale_product.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Sell product"><span class="fas fa-plus"></span> Sell Product</a>
</div>

</div>

        <div class="panel-body">
          <table class="table table-bordered" style="color: #567189;">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Product name </th>
                <th class="text-center" style="width: 15%;"> Quantity</th>
                <th class="text-center" style="width: 15%;"> Total </th> 
                <th class="text-center" style="width: 15%;"> Date </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>

           <tbody>
             <?php foreach ($sales as $sale):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($sale['name']); ?></td>
               <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
               <td class="text-center"><?php echo remove_junk($sale['price']); ?></td>
               <td class="text-center"><?php echo $sale['date']; ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a class="text-center" href="edit_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-warning btn-xs"  title="Edit sale record" data-toggle="tooltip">
                       <span class="fas fa-edit" style="color: #567189;"></span>
                     </a>
                     <a class="text-center" href="delete_sale.php?id=<?php echo (int)$sale['id'];?>" class="btn btn-danger btn-xs"  title="Remove sale record" data-toggle="tooltip">
                       <span class="fas fa-trash" style="color: #567189;"></span>
                     </a>
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
           
         </table>

        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>


<!-- <?php
  $page_title = 'History';
  require_once('includes/load.php');
  // Checking what level user has permission to view this page
  page_require_level(3);
?>
<?php
  $sales = find_all_sale();
?>
<?php include_once('layouts/header.php'); ?>

<style>
  body {
    background-color: #DDDDDD;
  }

  .button-container {
    display: flex;
    align-items: center;
    gap: 10px;
  }
</style>

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
          <span>Sold Products History</span>
        </strong>

        <div class="pull-right button-container">
          <a href="product.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Inventory"><span class="fab fa-delicious"></span></a>
          <a href="add_sale_product.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Sell product"><span class="fas fa-plus"></span> Sell Product</a>
        </div>
      </div>

      <div class="panel-body">
        <table class="table table-bordered" style="color: #567189;">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Product name</th>
              <th class="text-center" style="width: 15%;">Quantity</th>
              <th class="text-center" style="width: 15%;">Total</th> 
              <th class="text-center" style="width: 15%;">Date</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($sales as $sale): ?>
            <?php
              $product = find_by_id('products', $sale['product_id']);
              if ($product['quantity'] == 0) {
                continue; // Skip the iteration if quantity is zero
              }
            ?>
            <tr>
              <td class="text-center"><?php echo count_id(); ?></td>
              <td><?php echo remove_junk($sale['name']); ?></td>
              <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
              <td class="text-center"><?php echo remove_junk($sale['price']); ?></td>
              <td class="text-center"><?php echo $sale['date']; ?></td>
              <td class="text-center">
                <div class="btn-group">
                  <a class="text-center" href="edit_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-warning btn-xs" title="Edit sale record" data-toggle="tooltip">
                    <span class="fas fa-edit" style="color: #567189;"></span>
                  </a>
                  <a class="text-center" href="delete_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-danger btn-xs" title="Remove sale record" data-toggle="tooltip">
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

<?php include_once('layouts/footer.php'); ?> -->

