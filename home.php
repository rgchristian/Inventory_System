<?php
  $page_title = 'Home';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('home.php', false);}
?>
<?php include_once('layouts/header.php'); ?>

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
         <h1>Welcome, User.</h1> 
         <h1><span class="fa fa-cubes"></span> Tile Inventory Management System</h1>
         <hr><p>Browse around to find out the pages that you can access.</p>
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>

