<?php
  $page_title = 'System User';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
 page_require_level(1);
//pull out all user form database
 $all_users = find_all_user();
?>
<?php include_once('layouts/header.php'); ?>



<style>
  body {
    background-color: #DDDDDD;
    }
</style>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-info">
      <div class="panel-heading clearfix">
        <strong>
          
          <span >Users</span>
       </strong>
         <a href="add_user.php" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add new user to the system"><i class="fas fa-plus">&nbsp;</i> Add New User</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered" style="color: #567189;">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Name </th>
            <th class="text-center">Username</th>
            <th class="text-center" style="width: 20%;">User Role</th>
            <th class="text-center" style="width: 15%;">Status</th>
            <th class="text-center" style="width: 20%;">Last Login</th>
            <th class="text-center" style="width: 100px;">Actions</th>
          </tr>
          
        </thead>
        <tbody>
        <?php foreach($all_users as $a_user): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['username']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
           <td class="text-center">
           <?php if($a_user['status'] === '1'): ?>
            <span class="label label-success"><?php echo "Active"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Inactive"; ?></span>
          <?php endif;?>
           </td>
           <td class="text-center"><?php echo read_date($a_user['last_login'])?></td>
           <td class="text-center">
             <div class="btn-group">
                <a class="text-center" href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit user account">
                  <i class="fas fa-pencil-square-o" style="color: #567189;"></i>
               </a>
                <a class="text-center" href="delete_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove user account">
                  <i class="fas fa-trash" style="color: #567189;"></i>
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
