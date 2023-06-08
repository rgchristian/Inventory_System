<?php
  $page_title = 'Shop';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('customer_home.php', false);}
?>
<?php include_once('layouts/customer_header.php'); ?>

<style>
  body {
    background-color: #DDDDDD;
    }
</style>

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1><span class="fas fa-user-tie"></span> Welcome, User.</h1> 
         <h1><span class="fas fa-cubes"></span> Tile Shop</h1>
         <hr><p><span class="fas fa-mouse-pointer"></span> Browse around to find out the pages that you can access.</p>
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>

