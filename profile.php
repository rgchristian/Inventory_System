<?php
  $page_title = 'User Profile';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
  <?php
  $user_id = (int)$_GET['id'];
  if(empty($user_id)):
    redirect('home.php',false);
  else:
    $user_p = find_by_id('users',$user_id);
  endif;
?>
<?php include_once('layouts/header.php'); ?>

<style>
  body {
    background-color: #DDDDDD;
    }
</style>

<div class="row">
   <div class="col-md-4">
       <div class="panel profile panel-info">
       <div class="jumbotron text-center" style="background-color: #567189;">
            <img class="img-circle img-size-2" src="uploads/users/<?php echo $user_p['image'];?>" alt="">
           <h3><?php echo first_character($user_p['name']); ?></h3>
         </div>
        <?php if( $user_p['id'] === $user['id']):?>
         <ul class="nav nav-pills nav-stacked">
          <li><a href="edit_account.php" data-toggle="tooltip" data-placement="bottom" title="Edit account"> <i class="fas fa-arrow-right pull-right" style="color: #567189;"></i> <strong style="color: #567189;">Edit Account</a></li></strong>
         </ul>
       <?php endif;?>
       </div>
   </div>
</div>
<?php include_once('layouts/footer.php'); ?>
