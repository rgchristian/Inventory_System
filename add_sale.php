<?php
  $page_title = 'Sell Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
   
?>

<?php

  if (isset($_POST['add_sale'])) {
  $req_fields = array('s_id', 'quantity', 'price', 'total', 'date');
  validate_fields($req_fields);

  if (empty($errors)) {
    $p_id    = $db->escape((int)$_POST['s_id']);
    $s_qty   = $db->escape((int)$_POST['quantity']);
    $s_total = $db->escape($_POST['total']);
    $date    = $db->escape($_POST['date']);
    $s_date  = make_date();

    // Check if the selling quantity exceeds the available quantity
    $product = find_product_by_id($p_id);
    if ($product['quantity'] >= $s_qty) {
      $sql = "INSERT INTO sales (product_id, qty, price, date) VALUES ('{$p_id}', '{$s_qty}', '{$s_total}', '{$s_date}')";

      if ($db->query($sql)) {
        update_product_qty($s_qty, $p_id);
        $session->msg('s', "Product sold successfully.");
        redirect('product.php', false);
      } else {
        $session->msg('d', 'Failed to sell product.');
        redirect('add_sale.php', false);
      }
    } else {
      $session->msg('d', "Selling quantity exceeds the available quantity for the product: {$product['name']}");
      redirect('add_sale.php', false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('add_sale.php', false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>

<?php
require_once('includes/load.php');
page_require_level(2);

// Check if a product ID is provided
if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
    $product = find_product_by_id($product_id);
    
    // Check if the product is found
    if (!$product) {
        $session->msg('d', 'Product not found!');
        redirect('product.php');
    }
} else {
    $session->msg('d', 'Invalid product ID!');
    redirect('product.php');
}
?>
<style>
  body {
    background-color: #DDDDDD;
    }
</style>

<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Search product"><span class="fas fa-search"></span> Search</button>
            </span>
            <?php
            // Retrieve the product name from the database
            $product_name = ''; // Initialize the variable
            if (isset($product['name'])) {
              $product_name = remove_junk($product['name']);
            }
            ?>
            <input type="text" id="sug_input" data-toggle="tooltip" data-placement="bottom" title="Input product name" class="form-control" name="title" value="<?php echo $product_name; ?>">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="panel panel-info">
      <div class="panel-heading clearfix">
        <strong>
          
          <span >Sell Product</span>
       </strong>
       <div class="pull-right">
          <a href="product.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php">
         <table class="table table-bordered" style="color: #567189;">
           <thead>
            <th class="text-center"> Item </th>
            <th class="text-center"> Price </th>
            <th class="text-center"> Quantity </th>
            <th class="text-center"> Total </th>
            <th class="text-center"> Date </th>
            <th class="text-center"> Action </th>
           </thead>
             <tbody id="product_info"> </tbody>
         </table>
       </form>
      </div>
    </div>
  </div>

</div>

<?php include_once('layouts/footer.php'); ?>