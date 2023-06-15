<?php
  $page_title = 'User Roles';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
  $all_groups = find_all('user_groups');
?>
<?php include_once('layouts/header.php'); ?>

<style>
  body {
    background-color: #DDDDDD;
    }

  .custom-primary-btn {
    background-color: #567189;
    color: white;
    
  }
  .custom-primary-btn:hover {
    background-color: white;
    border-color: black;
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
        <span >Roles</span>
     </strong>
     <a href="add_group.php" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add new access role"><span class="fa fa-plus"></span> Add New Role</a>
    </div>
     <div class="panel-body">
      <table class="table table-bordered" style="color: #567189;">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th >Role Name</th>
            <th class="text-center" style="width: 20%;">Access Level</th>
            <th class="text-center" style="width: 15%;">Status</th>
            <th class="text-center" style="width: 100px;">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_groups as $a_group): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_group['group_name']))?></td>
           <td class="text-center">
             <?php echo remove_junk(ucwords($a_group['group_level']))?>
           </td>
           <td class="text-center">
           <?php if($a_group['group_status'] === '1'): ?>
            <span class="label label-success"><?php echo "Active"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Deactive"; ?></span>
          <?php endif;?>
           </td>
           <td class="text-center">
             <div class="btn-group">
                <a class="text-center" href="edit_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit access role">
                  <i class="fas fa-pencil-square-o" style="color: #567189;"></i>
               </a>
                <a class="text-center" href="delete_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove role">
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
