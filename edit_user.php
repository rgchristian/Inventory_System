<?php
  $page_title = 'Edit User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>

<?php
  $e_user = find_by_id('users',(int)$_GET['id']);
  $groups  = find_all('user_groups');
  if(!$e_user){
    $session->msg("d","Missing user id.");
    redirect('users.php');
  }
?>

<?php
//Update User basic info
  if(isset($_POST['update'])) {
    $req_fields = array('name','username','level');
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$e_user['id'];
           $name = remove_junk($db->escape($_POST['name']));
       $username = remove_junk($db->escape($_POST['username']));
          $level = (int)$db->escape($_POST['level']);
       $status   = remove_junk($db->escape($_POST['status']));
            $sql = "UPDATE users SET name ='{$name}', username ='{$username}',user_level='{$level}',status='{$status}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"User account successfully updated.");
            redirect('users.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Failed to update user account.');
            redirect('edit_user.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('edit_user.php?id='.(int)$e_user['id'],false);
    }
  }
?>
<?php
// Update user password
if(isset($_POST['update-pass'])) {
  $req_fields = array('password');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
     $password = remove_junk($db->escape($_POST['password']));
     $h_pass   = sha1($password);
          $sql = "UPDATE users SET password='{$h_pass}' WHERE id='{$db->escape($id)}'";
       $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"Password updated successfully.");
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d', 'Failed to update user password.');
          redirect('edit_user.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('edit_user.php?id='.(int)$e_user['id'],false);
  }
}
?>

<?php include_once('layouts/header.php'); ?>
 <div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-info">
       <div class="panel-heading clearfix">
        <strong >
          
          Edit User Account
        </strong>
        <div class="pull-right">
          <a href="users.php" class="btn custom-primary-btn btn-sm" data-toggle="tooltip" data-placement="bottom" title="Back"><span class="fas fa-arrow-left"></span></a>
        </div>
      </div>
       <div class="panel-body">
          <form method="post" action="edit_user.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
          <div class="form-group">
  <label style="color: #7f7f7f;" for="name" class="control-label">Name</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-pencil-alt" style="color: #666666;"></i>
    </span>
    <input type="name" class="form-control" name="name" data-toggle="tooltip" data-placement="bottom" title="Edit user's full name" value="<?php echo remove_junk(ucwords($e_user['name'])); ?>">
  </div>
</div>
<div class="form-group">
  <label style="color: #7f7f7f;" for="username" class="control-label">Username</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-user" style="color: #666666;"></i>
    </span>
    <input type="text" class="form-control" name="username" data-toggle="tooltip" data-placement="bottom" title="Edit user's username" value="<?php echo remove_junk(ucwords($e_user['username'])); ?>">
  </div>
</div>
<div class="form-group">
  <label style="color: #7f7f7f;" for="level">User Role</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-user-check" style="color: #666666;"></i>
    </span>
    <select class="form-control" data-toggle="tooltip" data-placement="bottom" title="Edit user's access level" name="level">
      <?php foreach ($groups as $group ):?>
        <option <?php if($group['group_level'] === $e_user['user_level']) echo 'selected="selected"';?> value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
      <?php endforeach;?>
    </select>
  </div>
</div>
<div class="form-group">
  <label style="color: #7f7f7f;" for="status">Status</label>
  <div class="input-group">
    <span class="input-group-addon">
      <i class="fas fa-toggle-on" style="color: #666666;"></i>
    </span>
    <select class="form-control" data-toggle="tooltip" data-placement="bottom" title="Activate/Deactivate user" name="status">
      <option <?php if($e_user['status'] === '1') echo 'selected="selected"';?>value="1">Active</option>
      <option <?php if($e_user['status'] === '0') echo 'selected="selected"';?> value="0">Inactive</option>
    </select>
  </div>
</div>

            <div class="form-group">
                    <button type="submit" name="update" class="btn custom-primary-btn pull-right btn-sm" data-toggle="tooltip" data-placement="bottom" title="Save changes"><span class="fas fa-check"></span> Save Changes</button>
            </div>
        </form>
       </div>
     </div>
  </div>
  
  
      
    

      


<?php include_once('layouts/footer.php'); ?>
