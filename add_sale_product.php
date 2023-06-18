<?php
  $page_title = 'Search & Sell Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('s_id','quantity','price','total', 'date' );
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$_POST['s_id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = make_date();

          $sql  = "INSERT INTO sales (";
          $sql .= " product_id,qty,price,date";
          $sql .= ") VALUES (";
          $sql .= "'{$p_id}','{$s_qty}','{$s_total}','{$s_date}'";
          $sql .= ")";

                if($db->query($sql)){
                  update_product_qty($s_qty,$p_id);
                  $session->msg('s', "Product sold successfully.");
                  redirect('sales.php', false);
                } else {
                  $session->msg('d', 'Failed to sale product.');
                  redirect('sales.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('sales.php',false);
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
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Search product"><span class="fas fa-search"></span> Search</button>
            </span>
            <input type="text" id="sug_input" data-toggle="tooltip" data-placement="bottom" title="Input product name" class="form-control" name="title" placeholder="Search for product name to sell">
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
          <a href="sales.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
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