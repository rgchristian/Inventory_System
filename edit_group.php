<?php
  $page_title = 'Edit Group';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>
<?php
  $e_group = find_by_id('user_groups',(int)$_GET['id']);
  if(!$e_group){
    $session->msg("d","Missing Group id.");
    redirect('group.php');
  }
?>

<?php
  if(isset($_POST['update'])){
   $req_fields = array('group-name','group-level');
   validate_fields($req_fields);
   if(empty($errors)){
           $name = remove_junk($db->escape($_POST['group-name']));
          $level = remove_junk($db->escape($_POST['group-level']));
         $status = remove_junk($db->escape($_POST['status']));

        $query  = "UPDATE user_groups SET ";
        $query .= "group_name='{$name}',group_level='{$level}',group_status='{$status}'";
        $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s', "Role updated successfully.");
          redirect('edit_group.php?id='.(int)$e_group['id'], false);
        } else {
          //failed
          $session->msg('d', 'Failed to update role.');
          redirect('edit_group.php?id='.(int)$e_group['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('edit_group.php?id='.(int)$e_group['id'], false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
  </div>
   <div class="row">
    <div class="col-md-5">
      <div class="panel panel-info">
        <div class="panel-heading clearfix">
          <strong>
            
            <span >Edit Role</span>
          </strong>

          <div class="pull-right">
          <a href="group.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
      </div>
        

        

        <div class="panel-body">
          <form method="post" action="edit_group.php?id=<?php echo (int)$e_group['id'];?>">

          <form method="post" action="edit_group.php?id=<?php echo (int)$e_group['id'];?>" class="clearfix">
        <div class="form-group">
              <label style="color: #567189;" for="name" class="control-label">Role Name</label>
              <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-pencil-alt" style="color: #567189;"></i></span>
              <input type="name" class="form-control" name="group-name" data-toggle="tooltip" data-placement="bottom" title="Edit role name" value="<?php echo remove_junk(ucwords($e_group['group_name'])); ?>">
        </div>
        </div>
        

        <div class="form-group">
              <label style="color: #567189;" for="level" class="control-label">Access Level</label>
              <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-key" style="color: #567189;"></i></span>

              <input type="number" class="form-control" name="group-level" data-toggle="tooltip" data-placement="bottom" title="Edit role access level" value="<?php echo (int)$e_group['group_level']; ?>">
        </div>
        </div>

        <div class="form-group">
          <label style="color: #567189;" for="status">Status</label>
          <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-toggle-on" style="color: #567189;"></i></span>
              <select class="form-control" data-toggle="tooltip" data-placement="bottom" title="Activate/Deactivate role" name="status">
                <option <?php if($e_group['group_status'] === '1') echo 'selected="selected"';?> value="1">Active</option>
                <option <?php if($e_group['group_status'] === '0') echo 'selected="selected"';?> value="0">Inactive</option>
              </select>
        </div>
        </div>

        <div class="form-group">
        <button type="submit" name="update" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Save changes"><span class="fas fa-check"></span> Save Changes</button>
        </div>
    </form>
</div>

<?php include_once('layouts/footer.php'); ?>


